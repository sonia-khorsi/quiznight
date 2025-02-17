<?php
session_start();
$error = $_GET['error'] ?? null;
session_start();
require 'Connection_BDD.php';
//ici on essaye de ce connecter mais :

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = Connection::getPDO();
    
    // Nettoyage des entrées
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
   
    // Hash le mot de passe pour le stocker dans la base de données
    if ($_POST) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        echo  password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        // Recherche de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `nom _utilisateur` = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && $password === $user['mot _de _passe']) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nom _utilisateur'];
            $_SESSION['is_admin'] = $user['droits_ d\'administrateur'];
            
            // Redirection selon les droits
            if ($_SESSION['is_admin']) {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: user_dashboard.php');
            }
            exit();
        } else {
            header('Location: connexion.php?error=Identifiants incorrects');
            exit();
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        header('Location: connexion.php?error=Erreur de connexion');
        exit();
    }
} else {
    header('Location: connexion.php');
    exit();
}
}

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