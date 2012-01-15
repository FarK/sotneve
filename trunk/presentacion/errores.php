<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
		<title>Sotneve -Error</title>
		<link rel="stylesheet" type="text/css" href="estilos/errores.css" />
		<script type="text/javascript" src="../logica/scripts/buscar_evento.js"></script>
	</head>
	<body>
		<?php
		session_start();
		
		$logeado = isset($_SESSION['idUsuario']);
		
		if (isset($_SESSION['error']) && $_SESSION['error']) {
			$err = $_SESSION['error'];
			$_SESSION['error'] = false;
		} else {
			$err = null;
		}
		
		if ($logeado && $err!='internalError') {
			include ('head.php');
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
			echo "Error en la conexi&oacute;n a la base de datos, int&eacute;ntelo de nuevo m&aacute;s tarde";
		
		}else if ($err == 'searchError') {
			echo "Error en la b&uacute;squeda, compruebe los campos o int&eacute;ntelo de nuevo m&aacute;s tarde";
		 
		} else {
			echo "Hemos tenido un problema, int&eacute;ntelo de nuevo m&aacute;s tarde";
		}
		//debug
		echo $_SESSION['debug'];
		?>
		</span>
	</body>
</html>
