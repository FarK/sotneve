<?php
session_start();
include_once ("../datos/conexion.php");
include_once ("../datos/usuario.php");
include_once ("../datos/provincia.php");
//Crear objeto gestor bd
$conexion = new Conexion();
$usuario = new Usuario($conexion);
$provincia = new Provincia($conexion);


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
	$id = $conexion->getLastInsertId();
	$_SESSION['idUsuario'] = $id;
	header("Location:../presentacion/principal.php");
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

	if ($email == "" || $contrasena == "" || $nombre == "" || $apellidos == "") {//OK
		$camposvacios = true;
		$_SESSION['err_campos'] = true;
		$valido = false;
	}
	
	if (!$camposvacios && $resultadoEmail) {//OK
		$_SESSION['err_email'] = true;
		$valido = false;
	}

	if (!$camposvacios && ($contrasena != $recontrasena || strlen($contrasena) < 6 || strlen($contrasena) > 15)) {//No entra en el if
		$_SESSION['err_contrasena'] = true;
		$valido = false;
	}


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
		header("Location:../presentacion/registro.php");
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
