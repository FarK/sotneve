function esFormularioValido() {

	var ctrlAlias = document.getElementById("alias");
	var alias = ctrlAlias.value;
	
	var sexo = document.getElementById("sexo").value;
	var email = document.getElementById("email").value;
	var nombre = document.getElementById("nombre").value;
	var apellidos = document.getElementById("apellidos").value;
	var contrasena = document.getElementById("contrasena").value;
	var recontrasena = document.getElementById("recontrasena").value;
	var fechaNac = document.getElementById("fechanac").value;
	
	var res="No se ha podido completar el registro:\n"
	var valido=true;

	if(alias == "") {
		res=res+"- El campo alias no puede ser vacío\n";
		valido=false;
	}
	if(nombre == "") {
		res=res+"- El campo nombre no puede ser vacío\n";
		valido=false;
	}
	if (apellidos == "") {
		res=res+"- El campo apellidos no puede ser vacío\n";
		valido=false;		
	}
	
	if (contrasena!=recontrasena || contrasena.length<6 || contrasena.length>15){
		res=res+"- Las contraseñas no coinciden o bien son inferior a 6 caracteres o superior a 15\n";
		valido=false;
	}
	
	var patronEmail=/(\w)+@(\w)+\.((\w)+|.(\w)+)+$/;
	if (!patronEmail.test(email)){
		res=res+"- El email no es correcto\n";
		valido=false;
	}
	
	if(sexo!="Hombre" && sexo!="Mujer"){
		res=res+"- Selecciona un sexo\n";
		valido=false;
	}
	
	var patronFecha= /(0[1-9]|1[0-9]|2[0-9]|30|31)\/((0[1-9])|1[0-2])\/((19|20)[0-9]{2})/
	if(patronFecha="" || !(patronFecha.test(fechaNac))){
		res=res+"- La fecha de nacimiento no es correcta";
		valido=false;
	
	
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