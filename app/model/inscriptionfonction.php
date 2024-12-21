<?php
// Vérifie si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire en les sécurisant
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
    $mot_de_passe2 = htmlspecialchars($_POST['mot_de_passe2']);

    // Vérifier si les champs sont remplis
    if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($mot_de_passe) || empty($mot_de_passe2)) {
        die('Tous les champs sont obligatoires.');
    }

    // Vérifier si les mots de passe correspondent
    if ($mot_de_passe !== $mot_de_passe2) {
        die('Les mots de passe ne correspondent pas.');
    }

    // Valider l'e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Adresse e-mail invalide.');
    }

    // Valider le numéro de téléphone
    if (!preg_match('/^[0-9]{10,15}$/', $telephone)) {
        die('Le numéro de téléphone doit contenir entre 10 et 15 chiffres.');
    }

    // Hacher le mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    try {
        // Préparer et exécuter la requête SQL pour insérer les données
        $stmt = $pdo->prepare('INSERT INTO utilisateur (nom, prenom, email, telephone, mot_de_passe) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe)');
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe_hash);

        if ($stmt->execute()) {
            // Redirige l'utilisateur vers la page de connexion après l'inscription
            
            echo "redirect_url : " . htmlspecialchars($_SESSION['redirect_url']);
            header("Location: index.php?page=Connexion" );
            exit();
            exit;
        } else {
            die('Erreur lors de l\'inscription. Veuillez réessayer.');
        }
    } catch (PDOException $e) {
        // Gérer les erreurs liées à la base de données (par exemple, e-mail déjà utilisé)
        if ($e->getCode() === '23000') {
            die('Cette adresse e-mail est déjà utilisée.');
        } else {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>