<?php

include_once ('../datos/conexion.php');
include_once ('../datos/provincia.php');
include_once ('../datos/tipo.php');

$conexion = new Conexion();
$provincia = new Provincia($conexion);
$prov = $provincia -> getProvincias();

$tipo = new Tipo($conexion);
?>

<div id="buscador">
	<form method="get" action="busqueda.php">
		<div class='opcion'>
			<select class='selbusc' name='provincia' id='provincia'>
				<option value='0'>Todos</option>
				<?php

				foreach ($prov as $idp => $p) {

					echo "<option value='" . $idp . "'>" . htmlentities($p) . "</option>";
				}
				?>
			</select>
		</div>
		<div class='opcion'>
			<select class = 'selbusc' name="tipo" id="tipo">
				<option value="0">Todos</option>
				
				<?php $tipo -> getArbolTipos();?>
				
			</select>
			<input type="image" id="search_icon" src="recursos/imagenes/search.png" alt="Buscar eventos"/>
		</div>
	</form>
</div>
