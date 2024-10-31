<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo "<html>
    <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
        <script type='text/javascript' src='../../ajax.js'></script>
        <script src='../js/expresiones_regulares.js'></script>
        <script src='js/validacion_artistas.js'></script>
        <script type='text/javascript' src='js/buscar_genero.js'></script>
    </head>
    <body>
        <p>&nbsp;</p>
        <h1>INSERTAR ARTISTA</h1>";

echo "<form action='artista_nuevo1.php' method='post' name='formu' class='form-container'>
    <div class='form-group'>
        <label for='anio_origen'>Año de origen</label>
        <input type='text' name='anio_origen' id='anio_origen' size='10' onkeyup='buscar()'>
    </div>
    <div class='form-group'>
        <label for='nombre'>Nombre</label>
        <input type='text' name='nombre' id='nombre' size='10' onkeyup='buscar()'>
    </div>
    <div class='form-group'>
        <label for='genero'>(*)Selecciona el género</label>
        <div id='generos'></div>
    </div>
    <div class='form-group'>
        <label for='genero_seleccionado'>Género seleccionado</label>
        <div id='genero_seleccionado'></div>
    </div>
    <div class='form-group'>
        <label for='genero_insertado'>Género insertado</label>
        <div id='genero_insertado'></div>
    </div>
    <div class='form-group'>
        <label for='nombreA'>(*)Nombre Artista</label>
        <input type='text' name='nombreA' id='nombreA' size='10'>
    </div>
    <div class='form-group'>
        <label for='nombre_artistico'>(*)Nombre Artístico</label>
        <input type='text' name='nombre_artistico' id='nombre_artistico' size='10'>
    </div>
    <div class='form-group'>
        <label for='pais'>(*)País</label>
        <input type='text' name='pais' id='pais' size='10'>
    </div>
    <div class='form-group'>
        <label for='fec_creacion'>Fecha Creación</label>
        <input type='date' name='fec_creacion' id='fec_creacion' size='10'>
    </div>
    <div class='full-width'>
        <h4>(*)Datos obligatorios</h4>
        <input type='button' value='ACEPTAR' onclick='validar();'>
        <input type='reset' value='CANCELAR'>
    </div>
</form>";

echo "</body>
</html>";
?>
