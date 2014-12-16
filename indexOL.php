<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Pruebas Mapa OpenLayers 3</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/ol.css" />
        <link rel="stylesheet" href="css/estilos.css" />
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/ol.js" type="text/javascript"></script>
        <script src="geojson/horizontal.js" type="text/javascript"></script>
    </head>

    <body>

        <div id="mapCanvas"></div>

        <script>

            var map;

            function init() {
                map = new ol.Map({
                    target: 'mapCanvas',
                    renderer: 'canvas',
                    view: new ol.View({
                        projection: 'EPSG:3857',
                        center: ol.proj.transform([-3.693107, 40.419356], 'EPSG:4326', 'EPSG:3857'),
                        zoom: 12
                    })
                });

                var newLayer = new ol.layer.Tile({
                    source: new ol.source.OSM()
                });

                map.addLayer(newLayer);


                var styleCache = {};

                var geoLayer = new ol.layer.Vector({
                    source: new ol.source.GeoJSON({
                        projection: 'EPSG:900913',
                        url: './geojson/cruces.json'
                    }),
                    style: function (feature, resolution) {
                        var text = resolution < 5000 ? feature.get('name') : '';
                        if (!styleCache[text]) {
                            styleCache[text] = [new ol.style.Style({
                                    fill: new ol.style.Fill({
                                        color: 'rgba(255, 255, 255, 0.1)'
                                    }),
                                    stroke: new ol.style.Stroke({
                                        color: '#319FD3',
                                        width: 1
                                    }),
                                    text: new ol.style.Text({
                                        font: '12px Calibri,sans-serif',
                                        text: text,
                                        fill: new ol.style.Fill({
                                            color: '#000'
                                        }),
                                        stroke: new ol.style.Stroke({
                                            color: '#fff',
                                            width: 3
                                        })
                                    }),
                                    zIndex: 999
                                })];
                        }
                        return styleCache[text];
                    }
                });

                map.addLayer(geoLayer);
            }
        </script>
    </body>
</html>