<HTML>
	<head>
		<title>Tus favoritos</title>
	</head>
	<body>
		
<?php

include_once ('BD/GestorBD.php');

session_start();
if(!$_SESSION['logged'])
	header('Location:index.php');

$bd = new GestorBD();

if ($bd -> conectar()) {



}

?>
		
	</body>
</HTML>