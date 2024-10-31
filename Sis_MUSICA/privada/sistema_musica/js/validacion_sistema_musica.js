"use strict";

function validar(){
	var nombre = document.formu.nombre.value;

	if (!v1.test(nombre)) {
		alert("el nombre es incorrecto o el campo esta vacio");
		document.formu.nombre.focus();
		return;
	}
document.formu.submit();
}