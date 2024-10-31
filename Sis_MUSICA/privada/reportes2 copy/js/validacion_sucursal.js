"use strict";

function validar(){
	var dpto = document.formu.dpto.value;
	var dir_suc = document.formu.dir_suc.value;
    var id = document.formu.id.value;

if (id=="") {
	alert("falta seleccionar compania");
	document.formu.id.focus();
	return;
}
if (!v1.test(dpto)) {
	alert("el departamento es incorrecto o esta vacio");
	document.formu.dpto.focus();
	return;
}
if (dir_suc=="") {
	alert("falta llenar direccion");
	document.formu.dir_suc.focus();
	return;
}

document.formu.submit();
}