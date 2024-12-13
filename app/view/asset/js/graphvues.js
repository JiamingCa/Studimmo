document.addEventListener("DOMContentLoaded", () => {
    if (typeof Chart === "undefined") {
        console.error("Chart.js n'est pas chargé.");
        return;
    }

    // Plugin local pour ajouter "Vues" et "Par mois"
    const vuesSubtitlePlugin = {
        id: 'vuesSubtitle',
        beforeDraw(chart) {
            const { ctx } = chart;
            const titleFont = "bold 16px Arial";
            const subtitleFont = "12px Arial";

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
    };

    Object.entries(vuesData).forEach(([idAnnonce, data]) => {
        const ctx = document.getElementById(`chart-${idAnnonce}`).getContext('2d');

        const maxVues = Math.max(...Object.values(data.vues));
        const maxIndex = Object.values(data.vues).indexOf(maxVues);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    data: Object.values(data.vues),
                    backgroundColor: 'rgba(123, 97, 255, 0.8)',
                    borderRadius: 5,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 30
                    }
                },
                plugins: {
                    legend: {
                        display: false
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
                            return context.dataIndex === maxIndex ? value : '';
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.raw} vues`;
                            }
                        },
                        displayColors: false,
                        backgroundColor: '#000',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        caretSize: 5,
                        yAlign: 'top',
                    }
                },
                scales: {
                    y: {
                        display: false
                    },
                    x: {
                        ticks: {
                            color: '#666'
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                animation: {
                    duration: 800,
                    easing: 'easeOutQuint'
                }
            },
            plugins: [ChartDataLabels, vuesSubtitlePlugin]
        });
    });

    const allCanvases = document.querySelectorAll("canvas");
    allCanvases.forEach((canvas) => {
        canvas.style.width = "";
        canvas.style.height = "";
    });
});
