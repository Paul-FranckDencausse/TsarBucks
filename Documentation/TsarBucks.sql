-- Adminer 4.8.1 MySQL 10.3.39-MariaDB-0ubuntu0.20.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `avis`;
CREATE TABLE `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `salon_id` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `salon_id` (`salon_id`),
  CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240807221615',	'2024-08-07 22:16:27',	6),
('DoctrineMigrations\\Version20240808143302',	'2024-08-08 14:33:08',	15);

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salon_id` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salon_id` (`salon_id`),
  CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `menus` (`id`, `salon_id`, `nom`, `description`, `prix`) VALUES
(1,	1,	'Café Expresso',	'Un expresso intense et riche en arômes',	3),
(2,	1,	'Thé Vert',	'Thé vert bio d\'origine japonaise',	3),
(3,	2,	'Cappuccino',	'Café avec mousse de lait et cacao',	4),
(4,	3,	'Mocha',	'Café au lait avec chocolat fondu',	4),
(5,	3,	'Croissant',	'Croissant frais du jour',	2);

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `salon_id` int(11) DEFAULT NULL,
  `date_heure` datetime DEFAULT NULL,
  `nombre_personnes` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  KEY `salon_id` (`salon_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservations` (`id`, `utilisateur_id`, `salon_id`, `date_heure`, `nombre_personnes`, `status`) VALUES
(1,	1,	1,	'2024-08-10 14:00:00',	2,	'confirmée'),
(2,	2,	2,	'2024-08-11 15:30:00',	4,	'confirmée'),
(3,	3,	3,	'2024-08-12 09:00:00',	1,	'confirmée'),
(4,	1,	2,	'2024-08-13 12:00:00',	3,	'annulée');

DROP TABLE IF EXISTS `salons`;
CREATE TABLE `salons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `code_postal` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `salons` (`id`, `nom`, `adresse`, `ville`, `code_postal`, `description`, `site_web`, `email`, `telephone`) VALUES
(1,	'Le Café du Coin',	'12 Rue de la Paix',	'Paris',	'75002',	'Un café cosy au cœur de Paris',	'www.cafeducoin.fr',	NULL,	NULL),
(2,	'Café des Artistes',	'5 Place des Arts',	'Lyon',	'69001',	'Lieu idéal pour les amateurs d\'art',	'www.cafedesartistes.com',	NULL,	NULL),
(3,	'La Brûlerie',	'23 Avenue de la Liberté',	'Marseille',	'13001',	'Le meilleur café torréfié de la ville',	'www.labrulerie.fr',	NULL,	NULL);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(1,	'dencaussepaulfranck@gmail.com',	'[]',	'$2y$13$vrZ6Z25sQz4tlYbIMczYeOdcyzNmVvBu/K0G2f407RmTO36jP81S2'),
(3,	'toto',	'[]',	'$2y$13$l32DEp7POqzrxaMBN1k4M.KtjgUnq2lMRwOFx/08S8MOupB49AA1.'),
(4,	'admin@admin.com',	'[]',	'$2y$13$p//SuLtpNtrIZMI72uQSsettQaowfNscEhLnAkqLkXqrDW0z7wtxG'),
(5,	'teub',	'[]',	'$2y$13$urrMzaCKr6Q8p49qOuzT6OpX8XVBY206BBOCpW9QnOxbwRO0BSOdu'),
(6,	'alexandre@gmail.com',	'[]',	'$2y$13$MdMF0R37yahqFMlA2pNSO.diGD6WDTAC.bAtJxEuczrZJTrZJU1GC');

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`) VALUES
(1,	'Dupont',	'Jean',	'jean.dupont@example.com',	'password123',	'client'),
(2,	'Martin',	'Marie',	'marie.martin@example.com',	'securepass',	'client'),
(3,	'Durand',	'Paul',	'paul.durand@example.com',	'paul2023',	'client'),
(4,	'Leclerc',	'Sophie',	'sophie.leclerc@example.com',	'sophie789',	'admin');

-- 2024-08-08 19:14:09
