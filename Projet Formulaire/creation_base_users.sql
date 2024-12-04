CREATE DATABASE users_db;

USE users_db;

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