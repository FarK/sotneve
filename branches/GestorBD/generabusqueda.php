<?php
include_once ('BD/GestorBD.php');

$bd = new GestorBD();

if ($bd -> conectar()) {

	$provincia = $bd -> escapeString($_GET['provincia']);
	$subtipo = $bd -> escapeString($_GET['subtipos']);
	if ($provincia == NULL || $subtipo == NULL) {
		header('Location:errores.php?error="Busqueda no valida"');
	} else {
		$string = sprintf("Location:resultadobusqueda.php?provincia=%s&subtipos=%s", $provincia, $subtipo);
		header($string);
	}
}
?>
