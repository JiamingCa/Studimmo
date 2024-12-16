<?php
// app/controllers/ProfilsController.php
require 'app/model/ProfilsModel.php';

class ProfilsController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function afficherProfils($userId) {
        // Récupérer les informations de l'utilisateur depuis la base de données
        $utilisateur = selectUsers($this->pdo, $userId)->fetch();

        // Inclure la vue du profil avec les données utilisateur
        require 'app/view/pages/profils.php';
    }

    public function modifierProfils($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données envoyées via le formulaire
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $telephone = $_POST['telephone'] ?? '';
            $mot_de_passe = $_POST['mot_de_passe'] ?? '';


            // Mettre à jour les informations dans la base de données
            updateUsers($this->pdo, $nom, $prenom, $email, $telephone, $userId);

            // Rediriger vers la page de profil pour refléter les modifications
            header('Location: index.php?page=profils');
            exit;
        }
    }
}
?>
