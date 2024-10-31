function mostrar_artista(id_artista) {
    var d1, ventanaCalendario;
    d1 = id_artista;
    //alert(id_persona);
    ventanaCalendario = window.open("ficha_artistas_genero1.php?id_artista=" + d1 , "calendario", "width=600, height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO")
}