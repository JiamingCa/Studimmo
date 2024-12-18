<?php
require 'app/model/inscriptionfonction.php';
require 'app/model/registerUser.php';
require 'app/model/validateVerification.php';
// app/controllers/MonEspaceController.php
class InscriptionController {
    
    public function afficherInscription() {
        
        // Inclure la vue
        require 'app/view/pages/Inscription.php';
    }
}
?>