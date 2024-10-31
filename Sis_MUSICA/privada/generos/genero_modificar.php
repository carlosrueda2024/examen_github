<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
// $db->debug=true;

$id_genero = $_POST["id_genero"];

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
         <script src='../js/expresiones_regulares.js'></script>
         <script src='js/validacion_generos.js'></script>
       </head>
       <body>
       <p>&nbsp;</p>";
       
echo "<h1>MODIFICAR GÉNERO</h1>";

$sql = $db->Prepare("SELECT *
                     FROM generos
                     WHERE id_genero = ?
                     AND estado <> 'X'");
$rs = $db->GetAll($sql, array($id_genero));

foreach ($rs as $k => $fila) {  
    echo "<form action='genero_modificar1.php' method='post' name='formu' class='form-container'>";
    echo "  <div class='form-group'>
                <label for='nombre'>(*)Nombre</label>
                <input type='text' name='nombre' id='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["nombre"] . "'>
            </div>
            <div class='form-group'>
                <label for='anio_origen'>Año Origen</label>
                <input type='number' name='anio_origen' id='anio_origen' min='1900' max='2024' step='1' onkeydown='return false' value='" . $fila["anio_origen"] . "'>
            </div>
            <div class='full-width'>
                <h4>(*)datos obligatorios</h4>
                <input type='button' value='ACEPTAR' onclick='validar();'>
                <input type='reset' value='CANCELAR'>
                <input type='hidden' name='id_genero' value='" . $fila["id_genero"] . "'>
            </div>";
    echo "</form>";
}
echo "</body>
      </html>";
?>
