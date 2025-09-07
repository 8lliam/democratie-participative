<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données JSON envoyées par le client
    $data = json_decode(file_get_contents('php://input'), true);

    // Vérification que l'ID utilisateur est présent
    if (isset($data['id'])) {
        $id = $data['id'];

        // Connexion à la base de données pour récupérer les informations de l'utilisateur
        $pdo = connexionBD();
        $stmt = $pdo->prepare("
            SELECT Nom_Internaute, Prenom_Internaute, Email_Internaute, CodePostal_Internaute
            FROM Internaute 
            WHERE ID_Internaute = :id
        ");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'nom' => $user['Nom_Internaute'],
                    'prenom' => $user['Prenom_Internaute'],
                    'email' => $user['Email_Internaute'],
                    'codePostal' => $user['CodePostal_Internaute']
                ]
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Utilisateur non trouvé']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID utilisateur manquant']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
}
?>
