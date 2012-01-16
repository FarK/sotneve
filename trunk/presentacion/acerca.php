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
				echo "<a href='../index.php'>Volver</a>";
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
				<ul>
					<li>Alejandro Molinas Salas</li>
					<li>Jesus Vacas Bomb&iacute;n</li>
					<li>Rafael Espillaque Espinosa</li>
					<li>Carlos Falgueras Garc&iacute;a</li>
					<li>Antonio Rodriguez Jim&eacute;nez</li>
				</ul>
			</div>
			<div id="videoImg">
			<img src="recursos/imagenes/esquema_relacional.png" alt="Esquema Relacional"/>
			<video controls="">
				<source type="video/webm" src="recursos/videos/tu_video.webm"></source>
			</video>
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
							<dd>Todas las paginas tiene su archivo en la carpeta de presentaci&oacute;, encargado de generar la estructura xhtml</dd>

							<dt>Head y footer</dt>
							<dd>C&oacute;digo php que genera las estructuras xhtml de la cabecera y el pie de p&aacute;gina. Este c&oacute;digo se importa desde las dem&aacute;s clases</dd>

							<dt>Recursos</dt>
							<dd>Carpeta d&oacute;nde guardamos los recursos multimedia de nuestra aplicaci&oacute;n</dd>
						</dl>
					</dd>

					<dt>CAPA DE DATOS</dt>
					<dd>
						<dl>
							<dt>Clase Conexi&oacute;n</dt>
							<dd>Se encarga de gestionar la conexi&oacute;n con la base de datos y las consultas a trav&eacute;s de la calse PDO</dd>
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
							<dd>Todos los formularios tiene su p&aacute;gina en la capa de l&oacute;gica que se encarga
							de validar el formulario en el servidor</dd>

							<dt>TestSesion</dt>
							<dd>Una peque&ntilde;a porci&oacute;n de c&oacute;digo php que testea si el usuario est&aacute; o no logeado
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
				<span class="h2"> Lista de features</span>
				<ul>
					<li>SEGURIDAD
						<ul>
							<li>Validaci&oacute;n en cliente y servidor de todos los formularios</li>
							<li>Encriptaci&oacute;n de las contrase&ntilde;as de los usuarios en SHA256</li>
							<li>Solo el usuario propietario puede edirar su evento</li>
							<li>Solo el usuario en editar lo relacionado con su perfil (favoritos, nombre, contrase&ntilde;a...)</li>
						</ul>
					</li>

					<li>DISE&Ntilde;O y FUNCIONALIDAD
						<ul>
							<li>Maquetaci&oacute;n intensiva y estructurada de todas las p&aacute;ginas en css</li>
							<li>Cabecera con men&uacute; superior de navegaci&oacute;n y buscador</li>
							<li>Buscador de eventos con 4 tipos de consultas distintas</li>
							<li>P&aacute;gina principal con enlaces a tus favoritos, tus eventos y eventos de tu provincia</li>
							<li>Posibilidad de crear y editar eventos</li>
							<li>Posibilidad de editar informaci&oacute;n de tu perfil</li>
							<li>Se puede eligir la publicaci&oacute;n o no de tu email, nombre, sexo, etc...</li>
							<li>Elimincaci&oacute;n y agragaci&oacute;n de favoritos con AJAX</li>
							<li>Facilidad de afiliaci&oacute;n y desafiliaci&oacute;n de eventos</li>
							<li>Se resaltan los eventos completos</li>
							<li>Se resaltan los campos erroreos en la validaci&oacute;n de los formularios</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="lista">
				<span class="h2"> Lista de control de trabajo en grupo </span>
				<ul>
					<li>Evaluación Basica
						<ul>
							<li>Entrega correcta de la práctica </li>
							<li>Instalación correcta (index.html/php) </li>
							<li>Ausencia de errores de programación</li>
							<li>Uso marcado HTML/XHTML estricto. Si, en cada página de presentacion.</li>
							<li>Uso de CSS en archivos externos. Si.</li>
							<li>Maquetacion CSS en todas las paginas. Si.</li>
							<li>Formularios. Si, registro, crear_evento...</li>
							<li>Validacion en cliente de todos los formularios. Si, usando javascript</li>
							<li>Validacion en servidor de todos los formularios. Si, en la capa de logica</li>
							<li>Base de datos (3FN). Si</li>
							<li>Inserción en BD. Si, al registrar un usuario por ejemplo.</li>
							<li>Actualizacion en la BD, si al cambiar los datos personales.</li>
							<li>Borrado en la BD. Si, al eliminar un favorito por ejemplo.</li>
							<li>Consulta a BD formateando resultados en tabla HTML. Si, en los resultados de la busqueda.</li>
							<li>Tratamiento de errores de acceso a BD en servidor. Si, haciendo uso del objeto conexion que gestiona dichos errores</li>
						</ul>
					</li>
										<li>Evaluacion Avanzada
						<ul>
							<li>Página de descripción de la aplicacion en HTML. Si, esta misma.</li>
							<li>Uso avanzado de JavaScript. Si.</li>
							<li>Uso de expresiones regulares en JavaScript o PHP. Si, cuando validamos formularios. ej: registro</li>
							<li>Facilidad de navegacion. Si</li>
							<li>Usabilidad de la aplicacion. Si</li>
							<li>Modularidad del codigo en cliente. ?????????</li>
							<li>Modularidad del codigo en servidor. Si, muy modular.</li>
							<li>Complejidad de la base de datos. Si, 7 tablas relacionadas</li>
							<li>Integridad referencial. ???????</li>
							<li>Uso de sesion en PHP. Si, para el login, y transmision de variables entre paginas</li>
							<li>Legibilidad del codigo. Si</li>
							<li>HTML validado por W3C. Si</li>
							<li>CSS validado por W3C.Todavia no</li>
							<li>Otros conocimientos. Si, ajax para añadir favoritos y inscribirse en eventos. HTML5 para el video</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<?php include ('footer.php'); ?>
	</body>
</html>
