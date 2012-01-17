<?php
include_once("conexion.php");

abstract class Tabla{
	var $conexion;

	var $nomTabla;			//Nombre de la tabla
	var $pks = array();		//Las claves primarias de la tabla ($nomCampo=>$valor)

	var $consultasPreparada;	//Consultas preparadas a realizar
	var $campos;			//Campos a consultar de la tabla

	public function __construct($conexion){
		//Inicializamos los atributos
		$this->conexion = $conexion;
		$this->consultasPreparadas = array();
		$this->resultados = array();
		$this->campos = array();

		//Preparamos la consulta de todos los campos
		$this->preparar('consultarTodosLosCampos', "SELECT * FROM " . $this->nomTabla . " WHERE " . $this->pksToStringPreparada());
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

	public function consultarTodosLosCampos() {
		//Hacemos bind a las claves primarias
		$parametros = array();
		$i = 0;
		foreach($this->pks as $pk){
			$parametros[':id' . $i] = $pk;
			++$i;
		}

		//Devolvemos un array con todos los campos
		$ret = $this->consultarPreparada('consultarTodosLosCampos', $parametros);
		if(!empty($ret))
			return $ret[0];
		else
			return $ret;
	}

	//Guarda el campo a consular
	public function prepCampo($campo){
		$this->campos[] = $campo;
	}

	protected function preparar($nombre, $consulta){
		$this->consultasPreparadas[$nombre] = $this->conexion->prepare($consulta);
	}

	protected function consultarPreparada($NomPreparada, $parametros){
		$preparada = $this->consultasPreparadas[$NomPreparada];
		//Hacemos bind a todos los parámetros
		foreach($parametros as $key=>&$value){
			$this->conexion->bindParam($preparada, $key, $value);
		}

		//Ejecutamos las consultas
		$this->conexion->ejecutarPreparada($preparada);

		//Pasamos todas las columnas a un array
		$ret = array();
		foreach($preparada as $row){
			$r = array();
			foreach($row as $id=>$campo)
				$r[$id] = htmlentities($campo);
			$ret[] = $r;
		}

		return $ret;
	}

	protected function consultar($query){
		//Hacemos la consulta
		$stmt = $this->conexion->consultar($query);

		//Comprobamos si ha devuelto algo (SELECT) o no (SELECT vacío o INSERT)
		if(!empty($stmt)){
			//Pasamos todas las columnas a un array
			$ret = array();
			foreach($stmt as $row){
				$r = array();
				foreach($row as $id=>$campo)
					$r[$id] = htmlentities($campo);
				$ret[] = $r;
			}

			return $ret;
		}
		else
			return $stmt;
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

	protected function pksToString(){
		//Sacamos el primer par $nombreCampo=>$valor
		reset($this->pks);
		$par = each($this->pks);
		$pks = $par['key'] . ' = ' . $par['value'];

		//Concatenamos el resto de campos
		while($par = each($this->pks))
			$pks = $pks . ' AND ' . $par['key'] . ' = ' . $par['value'];

		return $pks;
	}

	protected function pksToStringPreparada(){
		//Sacamos el primer par $nombreCampo=>$valor
		reset($this->pks);
		$i = 0;
		$par = each($this->pks);
		$pks = $par['key'] . ' = :id' . $i;

		//Concatenamos el resto de campos
		while($par = each($this->pks)){
			++$i;
			$pks = $pks . ' AND ' . $par['key'] . ' = :id' . $i;
		}

		return $pks;
	}
}
?>
