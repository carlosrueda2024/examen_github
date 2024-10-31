"use strict";

function validar(){
    var id_pastor = document.formu.id_pastor.value;
    var nombre_mensaje = document.formu.nombre_mensaje.value;
    var nombre_evento = document.formu.nombre_evento.value;
    var fecha = document.formu.fecha.value;

    if (id_pastor == "") {
        alert("Falta seleccionar un pastor.");
        document.formu.id_pastor.focus();
        return;
    }
    if (!v1.test(nombre_mensaje) || nombre_mensaje == "") {
        alert("El nombre del mensaje es incorrecto o está vacío.");
        document.formu.nombre_mensaje.focus();
        return;
    }
    if (!v1.test(nombre_evento) || nombre_evento == "") {
        alert("El nombre del evento es incorrecto o está vacío.");
        document.formu.nombre_evento.focus();
        return;
    }
    if (fecha == "") {
        alert("La fecha es incorrecta o está vacía.");
        document.formu.fecha.focus();
        return;
    }
    document.formu.submit();
}
