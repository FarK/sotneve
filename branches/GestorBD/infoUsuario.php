<?php
	include ("includes/testSession.php");
	include_once('BD/usuario.php');
	include_once('BD/conexion.php');
	
	$conex = new Conexion();
	//Se llama usuario visitado porque si no se pisa con usuario de head.php
	$usuarioVisitado = new Usuario($conex, $_GET["idUsuario"]);
	$usuarioVisitado->prepCampo('alias');
	$usuarioVisitado->prepCampo('nombre');
	$usuarioVisitado->prepCampo('apellidos');
	$usuarioVisitado->prepCampo('fechaNac');
	$usuarioVisitado->prepCampo('sexo');
	$usuarioVisitado->prepCampo('email');
	$usuarioVisitado->prepCampo('idProvincia');
	$camposUsuario = $usuarioVisitado->consultarCampos();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<title>Sotneve - <?php echo $camposUsuario['alias'];?></title>
		<meta content="text/xhtml; charset=UTF-8"></meta>
		
		<link rel="stylesheet" type="text/css" href="styles/general.css"/>
		<link rel="stylesheet" type="text/css" href="styles/info_usuario.css"/>
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php
		include ("includes/head.php");
		?>

		<div class='lista_usuarios' id="amigos">
			<p>
				<strong class="num_usuarios">Amigos de <?php echo $camposUsuario['alias']
				?>:
				<br />
				</strong>
				<?php
//include_once ('BD/evento.php');

$amigos = $usuarioVisitado->getFavoritos();

//Comprobar si ha habido errores

if(empty($amigos))
	echo '<span> Actualmente no hay amigos </span>';


foreach($amigos as $am){
$span= sprintf("<span><a class='usuario' href='infoUsuario.php?idUsuario=%s'>%s</a></span>\n\t\t", $am['idUsuario2'],$am['alias']);
echo $span;
}
				?>
			</p>
		</div>
		<h1><?php echo $camposUsuario['alias']
		?></h1>
		<?php

		$novisible = "No Disponible";
		$nombre = $novisible;
		$apellidos = $novisible;
		$sexo = $novisible;
		$fechaNac = $novisible;
		$email = $novisible;

		if ($usuarioVisitado -> esVisible($NOMBRE)) {
			$nombre = $camposUsuario['nombre'];

		}

		if ($usuarioVisitado -> esVisible($APELLIDOS)) {
			$apellidos = $camposUsuario['apellidos'];

		}

		if ($usuarioVisitado -> esVisible($SEXO)) {
			$sexo = $camposUsuario['sexo'];

			if ($sexo == 1) {
				$sexo = "Hombre";
			} elseif ($sexo == 0) {
				$sexo = "Mujer";
			}
		}

		if ($usuarioVisitado -> esVisible($FECHA_NAC)) {
			$fechaNac = $camposUsuario['fechaNac'];
		}

		if ($usuarioVisitado -> esVisible($EMAIL)) {
			$email = $camposUsuario['email'];
		}

		$provincia = $usuarioVisitado -> getProvincia();
		$alias = $camposUsuario['alias'];
		?>
		<div class='info_usuario'>
			<div class='data_row'>
				<span class="l_usuario"> Nombre: </span>
				<span class="c_usuario"> <?php
				echo $nombre;
					?></span>
			</div>
			<div class='data_row'>
				<span class="l_usuario"> Apellidos: </span>
				<span class="c_usuario"> <?php
				echo $apellidos;
					?></span>
			</div>
			<div class='data_row'>
				<span class="l_usuario"> Sexo: </span>
				<span class="c_usuario"> <?php
				echo $sexo;
					?></span>
			</div>
			<div class='data_row'>
				<span class="l_usuario"> Fecha de Nacimiento: </span>
				<span class="c_usuario"> <?php
				echo $fechaNac;
					?></span>
			</div>
			<div class='data_row'>
				<span class="l_usuario"> Email: </span>
				<span class="c_usuario"> <?php
				echo $email;
					?></span>
			</div>
			<div class='data_row'>
				<span class="l_usuario"> Provincia: </span>
				<span class="c_usuario"> <?php
				echo $provincia;
					?></span>
			</div>
		</div>
		<?php
		include 'includes/footer.php';
		?>
	</body>
</html>
