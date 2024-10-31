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
$id_opcion = $_POST["id_opcion"];
$opcion = $_POST["opcion"];
$contenido = $_POST["contenido"];
$orden = $_POST["orden"];


if(($id_grupo!="") and  ($id_opcion!="") and ($opcion!="") and ($contenido!="") and ($orden!="")){
   $reg = array();
   $reg["id_grupo"] = $id_grupo;
   $reg["opcion"] = $opcion;
   $reg["contenido"] = $contenido;
   $reg["orden"] = $orden;  
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("opciones", $reg, "UPDATE", "id_opcion='".$id_opcion."'");
   header("Location: opciones.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA OPCION";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='opciones.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
echo "</body>
      </html> ";
?> 