<?php
session_start();
require_once("../../conexion.php");

//$db->debug = true;

echo "<html> 
<head>
    <script type='text/javascript'>
        var ventanaCalendario = false;
        function imprimir() {
            if (confirm('¿Desea Imprimir?')) {
                window.print();
            }
        }
    </script>
</head>
<body style='cursor:pointer;' onClick='imprimir();'>
";

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
            <td><img src='../tienda_ropa/logos/{$logotipo}' width='70%'></td>
            <td align='center' width='80%'><h1>REPORTE DE VALORACIONES DE CANCIONES</h1></td>
        </tr>
    </table>";
    echo"
    <center>
    <table border='1' cellspacing='0'>
        <tr>                                   
            <th>Nro</th><th>CANCIONES</th><th>VALORACION</th><th>COMENTARIO</th><th>USUARIO</th>
        </tr>
    ";
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
?>
