<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id = $_POST["id"];
$nombre = $_POST["nombre"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];

if(($id!="" and $nombre!="" and $cantidad!="" )){
   $reg = array();
   $reg["heladeria_pasteleria_id"] = $id;
   $reg["nombre"] = $nombre;
   $reg["cantidad"] = $cantidad;
   $reg["precio"] = $precio;
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("tortas", $reg, "INSERT"); 
   header("Location: tortas.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA TORTA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='torta_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 