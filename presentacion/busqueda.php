<?php
include ("../logica/test_session.php");
include_once ('../datos/evento.php');
include_once ('../datos/conexion.php');
include_once ('../datos/tipo.php');
include_once ('../datos/provincia.php');

$idprovincia = $_GET["provincia"];
$idtipo = $_GET["tipo"];

//Comprobar si ha habido errores

if ($idprovincia == NULL || $idtipo == NULL) {//Valido los datos que me llegan por get parte1 de 2
	//TODO mandar a errores bien
	header('Location:errores.php?error="Busqueda no valida"');
}

$conexion = new Conexion();

$provincia = new Provincia($conexion, $idprovincia);
$provincia -> prepCampo("nombre");
$auxProv = $provincia -> consultarCampos();
$provinciaString = $auxProv['nombre'];

$tipo = new Tipo($conexion, $idtipo);
$tipo -> prepCampo("nombre");
$auxTipo = $tipo -> consultarCampos();
$tipoString = $auxTipo['nombre'];

$eventoObj = new Evento($conexion);

if ($idtipo == 0) {//Si es 0 se muestran todos
	$eventos = $eventoObj -> getEventosProvinciaVigentes($provincia);
} else {
	$eventos = $eventoObj -> getEventosProvinciaTipoVigentes($idprovincia, $idtipo);
}
$enlaces = array();
		foreach ($eventos as $evento) {
			$idEvento = $evento['idEvento'];
			$titulo = $evento['titulo'];
			$maxpersonas = $evento['maxPersonas'];
			$lugar = $evento['lugar'];
			//TODO hacer asistentes
			$asistentes=$eventoObj->getUsuarios($idEvento);
			$personasActuales=count($asistentes);
	
			$enlaces[] = sprintf("<a class='enlaceEnmarcado' href='../presentacion/info_evento.php?&idEvento=%s' >Evento: %s , numero de personas %s de %s, lugar %s</a>", $idEvento, $titulo, $personasActuales, $maxpersonas, $lugar);
			
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta charset=utf-8" />
		<title>Sotneve - Resultado Busqueda</title>
		<link rel="stylesheet" type="text/css" href="estilos/busqueda.css">
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
		</head>
		<body>
		<!-- Incluimos la cabecera -->
		<?php
		include ("../presentacion/head.php");
		?>

		<h1><?php

		if ($idtipo == 0) {
			$tipoString = "'Todos'";
		}

		if ($provinciaString == NULL || $tipoString == NULL) {//Valido los datos que me llegan por get parte2 de 2
			header('Location:errores.php?error="los valores de busqueda no existen en la base de datos"');
		}
		$aux = sprintf("En %s buscando la actividad %s", $provinciaString, $tipoString);

		echo($aux);
		?></h1>
		<?php

		foreach ($enlaces as $linea) {
			echo $linea;
		}
		?>
		<?php
			include ("../presentacion/footer.php");
 ?>
		</body>
		</html>
