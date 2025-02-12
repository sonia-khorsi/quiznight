
/quiz/
├── index.php
├── questions.php
└── result.php
<?php
// page d'accueil avec les thèmes du quiz
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
    <h1>Bienvenue dans le Quiz</h1>
    <p>Choisissez un thème :</p>
    <ul>
        <li><a href="questions.php?theme=cinema">Cinéma</a></li>
        <li><a href="questions.php?theme=musique">Musique</a></li>
        <li><a href="questions.php?theme=football">Football</a></li>
        <li><a href="questions.php?theme=animaux">Animaux</a></li>
        <li><a href="questions.php?theme=art">Art</a></li>
        <li><a href="questions.php?theme=manga">Manga</a></li>
    </ul>
</body>
</html>
<?php
// Questions et réponses pour chaque thème
$questions = [
    'cinema' => [
        ['question' => 'Qui a réalisé "Inception" ?', 'options' => ['Christopher Nolan', 'Steven Spielberg', 'Quentin Tarantino'], 'answer' => 'Christopher Nolan'],
        ['question' => 'Quel film a remporté l’Oscar du meilleur film en 2020 ?', 'options' => ['Parasite', '1917', 'Joker'], 'answer' => 'Parasite']
    ],
    'musique' => [
        ['question' => 'Quel est le nom de l\'album le plus vendu de Michael Jackson ?', 'options' => ['Thriller', 'Bad', 'Dangerous'], 'answer' => 'Thriller'],
        ['question' => 'Qui a chanté "Like a Rolling Stone" ?', 'options' => ['Bob Dylan', 'Elvis Presley', 'John Lennon'], 'answer' => 'Bob Dylan']
    ],
    'football' => [
        ['question' => 'Quel pays a remporté la Coupe du Monde de football en 2018 ?', 'options' => ['France', 'Brésil', 'Allemagne'], 'answer' => 'France'],
        ['question' => 'Qui est le meilleur buteur de l\'histoire de la Ligue des Champions ?', 'options' => ['Cristiano Ronaldo', 'Lionel Messi', 'Raul'], 'answer' => 'Cristiano Ronaldo']
    ],
    'animaux' => [
        ['question' => 'Quel est l\'animal le plus rapide du monde ?', 'options' => ['Guépard', 'Aigle royal', 'Autruche'], 'answer' => 'Guépard'],
        ['question' => 'Combien de cœurs a un poulpe ?', 'options' => ['2', '3', '4'], 'answer' => '3']
    ],
    'art' => [
        ['question' => 'Qui a peint "La Joconde" ?', 'options' => ['Leonardo da Vinci', 'Pablo Picasso', 'Vincent van Gogh'], 'answer' => 'Leonardo da Vinci'],
        ['question' => 'Quel mouvement artistique est associé à Salvador Dalí ?', 'options' => ['Surréalisme', 'Cubisme', 'Impressionnisme'], 'answer' => 'Surréalisme']
    ],
    'manga' => [
        ['question' => 'Qui est le créateur de "Naruto" ?', 'options' => ['Masashi Kishimoto', 'Eiichiro Oda', 'Akira Toriyama'], 'answer' => 'Masashi Kishimoto'],
        ['question' => 'Dans "One Piece", quel est le rêve de Luffy ?', 'options' => ['Devenir le roi des pirates', 'Trouver le trésor', 'Devenir le plus fort'], 'answer' => 'Devenir le roi des pirates']
    ]
];

// Récupérer le thème
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'cinema';
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'musique';
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'football';
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'animaux';
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'art';
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'manga';

// Vérifier que le thème existe
if (!isset($questions[$theme])) {
    echo 'Thème invalide.';
    exit;
}

$selectedQuestions = $questions[$theme];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?php echo ucfirst($theme); ?></title>
</head>
<body>
    <h1>Quiz sur le thème : <?php echo ucfirst($theme); ?></h1>
    <form action="result.php?theme=<?php echo $_GET['theme']; ?>" method="POST">
        <?php foreach ($selectedQuestions as $index => $question): ?>
            <fieldset>
                <legend><?php echo $question['question']; ?></legend>
                <?php foreach ($question['options'] as $option): ?>
                    <label>
                        <input type="radio" name="q<?php echo $index; ?>" value="<?php echo $option; ?>" required> <?php echo $option; ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <button type="submit">Soumettre</button>
    </form>
</body>
</html>
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

foreach ($selectedQuestions as $index => $question) {
    if (isset($_POST["q$index"]) && $_POST["q$index"] === $question['answer']) {
        $score++;
    }
}

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
    <a href="index.php">Retour à la page d'accueil</a>
</body>
</html>
