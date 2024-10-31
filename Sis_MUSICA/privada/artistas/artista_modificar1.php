<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_genero = $_POST["id_genero"];
$id_artista = $_POST["id_artista"];
$nombreA = $_POST["nombreA"];
$nombre_artistico = $_POST["nombre_artistico"];
$pais = $_POST["pais"];
$fec_creacion = $_POST["fec_creacion"];

if(($id_genero!="") and  ($nombreA!="")){
   $reg = array();
   $reg["id_genero"] = $id_genero;
   $reg["nombreA"] = $nombreA;
   $reg["nombre_artistico"] = $nombre_artistico;
   $reg["pais"] = $pais;
   $reg["fec_creacion"] = $fec_creacion;  
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("artistas", $reg, "UPDATE", "id_artista='".$id_artista."'");
   header("Location: artistas.php");
   exit();
} else {
   require_once("../../libreria_menu.php");
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL ARTISTA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='artistas.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
echo "</body>
      </html> ";
?> 