<?php
session_start();
$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Connexion - Quiznight</title>
</head>
<body>
    <nav>
        <div class="nav-title">
            <h1>Quiznight</h1>
        </div>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="connexion.php">Se connecter</a></li>
            <li><a href="inscription.php"> S'inscrire</a> </li>
        </ul>
    </nav>

    <section class="login-container">
        <h2>Se connecter</h2>
        <?php if ($error): 
            ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="traitement_connexion.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required placeholder="Entrez votre nom d'utilisateur">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required placeholder="Entrez votre mot de passe">
            </div>
            <button type="submit" class="btn-primary">Se connecter</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2025 Quiznight. Tous droits réservés.</p>
    </footer>
</body>
</html>