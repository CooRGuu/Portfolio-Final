-- Database Creation
CREATE DATABASE IF NOT EXISTS `portfolio_db`;
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
    `user_id` int AUTO_INCREMENT,
    `nom` varchar(255),
    `prenom` varchar(255),
    `login` varchar(255),
    `password` varchar(255),
    PRIMARY KEY (`user_id`)
);

INSERT INTO users (nom, prenom, login, password)
VALUES
('Brunault', 'Anton', 'Caliall', 'ler0Eph6'),
('Beausoleil', 'Noémie', 'Rabing', 'Ru5thiol'),
('Plourde', 'Romain', 'Evand1994', 'ku9Oo3kaebae'),
('Archambault', 'Frédérique', 'Thil2005', 'AhWahNgai6ai'),
('Goudreau', 'Dalmace', 'Yourlenis', 'Dain1Low6ei');