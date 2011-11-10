<?php
	session_start();
	if(isset($_SESSION['logged'])){
		echo 'Ya estas logueado, cerrando sesion';
		//header('Location:TOOOOOOODOOOOOOOOOO');
		session_unset();
		session_destroy();
	}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- IMPORTANTE ESA LÍNEA DE AHÍ ARRIBA Y LA DE ABAJO!!!  -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<!-- IMPORTANTE ESA LÍNEA DE ABAJO!!!  -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sotneve - Login</title>
		<link rel="stylesheet" type="text/css" href="styles/index.css" />
		<script type="text/javascript" src="scripts/index.js"></script>
	</head>
	<body>
		<form id="login_form" method="post" action="login.php" onsubmit="return validaForm()"> 
			<fieldset>
				<legend>Login</legend> 
				<h1>BIENVENIDO A SOTNEVE</h1>
				<label class="error">Inserte un correo electr&oacute;nico v&aacute;lido</label>
				<label class="error">El campo contrase&ntilde;a no puede estar vac&iacute;o</label>
				<?php
				if(isset($_GET['err_pass'])){
					echo "<label class='errorserv' >Usuario o contrase&ntilde;a incorrecto</label>";
				}
				if(isset($_GET['err_bd']))
					echo "<label class='errorserv'>No se pudo conectar a la base de datos.</label></label>";
				?>
				<br/>
				<!--Se puede usar : o debe usar codigo ascii? -->
				<label for="email" class="normal"> Correo electr&oacute;nico </label>
				<input id="email" name="email" type="text" placeholder="Correo electr&oacute;nico" onchange="validaEmail()"/>
				<label for="pass" class="normal"> Contrase&ntilde;a: </label>
				<input id="pass" name="pass" type="password" placeholder="Contrase&ntilde;a" onblur="validaPass()"/>
				<input id="send" class="btn" name="Send" type="submit" value="Entrar"/>
			</fieldset>
		</form>

	</body>
</html>
