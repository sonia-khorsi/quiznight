<?php
include 'Connection_BDD.php';  // Vérifie si le chemin est correct

// Récupérer une instance de PDO
$pdo = Connection::getPDO();  // Cette ligne doit renvoyer un objet PDO

// Vérifier si un thème est sélectionné, sinon utiliser "cinema" par défaut
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'cinema';  // Récupérer le thème via GET ou 'cinema' par défaut

// Requête SQL pour récupérer les questions filtrées par thème
$query = 'SELECT * FROM quiz WHERE theme = :theme';  // Utilisation d'un paramètre préparé pour éviter les injections SQL
$stmt = $pdo->prepare($query);
$stmt->bindParam(':theme', $theme, PDO::PARAM_STR);  // Lier le paramètre du thème
$stmt->execute();

// Récupérer les résultats sous forme de tableau associatif
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <?php if (!empty($choix)): ?>
    <ul>
        <?php foreach ($choix as $choixReponse): ?>
            <li><?php echo htmlspecialchars($choixReponse['choix']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun choix de réponse disponible.</p>
<?php endif; ?>
    </section>
        </details>
    </div>

    

</body>
</html>
