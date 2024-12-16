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
        $query = "SELECT nom, prenom, email, mot_de_passe, telephone, type FROM utilisateur WHERE id_Utilisateur = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Vérifier si un utilisateur a été trouvé
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$utilisateur) {
            echo "Utilisateur introuvable.";
            return;
        }

        // Extraire les informations pour les passer à la vue
        $nom = $utilisateur['nom'];
        $prenom = $utilisateur['prenom'];
        $email = $utilisateur['email'];
        $mot_de_passe = $utilisateur['mot_de_passe'];
        $telephone = $utilisateur['telephone'];
        $type = $utilisateur['type'];

        // Inclure la vue du profil
        require 'app/view/pages/profils.php';
    }
}
?>
