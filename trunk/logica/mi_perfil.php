<?php
include ("test_session.php");
include_once ("../datos/conexion.php");
include_once ("../datos/usuario.php");
include_once ("../datos/provincia.php");

$conex = new Conexion();
$prov = new Provincia($conex);

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fechaNac = $_POST['fechanac'];
$email = $_POST['email'];
$provincia = $_POST['provincia'];
$sexo = $_POST['sexo'];
$passActual = $_POST['contrasenaactual'];
$passNueva = $_POST['contrasena'];
$passNueva2 = $_POST['recontrasena'];

//TODO Obtener y actualizar checkboxes
$cbNombre = $_POST['checkNombre'];
$cbApellidos = $_POST['checkApellidos'];
$cbFechaNac = $_POST['checkFechaNac'];
$cbEmail = $_POST['checkEmail'];
$cbProvincia = $_POST['checkProvincia'];
$cbSexo = $_POST['checkSexo'];

$existeProvincia = $prov -> existeProvincia($provincia);
$visibilidad = visibilidad();
$valido = esValido($nombre, $apellidos, $fechaNac, $email, $passActual, $passNueva, $passNueva2);
//TODO Comprobar provincia, y checkboxes
if ($valido) {

	$id = $_SESSION['idUsuario'];
	//TODO actualiza usuario con SESSION->idUsuario y valores del perfil

	header("Location:../presentacion/mi_perfil.php");
}
$conex -> desconectar();

function visibilidad() {
	if ($cbNombre)
		$nombreVisible = $NOMBRE;
	else
		$nombreVisible = 0;
	if ($cbApellidos)
		$apellidosVisible = $APELLIDOS;
	else
		$apellidosVisible = 0;
	if ($cbFechaNac)
		$fechaNacVisible = $FECHANAC;
	else
		$fechaNacVisible = 0;
	if ($cbEmail)
		$emailVisible = $EMAIL;
	else
		$emailVisible = 0;
	if ($cbProvincia)
		$provinciaVisible = $PROVINCIA;
	else
		$provinciaVisible = 0;
	if ($cbSexo)
		$sexoVisible = $SEXO;
	else
		$sexoVisible = 0;
	return $nombreVisible | $apellidosVisible | $fechaNacVisible | $emailVisible | $provinciaVisible | $sexoVisible;
}

function esValido($nombre, $apellidos, $fechaNac, $email, $provincia, $sexo, $passActual, $passNueva, $passNueva2) {
	$valido = true;
	/******** COMPROBACIÓN CAMPOS VACÍOS *********/
	if ($nombre == "" || $apellidos == "" || $fechaNac == "" || $email == "" || $provincia == '' || $sexo == '') {
		$camposvacios = true;
		$_SESSION['err_campos_perfil'] = true;
		$valido = false;
	}
	/******** FIN COMPROBACIÓN CAMPOS VACÍOS *********/

	/******** COMPROBACIÓN NOMBRE/APELLIDOS *********/
	$patronNomApe = "/^[[[:space:]][[:alpha:]]]+$/";
	if (!preg_match($patronNomApe, $nombre) || !preg_match($patronNomApe, $apellidos)) {
		$valido = false;
	} elseif (strlen($nombre) > 30 || strlen($apellidos) > 60) {
		$valido = false;
	}
	/******** FIN COMPROBACIÓN NOMBRE/APELLIDOS *********/

	/******** COMPROBACIÓN FECHA NACIMIENTO *********/
	$patronFecha = "/^([[:digit:]]{2}\/){2}[[:digit:]]{4}$/";

	if (!preg_match($patronFecha, $fechaNac)) {
		$valido = false;
	} else {

		$dia = substr($fechaNac, 0, 2);
		$mes = substr($fechaNac, 3, 2);
		$ano = substr($fechaNac, 6, 4);

		$diamax = 0;

		if ($mes > 0 && $mes < 13 && strlen($fechaEvento) == 10) {
			//La fecha es correcta (No contemplamos bisiestos ni los años)
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
			if ($dia < 1 || $dia > $diamax) {
				$valido = false;
			}
			//Comprobación de que la fecha no es posterior a la fecha actual
			if ($ano > date("Y")) {
				$valido = false;
			} elseif ($ano == date("Y")) {
				if ($mes > date("m")) {
					$valido = false;
				} elseif ($mes == date("m")) {
					if ($dia > date("d")) {
						$valido = false;
					}
				}
			}
		} else {
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

	// TODO Comprobar contraseñas

	/******* FIN COMPROBACIÓN CONTRASEÑAS *******/

	if ($valido) {
		return true;
	} else {
		header("Location:../presentacion/mi_perfil.php");
	}

}
?> 