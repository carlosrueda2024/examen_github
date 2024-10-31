<?php
session_start();
require_once("../../conexion.php");

$id = $_GET['id'];
$fecha=date("Y-m-d H:i:s");

$sql = $db->Prepare("SELECT s.*, g.nombre AS limpieza
                     FROM sucursales s
                     JOIN compania_limpieza g ON s.compania_limpieza_id = g.id
                     WHERE s.id = ?
                    ");
$rs = $db->GetAll($sql, array($id));

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
                <td align='center' width='80%'><h1>FICHA TÉCNICA DE SUCURSALES CON COMPANIA</h1></td>
            </tr>
        </table>";
    echo "<center>";
    foreach ($rs as $k => $fila) {
        echo "<table border='1' cellspacing='0'>
                <tr>
                    <th align='right'>Departamento</th><th>:</th>
                    <td><input type='text' name='dpto' value='".$fila['dpto']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Telefono</th><th>:</th>
                    <td><input type='text' name='telefono' value='".$fila['telefono']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Direccion</th><th>:</th>
                    <td><input type='text' name='dir_suc' value='".$fila['dir_suc']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Compania Limpieza</th><th>:</th>
                    <td><input type='text' name='limpieza' value='".$fila['limpieza']."' disabled></td>
                </tr>
        </table><br>
        <b>Fecha :</b>".$fecha."</b></center>";
    }
    echo "</center>";
}
echo "</body>
</html>";
?>
