<?php
// config/connexion.php
$host = 'herogu.garageisep.com'; // Remplacez par votre hôte
$dbname = 'O3JddIlKJk_studimmo'; // Remplacez par le nom de votre base de données
$user = 'fa13D0usCD_studimmo'; // Remplacez par votre utilisateur
$password = 'TTfxqwrSYG3z7PdT'; // Remplacez par votre mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
