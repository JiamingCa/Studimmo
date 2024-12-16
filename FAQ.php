<?php
session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
if (isset($_SESSION['type'])) {
  echo '<p>Votre rôle : ' . htmlspecialchars($_SESSION['type']) . '</p>';
} else {
  echo '<p>Vous n\'êtes pas connecté ou votre rôle n\'est pas défini.</p>';
}
// Vérifie si l'utilisateur est connecté et s'il est administrateur
if (isset($_SESSION['type']) && $_SESSION['type'] === 'Admin') {
    echo '<a href="GererUtilisateur.php" class="btn btn-primary">Accès Administrateur</a>';
} else {
    echo '<p>Vous n\'avez pas les droits nécessaires pour accéder à cette section.</p>';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studimmo</title>
    <link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>

<header>
    <h1>Studimmo</h1>
</header>
<?php include("view/navbar.php"); ?>

<div class="container">
    <h2>FAQ</h2>
    <div>
        <button class="accordion">Question 1</button>
        <div class="panel">
        <p>Réponse 1</p>
        </div>

        <button class="accordion">Question 2</button>
        <div class="panel">
        <p>Réponse 2</p>
        </div>

        <button class="accordion">Question 3</button>
        <div class="panel">
        <p>Réponse 3</p>
        </div>
    </div>
</div>

<footer>
    <p>© 2024 Site de Logement - Tous droits réservés.</p>
</footer>

<script>
    var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

</body>
</html>
