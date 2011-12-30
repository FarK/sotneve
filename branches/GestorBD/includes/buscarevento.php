<?php
include_once ("BD/utiles.php");
include_once ("BD/conexion.php");

$conex = new Conexion();
$utiles = new Utiles($conex);


function generaProvincias($u) {
	$provincias = $u->getProvincias();
	foreach ($provincias as $id=>$arr) {
		$option = sprintf("<option value='%s'>%s</option>", $id, $arr['nombre']);
		echo $option;
	}
}

function generaTipos($u) {
	$tipos = $u->getTiposPadre();
	// Voy imprimiendo el primer select compuesto por los tipos
	echo "<select class='selbusc' name='tipos' id='tipos' onchange='cargaContenido(this.id)'>";
	echo "<option value='-1'>Elige</option>";
	foreach($tipos as $id=>$arr) {
		echo "<option value='" . $id . "'>" . $arr['nombre'] . "</option>";
	}
	echo "</select>";
}
?>

<form method="get" action="generabusqueda.php">
	<div id="buscador" style="width:600px;">
		<div class='opcion'>
			<select  name="provincia" id="provincia">
				<?php
					generaProvincias($utiles);
				?>
			</select>
		</div>
		<div class='opcion'>
			<?php
				generaTipos($utiles);
			?>
		</div>
		<div class='opcion'>
			<select disabled="disabled" name="subtipos" id="subtipos">
				<option value="0">Selecciona opci&oacute;n...</option>
			</select>
		</div>
		<div class='opcion'>
			<button type="submit" id="btnbuscar">
				&iexcl;Buscar!
			</button>
		</div>
	</div>
</form>

<?php $conex->desconectar(); ?>