<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=studimmo", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p>Connexion réussie</p>" ;
} catch (PDOException $e) {
    die("<p>Connexion échouée". $e->getMessage() ."</p>");
}
?>