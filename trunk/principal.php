<?php
include("includes/testSession.php");
include_once ('BD/GestorBD.php');
include_once ('BD/usuario.php');

//Creamos un objeto usuario con el usuario logeado
$usuarioActual = new Usuario($_SESSION['idUsuario']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles/principal.css" />
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
	</head>
	<body>
		<div id="contenedor">
			<div id="cabecera">
				<?php include ("includes/head.php"); ?>
			</div>
			<div id="wrapper">
				<div id="eventos">
					<p>
						<strong id="eventsin">Eventos en [Sevilla(TODO)]</strong>
					</p>
					<p>
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
					</p>
					<p>
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
				
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
					</p><span>
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
				
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
					</span>
					
				</div>
			</div>
			<div class='lista_usuarios' id="favoritos">
				<p>
					<strong>Tus favoritos</strong>
				</p>
				<p>
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
				
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
					</p>
					<p>
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
				
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
					</p>
				<?php
				$favoritos = $usuarioActual -> getFavoritos();
				foreach ($favoritos as $fav) {
					$span = sprintf("<span><a class='usuario' href='infoUsuario.php?idUsuario=%s'>%s</a></span>\n\t\t", $fav['idUsuario'], $fav['alias']);
					echo $span;
				}
				?>
			</div>
			<div id="eventosUsuario">
				<p>
					<strong>Tus eventos</strong>
				</p>
				<p>
						
						<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
				
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
					</p>
					<p>
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
				
						texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto 
					</p>
								<?php
				$eventos = $usuarioActual -> getEventos();
				foreach ($eventos as $fav) {
					$span = sprintf("<span><a class='evento' href='infoEvento.php?idEvento=%s'>%s</a></span>\n\t\t", $fav['idEvento'], $fav['titulo']);
					echo $span;
				}
				?>
			</div>
			<?php include("includes/footer.php"); ?>
		</div>
	</body>
</html>
