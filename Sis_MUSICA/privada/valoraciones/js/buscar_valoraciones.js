"use strict"


function buscar_valoraciones() {
    var d1, d2, d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    d1 = document.formu.nom_usuario.value;
    d2 = document.formu.nombre.value;
    d3 = document.formu.valoracion.value;
    d4 = document.formu.comentario.value;
    
    ajax = nuevoAjax();
    url = "ajax_buscar_valoracion.php";
    param = "nom_usuario=" + d1 + "&nombre=" + d2 + "&valoracion=" + d3 + "&comentario=" + d4;
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}
