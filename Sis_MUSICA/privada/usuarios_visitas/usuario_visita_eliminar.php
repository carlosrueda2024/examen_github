<?php
session_start();
require_once("../../conexion.php");

$__id_usuario_visita = $_REQUEST["id_usuario_visita"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_USUARIO_VISITA ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM lista_reproduccion
                     WHERE id_lista_reproduccion = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($__id_usuario_visita));
$sq2 = $db->Prepare("SELECT *
                     FROM valoraciones
                     WHERE id_valoracion = ?
                     AND estado <> 'X'
                   ");
$rs1 = $db->GetAll($sq2, array($__id_usuario_visita));


if ((!$rs) and (!$rs1)) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("usuarios_visitas", $reg, "UPDATE", "id_usuario_visita='".$__id_usuario_visita."'");
    header("Location:usuarios_visitas.php");
    exit();
    
} else {
    require_once("../../libreria_menu.php");
     echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DEL USUARIO PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='usuarios_visitas.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
}


echo"</body>
</html>";
?>
