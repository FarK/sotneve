<?php
    include 'includes/testSession.php';
	include_once 'BD/usuario.php';
	include 'BD/evento.php';
	
	
	//Crear objeto evento
	$evento = new Evento($_GET["idEvento"]);
	//Comprobar si ha habido errores
	if($evento->error() == -2) //No pudo conectar
		header('Location:index.php?err_bd');	//Redirecconar con GET a error
	
	else if($evento->error() == -1)//no existe el evento (o ha fallado la consulta)
		header('Location:errores.php?error="eventNotFound"');


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Sotneve - <?php echo $evento -> getCampo("titulo");?></title>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
		<link rel="stylesheet" type="text/css" href="styles/general.css">
	</head>
	<body>
		<div id="container">
			<div id="header">
				<!-- 	<div id="logo">
				<h1>Logo</h1>
				</div> -->
				<span><?php
				include 'includes/head.php';
					?></span>
			</div>
			<div id="wrapper">
				<div id="content">
					<h1><?php echo $evento -> getCampo("titulo");?></h1>
					<p>
						<strong>1) Informaci&oacute;n del evento:
						<br />
						</strong>
						<span>Lugar: <?php echo $evento -> getCampo('lugar');?></span>
						<br />
						<span>Fecha: <?php echo $evento -> getCampo('fechaEvento');?></span>
						<br />
						<span>Quedan <?php echo $evento->getCampo('maxPersonas')-$evento->getNumAsistentes()
							?> plazas restantes de <?php echo $evento -> getCampo('maxPersonas');?> participantes</span>
						<br />
						<span>Descripci&oacute;n: <?php echo $evento -> getCampo('descripcion');?></span>
						<br />
						<span>Creado por: <?php
						if ($bd -> conectar()) {
							$query = sprintf("SELECT alias FROM usuarios WHERE idUsuario=%s", $evento -> getCampo('propietario'));
							$tuplas = $bd -> consulta($query);
							while ($fila = mysql_fetch_assoc($tuplas)) {

								echo $idEvento2 = $fila['alias'];
							}
							$bd -> desconectar();
						}
							?></span>
						<br />
				</div>
			</div>
			<div id="navigation">
				<p>
					<strong> Van estas <?php echo $evento->getNumAsistentes()
					?> personas:
					<br />
					</strong>
					<?php
//include_once ('BD/evento.php');

//Crear objeto usuario
$evento = new Evento($_GET["idEvento"]);
$asistentes = $evento->getAsistentes();

//Comprobar si ha habido errores
if($evento->error() == -2) //No pudo conectar
header('Location:index.php?err_bd');	//Redirecconar con GET a error
else if($evento->error() == -1)//no existe el usuario (o ha fallado la consulta)
echo '<span> Actualmente no hay asistentes</span>';
foreach($asistentes as $asist){
$span= sprintf("<span><a href='infoUsuario.php?idUsuario=%s'>%s</a></span>\n\t\t", $asist['idUsuario'],$asist['alias']);
echo $span;
}
					?>
				</p>
			</div>
			<div id="extra">
				<p>
					<strong>Comentarios (no sabemos si implementarlo)
					<br />
					</strong> very text make long column make filler fill make column column silly filler text silly column fill silly fill column text filler make text silly filler make filler very silly make text very very text make long filler very make column make silly column fill silly column long make silly filler column filler silly long long column fill silly column very
				</p>
			</div>
			<div id="footer">
				<p>
					Sotneve 2011 &copy;
				</p>
			</div>
		</div>
	</body>
</html>
