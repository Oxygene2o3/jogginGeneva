<?php

/**
 * Fonction de connexion à la DB
 * 
 * @staticvar type $maDB
 * 
 * @return  DB              Retourne la base de données
 */
function ConnectDB() {
    // Création d'une variable pour la DB
    static $maDB = null;
    
    // Test en cas d'exeption
    try {
        // Si la base de données est bien null
        if ($maDB == null) {
            // Connexion à la DB via PDO
            $maDB = new PDO("mysql:host=localhost;dbname=joggingeneva;charset=utf8", 'root', // username 
                    '', // mdp 
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false));
        }
    } catch (Exception $e) {
        // En cas d'erreur stop la fonction et retourne un message d'erreur
        die("Une erreur est survenue lors de la connexion." . $e->getMessage());
    }
    
    // Retourne la DB
    return $maDB;
}

/**
 * Fonction d'affichage du menu
 * 
 * @return  void    Ne retourne rien
 */
function menu() {
    // Recupere le nom de la page dans une variable
    $PageName = basename($_SERVER["PHP_SELF"]);

    // Si personne n'est connecté
    if (empty($_SESSION['logged'])) {
        // Ajoute du code HTML pour crée un menu d'utilisateur non-connecté
        $menu = array(  "index.php"   => '<span class="glyphicon'
                                      .  ' glyphicon-home"></span> Home',
            
                        "login.php"   => '<span class="glyphicon'
                                      .  ' glyphicon-user"></span> Login',
            
                        "profil.php"  => '<span class="glyphicon'
                                      .  ' glyphicon-info-sign"></span> Profil'
        );
    } else {
        // Sinon l'utilisateur est connecté
        // Ajoute du code HTML pour crée un menu d'utilisateur connecté
        $menu = array(  "index.php"   => "Home",
            
                        "logout.php"  => "Logout",
            
                        "profil.php"  => "Profil"
        );
    }
    // La suite est du code pour du BOOTSTRAP
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
 * Fonction d'ajout d'un nouvel utilisateur 
 * 
 * @staticvar type $maRequete
 * 
 * @param type $name        Le pseudo entré dans le formulaire d'inscription
 * @param type $password    Le mdp entré dans le formulaire d'inscription
 * 
 * @return boolean          Si le pseudo est déjà utilisé retourne FAUX
 *                          Sinon retourne VRAIE
 */
function AddUser($name, $password) {
    // Initialisation d'une variable statiq pour la requete sql
    static $maRequete = "";
    
    // Initialisation de la requete sql
    $sql = "INSERT INTO utilisateur "
            . "(NomUtilisateur, mdpUtilisateur) VALUES (?, ?)";
    
    // Test en cas d'exeption
    try {
        // Si la requete est bien null
        if($maRequete == null){
            // Connexion à la DB et préparation de la requete sql
            $maRequete = ConnectDB()->prepare($sql);
        }
    } catch (Exception $e) {
        // En cas d'erreur stop la fonction et retourne un message d'erreur
        die("Une erreur est survenue lors de la préparation de la requete."
                . $e->getMessage());
    }
    
    // Initialisation d'une variable indique si l'ajout est reussi
    $addIsSucess = true;

    // Test pour les exeption
    try {
        // Execution de la requete sql avec les variables
        // en parametre de la fonction
        $maRequete->execute(array($name, sha1($password)));
    } catch (Exception $e) {
        // En cas d'exeption retourne false 
        // pour indiquer que l'ajout est un echec
        $addIsSucess = false;
    }

    // Retourne un bool qui indique si l'ajout est reussi
    return $addIsSucess;
}

/**
 * Fonction de suppression d'un nouvel utilisateur 
 * 
 * @staticvar type $maRequete
 * 
 * @param type $name        Le pseudo de l'utilisateur à supprimer
 * 
 * @return boolean          Si la suppression est reussi retourne VRAIE
 *                          Sinon FAUX
 */
function DelUser($name) {
    // Initialisation d'une variable statiq pour la requete sql
    static $maRequete = "";
    
    // Initialisation de la requete sql
    $sql = "DELETE FROM utilisateur WHERE NomUtilisateur = ?";
    
    // Test en cas d'exeption
    try {
        // Si la requete est bien null
        if($maRequete == null){
            // Connexion à la DB et préparation de la requete sql
            $maRequete = ConnectDB()->prepare($sql);
        }
    } catch (Exception $e) {
        // En cas d'erreur stop la fonction et retourne un message d'erreur
        die("Une erreur est survenue lors de la préparation de la requete."
                . $e->getMessage());
    }
    
    // Initialisation d'une variable indique si la suppression est reussi
    $delIsSucess = true;

    // Test pour les exeption
    try {
        // Execution de la requete sql avec les variables
        // en parametre de la fonction
        $maRequete->execute(array($name));
    } catch (Exception $e) {
        // En cas d'exeption retourne false 
        // pour indiquer que la suppression est un echec
        $delIsSucess = false;
    }

    // Retourne un bool qui indique si la suppression est reussi
    return $delIsSucess;
}

/**
 * Fonction qui verifie la connexion d'un utilisateur
 * 
 * @staticvar type $maRequete
 * 
 * @param string $name      Le pseudo entré lors de la connexion
 * @param string $password  Le mdp entré lors de la connexion
 * 
 * @return boolean          Retourne VRAIE si la connexion et reussie
 *                          FAUX si la connexion n'est pas établie
 */
function CheckLogin($name, $password) {
    // Initialisation d'une variable statiq pour la requete sql
    static $maRequete = "";
    
    // Initialisation de la requete sql
    $sql = "Select * from utilisateur where NomUtilisateur = ? AND mdpUtilisateur = ?";

    // Test en cas d'exeption
    try {
        // Si la requete est bien null
        if($maRequete == null){
            // Connexion à la DB et préparation de la requete sql
            $maRequete = ConnectDB()->prepare($sql);
        }
    } catch (Exception $e) {
        // En cas d'erreur stop la fonction et retourne un message d'erreur
        die("Une erreur est survenue lors de la préparation de la requete."
                . $e->getMessage());
    }

    // Test pour les exeption
    try {
        // Execution de la requete sql avec les variables
        // en parametre de la fonction
        $maRequete->execute(array($name, sha1($password)));
        // Recuperation de l'entrée retournée
        $data = $maRequete->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // En cas d'exeption vide data pour annuller le login
        $data = "";
    }

    // Initialisation d'une variable indique si le login est reussi
    $logIsCorrect = false;

    // Si data n'est pas vide
    if (!empty($data)) {
        // Le login est reussi et donc mets true à la variable
        $logIsCorrect = true;
    }

    // Retourne un bool qui indique si le login est reussi
    return $logIsCorrect;
}

/**
 * Fonction d'ajout d'un nouveau parcours 
 * 
 * @staticvar type $maRequete
 * 
 * @param type $NomParcours         Le nom du parcours
 * @param type $LongueurParcours    La longueur du parcours
 * @param type $DifficulteParcours  La difficulté du parcours
 * @param type $idQuartier          Le quartier du parcours
 * 
 * @return boolean          Si l'ajout est un succès retourne VRAIE
 *                          Sinon FAUX
 */
function AddCourse($NomParcours, $LongueurParcours,
                   $DifficulteParcours, $idQuartier) {
    // Initialisation d'une variable statiq pour la requete sql
    static $maRequete = "";
    
    // Initialisation de la requete sql
    $sql = "INSERT INTO parcours "
            . "(NomParcours, LongueurParcours, DifficulteParcours, idQuartier) "
            . "VALUES (?, ?, ?, ?)";
    
    // Test en cas d'exeption
    try {
        // Si la requete est bien null
        if($maRequete == null){
            // Connexion à la DB et préparation de la requete sql
            $maRequete = ConnectDB()->prepare($sql);
        }
    } catch (Exception $e) {
        // En cas d'erreur stop la fonction et retourne un message d'erreur
        die("Une erreur est survenue lors de la préparation de la requete."
                . $e->getMessage());
    }
    
    // Initialisation d'une variable indique si l'ajout est reussi
    $addIsSucess = true;

    // Test pour les exeption
    try {
        // Execution de la requete sql avec les variables
        // en parametre de la fonction
        $maRequete->execute(array($NomParcours, $LongueurParcours,
                                  $DifficulteParcours, $idQuartier));
    } catch (Exception $e) {
        // En cas d'exeption retourne false 
        // pour indiquer que l'ajout est un echec
        $addIsSucess = false;
    }

    // Retourne un bool qui indique si l'ajout est reussi
    return $addIsSucess;
}

// alex
/**
 * Récupère dans un tableau les informations de chaques parcours
 * @param string $difficulte    La difficulté du parcour (Facile, Moyen, DIfficile)
 * @param double $longueur      La longueur maximum que doit avoir le parcour
 * @param int $idQuartier       Le quartier a afficher
 * @return array                Tableau contenant les information sur chaque parcours
 */
function getCourses($difficulte, $longueur, $idQuartier) {
    $table = [];
    $myDB = connectDB();
    $myRequest = $myDB->prepare("SELECT idParcours, NomParcours, LongueurParcours, DifficulteParcours, parcours.idQuartier, NomQuartier FROM parcours, quartier WHERE parcours.idQUartier = quartier.idQuartier AND ((DifficulteParcours = '$difficulte' OR '$difficulte' ='') AND (LongueurParcours <= '$longueur' OR '$longueur'= '') AND (parcours.idQuartier = '$idQuartier' OR '$idQuartier' = ''))");
    $myRequest->execute();
    while ($data = $myRequest->fetch(PDO::FETCH_ASSOC)) {
        $table[] = $data;
    }
    return $table;
}

/**
 * Affiche un select de chaque quartiers
 */
function printQuartier() {
    $myDB = connectDB();
    $myRequest = $myDB->prepare("SELECT idQuartier, NomQuartier FROM quartier");
    $myRequest->execute();
    echo '<select name="filtreQuartier">';
    echo '<option value=""></option>';
    while ($data = $myRequest->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $data["idQuartier"] . '">' . $data["NomQuartier"] . '</option>';
    }
    echo '</select>';
}

/**
 * Affiche les parcours en fonction du filtrage de la difficulté, de la pongueur et du quartier
 * @param string $difficulte    La difficulté du parcour (Facile, Moyen, DIfficile)
 * @param double $longueur      La longueur maximum que doit avoir le parcour
 * @param int $idQuartier       Le quartier a afficher
 */
function showCourses($difficulte, $longueur, $idQuartier) {
    
    // récumère les informations sur les parcours
    $courses = getCourses($difficulte, $longueur, $idQuartier);
    // Affiche un message si sucun parcour ne correspond aux critaires
    if (empty($courses)) {
        echo 'Aucun parcours ne correspond a vos critaires';
    }
    
    // Affichage web
    foreach ($courses as $value) {
        echo '<li class="list-group-item">';
        echo '<table class="listeParcours">';
        echo '<tr>';
        echo '<td>' . $value["NomParcours"] . '</td>';
        echo '<td>' . number_format($value["LongueurParcours"], 1, ',', ' ') . ' </td>';
        echo '<td>' . $value["DifficulteParcours"] . '</td>';
        echo '<td>' . $value["NomQuartier"] . '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</li>';
    }
}

/**
 * Cette fonction permet d'afficher le nom des parcours que l'utilisateur a ajouté à ses favoris
 * @param int $userId       l'id de l'utilisateur connecté
 */
function showFavoris($userId) {
    // Connexion a la base de données
    $myDB = connectDB();

    // Requète pour récupérer les favoris de l'utilisateurs
    $myRequest = $myDB->prepare("SELECT favoris.idParcours, favoris.idUtilisateur, parcours.NomParcours FROM parcours, favoris, utilisateur WHERE parcours.idParcours = favoris.idParcours AND favoris.idUtilisateur = utilisateur.idUtilisateur AND utilisateur.idUtilisateur = '$userId'");
    $myRequest->execute();

    // Affichage web
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading">Mes Favoris</div>';
    while ($data = $myRequest->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="panel-body">'
                . '' . $data["NomParcours"] . ''
                . '<a href="favoris.php?deleteParcoursId='.$data["idParcours"].'">Delete</a>'
                . '</div>';
    }
    echo '</ul>';
}

/**
 * Permet dêffacer un favoris
 * @param int $idUtilisateur    L'id de l'utilisateur
 * @param int $idParcours       L'id du parcours
 */
function deteleFav($idUtilisateur, $idParcours){
    // Connexion a la base de données
    $myDB = connectDB();

    // Requète pour effacer un champ dans la table favoris
    $myRequest = $myDB->prepare("DELETE FROM favoris WHERE idUtilisateur = ? AND idParcours = ?");
    $myRequest->execute(array($idUtilisateur, $idParcours));
}

// Marlon
function like($trip, $user) {
    
}

function myAccount($username) {
    $db = ConnectDB();
    $sql = 'SELECT * FROM utilisateur WHERE NomUtilisateur = :username';
    $requete = $db->prepare($sql);
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

/**
 *
 * Permet à un utilisateur d'ajouter un parcours à ses favoris.
 *
 * @param   int     $idUtilisateur      ID de l'utilisateur.
 * @param   int     $idParcours         ID du parcours.
 */
function favorite($idUtilisateur, $idParcours){
    
    // Connexion bade de données
    $db = ConnectDB();
    
    // Ajouter le l'id du parcours et l'id de l'utlisateur dans la table "favoris"
    $sqlAdd = ("INSERT INTO favoris (idUtilisateur,idParcours) VALUES (?,?);");
    
    // Nous faisons la prération
    $add = $db->prepare($sqlAdd);
    
    // Nous exécutons
    $add->execute(array($idUtilisateur,$idParcours));        
    
}