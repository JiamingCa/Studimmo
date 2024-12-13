document.addEventListener("DOMContentLoaded", () => {
    if (typeof Chart === "undefined") {
        console.error("Chart.js n'est pas chargé.");
        return;
    }

    // Plugin local pour le titre "Candidature"
    const candidatureTitlePlugin = {
        id: 'candidatureTitle',
        beforeDraw(chart) {
            const { ctx } = chart;
            const titleFont = "bold 13px Arial";

            ctx.save();
            ctx.font = titleFont;
            ctx.fillStyle = 'black';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            // Dessiner "Candidature" en haut avec un padding vertical
            const text = 'Candidature';
            const textX = (chart.chartArea.left + chart.chartArea.right) / 2; // Centré horizontalement
            const textY = chart.chartArea.top - 45; // Ajout d'un padding vertical
            ctx.fillText(text, textX, textY);
            ctx.restore();
        }
    };

    // Plugin pour le texte dynamique au centre
    const dynamicCenterTextPlugin = {
        id: 'dynamicCenterText',
        beforeDraw(chart) {
            const { ctx } = chart;
            const centerConfig = chart.config.centerText || {};
            const text = centerConfig.text || "";
            const subtext = centerConfig.subtext || "";

            ctx.save();
            ctx.font = "bold 18px Arial";
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            ctx.fillStyle = '#000';

            // Texte principal
            const centerX = (chart.chartArea.left + chart.chartArea.right) / 2;
            const centerY = (chart.chartArea.top + chart.chartArea.bottom) / 2;
            ctx.fillText(text, centerX, centerY - 10);

            // Sous-texte
            ctx.font = "11px Arial";
            ctx.fillText(subtext, centerX, centerY + 5);

            ctx.restore();
        }
    };

    // Génération des graphiques pour chaque annonce
    Object.entries(candidatureData).forEach(([idAnnonce, data]) => {
        // Vérifier s'il y a des candidatures
        const totalCandidatures = data.stats['En attente'] + data.stats['Accepté'] + data.stats['Rejeté'];

        const chartContainer = document.getElementById(`candidature-chart-${idAnnonce}`).parentElement;
        if (totalCandidatures === 0) {
            // Si pas de candidatures, afficher un message à la place du graphique
            chartContainer.innerHTML = "<p style='width:150px; height:auto; text-align:center; margin: 0; font-size: 14px;'>Il n'y a pas de candidatures pour le moment.</p>";
            return; // Ne pas afficher le graphique
        }

        const ctx = document.getElementById(`candidature-chart-${idAnnonce}`).getContext('2d');

        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['En attente', 'Accepté', 'Rejeté'],
                datasets: [{
                    data: [
                        data.stats['En attente'],
                        data.stats['Accepté'],
                        data.stats['Rejeté']
                    ],
                    backgroundColor: ['#FFA500', '#4CAF50', '#F44336'],
                    borderColor: '#ffffff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cutout: '65%', // Ajustez cette valeur pour changer la taille des cercles
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle', // Les points sont des cercles
                            font: {
                                size: 10
                            },
                            color: '#333',
                            padding: 5
                        }
                    },
                    tooltip: {
                        enabled: false // Désactiver les tooltips natifs
                    },
                },
                layout: {
                    padding: {
                        top: 15 // Laisse un peu d'espace en haut pour le titre
                    }
                },
                onHover: (event, elements) => {
                    if (elements.length) {
                        const element = elements[0];
                        const dataset = chart.data.datasets[element.datasetIndex];
                        const label = chart.data.labels[element.index];
                        const value = dataset.data[element.index];

                        // Mettre à jour le texte au centre
                        chart.config.centerText = {
                            text: `${((value / totalCandidatures) * 100).toFixed(0)}%`,
                            subtext: `${label}`
                        };
                        chart.update();
                    }
                },
                onLeave: () => {
                    // Afficher un texte par défaut lorsqu'on enlève la souris
                    chart.config.centerText = {
                        text: `${((data.stats['En attente'] / totalCandidatures) * 100).toFixed(0)}%`,
                        subtext: "En attente"
                    };
                    chart.update();
                }
            },
            plugins: [candidatureTitlePlugin, dynamicCenterTextPlugin]
        });

        // Texte par défaut au centre
        chart.config.centerText = {
            text: `${((data.stats['En attente'] / totalCandidatures) * 100).toFixed(0)}%`,
            subtext: "En attente"
        };
        chart.update();
    });

    // Réinitialiser les styles injectés par Chart.js
    const allCanvases = document.querySelectorAll("canvas");
    allCanvases.forEach((canvas) => {
        canvas.style.width = "";
        canvas.style.height = "";
    });
});
