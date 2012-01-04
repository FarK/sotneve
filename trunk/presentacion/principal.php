<?php
include("../logica/test_session.php");
include_once ('../datos/conexion.php');
include_once ('../datos/usuario.php');

//Creamos un objeto usuario con el usuario logeado
$conex = new Conexion();
$usuarioActual = new Usuario($conex, $_SESSION['idUsuario']);
?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<title>Sotneve</title>
		<meta content="text/xhtml; charset=UTF-8"></meta>
		<link rel="stylesheet" type="text/css" href="estilos/principal.css"></link>
		<script type="text/javascript" src="../logica/scripts/buscarevento.js"></script>
	</head>
	<body>
		<div id="contenedor">
			<div id="cabecera">
				<?php include ("head.php"); ?>
			</div>
			<div id="wrapper">
				<div id="eventos">
					<p>
						<strong id="eventsin">Eventos en tu provincia</strong>
					</p>
					<?php
					$eventosProv = $usuarioActual->getEventosProvincia();
					foreach ($eventosProv as $evento) {
						$span = sprintf("<a class='enlaceEnmarcado' href='infoEvento.php?idEvento=%s'>%s</a>\n\t\t", $evento['idEvento'], $evento['titulo']);
						echo $span;
					}
					?>
				</div>
			</div>
			<div class='lista_usuarios' id="favoritos">
				<p>
					<strong>Tus favoritos</strong>
				</p>
				<?php
				$favoritos = $usuarioActual->getFavoritos();
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
				$eventos = $usuarioActual->getEventos();
				foreach ($eventos as $evento) {
					$span = sprintf("<a class='enlaceEnmarcado' href='infoEvento.php?idEvento=%s'>%s</a>\n\t\t", $evento['idEvento'], $evento['titulo']);
					echo $span;
				}
				?>
			</div>
			<?php include("footer.php"); ?>
		</div>
	</body>
</html>
<?php $conex->desconectar(); ?>
