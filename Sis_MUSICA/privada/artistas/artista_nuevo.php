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
        <script src='js/validacion_artistas.js'></script>
        <script type='text/javascript' src='js/buscar_genero.js'></script>
    </head>";
echo "<body>
        <p> &nbsp;</p>
        <h1>INSERTAR ARTISTA</h1>";
$sql = $db->Prepare("SELECT CONCAT_WS(' ',nombre, anio_origen) as genero, id_genero
                    FROM generos
                    WHERE estado = 'A'
                    ");
$rs = $db->GetAll($sql);

echo "<form action='artista_nuevo1.php' method='post' name='formu'>";
echo "<center>
<table class='listado'>
    <tr>
        <th>(*)Selecciona a el genero</th>
        <td>
            <table>
                <tr>
                    <td>
                        <b>Año de origen</b><br />
                        <input type='text' name='anio_origen' value='' size='10' onKeyUp='buscar()'>
                    </td>
                    <td>
                        <b>Nombre</b><br />
                        <input type='text' name='nombre' value='' size='10' onKeyUp='buscar()'>
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
                    <div id='generos'> </div>
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
                    <div id='genero_seleccionado'> </div>
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
                    <input type='hidden' name='id_genero'>
                    <div id='genero_insertado'> </div>
                </td>
            </tr>
        </table>
    </td>
</tr>";
echo "<tr>
        <th><b>(*)Nombre Artista</b></th>
        <td><input type='text' name='nombreA' size='10'></td>
      </tr>
      <tr>
        <th><b>(*)Nombre Artistico</b></th>
        <td><input type='text' name='nombre_artistico' size='10'></td>
      </tr>
      <tr>
        <th><b>(*)pais</b></th>
        <td><input type='text' name='pais' size='10'></td>
      </tr>
      <tr>
        <th><b>Fecha Creacion</b></th>
        <td><input type='date' name='fec_creacion' size='10'></td>
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