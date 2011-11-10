<?php
	include_once('BD/GestorBD.php');
	//Validar POST                                         TODO
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
					//Variable error a true para el html
					$_SESSION['err_pass'] = true;
					//Redireccionar
					header('Location:index.php');
			}
			//Desconectar de la bd
		$bd->desconectar();
	}else{
	//No puedo conectar
		//Variable error para el html
		$_SESSION['err_bd'] = true;
		//Redirecconar
		header('Location:index.php');
	}
	
	echo 'Logueado, tu id es: ' . $_SESSION['idUsuario'] . '<br>';
