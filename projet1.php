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

    <!-- Navigation des onglets -->
    <nav>
        <ul>
            <li><button class="tab-button" data-tab="about">À propos</button></li>
            <li><button class="tab-button" data-tab="projects">Projets</button></li>
            <li><button class="tab-button" data-tab="contact">Contact</button></li>
        </ul>
    </nav>

    <!-- Contenu de la page du projet -->
    <section id="project-detail">
        <div class="container">
            <h2><?php echo $projet[0]['name']; ?></h2>

            <div class="project-description">
                <div class="project-info">
                </div>

                <!-- Image à droite -->
                <div class="project-image">
                    <img src="e-commerce.jpg" alt="E-commerce sur mesure" class="project-img">
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