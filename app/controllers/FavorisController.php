<?php
// app/controllers/FavorisController.php
require_once 'app/model/FavorisModel.php';

class FavorisController {
    private $FavorisModel;

    public function afficherFavoris($userId, $tri = 'recent', $page = 1, $parPage = 10) {
        // Vérifiez que $userId est valide
        if (!$userId) {
            die("Utilisateur non identifié.");
        }
    
        // Récupérer les annonces favorites
        $annonces = $this->FavorisModel->getFavorisByUser($userId, $tri, $page, $parPage);
    
        // Compter le nombre total d'annonces
        $nombreFavoris = $this->FavorisModel->countFavorisByUser($userId);
    
        // Vérifiez les résultats
        if (!isset($nombreFavoris)) {
            $nombreFavoris = 0;
        }
    
        // Charger la vue
        include 'app/view/pages/favoris.php';
    }
    
    public function supprimerFavori($userId, $idAnnonce) {
        $this->FavorisModel->deleteFavori($userId, $idAnnonce);
        header("Location: index.php?page=favoris"); // Redirige vers la page des favoris
    }
}
?>
