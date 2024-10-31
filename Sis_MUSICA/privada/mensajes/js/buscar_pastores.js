"use strict";
function buscar() { 
    var d1, d2, d3, contenedor, contenedor2, contenedor3, url;
    contenedor = document.getElementById('pastores');
    contenedor2 = document.getElementById('pastor_seleccionado');
    contenedor3 = document.getElementById('pastor_insertado');
    
    d1 = document.formu.especialidad.value;
    d2 = document.formu.sueldo.value;
    d3 = document.formu.cargo.value;

    var ajax = nuevoAjax();
    url = 'ajax_buscar_pastor.php';  
    var param = 'especialidad=' + d1 + '&sueldo=' + d2 + '&cargo=' + d3;
    
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = '';
        }
    };
    ajax.send(param);
}

function buscar_pastor(id) {
    var d1, contenedor, contenedor, contenedor2, url;
    contenedor = document.getElementById('pastor_seleccionado');
    contenedor2 = document.getElementById('pastores');
    
    document.formu.id_pastor.value = id;
    var ajax = nuevoAjax();
    url = 'ajax_buscar_pastor1.php'; 
    var param = 'id_pastor=' + id;
    
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
            contenedor2.innerHTML = '';
        }
    };
    ajax.send(param);
}

function insertar_pastor() {
    var d1, d2, d3, d4, d5, contenedor, contenedor2, contenedor3, url;
    contenedor = document.getElementById('pastor_seleccionado');
    contenedor2 = document.getElementById('pastores');
    contenedor3 = document.getElementById('pastor_insertado');
    
    d1 = document.formu.especialidad1.value;
    d2 = document.formu.sueldo1.value;
    d3 = document.formu.fec_inicio_pa1.value;
    d4 = document.formu.fec_fin_pa1.value;
    d5 = document.formu.cargo1.value;

    if (d1 == '') {
        alert('la especialidad es incorrecta o el campo está vacío');
        document.formu.especialidad1.focus();
        return;
    }
    if (d2 == '') {
        alert('El sueldo esta vacio vacío');
        document.formu.sueldo1.focus();
        return;
    }
    if (d3 == '') {
        alert('falta seleccionar fecha de inicio');
        document.formu.fec_fin_pa1.focus();
        return;
    }
    if (d5 == '') {
        alert('El cargo esta vacio vacío');
        document.formu.cargo1.focus();
        return;
    }
    var ajax = nuevoAjax();
    url = 'ajax_inserta_pastor.php';
    var param = 'especialidad1=' + d1 + '&sueldo1=' + d2 + '&fec_inicio_pa1=' + d3 +'&fec_fin_pa1=' + d4 + '&cargo1=' + d5;
    
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    alert('El pastor se agregó correctamente');
    
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = '';
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = ajax.responseText;
        }
    };
    ajax.send(param);
}
