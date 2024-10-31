<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$ap = $_POST["ap"] ?? '';
$am = $_POST["am"] ?? '';
$nombres = $_POST["nombres"] ?? '';
$ci = $_POST["ci"] ?? '';
$fec_insercion = $_POST["fec_insercion"] ?? '';

//$db->debug = true;

if ($ap || $am || $nombres || $ci || $fec_insercion) {
    $sql3 = $db->Prepare("SELECT *
                          FROM personas
                          WHERE ap LIKE ?
                          AND am LIKE ?
                          AND nombres LIKE ?
                          AND ci LIKE ?
                          AND fec_insercion LIKE ?
                          AND estado <> 'X'");
    $rs3 = $db->GetAll($sql3, array($ap."%", $am."%", $nombres."%", $ci."%", $fec_insercion."%"));
    if ($rs3) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES</th><th>FECHA</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
        foreach ($rs3 as $fila) {
            echo "<tr>
                  <td align='center'>".resaltar($ci, $fila["ci"])."</td>
                  <td>".resaltar($ap, $fila["ap"])."</td>
                  <td>".resaltar($am, $fila["am"])."</td>
                  <td>".resaltar($nombres, $fila["nombres"])."</td>
                  <td>".resaltar($fec_insercion, $fila["fec_insercion"])."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id_persona']."' method='post' action='persona_modificar.php'>
                  <input type='hidden' name='id_persona' value='".$fila['id_persona']."'>
                  <a href='javascript:document.formModif".$fila['id_persona'].".submit();' title='Modificar Persona Sistema'>
                    Modificar>
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_persona']."' method='post' action='persona_eliminar.php'>
                  <input type='hidden' name='id_persona' value='".$fila['id_persona']."'>
                  <a href='javascript:document.formElimi".$fila['id_persona'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la persona ".$fila["nombres"]." ".$fila["ap"]." ".$fila["am"]."?\"));'>
                    Eliminar>
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
      echo "<center><b style='color: #01FFFF;'>LA PERSONA NO EXISTE!!</b></center><br>";

    }
}
?>
