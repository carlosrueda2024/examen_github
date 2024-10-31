<?php
session_start();
require_once("../../conexion.php");

$__id_instrumento = $_REQUEST["id_instrumento"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_INSTRUMENTO ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM instrumentos_artistas
                     WHERE id_instrumento_artista = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($__id_instrumento));


if (!$rs) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("instrumentos", $reg, "UPDATE", "id_instrumento='".$__id_instrumento."'");
    header("Location:instrumentos.php");
    exit();
    
} else {
    require_once("../../libreria_menu.php");
     echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DEL INSTRUMENTO PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='instrumentos.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
}


echo"</body>
</html>";
?>
