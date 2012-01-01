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

	public function getTiposPadre(){
		return $this -> consultar("SELECT idTipo, nombre FROM tipos WHERE idPadre is NULL");
	}
	
	public function getSubtipos(){
		return $this -> consultar("SELECT idTipo, nombre FROM tipos WHERE idPadre is not NULL");
	}
	
	//TODO no se si va aqui este tipo de consulta
	

	public function insertarUsuario($fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia) {
		$query = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, nombre, apellidos, provincia,visibilidad) 
			VALUES ('%s', '%s', '%s', '%s', SHA2('%s',256), '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia, 0);
		return $this -> consultar($query);
	}
	
	public function usuariosCon($campo, $elemento) {
		$query = sprintf("SELECT * FROM usuarios WHERE '%s' = '%s'", $campo, $elemento);
		return $this -> consultar($query);
	}
	
	public function existeProvincia($provincia) {
		
		$query=sprintf("SELECT idProvincia FROM provincias WHERE idProvincia=%s",$provincia);
		return $this -> consultar($query);
	}
	
	
}
?>
