function esFormularioValido() {

	var ctrlAlias = document.getElementById("alias");
	var alias = ctrlAlias.value;

	/*var nombre=document.getElementById("nombre");
	 var apellidos=document.getElementById("apellidos");
	 var sexo=document.getElementById("sexo");*/
	if(alias == "") {
		alert("Escribe un alias");
		return false;
	}

}