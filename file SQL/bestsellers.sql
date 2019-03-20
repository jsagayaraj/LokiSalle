-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Janvier 2019 à 15:29
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bestsellers`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(5) NOT NULL AUTO_INCREMENT,
  `reference` int(15) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `couleur` varchar(100) NOT NULL,
  `taille` varchar(5) NOT NULL,
  `sexe` enum('m','f') NOT NULL,
  `photo` varchar(200) NOT NULL,
  `prix` int(5) NOT NULL,
  `promo` int(5) DEFAULT NULL,
  `stock` int(5) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id_article`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `sexe`, `photo`, `prix`, `promo`, `stock`, `keywords`) VALUES
(4, 1003, 'Bag', 'Bag', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo dicta et eligendi voluptate magnam, impedit, eius accusantium', 'black', 'S', 'f', '/bestsellers/photo/1003_bags8.jpg', 8, NULL, 0, 'bags, hand bags, letherbags'),
(5, 1004, 'Bag', 'Bag', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus tenetur, asperiores ex perferendis, nostrum aliquid quisquam itaque nihil sequi, praesentium sapiente veniam nam, ducimus odio? Rem architecto, quod iste! Quae.', 'white', '', 'f', '/bestsellers/photo/1004_bags6.jpg', 12, NULL, 3, 'bags, hand bags, letherbags'),
(6, 1005, 'Sarees', 'Sarees', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus tenetur, asperiores ex perferendis, nostrum aliquid quisquam itaque nihil sequi, praesentium sapiente veniam nam, ducimus odio? Rem architecto, quod iste! Quae.', 'red', 'L', 'f', '/bestsellers/photo/1005_ladies-sarees-250x250.jpg', 12, NULL, 2, 'sarees'),
(7, 1006, 'Shirt', 'Koolpals Navy Blue Cotton Men Shirt', 'Introduce yourself to comfort and style with this smart shirt from Koolpals. This navy blue coloured shirt will revive your glamorous look without much effort and guaranteeing you a second look. This is crafted using cotton blend material that will c', 'Light Blue', 'L', 'm', '/bestsellers/photo/1006_shirt-blue.jpg', 25, NULL, 19, 'Shirt, blue shirt, coton shirt, men,style'),
(8, 1007, 'Shirt', ' RPB White Plain Men Cotton Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum. Phasellus varius sem sit amet metus volutpat vel vehicula nunc lacinia.', 'White', 'XL', 'm', '/bestsellers/photo/1007_shirt-white.jpg', 22, NULL, 19, 'Shirt, blue shirt, white shirt, coton shirt, men,style'),
(9, 1009, 'Shirt', 'Koolpals Navy Blue Cotton Men Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum. Phasellus varius sem sit amet metus volutpat vel vehicula nunc lacinia.', 'Light Blue', 'XL', 'm', '/bestsellers/photo/1009_shirt-blue.jpg', 22, NULL, 10, 'Shirt, blue shirt, coton shirt, men,style'),
(10, 1010, 'Shirt', 'Koolpals Gray Cotton Men Shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum. Phasellus varius sem sit amet metus volutpat vel vehicula nunc lacinia.', 'Gray', 'S', 'm', '/bestsellers/photo/1010_shirt-gray.jpg', 22, NULL, 20, 'Shirt, blue shirt, coton shirt, men,style, Koolpals Gray Cotton Men Shirt'),
(11, 1015, 'Jean', 'Black Jean', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum. Phasellus varius sem sit amet metus volutpat vel vehicula nunc lacinia', 'Black', 'L', 'm', '/bestsellers/photo/1015_images.jpg', 35, NULL, 10, 'jean, men blue jean , black jean'),
(12, 1018, 'Jean', 'Combo of Blue Men Jeans', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum. Phasellus varius sem sit amet metus volutpat vel vehicula nunc lacinia', 'Blue', 'L', 'm', '/bestsellers/photo/1018_jean2.jpg', 30, NULL, 9, 'jean, men blue jean , black jean'),
(13, 1016, 'Jean', 'Combo of Beige Plain Men Jeans', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum. Phasellus varius sem sit amet metus volutpat vel vehicula nunc lacinia', 'Biege', 'L', 'm', '/bestsellers/photo/1016_index.jpg', 22, NULL, 20, 'jean, men blue jean , black jean, biege color'),
(14, 1019, 'Sarees', ' Florence Red&amp; Black Chiffon Embroidered Saree', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', 'Red', '', 'f', '/bestsellers/photo/1019_sarees6.jpg', 22, NULL, 9, 'women, sarees, coton sarees'),
(15, 10020, 'Sarees', 'Florence Red Chiffon Embroidered Saree', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', 'White', '', 'f', '/bestsellers/photo/10020_saree3.jpg', 30, NULL, 10, 'women, sarees, coton sarees'),
(16, 1021, 'Sarees', 'Florence Red Chiffon Embroidered Saree', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', 'blue', '', 'f', '/bestsellers/photo/1021_sarees7.jpg', 25, NULL, 19, 'women, sarees, coton sarees'),
(17, 1025, 'Bag', 'Lether Red bag', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', 'Red', '', 'f', '/bestsellers/photo/1025_bags4.jpg', 15, NULL, 15, 'bags, hand bags, letherbags'),
(18, 1045, 'Chudithars', 'Chudithar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', 'Brown', 'L', 'f', '/bestsellers/photo/1045_chudithar4.jpg', 25, NULL, 19, 'Chudithars '),
(19, 1024, 'Chudithars', 'Chudithar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', 'Blue', 'L', 'f', '/bestsellers/photo/1024_chudithar5.jpg', 22, NULL, 20, 'Chudithars, women'),
(20, 0, 'Jewels', 'Rhinestone Necklace Set ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', '', '', 'f', '/bestsellers/photo/_jweles1.jpg', 45, NULL, 20, 'jewels, covering jewels, moden jewels, necklace set'),
(21, 1026, 'Jewels', 'Necklace sets', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', '', '', 'f', '/bestsellers/photo/1026_jweles6.jpg', 30, NULL, 20, 'jewels, covering jewels, moden jewels, necklace set'),
(22, 1029, 'Jewels', 'White Necklace Set', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', '', '', 'f', '/bestsellers/photo/1029_jweles3.jpg', 30, NULL, 19, 'jewels, covering jewels, moden jewels, necklace set'),
(23, 1035, 'Kids', 'Robe', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', 'pink', 'M', 'f', '/bestsellers/photo/1035_robe6.jpg', 12, NULL, 10, 'robe, frog, kids, childrens'),
(25, 10245, 'Kids', 'Robe', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id odio in tortor scelerisque dictum', 'Red', '', 'f', '/bestsellers/photo/10245_robe3.jpg', 25, 1, 19, 'robe, frog, kids, childrens'),
(27, 10201, 'Shirt', 'Koolpals Navy Blue Cotton Men Shirt', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam optio voluptatem sed labore minima fugiat sit non unde a. ', 'Blue', 'L', 'm', '/bestsellers/photo/10201_shirt-blue.jpg', 10, 3, 10, 'shirts');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(5) NOT NULL AUTO_INCREMENT,
  `id_membre` int(5) NOT NULL,
  `id_article` int(5) NOT NULL,
  `commentaire` text NOT NULL,
  `note` varchar(5) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_avis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_article`, `commentaire`, `note`, `date`) VALUES
(1, 4, 4, 'This is realy nice product', '5/10', '2016-02-20 23:29:24'),
(2, 4, 5, 'test', '1/10', '2016-02-21 13:02:44');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id_art` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(6) NOT NULL AUTO_INCREMENT,
  `id_membre` int(5) NOT NULL,
  `montant` double(7,2) NOT NULL,
  `date` datetime NOT NULL,
  `etat` enum('en cours de traitement','envoyé','livré') NOT NULL,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `montant`, `date`, `etat`) VALUES
(1, 2, 18.00, '2016-02-19 18:12:02', 'en cours de traitement'),
(2, 2, 0.00, '2016-02-19 19:11:55', 'en cours de traitement'),
(3, 2, 0.00, '2016-02-19 19:13:43', 'en cours de traitement'),
(4, 2, 27.60, '2016-02-19 19:53:31', 'en cours de traitement'),
(5, 4, 26.40, '2016-02-20 23:43:32', 'en cours de traitement'),
(6, 4, 0.00, '2016-02-20 23:44:48', 'en cours de traitement'),
(7, 4, 0.00, '2016-02-20 23:49:22', 'en cours de traitement'),
(8, 4, 0.00, '2016-02-20 23:51:16', 'en cours de traitement'),
(9, 4, 0.00, '2016-02-20 23:55:19', 'en cours de traitement'),
(10, 4, 0.00, '2016-02-20 23:56:08', 'en cours de traitement'),
(11, 4, 57.60, '2016-02-21 00:40:50', 'en cours de traitement'),
(12, 4, 0.00, '2016-02-21 00:40:58', 'en cours de traitement'),
(13, 1, 14.40, '2016-02-21 00:44:21', 'en cours de traitement'),
(14, 4, 72.00, '2016-02-21 00:45:41', 'en cours de traitement'),
(15, 4, 9.60, '2016-02-21 13:04:33', 'en cours de traitement'),
(16, 4, 0.00, '2016-02-21 13:04:57', 'en cours de traitement'),
(17, 4, 0.00, '2016-02-21 13:05:19', 'en cours de traitement'),
(18, 4, 146.40, '2016-02-22 19:50:24', 'en cours de traitement'),
(19, 4, 30.00, '2016-02-22 20:16:06', 'en cours de traitement'),
(20, 4, 80.40, '2016-02-22 20:33:25', 'en cours de traitement'),
(21, 4, 14.40, '2016-02-22 21:52:39', 'en cours de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE IF NOT EXISTS `details_commande` (
  `id_details_commande` int(5) NOT NULL AUTO_INCREMENT,
  `id_commande` int(6) NOT NULL,
  `id_article` int(5) NOT NULL,
  `quantite` int(4) NOT NULL,
  `prix` double(7,2) NOT NULL,
  PRIMARY KEY (`id_details_commande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `details_commande`
--

INSERT INTO `details_commande` (`id_details_commande`, `id_commande`, `id_article`, `quantite`, `prix`) VALUES
(1, 1, 3, 1, 18.00),
(2, 4, 4, 1, 9.60),
(3, 4, 3, 1, 18.00),
(4, 5, 8, 1, 26.40),
(5, 11, 6, 4, 14.40),
(6, 13, 6, 1, 14.40),
(7, 14, 5, 5, 14.40),
(8, 15, 4, 1, 9.60),
(9, 18, 14, 1, 26.40),
(10, 18, 16, 1, 30.00),
(11, 18, 4, 1, 9.60),
(12, 18, 5, 1, 14.40),
(13, 18, 7, 1, 30.00),
(14, 18, 12, 1, 36.00),
(15, 19, 18, 1, 30.00),
(16, 20, 25, 1, 30.00),
(17, 20, 6, 1, 14.40),
(18, 20, 22, 1, 36.00),
(19, 21, 5, 1, 14.40);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int(5) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(15) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sexe` enum('M','Mme') NOT NULL,
  `ville` varchar(100) NOT NULL,
  `cp` int(5) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `statut` int(1) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `sexe`, `ville`, `cp`, `adresse`, `statut`) VALUES
(1, 'admin', 'admin', 'joseph', 'Sagayaraj', 'bjsahay@gmail.com', 'M', 'Nanterre', 92000, '11 all&eacute;e de l''arlequin', 1),
(2, 'cocou', 'coucou', 'sdfqsdfsd', 'dssdf21254d', 'bjsasdfhay@gmail.com', 'M', 'auxerre', 75012, 'sdfsdfsqdf23132123132', 0),
(3, 'sylvie', 'sylvie', 'sylvie', 'sylvie', 'sylvie@rediffemail.com', 'Mme', 'paris', 78000, '11 all&eacute;e de l''arlequin', 0),
(4, 'navin', 'navin', 'Joseph', 'Navin', 'navin@gmail.com', 'M', 'Nanterre', 92000, '145 rue victor hugo', 0),
(5, 'sdfsdf', 'sdfsdfsd', 'sdfsdf', '', 'dsdf', 'M', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id_newsletter` int(5) NOT NULL AUTO_INCREMENT,
  `id_membre` int(5) NOT NULL,
  PRIMARY KEY (`id_newsletter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `id_membre`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id_payment` int(11) NOT NULL AUTO_INCREMENT,
  `commande` int(10) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_payment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `payment`
--

INSERT INTO `payment` (`id_payment`, `commande`, `token`, `date`) VALUES
(1, 20, 'EC%2d3TM74042KT508550M', '2016-02-22 20:33:25'),
(2, 21, 'EC%2d9WD18770XH932520N', '2016-02-22 21:52:39');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id_promo` int(2) NOT NULL AUTO_INCREMENT,
  `code_promo` varchar(6) NOT NULL,
  `reduction` int(5) NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`id_promo`, `code_promo`, `reduction`) VALUES
(1, 'PROMO4', 10),
(2, 'PROMO2', 20),
(3, 'PROMO1', 25),
(4, 'PROMO1', 30),
(5, 'PROMO3', 5),
(6, 'PROMO5', 50);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
