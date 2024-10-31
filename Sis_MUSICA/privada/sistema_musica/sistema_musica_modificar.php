<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

$id_sistema_musica = 1;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
         <script src='../js/expresiones_regulares.js'></script>
         <script src='../js/validacion_sistema_musica.js'></script>
       </head>
       <body>
       <p>&nbsp;</p>
       <h1>MODIFICAR SISTEMA MUSICA</h1>";

$sql = $db->Prepare("SELECT *
                     FROM sistema_musica
                     WHERE id_sistema_musica = ?
                     AND estado <> 'X'");
$rs = $db->GetAll($sql, array($id_sistema_musica));

foreach ($rs as $fila) {
    echo "<form action='sistema_musica_modificar1.php' method='post' enctype='multipart/form-data' name='formu' class='form-container'>
            <div class='form-group'>
                <label for='nombre'>(*)Nombre</label>
                <input type='text' name='nombre' id='nombre' size='39' onkeyup='this.value=this.value.toUpperCase()' value='" . htmlspecialchars($fila["nombre"], ENT_QUOTES) . "'>
            </div>
            <div class='form-group'>
                <label for='logotipo'>(*)Logotipo</label>
                <input type='file' name='logotipo' id='logotipo' accept='image/*'>
                <br>" . htmlspecialchars($fila["logotipo"], ENT_QUOTES) . "
            </div>
            <div class='full-width'>
                <h4>(*)Datos obligatorios</h4>
                <input type='button' value='ACEPTAR' onclick='validar();'>
                <input type='reset' value='CANCELAR'>
                <input type='hidden' name='id_sistema_musica' value='" . htmlspecialchars($fila["id_sistema_musica"], ENT_QUOTES) . "'>
            </div>
          </form>";
}
echo "</body>
      </html>";
?>
