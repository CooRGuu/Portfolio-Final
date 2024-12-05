<?php
session_start();
if (isset($_SESSION['user_login'])) {
    $userName = htmlspecialchars($_SESSION['user_login']);
} else {
    $userName = null;
}

// Inclure le fichier avec les constantes de connexion à la base de données (config.php)
require_once 'config.php';

// Initialisation des variables de connexion
$dsn = sprintf('mysql:host=%s;dbname=%s;port=%d;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT);

try {
    // Création de la connexion PDO
    $mysqlClient = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD);
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}

// Fonction pour hacher un mot de passe en Base64
function hashPasswordBase64(string $password): string {
    $hashed = hash('sha256', $password, true); // Hachage brut (binaire)
    return base64_encode($hashed); // Encodage en Base64
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_form'])) {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if (empty($login) || empty($password)) {
        die("Tous les champs sont obligatoires.");
    }

    $sql = "SELECT * FROM users WHERE login = :login";
    $stmt = $mysqlClient->prepare($sql);
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe haché
    $hashedInputPassword = hashPasswordBase64($password);
    if ($user && $hashedInputPassword === $user['password']) {
        session_start();
        $_SESSION['user_login'] = $user['login'];
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: accueil.php?user_id=" . $_SESSION["user_id"]);
        exit;
    } else {
        die("Identifiant ou mot de passe incorrect.");
    }
}

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_form'])) {
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $register_login = trim($_POST['register_login']);
    $register_password = trim($_POST['register_password']);

    if (empty($prenom) || empty($nom) || empty($register_login) || empty($register_password)) {
        die("Tous les champs sont obligatoires.");
    }

    // Hachage du mot de passe
    $hashedPassword = hashPasswordBase64($register_password);

    $sql = "INSERT INTO users (nom, prenom, login, password) VALUES (:nom, :prenom, :login, :password)";
    try {
        $stmt = $mysqlClient->prepare($sql);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':login', $register_login);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
        echo "L'utilisateur a été enregistré avec succès.";
    } catch (PDOException $e) {
        die("Erreur lors de l'insertion dans la base de données : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Utilisateur</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 40px 0;
            text-align: center;
        }
        header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        header p {
            font-size: 18px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 20px auto;
            display: none;
        }
        .form-container.active {
            display: block;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 1rem;
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
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .toggle-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
        }
        .toggle-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
    <h1>Bienvenue sur mon portfolio</h1>
    <p>Connectez-vous ou créez un compte pour commencer</p>
</header>

<div class="form-container active" id="loginForm">
    <h2>Connexion</h2>
    <form method="POST">
        <label for="login">Login</label>
        <input type="text" id="login" name="login" required>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="login_form">Se connecter</button>
    </form>
    <button class="toggle-button" onclick="showRegisterForm()">Créer un compte</button>
</div>

<div class="form-container" id="registerForm">
    <h2>Inscription</h2>
    <form method="POST">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" required>
        <label for="register_login">Login</label>
        <input type="text" id="register_login" name="register_login" required>
        <label for="register_password">Mot de passe</label>
        <input type="password" id="register_password" name="register_password" required>
        <button type="submit" name="register_form">S'inscrire</button>
    </form>
    <button class="toggle-button" onclick="showLoginForm()">Retour à la connexion</button>
</div>

<script>
    function showRegisterForm() {
        document.getElementById('loginForm').classList.remove('active');
        document.getElementById('registerForm').classList.add('active');
    }
    function showLoginForm() {
        document.getElementById('registerForm').classList.remove('active');
        document.getElementById('loginForm').classList.add('active');
    }
</script>
</body>
</html>
