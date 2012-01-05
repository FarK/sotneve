<?php
include ("../logica/test_session.php");
include ("../datos/conexion.php");
include ("../datos/provincia.php");
include ("../datos/evento.php");

$conex = new Conexion();
$provincia = new Provincia($conex);
$provincias = $provincia -> getProvincias();

//Si nos pasan un idEvento se está intentando editar el evento
$campos = array();
$provinciaEv = null;
if(isset($_GET['idEvento'])){
	$idEvento = $_GET['idEvento'];
	$evento = new Evento($conex,$idEvento);
	$campos = $evento->consultarTodosLosCampos();

	//Sacamos la provincia del evento a editar
	$provinciEv = $evento->getProvincia();
}


function inputTituloEvento($campos){
	if(empty($campos))
		$input = sprintf('<input type="text" id="nomevento"  name="nomevento" />');
	else
		$input = sprintf('<input type="text" id="nomevento"  value="%s" name="nomevento" />', $campos['titulo']);

	echo $input;
}

function selectMeses($campos){
	$mesAct = -1;
	if(!empty($campos)){
		//TODO
		$mes = preg_match('/..\/../',$campos['fechaEvento']);
		echo $mes;
	}

	$meses = array(
		'',
		'Enero',
		'Febrero',
		'Marzo',
		'Abril',
		'Mayo',
		'Junio',
		'Julio',
		'Agosto',
		'Septiembre',
		'Octubre',
		'Noviembre',
		'Diciembre'
	);

	echo '<select name="mes" id="mes">';
	if($mesAct != -1){
		$option = sprintf('<option value=%s> %s </option>\n', $mesAct, $meses[$mesAct]);
		echo $option;
	}
	foreach($meses as $index=>$mes){
		if($mesAct != $index){
			$option = sprintf('<option value=%s> %s </option>\n', $index, $mes);
			echo $option;
		}
	}
	echo '<select/>';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta content="text/xhtml; charset=UTF-8">
		</meta>
		<title>Sotneve - Crear Evento</title>
		<link rel="stylesheet" type="text/css" href="estilos/crear_evento.css" />
		<script type="text/javascript" src="../logica/scripts/buscar_evento.js"></script>
		<script type="text/javascript" src="../logica/scripts/crear_evento.js"></script>
	</head>
	<body>
		 
		<!-- Incluimos la cabecera -->
		<?php
		include ("head.php");
		?>

		<div class="contenido">
			
		<h2>Crear Evento</h2>
		<?php
			if(isset($_SESSION['err_campos_evento']) && $_SESSION['err_campos_evento']){
				echo "<span class='errorphp'>Debe rellenar todos los campos.</span>";
				$_SESSION['err_campos_evento'] = false;
			}
		?>
			<div class="form">
				<form name="fval" action="../logica/crear_evento.php" method="post"   onsubmit="return valida()">
					<div class="filaform">
						<label for="nomevento"> T&iacute;tulo</label>
						<?php inputTituloEvento($campos); ?>
					</div>
					<div class="filaform">
						<label id="nump" for="numpersonas">N&uacute;mero de personas</label>
						<input type="text" id="numpersonas" name="numpersonas"/>
						<br/>
					</div>
					<div class="filaform">
						<label for="fechaevento">Fecha del Evento</label>
						<select name="dia" id="dia">
							<option value="0"></option>
							<?php
							for ($i = 1; $i < 32; $i++) {
								$dia = "0" + $i;
								$option = sprintf('<option value="%s">%s</option>', $dia, $dia);
								echo $option;
							}
							?>
						</select>
						<?php selectMeses($campos) ?>
						<select name="ano" id="ano">
							<option value="0"></option>
							<?php
							for ($i = 0; $i < 10; $i++) {

								$ano = "2011" + $i;
								$option = sprintf('<option value="%s">%s</option>', $ano, $ano);
								echo $option;
							}
							?>
						</select>
						<select name="hora" id="hora">
							<option value=""></option>
							<?php
							for ($i=0; $i <24; $i++) {
								$hora="00"+$i;
								if($i>=10)
									$option = sprintf('<option value="%s">%s</option>',$hora,$hora);
								else
									$option = sprintf('<option value="%s">0%s</option>',$hora,$hora);

								echo $option;
							}
							?>
						</select>
						<select name="min" id="min">
							<option value=""></option>
							<?php
							for ($i=0; $i <60 ; $i=$i+5) {
								if($i<10){
									$option = sprintf('<option value="%s">0%s</option>',$i,$i);
									echo $option;
								}else {
									$option = sprintf('<option value="%s">%s</option>',$i,$i);
									echo $option;
								}
							}
							?>
							
						</select>
					</div>
					<div class="filaform">
						<label for="provincia">Provincia</label>
						<select name="provincia" id="ev_provincia">
							<?php
							foreach ($provincias as $id => $prov) {
								$option = sprintf('<option value="%s">%s</option>', $id, $prov);
								echo $option;
							}
							?>
						</select>
					</div>
					<div class="filaform">
						<label for="lugar">Lugar</label>
						<input type="text" id="lugar" name="lugar"/>
					</div>
					<div class="filaform">
						<label for="descripcion" >Descripci&oacute;n</label>
						<textarea id="descripcion" name="descripcion" rows="100" maxlength="249"></textarea>
					</div>
						<input class="enlaceEnmarcado" type="submit" id="create" value="Crear Evento"/>
			</form>
			</div>
		</div>
		<?php
			include ("footer.php");
		?>
	</body>
</html>
