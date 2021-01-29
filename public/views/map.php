<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

    <link rel="stylesheet" type="text/css" href="public/css/map.css">


</head>
<body>

<div id="map"></div>

<script>
    var map = L.map('map').setView([50.06, 19.94], 14);

    L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=uBf51zOK4P3YedN0PRlg', {
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a>' +
            ' <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
    }).addTo(map);


    L.Control.Watermark = L.Control.extend({
        onAdd: function (map) {
            const img = L.DomUtil.create('img');
            img.src = '/public/img/logo.svg';
            img.style.width = '20em';
            return img;
        },
        onRemove: function (map) {
        },
    });
    L.control.watermark = function (opts) {
        return new L.Control.Watermark(opts);
    }
    L.control.watermark({position: 'bottomright'}).addTo(map);


    <?php foreach ($points as $point): ?>
    var marker2 = L.marker(["<?= $point->getSzerokosc(); ?>", "<?= $point->getDlugosc(); ?>"]).addTo(map);
    <?php endforeach; ?>


    var budynki = L.geoJSON().addTo(map);
    $.getJSON("/public/geojson/budynki.geojson", function (data) {
        budynki.addData(data);
    });


    var baseLayers = {};


    var overlays = {
        "budynki": budynki
    };

    L.control.layers(baseLayers, overlays).addTo(map);


    /*
    WA.bindPopup(function (layer) {
    return layer.feature.properties.description;
    }).addTo(map);
    */
</script>

</body>
</html>