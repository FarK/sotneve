<?php
include ("includes/testSession.php");
include_once ('BD/evento.php');

$provincia = $_GET["provincia"];
$subtipos = $_GET["subtipos"];
//Comprobar si ha habido errores
include_once ('BD/GestorBD.php');

$bd = new GestorBD();

if ($provincia == NULL || $subtipos == NULL) {
	header('Location:errores.php?error="Busqueda no valida"');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sotneve - Resultado Busqueda</title>
		<link rel="stylesheet" type="text/css" href="styles/resultadobusqueda.css" />
		<link rel="stylesheet" type="text/css" href="styles/buscarevento.css">
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php
		include ("includes/head.php");
		?>

		<h1><?php
		$conectado = $bd -> conectar();
		if ($conectado) {

			$provinciaString = $bd -> getNombreElementoCon('provincias', 'idProvincia', $provincia);

			$subtipoString = $bd -> getNombreElementoCon('subtipos', 'idSubTipo', $subtipos);

			if ($provinciaString == NULL || $subtipoString == NULL) {
				header('Location:errores.php?error="los valores de busqueda no existen en la base de datos"');
			}
			$aux = sprintf("En %s buscando la actividad %s", $provinciaString, $subtipoString);
			echo($aux);
		}
		?></h1>
		<?php
		if ($conectado) {
			$tuplas = $bd -> getEventosConProvinciaYSubtipoNoCaducados($provincia, $subtipos);
			$bd -> desconectar();
		}

		while ($fila = mysql_fetch_assoc($tuplas)) {
			$idEvento2 = $fila['idEvento'];
			$evento = new Evento($idEvento2);
			$titulo = $evento -> getCampo('titulo');
			$maxpersonas = $evento -> getCampo('maxPersonas');
			$lugar = $evento -> getCampo('lugar');

			$linea = sprintf("<span><a href='infoEvento.php?&idEvento=%s'>Evento: %s , numero de personas %s, lugar %s %s</a></span>", $idEvento2, $titulo, $maxpersonas, $lugar, $provincia);
			echo($linea);
		}
		?>
	</body>
</html>