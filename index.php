<?php
session_start();

if (isset($_SESSION['idUsuario'])) {
	header('Location:presentacion/principal.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- IMPORTANTE ESA LÍNEA DE AHÍ ARRIBA Y LA DE ABAJO!!!  -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8"/>
		<title>Sotneve - Login</title>
		<link rel="stylesheet" type="text/css" href="presentacion/estilos/index.css"/>
		<script type="text/javascript" src="logica/scripts/index.js"></script>
	</head>
	<body>
		<div class="contenido">
			<form id="login_form" method="post" action="logica/login.php" onsubmit="return validaForm()">
				<fieldset>
					<legend>
						Login
					</legend>
					<h1>BIENVENIDO A SOTNEVE</h1>
					<span class="error">Inserte un correo electr&oacute;nico v&aacute;lido</span>
					<span class="error">El campo contrase&ntilde;a no puede estar vac&iacute;o</span>
					<?php
					if (isset($_SESSION['err_pass']) && $_SESSION['err_pass']) {
						echo "<span class='errorserv' >Usuario o contrase&ntilde;a incorrecto</span>";
						$_SESSION['err_pass'] = false;
					}
					?>
					<br/>
					<!--Se puede usar : o debe usar codigo ascii? -->
					<label for="email" class="normal"> Correo electr&oacute;nico </label>
					<input id="email" name="email" type="text"  onchange="validaEmail()" onclick="onClickEmail()" value="Email"/>
					<label for="pass" class="normal"> Contrase&ntilde;a: </label>
					<input id="pass" name="pass" type="password"  onblur="validaPass()" onclick="onClickPass()" value="Password"/>
					<input name="Send" type="submit" value="Entrar"/>
					<div class="espacioBlanco"></div>
					<a id="registrarse" href="presentacion/registro.php">Registrarse</a>
				</fieldset>
			</form>
			<img id="logop" src="presentacion/recursos/imagenes/logo.png" alt="Inicio"></img>
		</div>
		<?php
		include 'presentacion/footer.php';
		?>
	</body>
</html>
