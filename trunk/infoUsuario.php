<?php
	include ("includes/testSession.php");
	include_once('BD/usuario.php');

	//Crear objeto usuario
	$usuario = new Usuario($_GET["idUsuario"]);
	//Comprobar si ha habido errores
	if($usuario->error() == -2) //No pudo conectar
		header('Location:index.php?err_bd');	//Redirecconar con GET a error
	
	else if($usuario->error() == -1)//no existe el usuario (o ha fallado la consulta)
		header('Location:errores.php?error="userNotFound"');


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sotneve - <?php echo $usuario->getCampo("alias"); ?></title>
		<link rel="stylesheet" type="text/css" href="styles/index.css" />
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php include ("includes/head.php"); ?>

		<h1><?php echo $usuario->getCampo("alias")?></h1>
		
		<div class="info_usuario">
			<span id="nombre" class="campo_usuario">
				<?php
					if($usuario->esVisible($NOMBRE)) echo $usuario->getCampo("nombre");
				?>
			</span>
			<span id="apellidos" class="campo_usuario">
				<?php
					if($usuario->esVisible($APELLIDOS)) echo $usuario->getCampo("apellidos");
				?>
			</span>
			<span id="sexo" class="campo_usuario">
				<?php
					if($usuario->esVisible($SEXO)) echo $usuario->getCampo("sexo");
				?>
			</span>
			<span id="fechaNac" class="campo_usuario">
				<?php
					if($usuario->esVisible($FECHA_NAC)) echo $usuario->getCampo("fechaNac");
				?>
			</span>
			<span id="email" class="campo_usuario">
				<?php
					if($usuario->esVisible($EMAIL)) echo $usuario->getCampo("email");
				?>
			</span>
			<span id="provincia" class="campo_usuario">
				<?php
					echo $usuario->getCampo("provincia");
				?>
			</span>
		</div>
	</body>
</html>
