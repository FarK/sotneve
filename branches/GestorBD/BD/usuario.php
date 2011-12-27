<?php
include_once("tabla.php");

class Usuario extends Tabla{
	public function __construct($conexion, $id){
		//Inicializamos el array de claves primarias y el nombre de la tabla
		$this->pks = array('idUsuario'=>$id);
		$this->nomTabla = 'usuarios';

		//Llamamos al constructor de tabla
		parent::__construct($conexion);
	}
}
?>
