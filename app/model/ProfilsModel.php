<?php

function updateUsers($db, $nom, $prenom, $id)
{
    $reponse = $db->prepare("update users set nom = ?, prenom = ? where id = ?");
	$reponse->execute(array($_GET["nom"],$_GET["prenom"], $_GET["id"] ));
    return $reponse;
}
