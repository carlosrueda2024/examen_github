<?php
session_start();
require_once("../../../../../conexion.php");

// Consulta para obtener las canciones y la cantidad de valoraciones
$sql = $db->Prepare("
    SELECT c.nombre AS cancion, COUNT(v.id_valoracion) AS num_valoraciones
    FROM valoraciones v
    JOIN canciones c ON v.id_cancion = c.id_cancion
    GROUP BY c.nombre
    ORDER BY num_valoraciones DESC
");
$rs = $db->GetAll($sql);  // Ejecuta la consulta y obtiene todos los resultados

// Inicializamos las variables para almacenar los valores de canciones y num_valoraciones
$canciones = "";
$num_valoraciones = "";

// Usamos foreach para generar las cadenas de categorías (canciones) y datos (número de valoraciones)
foreach ($rs as $fila) {
    $canciones .= "'".$fila['cancion']."', ";  // Agregamos la canción a la cadena
    $num_valoraciones .= $fila['num_valoraciones'].", ";  // Agregamos el número de valoraciones a la cadena
}

// Removemos la última coma y espacio en las cadenas
$canciones = rtrim($canciones, ', ');
$num_valoraciones = rtrim($num_valoraciones, ', ');

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Highcharts Example</title>

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
    <script src="../../code/modules/exporting.js"></script>
    <script src="../../code/modules/export-data.js"></script>
    <script src="../../code/modules/accessibility.js"></script>

    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Este gráfico muestra la distribución de valoraciones de canciones utilizando un eje Y logarítmico.
        </p>
    </figure>

    <script type="text/javascript">
    Highcharts.chart('container', {
        title: {
            text: 'Distribución de Valoraciones de Canciones'
        },

        xAxis: {
            title: {
                text: 'Canción'
            },
            categories: [<?php echo $canciones; ?>],
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },

        yAxis: {
            title: {
                text: 'Número de Valoraciones'
            },
            type: 'logarithmic',
            minorTickInterval: 0.1,
            accessibility: {
                rangeDescription: 'Rango: 0.1 a máximo valor'
            }
        },

        tooltip: {
            headerFormat: '<b>{series.name}</b><br />',
            pointFormat: '{point.x}: {point.y}'
        },

        series: [{
            name: 'Valoraciones',
            data: [<?php echo $num_valoraciones; ?>]
        }]
    });
    </script>
    </body>
</html>
