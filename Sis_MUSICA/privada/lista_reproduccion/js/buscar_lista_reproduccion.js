"use strict";

function buscar_lista_reproduccion() {
    var nombre, descripcion, fec_creacion, usuario, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    nombre = document.formu.nombre.value;

    if (nombre.length == 0) {
        nombre = '%';
    }
    descripcion = document.formu.descripcion.value;
    fec_creacion = document.formu.fec_creacion.value;
    usuario = document.formu.usuario.value;
    
    ajax = nuevoAjax();
    url = "ajax_buscar_lista_reproduccion.php";
    param = "nombre=" + nombre + "&descripcion=" + descripcion + "&fec_creacion=" + fec_creacion + "&usuario=" + usuario;
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}
