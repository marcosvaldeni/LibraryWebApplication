-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 17, 2017 at 01:34 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(45) NOT NULL,
  `book_author` varchar(45) NOT NULL,
  `book_ISBN` varchar(20) NOT NULL,
  `book_avaliable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `book_author`, `book_ISBN`, `book_avaliable`) VALUES
(1, 'Generation X', 'Douglas Coupland', '0349108390', 1),
(2, 'Introducing HTML5', ' Remy Sharp', '0321687299', 1),
(3, 'Hardcrafted CSS', 'Dan Cederholm', '0321643380', 1),
(4, 'Bulletproof Web Design', 'Dan Cederholm', '0321509021', 0),
(5, 'The Tipping Point', 'Malcolm Gladwell', '0349113467', 0),
(6, 'Java How To Program (Early Objects)', 'Paul J. Deitel', '0133813436', 1),
(7, 'Head First Java', 'Kathy Sierra', '0596009208', 1),
(8, 'Head First SQL: Your Brain on SQL', 'Lynn Beighley', '0596526849', 1),
(9, 'Beginning C++ Programming', 'Richard Grimes', '1787124940', 1),
(10, 'Origin', 'Dan Brown', '0593078756', 0),
(11, 'The Midnight Line', 'Lee Child', '0593078187', 1),
(12, 'The Lost Symbol', 'Dan Brown', '0552149527', 0),
(14, 'The Split', 'Hannah Hopkins', '1549988697', 1),
(17, 'Python: For Beginners', 'Timothy C. Needham', '1549776673', 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrowedbooks`
--

DROP TABLE IF EXISTS `borrowedbooks`;
CREATE TABLE IF NOT EXISTS `borrowedbooks` (
  `borrowedbook_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `staff_id` int(1) NOT NULL,
  `borrowedbook_checkout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `borrowedbook_exreturn` timestamp NULL DEFAULT NULL,
  `borrowedbook_checkin` timestamp NULL DEFAULT NULL,
  `borrowedbook_avaliable` int(1) DEFAULT '0',
  PRIMARY KEY (`borrowedbook_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowedbooks`
--

INSERT INTO `borrowedbooks` (`borrowedbook_id`, `book_id`, `user_id`, `staff_id`, `borrowedbook_checkout`, `borrowedbook_exreturn`, `borrowedbook_checkin`, `borrowedbook_avaliable`) VALUES
(1, 10, 10, 9, '2017-02-15 10:28:23', '2017-02-22 23:59:59', '2017-02-21 10:28:23', 1),
(2, 17, 10, 2, '2017-09-20 12:19:21', '2017-09-27 22:59:59', NULL, 0),
(3, 6, 10, 2, '2017-09-12 14:24:17', '2017-09-19 22:59:59', '2017-12-16 23:04:04', 1),
(4, 12, 10, 1, '2017-12-15 23:53:28', '2017-12-22 23:53:28', NULL, 0),
(5, 3, 10, 1, '2017-12-15 23:53:28', '2017-12-22 23:53:28', '2017-12-16 22:55:31', 1),
(6, 10, 5, 1, '2017-12-16 20:36:33', '2017-12-23 20:36:33', NULL, 0),
(7, 5, 5, 1, '2017-12-16 20:36:33', '2017-12-23 20:36:33', NULL, 0),
(11, 6, 5, 1, '2017-12-16 22:35:53', '2017-12-23 22:35:53', '2017-12-16 23:04:04', 1),
(12, 4, 5, 1, '2017-12-16 23:28:59', '2017-12-23 23:28:59', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) NOT NULL,
  `user_login` varchar(35) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_pass` varchar(65) NOT NULL,
  `user_level` int(1) NOT NULL DEFAULT '3',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_login` (`user_login`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_login`, `user_email`, `user_pass`, `user_level`) VALUES
(1, 'Afonso Mohan', 'afonso', 'AfonsoMohan@mail.com', '$2y$10$3d/kLak3ls.29m2Y2VcAlukEXkBPVIs2WjQqWUbu2aLel/4Kyn28O', 1),
(2, 'Anona Kelsey', 'anona', 'AnonaKelsey@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 2),
(3, 'Bronte Breen', 'bronte', 'BronteBreen@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 2),
(4, 'Hallie Simon', 'hallie', 'HallieSimon@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 2),
(5, 'Sheamus Brent', 'sheamus', 'SheamusBrent@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(6, 'Alexandrina Brock', 'alexandrina', 'AlexandrinaBrock@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(7, 'Gregory Norris', 'gregory', 'GregoryNorris@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(8, 'Naomh Salazar', 'naomh', 'NaomhSalazar@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(9, 'Hyrum Confortola', 'hyrum', 'HyrumConfortola@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(10, 'Gaia Danniell', 'gaia', 'GaiaDanniell@mail.com', '$2y$10$IQFTdanHRpk92SwOUTQK7u0E.qu/Vlcxedvch8yHC4ZWcAsYeGs3q', 3),
(11, 'Georgene Gibson', 'georgene', 'GeorgeneGibson@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(12, 'Murchadh Guttuso', 'murchadh', 'MurchadhGuttuso@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(13, 'Lawson Neil', 'lawson', 'LawsonNeil@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(14, 'Briar Ribeiro', 'briar', 'BriarRibeiro@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(15, 'Ernie Dudley', 'ernie', 'ErnieDudley@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(16, 'Sipho Bateson', 'sipho', 'SiphoBateson@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(17, 'Maura Coy', 'maura', 'MauraCoy@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(18, 'Giosetta Snyder', 'giosetta', 'GiosettaSnyder@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(19, 'Clemente Villa', 'clemente', 'ClementeVilla@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(20, 'Corina De Laurentis', 'corina', 'CorinaDeLaurentis@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(21, 'Lindsey Santana', 'lindsey', 'LindseySantana@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(22, 'Finnbar Potenza', 'finnbar', 'FinnbarPotenza@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(23, 'Tallulah McCrory', 'tallulah', 'TallulahMcCrory@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(24, 'Bobbie Close', 'bobbie', 'BobbieClose@mail.com', '$2y$10$8SPWCJ3dW9VSV1EdF.96XutP/qbtH5Ir41RbEa7yF.2pUnTn1OoZG', 3),
(25, 'Marcos Lucas', 'marcos', 'marcos@gmail.com', '$2y$10$RW5ATyucq25.A/jcg2XLF.TBgNJG/L5j3Jkgb9IU1fA0mMWgJJHme', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
