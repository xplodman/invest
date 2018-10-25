-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2018 at 04:35 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cj_investigation`
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
  KEY `fk_case_main_ledger1_idx` (`main_ledger_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case`
--

INSERT INTO `case` (`id`, `createdate`, `updatedate`, `status`, `deleted`, `depart_id`, `main_ledger_id`, `case_number`, `case_year`) VALUES
(1, '2018-10-11 09:59:18', NULL, 1, 0, 2, 1, 897, 987),
(2, '2018-10-11 10:03:06', NULL, 1, 0, 2, 2, 987, 897),
(4, '2018-10-11 10:03:38', NULL, 1, 0, 2, 2, 6666, 897),
(3, '2018-10-11 10:03:21', NULL, 1, 0, 2, 2, 7777, 897);

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
  `notes` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`investigation_number`,`investigation_year`),
  KEY `fk_case_has_investigation_case_status1_idx` (`case_status_idcase_status`),
  KEY `fk_case_has_investigation_users1_idx` (`users_id`),
  KEY `fk_case_has_investigation_prosecutor1_idx` (`prosecutor_id`),
  KEY `fk_case_has_investigation_case1_idx` (`case_id`),
  KEY `id` (`id_case_has_investigation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case_has_investigation`
--

INSERT INTO `case_has_investigation` (`id_case_has_investigation`, `investigation_number`, `investigation_year`, `case_id`, `case_status_idcase_status`, `users_id`, `prosecutor_id`, `createdate`, `updatedate`, `status`, `deleted`, `notes`) VALUES
(1, 897, 897, 1, 1, 2, 1, '2018-10-11 09:59:18', '2018-10-17 11:52:28', 1, 0, ''),
(2, 89987, 897, 2, 2, 2, 2, '2018-10-11 10:03:06', '2018-10-11 15:38:25', 1, 0, ''),
(4, 7678687, 77, 4, 2, 2, 2, '2018-10-11 10:03:38', '2018-10-11 12:04:14', 1, 0, ''),
(3, 7678687, 897, 3, 2, 2, 2, '2018-10-11 10:03:21', '2018-10-11 12:25:19', 1, 0, '');

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
  KEY `fk_case_has_investigation_has_charges_charges1_idx` (`charges_id_charges`),
  KEY `fk_case_has_investigation_has_charges_case_has_investigatio_idx` (`case_has_investigation_id_case_has_investigation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case_has_investigation_has_charges`
--

INSERT INTO `case_has_investigation_has_charges` (`case_has_investigation_id_case_has_investigation`, `charges_id_charges`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_charges_id`) VALUES
(4, 41, '2018-10-11 12:04:14', NULL, 1, 0, 1),
(3, 4, '2018-10-11 12:25:19', NULL, 1, 0, 25),
(3, 5, '2018-10-11 12:25:19', NULL, 1, 0, 26),
(2, 1, '2018-10-11 15:38:25', NULL, 1, 0, 113),
(2, 2, '2018-10-11 15:38:25', NULL, 1, 0, 114),
(1, 3, '2018-10-17 11:52:28', NULL, 1, 0, 121),
(1, 6, '2018-10-17 11:52:28', NULL, 1, 0, 122);

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
  KEY `fk_case_has_investigation_has_reason_to_done_reason_to_done_idx` (`reason_to_done_id_reason_to_done`),
  KEY `fk_case_has_investigation_has_reason_to_done_case_has_inves_idx` (`case_has_investigation_id_case_has_investigation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `case_has_investigation_has_reason_to_done`
--

INSERT INTO `case_has_investigation_has_reason_to_done` (`case_has_investigation_id_case_has_investigation`, `reason_to_done_id_reason_to_done`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_reason_to_done_id`) VALUES
(4, 1, '2018-10-11 12:04:14', NULL, 1, 0, 1),
(4, 2, '2018-10-11 12:04:14', NULL, 1, 0, 2),
(1, 1, '2018-10-17 11:52:28', NULL, 1, 0, 1);

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
  `owner_id` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_charges`,`owner_id`,`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id_charges`, `name`, `createdate`, `updatedate`, `status`, `deleted`, `owner_id`, `admin_id`) VALUES
(1, 'ابتزاز', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(2, 'اتلاف', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(3, 'اجهاض', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(4, 'احتجاز بدون وجه حق', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(5, 'اختلاس مال عام', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(6, 'اخفاء اشياء مسروقة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(7, 'ادارة منشئة للتصنيع السلاح', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(8, 'استعمال قسوة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(9, 'استيلاء', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(10, 'اصابة خطا', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(11, 'اصابة متهم', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(12, 'اضراب عن العمل ', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(13, 'اضرار مال عام', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(14, 'اغتصاب', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(15, 'اكراه علي توقيع', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(16, 'الاتجار في المواد المخدرة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(17, 'الاتجار في المواد المخدرة وتزيف عملة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(18, 'انتحار', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(19, 'انتحال صفة ', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(20, 'انضمام الي جماعه محظورة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(21, 'اهمال شركة مياة الشرب', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(22, 'اهمال طبي', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(23, 'بطلجة ', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(24, 'تبديد', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(25, 'تحرش', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(26, 'تربح', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(27, 'تزوير', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(28, 'تزيف عملة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(29, 'تشهير', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(30, 'تشهير عن طريق الانترنت', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(31, 'تظاهر', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(32, 'تعاطي مواد مخدرة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(33, 'تعدي بالضرب ', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(34, 'تعدي جنسي ', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(35, 'تعدي علي أطفال بالدار', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(36, 'تعدي علي موظف عام', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(37, 'جرائم انتخابية', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(38, 'حريق', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(39, 'حيازة سلعة تمونية ', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(40, 'خطف', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(41, 'دعارة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(42, 'رشوة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(43, 'زنا', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(44, 'سب وقذف', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(45, 'سرقة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(46, 'سرقة بالاكراه', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(47, 'سرقة دواب', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(48, 'سرقة سيارة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(49, 'سرقة كابلات', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(50, 'سرقة مهمات', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(51, 'سرقة مواد بترولية', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(52, 'سرقة هاتف', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(53, 'سلاح ابيض واحداث اصابة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(54, 'سلاح أبيض وتعاطي حشيش', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(55, 'سلاح ناري', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(56, 'سلاح ناري وبلطجة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(57, 'سلاح ناري وذخيرة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(58, 'شروع في سرقة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(59, 'شروع في سرقة بالاكراه', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(60, 'شروع في قتل', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(61, 'شروع في قتل و سلاح ناري', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(62, 'شروع في هتك عرض', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(63, 'شكوي مستشار / تهديد', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(64, 'ضرب', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(65, 'ضرب افضي الي موت', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(66, 'ضرب واحداث اصابة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(67, 'طرح أغذية منتهية الصلاحية ( غش تجاري )', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(68, 'عاهه', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(69, 'عثور علي سيارة ', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(70, 'عدوان علي مال العام', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(71, 'فعل فاضح ومواد مخدرة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(72, 'قتل', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(73, 'قتل خطا وهتك عرض', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(74, 'مادة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(75, 'مشاجره', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(76, 'مقاومة سلطات', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(77, 'مقاومة سلطات وتمكين من الهرب', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(78, 'مواد مخدرة ومقامة سلطات', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(79, 'نصب', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(80, 'نصب واحتيال', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(81, 'نصب وسرقة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(82, 'هتك عرض', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(83, 'وفاة', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(84, 'وفاة مسجون', '2018-10-11 12:04:01', NULL, 1, 0, 0, 0),
(85, 'asdasd', '2018-10-16 00:30:24', NULL, 0, 0, 2, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

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
(20, 'الميناء', '2018-03-20 14:57:20', NULL, 1, 0, 19),
(22, 'اللبان 2', '2018-10-07 16:55:03', NULL, 1, 0, 8);

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
  `pros_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`pros_id`),
  KEY `fk_prosecutor_pros1_idx` (`pros_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prosecutor`
--

INSERT INTO `prosecutor` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`, `pros_id`) VALUES
(1, 'محسن ممتاز', '2018-10-11 09:30:52', '2018-10-16 02:06:22', 1, 0, 2),
(2, 'احمد محمد', '2018-10-11 09:30:52', NULL, 1, 0, 2),
(3, 'حسان', '2018-10-16 01:36:36', '2018-10-16 02:06:05', 1, 0, 2);

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
(1, 2, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reason_to_done`
--

INSERT INTO `reason_to_done` (`id_reason_to_done`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES
(1, 'تحريات', '2018-07-20 00:20:17', NULL, 1, 0),
(2, 'سؤال المتهم', '2018-07-20 00:22:26', NULL, 1, 0),
(3, 'فثسف', '2018-10-16 02:16:57', NULL, 0, 0),
(4, 'معمل', '2018-10-16 02:17:42', NULL, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nickname`, `createdate`, `updatedate`, `status`, `deleted`, `role_id`) VALUES
(2, '1', '1', 'أحمد عبد الهادي', '2018-03-18 10:06:25', NULL, 1, 0, 2),
(4, '2', '2', 'admin', '2018-10-17 09:46:28', NULL, 1, 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `case`
--
ALTER TABLE `case`
  ADD CONSTRAINT `fk_case_depart1` FOREIGN KEY (`depart_id`) REFERENCES `depart` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_case_main_ledger1` FOREIGN KEY (`main_ledger_id`) REFERENCES `main_ledger` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `case_has_investigation`
--
ALTER TABLE `case_has_investigation`
  ADD CONSTRAINT `fk_case_has_investigation_case1` FOREIGN KEY (`case_id`) REFERENCES `case` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_case_has_investigation_case_status1` FOREIGN KEY (`case_status_idcase_status`) REFERENCES `case_status` (`idcase_status`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_case_has_investigation_prosecutor1` FOREIGN KEY (`prosecutor_id`) REFERENCES `prosecutor` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_case_has_investigation_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `case_has_investigation_has_charges`
--
ALTER TABLE `case_has_investigation_has_charges`
  ADD CONSTRAINT `charges` FOREIGN KEY (`charges_id_charges`) REFERENCES `charges` (`id_charges`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_case_has_investigation_has_charges_case_has_investigation1` FOREIGN KEY (`case_has_investigation_id_case_has_investigation`) REFERENCES `case_has_investigation` (`id_case_has_investigation`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `case_has_investigation_has_reason_to_done`
--
ALTER TABLE `case_has_investigation_has_reason_to_done`
  ADD CONSTRAINT `fk_case_has_investigation_has_reason_to_done_case_has_investi1` FOREIGN KEY (`case_has_investigation_id_case_has_investigation`) REFERENCES `case_has_investigation` (`id_case_has_investigation`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reason` FOREIGN KEY (`reason_to_done_id_reason_to_done`) REFERENCES `reason_to_done` (`id_reason_to_done`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pros`
--
ALTER TABLE `pros`
  ADD CONSTRAINT `fk_pros_overallpros1` FOREIGN KEY (`overallpros_id`) REFERENCES `overallpros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pros_depart1` FOREIGN KEY (`id`) REFERENCES `depart` (`pros_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `prosecutor`
--
ALTER TABLE `prosecutor`
  ADD CONSTRAINT `fk_prosecutor_pros1` FOREIGN KEY (`pros_id`) REFERENCES `pros` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
