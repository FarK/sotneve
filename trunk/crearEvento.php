<?php include ("includes/testSession.php"); ?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- IMPORTANTE ESA L�NEA DE AH� ARRIBA Y LA DE ABAJO!!!  -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA L�NEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sotneve - Crear Evento</title>
		<link rel="stylesheet" type="text/css" href="styles/styleEvento.css" />
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php include ("includes/head.php"); ?>
	
		<div class="cabecera">
				<fieldset class="cab">
				</fieldset>
			
			</div>
		<div class="contenido">
			<div class="form">
			<form>
				<fieldset     class="cont">
					<div class="diva">
				<label for="nomevento"> Titulo</label>
				<input type="text" id="nomevento" class="right"><br>
			</div><br>
					<div class="divb">
				<label id="nump" for="numpersonas">Num personas</label>
				<input type="text" id="numpersonas"><br>
			</div><br>
					<div class="divc">
				<label for="provincia"> Provincia</label>
				<input type="text" id="provincia"><br>
				</div><br>
					<div class="divd">
				<label for="compostal">Cod.Postal</label>
				<input type="text" id="compostal"><br>
			</div><br>
					<div class="dive">
				<label for="fechaevento">Fecha del Evento</label>
				<input type="text" id="fechaevento"><br>
			</div><br>
					<div class="divf">
				<label for="comaut">Comunidad aut&ocute;noma</label>
				<select name="comaut" size="1">
				<option value="s">sevilla</option>
				<option value="c">cadiz</option>
				<option value="m">malaga</option> 
				</select>
			</div><br>
					<div class="divg">
				<label for="localidad">Localidad</label>
				<input type="text" id="localidad"><br>
			</div><br>
					<div class="divh">
				<label for="descripcion">Descripcion</label>
				<input type="text" id="Descripcion"><br>
			</div><br>
					<div class="divi">
				<label for="lugar">lugar</label>
				<input type="text" id="lugar"><br>
			</div><br>
				
				</fieldset>
			</form>
		</div></div>
		<div class="barraiz">
			</div>
		<div class="barrader">
		
		</div>
		
		

	</body>
</html>
