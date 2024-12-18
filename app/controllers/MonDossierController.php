<?php
require 'app/model/DocumentModel.php';

class MonDossierController {
    private $pdo;
    private $documentModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->documentModel = new DocumentModel($pdo);
    }

    // Afficher les fichiers du dossier de l'utilisateur
    public function afficherMonDossier($userId) {
        // Simuler l'ID du dossier basé sur l'utilisateur (ou remplacez par une méthode pour obtenir le dossier_id)
        $dossierId = $userId; // Exemple : dossier_id = userId

        // Récupérer les documents du modèle
        $documents = $this->documentModel->getDocumentsByDossier($dossierId);

        // Passer les documents à la vue
        require 'app/view/pages/mon_dossier.php';
    }
}
