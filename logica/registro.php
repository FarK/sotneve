<?php
session_start();
include_once ("../datos/conexion.php");
include_once ("../datos/usuario.php");
include_once ("validador.php");


//Crear objeto gestor bd
$conexion = new Conexion();
$usuario = new Usuario($conexion);

//Comprobamos que los se han pasado todos los campos
if(!(
	isset($_POST['alias'])		&&
	isset($_POST['sexo'])		&&
	isset($_POST['nombre'])		&&
	isset($_POST['apellidos'])	&&
	isset($_POST['contrasena'])	&&
	isset($_POST['recontrasena'])	&&
	isset($_POST['email'])		&&
	isset($_POST['dia'])		&&
	isset($_POST['mes'])		&&
	isset($_POST['ano'])		&&
	isset($_POST['provincia'])
)){
	$_SESSION['error'] = 'POSTError';
	$_SESSION['debug'] = 'No se han recibido los POSTs correctos';
	header("Location: ../presentacion/errores.php");
	exit;
}

//Comporbamos si existen el alias y el email  
$exAlias = $usuario->existeAlias($_POST['alias']);
$exEmail = $usuario->existeEmail($_POST['email']);

if (esValido($_POST, $usuario) && !$exAlias && !$exEmail){
	//Vaciamos los campos en _SESSION para que no reaparezcan
	$_SESSION['alias'] = '';
	$_SESSION['nombre'] = '';
	$_SESSION['apellidos'] = '';
	$_SESSION['email'] = '';

	//Cambiamos la fecha al formato que usa la BD
	$fechanac = sprintf('%s-%s-%s', $_POST['ano'], $_POST['mes'], $_POST['dia']);

	//Insertamos los usuarios
	$usuario -> insertarUsuario($fechanac, $_POST['sexo'], $_POST['email'], $_POST['alias'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['provincia']);
	$id = $conexion->getLastInsertId();

	$_SESSION['idUsuario'] = $id;
	header("Location:../presentacion/principal.php");
	exit;
	echo '<span>bien</span>';
}
else{
	//Seteamos los campos en _SESSION para que reaparezcan
	$_SESSION['alias'] = $_POST['alias'];
	$_SESSION['nombre'] = $_POST['nombre'];
	$_SESSION['apellidos'] = $_POST['apellidos'];
	$_SESSION['email'] = $_POST['email'];

	//Seteamos el erro a la opción adecuada
	$_SESSION['err_registro'] = 0;
	if($exAlias)
		$_SESSION['err_registro'] = 1;
	if($exEmail)
		$_SESSION['err_registro'] = $_SESSION['err_registro'] | 2;

	header("Location:../presentacion/registro.php");
	exit;
}

$conexion -> desconectar();

function esValido($_POST, $usuario) {
	return	Validador::palabra($_POST['alias'])		&&
		($_POST['sexo'] == 0 || $_POST['sexo'] == 1)	&&
		Validador::palabras($_POST['nombre'])		&&
		Validador::palabras($_POST['apellidos'])	&&
		Validador::passNueva($_POST['contrasena'],
				$_POST['recontrasena'])		&&
		Validador::email($_POST['email'])		&&
		Validador::fechaPasada($_POST['dia'],
				$_POST['mes'],
				$_POST['ano'])			&&
		Validador::idProvincia($_POST['provincia'])
	;
}
?> 
