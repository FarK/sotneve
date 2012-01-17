<?php
	include_once('../datos/conexion.php');
	include_once('../datos/usuario.php');
	//Iniciar sesion
	session_start();
	//Crear objeto gestor bd
	$conex = new Conexion();	
	$usuarios = new Usuario($conex);
	
	if(!(isset($_POST['email']) && isset($_POST['pass']))){
		$_SESSION['error'] = 'POSTError';
		head('Location:../presentacion/errores.php');
		exit;
	}

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
	//Comprobar que la contraseña es correcta
	if($id = $usuarios->passCorrecta($email, $pass)){
		//Es correcta
		//Meter en la variable session que ha conectado
		$_SESSION['idUsuario'] = $id;
		header('Location:../presentacion/principal.php');
	}else{
		//Es incorrecta
		//Error en SESSION
		$_SESSION['err_pass'] = true;
		header('Location:../index.php');
	}
	
	$conex->desconectar();	
?>
