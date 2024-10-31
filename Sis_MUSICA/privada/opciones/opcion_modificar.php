<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");


$db->debug=true;
$id_grupo = $_POST["id_grupo"];
$id_opcion = $_POST["id_opcion"];
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>
         <h1>MODIFICAR OPCION</h1>";

$sql = $db->Prepare("SELECT *
                     FROM opciones
                     WHERE id_opcion = ?
                     AND estado = 'A'                        
                        ");
$rs = $db->GetAll($sql, array($id_opcion));


$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,grupo) as grupo, id_grupo
                     FROM grupos
                     WHERE id_grupo = ?
                     AND estado = 'A'                        
                        ");
$rs1 = $db->GetAll($sql1, array($id_grupo));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,grupo) as grupo, id_grupo
                     FROM grupos
                     WHERE id_grupo <> ?
                     AND estado = 'A'                        
                        ");
$rs2 = $db->GetAll($sql2, array($id_grupo));
 /*  if ($rs) {*/
        echo"<form action='opcion_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Grupo</th>
                    <td>
                      <select name='id_grupo'>";
                        foreach ($rs1 as $k => $fila) {
                        echo"<option value='".$fila['id_grupo']."'>".$fila['grupo']."</option>";    
                        }  
                        foreach ($rs2 as $k => $fila) {
                        echo"<option value='".$fila['id_grupo']."'>".$fila['grupo']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
                foreach ($rs as $k => $fila) {
             echo"<tr>
                    <th><b>(*)Opcion</b></th>
                    <td><input type='text' name='opcion' size='10' value='".$fila["opcion"]."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Contenido</b></th>
                    <td><input type='text' name='contenido' size='10' value='".$fila["contenido"]."'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Orden</b></th>
                    <td><input type='text' name='orden' size='10' value='".$fila["orden"]."'></td>
                  </tr>
                                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR OPCION'><br>
                      (*)Datos Obligatorios
                      <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                    </td>
                  </tr>";
                }
                echo"</table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>