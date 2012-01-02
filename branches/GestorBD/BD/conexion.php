<?php
class Conexion{
	private $PDO;
	private $consultas;		//Array con consultas preparadas
	private $DB_HOST;
	private $DB_USERNAME;
	private $DB_PASS;
	private $DB_NAME;

	public function __construct(){
		//Inicializamos los atributos
		$this->PDO = NULL;
		$this->consultas = array();
		$this->DB_HOST = 'localhost';
		$this->DB_USERNAME = 'root';
		$this->DB_PASS = '';
		$this->DB_NAME = 'sotneve';

		try{
			$this->PDO = new PDO("mysql:host=$this->DB_HOST;dbname=$this->DB_NAME",
				$this->DB_USERNAME, $this->DB_PASS);
			$this->PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $exp){
			//TODO: Redirigir a página de error
			echo "ERROR AL CONECTARSE CON LA BD </br>";
			echo $exp;
		}
	}

	//TODO: Intentar hacer esto en el destructor
	public function desconectar(){
		$this->PDO = null;
	}

	public function consultar($consulta){
		try{
			$res = $this->PDO->query($consulta);
		}
		catch(PDOException $exp){
			//TODO: Redirigir a página de error
			echo "ERROR AL HACER LA CONSULTA</br>";
			echo $exp;
		}

		//Si el statement está vacío, ya sea porque el select no ha
		//devuelto resultados o porque se trata de un insert, devolvemos un
		//array vacío
		if($res->columnCount() == 0)
			return array();
		else
			return $res;
	}

	public function prepare($consulta){
		return $this->PDO->prepare($consulta);
	}

	public function bindParam($stmt, $param, $value){
		if(!$stmt->bindParam($param, $value)){
			//TODO: Redirigir a página de error
			echo "ERROR AL HACER BIND</br>";
		}

	}

	//Ejecuta todas las consultas preparadas
	public function ejecutarPreparada($consultaPreparada){
		try{
			$consultaPreparada->execute();
		}
		catch(PDOException $exp){
			//TODO: Redirigir a página de error
			echo "ERROR AL HACER LA CONSULTA PREPARADA</br>";
			echo $exp;
		}
	}

	/**************************************************************************************************************************************************************************************/
	/* TODO: Mover estas consultas a sus clases correspondientes                                                                                                                          */
	/**************************************************************************************************************************************************************************************/
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

	// public function insertarUsuario($fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia) {
		// $query = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, nombre, apellidos, provincia,visibilidad) 
			// VALUES ('%s', '%s', '%s', '%s', SHA2('%s',256), '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $provincia, 0);
		// $res = $this -> consulta($query);
		// var_dump($query);
// 
	// }


	public function insertarEvento($fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar) {
		$query = sprintf("INSERT INTO eventos (fechaEvento, titulo, numpersonas, provincia, descripcion,lugar) 
			VALUES ('%s', '%s', '%s', '%s', '%s', '%s' )", $fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar);
		$res = $this -> consulta($query);
		var_dump($query);
	}

	// public function usuariosCon($campo, $elemento) {
		// $query = sprintf("SELECT * FROM usuarios WHERE '%s' = '%s'", $campo, $elemento);
		// return $this -> consulta($query);
	// }

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
