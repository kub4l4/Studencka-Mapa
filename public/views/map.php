<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <link rel="stylesheet" type="text/css" href="public/css/map.css">


    <style>

</style>
</head>

<body>
    <div id = "map"></div>
    <script>

        var map = L.map ('map').setView([50.06,19.94],14);
        L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=uBf51zOK4P3YedN0PRlg', {
            attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
        }).addTo(map);


        var LeaffletIcon = L.Icon.extend({
            options:{
                iconSize: [38,95],
                iconAnchor: [22,94],
                popupAnchor: [12,-90],
                shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
                shadowSize: [50,64],
                shadowAnchor: [4,62]
            }
        })
        var greenIcon = new LeaffletIcon({iconUrl:'https://leafletjs.com/examples/custom-icons/leaf-green.png'}),
            redIcon = new LeaffletIcon({iconUrl:'https://leafletjs.com/examples/custom-icons/leaf-red.png'}),
            orageIcon = new LeaffletIcon({iconUrl:'https://leafletjs.com/examples/custom-icons/leaf-orange.png'})


        var leafletIcon1 = L.icon({
            iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
            iconSize: [38,95],
            iconAnchor: [22,94],
            popupAnchor: [12,-90],
            shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
            shadowSize: [50,64],
            shadowAnchor: [4,62]
        });


        var marker = L.marker([50,11.1], {icon:greenIcon}).addTo(map);
        var marker = L.marker([51,11.1], {icon:redIcon}).addTo(map);
        var marker = L.marker([52,11.1], {icon:orageIcon}).addTo(map);
        var marker = L.marker([53,11.1], {icon:leafletIcon1}).addTo(map);

        var marker2 = L.marker([55.5,11.1]).addTo(map);


        var circle = L.circle ([51.508, 11.11],{
            color: ' red',
            fillColor: '#ff0033',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);

        var polygon = L.polygon ([
            [51.509, 11.1],
            [51.503, 11.2],
            [51.51, 11.047]
        ]).addTo(map);


        L.control.scale({
            metric: true,
            imperial: false,
            posiotion: 'bottomleft'
        }).addTo (map);

        L.Control.Watermark = L.Control.extend({
            onAdd: function (map){
                var img = L.DomUtil.create('img');
                img.src='img/logo.svg';
                img.style.width = '100px';
                return img;
            },
            onRemove:function(map){},
        });

        L.control.watermark = function(opts){
            return new L.Control.Watermark(opts);
        }

        L.control.watermark({
            position: 'bottomright'
        }).addTo(map);

        //marker2.bindPopup("<b> Hey There!</b><br>Marker here").openPopup();

    </script>
</body>
</html>