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
                <td align='center' width='80%'><h1>FICHA TÉCNICA DE PERSONA</h1></td>
            </tr>
        </table>";
    echo "<center>";
    foreach ($rs as $k => $fila) {
        echo "<table border='1' cellspacing='0'>
                <tr>
                    <th align='right'>CI</th><th>:</th>
                    <td><input type='text' name='ci' value='".$fila['ci']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Nombres</th><th>:</th>
                    <td><input type='text' name='nombres' value='".$fila['nombres']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Apellido Paterno</th><th>:</th>
                    <td><input type='text' name='ap' value='".$fila['ap']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Apellido Materno</th><th>:</th>
                    <td><input type='text' name='am' value='".$fila['am']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Dirección</th><th>:</th>
                    <td><input type='text' name='direccion' value='".$fila['direccion']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Teléfono</th><th>:</th>
                    <td><input type='text' name='telefono' value='".$fila['telefono']."' disabled></td>
                </tr>
                <tr>
                    <th align='right'>Género</th><th>:</th>
                    <td>";
                    if ($fila['genero'] == 'F') {
                        echo "<input type='text' value='FEMENINO' disabled>";
                    } else {
                        echo "<input type='text' value='MASCULINO' disabled>";
                    }
        echo "</td>
            </tr>
        </table>";
    }
    echo "</center>";
}
echo "</body>
</html>";
?>
