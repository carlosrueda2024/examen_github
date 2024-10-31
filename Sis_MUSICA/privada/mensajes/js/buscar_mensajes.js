"use strict";
function buscar_mensajes() {
    var d1, d2, d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    d1 = document.formu.pastor.options[document.formu.pastor.selectedIndex].value;
    d2 = document.formu.nombre_mensaje.value;
    d3 = document.formu.nombre_evento.value;
    ajax = nuevoAjax();
    url = "ajax_buscar_mensajes.php";
    param = "pastor=" + d1 + "&nombre_mensaje=" + d2 + "&nombre_evento=" + d3;
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    };
    ajax.send(param);
}
