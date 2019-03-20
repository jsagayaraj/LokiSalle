-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Janvier 2019 à 15:37
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `phpcms`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_panel`
--

CREATE TABLE IF NOT EXISTS `admin_panel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `post` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `admin_panel`
--

INSERT INTO `admin_panel` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(15, '26-10-2017 17:31: ', 'Chocolate', 'entrÃ©e', 'JOSEPH Sagayaraj', '25869.jpeg', '58522'),
(16, '26-10-2017:16:59', 'Chocolate Truffle Dessert', 'Dessert', 'JOSEPH Sagayaraj', 'Chocolate Truffle Dessert.jpeg', 'Chocolate Truffle Dessert'),
(20, '27-10-2017:11:40', 'Crab Fondant CitronnÃ©', 'entrÃ©e', 'JOSEPH Sagayaraj', 'Crabe-fondant citronne.jpg', 'Il sâ€™agit dâ€™une entrÃ©e au crabe citronnÃ© Ã  la coriandre, poireaux croquant et mangue. Servez cette entrÃ©e lors de votre prochain dÃ®ner et vous mâ€™en direz des nouvelles : effet waouh visuel et gustatif garanti !'),
(21, '28-10-2017:19:54', 'Piza royal', 'Piza', 'JOSEPH Sagayaraj', 'piza.jpeg', 'Pizza is a type of food that was created in Italy. It is made by putting "Toppings" (such as cheese, sausages, pepperoni, vegetables, tomatoes, spices and herbs) over a piece of bread covered with sauce; most often tomato, but sometimes butter-based sauces are used. (The piece of bread is usually called a "pizza crust".) Almost any kind of topping can be put over a pizza. The toppings people use are different in different parts of the world. Pizza comes from Italy, from Neapolitan cuisine, but has become popular in many parts of the world. Recently, on July 1st, James Penny (football player for arsenal) after being interviewed by BBC, quoted ''Pizza is like a drug, one bite is all that''s needed and there you are desperately wanting more.'' These inspiring words truly just show that even professional sports players like so still eat such foods and like the average person just can''t get enough');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatername` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `datetime`, `name`, `creatername`) VALUES
(2, '06-10-2017:53:43', 'CSS', 'JOSEPH Sagayaraj'),
(3, '06-10-2017:55:01', 'CSS', 'JOSEPH Sagayaraj'),
(4, '06-10-2017:56:42', 'javascript', 'JOSEPH Sagayaraj'),
(7, '06-10-2017:47:03', 'CSS', 'JOSEPH Sagayaraj'),
(18, '13-10-2017:05:52:53', 'Dessert', 'JOSEPH Sagayaraj'),
(19, '13-10-2017:05:53:02', 'EntrÃ©e', 'JOSEPH Sagayaraj'),
(20, '13-10-2017:05:53:08', 'Piza', 'JOSEPH Sagayaraj'),
(21, '13-10-2017:05:56:11', 'entr&eacute;e', 'JOSEPH Sagayaraj');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `post` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL,
  `admin_panel_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_panel_id` (`admin_panel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `name`, `datetime`, `email`, `post`, `status`, `admin_panel_id`) VALUES
(11, 'hello', '26-10-2017:19:27', 'cherisylvie@yahoo.fr', 'sdfsdfsdf', 'ON', 15),
(12, 'sylvie', '26-10-2017:19:31', 'saga@gmail.com', 'sdfsdfsdf', 'ON', 16),
(13, 'zeazerzerhzer', '26-10-2017:19:33', 'bjsahay@gmail.com', 'sdfsdfsd', 'ON', 16),
(14, 'sdfsdf', '26-10-2017:19:49', 'sdfsdf@gmial.com', 'sdfsdf', 'ON', 15),
(15, 'sdfsdf', '26-10-2017:19:52', 'bjsahay@gmail.com', 'sdfsdfsdf', 'ON', 15),
(16, 'sdfsdf', '26-10-2017:19:53', 'bjsahay@gmail.com', 'sdfsdfsdf', 'ON', 15),
(17, 'hello', '26-10-2017:19:53', 'hellofine@gmail.com', 'sf3sd1f31sd32f1', 'ON', 15),
(18, 'navin', '26-10-2017:19:56', 'navin@gmail.com', 'super', 'ON', 15),
(19, 'sdfsdf', '26-10-2017:20:00', 'dfsdf@com', 'sdfsdf', 'ON', 15),
(20, 'Antony', '27-10-2017:13:04', 'antony@yahoo.com', 'Il sâ€™agit dâ€™une entrÃ©e au crabe citronnÃ© Ã  la coriandre, poireaux croquant et mangue. Servez cette entrÃ©e lors de votre prochain dÃ®ner et vous mâ€™en direz des nouvelles : effet waouh visuel et gustatif garanti ', 'ON', 20),
(21, 'Gerard', '28-10-2017:19:55', 'gerard@gmail.com', 'It is made by putting "Toppings" (such as cheese, sausages, pepperoni, vegetables, tomatoes, spices and herbs) over a piece of bread covered with sauce;', 'ON', 21),
(24, 'sdfsdf', '28-10-2017:20:03', 'bjsahay@gmail.com', 'sdfsdfsd', 'ON', 21),
(25, 'sdfsd', '28-10-2017:20:04', 'at@mail.com', 'sdfsdf', 'OFF', 21),
(26, 'raju', '28-10-2017:20:05', 'at@mail.com', 'sdfsdfsd', 'OFF', 21),
(27, 'dfgdfg', '28-10-2017:20:06', 'at@mail.com', 'dfgdf', 'OFF', 21),
(28, 'dfgdfg', '28-10-2017:20:09', 'gerard@gmail.com', 'sfsdfsdfsdf', 'OFF', 21),
(29, 'raju', '28-10-2017:20:10', 'bjsahay@gmail.com', 'fqsdfqsdfsdf', 'OFF', 20),
(30, 'dfgdfg', '28-10-2017:20:12', 'bjsahay@gmail.com', 'sdfsdfqsdf', 'OFF', 21),
(31, 'sagayaraj joseph', '10-01-2019:10:19', 'bjsahay@gmail.com', 'sdfsdfsdfsdf', 'OFF', 21);

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `datetime` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `addedby` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `forignKey_to_admin_panel` FOREIGN KEY (`admin_panel_id`) REFERENCES `admin_panel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
