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
$id_valoracion = $_POST["id_valoracion"];
$id_cancion = $_POST["id_cancion"];
$valoracion = $_POST["valoracion"];
$comentario = $_POST["comentario"];

if(($id_usuario_visita!="") and  ($id_cancion!="") and ($id_valoracion!="")){
   $reg = array();
   $reg["id_usuario_visita"] = $id_usuario_visita;
   $reg["id_cancion"] = $id_cancion;
   $reg["valoracion"] = $valoracion;
   $reg["comentario"] = $comentario; 
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("valoraciones", $reg, "UPDATE", "id_valoracion='".$id_valoracion."'");
   header("Location: valoraciones.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE VALORACION";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='valoraciones.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
echo "</body>
      </html> ";
?> 