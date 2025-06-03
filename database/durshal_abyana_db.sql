-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2025 at 10:56 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `durshal_abyana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_roles`
--

CREATE TABLE `assign_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_roles`
--

INSERT INTO `assign_roles` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(9, 1, 1, NULL, NULL),
(19, 1, 2, NULL, NULL),
(20, 1, 3, NULL, NULL),
(24, 12, 4, NULL, NULL),
(25, 12, 2, NULL, NULL),
(26, 12, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `canals`
--

CREATE TABLE `canals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `canal_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_outlet` int(11) DEFAULT NULL,
  `no_outlet_ls` int(11) DEFAULT NULL,
  `no_outlet_rs` int(11) DEFAULT NULL,
  `total_no_cca` int(11) DEFAULT NULL,
  `total_no_discharge_cusic` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `canals`
--

INSERT INTO `canals` (`id`, `canal_name`, `village_id`, `created_at`, `updated_at`, `div_id`, `no_outlet`, `no_outlet_ls`, `no_outlet_rs`, `total_no_cca`, `total_no_discharge_cusic`) VALUES
(1, 'swat', 3, '2024-12-20 06:40:20', '2024-12-20 06:40:20', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Mathra 1', 2, '2025-01-09 00:54:01', '2025-01-09 00:54:01', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Saqib', 2, '2025-01-14 04:17:00', '2025-01-14 04:17:00', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Canal-1', 14, '2025-01-17 09:53:35', '2025-01-17 09:53:35', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Canal-2', 14, '2025-01-17 09:54:11', '2025-01-17 09:54:11', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'canal/3', 15, '2025-02-12 01:10:39', '2025-02-12 01:10:39', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'canal swat', 15, '2025-02-12 01:17:32', '2025-02-12 01:17:32', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'adezi canal', 14, '2025-02-20 13:12:01', '2025-02-20 13:12:01', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'minor No 1 of kalpani', 1, '2025-03-07 21:17:10', '2025-03-07 21:17:10', 1, 45, 40, 5, NULL, NULL),
(10, 'swat', 2, '2025-03-07 21:37:05', '2025-03-07 21:37:05', 1, 45, 40, 5, NULL, NULL),
(11, 'canal swat', 2, '2025-03-07 21:38:49', '2025-03-07 21:38:49', 2, 45, 40, 5, 3, NULL),
(12, 'change', 3, '2025-03-07 21:41:13', '2025-03-12 03:31:14', 1, 45, 40, 89, 8, 8),
(13, 'change', 3, '2025-03-07 21:59:54', '2025-03-12 00:28:58', 1, 48, 45, 28, 6, 8),
(14, 'Canal Amankot', 21, '2025-03-13 03:47:45', '2025-03-13 03:47:45', 1, 4550, 4, 5, 6, 8),
(15, 'canal amankot', 21, '2025-03-13 05:18:35', '2025-03-13 05:18:35', 1, 45, 40, 5, 6, 8),
(16, 'canal mardan', 23, '2025-03-14 03:13:12', '2025-03-14 03:13:12', 2, 45, 40, 5, 6, 8),
(17, 'tangi canal', 24, '2025-03-14 03:56:08', '2025-03-14 03:56:08', 1, 45, 40, 8, 6, 8),
(18, 'Peshawar', 17, '2025-03-18 03:20:05', '2025-03-18 03:20:05', 1, 2, 2, 2, 22, 22);

-- --------------------------------------------------------

--
-- Table structure for table `cropprices`
--

CREATE TABLE `cropprices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `final_crop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cropprices`
--

INSERT INTO `cropprices` (`id`, `crop_price`, `created_at`, `updated_at`, `final_crop`) VALUES
(1, '60', '2024-12-26 05:32:58', '2025-03-03 06:29:14', 'Maize'),
(2, '60', '2024-12-26 05:33:23', '2025-03-04 03:36:24', 'Rice'),
(3, '75', '2025-02-22 01:53:13', '2025-02-22 01:53:13', 'makie');

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `crop_name`, `created_at`, `updated_at`) VALUES
(1, 'Rabi', '2024-12-23 04:45:23', '2024-12-23 04:45:23'),
(2, 'Kharif', '2024-12-23 04:45:23', '2024-12-23 04:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `cropsurveys`
--

CREATE TABLE `cropsurveys` (
  `crop_survey_id` bigint(20) UNSIGNED NOT NULL,
  `khasra_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` date NOT NULL,
  `cultivators_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `snowing_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `land_assessment_marla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `land_assessment_kanal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_crop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `width` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_marla` int(11) NOT NULL,
  `area_kanal` int(11) NOT NULL,
  `double_crop_marla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `double_crop_kanal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifable_area_marla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifable_area_kanal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irrigated_area_marla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irrigated_area_kanal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `land_quality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irrigator_khata_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `irrigator_id` bigint(20) UNSIGNED NOT NULL,
  `canal_id` bigint(20) UNSIGNED NOT NULL,
  `crop_id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `session_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finalcrop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `crop_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_billed` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cropsurveys`
--

INSERT INTO `cropsurveys` (`crop_survey_id`, `khasra_number`, `tenant_name`, `registration_date`, `cultivators_info`, `snowing_date`, `land_assessment_marla`, `land_assessment_kanal`, `previous_crop`, `date`, `width`, `length`, `area_marla`, `area_kanal`, `double_crop_marla`, `double_crop_kanal`, `identifable_area_marla`, `identifable_area_kanal`, `irrigated_area_marla`, `irrigated_area_kanal`, `land_quality`, `irrigator_khata_number`, `village_id`, `irrigator_id`, `canal_id`, `crop_id`, `outlet_id`, `created_at`, `updated_at`, `session_date`, `finalcrop_id`, `crop_price`, `is_billed`, `review`, `status`) VALUES
(1, '234', 'Saqib', '2025-02-27', 'Saqib', '2025-02-27', '0', '0', 'Maize', '2025-02-27', '120', '243', 3, 18, '0', '0', '0', '0', '0', '0', 'N/A', '0001', 14, 1, 4, 1, 5, '2025-02-27 02:59:55', '2025-02-27 03:17:19', '2025', 2, '55', 1, 'xen', 3),
(2, '1234', 'Saqib', '2025-02-28', 'Saqib', '2025-02-28', '0', '0', 'Maize', '2025-02-28', '56', '34', 10, 4, '0', '0', '0', '0', '0', '0', 'N/A', '0001', 14, 1, 4, 2, 5, '2025-02-28 01:59:59', '2025-03-05 01:24:10', '2025', 1, '45', 0, 'collector', 3),
(3, '123', 'abbas ali shah', '2025-03-04', 'abbas ali shah', '2025-03-04', '0', '0', 'Rice', '2025-03-04', '9', '89', 18, 4, '0', '0', '0', '0', '0', '0', 'N/A', '001', 14, 4, 5, 2, 6, '2025-03-04 06:26:37', '2025-03-05 01:23:27', '2025', 2, '60', 0, 'gg', 3),
(4, '123', 'abbas ali shah', '2025-03-05', 'abbas ali shah', '2025-03-05', '0', '0', 'Maize', '2025-03-05', '90', '69', 19, 7, '0', '0', '0', '0', '0', '0', 'N/A', '00155', 14, 3, 5, 2, 6, '2025-03-05 01:21:42', '2025-03-05 01:27:56', '2025', 1, '60', 0, 'nn', 3),
(5, '1234', 'abbas ali shah', '2025-03-05', 'abbas ali shah', '2025-03-05', '0', '0', 'makie', '2025-03-05', '78', '90', 8, 8, '0', '0', '0', '0', '0', '0', 'N/A', '00155', 14, 3, 5, 2, 6, '2025-03-05 01:26:56', '2025-03-14 01:56:03', '2025', 3, '75', 0, 'farward', 2),
(6, '1234', 'mahnoor', '2025-03-05', 'mahnoor', '2025-03-05', '0', '0', 'Rice', '2025-03-05', '666', '55', 1, 36, '0', '0', '0', '0', '0', '0', 'N/A', '20202', 14, 5, 5, 2, 6, '2025-03-05 01:32:13', '2025-03-11 01:38:17', '2025', 2, '60', 0, 'g', 3),
(7, '2228', 'mahnoor', '2025-03-05', 'mahnoor', '2025-03-05', '0', '0', 'Rice', '2025-03-05', '555', '666', 1, 61, '0', '0', '0', '0', '0', '0', 'N/A', '20202', 14, 5, 5, 2, 6, '2025-03-05 01:34:28', '2025-03-13 18:55:31', '2025', 2, '60', 0, 'tt', 2),
(8, '99', 'Saqib', '2025-03-13', 'Saqib', '2025-03-13', '0', '0', 'makie', '2025-03-13', '8', '88', 16, 4, '0', '0', '0', '0', '0', '0', 'N/A', '0001', 14, 1, 4, 1, 5, '2025-03-13 18:53:50', '2025-03-13 18:54:13', '2025', 3, '75', 0, 'test', 1),
(9, '222', 'hamza', '2025-03-14', 'hamza', '2025-03-14', '0', '0', 'Maize', '2025-03-14', '0', '0', 0, 0, '0', '0', '0', '0', '0', '0', 'N/A', '001', 21, 10, 14, 1, 10, '2025-03-14 00:56:55', '2025-03-18 03:11:34', '2025', 1, '60', 0, 'g', 2),
(10, '6', 'Ghulam Shah s/o Ghandal Shah', '2025-03-14', 'Ghulam Shah s/o Ghandal Shah', '2025-03-14', '0', '0', 'Maize', '2025-03-14', '0', '0777', 17, 38, '0', '0', '0', '0', '0', '0', 'N/A', '8', 21, 9, 14, 1, 10, '2025-03-14 01:11:06', '2025-03-18 03:50:51', '2025', 1, '60', 0, 'reverse', 0),
(11, '222', 'Ghulam Shah s/o Ghandal Shah', '2025-03-14', 'Ghulam Shah s/o Ghandal Shah', '2025-03-14', '0', '0', 'Rice', '2025-03-14', '0', '0', 0, 0, '0', '0', '0', '0', '0', '0', 'N/A', '7', 24, 15, 17, 2, 11, '2025-03-14 04:06:46', '2025-03-14 04:07:38', '2025', 2, '60', 0, 'bb', 1),
(12, '222', 'Ghulam Shah s/o Ghandal Shah', '2025-03-14', 'Ghulam Shah s/o Ghandal Shah', '2025-03-14', '0', '0', 'Maize', '2025-03-14', '0', '0', 0, 0, '0', '0', '0', '0', '0', '0', 'N/A', '7', 24, 15, 17, 2, 11, '2025-03-14 04:07:10', '2025-03-14 04:07:25', '2025', 1, '60', 0, 'b', 1),
(13, '345', 'Saqib', '2025-03-17', 'Saqib', '2025-03-17', '0', '0', 'Rice', '2025-03-17', '78', '56', 14, 6, '0', '0', '0', '0', '0', '0', 'N/A', '0001', 14, 1, 4, 2, 5, '2025-03-17 04:24:41', '2025-03-17 04:27:49', '2025', 2, '60', 0, 'farwarded', 1),
(14, '222', 'abbas ali shah', '2025-03-18', 'abbas ali shah', '2025-03-18', '0', '0', 'Maize', '2025-03-18', '333', '1222', 15, 77, '0', '0', '0', '0', '0', '0', 'N/A', '001888', 14, 2, 5, 1, 6, '2025-03-18 03:12:37', '2025-03-18 03:17:22', '2025', 1, '60', 0, 'test', 1),
(15, '1112', 'Shahzeb Siddiq', '2025-03-18', 'Shahzeb Siddiq', '2025-03-18', '12', '12', 'Maize', '2025-03-18', '30', '20', 10, 2, '0', '0', '0', '0', '0', '0', 'N/A', '121212', 17, 16, 18, 2, 12, '2025-03-18 03:27:07', '2025-03-18 03:29:06', '2025', 1, '60', 0, 'All check no issue found', 1),
(16, '1212', 'Shahzeb Siddiq', '2025-03-18', 'Shahzeb Siddiq', '2025-03-18', '0', '0', 'Maize', '2025-03-18', '22', '33', 15, 2, '0', '0', '0', '0', '0', '0', 'N/A', '121212', 17, 16, 18, 1, 12, '2025-03-18 03:28:04', '2025-03-18 03:28:04', '2025', 1, '60', 0, 'Survey Added', 0);

-- --------------------------------------------------------

--
-- Table structure for table `distributaries`
--

CREATE TABLE `distributaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `canal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED DEFAULT NULL,
  `minor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_outlet` int(11) DEFAULT NULL,
  `no_outlet_ls` int(11) DEFAULT NULL,
  `no_outlet_rs` int(11) DEFAULT NULL,
  `total_no_cca` int(11) DEFAULT NULL,
  `total_no_discharge_cusic` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distributaries`
--

INSERT INTO `distributaries` (`id`, `name`, `canal_id`, `div_id`, `minor_id`, `no_outlet`, `no_outlet_ls`, `no_outlet_rs`, `total_no_cca`, `total_no_discharge_cusic`, `created_at`, `updated_at`) VALUES
(1, 'uzair', 3, 1, 2, 48, 40, 5, 6, 8, '2025-03-09 14:40:08', '2025-03-09 14:40:08'),
(2, 'change dist', 3, 1, 1, 45, 40, 5, 6, 8, '2025-03-11 02:40:52', '2025-03-12 03:52:27'),
(3, 'canal distri', 9, 1, 6, 45, 40, 500, 6, 800000, '2025-03-11 04:42:16', '2025-03-12 02:53:31'),
(4, 'distributaray', 14, 1, 7, 45, 40, 5, 6, 8, '2025-03-13 05:20:17', '2025-03-13 05:20:17'),
(5, 'minor dist', 14, 1, 7, 45, 20, 28, 3, 8, '2025-03-14 00:55:24', '2025-03-14 00:55:24'),
(6, 'tangi dist', 17, 1, 9, 45, 40, 5, 6, 8, '2025-03-14 04:00:02', '2025-03-14 04:00:02'),
(7, 'Disty Peshawar', 18, 1, 10, 2, 3, 3, 32, 323, '2025-03-18 03:23:42', '2025-03-18 03:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `div_id`) VALUES
(1, 'Charsadda', '2024-12-15 07:40:26', '2024-12-15 07:40:26', 1),
(2, 'Nowshera', '2024-12-15 07:40:45', '2024-12-15 07:40:45', 1),
(3, 'Mohmand', '2024-12-15 07:41:57', '2024-12-15 07:41:57', 1),
(4, 'Khyber', '2024-12-15 07:42:22', '2024-12-15 07:42:22', 1),
(5, 'Swabi', '2024-12-15 07:44:25', '2024-12-15 07:44:25', 2),
(6, 'Mardan', '2024-12-15 07:44:36', '2024-12-15 07:44:36', 2),
(7, 'Peshawar', '2024-12-15 07:45:04', '2024-12-15 07:45:04', 1),
(8, 'Kohat', '2024-12-15 07:46:17', '2024-12-15 07:46:17', 3),
(9, 'Hangu', '2024-12-15 07:46:32', '2024-12-15 07:46:32', 3),
(10, 'Karak', '2024-12-15 07:46:51', '2024-12-15 07:46:51', 3),
(11, 'Orakzai', '2024-12-15 07:47:08', '2024-12-15 07:47:08', 3),
(12, 'Kurram', '2024-12-15 07:47:24', '2024-12-15 07:47:24', 3),
(13, 'Bannu', '2024-12-15 07:49:03', '2024-12-15 07:49:03', 4),
(14, 'Lakki Marwatn', '2024-12-15 07:49:33', '2024-12-15 07:49:33', 4),
(15, 'North Waziristan', '2024-12-15 07:49:49', '2024-12-15 07:49:49', 4),
(16, 'Charsdda', '2025-02-20 12:31:57', '2025-02-20 12:31:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divsion_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `divsion_name`, `created_at`, `updated_at`) VALUES
(1, 'peshawar Canal Divsion', '2024-12-15 07:30:58', '2024-12-15 07:30:58'),
(2, 'Mardan Irrigation Divsion', '2024-12-15 07:35:04', '2024-12-15 07:35:04'),
(3, 'Marwat Canal Divsion', '2024-12-15 07:35:29', '2024-12-15 07:35:29'),
(4, 'Mansehra Irrigation Divsion', '2024-12-15 07:36:01', '2024-12-15 07:36:01'),
(5, ' Swabi Irrigation Divsion-2', '2024-12-15 07:36:22', '2024-12-15 07:36:22'),
(6, 'Swat Irrigation Division-II', '2024-12-15 07:36:39', '2024-12-15 07:36:39'),
(7, 'Chitral Irrigation Division', '2024-12-15 07:36:56', '2024-12-15 07:36:56'),
(8, 'Malakand Irrigation Division', '2025-02-17 12:04:40', '2025-02-17 12:04:40'),
(9, 'Warsak Canal Irrigation Division', '2025-02-17 12:05:09', '2025-02-17 12:05:09'),
(10, 'Gomal Zam Irrigation Division', '2025-02-17 12:05:25', '2025-02-17 12:05:25'),
(11, 'Paharpur Irrigation Division', '2025-02-17 12:05:43', '2025-02-17 12:05:43'),
(12, 'Flood Irrigation Division DI Khan', '2025-02-17 12:06:02', '2025-02-17 12:06:02'),
(13, 'CRBC Division DI Khan', '2025-02-17 12:06:19', '2025-02-17 12:06:19'),
(14, 'Charsadda Irrigation Division', '2025-02-17 12:06:48', '2025-02-17 12:06:48'),
(15, 'Tubewell Irrigation Division', '2025-02-17 12:07:06', '2025-02-17 12:07:06'),
(16, 'Hydrology Irrigation Division', '2025-02-17 12:07:20', '2025-02-17 12:07:20'),
(17, 'Bannu Canal Division', '2025-02-17 12:07:37', '2025-02-17 12:07:37'),
(18, 'Kohat Irrigation Division', '2025-02-17 12:07:51', '2025-02-17 12:07:51'),
(19, 'Haripur Irrigation Division', '2025-02-17 12:08:05', '2025-02-17 12:08:05'),
(20, 'Swabi Irrigation Division-I', '2025-02-17 12:34:15', '2025-02-17 12:34:15'),
(21, 'Swat Irrigation Division-I', '2025-02-17 12:34:32', '2025-02-17 12:34:32'),
(22, 'Dir Irrigation Division', '2025-02-17 12:34:52', '2025-02-17 12:34:52'),
(23, 'Bajur Irrigation Division', '2025-02-17 12:35:11', '2025-02-17 12:35:11'),
(24, 'Mohmand Irrigation Division', '2025-02-17 12:35:31', '2025-02-17 12:35:31'),
(25, 'Khyber Irrigation Division', '2025-02-17 12:35:49', '2025-02-17 12:35:49'),
(26, 'Orakzai Irrigation Division', '2025-02-17 12:36:03', '2025-02-17 12:36:03'),
(27, 'Kurrum Irrigation Division', '2025-02-17 12:36:19', '2025-02-17 12:36:19'),
(28, 'North waziristan Irrigation Division', '2025-02-17 12:36:35', '2025-02-17 12:36:35'),
(29, 'South waziristan Irrigation Division', '2025-02-17 12:36:49', '2025-02-17 12:36:49'),
(30, 'Ground water', '2025-02-17 12:37:04', '2025-02-17 12:37:04'),
(32, 'abbas', '2025-03-19 00:33:21', '2025-03-19 00:33:21');

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
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmer_id` bigint(20) UNSIGNED NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` date NOT NULL,
  `assessment_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patwari_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cultivators_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `marla` int(11) DEFAULT NULL,
  `kanal` int(11) DEFAULT NULL,
  `previous_crop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `snowing_date` date NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `tehsil_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `canal_id` bigint(20) UNSIGNED NOT NULL,
  `crop_id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` bigint(20) UNSIGNED NOT NULL,
  `water_outlet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plat_boundary_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`farmer_id`, `serial_number`, `registration_date`, `assessment_number`, `patwari_name`, `owner_name`, `tenant_name`, `cultivators_info`, `marla`, `kanal`, `previous_crop`, `snowing_date`, `village_id`, `division_id`, `tehsil_id`, `district_id`, `canal_id`, `crop_id`, `outlet_id`, `water_outlet`, `plat_boundary_number`, `created_at`, `updated_at`) VALUES
(1, '6', '2024-11-01', '7', 'abbas', 'abbas', 'hh', 'mahnoor', 0, 8, 'u', '2024-11-01', 1, 6, 8, 8, 8, 5, 4, 'h', '', '2024-10-31 22:27:22', '2024-10-31 22:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `halqa`
--

CREATE TABLE `halqa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `halqa_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tehsil_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `halqa`
--

INSERT INTO `halqa` (`id`, `halqa_name`, `tehsil_id`, `created_at`, `updated_at`) VALUES
(4, 'halqa 1', 4, '2024-12-15 08:12:08', '2024-12-15 08:12:08'),
(5, 'halqa 2', 4, '2024-12-15 08:12:29', '2024-12-15 08:12:29'),
(6, 'halqa shabqar', 5, '2024-12-15 08:12:54', '2024-12-15 08:12:54'),
(7, 'halqa2 sabqadar', 5, '2024-12-15 08:13:20', '2024-12-15 08:13:20'),
(8, 'halqa1 nowshra', 7, '2024-12-15 08:14:05', '2024-12-15 08:14:05'),
(9, 'halqa2 nowshra', 7, '2024-12-15 08:14:27', '2024-12-15 08:14:27'),
(10, 'halqa1 pabbi', 8, '2024-12-15 08:15:47', '2024-12-15 08:15:47'),
(11, 'halqa pabbi', 9, '2024-12-15 08:16:09', '2024-12-15 08:16:09'),
(12, 'halqa mohmand', 14, '2024-12-15 08:16:37', '2024-12-15 08:16:37'),
(13, 'halqa ekkaghund', 15, '2024-12-15 08:17:03', '2024-12-15 08:17:03'),
(14, 'halqa haleezai', 16, '2024-12-15 08:17:22', '2024-12-15 08:17:22'),
(15, 'halqa baizai', 17, '2024-12-15 08:17:45', '2024-12-15 08:17:45'),
(16, 'halqa safi pindiali', 18, '2024-12-15 08:18:37', '2024-12-15 08:18:37'),
(17, 'halqa bara', 10, '2024-12-15 08:19:02', '2024-12-15 08:19:02'),
(18, 'halqa jamurd', 11, '2024-12-15 08:21:39', '2024-12-15 08:21:39'),
(19, 'halqa landi kotal', 12, '2024-12-15 08:21:59', '2024-12-15 08:21:59'),
(20, 'halqa mulagori', 13, '2024-12-15 08:22:21', '2024-12-15 08:22:21'),
(21, 'Saddar', 1, '2024-12-16 03:22:02', '2024-12-16 03:22:02'),
(22, 'Saddar2', 1, '2024-12-16 03:22:18', '2024-12-16 03:22:18'),
(23, 'chota lahor halqa', 19, '2024-12-18 00:25:50', '2024-12-18 00:25:50'),
(24, 'halqa yyy', 19, '2024-12-19 04:45:05', '2024-12-19 04:45:05'),
(25, 'pabbi', 8, '2025-03-13 05:15:55', '2025-03-13 05:15:55'),
(26, 'mardan halqa', 21, '2025-03-14 03:11:28', '2025-03-14 03:11:28'),
(27, 'tangi village', 22, '2025-03-14 03:54:31', '2025-03-14 03:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `irrigators`
--

CREATE TABLE `irrigators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED DEFAULT NULL,
  `canal_id` int(11) DEFAULT NULL,
  `irrigator_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irrigator_khata_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irrigator_f_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `irrigator_mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `irrigators`
--

INSERT INTO `irrigators` (`id`, `village_id`, `canal_id`, `irrigator_name`, `irrigator_khata_number`, `irrigator_f_name`, `irrigator_mobile_number`, `created_at`, `updated_at`, `cnic`) VALUES
(1, 14, 4, 'Saqib updated', '0001', 'Sher Ali Khan', '0000001', '2025-02-27 02:21:54', '2025-03-17 04:27:03', NULL),
(2, 14, 5, 'abbas ali shah', '001888', 'dddd', '03331234', '2025-02-28 05:23:03', '2025-02-28 05:23:03', NULL),
(3, 14, 5, 'abbas ali shah', '00155', 'ddd', '03331234', '2025-02-28 05:36:10', '2025-02-28 05:36:10', '17301-2181940-9'),
(4, 14, 5, 'abbas ali shah', '001', 'mian', '212121', '2025-03-04 06:25:44', '2025-03-04 06:25:44', '1510191586243'),
(5, 14, 5, 'mahnoor', '20202', 'arbab', '03331234', '2025-03-05 01:30:07', '2025-03-05 01:30:07', '17301-2181940-9'),
(6, 14, 5, 'Ghulam Shah s/o Ghandal Shah', '55', '333', '03331234', '2025-03-05 01:30:28', '2025-03-05 01:30:28', '17301-2181940-9'),
(7, 14, 4, 'abbas ali shah test', '79', 'test', '2323232', '2025-03-13 02:49:09', '2025-03-13 02:49:09', '1510191586243'),
(8, 14, 4, 'hamza test2', '0013', 'test2', '03331234', '2025-03-13 02:49:36', '2025-03-13 02:49:36', '1510191586243'),
(9, 21, 14, 'Ghulam Shah s/o Ghandal Shah', '8', 'sher', '03331234', '2025-03-13 03:49:22', '2025-03-13 03:49:22', '5678798809658'),
(10, 21, 14, 'hamza', '001', 'sher', '03331234', '2025-03-13 04:13:57', '2025-03-13 04:13:57', '1730189401458'),
(11, 21, 14, 'saifoor', '1', 'shah', '2323232', '2025-03-13 04:14:24', '2025-03-13 04:14:24', '1730189401458'),
(12, 23, 16, 'abbas', '001', 'g', '03331234', '2025-03-14 03:13:59', '2025-03-14 03:13:59', '5678798809658'),
(13, 24, 17, 'saifoor', '001', 'gg', '90765', '2025-03-14 04:01:01', '2025-03-14 04:01:01', '17301-2181940-9'),
(14, 24, 17, 'Ghulam Shah s/o Ghandal Shah', '9', 'hh', 'hhh', '2025-03-14 04:01:17', '2025-03-14 04:01:17', '17301-2181940-9'),
(15, 24, 17, 'Ghulam Shah s/o Ghandal Shah', '7', 'gg', '2323232', '2025-03-14 04:06:03', '2025-03-14 04:06:03', '5678798809658'),
(16, 17, 18, 'Shahzeb Siddiq', '121212', 'Siddiq Jan', '03334740006', '2025-03-18 03:24:50', '2025-03-18 03:24:50', '17301123456789');

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
(5, '2024_10_24_070033_create_districts_table', 1),
(6, '2024_10_31_102828_create_divisions_table', 2),
(7, '2024_10_31_105241_create_tehsils_table', 2),
(9, '2024_11_01_095010_create_villages_table', 4),
(12, '2024_11_01_040006_create_canal_outlets_table', 5),
(13, '2024_11_01_110102_create_canals_table', 6),
(14, '2024_11_01_125515_create_canals_table', 7),
(15, '2024_11_01_160915_village_id_to_canal_outlets_table', 8),
(16, '2024_11_01_170722_rename_village_id_in_canal_outlets_table', 9),
(17, '2024_11_01_171344_village_id_to_canal_outlets_table', 10),
(18, '2024_11_04_055910_create_farmers_table', 11),
(19, '2024_11_04_071907_create_admins_table', 12),
(21, '2024_11_06_044255_create_crops_table', 13),
(22, '2024_11_08_162149_create_roles_table', 14),
(23, '2024_11_08_163444_create_permissions_table', 15),
(24, '2024_11_09_170500_create_assign_roles_table', 16),
(25, '2024_11_11_054431_add_columns_to_users_table', 17),
(26, '2024_11_20_060822_div_id_to_districts_table', 18),
(27, '2024_11_20_063252_create_halqa_table', 19),
(28, '2024_11_21_035657_create_patwari_table', 20),
(29, '2024_11_25_073723_create_irrigators_table', 21),
(30, '2024_11_27_095311_create_land_records_table', 22),
(31, '2024_11_28_153748_add_halqa_id_to_villages_table', 23),
(32, '2024_12_04_041414_create_cropsurveys_table', 24),
(33, '2024_12_11_064448_rename_district_id_to_halqa_id_in_users_table', 25),
(34, '2024_12_19_071559_create_outlets_table', 26),
(35, '2024_12_20_102504_create_canals_table', 27),
(36, '2024_12_20_111509_create_canals_table', 28),
(37, '2024_12_20_113520_create_canals_table', 29),
(38, '2024_12_23_094232_create_crops_table', 30),
(39, '2024_12_23_163242_add_new_column_to_cropsurveys_table', 31),
(40, '2024_12_24_091957_create_cropprices_table', 32),
(43, '2024_12_24_092313_create_cropprices_table', 33),
(44, '2024_12_26_095212_add_new_column_to_cropprices_table', 33),
(45, '2024_12_26_105934_add_new_column_to_cropsurveys_table', 34),
(46, '2024_12_26_110353_add_new_column_to_cropsurveys_table', 35),
(47, '2025_01_13_105106_add_new_column_to_cropsurveys_table', 36),
(48, '2025_01_13_105107_add_new_column_to_cropsurveys_table', 37),
(49, '2025_01_13_112830_modify_review_column_in_cropsurveys_table', 38),
(50, '2025_02_28_100352_add_column_to_irrigators_table', 39),
(51, '2025_03_08_011751_add_columns_to_canals_table', 40),
(52, '2025_03_08_051615_create_minorcanals_table', 41),
(53, '2025_03_08_190432_create_distributaries_table', 42),
(54, '2025_03_10_042831_add_columns_to_outlets_table', 43),
(56, '2025_03_19_074347_create_reviews_table', 44),
(58, '2025_03_10_044908_add_columns_to_outlets_table', 45),
(59, '2025_03_19_093616_create_review_table', 45);

-- --------------------------------------------------------

--
-- Table structure for table `minorcanals`
--

CREATE TABLE `minorcanals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `minor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `canal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_outlet` int(11) DEFAULT NULL,
  `no_outlet_ls` int(11) DEFAULT NULL,
  `no_outlet_rs` int(11) DEFAULT NULL,
  `total_no_cca` int(11) DEFAULT NULL,
  `total_no_discharge_cusic` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minorcanals`
--

INSERT INTO `minorcanals` (`id`, `minor_name`, `canal_id`, `div_id`, `no_outlet`, `no_outlet_ls`, `no_outlet_rs`, `total_no_cca`, `total_no_discharge_cusic`, `created_at`, `updated_at`) VALUES
(1, 'canal', 5, 1, 45, 40, 5, 6, 8, '2025-03-08 01:07:33', '2025-03-08 01:07:33'),
(2, 'change', 5, 1, 48, 40, 8, 6, 8, '2025-03-08 01:09:00', '2025-03-12 00:54:46'),
(3, 'canal', 5, 1, 45, 20, 28, 6, 8, '2025-03-08 01:10:11', '2025-03-08 01:10:11'),
(4, 'canal', 2, 1, 45, 4000, 5, 6, 8, '2025-03-09 14:21:01', '2025-03-12 05:04:45'),
(5, 'Charsdda', 2, 1, 45, 40, 5, 6, 8, '2025-03-09 14:25:28', '2025-03-09 14:25:28'),
(6, 'canal', 9, 1, 45, 40, 5, 6, 8, '2025-03-11 04:08:39', '2025-03-11 04:08:39'),
(7, 'canal minor', 14, 1, 45, 40, 5, 6, 8, '2025-03-13 05:19:35', '2025-03-13 05:19:35'),
(8, 'minor amankot', 15, 1, 45, 45, 28, 3, 8, '2025-03-14 00:54:22', '2025-03-14 00:54:22'),
(9, 'tangi canal', 17, 1, 45, 40, 8, 6, 3, '2025-03-14 03:59:22', '2025-03-14 03:59:22'),
(10, 'Minor Peshawar', 18, 1, 2, 3, 3, 32, 32, '2025-03-18 03:21:17', '2025-03-18 03:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `outlet_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `canal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED DEFAULT NULL,
  `minor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `distrib_id` bigint(20) UNSIGNED DEFAULT NULL,
  `beneficiaries` int(11) DEFAULT NULL,
  `total_no_discharge_cusic` int(11) DEFAULT NULL,
  `total_no_cca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `outlet_name`, `canal_id`, `created_at`, `updated_at`, `div_id`, `minor_id`, `distrib_id`, `beneficiaries`, `total_no_discharge_cusic`, `total_no_cca`) VALUES
(1, 'peshawar', 2, '2024-12-19 02:54:46', '2024-12-19 02:54:46', NULL, NULL, 1, NULL, NULL, NULL),
(2, 'peshawar', 2, '2024-12-20 04:34:17', '2024-12-20 04:34:17', NULL, NULL, 1, NULL, NULL, NULL),
(3, 'swta', 1, '2024-12-20 04:36:39', '2024-12-20 04:36:39', NULL, NULL, 1, NULL, NULL, NULL),
(4, 'Khan', 3, '2025-01-14 04:26:58', '2025-01-14 04:26:58', NULL, NULL, 1, NULL, NULL, NULL),
(5, 'Outlet-1', 4, '2025-01-20 03:03:51', '2025-01-20 03:03:51', NULL, NULL, 1, NULL, NULL, NULL),
(6, 'Outlet-01', 5, '2025-01-20 03:04:05', '2025-01-20 03:04:05', NULL, NULL, 1, NULL, NULL, NULL),
(7, 'peshawar', 2, '2025-03-10 02:55:21', '2025-03-10 02:55:21', 1, 2, 1, 88, 8, 6),
(8, 'peshawar', 1, '2025-03-10 03:04:16', '2025-03-10 03:04:16', 1, 4, 1, 88, 9, 6),
(9, 'peshawar', 9, '2025-03-11 04:44:19', '2025-03-11 04:44:19', 1, 6, 3, 777, 3, 6),
(10, 'peshawar', 14, '2025-03-14 00:56:01', '2025-03-14 00:56:01', 1, 7, 5, 0, 8, 6),
(11, 'tangi outlet', 17, '2025-03-14 04:05:16', '2025-03-14 04:05:16', 1, 9, 6, 33, 8, 6),
(12, 'Outlet Peshawar', 18, '2025-03-18 03:25:48', '2025-03-18 03:25:48', 1, 10, 7, 32, 32, 2);

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
-- Table structure for table `patwari`
--

CREATE TABLE `patwari` (
  `patwari_id` bigint(20) UNSIGNED NOT NULL,
  `patwari_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patwari_cnic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `halqa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'delete', '2024-11-09 11:32:10', '2024-11-09 11:32:10'),
(2, 'Add User', '2024-11-09 11:43:38', '2024-11-09 11:43:38'),
(3, 'Edit User', '2024-11-09 11:43:53', '2024-11-09 11:43:53'),
(4, 'Delete User', '2024-11-09 11:44:03', '2024-11-09 11:44:03'),
(5, 'Add Demand Statement', '2024-11-09 11:44:38', '2024-11-09 11:44:38'),
(6, 'Edit Demand Statement', '2024-11-09 11:45:13', '2024-11-09 11:45:13'),
(7, 'update', '2024-11-12 11:20:16', '2024-11-12 11:20:16'),
(8, 'uzair', '2024-11-25 05:17:20', '2024-11-25 05:17:20'),
(9, 'Charsdda', '2025-02-22 12:34:29', '2025-02-22 12:34:29');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'YourAppName', '60482d9551a01bfc2446c4e7b86dd66ef916570850696be618c15537425438ac', '[\"*\"]', NULL, NULL, '2024-11-05 11:28:02', '2024-11-05 11:28:02'),
(2, 'App\\Models\\User', 1, 'YourAppName', 'e22a777508bf02df984757c1849bdf77e27457aae64ea8cb608c1f5bef9754db', '[\"*\"]', NULL, NULL, '2024-11-05 11:36:21', '2024-11-05 11:36:21'),
(3, 'App\\Models\\User', 1, 'YourAppName', '13c5b2d96cd52f062ab22b8c87de17683c1d3ed39ffacf5e0058a33ef40ccaa9', '[\"*\"]', NULL, NULL, '2024-11-05 11:36:23', '2024-11-05 11:36:23'),
(4, 'App\\Models\\User', 1, 'YourAppName', '43d39dad30a1a374b559335a7f9b6a71ccb1904aeb91f3671c8446e2355613d8', '[\"*\"]', NULL, NULL, '2024-11-07 00:48:50', '2024-11-07 00:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servey_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-11-09 11:39:08', '2024-11-09 11:39:08'),
(12, 'Patwari', '2024-11-19 05:08:18', '2024-11-19 05:08:18'),
(15, 'Zilladar', '2025-01-08 06:26:00', '2025-01-08 06:26:00'),
(16, 'Deputy Collector', '2025-01-08 06:27:07', '2025-01-08 06:27:07'),
(17, 'XEN', '2025-01-08 06:27:50', '2025-01-08 06:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `tehsils`
--

CREATE TABLE `tehsils` (
  `tehsil_id` bigint(20) UNSIGNED NOT NULL,
  `tehsil_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tehsils`
--

INSERT INTO `tehsils` (`tehsil_id`, `tehsil_name`, `district_id`, `created_at`, `updated_at`) VALUES
(1, 'Peshawar Saddar', 7, '2024-12-15 07:53:42', '2024-12-15 07:53:42'),
(2, 'Shah Alam', 7, '2024-12-15 07:54:22', '2024-12-15 07:54:22'),
(3, 'Mattani', 7, '2024-12-15 07:54:50', '2024-12-15 07:54:50'),
(4, 'Charsadda', 1, '2024-12-15 07:55:27', '2024-12-15 07:55:27'),
(5, 'shabqadar', 1, '2024-12-15 07:58:38', '2024-12-15 07:58:38'),
(6, 'tangi', 7, '2024-12-15 07:58:53', '2024-12-15 07:58:53'),
(7, 'Nowshera', 2, '2024-12-15 07:59:27', '2024-12-15 07:59:27'),
(8, 'Pabbi', 2, '2024-12-15 07:59:54', '2024-12-15 07:59:54'),
(9, 'Jehangira', 2, '2024-12-15 08:00:11', '2024-12-15 08:00:11'),
(10, 'Bara', 4, '2024-12-15 08:00:47', '2024-12-15 08:00:47'),
(11, 'Jamrud', 4, '2024-12-15 08:01:10', '2024-12-15 08:01:10'),
(12, 'Landi Kotal', 4, '2024-12-15 08:01:35', '2024-12-15 08:01:35'),
(13, 'Mulagori', 4, '2024-12-15 08:01:53', '2024-12-15 08:01:53'),
(14, 'Mohmand', 3, '2024-12-15 08:04:01', '2024-12-15 08:04:01'),
(15, 'Ekkaghund', 3, '2024-12-15 08:05:27', '2024-12-15 08:05:27'),
(16, 'Haleemza', 3, '2024-12-15 08:05:53', '2024-12-15 08:05:53'),
(17, 'Baizai', 3, '2024-12-15 08:06:22', '2024-12-15 08:06:22'),
(18, 'Safi Pindiali', 3, '2024-12-15 08:06:38', '2024-12-15 08:06:38'),
(19, 'chota lohor', 5, '2024-12-18 00:25:16', '2024-12-18 00:25:16'),
(20, 'bb', 5, '2025-02-22 01:37:56', '2025-02-22 01:37:56'),
(21, 'mardan tehsil', 6, '2025-03-14 03:11:03', '2025-03-14 03:11:03'),
(22, 'tangii', 1, '2025-03-14 03:54:03', '2025-03-14 03:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `halqa_id` bigint(20) UNSIGNED DEFAULT 0,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `halqa_id`, `role_id`, `phone_number`) VALUES
(1, 'Patwari', 'patwari@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2024-12-15 08:48:27', '2024-12-15 08:48:27', 7, 12, '95468998'),
(12, 'Admin', 'admin@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2024-12-17 04:09:58', '2024-12-17 04:09:58', 0, 1, '03171443929'),
(18, 'Zilladar', 'zilladar@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2025-01-08 13:08:21', '2025-01-08 13:08:21', 7, 15, '03339163563'),
(20, 'Deputy Collector', 'collector@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2025-01-13 11:39:55', '2025-01-13 11:39:55', 7, 16, '12345'),
(21, 'XEN', 'xen@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2025-01-13 13:24:27', '2025-01-13 13:24:27', 7, 17, '234123'),
(29, 'saqibPatwari', 'saqibpatwari@gmail.com', NULL, '$2y$10$vyBz9heLyrphK0hgbSwY1O3izU8Bplovs0srH.lNDmV98t62RiHfa', NULL, '2025-03-13 03:38:41', '2025-03-13 03:38:41', 10, 12, '88888'),
(30, 'abspatwari', 'abs@gmail.com', NULL, '$2y$10$xoAQcodmyzY1Djerh4nuQem38cLw13YZnPWakvaELnMkaANkZmeym', NULL, '2025-03-13 05:23:17', '2025-03-13 05:23:17', 25, 12, '88888'),
(32, 'test xen', 'testxen@email.com', NULL, '$2y$10$fQJI3LhpnCeaBnSESFpASOp6Zo7UW3yJS5bC7DStj7Cnu1XQO3.vW', NULL, '2025-03-17 02:41:29', '2025-03-17 02:41:29', NULL, 17, '88888'),
(33, 'testxen', 'textxen@email.com', NULL, '$2y$10$OqPxlqWdeLKh/u69L.XWc..KUOK.Fb1YHR1f6uKWrJ/Nl0sqmS91y', NULL, '2025-03-17 03:01:52', '2025-03-17 03:01:52', 0, 17, '8888888'),
(34, 'collector', 'collector123@email.com', NULL, '$2y$10$tZhswqrpDRVofWn7WnIQbu61OM/N4GzfIXe0/0Sy0qBhoR/S0XGpC', NULL, '2025-03-17 03:21:05', '2025-03-17 03:21:05', NULL, 16, '8888899');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `halqa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `village_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tehsil_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`village_id`, `halqa_id`, `village_name`, `tehsil_id`, `created_at`, `updated_at`) VALUES
(1, 6, 'Palosai', 1, '2024-12-15 08:39:35', '2024-12-15 08:39:35'),
(2, 6, 'Mathra', 1, '2024-12-15 08:40:51', '2024-12-15 08:40:51'),
(3, 6, 'Shaikh Mohamm', 1, '2024-12-15 08:41:16', '2024-12-15 08:41:16'),
(4, 6, 'Charsadda Road Area Villages', 1, '2024-12-15 08:41:49', '2024-12-15 08:41:49'),
(5, 6, 'Warsak Road Villages', 1, '2024-12-15 08:42:08', '2024-12-15 08:42:08'),
(6, 5, 'Shah Alam', 2, '2024-12-15 08:43:40', '2024-12-15 08:43:40'),
(7, 5, 'Jhagra', 2, '2024-12-15 08:44:02', '2024-12-15 08:44:02'),
(8, 5, 'Dalazak', 2, '2024-12-15 08:44:16', '2024-12-15 08:44:16'),
(9, 5, 'Khalisa Payan', 2, '2024-12-15 08:44:34', '2024-12-15 08:44:34'),
(10, 4, 'Mattani', 3, '2024-12-15 08:45:47', '2024-12-15 08:45:47'),
(11, 4, 'Adezai', 3, '2024-12-15 08:46:04', '2024-12-15 08:46:04'),
(12, 4, 'Surizai', 3, '2024-12-15 08:46:21', '2024-12-15 08:46:21'),
(13, 4, 'Musaza', 3, '2024-12-15 08:46:36', '2024-12-15 08:46:36'),
(14, 7, 'kangra', 4, '2024-12-15 08:51:14', '2024-12-15 08:51:14'),
(15, 7, 'mazara', 5, '2024-12-15 08:51:36', '2024-12-15 08:51:36'),
(16, 7, 'hajai zai', 5, '2024-12-15 08:52:11', '2024-12-15 08:52:11'),
(17, 21, 'Gulberg', 1, '2024-12-16 03:24:53', '2024-12-16 03:24:53'),
(18, 21, 'University Road', 1, '2024-12-16 03:25:10', '2024-12-16 03:25:10'),
(19, 23, 'chota lahor', 19, '2024-12-18 00:26:45', '2024-12-18 00:26:45'),
(20, 24, 'durshal', 19, '2024-12-19 04:46:00', '2024-12-19 04:46:00'),
(21, 10, 'Amankot', 7, '2025-03-13 03:44:46', '2025-03-13 03:44:46'),
(22, 10, 'kang', 8, '2025-03-13 05:27:04', '2025-03-13 05:27:04'),
(23, 26, 'mardan village', 21, '2025-03-14 03:12:18', '2025-03-14 03:12:18'),
(24, 27, 'tangii v', 22, '2025-03-14 03:55:23', '2025-03-14 03:55:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_roles`
--
ALTER TABLE `assign_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_roles_role_id_foreign` (`role_id`),
  ADD KEY `assign_roles_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `canals`
--
ALTER TABLE `canals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cropprices`
--
ALTER TABLE `cropprices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cropsurveys`
--
ALTER TABLE `cropsurveys`
  ADD PRIMARY KEY (`crop_survey_id`);

--
-- Indexes for table `distributaries`
--
ALTER TABLE `distributaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `divisions_divsion_name_unique` (`divsion_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`farmer_id`);

--
-- Indexes for table `halqa`
--
ALTER TABLE `halqa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irrigators`
--
ALTER TABLE `irrigators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minorcanals`
--
ALTER TABLE `minorcanals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patwari`
--
ALTER TABLE `patwari`
  ADD PRIMARY KEY (`patwari_id`),
  ADD UNIQUE KEY `patwari_patwari_cnic_unique` (`patwari_cnic`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `tehsils`
--
ALTER TABLE `tehsils`
  ADD PRIMARY KEY (`tehsil_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`village_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_roles`
--
ALTER TABLE `assign_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `canals`
--
ALTER TABLE `canals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cropprices`
--
ALTER TABLE `cropprices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cropsurveys`
--
ALTER TABLE `cropsurveys`
  MODIFY `crop_survey_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `distributaries`
--
ALTER TABLE `distributaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `halqa`
--
ALTER TABLE `halqa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `irrigators`
--
ALTER TABLE `irrigators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `minorcanals`
--
ALTER TABLE `minorcanals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patwari`
--
ALTER TABLE `patwari`
  MODIFY `patwari_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tehsils`
--
ALTER TABLE `tehsils`
  MODIFY `tehsil_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `village_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_roles`
--
ALTER TABLE `assign_roles`
  ADD CONSTRAINT `assign_roles_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assign_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
