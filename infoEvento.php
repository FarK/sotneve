<?php
    include 'includes/testSession.php';
	include_once 'BD/usuario.php';
	include 'BD/evento.php';
	
	
	//Crear objeto evento
	$evento = new Evento($_GET["idEvento"]);
	//Comprobar si ha habido errores
	if($evento->error() == -2) //No pudo conectar
		header('Location:index.php?err_bd');	//Redirecconar con GET a error
	
	else if($evento->error() == -1)//no existe el evento (o ha fallado la consulta)
		header('Location:errores.php?error="eventNotFound"');


?>
