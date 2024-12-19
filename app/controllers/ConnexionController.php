<?php
// app/controllers/MonEspaceController.php
require('app/model/connexionfonction.php');
class ConnexionController {
    public function afficherConnexion() {
        if ($_GET['action'] === 'inscription') {
            $redirectUrl = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.php';
            header("Location: index.php?page=Inscription&redirect_url=" . urlencode($redirectUrl));
            exit();
        }
        // Inclure la vue
        require 'app/view/pages/Connexion.php';
    }
}
?>