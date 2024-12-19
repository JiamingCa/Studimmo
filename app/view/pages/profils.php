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
                    <label for="type">Type</label>
                    <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($utilisateur['type']); ?>" disabled> <br><br>
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
                <div class="profile-item">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?php echo htmlspecialchars($utilisateur['mot_de_passe']); ?>" disabled> <br><br>
                </div>
            </div>
            <button type="button" id="editSecurityButton" class="edit-button">Modifier</button>
            <button type="submit" id="saveSecurityButton" class="edit-button hidden">Enregistrer</button>
        </form>
    </div>

    <?php include 'app/view/templates/footer.php'; ?>
</main>

<script>
    document.getElementById('editButton').addEventListener('click', function() {
        const fields = document.querySelectorAll('#profileForm input');
        fields.forEach(field => field.disabled = false); 
        document.getElementById('editButton').classList.add('hidden'); 
        document.getElementById('saveButton').classList.remove('hidden'); 
    });

    document.getElementById('editSecurityButton').addEventListener('click', function() {
        const securityFields = document.querySelectorAll('#securityForm input');
        securityFields.forEach(field => field.disabled = false); 
        document.getElementById('editSecurityButton').classList.add('hidden'); 
        document.getElementById("saveSecurityButton").classList.remove('hidden'); 
    });
</script>

</body>
</html>
