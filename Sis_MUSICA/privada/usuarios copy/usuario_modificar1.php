<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_persona = $_POST["id_persona"];
$id_usuario = $_POST["id_usuario"];
$usuario_principal = $_POST["usuario_principal"];
$clave = $_POST["clave"];
$hash=password_hash($clave, PASSWORD_DEFAULT);

if(($id_persona!="") and  ($usuario_principal!="") and ($clave!="")){
   $reg = array();
   $reg["id_persona"] = $id_persona;
   $reg["usuario_principal"] = $usuario_principal;
   $reg["clave"] = $hash;   
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("usuarios", $reg, "UPDATE", "id_usuario='".$id_usuario."'");
   header("Location: usuarios.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL USUARIO2";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='usuarios.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
echo "</body>
      </html> ";
?> 