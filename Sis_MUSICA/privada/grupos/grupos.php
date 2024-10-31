<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
       
        

$sql = $db->Prepare("SELECT *
                     FROM grupos
                     WHERE estado <> 'X' 
                     ORDER BY id_grupo DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <h1>LISTADO DE GRUPOS</h1>
              <b><a  href='grupo_nuevo.php'>Nuevo Grupo>>>></a></b>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>GRUPO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['grupo']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_grupo"]."' method='post' action='grupo_modificar.php'>
                            <input type='hidden' name='id_grupo' value='".$fila['id_grupo']."'>
                            <a href='javascript:document.formModif".$fila['id_grupo'].".submit();' title='Modificar Grupo Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_grupo"]."' method='post' action='grupo_eliminar.php'>
                            <input type='hidden' name='id_grupo' value='".$fila["id_grupo"]."'>
                            <a href='javascript:document.formElimi".$fila['id_grupo'].".submit();' title='Eliminar Grupo Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a Grupo ".$fila["grupo"]." ?\"))'; location.href='grupo_eliminar.php''> 
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