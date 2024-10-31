"use strict";

function validar(){
	var nom_usuario = document.formu.nom_usuario.value;

if (nom_usuario=="") {
	alert("falta llenar el nombre se usuario");
	document.formu.nom_usuario.focus();
	return;
}
document.formu.submit();
}