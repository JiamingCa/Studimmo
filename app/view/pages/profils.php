<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Gestion Logement Étudiant</title>
    <link rel="stylesheet" href="../asset/css/profils.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
    <link rel="stylesheet" href="../asset/css/header.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>
    <div class="titre">
    <header>
        <div class="container">
            <h1>Gestion Logement Étudiant</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="profil.php">Mon Profil</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
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
            
            <section class="logements">
                <h2>Mes Logements</h2>
                <div class="logement-card">
                    <h3>Appartement 1</h3>
                    <p><strong>Adresse :</strong> 45 Rue des Étudiants</p>
                    <p><strong>Prix :</strong> 500€/mois</p>
                    <p><strong>Description :</strong> Studio meublé, proche université.</p>
                </div>
                <div class="logement-card">
                    <h3>Appartement 2</h3>
                    <p><strong>Adresse :</strong> 12 Avenue du Campus</p>
                    <p><strong>Prix :</strong> 450€/mois</p>
                    <p><strong>Description :</strong> Studio calme, bien desservi.</p>
                </div>
            </section>
        </div>
        <?php include '../templates/footer.php'; ?>
    </main>
</body>
</html>

