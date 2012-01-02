<?php
include ("includes/testSession.php");
include_once ('BD/GestorBD.php');
include_once ('BD/usuario.php');

//Creamos un objeto usuario con el usuario logeado
$usuarioActual = new Usuario($_SESSION['idUsuario']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta charset=utf-8 />
		<link rel="stylesheet" type="text/css" href="styles/acerca.css" />
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
	</head>
	<body>
		<div id="cabecera">
			<?php
			include ("includes/head.php");
			?>
		</div>
		<div>
		<span id="nosotros">
			Esta p&aacute;gina a sido desarrollada por un grupo de 5 compa&ntilde;eros para la asignatura de ABD.
		</span>
			
		<video id="video" controls>
			<source src="videos/tu_video.ogv" type="video/ogg" />
			<source src="videos/tu_video.mp4" type="video/mp4" />
			<object width="160" height="90" data="video.flv">
				<param name="movie" value="tu_video.flv">
				<embed src="videos/tu_video.flv" width="160" height="90">
			</object>
			<p>
				Tu navegador no soporta HTML5 ni Flash ¿En que era estas?
			</p>
		</video>
		</div>
	</body>
