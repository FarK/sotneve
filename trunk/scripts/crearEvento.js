function valida() {

	var factual = new Date()
	var dia = factual.getUTCDate()
	var ano = factual.getFullYear();
	var mes = factual.getMonth();

	if(document.getElementById("numpersonas").value <= 1) {
		alert("Numero de personas Invalido");
	}

	if(document.getElementById("ano").value < factual.getFullYear()) {
		alert("No puedes crear eventos para años ya finalizados");
	} else if(document.getElementById("ano").value = factual.getFullYear() && document.getElementById("mes").value < factual.getMonth() + 1) {
		alert("No puedes crear eventos para meses que ya han finalizado");
	} else if(document.getElementById("dia").value <= dia) {
		alert("No puedes crear eventos para dias que ya han finalizado, ni para hoy mismo.");

	}
}