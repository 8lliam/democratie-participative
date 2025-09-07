<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données JSON envoyées par le client
    $data = json_decode(file_get_contents('php://input'), true);

    // Vérification que l'ID utilisateur est fourni
    if (isset($data['id'])) {
        $id = $data['id'];
        $fieldsToUpdate = [];

        // Ajout des champs dynamiquement selon ce qui est fourni dans la requête
        if (!empty($data['nom'])) {
            $fieldsToUpdate['Nom_Internaute'] = $data['nom'];
        }
        if (!empty($data['prenom'])) {
            $fieldsToUpdate['Prenom_Internaute'] = $data['prenom'];
        }
        if (!empty($data['email'])) {
            $fieldsToUpdate['Email_Internaute'] = $data['email'];
        }
        if (!empty($data['codePostal'])) {
            $fieldsToUpdate['CodePostal_Internaute'] = $data['codePostal'];
        }
        if (!empty($data['mdp'])) {
            $fieldsToUpdate['MDP_Internaute'] = password_hash($data['mdp'], PASSWORD_DEFAULT);
        }

        // Construction dynamique de la requête SQL
        $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($fieldsToUpdate)));
        $fieldsToUpdate['id'] = $id; // Ajout de l'ID pour la clause WHERE

        if ($setClause) {
            $pdo = connexionBD();
            $stmt = $pdo->prepare("UPDATE Internaute SET $setClause WHERE ID_Internaute = :id");
            $success = $stmt->execute($fieldsToUpdate);

            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Informations mises à jour avec succès']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la mise à jour des informations']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Aucun champ à mettre à jour']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID utilisateur manquant']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
}
?>
