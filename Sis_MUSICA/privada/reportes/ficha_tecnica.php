<?php
session_start();
require_once("../../conexion.php");

$id_persona = $_GET['id_persona'];

$sql = $db->Prepare("SELECT *
                     FROM personas
                     WHERE id_persona = ?
                     AND estado <> 'X'
                    ");
$rs = $db->GetAll($sql, array($id_persona));

$sql1 = $db->Prepare("SELECT *
                      FROM sistema_musica
                      WHERE id_sistema_musica = 1
                      AND estado <> 'X'
                     ");
$rs1 = $db->GetAll($sql1);
$nombre = $rs1[0]["nombre"];
$logotipo = $rs1[0]["logotipo"];

echo "<html>
    <head>
        <script type='text/javascript'>
            var ventanaCalendario=false
            function imprimir() {
                if (confirm(' ¿Desea Imprimir?')){
                    window.print();
                }
            }
        </script>
    </head>
    <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

if ($rs) {
    $persona = $rs[0];
    echo "<table width='100%' border='0'>
            <tr>
                <td><img src='../tienda_ropa/logos/{$logotipo}' width='70%'></td>
                <td align='center' width='80%'><h1>FICHA TÉCNICA DE LA PERSONA</h1></td>
            </tr>
        </table>";
    echo "<center>
            <table border='1' cellspacing='0'>
                <tr>
                    <th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES</th><th>GÉNERO</th>
                </tr>
                <tr>
                    <td>{$persona['ci']}</td>
                    <td>{$persona['ap']}</td>
                    <td>{$persona['am']}</td>
                    <td>{$persona['nombres']}</td>
                    <td>" . ($persona['genero'] == 'F' ? 'FEMENINO' : 'MASCULINO') . "</td>
                </tr>
            </table>
        </center>";
} else {
    echo "<center><b>NO SE ENCONTRÓ LA PERSONA</b></center>";
}
echo "</body>
    </html>";
?>
