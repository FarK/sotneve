<?php
include ("../logica/test_session.php");
include_once ('../datos/conexion.php');
include_once ('../datos/usuario.php');
include_once ('../datos/provincia.php');

//Para evitar warning con el timezone
date_default_timezone_set('Europe/Madrid');

//Creamos la conexion y las clases de consulta
$conexion = new Conexion();
$usuario = new Usuario($conexion, $_SESSION['idUsuario']);
$provincia = new Provincia($conexion);

//Hacemos las consultas
$usuario -> prepCampo('nombre');
$usuario -> prepCampo('apellidos');
$usuario -> prepCampo('email');
$usuario -> prepCampo('sexo');
$usuario -> prepCampo('fechaNac');
$usuario -> prepCampo('idProvincia');
$usuario -> prepCampo('visibilidad');
$campos = $usuario -> consultarCampos();
$provUsuario = $usuario -> getProvincia();
$provincias = $provincia -> getProvincias();

$conexion -> desconectar();

//Prepara la fecha a partir de la cadena que recibe
function selectDia($campos) {
	echo '<select class="fecha" name="dia" id="dia">';
	$diaAct = (int)substr($campos['fechaNac'], 8, 2);
	$option = sprintf('<option value="%s">%s</option>', $diaAct, $diaAct);
	echo $option;
	echo '<option disabled="disabled">----</option>';
	for ($i = 1; $i < 32; $i++) {
		if ($diaAct != $i){
			$option = sprintf('<option value="%s">%s</option>', $i, $i);
		echo $option;
		}
	}
	echo '</select>';
}

