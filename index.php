<?php
include 'Connection_BDD.php';

$pdo = Connection::getPDO();

$queryAll = "SELECT * FROM quiz ORDER BY `theme`";
$stmtAll = $pdo->query($queryAll);
$allQuestions = $stmtAll->fetchAll(PDO::FETCH_ASSOC);

$groupedQuestions = [];
foreach ($allQuestions as $question) {
    $theme = $question['theme'];
    if (!isset($groupedQuestions[$theme])) {
        $groupedQuestions[$theme] = [];
    }
    $groupedQuestions[$theme][] = $question;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Quiznight</title>
    <style>
        .correct-answer { display: none; }
        .choice {
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .choice.selected { pointer-events: none; }
        .choice.correct { background-color: #d4edda !important; }
        .choice.incorrect { background-color: #f8d7da !important; }
    </style>
</head>
<body>

    <nav>
        <div class="nav-title">
            <h1>Quiznight</h1>
        </div>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="connexion.php">Se connecter</a></li>
            <li><a href = "inscription.php"> S'inscrire</a></li>
        </ul>
    </nav>

    <!-- Le reste du contenu -->
    <div class="themes">
        <?php foreach ($groupedQuestions as $theme => $questions): ?>
            <details>
                <summary><?= htmlspecialchars(ucfirst($theme)) ?></summary>
                <ul>
                    <?php foreach ($questions as $question): ?>
                        <li class="question-container">
                            <h3><?= htmlspecialchars($question['questions']) ?></h3>
                            <ul class="choices-list">
                                <?php 
                                $choices = explode(', ', $question['choix']);
                                $correctAnswer = trim($question['réponses']);
                                foreach ($choices as $choice): 
                                    $trimmedChoice = trim($choice);
                                    $isCorrect = $trimmedChoice === $correctAnswer;
                                ?>
                                    <li class="choice" data-correct="<?= $isCorrect ? 'true' : 'false' ?>">
                                        <?= htmlspecialchars($trimmedChoice) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <p class="correct-answer">
                                <strong>Réponse correcte :</strong> 
                                <?= htmlspecialchars($correctAnswer) ?>
                            </p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </details>
        <?php endforeach; ?>
    </div>

    <script>
        document.querySelectorAll('.choice').forEach(choice => {
            choice.addEventListener('click', function() {
                // Désactiver les autres réponses
                const questionContainer = this.closest('.question-container');
                const allChoices = questionContainer.querySelectorAll('.choice');
                
                // Marquer la réponse sélectionnée
                allChoices.forEach(c => c.classList.add('selected'));
                
                // Vérifier la réponse
                const isCorrect = this.dataset.correct === 'true';
                
                // Appliquer le style
                this.style.backgroundColor = isCorrect ? '#d4edda' : '#f8d7da';
                this.style.borderLeft = `4px solid ${isCorrect ? '#28a745' : '#dc3545'}`;
                
                // Afficher la réponse correcte
                questionContainer.querySelector('.correct-answer').style.display = 'block';
                
                // Colorer toutes les réponses
                allChoices.forEach(c => {
                    if(c.dataset.correct === 'true') {
                        c.classList.add('correct');
                    } else {
                        c.classList.add('incorrect');
                    }
                });
            });
        });
    </script>
</body>
</html>