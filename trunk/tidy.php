<?php
ob_start();

$pag = $_GET['pagina'];
$dir = preg_replace('/\/[^\/]+$/', "", $pag);
chdir($dir);

include("$pag");

$tidy = new Tidy;
$tidy->parseString(ob_get_clean());

$busqueda=array("/</i","/>/i");
$reemplazo=array("&lt","&gt");

$errors = explode("\n", $tidy->errorBuffer);
foreach($errors as $error)
	echo preg_replace($busqueda, $reemplazo, $error). "\n</br>";

?>
