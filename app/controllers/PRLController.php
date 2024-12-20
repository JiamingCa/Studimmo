<?php
require_once 'app/model/PRLModel.php';

class PRLController {
    private $PRLModel;

    public function __construct($pdo) {
        $this->PRLModel = new PRLModel($pdo);
    }

    // Méthode pour générer l'URL avec les filtres
    

    // Affichage des logements
    public function afficherPRL() {
        // Récupérer les filtres depuis la méthode GET
        $filters = [
            'location' => $_GET['location'] ?? '',
            'propertyType' => $_GET['property-type'] ?? '',
            'surfaceMin' => $_GET['surface-min'] ?? '',
            'surfaceMax' => $_GET['surface-max'] ?? '',
            'budgetMin' => $_GET['budget-min'] ?? '',
            'budgetMax' => $_GET['budget-max'] ?? '',
        ];

        // Appeler la méthode du modèle pour obtenir les logements
        $logements = $this->PRLModel->getLogements($filters);

      
       

        // Inclure la vue et lui passer les logements et l'URL générée
        require 'app/view/pages/PRL.php';
    }
}
?>
