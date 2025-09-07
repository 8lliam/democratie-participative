<?php 
require_once("modele/Internaute.php");
require_once("Controleur.php");

class ControleurInternaute extends Controleur{
    public static function inscrireInternaute(){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        $cp = $_POST["cp"];

        $data = [
            'nom' => $email,
            'email' => $email,
            'email' => $email,
            'mdp' => $mdp,
            'email' => $email
        ];
        $uri = Controleur::get_URL() . "internaute";
        $reponse = Controleur::demande_API($data, $uri);
        if (isset($reponse['status']) && $reponse['status'] === 'success'){
            Controleur::afficherFormulaireConnexion();
        }
        else{
            Controleur::afficherFormulaireInscription();
        }
    }

    public static function connecterInternaute(){
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];

        $data = [
            'email' => $email,
            'mdp' => $mdp
        ];
        $uri = Controleur::get_URL() . "login";
        $reponse = Controleur::demande_API($data, $uri);
        if (isset($reponse['status']) && $reponse['status'] === 'success'){
            $_SESSION["id"] = $reponse['data'];
            self::afficherAccueil();
        }
        else{
            Controleur::afficherFormulaireConnexion();
        }
    }

    public static function modifierInternaute() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'cp' => $_POST['cp'],
                'mdp' => $_POST['mdp']
            ];
    
            $uri = Controleur::get_URL() . "internaute/" . $_SESSION["id"];
            $reponse = Controleur::demande_API($data, $uri, "PUT");
            if (isset($reponse['status']) && $reponse['status'] == "success") {
                self::afficherProfil(true);
            } else {
                self::afficherProfil(false);
            }
        }
    }

    public static function afficherAccueil(){
        $obj = Internaute::getObjetById($_SESSION["id"]);
        $prenomInternaute = $obj->get("Prenom_Internaute");
        $titre = "Accueil de " . $prenomInternaute;
        require_once("vue/debut.php");
        require_once("vue/Accueil.php");
        require_once("vue/sideBar.html");
        require_once("vue/fin.html");
    }

    public static function afficherProfil($statut = null){
        $obj = Internaute::getObjetById($_SESSION["id"]);
        $nomInternaute = $obj->get("Nom_Internaute");
        $prenomInternaute = $obj->get("Prenom_Internaute");
        $emailInternaute = $obj->get("Email_Internaute");
        $cpInternaute = $obj->get("CodePostal_Internaute");
        $mdpInternaute = $obj->get("MDP_Internaute");
        $titre = "Profil de " . $prenomInternaute;
        require_once("vue/debut.php");
        require_once("vue/internaute/formulaireModification.php");
        require_once("vue/sideBar.html");
        require_once("vue/fin.html");
    }

    public static function afficherGroupes(){
        $obj = Internaute::getObjetById($_SESSION["id"]);
        $prenomInternaute = $obj->get("Prenom_Internaute");
        $titre = "Groupes de " . $prenomInternaute;
        require_once("vue/debut.php");
        require_once("vue/Accueil.php");
        require_once("vue/sideBar.html");
        require_once("vue/fin.html");
    }

    public static function afficherNotifications(){
        $obj = Internaute::getObjetById($_SESSION["id"]);
        $prenomInternaute = $obj->get("Prenom_Internaute");
        $titre = "Notifications de " . $prenomInternaute;
        require_once("vue/debut.php");
        require_once("vue/Accueil.php");
        require_once("vue/sideBar.html");
        require_once("vue/fin.html");
    }

    public static function afficherReglages(){
        $obj = Internaute::getObjetById($_SESSION["id"]);
        $prenomInternaute = $obj->get("Prenom_Internaute");
        $titre = "Reglage de " . $prenomInternaute;
        require_once("vue/debut.php");
        require_once("vue/Accueil.php");
        require_once("vue/sideBar.html");
        require_once("vue/fin.html");
    }

    public static function deconnecterUtilisateur() {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-1);
        self::afficherFormulaireConnexion();
    }
}