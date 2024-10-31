<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
// $db->debug=true;

// Consulta para obtener heladerías/pastelerías
$sql = $db->Prepare("SELECT * FROM heladeria_pasteleria");
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
    <script type='text/javascript' src='js/buscar_tortas.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "tortas");
paginacion("tortas.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTADO DE TORTAS</h1>
    <a href="torta_nueva.php" class="nuevo-boton">Nueva Torta &gt;&gt;&gt;</a>
    <form action="#" method="post" name="formu">
        <select name="heladeria_pasteleria" onchange="buscar_tortas()">
            <option value="">--Seleccione Heladería/Pastelería--</option>';
            foreach ($rs as $fila) {
                echo '<option value="'.$fila['nombre_heladeria_pasteleria'].'">'.$fila['nombre_heladeria_pasteleria'].'</option>';
            }
            echo '</select>
        <input type="text" name="nombre" placeholder="Nombre" onkeyup="buscar_tortas();">
        <input type="text" name="precio" placeholder="Precio" onkeyup="buscar_tortas();">
        <input type="text" name="cantidad" placeholder="Cantidad" onkeyup="buscar_tortas();">
    </form>
</center>';

echo "<div id='tabla' class='listado-container'>";

// Consulta para obtener la lista de tortas
$sql3 = $db->Prepare("SELECT h.nombre_heladeria_pasteleria as heladeria, t.*
                      FROM heladeria_pasteleria h, tortas t
                      WHERE h.id = t.heladeria_pasteleria_id
                      ORDER BY t.id DESC
                      LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql3, array($nElem, $regIni));

// Verificar si hay resultados
if ($rs) {
    echo "<center>
    <table class='listado'>
        <tr>
            <th>Nro</th><th>HELADERÍA/PASTELERÍA</th><th>NOMBRE</th><th>CANTIDAD</th><th>PRECIO</th>
            <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
        </tr>";

    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
            <td align='center'>".$b."</td>
            <td>".$fila['heladeria']."</td>
            <td>".$fila['nombre']."</td>
            <td>".$fila['cantidad']."</td>
            <td>".$fila['precio']."</td>
            <td align='center'>
                <form name='formModif".$fila['id']."' method='post' action='torta_modificar.php'>
                    <input type='hidden' name='id' value='".$fila['id']."'>
                    <input type='hidden' name='heladeria_pasteleria_id' value='".$fila['heladeria_pasteleria_id']."'>
                    <a href='javascript:document.formModif".$fila['id'].".submit();' title='Modificar Torta'>
                        Modificar &gt;&gt;
                    </a>
                </form>
            </td>
            <td align='center'>  
                <form name='formElimi".$fila['id']."' method='post' action='torta_eliminar.php'>
                    <input type='hidden' name='id' value='".$fila['id']."'>
                    <a href='javascript:document.formElimi".$fila['id'].".submit();' title='Eliminar Torta' onclick='return confirm(\"Desea realmente eliminar la torta ".$fila['nombre']." ?\");'>
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
