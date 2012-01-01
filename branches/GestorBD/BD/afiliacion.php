<?php
include_once("tabla.php");

class Afiliacion extends Tabla{
	
	public function __construct(/*$conexion*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'afiliaciones';

		//Llamamos al constructor de tabla
		parent::__construct(func_get_arg(0));

		//Consultas preparadas
		$this->preparar('getEventos', "SELECT * FROM " . $this->nomTabla . " A, eventos E WHERE A.idUsuario = :id AND A.idEvento = E.idEvento");
		$this->preparar('getUsuarios', "SELECT * FROM " . $this->nomTabla . " A, usuarios U WHERE A.idEvento = :id AND A.idUsuario = U.idUsuario");
	}

	//Todos los eventos a los que está afiliado un usuario
	public function getEventos($idUsuario){
		$parametros = array(':id'=>$idUsuario);
		return $this->consultarPreparada('getEventos', $parametros);
	}

	//Todos los usuarios que están afiliados a un evento
	public function getUsuarios($idEvento){
		$parametros = array(':id'=>$idEvento);
		return $this->consultarPreparada('getUsuario', $parametros);
	}
}
?>
