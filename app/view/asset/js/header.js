document.addEventListener('DOMContentLoaded', () => {
    const inscriptionButton = document.getElementById('inscriptionButton');
    const profileAvatar = document.getElementById('profileAvatar');

    // Vérifiez l'état de connexion de l'utilisateur
    if (userLoggedIn) {
        // Masquer le bouton d'inscription
        inscriptionButton.style.display = 'none';

        // Afficher l'avatar de profil
        profileAvatar.style.display = 'block';

        // Optionnel : définir l'image de profil de l'utilisateur si disponible
        profileAvatar.querySelector('img').src = "app/view/asset/image/default_avatar.png"; // Remplacez par l'URL de l'image réelle
    } else {
        // Afficher le bouton d'inscription si l'utilisateur n'est pas connecté
        inscriptionButton.style.display = 'block';
        profileAvatar.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const profileAvatarImg = document.getElementById('profileAvatarImg');
    const profileDropdown = document.getElementById('profileDropdown');

    profileAvatarImg.addEventListener('click', () => {
        profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Cacher la boîte déroulante si l'utilisateur clique en dehors
    document.addEventListener('click', (event) => {
        if (!profileAvatarImg.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.style.display = 'none';
        }
    });
});



