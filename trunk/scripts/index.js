
	function validaEmail(){
		var patronEmail=/^(.+)@(.+)$/;
		var email = document.getElementById("email").value;
		var correcto = patronEmail.test(email);
		if(correcto){
			document.getElementsByClassName("error")[0].style.display = "hidden";
			return true;
		}else{
			document.getElementsByClassName("error")[0].style.display = "block";
			return false;
		}
	}
	
	function validaPass(){
		var pass = document.getElementById("pass").value;
		var correcto = pass != "";
		if(correcto){
			document.getElementsByClassName("error")[1].style.display = "none";
			return true;
		}else{
			//Puesto a inline porque se ve más bonito
			document.getElementsByClassName("error")[1].style.display = "inline";
			return false;
		}
	}
	
	function validaForm(){
		/*Comprobando de 1 en 1 para que no haya evaluación perezosa*/
		var emailOK = validaEmail();
		var passOK = validaPass();
		return emailOK && passOK();
	}
	
