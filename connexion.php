<?php
$host = 'phpmyadmin.herogu.garageisep.com';
$dbname = 'O3JddIlKJk_studimmo';
$user = 'fa13D0usCD_studimmo';
$password = 'TTfxqwrSYG3z7PdT';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>