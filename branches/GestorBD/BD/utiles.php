<?php
include_once("tabla.php");
class Utiles extends Tabla{
	public function __construct(/*$conexion, $id*/){
		$arg_list = func_get_args();
		if(func_num_args() == 1){
			//Llamamos al constructor de tabla
			parent::__construct($arg_list[0]);
		}
	}

	//Devuelve el nombre de todas las provincias en un array de arrays
	//array(52) { [0]=> array(1) { ["nombre"]=> string(5) "Alava" } [1]=> array(1) { ["nombre"]=> string(8) "Albacete" } ...
	public function getProvincias() {
		$query = sprintf("SELECT nombre FROM provincias");
        $result = $this -> consultar($query);
		return $result;
	}
}
?>