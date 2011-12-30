<?php
include_once("tabla.php");

class Usuario extends Tabla{
	public function __construct(/*$conexion, $id*/){
		$this->nomTabla = 'usuarios';

		//Distinguimos entre el constructor con uno o dos parámetros
		$arg_list = func_get_args();
		if(func_num_args() == 1){
			//Inicializamos el nombre de la tabla

			//Llamamos al constructor de tabla
			parent::__construct($arg_list[0]);
		}
		else if (func_num_args() == 2){
			//Inicializamos el array de claves primarias y el nombre de la tabla
			$this->pks = array('idUsuario'=>$arg_list[1]);

			//Llamamos al constructor de tabla
			parent::__construct($arg_list[0]);
		}

		//Consultas preparadas
		$this->preparar('getUsuario', "SELECT * FROM " . $this->nomTabla . " WHERE idUsuario = :id");
		$this->preparar('getFavoritos', "SELECT idUsuario1, idUsuario2, alias FROM favoritos F, usuarios U WHERE F.idUsuario1 = " . $this->pks['idUsuario'] ." AND U.idUsuario = F.idUsuario2");
	}

	public function getEventos(){
		return $this->consultar("SELECT * FROM eventos E, afiliaciones A WHERE " . $this->pksToString() . " AND A.idEvento = E.idEvento");
	}

	public function getUsuario($id){
		//Hacemos el bind a la consulta y la ejecutamos
		$parametros = array(':id'=>$id);
		return $this->consultarPreparada('getUsuario', $parametros);
	}
	
	public function getFavoritos(){
		return $this->consultarPreparada('getFavoritos', array());
	}
	public function passCorrecta($email, $pass) {
		$query = sprintf("SELECT idUsuario FROM usuarios WHERE email = '%s' AND pass = SHA2('%s', 256)", $email, $pass);
        $result = $this -> consultar($query);
        if (count($result) == 1 && count($result[0]) == 1) {
			return $result[0]['idUsuario'];
        } else {
			return false;
        }
	}
}
?>
