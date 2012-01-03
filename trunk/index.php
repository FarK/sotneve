<?php
session_start();

if (isset($_SESSION['idUsuario'])) {
	header('Location:principal.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- IMPORTANTE ESA LÍNEA DE AHÍ ARRIBA Y LA DE ABAJO!!!  -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8">
		</meta> <title>Sotneve - Login</title>
		<link rel="stylesheet" type="text/css" href="styles/index.css"/>
		<script type="text/javascript" src="scripts/index.js"></script>
	</head>
	<body>
		<div id="logoprincipal">
			<img id="logop" src="images/logo.jpg" alt="Inicio"></img>
		</div>
		<form id="login_form" method="post" action="login.php" onsubmit="return validaForm()">
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
				if (isset($_GET['err_bd']) && $_SESSION['err_bd']) {
					echo "<span class='errorserv'>No se pudo conectar a la base de datos.</span>";
					$_SESSION['err_bd'] = false;
				}
				?>
				<br/>
				<!--Se puede usar : o debe usar codigo ascii? -->
				<label for="email" class="normal"> Correo electr&oacute;nico </label>
				<input id="email" name="email" type="text"  onchange="validaEmail()" onclick="onClickEmail()" value="Email"/>
				<label for="pass" class="normal"> Contrase&ntilde;a: </label>
				<input id="pass" name="pass" type="password"  onblur="validaPass()" onclick="onClickPass()" value="Password"/>
				<input id="send" class="boton" name="Send" type="submit" value="Entrar"/>
				<a id="registrarse" href="registro.php">Registrarse</a>
			</fieldset>
		</form>
		<?php
		include 'includes/footer.php';
		?>
	</body>
</html>
