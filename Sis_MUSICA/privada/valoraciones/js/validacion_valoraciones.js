"use strict";

function validar(){
	var comentario = document.formu.comentario.value;
	var id_usuario_visita = document.formu.id_usuario_visita.value;
	var id_cancion = document.formu.id_cancion.value;
	var valoracion = document.formu.valoracion.value;

	if (id_usuario_visita=="") {
		alert("falta seleccionar el el usuario");
		document.formu.id_usuario_visita.focus();
		return;
	}
	if (id_cancion=="") {
		alert("falta seleccionar la cancion");
		document.formu.id_cancion.focus();
		return;
	}
	if (valoracion=="") {
		alert("falta seleccionar valoracion");
		document.formu.valoracion.focus();
		return;
	}
	if (comentario=="") {
		alert("falta llenar comentario");
		document.formu.comentario.focus();
		return;
	}
alert("datos correctos");
document.formu.submit();
}