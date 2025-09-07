<?php
    require_once("config/connexion.php");
    require_once("modele/Session.php");
    connexion::connect();

    // Récupération de l'URI
    $requestUri = $_SERVER['REQUEST_URI'];

    // Vérification si c'est une requête API
    if (strpos($requestUri, '/api/') !== false) {
        // Inclure le fichier des routes API
        require_once('api/routes.php');
        exit; // Empêche l'exécution du reste de index.php
    }

    if(!(Session::userConnecting()) && !(Session::userConnected())){
        $controleur = "Controleur";
        if(isset($_GET["action"]) == "afficherFormulaireInscription"){
            $action = $_GET["action"];
        }
        else{
            $action = "afficherFormulaireConnexion";
        }
    }
    else{
        if(isset($_GET["controleur"]) && isset($_GET["action"])){
            $controleur = $_GET["controleur"];
            $action = $_GET["action"];
        }
        else{
            $controleur = $_POST["controleur"];
            $action = $_POST["action"];
        }
    }

    require_once("$controleur.php");
    $controleur::$action();
    
?>