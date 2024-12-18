<?php
// app/controllers/MonEspaceController.php
class HomepageController {
    public function afficherHomepage() {
        // Démarrer la session (si elle n'est pas déjà démarrée)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Inclure la vue
        require 'app/view/pages/homepage.php';
    }
}
?>