<?php
require_once 'config/connexion.php';
require_once 'Modele.php';

class Proposition extends Modele {
    private $ID_Proposition;
    private $Titre_Proposition;
    private $Description_Proposition;
    private $DateCreation_Proposition;
    private $DureeMaximal_Proposition;
    private $DureeMinimal_Proposition;
    private $Budget_Proposition;
    private $ID_Theme;
    private $ID_Membre;

    protected static $objet = "Proposition";
    protected static $cle = "ID_Proposition";

    // Ajouter une nouvelle proposition
    public static function addProposition($data) {
        $table = static::$objet;
        $requete = "
            INSERT INTO $table (
                Titre_Proposition,
                Description_Proposition,
                DateCreation_Proposition,
                DureeMaximal_Proposition,
                DureeMinimal_Proposition,
                Budget_Proposition,
                ID_Theme,
                ID_Membre
            ) VALUES (
                :titre,
                :description,
                NOW(),
                :dureeMaximal,
                :dureeMinimal,
                :budget,
                :idTheme,
                :idMembre
            )
        ";
        $requetePreparee = connexion::pdo()->prepare($requete);
        $valeurs = [
            ':titre' => $data['titre'],
            ':description' => $data['description'],
            ':dureeMaximal' => $data['dureeMaximal'] ?? null,
            ':dureeMinimal' => $data['dureeMinimal'] ?? null,
            ':budget' => $data['budget'] ?? null,
            ':idTheme' => $data['idTheme'],
            ':idMembre' => $data['idMembre']
        ];
        try {
            $requetePreparee->execute($valeurs);
            return true;
        } catch (PDOException $e) {
            return Modele::message_Erreur($e);
        }
    }

    public static function updateProposition($id, $attributs){
        $table = static::$objet;
        $requete = "
            UPDATE $table
            SET 
                Titre = :titre,
                Description = :description,
                DureeMaximal = :duree_max,
                DureeMinimal = :duree_min,
                Budget = :budget,
                IDTheme = :theme            
            WHERE ID_Proposition = $:id";
        
        
    }
}
?>