<?php
require_once("modele/Proposition.php");
require_once("Controleur.php");

class ControleurProposition extends Controleur {
    public static function créerProposition() {
        $titre = $_POST["titre"];
        $description = $_POST["description"];
        $categorie = $_POST["categorie"];
        $dateLimite = $_POST["date_limite"];
        $idMembre = $_POST["idMembre"];

        $data = [
            'titre' => $titre,
            'description' => $description,
            'categorie' => $categorie,
            'date_limite' => $dateLimite,
            'idMembre' => $idMembre
        ];

        $uri = Controleur::get_URL() . "proposition";
        $reponse = Controleur::demande_API($data, $uri);
        
        if (isset($reponse['status']) && $reponse['status'] === 'success') {
            self::afficherPagePropositionAjoutee($idProposition);
        } else {

            self::afficherFormulaireProposition();
        }
    }

    public static function afficherFormulaireProposition(){
        
    }
}