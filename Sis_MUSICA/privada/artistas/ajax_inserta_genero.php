<?php
session_start();

require_once("../../conexion.php");

$anio_origen1 = $_POST["anio_origen1"];
$nombre1 = $_POST["nombre1"];


$reg = array();
$reg["id_sistema_musica"] = 1;
$reg["anio_origen"] = $anio_origen1;
$reg["nombre"] = $nombre1;
$reg["fec_insersion"] = date("Y-m-d H:i:s");
$reg["estado"] = 'A';
$reg["usuario"] = $_SESSION["sesion_id_usuario"];
$rs1 = $db->AutoExecute("generos", $reg, "INSERT");
?>
