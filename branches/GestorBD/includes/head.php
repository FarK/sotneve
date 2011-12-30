<?php
session_start();
if(!isset($_SESSION['idUsuario'])){
	header("Location:../index.php");
}		
include_once ("../BD/usuario.php");
include_once ("../BD/conexion.php");

$id = $_SESSION['idUsuario'];
//Creamos el objeto usuario del usuario conectado
$conex = new Conexion();
$usuario = new Usuario($conex, $id);

$enlaceFavorito=sprintf("'favoritos.php?idUsuario=%s'",$id);
$usuario->prepCampo("nombre");
$result = $usuario->consultarCampos();
$nombre = $result['nombre'];
?>

<div id="hcabecera">
	<div id="hlogo">
		<a href="principal.php"><img id='logo' src="images/logo.jpg" alt="Inicio"></img></a>
	</div>
	<div id="husuario">
		<span>Hola, <?php echo $nombre;?></span>
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
