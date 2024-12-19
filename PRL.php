<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudImmo</title>
  <link rel="stylesheet" href="style_PRL.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
  <header>
    <a href="homepage.html" class="logo-link">
        <img src="./img/Logo_studimmo.png" alt="Logo de STUDIMMO" class="logo">
    </a>
    <nav class="nav-menu">
        <a href="trouver-logement.html" class="nav-link">Trouver un logement</a>
        <a href="publier-annonce.html" class="nav-link">Publier une annonce</a>
        <a href="faq.html" class="nav-link">FAQ</a>
    </nav>
    
    <a href="inscription.html" class="inscription-button" id="inscriptionButton">S’inscrire</a>
    <div class="profile-avatar" id="profileAvatar" style="display: none;">
        <img src="/img/default_avatar.png" alt="Avatar de profil" class="avatar-img">
        <div class="profile-icons" id="profileIcons" style="display: flex;">
            <i href="favoris.php" class="bi bi-heart"></i>
            <i href="message.php" class="bi bi-chat"></i>
            <i href="notification.php" class="bi bi-bell"></i>
        </div>
    </div>
    <div class="burger-menu">&#9776;</div>
  </header>
  <script src="header.js"></script>

  <main class="search-page">
    <aside class="filters">
      <h2>Filtres</h2>
      <form id="filterForm" action="PRL.php" method="get">
        <!-- Filtre Localisation -->
        <div class="form-group">
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

        <!-- Filtre Surface -->
        <div class="button-container">
          <button type="button" class="toggle-button">Surface</button>
          <div class="input-container" style="display: none;">
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
          <div class="input-container" style="display: none;">
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

        <button type="submit" class="filter-button">Appliquer les filtres</button>
      </form>
      <button class="alert-button">
        <i class="fas fa-bell"></i> Créer une alerte
      </button>
    </aside>

    <section class="result-container">
      <h2>Biens trouvés</h2>
      <?php
      include 'connexion.php';
      $location = isset($_GET['location']) ? $_GET['location'] : '';
      $propertyType = isset($_GET['property-type']) ? $_GET['property-type'] : '';
      $surfaceMin = isset($_GET['surface-min']) ? $_GET['surface-min'] : '';
      $surfaceMax = isset($_GET['surface-max']) ? $_GET['surface-max'] : '';
      $budgetMin = isset($_GET['budget-min']) ? $_GET['budget-min'] : '';
      $budgetMax = isset($_GET['budget-max']) ? $_GET['budget-max'] : '';

      $sql = "SELECT a.*, p.path AS photo_path 
              FROM `annonce` a
              LEFT JOIN `galerie` g ON a.id = g.annonce_id
              LEFT JOIN `photo` p ON g.id_galerie = p.id_galerie
              WHERE 1=1";
      if ($location) {
          $sql .= " AND `localisation` LIKE :location";
      }
      if ($propertyType) {
          $sql .= " AND `type_propriete` = :propertyType";
      }
      if ($surfaceMin) {
          $sql .= " AND `surface` >= :surfaceMin";
      }
      if ($surfaceMax) {
          $sql .= " AND `surface` <= :surfaceMax";
      }
      if ($budgetMin) {
          $sql .= " AND `prix` >= :budgetMin";
      }
      if ($budgetMax) {
          $sql .= " AND `prix` <= :budgetMax";
      }

      $stmt = $pdo->prepare($sql);
      if ($location) $stmt->bindValue(':location', "%$location%");
      if ($propertyType) $stmt->bindValue(':propertyType', $propertyType);
      if ($surfaceMin) $stmt->bindValue(':surfaceMin', $surfaceMin, PDO::PARAM_INT);
      if ($surfaceMax) $stmt->bindValue(':surfaceMax', $surfaceMax, PDO::PARAM_INT);
      if ($budgetMin) $stmt->bindValue(':budgetMin', $budgetMin, PDO::PARAM_INT);
      if ($budgetMax) $stmt->bindValue(':budgetMax', $budgetMax, PDO::PARAM_INT);

      $stmt->execute();
      $logements = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($logements as $logement) {
          echo "<div class='property-card'>
                  <div class='image-container'>
                    <img src='{$logement['photo_path']}' alt='Photo de la propriété'>
                  </div>
                  <div class='property-info'>
                    <h3>{$logement['titre']} - {$logement['localisation']}</h3>
                    <p>Surface : {$logement['surface']} m²</p>
                    <p>Prix : {$logement['prix']} €</p>
                    <p>Description : {$logement['description']}</p>
                    <a href='#' class='details-button'>Voir les détails</a>
                  </div>
                </div>";
      }
      ?>
    </section>
  </main>

  <footer>
    <!-- Top Section -->
    <div class="top-footer">
      <div class="logo">
        <img src="/img/Logo_studimmo.png" alt="Logo">
      </div>
      <div class="socials">
        <p>Retrouvez-nous sur ...</p>
        <div class="icons">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-tiktok"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
    <hr>
    <!-- Bottom Section -->
    <div class="bottom-footer">
      <div class="column">
        <h3>Contact</h3>
        <ul>
          <li><a href="mailto:STUDIMMO@gmail.com">Mail : STUDIMMO@gmail.com</a></li>
          <li>Numéro : 01 23 45 67 89</li>
        </ul>
      </div>
      <div class="column">
        <h3>Liens</h3>
        <ul>
          <li><a href="Accueil.php">Page d'accueil</a></li>
          <li><a href="PRL.php">Rechercher un logement</a></li>
          <li><a href="#">Publier un logement</a></li>
          <li><a href="#">Profil</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
      <div class="column">
        <h3>À Découvrir</h3>
        <ul>
          <li><a href="#">Suggestions personnalisées</a></li>
          <li><a href="#">Logements à proximité</a></li>
          <li><a href="#">Dernières actualités</a></li>
        </ul>
      </div>
      <div class="site-description">
        <h3>À propos de Studimmo</h3>
        <p>Studimmo, votre plateforme de confiance pour trouver, publier et gérer vos logements étudiants en toute simplicité.</p>
      </div>
    </div>
    <!-- Besoin d'aide et localisation -->
    <div class="support-location">
      <div class="support">
        <h3>Besoin d'aide ?</h3>
        <p>Contactez notre équipe de support :</p>
        <a href="mailto:support@nova.com">support@nova.com</a>
      </div>
      <div class="location">
        <h3>Nous trouver</h3>
        <p> 28 Rue Notre Dame des Champs, 75006 Paris, France</p>
        <a href="https://www.google.com/maps/place/28+Rue+Notre+Dame+des+Champs,+75006+Paris,+France/@48.8453523,2.3254938,17z/data=!3m1!4b1!4m6!3m5!1s0x47e671ce3fd4afd3:0xb729389a530d1380!8m2!3d48.8453488!4d2.3280687!16s%2Fg%2F11csdnp7_k?entry=ttu&g_ep=EgoyMDI0MTExNy4wIKXMDSoASAFQAw%3D%3D" target="_blank">Voir sur Google Maps</a>
      </div>
    </div>
    <!-- Mentions légales -->
    <div class="legal-links">
      <a href="#">Mentions Légales</a> | 
      <a href="#">Conditions Générales d'Utilisation</a>
    </div>
  </footer>

  <script src="PRL.js"></script>
  <script src="Accueil.js"></script>

</body>
</html>
