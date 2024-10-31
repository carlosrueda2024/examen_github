<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug = true;
$id_usuario_visita = $_POST["id_usuario_visita"];
$id_lista_reproduccion = $_POST["id_lista_reproduccion"];

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
            <script src='../js/expresiones_regulares.js'></script>
            <script src='../js/validacion_formularios.js'></script>
        </head>
        <body>
        <p>&nbsp;</p>
        <h1 class='titulo_formulario'>MODIFICAR LISTA DE REPRODUCCIÓN</h1>";

$sql = $db->Prepare("SELECT *
                     FROM lista_reproduccion
                     WHERE id_lista_reproduccion = ?
                     AND estado = 'A'");
$rs = $db->GetAll($sql, array($id_lista_reproduccion));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ', nom_usuario) as usuario, id_usuario_visita
                     FROM usuarios_visitas
                     WHERE id_usuario_visita = ?
                     AND estado = 'A'");
$rs1 = $db->GetAll($sql1, array($id_usuario_visita));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ', nom_usuario) as usuario, id_usuario_visita
                     FROM usuarios_visitas
                     WHERE id_usuario_visita <> ?
                     AND estado = 'A'");
$rs2 = $db->GetAll($sql2, array($id_usuario_visita));

echo "<form action='lista_reproduccion_modificar1.php' method='post' name='formu' class='form-container'>";

echo "<div class='form-group'>
        <label for='id_usuario_visita'>(*)Usuarios</label>
        <select name='id_usuario_visita' id='id_usuario_visita'>";
            foreach ($rs1 as $fila) {
                echo "<option value='" . $fila['id_usuario_visita'] . "'>" . $fila['usuario'] . "</option>";
            }
            foreach ($rs2 as $fila) {
                echo "<option value='" . $fila['id_usuario_visita'] . "'>" . $fila['usuario'] . "</option>";
            }
echo "</select>
      </div>";

foreach ($rs as $fila) {
    echo "<div class='form-group'>
            <label for='nombre'>(*)Nombre de Lista</label>
            <input type='text' name='nombre' id='nombre' size='20' value='" . $fila["nombre"] . "' onkeyup='this.value=this.value.toUpperCase()'>
          </div>";

    echo "<div class='form-group'>
            <label for='descripcion'>Descripción</label>
            <input type='text' name='descripcion' id='descripcion' size='20' value='" . $fila["descripcion"] . "'>
          </div>";

    echo "<div class='form-group'>
            <label for='fec_creacion'>(*)Fecha Creación</label>
            <input type='date' name='fec_creacion' id='fec_creacion' value='" . $fila["fec_creacion"] . "'>
          </div>";

    echo "<input type='hidden' name='id_lista_reproduccion' value='" . $fila["id_lista_reproduccion"] . "'>";
}

echo "<div class='full-width'>
        <h4>(*)datos obligatorios</h4>
        <input type='button' value='ACEPTAR' onclick='validar();'>
        <input type='reset' value='CANCELAR'>
      </div>";

echo "</form>";
echo "</body>
      </html>";
?>
