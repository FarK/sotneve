function esFormularioValido() {
	
	


	var email = document.getElementById("email").value;
	var nombre = document.getElementById("nombre").value;
	var apellidos = document.getElementById("apellidos").value;
	var contrasenaactual = document.getElementById("contrasenaactual").value;
	var contrasena = document.getElementById("contrasena").value;
	var recontrasena = document.getElementById("recontrasena").value;
	var fechaNac = document.getElementById("fechaNac").value;

	var res = "No se ha podido completar el registro\n";
	var valido = true;
	function IsNumeric(val) {

    if (isNaN(parseFloat(val))) {
          return false;
	 }
	}
	if(nombre == "" || IsNumeric(nombre)) {
		
		res=res+"- El campo nombre no puede ser vacío\n";
		valido=false;
	}
	
	
	
	 if (apellidos == "" || IsNumeric(apellidos)) {
		  res=res+"- El campo apellidos no puede ser vacío\n";
		 valido=false;		
	  }
	  
	 
 	if(contrasena!="" || recontrasena!="" || contrasenaactual!=""){
	 if (contrasena!=recontrasena || contrasena.length<6 || contrasena.length>15){
		 res=res+"- Las contraseñas no coinciden o bien son inferior a 6 caracteres o superior a 15\n";
		valido=false;
	 }
	 	
 	 if(contrasenaactual<6 || contrasenaactual>15){
 	 	res=res+"- La contraseña actual es inferior a 6 caracteres o superior a 15\n";
		  valido=false;
 	 }
 	}
	var patronEmail=/(\w)+@(\w)+\.((\w)+|.(\w)+)+$/;
	 if (!patronEmail.test(email)){
		 res=res+"- El email no es correcto\n";
		 valido=false;
	 }

 if(valido){
		 
		 return true;
	 }else{
		 alert(res);
		 return false;
	 }
// 
// }
// 
// 
// function esCampoNoVacio(id){
// 		
	// var ctrlCampo = document.getElementById(id);
	// var ctrlErrores = document.getElementById("errores");
	// var campo = ctrlCampo.value;
	// if(campo == "") {
		// ctrlCampo.style.borderColor="red";	
		// ctrlErrores.style.visibility="visible";	
	// }else{
		// ctrlCampo.style.borderColor="#418eb6";
	// }
// }
// 
// function esMismaContrasena(){
	// var ctrlErrores = document.getElementById("errores");
	// var ctrlRecontrasena = document.getElementById("recontrasena");
	// var recontrasena = ctrlRecontrasena.value;
	// var ctrlContrasena = document.getElementById("contrasena");
	// var contrasena = ctrlContrasena.value;
// 
	// if(contrasena!=recontrasena){
		// ctrlContrasena.style.borderColor="red";
		// ctrlRecontrasena.style.borderColor="red";
		// ctrlErrores.style.visibility="visible";	
		// alert("Las contrase\u00f1as no coinciden, le recomendamos que vuelva a escribir ambos campos");
	// }else{
		// ctrlContrasena.style.borderColor="#418eb6";
		// ctrlRecontrasena.style.borderColor="#418eb6";
	// }
// 	
// }
// 
// function esEmailValido(){
	// var ctrlErrores = document.getElementById("errores");
	// var ctrlEmail= document.getElementById("email");
	// var email= ctrlEmail.value;
// {	var patronEmail=/^(.+)@(.+)$/;}
// 	
	// if(!patronEmail.test(email)){
		// ctrlErrores.style.visibility="visible";	
		// ctrlEmail.style.borderColor="red";	
		// //alert("Email no valido");
	// }else{
		// ctrlEmail.style.borderColor="#418eb6";
	// }

}