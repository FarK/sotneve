<?php
include_once("tabla.php");

class Provincia extends Tabla{
	
	public function __construct(/*$conexion, $idProvincia*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'provincias';

		//Comprobamos si se han recibido las claves primarias
		$arg_list = func_get_args();
		if (func_num_args() == 2){
			//Inicializamos el array de claves primarias
			$this->pks = array('idProvincia'=>$arg_list[1]);
		}

		//Llamamos al constructor de tabla
		parent::__construct($arg_list[0]);

		//Consultas preparadas
	}

	//Todas las provincias en un array simple
	public function getProvincias(){
		$ret = array();

		$res = $this->consultar("SELECT nombre FROM provincias ORDER BY nombre");
		foreach($res as $row)
			foreach($row as $prov)
				$ret[] = $prov;

		return $ret;
	}
}
?>
