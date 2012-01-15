<?php
	include 'test_session.php';
	include_once '../datos/conexion.php';
	include_once '../datos/usuario.php';

	if(!isset($_POST['idUsuario2']){
		$_SESSION['error'] = 'POSTTError';
		head('Location:../presentacion/errores.php');
		exit;
	}

	$conexion = new Conexion();	
	//Crear objeto evento
	$usuario = new Usuario($conexion,$_SESSION["idUsuario"]);
	
	$usuario-> borraFavorito($_POST['idUsuario2']);//TODO mirar que nombre le a puesto el vacas por post
	
	header(favoritos.php);
	
?>
