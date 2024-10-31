<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug = true;

echo "<html>
<head>
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <script type='text/javascript'>
    function validar() {
        fecha1 = document.formu.date1.value;
        fecha2 = document.formu.date2.value;
        if ((document.formu.date1.value == '') || (document.formu.date2.value == '') || (document.formu.date1.value> document.formu.date2.value)) {
            alert('Las fechas son incorrectas');
            document.formu.date1.focus();
            return;
        }
        var ventanaCalendario = window.open('personas_fechas1.php?fechal=' + fecha1 + '&fecha2=' + fecha2, 'calendario', 'width=600, height=550, left=100, top=100, scrollbars=yes, menubars=no, statusbar=NO, status=NO, resizable=YES, location=NO');
    }
    </script>
</head>
<body>
    <p>&nbsp;</p>
    <h1>REPORTES DE PERSONAS CON FECHAS DE INSERCION</h1>
    <form method='post' name='formu'>
        <center>
            <table border='1'>
                <tr>
                    <th>Fecha Inicio </th>
                    <th>:</th>
                    <td><input type='date' name='date1' class='tcal' value='' size='10'></td>
                    <th>Fecha Fin</th>
                    <th>:</th>
                    <td><input type='date' name='date2' class='tcal' value='' size='10'></td>
                </tr>
                <tr>
                    <td align='center' colspan='6'>
                        <input type='hidden' name='accion' value=''>
                        <input type='button' value='Aceptar' onclick='validar();' style='cursor:pointer;border-radius:10px; font-weight: bold;height: 35px; color:white; background:black'>
                    </td>
                </tr>
            </table>
        </center>
    </form>
</body>
</html>";
?>
