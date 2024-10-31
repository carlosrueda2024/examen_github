<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$dpto = $_POST["dpto"];
$telefono = $_POST["telefono"];
$dir_suc = $_POST["dir_suc"];
$limpieza = $_POST["limpieza"]; // Nueva variable para el género

// Verifica si al menos uno de los campos de búsqueda tiene valor
if ($dpto || $telefono || $dir_suc || $limpieza) {
    $sql3 = $db->Prepare("SELECT s.*, g.nombre AS limpieza
                          FROM sucursales s
                          JOIN compania_limpieza g ON s.compania_limpieza_id = g.id
                          WHERE s.dpto LIKE ?
                          AND s.telefono LIKE ?
                          AND s.dir_suc LIKE ?
                          AND g.nombre LIKE ?
                         ");
    
    $rs3 = $db->GetAll($sql3, array($dpto."%", $telefono."%", $dir_suc."%", $limpieza."%"));

    if ($rs3) {
        echo "<center>
              <table width='60%' border='1'>
                <tr>
                  <th>DEPARTAMENTO</th><th>TELEFONO</th><th>DIRECCION</th><th>LIMPIEZA</th><th>SELECCIONE</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {
            $str = $fila["dpto"];
            $str1 = $fila["telefono"];
            $str2 = $fila["dir_suc"];
            $str3 = $fila["limpieza"];
            echo "<tr>
                    <td align='center'>".resaltar($dpto, $str)."</td>
                    <td>".resaltar($telefono, $str1)."</td>
                    <td>".resaltar($dir_suc, $str2)."</td>
                    <td>".resaltar($limpieza, $str3)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='{$fila["id"]}' onClick='mostrar_sucursales(".$fila["id"].")'>
                    </td>
                  </tr>";
        }
        echo "</table>
        </center>";
    } else {
        echo "<center><b> ¡LA SUCURSAL NO EXISTE!</b></center><br>";
    }
}
?>
