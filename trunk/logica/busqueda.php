<?php
include_once ('../datos/conexion.php');

$conexion = new Conexion();

        $provincia = $_GET['provincia'];
        $tipo = $_GET['tipo'];
        if ($provincia == NULL || $tipo == NULL) {
        		//TODO ir a error correcto
                header('Location:errores.php?error="Busqueda no valida"');
        } else {
                $string = sprintf("Location:../presentacion/busqueda.php?provincia=%s&tipo=%s", $provincia, $tipo);
                header($string);
        }

?>