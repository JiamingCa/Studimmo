<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="app/view/asset/css/tb_bord.css">
    <link rel="stylesheet" href="app/view/asset/css/footer.css">
    <link rel="stylesheet" href="app/view/asset/css/header.css">
    <link rel="stylesheet" href="app/view/asset/css/template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'app/view/templates/header.php'; ?>
    <div class="titre">
        <a href='index.php?page=mon_espace' class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <t1>Mes Annonces</t1>
    </div>
    <div class="tb_bord">
        

        <!-- Content -->
        <div class="content">
            <?php if (!empty($annonces)): ?>
                <?php foreach ($annonces as $annonce): ?>
                    <div class="logement">
                        <div class="logement-left">
                            <div class="logement-top">
                                <img src="<?= htmlspecialchars($annonce['path']) ?>" class="logement-image" alt="Photo logement">
                                <div class="logement-info_1">
                                    <div class="title-price">
                                        <div>
                                            <p class="logement-title">
                                                <?= htmlspecialchars($annonce['titre']) ?> 
                                            </p>
                                        </div>
                                        <div>
                                            <p class="logement-price"> 
                                                <span class="price"><?= htmlspecialchars($annonce['prix']) ?> €</span>
                                            </p>
                                        </div>
                                    </div>    
                                    <div>
                                       <p class="logement-description">
                                            <?= htmlspecialchars($annonce['description']) ?> 
                                        </p> 
                                    </div>
                                    <div style="padding-top: 10px;">
                                        <button class="btn-see-more">Voir plus</button>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="logement-bottom">
                                <div class="logement-info_2">
                                    <p><i class="fa fa-map-pin"></i> <?= htmlspecialchars($annonce['localisation']) ?></p>
                                </div>
                                <div class="status">
                                    <?php 
                                        // Déterminez la couleur en fonction du statut
                                        $statusClass = '';
                                        if ($annonce['statut'] === 'Actif') {
                                            $statusClass = 'green';
                                        } elseif ($annonce['statut'] === 'Inactif') {
                                            $statusClass = 'red';
                                        } elseif ($annonce['statut'] === 'Vérification') {
                                            $statusClass = 'orange';
                                        }
                                    ?>
                                    <span class="status-indicator <?= $statusClass ?>"></span>
                                    <span><?= htmlspecialchars($annonce['statut']) ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="vertical-bar"></div>
                        
                        <div class="logement-right">
                            <div class="logement-right-top">
                                <div class="afficheur-graph">
                                    <div class="graph-1">
                                        <canvas  id="chart-<?= $annonce['id_annonce'] ?>" width="325" height="150" display="false"></canvas>
                                    </div>
                                    <div class="graph-2">
                                        <canvas id="candidature-chart-<?= $annonce['id_annonce'] ?>" width="150" height="150" display="false"></canvas>
                                    </div>
                                </div>
                                <div class="actions">
                                    <button class="modify-btn">Modifier</button>
                                    <button class="delete-btn">Supprimer</button>
                                </div>
                            </div>
                            <div class="logement-right-bottom">
                                <div class="stats">
                                    <div class="stat">
                                        <i class="fa fa-eye"></i> 
                                        <?= isset($vuesStructurees[$annonce['id_annonce']]['total']) 
                                            ? $vuesStructurees[$annonce['id_annonce']]['total'] 
                                            : 0 ?> vues
                                    </div>
                                    <div class="stat">
                                        <i class="fa fa-paper-plane"></i> 
                                        <?= isset($candidaturesStructurees[$annonce['id_annonce']]['total']) 
                                            ? $candidaturesStructurees[$annonce['id_annonce']]['total'] 
                                            : 0 ?> candidatures
                                    </div>
                                    <div class="stat">
                                        <i class="fa fa-heart"></i> <?= $favorisStructurees[$annonce['id_annonce']] ?? 0 ?> favoris
                                    </div>
                                    <button class="toggle-graphs-btn" aria-expanded="false">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="annonces-empty">
                    <div class="animation-container">
                        <i class="bi bi-house-x"></i>
                    </div>
                    <p class="empty-text">Vous n'avez encore ajouté aucune annonce.</p>
                    <button class="create-annonce-button" onclick="window.location.href='index.php?page=creer_annonce'">Créer une annonce</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include 'app/view/templates/footer.php'; ?>
    <!-- Inclure le fichier JS -->
    <script src="app/view/asset/js/graphvues.js"></script>
    <script src="app/view/asset/js/tb_bord.js"></script>
    <script src="app/view/asset/js/graphcandidature.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        // Passer les données PHP vers le fichier JavaScript
        const vuesData = <?= json_encode($vuesStructurees) ?>;
        const candidatureData = <?= json_encode($candidaturesStructurees); ?>;
    </script>
</body>
</html>
