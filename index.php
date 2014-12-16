<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Pruebas Mapa</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/leaflet.css" />
        <link rel="stylesheet" href="css/estilos.css" />
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/leaflet.js" type="text/javascript"></script>
        <script src="geojson/cruces.js" type="text/javascript"></script>
        <script src="geojson/horizontal.js" type="text/javascript"></script>
    </head>
    <body>

        <div id="mapCanvas"></div>

        <script>
            var map = L.map('mapCanvas').setView([40.419356, -3.693107], 15);


            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                subdomains: ['a', 'b', 'c'],
                maxZoom: 18
            }).addTo(map);

function aa(){
            L.geoJson([horizontal,cruces], {
                style: function (feature) {
                    return  {
                        weight: 2,
                        color: "#999",
                        opacity: 1,
                        fillColor: "#B0DE5C",
                        fillOpacity: 0.8
                    };
                },
                pointToLayer: function (feature, latlng) {
                    return L.circleMarker(latlng, {
                        radius: 8,
                        fillColor: "#ff7800",
                        color: "#000",
                        weight: 1,
                        opacity: 1,
                        fillOpacity: 0.8
                    });
                }
            }).addTo(map);
        }            
        </script>
    </body>
</html>