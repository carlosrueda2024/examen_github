<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
// $db->debug=true;

$sql = $db->Prepare("SELECT * FROM pastores WHERE estado = 'A'");
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
    <script type='text/javascript' src='js/buscar_mensajes.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "mensajes");
paginacion("mensajes.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTADO DE MENSAJES</h1>
    <a href="mensaje_nuevo.php" class="nuevo-boton">Nuevo Mensaje &gt;&gt;&gt;</a>
    <form action="#" method="post" name="formu">
        <select name="pastor" onchange="buscar_mensajes()">
            <option value="">--Seleccione Pastor--</option>';
            foreach ($rs as $fila) {
                echo '<option value="'.$fila['especialidad'].'">'.$fila['especialidad'].'</option>';
            }
            echo '</select>
        <input type="text" name="nombre_mensaje" placeholder="Nombre Mensaje" onkeyup="buscar_mensajes();">
        <input type="text" name="nombre_evento" placeholder="Nombre Evento" onkeyup="buscar_mensajes();">
    </form>
</center>';

echo "<div id='tabla' class='listado-container'>";

// Consulta para obtener la lista de mensajes
$sql3 = $db->Prepare("SELECT p.especialidad as pastor, m.*
                      FROM pastores p, mensajes m
                      WHERE p.id_pastor = m.id_pastor
                      AND p.estado <> 'X'
                      AND m.estado <> 'X'
                      ORDER BY m.id_mensaje DESC
                      LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql3, array($nElem, $regIni));

// Verificar si hay resultados
if ($rs) {
    echo "<center>
    <table class='listado'>
        <tr>
            <th>Nro</th><th>PASTOR</th><th>NOMBRE MENSAJE</th><th>NOMBRE EVENTO</th><th>FECHA</th>
            <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
        </tr>";

    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
            <td align='center'>".$b."</td>
            <td>".$fila['pastor']."</td>
            <td>".$fila['nombre_mensaje']."</td>
            <td>".$fila['nombre_evento']."</td>
            <td>".$fila['fecha']."</td>
            <td align='center'>
                <form name='formModif".$fila['id_mensaje']."' method='post' action='mensaje_modificar.php'>
                    <input type='hidden' name='id_mensaje' value='".$fila['id_mensaje']."'>
                    <input type='hidden' name='id_pastor' value='".$fila['id_pastor']."'>
                    <a href='javascript:document.formModif".$fila['id_mensaje'].".submit();' title='Modificar Mensaje'>
                        Modificar &gt;&gt;
                    </a>
                </form>
            </td>
            <td align='center'>  
                <form name='formElimi".$fila['id_mensaje']."' method='post' action='mensaje_eliminar.php'>
                    <input type='hidden' name='id_mensaje' value='".$fila['id_mensaje']."'>
                    <a href='javascript:document.formElimi".$fila['id_mensaje'].".submit();' title='Eliminar Mensaje' onclick='return confirm(\"Desea realmente eliminar el mensaje ".$fila['nombre_mensaje']." ?\");'>
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
