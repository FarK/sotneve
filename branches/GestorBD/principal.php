<?php
include("includes/testSession.php");
include_once ('BD/conexion.php');
include_once ('BD/usuario.php');
include_once ('BD/favorito.php');
include_once ('BD/afiliacion.php');

//Creamos un objeto usuario con el usuario logeado
$conex = new Conexion();
$usuarioActual = new Usuario($conex, $_SESSION['idUsuario']);
$favorito = new Favorito($conex);
$afiliacion = new Afiliacion($conex);
?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<title>Sotneve</title>
		<meta content="text/xhtml; charset=UTF-8"></meta>
		<link rel="stylesheet" type="text/css" href="styles/principal.css"></link>
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
				<?php
				$favoritos = $favorito->getFavoritos($_SESSION['idUsuario']);
				foreach ($favoritos as $fav) {
					$span = sprintf("<a class='enlaceEnmarcado' href='infoUsuario.php?idUsuario=%s'>%s</a>\n\t\t", $fav['idUsuario2'], $fav['alias']);
					echo $span;
				}
				?>
			</div>
			<div id="eventosUsuario">
				<p>
					<strong>Tus eventos</strong>
				</p>
				
				<?php
				$eventos = $afiliacion->getEventos($_SESSION['idUsuario']);
				foreach ($eventos as $evento) {
					$span = sprintf("<a class='enlaceEnmarcado' href='infoEvento.php?idEvento=%s'>%s</a>\n\t\t", $evento['idEvento'], $evento['titulo']);
					echo $span;
				}
				?>
			</div>
			<?php include("includes/footer.php"); ?>
		</div>
	</body>
</html>
<?php $conex->desconectar(); ?>
