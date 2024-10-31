<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
// $db->debug=true;

// Consulta para obtener géneros
$sql = $db->Prepare("SELECT * FROM generos WHERE estado = 'A'");
$rs = $db->GetAll($sql);

// Inicio del HTML
echo "<html>
<head>
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_buscador.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_listado.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_paginacion.css' type='text/css'>
    <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
    <script type='text/javascript' src='../../ajax.js'></script>
    <script type='text/javascript' src='js/buscar_artistas.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "artistas");
paginacion("artistas.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTADO DE ARTISTAS</h1>
    <a href="artista_nuevo.php" class="nuevo-boton">Nuevo Artista &gt;&gt;&gt;</a>
    <form action="#" method="post" name="formu">
        <select name="genero" onchange="buscar_artistas()">
            <option value="">--Seleccione Genero--</option>';
            foreach ($rs as $fila) {
                echo '<option value="'.$fila['nombre'].'">'.$fila['nombre'].'</option>';
            }
            echo '</select>
        <input type="text" name="nombre_artistico" placeholder="Nombre Artístico" onkeyup="buscar_artistas();">
        <input type="text" name="pais" placeholder="País" onkeyup="buscar_artistas();">
    </form>
</center>';

echo "<div id='tabla' class='listado-container'>";

// Consulta para obtener la lista de artistas
$sql3 = $db->Prepare("SELECT g.nombre as genero, a.*
                      FROM generos g, artistas a
                      WHERE g.id_genero = a.id_genero
                      AND g.estado <> 'X'
                      AND a.estado <> 'X'
                      ORDER BY a.id_artista DESC
                      LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql3, array($nElem, $regIni));

// Verificar si hay resultados
if ($rs) {
    echo "<center>
    <table class='listado'>
        <tr>
            <th>Nro</th><th>GÉNERO</th><th>NOMBRE ARTÍSTICO</th><th>PAÍS</th><th>FECHA CREACIÓN</th>
            <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
        </tr>";

    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
            <td align='center'>".$b."</td>
            <td>".$fila['genero']."</td>
            <td>".$fila['nombre_artistico']."</td>
            <td>".$fila['pais']."</td>
            <td>".$fila['fec_creacion']."</td>
            <td align='center'>
                <form name='formModif".$fila['id_artista']."' method='post' action='artista_modificar.php'>
                    <input type='hidden' name='id_artista' value='".$fila['id_artista']."'>
                    <input type='hidden' name='id_genero' value='".$fila['id_genero']."'>
                    <a href='javascript:document.formModif".$fila['id_artista'].".submit();' title='Modificar Artista'>
                        Modificar &gt;&gt;
                    </a>
                </form>
            </td>
            <td align='center'>  
                <form name='formElimi".$fila['id_artista']."' method='post' action='artista_eliminar.php'>
                    <input type='hidden' name='id_artista' value='".$fila['id_artista']."'>
                    <a href='javascript:document.formElimi".$fila['id_artista'].".submit();' title='Eliminar Artista' onclick='return confirm(\"Desea realmente eliminar al artista ".$fila['nombre_artistico']." ?\");'>
                        Eliminar &gt;&gt;
                    </a>
                </form>                        
            </td>
        </tr>";
        $b++;
    }

    echo "</table>
    </center>";
}

// Mostrar paginación
mostrar_paginacion();
echo "</div>";
echo "</body>
</html>";
?>
