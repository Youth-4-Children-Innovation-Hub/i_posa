-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2024 at 11:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `hod_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Ownership` varchar(255) DEFAULT NULL,
  `Funders` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `name`, `district_id`, `hod_id`, `created_at`, `updated_at`, `Ownership`, `Funders`) VALUES
(1, 'chitete', 1, 80, '2023-11-19 03:53:23', '2024-04-14 11:05:30', 'VETA', 'UNICEF'),
(3, 'Mwaka', 2, 9, '2023-12-07 18:46:17', '2024-04-05 19:24:45', 'TCU', 'USAID'),
(5, 'Ihanda', 1, 48, '2024-01-20 09:56:52', '2024-01-20 09:56:52', NULL, NULL),
(6, 'Nyerere', 2, 82, '2024-04-15 12:58:18', '2024-04-15 12:58:18', NULL, NULL),
(7, 'Wailes', 4, 86, '2024-04-16 09:59:31', '2024-04-16 09:59:31', NULL, NULL),
(8, 'Bahati', 4, 89, '2024-04-16 10:02:56', '2024-04-16 10:02:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `center_reports`
--

CREATE TABLE `center_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `uploaded_by` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `dist_approval` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `reg_approval` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `nat_status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `center_reports`
--

INSERT INTO `center_reports` (`id`, `name`, `uploaded_by`, `user_id`, `dist_approval`, `reg_approval`, `nat_status`, `created_at`, `updated_at`) VALUES
(3, 'Quarter_report_1710496545.pdf', 'mary mary', 4, 3, 1, 'new', '2024-03-15 06:55:47', '2024-03-15 07:07:26'),
(4, 'Quarter_report_1710497320.pdf', 'mary mary', 4, 2, 3, 'new', '2024-03-15 07:08:44', '2024-03-15 07:12:38'),
(6, 'Quarter_report_1710529093.pdf', 'Jovin Sanga', 48, 1, 1, 'new', '2024-03-15 15:58:34', '2024-03-15 15:58:34'),
(12, 'Quarter_report_1710593981.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-03-16 09:59:48', '2024-03-16 10:14:55'),
(13, 'Quarter_report_1710594574.pdf', 'mary mary', 4, 3, 1, 'new', '2024-03-16 10:09:36', '2024-03-16 10:18:17'),
(14, 'Quarter_report_1710683140.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-03-17 10:45:42', '2024-03-17 11:48:29'),
(15, 'Quarter_report_1710687219.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-03-17 11:53:41', '2024-03-17 11:56:07'),
(16, 'Quarter_report_1710687447.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-03-17 11:57:29', '2024-03-17 11:58:10'),
(17, 'Quarter_report_1710687578.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-03-17 11:59:45', '2024-03-17 12:00:27'),
(18, 'Quarter_report_1710687643.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-03-17 12:00:45', '2024-03-17 12:03:49'),
(19, 'Quarter_report_1710687979.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-03-17 12:06:21', '2024-03-17 12:07:40'),
(20, 'Quarter_report_1710688153.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-03-17 12:09:14', '2024-03-17 16:09:00'),
(21, 'Quarter_report_1710702827.pdf', 'Jovin Sanga', 48, 3, 1, 'opened', '2024-03-17 16:13:49', '2024-03-20 10:23:25'),
(24, 'Quarter_report_1713334943.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-04-17 03:22:24', '2024-04-17 03:52:01'),
(25, 'Quarter_report_1713336517.pdf', 'Jovin Sanga', 48, 3, 1, 'new', '2024-04-17 03:48:41', '2024-04-17 03:53:10'),
(27, 'Quarter_report_1713351554.pdf', 'Jovin Sanga', 48, 2, 3, 'new', '2024-04-17 07:59:17', '2024-04-17 08:01:36'),
(28, 'Quarter_report_1713351765.pdf', 'Jovin Sanga', 48, 1, 1, 'opened', '2024-04-17 08:02:47', '2024-04-17 08:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `challenges` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `introduction`, `challenges`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'intro', '1.dfkhsdhfs\r\n2.dhifsdfisdfsd\r\n3.hfdjsfhisdfs', 4, '2024-03-27 09:02:56', '2024-03-27 10:23:01'),
(2, 'This is the introduction to the report', 'Challenges we faced so far are:\n1,Lack of tools\n2.Lack of proper training for entrepreneurship', 48, '2024-04-08 10:30:29', '2024-04-17 03:26:53'),
(3, 'jfhusdfgdfsd djfhudg', 'hduugfyusgd', 82, '2024-04-15 16:41:26', '2024-04-15 16:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Funding_sources` varchar(255) NOT NULL,
  `Registration_status` varchar(255) NOT NULL,
  `Chairperson` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Asset` varchar(255) NOT NULL,
  `Capital` bigint(20) UNSIGNED NOT NULL,
  `QA_Contact` varchar(255) NOT NULL,
  `Center_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `Name`, `Funding_sources`, `Registration_status`, `Chairperson`, `Contact`, `Email`, `Asset`, `Capital`, `QA_Contact`, `Center_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'AGRICULTURE', 'UNICEF,MUST', 'good', 'Alexander Hayes', '075555555', 'alexanderhayes@gmail.com', 'axe', 1000000, 'Yes', 1, NULL, '2024-01-15 04:06:15', '2024-01-15 04:06:15'),
(2, 'TOP CHEFS', 'UNICEF', 'good', 'Mia Rodriguez', '075555556', 'miarodriguez@gmail.com', 'plate,spoon', 1000000, 'Yes', 1, NULL, '2024-01-15 04:26:53', '2024-01-15 04:26:53'),
(3, 'THE CURRENT', 'UNICEF', 'good', 'Nolan Thompson', '075555557', 'nolan.thompson@mail.net', 'wires,bulb.battery', 1000000, 'Yes', 1, NULL, '2024-01-15 04:33:34', '2024-01-15 04:33:34'),
(4, 'MISHUMAA', 'UNICEF,DIT', 'good', 'Isabella Patel', '075555558', 'isabella.patel@testmail.org', 'candles', 1000000, 'Yes', 1, NULL, '2024-01-15 04:35:32', '2024-01-15 04:35:32'),
(5, 'EXERCISE', 'TFF', 'good', 'Elijah Foster', '075555559', 'elijah.foster@gmail.com', 'ball,jersey', 1000000, 'Yes', 1, NULL, '2024-01-15 04:37:32', '2024-01-15 04:37:32'),
(6, 'DRIVERS', 'VETA', 'good', 'SOPHIA CHEN', '075555567', 'sophia.chen@dummymail.co', 'car', 2000000, 'Yes', 1, NULL, '2024-01-15 05:48:19', '2024-01-15 05:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cookery', '2023-11-19 04:06:16', '2024-04-09 09:37:24'),
(7, 'agriculture', '2023-12-25 03:54:04', '2023-12-25 03:54:04'),
(8, 'electrical', '2024-01-10 02:04:18', '2024-01-10 02:04:18'),
(9, 'candle making', '2024-01-10 02:04:45', '2024-01-10 02:04:45'),
(10, 'jelly', '2024-01-10 02:05:03', '2024-01-10 02:05:03'),
(11, 'carpentry', '2024-01-10 02:05:26', '2024-01-10 02:05:26'),
(12, 'driving', '2024-01-10 02:05:43', '2024-01-10 02:05:43'),
(13, 'P.E', '2024-01-10 02:06:03', '2024-01-10 02:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `course_centers`
--

CREATE TABLE `course_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_centers`
--

INSERT INTO `course_centers` (`id`, `course_id`, `center_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2023-12-12 11:49:22', '2023-12-12 11:49:22'),
(3, 7, 1, 5, '2024-01-10 02:15:58', '2024-01-10 02:15:58'),
(4, 8, 1, 4, '2024-01-10 02:16:10', '2024-01-10 02:16:10'),
(6, 10, 1, 7, '2024-01-10 02:16:31', '2024-01-10 02:16:31'),
(7, 11, 1, 8, '2024-01-10 02:16:44', '2024-01-10 02:16:44'),
(10, 1, 5, 9, '2024-01-20 10:00:29', '2024-04-09 10:03:54'),
(11, 8, 5, 13, '2024-01-20 10:26:12', '2024-01-20 10:26:12'),
(12, 11, 6, 15, '2024-04-15 13:19:01', '2024-04-15 13:19:01'),
(13, 8, 6, 16, '2024-04-15 13:30:01', '2024-04-15 13:30:01'),
(14, 1, 6, 17, '2024-04-15 13:46:52', '2024-04-15 13:46:52'),
(15, 7, 7, 18, '2024-04-18 04:19:33', '2024-04-18 04:19:33'),
(16, 1, 7, 19, '2024-04-18 04:19:44', '2024-04-18 04:19:44'),
(17, 11, 7, 20, '2024-04-18 04:20:08', '2024-04-18 04:20:08'),
(18, 12, 8, 21, '2024-04-18 07:16:55', '2024-04-18 07:16:55'),
(19, 1, 8, 23, '2024-04-18 07:17:12', '2024-04-18 07:17:12'),
(20, 9, 8, 22, '2024-04-18 07:17:32', '2024-04-18 07:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `cordinator_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `cordinator_id`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'momba', 47, 1, '2023-11-19 03:48:34', '2024-01-20 04:56:23'),
(2, 'tunduma', 83, 1, '2023-12-07 17:59:38', '2024-04-15 14:13:47'),
(4, 'Temeke', 85, 4, '2024-04-16 09:58:51', '2024-04-16 09:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) NOT NULL,
  `disability` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`id`, `name`, `phone`, `email`, `address`, `occupation`, `disability`, `region`, `district`, `ward`, `student_id`, `created_at`, `updated_at`) VALUES
(5, 'Vina Majuu Moses', '0757239878', 'vinamajuu@gmail.com', 'P.o Box 454', 'Business', 'None', 'Mbeya', 'Momba', 'Queens', 28, '2024-04-08 17:15:16', '2024-04-08 20:40:10'),
(6, 'Japhaly Makuba', '0757239876', 'japhaly@gmail.com', 'P.o Box 454', 'Business', 'None', 'Mbeya', 'Tunduma', 'Majengo', 29, '2024-04-08 17:30:17', '2024-04-08 19:57:23'),
(7, 'Londo Smith', '0757239878', 'londosmith@gmail.com', 'P.o Box 400', 'Teacher', 'None', 'Songwe', 'Ileje', 'Native', 30, '2024-04-14 09:50:44', '2024-04-14 09:50:44'),
(8, 'John Johnson', '0757239877', 'johnjohnson@gmail.com', 'P.o Box 454', 'Business', 'None', 'Songwe', 'Ileje', 'Native', 31, '2024-04-14 09:56:46', '2024-04-14 09:56:46'),
(9, 'Willow Williams', '0757239877', 'willowwilliam@gmail.com', 'P.o Box 454', 'Teacher', 'Disabled', 'Songwe', 'Ileje', 'Sunna', 32, '2024-04-14 10:02:20', '2024-04-14 10:02:20'),
(10, 'Bocha Brown', '0657239890', 'bochabrown@gmail.com', 'P.o Box 454', 'Business', 'None', 'Songwe', 'Ileje', 'Native', 33, '2024-04-14 10:08:03', '2024-04-14 10:08:03'),
(11, 'Jona Jones', '0657239890', 'jonajones@gmail.com', 'P.o Box 400', 'Teacher', 'None', 'Songwe', 'Ileje', 'Native', 34, '2024-04-14 10:12:46', '2024-04-14 10:12:46'),
(12, 'David Davis', '0789123456', 'daviddavis@gmail.com', 'P.o Box 454', 'Lawyer', 'None', 'Songwe', 'Ileje', 'Native', 35, '2024-04-14 10:41:09', '2024-04-14 10:41:09'),
(13, 'Mia Miller', '0757239878', 'miamiller@gmail.com', 'P.o Box 454', 'Tailor', 'None', 'Songwe', 'Ileje', 'Native', 36, '2024-04-14 10:45:51', '2024-04-14 10:45:51'),
(14, 'Jovin Garcia', '0657239890', 'jagarcia@gmail.com', 'P.o Box 400', 'Lawyer', 'None', 'Songwe', 'Ileje', 'Native', 37, '2024-04-14 10:53:10', '2024-04-14 10:53:10'),
(15, 'Rodger Rodriguez', '0657239890', 'rodgerrodriguez@gmail.com', 'P.o Box 454', 'Teacher', 'None', 'Songwe', 'Mbozi', 'Tunu', 38, '2024-04-14 11:16:49', '2024-04-14 11:16:49'),
(16, 'Martin Martinez', '0657239890', 'martmart@gmail.com', 'P.o Box 454', 'Tailor', 'None', 'Songwe', 'Mbozi', 'Tunu', 39, '2024-04-14 11:21:10', '2024-04-14 11:21:10'),
(18, 'Luna Lopez', '0757239876', 'lunalopez@gmail.com', 'P.o Box 454', 'Teacher', 'None', 'Songwe', 'Mbozi', 'Tunu', 41, '2024-04-14 12:04:13', '2024-04-14 12:04:13'),
(20, 'Inna Gonzalez', '0757239878', 'innagonza@gmail.com', 'P.o Box 454', 'Tailor', 'None', 'Songwe', 'Mbozi', 'Tunu', 43, '2024-04-14 12:11:29', '2024-04-14 12:11:29'),
(21, 'Percy Perez', '0757239878', 'percypere@gmail.com', 'P.o Box 454', 'Lawyer', 'None', 'Songwe', 'Mbozi', 'Tunu', 44, '2024-04-14 12:15:26', '2024-04-14 12:15:26'),
(22, 'Martin Sanchez', '0757239876', 'martinsanche@gmail.com', 'P.o Box 454', 'Teacher', 'None', 'Songwe', 'Mbozi', 'Tunu', 45, '2024-04-14 12:19:10', '2024-04-14 12:19:10'),
(23, 'William Wilson', '0757239876', 'willywilson@gmail.com', 'P.o Box 454', 'Tailor', 'None', 'Songwe', 'Mbozi', 'Tunu', 46, '2024-04-14 12:22:45', '2024-04-14 12:22:45'),
(24, 'Dale Rivera', '0657239890', 'dalerivale@gmail.com', 'P.o Box 400', 'Teacher', 'None', 'Songwe', 'Mbozi', 'Tunu', 47, '2024-04-14 12:26:38', '2024-04-14 12:26:38'),
(25, 'Unna Young', '0757239878', 'unnayoun@gmail.com', 'P.o Box 400', 'Tailor', 'None', 'Songwe', 'Mbozi', 'Tunu', 48, '2024-04-14 12:31:48', '2024-04-14 12:31:48'),
(26, 'Terran Torres', '0757239878', 'terratorre@gmail.com', 'P.o Box 454', 'Lawyer', 'None', 'Songwe', 'Mbozi', 'Tunu', 49, '2024-04-14 12:35:33', '2024-04-14 12:35:33'),
(27, 'Yugo Nguyen', '0757239876', 'yugonguy@gmail.com', 'P.o Box 400', 'Driver', 'None', 'Songwe', 'Mbozi', 'Tunu', 50, '2024-04-14 12:39:56', '2024-04-14 12:39:56'),
(28, 'Monre Moore', '0757239876', 'monmoore@gmail.com', 'P.o Box 454', 'Chef', 'None', 'Songwe', 'Mbozi', 'Tunu', 51, '2024-04-14 12:45:20', '2024-04-14 12:45:20'),
(29, 'Leon Lewis', '0757239876', 'leonlewis@gmail.com', 'P.o Box 454', 'Tailor', 'None', 'Songwe', 'Mbozi', 'Tunu', 52, '2024-04-14 12:49:19', '2024-04-14 12:49:19'),
(30, 'Jetkins Johnson', '0657239890', 'jetkinsjohn@gmail.com', '', 'Agriculture', 'None', 'Songwe', 'Tunduma', 'Nyerere', 53, '2024-04-15 13:23:45', '2024-04-15 13:23:45'),
(31, 'Patel Patel', '0757239876', 'patel@gmail.com', 'P.o Box 400', 'Business', 'None', 'Songwe', 'Tunduma', 'Nyerere', 54, '2024-04-15 13:27:54', '2024-04-15 13:27:54'),
(32, 'Thomson Jack', '0757239876', 'jacktom@gmail.com', 'P.o Box 999', 'Chef', 'None', 'Songwe', 'Tunduma', 'Nyerere', 55, '2024-04-15 13:36:39', '2024-04-15 13:36:39'),
(33, 'Murphy Dalot', '0757239876', 'londosmith5453@gmail.com', 'P.o Box 999', 'Business', 'None', 'Songwe', 'Tunduma', 'Majengo', 56, '2024-04-15 13:45:47', '2024-04-15 13:45:47'),
(34, 'Garcia Bilali', '0657239890', 'dfdsfj88@gmail.com', 'P.o Box 999', 'Chef', 'None', 'Songwe', 'Momba', 'Queens', 57, '2024-04-15 13:50:42', '2024-04-15 13:50:42'),
(35, 'Clark Saka', '0757239876', 'clarkjdhf@gmail.com', 'P.o Box 999', 'Agriculture', 'None', 'Songwe', 'Tunduma', 'Tunu', 58, '2024-04-15 13:55:23', '2024-04-15 13:55:23'),
(36, 'King Kingston', '0757239876', 'king234@gmail.com', 'P.o Box 999', 'Lawyer', 'None', 'Songwe', 'Tunduma', 'Nyerere', 59, '2024-04-15 13:59:28', '2024-04-15 13:59:28'),
(37, 'Lee Lish', '0757239876', 'lishka@gmail.com', 'P.o Box 999', 'Teacher', 'Disabled', 'Songwe', 'Tunduma', 'Tunu', 60, '2024-04-15 14:03:28', '2024-04-15 14:03:28'),
(38, 'Turner Kisco', '0757239876', 'kisko@gmail.com', 'P.o Box 999', 'Teacher', 'None', 'Songwe', 'Tunduma', 'Nyerere', 61, '2024-04-15 14:08:01', '2024-04-15 14:08:01'),
(39, 'Baron Brown', '0757239877', 'baronbrown@gmail.com', 'P.o Box 999', 'Teacher', 'None', 'Dar Es Salaam', 'Temeke', 'Chamazi', 62, '2024-04-18 04:30:26', '2024-04-18 04:30:26'),
(40, 'June Jones', '0713123456', 'june@gmail.com', 'P.o Box 454', 'Tailor', 'None', 'Dar Es Salaam', 'Temeke', 'Chamazi', 63, '2024-04-18 04:34:39', '2024-04-18 04:34:39'),
(41, 'Lian Christopher', '0757239876', 'lianchristopher@gmail.com', 'P.o Box 400', 'Driver', 'None', 'Dar Es Salaam', 'Temeke', 'Keko', 64, '2024-04-18 04:39:43', '2024-04-18 04:39:43'),
(42, 'Miller Martinez', '0757239878', 'martinez09@gmail.com', 'P.o Box 454', 'Doctor', 'None', 'Dar Es Salaam', 'Temeke', 'Chamazi', 65, '2024-04-18 04:44:56', '2024-04-18 04:44:56'),
(43, 'Given Garcia', '0757239876', 'given@gmail.com', 'P.o Box 454', 'Driver', 'None', 'Dar Es Salaam', 'Temeke', 'Chamazi', 66, '2024-04-18 05:06:20', '2024-04-18 05:06:20'),
(44, 'Thomas Thompson', '0757239877', 'thomasthompson@gmail.com', 'P.o Box 454', 'Teacher', 'Disabled', 'Dar Es Salaam', 'Temeke', 'Keko', 67, '2024-04-18 05:12:50', '2024-04-18 05:13:02'),
(45, 'Andrew Anderson', '0657239890', 'andrewander@gmail.com', 'P.o Box 454', 'Teacher', 'None', 'Dar Es Salaam', 'Temeke', 'Keko', 68, '2024-04-18 05:21:17', '2024-04-18 05:21:17'),
(46, 'Brown Gadafi', '0657239890', 'bgadafi@gmail.com', 'P.o Box 400', 'Tailor', 'Disabled', 'Dar Es Salaam', 'Temeke', 'Chamazi', 69, '2024-04-18 05:26:50', '2024-04-18 05:26:50'),
(47, 'Clarence Clark', '0757239879', 'clarenceclar@gmail.com', 'P.o Box 999', 'Teacher', 'None', 'Dar Es Salaam', 'Temeke', 'Chamazi', 70, '2024-04-18 06:47:08', '2024-04-18 06:47:08'),
(48, 'Milan Miller', '0757239878', 'milanmiller@gmail.com', 'P.o Box 454', 'Lawyer', 'None', 'Dar Es Salaam', 'Temeke', 'Keko', 71, '2024-04-18 06:52:48', '2024-04-18 06:52:48'),
(49, 'Smith Taylor', '0757239877', 'smithtay@gmail.com', 'P.o Box 999', 'Teacher', 'None', 'Dar Es Salaam', 'Temeke', 'Chamazi', 72, '2024-04-18 06:58:29', '2024-04-18 06:58:29'),
(50, 'Lilian John', '0757239878', 'lilyjohn@gmail.com', 'P.o Box 454', 'Teacher', 'None', 'Dar Es Salaam', 'Temeke', 'Azimio', 73, '2024-04-18 08:08:37', '2024-04-18 08:08:37'),
(51, 'Taylor Clark', '0757239876', 'taylorclark@gmail.com', 'P.o Box 999', 'Doctor', 'None', 'Dar Es Salaam', 'Temeke', 'Azimio', 74, '2024-04-18 08:12:48', '2024-04-18 08:12:48'),
(52, 'Daniel Thompson', '0757239878', 'danielwilson@gmail.com', 'P.o Box 454', 'Tailor', 'Disabled', 'Dar Es Salaam', 'Temeke', 'Azimio', 75, '2024-04-18 08:17:31', '2024-04-18 08:17:31'),
(53, 'Kevin Miller', '0757239878', 'kevmiller@gmail.com', 'P.o Box 454', 'Tailor', 'None', 'Dar Es Salaam', 'Temeke', 'Buza', 76, '2024-04-18 08:27:13', '2024-04-18 08:27:13'),
(54, 'Chris Garcia', '0657239890', 'chrisgarcia@gmail.com', 'P.o Box 454', 'Doctor', 'None', 'Dar Es Salaam', 'Temeke', 'Buza', 77, '2024-04-18 08:31:36', '2024-04-18 08:31:36'),
(55, 'Anderson Pazi', '0757239876', 'anderpazi@gmail.com', 'P.o Box 454', 'Lawyer', 'None', 'Dar Es Salaam', 'Temeke', 'Buza', 78, '2024-04-18 08:42:23', '2024-04-18 08:42:23'),
(56, 'Juma Wilson', '0757239878', 'jumawil@gmail.com', 'P.o Box 999', 'Chef', 'None', 'Dar Es Salaam', 'Temeke', 'Azimio', 79, '2024-04-18 08:48:59', '2024-04-18 08:48:59'),
(57, 'Kelvin Christopher', '0757239878', 'kelvinchris@gmail.com', 'P.o Box 999', 'Teacher', 'None', 'Dar Es Salaam', 'Temeke', 'Buza', 80, '2024-04-18 08:59:25', '2024-04-18 08:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `number`, `condition`, `course_id`, `center_id`, `created_at`, `updated_at`) VALUES
(3, 'kijiko', '10', 'good', 1, 5, '2024-04-05 18:05:40', '2024-04-05 18:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_requests`
--

CREATE TABLE `inventory_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_14_072545_create_roles_table', 1),
(6, '2023_10_20_151259_create_courses_table', 2),
(8, '2023_04_11_160505_create_inventory_requests_table', 3),
(9, '2023_10_17_000000_create_users_table', 4),
(10, '2023_10_18_161000_create_regions_table', 5),
(11, '2023_05_31_214157_create_districts_table', 6),
(12, '2023_10_19_090723_create_centers_table', 7),
(15, '2023_06_03_154417_create_student_courses_table', 9),
(16, '2023_08_08_080644_create_reports_table', 9),
(17, '2023_08_14_083744_create_notifications_table', 9),
(26, '2023_11_27_125600_create_newrepports_table', 11),
(28, '2023_06_02_085401_create_teachers_table', 13),
(29, '2023_05_31_231629_create_course_centers_table', 14),
(30, '2023_10_20_160758_create_students_table', 15),
(31, '2024_01_11_055905_add_columns_to_center', 16),
(38, '2024_01_12_130751_clubs', 18),
(42, '2024_01_24_220846_add_column_name_to_center_reports', 20),
(47, '2023_03_31_063916_create_inventories_table', 23),
(49, '2024_01_18_092537_create_center_reports_table', 24),
(50, '2024_01_31_190600_create_remarks_table', 25),
(52, '2024_03_16_095705_add_column_to_table', 26),
(54, '2024_03_27_111530_create_challenges_table', 27),
(59, '2024_04_08_115510_remove_data__from_students_table', 29),
(60, '2024_01_11_070517_add_columns_to_students', 30),
(61, '2024_04_08_114401_create_parents_table', 31);

-- --------------------------------------------------------

--
-- Table structure for table `newrepports`
--

CREATE TABLE `newrepports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Title` varchar(255) NOT NULL,
  `student` bigint(20) UNSIGNED NOT NULL,
  `course` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `status` bigint(20) UNSIGNED DEFAULT NULL,
  `upload_user_id` bigint(20) UNSIGNED NOT NULL,
  `approve_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newrepports`
--

INSERT INTO `newrepports` (`id`, `Title`, `student`, `course`, `description`, `attachment`, `status`, `upload_user_id`, `approve_user_id`, `comment`, `created_at`, `updated_at`) VALUES
(2, 'mid year report', 100, 10, 'great progress', 'flowchart (3).pdf', NULL, 4, NULL, NULL, '2023-12-05 01:05:56', '2023-12-05 01:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03eb3c7f-aca0-4958-a1a7-d75a47432747', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706136586.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-24T22:49:53.000000Z\",\"created_at\":\"2024-01-24T22:49:53.000000Z\",\"id\":5}}', '2024-01-24 19:50:00', '2024-01-24 19:49:53', '2024-01-24 19:50:00'),
('04057105-08a5-4075-8f78-672a54fc570b', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":3,\"updated_at\":\"2023-11-20T08:05:42.000000Z\",\"created_at\":\"2023-11-20T08:05:42.000000Z\",\"id\":7}}', '2023-11-20 05:06:11', '2023-11-20 05:05:42', '2023-11-20 05:06:11'),
('094977e3-7e45-4664-b718-278427d848c4', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706170130.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-01-25T08:09:10.000000Z\",\"created_at\":\"2024-01-25T08:09:10.000000Z\",\"id\":11}}', '2024-01-25 05:09:16', '2024-01-25 05:09:10', '2024-01-25 05:09:16'),
('0c51492a-3bff-4010-a1e3-719cf07379fd', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710495438.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-03-15T09:37:21.000000Z\",\"created_at\":\"2024-03-15T09:37:21.000000Z\",\"id\":2}}', '2024-03-15 06:37:46', '2024-03-15 06:37:21', '2024-03-15 06:37:46'),
('0d1b52bc-70b0-44e7-9f93-dd81dc78d8c9', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710687643.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T15:00:45.000000Z\",\"created_at\":\"2024-03-17T15:00:45.000000Z\",\"id\":18}}', '2024-03-17 12:03:43', '2024-03-17 12:00:45', '2024-03-17 12:03:43'),
('1071f59f-244b-4044-8801-0150762c6a9d', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":42,\"name\":\"Quarter_report_1707379136.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"Approval\":2,\"created_at\":\"2024-02-08T07:59:03.000000Z\",\"updated_at\":\"2024-02-08T08:04:17.000000Z\"}}', '2024-03-12 17:07:29', '2024-02-08 05:04:17', '2024-03-12 17:07:29'),
('11dbb877-1805-4c8b-b1a0-64bbe3da0cfd', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":4,\"updated_at\":\"2023-11-18T20:25:18.000000Z\",\"created_at\":\"2023-11-18T20:25:18.000000Z\",\"id\":3}}', '2023-11-18 17:25:54', '2023-11-18 17:25:18', '2023-11-18 17:25:54'),
('133898b1-a3ce-43b8-8ce7-4a025340e402', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706163319.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-25T06:15:39.000000Z\",\"created_at\":\"2024-01-25T06:15:39.000000Z\",\"id\":8}}', '2024-01-25 03:24:46', '2024-01-25 03:15:39', '2024-01-25 03:24:46'),
('193ea617-3d17-447b-8f36-1f376baf3e00', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706794423.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:34:03.000000Z\",\"created_at\":\"2024-02-01T13:34:03.000000Z\",\"id\":31}}', '2024-02-01 10:38:19', '2024-02-01 10:34:03', '2024-02-01 10:38:19'),
('1fc15e44-ef5a-47a6-aedc-06597cba7ce2', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710688153.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T15:09:14.000000Z\",\"created_at\":\"2024-03-17T15:09:14.000000Z\",\"id\":20}}', '2024-03-17 16:08:39', '2024-03-17 12:09:15', '2024-03-17 16:08:39'),
('1fd262ce-b98f-4eb4-87fe-3e7d26e57e9f', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710580823.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-16T09:20:24.000000Z\",\"created_at\":\"2024-03-16T09:20:24.000000Z\",\"id\":10}}', '2024-03-16 06:20:36', '2024-03-16 06:20:25', '2024-03-16 06:20:36'),
('277c9c4a-041f-42e3-981c-38e12d1374e6', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":9,\"name\":\"Quarter_report_1710580524.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-16T09:15:26.000000Z\",\"updated_at\":\"2024-03-16T09:15:39.000000Z\"}}', '2024-03-16 06:15:48', '2024-03-16 06:15:39', '2024-03-16 06:15:48'),
('2832c458-b2d1-4441-b783-5969a31225af', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706771763.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T07:16:23.000000Z\",\"created_at\":\"2024-02-01T07:16:23.000000Z\",\"id\":25}}', '2024-02-01 04:16:34', '2024-02-01 04:16:24', '2024-02-01 04:16:34'),
('292228b1-b5b0-4052-8235-7be01db9703b', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706770790.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-01T07:00:10.000000Z\",\"created_at\":\"2024-02-01T07:00:10.000000Z\",\"id\":23}}', '2024-02-01 04:11:37', '2024-02-01 04:00:10', '2024-02-01 04:11:37'),
('2b9c5b1d-7885-46e0-8de8-45007ce18047', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706747621.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-01T00:33:44.000000Z\",\"created_at\":\"2024-02-01T00:33:44.000000Z\",\"id\":20}}', '2024-01-31 21:33:49', '2024-01-31 21:33:44', '2024-01-31 21:33:49'),
('344c4404-5e9d-40a6-b533-92aa4059ddca', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":24,\"name\":\"Quarter_report_1706771549.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"Approval\":2,\"created_at\":\"2024-02-01T07:12:49.000000Z\",\"updated_at\":\"2024-02-01T07:13:23.000000Z\"}}', '2024-02-01 04:14:35', '2024-02-01 04:13:23', '2024-02-01 04:14:35'),
('34626a6c-bc31-413f-8170-f37a5354d1d1', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706770739.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-01T06:59:19.000000Z\",\"created_at\":\"2024-02-01T06:59:19.000000Z\",\"id\":22}}', '2024-02-01 04:11:37', '2024-02-01 03:59:19', '2024-02-01 04:11:37'),
('348dce88-4dd1-43b2-8f7f-cd911303b986', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":4,\"name\":\"Quarter_report_1710497320.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-15T10:08:44.000000Z\",\"updated_at\":\"2024-03-15T10:09:24.000000Z\"}}', '2024-03-15 07:10:25', '2024-03-15 07:09:24', '2024-03-15 07:10:25'),
('3b071b30-4500-4fab-a82a-b92a07f29419', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710703008.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T19:16:50.000000Z\",\"created_at\":\"2024-03-17T19:16:50.000000Z\",\"id\":22}}', '2024-03-20 10:16:57', '2024-03-17 16:16:50', '2024-03-20 10:16:57'),
('3b6f2bc9-c1f9-45d6-9687-72f3d6a2b8e0', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710581630.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-16T09:33:51.000000Z\",\"created_at\":\"2024-03-16T09:33:51.000000Z\",\"id\":11}}', '2024-03-16 06:34:05', '2024-03-16 06:33:51', '2024-03-16 06:34:05'),
('3cb4def3-8f83-4329-a29f-c9f409e962f8', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"id\":10,\"name\":\"Quarter_report_1710580823.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":2,\"created_at\":\"2024-03-16T09:20:24.000000Z\",\"updated_at\":\"2024-03-16T09:21:03.000000Z\"}}', '2024-03-16 06:21:56', '2024-03-16 06:21:03', '2024-03-16 06:21:56'),
('3f36fe9c-2221-4efe-a1fa-b03bc95f0a91', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":26,\"name\":\"Quarter_report_1713336841.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":1,\"nat_status\":\"new\",\"created_at\":\"2024-04-17T06:54:03.000000Z\",\"updated_at\":\"2024-04-17T06:54:35.000000Z\"}}', '2024-04-17 05:16:52', '2024-04-17 03:54:35', '2024-04-17 05:16:52'),
('3f771ea3-8c11-4dec-bb2b-916b1ae371bc', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706164515.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-01-25T06:35:22.000000Z\",\"created_at\":\"2024-01-25T06:35:22.000000Z\",\"id\":9}}', '2024-01-25 03:35:30', '2024-01-25 03:35:22', '2024-01-25 03:35:30'),
('3fb79f9a-175b-400b-9d77-340adeecbebf', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710496545.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-03-15T09:55:47.000000Z\",\"created_at\":\"2024-03-15T09:55:47.000000Z\",\"id\":3}}', '2024-03-15 06:56:03', '2024-03-15 06:55:47', '2024-03-15 06:56:03'),
('3fcc0c77-ca9f-44e9-b196-b78c2879a1ff', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":46,\"name\":\"Quarter_report_1709888006.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"Approval\":2,\"created_at\":\"2024-03-08T08:53:28.000000Z\",\"updated_at\":\"2024-03-14T08:38:51.000000Z\"}}', '2024-03-14 05:39:15', '2024-03-14 05:38:52', '2024-03-14 05:39:15'),
('42a15cf4-d9a1-4bd7-b9c9-603ea6921713', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":39,\"name\":\"Quarter_report_1706954489.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"Approval\":2,\"created_at\":\"2024-02-03T10:01:34.000000Z\",\"updated_at\":\"2024-02-03T10:05:31.000000Z\"}}', '2024-03-12 17:07:30', '2024-02-03 07:05:31', '2024-03-12 17:07:30'),
('4821c308-339a-48c3-ab9c-7844d1a559d3', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"id\":9,\"name\":\"Quarter_report_1710580524.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":2,\"created_at\":\"2024-03-16T09:15:26.000000Z\",\"updated_at\":\"2024-03-16T09:16:07.000000Z\"}}', '2024-03-16 06:19:23', '2024-03-16 06:16:07', '2024-03-16 06:19:23'),
('4ae6f06a-4539-4d89-a744-53d00632f517', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"name\":\"Quarter_report_1706770739.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-01T06:59:19.000000Z\",\"created_at\":\"2024-02-01T06:59:19.000000Z\",\"id\":22}}', '2024-02-01 03:59:24', '2024-02-01 03:59:19', '2024-02-01 03:59:24'),
('4d3e9d28-56ab-434d-a98f-252071482563', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710497644.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-03-15T10:14:06.000000Z\",\"created_at\":\"2024-03-15T10:14:06.000000Z\",\"id\":5}}', '2024-03-15 07:14:43', '2024-03-15 07:14:06', '2024-03-15 07:14:43'),
('4da3f71e-794f-4fd7-8290-cb2489752947', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":45,\"name\":\"Quarter_report_1707390510.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"Approval\":2,\"created_at\":\"2024-02-08T11:08:32.000000Z\",\"updated_at\":\"2024-02-08T11:09:08.000000Z\"}}', '2024-03-12 17:07:29', '2024-02-08 08:09:08', '2024-03-12 17:07:29'),
('5079cea9-1e3a-443a-917f-6bf63361b7ae', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706794580.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:36:22.000000Z\",\"created_at\":\"2024-02-01T13:36:22.000000Z\",\"id\":32}}', '2024-02-01 10:38:19', '2024-02-01 10:36:23', '2024-02-01 10:38:19'),
('50adec4d-1f24-4931-88bc-9e8d28599e5f', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1707378911.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-08T07:55:14.000000Z\",\"created_at\":\"2024-02-08T07:55:14.000000Z\",\"id\":41}}', '2024-02-08 04:55:36', '2024-02-08 04:55:14', '2024-02-08 04:55:36'),
('524e4700-76ba-4785-a602-c879f6125fe1', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706792590.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:03:12.000000Z\",\"created_at\":\"2024-02-01T13:03:12.000000Z\",\"id\":26}}', '2024-02-01 10:33:10', '2024-02-01 10:03:12', '2024-02-01 10:33:10'),
('54f3293d-d135-4f89-959c-c801d1bf3d2c', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710580524.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-16T09:15:26.000000Z\",\"created_at\":\"2024-03-16T09:15:26.000000Z\",\"id\":9}}', '2024-03-16 06:15:36', '2024-03-16 06:15:26', '2024-03-16 06:15:36'),
('55835b8a-5a07-40f0-b19d-f179ff297adc', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1707379361.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-08T08:02:44.000000Z\",\"created_at\":\"2024-02-08T08:02:44.000000Z\",\"id\":43}}', '2024-02-08 05:03:54', '2024-02-08 05:02:44', '2024-02-08 05:03:54'),
('584111f6-8187-4dac-94a2-ff4f13b166f4', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706167414.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-01-25T07:23:54.000000Z\",\"created_at\":\"2024-01-25T07:23:54.000000Z\",\"id\":10}}', '2024-01-25 04:35:12', '2024-01-25 04:23:54', '2024-01-25 04:35:12'),
('59164cb7-b46b-4885-8de5-b36287fa36f1', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":11,\"name\":\"Quarter_report_1710581630.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-16T09:33:51.000000Z\",\"updated_at\":\"2024-03-16T09:34:08.000000Z\"}}', '2024-03-16 06:34:16', '2024-03-16 06:34:08', '2024-03-16 06:34:16'),
('59df828e-9a75-42b2-bfba-7a0484181783', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706742300.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-31T23:05:03.000000Z\",\"created_at\":\"2024-01-31T23:05:03.000000Z\",\"id\":15}}', '2024-01-31 20:05:14', '2024-01-31 20:05:03', '2024-01-31 20:05:14'),
('5d25b547-a368-4a2c-ae80-0019578e1745', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706793030.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:10:31.000000Z\",\"created_at\":\"2024-02-01T13:10:31.000000Z\",\"id\":28}}', '2024-02-01 10:33:10', '2024-02-01 10:10:32', '2024-02-01 10:33:10'),
('5dc1c27f-b1ef-4a95-a1e6-79e5f8a23fce', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":30,\"name\":\"Quarter_report_1706793696.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"Approval\":2,\"created_at\":\"2024-02-01T13:21:38.000000Z\",\"updated_at\":\"2024-02-01T13:33:22.000000Z\"}}', '2024-03-12 17:07:30', '2024-02-01 10:33:22', '2024-03-12 17:07:30'),
('5e127487-7a0f-4aec-92bb-2fb58c3b5bc7', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1713336841.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-04-17T06:54:03.000000Z\",\"created_at\":\"2024-04-17T06:54:03.000000Z\",\"id\":26}}', '2024-04-17 03:54:27', '2024-04-17 03:54:03', '2024-04-17 03:54:27'),
('5f5154f0-60f9-4c07-a1c1-522fe6e03c80', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"id\":22,\"name\":\"Quarter_report_1710703008.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":2,\"nat_status\":\"new\",\"created_at\":\"2024-03-17T19:16:50.000000Z\",\"updated_at\":\"2024-03-20T13:17:42.000000Z\"}}', '2024-03-20 10:17:55', '2024-03-20 10:17:42', '2024-03-20 10:17:55'),
('5fb04b4c-80bb-4986-bbc7-bc911c1acb3c', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":1,\"name\":\"Quarter_report_1710493524.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-15T09:05:27.000000Z\",\"updated_at\":\"2024-03-15T09:09:50.000000Z\"}}', '2024-03-15 06:10:34', '2024-03-15 06:09:50', '2024-03-15 06:10:34'),
('6328b9e3-ea65-461f-93e1-6204aa57ab2e', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710594574.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-03-16T13:09:36.000000Z\",\"created_at\":\"2024-03-16T13:09:36.000000Z\",\"id\":13}}', '2024-03-16 10:09:57', '2024-03-16 10:09:37', '2024-03-16 10:09:57'),
('68d5162b-3827-40eb-b6ad-02173ba0cf12', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706954489.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-03T10:01:34.000000Z\",\"created_at\":\"2024-02-03T10:01:34.000000Z\",\"id\":39}}', '2024-02-03 07:04:42', '2024-02-03 07:01:34', '2024-02-03 07:04:42'),
('6a7ef9b5-701b-4682-b060-8c8769156ab0', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1713334943.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-04-17T06:22:24.000000Z\",\"created_at\":\"2024-04-17T06:22:24.000000Z\",\"id\":24}}', '2024-04-17 03:51:16', '2024-04-17 03:22:24', '2024-04-17 03:51:16'),
('6c6b3491-1f38-49f0-8fff-2137cf6d50ec', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":40,\"name\":\"Quarter_report_1706956288.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"Approval\":2,\"created_at\":\"2024-02-03T10:31:32.000000Z\",\"updated_at\":\"2024-02-03T10:33:02.000000Z\"}}', '2024-03-12 17:07:29', '2024-02-03 07:33:02', '2024-03-12 17:07:29'),
('6ca1dbd4-8b77-4614-a7db-379f548f6416', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706794791.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:39:53.000000Z\",\"created_at\":\"2024-02-01T13:39:53.000000Z\",\"id\":35}}', '2024-02-03 07:04:42', '2024-02-01 10:39:53', '2024-02-03 07:04:42'),
('729aa3b6-7c1a-4a6c-b743-6cc206c256bc', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":5,\"name\":\"Quarter_report_1710497644.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-15T10:14:06.000000Z\",\"updated_at\":\"2024-03-15T10:49:52.000000Z\"}}', '2024-03-15 07:50:07', '2024-03-15 07:49:52', '2024-03-15 07:50:07'),
('75ccd57f-e044-4ae5-80b9-c1be4e707134', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 3, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":4,\"updated_at\":\"2023-11-26T20:00:34.000000Z\",\"created_at\":\"2023-11-26T20:00:34.000000Z\",\"id\":10}}', '2023-11-26 17:01:14', '2023-11-26 17:00:34', '2023-11-26 17:01:14'),
('75df4cb6-5cb1-4901-8da4-fc9c272dab19', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706794706.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:38:28.000000Z\",\"created_at\":\"2024-02-01T13:38:28.000000Z\",\"id\":33}}', '2024-02-03 07:04:42', '2024-02-01 10:38:28', '2024-02-03 07:04:42'),
('7a9a0429-3c8d-4a61-b51e-2fac1507375c', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":25,\"name\":\"Quarter_report_1706771763.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"Approval\":2,\"created_at\":\"2024-02-01T07:16:23.000000Z\",\"updated_at\":\"2024-02-01T07:16:47.000000Z\"}}', '2024-02-01 04:16:57', '2024-02-01 04:16:47', '2024-02-01 04:16:57'),
('851a772f-6518-4af1-a101-ef99599f8a60', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706794722.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:38:44.000000Z\",\"created_at\":\"2024-02-01T13:38:44.000000Z\",\"id\":34}}', '2024-02-03 07:04:42', '2024-02-01 10:38:44', '2024-02-03 07:04:42'),
('86f7dd5b-2d8b-4ff1-9b5c-11b1c9c4d1cd', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":27,\"name\":\"Quarter_report_1713351554.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":1,\"nat_status\":\"new\",\"created_at\":\"2024-04-17T10:59:17.000000Z\",\"updated_at\":\"2024-04-17T11:00:26.000000Z\"}}', '2024-04-17 08:01:02', '2024-04-17 08:00:26', '2024-04-17 08:01:02'),
('90c5f8f4-2cc0-4a23-9d0b-5edb7dd5c4f3', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706725223.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-31T18:20:24.000000Z\",\"created_at\":\"2024-01-31T18:20:24.000000Z\",\"id\":12}}', '2024-01-31 15:20:29', '2024-01-31 15:20:24', '2024-01-31 15:20:29'),
('927e509f-24b0-458b-a019-108b3a5116c1', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706793696.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:21:38.000000Z\",\"created_at\":\"2024-02-01T13:21:38.000000Z\",\"id\":30}}', '2024-02-01 10:33:10', '2024-02-01 10:21:38', '2024-02-01 10:33:10'),
('95cefa6f-9071-4c98-88da-d5cf1098a415', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706725980.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-31T18:33:04.000000Z\",\"created_at\":\"2024-01-31T18:33:04.000000Z\",\"id\":13}}', '2024-01-31 15:33:12', '2024-01-31 15:33:04', '2024-01-31 15:33:12'),
('990e2884-94f6-48ed-8565-d7627b9fc283', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1713351554.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-04-17T10:59:17.000000Z\",\"created_at\":\"2024-04-17T10:59:17.000000Z\",\"id\":27}}', '2024-04-17 08:00:04', '2024-04-17 07:59:17', '2024-04-17 08:00:04'),
('9c005b39-98c8-4101-bb78-af3ec1bdeadf', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706794887.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-01T13:41:40.000000Z\",\"created_at\":\"2024-02-01T13:41:40.000000Z\",\"id\":36}}', '2024-02-03 07:04:42', '2024-02-01 10:41:40', '2024-02-03 07:04:42'),
('9d4e5950-31c8-4942-a802-19b56727c4ef', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706136630.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-24T22:50:36.000000Z\",\"created_at\":\"2024-01-24T22:50:36.000000Z\",\"id\":6}}', '2024-01-24 19:50:50', '2024-01-24 19:50:37', '2024-01-24 19:50:50'),
('9e2ddb7c-fa43-49cc-92b4-bb583c681be1', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706135805.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-24T22:37:14.000000Z\",\"created_at\":\"2024-01-24T22:37:14.000000Z\",\"id\":3}}', '2024-01-24 19:44:19', '2024-01-24 19:37:14', '2024-01-24 19:44:19'),
('a237dec7-e81e-4ae4-ab71-2534ad6ed96e', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706956288.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-03T10:31:32.000000Z\",\"created_at\":\"2024-02-03T10:31:32.000000Z\",\"id\":40}}', '2024-02-03 07:32:19', '2024-02-03 07:31:32', '2024-02-03 07:32:19'),
('a2cd1909-44dc-469a-a211-3e27d5af7a12', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710580324.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-16T09:12:05.000000Z\",\"created_at\":\"2024-03-16T09:12:05.000000Z\",\"id\":8}}', '2024-03-16 06:12:18', '2024-03-16 06:12:06', '2024-03-16 06:12:18'),
('a30035b4-c65a-4123-9eed-2316550ee603', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706742940.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-31T23:15:41.000000Z\",\"created_at\":\"2024-01-31T23:15:41.000000Z\",\"id\":16}}', '2024-01-31 20:15:48', '2024-01-31 20:15:41', '2024-01-31 20:15:48'),
('a71e8303-963b-442d-8208-7a7af9bf48b2', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706136014.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-24T22:40:19.000000Z\",\"created_at\":\"2024-01-24T22:40:19.000000Z\",\"id\":4}}', '2024-01-24 19:44:19', '2024-01-24 19:40:19', '2024-01-24 19:44:19'),
('a965ad14-6fed-4f14-aa0f-1b1fac849163', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1707379136.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-08T07:59:03.000000Z\",\"created_at\":\"2024-02-08T07:59:03.000000Z\",\"id\":42}}', '2024-02-08 05:03:54', '2024-02-08 04:59:03', '2024-02-08 05:03:54'),
('ac24a34c-721a-4813-97b7-0e034d302915', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":37,\"name\":\"Quarter_report_1706861360.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"Approval\":2,\"created_at\":\"2024-02-02T08:10:00.000000Z\",\"updated_at\":\"2024-02-07T15:48:17.000000Z\"}}', '2024-03-12 17:07:29', '2024-02-07 12:48:17', '2024-03-12 17:07:29'),
('ae2ad41f-c6cc-4c92-98a0-26daaa0df1c8', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710702827.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T19:13:49.000000Z\",\"created_at\":\"2024-03-17T19:13:49.000000Z\",\"id\":21}}', '2024-03-20 10:16:57', '2024-03-17 16:13:49', '2024-03-20 10:16:57'),
('b134390b-63c9-4701-a994-f89256c6590a', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706729195.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-31T19:26:49.000000Z\",\"created_at\":\"2024-01-31T19:26:49.000000Z\",\"id\":14}}', '2024-01-31 16:26:52', '2024-01-31 16:26:49', '2024-01-31 16:26:52'),
('b272753f-14ec-4e46-9158-ef15bcafd22a', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 3, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":4,\"updated_at\":\"2023-11-26T20:21:11.000000Z\",\"created_at\":\"2023-11-26T20:21:11.000000Z\",\"id\":11}}', '2023-11-27 03:20:28', '2023-11-26 17:21:11', '2023-11-27 03:20:28'),
('b360674f-affa-4cb7-9a7a-72e6e40ab9e9', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1713336517.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-04-17T06:48:41.000000Z\",\"created_at\":\"2024-04-17T06:48:41.000000Z\",\"id\":25}}', '2024-04-17 03:51:16', '2024-04-17 03:48:41', '2024-04-17 03:51:16'),
('b5134d95-1a6a-4b1b-acd9-450314d55b35', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":2,\"name\":\"Quarter_report_1710495438.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-15T09:37:21.000000Z\",\"updated_at\":\"2024-03-15T09:49:54.000000Z\"}}', '2024-03-15 06:50:59', '2024-03-15 06:49:54', '2024-03-15 06:50:59'),
('b687a8ab-6124-4fdf-8553-c2414a769c0b', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706743586.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-31T23:26:26.000000Z\",\"created_at\":\"2024-01-31T23:26:26.000000Z\",\"id\":18}}', '2024-01-31 20:26:34', '2024-01-31 20:26:26', '2024-01-31 20:26:34'),
('b812305c-643e-419e-a1c2-15e760f9c9b0', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710497320.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-03-15T10:08:44.000000Z\",\"created_at\":\"2024-03-15T10:08:44.000000Z\",\"id\":4}}', '2024-03-15 07:09:02', '2024-03-15 07:08:44', '2024-03-15 07:09:02'),
('b96f063c-1f9a-4396-81b9-8217d4f1fa9c', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710683140.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T13:45:42.000000Z\",\"created_at\":\"2024-03-17T13:45:42.000000Z\",\"id\":14}}', '2024-03-17 10:46:07', '2024-03-17 10:45:43', '2024-03-17 10:46:07'),
('b9e453d1-7df3-40c5-9532-be894fc4c15e', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1707390404.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-08T11:06:47.000000Z\",\"created_at\":\"2024-02-08T11:06:47.000000Z\",\"id\":44}}', '2024-02-08 08:07:58', '2024-02-08 08:06:47', '2024-02-08 08:07:58'),
('bb0bff77-2c4c-4efa-9ae1-fa5284bac01e', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"name\":\"Quarter_report_1706770790.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-01T07:00:10.000000Z\",\"created_at\":\"2024-02-01T07:00:10.000000Z\",\"id\":23}}', '2024-02-01 04:12:13', '2024-02-01 04:00:10', '2024-02-01 04:12:13'),
('bbf96ead-6375-4326-b26d-038a0ad96a50', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"id\":26,\"name\":\"Quarter_report_1713336841.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":2,\"nat_status\":\"opened\",\"created_at\":\"2024-04-17T06:54:03.000000Z\",\"updated_at\":\"2024-04-17T08:17:08.000000Z\"}}', '2024-04-17 05:17:56', '2024-04-17 05:17:08', '2024-04-17 05:17:56'),
('bd9d70d6-8740-4c07-8b60-17abbbef8f01', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710493524.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-03-15T09:05:27.000000Z\",\"created_at\":\"2024-03-15T09:05:27.000000Z\",\"id\":1}}', '2024-03-15 06:05:43', '2024-03-15 06:05:27', '2024-03-15 06:05:43'),
('bfc9ffe1-4c33-47c6-b330-7a0e97d9a57d', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":3,\"updated_at\":\"2023-11-26T19:44:05.000000Z\",\"created_at\":\"2023-11-26T19:44:05.000000Z\",\"id\":9}}', '2023-11-26 16:44:18', '2023-11-26 16:44:06', '2023-11-26 16:44:18'),
('c1aab5c3-4501-4b4c-afb4-09a3b62055d7', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706771549.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-01T07:12:49.000000Z\",\"created_at\":\"2024-02-01T07:12:49.000000Z\",\"id\":24}}', '2024-02-01 04:13:03', '2024-02-01 04:12:49', '2024-02-01 04:13:03'),
('c25b8c00-a09c-4c07-9f8e-830b3aae3d4b', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710579566.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-16T08:59:28.000000Z\",\"created_at\":\"2024-03-16T08:59:28.000000Z\",\"id\":7}}', '2024-03-16 05:59:47', '2024-03-16 05:59:28', '2024-03-16 05:59:47'),
('c49c057d-ef8f-406d-9c8b-cb84779160f4', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1)-1.pdf\",\"user_id\":3,\"updated_at\":\"2023-11-22T15:01:51.000000Z\",\"created_at\":\"2023-11-22T15:01:51.000000Z\",\"id\":8}}', '2023-11-22 12:02:41', '2023-11-22 12:01:51', '2023-11-22 12:02:41'),
('c7a34150-9891-4013-9c3d-0ff3ea849c1a', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706743027.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-31T23:17:07.000000Z\",\"created_at\":\"2024-01-31T23:17:07.000000Z\",\"id\":17}}', '2024-01-31 20:17:12', '2024-01-31 20:17:07', '2024-01-31 20:17:12'),
('c8a36530-4605-42a7-88ed-dd83b313f88e', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":8,\"name\":\"Quarter_report_1710580324.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-16T09:12:05.000000Z\",\"updated_at\":\"2024-03-16T09:12:22.000000Z\"}}', '2024-03-16 06:12:36', '2024-03-16 06:12:22', '2024-03-16 06:12:36'),
('caef25c8-95c5-4f9e-85b3-fd908ac703e9', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706792861.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:07:43.000000Z\",\"created_at\":\"2024-02-01T13:07:43.000000Z\",\"id\":27}}', '2024-02-01 10:33:10', '2024-02-01 10:07:43', '2024-02-01 10:33:10'),
('cc91fcf5-dc88-4d6a-bb5a-549af08f017e', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1711537024.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-03-27T10:57:07.000000Z\",\"created_at\":\"2024-03-27T10:57:07.000000Z\",\"id\":23}}', '2024-03-27 07:57:20', '2024-03-27 07:57:07', '2024-03-27 07:57:20'),
('cd10e62e-40bf-4cbc-8ca3-1cb19cd0b73e', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1709888006.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-08T08:53:28.000000Z\",\"created_at\":\"2024-03-08T08:53:28.000000Z\",\"id\":46}}', '2024-03-14 04:46:07', '2024-03-08 05:53:28', '2024-03-14 04:46:07'),
('d1fd40ce-8277-4594-acaa-d191d057c7b2', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":4,\"updated_at\":\"2023-11-18T20:04:07.000000Z\",\"created_at\":\"2023-11-18T20:04:07.000000Z\",\"id\":1}}', '2024-02-01 03:52:39', '2023-11-18 17:04:07', '2024-02-01 03:52:39'),
('d3147e5b-4362-4efc-ba3d-bf3ddb8d7463', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710687447.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T14:57:29.000000Z\",\"created_at\":\"2024-03-17T14:57:29.000000Z\",\"id\":16}}', '2024-03-17 11:57:49', '2024-03-17 11:57:29', '2024-03-17 11:57:49'),
('d42f72d8-c4a4-4924-8e50-dc72c9200724', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":4,\"updated_at\":\"2023-11-18T20:27:00.000000Z\",\"created_at\":\"2023-11-18T20:27:00.000000Z\",\"id\":4}}', '2023-11-18 17:27:49', '2023-11-18 17:27:01', '2023-11-18 17:27:49'),
('d6631912-65de-466b-863c-862c8dade7a5', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706744526.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-31T23:42:09.000000Z\",\"created_at\":\"2024-01-31T23:42:09.000000Z\",\"id\":19}}', '2024-01-31 20:42:15', '2024-01-31 20:42:09', '2024-01-31 20:42:15'),
('d92c7e65-4e9b-4112-8d35-4011b74462b8', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706141824.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-01-25T00:17:12.000000Z\",\"created_at\":\"2024-01-25T00:17:12.000000Z\",\"id\":7}}', '2024-01-24 21:17:35', '2024-01-24 21:17:12', '2024-01-24 21:17:35'),
('db444ff6-47f9-4915-bf61-826a875eca9c', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710486667.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-15T07:11:09.000000Z\",\"created_at\":\"2024-03-15T07:11:09.000000Z\",\"id\":47}}', '2024-03-15 04:12:34', '2024-03-15 04:11:09', '2024-03-15 04:12:34'),
('dc49a0f3-6d36-4c0d-a7a9-77d764e7a79e', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710486784.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-03-15T07:13:06.000000Z\",\"created_at\":\"2024-03-15T07:13:06.000000Z\",\"id\":48}}', '2024-03-15 04:15:15', '2024-03-15 04:13:07', '2024-03-15 04:15:15'),
('de954ca1-3e39-40dc-8b5c-2bb5dc65b837', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706954372.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-03T09:59:37.000000Z\",\"created_at\":\"2024-02-03T09:59:37.000000Z\",\"id\":38}}', '2024-02-03 07:04:42', '2024-02-03 06:59:38', '2024-02-03 07:04:42'),
('dfb5c99b-a691-4407-b909-9d681d960ddf', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710687979.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T15:06:21.000000Z\",\"created_at\":\"2024-03-17T15:06:21.000000Z\",\"id\":19}}', '2024-03-17 12:07:36', '2024-03-17 12:06:21', '2024-03-17 12:07:36'),
('e02aee01-1f8c-47c1-a901-0a6af5bda669', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":43,\"name\":\"Quarter_report_1707379361.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"Approval\":2,\"created_at\":\"2024-02-08T08:02:44.000000Z\",\"updated_at\":\"2024-02-08T08:04:11.000000Z\"}}', '2024-03-12 17:07:29', '2024-02-08 05:04:11', '2024-03-12 17:07:29'),
('e10e30a3-2b81-4889-9e04-303d75e70fc4', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710687578.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T14:59:45.000000Z\",\"created_at\":\"2024-03-17T14:59:45.000000Z\",\"id\":17}}', '2024-03-17 12:00:18', '2024-03-17 11:59:45', '2024-03-17 12:00:18'),
('e391a7ab-60e1-4039-a17b-5c8e74e09317', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710593981.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-16T12:59:48.000000Z\",\"created_at\":\"2024-03-16T12:59:48.000000Z\",\"id\":12}}', '2024-03-16 10:06:34', '2024-03-16 09:59:48', '2024-03-16 10:06:34'),
('e6e72401-9339-4a41-9095-bf946301f914', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1707390510.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-08T11:08:32.000000Z\",\"created_at\":\"2024-02-08T11:08:32.000000Z\",\"id\":45}}', '2024-02-08 08:08:58', '2024-02-08 08:08:32', '2024-02-08 08:08:58'),
('e7ecc2e3-27f6-44a4-9ba9-f670b03aa6a0', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":3,\"updated_at\":\"2023-11-19T21:58:55.000000Z\",\"created_at\":\"2023-11-19T21:58:55.000000Z\",\"id\":6}}', '2023-11-19 18:59:21', '2023-11-19 18:58:56', '2023-11-19 18:59:21'),
('ea67c610-1357-425c-baee-c5e400a0703b', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"id\":11,\"name\":\"Quarter_report_1710581630.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":2,\"created_at\":\"2024-03-16T09:33:51.000000Z\",\"updated_at\":\"2024-03-16T09:34:20.000000Z\"}}', '2024-03-16 06:34:28', '2024-03-16 06:34:20', '2024-03-16 06:34:28'),
('ee76894a-d6e1-46ca-bdad-8ad233d2d002', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706861360.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-02T08:10:00.000000Z\",\"created_at\":\"2024-02-02T08:10:00.000000Z\",\"id\":37}}', '2024-02-03 07:04:42', '2024-02-02 05:10:00', '2024-02-03 07:04:42'),
('eeb0b07f-513a-4996-9570-11bd239030cf', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":36,\"name\":\"Quarter_report_1706794887.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"Approval\":2,\"created_at\":\"2024-02-01T13:41:40.000000Z\",\"updated_at\":\"2024-03-04T13:21:54.000000Z\"}}', '2024-03-12 17:07:29', '2024-03-04 10:21:54', '2024-03-12 17:07:29'),
('ef1d84eb-b774-445d-bbac-1ae253304673', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1713351765.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-04-17T11:02:47.000000Z\",\"created_at\":\"2024-04-17T11:02:47.000000Z\",\"id\":28}}', NULL, '2024-04-17 08:02:47', '2024-04-17 08:02:47'),
('f00fbe37-2588-4104-913f-cb5b0cf7e9c9', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"id\":23,\"name\":\"Quarter_report_1711537024.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"dist_approval\":2,\"reg_approval\":2,\"nat_status\":\"new\",\"created_at\":\"2024-03-27T10:57:07.000000Z\",\"updated_at\":\"2024-03-27T10:57:39.000000Z\"}}', '2024-03-27 07:57:47', '2024-03-27 07:57:39', '2024-03-27 07:57:47'),
('f247e8af-b874-4379-ab20-a256456debad', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":10,\"name\":\"Quarter_report_1710580823.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-16T09:20:24.000000Z\",\"updated_at\":\"2024-03-16T09:20:46.000000Z\"}}', '2024-03-16 06:20:57', '2024-03-16 06:20:46', '2024-03-16 06:20:57'),
('f3cbbe4d-98b4-4920-8b84-1e8ef93fd75a', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":7,\"name\":\"Quarter_report_1710579566.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":1,\"created_at\":\"2024-03-16T08:59:28.000000Z\",\"updated_at\":\"2024-03-16T09:00:17.000000Z\"}}', '2024-03-16 06:00:53', '2024-03-16 06:00:17', '2024-03-16 06:00:53'),
('f446529e-cdcc-458e-b934-9a6415547117', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"id\":8,\"name\":\"Quarter_report_1710580324.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":2,\"created_at\":\"2024-03-16T09:12:05.000000Z\",\"updated_at\":\"2024-03-16T09:12:42.000000Z\"}}', '2024-03-16 06:19:23', '2024-03-16 06:12:42', '2024-03-16 06:19:23'),
('f45d9305-02e2-4b54-97f0-1caf48c64455', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":22,\"name\":\"Quarter_report_1710703008.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"dist_approval\":2,\"reg_approval\":1,\"nat_status\":\"new\",\"created_at\":\"2024-03-17T19:16:50.000000Z\",\"updated_at\":\"2024-03-20T13:17:04.000000Z\"}}', '2024-03-20 10:17:33', '2024-03-20 10:17:05', '2024-03-20 10:17:33'),
('f4619be7-3f9d-4f94-b315-78294485e45b', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710529093.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-15T18:58:34.000000Z\",\"created_at\":\"2024-03-15T18:58:34.000000Z\",\"id\":6}}', '2024-03-16 05:59:47', '2024-03-15 15:58:34', '2024-03-16 05:59:47'),
('f6da378a-baa2-43e5-8af9-f61a8d1516ff', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706793264.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-02-01T13:14:26.000000Z\",\"created_at\":\"2024-02-01T13:14:26.000000Z\",\"id\":29}}', '2024-02-01 10:33:10', '2024-02-01 10:14:26', '2024-02-01 10:33:10'),
('f9fb2004-d382-4e12-8011-e6e85daa946b', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":23,\"name\":\"Quarter_report_1706770790.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"Approval\":2,\"created_at\":\"2024-02-01T07:00:10.000000Z\",\"updated_at\":\"2024-02-01T07:11:43.000000Z\"}}', '2024-02-01 04:12:13', '2024-02-01 04:11:43', '2024-02-01 04:12:13'),
('fbeb8689-7711-4b1e-9791-7db2094998a2', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 2, '{\"report\":{\"id\":23,\"name\":\"Quarter_report_1711537024.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"dist_approval\":2,\"reg_approval\":1,\"nat_status\":\"new\",\"created_at\":\"2024-03-27T10:57:07.000000Z\",\"updated_at\":\"2024-03-27T10:57:24.000000Z\"}}', '2024-03-27 07:57:34', '2024-03-27 07:57:25', '2024-03-27 07:57:34'),
('fde37569-d0b3-48fc-b4b2-e7b223ab5e47', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1706748325.pdf\",\"uploaded_by\":\"mary mary\",\"user_id\":4,\"updated_at\":\"2024-02-01T00:45:28.000000Z\",\"created_at\":\"2024-02-01T00:45:28.000000Z\",\"id\":21}}', '2024-01-31 21:45:32', '2024-01-31 21:45:28', '2024-01-31 21:45:32'),
('fe073905-cdb6-41e3-8473-4b6fa03194cc', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 47, '{\"report\":{\"name\":\"Quarter_report_1710687219.pdf\",\"uploaded_by\":\"Jovin Sanga\",\"user_id\":48,\"updated_at\":\"2024-03-17T14:53:41.000000Z\",\"created_at\":\"2024-03-17T14:53:41.000000Z\",\"id\":15}}', '2024-03-17 11:54:12', '2024-03-17 11:53:41', '2024-03-17 11:54:12'),
('fed11aa1-be83-4fbc-ba7b-bcd9c385e028', 'App\\Notifications\\ReportUploaded', 'App\\Models\\User', 1, '{\"report\":{\"name\":\"ACTIVITY DIAGRAM OF IPOSA PROGRAMME 2 (1).pdf\",\"user_id\":4,\"updated_at\":\"2023-11-18T20:27:36.000000Z\",\"created_at\":\"2023-11-18T20:27:36.000000Z\",\"id\":5}}', '2023-11-18 17:27:49', '2023-11-18 17:27:37', '2023-11-18 17:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('andocius26philemon@gmail.com', '$2y$10$8SP.6DLfPCIledXxNm.acOWY2f7uBFn724rrWSUBdK/YSWOGBIzyG', '2024-03-29 05:59:57'),
('freymous10@gmail.com', '$2y$10$28jiJpCNnEYoDv3FVF8yhuJxn6V3Z9AtZrj9E.4LveOzwXDHt0/Zq', '2024-01-05 09:15:03'),
('gadafijaphaly10@gmail.com', '$2y$10$WzYwO21khawQARlvzcMkTOJ0LXumdfdA16sfUXtq2mcTmGsn0xSz.', '2024-04-21 04:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `cordinator_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `cordinator_id`, `created_at`, `updated_at`) VALUES
(1, 'songwe', 2, '2023-11-19 03:41:17', '2023-11-19 03:41:17'),
(4, 'Dar es salaam', 84, '2024-04-16 09:58:27', '2024-04-16 09:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `remark` varchar(255) NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `sent_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remarks`
--

INSERT INTO `remarks` (`id`, `remark`, `report_id`, `sent_by`, `created_at`, `updated_at`) VALUES
(1, 'change that boy', 3, 47, '2024-03-15 07:07:26', '2024-03-15 07:07:26'),
(2, 'change it', 4, 2, '2024-03-15 07:12:37', '2024-03-15 07:12:37'),
(3, 'careful', 12, 47, '2024-03-16 10:14:54', '2024-03-16 10:14:54'),
(4, 'careful', 12, 47, '2024-03-16 10:15:39', '2024-03-16 10:15:39'),
(5, '<script>alert(1)</script>', 13, 47, '2024-03-16 10:18:16', '2024-03-16 10:18:16'),
(6, 'not well done', 14, 47, '2024-03-17 11:48:29', '2024-03-17 11:48:29'),
(7, 'not well done', 15, 47, '2024-03-17 11:56:07', '2024-03-17 11:56:07'),
(8, 'fuck off', 16, 47, '2024-03-17 11:58:10', '2024-03-17 11:58:10'),
(9, 'well done', 17, 47, '2024-03-17 12:00:27', '2024-03-17 12:00:27'),
(10, 'well done', 18, 47, '2024-03-17 12:03:49', '2024-03-17 12:03:49'),
(11, 'well done', 19, 47, '2024-03-17 12:07:40', '2024-03-17 12:07:40'),
(12, 'well done', 19, 47, '2024-03-17 12:08:27', '2024-03-17 12:08:27'),
(13, 'nope', 20, 47, '2024-03-17 16:09:00', '2024-03-17 16:09:00'),
(14, 'vfsdf', 21, 47, '2024-03-20 10:19:23', '2024-03-20 10:19:23'),
(15, '<script>alert()1</script>', 24, 47, '2024-04-17 03:52:01', '2024-04-17 03:52:01'),
(16, '<script>alert()1</script>', 25, 47, '2024-04-17 03:53:10', '2024-04-17 03:53:10'),
(17, 'introduction not good', 27, 2, '2024-04-17 08:01:36', '2024-04-17 08:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'New',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-11-18 16:07:41', '2023-11-18 16:07:41'),
(2, 'regional cordinator', '2023-11-18 16:07:41', '2023-11-18 16:07:41'),
(3, 'district cordinator', '2023-11-18 16:07:41', '2023-11-18 16:07:41'),
(4, 'head of center', '2023-11-18 16:07:41', '2023-11-18 16:07:41'),
(5, 'user', '2023-11-18 16:07:41', '2023-11-18 16:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `disability` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `letter` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `stage` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nida` varchar(255) DEFAULT NULL,
  `employment_status` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `education_level` varchar(255) DEFAULT NULL,
  `education_type` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `date_of_birth`, `gender`, `disability`, `phone_number`, `center_id`, `profile_picture`, `birth_certificate`, `letter`, `status`, `stage`, `created_at`, `updated_at`, `nida`, `employment_status`, `marital_status`, `education_level`, `education_type`, `region`, `district`, `ward`, `street`, `email`) VALUES
(28, 'Bunastar Vina', '2005-04-11', 'M', 'None', '0756764947', 5, '/var/opt/i_posa/storage/app/public/students/passports/Bunastar vina_0756765678/kikiki.jpg', '/var/opt/i_posa/storage/app/public/students/certificates/Bunastar vina_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Bunastar vina_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-08 17:15:16', '2024-04-12 09:31:53', '12345678901234567897', 'Not employed', 'Single', 'Primary', 'Married', 'Mbeya', 'Momba', 'Queens', 'Bleeker', 'vina@gmail.com'),
(29, 'Gadafi Japhali', '2000-04-05', 'M', 'None', '0755555587', 5, '/var/opt/i_posa/storage/app/public/students/passports/Gadafi japhaly_0755555587/kikiki.jpg', '/var/opt/i_posa/storage/app/public/students/certificates/Gadafi japhaly_0755555587/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Gadafi japhaly_0755555587/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-08 17:30:17', '2024-04-08 19:55:48', '12345678912345678967', 'Not employed', 'Single', 'Primary', 'Married', 'Mbeya', 'Momba', 'Queens', 'Bleeker', NULL),
(30, 'Liam Smith', '2005-04-13', 'M', 'Deaf', '0678912346', 5, '/var/opt/i_posa/storage/app/public/students/passports/Liam Smith_0678912346/DSC_1992.JPG', '/var/opt/i_posa/storage/app/public/students/certificates/Liam Smith_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Liam Smith_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 09:50:44', '2024-04-14 09:50:44', '12345678901234567890', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Ileje', 'Native', 'Staillingi Street', 'liamsmith@gmail.com'),
(31, 'Olivia Johnson', '2006-04-11', 'M', 'Albino', '0678912345', 5, '/var/opt/i_posa/storage/app/public/students/passports/Olivia Johnson_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Olivia Johnson_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Olivia Johnson_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 09:56:46', '2024-04-14 09:56:46', '20060411891234567890', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Ileje', 'Native', 'Staillingi Street', 'oliviajhnson@gmail.com'),
(32, 'Noah Williams', '2003-03-12', 'M', 'Hearing impaired', '0678912346', 5, '/var/opt/i_posa/storage/app/public/students/passports/Noah Williams_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Noah Williams_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Noah Williams_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-14 10:02:20', '2024-04-14 10:02:20', '20030312345678901234', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Ileje', 'Native', 'Sunna', 'naohwilliams@gmail.com'),
(33, 'Emma Brown', '2009-05-13', 'F', 'None', '0678912345', 5, '/var/opt/i_posa/storage/app/public/students/passports/Emma Brown_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Emma Brown_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Emma Brown_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 10:08:03', '2024-04-14 10:08:03', '20090513567890123456', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Ileje', 'Native', 'Staillingi Street', 'emmawilliams@gmail.com'),
(34, 'Oliver Jones', '2010-02-15', 'M', 'None', '0756765678', 5, '/var/opt/i_posa/storage/app/public/students/passports/Oliver Jones_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Oliver Jones_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Oliver Jones_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 10:12:46', '2024-04-14 10:12:46', '20100215234567890123', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Ileje', 'Native', 'Staillingi Street', 'oliverjones@gmail.com'),
(35, 'Ava Davis', '2010-03-16', 'F', 'None', '0755555555', 5, '/var/opt/i_posa/storage/app/public/students/passports/Ava Davis_0755555555/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Ava Davis_0755555555/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Ava Davis_0755555555/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-14 10:41:09', '2024-04-14 10:41:09', '20100316123456000090', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Ileje', 'Native', 'Staillingi Street', 'avadavis@gmail.com'),
(36, 'Elijah Miller', '2003-04-15', 'M', 'None', '0678912345', 5, '/var/opt/i_posa/storage/app/public/students/passports/Elijah Miller_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Elijah Miller_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Elijah Miller_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 10:45:51', '2024-04-14 10:45:51', '20030415123456789010', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Ileje', 'Native', 'Sunna', 'elijahmiller@gmail.com'),
(37, 'Sophia Garcia', '2006-05-10', 'F', 'None', '0756765678', 5, '/var/opt/i_posa/storage/app/public/students/passports/Sophia Garcia_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Sophia Garcia_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Sophia Garcia_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 10:53:10', '2024-04-14 10:53:10', '20060510123456789010', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Ileje', 'Native', 'Staillingi Street', 'sophiagarcia@gmail.com'),
(38, 'James Rodriguez', '2007-08-15', 'M', 'None', '0756765678', 1, '/var/opt/i_posa/storage/app/public/students/passports/James Rodriguez_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/James Rodriguez_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/James Rodriguez_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 11:16:49', '2024-04-14 11:16:49', '20070815123456789001', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Iloni', 'jamesrodriguez@gmail.com'),
(39, 'Charlotte Martinez', '2010-02-02', 'F', 'None', '0756765678', 1, '/var/opt/i_posa/storage/app/public/students/passports/Charlotte Martinez_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Charlotte Martinez_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Charlotte Martinez_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-14 11:21:10', '2024-04-14 11:21:10', '20100202123456789001', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'charmart@gmail.com'),
(41, 'Mia Lopez', '2009-04-28', 'F', 'None', '0678912345', 1, '/var/opt/i_posa/storage/app/public/students/passports/Mia Lopez_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Mia Lopez_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Mia Lopez_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-14 12:04:13', '2024-04-14 12:04:13', '20090428123456789000', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'mialopez@gmail.com'),
(43, 'William Gonzalez', '2009-02-12', 'M', 'None', '0756765678', 1, '/var/opt/i_posa/storage/app/public/students/passports/William Gonzalez_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/William Gonzalez_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/William Gonzalez_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 12:11:29', '2024-04-14 12:11:29', '20090212123456789012', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'williamgonzale@gmail.com'),
(44, 'Amelia Perez', '2003-04-09', 'F', 'None', '0678912345', 1, '/var/opt/i_posa/storage/app/public/students/passports/Amelia Perez_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Amelia Perez_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Amelia Perez_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 12:15:25', '2024-04-14 12:15:25', '20030409123456789012', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Sunna', 'ameliapere@gmail.com'),
(45, 'Henry Sanchez', '2010-04-29', 'M', 'None', '0678912345', 1, '/var/opt/i_posa/storage/app/public/students/passports/Henry Sanchez_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Henry Sanchez_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Henry Sanchez_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-14 12:19:09', '2024-04-14 12:19:09', '20100429123456789012', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'henrysanche@gmail.com'),
(46, 'Isabella Wilson', '2009-01-21', 'F', 'None', '0678912346', 1, '/var/opt/i_posa/storage/app/public/students/passports/Isabella Wilson_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Isabella Wilson_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Isabella Wilson_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-14 12:22:45', '2024-04-14 12:22:45', '20090121123456789012', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'isabellwilson@gmail.com'),
(47, 'Alexandra Rivera', '2007-02-01', 'M', 'None', '0678912346', 1, '/var/opt/i_posa/storage/app/public/students/passports/Alexandra Rivera_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Alexandra Rivera_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Alexandra Rivera_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 12:26:38', '2024-04-14 12:26:38', '20070201098765432101', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'alexandrariv@gmail.com'),
(48, 'Harper Young', '2009-12-08', 'F', 'Albino', '0756765678', 1, '/var/opt/i_posa/storage/app/public/students/passports/Harper Young_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Harper Young_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Harper Young_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 12:31:48', '2024-04-14 12:31:48', '20111207123456789000', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'harpyoung@gmail.com'),
(49, 'Ethan Torres', '2007-03-07', 'M', 'None', '0678912346', 1, '/var/opt/i_posa/storage/app/public/students/passports/Ethan Torres_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Ethan Torres_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Ethan Torres_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 12:35:33', '2024-04-14 12:35:33', '20070307123456789000', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Sunna', 'ethantorre@gmail.com'),
(50, 'Evelyn Nguyen', '2005-05-04', 'F', 'None', '0678912346', 1, '/var/opt/i_posa/storage/app/public/students/passports/Evelyn Nguyen_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Evelyn Nguyen_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Evelyn Nguyen_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-14 12:39:56', '2024-04-14 12:39:56', '20050504098765432100', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Sunna', 'evengyen@gmail.com'),
(51, 'Michael Moore', '2001-12-05', 'M', 'None', '0756765678', 1, '/var/opt/i_posa/storage/app/public/students/passports/Michael Moore_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Michael Moore_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Michael Moore_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-14 12:45:20', '2024-04-14 12:45:20', '20011205123456789011', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'mikemoore@gmail.com'),
(52, 'Abigail Lewis', '2011-02-02', 'F', 'None', '0755555587', 1, '/var/opt/i_posa/storage/app/public/students/passports/Abigail Lewis_0755555587/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Abigail Lewis_0755555587/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Abigail Lewis_0755555587/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-14 12:49:19', '2024-04-14 12:49:19', '20110202123451234567', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Mbozi', 'Tunu', 'Staillingi Street', 'abbylewis@gmail.com'),
(53, 'Aaron Jenkins', '2009-04-09', 'M', 'None', '0678912346', 6, '/var/opt/i_posa/storage/app/public/students/passports/Aaron Jenkins_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Aaron Jenkins_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Aaron Jenkins_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-15 13:23:45', '2024-04-15 13:23:45', '12345678901234567890', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'aaron10@gmail.com'),
(54, 'Sarah Patel', '2003-04-17', 'F', 'None', '0678912345', 6, '/var/opt/i_posa/storage/app/public/students/passports/Sarah Patel_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Sarah Patel_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Sarah Patel_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-15 13:27:54', '2024-04-15 13:27:54', '12345678900987654321', 'Not employed', 'Single', 'Ordinary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'sarahi@gmail.com'),
(55, 'Mark Thompson', '2009-04-08', 'M', 'None', '0678912346', 6, '/var/opt/i_posa/storage/app/public/students/passports/Mark Thompson_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Mark Thompson_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Mark Thompson_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-15 13:36:39', '2024-04-15 13:36:39', '01928374650192837465', 'Not employed', 'Single', 'Ordinary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'thomson@gmail.com'),
(56, 'David Murphy', '2006-04-05', 'M', 'None', '0756765678', 6, '/var/opt/i_posa/storage/app/public/students/passports/David Murphy_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/David Murphy_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/David Murphy_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-15 13:45:47', '2024-04-15 13:45:47', '12345678909876543000', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'vina74@gmail.com'),
(57, 'Emily Garcia', '2006-04-05', 'F', 'None', '0756765678', 6, '/var/opt/i_posa/storage/app/public/students/passports/Emily Garcia_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Emily Garcia_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Emily Garcia_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-15 13:50:41', '2024-04-15 13:50:41', '12345678909876543210', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'nige6@gmail.com'),
(58, 'Michael Clark', '2008-04-18', 'M', 'None', '0678912345', 6, '/var/opt/i_posa/storage/app/public/students/passports/Michael Clark_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Michael Clark_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Michael Clark_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-15 13:55:23', '2024-04-15 13:55:23', '12345678900987654312', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'michael8947@gmail.com'),
(59, 'Jennifer King', '2006-04-19', 'F', 'None', '0756765678', 6, '/var/opt/i_posa/storage/app/public/students/passports/Jennifer King_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Jennifer King_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Jennifer King_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-15 13:59:28', '2024-04-15 13:59:28', '12345678901234560987', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'jennifer8457@gmail.com'),
(60, 'Daniel Lee', '2009-04-08', 'M', 'None', '0756765678', 6, '/var/opt/i_posa/storage/app/public/students/passports/Daniel Lee_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Daniel Lee_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Daniel Lee_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-15 14:03:28', '2024-04-15 14:03:28', '98765432101234567890', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'leekee@gmail.com'),
(61, 'Jessica Turner', '2008-04-30', 'F', 'None', '0678912346', 6, '/var/opt/i_posa/storage/app/public/students/passports/Jessica Turner_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Jessica Turner_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Jessica Turner_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-15 14:08:01', '2024-04-15 14:08:01', '56789043219087654321', 'Not employed', 'Single', 'Primary', 'Married', 'Songwe', 'Tunduma', 'Nyerere', 'Paken', 'turnaround@gmail.com'),
(62, 'Sarah Brown', '2008-04-17', 'F', 'Albino', '0712345678', 7, '/var/opt/i_posa/storage/app/public/students/passports/Sarah Brown_0712345678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Sarah Brown_0712345678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Sarah Brown_0712345678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 04:30:26', '2024-04-18 04:30:26', '20080417123456789012', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Chamazi', '14 Kiru Street', 'sarahbrown@gmail.com'),
(63, 'David Jones', '2007-01-02', 'M', 'None', '0678912346', 7, '/var/opt/i_posa/storage/app/public/students/passports/David Jones_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/David Jones_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/David Jones_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 04:34:39', '2024-04-18 04:34:39', '20070102123456790000', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Chamazi', '14 Kiru Street', 'davidjones@gmail.com'),
(64, 'Christopher Wilson', '2010-10-07', 'M', 'None', '0756765678', 7, '/var/opt/i_posa/storage/app/public/students/passports/christopher wilson_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/christopher wilson_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/christopher wilson_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 04:39:43', '2024-04-18 04:39:43', '20101007123456789009', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Keko', '13 Chube Street', 'christopher@gmail.com'),
(65, 'Amanda Martinez', '2009-03-03', 'F', 'None', '0678912346', 7, '/var/opt/i_posa/storage/app/public/students/passports/Amanda Martinez_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Amanda Martinez_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Amanda Martinez_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-18 04:44:56', '2024-04-18 04:44:56', '20090303123456123456', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Chamazi', '14 Kiru Street', 'amanda18@gmail.com'),
(66, 'Daniel Garcia', '2005-09-13', 'M', 'None', '0712345678', 7, '/var/opt/i_posa/storage/app/public/students/passports/Daniel Garcia_0712345678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Daniel Garcia_0712345678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Daniel Garcia_0712345678/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-18 05:06:20', '2024-04-18 05:06:20', '20050913123456789012', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Chamazi', '14 Kiru Street', 'daniel@gmail.com'),
(67, 'Ethan Thompson', '2010-08-02', 'M', 'None', '0678912346', 7, '/var/opt/i_posa/storage/app/public/students/passports/ethan thompson_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/ethan thompson_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/ethan thompson_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 05:12:49', '2024-04-18 05:12:49', '20100802123456789000', 'Self employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Keko', '13 Chube Street', 'ethanthomp@gmail.com'),
(68, 'Olivia Anderson', '2010-03-28', 'F', 'None', '0712345678', 7, '/var/opt/i_posa/storage/app/public/students/passports/olivia anderson_0712345678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/olivia anderson_0712345678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/olivia anderson_0712345678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 05:21:16', '2024-04-18 05:21:16', '20120328123443212300', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Keko', '14 Kiru Street', 'oliviaander@gmail.com'),
(69, 'Gadafi Gadafi', '2008-04-16', 'M', 'None', '0678912345', 7, '/var/opt/i_posa/storage/app/public/students/passports/gadafi gadafi_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/gadafi gadafi_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/gadafi gadafi_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 05:26:50', '2024-04-18 05:26:50', '20080416123456789012', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Chamazi', '14 Kiru Street', 'gadafigadafi@gmail.com'),
(70, 'Isabella Clark', '2010-02-14', 'F', 'None', '0678912345', 7, '/var/opt/i_posa/storage/app/public/students/passports/isabella clark_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/isabella clark_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/isabella clark_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 06:47:08', '2024-04-18 06:47:08', '20100214123456789098', 'Self employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Chamazi', '14 Kiru Street', 'isabelclark@gmail.com'),
(71, 'Sophia Miller', '2010-02-14', 'F', 'None', '0678912346', 7, '/var/opt/i_posa/storage/app/public/students/passports/sophia miller_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/sophia miller_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/sophia miller_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 06:52:47', '2024-04-18 06:52:47', '20100214098765432100', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Keko', '14 Kiru Street', 'sophiamiller@gmail.com'),
(72, 'Matthew Taylor', '2006-06-07', 'M', 'Albino', '0678912345', 7, '/var/opt/i_posa/storage/app/public/students/passports/matthew taylor_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/matthew taylor_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/matthew taylor_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 06:58:29', '2024-04-18 06:58:29', '20060607098765432000', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Chamazi', '14 Kiru Street', 'matthewtay@gmail.com'),
(73, 'Smith Rodriguuez', '2010-04-07', 'M', 'None', '0755555578', 8, '/var/opt/i_posa/storage/app/public/students/passports/smith rodriguuez_0755555578/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/smith rodriguuez_0755555578/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/smith rodriguuez_0755555578/3_5g_device_specs.pdf', 'continous', 'Stage two', '2024-04-18 08:08:37', '2024-04-18 08:08:37', '20100407123456789000', 'Self employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Azimio', '13 Chube Street', 'smithrod@gmail.com'),
(74, 'Emily Clark', '2009-02-04', 'F', 'None', '0712345678', 8, '/var/opt/i_posa/storage/app/public/students/passports/Emily Clark_0712345678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Emily Clark_0712345678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Emily Clark_0712345678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 08:12:48', '2024-04-18 08:12:48', '20090204000000000000', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Azimio', '13 Chube Street', 'emilyclark@gmail.com'),
(75, 'Michael Thompson', '2007-04-11', 'M', 'None', '0712345678', 8, '/var/opt/i_posa/storage/app/public/students/passports/Michael Thompson_0712345678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Michael Thompson_0712345678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Michael Thompson_0712345678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 08:17:31', '2024-04-18 08:17:31', '20070411123456789012', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Azimio', '14 Kiru Street', 'mikethomp@gmail.com'),
(76, 'Sarah Miller', '2009-03-30', 'F', 'None', '0756765678', 8, '/var/opt/i_posa/storage/app/public/students/passports/Sarah Miller_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Sarah Miller_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Sarah Miller_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 08:27:12', '2024-04-18 08:27:12', '20090330123456789012', 'Self employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Buza', '14 Kiru Street', 'sarahmil@gmail.com'),
(77, 'David Garcia', '2008-12-31', 'M', 'None', '0756765678', 8, '/var/opt/i_posa/storage/app/public/students/passports/David Garcia_0756765678/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/David Garcia_0756765678/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/David Garcia_0756765678/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 08:31:36', '2024-04-18 08:31:36', '20081231000000987600', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Buza', '14 Kiru Street', 'davidgarcia@gmail.com'),
(78, 'Jessica Anderson', '2008-10-01', 'F', 'None', '0678912346', 8, '/var/opt/i_posa/storage/app/public/students/passports/Jessica Anderson_0678912346/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Jessica Anderson_0678912346/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Jessica Anderson_0678912346/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 08:42:22', '2024-04-18 08:42:22', '20081001000001000000', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Buza', '14 Kiru Street', 'jessander@gmail.com'),
(79, 'Wilson Matthew', '2006-11-17', 'M', 'None', '0678912345', 8, '/var/opt/i_posa/storage/app/public/students/passports/Wilson Matthew_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Wilson Matthew_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Wilson Matthew_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 08:48:59', '2024-04-18 08:48:59', '20061117100203040506', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Azimio', '14 Kiru Street', 'wilmatthew@gmail.com'),
(80, 'Taylor Christopher', '2006-04-04', 'F', 'None', '0678912345', 8, '/var/opt/i_posa/storage/app/public/students/passports/Taylor Christopher_0678912345/Screenshot from 2024-04-13 00-39-41.png', '/var/opt/i_posa/storage/app/public/students/certificates/Taylor Christopher_0678912345/3_5g_device_specs.pdf', '/var/opt/i_posa/storage/app/public/students/letters/Taylor Christopher_0678912345/3_5g_device_specs.pdf', 'continous', 'Stage one', '2024-04-18 08:59:25', '2024-04-18 08:59:25', '20060404123123090090', 'Not employed', 'Single', 'Primary', 'Married', 'Dar Es Salaam', 'Temeke', 'Buza', '13 Chube Street', 'taylorchris@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `student_id`, `course_id`, `state`, `created_at`, `updated_at`) VALUES
(34, 28, 8, 'not complete', '2024-04-08 17:15:16', '2024-04-08 17:15:16'),
(35, 29, 1, 'not complete', '2024-04-08 17:30:17', '2024-04-08 17:30:17'),
(36, 30, 8, 'not complete', '2024-04-14 09:50:44', '2024-04-14 09:50:44'),
(37, 31, 1, 'not complete', '2024-04-14 09:56:46', '2024-04-14 09:56:46'),
(38, 32, 1, 'not complete', '2024-04-14 10:02:20', '2024-04-14 10:02:20'),
(39, 33, 1, 'not complete', '2024-04-14 10:08:03', '2024-04-14 10:08:03'),
(40, 34, 1, 'not complete', '2024-04-14 10:12:46', '2024-04-14 10:12:46'),
(41, 35, 8, 'not complete', '2024-04-14 10:41:09', '2024-04-14 10:41:09'),
(42, 36, 8, 'not complete', '2024-04-14 10:45:51', '2024-04-14 10:45:51'),
(43, 37, 8, 'not complete', '2024-04-14 10:53:10', '2024-04-14 10:53:10'),
(44, 38, 10, 'not complete', '2024-04-14 11:16:49', '2024-04-14 11:16:49'),
(45, 39, 8, 'not complete', '2024-04-14 11:24:07', '2024-04-14 11:24:07'),
(46, 41, 7, 'not complete', '2024-04-14 12:04:45', '2024-04-14 12:04:45'),
(47, 43, 11, 'not complete', '2024-04-14 12:11:29', '2024-04-14 12:11:29'),
(48, 44, 1, 'not complete', '2024-04-14 12:15:26', '2024-04-14 12:15:26'),
(49, 45, 7, 'not complete', '2024-04-14 12:19:10', '2024-04-14 12:19:10'),
(50, 46, 8, 'not complete', '2024-04-14 12:22:45', '2024-04-14 12:22:45'),
(51, 47, 11, 'not complete', '2024-04-14 12:26:38', '2024-04-14 12:26:38'),
(52, 48, 1, 'not complete', '2024-04-14 12:31:48', '2024-04-14 12:31:48'),
(53, 49, 7, 'not complete', '2024-04-14 12:35:33', '2024-04-14 12:35:33'),
(54, 50, 8, 'not complete', '2024-04-14 12:39:56', '2024-04-14 12:39:56'),
(55, 51, 10, 'not complete', '2024-04-14 12:45:20', '2024-04-14 12:45:20'),
(56, 52, 11, 'not complete', '2024-04-14 12:49:19', '2024-04-14 12:49:19'),
(57, 53, 11, 'not complete', '2024-04-15 13:23:45', '2024-04-15 13:23:45'),
(58, 54, 8, 'not complete', '2024-04-15 13:27:54', '2024-04-15 13:27:54'),
(59, 55, 11, 'not complete', '2024-04-15 13:36:39', '2024-04-15 13:36:39'),
(60, 56, 11, 'not complete', '2024-04-15 13:45:47', '2024-04-15 13:45:47'),
(61, 57, 1, 'not complete', '2024-04-15 13:50:42', '2024-04-15 13:50:42'),
(62, 58, 11, 'not complete', '2024-04-15 13:55:23', '2024-04-15 13:55:23'),
(63, 59, 8, 'not complete', '2024-04-15 13:59:28', '2024-04-15 13:59:28'),
(64, 60, 8, 'not complete', '2024-04-15 14:03:28', '2024-04-15 14:03:28'),
(65, 61, 1, 'not complete', '2024-04-15 14:08:02', '2024-04-15 14:08:02'),
(66, 62, 1, 'not complete', '2024-04-18 04:30:26', '2024-04-18 04:30:26'),
(67, 63, 11, 'not complete', '2024-04-18 04:34:39', '2024-04-18 04:34:39'),
(68, 64, 1, 'not complete', '2024-04-18 04:39:43', '2024-04-18 04:39:43'),
(69, 65, 7, 'not complete', '2024-04-18 04:44:56', '2024-04-18 04:44:56'),
(70, 66, 11, 'not complete', '2024-04-18 05:06:20', '2024-04-18 05:06:20'),
(71, 67, 1, 'not complete', '2024-04-18 05:12:50', '2024-04-18 05:12:50'),
(72, 68, 1, 'not complete', '2024-04-18 05:21:17', '2024-04-18 05:21:17'),
(73, 69, 7, 'not complete', '2024-04-18 05:26:50', '2024-04-18 05:26:50'),
(74, 70, 11, 'not complete', '2024-04-18 06:47:08', '2024-04-18 06:47:08'),
(75, 71, 1, 'not complete', '2024-04-18 06:52:48', '2024-04-18 06:52:48'),
(76, 72, 1, 'not complete', '2024-04-18 06:58:29', '2024-04-18 06:58:29'),
(77, 73, 9, 'not complete', '2024-04-18 08:08:37', '2024-04-18 08:08:37'),
(78, 74, 1, 'not complete', '2024-04-18 08:12:48', '2024-04-18 08:12:48'),
(79, 75, 12, 'not complete', '2024-04-18 08:17:32', '2024-04-18 08:17:32'),
(80, 76, 1, 'not complete', '2024-04-18 08:27:13', '2024-04-18 08:27:13'),
(81, 77, 12, 'not complete', '2024-04-18 08:31:36', '2024-04-18 08:31:36'),
(82, 78, 9, 'not complete', '2024-04-18 08:42:23', '2024-04-18 08:42:23'),
(83, 79, 12, 'not complete', '2024-04-18 08:48:59', '2024-04-18 08:48:59'),
(84, 80, 12, 'not complete', '2024-04-18 08:59:25', '2024-04-18 08:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `ANFE_training` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `gender`, `qualification`, `ANFE_training`, `email`, `phone_number`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Maria rwetuguru', 'F', 'Yes', 'Yes', 'rwetuguru@gmail.com', '0754606455', 4, '2023-12-12 11:32:55', '2024-04-05 17:45:00'),
(2, 'gadafi jeff', 'M', 'Yes', 'Yes', 'gadafi@gmail.com', '0755555555', 1, '2023-12-25 03:54:48', '2023-12-25 03:54:48'),
(3, 'kanaly kibaha', 'M', 'yes', 'Yes', 'kanalykibaha@gmail.com', '0755555555', 4, '2024-01-06 03:16:14', '2024-01-06 03:16:14'),
(4, 'Moses bunango', 'M', 'yes', 'Yes', 'bunangomoses@gmail.com', '0755555555', 4, '2024-01-10 02:08:34', '2024-01-10 02:08:34'),
(5, 'filbert ayo', 'M', 'yes', 'Yes', 'filbertayo09@gmail.com', '0754606455', 4, '2024-01-10 02:10:17', '2024-01-10 02:10:17'),
(6, 'mbunji mbunji', 'M', 'yes', 'Yes', 'mbunjimo@gmail.com', '0755555555', 4, '2024-01-10 02:10:44', '2024-01-10 02:10:44'),
(7, 'elizabeth mangu', 'F', 'yes', 'Yes', 'elizabethmangu123@gmail.com', '0754606455', 4, '2024-01-10 02:11:09', '2024-01-10 02:11:09'),
(8, 'Anatolia Ndigeza', 'F', 'yes', 'Yes', 'anatolia@gmail.com', '0754606455', 4, '2024-01-10 02:11:50', '2024-01-10 02:11:50'),
(9, 'Lisa Katani', 'F', 'yes', 'Yes', 'katani@gmail.com', '0782675745', 48, '2024-01-10 02:12:39', '2024-04-09 14:36:21'),
(10, 'Paula Makafu', 'F', 'yes', 'Yes', 'paula@gmail.com', '0754606455', 4, '2024-01-10 02:13:33', '2024-01-10 02:13:33'),
(11, 'Daud Magembe', 'M', 'yes', 'Yes', 'magembe@gmail.com', '0754606455', 4, '2024-01-10 02:14:10', '2024-01-10 02:14:10'),
(12, 'John Butoto', 'M', 'yes', 'Yes', 'butoto@gmail.com', '0755555555', 4, '2024-01-10 02:15:27', '2024-01-10 02:15:27'),
(13, 'Dismas Zaman', 'M', 'Great', 'Yes', 'dismass@gmail.com', '0754606455', 48, '2024-01-20 10:25:44', '2024-04-12 04:50:16'),
(15, 'David Ndelwa', 'M', 'qualified', 'Yes', 'ndelwa@gmail.com', '0678912346', 82, '2024-04-15 13:18:29', '2024-04-15 13:18:29'),
(16, 'Bukayo Saka', 'M', 'qualified', 'Yes', 'bukayo@gmail.com', '0756765678', 82, '2024-04-15 13:29:28', '2024-04-15 13:29:28'),
(17, 'Amina Fernachi', 'F', 'qualified', 'Yes', 'fenachiii@gmail.com', '0756765678', 82, '2024-04-15 13:46:38', '2024-04-15 13:46:38'),
(18, 'John Smith', 'M', 'qualified', 'Yes', 'john@gmail.com', '0756765678', 86, '2024-04-18 04:16:03', '2024-04-18 04:16:03'),
(19, 'Jessica Davis', 'F', 'Qualified', 'Yes', 'jessica@gmail.com', '0678912345', 86, '2024-04-18 04:17:47', '2024-04-18 04:17:47'),
(20, 'Michael Williams', 'M', 'Qualified', 'Yes', 'michael@gmail.com', '0712345678', 86, '2024-04-18 04:19:10', '2024-04-18 04:19:10'),
(21, 'Didas Mafuru', 'M', 'Qualified', 'Yes', 'didasmafuru@gmail.com', '0756765678', 89, '2024-04-18 07:12:37', '2024-04-18 07:12:37'),
(22, 'Hassan Masegenze', 'M', 'Qualified', 'Yes', 'hassangenze@gmail.com', '0712345678', 89, '2024-04-18 07:14:59', '2024-04-18 07:14:59'),
(23, 'Mwassi Rashid', 'F', 'Qualified', 'Yes', 'mwassirashid@gmail.com', '0756765678', 89, '2024-04-18 07:16:30', '2024-04-18 07:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_photo`, `phone_number`, `national_id`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gadafi japhaly', 'gadafijaphaly10@gmail.com', '/storage/images/me.jpg', NULL, NULL, 1, NULL, '$2y$10$GyNbBN.IBTr4Zf3e2lfK.uDBu9O9eg.WSBxP26pujH.lT4U39Gv6e', 'RxntIJ2xbDTIml7VcJPn3FWVcgTmGF7x29GeMrC1qP6aovpm35NXPSUWM1Ga', NULL, '2024-03-29 05:28:53'),
(2, 'Jane Doe', 'julianajumannegabriel@gmail.com', NULL, NULL, NULL, 2, NULL, '$2y$10$lw7XWas..rlXgrP0C4r0Ye.iQeuM62QTuxhswJs50bbFKyeoolpyK', NULL, NULL, NULL),
(3, 'Michael Doe', 'michaeldoe@example.com', '/storage/images/me.jpg', NULL, NULL, 3, NULL, '$2y$10$S.vysw6G7//60VVizKztlOPtKwg8ld1SOjS6ObWBg8lx5RwQGO2JC', NULL, NULL, NULL),
(4, 'mary mary', 'mary@example.com', '/storage/images/engineer.jpg', NULL, NULL, 4, NULL, '$2y$10$oDSOzrW7eXuu4VZ3Se83Cu6/BivkNFVqr8wNjJoHRfi8YiElRWSLu', NULL, NULL, NULL),
(6, 'god god', 'gadafijaphaly9@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$.D65XqmhmVhA28Dk9.77hOX.4AU45wyn5q8jeg5EMku..8VklK1om', NULL, '2023-11-18 17:39:49', '2024-03-16 06:03:14'),
(7, 'ezra makuba', 'ezra@gmail.com', NULL, NULL, NULL, 2, NULL, '$2y$10$qBPbiwGtXouZU.XO18ht3umEKOjnpm2lH9EtPwB/rwqLOy3Za.YyG', NULL, '2023-12-01 01:42:55', '2023-12-01 01:42:55'),
(8, 'editha julius', 'editha@gmail.com', NULL, NULL, NULL, 3, NULL, '12345678', NULL, '2023-12-07 17:58:57', '2023-12-07 17:58:57'),
(9, 'ashura ashura', 'ashura@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$/a8BFIVXthxyK4BVJ0Ad2O4PeVeB5qwe77TyFYxKsl7NeYmeAPJe.', NULL, '2023-12-07 18:45:38', '2023-12-07 18:45:38'),
(10, 'maria rosa', 'rosa@gmail.com', NULL, NULL, NULL, 3, NULL, '$2y$10$PCFgh6hHCqKYNbLdw1oWIeTqMcPbEbDZ/.5CTtrTn1qXOjlp5lCJu', NULL, '2023-12-08 04:58:26', '2023-12-08 04:58:26'),
(11, 'oscar skaonga', 'oscar@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$X1awTVzw9pyHT5z96eX/9.jVeZL4rqkfCAowTh3sZ/0tqOFCbbpee', NULL, '2023-12-08 05:00:52', '2023-12-08 05:00:52'),
(47, 'bashiri japhaly', 'freymous10@gmail.com', '/storage/images/16.jpeg', NULL, NULL, 3, NULL, '$2y$10$opVk.FVvb55yloZDTehK1OfDNG7K5hsGOPKHyIzWJF0/OT67j9Xc2', NULL, NULL, NULL),
(48, 'Jovin Sanga', 'jovin@gmail.com', '/storage/images/kikiki.jpg', NULL, NULL, 4, NULL, '$2y$10$ZEHMahY7X/XEs74mgFi.zeItRYJUtp1IyNerpinAeIyYUTLb2ZNw2', NULL, NULL, NULL),
(58, 'Andy File', 'andocius26philemon@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$G94jQ4KIxw92C4zpioMebec.F7.pMTyrZMrRK0me9sB9HErIP09c6', '4kSsx6GD3We3bDM7nQAFEYJ2GCrqSsfMF9WCGRfVPJYXb4nC1p7mPUMcvb3q', '2024-03-28 06:20:43', '2024-03-29 05:35:18'),
(77, 'simon mpembee', 'lupembe@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$dGnw8fPVAkSXoQXFvDUYjOGCBOPUKINin8qNLhalCqp7BeIJoeonC', NULL, '2024-03-29 05:14:08', '2024-03-29 05:14:08'),
(80, 'Donatha Yona', 'donatha@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$sqB7KxfdCatHbZR4cIou5uPiDFVFV6PlNGcSthNblY.6dXsEQr2bW', NULL, NULL, NULL),
(81, 'Grace Yona', 'grace@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$pWoAJWPiGdIxMUmDGTBX7OVhYIwCGBiTlTz7QDqpwSl6zzkfX3W8e', NULL, NULL, NULL),
(82, 'Greta guresi', 'greta@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$IUB0K/Q/iUTk9aZIHvW3FuIA6lfdhXXFsWUm0z9s.8JRmzVeOf32G', NULL, NULL, NULL),
(83, 'Kobbie Maino', 'maino@gmail.com', NULL, NULL, NULL, 3, NULL, '$2y$10$86joNPKFHi3BYRfGfj1OMOKy/AxdOoP5sEXbVftKrxoULMKBjLv8O', NULL, NULL, NULL),
(84, 'Cole Palmer', 'colepalmer@gmail.com', NULL, NULL, NULL, 2, NULL, '$2y$10$bbdeodgf4PvUawSs4L1Mie3QWKjrdxk3nNlFNmqBkevYFumu0fhMC', NULL, NULL, NULL),
(85, 'Connor Gallagher', 'gallagher@gmail.com', NULL, NULL, NULL, 3, NULL, '$2y$10$FQSGuIPgqzvs2UImPhEko.cKYQW3GBMZn90kr.LdscZj3KXbT71Z2', NULL, NULL, NULL),
(86, 'Niko Jackson', 'jackson@gmail.com', NULL, NULL, NULL, 4, NULL, '$2y$10$zlOUMU/y8vG4Rn1ckCRtROb2YZu2NdCtQX8pzqzbTR/Jb35YVwKiS', NULL, NULL, NULL),
(87, 'Enzo Fernandez', 'enzo@gmail.com', NULL, NULL, NULL, 2, NULL, '$2y$10$2SJmlnT764pg9Js7IZ1UDeJkfKSetJ/gp9EEpBxPeEtkkg5mEHG12', NULL, NULL, NULL),
(88, 'Thiago Silver', 'silver@gmail.com', NULL, NULL, NULL, 3, NULL, '$2y$10$KPGYZ6uvhvvy8sPIs.4yzeDUNINfzTQRKs0yR/HbYUfrkz8uvf0zy', NULL, NULL, NULL),
(89, 'Alex Disasi', 'disasi@gmail.com', '/storage/images/batty.jpeg', NULL, NULL, 4, NULL, '$2y$10$6TTT4vnP4ufm9WPKnbpvP.d7hljn6e7SA.fjhnnSZQ4lrLicONRW.', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centers_district_id_foreign` (`district_id`),
  ADD KEY `centers_hod_id_foreign` (`hod_id`);

--
-- Indexes for table `center_reports`
--
ALTER TABLE `center_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `challenges_user_id_foreign` (`user_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clubs_center_id_foreign` (`Center_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_name_unique` (`name`);

--
-- Indexes for table `course_centers`
--
ALTER TABLE `course_centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_centers_course_id_foreign` (`course_id`),
  ADD KEY `course_centers_center_id_foreign` (`center_id`),
  ADD KEY `course_centers_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_name_unique` (`name`),
  ADD UNIQUE KEY `districts_cordinator_id_unique` (`cordinator_id`),
  ADD KEY `districts_region_id_foreign` (`region_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guardians_student_id_foreign` (`student_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_course_id_foreign` (`course_id`),
  ADD KEY `inventories_center_id_foreign` (`center_id`);

--
-- Indexes for table `inventory_requests`
--
ALTER TABLE `inventory_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_requests_course_id_foreign` (`course_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newrepports`
--
ALTER TABLE `newrepports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `newrepports_upload_user_id_foreign` (`upload_user_id`),
  ADD KEY `newrepports_approve_user_id_foreign` (`approve_user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_name_unique` (`name`),
  ADD KEY `regions_cordinator_id_foreign` (`cordinator_id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remarks_report_id_foreign` (`report_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_center_id_foreign` (`center_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`),
  ADD KEY `teachers_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_national_id_unique` (`national_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `center_reports`
--
ALTER TABLE `center_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `course_centers`
--
ALTER TABLE `course_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory_requests`
--
ALTER TABLE `inventory_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `newrepports`
--
ALTER TABLE `newrepports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `centers`
--
ALTER TABLE `centers`
  ADD CONSTRAINT `centers_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `centers_hod_id_foreign` FOREIGN KEY (`hod_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `challenges`
--
ALTER TABLE `challenges`
  ADD CONSTRAINT `challenges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_center_id_foreign` FOREIGN KEY (`Center_id`) REFERENCES `centers` (`id`);

--
-- Constraints for table `course_centers`
--
ALTER TABLE `course_centers`
  ADD CONSTRAINT `course_centers_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `course_centers_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_centers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_cordinator_id_foreign` FOREIGN KEY (`cordinator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `districts_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `guardians`
--
ALTER TABLE `guardians`
  ADD CONSTRAINT `guardians_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `inventories_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `inventory_requests`
--
ALTER TABLE `inventory_requests`
  ADD CONSTRAINT `inventory_requests_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `newrepports`
--
ALTER TABLE `newrepports`
  ADD CONSTRAINT `newrepports_approve_user_id_foreign` FOREIGN KEY (`approve_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `newrepports_upload_user_id_foreign` FOREIGN KEY (`upload_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_cordinator_id_foreign` FOREIGN KEY (`cordinator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `remarks`
--
ALTER TABLE `remarks`
  ADD CONSTRAINT `remarks_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `center_reports` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
