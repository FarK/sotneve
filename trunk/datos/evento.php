<?php
include_once("tabla.php");

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

		//Consultas preparadas
		$this->preparar('getUsuarios', "SELECT * FROM usuarios U, afiliaciones A WHERE A.idEvento = :id AND A.idUsuario = U.idUsuario");

	}
	
	public function insertarEvento($fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar){
		$query = sprintf("INSERT INTO eventos (idTipo, titulo, maxPersonas, fechaCreacion, descripcion, 
							fechaEvento, idProvincia, lugar, propietario) VALUES (%s, '%s', %s, NOW(), '%s', '%s', %s, '%s', %s)", 
							2/*TODO: subtipo*/, $titulo, $numpersonas, $descripcion, $fechaEvento, $provincia, $lugar, 
							$_SESSION['idUsuario']);
		return $this -> consultar($query);
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
		$max = $result[0]['maxPersonas'];
		if(count($result)>=$max)
			return true;
		else
			return false;
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
        $query = sprintf("SELECT * FROM eventos WHERE idProvincia='%s' AND idTipo='%s' AND fechaEvento>='%s'", $idProvincia,$idTipo, $actual);
		return $this->consultar($query);
	}
}
/**********************
 * ANTIGUAS CONSULTAS *
 **********************
 GET ASISTENTES
 $query = sprintf("SELECT alias,afiliaciones.idUsuario FROM usuarios, afiliaciones WHERE usuarios.idUsuario=afiliaciones.idUsuario AND afiliaciones.idEvento='%s'", $this -> idEvento);

GET NUM ASISTENTES
$query = sprintf("SELECT idUsuario FROM afiliaciones WHERE afiliaciones.idEvento = '%s'", $this -> idEvento);
 */
?>
