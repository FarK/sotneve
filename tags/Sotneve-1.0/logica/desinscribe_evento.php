<?php
include 'test_session.php';
include_once '../datos/conexion.php';
include_once '../datos/evento.php';

if(!isset($_GET['idEv'])){
	$_SESSION['error'] = 'GETTError';
	head('Location:../presentacion/errores.php');
	exit;
}

$idUser = $_SESSION['idUsuario'];
$idEvento = $_GET['idEv'];
$conex = new Conexion();
$evento = new Evento($conex, $idEvento);

$evento->desinscribeUsuario($idUser);

$asistentes = $evento->getUsuarios($idEvento);
echo generaAsistentes($asistentes);

$conex->desconectar();

function generaAsistentes($asistentes){
	$enlaces = "";
	foreach($asistentes as $asist){
		$a= sprintf("<a class='enlaceEnmarcado' href='info_usuario.php?idUsuario=%s'>%s</a>\n\t\t", 
		$asist['idUsuario'],$asist['alias']);
		$enlaces = $enlaces . $a;
	}
	return $enlaces;
}
?>
