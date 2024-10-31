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
$opcion = $_POST["opcion"];
$contenido = $_POST["contenido"];
$orden = $_POST["orden"];

if(($id_grupo!="") and  ($opcion!="") and ($contenido!="") and ($orden!="")){
   $reg = array();
   $reg["id_grupo"] = $id_grupo;
   $reg["opcion"] = $opcion;
   $reg["contenido"] = $contenido;
   $reg["orden"] = $orden;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("opciones", $reg, "INSERT"); 
   header("Location: opciones.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA OPCION";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='opcion_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }

echo "</body>
      </html> ";
?> 