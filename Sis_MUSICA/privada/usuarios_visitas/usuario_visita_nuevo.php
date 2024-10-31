<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$db->debug = true;

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
            <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
            <script src='../js/expresiones_regulares.js'></script>
            <script src='../js/validacion_formularios.js'></script>
        </head>
        <body>
        <p>&nbsp;</p>
        <h1 class='titulo_formulario'>INSERTAR NOMBRE USUARIO</h1>";

echo "<form action='usuario_visita_nuevo1.php' method='post' name='formu' class='form-container'>";

echo "<div class='form-group'>
        <label for='nom_usuario'>(*)Nombre Usuario</label>
        <input type='text' name='nom_usuario' id='nom_usuario' size='20' onkeyup='this.value=this.value.toUpperCase()'>
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
