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
    <script type='text/javascript' src='js/buscar_valoraciones.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "valoraciones");
paginacion("valoraciones.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTADO DE VALORACIONES</h1>
    <a href="valoracion_nuevo.php" class="nuevo-boton">Nueva Valoración &gt;&gt;&gt;</a>
    <form action="#" method="post" name="formu">
        <input type="text" name="nom_usuario" placeholder="Usuario" onkeyup="buscar_valoraciones();">
        <input type="text" name="nombre" placeholder="Canción" onkeyup="buscar_valoraciones();">
        <input type="number" name="valoracion" placeholder="Valoracion" max="10" min="1" oninput="buscar_valoraciones();" onkeydown="return false;">
        <input type="text" name="comentario" placeholder="Comentario" onkeyup="buscar_valoraciones();">
    </form>
</center>';

echo "<div id='tabla' class='listado-container'>";

$sql3 = $db->Prepare("SELECT CONCAT_WS(' ', u.nom_usuario) AS usuario_visita, v.*, CONCAT_WS(' ', c.nombre, c.duracion, c.anio_lanza) AS cancion
                      FROM usuarios_visitas u, valoraciones v, canciones c
                      WHERE u.id_usuario_visita = v.id_usuario_visita
                      AND v.id_cancion = c.id_cancion
                      AND v.estado <> 'X'
                      AND u.estado <> 'X' 
                      AND c.estado <> 'X'
                      ORDER BY v.id_valoracion DESC
                      LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql3, array($nElem, $regIni));

if ($rs) {
    echo "<center>
    <table class='listado'>
        <tr>
            <th>Nro</th><th>USUARIO_VISITA</th><th>CANCION</th><th>VALORACION</th><th>COMENTARIO</th>
            <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
        </tr>";

    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['usuario_visita']."</td>
                <td>".$fila['cancion']."</td>
                <td>".$fila['valoracion']."</td>
                <td>".$fila['comentario']."</td>
                <td align='center'>
                    <form name='formModif".$fila['id_valoracion']."' method='post' action='valoracion_modificar.php'>
                        <input type='hidden' name='id_valoracion' value='".$fila['id_valoracion']."'>
                        <input type='hidden' name='id_usuario_visita' value='".$fila['usuario_visita']."'>
                        <input type='hidden' name='id_cancion' value='".$fila['id_cancion']."'>
                        <a href='javascript:document.formModif".$fila['id_valoracion'].".submit();' title='Modificar Valoración Sistema'>
                          Modificar &gt;&gt;
                        </a>
                    </form>
                </td>
                <td align='center'>
                    <form name='formElimi".$fila['id_valoracion']."' method='post' action='valoracion_eliminar.php'>
                        <input type='hidden' name='id_valoracion' value='".$fila['id_valoracion']."'>
                        <a href='javascript:document.formElimi".$fila['id_valoracion'].".submit();' title='Eliminar Valoración Sistema' onclick='return confirm(\"Desea realmente eliminar la valoración de ".$fila['usuario_visita']."?\")'>
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
