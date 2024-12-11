
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <link rel="stylesheet" href="app/view/asset/css/mon_espace.css">
    <link rel="stylesheet" href="app/view/asset/css/footer.css">
    <link rel="stylesheet" href="app/view/asset/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include 'app/view/templates/header.php'; ?>
    <div class="titre">
        <t1>Mon Espace</t1>
    </div>
    <div class="container">
        <h1 class="title">Bienvenue</h1>
        <div class="grid">
            <!-- Carte Favoris -->
            <div class="card" onclick="location.href='index.php?page=favoris';">
                <i class="fas fa-heart icon"></i>
                <h2>Favoris</h2>
                <p>Retrouver vos biens enregistrés</p>
            </div>

            <!-- Carte Mes alertes -->
            <div class="card" onclick="location.href='index.php?page=alerte';">
                <i class="fas fa-bell icon"></i>
                <h2>Mes alertes</h2>
                <p>Gérer vos recherches sauvegardées</p>
            </div>

            <!-- Carte Mon profil -->
            <div class="card" onclick="location.href='index.php?page=candidature';">
                <i class="fas fa-folder icon"></i>
                <h2>Candidature</h2>
                <p>Compléter votre profil</p>
            </div>

            <!-- Carte Mes annonces -->
            <div class="card" onclick="location.href='index.php?page=tb_bord';">
                <i class="fas fa-home icon"></i>
                <h2>Mes annonces</h2>
                <p>Annonces déposées et contacts</p>
            </div>

            <!-- Carte Compte -->
            <div class="card" onclick="location.href='index.php?page=compte';">
                <i class="fas fa-user icon"></i>
                <h2>Compte</h2>
                <p>Données personnelles et plus</p>
            </div>

            <!-- Carte Aide -->
            <div class="card" onclick="location.href='index.php?page=aide';">
                <i class="fas fa-question-circle icon"></i>
                <h2>Aide</h2>
                <p>Support et assistance</p>
            </div>
        </div>

        <!-- Bouton Déconnexion -->
        <div class="logout">
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Se déconnecter
            </a>
        </div>
    </div>
    <?php include 'app/view/templates/footer.php'; ?>
</body>
</html>
