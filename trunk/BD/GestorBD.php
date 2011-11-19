<?php
class GestorBD {
	private $conn;

	//public GestorBD(){}

	public function conectar() {
		$this -> conn = mysql_connect('localhost', 'root', '');
		if (!$this -> conn) {
			//die('No se pudo conectar: ' . mysql_error());
			return false;
		} else {
			mysql_select_db("sotneve", $this -> conn);
			return true;
		}
	}

	public function desconectar() {
		mysql_close($this -> conn);

	}

	public function escapeString($str) {
		return mysql_real_escape_string($str, $this -> conn);
	}

	public function consulta($query)//CUIDAOOOOOOOOO! SQL Injection !!
	{
		return mysql_query($query, $this -> conn);
	}

	public function passCorrecta($email, $pass) {
		$query = sprintf("SELECT * FROM usuarios WHERE email = '%s' AND pass = SHA2('%s', 256)", $email, $pass);
		$result = $this -> consulta($query);
		if (mysql_num_rows($result) == 1) {
			$row = mysql_fetch_assoc($result);
			return $row;
		} else {
			return false;
		}
	}

	public function insertarUsuario($fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia) {
		$query = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, nombre, apellidos, provincia,visibilidad) 
			VALUES ('%s', '%s', '%s', '%s', SHA2('%s',256), '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia, 0);
		$res = $this -> consulta($query);
		var_dump($query);

	}
	
	
	public function insertarEvento($fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar) {
		$query = sprintf("INSERT INTO eventos (fechaEvento, titulo, numpersonas, provincia, descripcion,lugar) 
			VALUES ('%s', '%s', '%s', '%s', '%s', '%s' )", $fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar);
		$res = $this -> consulta($query);
		var_dump($query);
	}

	public function usuariosCon($campo, $elemento) {
		$query = sprintf("SELECT * FROM usuarios WHERE '%s' = '%s'", $campo, $elemento);
		return $this -> consulta($query);
	}

	public function getNombreElementoCon($tabla,$elemento,$id) {
		$aux = sprintf("SELECT nombre FROM %s WHERE %s=%s", $tabla,$elemento, $id);
		$provinciaAux = $this -> consulta($aux);
		while ($fila = mysql_fetch_assoc($provinciaAux)) {
			return $provinciaString = $fila['nombre'];
		}
	}
	
	public  function getEventosConProvinciaYSubtipoNoCaducados($provincia,$subtipo){
			$fecha = time (); 
			$actual =  date ( "Y-m-d h:i:s" , $fecha );
			$query = sprintf("SELECT * FROM eventos WHERE idProvincia='%s' AND idSubTipo='%s' AND fechaEvento>='%s'", $provincia, $subtipo, $actual);
			$tuplas = $this -> consulta($query);
		return $tuplas;
	}
		public  function getTodosEventosConProvinciaNoCaducados($provincia,$subtipo){
			$fecha = time (); 
			$actual =  date ( "Y-m-d h:i:s" , $fecha );
			$query = sprintf("SELECT * FROM eventos WHERE idProvincia='%s' AND fechaEvento>='%s'", $provincia, $actual);
			$tuplas = $this -> consulta($query);
		return $tuplas;
	}
		


}
?>
