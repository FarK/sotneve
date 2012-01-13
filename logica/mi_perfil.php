<?php
include ("test_session.php");
include_once ("../datos/conexion.php");
include_once ("../datos/usuario.php");
include_once ("../datos/provincia.php");
include_once ("validador.php");

$conex = new Conexion();
$prov = new Provincia($conex);
$usuario = new Usuario($conex, $_SESSION['idUsuario']);

$usuario -> prepCampo('email');
$usuario -> prepCampo('pass');
$usuario -> prepCampo('visibilidad');
$camposUsuario = $usuario -> consultarCampos();

//Comprobamos que los se han pasado todos los campos
if(!(
	isset($_POST['nombre'])			&&
	isset($_POST['apellidos'])		&&
	isset($_POST['dia'])			&&
	isset($_POST['mes'])			&&
	isset($_POST['ano'])			&&
	isset($_POST['email'])			&&
	isset($_POST['provincia'])		&&
	isset($_POST['sexo'])			&&
	isset($_POST['contrasenaactual'])	&&
	isset($_POST['contrasena'])		&&
	isset($_POST['recontrasena'])
))
	//TODO: Redirigir a error
	echo "ERROR: no se han pasado bien los post";

$visibilidad = 0;
//Pasamos la visibilidad al formato de la BD
if(isset($_POST['check' . $NOMBRE]))
	$visibilidad = $visibilidad | (int)$_POST['check' . $NOMBRE];

if(isset($_POST['check' . $APELLIDOS]))
	$visibilidad = $visibilidad | (int)$_POST['check' . $APELLIDOS];

if(isset($_POST['check' . $FECHA_NAC]))
	$visibilidad = $visibilidad | (int)$_POST['check' . $FECHA_NAC];

if(isset($_POST['check' . $EMAIL]))
	$visibilidad = $visibilidad | (int)$_POST['check' . $EMAIL];

if(isset($_POST['check' . $PROVINCIA]))
	$visibilidad = $visibilidad | (int)$_POST['check' . $PROVINCIA];

if(isset($_POST['check' . $SEXO]))
	$visibilidad = $visibilidad | (int)$_POST['check' . $SEXO];

//Añadimos la contraseña actual de la BD al array _POST para pasarselo a esValido
$_POST['passBD'] = $camposUsuario['pass'];

//Comprobamos que el formulario es válido, que la provincia realmente existe y que el email no está ya en uso

if(esValido($_POST) &&
	$prov->existeProvincia($_POST['provincia']) &&
	(!$usuario->existeEmail($_POST['email']) || $_POST['email'] == $camposUsuario['email']))
{
	$fechaNac = $_POST['ano']. '-' . $_POST['mes']. '-' . $_POST['dia'];
	if ($_POST['contrasena'] == '')
		$usuario->actualizarUsuarioSinPass(
			$fechaNac,
			(int)$_POST['sexo'],
			$_POST['email'],
			$_POST['nombre'],
			$_POST['apellidos'],
			$_POST['provincia'],
			$visibilidad);
	else
		$usuario->actualizarUsuarioConPass(
			$fechaNac,
			(int)$_POST['sexo'],
			$_POST['email'],
			$_POST['contrasena'],
			$_POST['nombre'],
			$_POST['apellidos'],
			$_POST['provincia'],
			$visibilidad);

	$_SESSION['OK']=true;
	header("Location:../presentacion/mi_perfil.php");

}
else{
	$_SESSION['err_campos_perfil'] = true;
	header("Location:../presentacion/mi_perfil.php");
}
$conex -> desconectar();

function esValido($_POST) {
	return	Validador::palabras($_POST['nombre'])					&&
		Validador::palabra($_POST['apellidos'])					&&
		Validador::email($_POST['email'])					&&
		Validador::fechaPasada($_POST['dia'], $_POST['mes'], $_POST['ano'])	&&
		Validador::changePass($_POST['contrasenaactual'],
			$_POST['passBD'],
			$_POST['contrasena'],
			$_POST['recontrasena'])
	;
}
?> 
