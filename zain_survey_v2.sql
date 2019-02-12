-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2019 at 08:42 AM
-- Server version: 5.7.19
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zain_survey.v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `english_main_question`
--

DROP TABLE IF EXISTS `english_main_question`;
CREATE TABLE IF NOT EXISTS `english_main_question` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `english_question_part_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `english_main_question`
--

INSERT INTO `english_main_question` (`id`, `english_question_part_id`, `title`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'grammer1', NULL, '2018-09-08 17:17:24', '2018-09-08 17:17:24'),
(2, 1, 'grammer2', NULL, '2018-09-08 17:18:05', '2018-09-08 17:18:05'),
(5, 2, 'pharagrap QQ', NULL, '2018-09-08 17:33:33', '2018-09-08 17:33:33'),
(4, 3, 'Audio Tesr', '8033a35d223a5e771ead87893c229f19eb040d5e.mp3', '2018-09-08 17:18:55', '2018-09-08 17:18:55'),
(6, 1, 'test', NULL, '2018-10-29 02:37:47', '2018-10-29 02:37:47'),
(7, 3, 'vvvvvv', '611e6452fd253b84cc878a5cb7d12125ff548f08.mp3', '2018-10-29 04:09:44', '2018-10-29 04:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `english_question`
--

DROP TABLE IF EXISTS `english_question`;
CREATE TABLE IF NOT EXISTS `english_question` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `english_main_question_id` int(11) NOT NULL,
  `english_question_type_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_level_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `english_question`
--

