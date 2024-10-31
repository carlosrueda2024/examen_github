<?php
session_start();

require_once("../../conexion.php");


$__id_artista = $_REQUEST["id_artista"];

//$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_ARTISTA ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM albunes
                     WHERE id_albun = ?
                     AND estado <> 'X'
                   ");
$rs = $db->GetAll($sql, array($__id_artista));

$sql1 = $db->Prepare("SELECT *
                     FROM instrumentos_artistas
                     WHERE id_instrumento_artista = ?
                     AND estado <> 'X'
                   ");
$rs1 = $db->GetAll($sql1, array($__id_artista));

if ((!$rs) and (!$rs1)) {
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("artistas", $reg, "UPDATE", "id_artista='".$__id_artista."'");
    header("Location:artistas.php");
    exit();
    
} else {
    require_once("../../libreria_menu.php");
    echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DEL ARTISTA POR QUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='artistas.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
}

echo"</body>
</html>";
?>
