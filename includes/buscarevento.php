<?php
include_once ('BD/GestorBD.php');

$bd = new GestorBD();
$conectado = $bd -> conectar();

function generaOption($bd, $campo, $tabla) {//el metodo ya no es generico

	$query = sprintf("SELECT %s,idProvincia FROM %s", $campo, $tabla);
	$campos = $bd -> consulta($query);

	while ($fila = mysql_fetch_assoc($campos)) {
		$campoAux = $fila[$campo];
		$campoAux2 = $fila['idProvincia'];
		$option = sprintf("<option value='%s'>%s</option>\n\t\t", $campoAux2, $campoAux);
		echo $option;
	}

}

function generaTipos() {

	$consulta = mysql_query("SELECT idTipo, nombre FROM tipos");

	// Voy imprimiendo el primer select compuesto por los tipos
	echo "<select class='selbusc' name='tipos' id='tipos' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while ($registro = mysql_fetch_row($consulta)) {
		echo "<option value='" . $registro[0] . "'>" . $registro[1] . "</option>";
	}
	echo "</select>";
}
?>

<form name="form" method="get" action="generabusqueda.php">
	<div id="buscador" name="buscador" style="width:600px;">
			<select class="selbusc" name="provincia" id="provincia">
				<?php
				if ($conectado) {
					generaOption($bd, 'nombre', 'provincias');
				}
				?>
			</select>

			<?php
			if ($conectado) {
				generaTipos();
			}
			$bd -> desconectar();

			$conectado = false;
			?>

			<select class="selbusc" disabled="disabled" name="subtipos" id="subtipos">
				<option value="0">Selecciona opci&oacute;n...</option>
			</select>
			<button type="submit" class="boton">
				¡Buscar!
			</button>
	</div>
</form>
