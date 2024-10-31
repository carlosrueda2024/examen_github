<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id_persona = $_POST["id_persona"];

$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                      FROM personas
                      WHERE id_persona = ?
                      AND estado <> 'X'
                     ");
$rs3 = $db->GetAll($sql3, array($id_persona));

echo"<center>
      <table width='60%' border='1'>
        <tr>
          <th colspan='4'>Datos Persona</th>
        </tr>";

foreach ($rs3 as $k => $fila) {
    echo"<tr>
            <td align='center'>".$fila["ci"]."</td>
            <td>".$fila["ap"]."</td>
            <td>".$fila["am"]."</td>
            <td>".$fila["nombres"]."</td>
         </tr>";
}
echo"</table>
    </center>";

// CON ESTA CONSULTA VISUALIZO LOS USUARIOS CREADOS DE LA PERSONA
?>
