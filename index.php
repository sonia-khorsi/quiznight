<?php
include 'Connection_BDD.php';  // Vérifie si le chemin est correct

// Récupérer une instance de PDO
$pdo = Connection::getPDO();  // Cette ligne doit renvoyer un objet PDO

if ($pdo) {
    // Si la connexion est établie, exécuter la requête
    $sql = "SELECT * FROM quiz LIMIT 1";
    $stmt = $pdo->query($sql);

    // Vérifier si une question a été trouvée
    if ($stmt->rowCount() > 0) {
        // Récupérer la première question
        $question = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $question = null; // Si aucune question n'est trouvée, définir $question à null
    }
} else {
    die("La connexion à la base de données a échoué.");
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Quiznight</title>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-title">
            <h1>Quiznight</h1> <!-- Titre à l'intérieur de la navigation -->
        </div>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="connexion.html">Se connecter</a></li>
        </ul>
    </nav>

    <!-- Liste des thèmes -->
    <div class="themes">
        <details>
            <summary>Animaux</summary>
            <h2>test</h2>
        </details>
        <details>
            <summary>Arts</summary>
            <h2>test</h2>
        </details>
        <details>
            <summary>Mangas</summary>
            <h2>test</h2>
        </details>
        <details>
            <summary>Cinéma</summary>
            <h2>test</h2>
        </details>
        <details>
            <summary>Musique</summary>
            <h2>test</h2>
        </details>
        <details>
            <summary>Football</summary>
            <h2>test</h2>
        </details>
    </div>

    <!-- Affichage de la question du quiz -->
    <?php if ($question): ?>
        <section class="quiz-container">
            <h3>Question du quiz :</h3>
            <p><?php echo htmlspecialchars($question['question']); ?></p> <!-- Affichage de la question -->
            <ul>
                <li><?php echo htmlspecialchars($question['reponse1']); ?></li>
                <li><?php echo htmlspecialchars($question['reponse2']); ?></li>
                <li><?php echo htmlspecialchars($question['reponse3']); ?></li>
                <li><?php echo htmlspecialchars($question['reponse4']); ?></li>
            </ul>
        </section>
    <?php else: ?>
        <p>Aucune question trouvée.</p>
    <?php endif; ?>

</body>
</html>
