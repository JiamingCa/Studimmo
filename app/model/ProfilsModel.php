<?php



function updateUsers($pdo, $nom, $prenom,$email ,$telephone, $userID)
{
    $reponse = $pdo->prepare("update users set nom = ?, prenom = ?, email = ?, telephone = ? where id = ?");
	$reponse->execute(array($_GET["nom"],$_GET["prenom"],$_GET["email"],$_GET["telephone"], $_GET["id"] ));
    return $reponse;
}

//function selectUsers($db, $nom, $prenom,$email ,$telephone, $id)
//{
//    $reponse = $db->prepare("update users set nom = ?, prenom = ?, email = ?, telephone = ? where id = ?");
//	$reponse->execute(array($_GET["nom"],$_GET["prenom"],$_GET["email"],$_GET["telephone"], $_GET["id"] ));
//  return $reponse;
//}

function selectUsers($pdo, $userID)
{
    $reponse = $pdo->prepare("select * from users where id=?");
	$reponse->execute(array($_GET["id"]));
    return $reponse;
}

function selectAll($pdo)
{
    $reponse = $pdo->prepare("select * from users ");
	$reponse->execute();
    return $reponse;
}
