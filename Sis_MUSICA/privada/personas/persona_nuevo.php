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
        <h1>INSERTAR PERSONA</h1>";

echo "<form action='persona_nuevo1.php' method='post' name='formu' class='form-container'>
        <div class='form-group'>
            <label for='ci'>(*)CI</label>
            <input type='text' name='ci' id='ci' size='10'>
        </div>
        <div class='form-group'>
            <label for='ap'>Paterno</label>
            <input type='text' name='ap' id='ap' size='10' onkeyup='this.value=this.value.toUpperCase()'>
        </div>
        <div class='form-group'>
            <label for='am'>Materno</label>
            <input type='text' name='am' id='am' size='10' onkeyup='this.value=this.value.toUpperCase()'>
        </div>
        <div class='form-group'>
            <label for='nombres'>(*)Nombres</label>
            <input type='text' name='nombres' id='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()'>
        </div>
        <div class='form-group'>
            <label for='direccion'>(*)Dirección</label>
            <input type='text' name='direccion' id='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()'>
        </div>
        <div class='form-group'>
            <label for='telefono'>(*)Teléfono</label>
            <input type='text' name='telefono' id='telefono' size='10'>
        </div>
        <div class='form-group'>
            <label for='genero'>(*)Género</label>
            <select name='genero' id='genero'>
                <option value=''>Seleccione</option>
                <option value='M'>Masculino</option>
                <option value='F'>Femenino</option>
            </select>
        </div>
        <div class='full-width'>
            <h4>(*)datos obligatorios</h4>
            <input type='button' value='ACEPTAR' onclick='validar();'>
            <input type='reset' value='CANCELAR'>
        </div>
      </form>";

echo "</body>
      </html>";
?>
