<?php
session_start();
require_once("../../conexion.php"); 

//$db->debug=true;

echo "<html>
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$id_pastor = $_POST["id_pastor"];
$nombre_mensaje = $_POST["nombre_mensaje"];
$nombre_evento = $_POST["nombre_evento"];
$fecha = $_POST["fecha"];


if (($id_pastor != "" && $nombre_mensaje != "" && $nombre_evento != "" && $fecha != "")) {
   $reg = array();
   $reg["id_pastor"] = $id_pastor;
   $reg["nombre_mensaje"] = $nombre_mensaje;
   $reg["nombre_evento"] = $nombre_evento;
   $reg["fecha"] = $fecha;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"]; 
   $rs1 = $db->AutoExecute("mensajes", $reg, "INSERT");
   header("Location: mensajes.php");
   exit();
} else {
   echo "<div class='mensaje'>";
   $mensaje = "NO SE INSERTARON LOS DATOS DEL MENSAJE";
   echo "<h1>" . $mensaje . "</h1>";
   echo "<a href='mensaje_nuevo.php'>
            <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height:25px;' value='VOLVER>>>>'>
         </a>";
   echo "</div>";
}

echo "</body>
      </html>";
?>
