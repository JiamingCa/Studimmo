// Récupération des éléments
const searchInput = document.querySelector('#searchInput');
const searchSuggestions = document.querySelector('#searchSuggestions');
const filterContainer = document.querySelector('#filterContainer'); // Conteneur pour les filtres sélectionnés
const resultsContainer = document.querySelector('#resultsContainer'); // Conteneur pour les résultats de recherche (à ajouter dans votre HTML)

// Fonction debounce pour limiter les appels API
function debounce(func, delay) {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => func(...args), delay);
  };
}

// Fonction pour créer un élément de suggestion (modifié pour ajouter un bouton)
function createSuggestionItem(label, type, color = 'black') {
  const li = document.createElement('li');
  li.innerHTML = `
    <button class="suggestion-button" style="color: ${color};">
      <strong>${label}</strong> <small>(${type})</small>
    </button>`;
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

// Fonction pour effectuer la recherche de logements
async function fetchHousingResults(query) {
  try {
    const response = await fetch(`Search.php?query=${encodeURIComponent(query)}`);
    resultsContainer.innerHTML = ''; // Réinitialiser les résultats

    if (response.ok) {
      const results = await response.json();

      if (results.length > 0) {
        results.forEach((result) => {
          const resultItem = document.createElement('div');
          resultItem.className = 'result-item';
          resultItem.innerHTML = `
            <div>
              <h3>${result.titre}</h3>
              <p>${result.description}</p>
              <p><strong>Localisation :</strong> ${result.localisation}</p>
              <p><strong>Prix :</strong> ${result.prix} €</p>
            </div>
            <img src="${result.image_url}" alt="${result.titre}">
          `;
          resultsContainer.appendChild(resultItem);
        });
      } else {
        resultsContainer.innerHTML = '<p>Aucun logement trouvé pour cette localisation.</p>';
      }
    } else {
      resultsContainer.innerHTML = '<p>Erreur lors de la recherche des logements.</p>';
    }
  } catch (error) {
    console.error('Erreur lors de la recherche des logements :', error);
    resultsContainer.innerHTML = '<p>Erreur de connexion au serveur.</p>';
  }
}

// Gestion de la sélection d'une suggestion (modifié pour fonctionner avec les boutons)
searchSuggestions.addEventListener('click', (event) => {
  const button = event.target.closest('.suggestion-button');
  if (button) {
    const selectedText = button.querySelector('strong').textContent.trim();

    // Insérer la suggestion dans la barre de recherche
    searchInput.value = selectedText;

    // Efface les suggestions après sélection
    searchSuggestions.innerHTML = '';

    // Vérifie si le filtre existe déjà
    const existingFilters = Array.from(filterContainer.children).map((filter) => filter.textContent.replace('×', '').trim());
    if (!existingFilters.includes(selectedText)) {
      const filter = createFilter(selectedText);
      filterContainer.appendChild(filter);
    }

    // Lancer la recherche pour la localisation sélectionnée
    fetchHousingResults(selectedText);
  }
});

// Écoute de l'événement input avec debounce
searchInput.addEventListener('input', debounce(fetchSuggestions, 300));
