function valida() {
	
	
	var factual = new Date()
	var diaAct = factual.getUTCDate();
	var anoAct = factual.getFullYear();
	var mesAct = factual.getMonth()+1; //El +1 es porque getMonth cuenta los meses desde 0 a 11
		
	

	var ano = document.getElementById("ano").value;
	var mes = document.getElementById("mes").value;
	var dia = document.getElementById("dia").value;
	
	var titulo = document.getElementById("nomevento").value;
	var provincia = document.getElementById("ev_provincia").value;
	var lugar = document.getElementById("lugar").value;
	var descripcion = document.getElementById("descripcion").value;
	var numpersonas = document.getElementById("numpersonas").value;
	
	
	
	  if(titulo == "" || lugar == "" || descripcion == ""  || numpersonas == ""){
		 alert("Debe rellenar todos los campos");
		  return false;
		 }
		if(isNaN(numpersonas)){
			alert("El numero de personas tiene que ser numerico.")
		}
		
	  if(provincia == 0){
		  alert("Debe seleccionar una provincia");
		  return false;
		  }
	
	if(numpersonas <= 1) {
		 alert("El numero de personas debe ser mayor que 1");
		 return false;
	 }

	 if(ano < anoAct) {
		 alert("No puedes crear eventos para fechas ya finalizadas");
			return false;}
	   else if(ano == anoAct && mes < mesAct) {
		alert("No puedes crear eventos para fechas  ya  finalizadas");
		return false;
	} else if(ano == anoAct && mes == mesAct && dia < diaAct) {
		 alert("No puedes crear eventos para fechas  ya  finalizaas");
		 return false;
	}
 	
	return true;
}