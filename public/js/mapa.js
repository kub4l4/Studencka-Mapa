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
L.control.watermark = function(opts) {
    return new L.Control.Watermark(opts);
}
L.control.watermark({ position: 'bottomright' }).addTo(map);


var bydynki = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/budynki.geojson",function(data){
    bydynki.addData(data);
});

var jednostkiPozawydzialowe = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/Jednostki_pozawydzialowe.geojson",function(data){
    jednostkiPozawydzialowe.addData(data);
});

var WA = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/WA.geojson",function(data){
    WA.addData(data);
});

var WIEIK = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/WIEIK.geojson",function(data){
    WIEIK.addData(data);
});

var WIIT = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/WIIT.geojson",function(data){
    WIIT.addData(data);
});

var WIITCH = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/WIITCH.geojson",function(data){
    WIITCH.addData(data);
});

var WIL = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/WIL.geojson",function(data){
    WIL.addData(data);
});

var WIMIF = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/WIMIF.geojson",function(data){
    WIMIF.addData(data);
});

var WISIE = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/WISIE.geojson",function(data){
    WISIE.addData(data);
});


var WM = L.geoJSON().addTo(map);
$.getJSON("/public/geojson/WM.geojson",function(data){
    WM.addData(data);
});

var baseLayers = {
};

var overlays = {
    "Jednostki pozawydzialowe": jednostkiPozawydzialowe,
    "bydynki": bydynki,
    "WA": WA,
    "WIEIK": WIEIK,
    "WIIT": WIIT,
    "WIITCH": WIITCH,
    "WIL":WIL,
    "WIMIF":WIMIF,
    "WISIE":WISIE,
    "WM":WM
};

L.control.layers(baseLayers, overlays).addTo(map);



WA.bindPopup(function (layer) {
    return layer.feature.properties.description;
}).addTo(map);








