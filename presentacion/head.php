<?php
include_once ("../datos/usuario.php");
include_once ("../datos/conexion.php");

$id = $_SESSION['idUsuario'];
//Creamos el objeto usuario del usuario conectado
$conex = new Conexion();
$usuario = new Usuario($conex, $id);

$usuario -> prepCampo("nombre");
$result = $usuario -> consultarCampos();
$nombre = $result['nombre'];

$hvaloracion = $usuario -> getValoracion();
if ($hvaloracion == -1) {
	$hvaloracion = "Sin datos";
}
//Ceramos conexión
$conex -> desconectar();

$presentacion = array();
preg_match('/\/.+\/presentacion/', $_SERVER['SCRIPT_NAME'], $presentacion);
$presentacion = $presentacion[0];
$paginas = array('principal' => $presentacion . '/principal.php', 'crear_evento' => $presentacion . '/crear_evento.php', 'favoritos' => $presentacion . '/favoritos.php', 'mi_perfil' => $presentacion . '/mi_perfil.php', 'logout' => $presentacion . '/logout.php');

function claseEnlace($paginas, $indice) {
	if ($paginas[$indice] == $_SERVER['PHP_SELF'])
		echo 'class = "botonResaltado"';
	else
		echo 'class = "boton"';
}
?>

<div id="hcabecera">
	<a id='enlaceLogo' href="principal.php"><img id='logo' src="recursos/imagenes/logoHead.png" alt="Inicio"></img></a>
	<div id="hbotones">
		<a <?php claseEnlace($paginas, 'principal');?>  id="hinicio" href="principal.php">Inicio</a>
		<a <?php claseEnlace($paginas, 'crear_evento');?>  id ="creaEvento" href="crear_evento.php">Crear Evento</a>
		<a <?php claseEnlace($paginas, 'favoritos');?> href="favoritos.php">Favoritos</a>
		<a <?php claseEnlace($paginas, 'mi_perfil');?> href="mi_perfil.php">Mi perfil</a>
		<a <?php claseEnlace($paginas, 'logout');?> href="../logica/logout.php">Logout</a>
	</div>
	<div id="husuario">
		<span>Hola, <?php echo $nombre;?></span>
		<br/>
		<span>Puntos: <?php
		if (!is_numeric($valoracion)) {
			echo("n/a");
		} else {
			echo number_format($valoracion, 2, '.', ',');
		}
			?></span>
	</div>
	<?php
		include ("buscador.php");
	?>
</div>
