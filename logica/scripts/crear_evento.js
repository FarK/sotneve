function valida() {
	var factual = new Date()
	var diaAct = factual.getUTCDate()
	var anoAct = factual.getFullYear();
	var mesAct = factual.getMonth();
	
	var ano = document.getElementById("ano").value;
	var mes = document.getElementById("mes").value;
	var dia = document.getElementById("dia").value;
	
	var titulo = document.getElementById("titulo").value;
	var provincia = document.getElementById("provincia").value;
	var lugar = document.getElementById("lugar").value;
	var descripcion = document.getElementById("descripcion").value;
	var numpersonas = document.getElementById("numpersonas").value;
	
	if(titulo == "" || lugar == "" || descripcion == "" || numpersonas = ""){
		alert("Debe rellenar todos los campos");
		return false;
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
		alert("No puedes crear eventos para años ya finalizados");
		return false;
	} else if(ano == anoAct && mes < mesAct) {
		alert("No puedes crear eventos para meses que ya han finalizado");
		return false;
	} else if(ano == anoAct && mes < mesAct && dia < diaAct) {
		alert("No puedes crear eventos para dias que ya han finalizado");
		return false;
	}
	
	return true;
}