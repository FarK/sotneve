function esFormularioValido() {

	var ctrlAlias = document.getElementById("alias");
	var alias = ctrlAlias.value;
	
	var sexo = document.getElementById("sexo").value;
	var email = document.getElementById("email").value;
	var nombre = document.getElementById("nombre").value;
	var apellidos = document.getElementById("apellidos").value;
	var contrasena = document.getElementById("contrasena").value;
	var recontrasena = document.getElementById("recontrasena").value;
	
	var res="Error "
	var valido=true;

	if(alias == "") {
		res=res+", el alias no puede ser vacio";
		valido=false;
	}
	if(nombre == "") {
		res=res+", el nombre no puede ser vacio";
		valido=false;
	}
	if (apellidos == "") {
		res=res+", los apellidos no pueden ser vacio";
		valido=false;		
	}
	
	if (contrasena!=recontrasena || contrasena.length<6 || contrasena.length>15){
		res=res+", las contraseñas no coinciden o bien son inferior a 6 caracteres o superior a 15";
		valido=false;
	}
	
	var patronEmail=/^(.+)@(.+)$/;
	if (!patronEmail.test(email)){
		res=res+", el email no es correcto";
	}
	
	if(sexo!="Hombre" || sexo!="Mujer"){
		res=res+", selecciona un sexo";
	}
	
	
	
	
	
	
	if(valido){
		return true;
	}else{
		alert(res);
		return false;
	}

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
		//alert("Las contrase\u00f1as no coinciden, le recomendamos que vuelva a escribir ambos campos");
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