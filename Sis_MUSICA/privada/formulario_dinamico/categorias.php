<?php
require_once("../../conexion.php");

$id_rubro = isset($_GET['id_rubro']) ? $_GET['id_rubro'] : 0;

// Consulta para obtener las categorías
$sql_categorias = $db->Prepare("SELECT id_categoria, categoria_rubro FROM categorias WHERE id_rubro = ? AND estado = 'A'");
$rs_categorias = $db->GetAll($sql_categorias, array($id_rubro));

// Generar las opciones del select de categorías
echo "<option value=''>--Seleccione Categoría--</option>";
foreach ($rs_categorias as $categoria) {
    echo "<option value='".$categoria['id_categoria']."'>".$categoria['categoria_rubro']."</option>";
}
?>
