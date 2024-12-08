<?php
// app/controllers/DashboardController.php
require_once 'app/model/AnnonceModel.php';

class DashboardController {
    private $annonceModel;

    public function __construct($pdo) {
        $this->annonceModel = new AnnonceModel($pdo);
    }

    public function afficherTableauDeBord($userId) {
        // Récupère les annonces de l'utilisateur
        $annonces = $this->annonceModel->getAnnoncesByUser($userId);
    
        // Récupère les vues mensuelles pour toutes les annonces de l'utilisateur
        $vuesParAnnonce = $this->annonceModel->getVuesParMois($userId);
    
        // Organiser les données pour chaque annonce
        $vuesStructurees = [];
        foreach ($vuesParAnnonce as $vue) {
            $idAnnonce = $vue['id_annonce'];
            if (!isset($vuesStructurees[$idAnnonce])) {
                $vuesStructurees[$idAnnonce] = [
                    'titre' => $vue['titre'],
                    'vues' => array_fill(1, 12, 0) // Prérempli avec 0 pour chaque mois
                ];
            }
            $vuesStructurees[$idAnnonce]['vues'][(int) $vue['mois']] = (int) $vue['total'];
        }
    
        // Inclut la vue du tableau de bord avec les données
        require 'app/view/pages/tb_bord.php';
    }
    
}

