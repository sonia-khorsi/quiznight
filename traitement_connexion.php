<?php
session_start();
require 'Connection_BDD.php';
//ici on essaye de ce connecter mais :

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = Connection::getPDO();
    
    // Nettoyage des entrées
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
   
    
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

