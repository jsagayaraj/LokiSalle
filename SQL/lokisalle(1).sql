-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Décembre 2015 à 23:40
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `lokisalle`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(5) NOT NULL AUTO_INCREMENT,
  `id_membre` int(5) NOT NULL,
  `id_salle` int(5) NOT NULL,
  `commentaire` text CHARACTER SET latin1 NOT NULL,
  `note` varchar(5) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `id_membre` (`id_membre`),
  KEY `id_salle` (`id_salle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date`) VALUES
(15, 1, 2, 'magnifique', '3/10', '2015-11-27 12:32:42'),
(16, 1, 15, 'A recommander', '8/10', '2015-11-27 12:33:03'),
(17, 2, 13, '', '1/10', '2015-12-13 11:29:59');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(6) NOT NULL AUTO_INCREMENT,
  `montant` int(5) NOT NULL,
  `id_membre` int(5) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `montant`, `id_membre`, `date`) VALUES
(45, 720, 1, '2015-12-14 21:51:44'),
(46, 1020, 1, '2015-12-14 21:52:02');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE IF NOT EXISTS `details_commande` (
  `id_details_commande` int(6) NOT NULL AUTO_INCREMENT,
  `id_commande` int(6) NOT NULL,
  `id_produit` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_details_commande`),
  KEY `id_commande` (`id_commande`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Contenu de la table `details_commande`
--

INSERT INTO `details_commande` (`id_details_commande`, `id_commande`, `id_produit`) VALUES
(40, 45, 28),
(41, 46, 36);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int(5) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(15) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(32) CHARACTER SET latin1 NOT NULL,
  `nom` varchar(20) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(20) CHARACTER SET latin1 NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sexe` enum('M','Mme') CHARACTER SET latin1 NOT NULL,
  `ville` varchar(20) CHARACTER SET latin1 NOT NULL,
  `cp` int(5) NOT NULL,
  `adresse` varchar(20) CHARACTER SET latin1 NOT NULL,
  `statut` int(1) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `sexe`, `ville`, `cp`, `adresse`, `statut`) VALUES
(1, 'admin', 'admin', 'JOSEPH', 'Sagayaraj', 'bjsahay@gmail.com', 'M', 'Nanterre', 92000, '50 allÃ©e de l', 1),
(2, 'test', '123456', 'chabier', 'Marie Antoin', 'antoine@yahoo.com', 'M', 'Paris', 92000, '10 rue louis bonnet', 0),
(5, 'coucou', 'coucou', 'Julien', 'Matilde', 'peter@hotmail.com', '', 'Lille', 55000, '154 avenue parmentie', 0),
(8, 'computer', '123456', 'yoyo', 'yoyo', 'yoyo@hotmail.com', 'M', 'paris', 75012, '12 rue de la chapell', 0),
(14, 'Pauline', '123456', 'CHERIDAN', 'Pauline', 'pauline@gmail.com', 'Mme', 'Cergy', 95000, '10 rue victor hugo', 0),
(15, 'pencil', '147258', 'Amin', 'Ravi', 'bj_sahay@yahoo.com', 'M', 'nanterre', 92000, '11 allee de l''arlequ', 0),
(16, 'Nicolas', '147852', 'sdfsd', 'sdsdfsd', 'sdfsdf@gmail.com', 'M', 'Paris', 85252, 'sdfsdf', 0),
(17, 'sdfsdf', 'ssdfsd', 'Julien', 'jkghjkjh', 'sdfsd@gmail.com', 'M', 'Lille', 25852, 'sdfsd', 0);

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id_newsletter` int(5) NOT NULL AUTO_INCREMENT,
  `id_membre` int(5) NOT NULL,
  PRIMARY KEY (`id_newsletter`),
  KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `id_membre`) VALUES
(1, 15),
(2, 16);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(5) NOT NULL AUTO_INCREMENT,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `id_salle` int(5) NOT NULL,
  `id_promo` int(2) DEFAULT NULL,
  `prix` int(5) NOT NULL,
  `etat` enum('0','1') NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_salle` (`id_salle`),
  KEY `id_promo` (`id_promo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `date_arrivee`, `date_depart`, `id_salle`, `id_promo`, `prix`, `etat`) VALUES
(12, '2017-10-20 00:00:00', '2017-10-23 00:00:00', 2, 0, 300, '0'),
(13, '2016-10-20 09:00:00', '2016-10-23 18:00:00', 20, 2, 258, '0'),
(20, '2016-03-02 00:00:00', '2016-03-05 00:00:00', 7, 1, 500, '0'),
(22, '2016-04-08 00:00:00', '2016-04-13 00:00:00', 13, 0, 300, '1'),
(23, '2017-02-01 00:00:00', '2017-02-05 00:00:00', 21, 2, 550, '0'),
(24, '2016-04-03 00:00:00', '2016-04-10 00:00:00', 3, 0, 600, '1'),
(25, '2016-03-15 00:00:00', '2016-03-18 00:00:00', 4, 1, 350, '1'),
(26, '2016-10-20 00:00:00', '2016-10-22 00:00:00', 5, 0, 800, '1'),
(27, '2016-08-20 00:00:00', '2016-08-23 00:00:00', 6, 2, 450, '1'),
(28, '2016-02-20 00:00:00', '2016-02-24 00:00:00', 8, 2, 600, '0'),
(29, '2016-03-15 00:00:00', '2016-03-20 00:00:00', 9, 0, 400, '1'),
(30, '2016-01-10 00:00:00', '2016-01-15 00:00:00', 10, 1, 275, '1'),
(31, '2016-05-02 00:00:00', '2016-05-05 00:00:00', 14, 0, 375, '1'),
(32, '2016-05-10 00:00:00', '2016-05-15 00:00:00', 15, 2, 500, '1'),
(33, '2016-06-01 00:00:00', '2016-06-03 00:00:00', 16, 1, 640, '1'),
(34, '2016-02-12 00:00:00', '2016-02-15 00:00:00', 17, 0, 330, '1'),
(35, '2016-08-01 00:00:00', '2016-08-05 00:00:00', 18, 0, 290, '1'),
(36, '2017-01-02 00:00:00', '2017-01-06 00:00:00', 19, 2, 850, '0'),
(37, '2017-03-02 00:00:00', '2017-03-05 00:00:00', 11, 0, 300, '1'),
(38, '2016-05-03 00:00:00', '2016-05-08 00:00:00', 12, 1, 450, '1');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id_promo` int(2) NOT NULL AUTO_INCREMENT,
  `code_promo` varchar(6) CHARACTER SET latin1 NOT NULL,
  `reduction` int(5) NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`id_promo`, `code_promo`, `reduction`) VALUES
