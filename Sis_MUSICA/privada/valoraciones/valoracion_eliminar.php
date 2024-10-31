<?php
session_start();

require_once("../../conexion.php");


$__id_valoracion = $_REQUEST["id_valoracion"];

//$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_CANCION ESTA COMO HERENCIA*/

$sql1 = $db->Prepare("SELECT *
                     FROM valoraciones
                     WHERE id_valoracion = ?
                   ");
$rs1 = $db->GetAll($sql1, array($__id_valoracion));



if (!$r1) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("valoraciones", $reg, "UPDATE", "id_valoracion='".$__id_valoracion."'");
    header("Location:valoraciones.php");
    exit();
    
} else {
    require_once("../../libreria_menu.php");
    echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DE VALORACION PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='valoraciones.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
}

echo"</body>
</html>";
?>
