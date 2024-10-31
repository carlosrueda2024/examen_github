<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_usuario_visita = $_POST["id_usuario_visita"];
$id_cancion = $_POST["id_cancion"];
$valoracion = $_POST["valoracion"];
$comentario = $_POST["comentario"];

if(($id_cancion!="") and ($id_usuario_visita!="")){
   $reg = array();
   $reg["id_usuario_visita"] = $id_usuario_visita;
   $reg["id_cancion"] = $id_cancion;
   $reg["valoracion"] = $valoracion;
   $reg["comentario"] = $comentario;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("valoraciones", $reg, "INSERT"); 
   header("Location: valoraciones.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA VALORACION";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='valoracion_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }

echo "</body>
      </html> ";
?> 