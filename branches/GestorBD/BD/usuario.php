<?php
include_once ('BD/GestorBD.php');

$FECHA_NAC = 16;
$SEXO = 8;
$EMAIL = 4;
$NOMBRE = 2;
$APELLIDOS = 1;

class Usuario {
	private $idUsuario;
	private $consultas;	//Consultas a realizar
	private $resultados;	//Resultados de las consultas ($campo=>$valor)
	//$campos tiene en la primera posición un array de campos con las claves primarias de la tabla
	private $campos;	//Campos a consultar de cada tabla ($tabla=>$campos)

	//Usuario() o Usuario($idUsuario)
	public function Usuario(){
		$this->consultas = array();
		$this->resultados = array();
		$this->campos = array();
		//Inicializamos los nombres de los campos que forman la clave primaria de cada tabla
		$this->campos = array('usuarios' => array(array('idUsuario')));

		if($args = func_get_args()){
			$this->idUsuario = $args[0];
		}
	}

	public function consultar() {
		$this->getCampos();

		//Crear objeto gestor bd
		$bd = new GestorBD();

		//Conectar a la bd
		$bd -> conectar();
			foreach($this->consultas as $consulta){
				$resource = $bd -> consulta($consulta);
				while($fetch_array = mysql_fetch_assoc($resource))
					foreach($fetch_array as $campo => $valor)
						$this->resultados[$campo] = $valor;
			}

		//Desconectar de la bd
		$bd -> desconectar();

		//Borramos los campos seleccionados de las tablas
		$this->campos= array();

		return $this->resultados;
	}

	private function getCampos(){
		foreach($this->campos as $tabla=>$campos){
			//Unimos todos los campos de la clave primaria en un string
			if($ids= func_get_args()){	//Si se han pasado ids
				$arrayPrim = current($campos);
				$camposPrim = current($arrayPrim) . " = " . current($ids);
				while(($campo = next($arrayPrim)) || ($id = next($ids)))
					$camposPrim = $camposPrim . " AND " . $campo . " = " . $id;
			}
			else
				$camposPrim = $this->campos[$tabla][0][0] . " = " . $this->idUsuario;
			
			//Unimos todos los campos de la consulta en un string
			$camposStr = next($campos);
			while($campo = next($campos))
				$camposStr = $camposStr . ", " . $campo;

			//Añadimos la consulta
			$this->consultas[] = sprintf("SELECT %s FROM %s WHERE %s", $camposStr, $tabla, $camposPrim);
		}
	}

	public function getCampo($campo){
		$this->campos['usuarios'][] = $campo;
	}

	public function esVisible($campo) {
		return ($this -> usuario["visibilidad"] & $campo);
	}

	//Devuelve un array de arrays del tipo "idEvento => idEvento, titulo=> titulo"
	public function getEventos() {
		$fecha = time();
		$actual = date("Y-m-d h:i:s", $fecha);

		//Si no ha sido inicializado antes hacemos la consulta
		if (is_null($this -> eventosafiliados)) {
			//Crear objeto gestor bd
			$bd = new GestorBD();
			//inicializamos el array
			$this -> eventosafiliados = array();

			if ($bd -> conectar()) {//Se ha podido conectar
				$query = sprintf("SELECT idEvento FROM afiliaciones WHERE idUsuario= '%s'", $this -> idUsuario);
				$tuplas = $bd -> consulta($query);
				//Si no existe el usuario (o ha fallado la consulta)
				if (!$tuplas)
					$this -> error = -1;

				while ($fila = mysql_fetch_assoc($tuplas)) {
					//Obtenemos el idEvento y el titulo del evento
					$idEvento2 = $fila['idEvento'];






					$query = sprintf("SELECT titulo FROM eventos WHERE idEvento= '%s' AND fechaEvento>='%s'", $idEvento2, $actual);
					//Si no existe el usuario (o ha fallado la consulta)
					if (!$query)
						$this -> error = -1;
					$aliasRes = $bd -> consulta($query);
					$titulo2 = mysql_fetch_assoc($aliasRes);

					$this -> eventosafiliados[] = array('idEvento' => $idEvento2, 'titulo' => $titulo2['titulo']);
				}
			} else//Conexión fallida
				$this -> error = -2;

		}
		return $this -> eventosafiliados;
	}

	//Devuelve un array de arrays del tipo "idUsuario => idUsuario, alias => alias"
	public function getFavoritos() {
		//Si no ha sido inicializado antes hacemos la consulta
		if (is_null($this -> favoritos)) {
			//Crear objeto gestor bd
			$bd = new GestorBD();
			//inicializamos el array
			$this -> favoritos = array();

			if ($bd -> conectar()) {//Se ha podido conectar
				$query = sprintf("SELECT idUsuario2 FROM favoritos WHERE idUsuario1= '%s'", $this -> idUsuario);
				$tuplas = $bd -> consulta($query);
				//Si no existe el usuario (o ha fallado la consulta)
				if (!$tuplas)
					$this -> error = -1;

				while ($fila = mysql_fetch_assoc($tuplas)) {
					//Obtenemos el idUsuario y el alias del favorito
					$idUsuario2 = $fila['idUsuario2'];
					$query = sprintf("SELECT alias FROM usuarios WHERE idUsuario= '%s'", $idUsuario2);
					//Si no existe el usuario (o ha fallado la consulta)
					if (!$query)
						$this -> error = -1;
					$aliasRes = $bd -> consulta($query);
					$alias2 = mysql_fetch_assoc($aliasRes);

					$this -> favoritos[] = array('idUsuario' => $idUsuario2, 'alias' => $alias2['alias']);
				}
			} else//Conexión fallida
				$this -> error = -2;

		}
		return $this -> favoritos;
	}

}
?>
