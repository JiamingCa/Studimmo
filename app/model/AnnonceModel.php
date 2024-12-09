<?php
// app/model/AnnonceModel.php

class AnnonceModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupère toutes les annonces d'un utilisateur
    public function getAnnoncesByUser($userId) {
        $query = $this->pdo->prepare("SELECT a.*, g.id_galerie, p.path 
                                      FROM annonce a
                                      LEFT JOIN galerie g ON a.id_annonce = g.annonce_id
                                      LEFT JOIN photo p ON g.id_galerie = p.galerie_id
                                      WHERE a.utilisateur_id = :userId
                                      GROUP BY a.id_annonce");
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getVuesParMois($userId) {
        $query = $this->pdo->prepare("SELECT a.id_annonce, a.titre, MONTH(v.date_vue) AS mois, COUNT(v.id) AS total
                                      FROM annonce a
                                      LEFT JOIN vue v ON a.id_annonce = v.annonce_id
                                      WHERE a.utilisateur_id = :userId
                                      GROUP BY a.id_annonce, mois
                                      ORDER BY a.id_annonce, mois ASC");
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC); // Renvoie un tableau associatif
    }
    public function getCandidaturesParStatut($userId) {
        $query = $this->pdo->prepare("SELECT a.id_annonce, a.titre, c.statut, COUNT(c.id_candidature) AS total
                                      FROM annonce a
                                      LEFT JOIN candidature c ON a.id_annonce = c.annonce_id
                                      WHERE a.utilisateur_id = :userId
                                      GROUP BY a.id_annonce, c.statut");
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFavorisParAnnonce($userId) {
        $query = $this->pdo->prepare("SELECT a.id_annonce, a.titre, COUNT(f.id_favoris) AS total
                                      FROM annonce a
                                      LEFT JOIN favoris f ON a.id_annonce = f.annonce_id
                                      WHERE a.utilisateur_id = :userId
                                      GROUP BY a.id_annonce");
        $query->execute(['userId' => $userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
