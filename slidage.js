// Liste des images pour le carrousel
const images = [
    url('https://www.paris.fr/images/meta/parisfr.jpg'),
    url('https://www.larousse.fr/encyclopedie/data/images/1314872-Lyon.jpg'),
    url('https://www.lilletourism.com/app/uploads/lille-tourisme/2023/11/thumbs/Centre-ville-de-Lille-Martin-Vangaeveren-41-min-1920x960-crop-1699524524.jpg')
];

let index = 0; // Indice pour suivre l'image actuelle
const carousel = document.querySelector('.background-carousel'); // Sélection de l'élément

// Fonction pour changer l'image de fond avec une transition de glissement
function changeBackground() {
    carousel.style.transition = "transform 1s ease-in-out"; // Transition pour le glissement
    carousel.style.backgroundImage = `url(${images[index]})`;
    index = (index + 1) % images.length; // Passer à l'image suivante
}

// Démarrer le carrousel
setInterval(() => {
    // Appliquer l'effet de glissement
    carousel.style.transform = 'translateX(-100%)'; // Commence par déplacer l'élément
    setTimeout(() => {
        changeBackground();
        carousel.style.transform = 'translateX(0)'; // Revenir à la position d'origine
    }, 1000); // Attendre la fin de la transition pour changer l'image
}, 6000); // Changer toutes les 6 secondes
changeBackground(); // Initialisation au chargement
