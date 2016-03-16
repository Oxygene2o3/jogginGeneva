var map;
var direction;

/* Donne les parametres par default de la map */
function initMap() {
    var TempoIni = new google.maps.LatLng(46.2, 6.1667); // Correspond au coordonnées d'initialisation
    var myOptions = {
        zoom: 14, // Zoom par défaut
        center: TempoIni, // Coordonnées de départ
        mapTypeId: google.maps.MapTypeId.TERRAIN, // Type de carte, différentes valeurs possible HYBRID, ROADMAP, SATELLITE, TERRAIN
        maxZoom: 20
    };
    return myOptions;
}

/* initialize la map et utilise plusieurs fonctions */
function initialize() {

    map = new google.maps.Map(document.getElementById('Map'), initMap());

    direction = new google.maps.DirectionsRenderer({
        map: map
    });
}





