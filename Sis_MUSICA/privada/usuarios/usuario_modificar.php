<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

// $db->debug=true;
$id_persona = $_POST["id_persona"];
$id_usuario = $_POST["id_usuario"];

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
         <script src='../js/expresiones_regulares.js'></script>
         <script src='js/validacion_usuarios.js'></script>
       </head>
       <body>
       <p>&nbsp;</p>";

echo "<h1>MODIFICAR USUARIO</h1>";

$sql = $db->Prepare("SELECT *
                     FROM usuarios
                     WHERE id_usuario = ?
                     AND estado = 'A'");
$rs = $db->GetAll($sql, array($id_usuario));

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombres) AS persona, id_persona
                     FROM personas
                     WHERE id_persona = ?
                     AND estado = 'A'");
$rs1 = $db->GetAll($sql1, array($id_persona));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombres) AS persona, id_persona
                     FROM personas
                     WHERE id_persona <> ?
                     AND estado = 'A'");
$rs2 = $db->GetAll($sql2, array($id_persona));

echo "<form action='usuario_modificar1.php' method='post' name='formu' class='form-container'>";

echo "  <div class='form-group'>
            <label for='id_persona'>(*)Persona</label>
            <select name='id_persona' id='id_persona'>";
                foreach ($rs1 as $fila) {
                    echo "<option value='".$fila['id_persona']."' selected>".$fila['persona']."</option>";    
                }
                foreach ($rs2 as $fila) {
                    echo "<option value='".$fila['id_persona']."'>".$fila['persona']."</option>";    
                }
echo "      </select>
        </div>";

foreach ($rs as $fila) {
    echo "<div class='form-group'>
            <label for='usuario_principal'>(*)Nombre de usuario</label>
            <input type='text' name='usuario_principal' id='usuario_principal' size='10' value='".$fila["usuario_principal"]."'>
          </div>
          <div class='form-group'>
            <label for='clave'>(*)Clave</label>
            <input type='password' name='clave' id='clave' size='10'>
          </div>";
}

echo "  <div class='full-width'>
            <h4>(*)datos obligatorios</h4>
            <input type='button' value='ACEPTAR' onclick='validarU();'>
            <input type='reset' value='CANCELAR'>
            <input type='hidden' name='id_usuario' value='".$id_usuario."'>
        </div>";

echo "</form>";

echo "</body>
      </html>";
?>
