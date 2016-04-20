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
                    <h3>Bon Jogging !</h3>
                </div>
            </div>
            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">&#x23CF;</a></p>
                <p class="footer">&copy; Marlon P.R. & Fabio D.B. & Alex A. & Damiano R. </p>
            </footer>
        </div>

        <!-- Bootstrap script  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="./BootStrap/js/bootstrap.min.js"></script>
    </body>
</html>