<?php
include ("includes/testSession.php");
include_once ('BD/GestorBD.php');
include_once ('BD/usuario.php');

//Creamos un objeto usuario con el usuario logeado
$usuarioActual = new Usuario($_SESSION['idUsuario']);
if ($usuarioActual -> error() != 0)
	header('Location:errores.php?error="usernotfound"');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles/principal.css" />
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php include ("includes/head.php");
include ("buscarevento.php")
		?>

		<div id="contenedor">
			<div id="cabecera">
				<h1>Cabecera</h1>
			</div>
			<div id="wrapper">
				<div id="eventos">
					<p>
						<strong>Eventos en [Sevilla(TODO)]</strong>
					</p>
				</div>
			</div>
			<div id="favoritos">
				<p>
					<strong>Tus favoritos</strong>
				</p>
				<?php
				$favoritos = $usuarioActual -> getFavoritos();
				foreach ($favoritos as $fav) {
					$span = sprintf("<span><a href='infoUsuario.php?idUsuario=%s'>%s</a></span>\n\t\t", $fav['idUsuario'], $fav['alias']);
					echo $span;
				}
				?>
			</div>
			<div id="eventosUsuario">
				<p>
					<strong>Tus eventos</strong>
				</p>
			</div>
			<div id="pie">
				<span>Pie</span>
			</div>
		</div>
	</body>
</html>
