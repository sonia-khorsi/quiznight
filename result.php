<?php
// Questions et réponses pour chaque thème (répétition pour le traitement)
$questions = [
    'cinema' => [
        ['question' => 'Qui a réalisé "Inception" ?', 'answer' => 'Christopher Nolan'],
        ['question' => 'Quel film a remporté l’Oscar du meilleur film en 2020 ?', 'answer' => 'Parasite']
    ],
    'musique' => [
        ['question' => 'Quel est le nom de l\'album le plus vendu de Michael Jackson ?', 'answer' => 'Thriller'],
        ['question' => 'Qui a chanté "Like a Rolling Stone" ?', 'answer' => 'Bob Dylan']
    ],
    'football' => [
        ['question' => 'Quel pays a remporté la Coupe du Monde de football en 2018 ?', 'answer' => 'France'],
        ['question' => 'Qui est le meilleur buteur de l\'histoire de la Ligue des Champions ?', 'answer' => 'Cristiano Ronaldo']
    ],
    'animaux' => [
        ['question' => 'Quel est l\'animal le plus rapide du monde ?', 'answer' => 'Guépard'],
        ['question' => 'Combien de cœurs a un poulpe ?', 'answer' => '3']
    ],
    'art' => [
        ['question' => 'Qui a peint "La Joconde" ?', 'answer' => 'Leonardo da Vinci'],
        ['question' => 'Quel mouvement artistique est associé à Salvador Dalí ?', 'answer' => 'Surréalisme']
    ],
    'manga' => [
        ['question' => 'Qui est le créateur de "Naruto" ?', 'answer' => 'Masashi Kishimoto'],
        ['question' => 'Dans "One Piece", quel est le rêve de Luffy ?', 'answer' => 'Devenir le roi des pirates']
    ]
];

// Récupérer les réponses soumises
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'cinema';
$selectedQuestions = $questions[$theme];
$score = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats - Quiz</title>
</head>
<body>
    <h1>Résultats du quiz sur le thème : <?php echo ucfirst($theme); ?></h1>
    <p>Votre score : <?php echo $score; ?> / <?php echo count($selectedQuestions); ?></p>

    <ul>
    <?php foreach ($selectedQuestions as $index => $question): ?>
        <li>
            <strong>Question :</strong> <?php echo $question['question']; ?><br>
            <strong>Votre réponse :</strong> <?php echo isset($_POST["q$index"]) ? $_POST["q$index"] : 'Aucune réponse'; ?><br>
            <strong>Bonne réponse :</strong> <?php echo $question['answer']; ?><br>
            <?php
            // Vérification de la réponse et calcul du score
            if (isset($_POST["q$index"]) && $_POST["q$index"] === $question['answer']) {
                $score++;
                echo "<strong>Votre réponse est correcte !</strong><br><br>";
            } else {
                echo "<strong>Votre réponse est incorrecte.</strong><br><br>";
            }
            ?>
            
        </li>
    <?php endforeach; ?>
    </ul>

    <p><strong>Votre score final : </strong> <?php echo $score; ?> / <?php echo count($selectedQuestions); ?></p>
    <a href="index.php">Retour à la page d'accueil</a>
</body>
</html>
