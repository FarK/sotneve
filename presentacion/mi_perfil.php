<?php
include ("../logica/test_session.php");
include_once ('../datos/conexion.php');
include_once ('../datos/usuario.php');
include_once ('../datos/provincia.php');

//Creamos la conexion y las clases de consulta
$conexion = new Conexion();
$usuario = new Usuario($conexion, $_SESSION['idUsuario']);
$provincia = new Provincia($conexion);

//Hacemos las consultas
$usuario->prepCampo('nombre');
$usuario->prepCampo('apellidos');
$usuario->prepCampo('email');
$usuario->prepCampo('fechaNac');
$usuario->prepCampo('idProvincia');
$usuario->prepCampo('visibilidad');
$campos = $usuario->consultarCampos();
$provUsuario = $usuario->getProvincia();
$provincias = $provincia->getProvincias();

$conexion->desconectar();

//Prepara la fehca a partir de la cadena que recibe
function fechaNac($fecha) {
	$ano = substr($fecha, 0, 4);
	$mes = substr($fecha, 5, 2);
	$dia = substr($fecha, 8, 9);

	echo $dia . "/" . $mes . "/" . $ano;
}

function creaCheckBox($campos, $campo) {
	$visible = "";
	$check = "check";
	if($campos['visibilidad'] & $campo)
		$visible = "checked=''";

	$linea = sprintf("<input type='checkbox' class='visibilitybox' id='%s%s' value='%s%s' %s>", $check, $campo, $check, $campo, $visible);
	echo $linea;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>sotneve - Únete</title>
		<script type="text/javascript" src="estilos/editausuario.js"></script>

		<link rel="stylesheet" type="text/css" href="estilos/mi_perfil.css"/>
	</head>
	<body>
		<!--<div class="contenedorgeneral"> -->
		<?php
		include ("head.php");
		?>
		<h1>Edita tu perfil</h1>
		<?php
		if(isset($_SESSION['err_campos_perfil']) && $_SESSION['err_campos_perfil']){
			echo '<span id="errores">Ha ocurrido algún error.</span>';
			$_SESSION['err_campos_perfil'] = false;
		}
		?>
		<form name="form" method="post" action="../logica/mi_perfil.php" onsubmit="return esFormularioValido()">
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
				<label for="visible" class="etiqueta">¿Es visible?</label>
			</div>
			<div class="divf">
				<label for="sexo" class="etiqueta">Sexo:</label>
				<select  name="sexo" id="sexo" class="info_input">
					<?php
					if ($campos['sexo'] == 1) {
						echo "<option value='1'>Hombre</option>
								<option value='0'>Mujer</option>";
					} else {
						echo "<option value='0'>Mujer</option>
								<option value='1'>Hombre</option>";
					}
					?>
				</select>
				<?php creaCheckBox($campos, $SEXO);?>
				
			</div>
			<div class="divf">
				<label class="etiqueta" for="nombre">Nombre:</label>
				<input type="text" class='input' name="nombre" onblur="esCampoNoVacio(this.id)"  value = "<?php echo $campos['nombre'];?>"/>
				<?php creaCheckBox($campos, $NOMBRE);?>
			</div>
			<div class="divf">
				<label class="etiqueta" for="apellidos">Apellidos:</label>
				<input type="text" name="apellidos" class="info_input" onblur="esCampoNoVacio(this.id)" value="<?php echo $campos['apellidos'];?>"/>
				<?php creaCheckBox($campos, $APELLIDOS);?>
			</div>
			<div class="divf">
				<label class="etiqueta" for="email">Email:</label>
				<input type="text" class="info_input" name="email" id="email" onblur="esEmailValido()" value = "<?php echo $campos['email'];?>"/>
				<?php creaCheckBox($campos, $EMAIL);?>
			</div>
			<div class="divf">
				<label class="etiqueta">Fecha de nacimiento:</label>
				<input type="text" class="info_input" name="fechanac" id="fechanac"  value = "<?php echo fechaNac($campos['fechaNac']);?>"/>
				<?php creaCheckBox($campos, $FECHA_NAC);?>
			</div>
			<div class="divf">
				<label class="etiqueta" for="provincia">Provincia:</label>
				<select  class="info_input" name="provincia" id="provincia">
					<?php
						//Ponemos la provincia actual como primera opcion del select
						$option = sprintf('<option value="%s">%s</option>', $provUsuario['idProvincia'], $provUsuario['nombre']);
						echo $option;

						//Ponemos todas las demás provincias
						foreach($provincias as $idProv=>$prov){
							if($idProv != $provUsuario['idProvincia']){	//No imprimimos 2 veces la misma provincia
								$option = sprintf('<option value="%s">%s</option>', $idProv, $prov);
								echo $option;
							}
						}
					?>
				</select>
			</div>
			<div class="divf">
				<label class="etiqueta" for="contrasenaactual">Contrase&ntilde;a Actual:</label>
				<input type="password" class="info_input" name="contrasenaactual" id="contrasena" />
			</div>
			<div class="divf">
				<label class="etiqueta" for="contrasena">Cambiar contrase&ntilde;a:</label>
				<input type="password" class="info_input" name="contrasena" id="contrasena" />
			</div>
			<div class="divf">
				<label class="etiqueta" for="recontrasena">Repite contrase&ntilde;a</label>
				<input type="password" class="info_input" name="recontrasena" id="recontrasena" onblur="esMismaContrasena()"/>
			</div>
			<button type="submit" id="registrate">
				Guardar
			</button>
		</form>
		<?php
		include ("footer.php");
		?>
		<!-- </div> -->
	</body>
</html>
