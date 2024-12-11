<?php
// app/controllers/MonEspaceController.php
class MonEspaceController {
    public function afficherMonEspace() {
        // Démarrer la session (si elle n'est pas déjà démarrée)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Marquer la page intermédiaire comme visitée
        $_SESSION['mon_espace_visite'] = true;

        // Inclure la vue
        require 'app/view/pages/profils.php';
    }
}
