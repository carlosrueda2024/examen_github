<?php
if (isset($_SESSION["sesion_id_rol"])) {
    // Obtener nombre y logotipo del sistema
    $sql1 = $db->Prepare("SELECT nombre, logotipo
                          FROM sistema_musica
                          WHERE id_sistema_musica = 1
                          AND estado <> 'X'");
    $rs1 = $db->GetAll($sql1);
    $nombre = $rs1[0]["nombre"];
    $logotipo = $rs1[0]["logotipo"];

    $dir_php = $_SERVER["PHP_SELF"];
    $cuerp = strpos($dir_php, "listado_tablas.php");

    $sql = $db->Prepare("SELECT ac.*, op.id_opcion, op.orden, op.contenido, gr.id_grupo, gr.grupo, op.opcion 
                         FROM accesos ac
                         INNER JOIN opciones op ON ac.id_opcion = op.id_opcion
                         INNER JOIN grupos gr ON op.id_grupo = gr.id_grupo
                         WHERE ac.id_rol = '".$_SESSION["sesion_id_rol"]."'
                         AND ac.estado <> 'X'
                         AND op.estado <> 'X'
                         AND gr.estado <> 'X'
                         ORDER BY op.id_grupo, op.orden");
    $rs = $db->Execute($sql);

    $sql2 = $db->Prepare("SELECT ac.*, op.id_opcion, op.orden, op.contenido, gr.id_grupo, gr.grupo, op.opcion 
                          FROM accesos ac
                          INNER JOIN opciones op ON ac.id_opcion = op.id_opcion
                          INNER JOIN grupos gr ON op.id_grupo = gr.id_grupo
                          WHERE ac.id_rol = '".$_SESSION["sesion_id_rol"]."'
                          AND ac.estado <> 'X'
                          AND op.estado <> 'X'
                          AND gr.estado <> 'X'
                          ORDER BY op.id_grupo, op.orden");
    $rs2 = $db->Execute($sql2);
    $nick = $_SESSION["sesion_usuario"];
} else {
    $rs = "";
    $rs2 = "";
    $nick = "";
}

echo "<html>
<head>";
if ($cuerp == false)
    echo "<link rel='stylesheet' href='../../css/menu_desplegable.css' type='text/css'>";
else
    echo "<link rel='stylesheet' href='css/menu_desplegable.css' type='text/css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
echo "</head>
<body id='particles-js'>";

if ($nick != "") {
    echo "<div class='cabecera'>";
    if ($cuerp == false) {
        echo "<img src='../tienda_ropa/logos/{$logotipo}' width='10%' >";
    } else {
        echo "<img src='privada/tienda_ropa/logos/{$logotipo}' width='10%' >";
    }
    echo "<div class='titulo'>";
    echo "SISTEMA WEB {$nombre}";
    echo "</div>";
    echo "<div class='usuario'>";
    echo " &nbsp;&nbsp;  &nbsp;&nbsp; USUARIO: <b>".$_SESSION["sesion_usuario"]."</b>  &nbsp;&nbsp; ";
    echo "ROL:<b> ".$_SESSION["sesion_rol"]."</b>";
    echo "</div>";
    echo "</div>";
    echo "<div style='position:fixed; bottom:10px; z-index:9; right:10px; background: #01FFFF; padding:2px 10px; font-size:30px; border-radius:20px'>
          VISITAS: ".$_SESSION["contador"]."</div>";

    echo "<div id='header'>
            <div class='menu-toggle' id='menu-toggle'>
                <div class='bar'></div>
                <div class='bar'></div>
                <div class='bar'></div>
            </div>
            <ul class='nav'>";

    $grup = "";
    foreach ($rs as $r => $fila) {
        echo "<li>";
        if ($grup != $fila["grupo"]) {
            echo "<a onclick='location.href=\"#\"' style='cursor:pointer;'>".$fila["grupo"]."</a>";
            $grup = $fila["grupo"];
        }
        echo "<ul>";
        foreach ($rs2 as $t => $fila2) {
            if ($grup == $fila2["grupo"]) {
                if ($cuerp == false or $cuerp == "") {
                    echo "<li><a onclick='location.href=\"../".$fila2["contenido"]."\"' style='cursor:pointer;'>".$fila2["opcion"]."</a></li>";
                } else {
                    echo "<li><a onclick='location.href=\"Sis_tienda_RUEDA/".$fila2["contenido"]."\"' style='cursor:pointer;'>".$fila2["opcion"]."</a></li>";
                }
            }
        }
        echo "</ul>";
        echo "</li>";
    }
    echo "</ul>";
    if ($cuerp == false) {
        echo "<a onclick='location.href=\"../../validar.php\"'><input type='button' name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
    } else {
        echo "<a onclick='location.href=\"validar.php\"'><input type='button' name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight: bold;height: 25px;margin-left: 35px;' class='boton_cerrar'></a>";
    }
    echo "</ul>
        </div>";
    echo "<script src='https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js'></script>
          <script src='js/menu.js'></script>";
}
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var menuToggle = document.getElementById('menu-toggle');
    var nav = document.querySelector('.nav');

    menuToggle.addEventListener('click', function() {
        menuToggle.classList.toggle('active');
        nav.classList.toggle('active');
    });
});
</script>
</body>
</html>
