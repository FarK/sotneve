<?php include ("includes/testSession.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles/favoritos.css" />
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
		<title>Sotneve - Tus favoritos</title>
		
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php include ("includes/head.php"); ?>

		<div id=listafavoritos>
		<h1>&iexcl;&Eacute;stos son tus favoritos!</h1>
		<?php

			include_once ('BD/conexion.php');
			include_once ('BD/usuario.php');
			include_once ('BD/favorito.php');

			//Creamos la conexión y los objetos de consulta
			$conexion = new Conexion();
			$usuario = new Usuario($conexion, $_GET["idUsuario"]);
			$favorito = new Favorito($conexion);
			$favoritos = $favorito->getFavoritos($_GET['idUsuario']);

			foreach($favoritos as $fav){
				if($_SESSION['idUsuario'] == $_GET['idUsuario']){
					$span= sprintf("
					<div class='enlaceEnmarcado'>
						<a class='favorito' href='infoUsuario.php?idUsuario=%s'>%s</a>
						<a class='favorito' href='http://www.google.es?%s'>
							<img id='delete' src='images/delete.png' width='16px' height='16px' alt='Eliminar favorito'/>
						</a>
					</div>
					\n\t\t", $fav['idUsuario'], $fav['alias'], $fav['idUsuario']);
					echo $span;
				}else{
					$span= sprintf("
					<div class='enlaceEnmarcado'>
						<a class='favorito' href='infoUsuario.php?idUsuario=%s'>%s</a>
					</div>
					\n\t\t", $fav['idUsuario'],$fav['alias']);
					echo $span;
				}
			}
		?>
			

	</div>
		<?php include("includes/footer.php"); ?>
	</body>
</html>
