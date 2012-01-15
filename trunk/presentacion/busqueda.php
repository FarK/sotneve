<?php
include ("../logica/test_session.php");
include_once ('../datos/evento.php');
include_once ('../datos/conexion.php');
include_once ('../datos/tipo.php');
include_once ('../datos/provincia.php');

if(isset($_GET['provincia']) || isset($_GET['tipo'])){
	$idprovincia = $_GET["provincia"];
	$idtipo = $_GET["tipo"];
}
else{
	header('Location:errores.php?error="Busqueda no valida"');
}

$conexion = new Conexion();

$provincia = new Provincia($conexion, $idprovincia);
$provincia -> prepCampo("nombre");
$auxProv = $provincia -> consultarCampos();
$nomProvincia = $auxProv['nombre'];

$tipo = new Tipo($conexion, $idtipo);
$tipo -> prepCampo("nombre");
$auxTipo = $tipo -> consultarCampos();
$nomTipo = $auxTipo['nombre'];

$eventoObj = new Evento($conexion);

if ($idtipo == 0 && $idprovincia == 0)
	$eventos = $eventoObj -> getEventosVigentes();
elseif ($idtipo == 0 && $idprovincia != 0) 
	$eventos = $eventoObj -> getEventosProvinciaVigentes($idprovincia);
elseif ($idtipo !=0  && $idprovincia == 0) 
	$eventos = $eventoObj -> getEventosTipoVigentes($idtipo);
elseif ($idtipo != 0 && $idprovincia != 0) 
	$eventos = $eventoObj -> getEventosProvinciaTipoVigentes($idprovincia, $idtipo);

$enlaces = array();
foreach ($eventos as $evento) {
	$asistentes = count($eventoObj->getUsuarios($evento['idEvento']));

	$idLleno = '';
	if($asistentes == $evento['maxPersonas'])
		$idLleno = 'class="lleno"';

	$enlaces[] = sprintf("
		<tr>
		<td><a class='enlace' href='../presentacion/info_evento.php?&idEvento=%s'>%s</a></td>
		<td><span class='celda'>%s</span></td>
		<td><span %s class='celda'>[%s/%s]</span></td>
		</tr>
		",
		$evento['idEvento'], $evento['titulo'], $evento['lugar'], $idLleno, $asistentes, $evento['maxPersonas']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
		<title>Sotneve - Resultado Busqueda</title>
		<link rel="stylesheet" type="text/css" href="estilos/busqueda.css"/>
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php include ("../presentacion/head.php"); ?>

		<div class="contenido">
			<?php
			//Comprobamos si ha habido resultados
			if (empty($enlaces))
				echo '<span class="h1" id="sinResultados">No se ha encontrado ningún evento';
			else
				echo '<span class="h1">Todos los eventos';

			if ($idprovincia != 0)
				echo ' en ' . $nomProvincia;
			if ($idtipo !=0) 
				echo ' del tipo ' . $nomTipo;

			echo '</span>';
			?>

			<table>
				<tr>
				<th>Nombre</th>
				<th>Lugar</th>
				<th>Asistentes</th>
				</tr>
			<?php
			foreach ($enlaces as $enlace){
				echo $enlace;
			}
			?>
			</table>
		</div>

		<?php include ("footer.php"); ?>
	</body>
</html>
