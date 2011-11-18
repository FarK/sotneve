<?php

include_once("BD/usuario.php");

$u = new Usuario(1);

$u->getCampo('nombre');
$u->getCampo('apellidos');
$resultados = $u->consultar();

echo "Nombre: " . $resultados['nombre'];
echo "</br>";
echo "Apellidos: " . $resultados['apellidos'];

?>
