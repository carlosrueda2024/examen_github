<?php
session_start();

require_once("../../conexion.php");


$__id_lista_reproduccion = $_REQUEST["id_lista_reproduccion"];

$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_LISTA_REPRODUCCION ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM detalles_reproduccion
                     WHERE id_detalle_reproduccion = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($__id_lista_reproduccion));

if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("lista_reproduccion", $reg, "UPDATE", "id_lista_reproduccion='".$__id_lista_reproduccion."'");
    header("Location:lista_reproduccion.php");
    exit();
    
} else {
    require_once("../../libreria_menu.php");
    echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DE LA LISTA PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='lista_reproduccion.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
}

echo"</body>
</html>";
?>
