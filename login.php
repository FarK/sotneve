<?php
	include_once('BD/GestorBD.php');
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
					$_SESSION['logged'] = true;
					$_SESSION['idUsuario'] = $row['idUsuario'];
			}else{
				//Es incorrecta
					//Redireccionar con GET a error
					header('Location:index.php?err_pass');
			}
			//Desconectar de la bd
		$bd->desconectar();
	}else{
	//No puedo conectar
		//Redirecconar con GET a error
		header('Location:index.php?err_bd');
	}
	
	echo 'Logueado, tu id es: ' . $_SESSION['idUsuario'] . '<br>';
