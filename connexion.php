<?php 

 session_start();
require "quiznight.sql";


if ($_POST) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    //Vérifie si le formulaire a déjà été envoyé (Si $_POST n'est pas vide)

    // Prépare la requête pour sélectionner les données de l'utilisateur, permettant de vérifier si les informations sont correctes ou non.
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
    $requete->execute(['nom_utilisateur' => $nom_utilisateur]);
    $reponse = $requete->fetch(PDO::FETCH_ASSOC);
    $mot_de_passe = $_POST['mot_de_passe'];

    //Vérifie si le mot de passe correspond au mot de passe hashé dans la base de données. Si les identifiants sont bons, on stocke dans la session. Sinon, on affiche un message d'erreur.
    if ($reponse && password_verify($mot_de_passe, $reponse['mot_de_passe'])) {
        $_SESSION['nom_utilisateur'] = $_POST['nom_utilisateur'];
        $_SESSION['id_utilisateur'] = $reponse['id_utilisateur'];
        $_SESSION['droits'] = $reponse['droits_utilisateur'];
        header('Location: index.php');
    } else {
        echo 'Identifiant ou mot de passe incorrect';
    }
}
echo password_hash ();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Se connecter - Quiznight</title>
</head>
<body>
    <!-- Navigation -->
    <nav>
        
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="connexion.html">Se connecter</a></li>
            </ul>
        
    </nav>

                </div>
                <?php if (!isset($_SESSION['nom_utilisateur'])) {
                    echo "<li><a href=''>Connexion</a></li>";
                    echo "<li><a href=''>S'inscrire</a></li>";
                } else {
                    echo "<div>";
                    echo "<li><a href='#'>" . $_SESSION['nom_utilisateur'] . "</a></li>";
                    echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
                    echo "</div>";
                }
                ?>
                <!-- Formulaire de connexion -->
    <section class="login-container">
        <h2>Se connecter</h2>
        <form action="dashboard.html" method="POST" class="login-form">
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

    <footer></footer>
            </ul>
        </nav>
    </header>
    <main>
    <
