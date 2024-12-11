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

        // Récupère les candidatures par statut
        $candidatures = $this->annonceModel->getCandidaturesParStatut($userId);

        // Récupère les favoris pour toutes les annonces de l'utilisateur
        $favorisParAnnonce = $this->annonceModel->getFavorisParAnnonce($userId);
    
        // Organiser les données pour chaque annonce et calculer le total global des vues
    $vuesStructurees = [];
    foreach ($vuesParAnnonce as $vue) {
        $idAnnonce = $vue['id_annonce'];
        if (!isset($vuesStructurees[$idAnnonce])) {
            $vuesStructurees[$idAnnonce] = [
                'titre' => $vue['titre'],
                'vues' => array_fill(1, 12, 0), // Prérempli avec 0 pour chaque mois
                'total' => 0 // Ajouter un total global
            ];
        }
        $mois = (int) $vue['mois'];
        $totalMois = (int) $vue['total'];
        $vuesStructurees[$idAnnonce]['vues'][$mois] = $totalMois;
        $vuesStructurees[$idAnnonce]['total'] += $totalMois; // Ajouter au total global
    }
        // Organiser les candidatures par statut et calculer le total global
    $candidaturesStructurees = [];
    foreach ($candidatures as $candidature) {
        $idAnnonce = $candidature['id_annonce'];
        if (!isset($candidaturesStructurees[$idAnnonce])) {
            $candidaturesStructurees[$idAnnonce] = [
                'titre' => $candidature['titre'],
                'stats' => [
                    'En attente' => 0,
                    'Accepté' => 0,
                    'Rejeté' => 0
                ],
                'total' => 0 // Ajouter un total global
            ];
        }
        $statut = $candidature['statut'];
        $totalStatut = (int) $candidature['total'];
        $candidaturesStructurees[$idAnnonce]['stats'][$statut] = $totalStatut;
        $candidaturesStructurees[$idAnnonce]['total'] += $totalStatut; // Ajouter au total global
    }
        // Organiser les données des favoris
    $favorisStructurees = [];
    foreach ($favorisParAnnonce as $favori) {
        $idAnnonce = $favori['id_annonce'];
        $favorisStructurees[$idAnnonce] = (int) $favori['total'];
    }
    
        // Inclut la vue du tableau de bord avec les données
        require 'app/view/pages/tb_bord.php';
    }
    
}

