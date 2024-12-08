document.addEventListener("DOMContentLoaded", () => {
    // Vérifier si Chart.js est chargé
    if (typeof Chart === "undefined") {
        console.error("Chart.js n'est pas chargé.");
        return;
    }

    // Plugin personnalisé pour ajouter un titre et un sous-titre
    Chart.register({
        id: 'customSubtitle',
        beforeDraw(chart) {
            const { ctx } = chart;
            const titleFont = "bold 16px Arial"; // Style pour "Vues"
            const subtitleFont = "12px Arial"; // Style pour "Par mois"

            ctx.save();
            ctx.font = titleFont;
            ctx.fillStyle = 'black';
            ctx.textAlign = 'left';
            ctx.fillText('Vues', chart.chartArea.left, chart.chartArea.top - 20);

            ctx.font = subtitleFont;
            ctx.fillStyle = 'gray';
            ctx.fillText('Par mois', chart.chartArea.left, chart.chartArea.top - 5);
            ctx.restore();
        }
    });

    // Boucler sur les données
    Object.entries(vuesData).forEach(([idAnnonce, data]) => {
        const ctx = document.getElementById(`chart-${idAnnonce}`).getContext('2d');
        
        // Trouver le mois avec le maximum de vues
        const maxVues = Math.max(...Object.values(data.vues));
        const maxIndex = Object.values(data.vues).indexOf(maxVues);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    data: Object.values(data.vues),
                    backgroundColor: 'rgba(123, 97, 255, 0.8)', // Couleur des barres
                    borderRadius: 5, // Arrondi des coins
                    borderSkipped: false // Supprime les coins carrés
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Permet de redimensionner librement le graphique
                layout: {
                    padding: {
                        top: 30 // Augmente l'espace au-dessus du graphique
                    }
                },
                plugins: {
                    legend: {
                        display: false // Supprime la légende
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        color: '#7b61ff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: function(value, context) {
                            // Afficher le chiffre uniquement pour la barre avec la valeur maximale
                            return context.dataIndex === maxIndex ? value : '';
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.raw} vues`; // Infobulle : "X vues"
                            }
                        },
                        displayColors: false, // Supprimer les couleurs dans l'infobulle
                        backgroundColor: '#000', // Fond noir pour l'infobulle
                        titleColor: '#fff', // Couleur du titre de l'infobulle
                        bodyColor: '#fff', // Couleur du texte de l'infobulle
                        caretSize: 5, // Taille de la petite flèche de l'infobulle
                        yAlign: 'top', // Affiche l'infobulle au bas de la barre
                    }
                },
                scales: {
                    y: {
                        display: false // Supprimer l'axe des ordonnées
                    },
                    x: {
                        ticks: {
                            color: '#666' // Couleur des mois
                        },
                        grid: {
                            display: false // Supprimer la grille verticale
                        }
                    }
                },
                animation: {
                    duration: 800, // Durée de l'animation
                    easing: 'easeOutQuint' // Animation fluide
                }
            },
            plugins: [ChartDataLabels] // Activer ChartDataLabels pour afficher le chiffre
        });
    });
    // Étape 4 : Réinitialiser les styles injectés par Chart.js
    const allCanvases = document.querySelectorAll("canvas");
    allCanvases.forEach((canvas) => {
        canvas.style.width = ""; // Réinitialise le style inline de largeur
        canvas.style.height = ""; // Réinitialise le style inline de hauteur
    });
});

