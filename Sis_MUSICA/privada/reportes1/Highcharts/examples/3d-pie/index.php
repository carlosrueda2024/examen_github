<?php
session_start();
require_once("../../../../../conexion.php");

// Consulta para obtener los grupos y la cantidad de opciones
$sql = $db->Prepare("
    SELECT g.grupo, COUNT(o.id_opcion) AS num_opciones
    FROM grupos g
    LEFT JOIN opciones o ON g.id_grupo = o.id_grupo
    WHERE g.estado = 'A'
    AND o.estado = 'A'
    GROUP BY g.grupo
    ORDER BY g.id_grupo
");
$rs = $db->GetAll($sql);  // Ejecuta la consulta y obtiene todos los resultados

// Inicializamos las variables para almacenar los valores de grupos y num_opciones en formato para Highcharts
$data_series = "";

// Usamos foreach para generar la cadena de datos para el gráfico de torta 3D
foreach ($rs as $fila) {
    $data_series .= "['" . $fila['grupo'] . "', " . $fila['num_opciones'] . "], ";
}

// Removemos la última coma y espacio en la cadena
$data_series = rtrim($data_series, ', ');
?>

<!DOCTYPE HTML>
<html>
<head>
    <!-- Declaración del tipo de documento HTML -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Configuración de la visualización en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Título de la página -->
    <title>Reporte 2: TORTA 3D GRUPOS CON OPCIONES-CARLOS RUEDA</title>

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
            text: 'REPORTE GRÁFICO DE TORTAS 3D GRUPOS CON OPCIONES',
            align: 'left'
        },
        subtitle: {
            text: 'Elaborado por Carlos Rueda',
            align: 'left'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Numero de opciones',
            data: [<?php echo $data_series; ?>] 
        }]
    });
</script>
</body>
</html>
