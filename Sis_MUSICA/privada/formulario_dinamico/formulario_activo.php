<?php
require_once("../../conexion.php");

$id_categoria = isset($_GET['id_categoria']) ? (int)$_GET['id_categoria'] : 0;

if ($id_categoria == 0) {
    echo "Seleccione una categoría válida.";
    exit;
}

// Formulario para los campos de activos_fijos
echo "
      <form action='guardar_activo.php' method='post' enctype='multipart/form-data'>
          <fieldset>
              <legend>(*) Datos Activo Fijo</legend> 
              
              <input type='hidden' name='id_categoria' value='$id_categoria'>
              <label for='descripcion'>Descripción:</label>
              <input type='text' name='descripcion' required><br>

              <label for='fecha_adquisicion'>Fecha de Adquisición:</label>
              <input type='date' name='fecha_adquisicion' required><br>

              <label for='fecha_activacion'>Fecha de Activación:</label>
              <input type='date' name='fecha_activacion'><br>

              <label for='fotografia'>Fotografía:</label>
              <input type='file' name='fotografia'><br>

              <label for='nro_documento'>Número de Documento:</label>
              <input type='text' name='nro_documento'><br>

              <label for='valor'>Valor:</label>
              <input type='number' step='0.01' name='valor' required><br>

              <label for='valor_residual'>Valor Residual:</label>
              <input type='number' step='0.01' name='valor_residual'><br>

              <label for='responsable'>Responsable:</label>
              <input type='text' name='responsable'><br>";

// Mostrar el campo depreciación si el id_categoria está entre 4 y 15
if ($id_categoria >= 4 && $id_categoria <= 15) {
    echo "<label for='depreciacion'>Depreciación:</label>
          <input type='text' name='depreciacion'><br>";
}

// Mostrar el campo marca_del_activo si el id_categoria está entre 9 y 15
if ($id_categoria >= 9 && $id_categoria <= 15) {
    echo "<label for='marca_del_activo'>Marca del Activo:</label>
          <input type='text' name='marca_del_activo'><br>";
}

// Mostrar el campo nro_serie_placa solo si el id_categoria es igual a 14
if ($id_categoria == 14) {
    echo "<label for='nro_serie_placa'>Número de Serie/Placa:</label>
          <input type='text' name='nro_serie_placa'><br>";
}

echo "      <input type='submit' value='ADICIONAR ACTIVO'>
              <input type='reset' value='BORRAR'>
          </fieldset> <!-- Cierra el fieldset -->
      </form>";
?>
