<?php
// app/controllers/MonEspaceController.php
class DeconnexionController {
    public function afficherDeconnexion() {
        session_start(); // Démarre la session

        // Détruit toutes les variables de session
        session_unset();

        // Détruit la session
        session_destroy();

        // Redirige vers la page de connexion ou d'accueil
        header('Location: index.php?page=homepage'); // Remplacez `login.php` par la page souhaitée
        exit;
    }
}
