<?php
include 'connexion.php';

// Récupérer le terme de recherche depuis la requête
$searchTerm = isset($_GET['query']) ? $_GET['query'] : '';

// Préparer la requête SQL
$sql = "SELECT * FROM annonce WHERE localisation LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $searchTerm . '%';
$stmt->bind_param("s", $searchTerm);

// Exécuter la requête
$stmt->execute();
$result = $stmt->get_result();

// Construire le tableau de résultats
$logements = [];
while ($row = $result->fetch_assoc()) {
    $logements[] = $row;
}

// Retourner les résultats en JSON
header('Content-Type: application/json');
echo json_encode($logements);

// Fermer la connexion
$stmt->close();
$conn->close();
?>
