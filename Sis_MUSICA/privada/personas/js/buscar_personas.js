"use strict"


function buscar_personas() {
    var d1, d2, d3, d4, d5, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    d1 = document.formu.ap.value;
    d2 = document.formu.am.value;
    d3 = document.formu.nombres.value;
    d4 = document.formu.ci.value;
    d5 = document.formu.fec_insercion.value;
    
    ajax = nuevoAjax();
    url = "ajax_buscar_persona.php";
    param = "ap=" + d1 + "&am=" + d2 + "&nombres=" + d3 + "&ci=" + d4 + "&fec_insercion=" + d5;
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}
