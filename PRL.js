const locationInput = document.querySelector('#locationInput');
const suggestionsList = document.querySelector('#suggestionsList');

// Fonction pour ajouter un délai entre les requêtes
function debounce(func, delay) {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => func(...args), delay);
  };
}

// Fonction pour créer un élément de suggestion
function createSuggestionItem(text, color = 'black') {
  const li = document.createElement('li');
  li.textContent = text;
  li.style.color = color;
  return li;
}

// Gestion de l'input
locationInput.addEventListener('input', debounce(async () => {
  const inputValue = locationInput.value.trim();
  suggestionsList.innerHTML = ''; // Réinitialise les suggestions

  if (inputValue.length >= 2) { // Minimum 2 caractères pour déclencher la recherche
    try {
      let response;
      // Si l'utilisateur entre un code postal (5 chiffres)
      if (/^\d{2,5}$/.test(inputValue)) {
        response = await fetch(`https://geo.api.gouv.fr/communes?codePostal=${encodeURIComponent(inputValue)}&fields=nom,codesPostaux,population`);
      } 
      // Sinon, recherche par nom de ville
      else {
        response = await fetch(`https://geo.api.gouv.fr/communes?nom=${encodeURIComponent(inputValue)}&boost=population&limit=5&fields=nom,codesPostaux,population`);
      }

      if (!response.ok) throw new Error('Erreur lors de la récupération des données');
      const cities = await response.json();

      // Ajouter les suggestions
      if (cities.length > 0) {
        cities.forEach(city => {
          city.codesPostaux.forEach(codePostal => {
            const li = createSuggestionItem(`${city.nom} - ${codePostal}`);
            li.addEventListener('click', () => {
              locationInput.value = `${city.nom} - ${codePostal}`;
              suggestionsList.innerHTML = ''; // Efface les suggestions après sélection
            });
            suggestionsList.appendChild(li);
          });
        });
      } else {
        suggestionsList.appendChild(createSuggestionItem('Aucune correspondance trouvée', 'grey'));
      }
    } catch (error) {
      console.error('Erreur lors de la récupération des données :', error);
      suggestionsList.appendChild(createSuggestionItem('Erreur de connexion. Réessayez.', 'red'));
    }
  }
}, 300)); // Délai de 300 ms entre deux requêtes
