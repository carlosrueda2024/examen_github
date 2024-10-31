<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
// $db->debug=true;

echo "<html>
<head>
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_buscador.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_listado.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_paginacion.css' type='text/css'>
    <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
    <script type='text/javascript' src='../../ajax.js'></script>
    <script type='text/javascript' src='js/buscar_generos.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "generos");
paginacion("generos.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTADO DE GENEROS</h1>
    <a href="genero_nuevo.php" class="nuevo-boton">Nuevo Género &gt;&gt;&gt;</a>
    <form action="#" method="post" name="formu">
        <input type="text" name="nombre" placeholder="Nombre" onkeyup="buscar_generos();">
        <input type="text" name="anio_origen" placeholder="Año Origen" onkeyup="buscar_generos();">
    </form>
</center>';

echo "<div id='tabla' class='listado-container'>";

$sql3 = $db->Prepare("SELECT *
                      FROM generos
                      WHERE estado <> 'X'
                      ORDER BY id_genero DESC
                      LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql3, array($nElem, $regIni));

if ($rs) {
    echo "<center>
    <table class='listado'>
      <tr>
        <th>Nro</th><th>NOMBRE</th><th>AÑO ORIGEN</th>
        <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
      </tr>";

    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['nombre']."</td>
                <td>".$fila['anio_origen']."</td>
                <td align='center'>
                    <form name='formModif".$fila['id_genero']."' method='post' action='genero_modificar.php'>
                        <input type='hidden' name='id_genero' value='".$fila['id_genero']."'>
                        <a href='javascript:document.formModif".$fila['id_genero'].".submit();' title='Modificar Género Sistema'>
                          Modificar &gt;&gt;
                        </a>
                    </form>
                </td>
                <td align='center'>
                    <form name='formElimi".$fila['id_genero']."' method='post' action='genero_eliminar.php'>
                        <input type='hidden' name='id_genero' value='".$fila['id_genero']."'>
                        <a href='javascript:document.formElimi".$fila['id_genero'].".submit();' title='Eliminar Género Sistema' onclick='return confirm(\"Desea realmente Eliminar el género ".$fila['nombre']." ".$fila['anio_origen']." ?\")'>
                          Eliminar &gt;&gt;
                        </a>
                    </form>
                </td>
              </tr>";
        $b = $b + 1;
    }

    echo "</table>
    </center>";
}

mostrar_paginacion();
echo "</div>";
echo "</body>
</html>";
?>
