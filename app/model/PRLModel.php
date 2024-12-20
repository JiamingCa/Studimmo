<?php
class PRLModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    

    public function getLogements($filters) {
        $sql = "SELECT a.*, g.id_galerie, p.path AS photo_path 
                FROM annonce a
                LEFT JOIN galerie g ON a.id_annonce = g.annonce_id
                LEFT JOIN photo p ON g.id_galerie = p.galerie_id
                WHERE 1=1";
                

        if (!empty($filters['location'])) {
            $sql .= " AND `localisation` LIKE :location";
        }
        if (!empty($filters['propertyType'])) {
            $sql .= " AND `type_propriete` = :propertyType";
        }
        if (!empty($filters['surfaceMin'])) {
            $sql .= " AND `surface` >= :surfaceMin";
        }
        if (!empty($filters['surfaceMax'])) {
            $sql .= " AND `surface` <= :surfaceMax";
        }
        if (!empty($filters['budgetMin'])) {
            $sql .= " AND `prix` >= :budgetMin";
        }
        if (!empty($filters['budgetMax'])) {
            $sql .= " AND `prix` <= :budgetMax";
        }
        $sql .= " GROUP BY a.id_annonce";
        $stmt = $this->pdo->prepare($sql);

        if (!empty($filters['location'])) {
            $stmt->bindValue(':location', "%" . $filters['location'] . "%");
        }
        if (!empty($filters['propertyType'])) {
            $stmt->bindValue(':propertyType', $filters['propertyType']);
        }
        if (!empty($filters['surfaceMin'])) {
            $stmt->bindValue(':surfaceMin', $filters['surfaceMin'], PDO::PARAM_INT);
        }
        if (!empty($filters['surfaceMax'])) {
            $stmt->bindValue(':surfaceMax', $filters['surfaceMax'], PDO::PARAM_INT);
        }
        if (!empty($filters['budgetMin'])) {
            $stmt->bindValue(':budgetMin', $filters['budgetMin'], PDO::PARAM_INT);
        }
        if (!empty($filters['budgetMax'])) {
            $stmt->bindValue(':budgetMax', $filters['budgetMax'], PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
