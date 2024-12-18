<?php
function updateUsers($pdo,$nom,$prenom,$id)
{
    $reponse = $pdo->prepare("update users set nom = ?, prenom = ? where id = ?");
	$reponse->execute(array($_GET["nom"],$_GET["prenom"], $_GET["id"] ));
    return $reponse;
}
function insertUsers($pdo,$nom,$prenom)
{
    $reponse = $pdo->prepare("insert into users (nom,prenom) values (?,?)");
	$reponse->execute(array($_GET["nom"], $_GET["prenom"]));
    return $reponse;

}
function selectUsers($pdo,$id)
{
    $reponse = $pdo->prepare("select * from users where id=?");
    $reponse->execute(array($_GET["id"]));
    return $reponse;
}
?>