-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- 主機: db
-- 產生時間： 2018 年 09 月 17 日 16:27
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
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `orders`
--

INSERT INTO `orders` (`id`, `title`, `firstname`, `lastname`, `affiliation`, `email`, `reg_type`, `member_num`, `paper_id`, `paper_title`, `paper_type`, `paper_add_pages`, `department`, `job`, `address`, `address2`, `address3`, `zipcode`, `city`, `country`, `phone`, `mealtype`, `banquet_tickets`, `visa_nation`, `passport`, `place`, `issue`, `expiration`, `birth`, `amount`, `payment_method`, `paid`, `transaction_time`, `esun_payment_id`, `payment_confirmed`, `ref_token`, `invalid`, `remark`, `updated_at`, `created_at`) VALUES
(272, 0, 'Yusung', 'Wu', 'National Chiao Tung University', 'ysw@nctu.edu.tw', 0, '1234567', '500', 'This is  a test paper', NULL, 0, '資工系', 'マネージャー', '大学路1001號', '工程三館', '', '300', 'Hsinchu', 'Taiwan', '+886 975225901', 'Vegetarian', 4, 'Canada', '6545654646', '', '', '', '', 29000, 0, 0, NULL, NULL, 0, '00c9f1d5a616', 0, NULL, '2018-05-19 02:08:49', '2018-05-19 02:08:49'),
(274, 0, 'Yusung', 'Wu', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 0, '54545454', '535', 'This is a test paper', NULL, 0, 'Computer Science', 'Associate Professor', '1001 University Rd', '', '', '300', 'Hsinchu', 'Taiwan', '+886 975225901', 'Any', 0, '', '', '', '', '', '', 19, 0, 0, NULL, NULL, 0, 'fb50af23de77b96f', 0, NULL, '2018-05-20 14:51:08', '2018-05-20 14:51:08'),
(275, 0, 'Hello', 'Lin', 'NCTU', 'ysw@cs.nctu.edu.tw', 3, '', '', '', NULL, 0, '', 'Professor', '12312 University Rd', '', '', '333', 'sdfsdfs', 'Bolivia', '5754545454', 'Any', 0, '', '', '', '', '', '', 16, 0, 0, NULL, NULL, 0, 'f86e7abd1d0f14c6', 0, NULL, '2018-05-20 14:53:20', '2018-05-20 14:53:20'),
(278, 0, 'Yusung', 'Wu', 'National Chiao Tung University', 'yswu@livemail.tw', 2, '1234567', '56', 'This is  a test paper !!!', NULL, 0, 'Computer Science', 'Associate professor', '1001 University Rd', 'Engineering Building III', 'Room 429', '300', 'Hsinchu', 'Taiwan', '+886 975225901', 'Any', 2, 'Anguilla', '987654321', 'Taipei', '1980-01-01', '2020-08-02', '1980-01-01', 18, 0, 0, NULL, NULL, 0, '32fae159669c43c3', 0, NULL, '2018-05-26 10:10:59', '2018-05-26 10:10:59'),
(279, 0, 'John', 'Clinton', 'NTHU', 'ysw@cs.nctu.edu.tw', 0, '123123', '', '', NULL, 0, 'Electrical Engineering', 'Assistant Professor', '1000 Kung Fu Rd', 'Engineering Building 5', 'Room 5', '308', 'Taipei', 'Taiwan', '12312312312', 'Any', 0, '', '', '', '', '', '', 19, 0, 0, '2018-06-04 15:28:13', 'dl3FgDLi4089vAvm7Gxk', 0, 'f8413bf9e2e325ee', 0, NULL, '2018-09-03 09:00:49', '2018-05-26 15:09:13'),
(281, 4, 'Yu-Sung', 'Wu', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 0, '1234567', '100', 'This is a test paper', NULL, 0, 'Computer Science', 'Associate professor', '1001 University Rd', 'Engineering Building III', 'Room 429', '300', 'Hsinchu', 'Taiwan', '0975225901', 'Muslim', 1, '', '', '', '', '', '', 22, 0, 1, '2018-06-04 15:28:13', 'dl3FgDLi4089vAvm7Gxk', 0, '6ca563fc55078a68', 0, NULL, '2018-06-04 15:28:13', '2018-06-04 15:11:48'),
(284, 0, 'e', 'e', 'e', 'willylu.cs06g@nctu.edu.tw', 0, 'e', '', '', NULL, 0, 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'Ecuador', 'e', 'Any', 0, '', '', '', '', '', '', 19, 0, 1, '2018-06-04 15:28:13', NULL, 0, 'ee5943e1fff6aa20', 0, NULL, '2018-06-08 07:35:59', '2018-06-08 07:33:51'),
(285, 5, 'Strange', 'Lin', 'National Tsing Hua University', 'hankwu@g2.nctu.edu.tw', 0, '9876543', '500', 'A Study on the Implementation of Virtual Machine Device Models for ARM SoC Platforms', NULL, 0, 'Chemestry', 'Professor', '100 Kung Fu Rd', 'EE Bldg', '', '408', 'Taipei City', 'Taiwan', '975225901', 'Vegetarian', 0, 'Bhutan', '77777', 'Earth', '2009-05-05', '2020-08-01', '1970-01-01', 19, 0, 1, '2018-06-11 15:22:30', 'cmjNhcWKrhaLcsAz8ziq', 0, '62085e4e3521ead1', 0, NULL, '2018-06-11 15:22:30', '2018-06-11 15:09:39'),
(289, 2, 'TEstName', 'TestFirstName', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 0, '1234567', '100', 'Quantum Physics', NULL, 0, 'Electrical Engineering', 'Assistent Professor', '123 Chung Hua Rd', 'Room 3', '', '2000', 'Taipei', 'Switzerland', '7654900700', 'Vegetarian', 3, 'Bermuda', '2324342', 'Taipei', '1977-01-01', '1999-09-09', '1966-01-01', 27, 0, 0, NULL, NULL, 0, '433af7c99add6b9e', 0, NULL, '2018-06-23 20:46:11', '2018-06-23 20:46:11'),
(290, 3, 'Linda', 'Xi', 'NTHU', 'yswu@livemail.tw', 1, '', '', '', NULL, 0, '', 'Professor', '123 University Rd', 'Room 8', '', '302', 'Hualien', 'Bermuda', '56564454', 'Any', 0, '', '', '', '', '', '', 23, 1, 0, NULL, NULL, 0, '8b06ff23414884ab', 0, NULL, '2018-06-23 20:52:48', '2018-06-23 20:52:48'),
(291, 0, 'John', 'Coh', 'Academia Sinica', 'wu.yusung@gmail.com', 8, '', '', '', NULL, 0, 'Chemical Engineering', 'Student', '1212 Xininyu Ro', 'Bldg 3', '212', '121212', 'taipeitt', 'Taiwan', '76213721653', 'Any', 0, '', '', '', '', '', '', 20, 1, 0, NULL, NULL, 0, '0763baffa73c8e9d', 0, NULL, '2018-06-23 21:16:15', '2018-06-23 21:16:15'),
(292, 0, 'Yu-Sung', 'Wu', 'Test', 'ysw@cs.nctu.edu.tw', 0, '12312312', '', '', NULL, 0, '', 'TTT', '23123', '', '', '123123', '12312', 'Bhutan', '3123123123', 'Any', 0, '', '', '', '', '', '', 19000, 1, 0, NULL, NULL, 0, '8d9c29a052907f05', 0, NULL, '2018-08-11 15:26:16', '2018-08-11 15:26:16'),
(293, 3, 'Linda', 'Cho', 'NTHU', 'ysw@cs.nctu.edu.tw', 2, '5646456456', '', '', NULL, 0, '', 'N/A', '1001 University Rd', 'Engineering Bldg. III', '', '300', 'Hsinchu', 'Taiwan', '0975225901', 'Any', 0, '', '', '', '', '', '', 13000, 0, 0, NULL, NULL, 0, '85e6298c4a62119b', 0, NULL, '2018-08-27 15:32:06', '2018-08-27 15:32:06'),
(294, 2, 'Yu-Sung', 'Nick', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 3, '', '57', 'nonono', NULL, 0, '', 'TTT', '1001 University Rd', 'Engineering Bldg. III', '', '300', 'Hsinchu City', 'Taiwan', '0975225901', 'Any', 5, '', '', '', '', '', '', 28500, 0, 0, NULL, NULL, 0, 'b49c7e03f6f12c40', 0, NULL, '2018-08-27 15:43:28', '2018-08-27 15:43:28'),
(295, 0, 'Yu-Sung', 'Yu-Sung', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 7, '12312312', '', '', NULL, 0, '', 'TTT', '1001 University Rd', 'Engineering Bldg. III', '', '300', 'Hsinchu City', 'Taiwan', '0975225901', 'Vegetarian', 0, '', '', '', '', '', '', 16000, 1, 0, NULL, NULL, 0, '915444d79b5a2342', 0, NULL, '2018-08-27 15:46:46', '2018-08-27 15:46:46'),
(296, 5, '育松', '吳', '交通大學', 'yswu@livemail.tw', 0, '1234567', '44', 'this is a paper', NULL, 0, '資訊工程學系', '副教授', '大學路1001號', '', '', '30841', '新竹市', 'South Korea', '0975225901', 'Vegetarian', 2, 'Anguilla', '233333', 'earth', '0001-01-01', '0001-02-03', '0003-02-01', 24000, 1, 0, NULL, NULL, 0, 'b5b71443428b3f4f', 0, NULL, '2018-08-31 04:30:55', '2018-08-31 04:30:55'),
(297, 0, 'Final Test', '測試測試', 'NTU', 'YSW@CS.NCTU.EDU.TW', 4, '1234567', '', '', NULL, 0, 'PHYSICS', 'DEAN', '1234 ABC', '', '', '111', 'TAIPEI', 'Benin', '213123', 'Any', 0, '', '', '', '', '', '', 13000, 1, 0, NULL, NULL, 0, 'da03cb72f4d710f4', 0, NULL, '2018-09-07 05:09:37', '2018-09-07 05:09:37'),
(298, 5, 'Jin', 'Hong', 'University of Western Australia', 'jin.hong@uwa.edu.au', 0, '92638378', '15', 'Evaluating the Security of IoT Networks with Mobile Devices', NULL, 0, '', 'Lecturer', 'M002, 35 Stirling Highway', 'Crawley', '', '6009', 'Perth', 'Australia', '+61864882796', 'Any', 0, '', '', '', '', '', '', 19000, 0, 1, '2018-09-11 07:44:58', 'lnuTdWAEg7L7zXKKJGCa', 0, 'b4b8bf9fb3b14bf5', 0, NULL, '2018-09-11 07:44:58', '2018-09-10 04:20:28'),
(305, 0, 'Yu-Sung Test', 'Wu Test', 'National Chiao Tung University', 'ysw@cs.nctu.edu.tw', 1, '', '57', 'hahaha', 1, 1, '', 'TTT', '1001 University Rd', 'Engineering Bldg. III', '', '300', 'Hsinchu City', 'Taiwan', '975225901', 'Any', 2, '', '', '', '', '', '', 31200, 0, 0, NULL, NULL, 0, '5f2885b5d61543ee', 0, NULL, '2018-09-10 13:16:25', '2018-09-10 13:16:25'),
(306, 0, 'Simin', 'Cai', 'Mälardalen University', 'simin.cai@mdh.se', 0, '93617480', '34', 'Specification and Formal Verification of Atomic Concurrent Real-Time Transactions', 1, 1, '', 'PhD Student', 'Box 883, Högskoleplan 1', '', '', '72123', 'Västerås', 'Sweden', '004621107071', 'Any', 0, 'China', 'EB1640111', 'HUNAN', '2018-01-11', '2028-01-10', '1988-09-07', 22200, 0, 1, '2018-09-12 07:50:24', 'CZ7QbtsP619nAUJQUaJT', 0, 'c568a95349762b62', 0, NULL, '2018-09-12 07:50:24', '2018-09-12 07:48:08'),
(307, 0, 'Angelos', 'Oikonomopoulos', 'Vrije Universiteit Amsterdam', 'a.oikonomopoulos@vu.nl', 1, '', '10', 'On the effectiveness of code normalization for function identification', 1, 0, '', 'PhD Student', 'Moislinger Allee 112a', '', '', '23558', 'Luebeck', 'Germany', '+4917657645997', 'Vegetarian', 0, '', '', '', '', '', '', 23000, 0, 1, '2018-09-14 21:21:59', 'S17HoJO1JH3OSss37eGk', 0, '9d841bd87d532942', 0, NULL, '2018-09-14 21:21:59', '2018-09-14 21:17:01'),
(308, 0, 'Venu Babu', 'Thati', 'KU Leuven', 'venubabu.thati@kuleuven.be', 0, '93992219', '9', 'An Improved Data Error Detection Technique for Dependable Embedded Software', 1, 0, 'Computer Science', 'PhD student', 'Spoorwegstraat 12', 'KU Leuven Campus Brugge', '', '8200', 'Brugge - Sint- Michiels', 'Belgium', '+32 465500165', 'Any', 0, 'India', 'J2830103', 'Thativaripalem, India', '2011-01-06', '2021-01-05', '1990-03-06', 19000, 0, 0, NULL, NULL, 0, '55ca99697a99dc6a', 0, NULL, '2018-09-15 14:44:42', '2018-09-15 14:44:42'),
(309, 0, 'Venu Babu', 'Thati', 'KU Leuven', 'venubabu.thati@kuleuven.be', 0, '93992219', '9', 'An Improved Data Error Detection Technique for Dependable Embedded Software', 1, 0, 'Computer Science', 'PhD student', 'Spoorwegstraat 12', 'KU Leuven Campus Brugge', '', '8200', 'Brugge - Sint- Michiels', 'Belgium', '+32 465500165', 'Any', 0, 'India', 'J2830103', 'Thativaripalem, India', '2011-01-06', '2021-01-05', '1990-03-06', 19000, 0, 1, '2018-09-15 14:50:52', '6hpdnCzdaAuVg5l50KbL', 0, '66f7c144d82a1d03', 0, NULL, '2018-09-15 14:50:52', '2018-09-15 14:48:14'),
(310, 0, 'Tommaso', 'Zoppi', 'University of Florence', 'tommaso.zoppi@unifi.it', 1, '', '21', 'On Algorithms Selection for Unsupervised Anomaly Detection', 1, 0, 'Department of Mathematics and Informatics', 'Post-Doc Researcher', 'Viale Morgagni 65, Florence, Italy', '', '', '50134', 'Florence', 'Italy', '0552751483', 'Any', 0, '', '', '', '', '', '', 23000, 0, 1, '2018-09-17 09:52:42', 'b4Cj7AMSEFnCV9ppmwdj', 0, '97590be543d4b886', 0, NULL, '2018-09-17 09:52:42', '2018-09-17 09:46:40');

