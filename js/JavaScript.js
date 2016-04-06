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

function initMapParcours(nbParcours) {
// On boucle autant de fois qu'il y a de points dans nbParcours.
    var locations = [];
    for (var i = 1; i <= nbParcours; i++) {
        locations.push(['Étape ' + document.getElementById('e' + i).value, document.getElementById('lat' + i).value, document.getElementById('lon' + i).value]);
    }
    // paramètres de base de la carte à l'affichage.
    var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(46.2000, 6.1500),
        zoom: 14,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        navigationControl: true,
        navigationControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL,
            position: google.maps.ControlPosition.TOP_LEFT
        },
        scaleControl: true,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            };
        })(marker, i));
    }

// On créé une variable parcours pour contenir les lattitudes et les longitudes de chaque
// points du parcours choisi
    var parcours = [];
    // On boucle autant de fois qu'il y a de points dans nbParcours et on y insère dans le tableau parcours.
    for (x = 0; x < nbParcours; x++) {
        parcours.push(new google.maps.LatLng(locations[x][1], locations[x][2]));
    }

    var traceParcours = new google.maps.Polyline({
        path: parcours, //chemin du tracé
        strokeColor: "#FF0000", //couleur du tracé
        strokeOpacity: 1.0, //opacité du tracé
        strokeWeight: 4//grosseur du tracé
    });

//lier le tracé à la carte
//ceci permet au tracé d'être affiché sur la carte
    traceParcours.setMap(map);

}






