<?php
session_start();
require_once 'application.php';
if (isset($_REQUEST["parcoursId"])){
    deleteFav($_SESSION["user"]["idUtilisateur"], $_REQUEST["parcoursId"]);
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
            <div class="panel panel-default" id="borderUser">
                <div class="panel-body" id='banniereUser'>
                    <img src='images/default_avatar_560d512bd0fc2.gif' alt="test" class="img-circle">
                </div>
            </div>
            <div class="btn-group btn-group-justified" role="group">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" id="btnChoice" onclick="changeContenueTexte('Detail')">Détail</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" id="btnChoice" onclick="changeContenueTexte('Favoris')">Favoris</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" id="btnChoice" onclick="changeContenueTexte('Modif')">Modif</button>
                </div>
            </div>
            
            <!-- CONTENT -->
            <div class="panel panel-primary">
                <div class="panel-body" id="content">
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
            function changeContenueTexte(Choice) {

            //recupération du div
            var div = document.getElementById("content");
            var Contenu = "";
            div.innerHTML = "";
            switch (Choice) {
                case "Detail":
                    Contenu = '<?php echo '<p><h4>Binvenue sur votre page personelle monsieur/madame </h4>' . $_SESSION["user"]["NomUtilisateur"] ?></p>';
                    div.innerHTML = Contenu;
                    break;
                case "Favoris":
                    Contenu = '<?php showFavoris($_SESSION['user_logged']) ?>';
                    div.innerHTML = Contenu;
                    break;
                case "Modif":
                    Contenu = Choice;
                    div.innerHTML = Contenu;
                    break;
                default:
                    Contenu = "";
                    div.innerHTML = Contenu;
            }
        }
        </script>
    </script>
</body>
</html>