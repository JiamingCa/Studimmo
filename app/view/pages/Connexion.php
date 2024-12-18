<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studimmo</title>
    <link rel="stylesheet" type="text/css" href="app/view/asset/css/ptemplate.css"/>
    <link rel="stylesheet" type="text/css" href="app/view/asset/css/header.css"/>
</head>
<body>

<?php include("app/view/templates/header.php"); ?>
<?php require('app/model/connexionfonction.php'); ?>
<div class="login">
    <div class="container">
        <div class="login-container">
            <h2>Connexion</h2>
            <div>Vous n'avez pas de compte ? <a href="index.php?page=Inscription">S'inscrire</a></div>
            <form action="Connexion.php" method="POST">
                <div class="input-group">
                    <label for="email">Votre email</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="mot_de_passe">Votre mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                </div>
                <div class="input-group">
                    <button type="submit">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<footer>
    <p>© 2024 Site de Logement - Tous droits réservés.</p>
</footer>
</body>
</html>
