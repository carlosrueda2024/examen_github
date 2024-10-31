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
    <script type='text/javascript' src='js/buscar_usuarios_visitas.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

    // Contador de registros y paginación
    contarRegistros($db, "usuarios_visitas");
    paginacion("usuarios_visitas.php?");

    // Formulario de búsqueda
    echo '
    <center>
        <h1>LISTADO DE USUARIOS VISITAS</h1>
        <a href="usuario_visita_nuevo.php" class="nuevo-boton">Nuevo Usuario Visita &gt;&gt;&gt;</a>
        <form action="#" method="post" name="formu">
            <input type="text" name="nom_usuario" placeholder="Nombre Usuario" onkeyup="buscar_usuarios_visitas();">
        </form>
    </center>';

    echo "<div id='tabla' class='listado-container'>";

    $sql3 = $db->Prepare("SELECT *
                          FROM usuarios_visitas
                          WHERE estado <> 'X'
                          ORDER BY id_usuario_visita DESC
                          LIMIT ? OFFSET ?");
    $rs = $db->GetAll($sql3, array($nElem, $regIni));

    if ($rs) {
        echo "<center>
        <table class='listado'>
          <tr>
            <th>Nro</th><th>NOMBRE USUARIO</th>
            <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
          </tr>";

        $b = 0;
        $total = $pag - 1;
        $a = $nElem * $total;
        $b = $b + 1 + $a;

        foreach ($rs as $k => $fila) {
            echo "<tr>
                    <td align='center'>".$b."</td>
                    <td>".$fila['nom_usuario']."</td>
                    <td align='center'>
                        <form name='formModif".$fila['id_usuario_visita']."' method='post' action='usuario_visita_modificar.php'>
                            <input type='hidden' name='id_usuario_visita' value='".$fila['id_usuario_visita']."'>
                            <a href='javascript:document.formModif".$fila['id_usuario_visita'].".submit();' title='Modificar Nombre Usuario Sistema'>
                              Modificar &gt;&gt;
                            </a>
                        </form>
                    </td>
                    <td align='center'>
                        <form name='formElimi".$fila['id_usuario_visita']."' method='post' action='usuario_visita_eliminar.php'>
                            <input type='hidden' name='id_usuario_visita' value='".$fila['id_usuario_visita']."'>
                            <a href='javascript:document.formElimi".$fila['id_usuario_visita'].".submit();' title='Eliminar Usuario Sistema' onclick='return confirm(\"Desea realmente Eliminar al usuario ".$fila['nom_usuario']." ?\")'>
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
