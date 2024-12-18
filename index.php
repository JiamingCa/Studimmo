<?php
// index.php
session_start();

// Inclure les fichiers de configuration et les dépendances
require_once 'config/connexion.php';



// Simulation d'un utilisateur connecté (utilisateur avec id = 1)
// if (!isset($_SESSION['user_id'])) {
//     $_SESSION['user_id'] = 1; // Remplacez "1" par l'id réel d'un utilisateur dans votre base de données
// }
// // Récupération de l'id de l'utilisateur connecté
// $userId = $_SESSION['user_id'];



// Vérification des paramètres dans l'URL (route)
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage'; // Par défaut, "accueil"

// Charger le contrôleur correspondant
switch ($page) {
    case 'mon_espace':
        require_once 'app/controllers/MonEspaceController.php';
        $controller = new MonEspaceController($pdo);
        $controller->afficherMonEspace($userId);
        break;

    case 'favoris':
        require_once 'app/controllers/FavorisController.php';
        $controller = new FavorisController($pdo);
        $controller->afficherFavoris($userId);
        break;
    
    case 'tb_bord':
        require_once 'app/controllers/DashboardController.php';
        $controller = new DashboardController($pdo);
        $controller->afficherTableauDeBord($userId);
        break;

    case 'Connexion':
        require_once 'app/controllers/ConnexionController.php';
        $controller = new ConnexionController($pdo);
        $controller->afficherConnexion();
        break;

    case 'Inscription':
        require_once 'app/controllers/InscriptionController.php';
        $controller = new InscriptionController($pdo);
        $controller->afficherInscription();
        break;

    case 'GererUtilisateur':
        require_once 'app/controllers/GererUtilisateurController.php';
        $controller = new GererUtilisateurController($pdo);
        $controller->afficherGererUtilisateur($userId);
        break;

    case 'homepage':
        require_once 'app/controllers/HomepageController.php';
        $controller = new HomepageController($pdo);
        $controller->afficherHomePage();
        break;

    // ... autres routes comme accueil, tableau_de_bord, login, etc.

    default:
        echo "Page introuvable.";
        break;
}

?>

<!-- à ne pas toucher ce qui est dessous, je l'enlèverais après des tests-->
<?php
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
if (isset($_SESSION['type'])) {
  echo '<p>Votre rôle : ' . htmlspecialchars($_SESSION['type']) . '</p>';
} else {
  echo '<p>Vous n\'êtes pas connecté ou votre rôle n\'est pas défini.</p>';
}
// Vérifie si l'utilisateur est connecté et s'il est administrateur
if (isset($_SESSION['type']) && $_SESSION['type'] === 'Admin') {
    echo '<a href="index.php?page=GererUtilisateur" class="btn btn-primary">Accès Administrateur</a>';
} else {
    echo '<p>Vous n\'avez pas les droits nécessaires pour accéder à cette section.</p>';
}
?>