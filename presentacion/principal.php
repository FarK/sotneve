<?php
include("../logica/test_session.php");
include_once ('../datos/conexion.php');
include_once ('../datos/usuario.php');

//Creamos un objeto usuario con el usuario logeado
$conex = new Conexion();

$usuarioActual = new Usuario($conex, $_SESSION['idUsuario']);
$eventos = $usuarioActual->getEventos();
$eventosProv = $usuarioActual->getEventosProvincia();
$favoritos = $usuarioActual->getFavoritos();
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
		<?php include ("head.php"); ?>
		<div class='contenido'>
			<div id='listas'>
				<div class='listaLateral' id='listaFavoritos'>
					<span class='titulo'>Tus favoritos</span>
					<br/>
					<?php
					foreach ($favoritos as $fav) {
						$span = sprintf("<a class='enlaceEnmarcado' href='info_usuario.php?idUsuario=%s'>%s</a>\n\t\t", $fav['idUsuario2'], htmlentities($fav['alias']));
						echo $span;
					}
					?>
				</div>

				<div id='listaEventosProvincia'>
					<span class='titulo'>Eventos en tu provincia</span>
					<br/>
					<?php
					foreach ($eventosProv as $evento) {
						$span = sprintf("<a class='enlaceEnmarcado' id='enlaceEnmarcadoInv' href='info_evento.php?idEvento=%s'>%s</a>\n\t\t", $evento['idEvento'], $evento['titulo']);
						echo $span;
					}
					?>
				</div>

				<div class='listaLateral' id='listaEventos'>
					<span class='titulo'>Tus eventos</span>
					<br/>
					<?php
					foreach ($eventos as $evento) {
						$span = sprintf("<a class='enlaceEnmarcado' href='info_evento.php?idEvento=%s'>%s</a>\n\t\t", $evento['idEvento'], $evento['titulo']);
						echo $span;
					}
					?>
				</div>
			</div>
			<?php include("footer.php"); ?>
		</div>
	</body>
</html>
<?php $conex->desconectar(); ?>
