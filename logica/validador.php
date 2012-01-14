<?php
//Para evitar warning con el timezone
date_default_timezone_set('Europe/Madrid');

class Validador{
	private static $letrasPalabra = 'A-Za-zñáéíóúÁÉÍÓÚÜüàèìòùÀÈÌÒÙç.';

	//Un solo dígito
	public static function numero($string){
		return preg_match('/^[[:digit:]]$/', $string);
	}

	//Uno o más números segidos
	public static function cifra($string){
		return preg_match('/^[[:digit:]]+$/', $string);
	}

	//Una o más letras de las permitidas para una palabra
	public static function palabra($string){
		$patron = sprintf('/^[%s]+$/', Validador::$letrasPalabra, Validador::$letrasPalabra);
		return preg_match($patron, $string);
	}

	//Palabras separadas por espacios simples y sin terminar ni empezar en espacio
	public static function palabras($string){
		$patron = sprintf('/^[%s]+( [%s]+)*$/', Validador::$letrasPalabra, Validador::$letrasPalabra);
		return preg_match($patron, $string);
	}
	
	public static function email($string){
		return preg_match('/^\w+\.*\w*@\w+\.\w+$/', $string);
	}

	public static function fecha($dia, $mes, $ano){
		return checkdate($mes, $dia, $ano);
	}

	public static function fechaFutura($dia, $mes, $ano){
		return	Validador::fecha($dia, $mes, $ano) &&
			(strtotime(date('d-m-Y')) - strtotime($dia . '-' . $mes . '-' . $ano)) <= 0;
	}

	public static function fechaPasada($dia, $mes, $ano){
		return	Validador::fecha($dia, $mes, $ano) &&
			(strtotime(date('d-m-Y')) - strtotime($dia . '-' . $mes . '-' . $ano)) >= 0;
	}

	public static function passNueva($pass1, $pass2){
		return	strlen($pass1) >=  6 &&
			strlen($pass1) <= 15 &&
			strlen($pass2) >=  6 &&
			strlen($pass2) <= 15 &&
			$pass1 == $pass2;
	}

	public static function changePass($passActual, $passBD, $pass1, $pass2){
		return	(!strlen($passActual) && !strlen($pass1) && !strlen($pass2)) || 
			(Validador::passNueva($pass1, $pass2) &&
			(hash('sha256', $passActual)) == $passBD);
	}

	public static function idProvincia($string){
		return ((int)$string) >= 1 && ((int)$string) <= 52;
	}
}
?>
