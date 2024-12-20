<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudImmo - Trouvez votre logement idéal</title>
  <link rel="stylesheet" href="app/view/asset/css/Accueil.css">
  <link rel="stylesheet" href="app/view/asset/css/footer.css">
  <link rel="stylesheet" href="app/view/asset/css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">   

</head>
<body>
<?php include 'app/view/templates/header.php'; ?>

<div class ="slider-container">
  <section class="hero">
    <div id="diaporama" class="slider">
      <img src="app/view/asset/image/Paris.png" alt="Image 1" >
      <img src="app/view/asset/image/Lyon.png" alt="Image 2">
    </div>
    <div class ="titre-recherche-container">
      <h1>Votre clé pour un logement étudiant idéal</h1>
      <p>Trouvez rapidement des milliers d'annonces de logements pour étudiants.</p>
      <div class="search-container">
        <!-- Formulaire de recherche action="PRL.php" -->
        <form  action="index.php" method="GET">
          <!-- Champ caché pour inclure "page=PRL" dans l'URL -->
          <input type="hidden" name="page" value="PRL">
          <input type="text" id="searchInput" name="location" placeholder="Recherchez par ville, code postal ou département" required>
          <button type="submit" id="searchButton">Rechercher</button>
        </form>
        <ul id="searchSuggestions" class="suggestions-list"></ul>
      </div>
    </div>
  </section>
</div>

  <section class="features">
    <div class="feature">
      <i class="fas fa-home"></i>
      <h3>Large choix de logements</h3>
      <p>Explorez une variété de logements adaptés à vos besoins.</p>
    </div>
    <div class="feature">
      <i class="fas fa-map-marker-alt"></i>
      <h3>Filtres personnalisés</h3>
      <p>Recherchez facilement par localisation, budget et plus encore.</p>
    </div>
    <div class="feature">
      <i class="fas fa-bell"></i>
      <h3>Alertes en temps réel</h3>
      <p>Recevez des notifications pour les nouvelles annonces.</p>
    </div>
  </section>

  

  <?php include 'app/view/templates/footer.php'; ?>
  <script src="app/view/asset/js/Accueil.js"></script>
</body>
</html>
