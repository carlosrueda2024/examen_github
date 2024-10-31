"use strict";

function buscar_usuarios_visitas() {
    var d1, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    d1 = document.formu.nom_usuario.value;

    if (d1.length == 0) {
        d1 = '%';
    }

    ajax = nuevoAjax();
    url = "ajax_buscar_usuario_visita.php";
    param = "nom_usuario=" + encodeURIComponent(d1);
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    };
    ajax.send(param);
}
