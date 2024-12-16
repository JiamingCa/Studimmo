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

    <form action="index.php?page=profils&action=modifier" method="POST">
    <div class="profile-title">Données personnelles</div>

    <div class="profile-grid">
    <div class="profile-item">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($utilisateur['prenom']); ?>"> <br><br>
        </div>

    <div class="profile-item">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($utilisateur['nom']); ?>"> <br><br>
        </div>

    <div class="profile-item">
        <label for="type">Type</label>
        <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($utilisateur['type']); ?>"> <br><br>
        </div>

    <div class="profile-item">
            <label for="telephone">Numéro de téléphone</label>
            <input type="tel" id="tel" name="telephone" value="<?php echo htmlspecialchars($utilisateur['telephone']); ?>"> <br><br>
        </div>

    <div class="profile-item">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($utilisateur['email']); ?>"> <br><br>
        </div>
            

    <button type="submit" class="edit-button">Enregistrer</button>
    </form>
    </div>
    </div>

    <div class="profile-container">
    <div class="profile-grid">
    <div class="profile-title">Sécurité</div>
    <div class="profile-item">
            <label for="mot_de_passe">Mot de passe</label>
            <!-- MET PASSWORD AU LIEU DE TEXT -->                                                          <!-- DISABLED SERT A NE PAS POUVOIR INTERAGIR -->
            <input type="text" id="mot_de_passe" value="<?php echo htmlspecialchars($utilisateur['mot_de_passe']); ?>" disabled> <br><br>
        </div>          <!-- DISABLED SERT A NE PAS POUVOIR INTERAGIR -->
        <button class="edit-button" disabled>Modifier le mot de passe</button>
    </div>
    </div>
    </div>


    <?php include 'app/view/templates/footer.php'; ?>
    

</main>   
</body>
</html>
