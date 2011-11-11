<?php
include_once ('BD/GestorBD.php');

$bd = new GestorBD();

if ($bd -> conectar()) {

	$fechanac = $bd -> escapeString($_POST['fechanac']);
	$sexo = $bd -> escapeString($_POST['sexo']);
	$email = $bd -> escapeString($_POST['email']);
	$alias = $bd -> escapeString($_POST['alias']);
	$contrasena = $bd -> escapeString($_POST['contrasena']);
	$cp = $bd -> escapeString($_POST['cp']);
	$nombre = $bd -> escapeString($_POST['nombre']);
	$apellidos = $bd -> escapeString($_POST['apellidos']);

	$provincia = $bd -> escapeString($_POST['provincia']);
	$comautonoma = $bd -> escapeString($_POST['comautonoma']);
	$recontrasena = $bd -> escapeString($_POST['recontrasena']);

	$valido = esValido($bd, $email, $contrasena, $recontrasena, $comautonoma, $provincia, $nombre, $apellidos, $sexo, $fechanac,$alias);

	$fechanac = dmaToamd($fechanac);
	//Convertimos la fecha a AAAA-MM-DD para poder meterla en la BD

	$sexo = sexoToInt($sexo);
	//pasa Hombre a 1 y Mujer a 0

	if ($valido) {
		$string = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, nombre, apellidos) 
			VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $nombre, $apellidos);
		$bd -> consulta($string);
	}

}

function esValido($bd, $email, $contrasena, $recontrasena, $comautonoma, $provincia, $nombre, $apellidos, $sexo, $fechanac, $alias) {
	$valido = true;
	$row = sprintf("SELECT * FROM usuarios WHERE email = '%s'", $email);
	$resultadoEmail = $bd -> consulta($row);
	$row = sprintf("SELECT * FROM usuarios WHERE alias = '%s'", $alias);
	$resultadoAlias = $bd -> consulta($row);
	$res = sprintf("Location:registro.php?");

	//Hay error si...
	$camposvacios = false;
	//En algunos if se podria hacer que si ya hay alguno que no es valido lo comprobara, todos no porque algunos tienen que añadir el error indicado

	if ($email == "" || $contrasena == "" || $nombre == "" || $apellidos == "") {//OK
		$camposvacios = true;
		$res = $res . '&err_campos';
	}

	if (!$camposvacios && (mysql_num_rows($resultadoEmail) > 0 || strlen($email) > 60)) {//OK
		$res = $res . '&err_email';
		$valido = false;
	}

	if (!$camposvacios && ($contrasena != $recontrasena || strlen($contrasena) < 6 || strlen($contrasena) > 15)) {//No entra en el if
		$res = $res.'&err_contrasena';
		$valido = false;
	}

	//Nombre y apellidos, validados como campos no vacios

	if ($sexo != "Hombre" || $sexo != "Mujer") {
		$valido = false;
	}
	$dia = substr($fechanac, 0, 2);
	$mes = substr($fechanac, 3, 2);
	$ano = substr($fechanac, 6, 9);

	$diamax;
	//No contemplamos visiestos ni los años
	echo $fechanac;
	if ($mes > 0 && $mes < 12) {
		switch ($mes) {
			case '2' :
				$diamax = 28;
				break;

			case 4 || 6 || 11 || 9 :
				$diamax = 30;
				break;
			case 1 || 3 || 5 || 7 || 8 || 10 || 12 :
				$diamax = 31;
				break;
			default :
				break;
		}
		if ($dia < 1 && $dia > $diamax) {
			echo ('novale');
			$valido = false;
		}

	} else {
		$valido = false;
	}
	if (!$camposvacios && (mysql_num_rows($resultadoAlias) > 0 || strlen($alias) > 60 || strlen($alias)< 6)) {//OK
		$valido=false;
	}
	
	header($res);

	// while($fila = mysql_fetch_assoc($resultado)){
	// $existe=$fila['idUsuario'];
	// if($existe=='null'){
	// $valido=false;
	// }
	// }

}

function dmaToamd($fecha) {
	$dia = substr($fecha, 0, 2);
	$mes = substr($fecha, 3, 2);
	$ano = substr($fecha, 6, 9);

	$fecha = $ano . "-" . $mes . "-" . $dia;

	return $fecha;
}

function sexoToInt($sexo) {
	if ($sexo == 'Hombre') {
		$sexo = 1;
		return $sexo;
	} elseif ($sexo == 'Mujer') {
		$sexo = 0;
		return $sexo;
	}
}
?> 