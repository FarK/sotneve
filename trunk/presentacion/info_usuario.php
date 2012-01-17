<?php
include ("../logica/test_session.php");
include_once ('../datos/conexion.php');
include_once ('../datos/usuario.php');
include_once ('../datos/favorito.php');

if (!isset($_GET["idUsuario"])) {
	$_SESSION['error'] = "userNotFound";
	header("Location:errores.php");
	exit ;
}

$conex = new Conexion();
//Se llama usuario visitado porque si no se pisa con usuario de head.php
$idUserVisitado = $_GET["idUsuario"];
$usuarioVisitado = new Usuario($conex, $idUserVisitado);
$favorito = new Favorito($conex);
$userLog = new Usuario($conex, $_SESSION['idUsuario']);
//Consultamos los campos del usuario
$camposUsuario = $usuarioVisitado -> consultarTodosLosCampos();
$provincia = $usuarioVisitado -> getProvincia();
$provActual = $provincia;

$valoracion = $usuarioVisitado -> getValoracion();
if ($valoracion == -1)
	$valoracion = "Sin datos";

//Consultamos los favoritos del usuario
$favoritos = $favorito -> getFavoritos($_GET['idUsuario']);
$esFavorito = $userLog -> esFavorito($idUserVisitado);
if ($esFavorito) {
	$add_form_action = 'javascript:borraFavorito(' . $idUserVisitado . ')';
	$add_image = '<input type="image" class="add_image" src="recursos/imagenes/delete.png"/><span class="texto_accion"> Borrar de favoritos</span>';
} else {
	$add_form_action = 'javascript:insertaFavorito(' . $idUserVisitado . ')';
	$add_image = '<input type="image" class="add_image" src="recursos/imagenes/add.png"/><span class="texto_accion"> A&ntilde;adir a favoritos</span>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<title>Sotneve - <?php echo $camposUsuario['alias'];?></title>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="estilos/info_usuario.css"/>
		<script type="text/javascript" src="../logica/scripts/buscarevento.js"></script>
		<script type="text/javascript" src="../logica/scripts/info_usuario.js"></script>
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php
		include ("head.php");
		?>

		<div class="contenido">
			<div class='lista_usuarios' id="amigos">
				<p>
					<?php
					$titulo = sprintf('<strong class="num_usuarios">Favoritos de %s:</strong>', $camposUsuario['alias']);

					echo $titulo;
					?>
					<br />
					<?php

					//Comprobamos si tiene o no favoritos
					if (empty($favoritos))
						echo '<span> Actualmente no hay favoritos </span>';

					foreach ($favoritos as $fav) {
						$span = sprintf("<a class='enlaceEnmarcado' href='info_usuario.php?idUsuario=%s'>%s</a>\n\t\t", $fav['idUsuario2'], $fav['alias']);
						echo $span;
					}
					?>
				</p>
			</div>
			<div id="acciones_usuario">
				<form id="add_form" method="post" action='<?php echo $add_form_action ?>'>
					<div id='add_to_favs'>
						<?php echo $add_image
						?>
					</div>
				</form>
				<?php
				$form = sprintf('
<form method="post" id="rate_form" action="javascript:valoraUsuario(%s)">
<div id="rate_user">
<input type="image" class="add_image" src="recursos/imagenes/valoracion.png" />
<span id="valora" class="texto_accion">&iexcl;Punt&uacute;alo!</span>
</div>
</form>', $idUserVisitado);
				echo $form;
				?>
			</div>
			<span class="h1"><?php echo $camposUsuario['alias']
				?></span>
			<?php

			$novisible = "No Disponible";
			$nombre = $novisible;
			$apellidos = $novisible;
			$sexo = $novisible;
			$fechaNac = $novisible;
			$email = $novisible;
			$provincia = $novisible;

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

			if ($camposUsuario['visibilidad'] & $PROVINCIA) {
				$provincia = $provActual['nombre'];
			}

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
				<div class='data_row'>
					<span class="l_usuario"> Valoraci&oacute;n: </span>
					<span id='val' class="c_usuario"> <?php
					if (!is_numeric($valoracion)) {
						echo("Sin puntuar");
					} else {
						echo number_format($valoracion, 2, '.', ',');
					}
						?></span>
				</div>
			</div>
		</div>
		<?php
		include 'footer.php';
		?>
	</body>
</html>
