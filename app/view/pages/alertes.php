<!-- View: alertes.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Alertes</title>
    <link rel="stylesheet" href="app/view/asset/css/alertes.css">
    <link rel="stylesheet" href="app/view/asset/css/footer.css">
    <link rel="stylesheet" href="app/view/asset/css/header.css">
    <link rel="stylesheet" href="app/view/asset/css/template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">   
</head>
<body>
    <?php include 'app/view/templates/header.php'; ?>
    <div class="titre">
        <a href='index.php?page=mon_espace' class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <t1>Mes Alertes</t1>
    </div>
    <div class="alertes-container">
        <?php foreach ($alertes as $alerte): ?>
            <div class="alerte-item" id="alerte-<?= $alerte['id_alerte'] ?>">
                <div class="alerte-header">
                    <h2>Mon futur bien à : <?= htmlspecialchars($alerte['localisation']) ?></h2>
                    <button class="delete-btn" onclick="supprimerAlerte(<?= $alerte['id_alerte'] ?>)">
                        <i class="bi bi-trash3" alt="Supprimer"></i>  
                    </button>
                </div>
                <div class="alerte-tags">
                    <span><?= htmlspecialchars($alerte['type']) ?></span>
                    <span><?= htmlspecialchars($alerte['prix']) ?> €</span>
                    <span><?= htmlspecialchars($alerte['surface']) ?> m²</span>
                    <span><?= htmlspecialchars($alerte['localisation']) ?></span>
                    <span>...</span>
                </div>
                <div class="alerte-details">
                    <p>E-mail</p>
                    <button class="toggle-btn" onclick="toggleAlerte(<?= $alerte['id_alerte'] ?>, <?= $alerte['etat'] ? 0 : 1 ?>)">
                        <?= $alerte['etat'] ? 'Désactivée' : 'Activée' ?>
                    </button>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <script>
        function toggleAlerte(id, isActive) {
            fetch(`/toggle_alerte.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ alerteId: id, etat: isActive })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    alert("Alerte mise à jour avec succès");
                }
            });
        }

        function supprimerAlerte(id) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette alerte ?")) {
                fetch(`/supprimer_alerte.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ alerteId: id })
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        document.getElementById(`alerte-${id}`).remove();
                        alert("Alerte supprimée avec succès");
                    }
                });
            }
        }
    </script>
    <?php include 'app/view/templates/footer.php'; ?>
</body>
</html>
