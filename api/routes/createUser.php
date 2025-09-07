<?php
// Vérification que la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données JSON envoyées par le client
    $data = json_decode(file_get_contents('php://input'), true);

    // Affichage des données reçues pour déboguer
    var_dump($data);

    // Vérification que toutes les données nécessaires sont présentes
    if (isset($data['nom'], $data['prenom'], $data['email'], $data['mdp'], $data['codePostal'], $data['dateInscription'])) {
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $mdp = password_hash($data['mdp'], PASSWORD_DEFAULT); // On hash le mot de passe
        $codePostal = $data['codePostal'];
        $dateInscription = $data['dateInscription']; // Ou SYSDATE() si tu veux que la date soit actuelle

        // Connexion à la base de données
        $pdo = connexionBD();

        // Requête d'insertion
        $stmt = $pdo->prepare("
            INSERT INTO Internaute (Nom_Internaute, Prenom_Internaute, Email_Internaute, MDP_Internaute, CodePostal_Internaute, DateInscription_Internaute) 
            VALUES (:nom, :prenom, :email, :mdp, :codePostal, :dateInscription)
        ");

        // Exécution de la requête
        $success = $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mdp' => $mdp,
            'codePostal' => $codePostal,
            'dateInscription' => $dateInscription
        ]);

        // Vérification du succès
        if ($success) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Utilisateur créé avec succès.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Erreur lors de la création de l\'utilisateur.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Données manquantes (nom, prénom, email, codePostal, mdp, dateInscription)'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Méthode non autorisée'
    ]);
}
?>
