<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- IMPORTANTE ESA LÍNEA DE AHÍ ARRIBA Y LA DE ABAJO!!!  -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta charset=utf-8" />
		<title>Sotneve -Error</title>
		<link rel="stylesheet" type="text/css" href="estilos/errores.css" />
		<script type="text/javascript" src="../logica/scripts/buscar_evento.js"></script>
	</head>
	<body>
		<?php
		session_start();
		//$_SESSION['error'] = "userNotFound"; //linea para probar errores
		
		$logeado = isset($_SESSION['idUsuario']);
		
		if (isset($_SESSION['error']) && $_SESSION['error']) {
			$err = $_SESSION['error'];
		} else {
			$err = "NULO";
		}
		
		if ($logeado) {
			echo("<div id='contenedor'>
<div id='cabecera'>");
			include ('head.php');
			echo("</div>");
		}
		?>
		<br/>
		<span id="mens">
		<?php
		if ($err == 'userNotFound') {
			echo "Usuario no encontrado";
		
		}else if ($err == 'eventNotFound') {
			echo "Evento no encontrado";
		
		}else if ($err == 'internalError') {
			echo "Error en la conexión a la base de datos";
		
		}else if ($err == 'searchError') {
			echo "Error en la busqueda, compruebe los campos o intentelo de nuevo mas tarde";
		 
		} else {
			echo "Hemos tenido un problema, intentelo de nuevo mas tarde";
		}
		$_SESSION['error'] = false;
		
		?>
		</span>
	</body>
</html>
