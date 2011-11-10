<?php
	session_start();
	if(!isset($_SESSION['logged'])){
		//header('Location:index.php');
	}		

	include_once('BD/GestorBD.php');
	//Iniciar sesion
	//session_start();
	//Crear objeto gestor bd
	$bd = new GestorBD();	
	//Conectar a la bd
	if($bd->conectar()){ //Pudo conectar
		
		$usuario = $bd->getUsuario($_GET["idUsuario"]);

		//Si no existe el usuario (o ha fallado la consulta)
		if(!$usuario)
			header('Location:errores.php?error="userNotFound"');
			//echo "error";

		//Desconectar de la bd
		$bd->desconectar();
	}else{
	//No puedo conectar
		//Redirecconar con GET a error
		header('Location:index.php?err_bd');
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- IMPORTANTE ESA LÍNEA DE AHÍ ARRIBA Y LA DE ABAJO!!!  -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sotneve - Login</title>
		<link rel="stylesheet" type="text/css" href="styles/index.css" />
		<script type="text/javascript" src="scripts/index.js"></script>
	</head>
	<body>
asd	
		<h1><?php echo $usuario["alias"]?><h1>
	</body>
</html>
