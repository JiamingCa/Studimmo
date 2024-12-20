<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonce - Appartement Moderne</title>
    <link rel="stylesheet" type="text/css" href="app/view/asset/css/annonce.css"/>
    <link rel="stylesheet" href="app/view/asset/css/footer.css">
    <link rel="stylesheet" href="app/view/asset/css/header.css">
    <link rel="stylesheet" type="text/css" href="app/view/asset/css/popup_contcter.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">   
</head>
<body>

<?php include 'app/view/templates/header.php'; ?>
    

<div class="container">
  <h2>Appartement • Auteuil Sud, Paris 16ème</h2>
  <div class="annonce-detail">
    <div class="image-box">
      <img src="app/view/asset/image/annonce1/image1.png" alt="Appartement Moderne" class="main-image">
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
            <img src="app/view/asset/image/annonce1/image1.png" alt="Nature Image #1">
          </li>
          <li class="slide">
            <img src="app/view/asset/image/annonce1/image2.png" alt="Nature Image #2">
          </li>
          <li class="slide">
            <img src="app/view/asset/image/annonce1/image3.png" alt="Nature Image #3">
          </li>
          <li class="slide">
            <img src="app/view/asset/image/annonce1/image4.png" alt="Nature Image #4">
          </li>
          <li class="slide">
            <img src="app/view/asset/image/annonce1/image5.png" alt="Nature Image #5">
          </li>
          <li class="slide">
            <img src="app/view/asset/image/annonce1/image6.png" alt="Nature Image #6">
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
  <?php include 'app/view/templates/popup_contacter.php'; ?>
</div>


<?php include 'app/view/templates/footer.php'; ?>


<script src="annonce.js"></script>
</body>
</html>