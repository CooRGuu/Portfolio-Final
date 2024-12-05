-- Database Creation
CREATE DATABASE `portfolio_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `portfolio_db`;

-- Table Creation
CREATE TABLE IF NOT EXISTS `projet` (
    `projet_id` int AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `compétences` varchar(50),
    `description` TEXT NOT NULL,
    `image` TEXT NOT NULL,
    PRIMARY KEY (`projet_id`)
);

-- Removing Old Data
DELETE FROM `projet`;

-- Data Insertion
INSERT INTO `projet` (`name`, `compétences`, `description`, `image`) 
VALUES 
('Projet 1 - E-commerce sur mesure', 'HTML & CSS', 'Site créé sur mesure', 'e-commerce.jpg'),
('Projet 2 - Outil de collaboration interne', 'Authentification Gestion des permissions et des utilisateurs', 'Outil de collaboration', 'outil-de-collaboration.jpg');

CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int AUTO_INCREMENT PRIMARY KEY,
    `nom` varchar(255),
    `prenom` varchar(255),
    `login` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);