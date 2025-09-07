<?php
class Controleur {
    const URL_MODELE = "https://projets.iut-orsay.fr/saes3-wsimion/index.php/api/";

    public function get($attribut){
        return $this->$attribut;
    }
    public static function get_URL(){
        return self::URL_MODELE;
    }
    public static function demande_API($data, $URI, $customMethod = NULL){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $URI);
        if(!(empty($customMethod))){
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $customMethod);
        }
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public static function afficherFormulaireConnexion(){
        $titre = "Connexion";
        require_once("vue/debut.php");
        require_once("vue/formulaireConnexion.html");
        require_once("vue/fin.html");
    }

    public static function afficherFormulaireInscription(){
        $titre = "Inscription";
        require_once("vue/debut.php");
        require_once("vue/formulaireInscription.html");
        require_once("vue/fin.html");
    }
}