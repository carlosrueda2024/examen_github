<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"] ?? '';
$descripcion = $_POST["descripcion"] ?? '';
$fec_creacion = $_POST["fec_creacion"] ?? '';
$usuario = $_POST["usuario"] ?? '';

//$db->debug = true;

if ($nombre || $descripcion || $fec_creacion || $usuario) {
    $sql3 = $db->Prepare("SELECT CONCAT_WS(' ', u.nom_usuario) AS usuarios, l.* 
                          FROM usuarios_visitas u, lista_reproduccion l
                          WHERE u.id_usuario_visita = l.id_usuario_visita
                          AND l.nombre LIKE ?
                          AND l.descripcion LIKE ?
                          AND l.fec_creacion LIKE ?
                          AND u.nom_usuario LIKE ?
                          AND u.estado <> 'X' 
                          AND l.estado <> 'X'");
    $rs3 = $db->GetAll($sql3, array($nombre."%", $descripcion."%", $fec_creacion."%", $usuario."%"));
    if ($rs3) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>USUARIOS</th><th>NOMBRE</th><th>DESCRIPCIÓN</th><th>FECHA CREACIÓN</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
        foreach ($rs3 as $fila) {
            echo "<tr>
                  <td>".resaltar($usuario, $fila["usuarios"])."</td>
                  <td>".resaltar($nombre, $fila["nombre"])."</td>
                  <td>".resaltar($descripcion, $fila["descripcion"])."</td>
                  <td>".resaltar($fec_creacion, $fila["fec_creacion"])."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id_lista_reproduccion']."' method='post' action='lista_reproduccion_modificar.php'>
                  <input type='hidden' name='id_lista_reproduccion' value='".$fila['id_lista_reproduccion']."'>
                  <input type='hidden' name='id_usuario_visita' value='".$fila['id_usuario_visita']."'>
                  <a href='javascript:document.formModif".$fila['id_lista_reproduccion'].".submit();' title='Modificar Lista de Reproducción'>
                    Modificar>
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_lista_reproduccion']."' method='post' action='lista_reproduccion_eliminar.php'>
                  <input type='hidden' name='id_lista_reproduccion' value='".$fila['id_lista_reproduccion']."'>
                  <a href='javascript:document.formElimi".$fila['id_lista_reproduccion'].".submit();' title='Eliminar Lista de Reproducción' onclick='javascript:return(confirm(\"¿Realmente desea eliminar la lista ".$fila["nombre"]."?\"));'>
                    Eliminar>
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
        echo "<center><b style='color: #01FFFF;'>LA LISTA DE REPRODUCCION NO EXISTE!!</b></center><br>";
    }
}
?>
