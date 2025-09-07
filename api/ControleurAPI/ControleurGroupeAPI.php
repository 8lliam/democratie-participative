<?php

require_once 'modele/Groupe.php';

class ControleurGroupeAPI {

    public static function GET($route){
        $pattern = '/^api\/groupe\/([1-9][0-9]*)$/';
        $decideur = '/^api\/groupe\/([1-9][0-9]*)\?action=decideur$/';

        if (preg_match($decideur, $route, $matches)){
            // exemple d'uri : https://projets.iut-orsay.fr/saes3-wsimion/index.php/api/groupe/1?action=decideur
            $ID_Internaute = $matches[1]; //  récupérer la valeur après le /internaute
            $reponse = Groupe::getAllDecideur($ID_Internaute);
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
        else if (preg_match($pattern, $route, $matches)){
            $ID_Internaute = $matches[1];
            $reponse = Groupe::getAllById($ID_Internaute);
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
}