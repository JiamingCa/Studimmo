<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce - Appartement Moderne</title>
    <link rel="stylesheet" type="text/css" href="annonce.css"/>
    <link rel="stylesheet" type="text/css" href="popup_contcter.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">   
</head>
<body>

<header>
    <a href="homepage.html" class="logo-link">
        <img src="logo.png" alt="STUDIMMO" class="logo">
    </a>
    <nav class="nav-menu">
        <a href="trouver-logement.html" class="nav-link">Trouver un logement</a>
        <a href="publier-annonce.html" class="nav-link">Publier une annonce</a>
        <a href="faq.html" class="nav-link">FAQ</a>
    </nav>
    
    <a href="inscription.html" class="inscription-button" id="inscriptionButton">S’inscrire</a>
    <div class="profile-avatar" id="profileAvatar" style="display: none;">
        <img src="app/view/asset/image/default_avatar.png" alt="Avatar de profil" class="avatar-img">
        <div class="profile-icons" id="profileIcons" style="display: flex;">
            <i href="favoris.php" class="bi bi-heart"></i>
            <i href="message.php" class="bi bi-chat"></i>
            <i href="notification.php" class="bi bi-bell"></i>
        </div>
    </div>
    <div class="burger-menu">&#9776;</div>
</header>
        <script src="header.js"></script>
    

<div class="container">
  <h2>Appartement • Auteuil Sud, Paris 16ème</h2>
  <div class="annonce-detail">
    <div class="image-box">
      <img src="image1.png" alt="Appartement Moderne" class="main-image">
    </div>
    <div class="info-box">
      <div class="description">
        <h3>5 Pièces • Surface de 99 m²</h3>
        <p>Très bel appartement lumineux de 99 m² rénové et meublé avec beaucoup de goût. Situé en rez-de-chaussée, cet appartement comprend une entrée, une cuisine aménagée et équipée ouvrant sur un grand séjour, trois chambres, une salle de bains et une salle de douche. Une cave complète ce bien.
          Gardien, digicode, interphone, ascenseur.</p>
        </p>Chauffage et eau chaude collectifs.</p>
        </p>Disponible fin décembre.</p>
        </p>Référence de l'annonce : 85472260</p>
        <button class="heart-button" onclick="toggleFavorite()">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
          </svg>
        </button>
        <button class="contact-icon-button" onclick="togglePopup()">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope-plus" viewBox="0 0 16 16">
            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
  <div class =  "section2">
    <section aria-label="Newest Photos">
      <div class="carousel" data-carousel>
        <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
        <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
        <ul data-slides>
          <li class="slide" data-active>
            <img src="image1.png" alt="Nature Image #1">
          </li>
          <li class="slide">
            <img src="image2.png" alt="Nature Image #2">
          </li>
          <li class="slide">
            <img src="image3.png" alt="Nature Image #3">
          </li>
          <li class="slide">
            <img src="image4.png" alt="Nature Image #3">
          </li>
          <li class="slide">
            <img src="image5.png" alt="Nature Image #3">
          </li>
          <li class="slide">
            <img src="image6.png" alt="Nature Image #3">
          </li>
        </ul>
      </div>
    </section>
    <div class="financial-conditions">
        <li><strong>Loyer charges comprises :</strong> 3 555 € / mois</li>
        <li><strong>Loyer de base :</strong> 3 255 € / mois</li>
        <li><strong>Dépôt de garantie :</strong> 6 510 €</li>
      </ul>
    </div>
  </div>
  <?php include 'popup_contacter.php'; ?>
</div>

<footer>
 <!-- Top Section -->
 <div class="top-footer">
    <div class="logo">
      <img src="logo.png" alt="Logo">
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
        <li><a href="#">Page d'accueil</a></li>
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

<script>
    function contactOwner() {
        alert("Merci de nous contacter via l'email ou le téléphone mentionné.");
    }
</script>


<script src="annonce.js"></script>
</body>
</html>