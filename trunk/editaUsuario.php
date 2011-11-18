<?php
include ("includes/testSession.php");
include_once ('BD/GestorBD.php');
include_once ('BD/usuario.php');

//Creamos un objeto usuario con el usuario logeado
$usuario= new Usuario($_SESSION['idUsuario']);
if ($usuario -> error() != 0){
		header('Location:errores.php?error="usernotfound"');
}

function creaCheckBox($usuario,$campo){
	$visibilidad=$usuario->esVisible($campo);
	$visible="";
	$check="check";
	if($visibilidad){ // TODO para carlos, es visible se llama abajo
		$visible="checked=''";
	}
	$linea=sprintf("<input type='checkbox' id='%s%s' value='%s%s' %s>" ,$check,$campo,$check,$campo,$visible);
	echo $linea;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>sotneve - Únete</title>
		<script type="text/javascript" src="scripts/registro.js"></script>
	</head>
	<body>
		<form name="form" method="post" action="insertarcambiosperfil.php" onsubmit="return esFormularioValido()">
			<fieldset>
				<h1>Edita tu perfil</h1>
				<hr />
				<div class="div1">
					<label for="sexo" class="labelright">Sexo:</label>
					<select  name="sexo" id="sexo" class="inputright">
						<?php $sexo=$usuario->getCampo('sexo');
						if($sexo==1){
							echo "<option value='1'>Hombre</option>
						          <option value='0'>Mujer</option>";
						}else{
							echo "<option value='0'>Mujer</option>
						          <option value='1'>Hombre</option>";
						}
						 ?>

					</select>
					<?php creaCheckBox($usuario,$SEXO);?>
				</div>
				<div class="div2">
					<label id="idnombre" for="nombre" class="labelleft" >Nombre:</label>
					<input type="text" name="nombre" id="nombre" class="inputleft" onblur="esCampoNoVacio(this.id)"/>
					
					<?php creaCheckBox($usuario,$NOMBRE);?>
					<label class="labelright" for="apellidos">Apellidos:</label>
					<input type="text" name="apellidos" id="apellidos" class="inputright" onblur="esCampoNoVacio(this.id)" />
					<?php creaCheckBox($usuario,$APELLIDOS);?>
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
					<?php creaCheckBox($usuario,$EMAIL);?>
					<label class="labelright">Fecha de nacimiento:</label>
					<input type="text" name="fechanac" id="fechanac" placeholder="dd/mm/aaaa"/>
					<?php creaCheckBox($usuario,$FECHA_NAC);?>
				</div>
				<div class="div5">
					<label class="labelleft" for="provincia">Provincia:</label>
					<select  name="provincia" id="provincia">
						<option value="0"></option>
						<?php
						
						include_once 'BD/GestorBD.php';
						//Crear objeto gestor bd
						$bd = new GestorBD();
						//Conectar a la bd
						if ($bd -> conectar()) {
						$query=sprintf("SELECT idProvincia, nombre FROM provincias");
						$tuplas=$bd->consulta($query);
						while ($fila = mysql_fetch_assoc($tuplas)) {
							$idProvincia = $fila['idProvincia'];
							$nombre=$fila['nombre'];
							$option=sprintf('<option value="%s">%s</option>',$idProvincia,$nombre);
							echo $option;
						}
						$bd->desconectar();
						}else{
							//Error aqui cuando aclaremos que vamos hacer con ellos
						}
							
						?>
					</select>
				</div>

				<button type="submit" id="registrate">
					Guardar
				</button>
			</fieldset>
		</form>
	</body>
</html>