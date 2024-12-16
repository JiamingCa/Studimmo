<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon dossier</title>
    <link rel="stylesheet" href="app/view/asset/css/footer.css">
    <link rel="stylesheet" href="app/view/asset/css/header.css">
    <link rel="stylesheet" href="app/view/asset/css/template.css">
    <link rel="stylesheet" href="app/view/asset/css/creer_dossier.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'app/view/templates/header.php'; ?>

    <div class="dossier-wrapper">
        <!-- Titre principal -->
        <div class="header-section">
            <h1 class="title">Créer Votre Dossier</h1>
            <p class="subtitle">Complétez toutes les sections pour finaliser votre dossier.</p>
        </div>

        <!-- Zone des cartes (pièces principales) -->
        <form id="creer-dossier-form" action="?page=traiter_fichiers" method="POST" enctype="multipart/form-data">
            <div class="cards-section">
                <!-- Pièce d'identité -->
                <div class="card" id="identite">
                    <h2>Pièce d'identité</h2>
                    <div class="file-preview" id="preview_identite">
                        <p>Aucun fichier importé</p>
                    </div>
                    <div class="file-upload">
                        <label for="file_identite" class="upload-btn">Importer un fichier</label>
                        <input type="file" name="file_identite[]" id="file_identite" accept=".jpg,.png,.pdf" multiple hidden>
                    </div>
                </div>

                <!-- Justificatif de scolarité -->
                <div class="card" id="scolarite">
                    <h2>Justificatif de scolarité</h2>
                    <div class="file-preview" id="preview_scolarite">
                        <p>Aucun fichier importé</p>
                    </div>
                    <label for="file_scolarite" class="upload-btn">Importer</label>
                    <input type="file" name="file_scolarite[]" id="file_scolarite" accept=".jpg,.png,.pdf" multiple hidden>
                </div>

                <!-- RIB du locataire -->
                <div class="card" id="rib_locataire">
                    <h2>RIB du locataire</h2>
                    <div class="file-preview" id="preview_rib_locataire">
                        <p>Aucun fichier importé</p>
                    </div>
                    <label for="file_rib_locataire" class="upload-btn">Importer</label>
                    <input type="file" name="file_rib_locataire[]" id="file_rib_locataire" accept=".jpg,.png,.pdf" multiple hidden>
                </div>

                <!-- Section Garant -->
                <div class="card" id="garant">
                    <h2>Garant</h2>
                    <select id="garant_type" class="garant-select" name="garant_type">
                        <option value="">Choisissez le type de garant</option>
                        <option value="physique">Garant physique</option>
                        <option value="moral">Garant moral</option>
                    </select>

                    <!-- Garant Physique -->
                    <div id="garant_physique" class="garant-section hidden">
                        <!-- Pièce d'identité -->
                        <div class="sub-card" id="garant_identite">
                            <h3>Pièce d'identité</h3>
                            <div class="file-preview" id="preview_garant_identite">
                                <p>Aucun fichier importé</p>
                            </div>
                            <label for="file_garant_identite" class="upload-btn">Importer</label>
                            <input type="file" name="file_garant_identite[]" id="file_garant_identite" accept=".jpg,.png,.pdf" multiple hidden>
                        </div>
                        <!-- RIB -->
                        <div class="sub-card" id="garant_rib">
                            <h3>RIB</h3>
                            <div class="file-preview" id="preview_garant_rib">
                                <p>Aucun fichier importé</p>
                            </div>
                            <label for="file_garant_rib" class="upload-btn">Importer</label>
                            <input type="file" name="file_garant_rib[]" id="file_garant_rib" accept=".jpg,.png,.pdf" multiple hidden>
                        </div>
                        <!-- Justificatif de domicile -->
                        <div class="sub-card" id="garant_domicile">
                            <h3>Justificatif de domicile</h3>
                            <div class="file-preview" id="preview_garant_domicile">
                                <p>Aucun fichier importé</p>
                            </div>
                            <label for="file_garant_domicile" class="upload-btn">Importer</label>
                            <input type="file" name="file_garant_domicile[]" id="file_garant_domicile" accept=".jpg,.png,.pdf" multiple hidden>
                        </div>
                        <!-- Dernier avis d'imposition -->
                        <div class="sub-card" id="garant_impot">
                            <h3>Dernier avis d'imposition</h3>
                            <div class="file-preview" id="preview_garant_impot">
                                <p>Aucun fichier importé</p>
                            </div>
                            <label for="file_garant_impot" class="upload-btn">Importer</label>
                            <input type="file" name="file_garant_impot[]" id="file_garant_impot" accept=".jpg,.png,.pdf" multiple hidden>
                        </div>
                    </div>

                    <!-- Garant Moral -->
                    <div id="garant_moral" class="garant-section hidden" style="flex-direction: column;">
                        <div>
                            <p>Pour utiliser Visale, rendez-vous sur leur site et suivez les instructions :</p>
                            <a href="https://www.visale.fr" target="_blank" class="link">Aller sur Visale</a>               
                        </div>
                        <div>
                            <div class="sub-card" id="garant_moral">
                                <h3>Importer document Visale</h3>
                                <div class="file-preview" id="preview_garant_moral">
                                    <p>Aucun fichier importé</p>
                                </div>
                                <label for="file_garant_moral" class="upload-btn">Importer</label>
                                <input type="file" name="file_garant_moral[]" id="file_garant_moral" accept=".jpg,.png,.pdf" multiple hidden>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Zone de progression -->
            <div class="progress-section">
                <div class="progress-bar-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
                <p class="progress-text" id="progress-text">0% Complété</p>
            </div>

            <!-- Bouton de finalisation -->
            <div class="finalize-section">
                <button type="submit" class="finalize-btn">Créer mon dossier</button>
            </div>
        </form>
    </div>

    <?php include 'app/view/templates/footer.php'; ?>

    <script src="app/view/asset/js/creer_dossier.js"></script>
</body>
</html>
