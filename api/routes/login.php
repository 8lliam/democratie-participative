<?php
// Vérification que la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données JSON envoyées par le client
    $data = json_decode(file_get_contents('php://input'), true);

    // Vérification que les champs nécessaires sont présents
    if (isset($data['email']) && isset($data['mdp'])) {
        $email = $data['email'];
        $mdp = $data['mdp'];

        // Connexion à la base de données et vérification des identifiants
        $pdo = connexionBD();
        $stmt = $pdo->prepare("
            SELECT ID_Internaute, Prenom_Internaute 
            FROM Internaute 
            WHERE Email_Internaute = :email AND MDP_Internaute = :mdp
        ");
        $stmt->execute([
            'email' => $email,
            'mdp' => $mdp
        ]);
        $user = $stmt->fetch();

        if ($user) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Connexion réussie',
                'user_id' => $user['ID_Internaute'],
                'prenom_id' => $user['Prenom_Internaute'] // Inclure le prénom
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Identifiants incorrects']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Champs manquants (email ou mdp)']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
}
?>
