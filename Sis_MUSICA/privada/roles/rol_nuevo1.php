<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$nombre = $_POST["nombre"];
$telef = $_POST["telef"];
$direccion = $_POST["direccion"];
$correo = $_POST["correo"];
//$genero1 = isset($_POST["genero"]); 

if(($nombre!="") and ($telef!="") and ($direccion!="") and ($correo!="")){
   $reg = array();
   $reg["id_tienda"] = 1;
   $reg["nombre"] = $nombre;
   $reg["telef"] = $telef;
   $reg["direccion"] = $direccion;
   $reg["correo"] = $correo;
   //$reg["genero"] = $_POST["genero"];
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("proveedores", $reg, "INSERT"); 
   header("Location: proveedores.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL PROVEEDOR";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='proveedor_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 