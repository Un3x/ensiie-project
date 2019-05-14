-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 11 mai 2019 à 14:45
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `commandes_njv`
--


--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ariseID` varchar(50) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`ariseID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ariseID`, `pseudo`, `prenom`, `nom`, `isAdmin`) VALUES
('gabbay2018', 'Jalik', 'Milan', 'Gabbay', 1),
('begue2018', 'Jed', 'Olivier', 'Begue', 0),
('maret2016', 'Cloud', 'Sylvain', 'Maret', 1),
('wang2017', NULL, 'Eric', 'Wang', 0);
COMMIT;


-- --------------------------------------------------------


--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `typeEvent` enum('NJV','ObiLan','Autre') NOT NULL,
  `numeroEvent` int(10) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  PRIMARY KEY (`eventID`),
  UNIQUE KEY `typeEvent` (`typeEvent`,`numeroEvent`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`eventID`, `typeEvent`, `numeroEvent`, `date_start`, `date_end`) VALUES
(1, 'NJV', 55, '2019-02-22', '2019-03-01'),
(2, 'NJV', 56, '2019-03-29', '2019-04-05'),
(3, 'NJV', 57, '2019-04-26', '2019-05-03'),
(4, 'NJV', 58, '2019-09-01', '2019-09-05'),
(5, 'ObiLan', 42, '2019-05-09', '2019-06-30');

-- --------------------------------------------------------

--
-- Structure de la table `foodtype`
--

DROP TABLE IF EXISTS `foodtype`;
CREATE TABLE IF NOT EXISTS `foodtype` (
  `foodTypeID` int(10) NOT NULL AUTO_INCREMENT,
  `nomTypeFood` varchar(50) NOT NULL,
  PRIMARY KEY (`foodTypeID`),
  UNIQUE KEY `nomTypeFood` (`nomTypeFood`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `foodtype`
--

INSERT INTO `foodtype` (`foodTypeID`, `nomTypeFood`) VALUES
(1, 'Pizza'),
(2, 'Tacos');

-- --------------------------------------------------------


--
-- Structure de la table `partenariat`
--

DROP TABLE IF EXISTS `partenariat`;
CREATE TABLE IF NOT EXISTS `partenariat` (
  `idPartenariat` int(11) NOT NULL AUTO_INCREMENT,
  `nomPartenariat` varchar(50) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `adresseMail` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idPartenariat`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `partenariat`
--

INSERT INTO `partenariat` (`idPartenariat`, `nomPartenariat`, `contact`, `adresseMail`, `telephone`) VALUES
(1, 'Le Palais', 'M. Jean Dupont', 'jean.dupont@palais.fr', '06.06.06.06.06'),
(2, 'ObigDelice', 'Jean Michel', 'obigdelice@gmail.com', '0606060606');

-- --------------------------------------------------------

--
-- Structure de la table `special_type`
--

