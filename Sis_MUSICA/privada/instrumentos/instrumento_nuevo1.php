<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$descripcion = $_POST["descripcion"];

if(($nombre!="") and  ($tipo!="")){
   $reg = array();
   $reg["nombre"] = $nombre;
   $reg["tipo"] = $tipo;
   $reg["descripcion"] = $descripcion;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("instrumentos", $reg, "INSERT"); 
   header("Location: instrumentos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL INSTRUMENTOS";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='instrumetno_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 