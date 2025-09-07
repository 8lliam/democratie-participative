<link href="css/stylesFormulaire.css" rel="stylesheet" />
<link href="css/stylesConnectee.css" rel="stylesheet">

<main>
  <div class="formulaireNonConnectée">
    <h1>Modifier mon profil</h1>
    <!-- Ajouter les messages en cas de modification succès et d'échecs (recopier un truc fait dans Profil.php) -->

    <form method="POST" action="index.php">
      <input type="hidden" name="controleur" value="ControleurInternaute" />
      <input type="hidden" name="action" value="modifierInternaute" />
      <label for="nom">Nom :</label>
      <input
        type="text"
        id="nom"
        name="nom"
        value="<?php echo $nomInternaute; ?>"
        required
      /><br /><br />

      <label for="prenom">Prénom :</label>
      <input
        type="text"
        id="prenom"
        name="prenom"
        value="<?php echo $prenomInternaute; ?>"
        required
      /><br /><br />

      <label for="email">Email :</label>
      <input
        type="email"
        id="email"
        name="email"
        value="<?php echo $emailInternaute; ?>"
        required
      /><br /><br />

      <label for="codePostal">Code Postal :</label>
      <input
        type="text"
        id="cp"
        name="cp"
        value="<?php echo $cpInternaute; ?>"
        required
      /><br /><br />

      <label for="currentPassword">Mot de passe :</label>
      <input
        type="text"
        id="mdp"
        name="mdp"
        value="<?php echo $mdpInternaute; ?>"
        required
      /><br /><br />

      <input type="submit" value="Mettre à jour" />
    </form>
    <!-- Afficher les messages de succès ou d'erreur -->
    <?php if (isset($statut) && $statut): ?>
        <p style="color: green;"><?= "Profil mis à jour avec succès" ?></p>
    <?php elseif (isset($error)): ?>
        <p style="color: red;"><?= "Erreurs ou champs manquants" ?></p>
    <?php endif; ?>
    <div>
</main>
