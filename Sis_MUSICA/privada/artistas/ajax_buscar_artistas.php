<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$genero = $_POST["genero"] ?? '';
$nombre_artistico = $_POST["nombre_artistico"] ?? '';
$pais = $_POST["pais"] ?? '';

//$db->debug = true;

if ($genero || $nombre_artistico || $pais) {
    $sql = $db->Prepare("SELECT g.nombre as genero, a.*
                          FROM generos g, artistas a
                          WHERE g.id_genero = a.id_genero
                          AND g.nombre LIKE ?
                          AND a.nombre_artistico LIKE ?
                          AND a.pais LIKE ?
                          AND a.estado <> 'X'");
    $rs = $db->GetAll($sql, array("%$genero%", "%$nombre_artistico%", "%$pais%"));
    if ($rs) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>GÉNERO</th><th>NOMBRE ARTÍSTICO</th><th>PAÍS</th><th>FECHA CREACIÓN</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
        foreach ($rs as $fila) {
            echo "<tr>
                  <td>".resaltar($genero, $fila["genero"])."</td>
                  <td>".resaltar($nombre_artistico, $fila["nombre_artistico"])."</td>
                  <td>".resaltar($pais, $fila["pais"])."</td>
                  <td>".$fila["fec_creacion"]."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id_artista']."' method='post' action='artista_modificar.php'>
                  <input type='hidden' name='id_artista' value='".$fila['id_artista']."'>
                  <input type='hidden' name='id_genero' value='".$fila['id_genero']."'>
                  <a href='javascript:document.formModif".$fila['id_artista'].".submit();' title='Modificar Artista'>
                    Modificar>
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_artista']."' method='post' action='artista_eliminar.php'>
                  <input type='hidden' name='id_artista' value='".$fila['id_artista']."'>
                  <a href='javascript:document.formElimi".$fila['id_artista'].".submit();' title='Eliminar Artista' onclick='javascript:return(confirm(\"Desea realmente eliminar al artista ".$fila["nombre_artistico"]." ?\"));'>
                    Eliminar>
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
        echo "<center><b style='color: #01FFFF;'>No se encontraron artistas con los criterios de búsqueda.</b></center><br>";
    }
}
?>
