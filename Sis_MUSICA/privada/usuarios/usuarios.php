<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
// $db->debug=true;

echo "<html>
<head>
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_listado.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_paginacion.css' type='text/css'>
    <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
</head>
<body>
    <p>&nbsp;</p>";

// Contador de registros y paginación
contarRegistros($db, "usuarios");
paginacion("usuarios.php?");

// Formulario de búsqueda
echo '
<center>
    <h1>LISTADO DE USUARIOS</h1>
    <a href="usuario_nuevo.php" class="nuevo-boton">Nuevo Usuario &gt;&gt;&gt;</a>
</center>';

echo "<div id='tabla' class='listado-container'>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', p.ap, p.am, p.nombres) AS persona, u.* 
                     FROM personas p, usuarios u
                     WHERE p.id_persona = u.id_persona
                     AND p.estado <> 'X' 
                     AND u.estado <> 'X' 
                     ORDER BY u.id_usuario DESC
                     LIMIT ? OFFSET ?");
$rs = $db->GetAll($sql, array($nElem, $regIni));

if ($rs) {
    echo "<center>
    <table class='listado'>
      <tr>
        <th>Nro</th><th>PERSONA</th><th>USUARIO</th>
        <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
      </tr>";

    $b = 0;
    $total = $pag - 1;
    $a = $nElem * $total;
    $b = $b + 1 + $a;

    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>".$b."</td>
                <td>".$fila['persona']."</td>                        
                <td>".$fila['usuario_principal']."</td>
                <td align='center'>
                    <form name='formModif".$fila['id_usuario']."' method='post' action='usuario_modificar.php'>
                        <input type='hidden' name='id_usuario' value='".$fila['id_usuario']."'>
                        <input type='hidden' name='id_persona' value='".$fila['id_persona']."'>
                        <a href='javascript:document.formModif".$fila['id_usuario'].".submit();' title='Modificar Usuario Sistema'>
                          Modificar &gt;&gt;
                        </a>
                    </form>
                </td>
                <td align='center'>  
                    <form name='formElimi".$fila['id_usuario']."' method='post' action='usuario_eliminar.php'>
                        <input type='hidden' name='id_usuario' value='".$fila['id_usuario']."'>
                        <a href='javascript:document.formElimi".$fila['id_usuario'].".submit();' title='Eliminar Persona Sistema' onclick='return confirm(\"Desea realmente Eliminar al usuario ".$fila['usuario_principal']."?\")'>
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
