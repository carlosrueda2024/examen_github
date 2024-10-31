function buscar() {
    var d1, contenedor, url;
    contenedor = document.getElementById('heladeria_pasteleria');
    contenedor2 = document.getElementById('heladeria_seleccionada');
    contenedor3 = document.getElementById('heladeria_insertada');
    d1 = document.formu.nombre_heladeria_pasteleria.value;
    d2 = document.formu.direccion.value;
    d3 = document.formu.telefono.value;
    ajax = nuevoAjax();
    url = 'ajax_buscar_heladeria.php';
    param = 'nombre_heladeria_pasteleria=' + d1 + '&direccion=' + d2 + '&telefono=' + d3;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = '';
        }
    }
    ajax.send(param);
}

function buscar_heladeria(id) {
    var d1, contenedor, url;
    contenedor = document.getElementById('heladeria_seleccionada');
    contenedor2 = document.getElementById('heladeria_pasteleria');
    document.formu.id.value = id;

    d1 = id;

    ajax = nuevoAjax();
    url = 'ajax_buscar_heladeria1.php';
    param = 'id=' + d1;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
            contenedor2.innerHTML = '';
        }
    }
    ajax.send(param);
}

function insertar_heladeria() {
    var d1, contenedor, url;
    contenedor = document.getElementById('heladeria_seleccionada');
    contenedor2 = document.getElementById('heladeria_pasteleria');
    contenedor3 = document.getElementById('heladeria_insertada');
    d1 = document.formu.nombre_heladeria_pasteleria1.value;
    d2 = document.formu.direccion1.value;
    d3 = document.formu.telefono1.value;

    if (d1 == '') {
        alert('El nombre es incorrecto o el campo esta vacio');
        document.formu.nombre_heladeria_pasteleria1.focus();
        return;
    }
    if (d2 == '') {
        alert('El campo direccion esta vacio');
        document.formu.direccion1.focus();
        return;
    }

    ajax = nuevoAjax();
    url = 'ajax_inserta_heladeria.php';
    param = 'nombre_heladeria_pasteleria1=' + d1 + '&direccion1=' + d2 + '&telefono1=' + d3 ;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    alert('se agrego correctamente');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = '';
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}

