-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 28, 2023 at 05:15 AM
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
-- Database: `kudi`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_recipes`
--

CREATE TABLE IF NOT EXISTS `favorite_recipes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_recipes`
--

INSERT INTO `favorite_recipes` (`id`, `recipe_id`, `user_id`, `created_at`, `updated_at`) VALUES
(54, 2, 4, '2023-08-26 10:30:50', '2023-08-26 10:30:50'),
(87, 3, 3, '2023-08-27 12:53:25', '2023-08-27 12:53:25'),
(90, 2, 3, '2023-08-28 01:26:24', '2023-08-28 01:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_histories`
--

CREATE TABLE IF NOT EXISTS `ingredient_histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ingredient_variants_id` bigint(20) UNSIGNED NOT NULL,
  `qty_change` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_types`
--

CREATE TABLE IF NOT EXISTS `ingredient_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_category_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient_types`
--

INSERT INTO `ingredient_types` (`id`, `type`, `created_at`, `updated_at`, `unit_category_id`) VALUES
(1, 'Eggs', '2023-08-24 01:11:24', '2023-08-24 01:11:24', 5),
(2, 'Potatoes', '2023-08-24 01:11:52', '2023-08-24 01:11:52', 1),
(3, 'Chilli', '2023-08-24 04:45:31', '2023-08-24 04:45:31', 1),
(4, 'Carrot', '2023-08-25 01:10:45', '2023-08-25 01:10:45', 1),
(5, 'Cabbage', '2023-08-25 01:11:47', '2023-08-25 01:11:47', 1),
(73, 'Oil\r\n', '2023-08-28 01:01:20', '2023-08-28 01:01:20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_variants`
--

CREATE TABLE IF NOT EXISTS `ingredient_variants` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ingredient_types_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `initial_qty` int(11) NOT NULL,
  `current_qty` int(11) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient_variants`
--

INSERT INTO `ingredient_variants` (`id`, `ingredient_types_id`, `user_id`, `initial_qty`, `current_qty`, `buy_price`, `created_at`, `updated_at`, `unit_id`) VALUES
(69, 1, 3, 1, 1, 1000, '2023-08-27 10:55:38', '2023-08-27 10:55:38', 1),
(72, 2, 4, 3, 2, 1000, '2023-08-27 12:27:52', '2023-08-27 12:27:58', 1),
(73, 2, 3, 10, 1, 1000, '2023-08-27 13:23:45', '2023-08-28 01:30:21', 1),
(74, 3, 3, 10, 10, 1000, '2023-08-28 01:25:54', '2023-08-28 01:25:54', 1),
(75, 1, 3, 1, 1, 2000, '2023-08-28 01:28:47', '2023-08-28 01:28:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_08_18_032811_create_months_table', 1),
(8, '2023_08_22_004417_create_ingredient_histories_table', 1),
(9, '2023_08_22_004625_create_ingredient_types_table', 1),
(10, '2023_08_22_004712_create_ingredient_variants_table', 1),
(13, '2023_08_13_083538_create_recipes_table', 2),
(14, '2023_08_22_073001_create_user_ingredients_table', 2),
(15, '2023_08_24_213906_create_recipe_ingredients_table', 2),
(16, '2023_08_13_084627_create_favorites_table', 3),
(17, '2023_08_28_071914_create_unit_categories_table', 4),
(18, '2023_08_28_072045_create_units_table', 4),
(19, '2023_08_28_074319_add_unit_category_id_to_ingredient_types', 4),
(20, '2023_08_28_093132_add_unit_id_to_ingredient_variants', 4);

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE IF NOT EXISTS `months` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `month`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipe_name` varchar(255) NOT NULL,
  `recipe_img` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `procedure` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `recipe_name`, `recipe_img`, `user_id`, `procedure`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Fried rice', 'https://hips.hearstapps.com/hmg-prod/images/delish-230313-12-fried-rice-0842-eb-index-64220e8a7fc9a.jpg?crop=0.888888888888889xw:1xh;center,top&resize=1200:*', 3, 'sdkabdfjkna', '2023-08-25 00:59:14', '2023-08-25 00:59:14', ''),
