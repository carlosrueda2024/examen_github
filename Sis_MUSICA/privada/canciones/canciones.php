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
    <script type='text/javascript' src='js/buscar_canciones.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

    // Contador de registros y paginación
    contarRegistros($db, "canciones");
    paginacion("canciones.php?");

    // Formulario de búsqueda
    echo '
    <center>
        <h1>LISTADO DE CANCIONES</h1>
        <a href="cancion_nuevo.php" class="nuevo-boton">Nueva Canción &gt;&gt;&gt;</a>
        <form action="#" method="post" name="formu">
            <input type="text" name="nombre" placeholder="Nombre Canción" onkeyup="buscar_canciones();">
            <input type="text" name="duracion" placeholder="Duracion (HH:mm:ss)" onkeyup="buscar_canciones();">
            <input type="number" name="anio_lanza" min="2000" max="2024" onchange="buscar_canciones();">
        </form>
    </center>';

    echo "<div id='tabla' class='listado-container'>";

    $sql3 = $db->Prepare("SELECT CONCAT_WS(' ', a.nombre, a.anio_lanza) AS albun, c.*, CONCAT_WS(' ', g.nombre, g.anio_origen) AS genero, c.* 
                          FROM albunes a, canciones c, generos g
                          WHERE c.id_genero = g.id_genero
                          AND c.id_albun = a.id_albun
                          AND c.estado <> 'X'
                          AND a.estado <> 'X' 
                          AND g.estado <> 'X' 
                          ORDER BY c.id_cancion DESC
                          LIMIT ? OFFSET ?");
    $rs = $db->GetAll($sql3, array($nElem, $regIni));

    if ($rs) {
        echo "<center>
        <table class='listado'>
        <tr>
            <th>Nro</th><th>ÁLBUM</th><th>GÉNERO</th><th>NOMBRE</th><th>DURACIÓN</th><th>AÑO</th>
            <th>REPRODUCIR</th>
            <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
        </tr>";

        $b = 0;
        $total = $pag - 1;
        $a = $nElem * $total;
        $b = $b + 1 + $a;

        foreach ($rs as $k => $fila) {
            echo "<tr>
                    <td align='center'>".$b."</td>
                    <td>".$fila['albun']."</td>
                    <td>".$fila['genero']."</td>
                    <td>".$fila['nombre']."</td>
                    <td>".$fila['duracion']."</td>
                    <td>".$fila['anio_lanza']."</td>
                    <td align='center'>
                        <audio controls>
                            <source src='musica/".$fila['nombre']."' type='audio/mpeg'>
                            Your browser does not support the audio element.
                        </audio>
                    </td>
                    <td align='center'>
                        <form name='formModif".$fila['id_cancion']."' method='post' action='cancion_modificar.php'>
                            <input type='hidden' name='id_cancion' value='".$fila['id_cancion']."'>
                            <input type='hidden' name='id_albun' value='".$fila['id_albun']."'>
                            <input type='hidden' name='id_genero' value='".$fila['id_genero']."'>
                            <a href='javascript:document.formModif".$fila['id_cancion'].".submit();' title='Modificar Canción'>
                            Modificar &gt;&gt;
                            </a>
                        </form>
                    </td>
                    <td align='center'>
                        <form name='formElimi".$fila['id_cancion']."' method='post' action='cancion_eliminar.php'>
                            <input type='hidden' name='id_cancion' value='".$fila['id_cancion']."'>
                            <a href='javascript:document.formElimi".$fila['id_cancion'].".submit();' title='Eliminar Canción' onclick='return confirm(\"Desea realmente eliminar la canción ".$fila['nombre']."?\")'>
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
