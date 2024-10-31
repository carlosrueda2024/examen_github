<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

// $db->debug=true;
$id_genero = $_POST["id_genero"];
$id_artista = $_POST["id_artista"];

echo "<html>
<head>
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
    <script src='../js/expresiones_regulares.js'></script>
    <script src='js/validacion_artistas.js'></script>
</head>
<body>
<p>&nbsp;</p>";

echo "<h1>MODIFICAR ARTISTA</h1>";

$sql = $db->Prepare("SELECT *
                     FROM artistas
                     WHERE id_artista = ?
                     AND estado = 'A'");
$rs = $db->GetAll($sql, array($id_artista));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_origen) as genero, id_genero
                      FROM generos
                      WHERE id_genero = ?
                      AND estado = 'A'");
$rs1 = $db->GetAll($sql1, array($id_genero));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, anio_origen) as genero, id_genero
                      FROM generos
                      WHERE id_genero <> ?
                      AND estado = 'A'");
$rs2 = $db->GetAll($sql2, array($id_genero));

foreach ($rs as $fila) {
    echo "<form action='artista_modificar1.php' method='post' name='formu' class='form-container'>";
    
    // Campo de selección de género
    echo "<div class='form-group'>
            <label for='id_genero'>(*)Género</label>
            <select name='id_genero' id='id_genero'>";
    foreach ($rs1 as $opcion) {
        echo "<option value='" . $opcion['id_genero'] . "' selected>" . $opcion['genero'] . "</option>";
    }
    foreach ($rs2 as $opcion) {
        echo "<option value='" . $opcion['id_genero'] . "'>" . $opcion['genero'] . "</option>";
    }
    echo "  </select>
          </div>";
    
    // Campos de texto para los datos del artista
    echo "<div class='form-group'>
            <label for='nombreA'>(*)Nombre</label>
            <input type='text' name='nombreA' id='nombreA' size='20' value='" . $fila["nombreA"] . "'>
          </div>
          <div class='form-group'>
            <label for='nombre_artistico'>(*)Nombre Artístico</label>
            <input type='text' name='nombre_artistico' id='nombre_artistico' size='20' value='" . $fila["nombre_artistico"] . "'>
          </div>
          <div class='form-group'>
            <label for='pais'>(*)País</label>
            <input type='text' name='pais' id='pais' size='20' value='" . $fila["pais"] . "'>
          </div>
          <div class='form-group'>
            <label for='fec_creacion'>Fecha Creación</label>
            <input type='date' name='fec_creacion' id='fec_creacion' value='" . $fila["fec_creacion"] . "'>
          </div>";

    // Botones y campos ocultos
    echo "<div class='full-width'>
            <h4>(*)datos obligatorios</h4>
            <input type='button' value='ACEPTAR' onclick='validar();'>
            <input type='reset' value='CANCELAR'>
            <input type='hidden' name='id_artista' value='" . $fila["id_artista"] . "'>
          </div>";
    
    echo "</form>";
}

echo "</body>
</html>";
?>
