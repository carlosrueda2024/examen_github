<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id_genero = $_POST["id_genero"];

//$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                      FROM generos
                      WHERE id_genero = ?
                      AND estado <> 'X'
                     ");
$rs3 = $db->GetAll($sql3, array($id_genero));

echo"<center>
      <table width='60%' border='1'>
        <tr>
          <th colspan='4'>Datos Genero</th>
        </tr>";

foreach ($rs3 as $k => $fila) {
    echo"<tr>
            <td align='center'>".$fila["anio_origen"]."</td>
            <td>".$fila["nombre"]."</td>
         </tr>";
}
echo"</table>
    </center>";

// CON ESTA CONSULTA VISUALIZO LOS USUARIOS CREADOS DE LA PERSONA
$sql4 = $db->Prepare("SELECT *
                      FROM artistas
                      WHERE id_genero = ?
                      AND estado <> 'X'
                     ");
$rs4 = $db->GetAll($sql4, array($id_genero));

echo"<center>
      <table width='60%' border='1'>
        <tr>
          <th colspan='4'>Datos Artista</th>
        </tr>
      ";
if ($rs4){
    foreach ($rs4 as $k => $fila) {
        echo"<tr>
                <td align='center'>".$fila["nombreA"]."</td>
                <td>".$fila["nombre_artistico"]."</td>
                <td>".$fila["pais"]."</td>
                <td>".$fila["fec_creacion"]."</td>
             </tr>";
    }
} else {
    echo"<tr>
            <td align='center'>NO TIENE ARTISTAS</td>
         </tr>";
}

echo"</table>
    </center>";
?>
