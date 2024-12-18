<header>
    <a href="index.php?page=homepage" class="logo-link">
        <img src="app/view/asset/image/Logo_studimo.png" alt="Logo de STUDIMMO" class="logo">
    </a>
    <nav class="nav-menu">
        <a href="trouver-logement.html" class="nav-link">Trouver un logement</a>
        <a href="publier-annonce.html" class="nav-link">Publier une annonce</a>
        <a href="faq.html" class="nav-link">FAQ</a>
    </nav>
    
    <a href="index.php?page=Connexion" class="inscription-button" id="inscriptionButton">Connexion</a>
    <div class="profile-avatar" id="profileAvatar" style="display: none;">
        <img src="app/view/asset/image/default_avatar.png" alt="Avatar de profil" class="avatar-img">
        <div class="profile-icons" id="profileIcons" style="display: flex;">
            <i href="favoris.php" class="bi bi-heart"></i>
            <i href="message.php" class="bi bi-chat"></i>
            <i href="notification.php" class="bi bi-bell"></i>
        </div>
    </div>
    <div class="burger-menu">&#9776;</div>
</header>
        <script>
            const USER_LOGGED_IN = <?php echo isset($_SESSION['type']) ? 'true' : 'false'; ?>;
        </script>
        <script src="app/view/asset/js/header.js"></script>
        
