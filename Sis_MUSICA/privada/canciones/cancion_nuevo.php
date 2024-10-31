<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
// $db->debug=true;

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
            <script src='../js/expresiones_regulares.js'></script>
            <script src='../js/validacion_formularios.js'></script>
        </head>
        <body>
        <p>&nbsp;</p>
        <h1>INSERTAR CANCIÓN</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_lanza) as albun, id_albun
                     FROM albunes
                     WHERE estado = 'A'");
$rs = $db->GetAll($sql);

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_origen) as genero, id_genero
                     FROM generos
                     WHERE estado = 'A'");
$rs2 = $db->GetAll($sql2);

echo "<form action='cancion_nuevo1.php' method='post' name='formu' class='form-container' enctype='multipart/form-data'>";

echo "<div class='form-group'>
        <label for='id_albun'>(*)Álbum</label>
        <select name='id_albun' id='id_albun'>
            <option value=''>--Seleccione--</option>";
            foreach ($rs as $fila) {
                echo "<option value='".$fila['id_albun']."'>".$fila['albun']."</option>";
            }
echo "</select>
      </div>";

echo "<div class='form-group'>
        <label for='id_genero'>(*)Género</label>
        <select name='id_genero' id='id_genero'>
            <option value=''>--Seleccione--</option>";
            foreach ($rs2 as $fila) {
                echo "<option value='".$fila['id_genero']."'>".$fila['genero']."</option>";
            }
echo "</select>
      </div>";

// Campo para subir el archivo de música
echo "<div class='form-group'>
        <label for='nombre'>(*)Archivo de Música</label>
        <input type='file' name='nombre' id='nombre' accept='audio/*' required>
      </div>";

echo "<div class='form-group'>
        <label for='anio_lanza'>(*)Año Lanzamiento</label>
        <input type='number' name='anio_lanza' id='anio_lanza' min='2000' max='2024' onkeydown='return false'>
      </div>";

echo "<div class='full-width'>
        <h4>(*)datos obligatorios</h4>
        <input type='button' value='ACEPTAR' onclick='validar();'>
        <input type='reset' value='CANCELAR'>
      </div>";

echo "</form>";
echo "</body>
      </html>";
?>
