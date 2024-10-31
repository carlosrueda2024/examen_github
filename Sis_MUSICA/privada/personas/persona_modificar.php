<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
$db->debug = true;

$id_persona = $_POST["id_persona"];

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
         <script src='../js/expresiones_regulares.js'></script>
         <script src='../js/validacion_formularios.js'></script>
       </head>
       <body>
       <p>&nbsp;</p>";
       
echo "<h1>MODIFICAR PERSONA</h1>";

$sql = $db->Prepare("SELECT *
                     FROM personas
                     WHERE id_persona = ?
                     AND estado <> 'X'");
$rs = $db->GetAll($sql, array($id_persona));

foreach ($rs as $k => $fila) {  
    echo "<form action='persona_modificar1.php' method='post' name='formu' class='form-container'>";
    echo "  <div class='form-group'>
                <label for='ci'>(*)CI</label>
                <input type='text' name='ci' id='ci' size='10' value='" . $fila["ci"] . "'>
            </div>
            <div class='form-group'>
                <label for='ap'>Paterno</label>
                <input type='text' name='ap' id='ap' size='10' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["ap"] . "'>
            </div>
            <div class='form-group'>
                <label for='am'>Materno</label>
                <input type='text' name='am' id='am' size='10' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["am"] . "'>
            </div>
            <div class='form-group'>
                <label for='nombres'>(*)Nombres</label>
                <input type='text' name='nombres' id='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["nombres"] . "'>
            </div>
            <div class='form-group'>
                <label for='direccion'>Dirección</label>
                <input type='text' name='direccion' id='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()' value='" . $fila["direccion"] . "'>
            </div>
            <div class='form-group'>
                <label for='telefono'>Teléfono</label>
                <input type='text' name='telefono' id='telefono' size='10' value='" . $fila["telefono"] . "'>
            </div>
            <div class='form-group'>
                <label for='genero'>(*)Género</label>
                <select name='genero' id='genero'>
                    <option value=''>Seleccione</option>
                    <option value='M' " . ($fila["genero"] == 'M' ? 'selected' : '') . ">Masculino</option>
                    <option value='F' " . ($fila["genero"] == 'F' ? 'selected' : '') . ">Femenino</option>
                </select>
            </div>
            <div class='full-width'>
                <h4>(*)datos obligatorios</h4>
                <input type='button' value='ACEPTAR' onclick='validar();'>
                <input type='reset' value='CANCELAR'>
                <input type='hidden' name='id_persona' value='" . $fila["id_persona"] . "'>
            </div>";
    echo "</form>";
}
echo "</body>
      </html>";
?>
