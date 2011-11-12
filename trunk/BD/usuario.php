<?php
include_once('BD/GestorBD.php');

$FECHA_NAC = 16;
$SEXO = 8;
$EMAIL = 4;
$NOMBRE = 2;
$APELLIDOS = 1;

class Usuario{
	private $usuario = NULL;

	private $usuarionNoEncontrado = FALSE;
	private $falloDeConexion = FALSE;

	public function Usuario($idUsuario){
		//Crear objeto gestor bd
		$bd = new GestorBD();	
		//Conectar a la bd
		if($bd->conectar()){ //Pudo conectar
			//Consulta usuario
			$query = sprintf("SELECT * FROM usuarios WHERE idUsuario = '%s'", $idUsuario);
			$this->usuario = mysql_fetch_assoc($bd->consulta($query));

			//Si no existe el usuario (o ha fallado la consulta)
			if(!$this->usuario)
				$this->usuarionNoEncontrado = TRUE;

			//Desconectar de la bd
			$bd->desconectar();
		}else{
			//No puedo conectar
			$this->falloDeConexion = TRUE;
		}
	}

	public function error(){
		if($this->usuarionNoEncontrado)
			return -1;
		else if($this->falloDeConexion)
			return -2;
		else
			return 0;
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
}
?>
