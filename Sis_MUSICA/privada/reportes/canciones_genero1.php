<?php
session_start();
require_once("../../conexion.php");

//$db->debug = true;

$genero = $_REQUEST["genero"];
$fecha = date("Y-m-d H:i:s");

if ($genero == "T") {
    $sql = $db->Prepare("SELECT c.nombre as cancion, g.nombre as genero, a.nombre as album, c.duracion, c.anio_lanza
                         FROM canciones c
                         INNER JOIN generos g ON c.id_genero = g.id_genero
                         INNER JOIN albunes a ON c.id_albun = a.id_albun
                         WHERE c.estado <> 'X'
                         AND g.estado <> 'X'
                         AND a.estado <> 'X'
                        ");
    $rs = $db->GetAll($sql);
} else {
    $sql = $db->Prepare("SELECT c.nombre as cancion, g.nombre as genero, a.nombre as album, c.duracion, c.anio_lanza
                         FROM canciones c
                         INNER JOIN generos g ON c.id_genero = g.id_genero
                         INNER JOIN albunes a ON c.id_albun = a.id_albun
                         WHERE c.id_genero = ?
                         AND c.estado <> 'X'
                         AND g.estado <> 'X'
                         AND a.estado <> 'X'
                        ");
    $rs = $db->GetAll($sql, array($genero));
}

$sql_sistema_musica = $db->Prepare("SELECT *
                                    FROM sistema_musica
                                    WHERE id_sistema_musica = 1
                                    AND estado <> 'X'
                                   ");
$rs_sistema_musica = $db->GetAll($sql_sistema_musica);
$nombre_sistema = $rs_sistema_musica[0]["nombre"];
$logotipo_sistema = $rs_sistema_musica[0]["logotipo"];

echo "<html>
    <head>
        <script type='text/javascript'>
            var ventanaCalendario=false
            function imprimir() {
                if (confirm('¿Desea imprimir?')) {
                    window.print();
                }
            }
        </script>
    </head>
    <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

if ($rs) {
    echo "<table width='100%' border='0'>
            <tr>
                <td><img src='../tienda_ropa/logos/{$logotipo_sistema}' width='70%'></td>
                <td align='center' width='80%'><h1>REPORTES DE CANCIONES POR GÉNERO MUSICAL</h1></td>
            </tr>
        </table>";
    echo "
        <center>
            <table border='1' cellspacing='0'>
                <tr>
                    <th>Nro</th><th>CANCION</th><th>GÉNERO</th><th>ÁLBUM</th><th>DURACIÓN</th><th>AÑO LANZAMIENTO</th>
                </tr>";
    $b = 1;
    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['cancion']."</td>
                <td>".$fila['genero']."</td>
                <td>".$fila['album']."</td>
                <td>".$fila['duracion']."</td>
                <td>".$fila['anio_lanza']."</td>
              </tr>";
        $b++;
    }
    echo "</table><br>
            <b>Fecha :</b>".$fecha."</b></center>";
}
echo "</body>
    </html>";
?>
