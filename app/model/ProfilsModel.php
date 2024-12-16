<?php
// app/model/ProfilsModel.php

function updateUsers($pdo, $nom, $prenom, $email, $telephone, $userID) {
    $reponse = $pdo->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, telephone = ? WHERE id_Utilisateur = ?");
    $reponse->execute([$nom, $prenom, $email, $telephone, $userID]);
    return $reponse;
}

function selectUsers($pdo, $userID) {
    $reponse = $pdo->prepare("SELECT * FROM utilisateur WHERE id_Utilisateur = ?");
    $reponse->execute([$userID]);
    return $reponse;
}
