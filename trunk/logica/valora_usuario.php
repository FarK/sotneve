<?php
include 'test_session.php';
include_once '../datos/conexion.php';
include_once '../datos/usuario.php';


if(!isset($_GET['idUser2']) || !isset($_GET['valoracion']) || $_GET['valoracion'] > 5 || $_GET['valoracion'] <0){
	$_SESSION['error'] = "POST";
	header("Location: ../presentacion/errores.php");
	exit;
}


$idUser = $_SESSION['idUsuario'];
$idUser2 = $_GET['idUser2'];
$valoracion = $_GET['valoracion'];
$conex = new Conexion();
$user = new Usuario($conex, $idUser);
$user->valoraUsuario($idUser2, $valoracion);
$conex->desconectar();
?>