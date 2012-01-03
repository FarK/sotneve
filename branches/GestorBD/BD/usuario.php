<?php
include_once("tabla.php");

$FECHA_NAC = 16;
$SEXO = 8;
$EMAIL = 4;
$NOMBRE = 2;
$APELLIDOS = 1;

class Usuario extends Tabla{

	var $visibilidad;

	public function __construct(/*$conexion, $id*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'usuarios';

		//Comprobamos si se han recibido las claves primarias
		$arg_list = func_get_args();
		if (func_num_args() == 2){
			//Inicializamos el array de claves primarias y el nombre de la tabla
			$this->pks = array('idUsuario'=>$arg_list[1]);

			//Llamamos al constructor de tabla
			parent::__construct($arg_list[0]);
		}

		//Inicializamos la visibilidad
		$this->visibilidad = -1;

		//Llamamos al constructor de tabla
		parent::__construct($arg_list[0]);

		//Consultas preparadas
		$this->preparar('getUsuario', "SELECT * FROM " . $this->nomTabla . " WHERE idUsuario = :id");
		$this->preparar('getProvincia', "SELECT P.idProvincia, P.nombre FROM provincias P, " . $this->nomTabla . " U WHERE U.idUsuario = :id AND P.idProvincia = U.idProvincia");
		$this->preparar('existeEmail', "SELECT * FROM " . $this->nomTabla . " WHERE email = :id");
		$this->preparar('existeAlias', "SELECT * FROM " . $this->nomTabla . " WHERE alias = :id");
		$this->preparar('getEventos', "SELECT * FROM afiliaciones A, eventos E WHERE A.idUsuario = " . $this->pks['idUsuario'] ." AND A.idEvento = E.idEvento AND fechaEvento >= NOW()");
		$this->preparar('getFavoritos', "SELECT idUsuario1, idUsuario2, alias FROM favoritos F, " . $this->nomTabla . " U WHERE F.idUsuario1 = " . $this->pks['idUsuario'] ." AND U.idUsuario = F.idUsuario2");
		$this->preparar('getEventosProvincia', "SELECT * FROM afiliaciones A, eventos E, usuarios U WHERE A.idUsuario = " . $this->pks['idUsuario'] ." AND A.idUsuario = U.idUsuario AND U.idProvincia = E.idProvincia AND A.idEvento = E.idEvento AND fechaEvento >= NOW()");
	}

	public function getUsuario($id){
		//Hacemos el bind a la consulta y la ejecutamos
		$parametros = array(':id'=>$id);
		return $this->consultarPreparada('getUsuario', $parametros);
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

	public function esVisible($campo) {
		if($this->visibilidad == -1){
			echo "asd".$this->visibilidad;
			$this->prepCampo('visibilidad');
			$res = $this->consultarCampos();
			$this->visibilidad = $res['visibilidad'];
		}
		echo "asd222".$this->visibilidad;
		return ($this -> visibilidad & $campo);
	}

	public function getProvincia(){
		//Hacemos el bind a la consulta
		$parametros = array(':id'=>$this->pks['idUsuario']);
		$res = $this->consultarPreparada('getProvincia', $parametros);

		//Devolvemos la provincia en un array ('idProvincia'=>$idProvincia, 'nombre' => $nombre)
		$ret = array();
		if(!empty($res))
			$ret = $res[0];
		return $ret;
	}
	
	public function existeEmail($email){
               //preparamos los parametros
               $parametros = array(':id'=>$email);
               $resp = $this->consultarPreparada('existeEmail', $parametros);
               
               if(empty($resp)){
                   return false;
               }else{
                   return true;
			   }
     }
		 
	 public function existeAlias($alias){
               //preparamos los parametros
               $parametros = array(':id'=>$alias);
               $resp = $this->consultarPreparada('existeAlias', $parametros);
               
               if(empty($resp)){
                   return false;
               }else{
                   return true;
			   }
     }
	
	//Todos los eventos a los que está afiliado un usuario NO caducados
	public function getEventos(){
		return $this->consultarPreparada('getEventos', array());
	}
	
	public function getEventosProvincia(){
		return $this->consultarPreparada('getEventosProvincia', array());
	}
	
	public function insertarUsuario($fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia) {
		$query = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, nombre, apellidos, idProvincia, visibilidad) 
			VALUES ('%s', '%s', '%s', '%s', SHA2('%s',256), '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia, 0);
		return $this -> consultar($query);
	}
	
	public function getFavoritos(){
		return $this->consultarPreparada('getFavoritos', array());
	}
	
	public function consultarTodosLosCampos(){
		$res = parent::consultarTodosLosCampos();
		$this->visibilidad = $res['visibilidad'];
		echo $this->visibilidad;
		return $res;
	}
	
	
}
?>
