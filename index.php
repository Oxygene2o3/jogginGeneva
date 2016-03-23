<?php
session_start();
require_once 'application.php';
$difficulte = (isset($_REQUEST["filtre"])) ? $_REQUEST["filtreDifficulte"] : '';
$longueur = (isset($_REQUEST["filtre"])) ? $_REQUEST["filtreLongueur"] : '';
$idQuartier = (isset($_REQUEST["filtre"])) ? $_REQUEST["filtreQuartier"] : '';
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
        <script
            src="./js/JavaScript.js">
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
                    <p>texte</p>
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
                        <form action="" method="post">
                            <div class="btn-group btn-group-justified" role="group">
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-default" name="filtre">Filtrer</button>
                                </div>
                                <div class="btn-group" role="group">
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Longueur Max" name="filtreLongueur">
                                </div>
                                <div class="btn-group" role="group">
                                    <select class="form-control" id="sel1" name="filtreDifficulte" >
                                        <option value=""></option>
                                        <option value="Facile">Facile</option>
                                        <option value=Moyen>Moyen</option>
                                        <option value="Difficile">Difficile</option>
                                    </select>
                                </div>    
                                <div class="btn-group" role="group">
                                    <select class="form-control" id="sel1" name="filtreQuartier">
                                        <?php //printQuartier() ?>
                                    </select>
                                </div>  
                            </div>
                        </form>
                        <?php //showCourses($difficulte, $longueur, $idQuartier) ?>
                    </ul>
                </div>
            </div>
            <!-- MAP -->
            <div id="Map">
                <p>Veuillez patienter pendant le chargement de la carte...</p>
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
        <script>initialize();</script>
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