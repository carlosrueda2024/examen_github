<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$ap = $_POST["ap"];
$am = $_POST["am"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];

if ($ap || $am || $nombres || $ci) {
    $sql3 = $db->Prepare("SELECT *
                          FROM personas
                          WHERE ap LIKE ?
                          AND am LIKE ?
                          AND nombres LIKE ?
                          AND ci LIKE ?
                          AND estado <> 'X'
                         ");
    
    $rs3 = $db->GetAll($sql3, array($ap."%", $am."%", $nombres."%", $ci."%"));

    if ($rs3) {
        echo "<center>
              <table width='60%' border='1'>
                <tr>
                  <th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES</th><th>?</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {
            $str = $fila["ci"];
            $str1 = $fila["ap"];
            $str2 = $fila["am"];
            $str3 = $fila["nombres"];
            echo "<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($ap, $str1)."</td>
                    <td>".resaltar($am, $str2)."</td>
                    <td>".resaltar($nombres, $str3)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='{$fila["id_persona"]}' onClick='buscarPersona(this.value)'>
                    </td>
                  </tr>";
        }
        echo "</table>
        </center>";
    } else {
        echo "<center><b> LA PERSONA NO EXISTE!!</b></center><br>";
    }
}
?>
