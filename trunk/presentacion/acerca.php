<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta charset=utf-8 />
		<link rel="stylesheet" type="text/css" href="estilos/acerca.css" />
		<script type="text/javascript" src="../logica/scripts/buscar_evento.js"></script>
	</head>
	<body>
		<div id="cabecera">
			<?php
			session_start();
			if (isset($_SESSION['idUsuario'])) {
				include ("head.php");
			}else{
				//TODO desarrollar un boton de volver, una barra arriba con opciones inicio, registrarse o algo parecido, que esta muy soso
			}
			
			?>
		</div>
		<div>
			<span id="nosotros"> Esta p&aacute;gina ha sido desarrollada por un grupo de 5 compa&ntilde;eros para la asignatura de ABD. </span>
			<video id="video" controls>
				<source src="recursos/videos/tu_video.ogv" type="video/ogg" />
				<source src="recursos/videos/tu_video.mp4" type="video/mp4" />
				<object width="160" height="90" data="video.flv">
					<param name="movie" value="tu_video.flv">
					<embed src="recursos/videos/tu_video.flv" width="160" height="90">
				</object>
				<p>
					Tu navegador no soporta HTML5 ni Flash Â¿En que era estÃ¡s?
				</p>
			</video>
		</div>
	</body>
</html>
