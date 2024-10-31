<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

// Recibir los datos del formulario
$nombre_heladeria_pasteleria = $_POST["nombre_heladeria_pasteleria"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];

// Establecer conexión y consultar a la base de datos si hay datos proporcionados
if ($nombre_heladeria_pasteleria || $direccion || $telefono) {
    $sql3 = $db->Prepare("SELECT *
                          FROM heladeria_pasteleria
                          WHERE nombre_heladeria_pasteleria LIKE ?
                          AND direccion LIKE ?
                          AND telefono LIKE ?
                         ");
    
    $rs3 = $db->GetAll($sql3, array($nombre_heladeria_pasteleria."%", $direccion."%", $telefono."%"));
    
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
                  <th>NOMBRE</th><th>DIRECCION</th><th>TELEFONO</th><th>Seleccionar</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {
            $str = $fila["nombre_heladeria_pasteleria"];
            $str1 = $fila["direccion"];
            $str2 = $fila["telefono"];
            echo "<tr>
                    <td align='center'>".resaltar($nombre_heladeria_pasteleria, $str)."</td>
                    <td>".resaltar($direccion, $str1)."</td>
                    <td>".resaltar($telefono, $str2)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_heladeria(".$fila["id"].")'>
                    </td>
                  </tr>";
        }
        echo "</table>
        </center>";
    } else {
        // Mostrar formulario de adición de persona si no hay resultados
        echo "<center><b> LA HELADERIA NO EXISTE!!</b></center><br>";
        echo "<form name='formu' class='form-container'>
                <fieldset>
                    <legend>Agregar Heladeria</legend>

                    <!-- Grupo de formulario para almacenar datos del usuario -->
                    <div class='form-group'>
                        <input type='text' name='nombre_heladeria_pasteleria1' placeholder='(*) Nombre' id='nombre_heladeria_pasteleria1' size='10'>
                    </div>
                    <div class='form-group'>
                        <input type='text' name='direccion1' id='direccion1' placeholder='(*) Direccion' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </div>
                    <div class='form-group'>
                        <input type='text' name='telefono1' id='telefono1'placeholder='Telefono' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </div>
                    <div class='full-width'>
                    <h4>(*)datos obligatorios</h4>
                    <input type='button' value='ADICIONAR HELADERIA' onclick='insertar_heladeria();'>
                </div>
                </fieldset>
              </form>";
    }
    echo "</body></html>";
}
?>
