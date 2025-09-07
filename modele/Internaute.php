<?php
require_once ('config/connexion.php');
require_once ("Modele.php");
class Internaute extends Modele{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $codePostal;
    private $dateInscription;

    protected static $objet = "Internaute";
    protected static $cle = "ID_Internaute";

    // // Constructeur pour initialiser l'objet Utilisateur
    // public function __construct($nom, $prenom, $email, $mdp, $codePostal) {
    //     $this->nom = $nom;
    //     $this->prenom = $prenom;
    //     $this->email = $email;
    //     $this->mdp = $mdp;
    //     $this->codePostal = $codePostal;
    //     $this->dateInscription = date("Y-m-d H:i:s");
    // }

    // Methode créer Internaute -> Faire le TP 14 de dev web

    // Vérifier si un utilisateur existe avec un email et un mot de passe
    public static function checkMDP($email, $mdp) {
        $table = static::$objet;
        $requete = "SELECT * FROM $table WHERE Email_Internaute = :email_tag AND MDP_Internaute = :mdp_tag";
        $requetePreparee = connexion::pdo()->prepare($requete);
        $valeurs = array(
            ":email_tag" => $email,
            ":mdp_tag" => $mdp
        );
        try{
            $requetePreparee->execute($valeurs);
            $requetePreparee->setFetchmode(PDO::FETCH_CLASS, $table);
            $tabObj = $requetePreparee->fetchAll();
            if(count($tabObj) == 1){
                $reponse = true;
            }
            else{
                $reponse = false;
            }
         } catch(PDOException $e){
            return Modele::message_Erreur($e);
         }
         return $reponse;
    }

    public static function getObjetByEmail($email){
        $table = static::$objet;
        $requete = "SELECT * FROM Internaute WHERE Email_Internaute = ?";
        if(!(empty($email))){
            $valeur = $email;
        }
        else{
            $valeur = NULL;
        }
        $requetePreparee = connexion::pdo()->prepare($requete);
        try{
           $requetePreparee->execute([$valeur]);
           $requetePreparee->setFetchmode(PDO::FETCH_CLASS, $table);
           $reponse = $requetePreparee->fetch();
        } catch(PDOException $e){
            $reponse = Modele::message_Erreur($e);   
        }
        return $reponse;
    }

    public static function addInternaute($nom, $prenom, $email, $mdp, $cp){
        $table = static::$objet;
        $requete = "INSERT INTO Internaute VALUES (NULL, :nom_tag, :prenom_tag, :email_tag, :mdp_tag, :cp_tag, '" . date("Y-m-d H:i:s") . "')";
        $requetePreparee = connexion::pdo()->prepare($requete);
        $valeurs = array(
            ":nom_tag" => $nom,
            ":prenom_tag" => $prenom,
            ":email_tag" => $email,
            ":mdp_tag" => $mdp,
            ":cp_tag" => $cp
        );
        try{
            $requetePreparee->execute($valeurs);
            return true;
        } catch(PDOException $e){
            return false;
        }
    }

    public static function updateInternaute($id, $nom, $prenom, $email, $codePostal, $mdp) {
        $table = static::$objet;
        $requete = "UPDATE $table SET Nom_Internaute = :nom, Prenom_Internaute = :prenom, Email_Internaute = :email, CodePostal_Internaute = :codePostal, MDP_Internaute = :mdp WHERE ID_Internaute = :id";
        $requetePreparee = connexion::pdo()->prepare($requete);
        $valeurs = array(
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":email" => $email,
            ":codePostal" => $codePostal,
            ":mdp" => $mdp,
            ":id" => $id
        );
        try {
            $requetePreparee->execute($valeurs);
            return true;
        } catch(PDOException $e) {
            return Modele::message_Erreur($e);
            //return false;
        }
    }
}
?>
