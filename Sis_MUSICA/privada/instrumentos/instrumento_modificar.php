<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$id_instrumento = $_POST["id_instrumento"];

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
            <script src='../js/expresiones_regulares.js'></script>
            <script src='../js/validacion_formularios.js'></script>
        </head>
        <body>
        <p>&nbsp;</p>
        <h1 class='titulo_formulario'>MODIFICAR INSTRUMENTO</h1>";

$sql = $db->Prepare("SELECT *
                     FROM instrumentos
                     WHERE id_instrumento = ?
                     AND estado <> 'X'");
$rs = $db->GetAll($sql, array($id_instrumento));

foreach ($rs as $fila) {
    echo "<form action='instrumento_modificar1.php' method='post' name='formu' class='form-container'>";
    
    echo "<div class='form-group'>
            <label for='nombre'>(*)Nombre</label>
            <input type='text' name='nombre' id='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["nombre"] . "'>
          </div>";

    echo "<div class='form-group'>
            <label for='tipo'>(*)Tipo</label>
            <input type='text' name='tipo' id='tipo' size='10' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["tipo"] . "'>
          </div>";

    echo "<div class='form-group'>
            <label for='descripcion'>Descripción</label>
            <input type='text' name='descripcion' id='descripcion' size='10' value='" . $fila["descripcion"] . "'>
          </div>";

    echo "<div class='full-width'>
            <h4>(*)datos obligatorios</h4>
            <input type='button' value='ACEPTAR' onclick='validar();'>
            <input type='reset' value='CANCELAR'>
            <input type='hidden' name='id_instrumento' value='" . $fila["id_instrumento"] . "'>
          </div>";

    echo "</form>";
}

echo "</body>
      </html>";
?>
