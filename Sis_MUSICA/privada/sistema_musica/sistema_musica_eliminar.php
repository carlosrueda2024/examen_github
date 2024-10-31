<?php
session_start();
require_once("../../conexion.php");

$__id_genero = $_REQUEST["id_genero"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
//$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_GENERO ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM canciones
                     WHERE id_canciones = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($__id_genero));

$sql1 = $db->Prepare("SELECT *
                     FROM artistas
                     WHERE id_artista = ?
                     AND estado <> 'X'
                   ");
$rs1 = $db->GetAll($sql1, array($__id_genero));


if ((!$rs) and (!$rs1 )) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("generos", $reg, "UPDATE", "id_genero='".$__id_genero."'");
    header("Location:generos.php");
    exit();
    
} else {
    require_once("../../libreria_menu.php");
     echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DEL GENERO PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='generos.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
}


echo"</body>
</html>";
?>
