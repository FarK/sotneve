<?php
include ("includes/testSession.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta content="text/xhtml; charset=UTF-8"></meta>
		<title>Sotneve - Crear Evento</title>
		<link rel="stylesheet" type="text/css" href="styles/crear_evento.css" />
		<script type="text/javascript" src="scripts/buscarevento.js"></script>

		<script type="text/javascript" src="scripts/crearEvento.js"></script>
	</head>
	<body>
		<!-- Incluimos la cabecera -->
		<?php
			include ("includes/head.php");
		?>

		
		<div class="contenido">
			
		<h2>Crear Evento</h2>
		<?php
			if(isset($_SESSION['err_campos']) && $_SESSION['err_pass']){
				echo "<span class='error'>Debe rellenar todos los campos.</span>";
				$_SESSION['err_campos'] = false;
			}
		?>
			<div class="form">
				<form name="fval" onsubmit="return valida()">
						<div class="filaform">
							<label for="nomevento"> T&iacute;tulo</label>
							<input type="text" id="nomevento" name="nomevento" />
						</div>
						<div class="filaform">
							<label id="nump" for="numpersonas">N&uacute;mero de personas</label>
							<input type="text" id="numpersonas" />
							<br/>
						</div>
						<div class="filaform">
						<!-- Podríamos usar aquí AJAX para fechas como el 30 de febrero -->
							<label for="fechaevento">Fecha del Evento</label>
							<select name="dia" id="dia">
								<option value="01">1</option>
								<option value="02">2</option>
								<option value="03">3</option>
								<option value="04">4</option>
								<option value="05">5</option>
								<option value="06">6</option>
								<option value="07">7</option>
								<option value="08">8</option>
								<option value="09">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select>
							<select name="mes" id="mes">
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
								<option value="2010">2010</option>
								<option value="2011">2011</option>
								<option value="2012">2012</option>
								<option value="2013">2013</option>
								<option value="2014">2014</option>
							</select>
						</div>
						<div class="filaform">
							<label for="provincia">Provincia</label>
							<select name="provincia" id="provincia">
								<?php
								$conex = new Conexion();
								$provincia = new Provincia($conex);
								$provincias = $provincia ->getProvincias();
								$conex->desconectar();
								foreach ($provincias as $id=>$prov) {
									$option = sprintf("<option value='%s'>%s</option>", $id, $prov);
									echo $option;
								}
								?>
							</select>
							<br/>
						</div>
						<div class="filaform">
							<label for="lugar">Lugar</label>
							<input type="text" id="lugar"/>
							<br/>
						</div>
						<div class="filaform">
							<label for="descripcion" >Descripci&oacute;n</label>
							<input type="text" id="descripcion" />
							<br/>
						</div>
						<button type="submit" id="crea">
							Crear Evento
						</button>

				</form>
			</div>
		</div>
			<?php include("includes/footer.php"); ?>
		
	</body>
</html>
