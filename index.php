<?php
session_start();
require_once 'application.php';
$difficulte = (isset($_REQUEST["filtre"])) ? $_REQUEST["filtreDifficulte"] : '';
$longueur = (isset($_REQUEST["filtre"])) ? $_REQUEST["filtreLongueur"] : '';
$idQuartier = (isset($_REQUEST["filtre"])) ? $_REQUEST["filtreQuartier"] : '';

if (isset($_GET['idParcours'])) {
    AfficherParcoursSelectionne($_GET['idParcours']);
}
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
            src="http://maps.googleapis.com/maps/api/js?key= AIzaSyB45lygduZiEszTK6nCOiUMnNkH4tTz70c">
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
                    <p>Bienvenue dans JogginGeneva ! Vous voulez faire votre jogging, mais les parcours précédents ne vous ont pas satisfait ? Ne vous inquitez pas ! Dans JogginGeneva vous avez la possibilité de consulter notre liste des parcours qui peuvent être fitlrés par difficulté, cartier ou bien la distance totale !</p>
                    <br>
                    <p>Si JogginGeneva vous plait, nous vous proposons alors de vous créer un compte <b><a href="login.php">ici</a></b>. Grâce à ce compte vous aurez la possibilité d'ajouter les parcours qui vous plaisent dans votre liste de favoris.</p>
                    <br>
                    <h3>Bon Jogging !!</h3>
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
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Longueur Max" name="filtreLongueur">
                                </div>
                                <div class="btn-group" role="group">
                                    <select class="form-control" id="sel1" name="filtreDifficulte" >
                                        <option <?php if($difficulte=="")          echo 'selected="selected"'; ?> value="">Tout</option>
                                        <option <?php if($difficulte=="Facile")    echo 'selected="selected"'; ?> value="Facile">Facile</option>
                                        <option <?php if($difficulte=="Moyen")     echo 'selected="selected"'; ?> value="Moyen">Moyen</option>
                                        <option <?php if($difficulte=="DIfficile") echo 'selected="selected"'; ?> value="Difficile">Difficile</option>
                                    </select>
                                </div>    
                                <div class="btn-group" role="group">
                                    <select class="form-control" id="sel1" name="filtreQuartier">
                                        <?php printQuartier($idQuartier) ?>
                                    </select>
                                </div>    
                            </div>
                            <div class="btn-group btn-group-justified" role="group">
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-info" name="filtre">Filtrer</button>
                                </div>
                            </div>
                        </form>
                        <?php showCourses($difficulte, $longueur, $idQuartier) ?>
                    </ul>
                </div>
            </div>
            <!-- MAP -->
            <div id="Map">
                <p>Veuillez patienter pendant le chargement de la carte...</p>
            </div>

            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">&#x23CF;</a></p>
                <p>&copy; Marlon P.R. & Fabio D.B. & Alex A. & Damiano R. </p>
            </footer>
        </div>

        <!-- Bootstrap script  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="./BootStrap/js/bootstrap.min.js"></script>
        <script>initialize();</script>
        <script>

            $(".panel-dropdown").find('.panel-heading').click();
            $('<span>', {
                class: "pull-right glyphicon glyphicon-triangle-bottom"
            }).appendTo($(".panel-dropdown").find('.panel-heading').find('h4'));
            $(".panel-dropdown").find('.panel-heading').click(function () {
                $(this).find('span').toggleClass('glyphicon-triangle-bottom glyphicon-triangle-top');
                $(this).parent(".panel").find(".panel-body").first().slideToggle();
            });


        </script>
    </body>
</html>