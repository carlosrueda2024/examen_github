function buscar_personas() {
    var d1, d2, d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('personas1');
    d1 = document.formu.ap.value;
    d2 = document.formu.am.value;
    d3 = document.formu.nombres.value;
    d4 = document.formu.ci.value;
    ajax = nuevoAjax();
    url = 'ajax_buscar_persona.php';
    param = 'ap=' + d1 + '&am=' + d2 + '&nombres=' + d3 + '&ci=' + d4;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}

function buscarPersona(id_persona) {
    var d1, contenedor, url;
    contenedor = document.getElementById('persona_seleccionado');
    contenedor2 = document.getElementById('personas1'); // Ajusté este ID para que coincida
    document.formu.id_persona.value = id_persona;

    d1 = id_persona;

    ajax = nuevoAjax();
    url = 'ajax_buscar_persona1.php';
    param = 'id_persona=' + d1;
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

function insertar_persona() {
    var d1, contenedor, url;
    contenedor = document.getElementById('persona_seleccionado');
    contenedor2 = document.getElementById('personas1');
    contenedor3 = document.getElementById('persona_insertada');
    d1 = document.formu.ap1.value;
    d2 = document.formu.am1.value;
    d3 = document.formu.nombres1.value;
    d4 = document.formu.ci1.value;
    d5 = document.formu.direccion1.value;
    d6 = document.formu.telefono1.value;

    if (d4 == '') {
        alert('El ci es incorrecto o el campo esta vacio');
        document.formu.ci1.focus();
        return;
    }
    if ((d1 == '') && (d2 == '')) {
        alert('Por favor introduzca un Apellido');
        document.formu.ap1.focus();
        return;
    }
    if (d3 == '') {
        alert('El nombre es incorrecto o el campo esta vacio');
        document.formu.nombre1.focus();
        return;
    }
    ajax = nuevoAjax();
    url = 'ajax_inserta_persona.php';
    param = 'ap1=' + d1 + '&am1=' + d2 + '&nombres1=' + d3 + '&ci1=' + d4 + '&direccion1=' + d5 + '&telefono1=' + d6 + '&genero1=';
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
