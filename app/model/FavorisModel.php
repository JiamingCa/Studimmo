<?php
// app/model/FavorisModel.php

class FavorisModel {
    private $pdo;

    // Constructeur pour initialiser $pdo
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function countFavorisByUser($userId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM favoris WHERE utilisateur_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }


    public function getFavorisByUser($userId, $tri, $page, $parPage) {
        $orderBy = match ($tri) {
            'recent' => 'f.date_ajout DESC',
            'prix-asc' => 'a.prix ASC',
            'prix-desc' => 'a.prix DESC',
            'surface-asc' => 'a.surface ASC',
            'surface-desc' => 'a.surface DESC',
            default => 'f.date_ajout DESC'
        };
        $offset = ($page - 1) * $parPage;
    
        // Préparer la requête pour récupérer à la fois les images et l'état de favori
        $stmt = $this->pdo->prepare(
            "SELECT a.*, 
                    g.id_galerie, 
                    JSON_ARRAYAGG(p.path) AS images, 
                    IF(f.utilisateur_id IS NOT NULL, 1, 0) AS is_favori
             FROM favoris f
             JOIN annonce a ON f.annonce_id = a.id_annonce
             LEFT JOIN galerie g ON a.id_annonce = g.annonce_id
             LEFT JOIN photo p ON g.id_galerie = p.galerie_id
             WHERE f.utilisateur_id = :userId 
             GROUP BY a.id_annonce
             ORDER BY $orderBy 
             LIMIT :offset, :parPage"
        );
        
    
        // Bind des valeurs
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':parPage', $parPage, PDO::PARAM_INT);
    
        // Exécuter la requête
        $stmt->execute();
    
        // Retourner les favoris avec l'état des favoris et les images
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    

    
    public function addFavori($userId, $idAnnonce) {
        $stmt = $this->pdo->prepare("INSERT INTO favoris (utilisateur_id, annonce_id) VALUES (:userId, :idAnnonce)");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':idAnnonce', $idAnnonce, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteFavori($userId, $idAnnonce) {
        $stmt = $this->pdo->prepare("DELETE FROM favoris WHERE utilisateur_id = ? AND annonce_id = ?");
        $stmt->execute([$userId, $idAnnonce]);
    }
}
