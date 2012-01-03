<?php
include_once ("BD/provincia.php");
include_once ("BD/conexion.php");
include_once ("BD/utiles.php");

$conex = new Conexion();
$utiles = new Utiles($conex);
$provincia = new Provincia($conex);


function generaProvincias($provincia) {
	$provincias = $provincia ->getProvincias();
	foreach ($provincias as $id=>$prov) {
		$option = sprintf("<option value='%s'>%s</option>", $id, $prov);
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
					generaProvincias($provincia);
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
		<input type="image" id="search_icon" src="images/search.png" alt="Buscar eventos"/>
	</div>
</form>

<?php $conex->desconectar(); ?>
