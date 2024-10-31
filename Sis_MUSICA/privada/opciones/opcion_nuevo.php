<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>
         <h1>INSERTAR OPCION</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,grupo) as grupo, id_grupo
                     FROM grupos
                     WHERE estado = 'A'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='opcion_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Grupo</th>
                    <td>
                      <select name='id_grupo'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_grupo']."'>".$fila['grupo']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Opcion</b></th>
                    <td><input type='text' name='opcion' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                    </tr>
                  <tr>
                    <th><b>(*)Contenido</b></th>
                    <td><input type='text' name='contenido' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Orden</b></th>
                    <td><input type='text' name='orden' size='10'></td>
                  </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR OPCION'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>