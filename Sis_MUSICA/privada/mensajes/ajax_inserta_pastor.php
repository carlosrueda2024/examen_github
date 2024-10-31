<?php
session_start();

require_once("../../conexion.php");

$especialidad1 = $_POST["especialidad1"];
$sueldo1 = $_POST["sueldo1"];
$fec_inicio_pa1 = $_POST["fec_inicio_pa1"];
$fec_fin_pa1 = $_POST["fec_fin_pa1"];
$cargo1 = $_POST["cargo1"];


$reg = array();
$reg["id_sistema_musica"] = 1;
$reg["especialidad"] = $especialidad1;
$reg["sueldo"] = $sueldo1;
$reg["fec_inicio_pa"] = $fec_inicio_pa1;
$reg["fec_fin_pa"] = $fec_fin_pa1;
$reg["cargo"] = $cargo1;
$reg["fec_insercion"] = date("Y-m-d H:i:s");
$reg["estado"] = 'A';
$reg["usuario"] = $_SESSION["sesion_id_usuario"];
$rs1 = $db->AutoExecute("pastores", $reg, "INSERT");
?>
