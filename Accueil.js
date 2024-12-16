// Récupération des éléments
const searchInput = document.querySelector('#searchInput');
const searchSuggestions = document.querySelector('#searchSuggestions');
const filterContainer = document.querySelector('#filterContainer'); // Conteneur pour les filtres sélectionnés

// Fonction debounce pour limiter les appels API
function debounce(func, delay) {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => func(...args), delay);
  };
}

// Fonction pour créer un élément de suggestion
function createSuggestionItem(label, type, color = 'black') {
  const li = document.createElement('li');
  li.innerHTML = `<strong>${label}</strong> <small>(${type})</small>`;
  li.style.color = color;
  return li;
}

// Fonction pour créer un filtre sélectionné
function createFilter(label) {
  const filter = document.createElement('div');
  filter.className = 'filter';
  filter.textContent = label;
  const removeBtn = document.createElement('button');
  removeBtn.textContent = '×';
  removeBtn.className = 'remove-filter';
  filter.appendChild(removeBtn);

  // Suppression du filtre au clic sur le bouton
  removeBtn.addEventListener('click', () => {
    filterContainer.removeChild(filter);
  });

  return filter;
}

// Fonction principale pour gérer les suggestions
async function fetchSuggestions() {
  const inputValue = searchInput.value.trim();
  searchSuggestions.innerHTML = ''; // Réinitialise les suggestions

  if (inputValue.length >= 1) {
    try {
      const suggestions = [];

      // Si c'est un code postal (5 chiffres)
      if (/^\d{5}$/.test(inputValue)) {
        const postalResponse = await fetch(
          `https://geo.api.gouv.fr/communes?codePostal=${encodeURIComponent(inputValue)}&fields=nom,codesPostaux`
        );
        if (postalResponse.ok) {
          const postal = await postalResponse.json();
          if (postal.length > 0) {
            postal.forEach((commune) => {
              suggestions.push(createSuggestionItem(commune.nom, 'Code Postal'));
            });
          } else {
            suggestions.push(createSuggestionItem('Aucune commune trouvée', 'Info', 'grey'));
          }
        } else {
          suggestions.push(createSuggestionItem('Erreur API pour code postal', 'Erreur', 'red'));
        }
      } else {
        // Recherche par nom (communes et départements)
        const citiesResponse = await fetch(
          `https://geo.api.gouv.fr/communes?nom=${encodeURIComponent(inputValue)}&boost=population&limit=10&fields=nom,codesPostaux`
        );
        if (citiesResponse.ok) {
          const cities = await citiesResponse.json();
          cities.forEach((city) => {
            city.codesPostaux.forEach((codePostal) => {
              suggestions.push(createSuggestionItem(`${city.nom} - ${codePostal}`, 'Commune'));
            });
          });
        }

        const deptResponse = await fetch(
          `https://geo.api.gouv.fr/departements?nom=${encodeURIComponent(inputValue)}&fields=nom,code`
        );
        if (deptResponse.ok) {
          const departments = await deptResponse.json();
          departments.forEach((dept) => {
            suggestions.push(createSuggestionItem(dept.nom, `Département ${dept.code}`));
          });
        }
      }

      // Affichage des suggestions
      if (suggestions.length > 0) {
        suggestions.forEach((suggestion) => searchSuggestions.appendChild(suggestion));
      } else {
        searchSuggestions.appendChild(createSuggestionItem('Aucune correspondance trouvée', 'Info', 'grey'));
      }
    } catch (error) {
      console.error('Erreur lors de la récupération des données :', error);
      searchSuggestions.appendChild(createSuggestionItem('Erreur de connexion', 'Erreur', 'red'));
    }
  }
}

// Écoute de l'événement input avec debounce
searchInput.addEventListener('input', debounce(fetchSuggestions, 300));

// Gestion de la sélection d'une suggestion
searchSuggestions.addEventListener('click', (event) => {
  if (event.target.tagName === 'LI') {
    const selectedText = event.target.textContent;

    // Vérifie si le filtre existe déjà
    const existingFilters = Array.from(filterContainer.children).map((filter) => filter.textContent.replace('×', '').trim());
    if (!existingFilters.includes(selectedText)) {
      const filter = createFilter(selectedText);
      filterContainer.appendChild(filter);
    }

    searchInput.value = ''; // Réinitialise le champ de recherche
    searchSuggestions.innerHTML = ''; // Efface les suggestions après sélection
  }
});

// Slider
const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

let currentIndex = 0; // Index de l'image actuelle

// Fonction pour afficher le slide actif
function showSlide(index) {
  // Réinitialiser tous les slides
  slides.forEach((slide) => {
    slide.classList.remove('active');
  });

  // Ajouter la classe active au slide correspondant
  slides[index].classList.add('active');
}

// Fonction pour passer au slide suivant
function nextSlide() {
  currentIndex = (currentIndex + 1) % slides.length; // Revenir au premier slide après le dernier
  showSlide(currentIndex);
}

// Fonction pour revenir au slide précédent
function prevSlide() {
  currentIndex = (currentIndex - 1 + slides.length) % slides.length; // Revenir au dernier slide avant le premier
  showSlide(currentIndex);
}

// Ajouter les événements pour les boutons
nextButton.addEventListener('click', nextSlide);
prevButton.addEventListener('click', prevSlide);

// Afficher le premier slide au chargement
showSlide(currentIndex);

// Optionnel : Défilement automatique
setInterval(nextSlide, 5000); // Change toutes les 5 secondes
