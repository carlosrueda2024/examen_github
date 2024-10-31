<?php
session_start();
require_once("../../conexion.php");


$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_grupo = $_POST["id_grupo"];
$grupo = $_POST["grupo"];
 

if(($grupo!="")){
   $reg = array();
   //$reg["id_tienda"] = 1;
   $reg["grupo"] = $grupo;
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("grupos", $reg, "UPDATE", "id_grupo='".$id_grupo."'");
   header("Location: grupos.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL GRUPO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='grupo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }

echo "</body>
      </html> ";
?> 