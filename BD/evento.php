<?php
include_once 'BD/GestorBD.php';

class Evento {

	private $idEvento = NULL;
	private $evento = NULL;

	private $error = 0;

	public function Evento($idEvento) {
		$this -> idEvento = $idEvento;
		$bd = new GestorBD();

		if ($bd -> conectar()) {//Pudo conectar
			//Consulta evento
			$query = sprintf("SELECT * FROM eventos WHERE idEvento = '%s'", $idEvento);
			$this -> evento = mysql_fetch_assoc($bd -> consulta($query));
			//Si no existe el usuario (o ha fallado la consulta)
			if (!$this -> usuario)
				$this -> error = -1;

			//Desconectar de la bd
			$bd -> desconectar();
		} else {
			//No puedo conectar
			$this -> error = -2;
		}

	}
	
	public function error(){
		return $this->error;
	}
	
	public function getCampo($campo){
		return $this->evento[$campo];
	}
	
	

}
?>