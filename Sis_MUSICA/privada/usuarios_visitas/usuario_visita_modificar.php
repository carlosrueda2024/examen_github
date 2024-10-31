<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug = true;
$id_usuario_visita = $_POST["id_usuario_visita"];

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
            <script src='../js/expresiones_regulares.js'></script>
            <script src='../js/validacion_formularios.js'></script>
        </head>
        <body>
        <p>&nbsp;</p>
        <h1 class='titulo_formulario'>MODIFICAR NOMBRE USUARIO</h1>";

$sql = $db->Prepare("SELECT *
                     FROM usuarios_visitas
                     WHERE id_usuario_visita = ?
                     AND estado <> 'X'");
$rs = $db->GetAll($sql, array($id_usuario_visita));

foreach ($rs as $fila) {
    echo "<form action='usuario_visita_modificar1.php' method='post' name='formu' class='form-container'>";

    echo "<div class='form-group'>
            <label for='nom_usuario'>(*)Nombre Usuario</label>
            <input type='text' name='nom_usuario' id='nom_usuario' size='20' value='" . $fila["nom_usuario"] . "' onkeyup='this.value=this.value.toUpperCase()'>
          </div>";

    echo "<input type='hidden' name='id_usuario_visita' value='" . $fila["id_usuario_visita"] . "'>";

    echo "<div class='full-width'>
            <h4>(*)datos obligatorios</h4>
            <input type='button' value='ACEPTAR' onclick='validar();'>
            <input type='reset' value='CANCELAR'>
          </div>";

    echo "</form>";
}

echo "</body>
      </html>";
?>
