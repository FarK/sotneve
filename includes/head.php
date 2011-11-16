<?php
include_once ("BD/usuario.php");

//Creamos el objeto usuario del usuario conectado
$usuario = new Usuario($_SESSION['idUsuario']);
//Comprobar si ha habido errores
if ($usuario -> error() == -2)//No pudo conectar
	header('Location:index.php?err_bd');
//Redirecconar con GET a error
?>

<div id="hcabecera">
	<div id="hlogo">
		<h1>logo</h1>
	</div>
	<div id="husuario">
		<span>hola, <?php echo $usuario -> getCampo("nombre") . " " . $usuario -> getCampo("apellidos");?>;</span>
	</div>
	<div id="hbotones">
		<a id="hinicio" href="principal.php">Inicio</a>
		<a id="hfavoritos" href="favoritos.php">Favoritos</a>
		<a id="hlinkperfil" href="evento.css">Mi perfil</a>
		<a href="formulario.xhtml">Logout</a>
	</div>

		<?php
		include ("buscarevento.php");
		?>

</div>
