<?php
session_start();
require_once 'application.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="./images/bootstrap.ico">
        <link href="BootStrap/css/bootstrap.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
        <script
            src="http://maps.googleapis.com/maps/api/js">
        </script>
        <script>
            function initialize() {
                var mapProp = {
                    center: new google.maps.LatLng(51.508742, -0.120850),
                    zoom: 17,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <title>JogginGeneva</title>
    </head>
    <body>
        <!-- MENU -->
        <div class="navbar-wrapper">
            <div class="container">
                <?php
                menu();
                ?>
            </div>
        </div>

        <!-- CONTENT PRESENTATION -->
        <div class="container marketing">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <p>texte de présentation</p>
                </div>
            </div>

            <!-- Liste parcours -->
            <div class="panel panel-default panel-dropdown">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Liste de parcours
                        <span class="pull-right glyphicon glyphicon-triangle-top"></span>
                    </h3>
                </div>

                <!-- Contenue de la liste -->
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">test1<span class="badge"><a href="index.php"><span class="glyphicon glyphicon-info-sign"></span></a></span></li>
                        <li class="list-group-item">test2</li>
                        <li class="list-group-item">test3</li>
                        <li class="list-group-item">test4</li>
                        <li class="list-group-item">test5</li>
                    </ul>
                </div>
            </div>
            <div id="googleMap" style="width:100%;height:380px;"></div>
            <div class="col-sm-6 map">
                <div class="google-map-canvas" id="map-canvas">
                </div>
            </div>

            <!-- CONTENT INFORMATION -->
            <div class="panel panel-info">
                <div class="panel-body">
                    <p>Information sur le parcour</p>
                </div>
            </div>

            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">&#x23CF;</a></p>
                <p>&copy;</p>
            </footer>
        </div>

        <!-- Bootstrap script  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="./BootStrap/js/bootstrap.min.js"></script>
        <script>
            $(".panel-dropdown").find('.panel-heading').click(function () {
                $(this).find('span').toggleClass('glyphicon-triangle-bottom glyphicon-triangle-top');
                $(this).parent(".panel").find(".panel-body").first().slideToggle();
            });

            $(".panel-dropdown").find('.panel-heading').click();
            $('<span>', {
                class: "pull-right glyphicon glyphicon-triangle-bottom"
            }).appendTo($(".panel-dropdown").find('.panel-heading').find('h4'));
        </script>
    </body>
</html>