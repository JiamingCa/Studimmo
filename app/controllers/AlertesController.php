<?php
// Controller: AlertesController.php
require_once 'app/model/AlertesModel.php';

class AlertesController {
    private $alerteModel;

    public function __construct($pdo) {
        $this->alerteModel = new AlerteModel($pdo);
    }

    public function afficherAlertes($userId) {
        if (!$userId) {
            die("Utilisateur non identifié.");
        }

        $alertes = $this->alerteModel->getAlertesByUser($userId);
        include 'app/view/pages/alertes.php';
    }

    public function toggleAlerte($alerteId, $etat) {
        $this->alerteModel->updateAlerteEtat($alerteId, $etat);
        echo json_encode(["success" => true]);
    }

    public function supprimerAlerte($alerteId) {
        $this->alerteModel->deleteAlerte($alerteId);
        echo json_encode(["success" => true]);
    }
}
