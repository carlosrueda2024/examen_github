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
$nom_usuario = $_POST["nom_usuario"];
 

if(($nom_usuario!="")){
   $reg = array();
   $reg["id_sistema_musica"] = 1;
   $reg["nom_usuario"] = $nom_usuario;
   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("usuarios_visitas", $reg, "UPDATE", "id_usuario_visita='".$id_usuario_visita."'");
   header("Location: usuarios_visitas.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL USUARIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='usuarios_visitas.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }

echo "</body>
      </html> ";
?> 