<?php
include ("../logica/test_session.php");
include ("../datos/conexion.php");
include ("../datos/provincia.php");
include ("../datos/evento.php");
include ("../datos/tipo.php");

$conex = new Conexion();
$provincia = new Provincia($conex);
$provincias = $provincia -> getProvincias();

$tipo = new Tipo($conex);

//Si nos pasan un idEvento se está intentando editar el evento
$campos = array();
$nomTipo = null;
$provinciaEv = null;
$idEvento = -1;
if(isset($_GET['idEvento'])){
	$idEvento = $_GET['idEvento'];
	$evento = new Evento($conex,$idEvento);
	$campos = $evento->consultarTodosLosCampos();

	//Si no es propietario redirigimos a info_evento.php
	if($_SESSION['idUsuario'] != $campos['propietario'])
		header('Location: info_evento.php?idEvento=' . $campos['idEvento']);	

	//Inicializamos el tipo por defecto del objeto Tipo
	$tipo->pks = array('idTipo'=>$campos['idTipo']);
	$tipo->prepCampo('nombre');
	$res = $tipo->consultarCampos();
	$nomTipo = $res['nombre'];
}

$conex->desconectar();

function tituloWeb($campos){
	if(empty($campos))
		$titulo = '<title>Sotneve - Crear Evento</title>';
	else
		$titulo = sprintf('<title>Sotneve - Editar "%s"</title>', $campos['titulo']);

	echo $titulo;
}

function tituloEvento($campos){
	if(empty($campos))
		$titulo = '<span class="h1" id="ev_titulo">Crear Evento</span>';
	else
		$titulo = sprintf('<span class="h1" id="ev_titulo">Editar "%s"</span>', $campos['titulo']);

	echo $titulo;
}

function inputTitulo($campos){
	if(empty($campos))
		$input = '<input class="evento" type="text" id="nomevento"  name="nomevento" />';
	else
		$input = sprintf('<input class="evento" type="text" id="nomevento"  value="%s" name="nomevento" />', $campos['titulo']);

	echo $input;
}

function inputNumPersonas($campos){
	if(!empty($campos))
		$input = sprintf('<input class="evento" type="text" id="numpersonas" name="numpersonas" value="%s" />', $campos['maxPersonas']);
	else
		$input = '<input class="evento" type="text" id="numpersonas" name="numpersonas"/>'; 

	echo $input;
}

//TODO: Empezar por la fecha actual
function selectDia($campos){
	echo '<select class="fecha" name="dia" id="dia">';

	$diaAct = -1;
	if(!empty($campos)){
		$diaAct = (int)substr($campos['fechaEvento'], 8, 2);
		$option = sprintf('<option value="%s">%s</option>', $diaAct, $diaAct);
		echo $option;
		echo '<option disabled="true">----</option>';
	}

	for ($i = 1; $i < 32; $i++) {
		if($i != $diaAct){
			$option = sprintf('<option value="%s">%s</option>', $i, $i);
			echo $option;
		}
	}

	echo '</select>';
}

