CREATE TABLE `salons` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `adresse` varchar(255),
  `number` int,
  `email` varchar(255),
  `horaires` varchar(255)
);

CREATE TABLE `menu` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `media_id` int,
  `name` varchar(255),
  `type` varchar(255),
  `recipe_id` int
);

CREATE TABLE `salons_menu` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `salon_id` int,
  `menu_id` int
);

CREATE TABLE `recettes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `ingredient_id` int,
  `media_id` int
);

CREATE TABLE `ingredients` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `fournisseur_id` int,
  `category_id` int,
  `name` varchar(255),
  `media_id` int
);

CREATE TABLE `allergenes` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `restrictions_alimentaires` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255),
  `prenom` varchar(255),
  `email` varchar(255) UNIQUE,
  `mot_de_passe` varchar(255),
  `role_id` int,
  `phone` int,
  `adresse` varchar(255),
  `is_consent` bool,
  `media_id` int
);

CREATE TABLE `role` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `is_admin` bool,
  `role` varchar(255)
);

CREATE TABLE `media` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `file_path` varchar(255),
  `file_type` varchar(255)
);

CREATE TABLE `translations` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `table_name` varchar(255),
  `column_name` varchar(255),
  `row_id` int,
  `language_code` varchar(255),
  `translated_text` text
);

CREATE TABLE `contact` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int
);

CREATE TABLE `activities` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `association_id` int,
  `media_id` int,
  `type` varchar(255)
);

CREATE TABLE `loyalty` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `points` int,
  `rewards` varchar(255),
  `money_spent` int,
  `favoris` varchar(255),
  `media_id` int
);

CREATE TABLE `associations` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255),
  `raison_sociale` varchar(255),
  `media_id` int
);

CREATE TABLE `fournisseurs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255),
  `raison_sociale` varchar(255),
  `media_id` int
);

CREATE TABLE `reservations` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `utilisateur_id` int,
  `salon_id` int,
  `date_heure` datetime,
  `nombre_personnes` int,
  `statut` varchar(255),
  `activity_id` int
);

CREATE TABLE `avis` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `utilisateur_id` int,
  `salon_id` int,
  `note` int,
  `commentaire` text,
  `date` datetime
);

ALTER TABLE `salons_menu` ADD FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`);

ALTER TABLE `salons_menu` ADD FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

ALTER TABLE `recettes` ADD FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`);

ALTER TABLE `recettes` ADD FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

ALTER TABLE `ingredients` ADD FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`);

ALTER TABLE `ingredients` ADD FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

ALTER TABLE `users` ADD FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

ALTER TABLE `users` ADD FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

ALTER TABLE `contact` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `activities` ADD FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`);

ALTER TABLE `activities` ADD FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

ALTER TABLE `loyalty` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `loyalty` ADD FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

ALTER TABLE `associations` ADD FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

ALTER TABLE `fournisseurs` ADD FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

ALTER TABLE `reservations` ADD FOREIGN KEY (`utilisateur_id`) REFERENCES `users` (`id`);

ALTER TABLE `reservations` ADD FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`);

ALTER TABLE `reservations` ADD FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`);

ALTER TABLE `avis` ADD FOREIGN KEY (`utilisateur_id`) REFERENCES `users` (`id`);

ALTER TABLE `avis` ADD FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`);
