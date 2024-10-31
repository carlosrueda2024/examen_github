"use strict";

function validar(){
	var nombre = document.formu.nombre.value;
	var anio_origen = document.formu.anio_origen.value;

	if (!v1.test(nombre)) {
		alert("el nombre es incorrecto o el campo esta vacio");
		document.formu.nombre.focus();
		return;
	}
	if (anio_origen !="") {
		if (!v2.test(anio_origen)) {
		alert("el anio es incorrecto");
		document.formu.anio_origen.focus();
		return;
		}
	}
document.formu.submit();
}