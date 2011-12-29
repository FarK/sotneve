<?php
include ("includes/testSession.php");
include_once ('BD/evento.php');

$provincia = $_GET["provincia"];
$subtipos = $_GET["subtipos"];
//Comprobar si ha habido errores
include_once ('BD/GestorBD.php');

$bd = new GestorBD();

if ($provincia == NULL || $subtipos == NULL) {//Valido los datos que me llegan por get parte1 de 2
	header('Location:errores.php?error="Busqueda no valida"');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta charset=utf-8" />
		<title>Sotneve - Resultado Busqueda</title>
		<link rel="stylesheet" type="text/css" href="styles/resultadobusqueda.css" />
		<link rel="stylesheet" type="text/css" href="styles/buscarevento.css">
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php
		include ("includes/head.php");
		?>

		<h1><?php
		$conectado = $bd -> conectar();
		if ($conectado) {

			$provinciaString = $bd -> getNombreElementoCon('provincias', 'idProvincia', $provincia);
			$subtipoString = $bd -> getNombreElementoCon('subtipos', 'idSubTipo', $subtipos);
			
			if($subtipos==0){
				$subtipoString="'Todos'";
			}

			if ($provinciaString == NULL || $subtipoString == NULL) {//Valido los datos que me llegan por get parte2 de 2
				header('Location:errores.php?error="los valores de busqueda no existen en la base de datos"');
			}
			$aux = sprintf("En %s buscando la actividad %s", $provinciaString, $subtipoString);
			
			echo($aux);
		}
		?></h1>
		<?php
		if ($conectado) {
			if($subtipos==0){//Si es 0 se muestran todos
				$tuplas = $bd -> getTodosEventosConProvinciaNoCaducados($provincia, $subtipos);
			}else{
				$tuplas = $bd -> getEventosConProvinciaYSubtipoNoCaducados($provincia, $subtipos);
				}
			$bd -> desconectar();
		}

		while ($fila = mysql_fetch_assoc($tuplas)) {
			$idEvento2 = $fila['idEvento'];
			$evento = new Evento($idEvento2);
			$titulo = $evento -> getCampo('titulo');
			$maxpersonas = $evento -> getCampo('maxPersonas');
			$lugar = $evento -> getCampo('lugar');
			$personasActuales=$evento -> getNumAsistentes();
			
			$linea = sprintf("<span><a href='infoEvento.php?&idEvento=%s'>Evento: %s , numero de personas %s de %s, lugar %s</a></span>", $idEvento2, $titulo, $personasActuales,$maxpersonas, $lugar);
			echo($linea);
		}
		?>
			<?php include("includes/footer.php"); ?>
	</body>
</html>