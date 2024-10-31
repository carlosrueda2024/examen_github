"use strict";
function buscar_artistas1() {
    var d1, d2, d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('artistas1');
    d1 = document.formu2.genero1.options[document.formu2.genero1.selectedIndex].value;
    d2 = document.formu2.nombre_artistico1.value;
    d3 = document.formu2.pais1.value;
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
