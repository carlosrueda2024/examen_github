function buscar_sucursales() {
    var d1, d2, d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('sucursales1');
    d1 = document.formu.dpto.value;
    d2 = document.formu.telefono.value;
    d3 = document.formu.dir_suc.value;
    d4 = document.formu.limpieza.value;
    ajax = nuevoAjax();
    url = 'ajax_buscar_sucursal.php';
    param = 'dpto=' + d1 + '&telefono=' + d2 + '&dir_suc=' + d3 + '&limpieza=' + d4; 
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}
