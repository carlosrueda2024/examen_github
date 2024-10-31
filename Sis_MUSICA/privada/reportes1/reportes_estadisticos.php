<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

$db->debug = true;

echo "<html>
    <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <script type='text/javascript' src='../../ajax.js'></script>
        <script src='../js/expresiones_regulares.js'></script>
        <script src='js/validacion_usuarios.js'></script>
        <script type='text/javascript' src='js/buscar_artista.js'></script>
        <script type='text/javascript' src='js/mostrar_artista.js'></script>
        
        <script type='text/javascript'>
            function abrirReporte(reporte) {
                let url = '';
                if (reporte === 'reporte1') {
                    url = './Highcharts/examples/line-basic/index.php';
                } else if (reporte === 'reporte2') {
                    url = './Highcharts/examples/line-basic/valoraciones_canciones.php';
                } else if (reporte === 'reporte3') {
                    url = './Highcharts/examples/3d-pie/index.php';
                } else if (reporte === 'reporte4') {
                    url = './Highcharts/examples/3d-pie/artistas_canciones.php';
                } else if (reporte === 'reporte5') {
                    url = './Highcharts/examples/3d-pie/artistas_canciones.php';
                }
                // Abre el reporte en una nueva ventana
                window.open(url, '_blank', 'width=800, height=700,left=300,top=100,scrollbars=yes,menubars=no,statusbar=NO');
            }
        </script>
    </head>";

echo "<body>
        <p> &nbsp;</p>";

echo "<h1>REPORTES ESTADÍSTICOS GRÁFICOS</h1>";

echo "<form name='formu'>";
echo "<center>
<table class='listado'>
    <tr>
        <td>
            <table border='1'>
                <tr>
                    <th colspan='2' style='background-color: #07091E; color: #01FFFF; padding: 10px;'>
                        SELECCIONE EL REPORTE ESTADÍSTICO
                    </th>
                </tr>
                <tr>
                    <td><input type='radio' name='reporte' value='reporte1' onclick=\"abrirReporte('reporte1')\"></td>
                    <td style='color: white;'>Reporte 1: LÍNEAS BÁSICAS GRUPOS CON OPCIONES</td>
                </tr>
                <tr>
                    <td><input type='radio' name='reporte' value='reporte2' onclick=\"abrirReporte('reporte2')\"></td>
                    <td style='color: white;'>Reporte 2: LINEAS BÁSICAS GENEROS CON ARTISTAS</td>
                </tr>
                <tr>
                    <td><input type='radio' name='reporte' value='reporte3' onclick=\"abrirReporte('reporte3')\"></td>
                    <td style='color: white;'>Reporte 3: TORTA 3D GRUPOS CON OPCIONES</td>
                </tr>
                <tr>
                    <td><input type='radio' name='reporte' value='reporte4' onclick=\"abrirReporte('reporte4')\"></td>
                    <td style='color: white;'>Reporte 4: TORTA 3D ARTISTAS CON CANCIONES</td>
                </tr>
                <tr>
                    <td><input type='radio' name='reporte' value='reporte5' onclick=\"abrirReporte('reporte5')\"></td>
                    <td style='color: white;'>Reporte 5: REPORTES EXAMEN</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</center>";
echo "</form>";
echo "</body>
</html>";
?>
