<?php
	include ("includes/testSession.php");
	include_once('BD/usuario.php');

	//Se llama usuario visitado porque si no se pisa con usuario de head.php
	$usuarioVisitado = new Usuario($_GET["idUsuario"]);
	//Comprobar si ha habido errores
	if($usuarioVisitado->error() == -2) //No pudo conectar
		header('Location:index.php?err_bd');	//Redirecconar con GET a error
	
	else if($usuarioVisitado->error() == -1)//no existe el usuario (o ha fallado la consulta)
		header('Location:errores.php?error="userNotFound"');


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sotneve - <?php echo $usuarioVisitado->getCampo("alias"); ?></title>
		<link rel="stylesheet" type="text/css" href="styles/general.css">
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php include ("includes/head.php"); ?>

		<h1><?php echo $usuarioVisitado->getCampo("alias")?></h1>
		
		<div class="info_usuario">
			
				<?php
				
					$novisible="No Disponible";
					$nombre=$novisible;
					$apellidos=$novisible;
					$sexo=$novisible;
					$fechaNac=$novisible;
					$email=$novisible;
					
					
					if($usuarioVisitado->esVisible($NOMBRE)){
						$nombre=$usuarioVisitado->getCampo("nombre");
						
					}

					if($usuarioVisitado->esVisible($APELLIDOS)){
						$apellidos=$usuarioVisitado->getCampo("apellidos");
						
					}

					if($usuarioVisitado->esVisible($SEXO)) {
						$sexo=$usuarioVisitado->getCampo("sexo");
						
						if($sexo==1){
							$sexo="Hombre";
						}elseif($sexo==0){
							$sexo="Mujer";
						}
					}

					if($usuarioVisitado->esVisible($FECHA_NAC)){
						 $fechaNac=$usuarioVisitado->getCampo("fechaNac");
					}

					if($usuarioVisitado->esVisible($EMAIL)) {
						$email=$usuarioVisitado->getCampo("email");
					}

					$provincia=$usuarioVisitado->getCampo("provincia");
					$alias=$usuarioVisitado->getCampo("alias");
					
					
					
				?>
			<span class="l_usuario"> 
				Nombre:
			</span>
			<span class="c_usuario">
				<?php
				echo $nombre;
				?>
			</span>
			
			<span class="l_usuario"> 
				Apellidos:
			</span>
			<span class="c_usuario">
				<?php
				echo $apellidos;
				?>
			</span>
			
			<span class="l_usuario"> 
				Sexo:
			</span>
			<span class="c_usuario">
				<?php
				echo $sexo;
				?>
			</span>
			
			<span class="l_usuario"> 
				Fecha de Nacimiento:
			</span>
			<span class="c_usuario">
				<?php
				echo $fechaNac;
				?>
			</span>
			
			<span class="l_usuario"> 
				Email:
			</span>
			<span class="c_usuario">
				<?php
				echo $email;
				?>
			</span>
			
			<span class="l_usuario"> 
				Provincia:
			</span>
			<span class="c_usuario">
				<?php
				echo $provincia;
				?>
			</span>
			
		</div>
	</body>
</html>