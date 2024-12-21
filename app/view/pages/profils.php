<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Gestion Logement Étudiant</title>
    <link rel="stylesheet" href="app/view/asset/css/profils.css">
    <link rel="stylesheet" href="app/view/asset/css/footer.css">
    <link rel="stylesheet" href="app/view/asset/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <?php include 'app/view/templates/header.php'; ?>
    <div class="titre">
        <a href='index.php?page=mon_espace' class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <t1>Mon profil</t1>
    </div>

<main>
    <div class="profile-container">
        <div class="profile-title">Données personnelles</div>
        <form action="index.php?page=profils&action=modifier" method="POST" id="profileForm">
            <div class="profile-grid">
                <div class="profile-item">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($utilisateur['prenom']); ?>" disabled> <br><br>
                </div>

                <div class="profile-item">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($utilisateur['nom']); ?>" disabled> <br><br>
                </div>

                

                <div class="profile-item">
                    <label for="telephone">Numéro de téléphone</label>
                    <input type="tel" id="tel" name="telephone" value="<?php echo htmlspecialchars($utilisateur['telephone']); ?>" disabled> <br><br>
                </div>

                <div class="profile-item">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($utilisateur['email']); ?>" disabled> <br><br>
                </div>
            </div>
            <button type="button" id="editButton" class="edit-button">Modifier</button>
            <button type="submit" id="saveButton" class="edit-button hidden">Enregistrer</button>
        </form>
    </div>

    <div class="profile-container">
        <div class="profile-title">Sécurité</div>
        <form action="index.php?page=profils&action=modifier_securite" method="POST" id="securityForm">
            <div class="profile-grid">
                <!-- Champ pour le nouveau mot de passe -->
                <div class="profile-item">
                    <label for="new_password">Nouveau mot de passe</label>
                    <div style="position: relative;">
                        <input 
                            type="password" 
                            id="new_password" 
                            name="new_password" 
                            placeholder="Nouveau mot de passe" 
                            required>
                        <i class="fas fa-eye toggle-password" data-target="new_password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                    <small id="new_password_error" class="error-message"></small>
                </div>

                <!-- Champ pour confirmer le mot de passe -->
                <div class="profile-item">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <div style="position: relative;">
                        <input 
                            type="password" 
                            id="confirm_password" 
                            name="confirm_password" 
                            placeholder="Confirmez le mot de passe" 
                            required>
                        <i class="fas fa-eye toggle-password" data-target="confirm_password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                    <small id="confirm_password_error" class="error-message"></small>
                </div>
            </div>
            <button type="submit" id="saveSecurityButton" class="edit-button">Enregistrer</button>
        </form>
    </div>

    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
            display: none; /* Masqué par défaut */
        }
    </style>



    <?php include 'app/view/templates/footer.php'; ?>
</main>

<script>
    document.getElementById('editButton').addEventListener('click', function() {
        const fields = document.querySelectorAll('#profileForm input');
        fields.forEach(field => field.disabled = false); 
        document.getElementById('editButton').classList.add('hidden'); 
        document.getElementById('saveButton').classList.remove('hidden'); 
    });

    // Gestion de l'icône œil pour afficher/masquer le mot de passe
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function () {
            const targetInput = document.getElementById(this.dataset.target);
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                targetInput.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });

    // Validation des mots de passe
    document.getElementById('securityForm').addEventListener('submit', function (event) {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const errorNewPassword = document.getElementById('new_password_error');
        const errorConfirmPassword = document.getElementById('confirm_password_error');

        // Réinitialiser les messages d'erreur
        errorNewPassword.style.display = 'none';
        errorConfirmPassword.style.display = 'none';

        let isValid = true;

        // Vérifiez la complexité du mot de passe
        if (newPassword.length < 8) {
            errorNewPassword.textContent = 'Le mot de passe doit comporter au moins 8 caractères.';
            errorNewPassword.style.display = 'block';
            isValid = false;
        }

        // Vérifiez que les mots de passe correspondent
        if (newPassword !== confirmPassword) {
            errorConfirmPassword.textContent = 'Les mots de passe ne correspondent pas.';
            errorConfirmPassword.style.display = 'block';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Empêcher l'envoi du formulaire
        }
    });


</script>

</body>
</html>
