
<?php
	include ("includes/testSession.php");
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
		<head>
		<meta charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles/miPerfil.css" />
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<title>Sotneve - Mi perfil</title>
		</head>
		<body>
			
			<!--Incluimos la cabecera-->
			
			<?php
				include ("includes/head.php");
 ?>
			
			<div id=contenido>
				<h1>Mi perfil!</h1>
				<?
					include_once ("includes/head.php");
					
					$usuario = new Usuario($_SESSION['idUsuario']);
					$nombre  = $usuario -> getCampo("nombre");
					$apellidos = $usuario -> getCampo("apellidos");
					$fechaNac = $usuario -> getCampo("fechaNac");
					$sexo = $usuario -> getCampo("sexo");
					
				
					

					?></div>

					</body>
				