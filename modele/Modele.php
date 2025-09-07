<?php
class Modele {
    public function __construct($donnees = NULL) {
        if(!is_null($donnees)){
            foreach($donnees as $attribut => $valeur) {
                $this -> set($attribut, $valeur);
            }
        }
    }

    public function get($attribut){
        return $this->$attribut;
    }

    public function set($attribut, $valeur){
        $this -> $attribut = $valeur;
    }

    public static function getAll(){
        $table = static::$objet;
        $requete = "SELECT * FROM $table";
        $resultat = connexion::pdo()->query($requete);
        try{
            $resultat->setFetchmode(PDO::FETCH_CLASS, ucfirst($table));
            $reponse = $resultat->fetchAll();
        } catch(PDOException $e){
           $reponse = Modele::message_Erreur($e);   
        }
        return $reponse;
    }

    public static function getAllById($id){
        $table = static::$objet;
        $cleP = static::$cle;
        $requete = "SELECT * FROM $table where  $cle = $id";
        $resultat = connexion::pdo()->query($requete);
        try{
            $resultat->setFetchmode(PDO::FETCH_CLASS, ucfirst($table));
            $reponse = $resultat->fetchAll();
        } catch(PDOException $e){
           $reponse = Modele::message_Erreur($e);   
        }
        return $reponse;
    }

    public static function getObjetById($id){
        $table = static::$objet;
        $cle = static::$cle;
        $requete = "SELECT * FROM $table WHERE $cle = ?";
        if(strlen($id) > 0){
            $valeur = $id;
        }
        else{
            $valeur = NULL;
        }
        $requetePreparee = connexion::pdo()->prepare($requete);
        $requetePreparee->execute([$valeur]);
        $requetePreparee->setFetchmode(PDO::FETCH_CLASS, $table);
        $obj = $requetePreparee->fetchAll();
        return $obj;
    }

    public static function message_Erreur($e){
        return [
            'status' => 'error',
            'message' => $e->getMessage()
        ];

    }
}

?>