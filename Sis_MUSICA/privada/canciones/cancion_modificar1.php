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
$id_cancion = $_POST["id_cancion"];

// Obtener información actual de la canción
$sql = $db->Prepare("SELECT * FROM canciones WHERE id_cancion = ?");
$cancion_actual = $db->GetRow($sql, array($id_cancion));

// Verificar si se subió un nuevo archivo de música
if (isset($_FILES['nombre']) && $_FILES['nombre']['error'] === 0) {

    // Definir el directorio donde se almacenarán los archivos
    $directorio_destino = "musica/";
    $nombre_archivo = basename($_FILES['nombre']['name']);
    $ruta_archivo = $directorio_destino . $nombre_archivo;

    // Mover el archivo subido al servidor
    if (move_uploaded_file($_FILES['nombre']['tmp_name'], $ruta_archivo)) {

        // Crear una instancia de getID3 para analizar el archivo
        $getID3 = new getID3;
        $archivo_info = $getID3->analyze($ruta_archivo);

        // Obtener el nombre y duración del archivo
        $nombre = $nombre_archivo;  // Nombre del archivo subido

        // Obtener la duración del archivo en segundos
        if (isset($archivo_info['playtime_seconds'])) {
            $duracion_segundos = $archivo_info['playtime_seconds'];
            $duracion = gmdate("H:i:s", $duracion_segundos);
        } else {
            $duracion = '00:00:00'; // Valor por defecto si no se puede obtener
        }

    } else {
        echo "<div class='mensaje'><h1>Error al subir el archivo de música.</h1></div>";
        exit();
    }
} else {
    // Si no se subió un nuevo archivo, usar el existente
    $nombre = $cancion_actual['nombre']; // Usar el nombre del archivo existente
    $duracion = $cancion_actual['duracion']; // Usar la duración existente
}

// Actualizar la canción en la base de datos
$reg = array();
$reg["id_albun"] = $id_albun;
$reg["id_genero"] = $id_genero;
$reg["nombre"] = $nombre; // Nombre del archivo (nuevo o existente)
$reg["duracion"] = $duracion; // Duración del archivo (nuevo o existente)
$reg["anio_lanza"] = $_POST["anio_lanza"]; // Año de lanzamiento
$reg["usuario"] = $_SESSION["sesion_id_usuario"];   

$rs1 = $db->AutoExecute("canciones", $reg, "UPDATE", "id_cancion='" . $id_cancion . "'");
header("Location: canciones.php");
exit();

echo "</body></html>";
?>
