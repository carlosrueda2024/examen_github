<?php
session_start();
require_once("../../../../../conexion.php");

// Consulta para obtener el promedio de valoraciones de canciones por género
$sql = $db->Prepare("
    SELECT g.nombre AS genero, AVG(v.valoracion) AS avg_valoracion
    FROM canciones c
    JOIN generos g ON c.id_genero = g.id_genero
    JOIN valoraciones v ON c.id_cancion = v.id_cancion
    WHERE c.estado = 'A' AND g.estado = 'A' AND v.estado = 'A'
    GROUP BY g.nombre
    ORDER BY g.nombre
");
$rs = $db->GetAll($sql);  // Ejecuta la consulta y obtiene todos los resultados

// Inicializamos las variables para almacenar los valores de géneros y promedio de valoraciones
$generos = "";
$avg_valoraciones = "";
$max_valoracion = 0;

// Usamos foreach para generar las cadenas de categorías (géneros) y datos (promedio de valoraciones)
foreach ($rs as $fila) {
    $generos .= "'".$fila['genero']."', ";  // Agregamos el género a la cadena
    $avg_valoraciones .= number_format($fila['avg_valoracion'], 2, '.', '').", ";  // Formateamos el promedio a 2 decimales

    // Calculamos el valor máximo de promedio de valoraciones
    if ((float)$fila['avg_valoracion'] > $max_valoracion) {
        $max_valoracion = (float)$fila['avg_valoracion'];
    }
}

// Removemos la última coma y espacio en las cadenas
$generos = rtrim($generos, ', ');
$avg_valoraciones = rtrim($avg_valoraciones, ', ');
$max_valoracion = ceil($max_valoracion) + 1;  // Ajuste del valor máximo añadiendo 1
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Promedio de Valoraciones de Canciones por Género</title>

        <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
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
        <script src="../../code/highcharts.js"></script>
        <script src="../../code/modules/series-label.js"></script>
        <script src="../../code/modules/exporting.js"></script>
        <script src="../../code/modules/export-data.js"></script>
        <script src="../../code/modules/accessibility.js"></script>

        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
                Gráfico de líneas que muestra el promedio de valoraciones de canciones por género musical.
            </p>
        </figure>

        <script type="text/javascript">
        Highcharts.chart('container', {
            title: {
                text: 'Promedio de Valoraciones de Canciones por Género',
                align: 'left'
            },
            subtitle: {
                text: 'Elaborado por Carlos Rueda',
                align: 'left'
            },
            yAxis: {
                title: {
                    text: 'Valoración Promedio'
                },
                min: 0,
                max: <?php echo $max_valoracion; ?>
            },
            xAxis: {
                categories: [<?php echo $generos; ?>],
                labels: {
                    rotation: -45,
                    align: 'right'
                },
                accessibility: {
                    description: 'Géneros musicales'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 0
                }
            },
            series: [{
                name: 'Valoración Promedio',
                data: [<?php echo $avg_valoraciones; ?>]
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        </script>
    </body>
</html>
