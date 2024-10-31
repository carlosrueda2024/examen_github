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
        <h1 class='titulo_formulario'>INSERTAR LISTA DE REPRODUCCIÓN</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nom_usuario) as usuarios, id_usuario_visita
                     FROM usuarios_visitas
                     WHERE estado = 'A'");
$rs = $db->GetAll($sql);

echo "<form action='lista_reproduccion_nuevo1.php' method='post' name='formu' class='form-container'>";

echo "<div class='form-group'>
        <label for='id_usuario_visita'>(*)Usuarios</label>
        <select name='id_usuario_visita' id='id_usuario_visita'>
            <option value=''>--Seleccione--</option>";
            foreach ($rs as $fila) {
                echo "<option value='" . $fila['id_usuario_visita'] . "'>" . $fila['usuarios'] . "</option>";
            }
echo "</select>
      </div>";

echo "<div class='form-group'>
        <label for='nombre'>(*)Nombre de Lista</label>
        <input type='text' name='nombre' id='nombre' size='20' onkeyup='this.value=this.value.toUpperCase()'>
      </div>";

echo "<div class='form-group'>
        <label for='descripcion'>Descripción</label>
        <input type='text' name='descripcion' id='descripcion' size='20'>
      </div>";

echo "<div class='form-group'>
        <label for='fec_creacion'>(*)Fecha Creación</label>
        <input type='date' name='fec_creacion' id='fec_creacion'>
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
