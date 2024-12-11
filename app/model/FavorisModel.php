<?php
// app/model/FavorisModel.php

class FavorisModel {
    private $pdo;

    public function getFavorisByUser($userId, $tri, $page, $parPage) {
        $orderBy = match ($tri) {
            'recent' => 'date_ajout ASC',
            'prix-asc' => 'prix ASC',
            'prix-desc' => 'prix DESC',
            'surface-asc' => 'surface ASC',
            'surface-desc' => 'surface DESC',
            default => 'date_ajout DESC'
        };
        $offset = ($page -1) * $parPage;
        $stmt = $this->pdo->prepare("SELECT * FROM favoris f JOIN annonces a ON f.id_annonce = a.id WHERE f.id_utilisateur = ? ORDER BY $orderBy LIMIT ?, ?");
        $stmt->execute([$userId, $offset, $parPage]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countFavorisByUser($userId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM favoris WHERE id_utilisateur = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function deleteFavori($userId, $idAnnonce) {
        $stmt = $this->pdo->prepare("DELETE FROM favoris WHERE id_utilisateur = ? AND id_annonce = ?");
        $stmt->execute([$userId, $idAnnonce]);
    }
    
}
