-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 01:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `canal_name` varchar(150) NOT NULL,
  `village_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `c_type` varchar(70) NOT NULL,
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

INSERT INTO `canals` (`id`, `canal_name`, `village_id`, `created_at`, `updated_at`, `c_type`, `div_id`, `no_outlet`, `no_outlet_ls`, `no_outlet_rs`, `total_no_cca`, `total_no_discharge_cusic`) VALUES
(1, 'Lower Swat', 1, '2025-06-24 06:36:31', '2025-06-24 06:36:31', 'flow', 1, 200, 100, 100, 3300, 20000),
(2, 'Warsak Canal System', NULL, '2025-06-24 13:25:58', '2025-06-24 13:25:58', 'flow', 1, 300, 150, 150, 22222, 222);

-- --------------------------------------------------------

--
-- Table structure for table `canal_branch`
--

CREATE TABLE `canal_branch` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `canal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED DEFAULT NULL,
  `minor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `distrib_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_outlet` int(11) DEFAULT NULL,
  `no_outlet_ls` int(11) DEFAULT NULL,
  `no_outlet_rs` int(11) DEFAULT NULL,
  `total_no_cca` int(11) DEFAULT NULL,
  `total_no_discharge_cusic` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `canal_branch`
--

INSERT INTO `canal_branch` (`id`, `branch_name`, `canal_id`, `div_id`, `minor_id`, `distrib_id`, `no_outlet`, `no_outlet_ls`, `no_outlet_rs`, `total_no_cca`, `total_no_discharge_cusic`, `created_at`, `updated_at`) VALUES
(1, 'Branch 1', 1, 1, 1, 1, 11, 7, 4, 3300, 33, '2025-06-24 09:19:07', '2025-06-24 09:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `cropprices`
--

CREATE TABLE `cropprices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `final_crop` varchar(150) NOT NULL,
  `crop_type` enum('Cash Crop','Non-Cash Crop') NOT NULL DEFAULT 'Cash Crop'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cropprices`
--

INSERT INTO `cropprices` (`id`, `created_at`, `updated_at`, `final_crop`, `crop_type`) VALUES
(1, '2024-12-26 05:32:58', '2025-06-23 09:05:36', 'Maize (مکئی)', 'Non-Cash Crop'),
(2, '2024-12-26 05:33:23', '2025-06-23 09:06:30', 'Rice (چاول)', 'Non-Cash Crop'),
(4, '2025-06-23 08:55:48', '2025-06-23 08:55:48', 'Wheat (گندم)', 'Non-Cash Crop');

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_name` varchar(150) NOT NULL,
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
  `khasra_number` varchar(150) NOT NULL,
  `tenant_name` varchar(150) NOT NULL,
  `registration_date` date NOT NULL,
  `cultivators_info` text NOT NULL,
  `snowing_date` text NOT NULL,
  `land_assessment_marla` varchar(150) NOT NULL,
  `land_assessment_kanal` varchar(150) NOT NULL,
  `previous_crop` varchar(150) NOT NULL,
  `date` date DEFAULT NULL,
  `width` varchar(150) DEFAULT NULL,
  `length` varchar(150) DEFAULT NULL,
  `area_marla` int(11) DEFAULT NULL,
  `area_kanal` int(11) DEFAULT NULL,
  `double_crop_marla` varchar(150) NOT NULL,
  `double_crop_kanal` varchar(150) NOT NULL,
  `identifable_area_marla` varchar(150) NOT NULL,
  `identifable_area_kanal` varchar(150) NOT NULL,
  `irrigated_area_marla` varchar(150) NOT NULL,
  `irrigated_area_kanal` varchar(150) NOT NULL,
  `land_quality` varchar(150) NOT NULL,
  `irrigator_khata_number` varchar(150) NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `irrigator_id` bigint(20) UNSIGNED NOT NULL,
  `canal_id` bigint(20) UNSIGNED NOT NULL,
  `minor_id` bigint(20) DEFAULT NULL,
  `distri_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `crop_id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `session_date` varchar(50) DEFAULT NULL,
  `finalcrop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `crop_price` varchar(150) DEFAULT NULL,
  `is_billed` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `review` text DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cropsurveys`
