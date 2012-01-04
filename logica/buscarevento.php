<?php
include_once ('../datos/conexion.php');
include_once ('../datos/provincia.php');

$conexion = new Conexion();
$provincia = new Provincia($conexion);
$prov=$provincia->getProvincias();

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

       // $consulta=mysql_query("SELECT idSubTipo, nombre FROM $tabla WHERE idTipo='$opcionSeleccionada'") or die(mysql_error());

        
        // Comienzo a imprimir el select
        echo "<select class='selbusc' name='".$selectDestino."' id='".$selectDestino."' onChange='cargaContenido(this.id)'>";
        echo "<option value='0'>Todos</option>";
        foreach($prov as $idp=>$p){
        	
                // Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
                $registro[1]=htmlentities($registro[1]);
                // Imprimo las opciones del select
                echo "<option value='".$idp."'>".$p."</option>";
        }                       
        echo "</select>";
}
?>