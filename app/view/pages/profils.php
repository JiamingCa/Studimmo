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

    <div class="profile-title">Données personnelles</div>

    <div class="profile-grid">
    <div class="profile-item">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom"> <br><br>
        </div>

    <div class="profile-item">
            <label for="nom">Nom</label>
            <input type="text" id="nom"> <br><br>
        </div>

    <div class="profile-item">
        <label for="date_de_naissance">Date de naissance</label>
        <input type="date" id="date_de_naissance"> <br><br>
        </div>

    <div class="profile-item">
            <label for="tel">Numéro de téléphone</label>
            <input type="tel" id="tel"> <br><br>
        </div> 

    <div class="profile-item">
            <label for="email">Email</label>
            <input type="email" id="email"> <br><br>
        </div>
    
    <button class="edit-button" onclick="toggleEdit()">Modifier</button>
    </div>
    </div>
    

    <div class="profile-container">

    <div class="profile-grid">
    <div class="profile-title">Sécurité</div>

    <div class="profile-item">
            <label for="mdp">Mot de passe</label>
            <input type="mdp" id="mdp"> <br><br>
        </div>
        <button class="edit-button" onclick="toggleEdit()">Modifier</button>
    </div>
    </div>
    </div>

    
    <?php include 'app/view/templates/footer.php'; ?>
</main> 
</body>
</html>

