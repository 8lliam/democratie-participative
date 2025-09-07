<?php
require_once ('config/connexion.php');
require_once ("Modele.php");
class Groupe extends Modele{
    protected $id;
    protected $nom;
    protected $description;
    protected $etiquette;
    protected $image;
    protected $dateCreation;

    protected static $objet = "Groupe";
    protected static $cle = "ID_Groupe";

    public static function getAllByRole($id_Internaute,$role){
        $requete = "CALL GetGroupesDecideurParMembre(?, ?)";
        $requetePreparee = connexion::pdo()->prepare($requete);
        $requetePreparee->bindParam(1, $id_Internaute, PDO::PARAM_INT, 4000);
        $resultat->bindParam(1, $role, PDO::PARAM_json | PRO::PARAM_OUTPUT, 4000);
        try{
            $requetePreparee->execute();
        } catch(PDOException $e){
           $reponse = Modele::message_Erreur($e);   
        }
        return $reponse;
    }

    public static function getAllDecideur($id_Internaute){
        $requete = "SELECT G.ID_Groupe, G.Nom_Groupe, G.Description_Groupe, G.Etiquette_Groupe, G.Image_Groupe, G.DateCreation_Groupe FROM Membre M JOIN Role R ON M.ID_Role = R.ID_Role  JOIN Groupe G ON M.ID_Groupe = G.ID_Groupe  WHERE R.Nom_Role = 'Decideur' AND M.ID_Internaute = :idInternaute_tag;";
        $resultat = connexion::pdo()->prepare($requete);
        $resultat->bindParam(':idInternaute_tag', $id_Internaute, PDO::PARAM_INT);
        try{
            $resultat->execute();
            $reponse = $resultat->fetchAll(PDO::FETCH_CLASS);
        } catch(PDOException $e){
           $reponse = Modele::message_Erreur($e);   
        }
        return $reponse;
    }
}