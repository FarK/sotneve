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
var idFavorito;

function insertaFavorito(idFav) {
	idFavorito = idFav;
	document.getElementById('add_to_favs').innerHTML = '<img id="add" src="recursos/imagenes/spinner.gif">Espere por favor';
	ajax.open('get', '../logica/inserta_favorito.php?idFav=' +idFavorito);
	ajax.onreadystatechange = insertaCallback;
	ajax.send(null);
}
function insertaCallback() {
	if(ajax.readyState == 4){ 
		var response = ajax.responseText;
		document.getElementById('add_to_favs').innerHTML = '<input type="image" id="add" src="recursos/imagenes/delete.png">Eliminar';
		document.getElementById('add_form').action = 'javascript:borraFavorito('+idFavorito+')';
	}
}
function borraFavorito(idFav) {
	idFavorito = idFav;
	document.getElementById('add_to_favs').innerHTML = '<img id="add" src="recursos/imagenes/spinner.gif">Espere por favor';
	ajax.open('get', '../logica/borra_favorito.php?idFav=' +idFavorito);
	ajax.onreadystatechange = borraCallback;
	ajax.send(null);
}
function borraCallback() {
	if(ajax.readyState == 4){ 
		var response = ajax.responseText;
		document.getElementById('add_to_favs').innerHTML = '<input type="image" id="add" src="recursos/imagenes/add.png">Eliminar';
		document.getElementById('add_form').action = 'javascript:insertaFavorito('+idFavorito+')';
	}
}