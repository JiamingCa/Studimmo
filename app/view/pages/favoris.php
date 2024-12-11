<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris</title>
    <link rel="stylesheet" href="app/view/asset/css/favoris.css">
    <link rel="stylesheet" href="app/view/asset/css/footer.css">
    <link rel="stylesheet" href="app/view/asset/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'app/view/templates/header.php'; ?>
    <div class="favoris-container">
        <div class="header-favoris">
            <h1>Mes Favoris (<?= $nombreFavoris ?>)</h1>
            <div class="tri-options">
                <label for="tri">Trier par :</label>
                <select id="tri" name="tri" onchange="trierFavoris(this.value)">
                    <option value="recent" <?= $tri === 'recent' ? 'selected' : '' ?>>Récemment ajoutés</option>
                    <option value="prix-asc" <?= $tri === 'prix-asc' ? 'selected' : '' ?>>Prix croissant</option>
                    <option value="prix-desc" <?= $tri === 'prix-desc' ? 'selected' : '' ?>>Prix décroissant</option>
                    <option value="surface-asc" <?= $tri === 'surface-asc' ? 'selected' : '' ?>>Surface croissante</option>
                    <option value="surface-desc" <?= $tri === 'surface-desc' ? 'selected' : '' ?>>Surface décroissante</option>
                </select>
            </div>
        </div>

        <div class="liste-favoris">
            <?php if (!empty($annonces)): ?>
                <?php foreach ($annonces as $annonce): ?>
                    <div class="annonce">
                        <div class="annonce-image">
                            <img src="<?= htmlspecialchars($annonce['path']) ?>" alt="Photo de l'annonce">
                            <button class="supprimer-favori" onclick="supprimerFavori(<?= $annonce['id_annonce'] ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="annonce-details">
                            <h3><?= htmlspecialchars($annonce['titre']) ?></h3>
                            <p><strong>Prix :</strong> <?= htmlspecialchars($annonce['prix']) ?> €</p>
                            <p><strong>Surface :</strong> <?= htmlspecialchars($annonce['surface']) ?> m²</p>
                            <p><strong>Localisation :</strong> <?= htmlspecialchars($annonce['localisation']) ?></p>
                            <button class="btn-contacter">Contacter</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune annonce trouvée dans vos favoris.</p>
            <?php endif; ?>
        </div>

        <div class="pagination">
            <!-- Pagination logic here -->
        </div>
    </div>

    <script>
        function trierFavoris(valeurTri) {
            window.location.href = `index.php?page=favoris&tri=${valeurTri}`;
        }

        function supprimerFavori(idAnnonce) {
            if (confirm('Voulez-vous vraiment supprimer cet favori ?')) {
                window.location.href = `index.php?page=supprimerFavori&id_annonce=${idAnnonce}`;
            }
        }
    </script>

    <?php include 'app/view/templates/footer.php'; ?>
</body>
</html>
