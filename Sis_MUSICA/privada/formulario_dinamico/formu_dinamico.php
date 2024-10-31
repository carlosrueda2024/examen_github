<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

// Consulta para obtener los rubros
$sql_rubros = $db->Prepare("SELECT id_rubro, rubro FROM rubros WHERE estado = 'A'");
$rs_rubros = $db->GetAll($sql_rubros);

echo "<html>
<head>
    <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>
    <script src='../js/expresiones_regulares.js'></script>
    <script src='../js/validacion_formularios.js'></script>
    <script type='text/javascript'>
        function cargarCategorias() {
            var idRubro = document.formu.rubro.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'categorias.php?id_rubro=' + idRubro, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('categoria').innerHTML = xhr.responseText;
                    document.getElementById('formulario_activo').innerHTML = ''; // Limpiar el formulario cuando se cambia el rubro
                }
            };
            xhr.send();
        }

        function cargarActivos() {
            var idCategoria = document.formu.categoria.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'formulario_activo.php?id_categoria=' + idCategoria, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('formulario_activo').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <center>
        <h1>INSERTAR ACTIVO FIJO</h1>
        <form action='activo_nuevo1.php' method='post' name='formu' class='form-container'>
            <div class='form-group'>
                <label for='rubro'>(*) Seleccione Rubro:</label>
                <select name='rubro' id='rubro' onchange='cargarCategorias()'>
                    <option value=''>--Seleccione un Rubro--</option>";
                    foreach ($rs_rubros as $rubro) {
                        echo "<option value='".$rubro['id_rubro']."'>".$rubro['rubro']."</option>";
                    }
                    echo "</select>
            </div>
            <div class='form-group'>
                <label for='categoria'>(*) Seleccione Categoría:</label>
                <select name='categoria' id='categoria' onchange='cargarActivos()'>
                    <option value=''>--Seleccione una Categoría--</option>
                </select>
            </div>
            <div id='formulario_activo'></div>
        </form>
    </center>
</body>
</html>";
?>
