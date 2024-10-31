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
    </head>";
echo "<body>
        <p> &nbsp;</p>";

// Fetch genres data
$sqlGenres = $db->Prepare("SELECT * FROM generos WHERE estado = 'A'");
$rsGenres = $db->GetAll($sqlGenres);

echo "<h1>BUSCAR ARTISTA</h1>";
echo "<form name='formu'>";
echo "<center>
<table class='listado'>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <b>Género</b><br />
                        <select name='genero' onchange='buscar_artistas()'>
                            <option value=''>--Seleccione--</option>";
                            foreach ($rsGenres as $genre) {
                                echo "<option value='".$genre['nombre']."'>".$genre['nombre']."</option>";
                            }
                            echo "</select>
                    </td>
                    <td>
                        <b>Nombre</b><br />
                        <input type='text' name='nombreA' value='' size='10' onKeyUp='buscar_artistas()'>
                    </td>
                    <td>
                        <b>Nombre Artístico</b><br />
                        <input type='text' name='nombre_artistico' value='' size='10' onKeyUp='buscar_artistas()'>
                    </td>
                    <td>
                        <b>País</b><br />
                        <input type='text' name='pais' value='' size='10' onKeyUp='buscar_artistas()'>
                    </td>
                    <td>
                        <b>Fecha Creación</b><br />
                        <input type='date' name='fec_creacion' value='' size='10' onchange='buscar_artistas()'>
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
                    <div id='artistas1'></div>
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
