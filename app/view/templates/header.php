<header>
    <a href="index.php?page=homepage" class="logo-link">
        <img src="app/view/asset/image/Logo_studimo.png" alt="Logo de STUDIMMO" class="logo">
    </a>
    <nav class="nav-menu">
        <a href="trouver-logement.html" class="nav-link">Trouver un logement</a>
        <a href="publier-annonce.html" class="nav-link">Publier une annonce</a>
        <a href='index.php?page=Faq'; class="nav-link">FAQ</a>
    </nav>
    
    <a href="index.php?page=Connexion" class="inscription-button" id="inscriptionButton">Connexion</a>
    <div class="profile-avatar" id="profileAvatar" style="display: none; position: relative;">
        <img src="app/view/asset/image/default_avatar.png" alt="Avatar de profil" class="avatar-img" id="profileAvatarImg" style="cursor: pointer;">
        <div class="profile-icons" id="profileIcons" style="display: flex; gap: 10px;">
            <a href='index.php?page=favoris'><i  class="bi bi-heart"></i></a>
            <a href='index.php?page=messagerie' ><i class="bi bi-chat"></i></a>
            <a href='index.php?page=alert'><i  class="bi bi-bell"></i></a>
        </div>
        <div class="profile-dropdown" id="profileDropdown" style="display: none; position: absolute; top: 80px; right: 0; background: #ffffff; border-radius: 10px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2); z-index: 1000; overflow: hidden;">
            <a href='index.php?page=mon_espace' class="dropdown-item">
                <i class="bi bi-wallet"></i> Mon Espace
            </a>
            <a href='index.php?page=compte' class="dropdown-item">
                <i class="fas fa-user icon"></i> Mon Compte
            </a>
            <a href='index.php?page=mon_dossier' class="dropdown-item">
                <i class="bi bi-folder"></i> Mon Dossier
            </a>
            <a href='index.php?page=tb_bord' class="dropdown-item">
                <i class="fas fa-home icon"></i> Mes Annonces
            </a>
            <hr style="margin: 0; border: none; border-top: 1px solid #eee;">
            <a href='index.php?page=deconnexion' class="dropdown-item header-logout">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </a>
        </div>
    </div>

    <div class="burger-menu">&#9776;</div>
</header>
        
        <script src="app/view/asset/js/header.js"></script>
        
