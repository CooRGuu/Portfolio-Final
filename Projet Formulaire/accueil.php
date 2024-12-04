<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_login'])) {
    header("Location: login.php"); // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    exit;
}

// Récupérer les informations de l'utilisateur (par exemple, le nom)
$user_login = $_SESSION['user_login'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        .logout-btn {
            background-color: #ff4c4c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #e04343;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Bienvenue, <?php echo htmlspecialchars($user_login); ?>!</h2>
        <p>Vous êtes connecté avec succès.</p>
        <a href="logout.php" class="logout-btn">Se déconnecter</a>
    </div>

</body>
</html>
