<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"tipos"=>"tipos",
"subtipos"=>"subtipos"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["nombre"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];
	include_once ('BD/utiles.php');
	include_once ('BD/conexion.php');

	$conex = new Conexion();
	$utiles = new Utiles($conex);
	$subtipos = $utiles->getSubtipos();
	$conex->desconectar();
	// Comienzo a imprimir el select
	echo "<select class='selbusc' name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
	echo "<option value='-1'>Todos</option>";
	foreach($subtipos as $subtipo)
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$subtipo[1]=htmlentities($subtipo[1]);
		// Imprimo las opciones del select
		echo "<option value='".$subtipo[0]."'>".$subtipo[1]."</option>";
	}			
	echo "</select>";
}
?>