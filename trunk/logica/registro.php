<?php
include_once 'BD/conexion.php';
include_once ("BD/usuario.php");
include_once ("BD/utiles.php");
include_once ("BD/provincia.php");
//Crear objeto gestor bd
$conexion = new Conexion();
$usuario = new Usuario($conexion);
$utiles = new Utiles($conexion);
$provincia = new Provincia($conexion);

// $fechanac = $bd -> escapeString($_POST['fechanac']);
// $sexo = $bd -> escapeString($_POST['sexo']);
// $email = $bd -> escapeString($_POST['email']);
// $alias = $bd -> escapeString($_POST['alias']);
// $contrasena = $bd -> escapeString($_POST['contrasena']);
// $nombre = $bd -> escapeString($_POST['nombre']);
// $apellidos = $bd -> escapeString($_POST['apellidos']);
//
// $provincia = $bd -> escapeString($_POST['provincia']);
// $recontrasena = $bd -> escapeString($_POST['recontrasena']);

$fechanac = $_POST['fechanac'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$alias = $_POST['alias'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$prov = $_POST['provincia'];
$recontrasena = $_POST['recontrasena'];

$valido = esValido($provincia,$usuario, $email, $contrasena, $recontrasena, $prov, $nombre, $apellidos, $sexo, $fechanac, $alias);

$fechanac = dmaToamd($fechanac);
//Convertimos la fecha a AAAA-MM-DD para poder meterla en la BD

//$sexo = sexoToInt($sexo);
//pasa Hombre a 1 y Mujer a 0

if ($valido) {
	$usuario -> insertarUsuario($fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos, $prov);
	$aux = sprintf("Location:index.php?mens=Registrado con exito. %s", $prov);
//	header($aux);
}
$conexion -> desconectar();

function esValido($provincia, $usuario, $email, $contrasena, $recontrasena, $prov, $nombre, $apellidos, $sexo, $fechanac, $alias) {
	$valido = true;
	
	$resultadoEmail = $usuario -> existeEmail($email);
	$resultadoAlias = $usuario -> existeAlias($alias);
	$resultadoProvincia = $provincia -> existeProvincia($prov);
		
	//TODO Gestionar correctamente errores
	//Hay error si...
	$camposvacios = false;
	//En algunos if se podria hacer que si ya hay alguno que no es valido lo comprobara, todos no porque algunos tienen que añadir el error indicado

	if ($email == "" || $contrasena == "" || $nombre == "" || $apellidos == "") {//OK
		$camposvacios = true;
		$_SESSION['err_campos'] = true;
		$valido = false;
	}
	//TODO Validar el email con expresiones regulares.
	
	if (!$camposvacios && $resultadoEmail) {//OK
		$_SESSION['err_email'] = true;
		$valido = false;
	}

	if (!$camposvacios && ($contrasena != $recontrasena || strlen($contrasena) < 6 || strlen($contrasena) > 15)) {//No entra en el if
		$_SESSION['err_contrasena'] = true;
		$valido = false;
	}

	//Nombre y apellidos, validados como campos no vacios

	if ($sexo != '1' && $sexo != '0') {
		$valido = false;
	}
	$dia = substr($fechanac, 0, 2);
	$mes = substr($fechanac, 3, 2);
	$ano = substr($fechanac, 6, 9);

	$diamax = 0;
	//No contemplamos bisiestos ni los años

	if ($mes > 0 && $mes < 13 && strlen($fechanac) == 10) {//con == 10 hacemos que sea de la forma dd/mm/aaaa
		switch ($mes) {
			case '2' :
				$diamax = 28;
				break;

			case 04 || 06 || 11 || 09 :
				$diamax = 30;
				break;
			case 01 || 03 || 05 || 07 || 08 || 10 || 12 :
				$diamax = 31;
				break;
			default :
				break;
		}
		if ($dia < 1 && $dia > $diamax) {
			$valido = false;
		}

	} else {
		$valido = false;
	}
	if (!$camposvacios && ($resultadoAlias || strlen($alias) > 60 || strlen($alias) < 3)) {//OK
		$valido = false;
	}

	if ($prov == 0) {
		$_SESSION['err_campos'] = true;
		$valido = false;
	} elseif (!$camposvacios) {
		
	
		if(!$resultadoProvincia) {
		$_SESSION['err_campos'] = true;
		$valido=false;
		}

	}

	if ($valido) {
		return true;
	} else {//TODO indicar los motivos por los que se a vuelto a registro.php mediante $_SESSION
		header("Location:registro.php");
	}


}

function dmaToamd($fecha) {
	$dia = substr($fecha, 0, 2);
	$mes = substr($fecha, 3, 2);
	$ano = substr($fecha, 6, 9);

	$fecha = $ano . "-" . $mes . "-" . $dia;

	return $fecha;
}

function sexoToInt($sexo) {// TODO no se usa ya, lo borraremos cuando estemos 100% seguro
	if ($sexo == 'Hombre') {
		$sexo = 1;
		return $sexo;
	} elseif ($sexo == 'Mujer') {
		$sexo = 0;
		return $sexo;
	}
}
?> 
