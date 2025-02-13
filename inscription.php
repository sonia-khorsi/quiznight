<!-- Récupère le fichier de connexion à la base de données -->

<!-- Récupère le fichier de connexion à la base de données -->

<?php session_start();
require "Connection_BDD.php";
if (isset($_SESSION["nom_utilisateur"])) {
    header('Location: index.php');
}

if ($_POST) {
    $nom_utilisateur = $_POST["nom_utilisateur"];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hash le mot de passe pour le stocker dans la base de données

    // Prépare la requête pour sélectionner les données de l'utilisateur, permettant de vérifier si le nom d'utilisateur est déjà utilisé ou non.
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
    $requete->execute(['nom_utilisateur' => $nom_utilisateur]);
    $reponse = $requete->fetch(PDO::FETCH_ASSOC);

    if ($reponse) {
        echo "Nom d'utilisateur déjà utilisé";
    } else {
        $requete = $connexion->prepare("INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe) VALUES (:nom_utilisateur, :mot_de_passe)");
        $requete->execute([
            'nom_utilisateur' => $nom_utilisateur,
            'mot_de_passe' => $mot_de_passe
        ]);
        header('Location: .php');
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="styles.css" >
    <title>Inscription</title>
</head>
<header>
        <nav>
            <ul>
                <div>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="connexion.php">Se Connecter</a></li>
                    <li><a href="inscription.php">S'inscrire</a></li>

                </div>
                <?php if (!isset($_SESSION['nom_utilisateur'])) {
                    echo "<li><a href='>connexion</a></li>";
                    
                } else {
                    echo "<div>";
                    echo "<li><a href='#'>" . $_SESSION['nom_utilisateur'] . "</a></li>";
                    echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
                    echo "</div>";
                }
                ?>
            </ul>
        </nav>
    </header>

<body>
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
        <h2>S'inscrire</h2>
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
   
</body>
    </main>
</html>