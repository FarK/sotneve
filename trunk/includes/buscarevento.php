<?php
include_once ('BD/GestorBD.php');

$bd = new GestorBD();
$conectado = $bd -> conectar();

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

	$consulta = mysql_query("SELECT idTipo, nombre FROM tipos");

	// Voy imprimiendo el primer select compuesto por los tipos
	echo "<select name='tipos' id='tipos' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while ($registro = mysql_fetch_row($consulta)) {
		echo "<option value='" . $registro[0] . "'>" . $registro[1] . "</option>";
	}
	echo "</select>";
}
?>


<div id="buscador" name="buscador" style="width:600px;">
	
		<select  name="provincia" id="provincia">
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
		
		$conectado=false;
		?>
	

	
		<select disabled="disabled" name="subtipos" id="subtipos">
			<option value="0">Selecciona opci&oacute;n...</option>
		</select>
	

	<?php
		//hacer que $idProvincia y $idSubTipo de la linea siguiente, valga el id correspondiente con la palabra seleccionada en el momento, para poder generar bien el link de busqueda
		$linea=sprintf("<input id='buscareventos' class='btn' name='buscareventos' value='Buscar eventos' href='resultadobusqueda.php&idProvincia=%s&idSubTipo=%s'/>", $idProvincia,$idSubTipo);
		echo ($linea);
	?>
	
</div>
