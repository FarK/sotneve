	<?php
include_once ("BD/usuario.php");

//Creamos el objeto usuario del usuario conectado
$usuario = new Usuario($_SESSION['idUsuario']);
//Comprobar si ha habido errores
if ($usuario -> error() == -2)//No pudo conectar
	header('Location:index.php?err_bd');
//Redirecconar con GET a error

$id=$_SESSION['idUsuario'];
$enlaceFavorito=sprintf("'favoritos.php?idUsuario=%s'",$id);
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
		<a class="boton"  id ="creaEvento" href="crearEvento.php">Crear Evento</a>
		<a class="boton" href=<?php echo $enlaceFavorito ?>>Favoritos</a>
		<a class="boton" href="editaUsuario.php">Mi perfil</a>
		<a class="boton" href="logout.php">Logout</a>
		
	</div>

		<?php
		include ("buscarevento.php");
		?>

</div>
