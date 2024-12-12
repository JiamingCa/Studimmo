<?php
// app/model/ProfilsModel.php

class ProfilsModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupère les informations d'un utilisateur par son ID
    public function getUtilisateurById($userId) {
        $query = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id_Utilisateur = :id");
        $query->execute(['id' => $userId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Met à jour les informations d'un utilisateur
    
    public function updateUtilisateur($userId, $data) {
        $query = $this->pdo->prepare(
            "UPDATE utilisateur 
            SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, photo = :photo
            WHERE id_Utilisateur = :id"
        );

        return $query->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'photo' => $data['photo'],
            'id' => $userId
        ]);
    }
}
?>
