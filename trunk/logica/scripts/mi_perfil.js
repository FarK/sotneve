function esFormularioValido() {

	alert("En Construccion");
	return false;

}


function esCampoNoVacio(id){
		
	var ctrlCampo = document.getElementById(id);
	var ctrlErrores = document.getElementById("errores");
	var campo = ctrlCampo.value;
	if(campo == "") {
		ctrlCampo.style.borderColor="red";	
		ctrlErrores.style.visibility="visible";	
	}else{
		ctrlCampo.style.borderColor="#418eb6";
	}
}

function esMismaContrasena(){
	var ctrlErrores = document.getElementById("errores");
	var ctrlRecontrasena = document.getElementById("recontrasena");
	var recontrasena = ctrlRecontrasena.value;
	var ctrlContrasena = document.getElementById("contrasena");
	var contrasena = ctrlContrasena.value;

	if(contrasena!=recontrasena){
		ctrlContrasena.style.borderColor="red";
		ctrlRecontrasena.style.borderColor="red";
		ctrlErrores.style.visibility="visible";	
		alert("Las contrase\u00f1as no coinciden, le recomendamos que vuelva a escribir ambos campos");
	}else{
		ctrlContrasena.style.borderColor="#418eb6";
		ctrlRecontrasena.style.borderColor="#418eb6";
	}
	
}

function esEmailValido(){
	var ctrlErrores = document.getElementById("errores");
	var ctrlEmail= document.getElementById("email");
	var email= ctrlEmail.value;
{	var patronEmail=/^(.+)@(.+)$/;}
	
	if(!patronEmail.test(email)){
		ctrlErrores.style.visibility="visible";	
		ctrlEmail.style.borderColor="red";	
		//alert("Email no valido");
	}else{
		ctrlEmail.style.borderColor="#418eb6";
	}

}