-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Janvier 2019 à 15:35
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db_store`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(20) NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'sagayaraj', 'admin', 'admin@gmai.com', 'admin', 0);

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(5) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(255) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `brand`
--

INSERT INTO `brand` (`brand_id`, `brandName`) VALUES
(1, 'IPhone'),
(3, 'Canon'),
(4, 'Acer'),
(5, 'Sumsung');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`cat_id`, `catName`) VALUES
(1, 'Mobile Phones'),
(2, 'Desktop'),
(4, 'Accessories'),
(7, 'Footwear'),
(8, 'Jewellery'),
(9, 'Clothing'),
(10, 'Home Decor &amp; Kitchen'),
(11, 'Beauty &amp; Healthcare');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(5) NOT NULL AUTO_INCREMENT,
  `product_Name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`product_id`, `product_Name`, `cat_id`, `brand_id`, `description`, `price`, `image`, `type`) VALUES
(1, 'Bag', 4, 4, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, repellendus labore, delectus dolorem soluta quo tempora excepturi assumenda, est laborum impedit nemo. Hic voluptatem blanditiis, unde ex, et laudantium explicabo!</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, repellendus labore, delectus dolorem soluta quo tempora excepturi assumenda, est laborum impedit nemo. Hic voluptatem blanditiis, unde ex, et laudantium explicabo!</p>', 50.00, 'upload/f94658ea93.png', 0),
(3, 'Iphone', 4, 1, 'hello Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, repellendus labore, delectus dolorem soluta quo tempora excepturi assumenda, est laborum impedit nemo. Hic voluptatem blanditiis, unde ex, et laudantium explicabo!\r\n', 800.00, 'upload/0064e45f4b.jpg', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
