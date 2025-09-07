<?php
// Toujours définir les en-têtes de l'API
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json");

// Récupère la méthode HTTP de la requête
$method = $_SERVER['REQUEST_METHOD'];
// Récupère l'URI pour déterminer la ressource demandée
$uri = $_SERVER['REQUEST_URI'];

// Extraction de la route
// Exemple : /index.php/api/users devient /api/users

$route = str_replace("/saes3-wsimion/index.php/", "", $uri);
$fragments = explode("/", $route);
switch ($route) {
    case ($fragments[0] == 'api' && $fragments[1] == 'internaute'):
        require_once 'ControleurAPI/ControleurInternauteAPI.php';
        ControleurInternauteAPI::$method($route);
        break;
    case ($fragments[0] == 'api' && $fragments[1] == 'login'):
        require_once 'ControleurAPI/ControleurLoginAPI.php';
        ControleurLoginAPI::$method($route);
        break;
    case ($fragments[0] == 'api' && $fragments[1] == 'groupe'):
        require_once 'ControleurAPI/ControleurGroupeAPI.php';
        ControleurGroupeAPI::$method($route);
        break;
    case ($fragments[0] == 'api' && $fragments[1] == 'proposition'):
        require_once 'ControleurAPI/ControleurPropositionAPI.php';
        ControleurPropositionAPI::$method($route);
        break;
    default:
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Route non trouvée']);
        break; 
    }

?>