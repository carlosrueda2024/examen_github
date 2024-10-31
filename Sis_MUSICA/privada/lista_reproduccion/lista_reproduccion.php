<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo "<html>
<head>
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_buscador.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_listado.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_paginacion.css' type='text/css'>
    <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
    <script type='text/javascript' src='../../ajax.js'></script>
    <script type='text/javascript' src='js/buscar_lista_reproduccion.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "lista_reproduccion");
paginacion("lista_reproduccion.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTAS DE REPRODUCCIÓN</h1>
    <a href="lista_reproduccion_nuevo.php" class="nuevo-boton">Nueva Lista &gt;&gt;&gt;</a>
    <form action="#" method="post" name="formu">
        <input type="text" name="usuario" placeholder="Usuario" onkeyup="buscar_lista_reproduccion();">
        <input type="text" name="nombre" placeholder="Nombre" onkeyup="buscar_lista_reproduccion();">
        <input type="text" name="descripcion" placeholder="Descripción" onkeyup="buscar_lista_reproduccion();">
        <input type="date" name="fec_creacion" onchange="buscar_lista_reproduccion();">
    </form>
</center>';

echo "<div id='tabla' class='listado-container'>";

$nombre = $_POST["nombre"] ?? '';
$descripcion = $_POST["descripcion"] ?? '';
$fec_creacion = $_POST["fec_creacion"] ?? '';
$usuario = $_POST["usuario"] ?? '';

$sql3 = $db->Prepare("SELECT CONCAT_WS(' ', u.nom_usuario) AS usuarios, l.* 
                     FROM usuarios_visitas u, lista_reproduccion l
                     WHERE u.id_usuario_visita = l.id_usuario_visita
                     AND l.nombre LIKE ?
                     AND l.descripcion LIKE ?
                     AND l.fec_creacion LIKE ?
                     AND u.nom_usuario LIKE ?
                     AND u.estado <> 'X' 
                     AND l.estado <> 'X' 
                     ORDER BY l.id_lista_reproduccion DESC  
                     LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql3, array($nombre."%", $descripcion."%", $fec_creacion."%", $usuario."%", $nElem, $regIni));

if ($rs) {
    echo "<center>
    <table class='listado'>
      <tr>
        <th>Nro</th><th>USUARIOS</th><th>NOMBRE</th><th>DESCRIPCIÓN</th><th>FECHA CREACIÓN</th>
        <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
      </tr>";

    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['usuarios']."</td>
                <td>".$fila['nombre']."</td>
                <td>".$fila['descripcion']."</td>
                <td>".$fila['fec_creacion']."</td>
                <td align='center'>
                    <form name='formModif".$fila['id_lista_reproduccion']."' method='post' action='lista_reproduccion_modificar.php'>
                        <input type='hidden' name='id_lista_reproduccion' value='".$fila['id_lista_reproduccion']."'>
                        <input type='hidden' name='id_usuario_visita' value='".$fila['id_usuario_visita']."'>
                        <a href='javascript:document.formModif".$fila['id_lista_reproduccion'].".submit();' title='Modificar Lista Sistema'>
                          Modificar &gt;&gt;
                        </a>
                    </form>
                </td>
                <td align='center'>
                    <form name='formElimi".$fila['id_lista_reproduccion']."' method='post' action='lista_reproduccion_eliminar.php'>
                        <input type='hidden' name='id_lista_reproduccion' value='".$fila['id_lista_reproduccion']."'>
                        <a href='javascript:document.formElimi".$fila['id_lista_reproduccion'].".submit();' title='Eliminar Lista Sistema' onclick='return confirm(\"Desea realmente eliminar la lista ".$fila['nombre']."?\")'>
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