DROP TABLE IF EXISTS `special_type`;
CREATE TABLE IF NOT EXISTS `special_type` (
  `specialTypeID` int(10) NOT NULL AUTO_INCREMENT,
  `nomSpecialType` varchar(50) NOT NULL,
  PRIMARY KEY (`specialTypeID`),
  UNIQUE KEY `nomSpecialType` (`nomSpecialType`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `special_type`
--

INSERT INTO `special_type` (`specialTypeID`, `nomSpecialType`) VALUES
(1, 'Sauce'),
(2, 'Taille Pizza'),
(3, 'Viandes');

-- --------------------------------------------------------


--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(10) NOT NULL AUTO_INCREMENT,
  `userID` varchar(50) NOT NULL,
  `eventID` int(11) NOT NULL,
  `dateTimeCommande` datetime(6) NOT NULL,
  `isPaid` tinyint(1) NOT NULL,
  PRIMARY KEY (`idCommande`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--  FOREIGNS KEYS DE LA TABLE commande---
ALTER TABLE commande
    ADD CONSTRAINT fk_commande_user
    FOREIGN KEY (userID)
    REFERENCES utilisateur(ariseID);
	
ALTER TABLE commande
    ADD CONSTRAINT fk_commande_event
    FOREIGN KEY (eventID)
    REFERENCES event(eventID);
	

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `userID`, `eventID`, `dateTimeCommande`, `isPaid`) VALUES
(1, 'maret2016', 5, '2019-05-01 18:23:24.000000', 0),
(2, 'maret2016', 5, '2019-05-01 18:25:10.000000', 0),
(3, 'wang2017', 5, '2019-04-04 18:25:10.000000', 1);

-- --------------------------------------------------------

--
-- Structure de la table `foods`
--

DROP TABLE IF EXISTS `foods`;
CREATE TABLE IF NOT EXISTS `foods` (
  `foodID` int(11) NOT NULL AUTO_INCREMENT,
  `foodTypeID` int(11) NOT NULL,
  `partID` int(11) NOT NULL,
  `nomFood` varchar(100) NOT NULL,
  `priceIIE` decimal(4,2) NOT NULL,
  `pricePart` decimal(4,2) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL,
  PRIMARY KEY (`foodID`),
  UNIQUE KEY `nomFood` (`nomFood`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


--  FOREIGNS KEYS DE LA TABLE foods---
ALTER TABLE foods
    ADD CONSTRAINT fk_food_type
    FOREIGN KEY (foodTypeID)
    REFERENCES foodtype(foodTypeID);

ALTER TABLE foods
    ADD CONSTRAINT fk_food_part
    FOREIGN KEY (partID)
	REFERENCES partenariat(idPartenariat);

--
-- Déchargement des données de la table `foods`
--

INSERT INTO `foods` (`foodID`, `foodTypeID`, `partID`, `nomFood`, `priceIIE`, `pricePart`, `isAvailable`) VALUES
(1, 1, 1, 'Calzone (Tomate, fromage, jambon, oeuf)', '6.50', '6.00', 1),
(3, 2, 2, 'Tacos XL (3 Viandes)', '8.50', '8.00', 1),
(4, 2, 2, 'Tacos XXL (4 Viandes)', '12.50', '11.00', 1);

-- --------------------------------------------------------


--
-- Structure de la table `commande_item`
--

DROP TABLE IF EXISTS `commande_item`;
CREATE TABLE IF NOT EXISTS `commande_item` (
  `idItemCommande` int(11) NOT NULL AUTO_INCREMENT,
  `idCommande` int(11) NOT NULL,
  `idFood` int(11) NOT NULL,
  PRIMARY KEY (`idItemCommande`),
  UNIQUE KEY `idCommande` (`idCommande`,`idFood`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--  FOREIGNS KEYS DE LA TABLE commande_item---
ALTER TABLE commande_item
    ADD CONSTRAINT fk_commande_item_idCommande
    FOREIGN KEY (idCommande)
	REFERENCES commande(commandeID);

ALTER TABLE commande_item
    ADD CONSTRAINT fk_commande_item_idFood
    FOREIGN KEY (idFood)
	REFERENCES foods(foodID);

--
-- Déchargement des données de la table `commande_item`
--

INSERT INTO `commande_item` (`idItemCommande`, `idCommande`, `idFood`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `food_has_special`
--

DROP TABLE IF EXISTS `food_has_special`;
CREATE TABLE IF NOT EXISTS `food_has_special` (
  `foodID` int(11) NOT NULL,
  `specialTypeID` int(11) NOT NULL,
  `nbSpecialMin` int(11) NOT NULL,
  `nbSpecialMax` int(11) NOT NULL,
  PRIMARY KEY (`foodID`,`specialTypeID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--  FOREIGNS KEYS DE LA TABLE food_has_special---
ALTER TABLE food_has_special
    ADD CONSTRAINT fk_food_special_specialType
    FOREIGN KEY (specialTypeID)
	REFERENCES special_type(specialTypeID);

ALTER TABLE food_has_special
    ADD CONSTRAINT fk_food_special_foodID
    FOREIGN KEY (foodID)
	REFERENCES foods(foodID);

--
-- Déchargement des données de la table `food_has_special`
--

INSERT INTO `food_has_special` (`foodID`, `specialTypeID`, `nbSpecialMin`, `nbSpecialMax`) VALUES
(1, 2, 1, 1),
(3, 3, 1, 3),
(3, 1, 0, 2),
(4, 1, 0, 2),
(4, 3, 1, 4);

-- --------------------------------------------------------


--
-- Structure de la table `special_item`
--

DROP TABLE IF EXISTS `special_item`;
CREATE TABLE IF NOT EXISTS `special_item` (
  `specialItemID` int(11) NOT NULL AUTO_INCREMENT,
  `specialTypeID` int(11) NOT NULL,
  `nomSpecialItem` varchar(50) NOT NULL,
  PRIMARY KEY (`specialItemID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--  FOREIGNS KEYS DE LA TABLE special_item---
ALTER TABLE special_item
    ADD CONSTRAINT fk_special_item_part
    FOREIGN KEY (specialTypeID)
	REFERENCES special_type(specialTypeID);
	

--
-- Déchargement des données de la table `special_item`
--

INSERT INTO `special_item` (`specialItemID`, `specialTypeID`, `nomSpecialItem`) VALUES
(1, 1, 'Algérienne'),
(2, 1, 'Barbecue'),
(3, 2, 'Pizza L'),
(4, 2, 'Pizza XL'),
(5, 3, 'Viande Hachée'),
(6, 3, 'Poulet'),
(7, 3, 'Cordon Bleu'),
(8, 3, 'Curry'),
(9, 3, 'Grec');

-- --------------------------------------------------------

--
-- Structure de la table `item_commande_has_special`
--

DROP TABLE IF EXISTS `item_commande_has_special`;
CREATE TABLE IF NOT EXISTS `item_commande_has_special` (
  `idItemCommande` int(11) NOT NULL,
  `idItemSpecial` int(11) NOT NULL,
  PRIMARY KEY (`idItemCommande`,`idItemSpecial`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--  FOREIGNS KEYS DE LA TABLE item_commande_has_special---
ALTER TABLE item_commande_has_special
    ADD CONSTRAINT fk_itemItemsCommandeSpecial_idCommande
    FOREIGN KEY (idItemCommande)
	REFERENCES commande_item(idItemCommande);

ALTER TABLE item_commande_has_special
    ADD CONSTRAINT fk_itemItemsCommandeSpecial_idSpecial
    FOREIGN KEY (idItemSpecial)
	REFERENCES special_item(specialItemID);


--
-- Déchargement des données de la table `item_commande_has_special`
--

INSERT INTO `item_commande_has_special` (`idItemCommande`, `idItemSpecial`) VALUES
(2, 5),
(2, 6),
(2, 7),
(2, 1),
(2, 2);

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
