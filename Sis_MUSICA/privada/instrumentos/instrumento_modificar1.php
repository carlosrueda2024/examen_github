<?php
session_start();
require_once("../../conexion.php");


//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_instrumento = $_POST["id_instrumento"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$descripcion = $_POST["descripcion"];
 

if(($nombre!="") and  ($tipo!="")){
   $reg = array();
   $reg["nombre"] = $nombre;
   $reg["tipo"] = $tipo;
   $reg["descripcion"] = $descripcion;
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("instrumentos", $reg, "UPDATE", "id_instrumento='".$id_instrumento."'");
   header("Location: instrumentos.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL INSTRUMENTO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='instrumentos.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }

echo "</body>
      </html> ";
?> 