<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$heladeria_pasteleria = $_POST["heladeria_pasteleria"] ?? '';
$nombre = $_POST["nombre"] ?? '';
$precio = $_POST["precio"] ?? '';
$cantidad = $_POST["cantidad"] ?? '';

//$db->debug = true;

if ($heladeria_pasteleria || $nombre || $precio || $cantidad) {
    $sql = $db->Prepare("SELECT h.nombre_heladeria_pasteleria as heladeria, t.*
                          FROM heladeria_pasteleria h, tortas t
                          WHERE h.id = t.heladeria_pasteleria_id
                          AND h.nombre_heladeria_pasteleria LIKE ?
                          AND t.nombre LIKE ?
                          AND t.precio LIKE ?
                          AND t.cantidad LIKE ?");
    $rs = $db->GetAll($sql, array("%$heladeria_pasteleria%", "%$nombre%", "%$precio%", "%$cantidad%"));
    
    if ($rs) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>HELADERÍA/PASTELERÍA</th><th>NOMBRE</th><th>PRECIO</th><th>CANTIDAD</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
              
        foreach ($rs as $fila) {
            echo "<tr>
                  <td>".resaltar($heladeria_pasteleria, $fila["heladeria"])."</td>
                  <td>".resaltar($nombre, $fila["nombre"])."</td>
                  <td>".resaltar($precio, $fila["precio"])."</td>
                  <td>".resaltar($cantidad, $fila["cantidad"])."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id']."' method='post' action='torta_modificar.php'>
                  <input type='hidden' name='id' value='".$fila['id']."'>
                  <input type='hidden' name='heladeria_pasteleria_id' value='".$fila['heladeria_pasteleria_id']."'>
                  <a href='javascript:document.formModif".$fila['id'].".submit();' title='Modificar Torta'>
                    Modificar>
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id']."' method='post' action='torta_eliminar.php'>
                  <input type='hidden' name='id' value='".$fila['id']."'>
                  <a href='javascript:document.formElimi".$fila['id'].".submit();' title='Eliminar Torta' onclick='javascript:return(confirm(\"Desea realmente eliminar la torta ".$fila["nombre"]." ?\"));'>
                    Eliminar>
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
        echo "<center><b style='color: #01FFFF;'>NO SE ENCONTRARON REGISTROS DE TORTAS</b></center><br>";
    }
}
?>
