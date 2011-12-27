<?php
include ("includes/testSession.php");
include_once ('BD/GestorBD.php');
include_once ('BD/usuario.php');

$bd = new GestorBD();

//Creamos un objeto usuario con el usuario logeado
$usuario = new Usuario($_SESSION['idUsuario']);
if ($usuario -> error() != 0) {
	header('Location:errores.php?error="usernotfound"');
}
function fechaNac($usuario) {

	$fechanac = $usuario -> getCampo('fechaNac');
	$ano = substr($fechanac, 0, 4);
	$mes = substr($fechanac, 5, 2);
	$dia = substr($fechanac, 8, 9);

	echo $dia . "/" . $mes . "/" . $ano;
}

function provinciaActual($bd, $usuario) {
	$valor = $usuario -> getCampo('provincia');
	$query = sprintf("SELECT nombre FROM provincias WHERE idProvincia=%s", $valor);
	$tuplas = $bd -> consulta($query);

	while ($fila = mysql_fetch_assoc($tuplas)) {
		$valor = $fila['nombre'];

	}

	$linea = sprintf(" Actualmente %s", $valor);
	echo $linea;
}

function creaPlaceHolder($usuario, $campo) {

	$valor = $usuario -> getCampo($campo);
	$linea = sprintf("placeholder='%s'", $valor);
	echo $linea;
}

function creaCheckBox($usuario, $campo) {
	$visibilidad = $usuario -> esVisible($campo);
	$visible = "";
	$check = "check";
	if ($visibilidad) {
		$visible = "checked=''";
	}
	$linea = sprintf("<input type='checkbox' class='visibilitybox' id='%s%s' value='%s%s' %s>", $check, $campo, $check, $campo, $visible);
	echo $linea;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta charset=utf-8" />
		<title>sotneve - Únete</title>
		<script type="text/javascript" src="scripts/editausuario.js"></script>
		<script type="text/javascript" src="scripts/buscarevento.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/general.css">
		<link rel="stylesheet" type="text/css" href="styles/editaUsuario.css">
		
		
	</head>
	<body>
	<!--<div class="contenedorgeneral"> -->
		<?php
			include ("includes/head.php");
		?>
		<h1>Edita tu perfil</h1>
				<span id="errores">Errores.</span>
		<form name="form" method="post" action="insertarcambiosperfil.php" onsubmit="return esFormularioValido()">
			
				<?php
				if (isset($_GET['err_email'])) {
					echo '<span id="erroremail">El email ya existe o es superior a 60 caracteres</span>';
				}
				if (isset($_GET['err_contrasena'])) {
					echo '<span id="errorcontrasena">Contrase&ntildea incorrecta, ambas contrase&ntildea deben de coincidir y ser superior a 6 caracteres e inferior a 15</span>';
				}
				if (isset($_GET['err_campos'])) {
					echo '<span id="errorcampos">Todos los campos son obligatorios</span>';
				}
				?>
				
				<div class="divf">
					<label for="sexo" class="labelleft">Sexo:</label>
					<select  name="sexo" id="sexo" class="inputvalor">
						<?php $sexo = $usuario -> getCampo('sexo');
						if ($sexo == 1) {
							echo "<option value='1'>Hombre</option>
<option value='0'>Mujer</option>";
						} else {
							echo "<option value='0'>Mujer</option>
<option value='1'>Hombre</option>";
						}
						?>
					</select>
					<?php creaCheckBox($usuario, $SEXO);?>
				</div>
				<div class="divf">
					<label id="idnombre" for="nombre" class="labelleft" >Nombre:</label>
					<input type="text" name="nombre" id="nombre" class="inputvalor" onblur="esCampoNoVacio(this.id)" <?php creaPlaceHolder($usuario, 'nombre')?>/>
					<?php creaCheckBox($usuario, $NOMBRE);?>
					</div>
					<div class="divf">
					<label class="labelleft" for="apellidos">Apellidos:</label>
					<input type="text" name="apellidos" id="apellidos" class="inputvalor" onblur="esCampoNoVacio(this.id)" <?php creaPlaceHolder($usuario, 'apellidos')?> />
					<?php creaCheckBox($usuario, $APELLIDOS);?>
				</div>
				<div class="divf">
					<label class="labelleft" for="contrasenaactual">Contrase&ntilde;a Actual:</label>
					<input type="password" class="inputvalor" name="contrasenaactual" id="contrasena" />
					</div>
					<div class="divf">
					<label class="labelleft" for="contrasena">Cambiar contrase&ntilde;a:</label>
					<input type="password" class="inputvalor" name="contrasena" id="contrasena" />
					</div>
					<div class="divf">
					<label class="labelleft" for="recontrasena">Repite contrase&ntilde;a</label>
					<input type="password" class="inputvalor" name="recontrasena" id="recontrasena" onblur="esMismaContrasena()"/>
				</div>
				<div class="divf">
					<label class="labelleft" for="email">Email:</label>
					<input type="text" class="inputvalor" name="email" id="email" onblur="esEmailValido()"  <?php creaPlaceHolder($usuario, 'email')?>/>
					<?php creaCheckBox($usuario, $EMAIL);?>
					</div>
					<div class="divf">
					<label class="labelleft">Fecha de nacimiento:</label>
					<input type="text" class="inputvalor" name="fechanac" id="fechanac"  placeholder="<?php fechaNac($usuario)?>"/>
					<?php creaCheckBox($usuario, $FECHA_NAC);?>
				</div>
				<div class="divf">
					<label class="labelleft" for="provincia">Provincia:</label>
					<select  class="inputvalor" name="provincia" id="provincia">
						<option value="0"><?php
						if ($bd -> conectar()) {
							provinciaActual($bd, $usuario);
							$bd -> desconectar();
						}
							?></option>
						<?php

						//Conectar a la bd
						if ($bd -> conectar()) {
							$query = sprintf("SELECT idProvincia, nombre FROM provincias");
							$tuplas = $bd -> consulta($query);
							while ($fila = mysql_fetch_assoc($tuplas)) {
								$idProvincia = $fila['idProvincia'];
								$nombre = $fila['nombre'];
								$option = sprintf('<option value="%s">%s</option>', $idProvincia, $nombre);
								echo $option;
							}
							$bd -> desconectar();
						} else {
							//Error aqui cuando aclaremos que vamos hacer con ellos
						}
						?>
					</select>
				</div>
				<button type="submit" id="registrate">
					Guardar
				</button>
		</form>
			<?php include("includes/footer.php"); ?>
		<!-- </div> -->
	</body>
</html>