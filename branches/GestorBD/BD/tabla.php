<?php
include_once("conexion.php");

abstract class Tabla{
	var $conexion;

	var $nomTabla;			//Nombre de la tabla
	var $pks = array();		//Las claves primarias de la tabla ($nomCampo=>$valor)

	var $consultas;			//Consultas a realizar
	var $consultasPreparadas;	//Consulta preparadas
	var $resultados;		//Resultados de las consultas ($campo=>$valor)

	var $campos;			//Campos a consultar de la tabla
	var $stmtCampos;		//Statament de preparar la consulta de los campos

	public function __construct($conexion){
		//Inicializamos los atributos
		$this->conexion = $conexion;
		$this->consultas = array();
		$this->consultasPreparadas = array();
		$this->resultados = array();
		$this->campos = array();
		$this->stmtCampos = $this->conexion->prepare("SELECT :campos FROM " . $this->nomTabla . " WHERE " . $this->pksToString());
	}
	
	//Realiza las consultas y guarda el resultado en $this->resultados
	public function consultar() {
		//Ejecutamos la consulta de los campos
		$this->conexion->bindParam($this->stmtCampos, ':campos', $this->camposToString());
		$this->conexion->ejecutarPreparada($this->stmtCampos);
		foreach($this->stmtCampos as $row){
			foreach($this->campos as $campo)
				$this->resultados[$campo] = $row[$campo];
			var_dump($row);
		}

		/*
		foreach($this->consultas as $consulta){
			$resource = $bd -> consulta($consulta);
			while($fetch_array = mysql_fetch_assoc($resource))
				foreach($fetch_array as $campo => $valor)
					$this->resultados[$campo] = $valor;
		}
		 */

		//Borramos los campos seleccionados de las tablas
		$this->campos= array();
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
