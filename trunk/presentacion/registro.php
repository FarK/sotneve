<?php
include_once('../datos/conexion.php');
include_once('../datos/provincia.php');

session_start();
$conexion = new Conexion();
$provincia = new Provincia($conexion);

$provincias = $provincia->getProvincias();


//Comprobamos si los campos del registro están o no seteados en _SESSION
//Si el primero está seteado lo estarán todos, si no los seteamos como cadena vacía
if(!isset($_SESSION['alias'])){
	$_SESSION['alias'] = "";
	$_SESSION['nombre'] = "";
	$_SESSION['apellidos'] = "";
	$_SESSION['email'] = "";
}

function selectDia() {
	echo '<select class="fecha" name="dia" id="dia">';
	echo '<option value="0">D&iacute;a</option>';

	for ($i = 1; $i < 32; $i++)
		echo sprintf('<option value="%s">%s</option>', $i, $i);

	echo '</select>';
}

function selectMes() {
	$meses = array(1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
		'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

	echo '<select class="fecha" name="mes" id="mes">';
	echo '<option value="0">Mes</option>';

	foreach($meses as $index=>$mes){
		$option = sprintf('<option value="%s"> %s </option>', $index, $mes);
		echo $option;
	}

	echo '</select>';
}

function selectAno() {
	echo '<select class="fecha" name="ano" id="ano">';
	echo '<option value="0">A&ntilde;o</option>';

	for ($i = date('Y') ; $i > 1900 ; --$i) {
		$option = sprintf('<option value="%s">%s</option>', $i, $i);
		echo $option;
	}

	echo '</select>';
}

function selectProvincias($provincias){
	echo '<select  name="provincia" id="provincia" class="cellSelect">';
	echo '<option value="0"></option>';

	foreach ($provincias as $id=>$prov) {
		$option = sprintf('<option value="%s">%s</option>', $id, htmlentities($prov));
		echo $option;
	}

	echo '</select>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
		<title>sotneve - &Uacute;nete</title>
		<link rel="stylesheet" type="text/css" href="estilos/registro.css" />
		<script type="text/javascript" src="../logica/scripts/registro.js"></script>
	</head>
	<body>
		<form id="registro"  method="post" action="../logica/registro.php" onsubmit="return esFormularioValido()">
			<div><span class="h1">&iexcl;&Uacute;nete a nosotros!</span>
			<span id="errores">Corrige los campos en rojo, todos son obligatorios.</span>
			</div><?php
			if(isset($_SESSION['err_registro'])){
				if($_SESSION['err_registro'] & 1)
					echo '<span class="error">El usuario ya existe</span>';

				if($_SESSION['err_registro'] & 2)
					echo '<span class="error">El email ya existe</span>';

				else
					echo '<span class="error">Ha ocurrido algún error</span>';

				unset($_SESSION['err_registro']);
			}
			?>
			<div class="row">
				<label id="idalias" for="alias" class="labelleft">Alias:</label>
				<input type="text" name="alias" id="alias"  value="<?php echo $_SESSION['alias']?>" onblur="esCampoNoVacio(this.id)"/>
				<label for="sexo" class="labelright">Sexo:</label>
				<select name="sexo" id="sexo" class="cellSelect">
					<option> </option>
					<option value="1">Hombre</option>
					<option value="0">Mujer</option>
				</select>
			</div>
			<div class="row">
				<label id="idnombre" for="nombre" class="labelleft" >Nombre:</label>
				<input type="text" name="nombre" id="nombre"  value="<?php echo $_SESSION['nombre']?>" onblur="esCampoNoVacio(this.id)"/>
				<label class="labelright" for="apellidos">Apellidos:</label>
				<input type="text" name="apellidos" id="apellidos"  value="<?php echo $_SESSION['apellidos']?>" onblur="esCampoNoVacio(this.id)" />
			</div>
			<div class="row">
				<label class="labelleft" for="contrasena">Contrase&ntilde;a:</label>
				<input type="password" name="contrasena" id="contrasena" />
				<label class="labelright" for="recontrasena">Repite contrase&ntilde;a:</label>
				<input type="password" name="recontrasena" id="recontrasena" onblur="esMismaContrasena()"/>
			</div>
			<div class="row">
				<label class="labelleft" for="email">Email:</label>
				<input type="text" name="email" id="email" value="<?php echo $_SESSION['email']?>" onblur="esEmailValido()"></input>
				<label class="labelright">Fecha de nacimiento:</label>
				<div id='fecha'>
				<?php
					selectDia();
					selectMes();
					selectAno();
					?>
				</div>
			</div>
			<div class="row">
				<label class="labelleft" for="provincia">Provincia:</label>
				<?php selectProvincias($provincias); ?>
			</div>

			<div><input type="submit" id="registrate" value="&iexcl;Reg&iacute;strate!"/>
			</div>
		</form>
	</body>
</html>
