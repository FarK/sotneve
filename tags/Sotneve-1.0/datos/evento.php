<?php
include_once("tabla.php");

//Para evitar warning con el timezone
date_default_timezone_set('Europe/Madrid');

class Evento extends Tabla{
	public function __construct(/*$conexion, $id*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'eventos';

		//Comprobamos si se han recibido las claves primarias
		$arg_list = func_get_args();
		if (func_num_args() == 2){
			//Inicializamos el array de claves primarias y el nombre de la tabla
			$this->pks = array('idEvento'=>$arg_list[1]);
		}

		//Llamamos al constructor de tabla
		parent::__construct($arg_list[0]);

		//Comprobamos que el evento existe
		if (func_num_args() == 2){
			if(!$this->existeEvento()){
				$_SESSION['error'] = 'eventNotFound';
				header("Location:errores.php");
				exit;
			}
		}

		//Consultas preparadas
		$this->preparar('getUsuarios', "SELECT * FROM usuarios U, afiliaciones A WHERE A.idEvento = :id AND A.idUsuario = U.idUsuario");

	}
	
	public function existeEvento(){
		$resp = $this->consultar(sprintf("SELECT * FROM eventos WHERE idEvento = '%s'", $this->pks['idEvento']));
		if(empty($resp)){
			return false;
		}else{
			return true;
		}
	}
	
	public function insertarEvento($idTipo, $fechaEvento, $titulo, $maxPersonas, $provincia, $descripcion, $lugar, $propietario){
		$query = sprintf("INSERT INTO eventos (idTipo, titulo, maxPersonas, fechaCreacion, descripcion, 
				fechaEvento, idProvincia, lugar, propietario) VALUES (%s, '%s', %s, NOW(), '%s', '%s', %s, '%s', %s)", 
				$idTipo, $titulo, $maxPersonas, $descripcion, $fechaEvento, $provincia, $lugar, $propietario);

		$this -> consultar($query);
	}

	public function actualizarEvento($idTipo, $fechaEvento, $titulo, $maxPersonas, $provincia, $descripcion, $lugar, $propietario, $idEvento){
		$query = sprintf('UPDATE eventos SET
			idTipo="%s", fechaEvento="%s", titulo="%s", maxPersonas="%s", idProvincia="%s", descripcion="%s", lugar="%s", propietario="%s"
			WHERE idEvento="%s"',
			$idTipo, $fechaEvento, $titulo, $maxPersonas, $provincia, $descripcion, $lugar, $propietario, $idEvento);

		$this -> consultar($query);
	}
	
	
		//Todos los usuarios que están afiliados a un evento
	public function getUsuarios(/*$idUsuario*/){
		if (func_num_args() == 1){
			$parametros = array(':id'=>func_get_arg(0));
		}else{
			$parametros = array(':id'=>$this->pks['idEvento']);
		}
		return $this->consultarPreparada('getUsuarios', $parametros);
	}
	
	public function getAliasPropietario($idPropietario){
		$query = sprintf("SELECT alias FROM usuarios WHERE idUsuario ='%s'", $idPropietario);
		$result = $this -> consultar($query);
		if(empty($result))
			return $result;
		else
			return $result[0]['alias'];
	}

	public function getProvincia(){
		$query = sprintf("SELECT P.nombre FROM provincias P, eventos E WHERE E.idEvento = %s AND E.idProvincia = P.idProvincia", $this->pks['idEvento']);
		$ret = $this->consultar($query);
		return $ret[0]['nombre'];
	}
	
