"use strict";

function validar(){
	var id_usuario_visita = document.formu.id_usuario_visita.value;
	var nombre = document.formu.nombre.value;
	var fec_creacion = document.formu.fec_creacion.value;

	if (id_usuario_visita=="") {
		alert("falta seleccionar el usuario");
		document.formu.id_usuario_visita.focus();
		return;
	}
	if (!v1.test(nombre)) {
		alert("el nombre es incorrecto o el campo esta vacio");
		document.formu.nombre.focus();
		return;
	}
	if (fec_creacion=="") {
		alert("falta seleccionar la fecha de creacion");
		document.formu.fec_creacion.focus();
		return;
	}
document.formu.submit();
}