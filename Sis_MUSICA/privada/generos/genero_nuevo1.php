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
$anio_origen = $_POST["anio_origen"];

if(($nombre!="")){
   $reg = array();
   $reg["nombre"] = $nombre;
   $reg["anio_origen"] = $anio_origen;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("generos", $reg, "INSERT"); 
   header("Location: generos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL GENERO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='genero_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 