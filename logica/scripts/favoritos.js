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

function borraFavorito(idFav) {
	idFavorito = idFav;
	//document.getElementById('add_to_favs').innerHTML = '<img id="add" src="recursos/imagenes/spinner.gif">Espere por favor';
	ajax.open('get', '../logica/borra_favorito_yactualiza.php?idFav=' +idFavorito);
	ajax.onreadystatechange = borraCallback;
	ajax.send(null);
}
function borraCallback() {
	if(ajax.readyState == 4){ 
		var response = ajax.responseText;
		document.getElementById('favoritos').innerHTML = response;
	}
}