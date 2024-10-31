"use strict";

function validar(){
	var clave = document.formu.clave.value;
	var usuario_principal = document.formu.usuario_principal.value;
	var id_persona = document.formu.id_persona.value;


if (id_persona=="") {
	alert("falta seleccionar persona");
	document.formu.id_persona.focus();
	return;
}
if (usuario_principal=="") {
	alert("falta llenar usuario");
	document.formu.usuario_principal.focus();
	return;
}
if (clave=="") {
	alert("falta llenar clave");
	document.formu.clave.focus();
	return;
}
document.formu.submit();
}