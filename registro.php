<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>sotneve - Únete</title>
		<link rel="stylesheet" type="text/css" href="styles/registro.css" />
		<script type="text/javascript" src="scripts/registro.js"></script>
	</head>
	<body>
		<form name="form" method="post" action="insertarusuario.php" onsubmit="return esFormularioValido()">
			<fieldset>
				<h1>¡Únete a nosotros!</h1>
				<span id="errores">Corrige los campos en rojo, todos son obligatorios.</span>
				<?php
				if(isset($_GET['err_email'])){
					echo '<span id="erroremail">El email ya existe o es superior a 60 caracteres</span>';
				}
				if(isset($_GET['err_contrasena'])){
					echo '<span id="errorcontrasena">Contraseña incorrecta, ambas contraseña deben de coincidir y ser superior a 6 caracteres e inferior a 15</span>';
				}
				if(isset($_GET['err_campos'])){
					echo '<span id="errorcampos">Todos los campos son obligatorios</span>';
				}
				?>
				<hr />
				<div class="div1">
					<label id="idalias" for="alias" class="labelleft" onblur="esCampoNoVacio(this.id)">Alias:</label>
					<input type="text" name="alias" id="alias" class="inputleft"/>
					<label for="sexo" class="labelright">Sexo:</label>
					<select  name="sexo" id="sexo" class="inputright">
						<option> </option>
						<option value="Hombre">Hombre</option>
						<option value="Mujer">Mujer</option>
					</select>
				</div>
				<div class="div2">
					<label id="idnombre" for="nombre" class="labelleft" >Nombre:</label>
					<input type="text" name="nombre" id="nombre" class="inputleft" onblur="esCampoNoVacio(this.id)"/>
					<label class="labelright" for="apellidos">Apellidos:</label>
					<input type="text" name="apellidos" id="apellidos" class="inputright" onblur="esCampoNoVacio(this.id)" />
				</div>
				<div class="div3">
					<label class="labelleft" for="contrasena">Contraseña:</label>
					<input type="password" name="contrasena" id="contrasena" />
					<label class="labelright" for="recontrasena">Repite contraseña:</label>
					<input type="password" name="recontrasena" id="recontrasena" onblur="esMismaContrasena()"/>
				</div>
				<div class="div4">
					<label class="labelleft" for="email">Email:</label>
					<input type="text" name="email" id="email" onblur="esEmailValido()" />
					<label class="labelright">Fecha de nacimiento:</label>
					<input type="text" name="fechanac" id="fechanac" placeholder="dd/mm/aaaa"/>
				</div>
				<div class="div5">
					<label class="labelleft" for="provincia">Provincia:</label>
					<input type="text" name="provincia" id="provincia" />
				</div>

				<button type="submit" id="registrate">
					¡Registrate!
				</button>
			</fieldset>
		</form>
	</body>
</html>
