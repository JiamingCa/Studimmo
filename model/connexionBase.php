<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=studimmo", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p>Connexion réussie</p>" ;
} catch (PDOException $e) {
    die("<p>Connexion échouée". $e->getMessage() ."</p>");
}
?>