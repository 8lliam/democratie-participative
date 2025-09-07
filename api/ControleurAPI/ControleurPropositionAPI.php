<?php

require_once 'modele/Proposition.php';

class ControleurPropositionAPI {

    public static function GET($route) {
        $pattern = '/^api\/proposition\/([1-9][0-9]*)$/';

        // exemple d'uri : https://projets.iut-orsay.fr/saes3-wsimion/api/proposition/1
        if(preg_match($pattern, $route, $matches)){
            $ID_proposition = $matches[1];
            $reponse = Proposition::getObjetById($ID_proposition);
            if(isset($reponse["status"])){
                $reponse["message"] = "Proposition non trouvé";
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
            $reponse = Proposition::getAll();
            if(isset($reponse["status"])){
                $reponse["message"] = "Proposition non trouvé";
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


    public static function POST($route) {
        $data = json_decode(file_get_contents("php://input"), true);

        if ($route === '/api/proposition') {
            if (isset($data['titre'], $data['description'], $data['dureeMaximale'], $data['dureeMinimale'], $data['idTheme'], $data['idMembre'])) {
                $titre = $data['titre'];
                $description = $data['description'];
                $dureeMaximale = $data['dureeMaximale'];
                $dureeMinimale = $data['dureeMinimale'];
                $idTheme = $data['idTheme'];
                $idMembre = $data['idMembre'];

                $reponse = Proposition::addProposition([
                    'titre' => $titre,
                    'description' => $description,
                    'dureeMaximale' => $dureeMaximale,
                    'dureeMinimale' => $dureeMinimale,
                    'idTheme' => $idTheme,
                    'idMembre' => $idMembre
                ]);
                
                if ($reponse) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Proposition ajoutée avec succès'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => "Erreur lors de l'ajout de la proposition"
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Champs manquants (titre, description, durée, thème, membre)'
                ]);
            }
        }
    }

    /**
     * Méthode pour gérer la mise à jour d'une proposition
     */
    public static function PUT($segmentsURI) {
        $data = json_decode(file_get_contents("php://input"), true);
        $pattern = '/^api\/proposition\/([1-9][0-9]*)$/';

        if(preg_match($pattern, $route, $matches)){
            $id = $matches[1];;

            if (isset($data['titre'], $data['description'], $data['dureeMaximale'], $data['dureeMinimale'], $data['idTheme'], $data['idMembre'], $data['budget'])) {
                $titre = $data['titre'];
                $description = $data['description'];
                $dureeMaximale = $data['dureeMaximale'];
                $dureeMinimale = $data['dureeMinimale'];
                $idTheme = $data['idTheme'];
                $idMembre = $data['idMembre'];
                $budget = $data['budget'];

                $reponse = Proposition::updateProposition($id, [
                    'titre' => $titre,
                    'description' => $description,
                    'dureeMaximale' => $dureeMaximale,
                    'dureeMinimale' => $dureeMinimale,
                    'idTheme' => $idTheme,
                    'idMembre' => $idMembre,
                    'budget' => $budget
                ]);
                
                if ($reponse) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Proposition mise à jour avec succès'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erreur lors de la mise à jour de la proposition'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Champs manquants pour la mise à jour (titre, description, durée, thème, membre, budget)'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID de la proposition non spécifié'
            ]);
        }
    }

}
?>