<?php
// Ouverture de session
session_start();
// Lien à la librairie
require_once 'application.php';

// Initialisation 
$error = "";


// Traitement
// Si l'utilisateur a envoyé le formulaire d'inscription
if (isset($_REQUEST["modalForm"])) {
    // Initialisation
    $NewName = filter_input(INPUT_POST, 'NewName', FILTER_SANITIZE_SPECIAL_CHARS);
    $NewPassword = filter_input(INPUT_POST, 'NewPassword', FILTER_SANITIZE_SPECIAL_CHARS);
    $NewPasswordConfirmed = filter_input(INPUT_POST, 'NewPasswordConfirmed', FILTER_SANITIZE_SPECIAL_CHARS);

    // Si les champs ne sont pas vides
    if ((!empty($NewName)) && (!empty($NewPassword)) && (!empty($NewPasswordConfirmed))) {

        // Si le mdp est le même que le mdp de la verification
        if ($NewPassword == $NewPasswordConfirmed) {

            // Si l'ajout de l'utilisateur est fonctionnel
            if (AddUser($NewName, $NewPassword)) {
                // Affiche un message comme quoi le compte a été crée
                $error = '<span id="helpBlock" class="help-block">The account has been successfully created.</span>';
            } else {
                // Sinon affiche une erreur
                $error = '<span id="helpBlock" class="help-block">This name is already assigned</span>';
            }
        } else {
            // Sinon affiche une erreur
            $error = '<span id="helpBlock" class="help-block">The password are not the same.</span>';
        }
    } else {
        // Sinon affiche une erreur
        $error = '<span id="helpBlock" class="help-block">Some field are empty.</span>';
    }
}

// Si le formulaire de connexion est envoyé
if (isset($_REQUEST["btnSubmit"])) {
    // Initialisation    
    $UserName = filter_input(INPUT_POST, 'UserName', FILTER_SANITIZE_SPECIAL_CHARS);
    $UserPassword = filter_input(INPUT_POST, 'UserPassword', FILTER_SANITIZE_SPECIAL_CHARS);

    // Si le login est juste
    if (CheckLogin($UserName, $UserPassword)) {
        // Initialise une variable dans $_SESSION à true
        $_SESSION['user_logged'] = $UserName;
        $_SESSION["user"] = getUserByName($UserName);
        // Redirige vers l'index
        header('Location: index.php');
    } else {
        $error = '<span id="helpBlock" class="help-block">The login has failed.</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="./images/bootstrap.ico">
        <link href="BootStrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title>JogginGeneva</title>

    </head>
    <body>
        <!-- MENU -->
        <div class="navbar-wrapper">
            <div class="container">
                <?php
                echo menu();
                ?>

            </div>
        </div>
        <!-- CONTENT1 -->
        <div class="container marketing">
            <form action="#" method="post">
                <div class="input-group input-group-lg form-group">
                    <input type="text" class="form-control" placeholder="Username" name='UserName' required aria-describedby="basic-addon2">
                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-user"></span></span>
                </div> 
                <div class="input-group input-group-lg form-group">
                    <input type="password" class="form-control" placeholder="Password" name='UserPassword' required aria-describedby="basic-addon2">
                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock"></span>
                </div> 
                <?php echo $error ?>
                <br>
                <button type="submit" class="btn btn-default btn-lg btn-block" name='btnSubmit'>Submit</button>
            </form>     
            <br>
            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#myModal">
                Register Here
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="login.php" method="post" id="registerForm">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Register</h4>
                            </div>
                            <div class="modal-body">
                                <div class="input-group input-group-lg form-group">
                                    <input type="text" class="form-control" placeholder="Username"  name='NewName' required aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-user"></span></span>
                                </div> 
                                <div class="input-group input-group-lg form-group">
                                    <input type="password" class="form-control" placeholder="Password" name='NewPassword' required aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                </div> 
                                <div class="input-group input-group-lg form-group">
                                    <input type="password" class="form-control" placeholder="Confirme Password" required name='NewPasswordConfirmed' aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" name="modalForm" class="btn btn-primary">Let's Go</button>
                            </div>
                        </form>
                    </div>
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
