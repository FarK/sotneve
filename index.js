
	function validaEmail(){
		var patronEmail=/^(.+)@(.+)$/;
		var email = document.getElementById("email").value;
		var mensaje = patronEmail.test(email)? "Todo correcto" : "Error en el email";
		alert(mensaje);
	}
	
