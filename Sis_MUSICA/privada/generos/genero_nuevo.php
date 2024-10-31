<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

// $db->debug = true;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
         <script src='../js/expresiones_regulares.js'></script>
         <script src='js/validacion_generos.js'></script>
       </head>
       <body>
       <p>&nbsp;</p>
       <h1>INSERTAR GÉNERO</h1>";

echo "<form action='genero_nuevo1.php' method='post' name='formu' class='form-container'>
        <div class='form-group'>
            <label for='nombre'>(*)Nombre</label>
            <input type='text' name='nombre' id='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()'>
        </div>
        <div class='form-group'>
            <label for='anio_origen'>Año Origen</label>
            <input type='number' name='anio_origen' id='anio_origen' min='1900' max='2024' step='1' onkeydown='return false'>
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
