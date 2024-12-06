document.addEventListener('DOMContentLoaded', () => {
    const inscriptionButton = document.getElementById('inscriptionButton');
    const profileAvatar = document.getElementById('profileAvatar');
    
    
    // Simuler la vérification de l'état de connexion de l'utilisateur
    const userLoggedIn = true; // Changez à true pour tester l'état connecté

    if (userLoggedIn) {
        // Masquer le bouton d'inscription
        inscriptionButton.style.display = 'none';
        // Afficher l'avatar de profil 
        profileAvatar.style.display = 'block';
       

        // Optionnel : définir l'image de profil de l'utilisateur si disponible
        profileAvatar.querySelector('img').src = "../asset/image/default_avatar.png"; // Remplacez par l'URL de l'image réelle
    } else {
        // Assurer que le bouton d'inscription est visible si l'utilisateur n'est pas connecté
        inscriptionButton.style.display = 'block';
        profileAvatar.style.display = 'none';
        
    }
    
});
