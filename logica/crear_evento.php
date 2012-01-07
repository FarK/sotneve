<?php
include ("test_session.php");
include_once ("../datos/conexion.php");
include_once ("../datos/evento.php");
include_once ("../datos/provincia.php");
include_once("../datos/usuario.php");

$conex = new Conexion();
$prov = new Provincia($conex);
	 
	$tipo = $_POST['tipos'];
	$mes = $_POST['mes'];
	$dia = $_POST['dia'];
	$ano = $_POST['ano'];
	$hora = $_POST['hora'];
	$min = $_POST['min'];
	$fechaEvento = $ano.'-'.$mes.'-'.$dia.'-'.$hora.'-'.$dia;
	$titulo = $_POST['nomevento'];
	$tipo = $_POST['tipos'];
	$numpersonas = $_POST['numpersonas'];
	$descripcion = $_POST['descripcion'];
	$lugar = $_POST['lugar'];
	$provincia = $_POST['provincia'];
	$actualizar = $_POST['actualizar'];
	$fechaActual = time();
	$anoActual = date_default_timezone_get();
	$fechaEvento = $ano."-".$mes."-".$dia." ".$hora.":".$min.":"."00";

		
	$existeProvincia = $prov->existeProvincia($provincia);


	 $valido = esValido($tipo,$existeProvincia, $provincia ,$ano, $mes, $dia, $hora, $min, $titulo, $numpersonas, $provincia, $descripcion, $lugar);
	
	if ($valido){
		$evento = new Evento($conex);

		if($actualizar == -1){
			$evento-> insertarEvento($tipo, $fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar, $_SESSION['idUsuario']);
			$id = $conex->getLastInsertId();
			$evento->inscribeUsuario($_SESSION['idUsuario'],$id);
		}
		else{
			$evento-> actualizarEvento($tipo, $fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar, $_SESSION['idUsuario'], $actualizar);
			$id = $actualizar;
		}
		
		header(sprintf("Location:../presentacion/info_evento.php?idEvento=%s", $id));
	}
	
	$conex->desconectar();


function esValido($tipo ,$existeProvincia,$povincia ,$ano, $mes, $dia, $hora, $min, $titulo, $numpersonas, $provincia, $descripcion, $lugar) {
	$valido = true;
	$camposvacios = false;

	if ($ano == "" ||$mes == "" ||$dia == "" ||$hora == "" ||$provincia == "" ||$min == "" || 
		$titulo == "" || $numpersonas== "" || $descripcion == "" || $lugar==""  || $provincia == "" || $tipo== "") {
		$camposvacios = true;
		$_SESSION['err_campos_evento'] = true;
		$valido=false;
		return(false);
	}

	if(!$existeProvincia || $tipo < 1){
		
		$valido=false;
		return(false);
		
	}
	

	if($min < 0 || $min > 60 || $hora < 0 || $hora > 23  ){
		
		$valido=false;
		return(false);
	}
	

	$diamax=1;
	
	 if ($mes < 1 || $mes > 12) {
	 	
			$valido=false;
		 	return (false);
			
	 } else {
		 switch ($mes) {
			 case 2 :
				 if ((($ano % 4 == 0) && ($ano % 100 != 0)) || (($ano % 100 == 0) && ($ano % 400 == 0))){//Contemplo año bisiesto.
				 	$diamax = 29;
				 }else{
				 	$diamax = 28;
				 }
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
		 if ($dia < 1 || $dia > $diamax) {
			 $valido = false;
			 return (false);
		 }
 
	 }
	 

	  if ($valido) {
		  return true;
	  } else {
		  header("Location:../presentacion/crear_evento.php");
	 }

	

	 }
?> 
