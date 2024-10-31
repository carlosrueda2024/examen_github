<?php
ob_start();
session_start();
require_once("../../conexion.php");

echo "<html>
    <head>
    </head>
    <body>";

$sql = $db->Prepare("SELECT * FROM vista_valoraciones_canciones");
$rs = $db->GetAll($sql);

$sql1 = $db->Prepare("SELECT * FROM vista_sistema_musica");
$rs1 = $db->GetAll($sql1);

$nombre = $rs1[0]["nombre"];
$logotipo = $rs1[0]["logotipo"];
$fecha = date("Y-m-d H:i:s");

if ($rs) {

    echo "
    <table width='100%' border='0'>
        <tr>
            <td><img src='http://".$_SERVER['HTTP_HOST']."/PAGINA/Sis_Musica/privada/tienda_ropa/logos/{$logotipo}' width='70%'></td>
            <td align='center' width='80%'><h1>REPORTE DE VALORACIONES DE CANCIONES</h1></td>
        </tr>
    </table>";
    echo "
    <center>
    <table border='1' cellspacing='0' width='100%'>
        <tr>
            <th>Nro</th><th>CANCIONES</th><th>VALORACION</th><th>COMENTARIO</th><th>USUARIO</th>
        </tr>";
    $b = 1;
    foreach ($rs as $fila) {
        echo "<tr>
            <td align='center'>{$b}</td>
            <td>{$fila['cancion']}</td>
            <td>{$fila['valoracion']}</td>
            <td>{$fila['comentario']}</td>
            <td>{$fila['nom_usuario']}</td>
        </tr>";
        $b++;
    }
    echo "</table><br>
        <b>Fecha:</b> {$fecha}</center>";
}

echo "</body>
</html>";

$html = ob_get_clean();

require_once("../dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true)); 
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));
?>
