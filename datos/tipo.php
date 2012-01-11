<?php
include_once("tabla.php");
include_once("tipo.php");

class Tipo extends Tabla{
	var $tipos;
	
	public function __construct(/*$conexion, $idTipo*/){
		//Inicializamos el nombre de la tabla
		$this->nomTabla = 'tipos';

		//Comprobamos si se han recibido las claves primarias
		$arg_list = func_get_args();
		if (func_num_args() == 2){
			//Inicializamos el array de claves primarias
			$this->pks = array('idTipo'=>$arg_list[1]);
		}

		//Llamamos al constructor de tabla
		parent::__construct($arg_list[0]);
	}

	//Si le pasamos un idTipo solo nos devuelve los subtipos de ese tipo
	public function getArbolTipos(/*$callBackFunc, idTipo*/){
		//Consultamos todos los tipos
		$this->tipos = $this->consultar("SELECT * FROM tipos");

		$idTipo = -1;
		$callBack = array($this, 'creaOption');
		if(func_num_args() >= 1)
			$callBack = func_get_arg(0);
		if(func_num_args() == 2)
		      	$idTipo = func_get_arg(1);

		$array = array();
		foreach($this->tipos as $tipo){
			if(($idTipo == -1 && $tipo['idPadre'] == NULL) ||
			   ($tipo['idTipo'] == $idTipo))
			{
				$array[] = call_user_func($callBack, $tipo['idTipo'], $tipo['nombre'], 0);
				$this->getArbolSubtipos($tipo, 1, $callBack, $array);
			}
		}
		
		return $array;
	}

	private function getArbolSubtipos($tipoPadre, $nivel, $callBack, &$array){
		//Obtenemos los subtipos del tipos actual
		foreach($this->tipos as $tipoHijo)
			if(($tipoHijo['idPadre'] != NULL) && ($tipoHijo['idPadre'] == $tipoPadre['idTipo'])){
				$array[] = call_user_func($callBack, $tipoHijo['idTipo'], $tipoHijo['nombre'], $nivel);
				$this->getArbolSubtipos($tipoHijo, $nivel + 1, $callBack, $array);
			}
	}

	//CALL BACK FUNCTIONS__________________________________________________________________________________

	public function creaOption(/*$idTipo, $nombre, $nivel*/){
		$argList = func_get_args();

		$indentacion = $this->creaIndentacion($argList[2]);
		$option = sprintf("<option value=%s> %s%s </option>\n", $argList[0], $indentacion, $argList[1]);
		echo $option;
	}

	public static function getIdsSubtipos(){
		return func_get_arg(0);
	}

	public function creaIndentacion($nivel){
		$indentacion = '';
		if($nivel != 0){
			$indentacion = '&nbsp;';
			for($i = $nivel-1 ; $i > 0 ; --$i){
				$indentacion = $indentacion . '|&nbsp;&nbsp;&nbsp;';
			}
			$indentacion = $indentacion . '|--';
		}
		return $indentacion;
	}
}
