-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- 主機: db
-- 產生時間： 2018 年 09 月 20 日 16:56
-- 伺服器版本: 10.2.15-MariaDB-10.2.15+maria~jessie
-- PHP 版本： 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `prdc2018`
--

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `firstname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `affiliation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_type` int(11) NOT NULL,
  `member_num` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paper_type` int(11) DEFAULT NULL,
  `paper_add_pages` int(11) DEFAULT 0,
  `department` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mealtype` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banquet_tickets` int(11) NOT NULL,
  `visa_nation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` text NOT NULL,
  `birth` text NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT 0,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `esun_payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `ref_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=316 DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `orders`
--

INSERT INTO `orders` (`id`, `title`, `firstname`, `lastname`, `affiliation`, `email`, `reg_type`, `member_num`, `paper_id`, `paper_title`, `paper_type`, `paper_add_pages`, `department`, `job`, `address`, `address2`, `address3`, `zipcode`, `city`, `country`, `phone`, `mealtype`, `banquet_tickets`, `visa_nation`, `passport`, `place`, `issue`, `expiration`, `birth`, `amount`, `payment_method`, `paid`, `transaction_time`, `esun_payment_id`, `payment_confirmed`, `ref_token`, `invalid`, `remark`, `updated_at`, `created_at`) VALUES
(272, 0, 'Yusung', 'Wu', 'National Chiao Tung University', 'ysw@nctu.edu.tw', 0, '1234567', '500', 'This is  a test paper', NULL, 0, '資工系', 'マネージャー', '大学路1001號', '工程三館', '', '300', 'Hsinchu', 'Taiwan', '+886 975225901', 'Vegetarian', 4, 'Canada', '6545654646', '', '', '', '', 29000, 0, 0, NULL, NULL, 0, '00c9f1d5a616', 1, NULL, '2018-09-18 08:36:47', '2018-05-19 02:08:49'),
(274, 0, 'Yusung', 'Wu', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 0, '54545454', '535', 'This is a test paper', NULL, 0, 'Computer Science', 'Associate Professor', '1001 University Rd', '', '', '300', 'Hsinchu', 'Taiwan', '+886 975225901', 'Any', 0, '', '', '', '', '', '', 19, 0, 0, NULL, NULL, 0, 'fb50af23de77b96f', 1, NULL, '2018-09-18 08:34:03', '2018-05-20 14:51:08'),
(275, 0, 'Hello', 'Lin', 'NCTU', 'ysw@cs.nctu.edu.tw', 3, '', '', '', NULL, 0, '', 'Professor', '12312 University Rd', '', '', '333', 'sdfsdfs', 'Bolivia', '5754545454', 'Any', 0, '', '', '', '', '', '', 16, 0, 0, NULL, NULL, 0, 'f86e7abd1d0f14c6', 1, NULL, '2018-09-18 08:34:05', '2018-05-20 14:53:20'),
(278, 0, 'Yusung', 'Wu', 'National Chiao Tung University', 'yswu@livemail.tw', 2, '1234567', '56', 'This is  a test paper !!!', NULL, 0, 'Computer Science', 'Associate professor', '1001 University Rd', 'Engineering Building III', 'Room 429', '300', 'Hsinchu', 'Taiwan', '+886 975225901', 'Any', 2, 'Anguilla', '987654321', 'Taipei', '1980-01-01', '2020-08-02', '1980-01-01', 18, 0, 0, NULL, NULL, 0, '32fae159669c43c3', 1, NULL, '2018-09-18 08:34:07', '2018-05-26 10:10:59'),
(279, 0, 'John', 'Clinton', 'NTHU', 'ysw@cs.nctu.edu.tw', 0, '123123', '', '', NULL, 0, 'Electrical Engineering', 'Assistant Professor', '1000 Kung Fu Rd', 'Engineering Building 5', 'Room 5', '308', 'Taipei', 'Taiwan', '12312312312', 'Any', 0, '', '', '', '', '', '', 19, 0, 0, '2018-06-04 15:28:13', 'dl3FgDLi4089vAvm7Gxk', 0, 'f8413bf9e2e325ee', 1, NULL, '2018-09-18 08:34:10', '2018-05-26 15:09:13'),
(281, 4, 'Yu-Sung', 'Wu', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 0, '1234567', '100', 'This is a test paper', NULL, 0, 'Computer Science', 'Associate professor', '1001 University Rd', 'Engineering Building III', 'Room 429', '300', 'Hsinchu', 'Taiwan', '0975225901', 'Muslim', 1, '', '', '', '', '', '', 22, 0, 1, '2018-06-04 15:28:13', 'dl3FgDLi4089vAvm7Gxk', 0, '6ca563fc55078a68', 1, NULL, '2018-09-18 08:34:11', '2018-06-04 15:11:48'),
(284, 0, 'e', 'e', 'e', 'willylu.cs06g@nctu.edu.tw', 0, 'e', '', '', NULL, 0, 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'Ecuador', 'e', 'Any', 0, '', '', '', '', '', '', 19, 0, 1, '2018-06-04 15:28:13', NULL, 0, 'ee5943e1fff6aa20', 1, NULL, '2018-09-18 08:34:12', '2018-06-08 07:33:51'),
(285, 5, 'Strange', 'Lin', 'National Tsing Hua University', 'hankwu@g2.nctu.edu.tw', 0, '9876543', '500', 'A Study on the Implementation of Virtual Machine Device Models for ARM SoC Platforms', NULL, 0, 'Chemestry', 'Professor', '100 Kung Fu Rd', 'EE Bldg', '', '408', 'Taipei City', 'Taiwan', '975225901', 'Vegetarian', 0, 'Bhutan', '77777', 'Earth', '2009-05-05', '2020-08-01', '1970-01-01', 19, 0, 1, '2018-06-11 15:22:30', 'cmjNhcWKrhaLcsAz8ziq', 0, '62085e4e3521ead1', 1, NULL, '2018-09-18 08:34:15', '2018-06-11 15:09:39'),
(289, 2, 'TEstName', 'TestFirstName', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 0, '1234567', '100', 'Quantum Physics', NULL, 0, 'Electrical Engineering', 'Assistent Professor', '123 Chung Hua Rd', 'Room 3', '', '2000', 'Taipei', 'Switzerland', '7654900700', 'Vegetarian', 3, 'Bermuda', '2324342', 'Taipei', '1977-01-01', '1999-09-09', '1966-01-01', 27, 0, 0, NULL, NULL, 0, '433af7c99add6b9e', 1, NULL, '2018-09-18 08:34:17', '2018-06-23 20:46:11'),
(290, 3, 'Linda', 'Xi', 'NTHU', 'yswu@livemail.tw', 1, '', '', '', NULL, 0, '', 'Professor', '123 University Rd', 'Room 8', '', '302', 'Hualien', 'Bermuda', '56564454', 'Any', 0, '', '', '', '', '', '', 23, 1, 0, NULL, NULL, 0, '8b06ff23414884ab', 1, NULL, '2018-09-18 08:34:19', '2018-06-23 20:52:48'),
(291, 0, 'John', 'Coh', 'Academia Sinica', 'wu.yusung@gmail.com', 8, '', '', '', NULL, 0, 'Chemical Engineering', 'Student', '1212 Xininyu Ro', 'Bldg 3', '212', '121212', 'taipeitt', 'Taiwan', '76213721653', 'Any', 0, '', '', '', '', '', '', 20, 1, 0, NULL, NULL, 0, '0763baffa73c8e9d', 1, NULL, '2018-09-18 08:34:20', '2018-06-23 21:16:15'),
(292, 0, 'Yu-Sung', 'Wu', 'Test', 'ysw@cs.nctu.edu.tw', 0, '12312312', '', '', NULL, 0, '', 'TTT', '23123', '', '', '123123', '12312', 'Bhutan', '3123123123', 'Any', 0, '', '', '', '', '', '', 19000, 1, 0, NULL, NULL, 0, '8d9c29a052907f05', 1, NULL, '2018-09-18 08:34:22', '2018-08-11 15:26:16'),
(293, 3, 'Linda', 'Cho', 'NTHU', 'ysw@cs.nctu.edu.tw', 2, '5646456456', '', '', NULL, 0, '', 'N/A', '1001 University Rd', 'Engineering Bldg. III', '', '300', 'Hsinchu', 'Taiwan', '0975225901', 'Any', 0, '', '', '', '', '', '', 13000, 0, 0, NULL, NULL, 0, '85e6298c4a62119b', 1, NULL, '2018-09-18 08:34:24', '2018-08-27 15:32:06'),
(294, 2, 'Yu-Sung', 'Nick', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 3, '', '57', 'nonono', NULL, 0, '', 'TTT', '1001 University Rd', 'Engineering Bldg. III', '', '300', 'Hsinchu City', 'Taiwan', '0975225901', 'Any', 5, '', '', '', '', '', '', 28500, 0, 0, NULL, NULL, 0, 'b49c7e03f6f12c40', 1, NULL, '2018-09-18 08:34:28', '2018-08-27 15:43:28'),
(295, 0, 'Yu-Sung', 'Yu-Sung', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 7, '12312312', '', '', NULL, 0, '', 'TTT', '1001 University Rd', 'Engineering Bldg. III', '', '300', 'Hsinchu City', 'Taiwan', '0975225901', 'Vegetarian', 0, '', '', '', '', '', '', 16000, 1, 0, NULL, NULL, 0, '915444d79b5a2342', 1, NULL, '2018-09-18 08:34:41', '2018-08-27 15:46:46'),
(296, 5, '育松', '吳', '交通大學', 'yswu@livemail.tw', 0, '1234567', '44', 'this is a paper', NULL, 0, '資訊工程學系', '副教授', '大學路1001號', '', '', '30841', '新竹市', 'South Korea', '0975225901', 'Vegetarian', 2, 'Anguilla', '233333', 'earth', '0001-01-01', '0001-02-03', '0003-02-01', 24000, 1, 0, NULL, NULL, 0, 'b5b71443428b3f4f', 1, NULL, '2018-09-18 08:34:44', '2018-08-31 04:30:55'),
(297, 0, 'Final Test', '測試測試', 'NTU', 'YSW@CS.NCTU.EDU.TW', 4, '1234567', '', '', NULL, 0, 'PHYSICS', 'DEAN', '1234 ABC', '', '', '111', 'TAIPEI', 'Benin', '213123', 'Any', 0, '', '', '', '', '', '', 13000, 1, 0, NULL, NULL, 0, 'da03cb72f4d710f4', 1, NULL, '2018-09-18 08:34:52', '2018-09-07 05:09:37'),
(298, 5, 'Jin', 'Hong', 'University of Western Australia', 'jin.hong@uwa.edu.au', 0, '92638378', '15', 'Evaluating the Security of IoT Networks with Mobile Devices', NULL, 0, '', 'Lecturer', 'M002, 35 Stirling Highway', 'Crawley', '', '6009', 'Perth', 'Australia', '+61864882796', 'Any', 0, '', '', '', '', '', '', 19000, 0, 1, '2018-09-11 07:44:58', 'lnuTdWAEg7L7zXKKJGCa', 1, 'b4b8bf9fb3b14bf5', 0, NULL, '2018-09-18 08:31:59', '2018-09-10 04:20:28'),
(305, 0, 'Yu-Sung Test', 'Wu Test', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 1, '', '57', 'hahaha', 1, 1, '', 'TTT', '1001 University Rd', 'Engineering Bldg. III', '', '300', 'Hsinchu City', 'Taiwan', '975225901', 'Any', 2, '', '', '', '', '', '', 31200, 0, 0, NULL, NULL, 0, '5f2885b5d61543ee', 1, NULL, '2018-09-18 08:36:00', '2018-09-10 13:16:25'),
(306, 0, 'Simin', 'Cai', 'Mälardalen University', 'simin.cai@mdh.se', 0, '93617480', '34', 'Specification and Formal Verification of Atomic Concurrent Real-Time Transactions', 1, 1, '', 'PhD Student', 'Box 883, Högskoleplan 1', '', '', '72123', 'Västerås', 'Sweden', '004621107071', 'Any', 0, 'China', 'EB1640111', 'HUNAN', '2018-01-11', '2028-01-10', '1988-09-07', 22200, 0, 1, '2018-09-12 07:50:24', 'CZ7QbtsP619nAUJQUaJT', 1, 'c568a95349762b62', 0, NULL, '2018-09-18 08:31:53', '2018-09-12 07:48:08'),
(307, 0, 'Angelos', 'Oikonomopoulos', 'Vrije Universiteit Amsterdam', 'a.oikonomopoulos@vu.nl', 1, '', '10', 'On the effectiveness of code normalization for function identification', 1, 0, '', 'PhD Student', 'Moislinger Allee 112a', '', '', '23558', 'Luebeck', 'Germany', '+4917657645997', 'Vegetarian', 0, '', '', '', '', '', '', 23000, 0, 1, '2018-09-14 21:21:59', 'S17HoJO1JH3OSss37eGk', 1, '9d841bd87d532942', 0, NULL, '2018-09-18 08:31:48', '2018-09-14 21:17:01'),
(308, 0, 'Venu Babu', 'Thati', 'KU Leuven', 'venubabu.thati@kuleuven.be', 0, '93992219', '9', 'An Improved Data Error Detection Technique for Dependable Embedded Software', 1, 0, 'Computer Science', 'PhD student', 'Spoorwegstraat 12', 'KU Leuven Campus Brugge', '', '8200', 'Brugge - Sint- Michiels', 'Belgium', '+32 465500165', 'Any', 0, 'India', 'J2830103', 'Thativaripalem, India', '2011-01-06', '2021-01-05', '1990-03-06', 19000, 0, 0, NULL, NULL, 0, '55ca99697a99dc6a', 0, NULL, '2018-09-15 14:44:42', '2018-09-15 14:44:42'),
(309, 0, 'Venu Babu', 'Thati', 'KU Leuven', 'venubabu.thati@kuleuven.be', 0, '93992219', '9', 'An Improved Data Error Detection Technique for Dependable Embedded Software', 1, 0, 'Computer Science', 'PhD student', 'Spoorwegstraat 12', 'KU Leuven Campus Brugge', '', '8200', 'Brugge - Sint- Michiels', 'Belgium', '+32 465500165', 'Any', 0, 'India', 'J2830103', 'Thativaripalem, India', '2011-01-06', '2021-01-05', '1990-03-06', 19000, 0, 1, '2018-09-15 14:50:52', '6hpdnCzdaAuVg5l50KbL', 1, '66f7c144d82a1d03', 0, NULL, '2018-09-18 08:31:41', '2018-09-15 14:48:14'),
(310, 0, 'Tommaso', 'Zoppi', 'University of Florence', 'tommaso.zoppi@unifi.it', 1, '', '21', 'On Algorithms Selection for Unsupervised Anomaly Detection', 1, 0, 'Department of Mathematics and Informatics', 'Post-Doc Researcher', 'Viale Morgagni 65, Florence, Italy', '', '', '50134', 'Florence', 'Italy', '0552751483', 'Any', 0, '', '', '', '', '', '', 23000, 0, 1, '2018-09-17 09:52:42', 'b4Cj7AMSEFnCV9ppmwdj', 1, '97590be543d4b886', 0, NULL, '2018-09-18 08:31:33', '2018-09-17 09:46:40'),
(311, 1, 'Carmen', 'Cheh', 'University of Illinois at Urbana-Champaign', 'cheh2@illinois.edu', 3, '', '', '', NULL, 0, 'Computer Science', 'Student', '201 N. Goodwin Ave.', '', '', '61801', 'Urbana', 'United States', '217-550-5952', 'Any', 0, '', '', '', '', '', '', 16000, 0, 0, NULL, NULL, 0, 'dda1a1a3f1fa559d', 0, NULL, '2018-09-17 16:54:47', '2018-09-17 16:54:47'),
(312, 0, 'Zhengguo', 'Yang', 'Japan Advanced Institute of Science and Technology', 'yangzg@jaist.ac.jp', 1, '', '11', 'Modeling the Required Indoor Temperature Change by Hybrid Automata for Detecting Thermal Problems', 1, 0, '', 'Researcher', '1-1 Asahidai, Nomi, Ishikawa, Japan', '', '', '923-1292', 'Nomi', 'Japan', '08042504705', 'Any', 0, 'China', 'G43769925', 'Henan', '2010-07-20', '2020-07-19', '1983-07-19', 23000, 0, 1, '2018-09-18 02:54:08', 'DgE0uT50FWY6MD4aTz7E', 1, 'f19b1551292c4d92', 0, NULL, '2018-09-18 08:31:21', '2018-09-18 02:45:01'),
(313, 0, 'Nicolas', 'Coppik', 'TU Darmstadt', 'nicolas.coppik@googlemail.com', 0, '92314741', '25', 'FastFI: Accelerating Software Fault Injections', 1, 0, '', 'PhD Student', 'Hochschulstr. 10', '', '', '64289', 'Darmstadt', 'Germany', '+4917675003968', 'Any', 0, '', '', '', '', '', '', 19000, 0, 1, '2018-09-18 09:16:59', 'VC6EKOWqP7mT8RoMBHX9', 0, '0f0bd37bd5f852e6', 0, NULL, '2018-09-18 09:16:59', '2018-09-18 09:11:46'),
(314, 1, 'Tsvetoslava', 'Vateva-Gurova', 'Technische Universität Darmstadt', 'vateva@deeds.informatik.tu-darmstadt.de', 0, '95142936', '17', 'InfoLeak: Scheduling-based Information Leakage', 1, 0, 'CS Dept. ', 'Research Assistant', 'Hochschulstr. 10', '', '', '64289', 'Darmstadt', 'Germany', '004917655471660', 'Any', 0, '', '', '', '', '', '', 19000, 0, 1, '2018-09-18 09:20:57', 'pNmadL92sXkJhuYq51Nm', 0, 'e230202035c476fa', 0, NULL, '2018-09-18 09:20:57', '2018-09-18 09:13:33'),
(315, 1, 'Carmen', 'Cheh', 'University of Illinois at Urbana-Champaign', 'cheh2@illinois.edu', 3, '', '', '', NULL, 0, 'Computer Science', 'Student', '201 N. Goodwin Ave.', '', '', '61801', 'Urbana', 'United States', '217-550-5952', 'Any', 0, '', '', '', '', '', '', 16000, 0, 0, NULL, NULL, 0, '57871392db3e0559', 0, NULL, '2018-09-20 13:39:24', '2018-09-20 13:39:24');

