<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"] ?? '';
$duracion = $_POST["duracion"] ?? '';
$anio_lanza = $_POST["anio_lanza"] ?? '';

// $db->debug = true;

if ($nombre || $duracion || $anio_lanza) {
    $sql3 = $db->Prepare("SELECT c.*, g.nombre AS genero, a.nombre AS album, sm.nombre AS sistema_musica
                          FROM canciones c
                          JOIN generos g ON c.id_genero = g.id_genero
                          JOIN albunes a ON c.id_albun = a.id_albun
                          JOIN sistema_musica sm ON c.id_sistema_musica = sm.id_sistema_musica
                          WHERE c.nombre LIKE ?
                          AND c.duracion LIKE ?
                          AND c.anio_lanza LIKE ?
                          AND c.estado <> 'X'
                          ORDER BY c.id_cancion DESC");
    $rs3 = $db->GetAll($sql3, array($nombre."%", $duracion."%", $anio_lanza."%"));
    
    if ($rs3) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>Nro</th><th>NOMBRE</th><th>DURACION</th><th>AÑO DE LANZAMIENTO</th><th>REPRODUCIR</th>
              <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
        $b = 1;
        foreach ($rs3 as $fila) {
            echo "<tr>
                  <td align='center'>".$b."</td>
                  <td>".resaltar($nombre, $fila["nombre"])."</td>
                  <td>".resaltar($duracion, $fila["duracion"])."</td>
                  <td>".resaltar($anio_lanza, $fila["anio_lanza"])."</td>
                  <td align='center'>
                        <audio controls>
                            <source src='musica/".$fila['nombre']."' type='audio/mpeg'>
                            Your browser does not support the audio element.
                        </audio>
                  </td>
                  <td align='center'>
                  <form name='formModif".$fila['id_cancion']."' method='post' action='cancion_modificar.php'>
                  <input type='hidden' name='id_cancion' value='".$fila['id_cancion']."'>
                  <input type='hidden' name='id_albun' value='".$fila['id_albun']."'>
                  <input type='hidden' name='id_genero' value='".$fila['id_genero']."'>
                  <a href='javascript:document.formModif".$fila['id_cancion'].".submit();' title='Modificar Canción Sistema'>
                    Modificar >
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_cancion']."' method='post' action='cancion_eliminar.php'>
                  <input type='hidden' name='id_cancion' value='".$fila['id_cancion']."'>
                  <a href='javascript:document.formElimi".$fila['id_cancion'].".submit();' title='Eliminar Canción Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar la canción ".$fila["nombre"]."?\"));'>
                    Eliminar >
                  </a>
                  </form>
                  </td>
                  </tr>";
            $b++;
        }
        echo "</table>
              </center>";
    } else {
        echo "<center><b style='color: #01FFFF;'>LA CANCIÓN NO EXISTE!!</b></center><br>";
    }
}
?>
