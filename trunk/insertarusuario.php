<?php 
include_once('BD/GestorBD.php');

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
			
			$valido=esValido($bd,$email,$contrasena,$recontrasena,$comautonoma,$provincia,$cp);
						
			$fechanac=dmaToamd($fechanac); //Convertimos la fecha a AAAA-MM-DD para poder meterla en la BD
				
			$sexo=sexoToInt($sexo); //pasa Hombre a 1 y Mujer a 0
			
			if($valido){
			$string = sprintf("INSERT INTO usuarios (fechaNac, sexo, email, alias, pass, codPostal, nombre, apellidos) 
			VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )", $fechanac, $sexo, $email, $alias, $contrasena, $cp, $nombre, $apellidos);
			$bd->consulta($string);
			}
			
			
		
	}
	
	function esValido($bd,$email,$contrasena,$recontrasena,$comautonoma,$provincia,$cp){
			$valido=true;
			$row=sprintf("SELECT * FROM usuarios WHERE email = '%s'", $email);
			$resultado=$bd->consulta($row);
			$res=sprintf("Location:registro.php?");
			
			//Hay error si...
			$camposvacios=false;
			
			if($email=="" || $contrasena=="" || $email){//OK
				$camposvacios=true;
				$res=$res.'&err_campos';
			}

			if(!$camposvacios && (mysql_num_rows($resultado)>0 || strlen($email)>60)){//OK
					$res=$res.'&err_email';
					$valido=false;
			}
			
				
					// $email=true;
					// echo ("email repetido");
				// }elseif(!$camposvacios){//OK
					// $email=false;
					// echo ("email correcto!");
				// }
			
			
			
			if(!$camposvacios && ($contrasena!=$recontrasena || strlen($contrasena)<6 || strlen($contrasena)>15)){//No entra en el if
				$res=$res.'&err_contrasena';
				echo ("contraseña incorrecta");
				$valido=false;
			}
			
			if(!$camposvacios &&())


			// if($email){
				// $res=$res.'&err_email';
			// }	
			
			header($res);
			
			// while($fila = mysql_fetch_assoc($resultado)){
				 // $existe=$fila['idUsuario'];
				// if($existe=='null'){
					// $valido=false;
				// }
			// }
			
		
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