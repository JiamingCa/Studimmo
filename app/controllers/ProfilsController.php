<?php
// app/controllers/MonEspaceController.php
class ProfilsController {
    public function afficherProfils() {
       
        // Inclure la vue
        require 'app/view/pages/profils.php';
    }

    require ('app/model/profils.php')
    
    if(isset($_GET["action"]) && $_GET["action"]=="save") {
	if(isset($_GET["id"]) &&  $_GET["id"]!=null) {
		$reponse = updateUsers($db, $_GET['nom'], $_GET["prenom"], $_GET["id"]);
		
	} else {
		$reponse = insertUsers($db, $_GET['nom'], $_GET["prenom"]);
		
	}
}


if(isset($_GET["action"]) && ($_GET["action"]=="ajouter" || $_GET["action"]=="modifier")) {
	$nom = "";
	$prenom = "";
	$id = "";
	
	if($_GET["action"]=="modifier") {
		$reponse = selectUsers($db, $_GET['nom'], $_GET["prenom"], $_GET["id"]);

    while($user = $reponse->fetch()){
		$nom = $user["nom"];		
		$prenom = $user["prenom"];		
		$id = $user["id"];
	}
}
	include('views/edit.php');
	?>	
	
<?php	
} else { 
	$reponse = selectAll($db);
}}
?>




