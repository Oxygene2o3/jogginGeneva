<?php

/**
 * Allows connection to the DB
 * @staticvar type $maDB
 * @return  DB
 */
function ConnectDB() {
    static $maDB = null;
    try {
        if ($maDB == null) {
            $maDB = new PDO("mysql:host=localhost;dbname=db_maxyster;charset=utf8", 
                    'maxyster', // username 
                    'Super',    // mdp 
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false));
        }
        
    } catch (Exception $e) {
        die("R.I.P in peace " . $e->getMessage());
    }
    return $maDB;
}

function menu() {
    $PageName = basename($_SERVER["PHP_SELF"]);

    if (empty($_SESSION['logged'])) {
        //if the user is not connected
        $menu = array("index.php" => '<span class="glyphicon glyphicon-home"></span> Home',
            "login.php" => '<span class="glyphicon glyphicon-user"></span> Login',
            "profil.php" => '<span class="glyphicon glyphicon-info-sign"></span> Profil'
        );
    } else {
        //if the user is connected 
        $menu = array("index.php" => "Home",
            "logout.php" => "Logout",
            "profil.php" => "Profil"
        );
    }
    ?>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container"><div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">JogginGeneva</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <?php
                    //echo the menu
                    foreach ($menu as $url => $label) {
                        if ($PageName == $url) {
                            echo "<li class='active'><a class='' href='$url'>$label</a></li>";
                        } else {
                            echo "<li><a href='$url'>$label</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}

/**
 * Add a new user in the DB 
 * @staticvar type $maRequete
 * @param type $name
 * @param type $password
 * @return string if the user name is already assigned 
 */
function AddUser($name, $password) {
    static $maRequete = null;
    $error = false;

    //Prépaper la requête lors du premier appel
    if ($maRequete == null) {
        $maRequete = ConnectDB()->prepare("INSERT INTO t_user (name_user, password_user)
                                                VALUES        (        ?,             ?)");
    }

    try {
        //Enregistrer les données
        $maRequete->execute(array($name, $password));
    } catch (Exception $e) {
        $error = 'this name is already assigned';
    }
    return $error;
}

/**
 * check if the user is in the DB
 * @param string $name
 * @param string $password
 */
function CheckLogin($name, $password) {
    $dtb = ConnectDB();
    $sql = "Select * from t_user where name_user = ? AND password_user=?";
    $maRequete = $dtb->prepare($sql);
    $maRequete->execute(array($name, $password));
    $data = $maRequete->fetch(PDO::FETCH_ASSOC);
    return $data;
    // return data user
}

/**
 * Affiche les différentes informations sur l'utilisateur.
 * En attente de l'ajout du nombre de likes et le nombre de parcours effectués.
 * @param string $username		Indique l'utilisaeur en question
 */
function myAccount($username) {
    $db = Connexiondb();
    $sql = 'SELECT * FROM utilisateur WHERE NomUtilisateur = :username';
    $requete = $bdd->prepare($sql);
    $requete->execute(array());

    echo '<li class="list-group-item">';
    echo '<table class="listeParcours">';
    echo '<thead>';
    $firstLine = true;

    // Met tout les resultats dans un tableau associatif
    while (($data = $requete->fetch(PDO::FETCH_ASSOC)) != false) {
        if ($firstLine) {
            echo '<tr>';
            foreach ($data as $key => $val) {
                echo '<th style="text-align: center;">' . $key . '</th>';
            }

            echo '</tr>';
            echo '</thead>';


            $firstLine = false;
        }
        echo '<tbody>';
        echo '<tr>';
        
        foreach ($data as $key => $val) {
            
            echo '<td>' . $val . '</td>';
            
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo "</table>";
    echo '</li>';

}
