__<?php
// Définir la classe Connection
class Connection {
    // Méthode statique pour obtenir l'objet PDO
    public static function getPDO(): PDO
    {
        try {
            // Essayer de se connecter à la base de données
            return new PDO('mysql:dbname=quiz-night;host=localhost', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Gestion des erreurs en mode exception
            ]);
        } catch (PDOException $e) {
            // Afficher un message d'erreur en cas d'échec de connexion
            die("Échec de la connexion à la base de données : " . $e->getMessage());
        }
    }
}
?>
