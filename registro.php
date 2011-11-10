<?php 
include_once('../GestorBD.php');

$bd = new GestorBD();

	if($bd->conectar()){
		
			$fechanac = $bd->escapeString($_POST['fechanac']);
			$sexo = $bd->escapeString($_POST['sexo']);
			$email = $bd->escapeString($_POST['email']);
			$alias = $bd->escapeString($_POST['alias']);
			$contrasena = $bd->escapeString($_POST['contrasena']);
			$cp = $bd->escapeString($_POST['cp']);
			$nombre = $bd->escapeString($_POST['nombre']);
			$apellidos = $bd->escapeString($_POST['apellidos']);
			
			$provincia = $bd->escapeString($_POST['provincia']);
			$comautonoma = $bd->escapeString($_POST['comautonoma']);
			$recontrasena = $bd->escapeString($_POST['recontrasena']);
						
			$fechanac=dmaToamd($fechanac); //Convertimos la fecha a AAAA-MM-DD para poder meterla en la BD
				
			$sexo=sexoToInt($sexo); //pasa Hombre a 1 y Mujer a 0
			
			if($sexo=='Hombre'){
				$sexo=1;
			}elseif($sexo=='Mujer'){
				$sexo=0;
			}
			
			
			$string = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, codPostal, nombre, apellidos) 
			VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $cp, $nombre, $apellidos);
			$bd->consulta($string);
			
			
		
	}
	
	function dmaToamd($fecha){
			 $dia = substr($fecha, 0,2); 
			 $mes = substr($fecha, 3,2);
			 $ano = substr($fecha,6,9);
			 
			 $fecha=$ano."-".$mes."-".$dia;
		
			return $fecha;
	}
	
	function sexoToInt($sexo){
			if($sexo=='Hombre'){
				$sexo=1;
				return $sexo;
			}elseif($sexo=='Mujer'){
				$sexo=0;
				return $sexo;
			}
	}
	
?> 