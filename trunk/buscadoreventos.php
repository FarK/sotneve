<?php
	include_once ('BD/GestorBD.php');

	$bd = new GestorBD();
	$conectado=$bd -> conectar();
	
function generaOption($bd, $campo, $tabla) {

	$query = sprintf("SELECT %s FROM %s", $campo, $tabla);
	echo $query;
	$campos = $bd -> consulta($query);

	while ($fila = mysql_fetch_assoc($campos)) {
		$campoAux = $fila[$campo];
		$option = sprintf("<option value='%s'>%s</option>\n\t\t", $campoAux, $campoAux);
		echo $option;
	}

}

function generaTipos() {


	$consulta = mysql_query("SELECT id, opcion FROM tipos");


	// Voy imprimiendo el primer select compuesto por los tipos
	echo "<select name='tipos' id='tipos' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while ($registro = mysql_fetch_row($consulta)) {
		echo "<option value='" . $registro[0] . "'>" . $registro[1] . "</option>";
	}
	echo "</select>";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Buscador</title>
		<link rel="stylesheet" type="text/css" href="styles/buscadoreventos.css">
		<script type="text/javascript" src="scripts/buscadoreventos.js"></script>
	</head>
	<body>
		<div id="demo" style="width:600px;">
			<div id="demoIzq">
				<select  name="provincia" id="provincia">
					<?php
					if ($conectado) {
						generaOption($bd, 'nombre', 'provincias');
					}
					?>
				</select>
			</div>

			<div id="demoIzq">
				<?php generaTipos();
				$bd->desconectar();?>
			</div>
						<div id="demoDer">
				<select disabled="disabled" name="subtipos" id="subtipos">
					<option value="0">Selecciona opci&oacute;n...</option>
				</select>
				
			</div>
			<input id="buscareventos" class="btn" name="buscareventos" type="submit" value="Buscar eventos"/>
		</div>
	</body>
</html>