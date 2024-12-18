<?php
// app/controllers/MonEspaceController.php
class ConnexionController {
    public function afficherConnexion() {
        // Démarrer la session (si elle n'est pas déjà démarrée)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Inclure la vue
        require 'app/view/pages/Connexion.php';
    }
}
?>