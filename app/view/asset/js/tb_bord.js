document.addEventListener("DOMContentLoaded", function() {
    // Ajouter la classe hidden par défaut pour les écrans inférieurs à 800px
    const graphsContainers = document.querySelectorAll(".afficheur-graph");
    if (window.innerWidth <= 800) {
        graphsContainers.forEach(container => {
            container.classList.add("hidden");
        });
    }

    // Sélectionnez tous les boutons toggle
    const toggleButtons = document.querySelectorAll(".toggle-graphs-btn");

    toggleButtons.forEach(button => {
        button.addEventListener("click", function() {
            const graphsContainer = this.closest('.logement').querySelector('.afficheur-graph');
            const isExpanded = this.getAttribute("aria-expanded") === "true";

            // Basculer l'état d'affichage
            graphsContainer.classList.toggle("hidden", isExpanded);

            // Mettre à jour l'état de l'attribut aria-expanded
            this.setAttribute("aria-expanded", !isExpanded);

            // Basculer l'icône entre "+" et "-"
            const icon = this.querySelector("i");
            if (icon) {
                icon.classList.toggle("fa-plus", isExpanded);
                icon.classList.toggle("fa-minus", !isExpanded);
            }
        });
    });
});
