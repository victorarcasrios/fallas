-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2015 at 10:16 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fallas`
--

-- --------------------------------------------------------

--
-- Table structure for table `fallas`
--

CREATE TABLE IF NOT EXISTS `fallas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`,`address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fallas`
--

INSERT INTO `fallas` (`id`, `name`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cadiz - Los Centelles', 'Los Centelles 25, 46006 Valencia', 1, '2015-03-18 00:06:17', '2015-03-18 00:06:17'),
(2, 'Sueca - Literato', 'Calle Literato Azorín, 46006 Valencia', 1, '2015-03-18 00:07:48', '2015-03-18 00:07:48'),
(3, 'Vivons', 'Calle Vivons, 46006 Valencia', 1, '2015-03-18 00:09:37', '2015-03-18 00:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `objections`
--

CREATE TABLE IF NOT EXISTS `objections` (
  `id_falla` bigint(20) unsigned NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `text` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_falla`,`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `objections`
--

INSERT INTO `objections` (`id_falla`, `id_user`, `text`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Bla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla bla bla blabla', 1, '2015-03-18 01:27:07', '2015-03-18 01:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(60) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'francisco', 'francisco-am@hotmail.com', '$2y$10$n6dyhFBr8cLN2JE.rb28fOi60CC.2oM5jWjTqxlJakm/Ji5RqFSY.', 2, 'dUfQLD9UWw6SfqFX9pvPWEnaTlvqg8iFnddODgUi', '2015-03-17 22:55:43', '2015-03-17 22:55:43'),
(4, 'webmaster', 'victorarcasrios@gmail.com', '$2y$10$6CMfMFcvYLWQLJljR9r0Fu.SvvcvClnb1UYu7FvysfCNLYWnX7We.', 1, 'dUfQLD9UWw6SfqFX9pvPWEnaTlvqg8iFnddODgUi', '2015-03-17 23:30:31', '2015-03-17 23:31:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
