<?php
include_once('../datos/conexion.php');
include_once('../datos/provincia.php');

session_start();//TODO hay que hacer algo con sesion luego mas abajo??

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta content="text/xhtml; charset="utf-8" >
		<title>sotneve - &Uacute;nete</title>
		<link rel="stylesheet" type="text/css" href="estilos/registro.css" />
		<script type="text/javascript" src="../logica/scripts/registro.js"></script>
	</head>
	<body>
		<form name="form" method="post" action="../logica/registro.php" onsubmit="return esFormularioValido()">
			<fieldset>
				<h1>&iexcl;&Uacute;nete a nosotros!</h1>
				<span id="errores">Corrige los campos en rojo, todos son obligatorios.</span>
				<?php
				if(isset($_SESSION['err_email']) && $_SESSION['err_email']){
					echo '<span class="error" id="erroremail">El email ya existe o es superior a 60 caracteres</span>';
					$_SESSION['err_email'] = false;
				}
				if(isset($_SESSION['err_contrasena']) && $_SESSION['err_contrasena']){
					echo '<span class="error" id="errorcontrasena">Contrase&ntilde;a incorrecta, ambas contrase&ntilde;a deben de coincidir y ser superior a 6 caracteres e inferior a 15</span>';
					$_SESSION['err_contrasena'] = false;
				}
				if(isset($_SESSION['err_campos']) && $_SESSION['err_campos']){
					echo '<span class="error" id="errorcampos">Todos los campos son obligatorios</span>';
					$_SESSION['err_campos'] = false;
				}
				?>
				<hr />
				<div class="div1">
					<label id="idalias" for="alias" class="labelleft" onblur="esCampoNoVacio(this.id)">Alias:</label>
					<input type="text" name="alias" id="alias" class="inputleft"/>
					<label for="sexo" class="labelright">Sexo:</label>
					<select  name="sexo" id="sexo" class="inputright">
						<option> </option>
						<option value="1">Hombre</option>
						<option value="0">Mujer</option>
					</select>
				</div>
				<div class="div2">
					<label id="idnombre" for="nombre" class="labelleft" >Nombre:</label>
					<input type="text" name="nombre" id="nombre" class="inputleft" onblur="esCampoNoVacio(this.id)"/>
					<label class="labelright" for="apellidos">Apellidos:</label>
					<input type="text" name="apellidos" id="apellidos" class="inputright" onblur="esCampoNoVacio(this.id)" />
				</div>
				<div class="div3">
					<label class="labelleft" for="contrasena">Contrase&ntilde;a:</label>
					<input type="password" name="contrasena" id="contrasena" />
					<label class="labelright" for="recontrasena">Repite contrase&ntilde;a:</label>
					<input type="password" name="recontrasena" id="recontrasena" onblur="esMismaContrasena()"/>
				</div>
				<div class="div4">
					<label class="labelleft" for="email">Email:</label>
					<input type="text" name="email" id="email" onblur="esEmailValido()" />
					<label class="labelright">Fecha de nacimiento:</label>
					<input type="text" name="fechanac" id="fechanac" value="dd/mm/aaaa" onclick="fechaClick()"/>
				</div>
				<div class="div5">
					<label class="labelleft" for="provincia">Provincia:</label>
					<select  name="provincia" id="provincia">
						<option value="0"></option>
						<?php
						//Crear objeto gestor bd
						$conexion = new Conexion();
						$provincia = new Provincia($conexion);
						
						$provincias = $provincia->getProvincias();
						foreach ($provincias as $id=>$prov) {
						$option = sprintf("<option value='%s'>%s</option>", $id, $prov);
						echo $option;
						}
						
						$conexion->desconectar();

							
						?>
					</select>
				</div>

				<button type="submit" id="registrate">
					&iexcl;Reg&iacute;strate!
				</button>
			</fieldset>
		</form>
	</body>
</html>
