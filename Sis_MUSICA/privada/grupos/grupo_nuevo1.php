<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$grupo = $_POST["grupo"];
//$genero1 = isset($_POST["genero"]); 

if(($grupo!="")){
   $reg = array();
   //$reg["id_tienda"] = 1;
   $reg["grupo"] = $grupo;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("grupos", $reg, "INSERT"); 
   header("Location: grupos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL GRUPO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='grupo_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 