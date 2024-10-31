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
       
        

$sql = $db->Prepare("SELECT *
                     FROM roles
                     WHERE estado <> 'X' 
                     ORDER BY id_rol DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <h1>LISTADO DE ROLES</h1>
              <b><a  href='rol_nuevo.php'>Nuevo Rol>>>></a></b>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>ROL</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['rol']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_rol"]."' method='post' action='rol_modificar.php'>
                            <input type='hidden' name='id_rol' value='".$fila['id_rol']."'>
                            <a href='javascript:document.formModif".$fila['id_rol'].".submit();' title='Modificar Rol Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_rol"]."' method='post' action='rol_eliminar.php'>
                            <input type='hidden' name='id_rol' value='".$fila["id_rol"]."'>
                            <a href='javascript:document.formElimi".$fila['id_rol'].".submit();' title='Eliminar Rol Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar el rol ".$fila["rol"]." ?\"))'; location.href='rol_eliminar.php''> 
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