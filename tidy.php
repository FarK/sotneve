<?php
ob_start();

$pag = $_GET['pagina'];
$dir = preg_replace('/\/[^\/]+$/', "", $pag);
chdir($dir);

include("$pag");
$html = ob_get_clean();

$tidy = new Tidy;
$tidy->parseString($html);

$busqueda=array("/</i","/>/i");
$reemplazo=array("&lt","&gt");

$errors = explode("\n", $tidy->errorBuffer);
$errores = array();
foreach($errors as $error){
	$reg = array();
	preg_match_all('/[[:digit:]]+/',$error, $reg);
	$line = $reg[0][0];
	$column = $reg[0][1];
	$errores[$line] = $column;
	echo preg_replace($busqueda, $reemplazo, $error). "\n</br>";
}

echo '<strong><h1>CÓDIGO</h1></strong>';
$htmls = explode("\n", $html);
$i = 1;
foreach($htmls as $html){
	if(isset($errores[$i])){
		echo '<strong>';
		//$s1 = substr($html,$errores[$i] - strlen($html));
		//$s1 = substr($html,$errores[$i]);
	}

	echo "line " . $i . ":\t" . preg_replace($busqueda, $reemplazo, $html) . "\n</br>";

	if(isset($errores[$i]))
		echo '</strong>';
	++$i;
}
?>
