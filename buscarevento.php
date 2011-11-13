<?php
	include_once("BD/usuario.php");
	include_once ('BD/GestorBD.php');

	$bd = new GestorBD();
	$conectado = $bd -> conectar();

	function generaOption($bd, $campo, $tabla) {

		$query = sprintf("SELECT %s FROM %s", $campo, $tabla);
		$campos = $bd -> consulta($query);

		while ($fila = mysql_fetch_assoc($campos)) {
			$campoAux = $fila[$campo];
			$option = sprintf("<option value='%s'>%s</option>\n\t\t", $campoAux, $campoAux);
			echo $option;
		}

	}
	//Incluimos la cabecera
	include ("includes/head.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="styles/favoritos.css" />
		<title>Sotneve - Buscar evento </title>
		
	</head>
	<body>
		<select  name="provincia" id="provincia">
		<?php
			if ($conectado) {
				generaOption($bd, 'nombre', 'provincias');
			}
		?>
		</select>
		<select  name="tipo" id="tipo">
		<?php
			if ($conectado) {
				generaOption($bd, 'nombre', 'tipos');
			}
		?>
		</select>
		<select  name="subtipo" id="subtipo">
		<?php
			if ($conectado) {//condicionar los tipos
				generaOption($bd, 'nombre', 'subtipos');
			}
		?>
		</select>
	</body>
</html>
