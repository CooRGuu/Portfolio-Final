<?php
// Inclure les fichiers de connexion à la base de données
require_once 'config.php'; // Remplacez par le fichier de configuration contenant vos constantes DB

// Démarrer une session pour pouvoir stocker des informations sur l'utilisateur
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_login'])) {
    header("Location: accueil.php"); // Si l'utilisateur est déjà connecté, rediriger vers la page d'accueil
    exit;
}

// Traitement du formulaire après soumission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations du formulaire
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    // Vérification si les champs ne sont pas vides
    if (empty($login) || empty($password)) {
        echo "Tous les champs sont obligatoires.";
    } else {
        // Créer la connexion à la base de données
        $dsn = sprintf('mysql:host=%s;dbname=%s;port=%d;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT);
        try {
            $mysqlClient = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD);
            $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour vérifier l'utilisateur
            $sql = "SELECT * FROM users WHERE login = :login";
            $stmt = $mysqlClient->prepare($sql);
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe et si le mot de passe est correct
            if ($user) {
                // Comparer le mot de passe en clair
                if ($password === $user['password']) {
                    // Si l'authentification réussit, on démarre la session
                    $_SESSION['user_login'] = $user['login'];
                    
                    // Rediriger l'utilisateur vers la page d'accueil
                    header("Location: accueil.php");
                    exit;
                } else {
                    echo "Identifiant ou mot de passe incorrect.";
                }
            } else {
                echo "Identifiant ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-size: 1rem;
            margin-bottom: 8px;
            display: block;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Connexion</h2>
        <form method="POST" action="login.php">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
    </div>

</body>
</html>
