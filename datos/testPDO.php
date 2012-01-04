<?php
include_once("conexion.php");
include_once("usuario.php");

$conexion = new Conexion();

$usuario = new Usuario($conexion, 1);

$usuario->prepCampo('nombre');
$usuario->prepCampo('apellidos');
$arr = $usuario->consultarCampos();

$eventos = $usuario->getEventos();

$usuario2 = new Usuario($conexion);
$u = $usuario2->getUsuario(2);

echo $arr['nombre'] . "</br>";
echo $arr['apellidos'] . "</br>";

$i=0;
foreach($eventos as $evento){
	echo "<h3>Evento " . $i . "</h3>";
	foreach($evento as $campo=>$valor)
		echo $campo . " = " . $valor . "</br>";
	$i++;
}

echo "<h2>Usuario</h2>";
foreach($u as $user){
	foreach($user as $campo=>$valor)
		echo $campo . " = " . $valor . "</br>";
	$i++;
}

?>
