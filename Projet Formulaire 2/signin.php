<?php
// Inclure le fichier avec les constantes de connexion à la base de données (formulaire.php)
require_once 'config.php';

// Initialisation des variables de connexion
$dsn = sprintf('mysql:host=%s;dbname=%s;port=%d;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT);

try {
    // Création de la connexion PDO
    $mysqlClient = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD);
    // Configuration du mode d'erreur
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exception) {
    // Gestion des erreurs de connexion
    die('Erreur : ' . $exception->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire et éviter les espaces superflus
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    // Vérifier si tous les champs sont remplis
    if (empty($prenom) || empty($nom) || empty($login) || empty($password)) {
        die("Tous les champs sont obligatoires.");
    }

    // Le reste du traitement de l'insertion dans la base de données
    $sql = "INSERT INTO users (nom, prenom, login, password) VALUES (:nom, :prenom, :login, :password)";
    
    try {
        // Préparer la requête
        $stmt = $mysqlClient->prepare($sql);
        
        // Lier les paramètres
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);

        // Exécuter la requête
        $stmt->execute();

        // Message de succès
        echo "L'utilisateur a été enregistré avec succès.";
    } catch (PDOException $e) {
        die("Erreur lors de l'insertion dans la base de données : " . $e->getMessage());
    }
}
// Rediriger vers la page de connexion
header("Location: login.php");
exit;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Utilisateur</title>
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
        <h2>Formulaire d'Inscription</h2>
        <form id="userForm" method="POST" action="index.php" onsubmit="return validateForm()">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="login">Login</label>
            <input type="text" id="login" name="login" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>
