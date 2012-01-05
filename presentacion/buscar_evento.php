<?php

include_once ('../datos/conexion.php');
include_once ('../datos/provincia.php');
include_once ('../datos/tipo.php');

$conexion = new Conexion();
$provincia = new Provincia($conexion);
$prov = $provincia -> getProvincias();

$tipo = new Tipo($conexion);
?>

<form method="get" action="../logica/busqueda.php">
	<div id="buscador" style="width:600px;">
		<div class='opcion'>
			<select class='selbusc' name='provincia' id='provincia'>
				<option value='0'>Elige</option>
				<?php

				foreach ($prov as $idp => $p) {

					echo "<option value='" . $idp . "'>" . $p . "</option>";
				}
				?>
			</select>
		</div>
		<div class='opcion'>
			<select name="tipo" id="tipo">
				<option value="0">Elige</option>
				
				<?php $tipo -> getArbolTipos(true);?>
				
			</select>
		</div>
		<input type="image" id="search_icon" src="recursos/imagenes/search.png" alt="Buscar eventos"/>
	</div>
</form>