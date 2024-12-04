<?php
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
session_start();

if (isset($_SESSION['user_login'])) {
    // Vérifier l'ID de l'utilisateur dans l'URL
    $userIdInUrl = isset($_GET['id']) ? $_GET['id'] : null;
    
    if ($userIdInUrl && $userIdInUrl != $_SESSION['user_id']) {
        // Message de débogage
        echo "ID dans l'URL: $userIdInUrl, ID en session: {$_SESSION['user_id']}";
        // Si l'ID dans l'URL ne correspond pas à celui dans la session, rediriger
        header("Location: index.php");
        exit(); // Arrêter l'exécution du script après la redirection
    }

    // Récupérer les informations de l'utilisateur à partir de la base de données
    $sql = "SELECT * FROM users WHERE login = :login";
    $stmt = $mysqlClient->prepare($sql);
    $stmt->bindParam(':login', $_SESSION['user_login']);
    $stmt->execute();
    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $userInfo = null;
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio</title>
    <link rel="stylesheet" href="./cs/portfolio.css">
</head>
<body>

    <!-- En-tête avec le nom et le titre -->
    <header>
    <h1>Bienvenue sur mon portfolio</h1>
    <?php if ($userInfo): ?>
        <div class="user-menu">
            <button class="user-button">
                <?= htmlspecialchars($userInfo['prenom'] . ' ' . $userInfo['nom']) ?> ▼
            </button>
            <div class="dropdown-menu">
                <p><strong>Nom :</strong> <?= htmlspecialchars($userInfo['nom']) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($userInfo['prenom']) ?></p>
                <p><strong>Login :</strong> <?= htmlspecialchars($userInfo['login']) ?></p>
                <p><strong>User ID :</strong> <?= htmlspecialchars($userInfo['user_id']) ?></p>
                <a href="logout.php">Déconnexion</a>
            </div>
        </div>
    <?php endif; ?>
</header>

    <!-- Navigation des onglets -->
    <nav>
        <ul>
            <li><button class="tab-button" data-tab="about">À propos</button></li>
            <li><button class="tab-button" data-tab="projects">Projets</button></li>
            <li><button class="tab-button" data-tab="contact">Contact</button></li>
        </ul>
    </nav>

    <!-- Contenu des sections -->
    <div class="tab-content">
        <!-- Section À propos de moi -->
        <section id="about" class="tab-section active">
            <div class="container about-section">
                <h2>À propos de moi</h2>
                <div class="about-content">
                    <div class="about-photo">
                        <img src="cr7.jpg" alt="Zinedine Zidane" class="profil-photo">
                    </div>
                    <div class="about-info">
                        <p><strong>Nom :</strong> Zidane</p>
                        <p><strong>Prénom :</strong> Zinedine</p>
                        <p><strong>Adresse :</strong> 12 Rue des Lilas, 75012 Paris, France</p>
                        <p><strong>Téléphone :</strong> +33 6 12 34 56 78</p>
                        <p><strong>Email :</strong> zinedine.zidane@gmail.com</p>
                        <p><strong>LinkedIn :</strong> <a href="https://linkedin.com/in/zinedinezidane" target="_blank">linkedin.com/in/zinedinezidane</a></p>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="about-description">
                    <p>
                        Passionné par le <span style="color : blue;"> développement</span> web et la création de solutions performantes et innovantes, je suis développeur full stack avec une expertise approfondie en <b>Python</b>, <b>JavaScript</b>, <b>HTML</b>, et <b>CSS</b>. Je maîtrise l’ensemble du processus de développement, du design d’interfaces utilisateur modernes et ergonomiques (front-end) à la gestion des systèmes backend robustes et sécurisés.
                    </p>
                    <p>
                        Motivé par l’apprentissage continu et l’excellence, je m’efforce de concevoir des solutions fiables, scalables et adaptées aux besoins des utilisateurs, tout en gardant un fort souci du détail et de l’efficacité.
                    </p>
                </div>

                <!-- Compétences -->
                <div class="skills">
                    <h3>Compétences</h3>
                    <ul>
                        <li>HTML</li>
                        <li>CSS</li>
                        <li>Python</li>
                        <li>JavaScript</li>
                    </ul>
                </div>

                <!-- Expérience professionnelle -->
                <div class="experience">
                    <h3>Expérience Professionnelle</h3>
                    <p><strong>Développeur Full Stack | Entreprise Zizou</strong></p>
                    <p><em>Juin 2022 - Présent</em></p>
                    <p>Conception et développement d'applications web et outils internes pour améliorer les processus de l'entreprise. Utilisation de technologies comme React, Node.js et MongoDB.</p>

                    <p><strong>Développeur | Start-up Simply</strong></p>
                    <p><em>Janvier 2021 - Mai 2022</em></p>
                    <p>Création d'interfaces utilisateur dynamiques avec HTML, CSS, JavaScript.</p>
                </div>

                <!-- Éducation -->
                <div class="education">
                    <h3>Éducation</h3>
                    <p><strong>Bachelor en Informatique | Université de Paris</strong></p>
                    <p><em>2018 - 2021</em></p>
                    <p>Formation approfondie en développement logiciel, bases de données, algorithmique et design d'interfaces utilisateur.</p>

                    <p><strong>Formation en Développement Web | Codecademy</strong></p>
                    <p><em>2020</em></p>
                    <p>Formation en ligne couvrant les technologies front-end (HTML, CSS, JavaScript)</p>
                </div>
            </div>
        </section>

        <!-- Section des projets -->
        <section id="projects" class="tab-section">
            <div class="container">
                <h2>Mes Projets</h2>
                <div class="project-card" id="project1">
                    <h3><a href="projet1.php">Projet 1 - E-commerce sur mesure</a></h3>
                </div>

                <div class="project-card" id="project2">
                    <h3><a href="projet2.php">Projet 2 - Outil de collaboration interne</a></h3>
                </div>

            </div>
        </section>

        <!-- Section Contact -->
        <section id="contact" class="tab-section">
            <div class="container">
                <h2>Contactez-moi</h2>
                <form id="contact-form">
                    <input type="text" id="name" placeholder="Votre nom" required>
                    <input type="email" id="email" placeholder="Votre email" required>
                    <textarea id="message" placeholder="Votre message" required></textarea>
                    <button type="submit">Envoyer</button>
                </form>
                <p id="form-feedback"></p>
            </div>
        </section>
    </div>

    <!-- Lien vers le fichier JavaScript -->
    <script src="./js/portfolio.js"></script>
</body>
</html>



