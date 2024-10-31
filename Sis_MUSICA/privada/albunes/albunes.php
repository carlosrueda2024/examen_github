<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
// $db->debug=true;

// Consulta para obtener artistas
$sql = $db->Prepare("SELECT * FROM artistas WHERE estado = 'A'");
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
    <script type='text/javascript' src='js/buscar_albunes.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "albunes");
paginacion("albunes.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTADO DE ÁLBUNES</h1>
    <a href="album_nuevo.php" class="nuevo-boton">Nuevo Álbum &gt;&gt;&gt;</a>
    <form action="#" method="post" name="formu">
        <select name="artista" onchange="buscar_albunes()">
            <option value="">--Seleccione Artista--</option>';
            foreach ($rs as $fila) {
                echo '<option value="'.$fila['nombre_artistico'].'">'.$fila['nombre_artistico'].'</option>';
            }
            echo '</select>
        <input type="text" name="nombre" placeholder="Nombre del Álbum" onkeyup="buscar_albunes();">
        <input type="text" name="anio_lanza" placeholder="Año de Lanzamiento" onkeyup="buscar_albunes();">
    </form>
</center>';

echo "<div id='tabla' class='listado-container'>";

// Consulta para obtener la lista de álbumes
$sql3 = $db->Prepare("SELECT a.nombre_artistico, al.* 
                      FROM artistas a, albunes al 
                      WHERE a.id_artista = al.id_artista 
                      AND a.estado <> 'X' 
                      AND al.estado <> 'X' 
                      ORDER BY al.id_albun DESC 
                      LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql3, array($nElem, $regIni));

// Verificar si hay resultados
if ($rs) {
    echo "<center>
    <table class='listado'>
        <tr>
            <th>Nro</th><th>ARTISTA</th><th>NOMBRE DEL ÁLBUM</th><th>AÑO DE LANZAMIENTO</th><th>FECHA INSERCIÓN</th>
            <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
        </tr>";

    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
            <td align='center'>".$b."</td>
            <td>".$fila['nombre_artistico']."</td>
            <td>".$fila['nombre']."</td>
            <td>".$fila['anio_lanza']."</td>
            <td>".$fila['fec_insercion']."</td>
            <td align='center'>
                <form name='formModif".$fila['id_albun']."' method='post' action='album_modificar.php'>
                    <input type='hidden' name='id_albun' value='".$fila['id_albun']."'>
                    <input type='hidden' name='id_artista' value='".$fila['id_artista']."'>
                    <a href='javascript:document.formModif".$fila['id_albun'].".submit();' title='Modificar Álbum'>
                        Modificar &gt;&gt;
                    </a>
                </form>
            </td>
            <td align='center'>  
                <form name='formElimi".$fila['id_albun']."' method='post' action='album_eliminar.php'>
                    <input type='hidden' name='id_albun' value='".$fila['id_albun']."'>
                    <a href='javascript:document.formElimi".$fila['id_albun'].".submit();' title='Eliminar Álbum' onclick='return confirm(\"Desea realmente eliminar el álbum ".$fila['nombre']." ?\");'>
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
