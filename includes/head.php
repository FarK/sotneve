<?php
	include ("includes/testSession.php");
	include_once("BD/usuario.php");

	//Creamos el objeto usuario del usuario conectado
	$usuario = new Usuario($_SESSION['idUsuario']);
	//Comprobar si ha habido errores
	if($usuario->error() == -2) //No pudo conectar
		header('Location:index.php?err_bd');	//Redirecconar con GET a error
?>

<div id="cabecera">
	<div id="logo">
		<h1>logo</h1>
	</div>
	<div id="usuario">
	<span>hola, <?php echo $usuario->getCampo("nombre")." ".$usuario->getCampo("apellidos"); ?>;</span>
	<a id="linkperfil" href="evento.css">Mi perfil</a>
	<a href="formulario.xhtml">Logout</a>
	</div>
</div>