function selectMes($campos){
	$mesAct = -1;
	if(!empty($campos))
		$mesAct = (int)substr($campos['fechaEvento'], 5, 2);

	$meses = array(
		1=>'Enero',
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

	echo '<select class="fecha" name="mes" id="mes">';
	if($mesAct != -1){
		$option = sprintf('<option value=%s> %s </option>\n', $mesAct, $meses[$mesAct]);
		echo $option;
		echo '<option disabled="true">-----------</option>';
	}
	foreach($meses as $index=>$mes){
		if($mesAct != $index){
			$option = sprintf('<option value=%s> %s </option>\n', $index, $mes);
			echo $option;
		}
	}
	echo '</select>';
}

function selectAno($campos){
	echo '<select class="fecha" name="ano" id="ano">';

	$anoAct = -1;
	if(!empty($campos)){
		$anoAct = (int)substr($campos['fechaEvento'], 0, 4);
		$option = sprintf('<option value="%s">%s</option>', $anoAct, $anoAct);
		echo $option;
		echo '<option disabled="true">--------</option>';
	}

	for ($i = 0; $i < 10; $i++) {
		$ano = "2011" + $i;
		if($ano != $anoAct){
			$option = sprintf('<option value="%s">%s</option>', $ano, $ano);
			echo $option;
		}
	}

	echo '</select>';
}

function selectHora($campos){
	echo '<select class="hora" name="hora" id="hora">';

	$horaAct = -1;
	if(!empty($campos)){
		$horaAct = (int)substr($campos['fechaEvento'], 11, 2);
		$option = sprintf('<option value="%s">%s</option>', $horaAct, $horaAct);
		echo $option;
		echo '<option disabled="true">----</option>';
	}

	for ($i=0; $i <24; $i++) {
		if($i != $horaAct){
			if($i<10)
				$hora = '0' . $i;
			else
				$hora = $i;
			$option = sprintf('<option value="%s">%s</option>\n',$hora,$hora);
		}
			
		echo $option;
	}

	echo '</select>';
}

function selectMinutos($campos){
	echo '<select class="hora" name="min" id="min">';

	$minutosAct = -1;
	if(!empty($campos)){
		$minutosAct = (int)substr($campos['fechaEvento'], 14, 2);
		$option = sprintf('<option value="%s">%s</option>', $minutosAct, $minutosAct);
		echo $option;
		echo '<option disabled="true">----</option>';
	}

	for ($i=0; $i <60 ; $i=$i+5) {
		if($i != $minutosAct){
		if($i<10)
			$minutos = '0' . $i;
		else
			$minutos = $i;

		$option = sprintf('<option value="%s"> %s </option>', $minutos, $minutos);
		echo $option;
		}
	}
							
	echo '</select>';
}

function selectProvincia($campos, $provincias){
	echo '<select name="provincia" id="ev_provincia">';

	$idProvAct = -1;
	if(!empty($campos)){
		$idProvAct = $campos['idProvincia'];
		$option = sprintf('<option value="%s">%s</option>', $idProvAct, $provincias[$idProvAct]);
		echo $option;
		echo '<option disabled="true">-----------</option>';
	}

	foreach ($provincias as $id => $prov) {
		if($id != $idProvAct){
			$option = sprintf('<option value="%s">%s</option>', $id, $prov);
			echo $option;
		}
	}

	echo '</select>';
}

function selectTipos($campos, $tipo,  $nomTipo){
	echo '<select name="tipos" id="ev_tipos">';

	if(!empty($campos)){
		$option = sprintf('<option value="%s">%s</option>', $campos['idTipo'], $nomTipo);
		echo $option;
		echo '<option disabled="true">-----------</option>';
	}

	$tipo->getArbolTipos();

	echo '</select>';
}

function inputLugar($campos){
	if(!empty($campos))
		$input = sprintf('<input class="evento" type="text" id="lugar" name="lugar" value = "%s"/>', $campos['lugar']);
	else
		$input = '<input class="evento" type="text" id="lugar" name="lugar"/>';

	echo $input;
}

function texareaDescripcion($campos){
	if(!empty($campos))
		$input = sprintf('<textarea id="descripcion" name="descripcion" rows="100" maxlength="249"> %s </textarea>', $campos['descripcion']);
	else
		$input = '<textarea id="descripcion" name="descripcion" rows="100" maxlength="249"></textarea>';

	echo $input;
}

function inputBoton($campos){
	if(empty($campos))
		$input = '<input class="enlaceEnmarcado" type="submit" id="create" value="Crear Evento"/>';
	else
		$input = sprintf('<input class="enlaceEnmarcado" type="submit" id="create" value=\'Actualizar "%s"\'/>', $campos['titulo']);

	echo $input;
						
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta content="text/xhtml; charset=UTF-8">
		</meta>
		<?php tituloWeb($campos); ?>
		<link rel="stylesheet" type="text/css" href="estilos/crear_evento.css" />
		<script type="text/javascript" src="../logica/scripts/buscar_evento.js"></script>
		<script type="text/javascript" src="../logica/scripts/crear_evento.js"></script>
	</head>
	<body>
		 
		<!-- Incluimos la cabecera -->
		<?php include ("head.php"); ?>

		<div class="contenido">
			<?php
				tituloEvento($campos);

				if(isset($_SESSION['err_campos_evento']) && $_SESSION['err_campos_evento']){
					echo "<span class='errorphp'>Debe rellenar todos los campos.</span>";
					$_SESSION['err_campos_evento'] = false;
				}
			?>

			<form id='evento' name="fval" action="../logica/crear_evento.php" method="post"   onsubmit="return valida()">
				<div class="filaform">
					<label for="nomevento"> T&iacute;tulo</label>
					<?php inputTitulo($campos); ?>
				</div>
				<div class="filaform">
					<label id="nump" for="numpersonas">N&uacute;mero de personas</label>
					<?php inputNumPersonas($campos); ?>
					<br/>
				</div>
				<div class="filaform">
					<label for="fechaevento">Fecha del Evento</label>
					<?php
						selectDia($campos);
						selectMes($campos);
						selectAno($campos);
					?>
				</div>

				<div class='filaform'>
					<label for="fechaevento">Hora del Evento</label>
					<?php
						selectHora($campos);
						selectMinutos($campos);
					?>
				</div>
				<div class="filaform">
					<label for="provincia">Provincia</label>
					<?php selectProvincia($campos, $provincias); ?>
				</div>
				<div class="filaform">
					<label for="tipos">Tipo</label>
					<?php selectTipos($campos, $tipo, $nomTipo); ?>
				</div>
				<div class="filaform">
					<label for="lugar">Lugar</label>
					<?php inputLugar($campos); ?>
				</div>
				<div class="filaform">
					<label for="descripcion" >Descripci&oacute;n</label>
					<?php texareaDescripcion($campos) ?>
				</div>
				<div class="filaform">
				<div class="cell"></div>
				<?php inputBoton($campos); ?>
				</div>

				<!-- Campo fantasma para distinguir entre crear y actualizar un evento -->
				<?php echo '<input name="actualizar" type="hidden" value="' . $idEvento . '" ></input>'; ?>
			</form>
		</div>
		<?php include ("footer.php"); ?>
	</body>
</html>
