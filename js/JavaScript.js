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

// Ajoute les markers sur la map
function initMapParcours(nbParcours) {
    // Lance un call ajax pour recuperer les points
    $.ajax({ url: './application.php',
         data: {idParcours: nbParcours},
         type: 'post',
         datatype : 'json',
         success: function(output) {
                    // Traite les points recupere
                    ShowParcours(output);
                  }
    });
    
    
// Affiche les points
function ShowParcours(tableauPoints){
    // Initialise un tableau avec le tableau json decripté
    var liste_des_points = $.parseJSON(tableauPoints);
    var parcours = [];

    // Pour chaque point dans le tableau
    $.each(liste_des_points,function(index, value)
        {
            // Créait un nouveau marker
            new google.maps.Marker({
              position: new google.maps.LatLng(value.Latitude, value.Longitude),
              map: map
            });
            parcours.push(new google.maps.LatLng(value.Latitude, value.Longitude));
        });

        new google.maps.Polyline({
            path: parcours,
            strokeColor: "#FF0000", 
            strokeOpacity: 1.0, 
            strokeWeight: 4,
            map: map
        });
    }
}






