<?php
session_start();
require 'Connection_BDD.php';

// Vérification des droits admin
if (!isset($_SESSION['user_id']) || !$_SESSION['user_id']) {
    header('Location: index.php');
    exit();
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = htmlspecialchars($_POST['question']);
    $choix = htmlspecialchars($_POST['choices']);
    $reponse = htmlspecialchars($_POST['correct_answer']);
    $theme = htmlspecialchars($_POST['theme']);

    try {
        $pdo = Connection::getPDO();
        $stmt = $pdo->prepare("
            INSERT INTO quiz 
            (questions, `choix de réponses`, réponses, theme)
            VALUES (?, ?, ?, 0, ?)
        ");
        $stmt->execute([$question, $choix, $reponse, $essais, $theme]);
        
        header('Location: gestion_quiz.php');
        exit();
    } catch (PDOException $e) {
        $error = "Erreur lors de la création du quiz : " . $e->getMessage();
    }
}

// Récupération des quiz existants
$pdo = Connection::getPDO();
$quiz = $pdo->query("SELECT * FROM quiz")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des quiz</title>
    <style>
        .quiz-form {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-title">Quiznight Admin</div>
        <ul>
            <li><a href="gestion_quiz.php">Créer un quiz</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </nav>

    <div class="quiz-form">
        <h2>Créer un nouveau quiz</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Question :</label>
                <textarea name="question" required style="width: 100%"></textarea>
            </div>
            
            <div class="form-group">
                <label>Choix de réponses (séparés par des virgules) :</label>
                <input type="text" name="choices" required style="width: 100%">
            </div>
            
            <div class="form-group">
                <label>Réponse correcte :</label>
                <input type="text" name="correct_answer" required>
            </div>
            
            <div class="form-group">
                <label>theme :</label>
                <input type="text" name="theme" required>
            </div>
            
            <div class="form-group">
                <label>Nombre d'essais autorisés :</label>
                <input type="number" name="attempts" value="0" min="0">
            </div>
            
            <button type="submit">Créer le quiz</button>
        </form>

        <h2>Quiz existants</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Choix</th>
                <th>Réponse</th>
                <th>Essais</th>
                <th>theme</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($quiz as $q): ?>
            <tr>
                <td><?= $q['id'] ?></td>
                <td><?= $q['questions'] ?></td>
                <td><?= $q['choix'] ?></td>
                <td><?= $q['réponses'] ?></td>
                <td>0</td>
                <td><?= $q['theme'] ?></td>
                <td>
                    <!-- Ajouter les fonctionnalités d'édition/suppression ici -->
                    <button>Éditer</button>
                    <button>Copier</button>
                    <button>Supprimer</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>