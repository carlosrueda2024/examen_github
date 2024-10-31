<?php
session_start();
require_once("../../conexion.php");

$id_artista = $_GET['id_artista'];
$fecha=date("Y-m-d H:i:s");

$sql = $db->Prepare("SELECT a.*, g.nombre AS genero
                     FROM artistas a
                     JOIN generos g ON a.id_genero = g.id_genero
                     WHERE a.id_artista = ?
                     AND a.estado <> 'X'
                    ");
$rs = $db->GetAll($sql, array($id_artista));

$sql1 = $db->Prepare("SELECT *
                      FROM sistema_musica
                      WHERE id_sistema_musica = 1
                      AND estado <> 'X'
                     ");
$rs1 = $db->GetAll($sql1);
$logotipo = $rs1[0]["logotipo"];

echo "<html>
    <head>
        <script type='text/javascript'>
            function imprimir() {
                if (confirm('¿Desea Imprimir?')) {
                    window.print();
                }
            }
        </script>
    </head>
    <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

if ($rs) {
    echo "<table width='100%' border='0'>
            <tr>
                <td><img src='../tienda_ropa/logos/{$logotipo}' width='70%'></td>
                <td align='center' width='80%'><h1>FICHA TÉCNICA DE ARTISTAS CON GENERO</h1></td>
            </tr>
        </table>";
    echo "<center>";
    foreach ($rs as $k => $fila) {
        echo "<table border='1' cellspacing='0'>
                <tr>
                    <th align='right'>Nombre</th><th>:</th>
                    <td><input type='text' name='nombreA' value='".$fila['nombreA']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Nombre Artístico</th><th>:</th>
                    <td><input type='text' name='nombre_artistico' value='".$fila['nombre_artistico']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>País</th><th>:</th>
                    <td><input type='text' name='pais' value='".$fila['pais']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Fecha de Creación</th><th>:</th>
                    <td><input type='text' name='fec_creacion' value='".$fila['fec_creacion']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Género</th><th>:</th>
                    <td><input type='text' name='genero' value='".$fila['genero']."' disabled></td>
                </tr>
        </table><br>
        <b>Fecha :</b>".$fecha."</b></center>";
    }
    echo "</center>";
}
echo "</body>
</html>";
?>
