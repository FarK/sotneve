function valida() {

	var factual = new Date()
	var dia = factual.getUTCDate()
	var ano = factual.getFullYear();
	var mes = factual.getMonth();

	if(document.getElementById("numpersonas").value <= 1) {
		alert("El numero de personas debe ser mayor que 1");
		return false;
	}

	if(document.getElementById("ano").value < ano) {
		alert("No puedes crear eventos para años ya finalizados");
		return false;
	} else if(document.getElementById("ano").value == ano && document.getElementById("mes").value < mes) {
		alert("No puedes crear eventos para meses que ya han finalizado");
		return false;
	} else if(document.getElementById("ano").value == ano && document.getElementById("mes").value < mes && document.getElementById("dia").value < dia) {
		alert("No puedes crear eventos para dias que ya han finalizado");
		return false;
	}
	
	return true;
}