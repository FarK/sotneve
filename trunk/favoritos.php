<HTML>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/favoritos.css" />
		<title>Tus favoritos</title>
		
	</head>
	<body>
		<div id=listafavoritos>
		<h1>Estos son tus favoritos!</h1>
		<?php

		include_once ('BD/GestorBD.php');

		// session_start();
		// if(!$_SESSION['logged'])
		// header('Location:index.php');

		$bd = new GestorBD();

		$idusuarioactual = 4;
		//POner un Id que exista

		if ($bd -> conectar()) {

			$query = sprintf("SELECT * FROM favoritos WHERE idUsuario1= '%s'", $idusuarioactual);
			$tuplas = $bd -> consulta($query);
			while ($fila = mysql_fetch_assoc($tuplas)) {
				$idUsuario2 = $fila['idUsuario2'];

				$query = sprintf("SELECT alias FROM usuarios WHERE idUsuario= '%s'", $idUsuario2);
				$aux = $bd -> consulta($query);
				
				
				while ($fila = mysql_fetch_assoc($aux)) {
					$alias = $fila['alias'];
					$span= sprintf("<span><a href='infoUsuario.php?idUsuario=%s'>%s</a></span>\n\t\t", $idUsuario2,$alias);
					echo $span;
				}
			}

		}
	?>
	</div>
	</body>
</HTML>