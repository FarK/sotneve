<?php
include ("test_session.php");
include_once ("../datos/conexion.php");
include_once ("../datos/usuario.php");
include_once ("../datos/provincia.php");

$conex = new Conexion();
$prov = new Provincia($conex);
$usuario = new Usuario($conex, $_SESSION['idUsuario']);
$usuario -> prepCampo('email');
$usuario -> prepCampo('pass');

$camposUsuario = $usuario -> consultarCampos();
$emailUsuario = $camposUsuario['email'];
$passUsuario = $camposUsuario['pass'];

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$email = $_POST['email'];
$provincia = $_POST['provincia'];
$sexo = $_POST['sexo'];
$passActual = $_POST['contrasenaactual'];
$passNueva = $_POST['contrasena'];
$passNueva2 = $_POST['recontrasena'];

$cbVisib = array(
'cbNombre' => $_POST['check' . $NOMBRE], 
'cbApellidos' => $_POST['check' . $APELLIDOS], 
'cbFechaNac' => $_POST['check' . $FECHA_NAC], 
'cbEmail' => $_POST['check' . $EMAIL], 
'cbProvincia' => $_POST['check' . $PROVINCIA], 
'cbSexo' => $_POST['check' . $SEXO], );

$visibilidad = visibilidad($cbVisib);
$valido = esValido($nombre, $apellidos, $dia, $mes, $ano, $email, $provincia, $sexo, $passActual, $passNueva, $passNueva2, $passUsuario);

if ($valido && $prov -> existeProvincia($provincia) && (!$usuario -> existeEmail($email) || $email == $emailUsuario)) {
	$fechaNac = $ano . '-' . $mes . '-' . $dia;
	if ($passNueva == '') {
		$usuario -> actualizarUsuarioSinPass($fechaNac, (int)$sexo, $email, $nombre, $apellidos, $provincia, $visibilidad);
	} else
		$usuario -> actualizarUsuarioConPass($fechaNac, (int)$sexo, $email, $passNueva, $nombre, $apellidos, $provincia, $visibilidad);
	$_SESSION['OK']=true;
	header("Location:../presentacion/mi_perfil.php");

}
$conex -> desconectar();

function visibilidad($cbVisib) {
	if ($cbVisib['cbNombre'])
		$nombreVisible = $GLOBALS['NOMBRE'];
	else
		$nombreVisible = 0;
	if ($cbVisib['cbApellidos'])
		$apellidosVisible = $GLOBALS['APELLIDOS'];
	else
		$apellidosVisible = 0;
	if ($cbVisib['cbFechaNac'])
		$fechaNacVisible = $GLOBALS['FECHA_NAC'];
	else
		$fechaNacVisible = 0;
	if ($cbVisib['cbEmail'])
		$emailVisible = $GLOBALS['EMAIL'];
	else
		$emailVisible = 0;
	if ($cbVisib['cbProvincia'])
		$provinciaVisible = $GLOBALS['PROVINCIA'];
	else
		$provinciaVisible = 0;
	if ($cbVisib['cbSexo'])
		$sexoVisible = $GLOBALS['SEXO'];
	else
		$sexoVisible = 0;
	return $nombreVisible | $apellidosVisible | $fechaNacVisible | $emailVisible | $provinciaVisible | $sexoVisible;
}

function esValido($nombre, $apellidos, $dia, $mes, $ano, $email, $provincia, $sexo, $passActual, $passNueva, $passNueva2, $passUsuario) {
	$valido = true;

	/******** COMPROBACIÓN CAMPOS VACÍOS *********/
	if ($nombre == "" || $apellidos == "" || $dia == "" || $mes == "" || $ano == "" || $email == "" || $provincia == "" || $sexo == "") {
		$camposvacios = true;
		$_SESSION['err_campos_perfil'] = true;
		$valido = false;
	}
	/******** FIN COMPROBACIÓN CAMPOS VACÍOS *********/

	/******** COMPROBACIÓN NOMBRE/APELLIDOS *********/
	$patronNomApe = "/^([[:space:]][[:alpha:]]|[[:alpha:]])+$/";
	if (!preg_match($patronNomApe, $nombre) || !preg_match($patronNomApe, $apellidos)) {
		$valido = false;
	} elseif (strlen($nombre) > 30 || strlen($apellidos) > 60) {
		$valido = false;
	}
	/******** FIN COMPROBACIÓN NOMBRE/APELLIDOS *********/

	/******** COMPROBACIÓN FECHA NACIMIENTO *********/

	$diamax = 0;
	if ($mes < 1 && $mes > 12) {
		$valido = false;
	} else {//Comprobación de que la fecha no es posterior a la fecha actua
		if ($ano > date("Y")) {
			$valido = false;
		} else if ($ano == date("Y")) {
			if ($mes > date("m")) {
				$valido = false;

			} elseif ($mes == date("m")) {
				if ($dia > date("d")) {
					$valido = false;
				}
			}
		}
		switch ($mes) {
			case '2' :
				if ((($ano % 4 == 0) && ($ano % 100 != 0)) || (($ano % 100 == 0) && ($ano % 400 == 0))) {//Contemplo año bisiesto.
					$diamax = 29;
				} else {
					$diamax = 28;
				}
				break;
			case 04 || 06 || 11 || 09 :
				$diamax = 30;
				break;
			case 01 || 03 || 05 || 07 || 08 || 10 || 12 :
				$diamax = 31;
				break;
		}
		if ($dia < 1 || $dia > $diamax) {
			$valido = false;
		}

	}

	/******* FIN COMPROBACIÓN FECHA NACIMIENTO *******/

	/******* COMPROBACIÓN EMAIL *******/
	$patronEmail = "/^\w+@\w+\.\w+$/";
	if (!preg_match($patronEmail, $email)) {
		$valido = false;
	}
	/******* FIN COMPROBACIÓN EMAIL *******/

	/******* COMPROBACIÓN CONTRASEÑAS *******/
	if ($passNueva != "") {
		if (strlen($passNueva) < 6) {
			$valido = false;
		} elseif ($passNueva != $passNueva2) {
			$valido = false;
		} elseif (hash("sha256", $passActual) != $passUsuario){
			$valido= false;
		}
	}

	/******* FIN COMPROBACIÓN CONTRASEÑAS *******/

	if ($valido) {
		return true;

	} else {
		$_SESSION['err_campos_perfil'] = true;
		header("Location:../presentacion/mi_perfil.php");
	}

}
?> 