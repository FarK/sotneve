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
					$_SESSION['idUsuario'] = $row['idUsuario'];
					header('Location:principal.php');
			}else{
				//Es incorrecta
					//Redireccionar a index con error en SESSION
					$_SESSION['err_pass'] = true;
					header('Location:index.php');
			}
			//Desconectar de la bd
		$bd->desconectar();
	}else{
	//No puedo conectar
		//Redirecconar a index con error en SESSION
		$_SESSION['err_bd'] = true;
		header('Location:index.php');
	}
?>