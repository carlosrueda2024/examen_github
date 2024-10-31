<?php
require_once("../../conexion.php");

$id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : 0;

// Consulta para obtener los activos fijos
$sql_activos = $db->Prepare("SELECT id_activo_fijo, descripcion FROM activos_fijos WHERE id_categoria = ? AND estado = 'A'");
$rs_activos = $db->GetAll($sql_activos, array($id_categoria));

// Generar las opciones del select de activos fijos
echo "<option value=''>--Seleccione Activo Fijo--</option>";
foreach ($rs_activos as $activo) {
    echo "<option value='".$activo['id_activo_fijo']."'>".$activo['descripcion']."</option>";
}
?>
