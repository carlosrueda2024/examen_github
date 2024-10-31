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
    <script type='text/javascript' src='js/buscar_personas.js'></script>
</head>
<body>
    <p>&nbsp;</p>";

    // Contador de registros y paginación
    contarRegistros($db, "personas");
    paginacion("personas.php?");

    // Formulario de búsqueda
    echo '
    <center>
        <h1>LISTADO DE PERSONAS</h1>
        <a href="persona_nuevo.php" class="nuevo-boton">Nueva Persona &gt;&gt;&gt;</a>
        <form action="#" method="post" name="formu">
            <input type="text" name="ap" placeholder="Paterno" onkeyup="buscar_personas();">
            <input type="text" name="am" placeholder="Materno" onkeyup="buscar_personas();">
            <input type="text" name="nombres" placeholder="Nombres" onkeyup="buscar_personas();">
            <input type="text" name="ci" placeholder="C.I." onkeyup="buscar_personas();">
            <input type="date" name="fec_insercion" onchange="buscar_personas();">
        </form>
    </center>';

    echo "<div id='tabla' class='listado-container'>";

    $sql3 = $db->Prepare("SELECT *
                          FROM personas
                          WHERE estado <> 'X'
                          ORDER BY id_persona DESC
                          LIMIT ? OFFSET ?");
    $rs = $db->GetAll($sql3, array($nElem, $regIni));

    if ($rs) {
        echo "<center>
        <table class='listado'>
          <tr>
            <th>Nro</th><th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES</th><th>TELEFONO</th><th>DIRECCION</th>
            <th><img src='../../imagenes/modificar.gif' alt='Modificar'></th><th><img src='../../imagenes/borrar.jpeg' alt='Eliminar'></th>
          </tr>";

        $b = 0;
        $total = $pag - 1;
        $a = $nElem * $total;
        $b = $b + 1 + $a;

        foreach ($rs as $k => $fila) {
            echo "<tr>
                    <td align='center'>".$b."</td>
                    <td align='center'>".$fila['ci']."</td>
                    <td>".$fila['ap']."</td>
                    <td>".$fila['am']."</td>
                    <td>".$fila['nombres']."</td>
                    <td>".$fila['telefono']."</td>
                    <td>".$fila['direccion']."</td>
                    <td align='center'>
                        <form name='formModif".$fila['id_persona']."' method='post' action='persona_modificar.php'>
                            <input type='hidden' name='id_persona' value='".$fila['id_persona']."'>
                            <a href='javascript:document.formModif".$fila['id_persona'].".submit();' title='Modificar Persona Sistema'>
                              Modificar &gt;&gt;
                            </a>
                        </form>
                    </td>
                    <td align='center'>
                        <form name='formElimi".$fila['id_persona']."' method='post' action='persona_eliminar.php'>
                            <input type='hidden' name='id_persona' value='".$fila['id_persona']."'>
                            <a href='javascript:document.formElimi".$fila['id_persona'].".submit();' title='Eliminar Persona Sistema' onclick='return confirm(\"Desea realmente Eliminar a la persona ".$fila['nombres']." ".$fila['ap']." ".$fila['am']." ?\")'>
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
