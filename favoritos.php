<?php include ("includes/testSession.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles/favoritos.css" />
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
		<title>Sotneve - Tus favoritos</title>
		
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php include ("includes/head.php"); ?>

		<div id=listafavoritos>
		<h1>Estos son tus favoritos!</h1>
		<?php

			include_once ('BD/usuario.php');

			//Crear objeto usuario
			$usuario = new Usuario($_GET["idUsuario"]);
			$favoritos = $usuario->getFavoritos();
			//Comprobar si ha habido errores
			if($usuario->error() == -2) //No pudo conectar
				header('Location:index.php?err_bd');	//Redirecconar con GET a error
			else if($usuario->error() == -1)//no existe el usuario (o ha fallado la consulta)
				header('Location:errores.php?error="userNotFound"');

			foreach($favoritos as $fav){
				$span= sprintf("<span><a href='infoUsuario.php?idUsuario=%s'>%s</a></span>\n\t\t", $fav['idUsuario'],$fav['alias']);
				echo $span;
			}
		?>
	</div>
		<?php include("includes/footer.php"); ?>
	</body>
</html>
