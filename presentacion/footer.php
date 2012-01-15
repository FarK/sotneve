<?php
$presentacion = array();
preg_match('/\/.+\/presentacion/',$_SERVER['SCRIPT_NAME'], $presentacion);
$ruta = $presentacion[0] . '/acerca.php';
?>

<div id="pie">
	<span class="pieCell">Copyright Sotneve 2011 &copy;</span>
	<div class="pieCell" id='espacioBlanco'></div>
	<a class="pieCell" id="acerca" href="<?php echo $ruta; ?>">Acerca de nosotros</a>
</div>
