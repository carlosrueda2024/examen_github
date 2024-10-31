<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;
echo "<html>
    <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <script type='text/javascript' src='../../ajax.js'></script>
        <script src='../js/expresiones_regulares.js'></script>
        <script src='js/validacion_usuarios.js'></script>
        <script type='text/javascript' src='js/buscar_persona.js'></script>
    </head>";
echo "<body>
        <p> &nbsp;</p>
        <h1>BUSCAR PERSONA</h1>";
$sql = $db->Prepare("SELECT CONCAT_WS(' ',ap, am, nombres) as persona, id_persona
                    FROM personas
                    WHERE estado = 'A'
                    ");
$rs = $db->GetAll($sql);

echo "<form name='formu'>";
echo "<center>
<table class='listado'>
    <tr>
        <th>(*)Selecciona a la persona</th>
        <td>
            <table>
                <tr>
                    <td>
                        <b>Paterno</b><br />
                        <input type='text' name='ap' value='' size='10' onKeyUp='buscar()'>
                    </td>
                    <td>
                        <b>Materno</b><br />
                        <input type='text' name='am' value='' size='10' onKeyUp='buscar()'>
                    </td>
                    <td>
                        <b>Nombres</b><br />
                        <input type='text' name='nombres' value='' size='10' onKeyUp='buscar()'>
                    </td>
                    <td>
                        <b>C.I.</b><br />
                        <input type='text' name='ci' value='' size='10' onKeyUp='buscar()'>
                    </td>
                </tr>
            </table>
        </td>
    </tr>";
echo "<tr>
    <td colspan='6' align='center'>
        <table width='100%'>
            <tr>
                <td colspan='3' align='center'>
                    <div id='personas'> </div>
                </td>
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
