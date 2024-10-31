<?php
session_start();
require_once("../../conexion.php");
require_once('./librerias/getid3/getid3/getid3.php');  // Incluir la librería getID3

$db->debug = true;

echo "<html>
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_albun = $_POST["id_albun"];
$id_genero = $_POST["id_genero"];
$anio_lanza = $_POST["anio_lanza"];

/*var_dump($_FILES['nombre']);
var_dump($id_albun);
var_dump($id_genero);
var_dump($anio_lanza);*/

echo "Error del archivo: " . $_FILES['nombre']['error'];


// Verificamos si el archivo ha sido enviado correctamente
if (isset($_FILES['nombre']) && $_FILES['nombre']['error'] === 0 && ($id_albun != "") && ($id_genero != "")) {

    // Definir el directorio donde se almacenarán los archivos
    $directorio_destino = "musica/";

    // Obtenemos el nombre original del archivo
    $nombre_archivo = basename($_FILES['nombre']['name']);

    // Definir la ruta completa del archivo
    $ruta_archivo = $directorio_destino . $nombre_archivo;

    // Movemos el archivo subido al servidor
    if (move_uploaded_file($_FILES['nombre']['tmp_name'], $ruta_archivo)) {

        // Crear una instancia de getID3
        $getID3 = new getID3;

        // Analizar el archivo de audio
        $archivo_info = $getID3->analyze($ruta_archivo);

        // Obtener la duración del archivo en segundos
        if (isset($archivo_info['playtime_seconds'])) {
            $duracion_segundos = $archivo_info['playtime_seconds'];

            // Convertir la duración a formato de horas, minutos y segundos
            $duracion = gmdate("H:i:s", $duracion_segundos);
        } else {
            $duracion = '00:00:00'; // Si no se puede obtener la duración, se asigna un valor por defecto
        }

        // Insertar los datos en la base de datos
        $reg = array();
        $reg["id_sistema_musica"] = 1;  // Asumiendo un sistema de música por defecto
        $reg["id_albun"] = $id_albun;
        $reg["id_genero"] = $id_genero;
        $reg["nombre"] = $nombre_archivo;  // Guardamos el nombre del archivo como el nombre de la canción
        $reg["duracion"] = $duracion;  // Duración del archivo
        $reg["anio_lanza"] = $anio_lanza;
        $reg["fec_insercion"] = date("Y-m-d H:i:s");
        $reg["estado"] = 'A';
        $reg["usuario"] = $_SESSION["sesion_id_usuario"];  // Asumiendo que tienes este valor en sesión

        // Ejecutar la inserción
        $rs1 = $db->AutoExecute("canciones", $reg, "INSERT");

        // Redirigir a la lista de canciones después de la inserción
        header("Location: canciones.php");
        exit();

    } else {
        // Error al mover el archivo
        echo "<div class='mensaje'><h1>Error al subir el archivo de música.</h1></div>";
    }

} else {
    echo "<div class='mensaje'>";
    echo "<h1>No se insertaron los datos de la canción o no se subió el archivo correctamente.</h1>";
    echo "<a href='cancion_nuevo.php'>
              <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER >>>>'>
          </a>";
    echo "</div>";
}

echo "</body></html>";
?>
