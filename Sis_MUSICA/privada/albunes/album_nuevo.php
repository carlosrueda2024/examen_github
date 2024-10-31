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
        <script src='js/validacion_albunes.js'></script>
        <script type='text/javascript' src='js/buscar_artista.js'></script>
    </head>";
echo "<body>
        <p> &nbsp;</p>
        <h1>INSERTAR ÁLBUM</h1>";

$sql = $db->Prepare("SELECT nombre_artistico, id_artista
                     FROM artistas
                     WHERE estado = 'A'");
$rs = $db->GetAll($sql);

echo "<form action='album_nuevo1.php' method='post' name='formu'>";
echo "<center>
<table class='listado'>
    <tr>
        <th>(*)Selecciona al artista</th>
        <td>
            <table>
                <tr>
                    <td>
                        <b>Nombre Artístico</b><br />
                        <input type='text' name='nombre_artistico' value='' size='10' onKeyUp='buscar()'>
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
                    <div id='artistas'> </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan='6' align='center'>
        <table width='100%'>
            <tr>
                <td colspan='3'>
                    <div id='artista_seleccionado'> </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan='6' align='center'>
        <table width='100%'>
            <tr>
                <td colspan='3'>
                    <input type='hidden' name='id_artista'>
                    <div id='artista_insertado'> </div>
                </td>
            </tr>
        </table>
    </td>
</tr>";
echo "<tr>
        <th><b>(*)Nombre del Álbum</b></th>
        <td><input type='text' name='nombre' size='30'></td>
      </tr>
      <tr>
        <th><b>(*)Año de Lanzamiento</b></th>
        <td><input type='text' name='anio_lanza' size='4' maxlength='4' placeholder='YYYY'></td>
      </tr>
      <tr>
          <td align='center' colspan='2'>
              <input type='button' value='ACEPTAR' onclick='validar();' >
              <input type='reset' value='CANCELAR' >
              (*)Datos Obligatorios
          </td>
      </tr>
</table>
</center>";
echo "</form>";
echo "</body>
</html>";
?>
