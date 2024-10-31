<?php
session_start();  
require_once("../../conexion.php");  
require_once("../../libreria_menu.php");  

// $db->debug=true; 

echo "<html>
<head>
    <!-- Enlaces a las hojas de estilo CSS -->
    <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_buscador.css' type='text/css'>
    <link rel='stylesheet' href='../../css/estilo_listado.css' type='text/css'>
    <link rel='stylesheet' href='../../css/formulario.css' type='text/css'>

    <script type='text/javascript' src='../../ajax.js'></script>
    <script src='../js/expresiones_regulares.js'></script>
    <script type='text/javascript' src='js/validacion_mensajes.js'></script>
    <script type='text/javascript' src='js/buscar_pastores.js'></script>
</head>
<body>
    <p>&nbsp;</p>  <!-- Espaciado visual -->
    <h1>INSERTAR MENSAJE</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', especialidad, cargo) as pastor, id_pastor
                    FROM pastores
                    WHERE estado = 'A'");
$rs = $db->GetAll($sql);  


echo "
    <form action='mensaje_nuevo1.php' method='post' name='formu' class='form-container'>
        <fieldset>
            <legend>Buscar Pastor</legend>
            <!-- Contenedor para los campos de búsqueda -->
            <div class='form-group'>
                <input type='text' name='especialidad' placeholder='Especialidad' size='10' onKeyUp='buscar()'>
            </div>
            <div class='form-group'>
                <input type='text' name='sueldo' placeholder='Sueldo' size='10' onKeyUp='buscar()'>
            </div>
            <div class='form-group'>
                <input type='text' name='cargo' placeholder='Cargo' size='10' onKeyUp='buscar()'>
            </div>

            <!-- Área donde se mostrarán los resultados de la búsqueda de pastores -->
            <div class='form-group full-width'>
                <div id='pastores'></div>
            </div>

            <!-- Área donde se mostrará el pastor seleccionado -->
            <div class='form-group full-width'>
                <div id='pastor_seleccionado'></div>
            </div>

            <!-- Campo oculto para almacenar el ID del pastor seleccionado -->
            <div class='form-group full-width'>
                <input type='hidden' name='id_pastor'>
                <div id='pastor_insertado'></div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Agregar Mensaje</legend>

            <!-- Grupo de formulario para almacenar datos del mensaje -->
            <div class='form-group'>
                <label for='nombre_mensaje'>(*)Nombre del Mensaje:</label>
                <input type='text' name='nombre_mensaje' id='nombre_mensaje' placeholder='(*) Nombre del Mensaje' size='30'>
            </div>
            <div class='form-group'>
                <label for='nombre_evento'>(*)Nombre del Evento:</label>
                <input type='text' name='nombre_evento' id='nombre_evento' placeholder='(*) Nombre del Evento' size='30'>
            </div>
            <div class='form-group'>
                <label for='fecha'>(*)Fecha:</label>
                <input type='date' name='fecha' id='fecha' placeholder='(*) Fecha y Hora'>
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
