<?php


// Vérifie si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données du formulaire
    $email = htmlspecialchars(trim($_POST['email']));
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifie si les champs sont remplis
    if (empty($email) || empty($mot_de_passe)) {
        die('Veuillez remplir tous les champs.');
    }

    try {
        // Préparer la requête pour récupérer l'utilisateur
        $stmt = $pdo->prepare('SELECT id_Utilisateur, nom, prenom, type,  mot_de_passe FROM utilisateur WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        

        // Vérifie si l'utilisateur existe
        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Connexion réussie, stocke les informations en session
            session_start();
            $_SESSION['id_Utilisateur'] = $utilisateur['id_Utilisateur'];
            $userId = $_SESSION['id_Utilisateur'] ;
            
            // Redirige vers une page sécurisée
            header('Location: index.php?page=mon_espace');
            exit;
        } else {
            die('Identifiants incorrects.');
        }
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>
