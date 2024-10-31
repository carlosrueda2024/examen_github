"use strict";

function validar(){
	var nombre = document.formu.nombre.value;
	var tipo = document.formu.tipo.value;
	var descripcion = document.formu.descripcion.value;

	if (!v1.test(nombre)) {
		alert("el nombre es incorrecto o el campo esta vacio");
		document.formu.nombre.focus();
		return;
	}
	if (!v1.test(tipo)) {
		alert("el tipo es incorrecto o el campo esta vacio");
		document.formu.tipo.focus();
		return;
	}
	if (descripcion !="") {
		if (!v1.test(descripcion)) {
		alert("la descripcion es incorrecta");
		document.formu.descripcion.focus();
		return;
		}
	}
document.formu.submit();
}