--

INSERT INTO `cropsurveys` (`crop_survey_id`, `khasra_number`, `tenant_name`, `registration_date`, `cultivators_info`, `snowing_date`, `land_assessment_marla`, `land_assessment_kanal`, `previous_crop`, `date`, `width`, `length`, `area_marla`, `area_kanal`, `double_crop_marla`, `double_crop_kanal`, `identifable_area_marla`, `identifable_area_kanal`, `irrigated_area_marla`, `irrigated_area_kanal`, `land_quality`, `irrigator_khata_number`, `village_id`, `irrigator_id`, `canal_id`, `minor_id`, `distri_id`, `branch_id`, `crop_id`, `outlet_id`, `created_at`, `updated_at`, `session_date`, `finalcrop_id`, `crop_price`, `is_billed`, `review`, `status`) VALUES
(5, '1112', 'Saqib1', '2025-06-25', 'Saqib', '2025-06-26', '10', '10', 'Maize (مکئی)', '2025-06-26', '80', '0', 0, 8, '3', '30', '5', '50', '4', '40', 'N/A', '0001', 1, 1, 1, 1, 1, 1, 2, 1, '2025-06-26 04:10:42', '2025-06-27 14:24:18', '2024-25', 2, '50', 1, 'Forwarded to XEN', 3);

-- --------------------------------------------------------

--
-- Table structure for table `distributaries`
--

CREATE TABLE `distributaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
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
(1, 'Minor 1', 1, 1, 1, 10, 5, 5, 3300, 20000, '2025-06-24 06:37:55', '2025-06-24 06:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `div_id`) VALUES
(1, 'Mardan', '2025-06-24 06:34:45', '2025-06-24 06:34:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divsion_name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `divsion_name`, `created_at`, `updated_at`) VALUES
(1, 'Mardan Irrigation Division', '2025-06-24 06:34:28', '2025-06-24 06:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(150) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmer_id` bigint(20) UNSIGNED NOT NULL,
  `serial_number` varchar(150) NOT NULL,
  `registration_date` date NOT NULL,
  `assessment_number` varchar(150) NOT NULL,
  `patwari_name` varchar(150) NOT NULL,
  `owner_name` varchar(150) NOT NULL,
  `tenant_name` varchar(150) NOT NULL,
  `cultivators_info` text NOT NULL,
  `marla` int(11) DEFAULT NULL,
  `kanal` int(11) DEFAULT NULL,
  `previous_crop` varchar(150) NOT NULL,
  `snowing_date` date NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `tehsil_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `canal_id` bigint(20) UNSIGNED NOT NULL,
  `crop_id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` bigint(20) UNSIGNED NOT NULL,
  `water_outlet` varchar(150) NOT NULL,
  `plat_boundary_number` varchar(150) NOT NULL,
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
  `halqa_name` varchar(150) NOT NULL,
  `tehsil_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `halqa`
--

