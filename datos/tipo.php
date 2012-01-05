<?php
include_once("tabla.php");

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

		//Consultamos todos los tipos
		$this->tipos = $this->consultar("SELECT * FROM tipos");
	}

	public function getArbolTipos(){
		$arbolTipos = array();
		foreach($this->tipos as $tipo){
			if($tipo['idPadre'] == NULL){
				$this->creaOption($tipo['idTipo'], $tipo['nombre'], 0);
				$this->getArbolSubtipos($tipo, 1);
				//Lo insertamos en el array
				//$arbolTipos[] = array(
				//	$tipo['idTipo'] => $tipo['nombre'],
				//	'subtipos' => $this->getArbolSubtipos($tipo, 1)
				//);
			}
		}

		//return $arbolTipos;
	}

	private function getArbolSubtipos($tipoPadre, $nivel){
		//Obtenemos los subtipos del tipos actual
		$arbolTipos = array();
		foreach($this->tipos as $tipoHijo)
			if(($tipoHijo['idPadre'] != NULL) && ($tipoHijo['idPadre'] == $tipoPadre['idTipo'])){
				$this->creaOption($tipoHijo['idTipo'], $tipoHijo['nombre'], $nivel);
				$this->getArbolSubtipos($tipoHijo, $nivel + 1);
				//Lo insertamos en el array
				//$arbolTipos[] = array(
				//	$tipoHijo['idTipo'] => $tipoHijo['nombre'],
				//	'subtipos' => $this->getArbolSubtipos($tipoHijo, $nivel + 1)
				//);
			}

		//return $arbolTipos;
	}

	public function creaOption($idTipo, $nombre, $nivel){
		$indentacion = $this->creaIndentacion($nivel);
		$option = sprintf("<option value=%s> %s%s </option>\n", $idTipo, $indentacion, $nombre);
		echo $option;
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
