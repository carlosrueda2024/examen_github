<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$especialidad = $_POST["especialidad"];
$sueldo = $_POST["sueldo"];
$cargo = $_POST["cargo"];
if ($especialidad || $sueldo || $cargo) {
    $sql3 = $db->Prepare("SELECT *
                          FROM pastores
                          WHERE especialidad LIKE ?
                          AND sueldo LIKE ?
                          AND cargo LIKE ?
                          AND estado <> 'X'
                         ");
    
    $rs3 = $db->GetAll($sql3, array($especialidad."%", $sueldo."%", $cargo."%"));
    
    echo "<html>
            <head>
                <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
                <link rel='stylesheet' href='../../css/estilo_buscador.css' type='text/css'>
                <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>

                <script src='../js/expresiones_regulares.js'></script>
                <script src='../js/validacion_formulario.js'></script>
            </head>
            <body>
            <h4>Resultado de la búsqueda</h4>";

    if ($rs3) {
        echo "<center>
              <table class='form-container' width='60%' border='1'>
                <tr>
                  <th>ESPECIALIDAD</th><th>SUELDO</th><th>CARGO</th><th>Seleccionar</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {
            $str = $fila["especialidad"];
            $str1 = $fila["sueldo"];
            $str2 = $fila["cargo"];
            echo "<tr>
                    <td align='center'>".resaltar($especialidad, $str)."</td>
                    <td>".resaltar($sueldo, $str1)."</td>
                    <td>".resaltar($cargo, $str2)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_pastor(".$fila["id_pastor"].")'>
                    </td>
                  </tr>";
        }
        echo "</table>
        </center>";
    } else {
        echo "<center><b> EL PASTOR NO EXISTE!!</b></center><br>";
        echo "<form name='formu' class='form-container'>
                <fieldset>
                    <legend>Agregar Pastor</legend>

                    <!-- Grupo de formulario para almacenar datos del pastor -->
                    <div class='form-group'>
                        <label for='especialidad1'>Especialidad:</label>
                        <input type='text' name='especialidad1' id='especialidad1' placeholder='(*) Especialidad' size='10'>
                    </div>
                    <div class='form-group'>
                        <label for='sueldo1'>Sueldo:</label>
                        <input type='text' name='sueldo1' id='sueldo1' placeholder='(*) Sueldo' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </div>
                    <div class='form-group'>
                        <label for='fec_inicio_pa1'>Fecha Inicio:</label>
                        <input type='date' name='fec_inicio_pa1' id='fec_inicio_pa1' placeholder='Fecha inicio' size='10'>
                    </div>
                    <div class='form-group'>
                        <label for='fec_fin_pa1'>Fecha Fin:</label>
                        <input type='date' name='fec_fin_pa1' id='fec_fin_pa1' placeholder='Fecha fin' size='10'>
                    </div>
                    <div class='form-group'>
                        <label for='cargo1'>Cargo:</label>
                        <input type='text' name='cargo1' id='cargo1' placeholder='(*) Cargo' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </div>
                    <div class='full-width'>
                        <h4>(*) Datos obligatorios</h4>
                        <input type='button' value='ADICIONAR PASTOR' onclick='insertar_pastor();'>
                    </div>
                </fieldset>

              </form>";
    }
    echo "</body></html>";
}
?>
