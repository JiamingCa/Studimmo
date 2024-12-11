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

    <div class="profile-item">
            <label for="nom">Nom</label>
            <input type="text" id="nom" value="Dupont" disabled>
        </div>
        <div class="profile-item">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" value="Jean" disabled>
        </div>
        <div class="profile-item">
            <label for="email">Email</label>
            <input type="email" id="email" value="jean.dupont@example.com" disabled>
        </div>
        <button class="edit-button" onclick="toggleEdit()">Modifier</button>
    </div>

    <!--
    <main>
        <div class="container">
            <section class="profil">
                <h2>Mon Profil</h2>
                    <div class="profil-info">
                    <img src="images/profil.jpg" alt="Photo de profil" class="profil-photo">
                    <div class="details">
                        <p><strong>Nom :</strong> Étudiant Nom</p>
                        <p><strong>Email :</strong> etudiant@email.com</p>
                        <p><strong>Téléphone :</strong> 06 12 34 56 78</p>
                        <p><strong>Adresse :</strong> 12 Rue de l'Université, Ville</p>
                    </div>
                </div>
            </section>
        </div> -->
        <?php include 'app/view/templates/footer.php'; ?>
    </main> 
</body>
</html>

