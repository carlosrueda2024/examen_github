"use strict";
function buscar_artistas() {
    var d1, d2, d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    d1 = document.formu.genero.options[document.formu.genero.selectedIndex].value;
    d2 = document.formu.nombre_artistico.value;
    d3 = document.formu.pais.value;
    ajax = nuevoAjax();
    url = "ajax_buscar_artistas.php";
    param = "genero=" + d1 + "&nombre_artistico=" + d2 + "&pais=" + d3;
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    };
    ajax.send(param);
}
