<?php
// ajax_tri.php
require_once 'config/connexion.php';
require_once 'app/model/FavorisModel.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit;
}

$userId = $_SESSION['user_id'];
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'recent';

// Initialiser le modèle de favoris
$favorisModel = new FavorisModel($pdo);

// Exemple de structure de données renvoyée par le modèle PHP
$annonces = $favorisModel->getFavorisByUser($userId, $tri, $page = 1, $parPage = 10);

$annoncesFormatted = array_map(function($annonce) {
    // Assure-toi que le champ `images` est un tableau JSON valide
    $annonce['images'] = json_decode($annonce['images']);
    return $annonce;
}, $annonces);

// Renvoie les résultats triés en format JSON
echo json_encode([
    'success' => true,
    'annonces' => $annoncesFormatted
]);


?>