	public function estaCompleto(){
		$query = sprintf("SELECT A.idUsuario, E.maxPersonas FROM eventos E, afiliaciones A WHERE 
						A.idEvento = E.idEvento AND	A.idEvento = %s", $this->pks['idEvento']);
		$result = $this->consultar($query);
		if(!empty($result))
			$max = $result[0]['maxPersonas'];
		else
			return false;
		if(count($result)>=$max)
			return true;
		else
			return false;
	}
	
	public function getEventosVigentes(){
		$fecha = time (); 
		$actual =  date ( "Y-m-d h:i:s" , $fecha );
		$query = sprintf("SELECT * FROM eventos WHERE fechaEvento>='%s'", $actual);
		return $this->consultar($query);
	}
	
	public function haTerminado(){
		$query = sprintf("SELECT * FROM eventos WHERE IdEvento = '%s' AND fechaEvento>=NOW()", $this->pks['idEvento']);
		$res = $this->consultar($query);
		if(empty($res)){
			return true;
		}else{
			return false;
		}
	}
	
	public function getEventosTipoVigentes($idTipo){
		$fecha = time (); 
		$actual =  date ( "Y-m-d h:i:s" , $fecha);
		$query = sprintf("SELECT * FROM eventos E, tipos T WHERE E.idTipo = T.idTipo AND (%s) AND fechaEvento>='%s'", $this->pksSubtipos($idTipo), $actual);
		return $this->consultar($query);
	}
	
	public function getEventosProvinciaVigentes($idProvincia){
		$fecha = time (); 
		$actual =  date ( "Y-m-d h:i:s" , $fecha );
		$query = sprintf("SELECT * FROM eventos WHERE idProvincia='%s' AND fechaEvento>='%s'", $idProvincia, $actual);
		return $this->consultar($query);
	}
	
	public function getEventosProvinciaTipoVigentes($idProvincia,$idTipo){
		$fecha = time (); 
		$actual =  date ( "Y-m-d h:i:s" , $fecha );
		$query = sprintf("SELECT * FROM eventos E, tipos T WHERE idProvincia='%s' AND (%s) AND E.idTipo = T.idTipo AND fechaEvento>='%s'", $idProvincia, $this->pksSubtipos($idTipo), $actual);
		return $this->consultar($query);
	}
	
	public function inscribeUsuario($idUser){
		$arg_list = func_get_args();
		if (func_num_args() == 2){
			//Inicializamos el array de claves primarias y el nombre de la tabla
			$this->pks = array('idEvento'=>$arg_list[1]);
		}
		 $query = sprintf("INSERT INTO afiliaciones (idUsuario, idEvento) VALUES ('%s', '%s')", $idUser, $this->pks['idEvento']);
		 return $this->consultar($query);
	}
	
	public function desinscribeUsuario($idUser){
		$query = sprintf("DELETE FROM afiliaciones WHERE idUsuario = '%s' AND idEvento = '%s'", $idUser, $this->pks['idEvento']);
		 return $this->consultar($query);
	}
	
	public function estaInscrito($idUser){
		$parametros = array(':id'=>$this->pks['idEvento']);
		$usuarios = $this->consultarPreparada('getUsuarios', $parametros);
		foreach($usuarios as $user){
			if($user['idUsuario'] == $idUser)
				return true;
		}
		return false;
	}

	public function esPropietario($idUsuario){
		
		$query = sprintf("SELECT propietario FROM eventos WHERE idEvento = '%s'", $this->pks['idEvento'] );
		$resultado = $this->consultar($query);
		if(!empty($resultado) && $idUsuario==$resultado[0]['propietario']){
			return true;
		} else{
			return false;
		}
			
		
	}

	//Devuelve un string para usar en una consulta: "T.idTipo = $idTipo OR T.idTipo = $idSubtipo1 OR ..."
	public function pksSubtipos($idTipo){
		$tipo = new Tipo($this->conexion);
		$subtipos = $tipo->getArbolTipos(array($tipo, 'getIdsSubtipos'), $idTipo);

		//Sacamos el primero
		$string = 'T.idTipo = ' . current($subtipos);
		//Concatenamos el resto
		while($idSubtipo= next($subtipos))
			$string = $string . ' OR T.idTipo = ' . $idSubtipo;

		return $string;
	}
}
?>
