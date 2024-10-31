"use strict"


function buscar_instrumentos() {
    var d1, d2, d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    d1 = document.formu.nombre.value;

    if (d1.length == 0) {
        d1 = '%';
    }
    d2 = document.formu.tipo.value;
    d3 = document.formu.descripcion.value;
    d4 = document.formu.fec_insercion.value;
    
    ajax = nuevoAjax();
    url = "ajax_buscar_instrumento.php";
    param = "&nombre=" + d1 + "&tipo=" + d2 + "&descripcion=" + d3 + "&fec_insercion=" + d4;
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}
