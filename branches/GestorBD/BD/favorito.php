<?php
include_once("tabla.php");

class Favorito extends Tabla{
	
	public function __construct(/*$conexion, $idUsuario1, $idUsuario2*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'favoritos';

		//Comprobamos si se han recibido las claves primarias
		$arg_list = func_get_args();
		if (func_num_args() == 3){
			//Inicializamos el array de claves primarias
			$this->pks = array('idUsuario1'=>$arg_list[1], 'idUsuario2'=>$arg_list[2]);
		}

		//Llamamos al constructor de tabla
		parent::__construct($arg_list[0]);

		//Consultas preparadas
		$this->preparar('getFavoritos', "SELECT * FROM " . $this->nomTabla . " F, usuarios U WHERE F.idUsuario1 = :id AND F.idUsuario2 = U.idUsuario");
		$this->preparar('getSeguidores', "SELECT * FROM " . $this->nomTabla . " A, usuarios U WHERE F.idUsuario2 = :id AND F.idUsuario1 = U.idUsuario");
	}

	//Todos los favoritos de un usuario
	public function getEventos($idUsuario1){
		$parametros = array(':id'=>$idUsuario1);
		return $this->consultarPreparada('getFavoritos', $parametros);
	}

	//Todos los que tienen como favorio a un usuario
	public function getUsuarios($idUsuario2){
		$parametros = array(':id'=>$idUsuario2);
		return $this->consultarPreparada('getSeguidores', $parametros);
	}
}
?>
