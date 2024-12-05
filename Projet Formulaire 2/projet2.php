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
    <title>Projet 2 - Outil de collaboration interne</title>
    <link rel="stylesheet" href="./cs/portfolio.css">
</head>
<body>

    <!-- En-tête avec le nom et le titre -->
    <header>
        <div class="container">
            <h1>Mon Portfolio</h1>
            <p>Découvrez mon projet Outil de collaboration interne</p>
        </div>
    </header>

    <!-- Contenu de la page du projet -->
    <section id="project-detail">
        <div class="container">
            <h2>Projet 2: Outil de collaboration interne</h2>
            <p><strong>Client:</strong> Entreprise Zizou</p>
            <p><strong>Technologies utilisées:</strong> Pythoon, CSS</p>

            <div class="project-description">
                <div class="project-info">
                    <p>
                        Ce projet consistait à développer une plateforme collaborative interne pour une entreprise. L'outil permet aux équipes de mieux collaborer, de partager des documents, de gérer les tâches et de suivre l'avancement des projets. L'objectif était d'améliorer la communication et de faciliter la gestion des projets au sein de l'entreprise.
                    </p>
                </div>

                <!-- Image à droite -->
                <div class="project-image">
                    <img src="outils_de_collaboration.png" alt="Outil de collaboration interne" class="project-img">
                </div>
            </div>

            <div class="project-features">
                <h3>Fonctionnalités principales:</h3>
                <ul>
                    <li>Création de tâches et gestion des priorités</li>
                    <li>Partage de documents et discussion en temps réel</li>
                    <li>Suivi de l'avancement des projets et des équipes</li>
                    <li>Interface intuitive et responsive</li>
                    <li>Authentification des utilisateurs et gestion des accès</li>
                </ul>
            </div>

            <div class="project-skills">
                <h3>Compétences utilisées:</h3>
                <ul>
                    <li>Authentification </li>
                    <li>Gestion des permissions et des utilisateurs</li>
                    <li>WebSocket pour la communication en temps réel</li>
                </ul>
            </div>

            <a href="accueil.php" class="btn-back">Retour à la liste des projets</a>
        </div>
    </section>

    <script src="./js/portfolio.js"></script>
</body>
</html>
