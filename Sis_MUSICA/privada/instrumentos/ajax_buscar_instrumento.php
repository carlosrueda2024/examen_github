<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"] ?? '';
$tipo = $_POST["tipo"] ?? '';
$descripcion = $_POST["descripcion"] ?? '';
$fec_insercion = $_POST["fec_insercion"] ?? '';

//$db->debug = true;

if ($nombre || $tipo || $descripcion || $fec_insercion) {
    $sql3 = $db->Prepare("SELECT *
                          FROM instrumentos
                          WHERE nombre LIKE ?
                          AND tipo LIKE ?
                          AND descripcion LIKE ?
                          AND fec_insercion LIKE ?
                          AND estado <> 'X'");
    $rs3 = $db->GetAll($sql3, array($nombre."%", $tipo."%", $descripcion."%", $fec_insercion."%"));
    if ($rs3) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>NOMBRE</th><th>TIPO</th><th>DECRIPCION</th><th>FECHA</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
        foreach ($rs3 as $fila) {
            echo "<tr>
                  <td align='center'>".resaltar($nombre, $fila["nombre"])."</td>
                  <td>".resaltar($tipo, $fila["tipo"])."</td>
                  <td>".resaltar($descripcion, $fila["descripcion"])."</td>
                  <td>".resaltar($fec_insercion, $fila["fec_insercion"])."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id_instrumento']."' method='post' action='instrumento_modificar.php'>
                  <input type='hidden' name='id_instrumento' value='".$fila['id_instrumento']."'>
                  <a href='javascript:document.formModif".$fila['id_instrumento'].".submit();' title='Modificar Instrumento Sistema'>
                    Modificar>
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_instrumento']."' method='post' action='instrumento_eliminar.php'>
                  <input type='hidden' name='id_instrumento' value='".$fila['id_instrumento']."'>
                  <a href='javascript:document.formElimi".$fila['id_instrumento'].".submit();' title='Eliminar Instrumento Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al instrumento ".$fila["nombre"]." ".$fila["tipo"]." ".$fila["descripcion"]."?\"));'>
                    Eliminar>
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
      echo "<center><b style='color: #01FFFF;'>EL INSTRUMENTO NO EXISTE!!</b></center><br>";

    }
}
?>
