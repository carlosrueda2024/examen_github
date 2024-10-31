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
    <script type='text/javascript' src='js/buscar_instrumentos.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "instrumentos");
paginacion("instrumentos.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTADO DE INSTRUMENTOS</h1>
    <a href="instrumento_nuevo.php" class="nuevo-boton">Nuevo Instrumento &gt;&gt;&gt;</a>
    <form action="#" method="post" name="formu">
        <input type="text" name="nombre" placeholder="Nombre" onkeyup="buscar_instrumentos();">
        <input type="text" name="tipo" placeholder="Tipo" onkeyup="buscar_instrumentos();">
        <input type="text" name="descripcion" placeholder="Descripción" onkeyup="buscar_instrumentos();">
        <input type="date" name="fec_insercion" onchange="buscar_instrumentos();">
    </form>
</center>';

echo "<div id='tabla' class='listado-container'>";

$sql3 = $db->Prepare("SELECT *
                      FROM instrumentos
                      WHERE estado <> 'X' 
                      ORDER BY id_instrumento DESC
                      LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql3, array($nElem, $regIni));

if ($rs) {
    echo "<center>
    <table class='listado'>
      <tr>
        <th>Nro</th><th>NOMBRE</th><th>TIPO</th><th>DESCRIPCION</th>
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
                <td>".$fila['tipo']."</td>
                <td>".$fila['descripcion']."</td>
                <td align='center'>
                    <form name='formModif".$fila['id_instrumento']."' method='post' action='instrumento_modificar.php'>
                        <input type='hidden' name='id_instrumento' value='".$fila['id_instrumento']."'>
                        <a href='javascript:document.formModif".$fila['id_instrumento'].".submit();' title='Modificar Instrumento Sistema'>
                          Modificar &gt;&gt;
                        </a>
                    </form>
                </td>
                <td align='center'>
                    <form name='formElimi".$fila['id_instrumento']."' method='post' action='instrumento_eliminar.php'>
                        <input type='hidden' name='id_instrumento' value='".$fila['id_instrumento']."'>
                        <a href='javascript:document.formElimi".$fila['id_instrumento'].".submit();' title='Eliminar Instrumento Sistema' onclick='return confirm(\"Desea realmente Eliminar el instrumento ".$fila['nombre']." ".$fila['tipo']." ".$fila['descripcion']." ?\")'>
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
