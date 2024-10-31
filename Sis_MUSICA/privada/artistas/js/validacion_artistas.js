"use strict";

function validar(){
	var id_genero = document.formu.id_genero.value;
	var nombreA = document.formu.nombreA.value;
	var nombre_artistico = document.formu.nombre_artistico.value;
	var pais = document.formu.pais.value;

	if (id_genero=="") {
		alert("falta seleccionar el genero");
		document.formu.id_genero.focus();
		return;
	}
	if (!v1.test(nombreA)) {
		alert("el nombre es incorrecto o el campo esta vacio");
		document.formu.nombreA.focus();
		return;
	}

	if (!v1.test(nombre_artistico)) {
		alert("el nombre artistico es incorrecto o el campo esta vacio");
		document.formu.nombre_artistico.focus();
		return;
	}
	if (!v1.test(pais)) {
		alert("el pais es incorrecto o el campo esta vacio");
		document.formu.pais.focus();
		return;
	}
document.formu.submit();
}