<?php

require_once 'modele/Internaute.php';

class ControleurLoginAPI {

    public static function POST($route) {
        // exemple d'uri : https://projets.iut-orsay.fr/saes3-wsimion/index.php/api/login
        $data = json_decode(file_get_contents("php://input"), true);
        if($route === 'api/login'){
        
            if(isset($data['email']) && isset($data['mdp'])){
                $email = $data['email'];
                $mdp = $data['mdp'];
                $reponse = Internaute::checkMDP($email, $mdp);
                if($reponse){
                    $obj = Internaute::getObjetByEmail($email);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Connexion réussi',
                        'data' => $obj->get('ID_Internaute')
                    ]);
                }
                else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Identifiants incorrects'
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

}

?>