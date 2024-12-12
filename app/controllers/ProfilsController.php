<?php
// app/controllers/ProfilsController.php
require_once 'app/model/ProfilsModel.php';

class ProfilsController {
    private $profilsModel;

    public function __construct($pdo) {
        $this->profilsModel = new ProfilsModel($pdo);
    }

    // Affiche les informations du profil utilisateur
    public function afficherProfils($userId) {
        $utilisateur = $this->profilsModel->getUtilisateurById($userId);
        require 'app/view/pages/profils.php'; // Inclut la vue pour afficher le profil
    }

    // Met à jour les informations du profil utilisateur
    // data c'est les info que l'utisateur a mis pour changer ces info 
    public function modifierProfil($userId, $data) {
        // Validation et traitement des données si nécessaire
        if (isset($data['nom'], $data['prenom'], $data['email'], $data['telephone'])) {
            $updated = $this->profilsModel->updateUtilisateur($userId, [
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'photo' => $data['photo'] ?? null // Facultatif
            ]);

            
        } else {
            // Message d'erreur si les données sont invalides
            header('Location: /profil?error=invalid_data');
            exit;
        }
    }
}
?>