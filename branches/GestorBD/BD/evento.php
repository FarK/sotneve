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
		$this->preparar('getUsuarios', "SELECT * FROM " . $this->nomTabla . " A, usuarios U WHERE A.idEvento = :id AND A.idUsuario = U.idUsuario");
		
	}
	
	public function insertarEvento($fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar){
		$query = sprintf("INSERT INTO eventos (idSubtipo, titulo, maxPersonas, fechaCreacion, descripcion, 
							fechaEvento, idProvincia, lugar, propietario) VALUES (%s, '%s', %s, NOW(), '%s', '%s', %s, '%s', %s)", 
							2/*TODO: subtipo*/, $titulo, $numpersonas, $descripcion, $fechaEvento, $provincia, $lugar, 
							$_SESSION['idUsuario']);
		return $this -> consultar($query);
	}
	
	
		//Todos los usuarios que están afiliados a un evento
	public function getUsuarios($idEvento){
		$parametros = array(':id'=>$idEvento);
		return $this->consultarPreparada('getUsuario', $parametros);
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
