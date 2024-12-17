<?php
require 'model/connexionBase.php';

$data = json_decode(file_get_contents('php://input'), true);

// Hacher le mot de passe
$mot_de_passe_hash = password_hash($data['mot_de_passe'], PASSWORD_DEFAULT);

try {
    $stmt = $db->prepare('INSERT INTO utilisateur (nom, prenom, email, telephone, mot_de_passe) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe)');
    $stmt->execute([
        ':nom' => $data['nom'],
        ':prenom' => $data['prenom'],
        ':email' => $data['email'],
        ':telephone' => $data['telephone'],
        ':mot_de_passe' => $mot_de_passe_hash
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
