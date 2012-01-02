<?php
include_once("tabla.php");

class Evento extends Tabla{
	public function __construct(/*$conexion, $id*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'eventos';

		//Comprobamos si se han recibido las claves primarias
		$arg_list = func_get_args();
		if (func_num_args() == 2){
			//Inicializamos el array de claves primarias y el nombre de la tabla
			$this->pks = array('idEvento'=>$arg_list[1]);
		}

		//Llamamos al constructor de tabla
		parent::__construct($arg_list[0]);

		//Consultas preparadas
	}
}

/**********************
 * ANTIGUAS CONSULTAS *
 **********************
 GET ASISTENTES
 $query = sprintf("SELECT alias,afiliaciones.idUsuario FROM usuarios, afiliaciones WHERE usuarios.idUsuario=afiliaciones.idUsuario AND afiliaciones.idEvento='%s'", $this -> idEvento);

GET NUM ASISTENTES
$query = sprintf("SELECT idUsuario FROM afiliaciones WHERE afiliaciones.idEvento = '%s'", $this -> idEvento);
 */
?>
