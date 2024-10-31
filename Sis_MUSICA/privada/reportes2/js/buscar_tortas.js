"use strict";
function buscar_tortas() {
    var d1, d2, d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('tabla');
    
    // Obtener los valores de los campos del formulario
    d1 = document.formu.heladeria_pasteleria.options[document.formu.heladeria_pasteleria.selectedIndex].value;
    d2 = document.formu.nombre.value;
    d3 = document.formu.precio.value;
    d4 = document.formu.cantidad.value;

    // Crear la instancia del objeto AJAX
    ajax = nuevoAjax();
    
    // Definir la URL del archivo PHP que procesará la búsqueda
    url = "ajax_buscar_tortas.php";

    // Parametros que serán enviados al archivo PHP
    param = "heladeria_pasteleria=" + d1 + "&nombre=" + d2 + "&precio=" + d3 + "&cantidad=" + d4;
    
    // Configuración de la solicitud AJAX
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Función que se ejecutará cuando cambie el estado de la solicitud AJAX
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    };
    
    // Enviar los parámetros
    ajax.send(param);
}
