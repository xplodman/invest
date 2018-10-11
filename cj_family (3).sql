-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2018 at 08:02 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cj_family`
--

-- --------------------------------------------------------

--
-- Table structure for table `case`
--

CREATE TABLE IF NOT EXISTS `case` (
  `id` int(11) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `depart_id` int(11) NOT NULL,
  `main_ledger_id` int(11) NOT NULL,
  `case_number` int(12) NOT NULL,
  `case_year` int(5) NOT NULL,
  PRIMARY KEY (`depart_id`,`main_ledger_id`,`case_number`,`case_year`),
  KEY `fk_case_depart1_idx` (`depart_id`),
  KEY `fk_case_main_ledger1_idx` (`main_ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case`
--

INSERT INTO `case` (`id`, `createdate`, `updatedate`, `status`, `deleted`, `depart_id`, `main_ledger_id`, `case_number`, `case_year`) VALUES
(2, '2018-03-30 01:09:22', NULL, 1, 0, 1, 2, 98098, 9809809),
(3, '2018-03-30 12:45:50', NULL, 1, 0, 2, 2, 80, 2018),
(1, '2018-03-29 23:19:00', NULL, 1, 0, 3, 1, 98, 98),
(6, '2018-07-20 13:16:39', NULL, 1, 0, 4, 2, 33, 2018),
(4, '2018-07-20 11:15:10', NULL, 1, 0, 4, 2, 80, 2018),
(5, '2018-07-20 13:16:16', NULL, 1, 0, 4, 2, 180, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `case_has_investigation`
--

CREATE TABLE IF NOT EXISTS `case_has_investigation` (
  `id_case_has_investigation` int(11) NOT NULL,
  `investigation_number` int(11) NOT NULL,
  `investigation_year` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `case_status_idcase_status` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `prosecutor_id` int(11) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`investigation_number`,`investigation_year`),
  KEY `fk_case_has_investigation_case_status1_idx` (`case_status_idcase_status`),
  KEY `fk_case_has_investigation_users1_idx` (`users_id`),
  KEY `fk_case_has_investigation_prosecutor1_idx` (`prosecutor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case_has_investigation`
--

INSERT INTO `case_has_investigation` (`id_case_has_investigation`, `investigation_number`, `investigation_year`, `case_id`, `case_status_idcase_status`, `users_id`, `prosecutor_id`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(2, 2, 2018, 4, 1, 2, 2, '2018-07-20 11:15:10', '2018-07-21 05:59:41', 1, 0),
(3, 3, 2018, 5, 1, 2, 2, '2018-07-20 13:16:16', '2018-07-20 20:30:59', 1, 0),
(4, 4, 2018, 6, 1, 2, 1, '2018-07-20 13:16:39', '2018-07-20 19:30:21', 1, 0),
(1, 32232323, 2018, 3, 2, 2, 2, '2018-07-19 23:17:50', '2018-07-20 20:21:23', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `case_has_investigation_has_charges`
--

CREATE TABLE IF NOT EXISTS `case_has_investigation_has_charges` (
  `case_has_investigation_id_case_has_investigation` int(11) NOT NULL,
  `charges_id_charges` int(11) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `case_has_investigation_has_charges_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`case_has_investigation_id_case_has_investigation`,`charges_id_charges`),
  KEY `fk_case_has_investigation_has_charges_charges1_idx` (`charges_id_charges`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case_has_investigation_has_charges`
--

INSERT INTO `case_has_investigation_has_charges` (`case_has_investigation_id_case_has_investigation`, `charges_id_charges`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_charges_id`) VALUES
(1, 2, '2018-07-20 20:21:23', NULL, 1, 0, 11),
(2, 1, '2018-07-21 05:59:41', NULL, 1, 0, 14),
(2, 2, '2018-07-21 05:59:41', NULL, 1, 0, 15),
(3, 1, '2018-07-20 20:30:59', NULL, 1, 0, 12),
(3, 2, '2018-07-20 20:30:59', NULL, 1, 0, 13),
(4, 2, '2018-07-20 19:30:21', NULL, 1, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `case_has_investigation_has_reason_to_done`
--

CREATE TABLE IF NOT EXISTS `case_has_investigation_has_reason_to_done` (
  `case_has_investigation_id_case_has_investigation` int(11) NOT NULL,
  `reason_to_done_id_reason_to_done` int(11) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `case_has_investigation_has_reason_to_done_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`reason_to_done_id_reason_to_done`,`case_has_investigation_id_case_has_investigation`),
  KEY `fk_case_has_investigation_has_reason_to_done_reason_to_done_idx` (`reason_to_done_id_reason_to_done`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case_has_investigation_has_reason_to_done`
--

INSERT INTO `case_has_investigation_has_reason_to_done` (`case_has_investigation_id_case_has_investigation`, `reason_to_done_id_reason_to_done`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_reason_to_done_id`) VALUES
(2, 1, '2018-07-21 05:59:41', NULL, 1, 0, 1),
(4, 1, '2018-07-20 13:16:39', NULL, 1, 0, 1),
(2, 2, '2018-07-21 05:59:41', NULL, 1, 0, 2),
(3, 2, '2018-07-20 20:30:59', NULL, 1, 0, 1),
(4, 2, '2018-07-20 13:16:39', NULL, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `case_has_possession`
--

CREATE TABLE IF NOT EXISTS `case_has_possession` (
  `possession_possession_number` int(11) NOT NULL,
  `possession_possession_year` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  PRIMARY KEY (`possession_possession_number`,`possession_possession_year`,`case_id`),
  KEY `fk_case_has_possession_possession1_idx` (`possession_possession_number`,`possession_possession_year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case_has_possession`
--

INSERT INTO `case_has_possession` (`possession_possession_number`, `possession_possession_year`, `case_id`) VALUES
(98, 98, 1),
(786, 9786, 3),
(9098098, 98098, 2);

-- --------------------------------------------------------

--
-- Table structure for table `case_status`
--

CREATE TABLE IF NOT EXISTS `case_status` (
  `idcase_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcase_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `case_status`
--

INSERT INTO `case_status` (`idcase_status`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'تم التصرف', '2018-07-19 23:17:06', NULL, 1, 0),
(2, 'متداولة', '2018-07-20 18:44:13', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE IF NOT EXISTS `charges` (
  `id_charges` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_charges`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id_charges`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'اغتصاب', '2018-07-20 00:45:10', NULL, 1, 0),
(2, 'مخدرات', '2018-07-20 00:45:10', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `depart`
--

CREATE TABLE IF NOT EXISTS `depart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `pros_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`pros_id`),
  KEY `fk_depart_pros_idx` (`pros_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `depart`
--

INSERT INTO `depart` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`, `pros_id`) VALUES
(1, 'رمل أول', '2018-03-20 14:57:20', NULL, 1, 0, 1),
(2, 'رمل ثان', '2018-03-20 14:57:20', NULL, 1, 0, 2),
(3, 'منتزة أول', '2018-03-20 14:57:20', NULL, 1, 0, 3),
(4, 'منتزة ثان', '2018-03-20 14:57:20', NULL, 1, 0, 4),
(5, 'منشية', '2018-03-20 14:57:20', NULL, 1, 0, 5),
(6, 'باب شرقي', '2018-03-20 14:57:20', NULL, 1, 0, 6),
(7, 'العطارين', '2018-03-20 14:57:20', NULL, 1, 0, 7),
(8, 'اللبان', '2018-03-20 14:57:20', NULL, 1, 0, 8),
(9, 'سيدي جابر', '2018-03-20 14:57:20', NULL, 1, 0, 9),
(10, 'الجمرك', '2018-03-20 14:57:20', NULL, 1, 0, 10),
(11, 'الأحداث', '2018-03-20 14:57:20', NULL, 1, 0, 11),
(12, 'محرم بك', '2018-03-20 14:57:20', NULL, 1, 0, 12),
(13, 'مينا البصل', '2018-03-20 14:57:20', NULL, 1, 0, 13),
(14, 'كرموز', '2018-03-20 14:57:20', NULL, 1, 0, 14),
(15, 'عامرية أول', '2018-03-20 14:57:20', NULL, 1, 0, 15),
(16, 'عامرية ثان', '2018-03-20 14:57:20', NULL, 1, 0, 16),
(17, 'الدخيلة', '2018-03-20 14:57:20', NULL, 1, 0, 17),
(18, 'منتزة ثالث', '2018-03-20 14:57:20', NULL, 1, 0, 3),
(19, 'برج العرب', '2018-03-20 14:57:20', NULL, 1, 0, 18),
(20, 'الميناء', '2018-03-20 14:57:20', NULL, 1, 0, 19);

-- --------------------------------------------------------

--
-- Table structure for table `main_ledger`
--

CREATE TABLE IF NOT EXISTS `main_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `main_ledger`
--

INSERT INTO `main_ledger` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'جنح', '2018-03-20 14:55:19', NULL, 1, 0),
(2, 'جنح مباني', '2018-03-20 14:55:19', NULL, 1, 0),
(3, 'جنح إقتصادية', '2018-03-20 14:55:19', NULL, 1, 0),
(4, 'إداري', '2018-03-20 14:55:19', NULL, 1, 0),
(5, 'مخالفات', '2018-03-20 14:55:19', NULL, 1, 0),
(6, 'عوارض', '2018-03-20 14:55:19', NULL, 1, 0),
(7, 'جنح أمن دولة طوارئ', '2018-03-20 14:55:19', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `overallpros`
--

CREATE TABLE IF NOT EXISTS `overallpros` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overallpros`
--

INSERT INTO `overallpros` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'شرق الكلية', '2018-03-20 14:55:58', NULL, 1, 0),
(2, 'غرب الكلية', '2018-03-20 14:55:58', NULL, 1, 0),
(3, 'سيدي جابر', '2018-03-20 14:55:58', NULL, 1, 0),
(4, 'المنتزة', '2018-03-20 14:55:58', NULL, 1, 0),
(5, 'الدخيلة و العامرية', '2018-03-20 14:55:58', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `national_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `name`, `national_id`) VALUES
(1, 'ljk', '29008080202814'),
(2, 'klj;lkj', '29008080202814'),
(3, 'kljljk', '29008090202834'),
(4, ';lk;lk', '29008090202824'),
(5, 'lkjlkjlkjlkj', '26008080202814'),
(6, ';kljlkjlkj', '25008080202814');

-- --------------------------------------------------------

--
-- Table structure for table `person_has_case`
--

CREATE TABLE IF NOT EXISTS `person_has_case` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `person_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`person_id`,`person_status_id`),
  KEY `fk_person_has_case_person1_idx` (`person_id`),
  KEY `fk_person_has_case_person_status1_idx` (`person_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `person_has_case`
--

INSERT INTO `person_has_case` (`id`, `person_id`, `case_id`, `person_status_id`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 2),
(3, 2, 2, 1),
(4, 2, 2, 2),
(5, 4, 3, 1),
(6, 4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `person_status`
--

CREATE TABLE IF NOT EXISTS `person_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `person_status`
--

INSERT INTO `person_status` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'شاكي', '2018-03-21 22:26:35', NULL, 1, 0),
(2, 'مشكو في حقة', '2018-03-21 22:26:35', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `possession`
--

CREATE TABLE IF NOT EXISTS `possession` (
  `possession_number` int(11) NOT NULL,
  `possession_year` int(11) NOT NULL,
  `case_receive_date` date DEFAULT NULL,
  `prosecutor_id` int(11) NOT NULL,
  `completion_send_date` date DEFAULT NULL,
  `completion_delegate` varchar(60) DEFAULT NULL,
  `completion_receive_date` date DEFAULT NULL,
  `prosecution_decision` varchar(45) DEFAULT NULL,
  `case_send_date` date DEFAULT NULL,
  `case_send_number` int(4) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `users_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`possession_number`,`possession_year`),
  KEY `fk_possession_prosecutor1_idx` (`prosecutor_id`),
  KEY `fk_possession_users1_idx` (`users_id`),
  KEY `fk_possession_subject1_idx` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `possession`
--

INSERT INTO `possession` (`possession_number`, `possession_year`, `case_receive_date`, `prosecutor_id`, `completion_send_date`, `completion_delegate`, `completion_receive_date`, `prosecution_decision`, `case_send_date`, `case_send_number`, `createdate`, `updatedate`, `status`, `deleted`, `users_id`, `subject_id`, `id`) VALUES
(98, 98, '2018-03-28', 2, '0000-00-00', '', '0000-00-00', '', '0000-00-00', 0, '2018-03-29 23:19:00', NULL, 1, 0, 2, 2, 1),
(786, 9786, '2018-03-22', 2, '0000-00-00', '', '0000-00-00', '', '0000-00-00', 0, '2018-03-30 12:45:50', NULL, 1, 0, 2, 2, 3),
(9098098, 98098, '2018-03-28', 1, '0000-00-00', 'asdasdasdasd', '0000-00-00', '', '0000-00-00', 0, '2018-03-30 01:09:22', NULL, 1, 0, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pros`
--

CREATE TABLE IF NOT EXISTS `pros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `overallpros_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`overallpros_id`),
  KEY `fk_pros_overallpros1_idx` (`overallpros_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `pros`
--

INSERT INTO `pros` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`, `overallpros_id`) VALUES
(1, 'رمل أول', '2018-03-20 14:56:35', NULL, 1, 0, 1),
(2, 'رمل ثان', '2018-03-20 14:56:35', NULL, 1, 0, 1),
(3, 'منتزة أول', '2018-03-20 14:56:35', NULL, 1, 0, 4),
(4, 'منتزة ثان', '2018-03-20 14:56:35', NULL, 1, 0, 4),
(5, 'منشية', '2018-03-20 14:56:35', NULL, 1, 0, 1),
(6, 'باب شرقي', '2018-03-20 14:56:35', NULL, 1, 0, 1),
(7, 'العطارين', '2018-03-20 14:56:35', NULL, 1, 0, 1),
(8, 'اللبان', '2018-03-20 14:56:35', NULL, 1, 0, 2),
(9, 'سيدي جابر', '2018-03-20 14:56:35', NULL, 1, 0, 3),
(10, 'الجمرك', '2018-03-20 14:56:35', NULL, 1, 0, 2),
(11, 'الأحداث', '2018-03-20 14:56:35', NULL, 1, 0, 2),
(12, 'محرم بك', '2018-03-20 14:56:35', NULL, 1, 0, 1),
(13, 'مينا البصل', '2018-03-20 14:56:35', NULL, 1, 0, 2),
(14, 'كرموز', '2018-03-20 14:56:35', NULL, 1, 0, 2),
(15, 'عامرية أول', '2018-03-20 14:56:35', NULL, 1, 0, 5),
(16, 'عامرية ثان', '2018-03-20 14:56:35', NULL, 1, 0, 5),
(17, 'الدخيلة', '2018-03-20 14:56:35', NULL, 1, 0, 5),
(18, 'برج العرب', '2018-03-20 14:56:35', NULL, 1, 0, 2),
(19, 'الميناء', '2018-03-20 14:56:35', NULL, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `prosecutor`
--

CREATE TABLE IF NOT EXISTS `prosecutor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prosecutor`
--

INSERT INTO `prosecutor` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'احمد الخولي', '2018-03-21 16:41:49', NULL, 1, 0),
(2, 'محسن ممتاز', '2018-03-21 16:41:49', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pros_has_users`
--

CREATE TABLE IF NOT EXISTS `pros_has_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pros_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`pros_id`,`users_id`),
  KEY `fk_pros_has_users_users1_idx` (`users_id`),
  KEY `fk_pros_has_users_pros1_idx` (`pros_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pros_has_users`
--

INSERT INTO `pros_has_users` (`id`, `pros_id`, `users_id`) VALUES
(1, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reason_to_done`
--

CREATE TABLE IF NOT EXISTS `reason_to_done` (
  `id_reason_to_done` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_reason_to_done`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `reason_to_done`
--

INSERT INTO `reason_to_done` (`id_reason_to_done`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'تحريات', '2018-07-20 00:20:17', NULL, 1, 0),
(2, 'سؤال المتهم', '2018-07-20 00:22:26', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'admin', '2018-03-21 09:51:34', NULL, 1, 0),
(2, 'رئيس نيابة', '2018-03-21 09:51:34', NULL, 1, 0),
(3, 'وكيل نيابة', '2018-03-21 09:52:28', NULL, 1, 0),
(4, 'موظف', '2018-03-21 09:52:28', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'مسكن زوجية', '2018-03-21 10:48:50', NULL, 1, 0),
(2, 'حضانة', '2018-03-21 10:48:50', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `nickname` varchar(45) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`role_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_users_role1_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nickname`, `createdate`, `updatedate`, `status`, `deleted`, `role_id`) VALUES
(2, '1', '1', 'test', '2018-03-18 10:06:25', NULL, 1, 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `case`
--
ALTER TABLE `case`
  ADD CONSTRAINT `fk_case_depart1` FOREIGN KEY (`depart_id`) REFERENCES `depart` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_case_main_ledger1` FOREIGN KEY (`main_ledger_id`) REFERENCES `main_ledger` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `case_has_investigation`
--
ALTER TABLE `case_has_investigation`
  ADD CONSTRAINT `fk_case_has_investigation_case_status1` FOREIGN KEY (`case_status_idcase_status`) REFERENCES `case_status` (`idcase_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_case_has_investigation_prosecutor1` FOREIGN KEY (`prosecutor_id`) REFERENCES `prosecutor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_case_has_investigation_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `case_has_investigation_has_charges`
--
ALTER TABLE `case_has_investigation_has_charges`
  ADD CONSTRAINT `fk_case_has_investigation_has_charges_charges1` FOREIGN KEY (`charges_id_charges`) REFERENCES `charges` (`id_charges`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `case_has_investigation_has_reason_to_done`
--
ALTER TABLE `case_has_investigation_has_reason_to_done`
  ADD CONSTRAINT `fk_case_has_investigation_has_reason_to_done_reason_to_done1` FOREIGN KEY (`reason_to_done_id_reason_to_done`) REFERENCES `reason_to_done` (`id_reason_to_done`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `case_has_possession`
--
ALTER TABLE `case_has_possession`
  ADD CONSTRAINT `fk_case_has_possession_possession1` FOREIGN KEY (`possession_possession_number`, `possession_possession_year`) REFERENCES `possession` (`possession_number`, `possession_year`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `depart`
--
ALTER TABLE `depart`
  ADD CONSTRAINT `fk_depart_pros` FOREIGN KEY (`pros_id`) REFERENCES `pros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `person_has_case`
--
ALTER TABLE `person_has_case`
  ADD CONSTRAINT `fk_person_has_case_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_person_has_case_person_status1` FOREIGN KEY (`person_status_id`) REFERENCES `person_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `possession`
--
ALTER TABLE `possession`
  ADD CONSTRAINT `fk_possession_prosecutor1` FOREIGN KEY (`prosecutor_id`) REFERENCES `prosecutor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_possession_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_possession_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pros`
--
ALTER TABLE `pros`
  ADD CONSTRAINT `fk_pros_overallpros1` FOREIGN KEY (`overallpros_id`) REFERENCES `overallpros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pros_has_users`
--
ALTER TABLE `pros_has_users`
  ADD CONSTRAINT `fk_pros_has_users_pros1` FOREIGN KEY (`pros_id`) REFERENCES `pros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pros_has_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
