<?php

class DocumentModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Insérer un document dans la base de données
    public function insererDocument($nomFichier, $cheminFichier, $dossierId) {
        $query = "INSERT INTO document (nom_fichier, chemin_fichier, dossier_id) 
                  VALUES (:nom_fichier, :chemin_fichier, :dossier_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nom_fichier', $nomFichier);
        $stmt->bindParam(':chemin_fichier', $cheminFichier);
        $stmt->bindParam(':dossier_id', $dossierId);
        $stmt->execute();
    }

    // Récupérer les documents associés à un utilisateur (par dossier)
    public function getDocumentsByDossier($dossierId) {
        $query = "SELECT * FROM document WHERE dossier_id = :dossier_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':dossier_id', $dossierId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
?>