(2, 'French fries', 'https://thecozycook.com/wp-content/uploads/2020/02/Copycat-McDonalds-French-Fries-.jpg', 3, 'lsanfld', '2023-08-25 01:16:00', '2023-08-25 01:16:00', ''),
(3, 'Fried Carrots', 'https://img.buzzfeed.com/thumbnailer-prod-us-east-1/4e75ca6343e841149a8268e2dccfd15b/BFV_15257_VeggieFries4Ways-FB1080SQ.jpg', 3, 'dlalksfnk', '2023-08-25 01:17:03', '2023-08-25 01:17:03', '');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE IF NOT EXISTS `recipe_ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_types_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `ingredient_types_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '2023-08-25 01:18:33', '2023-08-25 01:18:33'),
(2, 1, 3, 3, '2023-08-25 01:19:30', '2023-08-25 01:19:30'),
(3, 2, 2, 3, '2023-08-25 01:20:55', '2023-08-25 01:20:55'),
(4, 3, 1, 2, '2023-08-25 01:21:35', '2023-08-25 01:21:35'),
(5, 3, 4, 4, '2023-08-25 01:22:08', '2023-08-25 01:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `unit_category_id` bigint(20) UNSIGNED NOT NULL,
  `abbrevation` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `unit_category_id`, `abbrevation`, `value`, `created_at`, `updated_at`) VALUES
(1, 'milligram', 1, 'mg', 1, '2023-08-28 00:31:45', '2023-08-28 00:31:45'),
(2, 'gram', 1, 'g', 1000, '2023-08-28 00:33:48', '2023-08-28 00:33:48'),
(3, 'kilogram', 1, 'kg', 1000000, '2023-08-28 00:34:51', '2023-08-28 00:34:51'),
(4, 'millilitre', 2, 'mL', 1, '2023-08-28 00:37:02', '2023-08-28 00:37:02'),
(5, 'litre', 2, 'L', 1000, '2023-08-28 00:37:47', '2023-08-28 00:37:47'),
(6, 'ounce', 1, 'oz', 28349, '2023-08-28 00:38:49', '2023-08-28 00:38:49'),
(7, 'pound', 1, 'lb', 453592, '2023-08-28 00:39:22', '2023-08-28 00:39:22'),
(8, 'piece', 5, 'pcs', 1, '2023-08-28 00:53:51', '2023-08-28 00:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `unit_categories`
--

CREATE TABLE IF NOT EXISTS `unit_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_categories`
--

INSERT INTO `unit_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'weight', '2023-08-28 00:28:35', '2023-08-28 00:28:35'),
(2, 'volume', '2023-08-28 00:30:10', '2023-08-28 00:30:10'),
(3, 'length', '2023-08-28 00:30:21', '2023-08-28 00:30:21'),
(4, 'temperature', '2023-08-28 00:30:32', '2023-08-28 00:30:32'),
(5, 'piece', '2023-08-28 00:30:40', '2023-08-28 00:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Halim Bajragin Simbolon S.Kom', 'iirawan@example.com', '2023-08-23 18:10:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'UOs0Nl7K5T', '2023-08-23 18:10:25', '2023-08-23 18:10:25'),
(2, 'Tasdik Winarno S.Ked', 'patricia61@example.com', '2023-08-23 18:10:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 't0i5EKWe8U', '2023-08-23 18:10:25', '2023-08-23 18:10:25'),
(3, 'Kenneth', 'kenneth@gmail.com', NULL, '$2y$10$YqaG.parRwq36n8HEy8cjeGtkJQlQqir.lQuW2/MfZu8WbUR2MSOC', 0, NULL, '2023-08-23 18:13:08', '2023-08-23 18:13:08'),
(4, 'joseph', 'joseph@gmail.com', NULL, '$2y$10$WUM2hPnNBbga5frpkMeHXukzCvm5hVxRO1wzYWoCZrNHx18JCSF7S', 0, NULL, '2023-08-26 04:15:10', '2023-08-26 04:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_ingredients`
--

CREATE TABLE IF NOT EXISTS `user_ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_types_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_ingredients`
--

INSERT INTO `user_ingredients` (`id`, `user_id`, `ingredient_types_id`, `created_at`, `updated_at`) VALUES
(27, 3, 1, '2023-08-27 10:55:38', '2023-08-27 10:55:38'),
(29, 4, 2, '2023-08-27 12:27:30', '2023-08-27 12:27:30'),
(30, 3, 2, '2023-08-27 13:23:45', '2023-08-27 13:23:45'),
(31, 3, 3, '2023-08-28 01:25:54', '2023-08-28 01:25:54'),
(32, 3, 73, '2023-08-28 03:08:39', '2023-08-28 03:08:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
