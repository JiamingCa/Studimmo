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
                        <button class="arrow arrow-left" onclick="changeImage(-1, <?= $annonce['id_annonce'] ?>)">&#10094;</button>
                        <img id="image-<?= $annonce['id_annonce'] ?>" 
                            src="<?= htmlspecialchars(json_decode($annonce['images'])[0]) ?>" 
                            alt="Photo de l'annonce" 
                            data-images='<?= json_encode(json_decode($annonce['images'])) ?>'
                            data-current-index="0">
                        <button class="arrow arrow-right" onclick="changeImage(1, <?= $annonce['id_annonce'] ?>)">&#10095;</button>
                    </div>
                    <div class="annonce-details">
                        <h3><?= htmlspecialchars($annonce['titre']) ?></h3>
                        <p><strong>Prix :</strong> <?= htmlspecialchars($annonce['prix']) ?> €</p>
                        <div style="display: flex; gap: 5px;">
                            <p><strong></strong> <?= htmlspecialchars($annonce['surface']) ?> m², </p>
                            <p><strong></strong> <?= htmlspecialchars($annonce['nombre_pieces']) ?> pièces, </p>
                            <p><strong></strong> <?= htmlspecialchars($annonce['type']) ?></p>
                        </div>
                        <p><strong>Localisation :</strong> <?= htmlspecialchars($annonce['localisation']) ?></p>
                        <button class="btn-contacter">Contacter</button>
                    </div>
                    <!-- Changer l'icône du cœur en fonction de `is_favori` -->
                    <button class="favori-toggle" data-id="<?= $annonce['id_annonce'] ?>" data-active="<?= $annonce['is_favori'] ? 'true' : 'false' ?>">
                        <i class="bi <?= $annonce['is_favori'] ? 'bi-heart-fill' : 'bi-heart' ?>" style="color: <?= $annonce['is_favori'] ? 'red' : 'black' ?>"></i>
                    </button>
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
        document.querySelector('.liste-favoris').addEventListener('click', function(event) {
            const button = event.target.closest('.favori-toggle'); // Vérifie si le clic est sur un bouton
            if (button) {
                const annonceId = button.dataset.id;
                const isActive = button.dataset.active === "true";

                // Envoie une requête POST à ajax_favori.php
                fetch('ajax_favori.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ idAnnonce: annonceId, action: isActive ? 'remove' : 'add' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Changer l'état du bouton
                        button.dataset.active = !isActive;
                        const icon = button.querySelector('i');
                        if (isActive) {
                            icon.classList.replace('bi-heart-fill', 'bi-heart');
                            icon.style.color = 'black';
                        } else {
                            icon.classList.replace('bi-heart', 'bi-heart-fill');
                            icon.style.color = 'red';
                        }
                    } else {
                        alert('Une erreur est survenue.');
                    }
                })
                .catch(error => console.error('Erreur:', error));
            }
        });

    </script>


    <script>
        document.getElementById('tri').addEventListener('change', function() {
            const valeurTri = this.value;

            // Envoie une requête AJAX pour récupérer les annonces triées
            fetch(`ajax_tri.php?tri=${valeurTri}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mettre à jour dynamiquement la liste des favoris
                        const listeFavoris = document.querySelector('.liste-favoris');
                        listeFavoris.innerHTML = ''; // Effacer les anciennes annonces

                        data.annonces.forEach(annonce => {
                            // S'assurer que l'images est un tableau valide
                            const images = annonce.images && Array.isArray(annonce.images) ? annonce.images : [];

                            // Créer un nouvel élément pour chaque annonce
                            const annonceElement = document.createElement('div');
                            annonceElement.classList.add('annonce');
                            annonceElement.innerHTML = `
                                <div class="annonce-image">
                                    <button class="arrow arrow-left" onclick="changeImage(-1, ${annonce.id_annonce})">&#10094;</button>
                                    <img id="image-${annonce.id_annonce}" 
                                        src="${images[0] || ''}" 
                                        alt="Photo de l'annonce" 
                                        data-images='${JSON.stringify(images)}'
                                        data-current-index="0">
                                    <button class="arrow arrow-right" onclick="changeImage(1, ${annonce.id_annonce})">&#10095;</button>
                                </div>
                                <div class="annonce-details">
                                    <h3>${annonce.titre}</h3>
                                    <p><strong>Prix :</strong> ${annonce.prix} €</p>
                                    <p><strong>Surface :</strong> ${annonce.surface} m²</p>
                                    <p><strong>Localisation :</strong> ${annonce.localisation}</p>
                                    <button class="btn-contacter">Contacter</button>
                                </div>
                                <button class="favori-toggle" data-id="${annonce.id_annonce}" data-active="${annonce.is_favori ? 'true' : 'false'}">
                                    <i class="bi ${annonce.is_favori ? 'bi-heart-fill' : 'bi-heart'}" style="color: ${annonce.is_favori ? 'red' : 'black'}"></i>
                                </button>
                            `;
                            listeFavoris.appendChild(annonceElement);
                        });
                    } else {
                        alert('Erreur lors du tri des favoris');
                    }
                })
                .catch(error => console.error('Erreur:', error));
        });

        function changeImage(direction, annonceId) {
            const imageElement = document.getElementById(`image-${annonceId}`);
            const images = JSON.parse(imageElement.getAttribute('data-images'));
            let currentIndex = parseInt(imageElement.getAttribute('data-current-index'));

            // Calculer le nouvel index en fonction de la direction (-1 pour précédent, 1 pour suivant)
            currentIndex = (currentIndex + direction + images.length) % images.length;

            // Mettre à jour l'image affichée
            imageElement.src = images[currentIndex];
            imageElement.setAttribute('data-current-index', currentIndex);
        }





        
        function changeImage(direction, annonceId) {
            const imageElement = document.getElementById(`image-${annonceId}`);
            const images = JSON.parse(imageElement.dataset.images); // Récupère les chemins des images
            let currentIndex = parseInt(imageElement.dataset.currentIndex) || 0;

            // Calculer le nouvel index
            currentIndex = (currentIndex + direction + images.length) % images.length;

            // Mettre à jour l'image
            imageElement.src = images[currentIndex];
            imageElement.dataset.currentIndex = currentIndex; // Mettre à jour l'index courant
        }

    </script>

    <?php include 'app/view/templates/footer.php'; ?>
</body>
</html>
