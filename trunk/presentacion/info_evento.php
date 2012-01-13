<?php
	include_once '../datos/conexion.php';
	include '../logica/test_session.php';
	include_once '../datos/usuario.php';
	include_once '../datos/evento.php';
	include_once '../datos/provincia.php';
	include_once '../datos/tipo.php';
	
	
	$conexion = new Conexion();	
	//Crear objeto evento
	$idEventoVisitado = $_GET["idEvento"];
	$evento = new Evento($conexion, $idEventoVisitado);
	$campos = $evento->consultarTodosLosCampos();
	if(empty($campos)){
		//TODO
		echo "ERROR: Mandar a error de evento no encontrado";
	}
	$provincia= new Provincia($conexion,$campos['idProvincia']);
	$provincia->prepCampo("nombre");
	$camposProv=$provincia->consultarCampos();
	
	$tipo = new tipo($conexion , $campos['idTipo']);
	$tipo->prepCampo("nombre");
	$camposTipo = $tipo->consultarCampos();
		
	$asistentes=$evento->getUsuarios($campos['idEvento']);
	$numeroAsistentes=count($asistentes);
		
	$estaCompleto = $evento->estaCompleto();
	$estaInscrito = $evento->estaInscrito($_SESSION['idUsuario']);
	
	$esPropietario = $evento->esPropietario($_SESSION['idUsuario']);
	if($esPropietario){
		$add_form_action = sprintf('crear_evento.php?idEvento=%s', $idEventoVisitado);
		$add_image = '<input type="image" id="add" src="recursos/imagenes/editar.png">Editar Evento';
	}
	else if($estaInscrito){
		$add_form_action = 'javascript:desinscribeEvento('.$idEventoVisitado.')';
		$add_image = '<input type="image" id="add" src="recursos/imagenes/delete.png">Desinscribirse';
	}else{
		if($estaCompleto){ //no inscrito pero completo->boton desactivado
			$add_form_action = 'javascript:hacerNada()';
			$add_image = '<input type="image" id="add" src="recursos/imagenes/add_disabled.png">Evento completo';
		}else{ //no inscrito y no completo -> boton verde
			$add_form_action = 'javascript:inscribeEvento('.$idEventoVisitado.')';
			$add_image = '<input type="image" id="add" src="recursos/imagenes/add.png">&iexcl;Me apunto!';
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Sotneve - <?php echo $campos['titulo'];?> </title>
		<meta charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="estilos/info_evento.css">
		<script type="text/javascript" src="../logica/scripts/buscarevento.js"></script>
		<script type="text/javascript" src="../logica/scripts/info_evento.js"></script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<span><?php
				include 'head.php';
					?></span>
			</div>
			<div id="wrapper">
				<div class='lista_usuarios'>
					
				<p>
					<strong class="num_usuarios">
						<span id="num_asistentes">
							<?php
								if($numeroAsistentes>0)
									echo "Asisten &eacute;stas personas:</br>";
								else
									echo "Ninguna persona asiste</br>";
							?>
						</span>
					</strong>
					<span id="asistentes">
					<?php
						foreach($asistentes as $asist){
							$a= sprintf("<a class='enlaceEnmarcado' href='info_usuario.php?idUsuario=%s'>%s</a>\n\t\t", $asist['idUsuario'],$asist['alias']);
							echo $a;
						}
					?>
					</span>
				</p>
			</div>
				<form id="informacion" method="post" action=<?php echo $add_form_action ?>>
					<span id='me_apunto'>
						<?php echo $add_image ?>
					</span>
				</form>
					
					
					<span class="h1"><?php echo $campos['titulo'];?></span>
					<p>
						<strong>Informaci&oacute;n del evento:
						<br />
						</strong>
						<span class='info'>Lugar: <?php echo $campos['lugar']; 
						echo " en "; 
						echo $camposProv['nombre'];?></span>
						<br />
						<span class='info'>Actividad:  <?php echo $camposTipo['nombre'];?> </span>
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

				 <?php include 'footer.php';?>
		</div>
	</body>
</html>
