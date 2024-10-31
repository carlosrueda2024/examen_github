<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$id_usuario_visita = $_POST["id_usuario_visita"];
$id_cancion = $_POST["id_cancion"];
$id_valoracion = $_POST["id_valoracion"];

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
            <script src='../js/expresiones_regulares.js'></script>
            <script src='../js/validacion_formularios.js'></script>
        </head>
        <body>
        <p>&nbsp;</p>
        <h1>MODIFICAR VALORACIÓN</h1>";

// Consulta para obtener los datos de la valoración
$sql = $db->Prepare("SELECT *
                     FROM valoraciones
                     WHERE id_valoracion = ?
                     AND estado = 'A'");
$rs = $db->GetAll($sql, array($id_valoracion));

// Consulta para obtener el usuario visita seleccionado
$sql1 = $db->Prepare("SELECT CONCAT_WS(' ', nom_usuario) as usuario_visita, id_usuario_visita
                     FROM usuarios_visitas
                     WHERE id_usuario_visita = ?
                     AND estado = 'A'");
$rs1 = $db->GetAll($sql1, array($id_usuario_visita));

// Consulta para obtener otros usuarios visita
$sql2 = $db->Prepare("SELECT CONCAT_WS(' ', nom_usuario) as usuario_visita, id_usuario_visita
                     FROM usuarios_visitas
                     WHERE id_usuario_visita <> ?
                     AND estado = 'A'");
$rs2 = $db->GetAll($sql2, array($id_usuario_visita));

// Consulta para obtener la canción seleccionada
$sql3 = $db->Prepare("SELECT CONCAT_WS(' ', nombre, anio_lanza) as cancion, id_cancion
                     FROM canciones
                     WHERE id_cancion = ?
                     AND estado = 'A'");
$rs3 = $db->GetAll($sql3, array($id_cancion));

// Consulta para obtener otras canciones
$sql4 = $db->Prepare("SELECT CONCAT_WS(' ', nombre, anio_lanza) as cancion, id_cancion
                     FROM canciones
                     WHERE id_cancion <> ?
                     AND estado = 'A'");
$rs4 = $db->GetAll($sql4, array($id_cancion));

// Formulario para modificar la valoración
echo "<form action='valoracion_modificar1.php' method='post' name='formu' class='form-container'>";

// Selección de usuario visita
echo "<div class='form-group'>
        <label for='id_usuario_visita'>(*)Usuario visita</label>
        <select name='id_usuario_visita' id='id_usuario_visita'>";
        foreach ($rs1 as $fila) {
            echo "<option value='".$fila['id_usuario_visita']."'>".$fila['usuario_visita']."</option>";
        }
        foreach ($rs2 as $fila) {
            echo "<option value='".$fila['id_usuario_visita']."'>".$fila['usuario_visita']."</option>";
        }
echo "</select>
      </div>";

// Selección de canción
echo "<div class='form-group'>
        <label for='id_cancion'>(*)Canción</label>
        <select name='id_cancion' id='id_cancion'>";
        foreach ($rs3 as $fila) {
            echo "<option value='".$fila['id_cancion']."'>".$fila['cancion']."</option>";
        }
        foreach ($rs4 as $fila) {
            echo "<option value='".$fila['id_cancion']."'>".$fila['cancion']."</option>";
        }
echo "</select>
      </div>";

// Selección de valoración (1 a 10)
foreach ($rs as $fila) {
    echo "<div class='form-group'>
            <label for='valoracion'>(*)Valoración</label>
            <select name='valoracion' id='valoracion'>
                <option value='".$fila['valoracion']."'>".$fila['valoracion']."</option>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
                <option value='6'>6</option>
                <option value='7'>7</option>
                <option value='8'>8</option>
                <option value='9'>9</option>
                <option value='10'>10</option>
            </select>
          </div>";

    // Campo de comentario
    echo "<div class='form-group'>
            <label for='comentario'>(*)Comentario</label>
            <input type='text' name='comentario' id='comentario' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["comentario"]."'>
          </div>";

    // Botones de acción
    echo "<div class='full-width'>
            <h4>(*)datos obligatorios</h4>
            <input type='button' value='ACEPTAR' onclick='validar();'>
            <input type='reset' value='CANCELAR'>
            <input type='hidden' name='id_valoracion' value='".$fila["id_valoracion"]."'>
          </div>";
}

echo "</form>";
echo "</body>
      </html>";
?>
