<?php
include 'test_session.php';
include_once '../datos/conexion.php';
include_once '../datos/usuario.php';

$idUser = $_SESSION['idUsuario'];
$idFav = $_GET['idFav'];
$conex = new Conexion();
$user = new Usuario($conex, $idUser);

$user->borraFavorito($idFav);
$favoritos = $user->getFavoritos();

$enlaces = "";

foreach($favoritos as $fav){
	$echo = sprintf("
			<div class='favorito'>
				<a class='favorito' href='info_usuario.php?idUsuario=%s'>%s</a>
				<span class='espacioBlanco'></span>
				<form class='favorito' action='javascript:borraFavorito(%s)'>
					<input id='delete' type='image' src='recursos/imagenes/delete.png'></input>
				</form>
			</div>", $fav['idUsuario2'], $fav['alias'], $fav['idUsuario2']);
	$enlaces = $enlaces . $echo;
}

echo $enlaces;

$conex->desconectar();
?>
