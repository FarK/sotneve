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

		//Seteamos la visibilidad
		$this->visibilidad = -1;

		//Llamamos al constructor de tabla
		parent::__construct($arg_list[0]);

		//Consultas preparadas
		$this->preparar('getUsuario', "SELECT * FROM " . $this->nomTabla . " WHERE idUsuario = :id");
		$this->preparar('getProvincia', "SELECT P.idProvincia, P.nombre FROM provincias P, " . $this->nomTabla . " U WHERE U.idUsuario = :id AND P.idProvincia = U.idProvincia");
		$this->preparar('existeEmail', "SELECT * FROM " . $this->nomTabla . " WHERE email = :id");
		$this->preparar('existeAlias', "SELECT * FROM " . $this->nomTabla . " WHERE alias = :id");
		$this->preparar('getEventos', "SELECT * FROM " . $this->nomTabla . " A, eventos E WHERE A.idUsuario = :id AND A.idEvento = E.idEvento");
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
			$this->prepCampo('visibilidad');
			$res = $this->consultarCampos();
			$this->visibilidad = $res['visibilidad'];
		}
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
	
	//Todos los eventos a los que está afiliado un usuario //TODO caducados o no?
	public function getEventos($idUsuario){
		$parametros = array(':id'=>$idUsuario);
		return $this->consultarPreparada('getEventos', $parametros);
	}
	
	public function insertarUsuario($fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia) {
		$query = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, nombre, apellidos, idProvincia, visibilidad) 
			VALUES ('%s', '%s', '%s', '%s', SHA2('%s',256), '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia, 0);
		return $this -> consultar($query);
	}
	//TODO posiblemente este metodo se pueda borrar porque no se usa
	public function usuariosCon($campo, $elemento) {
		$query = sprintf("SELECT * FROM usuarios WHERE '%s' = '%s'", $campo, $elemento);
		return $this -> consultar($query);
	}
	
	
}
?>
