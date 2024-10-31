<?php
session_start();
require_once("../../conexion.php");

$id_pastor = $_POST["id_pastor"];
$sql3 = $db->Prepare("SELECT *
                      FROM pastores
                      WHERE id_pastor = ?
                     ");
$rs3 = $db->GetAll($sql3, array($id_pastor));

echo "<center>
      <table width='60%' border='1'>
        <tr>
          <th colspan='4'>Datos del Pastor</th>
        </tr>";

foreach ($rs3 as $k => $fila) {
    echo "<tr>
            <td align='center'>".$fila["especialidad"]."</td>
            <td>".$fila["sueldo"]."</td>
            <td>".$fila["cargo"]."</td>
         </tr>";
}
echo "</table>
    </center>";

$sql4 = $db->Prepare("SELECT *
                      FROM mensajes
                      WHERE id_pastor = ?
                      AND estado <> 'X'
                     ");
$rs4 = $db->GetAll($sql4, array($id_pastor));

echo "<center>
      <table width='60%' border='1'>
        <tr>
          <th colspan='4'>Datos de los mensajes</th>
        </tr>";

if ($rs4) {
    foreach ($rs4 as $k => $fila) {
        echo "<tr>
                <td align='center'>".$fila["nombre_mensaje"]."</td>
                <td align='center'>".$fila["nombre_evento"]."</td>
                <td align='center'>".$fila["fecha"]."</td>
             </tr>";
    }
} else {
    echo "<tr>
            <td align='center'>NO TIENE MENSAJES</td>
         </tr>";
}

echo "</table>
    </center>";
?>
