<?php
include_once ("../datos/usuario.php");
include_once ("../datos/conexion.php");

$id = $_SESSION['idUsuario'];
//Creamos el objeto usuario del usuario conectado
$conex = new Conexion();
$usuario = new Usuario($conex, $id);

$enlaceFavorito=sprintf("'favoritos.php?idUsuario=%s'",$id);
$usuario->prepCampo("nombre");
$result = $usuario->consultarCampos();
$nombre = $result['nombre'];

//Ceramos conexión
$conex->desconectar();
?>

<div id="hcabecera">
	<div id="hlogo">
		<a href="principal.php"><img id='logo' src="recursos/imagenes/logo.png" alt="Inicio"></img></a>
	</div>
	<div id="husuario">
		<span>Hola, <?php echo $nombre;?></span>
	</div>
	<div id="hbotones">
		<a class="boton"  id="hinicio" href="principal.php">Inicio</a>
		<a class="boton"  id ="creaEvento" href="crear_evento.php">Crear Evento</a>
		<a class="boton" href=<?php echo $enlaceFavorito ?>>Favoritos</a>
		<a class="boton" href="mi_perfil.php">Mi perfil</a>
		<a class="boton" href="../logica/logout.php">Logout</a>
		
	</div>

		<?php
		include ("buscar_evento.php");
		?>

</div>
