<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
$db->debug=true;

$grupo=strip_tags(stripslashes($_POST["grupo"]));
$opcion=strip_tags(stripslashes($_POST["opcion"]));



if($grupo or $opcion){
           $sql3 = $db->Prepare(" SELECT  *
                                  FROM   grupos gru, opciones op
                                  WHERE  gru.grupo LIKE ?
                                  AND    op.opcion LIKE ?
                                  AND    op.id_grupo=gru.id_grupo
                                  AND    gru.estado <> 'X'
                                  AND    op.estado <> 'X'           
                              ");
$rs3 = $db->GetAll($sql3,array($grupo."%",$opcion."%"));
if ($rs3) {
  echo"<center>
        <table class='listado'>
          <tr>                                   
            <th>GRUPO</th><th>OPCION</th><th>CONTENIDO</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
          </tr>";
      foreach ($rs3 as $k => $fila) {                                       
                  $str=$fila["grupo"];                  
                  $str1=$fila["opcion"];
                  $str2=$fila["contenido"];
          echo "<tr>
                    <td align='center'>".resaltar($grupo,$str)."</td>
                    <td>".resaltar($opcion,$str1)."</td>
                    <td>".$str2."</td>
                    <td align='center'>
                      <form name='formModif".$fila["id_opcion"]."' method='post' action=opcion_modificar.php'>
                      <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
                      <a href='javascript:document.formModif".$fila['id_opcion'].".submit();' title='Modificar Opcion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_opcion"]."' method='post' action='opcion_eliminar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                            <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' title='Eliminar Opcion Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar la opción ".$fila["opcion"]." ?\"))'; location.href='opcion_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                </tr>";
            }
             echo"</table>
          </center>";
    }else{
      echo "<center><b style='color: #01FFFF;'>LA OPCION NO EXISTE!!</b></center><br>";
    }
  }
 ?>