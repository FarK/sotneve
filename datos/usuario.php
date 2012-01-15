<?php
include_once("tabla.php");

//Campos para la máscara de visibilidad
$PROVINCIA = 32;
$FECHA_NAC = 16;
$SEXO = 8;
$EMAIL = 4;
$NOMBRE = 2;
$APELLIDOS = 1;

class Usuario extends Tabla{
	public function __construct(/*$conexion, $id*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'usuarios';

		//Comprobamos si se han recibido las claves primarias
		$arg_list = func_get_args();
		if (func_num_args() == 2){
			//Inicializamos el array de claves primarias y el nombre de la tabla
			$this->pks = array('idUsuario'=>$arg_list[1]);
		}

		//Llamamos al constructor de tabla
		parent::__construct($arg_list[0]);

		//Comprobamos que el usuario existe
		if (func_num_args() == 2){
			if(!$this->existeUsuario()){
				$_SESSION['error'] = "userNotFound";
				$_SESSION['debug'] = "El usuario " . $arg_list[1] . " no existe.";
				header("Location:errores.php");
			}
		}

		//Consultas preparadas
		$this->preparar('getUsuario', "SELECT * FROM " . $this->nomTabla . " WHERE idUsuario = :id");
		$this->preparar('getProvincia', "SELECT P.idProvincia, P.nombre FROM provincias P, " . $this->nomTabla . " U WHERE U.idUsuario = :id AND P.idProvincia = U.idProvincia");
		$this->preparar('existeEmail', "SELECT * FROM " . $this->nomTabla . " WHERE email = :id");
		$this->preparar('existeAlias', "SELECT * FROM " . $this->nomTabla . " WHERE alias = :id");
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
     
	public function existeUsuario(){
		$resp = $this->consultar(sprintf("SELECT email FROM usuarios WHERE idUsuario = '%s'", $this->pks['idUsuario']));
		if(empty($resp)){
			return false;
		}else{
			return true;
		}
	}
	
	//Todos los eventos a los que está afiliado un usuario NO caducados
	public function getEventos(){
		return $this->consultar(sprintf('SELECT * FROM afiliaciones A, eventos E WHERE A.idUsuario = %s AND A.idEvento = E.idEvento AND fechaEvento >= NOW()', $this->pks['idUsuario']));
	}
	
	public function getEventosProvincia(){
		$query = sprintf("SELECT * FROM eventos E, usuarios U WHERE U.idUsuario = %s AND U.idProvincia = E.idProvincia AND fechaEvento >= NOW()", $this->pks['idUsuario']);
		return $this->consultar($query);
	}
	
	public function insertarUsuario($fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia) {
		$query = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, nombre, apellidos, idProvincia, visibilidad) 
			VALUES ('%s', '%s', '%s', '%s', SHA2('%s',256), '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia, 0);
		return $this -> consultar($query);
	}
	public function actualizarUsuarioConPass($fechanac, $sexo, $email, $contrasena, $nombre, $apellidos, $provincia, $visibilidad) {
			$query = sprintf("UPDATE usuarios SET fechaNac='%s', sexo='%s', email='%s', pass=SHA2('%s',256), nombre='%s', apellidos='%s', idProvincia='%s', visibilidad='%s' 
			WHERE idUsuario = " . $this->pks['idUsuario'], $fechanac, $sexo, $email, $contrasena, $nombre, 
			$apellidos, $provincia, $visibilidad);
			return $this -> consultar($query);
	}
	public function actualizarUsuarioSinPass($fechanac, $sexo, $email, $nombre, $apellidos, $provincia, $visibilidad) {
			$query = sprintf("UPDATE usuarios SET fechaNac='%s', sexo='%s', email='%s', 
			nombre='%s', apellidos='%s', idProvincia='%s', visibilidad='%s' 
			WHERE idUsuario = " . $this->pks['idUsuario'], $fechanac, $sexo, $email, $nombre, 
			$apellidos, $provincia, $visibilidad);
			return $this -> consultar($query);
	}
	
	public function getFavoritos(){
		return $this->consultar(sprintf('SELECT idUsuario1, idUsuario2, alias FROM favoritos F, %s U WHERE F.idUsuario1 = %s AND U.idUsuario = F.idUsuario2', $this->nomTabla, $this->pks['idUsuario']));
	}
	
	public function esFavorito($idFav){
		$res = $this->consultar(sprintf('SELECT * FROM favoritos WHERE idUsuario1 = %s AND idUsuario2 = %s', $this->pks['idUsuario'], $idFav));
		return empty($res)? false : true;
	}
	
	public function borraFavorito($idUsuario2) {
		$query = sprintf("DELETE FROM favoritos WHERE idUsuario1 = '%s' AND idUsuario2 = '%s'", $this->pks['idUsuario'], $idUsuario2);
		return $this -> consultar($query);
	}
	
	public function insertaFavorito($idFav){
		$query = sprintf("INSERT INTO favoritos (idUsuario1, idUsuario2) VALUES ('%s', '%s')", $this->pks['idUsuario'], $idFav);
		return $this -> consultar($query);
	}
	
	public function valoraUsuario($idUser2, $val){
		$query = sprintf("INSERT INTO valoraciones (idUsuario1, idUsuario2, valoracion) VALUES ('%s', '%s', '%s') ON DUPLICATE KEY UPDATE valoracion='%s'", $this->pks['idUsuario'], $idUser2, $val, $val);
		return $this->consultar($query);
	}
}
?>
