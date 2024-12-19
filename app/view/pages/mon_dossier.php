<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Dossier</title>
    <link rel="stylesheet" href="app/view/asset/css/footer.css">
    <link rel="stylesheet" href="app/view/asset/css/header.css">
    <link rel="stylesheet" href="app/view/asset/css/template.css">
    <link rel="stylesheet" href="app/view/asset/css/mon_dossier.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">   
</head>
<body>
    <?php include 'app/view/templates/header.php'; ?>

    <div class="dossier-visualisation-wrapper">
        <!-- Titre principal -->
        <div class="header-section">
            <h1 class="title">Mon Dossier</h1>
            <p class="subtitle">Voici les fichiers que vous avez téléchargés pour votre dossier.</p>
        </div>

        <div class="files-section">
            <?php
            // Sections prédéfinies avec leur titre
            $sections = [
                'identite' => 'Identité',
                'scolarite' => 'Scolarité',
                'rib_locataire' => 'RIB Locataire',
                'garant_moral' => 'Garant Moral'
            ];

            // Sous-sections pour "Garant Physique"
            $sousSectionsGarantPhysique = [
                'garant_identite' => 'Identité',
                'garant_rib' => 'RIB',
                'garant_domicile' => 'Domicile',
                'garant_impot' => 'Impôts'
            ];

            // Fonction pour vérifier si un fichier appartient à une section
            function belongsToSection($nomFichier, $sectionKey) {
                return $nomFichier === $sectionKey;
            }

            // Afficher les sections principales
            foreach ($sections as $key => $title) {
                echo "<div class='section'>";
                echo "<h2>$title</h2>";

                // Trouver les fichiers de la section courante
                $sectionFiles = [];
                foreach ($documents as $file) {
                    if (belongsToSection($file['nom_fichier'], $key)) {
                        $sectionFiles[] = $file;
                    }
                }

                // Afficher les fichiers ou un message vide
                if (count($sectionFiles) > 0) {
                    echo "<ul class='file-list'>";
                    foreach ($sectionFiles as $file) {
                        $fileName = htmlspecialchars($file['nom_fichier']);
                        $fileUrl = htmlspecialchars($file['chemin_fichier']);
                        echo "<li class='file-item'>
                                <a href='$fileUrl' target='_blank'>
                                    <i class='fas fa-file'></i> $fileName
                                </a>
                                <button class='replace-btn' data-file-id='{$file['id_document']}'>Remplacer</button>
                                <button class='delete-btn' data-file-id='{$file['id_document']}'>Supprimer</button>
                            </li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='empty'>Aucun fichier dans cette section.</p>";
                    echo "<button class='upload-btn' data-section='$key'>Importer un fichier</button>";
                }

                echo "</div>";
            }

            // Section pour "Garant Physique"
            echo "<div class='section'>";
            echo "<h2>Garant Physique</h2>";

            foreach ($sousSectionsGarantPhysique as $key => $title) {
                echo "<div class='sub-section'>";
                echo "<h3>$title</h3>";

                // Trouver les fichiers pour chaque sous-section de "Garant Physique"
                $subSectionFiles = [];
                foreach ($documents as $file) {
                    if (belongsToSection($file['nom_fichier'], $key)) {
                        $subSectionFiles[] = $file;
                    }
                }

                // Afficher les fichiers ou un message vide
                if (count($subSectionFiles) > 0) {
                    echo "<ul class='file-list'>";
                    foreach ($subSectionFiles as $file) {
                        $fileName = htmlspecialchars($file['nom_fichier']);
                        $fileUrl = htmlspecialchars($file['chemin_fichier']);
                        echo "<li class='file-item'>
                                <a href='$fileUrl' target='_blank'>
                                    <i class='fas fa-file'></i> $fileName
                                </a>
                                <button class='replace-btn' data-file-id='{$file['id_document']}'>Remplacer</button>
                                <button class='delete-btn' data-file-id='{$file['id_document']}'>Supprimer</button>
                            </li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='empty'>Aucun fichier dans cette sous-section.</p>";
                    echo "<button class='upload-btn' data-section='$key'>Importer un fichier</button>";
                }

                echo "</div>";
            }
            echo "</div>";
            ?>
        </div>



        <!-- Bouton pour retourner à l'accueil -->
        <div class="action-section">
            <a href="?page=creer_dossier" class="action-btn">Retour</a>
        </div>
    </div>

    <?php include 'app/view/templates/footer.php'; ?>

    <!-- Scripts pour gérer les boutons -->
    <script>
        document.querySelectorAll('.replace-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const fileId = button.dataset.fileId;
                alert('Remplacement de fichier ID : ' + fileId + ' non implémenté.');
                // Ajoutez ici votre logique de remplacement
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const fileId = button.dataset.fileId;
                alert('Suppression de fichier ID : ' + fileId + ' non implémentée.');
                // Ajoutez ici votre logique de suppression
            });
        });

        document.querySelectorAll('.upload-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const sectionKey = button.dataset.section;
                alert('Importation de fichier pour la section : ' + sectionKey + ' non implémentée.');
                // Ajoutez ici votre logique d'importation
            });
        });
    </script>
    
</body>
</html>