<?php
	include_once '../datos/conexion.php';
	include '../logica/test_session.php';
	include_once '../datos/usuario.php';
	include_once '../datos/evento.php';
	include_once '../datos/provincia.php';
	include_once '../datos/tipo.php';
	
	if(!isset($_GET["idEvento"])){
		$_SESSION['error'] = "eventNotFound";
		header("Location:errores.php");
		exit;
	}
	
	$conexion = new Conexion();	
	//Crear objeto evento
	$idEventoVisitado = $_GET["idEvento"];
	$evento = new Evento($conexion, $idEventoVisitado);
	$campos = $evento->consultarTodosLosCampos();

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
	$terminado = $evento->haTerminado();
	
	if($terminado){	//ha terminado->boton desactivado
		$add_form_action = 'javascript:hacerNada()';
		$add_image = '<input type="image" id="add" src="recursos/imagenes/add_disabled.png">Evento finalizado';
	}else if($esPropietario){ // boton de lapiz
		$add_form_action = sprintf('crear_evento.php?idEvento=%s', $idEventoVisitado);
		$add_image = '<input type="image" id="add" src="recursos/imagenes/editar.png">Editar evento';
	}else if($estaInscrito){ // boton de desinscribirse
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
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
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
						
						<span id='quedan'>Quedan <?php echo $campos['maxPersonas']-$numeroAsistentes;
							?> plazas restantes de <?php echo $campos['maxPersonas'];?> participantes</span>
						
						<br />
				<div class='info_evento'>
						
						<br />
						<div class='data_row'>
							<span class="campo_evento"> Lugar: </span>
							<span class="valor_evento"> <?php echo $campos['lugar']; 
									echo " en "; 
									echo $camposProv['nombre'];?></span>
						</div>
						<div class='data_row'>
							<span class="campo_evento"> Fecha: </span>
							<span class="valor_evento"> <?php echo $campos['fechaEvento'];?>
							</span>
						</div>
						<div class='data_row'>
							<span class="campo_evento"> Actividad: </span>
							<span class="valor_evento"> <?php echo $camposTipo['nombre'];?>
							</span>
						</div>
						<div class='data_row'>
							<span class="campo_evento"> Creado por: </span>
							<span class="valor_evento"> <?php
							echo $evento->getAliasPropietario($campos['propietario']);
							?>
							</span>
						</div>
						<div class='data_row'>
							<span class="campo_evento"> Descripci&oacute;n: </span>
							<div id="descr">
							<span id="descr"> <?php echo $campos['descripcion'];?>
							</span>
							</div>
						</div>
					</div>
				</div>
			</div>

				 <?php include 'footer.php';?>
		</div>
	</body>
</html>
