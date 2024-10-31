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
        <script type='text/javascript' src='js/buscar_sucursal.js'></script>
        <script type='text/javascript' src='js/mostrar_sucursal.js'></script>
    </head>";
echo "<body>
        <p> &nbsp;</p>";

// Fetch genres data
$sqlGenres = $db->Prepare("SELECT * FROM compania_limpieza WHERE id > 0" );
$rsGenres = $db->GetAll($sqlGenres);

echo "<h1>BUSCAR SUCURSAL</h1>";
echo "<form name='formu'>";
echo "<center>
<table class='listado'>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <b>Compania limpieza</b><br />
                        <select name='limpieza' onchange='buscar_sucursales()'>
                            <option value=''>--Seleccione--</option>";
                            foreach ($rsGenres as $genre) {
                                echo "<option value='".$genre['nombre']."'>".$genre['nombre']."</option>";
                            }
                            echo "</select>
                    </td>
                    <td>
                        <b>Departamento</b><br />
                        <input type='text' name='dpto' value='' size='10' onKeyUp='buscar_sucursales()'>
                    </td>
                    <td>
                        <b>Telefono</b><br />
                        <input type='text' name='telefono' value='' size='10' onKeyUp='buscar_sucursales()'>
                    </td>
                    <td>
                        <b>Direccion</b><br />
                        <input type='text' name='dir_suc' value='' size='10' onKeyUp='buscar_sucursales()'>
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
                    <div id='sucursales1'></div>
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
