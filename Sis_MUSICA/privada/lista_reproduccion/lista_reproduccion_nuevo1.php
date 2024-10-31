<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_usuario_visita = $_POST["id_usuario_visita"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$fec_creacion = $_POST["fec_creacion"];

if(($id_usuario_visita!="") and  ($nombre!="")){
   $reg = array();
   $reg["id_usuario_visita"] = $id_usuario_visita;
   $reg["nombre"] = $nombre;
   $reg["descripcion"] = $descripcion;
   $reg["fec_creacion"] = $fec_creacion;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("lista_reproduccion", $reg, "INSERT"); 
   header("Location: lista_reproduccion.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA LISTA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='lista_reproduccion_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 