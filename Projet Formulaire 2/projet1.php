<?php
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cs/portfolio.css">
</head>
<body>

    <!-- En-tête avec le nom et le titre -->
    <header>
        <div class="container">
            <h1>Mon Portfolio</h1>
            <p>Découvrez mon projet E-commerce sur mesure</p>
        </div>
    </header>

    <!-- Contenu de la page du projet -->
    <section id="project-detail">
        <div class="container">
            <h2>Projet 1: E-commerce sur mesure</h2>
            <p><strong>Client:</strong> Start-up E-commerce</p>
            <p><strong>Technologies utilisées:</strong> HTML, CSS, JavaScript, Python (Django), Stripe (paiement en ligne)</p>

            <div class="project-description">
                <div class="project-info">
                    <p>
                        Dans ce projet, j'ai développé un site e-commerce complet pour une start-up. Le site inclut des fonctionnalités telles que la gestion des utilisateurs, la création d'un panier d'achat, l'intégration des paiements en ligne, et une interface d'administration pour gérer les produits et les commandes. Ce projet a permis d’améliorer l’expérience utilisateur et de maximiser les ventes en ligne.
                    </p>
                </div>
            <!-- Image à droite -->
            <div class="project-image">
                <img src="e-commerce.png" alt="E-commerce sur mesure" class="project-img">
            </div>
            <div class="project-features">
                <h3>Fonctionnalités principales:</h3>
                <ul>
                    <li>Inscription et gestion des utilisateurs</li>
                    <li>Gestion du panier d'achat et des produits</li>
                    <li>Intégration de Stripe pour les paiements sécurisés</li>
                    <li>Interface d'administration pour la gestion des produits et commandes</li>
                    <li>Optimisation des performances et de la sécurité</li>
                </ul>
            </div>

            <div class="project-skills">
                <h3>Compétences utilisées:</h3>
                <ul>
                    <li>HTML & CSS</li>
                    <li>JavaScript (ES6+)</li>
                    <li>Python (Django)</li>
                    <li>Stripe (API de paiement)</li>
                    <li>Gestion de base de données (SQL)</li>
                    <li>Responsive Design</li>
                    <li>Optimisation des performances</li>
                </ul>
            </div>
        <div class="container">
            <h2><?php echo $projet[0]['name']; ?></h2>

            <div class="project-description">
                <div class="project-info">
                </div>
            </div>

            <div class="project-features">
                <ul>
                    <?php foreach ($projet as $projet): ?>
                <li><?php echo $projet['name']; ?> 
                <?php echo $projet['compétences']; ?> 
                - <?php echo $projet['description']; ?></li>
            <?php endforeach; ?>
                </ul>
            </div>

            <div class="project-skills">
            </div>

            <a href="accueil.php" class="btn-back">Retour à la liste des projets</a>
        </div>
    </section>

    <script src="./js/portfolio.js"></script>
</body>
</html>