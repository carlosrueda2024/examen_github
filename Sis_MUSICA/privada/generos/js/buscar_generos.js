"use strict"


function buscar_generos() {
    var d1, d2, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    d1 = document.formu.nombre.value;

    if (d1.length == 0) {
        d1 = '%';
    }
    d2 = document.formu.anio_origen.value;
    
    ajax = nuevoAjax();
    url = "ajax_buscar_genero.php";
    param = "&nombre=" + d1 + "&anio_origen=" + d2;
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}
