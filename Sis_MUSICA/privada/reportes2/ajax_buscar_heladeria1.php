<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id = $_POST["id"];

//$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                      FROM heladeria_pasteleria
                      WHERE id = ?
                     ");
$rs3 = $db->GetAll($sql3, array($id));

echo"<center>
      <table width='60%' border='1'>
        <tr>
          <th colspan='4'>Datos Heladeria</th>
        </tr>";

foreach ($rs3 as $k => $fila) {
    echo"<tr>
            <td align='center'>".$fila["nombre_heladeria_pasteleria"]."</td>
            <td>".$fila["direccion"]."</td>
            <td>".$fila["telefono"]."</td>
         </tr>";
}
echo"</table>
    </center>";

// CON ESTA CONSULTA VISUALIZO LOS USUARIOS CREADOS DE LA PERSONA
$sql4 = $db->Prepare("SELECT *
                      FROM tortas
                      WHERE heladeria_pasteleria_id = ?
                     ");
$rs4 = $db->GetAll($sql4, array($id));

echo"<center>
      <table width='60%' border='1'>
        <tr>
          <th colspan='4'>Datos Tortas</th>
        </tr>
      ";
if ($rs4){
    foreach ($rs4 as $k => $fila) {
        echo"<tr>
                <td align='center'>".$fila["nombre"]."</td>
                <td align='center'>".$fila["cantidad"]."</td>
                <td align='center'>".$fila["precio"]."</td>
             </tr>";
    }
} else {
    echo"<tr>
            <td align='center'>NO TIENE TORTAS</td>
         </tr>";
}

echo"</table>
    </center>";
?>
