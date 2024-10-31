<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
$db->debug=true;

$id_grupo = $_POST["id_grupo"];


echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
       
         echo"<h1>MODIFICAR GRUPO</h1>";

$sql = $db->Prepare("SELECT *
                     FROM grupos
                     WHERE id_grupo = ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_grupo));
 /*  if ($rs) {*/
  foreach ($rs as $k => $fila) {  
        echo"<form action='grupo_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th><b>(*)Grupo</b></th><td><input type='text' name='grupo' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["grupo"]."'>
                    </td>
                  </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR GRUPO'  >
                      <input type='hidden' name='id_grupo' value='".$fila["id_grupo"]."'>
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/
}
echo "</body>
      </html> ";

 ?>