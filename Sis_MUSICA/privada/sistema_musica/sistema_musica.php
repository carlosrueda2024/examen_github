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
                     FROM sistema_musica
                     WHERE estado <> 'X' 
                     ORDER BY id_sistema_musica DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <h1>LISTADO DE NOMBRES SISTEMAS MUSICA</h1>
              <b><a  href='sistema_musica_nuevo.php'>Nuevo Nombre de sistema>>>></a></b>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRE</th><th>LOGOTIPO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['logotipo']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_sistema_musica"]."' method='post' action='sistema_musica_modificar.php'>
                            <input type='hidden' name='id_sistema_musica' value='".$fila['id_sistema_musica']."'>
                            <a href='javascript:document.formModif".$fila['id_sistema_musica'].".submit();' title='Modificar Nombre Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_sistema_musica"]."' method='post' action='sistema_musica_eliminar.php'>
                            <input type='hidden' name='id_sistema_musica' value='".$fila["id_sistema_musica"]."'>
                            <a href='javascript:document.formElimi".$fila['id_sistema_musica'].".submit();' title='Eliminar Nombre Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar el Nombre".$fila["nombre"]." ".$fila["logotipo"]." ?\"))'; location.href='sistema_musica_eliminar.php''> 
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