function selectMes($campos) {

	$mesAct = (int)substr($campos['fechaNac'], 5, 2);
	$meses = array(1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

	echo '<select class="fecha" name="mes" id="mes">';
	$option = sprintf('<option value="%s"> %s </option>', $mesAct, $meses[$mesAct]);
	echo $option;
	echo '<option disabled="disabled">-----------</option>';
	foreach($meses as $index=>$mes){
		if($mesAct != $index){
			$option = sprintf('<option value="%s"> %s </option>', $index, $mes);
			echo $option;
		}
	}
	echo '</select>';
}

function selectAno($campos) {
	echo '<select class="fecha" name="ano" id="ano">';
	$anoAct = (int)substr($campos['fechaNac'], 0, 4);
	$option = sprintf('<option value="%s">%s</option>', $anoAct, $anoAct);
	echo $option;
	echo '<option disabled="disabled">--------</option>';

	for ($i = date('Y') ; $i > 1900 ; --$i) {
		if ($anoAct != $i) {
			$option = sprintf('<option value="%s">%s</option>', $i, $i);
			echo $option;
		}
	}
	echo '</select>';
}

function fechaNac($fecha) {
	$ano = substr($fecha, 0, 4);
	$mes = substr($fecha, 5, 2);
	$dia = substr($fecha, 8, 9);

	echo $dia . "/" . $mes . "/" . $ano;
}

function creaCheckBox($campos, $campo) {
	$visible = "";
	$check = "check";
	if ($campos['visibilidad'] & $campo)
		$visible = 'checked="checked"';

	$linea = sprintf("<input type='checkbox' class='visibilitybox' name='%s%s' value='%s' %s></input>", $check, $campo, $campo, $visible);
	echo "<div class='cell'>";
	echo $linea;
	echo "</div>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
		<title>sotneve - Únete</title>
		<script type="text/javascript" src="../logica/scripts/mi_perfil.js"></script>
		<link rel="stylesheet" type="text/css" href="estilos/mi_perfil.css"/>
	</head>
	<body>
		<?php include ("head.php"); ?>
		<div class='contenido'>
			<span class="h1" id="titulo">Edita tu perfil</span>
			<?php
			if (isset($_SESSION['err_campos_perfil']) && $_SESSION['err_campos_perfil']) {
				echo '<span id="errores">Ha ocurrido algún error.</span>';
				$_SESSION['err_campos_perfil'] = false;
			}
			else if (isset($_SESSION['OK']) && $_SESSION['OK']){
				echo '<span id="OK">Tus datos se han actualizado con &eacute;xito</span>';
				$_SESSION['OK'] = false;
			}
			?>
			<form id='miPerfilForm'  method="post" action="../logica/mi_perfil.php" onsubmit="return esFormularioValido()">
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
					<div class='cell'>
					</div>
					<div class='cell'>
					</div>
					<div class='cell'>
					<label class="etiqueta">¿Es visible?</label>
					</div>
				</div>
				<div class="divf">
					<label class="etiqueta" for="nombre">Nombre:</label>
					<div class='cell'>
					<input type="text" class='info_input' id="nombre" name="nombre" onblur="esCampoNoVacio(this.id)"  value = "<?php echo $campos['nombre'];?>"/>
					</div>
					<?php      creaCheckBox($campos, $NOMBRE);?>
				</div>
				<div class="divf">
					<label class="etiqueta" for="apellidos">Apellidos:</label>
					<div class='cell'>
					<input type="text" name="apellidos" class="info_input"  id="apellidos" onblur="esCampoNoVacio(this.id)" value="<?php echo $campos['apellidos'];?>"/>
					</div>
					<?php      creaCheckBox($campos, $APELLIDOS);?>
				</div>
				<div class="divf">
					<label class="etiqueta" for="email">Email:</label>
					<div class='cell'>
					<input type="text" class="info_input" name="email" id="email" onblur="esEmailValido()" value = "<?php echo $campos['email'];?>"/>
					</div>
					<?php      creaCheckBox($campos, $EMAIL);?>
				</div>
				<div class="divf">
					<label class="etiqueta">Fecha de nacimiento:</label>
					<div id="fechaNac">
						<?php
						selectDia($campos);
						selectMes($campos);
						selectAno($campos);
						?>
					</div>
					<?php creaCheckBox($campos, $FECHA_NAC); ?>
					<!--<input type="text" class="info_input" name="fechanac" id="fechanac"  value = "<?php echo fechaNac($campos['fechaNac']);?>"/>-->
				</div>
				<div class="divf">
					<label class="etiqueta" for="provincia">Provincia:</label>
					<select  class="info_input" name="provincia" id="provincia">
						<?php
						//Ponemos la provincia actual como primera opcion del select
						$option = sprintf('<option value="%s">%s</option>', $provUsuario['idProvincia'],$provUsuario['nombre']);
						echo $option;

						//Ponemos todas las demás provincias
						foreach ($provincias as $idProv => $prov) {
							if ($idProv != $provUsuario['idProvincia']) {//No imprimimos 2 veces la misma provincia
								$option = sprintf('<option value="%s">%s</option>', $idProv,$prov);
								echo $option;
							}
						}
						?>
					</select>
					<?php      creaCheckBox($campos, $PROVINCIA);?>
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
					<?php      creaCheckBox($campos, $SEXO);?>
				</div>
				<div class="divf">
					<label class="etiqueta" for="contrasenaactual">Contrase&ntilde;a Actual:</label>
					<div class='cell'>
					<input type="password" class="info_input" name="contrasenaactual" id="contrasenaactual" />
					</div>
				</div>
				<div class="divf">
					<label class="etiqueta" for="contrasena">Cambiar contrase&ntilde;a:</label>
					<div class='cell'>
					<input type="password" class="info_input" name="contrasena" id="contrasena" />
					</div>
				</div>
				<div class="divf">
					<label class="etiqueta" for="recontrasena">Repite contrase&ntilde;a</label>
					<div class='cell'>
					<input type="password" class="info_input" name="recontrasena" id="recontrasena" onblur="esMismaContrasena()"/>
					</div>
				</div>
				<div class="divf">
					<div class='cell'>
					</div>
					<div class='cell'>
					<input type="submit" id="registrate" value="Guardar cambios"/>
					</div>
				</div>
			</form>
		</div>
		<?php include ("footer.php"); ?>
	</body>
</html>
