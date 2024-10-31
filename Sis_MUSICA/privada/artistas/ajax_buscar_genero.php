<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$anio_origen = $_POST["anio_origen"];
$nombre = $_POST["nombre"];

//$db->debug=true;

if ($anio_origen or $nombre){
    $sql3 = $db->Prepare("SELECT *
                          FROM generos
                          WHERE anio_origen LIKE ?
                          AND nombre LIKE ?
                          AND estado <> 'X'
                         ");
    
    $rs3 = $db->GetAll($sql3, array($anio_origen."%", $nombre."%"));

    if ($rs3) {
        echo "<center>
              <table width='60%' border='1'>
                <tr>
                  <th>AÑO DE ORIGEN</th><th>NOMBRE</th><th>?</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {
            $str = $fila["anio_origen"];
            $str1 = $fila["nombre"];
            echo "<tr>
                    <td align='center'>".resaltar($anio_origen, $str)."</td>
                    <td>".resaltar($nombre, $str1)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_genero(".$fila["id_genero"].")'>
                    </td>
                  </tr>";
        }
        echo "</table>
        </center>";
        } else {
            echo "<center><b> EL GENERO NO EXISTE!!</b></center><br>";
            echo "<center>
                <table class='listado'>
                    <tr>
                        <th><b>(*)Nombre</b></th><td><input type='text' name='nombre1' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                        </td>
                    </tr>
                    <tr>
                        <th><b>Año Origen</b></th>
                        <td><input type='number' name='anio_origen1' min='1900' max='2024' step='1' onkeydown='return false'></td>
                    </tr>
                    <tr>
                        <td align='center' colspan='2'>
                            <input type='button' value='ADICIONAR GENERO' onClick='insertar_genero()' >
                        </td>
                    </tr>
                </table>
        </center>
    ";
  }
}
?>