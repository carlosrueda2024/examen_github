<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nom_usuario = $_POST["nom_usuario"] ?? '';
$nombre = $_POST["nombre"] ?? '';
$valoracion = $_POST["valoracion"] ?? '';
$comentario = $_POST["comentario"] ?? '';

//$db->debug = true;

if ($nom_usuario || $nombre || $valoracion || $comentario) {
    $sql3 = $db->Prepare("SELECT CONCAT_WS(' ', u.nom_usuario) AS usuario_visita, v.*, 
                          CONCAT_WS(' ', c.nombre) AS cancion
                          FROM usuarios_visitas u, valoraciones v, canciones c
                          WHERE u.id_usuario_visita = v.id_usuario_visita
                          AND v.id_cancion = c.id_cancion
                          AND u.nom_usuario LIKE ?
                          AND c.nombre LIKE ?
                          AND v.valoracion LIKE ?
                          AND v.comentario LIKE ?
                          AND v.estado <> 'X'
                          AND u.estado <> 'X'
                          AND c.estado <> 'X'
                          ORDER BY v.id_valoracion DESC");

    $rs3 = $db->GetAll($sql3, array($nom_usuario."%", $nombre."%", $valoracion."%", $comentario."%"));
    if ($rs3) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>Usuario</th><th>Canción</th><th>Valoración</th><th>Comentario</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
        foreach ($rs3 as $fila) {
            echo "<tr>
                  <td>".resaltar($nom_usuario, $fila["usuario_visita"])."</td>
                  <td>".resaltar($nombre, $fila["cancion"])."</td>
                  <td>".resaltar($valoracion, $fila["valoracion"])."</td>
                  <td>".resaltar($comentario, $fila["comentario"])."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id_valoracion']."' method='post' action='valoracion_modificar.php'>
                  <input type='hidden' name='id_valoracion' value='".$fila['id_valoracion']."'>
                  <input type='hidden' name='id_usuario_visita' value='".$fila['usuario_visita']."'>
                  <input type='hidden' name='id_cancion' value='".$fila['id_cancion']."'>
                  <a href='javascript:document.formModif".$fila['id_valoracion'].".submit();' title='Modificar Valoración'>
                    Modificar
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_valoracion']."' method='post' action='valoracion_eliminar.php'>
                  <input type='hidden' name='id_valoracion' value='".$fila['id_valoracion']."'>
                  <a href='javascript:document.formElimi".$fila['id_valoracion'].".submit();' title='Eliminar Valoración' onclick='javascript:return(confirm(\"Desea realmente eliminar la valoración de ".$fila["usuario_visita"]." para la canción ".$fila["cancion"]."?\"));'>
                    Eliminar
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
      echo "<center><b style='color: #01FFFF;'>NO SE ENCONTRÓ NINGUNA VALORACIÓN!!</b></center><br>";
    }
}
?>
