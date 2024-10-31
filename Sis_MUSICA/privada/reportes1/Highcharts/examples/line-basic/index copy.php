<?php
session_start();
require_once("../../../../../conexion.php");

// Consulta para obtener los grupos y la cantidad de opciones usando ADOdb
$sql = $db->Prepare("
    SELECT g.grupo, COUNT(o.id_opcion) AS num_opciones
    FROM grupos g
    LEFT JOIN opciones o ON g.id_grupo = o.id_grupo
    WHERE g.estado = 'A'
    AND o.estado='A'
    GROUP BY g.grupo
    ORDER BY g.id_grupo
");

$rs = $db->GetAll($sql);

$grupos = [];
$num_opciones = [];

// Procesar los resultados de la consulta
if (!empty($rs)) {
    foreach ($rs as $row) {
        $grupos[] = $row['grupo'];
        $num_opciones[] = (int)$row['num_opciones'];
    }
} else {
    echo "No se encontraron resultados.";
}
// Calcular el valor máximo en num_opciones y sumarle 1
$max_opciones = !empty($num_opciones) ? max($num_opciones) + 1 : 1;

?>

<!DOCTYPE HTML>
<html>
	<head>
		<!-- Declaración del tipo de documento HTML -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!-- Configuración de la visualización en dispositivos móviles -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Título de la página -->
		<title>Highcharts Example</title>

		<style type="text/css">
		/* Estilos para la figura del gráfico y la tabla de datos */
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
<!-- Inclusión de las librerías de Highcharts y módulos adicionales -->
<script src="../../code/highcharts.js"></script>
<script src="../../code/modules/series-label.js"></script>
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>
<script src="../../code/modules/accessibility.js"></script>

<!-- Contenedor para el gráfico -->
<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Gráfico de líneas básico que muestra la cantidad de opciones por grupo.
    </p>

</figure>

		<script type="text/javascript">
Highcharts.chart('container', {  // Inicializa el gráfico en el div con id "container"

    /* Comentado: Título original del gráfico */
    /*title: {
        text: 'U.S Solar Employment Growth',
        align: 'left'
    },*/

    // Título personalizado del gráfico
    title: {
        text: 'REPORTE GRÁFICO DE GRUPOS CON OPCIONES',
        align: 'left'
    },
    
    /* Comentado: Subtítulo original */
    /*subtitle: {
        text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
        align: 'left'
    },*/
    
    // Subtítulo personalizado del gráfico
    subtitle: {
        text: 'Elaborado por Carlos Rueda',
        align: 'left'
    },
    
    // Configuración del eje Y (vertical) con el título
    yAxis: {
        title: {
            text: 'Numero de Opciones'  // Texto del título del eje Y
        },
        min: 0,
        max: <?php echo $max_opciones; ?>  // Valor máximo dinámico basado en el número mayor de opciones + 1
    },

    // Configuración del eje X (horizontal)
    xAxis: {
        categories: <?php echo json_encode($grupos); ?>,  // Nombres de los grupos
        labels: {
            rotation: -45, // Rotar las etiquetas a 45 grados (puedes ajustar el ángulo)
            align: 'right' // Alineación a la derecha para que se vea mejor
        },
        accessibility: {
            rangeDescription: 'Range: Grupos'
        }
    },

    // Configuración de la leyenda (información sobre las series de datos)
    legend: {
        layout: 'vertical',         // Diseño de la leyenda en formato vertical
        align: 'right',             // Alineación a la derecha del gráfico
        verticalAlign: 'middle'     // Alineación vertical en el centro
    },

    // Configuración de las opciones de la serie de datos
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false  // No permite el uso de conectores para las etiquetas de las líneas
            },
            pointStart: 0  // Año de inicio de los datos en el eje X
        }
    },

    // Datos de las series (diferentes grupos con sus valores anuales)
    series: [{
        name: 'Numero de opciones',
        data: <?php echo json_encode($num_opciones); ?>
    }/*, {
        name: 'Manufacturing',  // Otra serie
        data: [24916, 37941, 29742, 29851, 32490, 30282,
            38121, 36885, 33726, 34243, 31050]
    }, {
        name: 'Sales & Distribution',  // Otra serie
        data: [11744, 30000, 16005, 19771, 20185, 24377,
            32147, 30912, 29243, 29213, 25663]
    }, {
        name: 'Operations & Maintenance',  // Otra serie (con valores nulos en los primeros años)
        data: [null, null, null, null, null, null, null,
            null, 11164, 11218, 10077]
    }, {
        name: 'Other',  // Otra serie
        data: [21908, 5548, 8105, 11248, 8989, 11816, 18274,
            17300, 13053, 11906, 10073]
    }*/],

    // Configuración para hacer que el gráfico sea responsive (adaptable a pantallas más pequeñas)
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500  // Si el ancho es menor que 500px
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',   // Cambia la leyenda a un formato horizontal
                    align: 'center',        // Centra la leyenda
                    verticalAlign: 'bottom' // Alinea la leyenda en la parte inferior
                }
            }
        }]
    }

});
		</script>
	</body>
</html>
