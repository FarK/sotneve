<?php 
include ('../logica/test_session.php'); 
include_once ('../datos/conexion.php');
include_once ('../datos/usuario.php');
include_once ('../datos/favorito.php');

//Creamos la conexión y los objetos de consulta
$conexion = new Conexion();
$usuario = new Usuario($conexion, $_SESSION['idUsuario']);
$favorito = new Favorito($conexion);
$favoritos = $favorito->getFavoritos($_SESSION['idUsuario']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="estilos/favoritos.css" />
		<script type="text/javascript" src="../logica/scripts/favoritos.js"></script>
		<title>Sotneve - Tus favoritos</title>
		
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php include ("head.php"); ?>

		<div id='listafavoritos'>
		<span class="h1">&iexcl;&Eacute;stos son tus favoritos!</span>
		<div id='favoritos'>
		<?php
			foreach($favoritos as $fav){
					$echo = sprintf("
					<div class='favorito'>
						<a class='favorito' href='info_usuario.php?idUsuario=%s'>%s</a>
						<span class='espacioBlanco'></span>
						<form class='favorito' action='javascript:borraFavorito(%s)'>
						<div>
							<input class='delete' type='image' src='recursos/imagenes/delete.png'/>
						</div>
						</form>
					</div>",
					$fav['idUsuario'], $fav['alias'], $fav['idUsuario']);
					echo $echo;
			}
		?>
		</div>
			
	</div>
		<?php include("footer.php"); ?>
	</body>
</html>
