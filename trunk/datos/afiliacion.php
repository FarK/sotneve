<?php
include_once("tabla.php");

class Afiliacion extends Tabla{
	
	public function __construct(/*$conexion*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'afiliaciones';

		//Llamamos al constructor de tabla
		parent::__construct(func_get_arg(0));

		//Consultas preparadas
		
		}
	
}
?>
