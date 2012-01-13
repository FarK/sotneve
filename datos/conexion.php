<?php
class Conexion{
	private $PDO;
	private $DB_HOST;
	private $DB_USERNAME;
	private $DB_PASS;
	private $DB_NAME;

	public function __construct(){
		//Inicializamos los atributos
		$this->PDO = NULL;
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
			$_SESSION['error'] = "internalError";
			$_SESSION['debug'] = $exp->getMessage();
			header("Location: ../presentacion/errores.php");
		}
	}

	//TODO: Intentar hacer esto en el destructor
	public function desconectar(){
		$this->PDO = null;
	}

	public function consultar($consulta){
		try{
			$res = $this->PDO->query($consulta, PDO::FETCH_ASSOC);
		}
		catch(PDOException $exp){
			$_SESSION['error'] = "internalError";
			$_SESSION['debug'] = $exp->getMessage();
			header("Location: ../presentacion/errores.php");
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
		return $this->PDO->prepare($consulta, array(PDO::FETCH_ASSOC));
	}

	public function bindParam($stmt, $param, $value){
		if(!$stmt->bindParam($param, $value)){
			$_SESSION['error'] = "internalError";
			$_SESSION['debug'] = $exp->getMessage();
			header("Location: ../presentacion/errores.php");
		}

	}

	//Ejecuta todas las consultas preparadas
	public function ejecutarPreparada($consultaPreparada){
		try{
			$consultaPreparada->execute();
		}
		catch(PDOException $exp){
			$_SESSION['error'] = "internalError";
			$_SESSION['debug'] = $exp->getMessage();
			header("Location: ../presentacion/errores.php");
		}
	}
	
	public function getLastInsertId(){
		return $this->PDO->lastInsertId();
	}

}
?>
