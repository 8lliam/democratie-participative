<?php

require_once 'modele/Internaute.php';

class ControleurInternauteAPI {

    public static function GET($route) {
        $pattern = '/^api\/internaute\/([1-9][0-9]*)$/';

        // exemple d'uri : https://projets.iut-orsay.fr/saes3-wsimion/api/internaute/1
        if(preg_match($pattern, $route, $matches)){
            $ID_Internaute = $matches[1];
            $reponse = Internaute::getObjetById($ID_Internaute);
            if(isset($reponse["status"])){
                $reponse["message"] = "Utilisateur non trouvé";
                echo json_encode($reponse);
            }
            else{
                if($reponse == "[]"){
                    echo json_encode([
                        'status' => 'success',
                        'data' => null
                    ]);
                }
                else{
                    echo json_encode([
                        'status' => 'success',
                        'data' => $reponse
                    ]);
                }
            }
        }
        else{ // l'uri se termine par /api/internaute
            $reponse = Internaute::getAll();
            if(isset($reponse["status"])){
                $reponse["message"] = "Utilisateur non trouvé";
                echo json_encode($reponse);
            }
            else{
                if($reponse == "[]"){
                    echo json_encode([
                        'status' => 'success',
                        'data' => null
                    ]);
                }
                else{
                    echo json_encode([
                        'status' => 'success',
                        'data' => $reponse
                    ]);
                }
            }
        }
    }

    public static function POST($route){
        $data = json_decode(file_get_contents("php://input"), true);
        
        // exemple d'uri : https://projets.iut-orsay.fr/saes3-wsimion/index.php/api/internaute
        if($route === 'api/internaute'){
            if(isset($data['nom']) && isset($data['prenom']) && isset($data['email']) && isset($data['mdp']) && isset($data['cp'])){
                $nom = $data['nom'];
                $prenom = $data['prenom'];
                $email = $data['email'];
                $mdp = $data['mdp'];
                $cp = $data['cp'];
                $reponse = Internaute::addInternaute($nom, $prenom, $email, $mdp, $cp);
                if($reponse){
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Inscription réussi'
                    ]);
                }
                else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Données invalides'
                    ]);
                }
            }
            else{
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Champs manquants (email ou mdp)'
                ]);
            }
        }
    }

    public static function PUT($route){
        
        $data = json_decode(file_get_contents("php://input"), true);
        $pattern = '/^api\/internaute\/([1-9][0-9]*)$/';

        // exemple d'uri : https://projets.iut-orsay.fr/saes3-wsimion/index.php/api/internaute/1
        if(preg_match($pattern, $route, $matches)){
            if(isset($data['nom']) && isset($data['prenom']) && isset($data['email']) && isset($data['mdp']) && isset($data['cp'])){
                $nom = $data['nom'];
                $prenom = $data['prenom'];
                $email = $data['email'];
                $mdp = $data['mdp'];
                $cp = $data['cp'];
                $ID_Internaute = $matches[1];
                $reponse = Internaute::updateInternaute($ID_Internaute, $nom, $prenom, $email, $cp, $mdp);
                if($reponse){
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Profil mis à jour avec succès'
                    ]);
                }
                else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erreur lors de la mise à jour'
                    ]);
                }
            }
            else{
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Champs manquants'
                ]);
            }
        }
    }

    

}

?>