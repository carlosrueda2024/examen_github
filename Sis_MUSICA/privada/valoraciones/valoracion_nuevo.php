<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
            <script src='../js/expresiones_regulares.js'></script>
            <script src='../js/validacion_formularios.js'></script>
        </head>
        <body>
        <p>&nbsp;</p>
        <h1>INSERTAR VALORACIÓN</h1>";

// Consulta para obtener los usuarios visita
$sql = $db->Prepare("SELECT CONCAT_WS(' ', nom_usuario) as usuario_visita, id_usuario_visita
                     FROM usuarios_visitas
                     WHERE estado = 'A'");
$rs = $db->GetAll($sql);

// Consulta para obtener las canciones
$sql2 = $db->Prepare("SELECT CONCAT_WS(' ', nombre, anio_lanza) as cancion, id_cancion
                     FROM canciones
                     WHERE estado = 'A'");
$rs2 = $db->GetAll($sql2);

// Formulario para insertar valoración
echo "<form action='valoracion_nuevo1.php' method='post' name='formu' class='form-container'>";

// Selección de usuario visita
echo "<div class='form-group'>
        <label for='id_usuario_visita'>(*)Usuario visita</label>
        <select name='id_usuario_visita' id='id_usuario_visita'>
            <option value=''>--Seleccione--</option>";
            foreach ($rs as $fila) {
                echo "<option value='".$fila['id_usuario_visita']."'>".$fila['usuario_visita']."</option>";
            }
echo "</select>
      </div>";

// Selección de canción
echo "<div class='form-group'>
        <label for='id_cancion'>(*)Canción</label>
        <select name='id_cancion' id='id_cancion'>
            <option value=''>--Seleccione--</option>";
            foreach ($rs2 as $fila) {
                echo "<option value='".$fila['id_cancion']."'>".$fila['cancion']."</option>";
            }
echo "</select>
      </div>";

// Selección de valoración (1 a 10)
echo "<div class='form-group'>
        <label for='valoracion'>(*)Valoración</label>
        <select name='valoracion' id='valoracion'>
            <option value=''>--Seleccione--</option>
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
        <input type='text' name='comentario' id='comentario' size='20' onkeyup='this.value=this.value.toUpperCase()'>
      </div>";

// Botones de acción
echo "<div class='full-width'>
        <h4>(*)datos obligatorios</h4>
        <input type='button' value='ACEPTAR' onclick='validar();'>
        <input type='reset' value='CANCELAR'>
      </div>";

echo "</form>";
echo "</body>
      </html>";
?>
