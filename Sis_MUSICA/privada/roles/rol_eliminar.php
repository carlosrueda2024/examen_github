<?php
session_start();
require_once("../../conexion.php");

$__id_proveedor = $_REQUEST["id_proveedor"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PROVEEDOR ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM productos
                     WHERE id_proveedor = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($__id_proveedor));


if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("proveedores", $reg, "UPDATE", "id_proveedor='".$__id_proveedor."'");
    header("Location:proveedores.php");
    exit();
    
} else {
    require_once("../../libreria_menu.php");
     echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DEL PROVEEDOR PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='proveedores.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
}


echo"</body>
</html>";
?>
