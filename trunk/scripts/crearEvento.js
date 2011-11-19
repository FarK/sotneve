function valida(){
			
		var factual=new Date()
		var dia=factual.getUTCDate()
		alert(dia)
	if(document.getElementById("numpersonas").value<=1)
			alert("Numero de personas Invalido")
		
			
	
	else if(document.getElementById("año").value<factual.getFullYear())
			alert("No puedes crear eventos para años ya finalizados")
	else if(document.getElementById("año").value=factual.getFullYear()&&document.getElementById("mes").value<factual.getMonth()+1)
			alert("No puedes crear eventos para meses que ya han finalizado")
			
	else if(document.getElementById("dia").value<=dia)
			alert("No puedes crear eventos para días que ya han pasado")	
	
}




