<?php


// Model: AlerteModel.php
class AlerteModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAlertesByUser($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM alerte WHERE utilisateur_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateAlerteEtat($alerteId, $etat) {
        $stmt = $this->pdo->prepare("UPDATE alerte SET etat = ? WHERE id_alerte = ?");
        $stmt->execute([$etat, $alerteId]);
    }

    public function deleteAlerte($alerteId) {
        $stmt = $this->pdo->prepare("DELETE FROM alerte WHERE id_alerte = ?");
        $stmt->execute([$alerteId]);
    }
}

?>
