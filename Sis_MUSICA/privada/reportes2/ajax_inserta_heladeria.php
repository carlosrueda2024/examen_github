<?php
session_start();

require_once("../../conexion.php");

$nombre_heladeria_pasteleria1 = $_POST["nombre_heladeria_pasteleria1"];
$direccion1 = $_POST["direccion1"];
$telefono1 = $_POST["telefono1"];


$reg = array();
$reg["id_sistema_musica"] = 1;
$reg["nombre_heladeria_pasteleria"] = $nombre_heladeria_pasteleria1;
$reg["direccion"] = $direccion1;
$reg["telefono"] = $telefono1;
$reg["usuario"] = $_SESSION["sesion_id_usuario"];
$rs1 = $db->AutoExecute("heladeria_pasteleria", $reg, "INSERT");
?>