INSERT INTO `english_question` (`id`, `english_main_question_id`, `english_question_type_id`, `title`, `question_level_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'grammer1', 2, '2018-09-08 17:17:24', '2018-09-08 17:17:24'),
(2, 2, 1, 'grammer2', 2, '2018-09-08 17:18:05', '2018-09-08 17:18:05'),
(3, 4, 1, 'AudioMulti', 2, '2018-09-08 17:20:34', '2018-09-08 17:20:34'),
(4, 4, 2, 'PARAGRAPH Audio', 2, '2018-09-08 17:21:02', '2018-09-08 17:21:02'),
(5, 5, 2, 'pharagrap QQ', 2, '2018-09-08 17:33:33', '2018-09-08 17:33:33'),
(6, 6, 1, 'test', 2, '2018-10-29 02:37:48', '2018-10-29 04:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `english_question_answer`
--

DROP TABLE IF EXISTS `english_question_answer`;
CREATE TABLE IF NOT EXISTS `english_question_answer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `english_question_id` int(11) NOT NULL,
  `answer1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `english_question_answer`
--

INSERT INTO `english_question_answer` (`id`, `english_question_id`, `answer1`, `answer2`, `answer3`, `answer4`, `correct`, `created_at`, `updated_at`) VALUES
(1, 1, 'grammerA1', 'grammerB1', 'grammerC1', 'grammerD1', 'answer1', '2018-09-08 17:17:24', '2018-09-08 17:17:24'),
(2, 2, 'grammer2a', 'grammer2b', 'grammer2c', 'grammer2d', 'answer2', '2018-09-08 17:18:05', '2018-09-08 17:18:05'),
(3, 3, 'AudioM1', 'AudioM22', 'AudioM33', 'AudioM44', 'answer1', '2018-09-08 17:20:34', '2018-09-08 17:20:34'),
(4, 6, 'test', 'test', 'test', 'test', 'answer3', '2018-10-29 02:37:48', '2018-10-29 04:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `english_question_part`
--

DROP TABLE IF EXISTS `english_question_part`;
CREATE TABLE IF NOT EXISTS `english_question_part` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `english_question_part`
--

INSERT INTO `english_question_part` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Grammar questions', '2018-03-05 16:32:25', '2018-03-05 16:32:25'),
(2, 'Paragraph Questions', '2018-03-05 16:33:09', '2018-03-05 16:33:09'),
(3, 'Audio Questions', '2018-03-05 16:33:28', '2018-03-05 16:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `english_question_type`
--

DROP TABLE IF EXISTS `english_question_type`;
CREATE TABLE IF NOT EXISTS `english_question_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `english_question_type`
--

INSERT INTO `english_question_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Multiple Choice Question', '2018-03-05 16:27:07', '2018-03-05 16:27:07'),
(2, 'Written Answer', '2018-03-05 16:27:43', '2018-03-05 16:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 93, '2018-09-08 19:06:31', '2018-09-08 19:06:31'),
(2, 94, '2018-09-08 17:40:55', '2018-09-08 17:40:55'),
(4, 95, '2018-12-08 14:24:19', '2018-12-08 14:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

DROP TABLE IF EXISTS `exam_question`;
CREATE TABLE IF NOT EXISTS `exam_question` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `english_question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_question`
--

INSERT INTO `exam_question` (`id`, `english_question_id`, `exam_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2018-09-08 17:40:57', '2018-09-08 17:40:57'),
(2, 2, 2, '2018-09-08 17:40:57', '2018-09-08 17:40:57'),
(3, 4, 2, '2018-09-08 17:40:57', '2018-09-08 17:40:57'),
(4, 3, 2, '2018-09-08 17:40:57', '2018-09-08 17:40:57'),
(5, 5, 2, '2018-09-08 17:40:57', '2018-09-08 17:40:57'),
(6, 2, 3, '2018-09-08 19:06:31', '2018-09-08 19:06:31'),
(7, 1, 3, '2018-09-08 19:06:31', '2018-09-08 19:06:31'),
(8, 3, 3, '2018-09-08 19:06:31', '2018-09-08 19:06:31'),
(9, 4, 3, '2018-09-08 19:06:31', '2018-09-08 19:06:31'),
(10, 5, 3, '2018-09-08 19:06:31', '2018-09-08 19:06:31'),
(11, 2, 4, '2018-12-08 14:24:19', '2018-12-08 14:24:19'),
(12, 6, 4, '2018-12-08 14:24:19', '2018-12-08 14:24:19'),
(13, 1, 4, '2018-12-08 14:24:19', '2018-12-08 14:24:19'),
(14, 5, 4, '2018-12-08 14:24:19', '2018-12-08 14:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_26_084052_create_english_main_question', 1),
(4, '2018_02_26_113841_create_english_question_part', 1),
(5, '2018_03_05_051424_create_english_question', 1),
(6, '2018_03_05_051806_create_english_question_type', 1),
(7, '2018_03_05_052224_create_question_level', 1),
(8, '2018_03_05_052721_create_exam_question', 1),
(9, '2018_03_05_053005_create_exam', 1),
(10, '2018_03_05_053232_create_department', 1),
(11, '2018_03_05_053517_create_user_answer', 1),
(12, '2018_03_05_053750_create_english_question_answer', 1),
(13, '2018_03_11_082008_create_personal_question_type', 2),
(14, '2018_03_11_082055_create_personal_question', 2),
(15, '2018_03_11_082325_create_personal_question_answer', 2),
(16, '2018_03_11_111924_create_personal_exam_question', 3),
(17, '2018_03_11_114056_create_personal_user_answer', 4),
(18, '2018_03_15_094318_create_personal_exam', 4),
(19, '2018_06_24_074908_create_ms_question', 5),
(20, '2018_06_24_080207_create_ms_question_type', 5),
(21, '2018_06_24_080427_create_ms_answer_type', 5),
(22, '2018_06_24_080524_create_ms_exam', 5),
(23, '2018_06_24_080645_create_ms_question_answer', 5),
(24, '2018_06_24_080742_create_ms_question_exam', 5),
(25, '2018_06_24_081026_create_ms_user_answer', 5),
(26, '2018_06_27_062908_create_personal_answer_type', 6);

-- --------------------------------------------------------

--
-- Table structure for table `ms_answer_type`
--

DROP TABLE IF EXISTS `ms_answer_type`;
CREATE TABLE IF NOT EXISTS `ms_answer_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_answer_type`
--

INSERT INTO `ms_answer_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Multiple Choice Question', '2018-09-08 15:38:37', '2018-09-08 15:38:37'),
(2, 'Written Answer', '2018-09-08 15:39:01', '2018-09-08 15:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `ms_exam`
--

DROP TABLE IF EXISTS `ms_exam`;
CREATE TABLE IF NOT EXISTS `ms_exam` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ms_exam_question`
--

DROP TABLE IF EXISTS `ms_exam_question`;
CREATE TABLE IF NOT EXISTS `ms_exam_question` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ms_question_id` int(11) NOT NULL,
  `ms_exam_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_exam_question`
--

INSERT INTO `ms_exam_question` (`id`, `ms_question_id`, `ms_exam_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2018-09-08 17:55:18', '2018-09-08 17:55:18'),
(2, 1, 2, '2018-09-08 17:55:18', '2018-09-08 17:55:18'),
(3, 1, 3, '2018-12-08 14:03:55', '2018-12-08 14:03:55'),
(4, 2, 3, '2018-12-08 14:03:55', '2018-12-08 14:03:55'),
(5, 1, 4, '2018-12-08 14:24:23', '2018-12-08 14:24:23'),
(6, 2, 4, '2018-12-08 14:24:23', '2018-12-08 14:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `ms_question`
--

DROP TABLE IF EXISTS `ms_question`;
CREATE TABLE IF NOT EXISTS `ms_question` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ms_question_section_id` int(11) NOT NULL,
  `ms_question_type_id` int(11) NOT NULL,
  `ms_answer_type_id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_level_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_question`
--

INSERT INTO `ms_question` (`id`, `ms_question_section_id`, `ms_question_type_id`, `ms_answer_type_id`, `title`, `image_path`, `question_level_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'WORD QUEST MULTI', NULL, 2, '2018-09-08 17:24:50', '2018-09-08 17:24:50'),
(2, 2, 2, 2, 'IMAGE Q', 'd293e7ed255f8527f5059beab17196d85fc0711f.jpg', 2, '2018-09-08 17:25:44', '2018-09-08 17:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `ms_question_answer`
--

DROP TABLE IF EXISTS `ms_question_answer`;
CREATE TABLE IF NOT EXISTS `ms_question_answer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ms_question_id` int(11) NOT NULL,
  `answer1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_question_answer`
--

INSERT INTO `ms_question_answer` (`id`, `ms_question_id`, `answer1`, `answer2`, `answer3`, `answer4`, `correct`, `created_at`, `updated_at`) VALUES
(1, 1, 'per', 'fds', 'ad', 'wqdsadssda', 'answer1', '2018-09-08 17:24:50', '2018-09-08 17:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `ms_question_section`
--

DROP TABLE IF EXISTS `ms_question_section`;
CREATE TABLE IF NOT EXISTS `ms_question_section` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_question_section`
--

INSERT INTO `ms_question_section` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Word ', '2018-09-08 14:53:13', '2018-09-08 14:53:13'),
(2, 'Excel', '2018-09-08 14:53:13', '2018-09-08 14:53:13'),
(3, 'PowerPoint', '2018-09-08 14:53:13', '2018-09-08 14:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `ms_question_type`
--

DROP TABLE IF EXISTS `ms_question_type`;
CREATE TABLE IF NOT EXISTS `ms_question_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_question_type`
--

INSERT INTO `ms_question_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Text Question', '2018-06-24 08:24:01', '2018-06-24 08:24:01'),
(2, 'Image Question', '2018-06-24 08:24:01', '2018-06-24 08:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `ms_user_answer`
--

DROP TABLE IF EXISTS `ms_user_answer`;
CREATE TABLE IF NOT EXISTS `ms_user_answer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ms_question_id` int(11) NOT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ms_exam_id` int(11) NOT NULL,
  `score` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_user_answer`
--

INSERT INTO `ms_user_answer` (`id`, `ms_question_id`, `answer`, `ms_exam_id`, `score`, `created_at`, `updated_at`) VALUES
(1, 1, 'per', 2, 1.00, '2018-09-08 17:56:16', '2018-09-08 17:56:16'),
(2, 2, 'dfsdfdsfd', 2, 1.00, '2018-09-08 17:56:16', '2018-09-08 17:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_answer_type`
--

DROP TABLE IF EXISTS `personal_answer_type`;
CREATE TABLE IF NOT EXISTS `personal_answer_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `answer1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_question_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_answer_type`
--

INSERT INTO `personal_answer_type` (`id`, `answer1`, `answer2`, `personal_question_id`, `created_at`, `updated_at`) VALUES
(1, 'personalQ21', 'personalQ22', 2, '2018-09-08 17:22:44', '2018-09-08 17:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `personal_exam`
--

DROP TABLE IF EXISTS `personal_exam`;
CREATE TABLE IF NOT EXISTS `personal_exam` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_exam_question`
--

DROP TABLE IF EXISTS `personal_exam_question`;
CREATE TABLE IF NOT EXISTS `personal_exam_question` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personal_question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_exam_question`
--

INSERT INTO `personal_exam_question` (`id`, `personal_question_id`, `exam_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2018-09-08 17:52:14', '2018-09-08 17:52:14'),
(2, 3, 2, '2018-09-08 17:52:14', '2018-09-08 17:52:14'),
(3, 2, 2, '2018-09-08 17:52:14', '2018-09-08 17:52:14'),
(4, 3, 3, '2018-09-08 19:06:35', '2018-09-08 19:06:35'),
(5, 2, 3, '2018-09-08 19:06:35', '2018-09-08 19:06:35'),
(6, 1, 3, '2018-09-08 19:06:35', '2018-09-08 19:06:35'),
(7, 1, 4, '2018-12-08 14:24:21', '2018-12-08 14:24:21'),
(8, 2, 4, '2018-12-08 14:24:21', '2018-12-08 14:24:21'),
(9, 3, 4, '2018-12-08 14:24:21', '2018-12-08 14:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `personal_question`
--

DROP TABLE IF EXISTS `personal_question`;
CREATE TABLE IF NOT EXISTS `personal_question` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personal_question_type_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_level_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_question`
--

INSERT INTO `personal_question` (`id`, `personal_question_type_id`, `title`, `question_level_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'personalQ', 2, '2018-09-08 17:22:17', '2018-09-08 17:22:17'),
(2, 2, 'MUTLTI2', 2, '2018-09-08 17:22:44', '2018-09-08 17:22:44'),
(3, 3, 'PARApERSONAL', 2, '2018-09-08 17:24:17', '2018-09-08 17:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `personal_question_answer`
--

DROP TABLE IF EXISTS `personal_question_answer`;
CREATE TABLE IF NOT EXISTS `personal_question_answer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personal_question_id` int(11) NOT NULL,
  `answer1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_question_answer`
--

INSERT INTO `personal_question_answer` (`id`, `personal_question_id`, `answer1`, `answer2`, `answer3`, `answer4`, `correct`, `created_at`, `updated_at`) VALUES
(1, 1, 'personalQ1', 'personalQ2', 'personalQ3', 'personalQ4', 'answer1', '2018-09-08 17:22:17', '2018-09-08 17:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `personal_question_type`
--

DROP TABLE IF EXISTS `personal_question_type`;
CREATE TABLE IF NOT EXISTS `personal_question_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_question_type`
--

INSERT INTO `personal_question_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Multiple Choice Question(4 Answer)', '2018-03-25 06:12:18', '2018-03-25 06:12:18'),
(2, 'Multiple Choice Question(2 Answer)', '2018-03-25 06:12:36', '2018-03-25 06:12:36'),
(3, 'Written Answer', '2018-03-25 06:12:18', '2018-03-25 06:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `personal_user_answer`
--

DROP TABLE IF EXISTS `personal_user_answer`;
CREATE TABLE IF NOT EXISTS `personal_user_answer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `personal_question_id` int(11) NOT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_exam_id` int(11) NOT NULL,
  `score` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_user_answer`
--

INSERT INTO `personal_user_answer` (`id`, `personal_question_id`, `answer`, `personal_exam_id`, `score`, `created_at`, `updated_at`) VALUES
(1, 1, 'personalQ1', 2, 1.00, '2018-09-08 17:54:16', '2018-09-08 17:54:16'),
(2, 3, 'sdf', 2, 1.00, '2018-09-08 17:54:16', '2018-09-08 17:54:57'),
(3, 2, 'personalQ22', 2, 1.00, '2018-09-08 17:54:16', '2018-09-08 17:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `question_level`
--

DROP TABLE IF EXISTS `question_level`;
CREATE TABLE IF NOT EXISTS `question_level` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_level`
--

INSERT INTO `question_level` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Hard', '2018-03-05 16:39:28', '2018-03-05 16:39:28'),
(2, 'medium', '2018-03-05 16:39:56', '2018-03-05 16:39:56'),
(3, 'Easy', '2018-03-05 16:40:15', '2018-03-05 16:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `permission`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abdulla basim', 'abdullabasim91@gmail.com', 'Admin', '$2y$10$txJhDTExZ3PJIwO0EbxoB.l6cPsSgPvZ9BFwc8nNaGrwTVX2b.CQW', 'Bq5g9SkiVKjtSk8hQAfh533M5PTL9fpcHonUicarjBPIpKOJ6uovijMEGuPZ', NULL, NULL),
(90, 'Taif Hussam Sabti', 'taif.hussam@iq.zain.com', 'Admin', '$2y$10$n456ttQ3fZ//rx1XU2.ece.S36gq/mNNGUSd5B1KoYz9oevLeEVeq', 'ssIfgkdAspzM70v55WyL6I4BHpJgbXISlkQZTdbB09y8RgpdMFmQfheDQfJe', '2018-07-02 02:36:59', '2018-07-02 02:36:59'),
(94, 'abdullah khudhair', 'tt@tt.com', 'Candidate', '$2y$10$Tn4n2y2tYJTDc/5mIqgPbeqzoBEAw3dbGIPMFCJRF94owwq9feiri', 'GDPWkdnLII8TFXWHhchUYCmAEFXXgGmwKVTsRvXAIn66FOagrp9rjEc4sWSu', '2018-09-08 15:09:28', '2018-09-08 15:09:28'),
(93, 'tmtm', 'tamarazead91@gmail.com', 'Candidate', '$2y$10$YEjAvLeMFpcPp29Cz5usIei/GTiaGy3DomJSPPQS10KCAZ.eWf1Ta', '2mOJIQ7dFHerTswZLjbdhJk2dzSaouvMwhVcE0zbU6J8FubmEo0Zk1QD6u8y', '2018-09-08 14:50:06', '2018-09-08 14:50:06'),
(95, 'Ahmed Zuhair', 'focal.point@iq.zain.com', 'Candidate', '$2y$10$T0175pUYkaHiLwFd4QwrNunDUD6ltXXMReEJidSQjVfrDIK5fdxd6', NULL, '2018-12-08 14:24:00', '2018-12-08 14:24:00'),
(89, 'Ali Mohamad', 'Ali.mohamad@iq.zain.com', 'Admin', '$2y$10$n456ttQ3fZ//rx1XU2.ece.S36gq/mNNGUSd5B1KoYz9oevLeEVeq', 'ssIfgkdAspzM70v55WyL6I4BHpJgbXISlkQZTdbB09y8RgpdMFmQfheDQfJe', '2018-07-02 02:36:59', '2018-07-02 02:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE IF NOT EXISTS `user_answer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `english_question_id` int(11) NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` float DEFAULT NULL,
  `exam_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_answer`
--

INSERT INTO `user_answer` (`id`, `english_question_id`, `answer`, `score`, `exam_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'grammerA1', 1, 2, '2018-09-08 17:43:44', '2018-09-08 17:43:44'),
(2, 2, 'grammer2a', 0, 2, '2018-09-08 17:43:44', '2018-09-08 17:43:44'),
(3, 4, 'xxxxxxx', 0, 2, '2018-09-08 17:43:44', '2018-09-08 17:48:41'),
(4, 3, 'AudioM1', 1, 2, '2018-09-08 17:43:44', '2018-09-08 17:43:44'),
(5, 5, 'qwqer', 5, 2, '2018-09-08 17:43:44', '2018-09-08 17:48:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
