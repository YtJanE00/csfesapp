-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 09:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcsfes`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_survey`
--

CREATE TABLE `form_survey` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_information` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`question`)),
  `question_rate` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`question_rate`)),
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_survey`
--

INSERT INTO `form_survey` (`id`, `title_id`, `name`, `office`, `contact_information`, `question`, `question_rate`, `feedback`, `feedback2`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', 'dad', 'asd', 'asdasd', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', '{\"1\":\"2\",\"2\":\"5\",\"3\":\"5\",\"4\":\"5\",\"5\":\"5\"}', 'asdasd', 'asdas', 'd7fLKoLb3K9Tj7XlbDx9BdoXtlOA7Xn10IFwMkAIbKXDiSh09QYGFK2bRzGb', '2025-02-23 18:59:22', '2025-02-23 18:59:22'),
(2, '1', 'rozfhdfh', 'dkfsh', '09321564875', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', '{\"1\":\"5\",\"2\":\"5\",\"3\":\"5\",\"4\":\"5\",\"5\":\"1\"}', 'gdfg', 'dgffdg', 'qboIST1HKKqxteQMfXD9EHIJCGWi20DXD2ZoJrDV5zy0RTPH5TJrRN6Gn675', '2025-02-23 19:54:41', '2025-02-23 19:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_25_042605_create_training_title_table', 2),
(6, '2024_05_25_065049_create_training_question_table', 3),
(7, '2024_06_13_134143_create_form_survey_table', 4),
(8, '2025_02_23_142229_create_offices_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(10) UNSIGNED NOT NULL,
  `office_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_abbr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office_name`, `office_abbr`, `created_at`, `updated_at`) VALUES
(9, 'CASHIER', 'CASH', '2023-08-16 17:13:18', '2023-09-05 18:58:51'),
(10, 'LIBRARY', 'LIB', '2023-08-24 21:33:15', '2023-08-24 21:33:15'),
(11, 'COLLEGE OF TEACHER EDUCATION', 'COTED', '2023-09-05 18:56:37', '2023-09-05 18:58:24'),
(14, 'MURCIA EXTENSION CLASS', 'MUR', '2023-09-05 22:15:03', '2023-09-05 22:15:29'),
(18, 'COLLEGE OF BUSINESS MANAGEMENT', 'CBM', '2023-09-25 03:20:23', '2023-09-25 03:20:23'),
(19, 'SECURITY', 'SECU', '2023-09-25 03:47:27', '2023-09-25 03:47:27'),
(20, 'COLLEGE OF ENGINEERING', 'COE', '2023-10-01 03:48:31', '2024-09-02 17:17:41'),
(21, 'COLLEGE OF CRIMINAL JUSTICE EDUCATION', 'CCJE', '2023-10-03 00:16:24', '2024-08-07 21:21:33'),
(22, 'COLLEGE OF ARTS & SCIENCES', 'CAS', '2023-10-03 17:15:10', '2023-10-03 17:15:10'),
(23, 'REGISTRAR', 'REG', '2023-10-05 01:14:22', '2023-10-05 01:14:22'),
(24, 'ACCOUNTING', 'ACC', '2023-10-06 20:47:38', '2024-09-02 22:14:44'),
(25, 'BIDS AND AWARS COMMITEE', 'BAC', '2023-10-06 20:48:30', '2024-07-18 17:39:00'),
(26, 'BOR', 'BOR', '2023-10-06 20:48:54', '2023-10-06 20:48:54'),
(28, 'CHIEF ADMINISTRATIVE OFFICER', 'CAO', '2023-10-06 20:52:00', '2023-10-06 20:52:00'),
(29, 'CATTLE PROJECT', 'CATTLE', '2023-10-06 20:53:07', '2023-10-06 20:53:07'),
(30, 'CLINIC', 'CLINIC', '2023-10-06 20:53:37', '2023-10-06 20:53:37'),
(31, 'CLONAL PROJECT', 'CLONAL', '2023-10-06 20:54:14', '2023-10-06 20:54:14'),
(32, 'COMMISSION ON AUDIT', 'COA', '2023-10-06 20:55:24', '2023-10-06 20:55:24'),
(33, 'DISASTER RISK REDUCTION MANAGEMENT', 'DRRM', '2023-10-06 20:56:34', '2023-10-06 20:56:34'),
(34, 'ELECTRICAL', 'ELECTRIC', '2023-10-06 20:57:15', '2023-10-06 20:57:15'),
(35, 'ENVIRONMENTAL MANAGEMENT SERVICES', 'EMS', '2023-10-06 20:59:01', '2024-09-03 02:02:09'),
(36, 'MANAGEMENT INFORMATION SYSTEM', 'MIS', '2023-10-06 20:59:59', '2024-03-25 19:34:37'),
(37, 'COLLEGE OF AGRICULTURE & FORESTRY', 'CAF', '2023-10-08 03:32:40', '2024-07-14 17:29:32'),
(38, 'ESSENTIAL OIL PROJECT', 'ESSENTIAL', '2023-10-11 18:35:23', '2023-10-11 18:35:23'),
(39, 'EXTENSION AND COMMUNITY SERVICES', 'ECS', '2023-10-11 18:36:17', '2023-10-11 18:36:17'),
(40, 'GENDER AND DEVELOPMENT', 'GAD', '2023-10-11 18:38:01', '2024-01-17 18:15:39'),
(41, 'GRADUATE SCHOOL', 'GRADSCHOOL', '2023-10-11 18:39:20', '2023-10-11 18:39:20'),
(42, 'GREEN TECHNOLOGY', 'GREENTECH', '2023-10-11 18:39:55', '2023-10-11 18:39:55'),
(43, 'GENERAL SERVICES OFFICE', 'GSO', '2023-10-11 18:40:38', '2023-10-11 18:40:38'),
(44, 'GUIDANCE', 'GUI', '2023-10-11 18:41:26', '2023-10-11 18:41:26'),
(45, 'HUMAN RESOURCE MANAGEMENT OFFICE', 'HRMO', '2023-10-11 18:42:28', '2024-08-19 17:09:17'),
(46, 'RESEARCH AND DEVELOPMENT SERVICES', 'RESEARCH', '2023-10-11 19:02:30', '2023-10-11 19:02:30'),
(47, 'IMPDC OFFICE', 'IMPDC', '2023-10-11 20:53:01', '2024-09-04 01:28:36'),
(48, 'INTERNATIONAL AFFAIRS OFFICE', 'IAO', '2023-10-11 20:55:13', '2023-10-11 20:55:13'),
(49, 'IPMO', 'IPMO', '2023-10-11 21:02:06', '2024-09-04 01:51:35'),
(50, 'KSCD', 'KSCD', '2023-10-11 21:05:41', '2023-10-11 21:05:41'),
(51, 'MARCHING BAND', 'MARCH', '2023-10-11 21:07:11', '2023-10-11 21:07:11'),
(52, 'BUDGET OFFICE', 'BUDGET', '2023-10-11 22:34:58', '2023-10-12 16:45:42'),
(53, 'MOTORPOOL OFFICE', 'MOTORPOOL', '2023-10-12 16:49:49', '2023-10-12 16:49:49'),
(54, 'MUSCOVADO', 'MUSCOVADO', '2023-10-12 16:50:39', '2023-10-12 16:50:39'),
(55, 'NATIONAL SERVICE TRAINING PROGRAM OFFICE', 'NSTP', '2023-10-12 16:51:50', '2023-10-12 16:51:50'),
(56, 'OSSA OFFICE', 'OSSA', '2023-10-12 16:54:00', '2024-09-02 21:59:37'),
(57, 'PEDO OFFICE', 'PEDO', '2023-10-12 16:55:18', '2023-10-12 16:55:18'),
(58, 'PLANNING OFFICE', 'PLANNING', '2023-10-12 16:56:28', '2023-10-12 16:56:28'),
(59, 'PMMO OFFICE', 'PMMO', '2023-10-12 16:58:37', '2023-10-12 16:58:37'),
(60, 'POULTRY PROJECT', 'POULTRY', '2023-10-12 16:59:34', '2023-10-12 17:08:19'),
(61, 'PRESIDENTS OFFICE', 'PRESIDENT', '2023-10-12 17:00:04', '2023-10-12 17:00:04'),
(62, 'PROCUREMENT OFFICE', 'PROCUREMENT', '2023-10-12 17:00:34', '2023-10-12 17:00:34'),
(63, 'QUALITY ASSURANCE OFFICE', 'QA', '2023-10-12 17:01:26', '2023-10-12 17:01:26'),
(64, 'RECORDS OFFICE', 'RECORDS', '2023-10-12 17:02:02', '2023-10-12 17:02:02'),
(65, 'SCHOLARSHIP OFFICE', 'SCHOLARSHIP', '2023-10-12 17:03:59', '2023-10-12 17:03:59'),
(66, 'SOIL LABORATORY', 'SOIL LAB', '2023-10-12 17:05:07', '2024-07-22 22:02:52'),
(67, 'SSG OFFICE', 'SSG', '2023-10-12 17:06:02', '2023-10-12 17:06:02'),
(68, 'SUPPLY OFFICE', 'SUPPLY', '2023-10-12 17:06:28', '2023-10-12 17:06:28'),
(69, 'TES OFFICE', 'TES', '2023-10-12 17:06:54', '2023-10-12 17:06:54'),
(70, 'VPAF OFFICE', 'VPAF', '2023-10-12 17:07:46', '2023-10-12 17:07:46'),
(71, 'PUBLIC INFORMATION OFFICE', 'PIO', '2023-10-12 17:08:05', '2024-08-19 17:09:38'),
(72, 'VPAA OFFICE', 'VPAA', '2023-10-12 17:13:22', '2023-10-12 17:13:22'),
(73, 'ASSESSMENT OFFICE', 'ASSESSMENT', '2023-10-12 17:14:27', '2023-10-12 17:14:27'),
(74, 'DCIO / RADYO MUSCOVADO', 'RADYO', '2023-10-12 17:15:53', '2023-11-07 16:55:35'),
(75, 'PHYSICAL PLANT & FACILITIES', 'PPF', '2023-10-12 17:17:11', '2023-10-12 17:17:11'),
(76, 'MUSEUM', 'MUSEUM', '2023-10-12 17:26:25', '2023-10-12 17:26:25'),
(77, 'REVIEW FOR LICENSURE EXAMINATION', 'REVIEW', '2023-10-12 17:29:28', '2024-08-01 00:25:45'),
(78, 'FLP OFFICE', 'FLP', '2023-10-12 17:33:42', '2024-09-18 18:54:11'),
(79, 'JOURNAL OFFICE', 'JOURNAL', '2023-10-12 18:34:12', '2023-10-12 18:34:12'),
(80, 'GOAT PROJECT', 'GOAT', '2023-10-12 18:36:40', '2023-10-12 18:36:40'),
(81, 'RICE PROJECT', 'RICE', '2023-10-12 18:37:10', '2023-10-12 18:37:10'),
(82, 'PAYROLL OFFICE', 'PAYROLL', '2023-10-12 18:38:38', '2024-07-15 16:49:25'),
(83, 'PIGGERY PROJECT', 'PIGGERY', '2023-10-12 18:39:07', '2023-10-12 18:39:07'),
(84, 'ENGINEERED BAMBOO PROJECT', 'BAMBOO', '2023-10-12 18:39:41', '2024-07-18 17:39:12'),
(85, 'QMS OFFICE', 'QMS', '2023-10-12 18:40:15', '2023-10-12 18:40:15'),
(86, 'TRAINING SERVICES', 'TRAINING', '2023-10-12 19:36:17', '2024-09-18 19:54:25'),
(87, 'CURRICULUM PLANNING AND DEVELOPMENT', 'CURRICULUM', '2023-10-12 19:37:14', '2024-09-18 19:57:19'),
(88, 'CARABAO PROJECT', 'CARABAO', '2023-10-12 19:38:25', '2023-10-12 19:38:25'),
(89, 'YEARBOOK OFFICE', 'YEARBOOK', '2023-10-12 19:39:44', '2024-09-18 22:03:58'),
(90, 'FORESTRY DEPARTMENT', 'FORESTRY', '2023-10-12 19:40:27', '2023-10-12 19:40:27'),
(91, 'COLLEGE OF COMPUTER STUDIES', 'CCS', '2023-10-24 02:38:10', '2024-09-02 20:53:20'),
(92, 'LEGAL OFFICE', 'LEGAL', '2023-11-22 00:58:46', '2023-11-22 00:58:46'),
(93, 'INTERNAL AUDIT', 'INTERNAL AUDIT', '2024-01-09 19:19:47', '2024-01-09 19:19:47'),
(94, 'SUPERVISING ADMINISTRATIVE OFFICE - FINANCE', 'SAO - FINANCE', '2024-10-03 22:45:13', '2024-10-03 22:45:13'),
(95, 'SUPERVISING ADMINISTRATIVE OFFICE - ADMINISTRATION', 'SAO - ADMINISTRATION', '2024-10-03 22:47:23', '2024-10-03 22:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_question`
--

CREATE TABLE `training_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_question`
--

INSERT INTO `training_question` (`id`, `title_id`, `question`, `question_rate`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Venue of the training/workshop', NULL, '6foum3iT3bkgP2deqfGccNeKxwDknoRWiFJAyoGGdeyZhZ7dePPs0OacPz41', '2025-02-23 17:27:06', '2025-02-23 17:27:06'),
(2, 1, 'Speaker’s competency and mastery of the subject matter', NULL, 'zt41N5IEqZ4f5Kzjs423uiVnNGBuRveHKQgj8eWS3eTlqJTFCyIXKy2AK4R4', '2025-02-23 17:27:22', '2025-02-23 17:27:22'),
(3, 1, 'Relevance of the topic(s)', NULL, 'Z9nKO1AX8sjzLjJZPdiLaNe7EG9tbSpOe5FzMCR2ukbJrGjbTW69fpDWpAiO', '2025-02-23 17:27:28', '2025-02-23 17:27:28'),
(4, 1, 'Organization and clarity of presentation', NULL, 'f58rolEOQEmTwQXtqDBRyPy9XadEm1f7Iir5QgBBKDcEf65xhMGGjaISNOvN', '2025-02-23 17:27:35', '2025-02-23 17:27:35'),
(5, 1, 'Opportunities for discussions', NULL, 'fK9sVwUAjgqKxLpbAcrGlrO09FsunX51gF5HxKkOTDNRHRmItb4AVwc0FGcC', '2025-02-23 17:27:41', '2025-02-23 17:27:41'),
(6, 2, 'Speaker is Knowledgable', NULL, 'XFI4vFlYz3Wsp8oUCBEwgxkIaU1SDB637wecGSpmX25ArG4dB1JLGycGDuRG', '2025-02-23 17:46:15', '2025-02-23 17:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `training_title`
--

CREATE TABLE `training_title` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `speaker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_venue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surveylink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postedBy` int(11) NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_title`
--

INSERT INTO `training_title` (`id`, `title`, `office`, `speaker`, `training_date`, `training_venue`, `surveylink`, `postedBy`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Basic Microsoft Tools Community Training', 'CCS', 'All CCS Faculty', '2025-02-24', 'Brgy. Camingawan Covered Court', 'http://localhost/csfes/public/survey/1/rSHN8NM6XbbpBcX6zoCBTbRsLupaLX04mXmeEGZ1kuKeIT1Jw6LTYnETF2Vs', 2, '0LcDQsRJsKSJ7xSpn1h5n7SODKeQkfuyBLnIKO1EIGPm4jAi4vmNzazPLJ9z', '2025-02-23 17:25:48', '2025-02-23 17:25:48'),
(2, 'Basic Canva Tips Training', 'CCS', 'All CCS Faculty', '2025-02-28', 'CS Lab 1', 'http://localhost/csfes/public/survey/2/vHeRVHvZn8LKzGXuFWodIEksTcEqQBDQYUIFZ5Wegt6PeUkWEiIJtWG61eUE', 2, 'vGl58eG46oUNuTAmd6MtkHrmr3DW6QKw0JJ69NOeDomzerh7A5D2KcYKV91t', '2025-02-23 17:44:31', '2025-02-23 17:44:31'),
(4, 's', 'CCS', 's', '2025-02-24', 's', 'http://localhost/csfes/public/survey/4/dDZAKgyHmt0lRF2zr8bvQUXcJC8TEWW44qT4lAx1sXhZAr46UWmnATkdgxZE', 2, 'lEk5VTDeIFc4Iw8YYfqujXIBjbbZ35lQvX1CfAQ4LieDmGHuaxxcVMEWaCgF', '2025-02-23 17:52:11', '2025-02-23 17:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campus` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dept` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `campus`, `dept`, `lname`, `fname`, `mname`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'MC', 'Admin', 'Level', 'Admin', 'A', 'admin@cpsu.edu.ph', NULL, '$2a$12$kaj3fnkDbv1OCU4/k1ahjeCqVRlEranjp6jXRWvyDCdM1gq6zs6Om', 'Administrator', 'ea7PTltKnaHzfaSGXScpbpK6QmDRGeMRvZ7EKVTuWQe3ReEm8jK7Z19ka182', '2025-02-23 13:17:11', '2025-02-23 14:17:11'),
(2, 'MC', 'CCS', 'Cofino', 'Chester', 'L.', 'facultyccs@cpsu.edu.ph', NULL, '$2y$10$CP32WGHWPMJ7gADMLEsHLejZN7Kw3VEsdAO9r4KmDRmlxI6eeUwUC', 'User', 'csKJttcC7NCYs18WWAVqwIBkbr0dq9HBmxUWzK0heLnh2sYAfArVgS9iU3xb', '2025-02-23 16:51:48', '2025-02-23 16:51:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_survey`
--
ALTER TABLE `form_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `training_question`
--
ALTER TABLE `training_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_title`
--
ALTER TABLE `training_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_survey`
--
ALTER TABLE `form_survey`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_question`
--
ALTER TABLE `training_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `training_title`
--
ALTER TABLE `training_title`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
