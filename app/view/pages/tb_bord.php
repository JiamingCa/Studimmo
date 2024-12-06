<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="../asset/css/tb_bord.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
    <link rel="stylesheet" href="../asset/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>
    <div class="titre">
          <t1>Mes Annonce</t1>
    </div>
    <div class="tb_bord">
        <!-- Navigation Left Sidebar -->
        <div class="sidebar">
            <div class="nav-item active" id="dashboard-nav">Tableau de bord</div>
            <div class="nav-item" id="candidature-nav">Candidatures</div>
            <div class="nav-item" id="mon-compte-nav">Mon Compte</div>
            <div class="nav-item" id="aide-nav">Aide</div>
        </div>
        
        

        <!-- Content Area -->
        <div class="content">
        
            <!-- Logement 1 -->
            <div class="logement">
                <div class="logement-left">
                    <!-- Conteneur pour l'image et les informations principales -->
                    <div class="logement-top">
                        <img src="../asset/image/photo-logement.png" class="logement-image" alt="Photo Logement">
                        <div class="logement-info">
                            <p class="logement-title">Titre de l'annonce... <span class="price">€Prix</span></p>
                            <p class="logement-description">Description de l'annonce... <span class="see-more">Voir plus</span></p>
                        </div>
                    </div>
                    <!-- Conteneur pour la localisation et le statut -->
                    <div class="logement-bottom">
                        <div class="logement-info">
                            <p><i class="fa fa-map-pin"></i> Localisation</p>
                        </div>
                        <div class="status">
                            <span class="status-indicator green"></span> <span>Statut Actif</span> <!-- Rond vert pour actif -->
                        </div>
                    </div>
                </div>

                <div class="logement-right">
                    <!-- Premier sous-conteneur : Graphiques et actions -->
                    <div class="logement-right-top">
                        <div class="chart">Graphique des vues (mois)</div>
                        <div class="chart">Graphique des candidatures</div>

                        <div class="actions">
                            <button class="modify-btn">Modifier</button>
                            <button class="delete-btn">Supprimer</button>
                        </div>
                    </div>

                    <!-- Deuxième sous-conteneur : Statistiques -->
                    <div class="logement-right-bottom">
                        <div class="stats">
                            <div class="stat">
                                <i class="fa fa-eye"></i> 100 vues
                            </div>
                            <div class="stat">
                                <i class="fa fa-paper-plane"></i> 5 candidatures
                            </div>
                            <div class="stat">
                                <i class="fa fa-heart"></i> 3 favoris
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include '../templates/footer.php'; ?>
</body>
</html>