(0, 'aucune', 0),
(1, 'PROMO1', 25),
(2, 'PROMO5', 50);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int(5) NOT NULL AUTO_INCREMENT,
  `reference` int(9) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `cp` varchar(5) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('Reunion') NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `reference`, `pays`, `ville`, `adresse`, `cp`, `titre`, `description`, `photo`, `capacite`, `categorie`) VALUES
(2, 100201, 'France', 'Paris', '145 avenue parmentier', '75019', 'Salle duval', '  Situ&eacute; &agrave; cinq minutes de la station de m&eacute;tro &laquo;&rsquo;R&eacute;publique&raquo;, &agrave; quelques pas du canal Saint Martin et de l&rsquo;animation de ses bars et restaurants en terrasse, Lokisalle met &agrave; votre disposition sur 250 m&sup2;, une salle de s&eacute;minaire climatis&eacute;e en lumi&egrave;re naturelle avec un auditorium &eacute;quip&eacute; de 50 places assises.', '/lokisalle/photo/100201_duval.jpg', 50, 'Reunion'),
(3, 100202, 'France', 'Paris', '9 rue Beranger', '75003', 'Salle Baron', ' Situ&eacute; &agrave; cinq minutes de la station de m&eacute;tro &laquo;&rsquo;R&eacute;publique&raquo;, &agrave; quelques pas du canal Saint Martin et de l&rsquo;animation de ses bars et restaurants en terrasse, Lokisalle met &agrave; votre disposition sur 250 m&sup2;, une salle de s&eacute;minaire climatis&eacute;e en lumi&egrave;re naturelle avec un auditorium &eacute;quip&eacute; de 50 places assises. ', '/lokisalle/photo/100202_baraon.jpg', 70, 'Reunion'),
(4, 100203, 'France', 'Paris', '11 place d&#039;italie', '75005', 'Salle Bardin', '     Salle spacieuse et moderne dont l&#039;&eacute;l&eacute;gance et la clart&eacute; vous seduiront. Un mat&eacute;riel de video-projection performant est mis gracieusement &agrave; votre disposition.', '/lokisalle/photo/100203_bardin.jpg', 20, 'Reunion'),
(5, 100204, 'France', 'Paris', '144 rue de rivoli', '75001', 'Salle Baille', '      Tr&egrave;s jolie salle toute &eacute;quip&eacute;e', '/lokisalle/photo/100204_baile.jpg', 80, 'Reunion'),
(6, 100205, 'France', 'Paris', '68 fauboug saint honore', '75008', 'Salle Ballerat', '      Situ&eacute; dans la rue du Palais de l&#039;&Eacute;lys&eacute;e. Et pour vos r&eacute;unions tardives : la salle est accessible 24 heures sur 24 !', '/lokisalle/photo/100205_ballerat.jpg', 50, 'Reunion'),
(7, 100206, 'France', 'Marseille', '83 boulevard du redon', '13000', 'Salle Victoire', '    Magnifique salle en plein xcoeur de Marseille A 2 pas de la Gare St Charles', '/lokisalle/photo/100206_victoire.jpg', 30, 'Reunion'),
(8, 100207, 'France', 'Lyon', '15 Boulevard Marius Vivier Merle', '69003', 'Salle Ballerata', '   Salle pratique et confortable b&eacute;n&eacute;ficiant d&#039;un dispositif de video-conference int&eacute;gr&eacute;s.\r\n\r\n', '/lokisalle/photo/100207_ballerat.jpg', 15, 'Reunion'),
(9, 100208, 'France', 'Paris', '8 rue Baillet', '75001', 'Salle Cabat', '  Tr&egrave;s jolie salle toute &eacute;quip&eacute;e', '/lokisalle/photo/100208_cabat.jpg', 25, 'Reunion'),
(10, 100209, 'France', 'Marseille', '20 Boulevard fifi turin', '13010', 'Salle Carriere', '  Le Salon Phenicia au coeur du 10e arrondissement de Marseille, vous ouvre ses portes.\r\n\r\n', '/lokisalle/photo/100209_carriere.jpg', 10, 'Reunion'),
(11, 100210, 'France', 'Lyon', '23 rue Felix Jacquier', '69006', 'Salle Cezanne', '      Salle pratique et confortable b&eacute;n&eacute;ficiant d&#039;un dispositif de video-conference int&eacute;gr&eacute;s.', '/lokisalle/photo/100210_cezanne.jpg', 30, 'Reunion'),
(12, 100211, 'France', 'Paris', '6 rue Charles-Francois Dupuis\r\n', '75003', 'Salle Clesinger', '   une salle de s&eacute;minaire climatis&eacute;e en lumi&egrave;re naturelle avec un auditorium &eacute;quip&eacute; de 50 places assises.', '/lokisalle/photo/100211_clesinger.jpg', 45, 'Reunion'),
(13, 100212, 'France', 'Marseille', '30 rue de la loge', '13000', 'Salle Couture', '       La Vaina Loca est situ&eacute; &agrave; l&rsquo;entr&eacute;e de Paris, &agrave; 5 minutes des villages ostr&eacute;icoles, &agrave; 10 minutes du centre de Paris. Ambiance futuriste et design pour ce concept unique int&eacute;grant un espace spa et fitness de 1000m2.', '/lokisalle/photo/100212_couture.jpg', 20, 'Reunion'),
(14, 100213, 'France', 'Paris', '8 rue Baillet', '75001', 'Salle Daubigny', '  Ambiance futuriste et design pour ce concept unique int&eacute;grant un espace spa et fitness de 1000m2.', '/lokisalle/photo/100213_daubigny.jpg', 30, 'Reunion'),
(15, 100214, 'France', 'Lyon', 'Boulevard de Staligared', '69100', 'Salle Delacroix', ' Magnifique salle en plein xcoeur de Marseille A 2 pas de la Gare St Charles', '/lokisalle/photo/100214_delacroix.jpg', 20, 'Reunion'),
(16, 100216, 'France', 'Paris', '15 place d&#039;italie', '75005', 'Salle Delaroche', ' Magnifique salle en plein xcoeur de Marseille A 2 pas de la Gare St Charles ', '/lokisalle/photo/100216_demanche.jpg', 50, 'Reunion'),
(17, 100217, 'France', 'Marseille', '30 rue de la loge', '13000', 'Salle Demanche', ' Situ&eacute; en plein c&oelig;ur du quartier d&rsquo;affaires, le Centre de Congr&egrave;s Lokisalle a &eacute;t&eacute; pens&eacute; pour vous offrir un confort optimal, des espaces et des services de grande qualit&eacute; tout en r&eacute;duisant l&rsquo;empreinte environnementale de vos &eacute;v&eacute;nements.', '/lokisalle/photo/100217_cabat.jpg', 35, 'Reunion'),
(18, 100218, 'fr', 'Lyon', '2 rue Nicolas sicard', '69005', 'Salle Latour', '  Salle pratique et confortable b&eacute;n&eacute;ficiant d&#039;un dispositif de video-conference int&eacute;gr&eacute;s.', '/lokisalle/photo/100218_latour.jpg', 20, 'Reunion'),
(19, 100219, 'France', 'Paris', '9 rue Beranger', '75003', 'Salle Jouvenet', '   une salle de s&eacute;minaire climatis&eacute;e en lumi&egrave;re naturelle avec un auditorium &eacute;quip&eacute; de 50 places assises.', '/lokisalle/photo/100219_jouvenet.jpg', 60, 'Reunion'),
(20, 100220, 'France', 'Lyon', '2 rue Nicolas sicard', '69005', 'Salle Grimaud', ' une salle de s&eacute;minaire climatis&eacute;e en lumi&egrave;re naturelle avec un auditorium &eacute;quip&eacute; de 50 places assises. ', '/lokisalle/photo/100220_langlois.jpg', 65, 'Reunion'),
(21, 100221, 'France', 'Paris', '9 rue Beranger', '75003', 'Salle Langlis', ' une salle de s&eacute;minaire climatis&eacute;e en lumi&egrave;re naturelle avec un auditorium &eacute;quip&eacute; de 50 places assises. ', '/lokisalle/photo/100221_demanche.jpg', 30, 'Reunion');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_3` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avis_ibfk_4` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_ibfk_3` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `details_commande_ibfk_4` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `newsletter_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`id_promo`) REFERENCES `promotion` (`id_promo`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
