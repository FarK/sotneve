<?php
include 'test_session.php';
include_once '../datos/conexion.php';
include_once '../datos/usuario.php';

$idUser = $_SESSION['idUsuario'];
$idFav = $_GET['idFav'];
$conex = new Conexion();
$user = new Usuario($conex, $idUser);

$user->insertaFavorito($idFav);

$conex->desconectar();
?>