<?php
// Inclure la connexion à la base de données
require_once '../API/BD/connexionBD.php';  // Ajuste le chemin si nécessaire

// Fonction pour effectuer une requête GET à l'API
function getApiData($route) {
    $url = 'http://localhost/saes3-wsimion/API/APIRest.php?route=' . $route;
    return json_decode(file_get_contents($url), true);
}

// Fonction pour effectuer une requête POST à l'API
function postApiData($route, $data) {
    $url = 'http://localhost/saes3-wsimion/API/APIRest.php?route=' . $route;
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    return json_decode(file_get_contents($url, false, $context), true);
}

// Récupérer les messages
$messages = getApiData('getMessages');

// Récupérer les commentaires pour chaque message
$comments = [];
foreach ($messages as $message) {
    $message_id = $message['id'];
    $comments[$message_id] = getApiData('getComments?message_id=' . $message_id);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Discussions</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<h1>Discussions</h1>

<!-- Affichage des messages -->
<div id="messages">
    <?php foreach ($messages as $message): ?>
        <div class="message">
            <p><strong><?= htmlspecialchars($message['username']); ?> :</strong> <?= htmlspecialchars($message['content']); ?></p>
            <p><em><?= $message['date_message']; ?></em></p>

            <!-- Affichage des commentaires pour ce message -->
            <div class="comments">
                <h3>Commentaires :</h3>
                <?php if (isset($comments[$message['id']])): ?>
                    <?php foreach ($comments[$message['id']] as $comment): ?>
                        <div class="comment">
                            <p><strong><?= htmlspecialchars($comment['username']); ?> :</strong> <?= htmlspecialchars($comment['content']); ?></p>
                            <p><em><?= $comment['date_comment']; ?></em></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Formulaire d'ajout de commentaire -->
            <form action="chat.php" method="POST">
                <input type="hidden" name="message_id" value="<?= $message['id']; ?>">
                <textarea name="comment_content" placeholder="Ajouter un commentaire..." required></textarea>
                <button type="submit" name="submit_comment">Envoyer</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<!-- Formulaire d'ajout de message -->
<form action="chat.php" method="POST" id="new_message">
    <textarea name="message_content" placeholder="Écrire un message..." required></textarea>
    <button type="submit" name="submit_message">Envoyer</button>
</form>

<?php
// Gérer l'ajout de message via l'API
if (isset($_POST['submit_message'])) {
    $message_content = $_POST['message_content'];
    $username = 'Utilisateur';  // À remplacer par la session ou l'utilisateur actuel

    $data = [
        'username' => $username,
        'content' => $message_content
    ];

    // Envoi de la requête POST à l'API
    $response = postApiData('createMessage', $data);

    // Vérifier la réponse de l'API
    if ($response['status'] == 'success') {
        header("Location: chat.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout du message.";
    }
}

// Gérer l'ajout de commentaire via l'API
if (isset($_POST['submit_comment'])) {
    $comment_content = $_POST['comment_content'];
    $message_id = $_POST['message_id'];
    $username = 'Utilisateur';  // À remplacer par la session ou l'utilisateur actuel

    $data = [
        'message_id' => $message_id,
        'username' => $username,
        'content' => $comment_content
    ];

    // Envoi de la requête POST à l'API
    $response = postApiData('createComment', $data);

    // Vérifier la réponse de l'API
    if ($response['status'] == 'success') {
        header("Location: chat.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout du commentaire.";
    }
}
?>

</body>
</html>
