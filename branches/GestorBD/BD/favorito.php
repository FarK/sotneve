<?php
include_once("tabla.php");

class Favorito extends Tabla{
	
	public function __construct(/*$conexion*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'favoritos';

		//Llamamos al constructor de tabla
		parent::__construct(func_get_arg(0));

		//Consultas preparadas
		$this->preparar('getFavoritos', "SELECT * FROM " . $this->nomTabla . " F, usuarios U WHERE F.idUsuario1 = :id AND F.idUsuario2 = U.idUsuario");
		$this->preparar('getSeguidores', "SELECT * FROM " . $this->nomTabla . " A, usuarios U WHERE F.idUsuario2 = :id AND F.idUsuario1 = U.idUsuario");
	}

	//Todos los favoritos de un usuario
	public function getFavoritos($idUsuario1){
		$parametros = array(':id'=>$idUsuario1);
		return $this->consultarPreparada('getFavoritos', $parametros);
	}

	//Todos los que tienen como favorio a un usuario
	public function getSeguidores($idUsuario2){
		$parametros = array(':id'=>$idUsuario2);
		return $this->consultarPreparada('getSeguidores', $parametros);
	}
}
?>
