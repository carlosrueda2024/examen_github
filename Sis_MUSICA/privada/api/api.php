<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa en Pantalla Completa con Ubicación Actual</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <style>
        /* Asegura que el cuerpo y el HTML ocupen todo el espacio disponible */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* El contenedor del mapa también debe ocupar el 100% de la pantalla */
        #map {
            height: 100%;
            width: 100%;
        }

        /* Estilo para el botón de ubicación */
        #ubicacion-btn {
            position: absolute;
            bottom: 10px;  /* Cambiado de top a bottom */
            right: 10px;
            z-index: 1000; /* Aseguramos que el botón quede sobre el mapa */
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Cambio de color al pasar el mouse por el botón */
        #ubicacion-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Botón para centrar en la ubicación actual -->
    <button id="ubicacion-btn">Ir a Mi Ubicación</button>

    <div id="map"></div> <!-- Mapa en pantalla completa -->

    <script>
        var map = L.map('map').setView([0, 0], 2);  // Inicializar el mapa

        // Definición de capas de mapas
        var streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);  // Capa de calles

        var satelliteLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://opentopomap.org/copyright">OpenTopoMap</a>',
            maxZoom: 17
        });

        var satelliteImageryLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; <a href="https://www.esri.com">Esri</a>, Maxar, Earthstar Geographics, and the GIS User Community',
            maxZoom: 19
        });

        // Capa de mapa inicial
        var baseMaps = {
            "Calle": streetLayer,
            "Satélite": satelliteLayer,
            "Imágenes Satelitales": satelliteImageryLayer
        };

        // Control de capas
        L.control.layers(baseMaps).addTo(map);

        var userMarker;  // Marcador de usuario
        var routingControl;  // Control de enrutamiento
        var lat, lng;  // Variables para la ubicación actual

        // Función para obtener la ubicación del usuario
        function localizarUsuario() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    lat = position.coords.latitude;
                    lng = position.coords.longitude;

                    // Centrar el mapa en la ubicación del usuario
                    map.setView([lat, lng], 13);

                    // Añadir un marcador en la ubicación actual del usuario
                    if (userMarker) {
                        map.removeLayer(userMarker);  // Eliminar el marcador anterior si ya existe
                    }
                    userMarker = L.marker([lat, lng]).addTo(map);
                    userMarker.bindPopup("<b>Estás aquí</b>").openPopup();

                }, function(error) {
                    alert("No se pudo obtener la ubicación.");
                });
            } else {
                alert("La geolocalización no está soportada por tu navegador.");
            }
        }

        // Función para centrar el mapa en la ubicación actual cuando se hace clic en el botón
        document.getElementById('ubicacion-btn').addEventListener('click', function() {
            if (lat && lng) {
                map.setView([lat, lng], 13);  // Centrar el mapa en las coordenadas guardadas
                if (userMarker) {
                    userMarker.openPopup();  // Mostrar el popup del marcador
                }
            } else {
                alert("Ubicación no disponible aún.");
            }
        });

        // Función para seleccionar un destino en el mapa
        function seleccionarDestino(e) {
            var destino = e.latlng;

            // Si ya hay una ruta, eliminarla
            if (routingControl) {
                map.removeControl(routingControl);
            }

            // Crear una nueva ruta desde la ubicación del usuario al destino seleccionado
            routingControl = L.routing.control({
                waypoints: [
                    L.latLng(userMarker.getLatLng().lat, userMarker.getLatLng().lng),
                    L.latLng(destino.lat, destino.lng)
                ],
                routeWhileDragging: true,
                geocoder: L.Control.Geocoder.nominatim() // Aquí se utiliza la función de geocodificación
            }).addTo(map);
        }

        // Evento para hacer clic en el mapa y seleccionar el destino
        map.on('click', seleccionarDestino);

        // Llamar a la función para localizar al usuario
        localizarUsuario();
    </script>
</body>
</html>