-- --------------------------------------------------------

--
-- 資料表結構 `r_rqid_ono`
--

CREATE TABLE IF NOT EXISTS `r_rqid_ono` (
  `rqid` int(11) DEFAULT NULL,
  `ono` varchar(20) DEFAULT NULL,
  `rc` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `r_rqid_ono`
--

INSERT INTO `r_rqid_ono` (`rqid`, `ono`, `rc`) VALUES
(263, 'yBnt67PcBF31fJFLkxWU', NULL),
(263, 'zFx0Q1Y8jdLvGTURiKq0', NULL),
(263, 'GiaC0I87eqnSz6Ta4On9', NULL),
(263, '93pq2sno6ulyE8VQ7sqf', NULL),
(263, 'ANGMBzWoYazdeDoxrBgS', NULL),
(263, 'slLEBzVYenpaRbFeqnfo', NULL),
(263, 'CWRpZtkEiEjteIDMKgEA', NULL),
(263, 'XGIz8Mckw9Edp4KzgjV6', NULL),
(263, 'BtpGu1M9YiaVgTMaLffi', NULL),
(263, 'LyFbCgs9CnD4NwFdwlrf', NULL),
(263, 'ceUSGLJfxMCHgnCtLYT7', NULL),
(263, 'Hj2IS44BO72RTsX2fUwf', NULL),
(263, 'SXt2qSybyEXurDkeQfzV', NULL),
(263, 'Cl8jxWBBK6gV4oqVSUPj', NULL),
(263, '9SDlJO7nld20LAq1MxdB', NULL),
(264, 'Xk2nDUHFMSoozcjb7aSj', NULL),
(264, 'HvLikoo1wBsadGWvVOus', NULL),
(264, 'YnTREuIEU900R5qTyDCE', NULL),
(264, 'Y7sWYY6QNwASQ3nvAiHl', NULL),
(264, 'RLZ57cS8OS6y1D23HCPL', NULL),
(267, '2Esy408YNTi9HWLAqRtL', NULL),
(267, 'WYWzssEZlhAYzflPPpCT', NULL),
(267, 'Tjs6TAoeD4DHVdwf4Vjx', NULL),
(267, 'y8LG5CB0WC1kfl5Tx7hh', NULL),
(267, 'W7Smx6NOuGy1PpRNdDtW', NULL),
(267, 'lfsXv9uAjlQ5iyn1Vk4V', NULL),
(267, 'cdWYeKdtkObpSbjHiG2t', NULL),
(266, 'zmwuCw8ykQV50wgVhS5q', NULL),
(266, 'rQklLwaqGsjq5QnhmxDg', NULL),
(267, '8oA0VLFUb64CMuW8H4ka', NULL),
(267, '0wopFKfwQ8hA0kTPspox', NULL),
(267, 'E0WBpco4hOyVWSGHuHhJ', NULL),
(266, 'w1gtYGLfb2NkT4oebl23', NULL),
(268, 'mSlMfoXHSMof0lRFne9s', NULL),
(266, 'NijrSlMs3F7mWJoYsJNS', NULL),
(268, '84dNv6yobX8fGswf0npz', NULL),
(268, '1s38XfHQPSFI4lwgdP30', NULL),
(268, 'xvJE8MTQs7bJYGsFbeXz', NULL),
(268, 'LXhW9ZBuTY3CHUOngCNV', NULL),
(268, 'MapdtLg8Y0teT1IgCwKw', NULL),
(268, 'L9xeF06goo8C4IFxkWHd', NULL),
(269, 'FqZ8QIxxyPyOfIuM8scG', NULL),
(269, 'IGpYpktbSuW8k89TJ2XW', NULL),
(267, '6Ry1K6zUPFm3JJFq91gk', NULL),
(267, 'tTYj57rspxCPL5vvUC1e', NULL),
(267, '1M0dI7Rj6AUupLiBlpAL', NULL),
(266, 'n8bWfnNAamapQ6pVjXTg', NULL),
(266, 'OH91MzsTvIGaDOmb438K', NULL),
(271, 'Qnh4Ko9yXILMj1ObdVvj', NULL),
(263, 'zc18QwA9AikMqqdBPTuO', NULL),
(271, 'FXmr6kVvIGtFP8Dv3rqv', NULL),
(271, 'jMxw0OSAj78eiW8oByIN', NULL),
(271, 'FeEYuBGnluJpDDOkh88y', NULL),
(266, 'bnsSYKfnGncH7YqXpR6R', NULL),
(272, '122jrGJSNwzr9L04ponl', NULL),
(272, '9KlcCLkK3oozjiVJq5Hn', NULL),
(266, 'xjuaA2f5G39LaDyRH49d', NULL),
(273, 'j1p2Kn4QjDZNAd5UkXwL', NULL),
(272, 'nPXdh1twWMJgRrh49x3J', NULL),
(274, 'pdZYOzQcQPjTnEQLeCax', NULL),
(275, 'lOLEdj3JNRNVGWqCx6vf', NULL),
(273, 'qa1jNKnMHuFZrxGAU5uy', NULL),
(266, 'knOpb08Vb9nbttTITAYk', NULL),
(273, 'PgC4n1uanvbHfhVPeURC', NULL),
(273, 'xTtU6xPVvom7WUBFkZqS', NULL),
(273, '1N24QWn1uwSfSOpYRyH3', NULL),
(273, 'vQIXC7OXADfFMQzFMCZf', NULL),
(277, 'ld36bioagwhoqdN7xryv', NULL),
(278, 'hbJbt2iLPtM4gMQ2NnKn', NULL),
(279, 'QvvFpSNF6dk3Ga8tEXbA', NULL),
(278, 'CfE04POx7cFet5mRjGGo', NULL),
(278, 'L6UOscd50JuhdK7tkAMW', NULL),
(278, 'Gt4bXohj5cikmSbbRfdK', NULL),
(278, 'ihAOFf2gIm9dHRgkrgHc', NULL),
(280, 't9qNkAJR0dZtxKVa55ka', NULL),
(280, 'oN76cOd8VUjN36g6FWjy', NULL),
(280, '2Urqaj0BNflSaqhID2PY', NULL),
(280, 'ddgHbUMX0ll78CdTEg9K', NULL),
(280, 'FJpKE0Z6wJilN3gNF52a', NULL),
(280, 'afUIEgEZMtbQNkEo9Xtp', NULL),
(280, 'ZeXTxwnhnNpvHMBrA39I', NULL),
(281, 'dl3FgDLi4089vAvm7Gxk', NULL),
(281, 'bXCufwJvxJUQjtRxN8D3', NULL),
(281, 'uD2MlgCS4AF6uPo0tjzp', NULL),
(282, 'kzENpL7yJRuCsTlGgtvy', NULL),
(282, 'gg9Q0q4YHIoZiVyJOAD0', NULL),
(282, 'eKGuys2T5kS0SwYdBqG6', NULL),
(282, 'rdg0QkxQxfgeLtoZdfFm', NULL),
(282, 'HWyetK3LnCMyRr86BBMU', NULL),
(282, 'U7PHB8WZDHcR84C2oTdn', NULL),
(281, 'GkrmOtkPdCHkM3yGydpN', NULL),
(281, 'yXA6aueO5l0LIKHOq0yc', NULL),
(281, 'BFe2cZc8BeyEVHKeHpdf', NULL),
(281, 'V9Njy2zqyS4UIwDrNeVI', NULL),
(279, 'PLmum4MS552mN2LHaoTM', NULL),
(279, 'MQ0iEu6cqNJNdMbHcEtg', NULL),
(284, 'XUhuWhfjeNOuz0y3JRi2', NULL),
(284, 'Xt2WnyGKZKRZiOM1qBHq', NULL),
(284, '4bYaFZVsQtqqe8VWjevu', NULL),
(284, 'miUj3esd7WTDLqC981fM', NULL),
(284, 'DUkDGeElO5G9Wj4Uyeyy', NULL),
(284, 'FWIw2lundXO1cBMYWmfN', NULL),
(284, 'rvLK8w3V3bGiNKOE8yVD', NULL),
(284, 'D4MNDlcYIdNO87v4C0J3', NULL),
(285, 'cmjNhcWKrhaLcsAz8ziq', NULL),
(285, 'jSQPZFHoCUr9PLzXHojB', NULL),
(285, 'v9ZFZ0MeSHZWBql3SYUo', NULL),
(285, 'cftL5SB3LK5tfFLWvgkZ', NULL),
(285, 'HgGGtp5WFzO1jxGX8NMz', NULL),
(285, 'CyFPdsOxHilIzUU4LruE', NULL),
(285, 'BoLyMXLGfu4SO85PyxyG', NULL),
(285, 'DIPLQgS3cHVSlkl4bzpO', NULL),
(285, 'J52bEQHTPNnhYjfWjeda', NULL),
(289, 'qRowS0BqUZQ4OjBC4ykt', NULL),
(290, '6p52uhKLwdDY1OolqSFI', NULL),
(291, '0s6Alzhk21uKDU24oerC', NULL),
(289, 'aWJttLzTUJ0MqMic6dl6', NULL),
(289, 'H8WpAyJg7XSeuTgdeRXZ', NULL),
(289, 'GaAawFqflJhLRFJfzGhj', NULL),
(289, 'B8Jw2XVNEPy8t9Htmu0l', NULL),
(289, 'nZHxdikVkUBUhiRdyPYX', NULL),
(289, 'iuOudPwS75frZjKkVZSP', NULL),
(289, '3AYWMbcmegTq9ISveAN3', NULL),
(289, 'WD9YDJnKh9p2LFE0rPXL', NULL),
(289, 'wDnr2EPMObicbnBoiEEm', NULL),
(292, 'ISfUYCqaPQtkYPi333Hs', NULL),
(272, 'UIIsGpGUxElNGxpwAGZE', NULL),
(293, 'jTcDBZkI5PmojF8NA2G6', NULL),
(293, '8d3h0vZWQ6ieWTkNocdz', NULL),
(295, 'NJ7VKAuTdW4o166V0hXS', NULL),
(296, 'FGaFE57ttrxczWc8Hbz5', NULL),
(296, 'udhVLOTqRlG7x98vr2dg', NULL),
(296, 'rvdrLiriTlbChhpMIA2N', NULL),
(296, 'Cvm8jYCqX3dGGrHlBTp2', NULL),
(296, 'HM8QzXQbrzKxmeFBh0BI', NULL),
(296, 'I6qJ9qoPAD0nvZdtBZTq', NULL),
(274, 'RG5zmMkdxJMNauqI7Df7', NULL),
(296, 'SNVB5pddyrVVaM2ieScq', NULL),
(274, 'Nwt4ojwhkU4va3s0AyBr', NULL),
(274, 'r3hdrbzKNH5Aveb18rcu', NULL),
(274, 'BwVYW9BhdUSMbYoR4j26', NULL),
(274, '47ErbE4EWHByMXA70WQ5', NULL),
(297, 'SZKUS1gsspQ42VAGF4E7', NULL),
(297, 'RXp2oD3fVnaW836NDm7q', NULL),
(297, 'pi4VL2BNneKFmVreXnXb', NULL),
(298, 'McgVQ9Jt4dMuWyAxIPPS', NULL),
(298, 'NJkOuTfa40voWNlHLJfQ', NULL),
(298, 'ufRMSOmWVxuAdJ6cfgcE', NULL),
(298, 'LxayhAZDNsd6s8Am4eFZ', NULL),
(298, 'LR4FhEbVcD1QZM3fRn90', NULL),
(298, 'FmTwMGPAHwUjO5QCixy1', NULL),
(298, 'Vmdn9nEd6l3oPGAtkV0o', NULL),
(299, 'yysA65fruNwvBQKzvVGF', NULL),
(299, 'd6tWNjoIu7Ah10QATzhh', NULL),
(299, 'awTRCr0WUwrZ0qgRfqCt', NULL),
(299, 'tcIVThkzjVNF80qXsoww', NULL),
(299, 'LopfoksqRxb41tDn5qCZ', NULL),
(299, 'iOn3TbmYwW8Pdy0I8g4w', NULL),
(299, 'sOJULHTs0eZJX3lRWGlx', NULL),
(299, 'bW6jbSlSSi45bFkIueFT', NULL),
(298, 'iwJvnrrZgAm85EHpshmW', NULL),
(300, '4vIYUSPqrCd8WzwEIslV', NULL),
(300, 'PcC1ZkWXwkHT1OBojyJ3', NULL),
(298, 'aOwkAyOv4C9wFX5slPX9', NULL),
(303, 'SGECpKdVi9YTs7Zc0Qol', NULL),
(298, 'U3KTJacwti130ztfhqNJ', NULL),
(304, '187DnkXb1jydSgva63LE', NULL),
(304, 'BicIubfqP7PZWbYtYZJt', NULL),
(305, 'YRRzPqtsRKQx8BoHQmZC', NULL),
(298, 'lnuTdWAEg7L7zXKKJGCa', NULL),
(298, '5UP4xhjXHHHM7ztKix2m', NULL),
(298, 'TeK1JBHRGVyfORntUckF', NULL),
(298, 'Nwq5Pp0I4lZj67ubeQwm', NULL),
(306, 'CZ7QbtsP619nAUJQUaJT', NULL),
(306, 'WltpyWTcYTK9dyziRiYD', NULL),
(306, 'zmRaGFzPVP18gu34rpHN', NULL),
(306, '7pkUf5yFvDobeHspt0Jx', NULL),
(298, 'ssXeY2DC367rWB9pNT0Q', NULL),
(306, 'BrZVUbuaizKPA4DrGqgb', NULL),
(307, 'S17HoJO1JH3OSss37eGk', NULL),
(307, 'sjLrCPLjHeyANCAJtiXu', NULL),
(307, 'SKPCCdXPyq6cIZUuA9Kt', NULL),
(309, '6hpdnCzdaAuVg5l50KbL', NULL),
(309, 'ycUKZKlS3ptko7JMtmI0', NULL),
(309, 'Y8vTKsOdQfOjd47niiZ3', NULL),
(309, 'T4RXWTygv5NejezFjqlg', NULL),
(310, 'hVVwSz5e4qB5fltTyWmr', NULL),
(310, 'b4Cj7AMSEFnCV9ppmwdj', NULL),
(310, 'FtoCxSJnyhgJTdaHQPtn', NULL),
(310, 'WpJGqe9zhaQ0D1X9hUUh', NULL),
(311, 'bF5iSTkIeuDWCHqbvHMl', NULL),
(311, 'RZbbW7n1X8xmHhps3e4p', NULL),
(311, 'U44yGH9lOYkgqnUsWfle', NULL),
(311, 'jjscPEWqUob1Xh3JqTxz', NULL),
(311, '4PtEJ1nPv4tBOnhG9GOn', NULL),
(312, 'DgE0uT50FWY6MD4aTz7E', NULL),
(312, 'H1DLbGbKQ40y3NHfrppZ', NULL),
(312, '5Qj0vF7Shve9BGbgiYt9', NULL),
(312, 'cvusB0KPhj87iUrcLm0z', NULL),
(312, '5v5xI3bIFQKBe0rY3eHZ', NULL),
(274, 'QcDRNVN0Dec8dkjMPPUe', NULL),
(313, 'VC6EKOWqP7mT8RoMBHX9', NULL),
(314, 'pNmadL92sXkJhuYq51Nm', NULL),
(313, 'jepH1mrOPxWSKu5fOEc2', NULL),
(313, '3xmUcEIKWiaa3vDuOM0c', NULL),
(314, 'UwN5vTYmXHAQNqAHZrn8', NULL),
(314, 'OdBFzBecewXh7sLmQNXm', NULL),
(311, 'b5YzGpisIXPfpIYlV59J', NULL),
(311, 'Bmt1iWLfpiODTlt0wHur', NULL),
(311, 'SY9ZiTtrJmTEvonmSDgq', NULL),
(311, '8KOdA5gOTxnMgEtE5qFk', NULL),
(311, 'MQJKovKJD78nwoYEKCQc', NULL),
(311, 'uBda1f0sJ5o905HyAZej', NULL),
(311, 'UokoaD1VSkZzaa1L5dX8', NULL),
(311, 'ZSG7DobdKShqOphYfRda', NULL),
(311, 'SKVrYGYZ3f1r0RftXmvz', NULL),
(311, 'J28QEVKJMlbcOTh2oyQW', NULL),
(311, '9H7ZToETesXq7Ttmq8dV', NULL),
(315, 'cJ8Bhbs6tFXeEwGcelzP', NULL),
(315, 'HcOytmFGbuVE3rLwu0h2', NULL),
(311, 'CMxhhlxruyDbiMkYgNNK', NULL),
(315, 'laB0WNpaoMtiUqZ7cnv5', NULL),
(315, 'kBQKvypgC04xnHtHnrAU', NULL),
(315, 'iLYd7RRPjDtAsbLP9hUV', NULL),
(311, 'vYsYtSgAgV32DNtbtI1C', NULL);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `r_rqid_ono`
--
ALTER TABLE `r_rqid_ono`
  ADD KEY `rqid` (`rqid`),
  ADD KEY `ono` (`ono`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=316;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;