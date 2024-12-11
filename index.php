<?php
// index.php
session_start();

// Inclure les fichiers de configuration et les dépendances
require_once 'config/connexion.php';

// Simulation d'un utilisateur connecté (utilisateur avec id = 1)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Remplacez "1" par l'id réel d'un utilisateur dans votre base de données
}
// Récupération de l'id de l'utilisateur connecté
$userId = $_SESSION['user_id'];



// Vérification des paramètres dans l'URL (route)
$page = isset($_GET['page']) ? $_GET['page'] : 'mon_espace'; // Par défaut, "accueil"

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
    
    case 'profils':
        require_once 'app/controllers/ProfilsController.php';
        $controller = new ProfilsController($pdo);
        $controller->afficherProfils($userId);
        break;

    // ... autres routes comme accueil, tableau_de_bord, login, etc.

    default:
        echo "Page introuvable.";
        break;
}

?>