-- --------------------------------------------------------

--
-- 資料表結構 `r_rqid_ono`
--

CREATE TABLE IF NOT EXISTS `r_rqid_ono` (
  `rqid` int(11) DEFAULT NULL,
  `ono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `r_rqid_ono`
--

INSERT INTO `r_rqid_ono` (`rqid`, `ono`) VALUES
(263, 'yBnt67PcBF31fJFLkxWU'),
(263, 'zFx0Q1Y8jdLvGTURiKq0'),
(263, 'GiaC0I87eqnSz6Ta4On9'),
(263, '93pq2sno6ulyE8VQ7sqf'),
(263, 'ANGMBzWoYazdeDoxrBgS'),
(263, 'slLEBzVYenpaRbFeqnfo'),
(263, 'CWRpZtkEiEjteIDMKgEA'),
(263, 'XGIz8Mckw9Edp4KzgjV6'),
(263, 'BtpGu1M9YiaVgTMaLffi'),
(263, 'LyFbCgs9CnD4NwFdwlrf'),
(263, 'ceUSGLJfxMCHgnCtLYT7'),
(263, 'Hj2IS44BO72RTsX2fUwf'),
(263, 'SXt2qSybyEXurDkeQfzV'),
(263, 'Cl8jxWBBK6gV4oqVSUPj'),
(263, '9SDlJO7nld20LAq1MxdB'),
(264, 'Xk2nDUHFMSoozcjb7aSj'),
(264, 'HvLikoo1wBsadGWvVOus'),
(264, 'YnTREuIEU900R5qTyDCE'),
(264, 'Y7sWYY6QNwASQ3nvAiHl'),
(264, 'RLZ57cS8OS6y1D23HCPL'),
(267, '2Esy408YNTi9HWLAqRtL'),
(267, 'WYWzssEZlhAYzflPPpCT'),
(267, 'Tjs6TAoeD4DHVdwf4Vjx'),
(267, 'y8LG5CB0WC1kfl5Tx7hh'),
(267, 'W7Smx6NOuGy1PpRNdDtW'),
(267, 'lfsXv9uAjlQ5iyn1Vk4V'),
(267, 'cdWYeKdtkObpSbjHiG2t'),
(266, 'zmwuCw8ykQV50wgVhS5q'),
(266, 'rQklLwaqGsjq5QnhmxDg'),
(267, '8oA0VLFUb64CMuW8H4ka'),
(267, '0wopFKfwQ8hA0kTPspox'),
(267, 'E0WBpco4hOyVWSGHuHhJ'),
(266, 'w1gtYGLfb2NkT4oebl23'),
(268, 'mSlMfoXHSMof0lRFne9s'),
(266, 'NijrSlMs3F7mWJoYsJNS'),
(268, '84dNv6yobX8fGswf0npz'),
(268, '1s38XfHQPSFI4lwgdP30'),
(268, 'xvJE8MTQs7bJYGsFbeXz'),
(268, 'LXhW9ZBuTY3CHUOngCNV'),
(268, 'MapdtLg8Y0teT1IgCwKw'),
(268, 'L9xeF06goo8C4IFxkWHd'),
(269, 'FqZ8QIxxyPyOfIuM8scG'),
(269, 'IGpYpktbSuW8k89TJ2XW'),
(267, '6Ry1K6zUPFm3JJFq91gk'),
(267, 'tTYj57rspxCPL5vvUC1e'),
(267, '1M0dI7Rj6AUupLiBlpAL'),
(266, 'n8bWfnNAamapQ6pVjXTg'),
(266, 'OH91MzsTvIGaDOmb438K'),
(271, 'Qnh4Ko9yXILMj1ObdVvj'),
(263, 'zc18QwA9AikMqqdBPTuO'),
(271, 'FXmr6kVvIGtFP8Dv3rqv'),
(271, 'jMxw0OSAj78eiW8oByIN'),
(271, 'FeEYuBGnluJpDDOkh88y'),
(266, 'bnsSYKfnGncH7YqXpR6R'),
(272, '122jrGJSNwzr9L04ponl'),
(272, '9KlcCLkK3oozjiVJq5Hn'),
(266, 'xjuaA2f5G39LaDyRH49d'),
(273, 'j1p2Kn4QjDZNAd5UkXwL'),
(272, 'nPXdh1twWMJgRrh49x3J'),
(274, 'pdZYOzQcQPjTnEQLeCax'),
(275, 'lOLEdj3JNRNVGWqCx6vf'),
(273, 'qa1jNKnMHuFZrxGAU5uy'),
(266, 'knOpb08Vb9nbttTITAYk'),
(273, 'PgC4n1uanvbHfhVPeURC'),
(273, 'xTtU6xPVvom7WUBFkZqS'),
(273, '1N24QWn1uwSfSOpYRyH3'),
(273, 'vQIXC7OXADfFMQzFMCZf'),
(277, 'ld36bioagwhoqdN7xryv'),
(278, 'hbJbt2iLPtM4gMQ2NnKn'),
(279, 'QvvFpSNF6dk3Ga8tEXbA'),
(278, 'CfE04POx7cFet5mRjGGo'),
(278, 'L6UOscd50JuhdK7tkAMW'),
(278, 'Gt4bXohj5cikmSbbRfdK'),
(278, 'ihAOFf2gIm9dHRgkrgHc'),
(280, 't9qNkAJR0dZtxKVa55ka'),
(280, 'oN76cOd8VUjN36g6FWjy'),
(280, '2Urqaj0BNflSaqhID2PY'),
(280, 'ddgHbUMX0ll78CdTEg9K'),
(280, 'FJpKE0Z6wJilN3gNF52a'),
(280, 'afUIEgEZMtbQNkEo9Xtp'),
(280, 'ZeXTxwnhnNpvHMBrA39I'),
(281, 'dl3FgDLi4089vAvm7Gxk'),
(281, 'bXCufwJvxJUQjtRxN8D3'),
(281, 'uD2MlgCS4AF6uPo0tjzp'),
(282, 'kzENpL7yJRuCsTlGgtvy'),
(282, 'gg9Q0q4YHIoZiVyJOAD0'),
(282, 'eKGuys2T5kS0SwYdBqG6'),
(282, 'rdg0QkxQxfgeLtoZdfFm'),
(282, 'HWyetK3LnCMyRr86BBMU'),
(282, 'U7PHB8WZDHcR84C2oTdn'),
(281, 'GkrmOtkPdCHkM3yGydpN'),
(281, 'yXA6aueO5l0LIKHOq0yc'),
(281, 'BFe2cZc8BeyEVHKeHpdf'),
(281, 'V9Njy2zqyS4UIwDrNeVI'),
(279, 'PLmum4MS552mN2LHaoTM'),
(279, 'MQ0iEu6cqNJNdMbHcEtg'),
(284, 'XUhuWhfjeNOuz0y3JRi2'),
(284, 'Xt2WnyGKZKRZiOM1qBHq'),
(284, '4bYaFZVsQtqqe8VWjevu'),
(284, 'miUj3esd7WTDLqC981fM'),
(284, 'DUkDGeElO5G9Wj4Uyeyy'),
(284, 'FWIw2lundXO1cBMYWmfN'),
(284, 'rvLK8w3V3bGiNKOE8yVD'),
(284, 'D4MNDlcYIdNO87v4C0J3'),
(285, 'cmjNhcWKrhaLcsAz8ziq'),
(285, 'jSQPZFHoCUr9PLzXHojB'),
(285, 'v9ZFZ0MeSHZWBql3SYUo'),
(285, 'cftL5SB3LK5tfFLWvgkZ'),
(285, 'HgGGtp5WFzO1jxGX8NMz'),
(285, 'CyFPdsOxHilIzUU4LruE'),
(285, 'BoLyMXLGfu4SO85PyxyG'),
(285, 'DIPLQgS3cHVSlkl4bzpO'),
(285, 'J52bEQHTPNnhYjfWjeda'),
(289, 'qRowS0BqUZQ4OjBC4ykt'),
(290, '6p52uhKLwdDY1OolqSFI'),
(291, '0s6Alzhk21uKDU24oerC'),
(289, 'aWJttLzTUJ0MqMic6dl6'),
(289, 'H8WpAyJg7XSeuTgdeRXZ'),
(289, 'GaAawFqflJhLRFJfzGhj'),
(289, 'B8Jw2XVNEPy8t9Htmu0l'),
(289, 'nZHxdikVkUBUhiRdyPYX'),
(289, 'iuOudPwS75frZjKkVZSP'),
(289, '3AYWMbcmegTq9ISveAN3'),
(289, 'WD9YDJnKh9p2LFE0rPXL'),
(289, 'wDnr2EPMObicbnBoiEEm'),
(292, 'ISfUYCqaPQtkYPi333Hs'),
(272, 'UIIsGpGUxElNGxpwAGZE'),
(293, 'jTcDBZkI5PmojF8NA2G6'),
(293, '8d3h0vZWQ6ieWTkNocdz'),
(295, 'NJ7VKAuTdW4o166V0hXS'),
(296, 'FGaFE57ttrxczWc8Hbz5'),
(296, 'udhVLOTqRlG7x98vr2dg'),
(296, 'rvdrLiriTlbChhpMIA2N'),
(296, 'Cvm8jYCqX3dGGrHlBTp2'),
(296, 'HM8QzXQbrzKxmeFBh0BI'),
(296, 'I6qJ9qoPAD0nvZdtBZTq'),
(274, 'RG5zmMkdxJMNauqI7Df7'),
(296, 'SNVB5pddyrVVaM2ieScq'),
(274, 'Nwt4ojwhkU4va3s0AyBr'),
(274, 'r3hdrbzKNH5Aveb18rcu'),
(274, 'BwVYW9BhdUSMbYoR4j26'),
(274, '47ErbE4EWHByMXA70WQ5'),
(297, 'SZKUS1gsspQ42VAGF4E7'),
(297, 'RXp2oD3fVnaW836NDm7q'),
(297, 'pi4VL2BNneKFmVreXnXb'),
(298, 'McgVQ9Jt4dMuWyAxIPPS'),
(298, 'NJkOuTfa40voWNlHLJfQ'),
(298, 'ufRMSOmWVxuAdJ6cfgcE'),
(298, 'LxayhAZDNsd6s8Am4eFZ'),
(298, 'LR4FhEbVcD1QZM3fRn90'),
(298, 'FmTwMGPAHwUjO5QCixy1'),
(298, 'Vmdn9nEd6l3oPGAtkV0o'),
(299, 'yysA65fruNwvBQKzvVGF'),
(299, 'd6tWNjoIu7Ah10QATzhh'),
(299, 'awTRCr0WUwrZ0qgRfqCt'),
(299, 'tcIVThkzjVNF80qXsoww'),
(299, 'LopfoksqRxb41tDn5qCZ'),
(299, 'iOn3TbmYwW8Pdy0I8g4w'),
(299, 'sOJULHTs0eZJX3lRWGlx'),
(299, 'bW6jbSlSSi45bFkIueFT'),
(298, 'iwJvnrrZgAm85EHpshmW'),
(300, '4vIYUSPqrCd8WzwEIslV'),
(300, 'PcC1ZkWXwkHT1OBojyJ3'),
(298, 'aOwkAyOv4C9wFX5slPX9'),
(303, 'SGECpKdVi9YTs7Zc0Qol'),
(298, 'U3KTJacwti130ztfhqNJ'),
(304, '187DnkXb1jydSgva63LE'),
(304, 'BicIubfqP7PZWbYtYZJt'),
(305, 'YRRzPqtsRKQx8BoHQmZC'),
(298, 'lnuTdWAEg7L7zXKKJGCa'),
(298, '5UP4xhjXHHHM7ztKix2m'),
(298, 'TeK1JBHRGVyfORntUckF'),
(298, 'Nwq5Pp0I4lZj67ubeQwm'),
(306, 'CZ7QbtsP619nAUJQUaJT'),
(306, 'WltpyWTcYTK9dyziRiYD'),
(306, 'zmRaGFzPVP18gu34rpHN'),
(306, '7pkUf5yFvDobeHspt0Jx'),
(298, 'ssXeY2DC367rWB9pNT0Q'),
(306, 'BrZVUbuaizKPA4DrGqgb'),
(307, 'S17HoJO1JH3OSss37eGk'),
(307, 'sjLrCPLjHeyANCAJtiXu'),
(307, 'SKPCCdXPyq6cIZUuA9Kt'),
(309, '6hpdnCzdaAuVg5l50KbL'),
(309, 'ycUKZKlS3ptko7JMtmI0'),
(309, 'Y8vTKsOdQfOjd47niiZ3'),
(309, 'T4RXWTygv5NejezFjqlg'),
(310, 'hVVwSz5e4qB5fltTyWmr'),
(310, 'b4Cj7AMSEFnCV9ppmwdj'),
(310, 'FtoCxSJnyhgJTdaHQPtn'),
(310, 'WpJGqe9zhaQ0D1X9hUUh');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=311;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
