<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<title>Acerca de...</title>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="estilos/acerca.css" />
		<script type="text/javascript" src="../logica/scripts/buscar_evento.js"></script>
	</head>
	<body>
		<div id="cabecera">
			<?php
			session_start();
			if (isset($_SESSION['idUsuario']))
				include ("head.php");
			else
				echo "<a id='enlaceLogo' href='../index.php'><img id='logo' src='recursos/imagenes/logoHead.png' alt='Inicio'></img></a>"
			?>
		</div>
		<div>
			<p id="nosotros">
				Esta p&aacute;gina ha sido desarrollada por un grupo de 5 compa&ntilde;eros para la asignatura de ABD.<br/>
				Este proyecto consiste en una aplicaci&oacute;n web d&oacute;nde los usuarios
 				registrados podr&aacute;n crear y/o unirse a eventos/grupos de diferentes actividades.<br/>
				
			</p>
			<div class="lista">
			<span class="h2">Programadores</span>
				<ul id="programadores">
					<li>Alejandro Molinas Salas</li>
					<li>Jesus Vacas Bomb&iacute;n</li>
					<li>Rafael Espillaque Espinosa</li>
					<li>Carlos Falgueras Garc&iacute;a</li>
					<li>Antonio Rodriguez Jim&eacute;nez</li>
				</ul>
				<img id="desarrolladores" src="recursos/imagenes/desarrolladores.jpg" alt="Programadores"/>
			</div>


			<div class="lista">
				<span class="h2"> Lista de features</span>
				<ul>
					<li>SEGURIDAD
						<ul>
							<li>Validaci&oacute;n en cliente y servidor de todos los formularios</li>
							<li>Encriptaci&oacute;n de las contrase&ntilde;as de los usuarios en SHA256</li>
							<li>S&oacute;lo el usuario propietario puede editar su evento</li>
							<li>S&oacute;lo el usuario en editar lo relacionado con su perfil (favoritos, nombre, contrase&ntilde;a...)</li>
						</ul>
					</li>

					<li>DISE&Ntilde;O y FUNCIONALIDAD
						<ul>
							<li>Maquetaci&oacute;n intensiva y estructurada de todas las p&aacute;ginas en CSS3</li>
							<li>Cabecera con men&uacute; superior de navegaci&oacute;n y buscador</li>
							<li>Buscador de eventos con 4 tipos de consultas distintas</li>
							<li>P&aacute;gina principal con enlaces a tus favoritos, tus eventos y eventos de tu provincia</li>
							<li>Posibilidad de crear y editar eventos</li>
							<li>Posibilidad de editar informaci&oacute;n de tu perfil</li>
							<li>Se puede eligir la publicaci&oacute;n o no de tu email, nombre, sexo, etc...</li>
							<li>Eliminaci&oacute;n y agregaci&oacute;n de favoritos con AJAX</li>
							<li>Facilidad de afiliaci&oacute;n y desafiliaci&oacute;n de eventos</li>
							<li>Se resaltan los eventos completos</li>
							<li>Se resaltan los campos err&oacute;neos en la validaci&oacute;n de los formularios</li>
						</ul>
					</li>
				</ul>
			</div>


			<div class="lista">
				<span class="h2"> Estructura del c&oacute;digo de la aplicaci&oacute;n </span>
				<p>
				Hemos estructurado el c&oacute;digo de manera que cada capa tiene asignada una carpeta.
				Todas las p&aacute;ginas tienen tres archivos con el mismo nombre, uno en cada carpeta de cada capa.
				</p>
				<dl>
					<dt>CAPA DE PRESENTACI&Oacute;N</dt>
					<dd>
						<dl>
							<dt>P&aacute;ginas de contenido</dt>
							<dd>Todas las paginas tienen su archivo en la carpeta de presentaci&oacute;, encargado de generar la estructura xhtml</dd>

							<dt>Head y footer</dt>
							<dd>C&oacute;digo php que genera las estructuras xhtml de la cabecera y el pie de p&aacute;gina. Este c&oacute;digo se importa desde las dem&aacute;s clases</dd>

							<dt>Recursos</dt>
							<dd>Carpeta donde guardamos los recursos multimedia de nuestra aplicaci&oacute;n</dd>
						</dl>
					</dd>

					<dt>CAPA DE DATOS</dt>
					<dd>
						<dl>
							<dt>Clase Conexi&oacute;n</dt>
							<dd>Se encarga de gestionar la conexi&oacute;n con la base de datos y las consultas a trav&eacute;s de la clase PDO</dd>
							<dt>Clase Tabla</dt>
							<dd>
							Se encarga de pasar a un array los statament de PDO.
							Tambi&eacute;n gestiona las consultas de campos determinados sobre una fila de una tabla espec&iacute;fica
							</dd>

							<dt>Clases hijas de Tabla</dt>
							<dd>Objetos que agrupan las consultas que se identifican con la tabla en cuesti&oacute;n</dd>
						</dl>
					</dd>

					<dt>CAPA DE L&Oacute;GICA</dt>
					<dd>
						<dl>
							<dt>Formularios</dt>
							<dd>Todos los formularios tienen su p&aacute;gina en la capa de l&oacute;gica que se encarga
							de validar el formulario en el servidor</dd>

							<dt>TestSesion</dt>
							<dd>Una peque&ntilde;a porci&oacute;n de c&oacute;digo php que testea si el usuario est&aacute; o no logueado
							y redirige al formulario de login en cado de que no lo est&eacute;</dd>

							<dt>Validador</dt>
							<dd>Clase php est&aacute;tica de apoyo para las validaciones</dd>

							<dt>Clases de apoyo para AJAX</dt>
							<dd>Generan el c&oacute;digo que va a reescribir AJAX</dd>
						</dl>
					</dd>
				</dl>
			</div>


			<div class="lista">
				<span class="h2"> Lista de puntos de control conseguidos</span>
				<ul>
					<li>Evaluación B&aacute;sica
						<ul>
							<li>Entrega correcta de la pr&aacute;ctica</li>
							<li>Instalaci&oacute;n correcta (index.html/php)</li>
							<li>Ausencia de errores de programaci&oacute;n</li>
							<li>Uso marcado HTML/XHTML estricto</li>
							<li>Uso de CSS en archivos externos</li>
							<li>Maquetacion CSS en todas las p&aacute;ginas</li>
							<li>Formularios</li>
							<li>Validaci&oacute;n en cliente de todos los formularios</li>
							<li>Validaci&oacute;n en servidor de todos los formularios</li>
							<li>Base de datos (3FN)</li>
							<li>Inserci&oacute;n en BD</li>
							<li>Actualizaci&oacute;n en la BD</li>
							<li>Borrado en la BD</li>
							<li>Consulta a BD formateando resultados en tabla HTML</li>
							<li>Tratamiento de errores de acceso a BD en servidor</li>
						</ul>
					</li>
					<li>Evaluaci&oacute;n Avanzada
						<ul>
							<li>P&aacute;gina de descripci&oacute;n de la aplicaci&oacute;n en HTML</li>
							<li>Uso avanzado de JavaScript</li>
							<li>Uso de expresiones regulares en JavaScript o PHP</li>
							<li>Facilidad de navegaci&oacute;n</li>
							<li>Usabilidad de la aplicaci&oacute;n</li>
							<li>Modularidad del c&oacute;digo en cliente</li>
							<li>Modularidad del c&oacute;digo en servidor</li>
							<li>Complejidad de la base de datos</li>
							<li>Integridad referencial</li>
							<li>Uso de sesi&oacute;n en PHP</li>
							<li>Legibilidad del c&oacute;digo</li>
							<li>HTML validado por W3C</li>
							<li>CSS validado por W3C</li>
							<li>Otros conocimientos</li>
						</ul>
					</li>
				</ul>
			</div>

			<div id="videoImg">
			<img src="recursos/imagenes/esquema_relacional.png" alt="Esquema Relacional"/>
			<img src="recursos/imagenes/loc.png" alt="Activity day"/>
			<img src="recursos/imagenes/activity_day.png" alt="Activity day"/>
			<img src="recursos/imagenes/activity_time.png" alt="Activity time"/>
			<video controls="">
				<source type="video/webm" src="recursos/videos/gource.webm"></source>
			</video>
			</div>
		</div>
		<?php include ('footer.php'); ?>
	</body>
</html>