INSERT INTO `halqa` (`id`, `halqa_name`, `tehsil_id`, `created_at`, `updated_at`) VALUES
(1, 'Check Mardan', 1, '2025-06-30 06:00:36', '2025-06-30 06:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `irrigators`
--

CREATE TABLE `irrigators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED DEFAULT NULL,
  `canal_id` int(11) DEFAULT NULL,
  `irrigator_name` varchar(150) NOT NULL,
  `irrigator_khata_number` varchar(150) NOT NULL,
  `irrigator_f_name` varchar(100) DEFAULT NULL,
  `irrigator_mobile_number` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cnic` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `irrigators`
--

INSERT INTO `irrigators` (`id`, `village_id`, `div_id`, `canal_id`, `irrigator_name`, `irrigator_khata_number`, `irrigator_f_name`, `irrigator_mobile_number`, `created_at`, `updated_at`, `cnic`) VALUES
(1, 1, 1, 1, 'Saqib', '0001', 'M Hadi', '03339163563', '2025-06-24 10:33:07', '2025-06-24 10:33:07', '1720167797919');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(150) NOT NULL,
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
(59, '2025_03_19_093616_create_review_table', 45),
(60, '2025_03_20_044051_add_columns_to_users_table', 46),
(61, '2025_03_28_183443_add_div_id_to_irrigators_table', 47),
(62, '2025_06_05_082355_create_canal_branch_table', 48),
(63, '2025_06_19_075709_add_crop_type_to_cropprices_table', 49),
(64, '2025_06_23_192712_create_price_revenues_table', 50);

-- --------------------------------------------------------

--
-- Table structure for table `minorcanals`
--

CREATE TABLE `minorcanals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `minor_name` varchar(150) NOT NULL,
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
(1, 'Distry 1', 1, 1, 5, 3, 2, 3300, 20000, '2025-06-24 06:37:18', '2025-06-24 06:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `outlet_name` varchar(150) NOT NULL,
  `canal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `div_id` bigint(20) UNSIGNED DEFAULT NULL,
  `minor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `distrib_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `beneficiaries` int(11) DEFAULT NULL,
  `total_no_discharge_cusic` int(11) DEFAULT NULL,
  `total_no_cca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `outlet_name`, `canal_id`, `created_at`, `updated_at`, `div_id`, `minor_id`, `distrib_id`, `branch_id`, `beneficiaries`, `total_no_discharge_cusic`, `total_no_cca`) VALUES
(1, 'Branch Outlet', 1, '2025-06-24 09:41:14', '2025-06-24 09:41:14', 1, 1, 1, 1, 15, 400, 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) NOT NULL,
  `token` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patwari`
--

CREATE TABLE `patwari` (
  `patwari_id` bigint(20) UNSIGNED NOT NULL,
  `patwari_name` varchar(150) NOT NULL,
  `patwari_cnic` varchar(150) NOT NULL,
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
  `name` varchar(150) NOT NULL,
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
  `tokenable_type` varchar(150) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
-- Table structure for table `price_revenues`
--

CREATE TABLE `price_revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_type` enum('Cash Crop','Non-Cash Crop') NOT NULL,
  `flow` double(10,2) NOT NULL,
  `LIS` double(10,2) NOT NULL,
  `t_well` double(10,2) NOT NULL,
  `jhallar` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_revenues`
--

INSERT INTO `price_revenues` (`id`, `crop_type`, `flow`, `LIS`, `t_well`, `jhallar`, `created_at`, `updated_at`) VALUES
(1, 'Cash Crop', 600.00, 1200.00, 1200.00, 300.00, '2025-06-23 14:51:56', '2025-06-23 15:18:41'),
(2, 'Non-Cash Crop', 400.00, 800.00, 800.00, 200.00, '2025-06-23 14:55:19', '2025-06-25 05:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_name` varchar(150) NOT NULL,
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
  `name` varchar(150) NOT NULL,
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
  `tehsil_name` varchar(150) NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tehsils`
--

INSERT INTO `tehsils` (`tehsil_id`, `tehsil_name`, `district_id`, `created_at`, `updated_at`) VALUES
(1, 'Mardan', 1, '2025-06-24 06:35:12', '2025-06-24 06:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `div_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tehsil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `halqa_id` bigint(20) UNSIGNED DEFAULT 0,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `div_id`, `district_id`, `tehsil_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `halqa_id`, `role_id`, `phone_number`) VALUES
(1, NULL, NULL, NULL, 'Patwari', 'patwari@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2024-12-15 08:48:27', '2025-03-21 14:50:02', 7, 12, '95468998'),
(12, NULL, NULL, NULL, 'Admin', 'admin@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2024-12-17 04:09:58', '2024-12-17 04:09:58', 0, 1, '03171443929'),
(18, NULL, 1, 22, 'Zilladar', 'zilladar@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2025-01-08 13:08:21', '2025-01-08 13:08:21', 7, 15, '03339163563'),
(20, NULL, 1, NULL, 'Deputy Collector', 'collector@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2025-01-13 11:39:55', '2025-01-13 11:39:55', 7, 16, '12345'),
(21, 1, NULL, NULL, 'XEN', 'xen@gmail.com', NULL, '$2y$10$PT10r7qjSD5AquLackEBsOSJJU4tEw6oSyvonU0i6ARbsPG6A3Dl.', NULL, '2025-01-13 13:24:27', '2025-01-13 13:24:27', 7, 17, '234123'),
(34, NULL, NULL, NULL, 'collector', 'collector123@email.com', NULL, '$2y$10$tZhswqrpDRVofWn7WnIQbu61OM/N4GzfIXe0/0Sy0qBhoR/S0XGpC', NULL, '2025-03-17 03:21:05', '2025-03-17 03:21:05', NULL, 16, '8888899'),
(36, 1, 1, NULL, 'test6', 'abbastest@email.com', NULL, '$2y$10$6fLUuUitmppJ5/LovU61bOZDurrtsQqZAU7osSCJyt0DIKCvb85re', NULL, '2025-03-20 00:07:17', '2025-03-20 00:07:17', NULL, 15, '88888'),
(37, NULL, NULL, NULL, 'test4', 'mianabb@gmail.com', NULL, '$2y$10$j80ZY52psM0QztXhM9hSGeSU8gHZUIVtDz1uANBddb81Ffaruwl6e', NULL, '2025-03-20 00:41:39', '2025-03-20 00:41:39', NULL, 1, '8888888'),
(38, NULL, NULL, NULL, 'abbas', 'mianabbas@gmail.com', NULL, '$2y$10$Me0JDrEHOJQp9cFC/kEhTuFti/MOMZ2rxMN4l8ZuK1Ba4qi/Iu77.', NULL, '2025-03-20 00:44:22', '2025-03-20 00:44:22', NULL, 16, '88888'),
(40, NULL, 7, 23, 'ammar', 'ammar@gmail.com', NULL, '$2y$10$psbC9pnZBKWHTTYLmX9fUufy2o2VfOYLgVVavwyvYKBTFZO/X/SJK', NULL, '2025-03-20 04:17:48', '2025-03-20 04:17:48', 28, 12, NULL),
(41, NULL, NULL, NULL, 'shahzeb khan', 'shah.admin@gmail.com', NULL, '$2y$10$sQ7r9rKE6M9ihvIQX5OzlOiRZsQoUQu.M456H.LBJzpy7dh6/nOJ.', NULL, '2025-03-20 05:33:10', '2025-03-20 05:33:10', NULL, 1, '03333333'),
(42, NULL, 6, 21, 'patwari mardan', 'patwari.mardan@gmail.com', NULL, '$2y$10$XoecZRC.aNQffWWbvQGqAOnzxqyFXFUsgLpaikvmAO0bRdOhNIkEm', NULL, '2025-03-20 05:34:42', '2025-03-20 05:34:42', 26, 12, '033333'),
(43, NULL, 3, 14, 'shah test', 'shah.test@gmail.com', NULL, '$2y$10$2pe5Bld2wpByhKt3OcQzf.SKxwwOM5jIwgYaK2YeGeNf5N7JtMRMK', NULL, '2025-03-20 05:38:08', '2025-03-20 05:38:08', 12, 12, '03333333'),
(44, NULL, 3, NULL, 'zilladar mohmand', 'zilladar.mohmand@gmail.com', NULL, '$2y$10$DsQuv5xRT.hTYz0wqsyRS.AJ7pW8/8dFD1KZUWEU6nYXuJmodBTPi', NULL, '2025-03-20 05:41:46', '2025-03-20 05:41:46', NULL, 15, '0333333');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `halqa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `village_name` varchar(150) NOT NULL,
  `tehsil_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`village_id`, `halqa_id`, `village_name`, `tehsil_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dagai', 1, '2025-06-24 06:35:55', '2025-06-24 06:35:55');

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
-- Indexes for table `canal_branch`
--
ALTER TABLE `canal_branch`
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
-- Indexes for table `price_revenues`
--
ALTER TABLE `price_revenues`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `canal_branch`
--
ALTER TABLE `canal_branch`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cropprices`
--
ALTER TABLE `cropprices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cropsurveys`
--
ALTER TABLE `cropsurveys`
  MODIFY `crop_survey_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `distributaries`
--
ALTER TABLE `distributaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `irrigators`
--
ALTER TABLE `irrigators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `minorcanals`
--
ALTER TABLE `minorcanals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `price_revenues`
--
ALTER TABLE `price_revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `tehsil_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `village_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
