<?php
session_start();  // Inicia una nueva sesión o reanuda la sesión existente
require_once("../../conexion.php");  // Incluye el archivo de conexión a la base de datos
require_once("../../libreria_menu.php");  // Incluye una librería de menús

// Configuración para depurar (desactivado por defecto)
// $db->debug=true;

// Inicia la generación del HTML
echo "<html>
<head>
    <!-- Enlaces a las hojas de estilo CSS -->
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_buscador.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_listado.css' type='text/css'>
    <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>

    <script type='text/javascript' src='../../ajax.js'></script>
    <script src='../js/expresiones_regulares.js'></script>
    <script type='text/javascript' src='js/validacion_tortas.js'></script>
    <script type='text/javascript' src='js/buscar_heladeria.js'></script>
</head>
<body>
    <!-- Espaciado visual y encabezado de la página -->
    <p>&nbsp;</p>
    <h1>INSERTAR TORTA</h1>";

// Prepara y ejecuta una consulta SQL para obtener personas activas de la base de datos
$sql = $db->Prepare("SELECT CONCAT_WS(' ', nombre_heladeria_pasteleria, direccion, telefono) as heladeria, id
                    FROM heladeria_pasteleria");
$rs = $db->GetAll($sql);  // Obtiene todos los resultados de la consulta

// Inicia el formulario para insertar un nuevo usuario
echo "
    <form action='torta_nuevo1.php' method='post' name='formu' class='form-container'>
        <fieldset>
            <legend>Buscar Heladeria</legend>
            <!-- Contenedor para los campos de búsqueda -->
            <div class='form-group'>
                <input type='text' name='nombre_heladeria_pasteleria' placeholder='Nombre' size='10' onKeyUp='buscar()'>
            </div>
            <div class='form-group'>
                <input type='text' name='direccion' placeholder='Direccion' size='10' onKeyUp='buscar()'>
            </div>
            <div class='form-group'>
                <input type='text' name='telefono' placeholder='Telefono' size='10' onKeyUp='buscar()'>
            </div>

            <!-- Área donde se mostrarán los resultados de la búsqueda de personas -->
            <div class='form-group full-width'>
                <div id='heladeria_pasteleria'></div>
            </div>

            <!-- Área donde se mostrará la persona seleccionada -->
            <div class='form-group full-width'>
                <div id='heladeria_seleccionada'></div>
            </div>

            <!-- Campo oculto para almacenar el ID de la persona seleccionada -->
            <div class='form-group full-width'>
                <input type='hidden' name='id'>
                <div id='heladeria_insertada'></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Agregar Torta</legend>

            <!-- Grupo de formulario para almacenar datos del usuario -->
            <div class='form-group'>
                <input type='text' name='nombre' placeholder='(*) Nombre' id='nombre' size='10'>
            </div>
            <div class='form-group'>
                <input type='text' name='cantidad' placeholder='(*) Cantidad' id='cantidad' size='10'>
            </div>
            <div class='form-group'>
                <input type='text' name='precio' id='precio' placeholder='(*) Precio' size='10'>
            </div>
            <!-- Botones de acción: aceptar y cancelar -->
            <div class='full-width'>
                <input type='button' value='ACEPTAR' onclick='validar();'>
                <input type='reset' value='CANCELAR'>
                <p>(*)Datos Obligatorios</p>  <!-- Nota sobre campos obligatorios -->
            </div>
        </fieldset>

    </form>
</body>
</html>";
?>
