<?php
include_once('BD/GestorBD.php');

$FECHA_NAC = 16;
$SEXO = 8;
$EMAIL = 4;
$NOMBRE = 2;
$APELLIDOS = 1;

class Usuario{
	private $idUsuario = NULL;
	private $usuario = NULL;
	private $favoritos = NULL;
	private $eventosafiliados=NULL;

	private $error = 0;

	public function Usuario($idUsuario){
		$this->idUsuario = $idUsuario;
		//Crear objeto gestor bd
		$bd = new GestorBD();	
		//Conectar a la bd
		if($bd->conectar()){ //Pudo conectar
			//Consulta usuario
			$query = sprintf("SELECT * FROM usuarios WHERE idUsuario = '%s'", $idUsuario);
			$this->usuario = mysql_fetch_assoc($bd->consulta($query));

			//Si no existe el usuario (o ha fallado la consulta)
			if(!$this->usuario)
				$this->error = -1;

			//Desconectar de la bd
			$bd->desconectar();
		}else{
			//No puedo conectar
			$this->error = -2;
		}
	}

	public function error(){
		return $this->error;
	}


	public function getCampo($campo){
		return $this->usuario[$campo];
	}

	/* TODO
	public function setCampo($nuevoValor, $campo){
	}
	 */

	public function esVisible($campo){
		return ($this->usuario["visibilidad"] & $campo);
	}
	//Devuelve un array de arrays del tipo "idEvento => idEvento, titulo=> titulo"
		public function getEventos(){
			$fecha = time (); 
			$actual =  date ( "Y-m-d h:i:s" , $fecha );
			
		//Si no ha sido inicializado antes hacemos la consulta
		if(is_null($this->eventosafiliados)){
			//Crear objeto gestor bd
			$bd = new GestorBD();	
			//inicializamos el array
			$this->eventosafiliados = array();

			if ($bd->conectar()){	//Se ha podido conectar
				$query = sprintf("SELECT idEvento FROM afiliaciones WHERE idUsuario= '%s'", $this->idUsuario);
				$tuplas = $bd->consulta($query);
				//Si no existe el usuario (o ha fallado la consulta)
				if(!$tuplas)
					$this->error = -1;

				while ($fila = mysql_fetch_assoc($tuplas)) {
					//Obtenemos el idEvento y el titulo del evento
					$idEvento2 = $fila['idEvento'];
					$query = sprintf("SELECT titulo FROM eventos WHERE idEvento= '%s' AND fechaEvento>='%s'", $idEvento2, $actual);
					//Si no existe el usuario (o ha fallado la consulta)
					if(!$query)
						$this->error = -1;
					$aliasRes = $bd->consulta($query);
					$titulo2 = mysql_fetch_assoc($aliasRes);

					$this->eventosafiliados[] = array('idEvento' => $idEvento2 , 'titulo' => $titulo2['titulo']);
				}
			}
			else	//Conexión fallida
				$this->error = -2;

		}
		return $this->eventosafiliados;
	}

	//Devuelve un array de arrays del tipo "idUsuario => idUsuario, alias => alias"
	public function getFavoritos(){
		//Si no ha sido inicializado antes hacemos la consulta
		if(is_null($this->favoritos)){
			//Crear objeto gestor bd
			$bd = new GestorBD();	
			//inicializamos el array
			$this->favoritos = array();

			if ($bd->conectar()){	//Se ha podido conectar
				$query = sprintf("SELECT idUsuario2 FROM favoritos WHERE idUsuario1= '%s'", $this->idUsuario);
				$tuplas = $bd->consulta($query);
				//Si no existe el usuario (o ha fallado la consulta)
				if(!$tuplas)
					$this->error = -1;

				while ($fila = mysql_fetch_assoc($tuplas)) {
					//Obtenemos el idUsuario y el alias del favorito
					$idUsuario2 = $fila['idUsuario2'];
					$query = sprintf("SELECT alias FROM usuarios WHERE idUsuario= '%s'", $idUsuario2);
					//Si no existe el usuario (o ha fallado la consulta)
					if(!$query)
						$this->error = -1;
					$aliasRes = $bd->consulta($query);
					$alias2 = mysql_fetch_assoc($aliasRes);

					$this->favoritos[] = array('idUsuario' => $idUsuario2 , 'alias' => $alias2['alias']);
				}
			}
			else	//Conexión fallida
				$this->error = -2;

		}
		return $this->favoritos;
	}
}
?>
