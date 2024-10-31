<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"] ?? '';
$anio_origen = $_POST["anio_origen"] ?? '';

//$db->debug = true;

if ($nombre || $anio_origen) {
    $sql3 = $db->Prepare("SELECT *
                          FROM generos
                          WHERE nombre LIKE ?
                          AND anio_origen LIKE ?
                          AND estado <> 'X'");
    $rs3 = $db->GetAll($sql3, array($nombre."%", $anio_origen."%"));
    if ($rs3) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>NOMBRE</th><th>AÑO DE ORIGEN</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
        foreach ($rs3 as $fila) {
            echo "<tr>
                  <td align='center'>".resaltar($nombre, $fila["nombre"])."</td>
                  <td>".resaltar($anio_origen, $fila["anio_origen"])."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id_genero']."' method='post' action='genero_modificar.php'>
                  <input type='hidden' name='id_genero' value='".$fila['id_genero']."'>
                  <a href='javascript:document.formModif".$fila['id_genero'].".submit();' title='Modificar Genero Sistema'>
                    Modificar>
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_genero']."' method='post' action='genero_eliminar.php'>
                  <input type='hidden' name='id_genero' value='".$fila['id_genero']."'>
                  <a href='javascript:document.formElimi".$fila['id_genero'].".submit();' title='Eliminar Genero Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al genero ".$fila["nombre"]." ".$fila["anio_origen"]."?\"));'>
                    Eliminar>
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
      echo "<center><b style='color: #01FFFF;'>EL GENERO NO EXISTE!!</b></center><br>";

    }
}
?>
