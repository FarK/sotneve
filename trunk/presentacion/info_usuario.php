<?php
	include ("../logica/test_session.php");
	include_once('../datos/conexion.php');
	include_once('../datos/usuario.php');
	include_once('../datos/favorito.php');
	
	$conex = new Conexion();
	//Se llama usuario visitado porque si no se pisa con usuario de head.php
	$usuarioVisitado = new Usuario($conex, $_GET["idUsuario"]);
	$favorito = new Favorito($conex);

	//Consultamos los campos del usuario
	$usuarioVisitado->prepCampo('alias');
	$usuarioVisitado->prepCampo('nombre');
	$usuarioVisitado->prepCampo('apellidos');
	$usuarioVisitado->prepCampo('fechaNac');
	$usuarioVisitado->prepCampo('sexo');
	$usuarioVisitado->prepCampo('email');
	$usuarioVisitado->prepCampo('idProvincia');
	$usuarioVisitado->prepCampo('visibilidad');
	$camposUsuario = $usuarioVisitado->consultarCampos();
	//Consultamos los favoritos del usuario
	$favoritos= $favorito->getFavoritos($_GET['idUsuario']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<title>Sotneve - <?php echo $camposUsuario['alias'];?></title>
		<meta content="text/xhtml; charset=UTF-8"></meta>
		
		<link rel="stylesheet" type="text/css" href="estilos/info_usuario.css"/>
		<script type="text/javascript" src="../logica/scripts/buscarevento.js"></script>
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php
		include ("head.php");
		?>

		<div class='lista_usuarios' id="amigos">
			<p>
				<strong class="num_usuarios">Favoritos de <?php echo $camposUsuario['alias']
				?>:
				<br />
				</strong>
				<?php

//Comprobamos si tiene o no favoritos
if(empty($favoritos ))
	echo '<span> Actualmente no hay favoritos </span>';


foreach($favoritos as $fav){
$span= sprintf("<a class='enlaceEnmarcado' href='info_usuario.php?idUsuario=%s'>%s</a>\n\t\t", $fav['idUsuario2'],$fav['alias']);
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

		if ($camposUsuario['visibilidad'] & $NOMBRE) {
			$nombre = $camposUsuario['nombre'];

		}

		if ($camposUsuario['visibilidad'] & $APELLIDOS) {
			$apellidos = $camposUsuario['apellidos'];

		}

		if ($camposUsuario['visibilidad'] & $SEXO) {
			$sexo = $camposUsuario['sexo'];

			if ($sexo == 1) {
				$sexo = "Hombre";
			} elseif ($sexo == 0) {
				$sexo = "Mujer";
			}
		}

		if ($camposUsuario['visibilidad'] & $FECHA_NAC) {
			$fechaNac = $camposUsuario['fechaNac'];
		}

		if ($camposUsuario['visibilidad'] & $EMAIL) {
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
		include 'footer.php';
		?>
	</body>
</html>
