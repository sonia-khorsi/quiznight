<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: connexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Quiznight</title>
</head>
<body>
    <nav>
        <div class="nav-title">Quiznight Admin</div>
        <ul>
            <li><a href="gestion_quiz.php">Gestion des quiz</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </nav>
    <h1>Bienvenue Administrateur <?= htmlspecialchars($_SESSION['username']) ?> !</h1>
    <!-- Contenu du dashboard admin -->
</body>
</html>