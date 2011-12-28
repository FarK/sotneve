<?php
include_once("conexion.php");

abstract class Tabla{
	var $conexion;

	var $nomTabla;			//Nombre de la tabla
	var $pks = array();		//Las claves primarias de la tabla ($nomCampo=>$valor)

	var $consultas;			//Consultas a realizar
	var $consultasPreparadas;	//Consulta preparadas

	var $campos;			//Campos a consultar de la tabla

	public function __construct($conexion){
		//Inicializamos los atributos
		$this->conexion = $conexion;
		$this->consultas = array();
		$this->consultasPreparadas = array();
		$this->resultados = array();
		$this->campos = array();
	}
	
	//Realiza las consultas y guarda el resultado en $this->resultados
	public function consultarCampos() {
		$stmt = null;

		//Si se han preparado campos hacemos la consulta
		$campos = $this->camposToString();
		if(!empty($campos)){
			$query = "SELECT " . $campos . " FROM " . $this->nomTabla . " WHERE " . $this->pksToString();
			$stmt = $this->conexion->consultar($query);
		}

		//Borramos los campos seleccionados de las tablas
		$this->campos = array();

		//Devolvemos el array
		return $stmt->fetch();
	}

	//Guarda el campo a consular
	public function prepCampo($campo){
		$this->campos[] = $campo;
	}

	private function preparar($consulta){
		$this->consultasPreparadas[] = $this->conexion->prepare($consulta);
	}

	private function camposToString(){
		//Sacamos el primero
		reset($this->campos);
		$campos = current($this->campos);

		//Concatenamos el resto
		while($campo = next($this->campos))
			$campos = $campos . ', ' . $campo;

		return $campos;
	}

	private function pksToString(){
		//Sacamos el primer par $nombreCampo=>$valor
		reset($this->pks);
		$par = each($this->pks);
		$pks = $par['key'] . ' = ' . $par['value'];

		//Concatenamos el resto de campos
		while($par = each($this->pks))
			$pks = $pks . ' AND ' . $par['key'] . ' = ' . $par['value'];

		return $pks;
	}
}
?>