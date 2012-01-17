<?php
include ("test_session.php");
include_once ("../datos/conexion.php");
include_once ("../datos/evento.php");
include_once ("../datos/usuario.php");
include_once ("validador.php");

$conex = new Conexion();
$evento = new Evento($conex);

//Comprobamos que los se han pasado todos los campos
if(!(
	isset($_POST['nomevento'])	&&
	isset($_POST['numpersonas'])	&&
	isset($_POST['dia'])		&&
	isset($_POST['mes'])		&&
	isset($_POST['ano'])		&&
	isset($_POST['hora'])		&&
	isset($_POST['min'])		&&
	isset($_POST['provincia'])	&&
	isset($_POST['tipos'])		&&
	isset($_POST['lugar'])		&&
	isset($_POST['descripcion'])	&&
	isset($_POST['actualizar'])
)){
	$_SESSION['error'] = 'No se han recibido los POSTs correctos';
	header("Location: ../presentacion.errores.php");
	exit;
}

//Comprobamos el formulario y actualizamos/insertamos el evento
if (esValido($_POST)) {
	$fechaEvento = sprintf('%s-%s-%s %s:%s:00', $_POST['ano'], $_POST['mes'], $_POST['dia'], $_POST['hora'], $_POST['min']);

	if ($_POST['actualizar'] == -1) {
		$evento -> insertarEvento(
			$_POST['tipos'],
			$fechaEvento,
			$_POST['nomevento'],
			$_POST['numpersonas'],
			$_POST['provincia'],
			$_POST['descripcion'],
			$_POST['lugar'],
			$_SESSION['idUsuario']);

		$id = $conex -> getLastInsertId();
		$evento -> inscribeUsuario($_SESSION['idUsuario'], $id);
	} else {
		$evento -> actualizarEvento(
			$_POST['tipos'],
			$fechaEvento,
			$_POST['nomevento'],
			$_POST['numpersonas'],
			$_POST['provincia'],
			$_POST['descripcion'],
			$_POST['lugar'],
			$_SESSION['idUsuario'],
			$_POST['actualizar']);

		//TODO: Vulnerabilidad: Creo que cualquiera puede actualizar el evento de otro a través de este post
		$id = $_POST['actualizar'];
	}

	header(sprintf("Location:../presentacion/info_evento.php?idEvento=%s", $id));
	exit;
} else {
	$_SESSION['err_campos_crearEvento'] = true;
	if ($_POST['actualizar'] == -1){
		header(sprintf("Location:../presentacion/crear_evento.php", $actualizar));
		exit;
	}else{
		header("Location:../presentacion/crear_evento.php");
		exit;
	}
}

$conex -> desconectar();


function esValido($_POST) {
	return	Validador::palabras($_POST['nomevento'])	&&
		Validador::cifra($_POST['numpersonas'])		&&
		($_POST['numpersonas'] >= 2)			&&
		Validador::fechaFutura($_POST['dia'],
			$_POST['mes'],
			$_POST['ano'])				&&
		Validador::hora($_POST['hora'], $_POST['min'])	&&
		Validador::idProvincia($_POST['provincia'])	&&
		($_POST['tipos'] >= 1)
	;
}
?>
