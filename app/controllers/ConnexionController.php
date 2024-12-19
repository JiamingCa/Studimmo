<?php
// app/controllers/MonEspaceController.php
require('app/model/connexionfonction.php');
class ConnexionController {
    public function afficherConnexion() {
        
        // Inclure la vue
        require 'app/view/pages/Connexion.php';
    }
}
?>