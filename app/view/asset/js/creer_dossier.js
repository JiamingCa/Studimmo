document.addEventListener("DOMContentLoaded", () => {
    const inputs = document.querySelectorAll("input[type='file']");
    const progressBar = document.getElementById("progress-bar");
    const progressText = document.getElementById("progress-text");
    const garantType = document.getElementById("garant_type");
    const garantPhysique = document.getElementById("garant_physique");
    const garantMoral = document.getElementById("garant_moral");

    // Stockage temporaire des fichiers par input
    const fileStorage = {};

    // Initialisation des fichiers pour chaque input
    inputs.forEach(input => {
        fileStorage[input.id] = []; // Initialisation du stockage des fichiers
        input.addEventListener("change", () => handleFileChange(input));
    });

    // Gestion de l'affichage conditionnel des sections Garant
    garantType?.addEventListener("change", event => {
        const value = event.target.value;

        if (value === "physique") {
            clearFileStorage(garantMoral); // Supprimer réellement les fichiers pour "moral"
            garantPhysique?.classList.remove("hidden");
            garantMoral?.classList.add("hidden");
        } else if (value === "moral") {
            clearFileStorage(garantPhysique); // Supprimer réellement les fichiers pour "physique"
            garantPhysique?.classList.add("hidden");
            garantMoral?.classList.remove("hidden");
        } else {
            clearFileStorage(garantPhysique); // Supprimer les fichiers pour "physique"
            clearFileStorage(garantMoral);   // Supprimer les fichiers pour "moral"
            garantPhysique?.classList.add("hidden");
            garantMoral?.classList.add("hidden");
        }

        updateProgress();
    });

    // Gestion des fichiers
    function handleFileChange(input) {
        const inputId = input.id;
        const preview = input.closest(".card, .sub-card").querySelector(".file-preview");

        // Ajouter les fichiers au stockage
        const newFiles = Array.from(input.files);
        fileStorage[inputId] = [...fileStorage[inputId], ...newFiles];

        // Mettre à jour l'aperçu
        updatePreview(preview, fileStorage[inputId]);

        // Réinitialiser l'input pour permettre un nouvel ajout
        input.value = "";
        updateProgress();
    }

    function updatePreview(preview, files) {
        preview.innerHTML = ""; // Réinitialiser l'affichage

        files.forEach((file, index) => {
            const fileContainer = document.createElement("div");
            fileContainer.classList.add("preview-content");

            fileContainer.innerHTML = `
                <p>${file.name}</p>
                <button class="delete-btn" data-index="${index}" title="Supprimer le fichier">❌</button>
            `;

            // Suppression des fichiers
            fileContainer.querySelector(".delete-btn").addEventListener("click", (event) => {
                const fileIndex = event.target.dataset.index;
                files.splice(fileIndex, 1); // Supprimer le fichier du stockage
                updatePreview(preview, files); // Mettre à jour l'affichage
                updateProgress();
            });

            preview.appendChild(fileContainer);
        });

        // Ajouter un message si aucun fichier n'est présent
        if (files.length === 0) {
            preview.innerHTML = "<p>Aucun fichier importé</p>";
        }
    }

    function clearFileStorage(section) {
        if (!section) return;

        const inputs = section.querySelectorAll("input[type='file']");
        inputs.forEach(input => {
            const inputId = input.id;

            // Supprimer les fichiers du stockage
            fileStorage[inputId] = [];

            // Nettoyer l'aperçu
            const preview = input.closest(".sub-card, .card").querySelector(".file-preview");
            if (preview) {
                preview.innerHTML = "<p>Aucun fichier importé</p>";
            }
        });
    }

    function updateProgress() {
        const sections = document.querySelectorAll(".card");
        let filledSections = 0;
        let totalSections = 0;
    
        sections.forEach(section => {
            if (section.id === "garant") {
                const garantTypeValue = garantType?.value;
    
                if (garantTypeValue === "physique") {
                    // Prendre en compte uniquement les sous-sections de garant physique
                    const subSections = section.querySelectorAll("#garant_physique .sub-card");
                    totalSections += subSections.length;
    
                    subSections.forEach(subSection => {
                        const input = subSection.querySelector("input[type='file']");
                        if (fileStorage[input.id]?.length > 0) {
                            filledSections++;
                        }
                    });
                } else if (garantTypeValue === "moral") {
                    // Prendre en compte uniquement la section garant moral
                    const inputsInMoral = section.querySelectorAll("#garant_moral input[type='file']");
                    totalSections += inputsInMoral.length;
    
                    inputsInMoral.forEach(input => {
                        if (fileStorage[input.id]?.length > 0) {
                            filledSections++;
                        }
                    });
                }
                // Ne pas ajouter de sections si garantType est "aucun"
            } else {
                // Compter les autres sections
                totalSections++;
                const inputsInSection = section.querySelectorAll("input[type='file']");
                if (Array.from(inputsInSection).some(input => fileStorage[input.id]?.length > 0)) {
                    filledSections++;
                }
            }
        });
    
        const progress = (filledSections / totalSections) * 100;
        progressBar.style.width = `${progress}%`;
        progressText.textContent = `${Math.round(progress)}% Complété`;
    }
    

    // Gestion de la soumission du formulaire
    const form = document.querySelector("form");
    form.addEventListener("submit", (event) => {
        const formData = new FormData();

        // Ajouter tous les fichiers stockés au FormData
        Object.keys(fileStorage).forEach(inputId => {
            fileStorage[inputId].forEach((file, index) => {
                formData.append(`${inputId}[]`, file, file.name);
            });
        });

        // Vérifier si des fichiers ont été importés
        if ([...formData.keys()].length === 0) {
            event.preventDefault();
            alert("Veuillez importer au moins un fichier avant de soumettre.");
            return;
        }

        // Envoyer les données via AJAX ou continuer la soumission classique
        const xhr = new XMLHttpRequest();
        xhr.open("POST", form.action, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                window.location.href = "?page=confirmation";
            } else {
                alert("Erreur lors de l'envoi des fichiers.");
            }
        };
        xhr.send(formData);

        // Empêcher la soumission classique
        event.preventDefault();
    });
});
