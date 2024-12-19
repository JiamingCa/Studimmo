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

    public function modifier($userId) {
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
    public function modifierSecurite($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
    
            // Validation : Vérifiez que les deux mots de passe correspondent
            if ($newPassword !== $confirmPassword) {
                echo "Les mots de passe ne correspondent pas.";
                exit;
            }
    
            // Validation : Vérifiez la complexité du mot de passe
            if (strlen($newPassword) < 8) {
                echo "Le mot de passe doit comporter au moins 8 caractères.";
                exit;
            }

            if (!preg_match('/[^\w]/', $newPassword)) {
                echo "Le mot de passe doit comporter au moins un caractère spécial.";
                exit;
            }
    
            // Hachage du mot de passe
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
            // Mise à jour du mot de passe dans la base de données
            $query = $this->pdo->prepare("UPDATE utilisateur SET mot_de_passe = :mot_de_passe WHERE id_Utilisateur = :id");
            $query->bindParam(':mot_de_passe', $hashedPassword);
            $query->bindParam(':id', $userId);
    
            if ($query->execute()) {
                echo "Mot de passe modifié avec succès.";
                // Redirection vers la page de profil après la modification
                header('Location: index.php?page=profils');
                exit;
            } else {
                echo "Erreur lors de la mise à jour du mot de passe.";
            }
        }
    }
    
    
}
?>
