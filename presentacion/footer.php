<?php
$ruta = split('/', $_SERVER['SCRIPT_NAME']);
$rutaAcerca = '/' . $ruta[1] . '/presentacion/acerca.php';
?>

<div id="pie">
	<span class="pieCell">Copyright Sotneve 2011 &copy;</span>
	<div class="pieCell" id='espacioBlanco'></div>
	<a class="pieCell" id="acerca" href="<?php echo $rutaAcerca; ?>">Acerca de nosotros</a>
</div>
