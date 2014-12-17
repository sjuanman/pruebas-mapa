<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Pruebas Mapa OpenLayers 3</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/ol.css" />
        <link rel="stylesheet" href="css/estilos.css" />
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/ol.js" type="text/javascript"></script>
    </head>

    <body>

        <div id="mapCanvas"></div>

        <script>

            var map;

            var aa;

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


                var styles = {
                    0: new ol.style.Style({
                        fill: new ol.style.Fill({
                            color: 'rgba(255, 0, 0, 0.5)'
                        }),
                        stroke: new ol.style.Stroke({
                            width: 1,
                            color: 'rgba(255, 0, 0, 1)'
                        })
                    }),
                    1: new ol.style.Style({
                        fill: new ol.style.Fill({
                            color: 'rgba(0, 255, 0, 0.5)'
                        }),
                        stroke: new ol.style.Stroke({
                            width: 1,
                            color: 'rgba(0, 255, 0, 1)'
                        })
                    }),
                    2: new ol.style.Style({
                        fill: new ol.style.Fill({
                            color: 'rgba(0, 0, 255, 0.5)'
                        }),
                        stroke: new ol.style.Stroke({
                            width: 1,
                            color: 'rgba(0, 0, 255, 1)'
                        })
                    })
                };

                var geoLayer = new ol.layer.Vector({
                    source: new ol.source.GeoJSON({
                        projection: 'EPSG:3857',
                        url: './geojson/cruces.json'
                    }),
                    style: function (feature) {
                        var aux = feature.get('REGULADOR') % 3;
                        var s = styles[aux];
                        return [s];
                    }
                });
                aa = styles;
                map.addLayer(geoLayer);
            }

            function montaVector() {
                var sol = {};
                var f = map.getLayers().getArray()[1].getSource().getFeatures();

                for (var i = 0; i < f.length; i++) {

                    sol[f[i].get('IDELEM')] = f[i];
                }

                return sol;
            }

            function cambiaColores(v) {

                for (var i in v) {
                    v[i].set('REGULADOR', Math.round(Math.random() * 100));
                }
            }
        </script>
    </body>
</html>