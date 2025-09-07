<link href="css/Accueil.css" rel="stylesheet">
<link href="css/stylesConnectee.css" rel="stylesheet">
<header>
    <h1>
    <?php
            echo 'Bonjour ' . $prenomInternaute;
    ?>
    </h1>
</header>
<main>
<section id="nouveautes">
        <h2>Nouveautés de notre application de vote</h2>
        <article class="nouveaute">
            <div class="nouveaute-content">
                <h3>Choix collaboratif</h3>
                <p>Notre application introduit le <strong>choix collaboratif</strong>, une fonctionnalité innovante permettant aux utilisateurs de participer à la création de propositions ensemble.<br> Grâce à cette option, vous pouvez :</p>
                <ul>
                    <li>Suggérer des idées en temps réel.</li>
                    <li>Voter pour affiner les propositions.</li>
                    <li>Travailler en groupe pour arriver à un consensus.</li>
                </ul>
            </div>
            <div class="image">
                <img src="img/choixCollaboratif.jpg" alt="Choix collaboratif">
            </div>
        </article>

        <article class="nouveaute">
            <div class="nouveaute-content">
                <h3>Statistiques instantanées</h3>
                <p>Obtenez des retours immédiats grâce à des statistiques claires et dynamiques dès que les votes sont enregistrés.</p>
                <p>Cette fonctionnalité inclut des graphiques interactifs et des tableaux comparatifs, vous permettant de :</p>
                <ul>
                    <li>Analyser les données en temps réel.</li>
                    <li>Identifier les tendances et les préférences des participants.</li>
                    <li>Prendre des décisions basées sur des informations précises et actualisées.</li>
                </ul>
                <p>Les graphiques sont personnalisables, offrant plusieurs styles visuels, comme des diagrammes à barres, des camemberts ou des courbes.<br> Vous pouvez également exporter les résultats pour les partager facilement avec votre équipe ou vos partenaires.</p>
            </div>
            <div class="image">
                <img src="img/statistiqueInstantanee.jpg" alt="Statistiques instantanées">
            </div>
        </article>
    </section>
</main>

</body>
</html>
