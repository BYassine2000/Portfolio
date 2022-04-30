DROP DATABASE IF EXISTS portfolio;
CREATE DATABASE IF NOT EXISTS portfolio;
USE portfolio;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 30 avr. 2022 à 12:01
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `portfolio`
--

DELIMITER $$
--
-- Fonctions
--
DROP FUNCTION IF EXISTS `check_category`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `check_category` (`newcategory` VARCHAR(100)) RETURNS INT(11) BEGIN
SELECT count(*) FROM category WHERE title = newcategory INTO @result;
RETURN @result;
END$$

DROP FUNCTION IF EXISTS `check_filter`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `check_filter` (`newfilter` VARCHAR(100)) RETURNS INT(11) BEGIN
SELECT count(*) FROM filters WHERE libelle = newfilter INTO @result;
RETURN @result;
END$$

DROP FUNCTION IF EXISTS `check_skill`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `check_skill` (`newskill` VARCHAR(100)) RETURNS INT(11) BEGIN
SELECT count(*) FROM skills WHERE libelle = newskill INTO @result;
RETURN @result;
END$$

DROP FUNCTION IF EXISTS `check_username`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `check_username` (`newusername` VARCHAR(15)) RETURNS INT(11) BEGIN
    SELECT count(*) FROM users WHERE username = newusername INTO @result;
    RETURN @result;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `all_projects`
--

