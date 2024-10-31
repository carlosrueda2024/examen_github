<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$id_cancion = $_POST["id_cancion"];
$id_albun = $_POST["id_albun"];
$id_genero = $_POST["id_genero"];

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
            <script src='../js/expresiones_regulares.js'></script>
            <script src='../js/validacion_formularios.js'></script>
        </head>
        <body>
        <p>&nbsp;</p>
        <h1>MODIFICAR CANCIÓN</h1>";

// Obtener datos de la canción a modificar
$sql = $db->Prepare("SELECT * 
                    FROM canciones 
                    WHERE id_cancion = ? 
                    AND estado = 'A'");
$rs = $db->GetAll($sql, array($id_cancion));

// Obtener datos del álbum seleccionado y otros álbumes disponibles
$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_lanza) as albun, id_albun
                      FROM albunes
                      WHERE id_albun = ?
                      AND estado = 'A'");
$rs1 = $db->GetAll($sql1, array($id_albun));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_lanza) as albun, id_albun
                      FROM albunes
                      WHERE id_albun <> ?
                      AND estado = 'A'");
$rs2 = $db->GetAll($sql2, array($id_albun));

// Obtener datos del género seleccionado y otros géneros disponibles
$sql3 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_origen) as genero, id_genero
                      FROM generos
                      WHERE id_genero = ?
                      AND estado = 'A'");
$rs3 = $db->GetAll($sql3, array($id_genero));

$sql4 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_origen) as genero, id_genero
                      FROM generos
                      WHERE id_genero <> ?
                      AND estado = 'A'");
$rs4 = $db->GetAll($sql4, array($id_genero));

// Formulario de modificación de canción
echo "<form action='cancion_modificar1.php' method='post' name='formu' class='form-container' enctype='multipart/form-data'>";
echo "<div class='form-group'>
        <label for='id_albun'>(*)Álbum</label>
        <select name='id_albun' id='id_albun'>
            <option value=''>--Seleccione--</option>";
            foreach ($rs1 as $fila) {
                echo "<option value='".$fila['id_albun']."' selected>".$fila['albun']."</option>";
            }
            foreach ($rs2 as $fila) {
                echo "<option value='".$fila['id_albun']."'>".$fila['albun']."</option>";
            }
echo "</select>
      </div>";

echo "<div class='form-group'>
        <label for='id_genero'>(*)Género</label>
        <select name='id_genero' id='id_genero'>
            <option value=''>--Seleccione--</option>";
            foreach ($rs3 as $fila) {
                echo "<option value='".$fila['id_genero']."' selected>".$fila['genero']."</option>";
            }
            foreach ($rs4 as $fila) {
                echo "<option value='".$fila['id_genero']."'>".$fila['genero']."</option>";
            }
echo "</select>
      </div>";

// Campo para subir el archivo de música
echo "<div class='form-group'>
        <label for='nombre'>(*)Archivo de Música</label>
        <input type='file' name='nombre' id='nombre' accept='audio/*'>
        <p>Archivo actual: <strong>".$rs[0]['nombre']."</strong></p>
      </div>";

echo "<div class='form-group'>
        <label for='anio_lanza'>(*)Año Lanzamiento</label>
        <input type='number' name='anio_lanza' id='anio_lanza' min='2000' max='2024' onkeydown='return false' value='".$rs[0]["anio_lanza"]."'>
      </div>";

echo "<input type='hidden' name='id_cancion' value='".$id_cancion."'>";

echo "<div class='full-width'>
        <h4>(*)datos obligatorios</h4>
        <input type='button' value='ACEPTAR' onclick='validar();'>
        <input type='reset' value='CANCELAR'>
      </div>";

echo "</form>";
echo "</body>
      </html>";
?>
