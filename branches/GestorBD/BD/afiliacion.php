<?php
include_once("tabla.php");

class Afiliacion extends Tabla{
	
	private $visibilidad = -1;
	
	public function __construct(/*$conexion, $idUsuario, $idEvento*/){
		$this->nomTabla = 'afiliaciones';

		//Distinguimos entre el constructor con uno o dos parámetros
		$arg_list = func_get_args();
		if(func_num_args() == 1){
			//Inicializamos el nombre de la tabla

			//Llamamos al constructor de tabla
			parent::__construct($arg_list[0]);
		}
		else if (func_num_args() == 3){
			//Inicializamos el array de claves primarias
			$this->pks = array('idUsuario'=>$arg_list[1], 'idEvento'=>$arg_list[2]);

			//Llamamos al constructor de tabla
			parent::__construct($arg_list[0]);
		}

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
