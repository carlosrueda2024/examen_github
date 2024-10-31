<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nom_usuario = $_POST["nom_usuario"] ?? '';

// $db->debug = true;

if ($nom_usuario) {
    $sql3 = $db->Prepare("SELECT *
                          FROM usuarios_visitas
                          WHERE nom_usuario LIKE ?
                          AND estado <> 'X'");
    $rs3 = $db->GetAll($sql3, array($nom_usuario."%"));
    
    if ($rs3) {
        echo "<center>
              <table class='listado'>
              <tr>
              <th>NOMBRE USUARIO</th>
              <th><img src='../../imagenes/modificar.gif'></th>
              <th><img src='../../imagenes/borrar.jpeg'></th>
              </tr>";
              
        foreach ($rs3 as $fila) {
            echo "<tr>
                  <td>".resaltar($nom_usuario, $fila["nom_usuario"])."</td>
                  <td align='center'>
                  <form name='formModif".$fila['id_usuario_visita']."' method='post' action='usuario_visita_modificar.php'>
                  <input type='hidden' name='id_usuario_visita' value='".$fila['id_usuario_visita']."'>
                  <a href='javascript:document.formModif".$fila['id_usuario_visita'].".submit();' title='Modificar Usuario Sistema'>
                    Modificar>
                  </a>
                  </form>
                  </td>
                  <td align='center'>
                  <form name='formElimi".$fila['id_usuario_visita']."' method='post' action='usuario_visita_eliminar.php'>
                  <input type='hidden' name='id_usuario_visita' value='".$fila['id_usuario_visita']."'>
                  <a href='javascript:document.formElimi".$fila['id_usuario_visita'].".submit();' title='Eliminar Usuario Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al usuario ".$fila["nom_usuario"]."?\"));'>
                    Eliminar>
                  </a>
                  </form>
                  </td>
                  </tr>";
        }
        echo "</table>
              </center>";
    } else {
        echo "<center><b style='color: #01FFFF;'>EL USUARIO NO EXISTE!!</b></center><br>";
    }
}
?>
