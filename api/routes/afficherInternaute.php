<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérification que les champs nécessaires sont présents
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Connexion à la base de données et vérification des identifiants
        $pdo = connexionBD();
        $stmt = $pdo->prepare("SELECT * FROM Internaute WHERE ID_Internaute = :id");
        $stmt->execute([
            'id' => $id
        ]);
        $user = $stmt->fetch();

        if ($user) {
            echo json_encode(['status' => 'success', 'message' => 'Connexion réussie', 'nom_id' => $user['Nom_Internaute'], 'prenom_id' => $user['Prenom_Internaute']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Identifiants incorrects']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Champs manquants (id)']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
}
?>