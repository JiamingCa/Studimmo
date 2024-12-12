<?php
// Inclure les fichiers nécessaires
require_once '../../config/connexion.php';
require_once '../model/FavorisModel.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit;
}

$userId = $_SESSION['user_id'];

// Récupérer les données envoyées par la requête AJAX
$data = json_decode(file_get_contents('php://input'), true);



if (!isset($data['idAnnonce']) || !isset($data['action'])) {
    echo json_encode(['error' => 'Données manquantes']);
    exit;
}

$idAnnonce = $data['idAnnonce'];
$action = $data['action']; // 'add' ou 'remove'

// Initialiser le modèle de favoris
$favorisModel = new FavorisModel($pdo);

if ($action === 'add') {
    // Ajouter le favori
    $favorisModel->addFavori($userId, $idAnnonce);
} elseif ($action === 'remove') {
    // Supprimer le favori
    $favorisModel->deleteFavori($userId, $idAnnonce);
} else {
    echo json_encode(['error' => 'Action non valide']);
    exit;
}

// Retourner une réponse JSON pour confirmer l'action
echo json_encode(['success' => true]);
