document.addEventListener("DOMContentLoaded", () => {
    const inputs = document.querySelectorAll("input[type='file']");
    const progressBar = document.getElementById("progress-bar");
    const progressText = document.getElementById("progress-text");
    const garantType = document.getElementById("garant_type");
    const garantPhysique = document.getElementById("garant_physique");
    const garantMoral = document.getElementById("garant_moral");

    // Map pour garder une trace des numéros d'incrémentation pour chaque input
    const fileCounters = {};

    // Gestion de l'importation des fichiers
    inputs.forEach(input => {
        const inputId = input.id;
        fileCounters[inputId] = 0; // Initialiser le compteur pour cet input

        input.addEventListener("change", () => {
            updatePreview(input, inputId);
            updateProgress();
        });
    });

    // Affichage conditionnel et réinitialisation des sections Garant
    garantType?.addEventListener("change", event => {
        const value = event.target.value;

        // Masquer/Afficher les sections et réinitialiser les fichiers
        if (value === "physique") {
            resetSection(garantMoral); // Réinitialiser garant moral
            garantPhysique?.classList.remove("hidden");
            garantMoral?.classList.add("hidden");
        } else if (value === "moral") {
            resetSection(garantPhysique); // Réinitialiser garant physique
            garantPhysique?.classList.add("hidden");
            garantMoral?.classList.remove("hidden");
        } else {
            // Aucun garant
            resetSection(garantPhysique);
            resetSection(garantMoral);
            garantPhysique?.classList.add("hidden");
            garantMoral?.classList.add("hidden");
        }

        updateProgress();
    });

    function updatePreview(input, inputId) {
        const preview = input.closest(".sub-card, .card").querySelector(".file-preview");
        const files = Array.from(input.files);

        // Vérifier et supprimer le message "Aucun fichier importé"
        const emptyMessage = preview.querySelector("p");
        if (emptyMessage && emptyMessage.textContent === "Aucun fichier importé") {
            emptyMessage.remove();
        }

        if (files.length > 0) {
            files.forEach(file => {
                const fileName = file.name;
                const fileId = `${inputId}-file-${fileCounters[inputId]++}`; // Utilisation et incrémentation du compteur

                const fileContainer = document.createElement("div");
                fileContainer.classList.add("preview-content");
                fileContainer.id = fileId;

                fileContainer.innerHTML = `
                    <p>${fileName}</p>
                    <button class="delete-btn" title="Supprimer le fichier">❌</button>
                `;

                preview.appendChild(fileContainer);

                // Gestion de la suppression individuelle des fichiers
                const deleteBtn = fileContainer.querySelector(".delete-btn");
                deleteBtn.addEventListener("click", () => {
                    fileContainer.remove();
                    updateProgress();

                    // Réinitialiser si tout est supprimé
                    if (preview.querySelectorAll(".preview-content").length === 0) {
                        input.value = "";
                        preview.innerHTML = "<p>Aucun fichier importé</p>";
                    }
                });
            });
        }
    }

    function resetSection(section) {
        if (!section) return;

        // Réinitialiser tous les inputs de fichier de cette section
        const inputs = section.querySelectorAll("input[type='file']");
        inputs.forEach(input => {
            input.value = ""; // Réinitialiser l'input
            const preview = input.closest(".sub-card, .card").querySelector(".file-preview");
            if (preview) {
                preview.innerHTML = "<p>Aucun fichier importé</p>"; // Réinitialiser l'aperçu
            }
            // Réinitialiser le compteur associé à l'input
            fileCounters[input.id] = 0;
        });
    }

    function updateProgress() {
        const sections = document.querySelectorAll(".card");
        let filledSections = 0;
        let totalSections = 0;

        sections.forEach(section => {
            if (section.id === "garant") {
                const garantTypeValue = garantType.value;

                if (garantTypeValue === "physique") {
                    const subSections = section.querySelectorAll(".sub-card");
                    totalSections += subSections.length;

                    subSections.forEach(subSection => {
                        const input = subSection.querySelector("input[type='file']");
                        const preview = subSection.querySelector(".file-preview");

                        if (input && preview.querySelectorAll(".preview-content").length > 0) {
                            filledSections++; // Une sous-section remplie
                        }
                    });
                } else if (garantTypeValue === "moral") {
                    const input = garantMoral.querySelector("input[type='file']");
                    const preview = garantMoral.querySelector(".file-preview");

                    totalSections += 1; // Compté comme une seule section
                    if (input && preview.querySelectorAll(".preview-content").length > 0) {
                        filledSections++;
                    }
                }
                // Si "Aucun garant", aucune section n'est comptabilisée
            } else {
                totalSections += 1;
                const inputsInSection = section.querySelectorAll("input[type='file']");
                let sectionFilled = false;

                inputsInSection.forEach(input => {
                    const preview = input.closest(".sub-card, .card").querySelector(".file-preview");
                    if (preview.querySelectorAll(".preview-content").length > 0) {
                        sectionFilled = true; // Section remplie si un fichier est présent
                    }
                });

                if (sectionFilled) {
                    filledSections++;
                }
            }
        });

        const progress = (filledSections / totalSections) * 100;
        progressBar.style.width = `${progress}%`;
        progressText.textContent = `${Math.round(progress)}% Complété`;
    }
});


document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    form.addEventListener("submit", (e) => {
        // Vérifiez si des fichiers ont été importés
        const inputs = document.querySelectorAll("input[type='file']");
        let hasFiles = false;

        inputs.forEach(input => {
            if (input.files.length > 0) {
                hasFiles = true;
            }
        });

        if (!hasFiles) {
            e.preventDefault();
            alert("Veuillez importer au moins un fichier avant de soumettre.");
        }
    });
});
