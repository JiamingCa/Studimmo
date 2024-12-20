<?php
// app/controllers/AccueilController.php
class AccueilController {
    public function afficherAccueil() {
        
        // Inclure la vue
        require 'app/view/pages/Accueil.php';
    }
}
?>