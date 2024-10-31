function buscar_artistas() {
    var d1, d2, d3, d4, d5, ajax, url, param, contenedor;
    contenedor = document.getElementById('artistas1');
    d1 = document.formu.nombreA.value;
    d2 = document.formu.nombre_artistico.value;
    d3 = document.formu.pais.value;
    d4 = document.formu.fec_creacion.value;
    d5 = document.formu.genero.value;
    ajax = nuevoAjax();
    url = 'ajax_buscar_artista.php';
    param = 'nombreA=' + d1 + '&nombre_artistico=' + d2 + '&pais=' + d3 + '&fec_creacion=' + d4 + '&genero=' + d5; 
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}
