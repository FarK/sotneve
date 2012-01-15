function iniciaAjax() {
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
		request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		request_type = new XMLHttpRequest();
	}
	return request_type;
}

var ajax = iniciaAjax();
var idEvento;

function inscribeEvento(idEv) {
	idEvento = idEv;
	document.getElementById('me_apunto').innerHTML = '<img id="add" src="recursos/imagenes/spinner.gif">Espere por favor';
	ajax.open('get', '../logica/inscribe_evento.php?idEv=' +idEvento);
	ajax.onreadystatechange = inscribeCallback;
	ajax.send(null);
}
function inscribeCallback() {
	if(ajax.readyState == 4){ 
		var response = ajax.responseText;
		document.getElementById('me_apunto').innerHTML = '<input type="image" id="add" src="recursos/imagenes/delete.png">Desinscribirse';
		document.getElementById('informacion').action = 'javascript:desinscribeEvento('+idEvento+')';
		if(response == "")
			document.getElementById('num_asistentes').innerHTML = "Ninguna persona asiste</br>";
		else
			document.getElementById('num_asistentes').innerHTML = "Asisten &eacute;stas personas:</br>";
		document.getElementById('asistentes').innerHTML = response;
	}
}
function desinscribeEvento(idEv) {
	idEvento = idEv;
	document.getElementById('me_apunto').innerHTML = '<img id="add" src="recursos/imagenes/spinner.gif">Espere por favor';
	ajax.open('get', '../logica/desinscribe_evento.php?idEv=' +idEvento);
	ajax.onreadystatechange = desinscribeCallback;
	ajax.send(null);
}
function desinscribeCallback() {
	if(ajax.readyState == 4){ 
		var response = ajax.responseText;
		document.getElementById('me_apunto').innerHTML = '<input type="image" id="add" src="recursos/imagenes/add.png" />&iexcl;Me apunto!';
		document.getElementById('informacion').action = 'javascript:inscribeEvento('+idEvento+')';
		if(response == "")
			document.getElementById('num_asistentes').innerHTML = "Ninguna persona asiste</br>";
		else
			document.getElementById('num_asistentes').innerHTML = "Asisten &eacute;stas personas:</br>";
		document.getElementById('asistentes').innerHTML = response;
	}
}