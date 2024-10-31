"use strict";

function validar(){
	var  nombre= document.formu.nombre.value;
	var cantidad = document.formu.cantidad.value;
	var precio = document.formu.precio.value;
    var id = document.formu.id.value;

if (id=="") {
	alert("falta seleccionar heladeria");
	document.formu.nombre_heladeria_pasteleria.focus();
	return;
}
if (!v1.test(nombre)) {
	alert("el nombre es incorrecto o esta vacio");
	document.formu.nombre.focus();
	return;
}
if (!v22.test(cantidad)) {
	alert("la cantidad es incorrecto o esta vacio");
	document.formu.cantidad.focus();
	return;
}
if (!v22.test(precio)) {
	alert("el precio es incorrecto o esta vacio");
	document.formu.precio.focus();
	return;
}

document.formu.submit();
}