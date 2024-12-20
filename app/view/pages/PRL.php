<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudImmo</title>
  <link rel="stylesheet" href="app/view/asset/css/PRL.css">
  <link rel="stylesheet" href="app/view/asset/css/footer.css">
  <link rel="stylesheet" href="app/view/asset/css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">   

</head>
<body>
  <?php include 'app/view/templates/header.php'; ?>

  <main class="search-page">
    <aside class="filters">
      <h2>Filtres</h2>
      <form id="filterForm" class="filter-form" action="index.php"method="get">
      <div class= "tout-sauf-alert">
          <!-- Filtre Localisation action="PRL.php"-->
          <div class="form-container" >
            
           
            <div class="form-group">
              <!-- Champ caché pour inclure "page=PRL" dans l'URL -->
              <input type="hidden" name="page" value="PRL">
              <label for="location">Localisation :</label>
              <input type="text" id="locationInput" name="location" placeholder="Ville, Code Postal">
              <ul id="suggestionsList" class="suggestions-list"></ul>
            </div>

            <!-- Filtre Type de bien -->
            <div class="form-group">
              <label for="property-type">Type de bien :</label>
              <select id="property-type" name="property-type">
                <option value="">Tous</option>
                <option value="appartement">Appartement</option>
                <option value="maison">Maison</option>
                <option value="terrain">Terrain</option>
                <option value="colocation">Colocation</option>
              </select>
            </div>


          </div>

            <div class="boutton-container" >
            <!-- Filtre Surface -->
            <div class="button-container">
              <button type="button" class="toggle-button">Surface</button>
              <div class="input-container" >
                <div class="form-group">
                  <label for="surface-min">Surface minimale (m²) :</label>
                  <input type="number" id="surface-min" name="surface-min" placeholder="Ex: 50">
                </div>
                <div class="form-group">
                  <label for="surface-max">Surface maximale (m²) :</label>
                  <input type="number" id="surface-max" name="surface-max" placeholder="Ex: 200">
                </div>
              </div>
            </div>

            <!-- Filtre Budget -->
            <div class="button-container">
              <button type="button" class="toggle-button">Budget</button>
              <div class="input-container" >
                <div class="form-group">
                  <label for="budget-min">Budget minimum (€) :</label>
                  <input type="number" id="budget-min" name="budget-min" placeholder="Ex: 200">
                </div>
                <div class="form-group">
                  <label for="budget-max">Budget maximum (€) :</label>
                  <input type="number" id="budget-max" name="budget-max" placeholder="Ex: 1500">
                </div>
              </div>
            </div>
          </div>

        <button type="submit" class="filter-button" href="<?php echo $generatedUrl; ?>">Appliquer les filtres</button>
        </div>
        <button class="alert-button">
        <i class="fas fa-bell"></i> Créer une alerte
      </button>
      </form>
      
    </aside>

    <section class="result-container">
      <h2>Biens trouvés</h2>
      <?php foreach ($logements as $logement): ?>
            <div class='property-card' onclick="location.href='index.php?page=annonce';" >
                <div class='image-container'>
                    <img src='<?= htmlspecialchars($logement['photo_path'] ?? 'app/view/asset/img/default.png') ?>' alt='Photo de la propriété'>
                </div>
                <div class='property-info'>
                    <h3><?= htmlspecialchars($logement['titre']) ?> - <?= htmlspecialchars($logement['localisation']) ?></h3>
                    <p>Surface : <?= htmlspecialchars($logement['surface']) ?> m²</p>
                    <p>Prix : <?= htmlspecialchars($logement['prix']) ?> €</p>
                    <p>Description : <?= htmlspecialchars($logement['description']) ?></p>
                    <a class='details-button'>Voir les détails</a>
                </div>
            </div>
        <?php endforeach; ?>
      
    </section>
  </main>

  <?php include 'app/view/templates/footer.php'; ?>

  <script src="app/view/asset/js/PRL.js"></script>
  <script src="app/view/asset/js/Accueil.js"></script>

</body>
</html>
