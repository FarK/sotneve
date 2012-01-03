<?php
include_once 'BD/GestorBD.php';

class Evento {

	private $idEvento = NULL;
	private $evento = NULL;
	private $asistentes = NULL;

	private $error = 0;

	public function Evento($idEvento) {
		$this -> idEvento = $idEvento;
		$bd = new GestorBD();

		if ($bd -> conectar()) {//Pudo conectar
			//Consulta evento
			$query = sprintf("SELECT * FROM eventos WHERE idEvento = '%s'", $idEvento);
			$this -> evento = mysql_fetch_assoc($bd -> consulta($query));
			//Si no existe el usuario (o ha fallado la consulta)
			if (!$this -> evento)
				$this -> error = -1;

			//Desconectar de la bd
			$bd -> desconectar();
		} else {
			//No puedo conectar
			$this -> error = -2;
		}

	}

	public function error() {
		return $this -> error;
	}

	public function getCampo($campo) {
		return $this -> evento[$campo];
	}

	public function getAsistentes() {
		if (is_null($this -> asistentes)) {
			$this -> asistentes = array();
			$bd = new GestorBD();
			if ($bd -> conectar()) {
				$query = sprintf("SELECT alias,afiliaciones.idUsuario FROM usuarios, afiliaciones 
				WHERE usuarios.idUsuario=afiliaciones.idUsuario AND afiliaciones.idEvento='%s'", $this -> idEvento);

				$tuplas = $bd -> consulta($query);

				if (!$tuplas) {
					$this -> error = -1;
				} else {
					while ($fila = mysql_fetch_assoc($tuplas)) {
						//Obtenemos los idUsuario y sus alias
						$idUsuario = $fila['idUsuario'];
						$aliasAns = $fila['alias'];
						$this -> asistentes[] = array('idUsuario' => $idUsuario, 'alias' => $aliasAns);
					}

				}
			} else//Conexión fallida
				$this -> error = -2;

		}
		return $this -> asistentes;
	}

	public function getNumAsistentes() {
		$bd = new GestorBD();
		if ($bd -> conectar()) {
			$query = sprintf("SELECT idUsuario FROM afiliaciones WHERE afiliaciones.idEvento = '%s'", $this -> idEvento);
			$tupla = $bd -> consulta($query);
			$numAsistentes = mysql_num_rows($tupla);
		} else//Conexión fallida
			$this -> error = -2;
		return $numAsistentes;

	}

}
?>