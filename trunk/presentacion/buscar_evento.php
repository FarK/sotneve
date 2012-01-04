<?php
include_once ('../datos/conexion.php');
include_once ('../datos/provincia.php');

$conexion = new Conexion();
$provincia = new Provincia($conexion);
$prov=$provincia->getProvincias();

// function generaOption($bd, $campo, $tabla) {//el metodo ya no es generico
//
// $query = sprintf("SELECT %s,idProvincia FROM %s ORDER BY `nombre`", $campo, $tabla);
// //  $campos = $bd -> consulta($query);
//
// while ($fila = mysql_fetch_assoc($campos)) {
// $campoAux = $fila[$campo];
// $campoAux2 = $fila['idProvincia'];
// $option = sprintf("<option value='%s'>%s</option>\n\t\t", $campoAux2, $campoAux);
// echo $option;
// }
//
// }

// function generaTipos() {
// 
	// $consulta = mysql_query("SELECT idTipo, nombre FROM tipos");
// 
	// // Voy imprimiendo el primer select compuesto por los tipos
	// echo "<select class='selbusc' name='tipos' id='tipos' onchange='cargaContenido(this.id)'>";
	// echo "<option value='0'>Elige</option>";
	// while ($registro = mysql_fetch_row($consulta)) {
		// echo "<option value='" . $registro[0] . "'>" . $registro[1] . "</option>";
	// }
	// echo "</select>";
// }
?>

<form method="get" action="generabusqueda.php">
	<div id="buscador" style="width:600px;">
<!-- 		                <div class='opcion'>
		<select  name="provincia" id="provincia"> -->
		<?php
		// if ($conectado) {
		// generaOption($bd, 'nombre', 'provincias');
		// }
		?>
<!-- 		</select>
		</div>  -->
		<div class='opcion'>
			<select class='selbusc' name='tipos' id='tipos' onchange='cargaContenido(this.id)'>
				<option value='0'>Elige</option>
				<?php
				
				foreach ($prov as $idp=>$p) {
					
					echo "<option value='" . $idp . "'>" . $p . "</option>";
				}
				
				?>
			</select>
		</div>
		<div class='opcion'>
			<select disabled="disabled" name="subtipos" id="subtipos">
				<option value="0">Selecciona opci&oacute;n...</option>
			</select>
		</div>
		<input type="image" id="search_icon" src="recursos/imagenes/search.png" alt="Buscar eventos"/>
	</div>
</form>