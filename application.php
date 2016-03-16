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
            $maDB = new PDO("mysql:host=localhost;dbname=db_maxyster;charset=utf8", 'maxyster', // username 
                    'Super', // mdp 
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
    $sql = "INSERT INTO t_user "
            . "(name_user, password_user) VALUES (?, ?)";
    
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
    $addIsSucess = false;

    // Test pour les exeption
    try {
        // Execution de la requete sql avec les variables
        // en parametre de la fonction
        $maRequete->execute(array($name, $password));
    } catch (Exception $e) {
        // En cas d'exeption retourne false 
        // pour indiquer que l'ajout est un echec
        $addIsSucess = false;
    }

    // Retourne un bool qui indique si l'ajout est reussi
    return $addIsSucess;
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
    $sql = "Select * from t_user where name_user = ? AND password_user = ?";

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
        $maRequete->execute(array($name, $password));
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
