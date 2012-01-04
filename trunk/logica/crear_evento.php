<?php
include ("test_session.php");
include_once ("../datos/conexion.php");
include_once ("../datos/evento.php");
include_once ("../datos/provincia.php");

$conex = new Conexion();
$prov = new Provincia($conex);
	
	$mes = $_POST['mes'];
	$dia = $_POST['dia'];
	$ano = $_POST['ano'];
	$fechaEvento = $ano.'-'.$mes.'-'.$dia;
	$titulo = $_POST['nomevento'];
	$numpersonas = $_POST['numpersonas'];
	$descripcion = $_POST['descripcion'];
	$lugar = $_POST['lugar'];
	$provincia = $_POST['provincia'];

	$existeProvincia = $prov->existeProvincia($provincia);

	$valido = esValido($existeProvincia, $fechaEvento, $titulo, $numpersonas, $provincia,$descripcion,$lugar);
	
	if ($valido){
		$evento = new Evento($conex);
		$evento-> insertarEvento($fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar);
		$id = $conex->getLastInsertId();
		
		header(sprintf("Location:../presentacion/info_evento.php?idEvento=%s", $id));
	}
	 $conex->desconectar();


function esValido($existeProvincia, $fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar) {
	$valido = true;
	$camposvacios = false;

	if ($fechaEvento == "" || $titulo == "" || $numpersonas== "" || $descripcion == "" || $lugar=='') {
		$camposvacios = true;
		$_SESSION['err_campos'] = true;
		$valido=false;
	}

	$dia = substr($fechaEvento, 0, 2);
	$mes = substr($fechaEvento, 3, 2);
	$ano = substr($fechaEvento, 6, 9);

	$diamax=0;
	//No contemplamos bisiestos ni los años

	if ($mes > 0 && $mes < 13 && strlen($fechaEvento)==10) {//con == 10 hacemos que sea de la forma dd/mm/aaaa
		switch ($mes) {
			case '2' :
				$diamax = 28;
				break;

			case 04 || 06 || 11 || 09 :
				$diamax = 30;
				break;
			case 01 || 03 || 05 || 07 || 08 || 10 || 12 :
				$diamax = 31;
				break;
			default :
				break;
		}
		if ($dia < 1 && $dia > $diamax) {
			$valido = false;
		}

	} else {
		$valido = false;
	}
	
	if ($provincia == 0) {
		$_SESSION['err_campos'] = true;
		$valido = false;
	} elseif (!$camposvacios && !$existeProvincia) {
		$_SESSION['err_campos'] = true;
		$valido=false;
	}

	if ($valido) {
		return true;
	} else {
		header("Location:../presentacion/crear_evento.php");
	}

}
?> 