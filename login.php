<?php
	include_once('GestorBD.php');
	
	//Variables para errores
	$err_bd = false;
	$err_pass = false;
	
	//Iniciar sesion
	session_start();
	//Crear objeto gestor bd
	$bd = new GestorBD();	
	//Conectar a la bd
	if($bd->conectar()){
		//Pudo conectar
			//Sanear POST
			$email = $bd->escapeString($_POST['email']);
			$pass = $bd->escapeString($_POST['pass']);
			//Comprobar que la contraseña es correcta
			if($row = $bd->passCorrecta($email, $pass)){
				//Es correcta
					//Meter en la variable session que ha conectado
					$_SESSION['idUsuario'] = $row['idUsuario'];
			}else{
				//Es incorrecta
					//Variable error a true para el html
					$err_pass = true;
			}
			//Desconectar de la bd
		$bd->desconectar();
	}else{
	//No puedo conectar
		//Variable error para el html
		$err_bd = true;
	}
	
	echo 'Id de conectado ' . $_SESSION['idUsuario'] . '<br>';
	if($err_pass) echo 'err_pass ' . '<br>';
	if($err_bd) echo 'err_bd ' . '<br>';
