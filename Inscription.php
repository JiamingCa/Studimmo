<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studimmo</title>
    <link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>

<?php require('model/connexionBase.php'); ?>

<header>
    <h1>Studimmo</h1>
</header>

<?php include("view/navbar.php"); ?>
<?php require("model/inscriptionfonction.php"); ?>
<div class="login">
    <div class="container">
        <div class="inscription-container">
            <h2>Créer un compte</h2>
            <div>Vous avez déjà un compte ? <a href="Connexion.php">Se connecter</a></div>
            <div id="error-messages"></div>
            <form action="Inscription.php" method="POST" onsubmit="return checkform(event)">
                <div class="input-row">
                    <div class="input-group">
                        <label for="nom">Votre nom</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="input-group">
                        <label for="prenom">Votre prénom</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="email">Votre e-mail</label>
                        <input type="text" id="email" name="email" onchange="verifemail()" required>
                    </div>
                    <div class="input-group">
                        <label for="telephone">Votre numéro de téléphone</label>
                        <input type="text" id="telephone" name="telephone" onchange="veriftelephone()" required>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <label for="mot_de_passe1">Votre mot de passe</label>
                        <input type="password" id="mot_de_passe1" name="mot_de_passe" required>
                    </div>
                    <div class="input-group">
                        <label for="mot_de_passe2">Confirmez votre mot de passe</label>
                        <input type="password" id="mot_de_passe2" name="mot_de_passe2" required>
                    </div>
                </div>

                <div class="input-group">
                    <button type="submit">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>
<footer>
    <p>© 2024 Site de Logement - Tous droits réservés.</p>
</footer>

<script>
    function verifemail() {
        var emailID = document.getElementById("email").value;
        atpos = emailID.indexOf("@");
        dotpos = emailID.lastIndexOf(".");
        if (atpos < 1 || ( dotpos - atpos < 2 )) {
        alert("Merci de saisir un email correct")
        document.myForm.EMail.focus() ;
        return false;
        }
    }

    function veriftelephone() {
        const telephone = document.getElementById("telephone").value;
        // Vérification du numéro de téléphone (doit contenir uniquement des chiffres et être long de 10 à 15 caractères)
        const phoneRegex = /^[0-9]{10,15}$/;
        if (!phoneRegex.test(telephone)) {
            alert("Le numéro de téléphone doit contenir entre 10 et 15 chiffres, sans espaces ni caractères spéciaux.");
        }
    }

    function checkform(event) {
        const mot_de_passe1 = document.getElementById("mot_de_passe1").value;
        const mot_de_passe2 = document.getElementById("mot_de_passe2").value;
        const errorContainer = document.getElementById("error-messages");
        errorContainer.innerHTML = ""; // Réinitialiser les messages d'erreur

        // Liste des critères pour le mot de passe
        const errors = [];
        if (mot_de_passe1.length < 7) {
            errors.push("Le mot de passe doit contenir au moins 7 caractères.");
        }
        if (!/[A-Z]/.test(mot_de_passe1)) {
            errors.push("Le mot de passe doit contenir au moins une majuscule.");
        }
        if (!/[0-9]/.test(mot_de_passe1)) {
            errors.push("Le mot de passe doit contenir au moins un chiffre.");
        }
        if (!/[!@#$%^&*(),.?\":{}|<>]/.test(mot_de_passe1)) {
            errors.push("Le mot de passe doit contenir au moins un caractère spécial.");
        }

        // Vérification si les mots de passe correspondent
        if (mot_de_passe1 !== mot_de_passe2) {
            errors.push("Les mots de passe ne correspondent pas !");
        }


        // Affichage des erreurs
        if (errors.length > 0) {
            event.preventDefault();
            errors.forEach(error => {
                const errorElement = document.createElement("p");
                errorElement.textContent = error;
                errorElement.style.color = "red"; // Style pour mettre en avant les erreurs
                errorContainer.appendChild(errorElement);
            });
            return false;
        }

        return true;
    }
</script>

</body>
</html>
