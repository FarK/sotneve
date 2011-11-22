<?php
include_once ("BD/usuario.php");

//Creamos el objeto usuario del usuario conectado
$usuario = new Usuario($_SESSION['idUsuario']);
//Comprobar si ha habido errores
if ($usuario -> error() == -2)//No pudo conectar
	header('Location:index.php?err_bd');
//Redirecconar con GET a error

$id=$_SESSION['idUsuario'];
$enlace=sprintf("'favoritos.php?idUsuario=%s'",$id);
?>

<div id="hcabecera">
	<div id="hlogo">
		<IMG SRC="images/logo.jpg" ALT="Inicio">
	</div>
	<div id="husuario">
		<span>hola, <?php echo $usuario -> getCampo("nombre") . " " . $usuario -> getCampo("apellidos");?></span>
	</div>
	<div id="hbotones">
		<a class="boton"  id="hinicio" href="principal.php">Inicio</a>
		<a class="boton" href=<?php echo $enlace ?>>Favoritos</a>
		<a class="boton" href="evento.css">Mi perfil</a>
		<a class="boton" href="formulario.xhtml">Logout</a>
	</div>

		<?php
		include ("buscarevento.php");
		?>

</div>
