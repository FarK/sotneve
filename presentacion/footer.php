<?php
$ruta = preg_split('/\//', $_SERVER['SCRIPT_NAME']);
$rutaAcerca = '/' . $ruta[1] . '/presentacion/acerca.php';
?>

<div id="pie">
	<span class="pieCell">Copyright Sotneve 2011 &copy;</span>
	
	<div class="pieCell" id='espacioBlanco'></div>
	
	<img
	class="valid"
	src="http://www.w3.org/Icons/valid-xhtml10" 
	alt="Valid XHTML 1.0 Strict" 
	height="31" width="88" />

	<img style="border:0;width:88px;height:31px"
	class="valid"
	src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
	alt="¡CSS Válido!" />
	
	<a class="pieCell" id="acerca" href="<?php echo $rutaAcerca;?>">Acerca de nosotros</a>
</div>
