<?php
// app/controllers/FavorisController.php
require_once 'app/model/FavorisModel.php';
require_once 'app/model/AnnonceModel.php';

class FavorisController {
    private $FavorisModel;

    public function __construct($pdo) {
        $this->FavorisModel = new FavorisModel($pdo);
    }

    public function afficherFavoris($userId, $tri = 'recent', $page = 1, $parPage = 10) {
        if (!$userId) {
            die("Utilisateur non identifié.");
        }
    
        // Récupérer les annonces avec l'état des favoris
        $annonces = $this->FavorisModel->getFavorisByUser($userId, $tri, $page, $parPage);
        $nombreFavoris = $this->FavorisModel->countFavorisByUser($userId);
    
        // Passer les annonces à la vue
        include 'app/view/pages/favoris.php';
    }

    public function toggleFavori($userId, $idAnnonce, $action) {
    if ($action === 'add') {
        $this->FavorisModel->addFavori($userId, $idAnnonce);
    } elseif ($action === 'remove') {
        $this->FavorisModel->deleteFavori($userId, $idAnnonce);
    }

    
}

    
}

?>
