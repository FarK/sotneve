<?php
	include_once 'BD/conexion.php';
    include_once 'includes/testSession.php';
	include_once 'BD/usuario.php';
	include_once 'BD/evento.php';
	include_once 'BD/provincia.php';

	

	$conexion = new Conexion();	
	//Crear objeto evento
	$evento = new Evento($conexion,$_GET["idEvento"]);
	

	//Comprobar si ha habido errores //TODO redireccionar a la pagina de errores correcta
	// if() //No pudo conectar
		// header('Location:index.php?err_bd');	//Redirecconar con GET a error
// 	
	// else if()//no existe el evento (o ha fallado la consulta)
		// header('Location:errores.php?error="eventNotFound"');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Sotneve - <?php 
		$evento -> prepCampo("idEvento");
		$evento -> prepCampo("titulo");
		$evento -> prepCampo("fechaEvento");
		$evento -> prepCampo("lugar");
		$evento -> prepCampo("idProvincia");
		$evento -> prepCampo("maxPersonas");
		$evento -> prepCampo("descripcion");
		$evento -> prepCampo("propietario");
		$campos = $evento->consultarCampos();
		if(empty($campos)){
			//TODO
			echo "ERROR: Mandar a error de evento no encontrado";
		}
		$provincia= new Provincia($conexion,$campos['idProvincia']);
		$provincia->prepCampo("nombre");
		$camposProv=$provincia->consultarCampos();
		echo $campos['titulo'];?></title>
		<meta charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles/info_evento.css">
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<span><?php
				include 'includes/head.php';
					?></span>
			</div>
			<div id="wrapper">
				<div class='lista_usuarios' id="asistentes">
				<p>
					<strong class="num_usuarios">Van estas <?php 
					$asistentes=$evento->getUsuarios($campos['idEvento']);
					$numeroAsistentes=count($asistentes);
					echo $numeroAsistentes;?> personas:
					
					<br />
					</strong>
					<?php




// //Comprobar si ha habido errores
// if($evento->error() == -2) //No pudo conectar //TODO mandar a errores correspondientes
// header('Location:index.php?err_bd');	//Redirecconar con GET a error
// else if($evento->error() == -1)//no existe el usuario (o ha fallado la consulta)
// echo '<span> Actualmente no hay asistentes </span>';

foreach($asistentes as $asist){
$span= sprintf("<a class='enlaceEnmarcado' href='infoUsuario.php?idUsuario=%s'>%s</a>\n\t\t", $asist['idUsuario'],$asist['alias']);
echo $span;
}
					?>
				</p>
			</div>
				<div id="informacion">
					<h1><?php echo $campos['titulo'];?></h1>
					<p>
						<strong>Informaci&oacute;n del evento:
						<br />
						</strong>
						<span class='info'>Lugar: <?php echo $campos['lugar']; 
						echo " en "; 
						echo $camposProv['nombre'];?></span>
						<br />
						<span class='info'>Fecha: <?php echo $campos['fechaEvento'];?></span>
						<br />
						<span class='info'>Quedan <?php echo $campos['maxPersonas']-$numeroAsistentes;
							?> plazas restantes de <?php echo $campos['maxPersonas'];?> participantes</span>
						<br />
						<span class='info'>Descripci&oacute;n: <?php echo $campos['descripcion'];?></span>
						<br />
						<span class='info'>Creado por: <?php
													
							echo $evento->getAliasPropietario($campos['propietario']);
						
							?></span>
						<br />
				</div>
			</div>
			<div id="comentarios">
				<p>
					<strong>Comentarios (no sabemos si implementarlo):
					<br />
					</strong> very text make long column make filler fill make column column silly filler text silly column fill silly fill column text filler make text silly filler make filler very silly make text very very text make long filler very make column make silly column fill silly column long make silly filler column filler silly long long column fill silly column very
				</p>
			</div>

				 <?php include 'includes/footer.php';?>
		</div>
	</body>
</html>
