<?php
// Connexion à la base de données

// Gestion AJAX : suppression d'un utilisateur
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id_Utilisateur = intval($_POST['id_Utilisateur']);
    $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE id_Utilisateur = :id_Utilisateur");
    $stmt->execute(['id_Utilisateur' => $id_Utilisateur]);
    echo json_encode(['status' => 'success']);
    exit;
}

// Gestion AJAX : modification d'un utilisateur
if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $id_Utilisateur = intval($_POST['id_Utilisateur']);
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $type = $_POST['type'];

    $stmt = $pdo->prepare("UPDATE utilisateur SET prenom = :prenom, nom = :nom, email = :email, type = :type WHERE id_Utilisateur = :id_Utilisateur");
    $stmt->execute([
        'prenom' => $prenom,
        'nom' => $nom,
        'email' => $email,
        'type' => $type,
        'id_Utilisateur' => $id_Utilisateur
    ]);
    echo json_encode(['status' => 'success']);
    exit;
}

// Récupération de tous les utilisateurs
$stmt = $pdo->query("SELECT * FROM utilisateur");
$utilisateur = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fb;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #004080;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #004080;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6f7ff;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            border: none;
            background: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .action-buttons .update {
            color: #007bff;
        }

        .action-buttons .update:hover {
            background-color: #e6f7ff;
        }

        .action-buttons .delete {
            color: #ff4d4f;
        }

        .action-buttons .delete:hover {
            background-color: #ffe6e6;
        }

        .action-buttons i {
            font-size: 1.2em;
        }

        input[type="text"], input[type="email"] {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]:focus, input[type="email"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="app/view/asset/css/ptemplate.css"/>
    <link rel="stylesheet" type="text/css" href="app/view/asset/css/header.css"/>
</head>
<body>
<?php include("app/view/templates/header.php"); ?>
<div class="container">
    <h1>Gérer les utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTable">
            <?php foreach ($utilisateur as $user): ?>
                <tr id="user-<?= htmlspecialchars($user['id_Utilisateur']) ?>">
                    <td><?= htmlspecialchars($user['id_Utilisateur']) ?></td>
                    <td><input type="text" class="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" data-id="<?= htmlspecialchars($user['id_Utilisateur']) ?>"></td>
                    <td><input type="text" class="nom" value="<?= htmlspecialchars($user['nom']) ?>" data-id="<?= htmlspecialchars($user['id_Utilisateur']) ?>"></td>
                    <td><input type="email" class="email" value="<?= htmlspecialchars($user['email']) ?>" data-id="<?= htmlspecialchars($user['id_Utilisateur']) ?>"></td>
                    <td><input type="text" class="type" value="<?= htmlspecialchars($user['type']) ?>" data-id="<?= htmlspecialchars($user['id_Utilisateur']) ?>"></td>
                    <td>
                        <div class="action-buttons">
                            <button class="update" data-id="<?= htmlspecialchars($user['id_Utilisateur']) ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete" data-id="<?= htmlspecialchars($user['id_Utilisateur']) ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Suppression
    $(document).on('click', '.delete', function () {
        const userId = $(this).data('id');
        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
            $.post('', { action: 'delete', id_Utilisateur: userId }, function (response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    // Supprime la ligne utilisateur visuellement
                    $(`#user-${userId}`).fadeOut(300, function () {
                        $(this).remove();
                    });
                } else {
                    alert('Erreur lors de la suppression de l’utilisateur.');
                }
            }).fail(function () {
                alert('Une erreur s\'est produite lors de la suppression.');
            });
        }
    });

    // Modification
    $(document).on('click', '.update', function () {
        const userId = $(this).data('id');
        const prenom = $(`.prenom[data-id="${userId}"]`).val();
        const nom = $(`.nom[data-id="${userId}"]`).val();
        const email = $(`.email[data-id="${userId}"]`).val();
        const type = $(`.type[data-id="${userId}"]`).val();

        $.post('', { action: 'update', id_Utilisateur: userId, prenom, nom, email, type }, function (response) {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                // Met en surbrillance la ligne pour indiquer le succès
                const row = $(`#user-${userId}`);
                row.css('background-color', '#d4edda'); // Vert clair pour succès
                setTimeout(() => row.css('background-color', ''), 1000); // Retour à la normale après 1 seconde
            } else {
                alert('Erreur lors de la mise à jour de l’utilisateur.');
            }
        }).fail(function () {
            alert('Une erreur s\'est produite lors de la mise à jour.');
        });
    });
</script>
</body>
</html>