DROP TABLE IF EXISTS `all_projects`;
CREATE TABLE IF NOT EXISTS `all_projects` (
  `id_p` int(11) NOT NULL,
  `id_f` int(11) NOT NULL,
  PRIMARY KEY (`id_p`,`id_f`),
  KEY `id_f` (`id_f`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `all_projects`
--

INSERT INTO `all_projects` (`id_p`, `id_f`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(9, 1),
(11, 1),
(12, 1),
(10, 2),
(6, 3),
(7, 3),
(8, 3);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `id_f` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cat`),
  UNIQUE KEY `title` (`title`),
  KEY `id_f` (`id_f`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_cat`, `title`, `id_f`) VALUES
(1, 'Développement web', 1),
(2, 'Développement d\'application', 2),
(3, 'Développement bureautique', 3),
(4, 'Systèmes Informatiques', 4),
(5, 'Réseaux et télécommunications', 5);

--
-- Déclencheurs `category`
--
DROP TRIGGER IF EXISTS `validate_category`;
DELIMITER $$
CREATE TRIGGER `validate_category` BEFORE INSERT ON `category` FOR EACH ROW BEGIN
    IF check_category(NEW.title)
    THEN
        signal sqlstate '45000' SET message_text = 'Cette catégorie est déjà utilisée';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id_comp` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id_comp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id_comp`, `company_name`, `company_address`, `start_date`, `end_date`) VALUES
(1, 'Open BPO ', 'Trappes', '2020-11-15', '2020-12-20'),
(2, 'Développeur web\r\nGroupe IPF', 'Ecole IRIS', '2021-11-14', '2021-12-19');

-- --------------------------------------------------------

--
-- Structure de la table `diplomes`
--

DROP TABLE IF EXISTS `diplomes`;
CREATE TABLE IF NOT EXISTS `diplomes` (
  `id_d` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_d` varchar(255) DEFAULT NULL,
  `date_d` date DEFAULT NULL,
  `id_school` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_d`),
  KEY `id_school` (`id_school`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `diplomes`
--

INSERT INTO `diplomes` (`id_d`, `libelle_d`, `date_d`, `id_school`) VALUES
(1, 'Bac S option ISN', '2018-07-10', 1),
(3, 'BTS Services Informatiques aux Organisations', '2021-07-10', 2);

-- --------------------------------------------------------

--
-- Structure de la table `filters`
--

DROP TABLE IF EXISTS `filters`;
CREATE TABLE IF NOT EXISTS `filters` (
  `id_f` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_f`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `filters`
--

INSERT INTO `filters` (`id_f`, `libelle`) VALUES
(2, 'developpement-application'),
(3, 'developpement-bureautique'),
(1, 'developpement-web'),
(5, 'reseaux-telecommunications'),
(4, 'systemes-informatiques');

--
-- Déclencheurs `filters`
--
DROP TRIGGER IF EXISTS `validate_filter`;
DELIMITER $$
CREATE TRIGGER `validate_filter` BEFORE INSERT ON `filters` FOR EACH ROW BEGIN
    IF check_filter(NEW.libelle)
    THEN
        signal sqlstate '45000' SET message_text = 'Ce filtre est déjà utilisé';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `chemin` varchar(255) DEFAULT NULL,
  `id_p` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_img`),
  KEY `id_p` (`id_p`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id_img`, `nom`, `chemin`, `id_p`) VALUES
(1, '1.png', 'assets/img/projects/', 1),
(2, '2.png', 'assets/img/projects/', 2),
(3, '3.png', 'assets/img/projects/', 3),
(4, '4.jpg', 'assets/img/projects/', 4),
(5, '5.png', 'assets/img/projects/', 5),
(6, '6.png', 'assets/img/projects/', 6),
(7, '7.png', 'assets/img/projects/', 7),
(8, '8.png', 'assets/img/projects/', 8),
(9, '9.jpg', 'assets/img/projects/', 9),
(10, '10.png', 'assets/img/projects/', 10),
(11, '11.png', 'assets/img/projects/', 11),
(12, '12.png', 'assets/img/projects/', 12);

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id_p` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `id_cat` int(11) DEFAULT NULL,
  `id_f` int(11) DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_p`),
  KEY `id_cat` (`id_cat`),
  KEY `id_f` (`id_f`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id_p`, `title`, `description`, `id_cat`, `id_f`, `github_url`) VALUES
(1, 'Développement d\'un site de gestion pour l\'entreprise Filelec (Client léger)', 'Projet réalisé en HTML, CSS et PHP', 1, 1, 'https://github.com/BYassine2000/filelec'),
(2, 'Création d\'une partie admin pour l\'entreprise Filelec (Client léger)', 'Projet réalisé en HTML, CSS, PHP et JavaScript', 1, 1, 'https://github.com/BYassine2000/filelec-admin'),
(3, 'Création d\'un site de gestion de salle Foot Five', 'Projet réalisé en HTML, CSS et PHP', 1, 1, 'https://github.com/BYassine2000/Five'),
(4, 'Création d\'un site de gestion de la ville de Paris', 'Projet réalisé en HTML, CSS et PHP', 1, 1, 'https://github.com/BYassine2000/Paris'),
(5, 'Création d\'un Forum', 'Projet réalisé en HTML, CSS, PHP et JavaScript', 1, 1, 'https://github.com/BYassine2000/Forum'),
(6, 'Mise en place de OCS Inventory sur VMware', 'Projet réalisé sur VMware', 3, 3, 'assets/files/SI7-Documentation.pdf'),
(7, 'Mise en place de GLPI sur VMware', 'Projet réalisé sur VMware', 3, 3, 'assets/files/SI7-Documentation.pdf'),
(8, 'Mise en place d\'un flux RSS sur VMware (Veille technologique)', 'Projet réalisé sur VMware', 3, 3, 'assets/files/SI7-Documentation.pdf'),
(9, 'Création d\'un Portfolio', 'Projet réalisé en HTML, CSS et PHP', 1, 1, 'https://github.com/BYassine2000/Portfolio'),
(10, 'Création d\'une application lourde pour l\'entreprise Filelec (Client lourd)', 'Projet réalisé en Java', 2, 2, 'https://github.com/BYassine2000/Filelec_lourd'),
(11, 'Création d\'un site pour une auto-école', 'Projet réalisé en HTML, CSS, PHP et JavaScript', 1, 1, 'https://github.com/BYassine2000/auto-ecole'),
(12, 'Création d\'un site pour une agence immobilière', 'Projet réalisé avec Symfony', 1, 1, 'https://github.com/BYassine2000/agence-immobiliere');

-- --------------------------------------------------------

--
-- Structure de la table `schools`
--

DROP TABLE IF EXISTS `schools`;
CREATE TABLE IF NOT EXISTS `schools` (
  `id_school` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(100) DEFAULT NULL,
  `school_address` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id_school`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `schools`
--

INSERT INTO `schools` (`id_school`, `school_name`, `school_address`, `start_date`, `end_date`) VALUES
(1, 'Lycée la Tourelle\r\n', '10 Rue Fernand Léger, 95200 Sarcelles', '2016-09-03', '2019-06-09'),
(2, 'École IRIS', '6-8 Impasse des 2 Cousins, 75017 Paris', '2020-09-06', '2022-06-01');

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `id_s` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  `lvl` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_s`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `skills`
--

INSERT INTO `skills` (`id_s`, `libelle`, `lvl`) VALUES
(1, 'HTML5 / CSS3', 90),
(2, 'Boostrap 5', 80),
(3, 'PHP / PDO', 80),
(4, 'JavaScript', 70),
(5, 'MySQL', 90),
(6, 'Java', 70);

--
-- Déclencheurs `skills`
--
DROP TRIGGER IF EXISTS `validate_skill`;
DELIMITER $$
CREATE TRIGGER `validate_skill` BEFORE INSERT ON `skills` FOR EACH ROW BEGIN
    IF check_skill(NEW.libelle)
    THEN
        signal sqlstate '45000' SET message_text = 'Cette compétence est déjà enregistrée';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_u` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `birthday_date` date DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `school_url` varchar(255) DEFAULT NULL,
  `school_name` varchar(50) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `website_title` varchar(50) DEFAULT NULL,
  `freelance_status` varchar(50) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lvl` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_u`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_u`, `lastName`, `firstName`, `age`, `birthday_date`, `contact_email`, `school_url`, `school_name`, `website_url`, `website_title`, `freelance_status`, `username`, `password`, `lvl`) VALUES
(1, 'Ben Hamdoune', 'Yassine', 22, '2000-04-09', 'Enissay999@gmail.com', 'https://ecoleiris.fr', 'École IRIS', 'https://ppe-filelec.000webhostapp.com/', 'Filelec', 'Indisponible', 'Yassine', '107d348bff437c999a9ff192adcb78cb03b8ddc6', 1);

--
-- Déclencheurs `users`
--
DROP TRIGGER IF EXISTS `valid_username`;
DELIMITER $$
CREATE TRIGGER `valid_username` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    IF new.username NOT IN ('tombruaire')
            THEN
                signal sqlstate '45000' SET message_text = 'Ce pseudo ne peut pas être enregistré';
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `validate_insert_username`;
DELIMITER $$
CREATE TRIGGER `validate_insert_username` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    IF check_username(NEW.username)
    THEN
        signal sqlstate '45000' SET message_text = 'Ce pseudo est déjà utilisé';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vallprojects`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vallprojects`;
CREATE TABLE IF NOT EXISTS `vallprojects` (
`id_p` varchar(100)
,`id_f` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vcategory`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vcategory`;
CREATE TABLE IF NOT EXISTS `vcategory` (
`id_cat` int(11)
,`title` varchar(100)
,`id_f` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vcompany`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vcompany`;
CREATE TABLE IF NOT EXISTS `vcompany` (
`id_comp` int(11)
,`company_name` varchar(100)
,`company_address` varchar(255)
,`start_date` date
,`end_date` date
,`libelle_w` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vimages`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vimages`;
CREATE TABLE IF NOT EXISTS `vimages` (
`id_img` int(11)
,`nom` varchar(50)
,`chemin` varchar(255)
,`id_p` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vprojects`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vprojects`;
CREATE TABLE IF NOT EXISTS `vprojects` (
`id_p` int(11)
,`id_f` varchar(100)
,`chemin` varchar(255)
,`nom` varchar(50)
,`title` varchar(100)
,`github_url` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vschools`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vschools`;
CREATE TABLE IF NOT EXISTS `vschools` (
`id_d` int(11)
,`libelle_d` varchar(255)
,`date_d` date
,`id_school` varchar(100)
,`school_address` varchar(255)
,`start_date` date
,`end_date` date
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vworks`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vworks`;
CREATE TABLE IF NOT EXISTS `vworks` (
`id_w` int(11)
,`libelle_w` varchar(255)
,`id_comp` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure de la table `works`
--

DROP TABLE IF EXISTS `works`;
CREATE TABLE IF NOT EXISTS `works` (
  `id_w` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_w` varchar(255) DEFAULT NULL,
  `id_comp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_w`),
  KEY `id_comp` (`id_comp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `works`
--

INSERT INTO `works` (`id_w`, `libelle_w`, `id_comp`) VALUES
(1, 'Coordination de projet, Création de bases de données et Mise en relation côté clients et côté serveur\r\n</br>\r\nDéveloppement d’un site de recrutement en ligne en HTML, CSS et JavaScript', 2),
(2, 'Coordination de projet Technique et Numérique, Création de bases de données et Résolution de problèmes </br>\r\nDéveloppement d’un chat en ligne', 1);

-- --------------------------------------------------------

--
-- Structure de la vue `vallprojects`
--
DROP TABLE IF EXISTS `vallprojects`;

DROP VIEW IF EXISTS `vallprojects`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vallprojects`  AS SELECT `p`.`title` AS `id_p`, `f`.`libelle` AS `id_f` FROM (`projects` `p` join `filters` `f`) WHERE (`p`.`id_f` = `f`.`id_f`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vcategory`
--
DROP TABLE IF EXISTS `vcategory`;

DROP VIEW IF EXISTS `vcategory`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vcategory`  AS SELECT `c`.`id_cat` AS `id_cat`, `c`.`title` AS `title`, `f`.`libelle` AS `id_f` FROM (`category` `c` join `filters` `f`) WHERE (`c`.`id_f` = `f`.`id_f`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vcompany`
--
DROP TABLE IF EXISTS `vcompany`;

DROP VIEW IF EXISTS `vcompany`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vcompany`  AS SELECT `c`.`id_comp` AS `id_comp`, `c`.`company_name` AS `company_name`, `c`.`company_address` AS `company_address`, `c`.`start_date` AS `start_date`, `c`.`end_date` AS `end_date`, `w`.`libelle_w` AS `libelle_w` FROM (`company` `c` join `works` `w`) WHERE (`w`.`id_comp` = `c`.`id_comp`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vimages`
--
DROP TABLE IF EXISTS `vimages`;

DROP VIEW IF EXISTS `vimages`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vimages`  AS SELECT `i`.`id_img` AS `id_img`, `i`.`nom` AS `nom`, `i`.`chemin` AS `chemin`, `p`.`title` AS `id_p` FROM (`images` `i` join `projects` `p`) WHERE (`i`.`id_p` = `p`.`id_p`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vprojects`
--
DROP TABLE IF EXISTS `vprojects`;

DROP VIEW IF EXISTS `vprojects`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vprojects`  AS SELECT `p`.`id_p` AS `id_p`, `f`.`libelle` AS `id_f`, `i`.`chemin` AS `chemin`, `i`.`nom` AS `nom`, `p`.`title` AS `title`, `p`.`github_url` AS `github_url` FROM (((`projects` `p` join `category` `c`) join `images` `i`) join `filters` `f`) WHERE ((`p`.`id_p` = `i`.`id_p`) AND (`p`.`id_f` = `f`.`id_f`) AND (`p`.`id_cat` = `c`.`id_cat`)) ORDER BY `f`.`id_f` ASC ;

-- --------------------------------------------------------

--
-- Structure de la vue `vschools`
--
DROP TABLE IF EXISTS `vschools`;

DROP VIEW IF EXISTS `vschools`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vschools`  AS SELECT `d`.`id_d` AS `id_d`, `d`.`libelle_d` AS `libelle_d`, `d`.`date_d` AS `date_d`, `s`.`school_name` AS `id_school`, `s`.`school_address` AS `school_address`, `s`.`start_date` AS `start_date`, `s`.`end_date` AS `end_date` FROM (`diplomes` `d` join `schools` `s`) WHERE (`d`.`id_school` = `s`.`id_school`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vworks`
--
DROP TABLE IF EXISTS `vworks`;

DROP VIEW IF EXISTS `vworks`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vworks`  AS SELECT `w`.`id_w` AS `id_w`, `w`.`libelle_w` AS `libelle_w`, `c`.`company_name` AS `id_comp` FROM (`works` `w` join `company` `c`) WHERE (`w`.`id_comp` = `c`.`id_comp`) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `all_projects`
--
ALTER TABLE `all_projects`
  ADD CONSTRAINT `all_projects_ibfk_1` FOREIGN KEY (`id_p`) REFERENCES `projects` (`id_p`),
  ADD CONSTRAINT `all_projects_ibfk_2` FOREIGN KEY (`id_f`) REFERENCES `filters` (`id_f`) ON DELETE CASCADE;

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id_f`) REFERENCES `filters` (`id_f`) ON DELETE CASCADE;

--
-- Contraintes pour la table `diplomes`
--
ALTER TABLE `diplomes`
  ADD CONSTRAINT `diplomes_ibfk_1` FOREIGN KEY (`id_school`) REFERENCES `schools` (`id_school`) ON DELETE CASCADE;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_p`) REFERENCES `projects` (`id_p`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id_cat`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`id_f`) REFERENCES `filters` (`id_f`) ON DELETE CASCADE;

--
-- Contraintes pour la table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_ibfk_1` FOREIGN KEY (`id_comp`) REFERENCES `company` (`id_comp`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
