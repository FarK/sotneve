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
	document.getElementById('add_to_favs').innerHTML = '<img class="add_image" src="recursos/imagenes/spinner.gif"/> Espere por favor';
	ajax.open('get', '../logica/inserta_favorito.php?idFav=' +idFavorito);
	ajax.onreadystatechange = insertaCallback;
	ajax.send(null);
}

function insertaCallback() {
	if(ajax.readyState == 4){ 
		var response = ajax.responseText;
		document.getElementById('add_to_favs').innerHTML = '<input type="image" class="add_image" src="recursos/imagenes/delete.png"/> Borrar de favoritos';
		document.getElementById('add_form').action = 'javascript:borraFavorito('+idFavorito+')';
	}
}

function borraFavorito(idFav) {
	idFavorito = idFav;
	document.getElementById('add_to_favs').innerHTML = '<img class="add_image" src="recursos/imagenes/spinner.gif"/> Espere por favor';
	ajax.open('get', '../logica/borra_favorito.php?idFav=' +idFavorito);
	ajax.onreadystatechange = borraCallback;
	ajax.send(null);
}

function borraCallback() {
	if(ajax.readyState == 4){ 
		var response = ajax.responseText;
		document.getElementById('add_to_favs').innerHTML = '<input type="image" class="add_image" src="recursos/imagenes/add.png"/>A&ntilde;adir a favoritos';
		document.getElementById('add_form').action = 'javascript:insertaFavorito('+idFavorito+')';
	}
}

//idUser2 es el mismo id que idFavorito
function valoraUsuario(idFav, valoracion) {
	idFavorito = idFav;
	valoracion = prompt("Introduce una puntuación entre 0 y 5");
	
	if(valoracion >= 0 && valoracion < 6){
		ajax.open('get', '../logica/valora_usuario.php?idUser2=' +idFavorito+ '&valoracion='+valoracion);
		ajax.onreadystatechange = valoraCallback;
		document.getElementById('valora').innerHTML = 'Procesando...';
		ajax.send(null);
	}else{
		document.getElementById('valora').innerHTML = 'Valoración inválida';
	}
}

function valoraCallback() {
	if(ajax.readyState == 4){ 
		var response = ajax.responseText;
		document.getElementById('valora').innerHTML = '¡Puntuado!';
	}
}