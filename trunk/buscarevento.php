<?php

include_once ('BD/GestorBD.php');
$bd = new GestorBD();
$conectado = $bd -> conectar();

function generaOption($bd, $campo, $tabla) {

	$query = sprintf("SELECT %s FROM %s", $campo, $tabla);
	echo($query);
	$campos = $bd -> consulta($query);

	while ($fila = mysql_fetch_assoc($campos)) {
		$campoAux = $fila[$campo];
		$option = sprintf("<option value='%s'>%s</option>\n\t\t", $campoAux, $campoAux);
		echo $option;
	}

}
?>
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
