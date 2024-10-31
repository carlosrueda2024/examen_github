<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo "<html>
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        </head>
        <body>";

$ap = $_POST["ap"];
$am = $_POST["am"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$genero = isset($_POST["genero"]) ? $_POST["genero"] : '';

if(($nombres != "") && ($ci != "") && ($direccion != "") && ($telefono != "")){
    $reg = array();
    $reg["id_sistema_musica"] = 1;
    $reg["ap"] = $ap;
    $reg["am"] = $am;
    $reg["nombres"] = $nombres;
    $reg["ci"] = $ci;
    $reg["direccion"] = $direccion;
    $reg["telefono"] = $telefono;
    $reg["genero"] = $genero;
    $reg["fec_insercion"] = date("Y-m-d H:i:s");
    $reg["estado"] = 'A';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("personas", $reg, "INSERT");
    header("Location: personas.php");
    exit();
} else {
    echo "<div class='mensaje'>";
    $mensaje = "NO SE INSERTARON LOS DATOS DE LA PERSONA";
    echo "<h1>".$mensaje."</h1>";
    echo "<a href='persona_nuevo.php'>
              <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
          </a>";
    echo "</div>";
}

echo "</body>
      </html>";
?>
