<?php
include_once("tabla.php");

class Usuario extends Tabla{
	public function __construct(/*$conexion, $id*/){
		//Distinguimos entre el constructor con uno o dos parámetros
		$arg_list = func_get_args();
		if(func_num_args() == 1){
			//Inicializamos el nombre de la tabla
			$this->nomTabla = 'usuarios';

			//Llamamos al constructor de tabla
			parent::__construct($arg_list[0]);
		}
		else if (func_num_args() == 2){
			//Inicializamos el array de claves primarias y el nombre de la tabla
			$this->pks = array('idUsuario'=>$arg_list[1]);
			$this->nomTabla = 'usuarios';

			//Llamamos al constructor de tabla
			parent::__construct($arg_list[0]);
		}

		//Consultas preparadas
		$this->preparar('getUsuario', "SELECT * FROM " . $this->nomTabla . " WHERE idUsuario = :id");
	}

	public function getEventos(){
		return $this->consultar("SELECT * FROM eventos E, afiliaciones A WHERE " . $this->pksToString() . " AND A.idEvento = E.idEvento");
	}

	public function getUsuario($id){
		//Hacemos el bind a la consulta y la ejecutamos
		$parametros = array(':id'=>$id);
		return $this->consultarPreparada($this->consultasPreparadas['getUsuario'], $parametros);
	}
}
?>
