<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombreA = $_POST["nombreA"];
$nombre_artistico = $_POST["nombre_artistico"];
$pais = $_POST["pais"];
$fec_creacion = $_POST["fec_creacion"];
$genero = $_POST["genero"]; // Nueva variable para el género

// Verifica si al menos uno de los campos de búsqueda tiene valor
if ($nombreA || $nombre_artistico || $pais || $fec_creacion || $genero) {
    $sql3 = $db->Prepare("SELECT a.*, g.nombre AS genero
                          FROM artistas a
                          JOIN generos g ON a.id_genero = g.id_genero
                          WHERE a.nombreA LIKE ?
                          AND a.nombre_artistico LIKE ?
                          AND a.pais LIKE ?
                          AND a.fec_creacion LIKE ?
                          AND g.nombre LIKE ?
                          AND a.estado <> 'X'
                         ");
    
    $rs3 = $db->GetAll($sql3, array($nombreA."%", $nombre_artistico."%", $pais."%", $fec_creacion."%", $genero."%"));

    if ($rs3) {
        echo "<center>
              <table width='60%' border='1'>
                <tr>
                  <th>NOMBRE</th><th>NOMBRE ARTÍSTICO</th><th>PAÍS</th><th>FECHA CREACIÓN</th><th>GÉNERO</th><th>SELECCIONE</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {
            $str = $fila["nombreA"];
            $str1 = $fila["nombre_artistico"];
            $str2 = $fila["pais"];
            $str3 = $fila["fec_creacion"];
            $str4 = $fila["genero"];
            echo "<tr>
                    <td align='center'>".resaltar($nombreA, $str)."</td>
                    <td>".resaltar($nombre_artistico, $str1)."</td>
                    <td>".resaltar($pais, $str2)."</td>
                    <td>".resaltar($fec_creacion, $str3)."</td>
                    <td>".resaltar($genero, $str4)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='{$fila["id_artista"]}' onClick='mostrar_artista(".$fila["id_artista"].")'>
                    </td>
                  </tr>";
        }
        echo "</table>
        </center>";
    } else {
        echo "<center><b> ¡EL ARTISTA NO EXISTE!</b></center><br>";
    }
}
?>
