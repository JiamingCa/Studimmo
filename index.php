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
$userLoggedIn = isset($_SESSION['id_Utilisateur']);
echo "<script>const userLoggedIn = " . json_encode($userLoggedIn) . ";</script>";
if (isset($_SESSION['id_Utilisateur'])) {
    $userId = $_SESSION['id_Utilisateur']; // Récupère l'ID utilisateur depuis la session
}




// Vérification des paramètres dans l'URL (route)
$page = isset($_GET['page']) ? $_GET['page'] : 'favoris'; // Par défaut, "accueil"

// Charger le contrôleur correspondant
switch ($page) {
    case 'mon_espace':
        if (!isset($_SESSION['id_Utilisateur'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // URL actuelle
            header("Location: index.php?page=Connexion");
            exit();
        
        }else {
            require_once 'app/controllers/MonEspaceController.php';
            $controller = new MonEspaceController($pdo);
            $controller->afficherMonEspace($userId);
        }
        break;

    case 'favoris':
        if (!isset($_SESSION['id_Utilisateur'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // URL actuelle
            header("Location: index.php?page=Connexion");
            exit();
        }else {
            require_once 'app/controllers/FavorisController.php';
            $controller = new FavorisController($pdo);
            $controller->afficherFavoris($userId);
        }
        break;
    
    case 'tb_bord':
        if (!isset($_SESSION['id_Utilisateur'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // URL actuelle
            header("Location: index.php?page=Connexion");
            exit();
        }else {
            require_once 'app/controllers/DashboardController.php';
            $controller = new DashboardController($pdo);
            $controller->afficherTableauDeBord($userId);
        }
        break;

    case 'alertes':
        if (!isset($_SESSION['id_Utilisateur'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // URL actuelle
            header("Location: index.php?page=Connexion");
            exit();
        }else {
            require_once 'app/controllers/AlertesController.php';
            $controller = new AlertesController($pdo);
            $controller->afficherAlertes($userId);
        }
        break;

    case 'creer_dossier':
        if (!isset($_SESSION['id_Utilisateur'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // URL actuelle
            header("Location: index.php?page=Connexion");
            exit();
        }else {
            require_once 'app/controllers/Creer_dossierController.php';
            $controller = new Creer_dossierController($pdo);
            $controller->afficherCreer_dossier($userId);
        }
        break;

    case 'traiter_fichiers':
        if (!isset($_SESSION['id_Utilisateur'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // URL actuelle
            header("Location: index.php?page=Connexion");
            exit();
        }else {
            require_once 'app/controllers/Creer_dossierController.php';
            $controller = new Creer_dossierController($pdo);
            $controller->traiterFichiers($userId);
        }
        break;
    
    
    case 'mon_dossier':
        if (!isset($_SESSION['id_Utilisateur'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // URL actuelle
            header("Location: index.php?page=Connexion");
            exit();
        }else {
            require_once 'app/controllers/MonDossierController.php';
            $controller = new MonDossierController($pdo);
            $controller->afficherMonDossier($userId);
        }
        break;
    
    

    case 'profils':
        require_once 'app/controllers/ProfilsController.php';
        $controller = new ProfilsController($pdo);
    
        // Vérifiez si une action spécifique est demandée
        $action = isset($_GET['action']) ? $_GET['action'] : 'afficher';
    
        if ($action === 'modifier') {
            $controller->modifierProfils($userId);
        } elseif ($action === 'modifier_securite') {
            $controller->modifierSecurite($userId); // Appeler la méthode pour modifier la sécurité
        } else {
            $controller->afficherProfils($userId);
        }
        break;
        

    case 'Faq':
        require_once 'app/controllers/FaqController.php';
        $controller = new FaqController($pdo);
        $controller->afficherFaq();
        break;

    case 'Connexion':
        require_once 'app/controllers/ConnexionController.php';
        $controller = new ConnexionController($pdo);
        $controller->afficherConnexion();
        break;
    
    case 'deconnexion':
        require_once 'app/controllers/DeconnexionController.php';
        $controller = new DeconnexionController($pdo);
        $controller->afficherDeconnexion();
        break;

    case 'Inscription':
        require_once 'app/controllers/InscriptionController.php';
        $controller = new InscriptionController($pdo);
        $controller->afficherInscription();
        
        break;

    case 'GererUtilisateur':
        if (!isset($_SESSION['id_Utilisateur'])) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // URL actuelle
            header("Location: index.php?page=Connexion");
            exit();
        }else {
            require_once 'app/controllers/GererUtilisateurController.php';
        }
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