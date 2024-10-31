<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$pastor = $_POST["pastor"] ?? '';
$nombre_mensaje = $_POST["nombre_mensaje"] ?? '';
$nombre_evento = $_POST["nombre_evento"] ?? '';

//$db->debug = true;

if ($pastor || $nombre_mensaje || $nombre_evento) {
    $sql = $db->Prepare("SELECT p.especialidad as pastor, m.*
                         FROM pastores p, mensajes m
                         WHERE p.id_pastor = m.id_pastor
                         AND p.especialidad LIKE ?
                         AND m.nombre_mensaje LIKE ?
                         AND m.nombre_evento LIKE ?
                         AND m.estado <> 'X'
                         AND p.estado <> 'X'");
    $rs = $db->GetAll($sql, array("%$pastor%", "%$nombre_mensaje%", "%$nombre_evento%"));

    if ($rs) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>PASTOR</th><th>NOMBRE MENSAJE</th><th>NOMBRE EVENTO</th><th>FECHA</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
        foreach ($rs as $fila) {
            echo "<tr>
                  <td>".resaltar($pastor, $fila["pastor"])."</td>
                  <td>".resaltar($nombre_mensaje, $fila["nombre_mensaje"])."</td>
                  <td>".resaltar($nombre_evento, $fila["nombre_evento"])."</td>
                  <td>".$fila["fecha"]."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id_mensaje']."' method='post' action='mensaje_modificar.php'>
                  <input type='hidden' name='id_mensaje' value='".$fila['id_mensaje']."'>
                  <input type='hidden' name='id_pastor' value='".$fila['id_pastor']."'>
                  <a href='javascript:document.formModif".$fila['id_mensaje'].".submit();' title='Modificar Mensaje'>
                    Modificar&gt;&gt;
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_mensaje']."' method='post' action='mensaje_eliminar.php'>
                  <input type='hidden' name='id_mensaje' value='".$fila['id_mensaje']."'>
                  <a href='javascript:document.formElimi".$fila['id_mensaje'].".submit();' title='Eliminar Mensaje' onclick='javascript:return(confirm(\"Desea realmente eliminar el mensaje ".$fila["nombre_mensaje"]." ?\"));'>
                    Eliminar&gt;&gt;
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
        echo "<center><b style='color: #01FFFF;'>NO SE ENCONTRARON MENSAJES.</b></center><br>";
    }
}
?>
