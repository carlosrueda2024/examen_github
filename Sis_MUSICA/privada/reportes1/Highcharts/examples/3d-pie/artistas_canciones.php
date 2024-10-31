<?php
session_start();
require_once("../../../../../conexion.php");

// Consulta para obtener los artistas y la duración máxima de sus canciones
$sql = $db->Prepare("
    SELECT 
        ar.nombre_artistico AS artista,
        MAX(TIME_TO_SEC(c.duracion)) / 60 AS max_duracion_minutos
    FROM canciones c
    JOIN generos g ON c.id_genero = g.id_genero
    JOIN artistas ar ON g.id_genero = ar.id_genero
    WHERE c.estado = 'A'
    AND g.estado = 'A'
    AND ar.estado = 'A'
    GROUP BY ar.id_artista
");


/*
Cantidad de usuarios por sistema de música:

Cantidad de usuarios registrados por cada sistema de música.
Utiliza la tabla usuarios_visitas y agrupa por id_sistema_musica.
Número de canciones por género musical:

Cantidad de canciones por cada género musical.
Usa la tabla canciones y agrupa por id_genero.



Número de canciones por año de lanzamiento:

Distribución de canciones según el año de lanzamiento.
Usa la tabla canciones y agrupa por anio_lanza.


Valoraciones promedio por canción:

Calcula el promedio de valoraciones recibidas por cada canción.
Usa las tablas valoraciones y canciones para calcular esto.
Detalles de reproducción por lista de reproducción:

Cantidad de reproducciones por cada lista de reproducción.
Usa la tabla detalles_reproduccion y agrupa por id_lista_reproduccion.
*/



















// Ejecuta la consulta y verifica si devuelve resultados
$rs = $db->GetAll($sql);

if ($rs === false) {
    // Si la consulta falla, muestra un mensaje de error
    echo "Error al ejecutar la consulta.";
    exit;
}

// Inicializamos las variables para almacenar los valores de artista y duración máxima en formato para Highcharts
$data_series = "";

// Usamos foreach para generar la cadena de datos para el gráfico de torta 3D
foreach ($rs as $fila) {
    $data_series .= "['" . $fila['artista'] . "', " . $fila['max_duracion_minutos'] . "], ";
}

// Removemos la última coma y espacio en la cadena
$data_series = rtrim($data_series, ', ');
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte 4: TORTA 3D DURACIÓN MÁXIMA DE CANCIONES POR ARTISTA</title>

    <style type="text/css">
        #container {
            height: 400px;
        }
        .highcharts-figure, .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }
        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
</head>
<body>
<!-- Inclusión de las librerías de Highcharts y módulos adicionales -->
<script src="../../code/highcharts.js"></script>
<script src="../../code/highcharts-3d.js"></script>
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>
<script src="../../code/modules/accessibility.js"></script>

<!-- Contenedor para el gráfico -->
<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
    </p>
</figure>

<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'REPORTE GRAFICO TORTAS 3D DURACIÓN MÁXIMA DE CANCIONES POR ARTISTA',
            align: 'left'
        },
        subtitle: {
            text: 'Reporte elaborado por Carlos Rueda',
            align: 'left'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:.2f} min'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Duración máxima',
            data: [<?php echo $data_series; ?>] 
        }]
    });
</script>
</body>
</html>
