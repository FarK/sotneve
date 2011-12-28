<?php
include_once("conexion.php");
include_once("usuario.php");

$conexion = new conexion();

$usuario = new Usuario($conexion, 1);

$usuario->prepCampo('nombre');
$usuario->prepCampo('apellidos');
$arr = $usuario->consultarCampos();

echo $arr['nombre'] . "</br>";
echo $arr['apellidos'];
 /*
class A {
	var $atributo = 'valor inicial';
	public function __construct(){
		$this->atributo = 22;
	}

	function operacion() {
		echo 'Clase A:<br>';
		echo "El valor de \$atributo es $this->atributo<br>";
	}
}

Class B extends A {

	public function __construct(){
		parent::__construct();
		$this->atributo = 'valor cambiado';
	}
}

$a = new A();
$b = new B();

$a->operacion();
$b->operacion();
  */
?>
