<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

// Recibir los datos del formulario
$ap = $_POST["ap"];
$am = $_POST["am"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];

// Establecer conexión y consultar a la base de datos si hay datos proporcionados
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
    
    // Incluir archivos CSS y scripts
    echo "<html>
            <head>
                <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
                <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
                <script src='../js/expresiones_regulares.js'></script>
                <script src='../js/validacion_formulario.js'></script>
            </head>
            <body>
            <h4>Resultado de la búsqueda</h4>";

    if ($rs3) {
        // Generar la tabla con resultados
        echo "<center>
              <table class='form-container' width='60%' border='1'>
                <tr>
                  <th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES</th><th>Seleccionar</th>
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
                      <input type='radio' name='opcion' value='' onClick='buscar_persona(".$fila["id_persona"].")'>
                    </td>
                  </tr>";
        }
        echo "</table>
        </center>";
    } else {
        // Mostrar formulario de adición de persona si no hay resultados
        echo "<center><b> LA PERSONA NO EXISTE!!</b></center><br>";
        echo "<form name='formu' class='form-container'>
                <div class='form-group'>
                    <label for='ci1'>(*)CI</label>
                    <input type='text' name='ci1' id='ci1' size='10'>
                </div>
                <div class='form-group'>
                    <label for='ap1'>Paterno</label>
                    <input type='text' name='ap1' id='ap1' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                </div>
                <div class='form-group'>
                    <label for='am1'>Materno</label>
                    <input type='text' name='am1' id='am1' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                </div>
                <div class='form-group'>
                    <label for='nombres1'>(*)Nombres</label>
                    <input type='text' name='nombres1' id='nombres1' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                </div>
                <div class='form-group'>
                    <label for='direccion1'>(*)Dirección</label>
                    <input type='text' name='direccion1' id='direccion1' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                </div>
                <div class='form-group'>
                    <label for='telefono1'>(*)Teléfono</label>
                    <input type='text' name='telefono1' id='telefono1' size='10'>
                </div>
                <div class='full-width'>
                    <h4>(*)datos obligatorios</h4>
                    <input type='button' value='ADICIONAR PERSONA' onclick='insertar_persona();'>
                </div>
              </form>";
    }
    echo "</body></html>";
}
?>
