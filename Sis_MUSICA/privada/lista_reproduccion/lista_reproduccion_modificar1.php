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
$id_lista_reproduccion = $_POST["id_lista_reproduccion"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$fec_creacion = $_POST["fec_creacion"];

if(($id_usuario_visita!="") and  ($nombre!="") and ($fec_creacion!="")){
   $reg = array();
   $reg["id_usuario_visita"] = $id_usuario_visita;
   $reg["nombre"] = $nombre;
   $reg["descripcion"] = $descripcion;
   $reg["fec_creacion"] = $fec_creacion;  
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("lista_reproduccion", $reg, "UPDATE", "id_lista_reproduccion='".$id_lista_reproduccion."'");
   header("Location: lista_reproduccion.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA LISTA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='lista_reproduccion.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
echo "</body>
      </html> ";
?> 