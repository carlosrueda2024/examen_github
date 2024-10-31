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
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', p.grupo) AS grupo, u.* 
                     FROM grupos p, opciones u
                     WHERE p.id_grupo = u.id_grupo
                     AND p.estado <> 'X' 
                     AND u.estado <> 'X' 
                     ORDER BY u.id_opcion DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <h1>LISTADO DE OPCIONES</h1>
              <b><a  href='opcion_nuevo.php'>Nueva Opcion>>>></a></b>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>GRUPO</th><th>OPCION</th><th>ORDEN</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['grupo']."</td>                        
                        <td>".$fila['opcion']."</td>
                        <td>".$fila['orden']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_opcion"]."' method='post' action='opcion_modificar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
                            <input type='hidden' name='id_grupo' value='".$fila['id_grupo']."'>

                            <a href='javascript:document.formModif".$fila['id_opcion'].".submit();' title='Modificar Opcion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_opcion"]."' method='post' action='opcion_eliminar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                            <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' title='Eliminar Opcion Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar opcion ".$fila["opcion"]." ?\"))'; location.href='opcion_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }
echo "</body>
      </html> ";

 ?>