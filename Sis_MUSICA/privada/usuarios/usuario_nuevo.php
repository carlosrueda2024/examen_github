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
    <script src='js/validacion_usuarios.js'></script>
    <script src='../js/validacion_formularios.js'></script>
    <script type='text/javascript' src='js/buscar_persona.js'></script>
</head>
<body>
    <!-- Espaciado visual y encabezado de la página -->
    <p>&nbsp;</p>
    <h1>INSERTAR USUARIO</h1>";

// Prepara y ejecuta una consulta SQL para obtener personas activas de la base de datos
$sql = $db->Prepare("SELECT CONCAT_WS(' ', ap, am, nombres) as persona, id_persona
                    FROM personas
                    WHERE estado = 'A'");
$rs = $db->GetAll($sql);  // Obtiene todos los resultados de la consulta

// Inicia el formulario para insertar un nuevo usuario
echo "
    <form action='usuario_nuevo1.php' method='post' name='formu' class='form-container'>
        <!-- Contenedor para los campos de búsqueda -->
        <div class='form-group'>
            <input type='text' name='ap' placeholder='Paterno' size='10' onKeyUp='buscar()'>
        </div>
        <div class='form-group'>
            <input type='text' name='am' placeholder='Materno' size='10' onKeyUp='buscar()'>
        </div>
        <div class='form-group'>
            <input type='text' name='nombres' placeholder='Nombres' size='10' onKeyUp='buscar()'>
        </div>
        <div class='form-group'>
            <input type='text' name='ci' placeholder='Cédula' size='10' onKeyUp='buscar()'>
        </div>
        
        <!-- Área donde se mostrarán los resultados de la búsqueda de personas -->
        <div class='form-group full-width'>
            <div id='personas'></div>
        </div>

        <!-- Área donde se mostrará la persona seleccionada -->
        <div class='form-group full-width'>
            <div id='persona_seleccionado'></div>
        </div>

        <!-- Campo oculto para almacenar el ID de la persona seleccionada -->
        <div class='form-group full-width'>
            <input type='hidden' name='id_persona'>
            <div id='persona_insertada'></div>
        </div>

        <!-- Grupo de formulario para almacenar datos del usuario -->
        <div class='form-group'>
            <label for='usuario_principal'>(*)Nombre de usuario</label>
            <input type='text' name='usuario_principal' id='usuario_principal' size='10'>
        </div>
        <div class='form-group'>
            <label for='clave' >(*)Clave</label>
            <input type='password' name='clave' id='clave' size='10'>
        </div>

        <!-- Botones de acción: aceptar y cancelar -->
        <div class='full-width'>
            <input type='button' value='ACEPTAR' onclick='validarU();'>
            <input type='reset' value='CANCELAR'>
            <p>(*)Datos Obligatorios</p>  <!-- Nota sobre campos obligatorios -->
        </div>
    </form>
</body>
</html>";
?>
