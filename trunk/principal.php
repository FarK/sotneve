<?php
	include_once('BD/GestorBD.php');
	session_start();
	if(!isset($_SESSION['logged']))
		header('Location:index.php');
		
	$usuarioActual = $_SESSION['idUsuario'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="styles/principal.css" />
	</head>
	<body>
		<div id="contenedor"> 
			<div id="cabecera">
				<h1>Cabecera</h1>
			</div> 
			<div id="wrapper"> 
				<div id="eventos"> 
					<p><strong>Eventos en [Sevilla(TODO)]</strong></p>
				</div> 
			</div> 
			
			<div id="favoritos"> 
				<p><strong>Tus favoritos</strong></p>
				<?php
				$bd = new GestorBD();
				if ($bd->conectar()) {
					$query = sprintf("SELECT * FROM favoritos WHERE idUsuario1= '%s'", $usuarioActual);
					$favoritos = $bd -> consulta($query);
					while ($fila = mysql_fetch_assoc($favoritos)) {
						$idUsuario2 = $fila['idUsuario2'];

						$usuarios = $bd->usuarioCon('idUsuario', $idUsuario2);
			
						while ($fila = mysql_fetch_assoc($usuarios)) {
							$alias = $fila['alias'];
							$p= sprintf("<span><a href='infoUsuario.php?idUsuario=%s'>%s</a></span>\n\t\t", $idUsuario2,$alias);
							echo $p;
						}
					}
					$bd->desconectar();
				}
				?>
			</div> 
			
			<div id="eventosUsuario"> 
				<p><strong>Tus eventos</strong></p>
			</div> 
			
		<div id="pie">
			<span>Pie</span>
		</div> 
	</div> 
	</body>
</html>