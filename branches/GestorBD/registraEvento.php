<?php
include_once ('BD/GestorBD.php');

$bd = new GestorBD();

if ($bd -> conectar()) {

	
	$mes = $bd -> escapeString($_POST['dia']);
	$dia = $bd -> escapeString($_POST['mes']);
	$ano = $bd -> escapeString($_POST['ano']);
	
	$fechaEvento = $ano.'-'.$mes.'-'.$dia;
	$titulo = $bd -> escapeString($_POST['nomevento']);
	$numpersonas = $bd -> escapeString($_POST['numpersonas']);
	$descripcion = $bd -> escapeString($_POST['descripcion']);
	$lugar = $bd -> escapeString($_POST['lugar']);
	$provincia = $bd -> escapeString($_POST['provincia']);

	$valido = esValido($bd, $fechaEvento, $titulo, $numpersonas, $provincia,$descripcion,$lugar);
	$fechanaEvento= dmaToamd($fechaEvento);
	

	
	if ($valido){
		 
		$bd -> insertarEvento($fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar);
		
	}
	 $bd->desconectar();
}

function esValido($bd, $fechaEvento, $titulo, $numpersonas, $provincia, $descripcion, $lugar) {
	$valido = true;
	
	$res = sprintf("Location:registro.php?");
	echo("empezamos");
	
	$camposvacios = false;

	if ($fechaEvento == "" || $titulo == "" || $numpersonas== "" || $descripcion == "" || $lugar=='') {//OK
		$camposvacios = true;
		$res = $res . '&err_campos';
		echo("campos");
		$valido=false;
	}

	if (!$camposvacios && (mysql_num_rows($resultadoEmail) > 0 || strlen($email) > 60)) {//OK
		$res = $res . '&err_email';
	echo("email");
		$valido = false;
	}

	if (!$camposvacios && ($contrasena != $recontrasena || strlen($contrasena) < 6 || strlen($contrasena) > 15)) {//No entra en el if
		$res = $res . '&err_contrasena';
	echo("contrasena");
		$valido = false;
	}

	//Nombre y apellidos, validados como campos no vacios
	
	if ($sexo != '1' && $sexo != '0') {
		$valido = false;
	}
	$dia = substr($fechanac, 0, 2);
	$mes = substr($fechanac, 3, 2);
	$ano = substr($fechanac, 6, 9);

	$diamax=0;
	//No contemplamos visiestos ni los años

	if ($mes > 0 && $mes < 13 && strlen($fechanac)==10) {//con == 10 hacemos que sea de la forma dd/mm/aaaa
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
			echo("fecha");
			$valido = false;
		}

	} else {
		echo("fecha2");
		$valido = false;
	}
	if (!$camposvacios && (mysql_num_rows($resultadoAlias) > 0 || strlen($alias) > 60 || strlen($alias) < 3)) {//OK
		echo("alias");
		$valido = false;
	}
	
	if($provincia==0){
			$res = $res . '&err_campos';
		$valido=false;
	}elseif(!$camposvacios){
		
		$query=sprintf("SELECT idProvincia FROM provincias WHERE idProvincia=%s",$provincia);
		$tuplas=$bd->consulta($query);
		
		while ($fila = mysql_fetch_assoc($tuplas)  && mysql_num_rows($fila)<=1 && mysql_num_rows($fila)>0) { 
			$prov=$fila['idProvincia'];
			if($prov==""){
				$res = $res . '&err_campos';
				$valido=false;
			}	
		}
		
	}

	if ($valido) {
		echo("terminamos");
		return true;
	} else {
		header($res);
	}
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

function sexoToInt($sexo) {// no se usa ya, lo borraremos cuando estemos 100% seguro
	if ($sexo == 'Hombre') {
		$sexo = 1;
		return $sexo;
	} elseif ($sexo == 'Mujer') {
		$sexo = 0;
		return $sexo;
	}
}
?> 