<?php
include ("../logica/test_session.php");
include ("../datos/conexion.php");
include ("../datos/provincia.php");

$conex = new Conexion();
$provincia = new Provincia($conex);
$provincias = $provincia ->getProvincias();
$conex->desconectar();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta content="text/xhtml; charset=UTF-8"></meta>
		<title>Sotneve - Crear Evento</title>
		<link rel="stylesheet" type="text/css" href="estilos/crear_evento.css" />
		<script type="text/javascript" src="../logica/scripts/buscar_evento.js"></script>

		<script type="text/javascript" src="../logica/scripts/crear_evento.js"></script>
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php
			include ("head.php");
		?>

		
		<div class="contenido">
			
		<h2>Crear Evento</h2>
		<?php
			if(isset($_SESSION['err_campos']) && $_SESSION['err_campos']){
				echo "<span class='errorphp'>Debe rellenar todos los campos.</span>";
				$_SESSION['err_campos'] = false;
			}
		?>
		<span class='error'>Debe rellenar todos los campos.</span>
			<div class="form">
				<form name="fval" action="../logica/crear_evento.php" method="post"   onsubmit="return valida()">
						<div class="filaform">
							<label for="nomevento"> T&iacute;tulo</label>
							<input type="text" id="nomevento"  value="" name="nomevento" />
						</div>
						<div class="filaform">
							<label id="nump" for="numpersonas">N&uacute;mero de personas</label>
							<input type="text" id="numpersonas" name="numpersonas"/>
							<br/>
						</div>
						<div class="filaform">
							<label for="fechaevento">Fecha del Evento</label>
							<select name="dia" id="dia">
								<option value="0"></option>
							<?php
								for ($i=1; $i <32 ; $i++) {
									$dia="0"+$i;
									$option = sprintf('<option value="%s">%s</option>',$dia,$dia); 
									echo $option;
								}
							?></select>
							<select name="mes" id="mes">
								<option value=""></option>
								<option value="01">Enero</option>
								<option value="02">Febrero</option>
								<option value="03">Marzo</option>
								<option value="04">Abril</option>
								<option value="05">Mayo</option>
								<option value="06">Junio</option>
								<option value="07">Julio</option>
								<option value="08">Agosto</option>
								<option value="09">Septiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
							</select>
							<select name="ano" id="ano">
								<option value="0"></option>
								<?php
									for ($i=0; $i <10 ; $i++) {
										 
										$ano="2011"+$i;
										$option= sprintf('<option value="%s">%s</option>',$ano,$ano);
										echo $option;
									}
							?></select>
						</div>
						<div class="filaform">
							<label for="provincia">Provincia</label>
							<select name="provincia" id="ev_provincia">
								<option value="0"></option>
								<?php
								foreach ($provincias as $id=>$prov) {
									$option = sprintf('<option value="%s">%s</option>', $id, $prov);
									echo $option;
								}
								?>
							</select>
							
						</div>
						<div class="filaform">
							<label for="lugar">Lugar</label>
							<input type="text" id="lugar" name="lugar"/>
							
						</div>
						<div class="filaform">
							<label for="descripcion" >Descripci&oacute;n</label>
							<textarea id="descripcion" name="descripcion" rows="100" maxlength="249"></textarea>											
							
						</div>
						<input class="enlaceEnmarcado" type="submit" id="create" value="Crear Evento"/>
				</form>
			</div>
		</div>
			<?php include("footer.php"); ?>
		
	</body>
</html>
