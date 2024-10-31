<?php
session_start();
require_once("../../conexion.php");


$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_proveedor = $_POST["id_proveedor"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telef = $_POST["telef"];
$correo = $_POST["correo"];

if(($nombre!="") and  ($direccion!="")){
   $reg = array();
   $reg["id_tienda"] = 1;
   $reg["nombre"] = $nombre;
   $reg["direccion"] = $direccion;
   $reg["telef"] = $telef;
   $reg["correo"] = $correo;
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("proveedores", $reg, "UPDATE", "id_proveedor='".$id_proveedor."'");
   header("Location: proveedores.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL PROVEEDOR";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='proveedores.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }

echo "</body>
      </html> ";
?> 