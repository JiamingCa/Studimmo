<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StudImmo - Trouvez votre logement idéal</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style_Accueil.css">
</head>
<body>
<header>
    <a href="homepage.html" class="logo-link">
        <img src="Logo_studimmo.png" alt="Logo de STUDIMMO" class="logo">
    </a>
    <nav class="nav-menu">
        <a href="trouver-logement.html" class="nav-link">Trouver un logement</a>
        <a href="publier-annonce.html" class="nav-link">Publier une annonce</a>
        <a href="faq.html" class="nav-link">FAQ</a>
    </nav>
    
    <a href="inscription.html" class="inscription-button" id="inscriptionButton">S’inscrire</a>
    <div class="profile-avatar" id="profileAvatar" style="display: none;">
        <img src="default_avatar.png" alt="Avatar de profil" class="avatar-img">
        <div class="profile-icons" id="profileIcons" style="display: flex;">
            <i href="favoris.php" class="bi bi-heart"></i>
            <i href="message.php" class="bi bi-chat"></i>
            <i href="notification.php" class="bi bi-bell"></i>
        </div>
    </div>
    <div class="burger-menu">&#9776;</div>
</header>
<script src="header.js"></script>

  <section class="hero">
    <div class="image-slider">
      <h1>Votre clé pour un logement étudiant idéal</h1>
        <p>Trouvez rapidement des milliers d'annonces de logements pour étudiants.</p>
        <div class="search-container">
          <input type="text" id="searchInput" placeholder="Recherchez par ville, code postal ou département">
          <button id="searchButton">Rechercher</button>
          <ul id="searchSuggestions" class="suggestions-list"></ul>
        </div>

        <div class="slides">
          <img src="img/Paris.jpg">
          <img src="img/Lyon.jpg">
        </div>
    </div>
    
  </section>

  <div class="image-slider">
      <div class="slides">
        <img src="Paris.jpg">
        <img src="Lyon.jpg">
      </div>
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

  <section class="cta">
    <h2>Prêt à trouver votre logement ?</h2>
    <button>Commencez votre recherche</button>
  </section>

  <footer>
    <!-- Top Section -->
    <div class="top-footer">
      <div class="logo">
        <img src="Logo_studimmo.png" alt="Logo">
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
          <li><a href="Page_Accueil.php">Page d'accueil</a></li>
          <li><a href="#">Rechercher un logement</a></li>
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

  <script src="Accueil.js"></script>
</body>
</html>
