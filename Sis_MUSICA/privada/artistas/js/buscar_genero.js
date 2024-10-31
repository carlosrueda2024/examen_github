function buscar() {
    var d1, contenedor, url;
    contenedor = document.getElementById('generos');
    contenedor2 = document.getElementById('genero_seleccionado');
    contenedor3 = document.getElementById('genero_insertado');
    d1 = document.formu.anio_origen.value;
    d2 = document.formu.nombre.value;
    ajax = nuevoAjax();
    url = 'ajax_buscar_genero.php';
    param = 'anio_origen=' + d1 + '&nombre=' + d2;
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

function buscar_genero(id_genero) {
    var d1, contenedor, url;
    contenedor = document.getElementById('genero_seleccionado');
    contenedor2 = document.getElementById('generos');
    document.formu.id_genero.value = id_genero;

    d1 = id_genero;

    ajax = nuevoAjax();
    url = 'ajax_buscar_genero1.php';
    param = 'id_genero=' + d1;
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

function insertar_genero() {
    var d1, contenedor, url;
    contenedor = document.getElementById('genero_seleccionado');
    contenedor2 = document.getElementById('generos');
    contenedor3 = document.getElementById('genero_insertado');
    d1 = document.formu.anio_origen1.value;
    d2 = document.formu.nombre1.value;

    if (d1 == "") {
        alert('El anio de origen es incorrecto o el campo esta vacio....OK');
        document.formu.anio_origen1.focus();
        return;
    }
    if (d2 == "") {
        alert('El nombre es incorrecto o el campo esta vacio');
        document.formu.nombre1.focus();
        return;
    }

    ajax = nuevoAjax();
    url = 'ajax_inserta_genero.php';
    param = 'anio_origen1=' + d1 + '&nombre1=' + d2;
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
