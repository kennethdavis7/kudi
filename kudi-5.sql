-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2023 at 06:51 AM
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
-- Table structure for table `favorite_recipes`
--

CREATE TABLE `favorite_recipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recipe_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_recipes`
--

INSERT INTO `favorite_recipes` (`id`, `recipe_id`, `user_id`, `created_at`, `updated_at`) VALUES
(54, 2, 4, '2023-08-26 10:30:50', '2023-08-26 10:30:50'),
(109, 5, 7, '2023-08-30 16:58:46', '2023-08-30 16:58:46'),
(110, 1, 3, '2023-09-06 04:32:19', '2023-09-06 04:32:19'),
(111, 5, 3, '2023-09-06 04:32:21', '2023-09-06 04:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_histories`
--

CREATE TABLE `ingredient_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_variants_id` bigint(20) UNSIGNED NOT NULL,
  `qty_change` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_types`
--

CREATE TABLE `ingredient_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient_types`
--

INSERT INTO `ingredient_types` (`id`, `type`, `created_at`, `updated_at`, `unit_category_id`) VALUES
(1, 'Telur', '2023-08-24 01:11:24', '2023-08-24 01:11:24', 5),
(3, 'Cabe', '2023-08-24 04:45:31', '2023-08-24 04:45:31', 1),
(4, 'Wortel', '2023-08-25 01:10:45', '2023-08-25 01:10:45', 1),
(5, 'Kol', '2023-08-25 01:11:47', '2023-08-25 01:11:47', 1),
(74, 'Kangkung', '2023-08-30 15:17:48', '2023-08-30 15:17:48', 1),
(76, 'Garam', '2023-08-30 15:23:57', '2023-08-30 15:23:57', 2),
(77, 'Gula', '2023-08-30 15:30:33', '2023-08-30 15:30:33', 2),
(78, 'Kaldu Jamur', '2023-08-30 15:30:55', '2023-08-30 15:30:55', 1),
(79, 'Terasi', '2023-08-30 15:33:04', '2023-08-30 15:33:04', 5),
(80, 'Bawang Putih', '2023-08-30 15:56:32', '2023-08-30 15:56:32', 1),
(81, 'Minyak', '2023-09-06 10:18:35', '2023-09-06 10:18:35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_variants`
--

CREATE TABLE `ingredient_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_types_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `initial_qty` int(11) NOT NULL,
  `current_qty` int(11) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient_variants`
--

INSERT INTO `ingredient_variants` (`id`, `ingredient_types_id`, `user_id`, `initial_qty`, `current_qty`, `buy_price`, `created_at`, `updated_at`, `unit_id`) VALUES
(149, 79, 7, 6, 0, 500, '2023-08-30 15:49:37', '2023-09-06 10:32:34', 8),
(153, 76, 7, 3, 0, 500, '2023-08-30 15:51:59', '2023-08-30 16:49:11', 4),
(154, 77, 7, 3, 0, 500, '2023-08-30 15:52:24', '2023-09-06 10:32:50', 4),
(155, 78, 7, 3, 0, 500, '2023-08-30 15:56:26', '2023-09-06 10:32:50', 1),
(156, 80, 7, 30, 0, 1000, '2023-08-30 15:57:17', '2023-08-30 16:49:11', 2),
(160, 3, 7, 3, 0, 5000, '2023-08-30 16:12:46', '2023-08-30 16:49:11', 2),
(162, 3, 3, 3, 0, 15000, '2023-09-06 04:33:13', '2023-09-06 04:33:22', 2),
(164, 80, 3, 1, 1, 1000, '2023-09-06 07:45:07', '2023-09-06 07:45:07', 2),
(166, 81, 7, 1, 1, 1000, '2023-09-06 10:43:48', '2023-09-06 10:43:48', 4),
(167, 81, 8, 1, 1, 10000, '2023-09-07 08:48:58', '2023-09-07 08:51:27', 5),
(168, 2, 3, 3, 0, 3000, '2023-09-08 05:21:53', '2023-09-08 05:21:59', 3),
(169, 3, 3, 10, 10, 1000, '2023-09-09 03:31:50', '2023-09-09 03:31:50', 3),
(170, 80, 3, 10, 10, 1000, '2023-09-09 03:33:06', '2023-09-09 03:33:06', 2);

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
(20, '2023_08_28_093132_add_unit_id_to_ingredient_variants', 4),
(21, '2023_08_28_105351_create_monthly_budgets_table', 5),
(22, '2023_08_28_144320_add_unit_id_to_recipe_ingredients', 5);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_budgets`
--

CREATE TABLE `monthly_budgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `budget` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthly_budgets`
--

INSERT INTO `monthly_budgets` (`id`, `user_id`, `budget`, `created_at`, `updated_at`) VALUES
(1, 3, 500000, '2023-08-28 04:51:14', '2023-09-06 10:52:13'),
(2, 7, 500000, '2023-08-30 15:42:48', '2023-08-30 15:43:40'),
(3, 8, 10000000, '2023-09-07 08:47:00', '2023-09-07 08:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recipe_name` varchar(255) NOT NULL,
  `recipe_img` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `procedure` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `recipe_name`, `recipe_img`, `user_id`, `procedure`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Nasi Goreng', 'https://hips.hearstapps.com/hmg-prod/images/delish-230313-12-fried-rice-0842-eb-index-64220e8a7fc9a.jpg?crop=0.888888888888889xw:1xh;center,top&resize=1200:*', 3, 'sdkabdfjkna', '2023-08-25 00:59:14', '2023-08-25 00:59:14', 'Resep ini merupakan nasi goreng oriental yang tidak diberi tambahan kecap. Warnanya putih kekuningan dengan campuran ayam charsiun, udang dan juga telur ayam.\r\n'),
(5, 'Kangkung Terasi', 'https://img-global.cpcdn.com/recipes/3b3b149317155aa1/1200x630cq70/photo.jpg', 1, '', '2023-08-30 15:52:04', '2023-08-30 15:52:04', 'Kangkung yang segar dan renyah dimasak dengan sempurna dalam campuran terasi yang kaya akan aroma dan cita rasa. Terasi memberikan dimensi tambahan pada hidangan ini, memberikan sentuhan gurih yang khas dan mengundang selera. Proses memasak yang cepat dan mudah membuat hidangan ini menjadi pilihan favorit untuk hidangan sehari-hari yang enak dan bergizi.');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recipe_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_types_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `ingredient_types_id`, `qty`, `created_at`, `updated_at`, `unit_id`) VALUES
(1, 1, 1, 2, '2023-08-25 01:18:33', '2023-08-25 01:18:33', 8),
(2, 1, 3, 3, '2023-08-25 01:19:30', '2023-08-25 01:19:30', 3),
(3, 2, 2, 3, '2023-08-25 01:20:55', '2023-08-25 01:20:55', 3),
(4, 3, 1, 2, '2023-08-25 01:21:35', '2023-08-25 01:21:35', 3),
(5, 3, 4, 5, '2023-08-25 01:22:08', '2023-08-25 01:22:08', 3),
(6, 1, 73, 100, '2023-08-29 07:24:18', '2023-08-29 07:24:18', 5),
(7, 5, 74, 3, '2023-08-30 16:03:39', '2023-08-30 16:03:39', 6),
(8, 5, 3, 3, '2023-08-30 16:04:04', '2023-08-30 16:04:04', 2),
(9, 5, 81, 30, '2023-08-30 16:04:32', '2023-08-30 16:04:32', 4),
(10, 5, 76, 3, '2023-08-30 16:05:04', '2023-08-30 16:05:04', 4),
(11, 5, 77, 1, '2023-08-30 16:05:23', '2023-08-30 16:05:23', 4),
(12, 5, 78, 1, '2023-08-30 16:06:27', '2023-08-30 16:06:27', 4),
(13, 5, 80, 30, '2023-08-30 16:07:02', '2023-08-30 16:07:02', 2),
(14, 5, 79, 3, '2023-08-30 16:07:29', '2023-08-30 16:07:29', 8);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_category_id` bigint(20) UNSIGNED NOT NULL,
  `abbreviation` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `unit_category_id`, `abbreviation`, `value`, `created_at`, `updated_at`) VALUES
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

CREATE TABLE `unit_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Halim Bajragin Simbolon S.Kom', 'iirawan@example.com', '2023-08-23 18:10:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'UOs0Nl7K5T', '2023-08-23 18:10:25', '2023-08-23 18:10:25'),
(2, 'Tasdik Winarno S.Ked', 'patricia61@example.com', '2023-08-23 18:10:25', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 't0i5EKWe8U', '2023-08-23 18:10:25', '2023-08-23 18:10:25'),
(3, 'Kenneth', 'kenneth@gmail.com', NULL, '$2y$10$YqaG.parRwq36n8HEy8cjeGtkJQlQqir.lQuW2/MfZu8WbUR2MSOC', 0, NULL, '2023-08-23 18:13:08', '2023-08-23 18:13:08'),
(4, 'joseph', 'joseph@gmail.com', NULL, '$2y$10$WUM2hPnNBbga5frpkMeHXukzCvm5hVxRO1wzYWoCZrNHx18JCSF7S', 0, NULL, '2023-08-26 04:15:10', '2023-08-26 04:15:10'),
(7, 'Alisa', 'alisa@gmail.com', NULL, '$2y$10$kEdtApOdOsPnfWaWPI6dO.BJ1bsN/9MpnZlepOXZTo61w3vm.eEZq', 0, NULL, '2023-08-30 15:40:47', '2023-08-30 15:40:47'),
(8, 'Mario', 'mariobenedict77@gmail.com', NULL, '$2y$10$Wq70hIUda7lRpXXx46fA/.YJNZDYo.65apv1e72y/CvNyzLrHX4b.', 0, NULL, '2023-09-07 08:45:52', '2023-09-07 08:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_ingredients`
--

CREATE TABLE `user_ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_types_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_ingredients`
--

INSERT INTO `user_ingredients` (`id`, `user_id`, `ingredient_types_id`, `created_at`, `updated_at`) VALUES
(29, 4, 2, '2023-08-27 12:27:30', '2023-08-27 12:27:30'),
(74, 3, 80, '2023-09-06 07:45:07', '2023-09-06 07:45:07'),
(75, 7, 81, '2023-09-06 10:43:48', '2023-09-06 10:43:48'),
(76, 8, 81, '2023-09-07 08:48:58', '2023-09-07 08:48:58'),
(77, 3, 2, '2023-09-08 05:21:53', '2023-09-08 05:21:53'),
(78, 3, 3, '2023-09-09 03:31:50', '2023-09-09 03:31:50');

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
-- Indexes for table `favorite_recipes`
--
ALTER TABLE `favorite_recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_histories`
--
ALTER TABLE `ingredient_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_types`
--
ALTER TABLE `ingredient_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_variants`
--
ALTER TABLE `ingredient_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_budgets`
--
ALTER TABLE `monthly_budgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_categories`
--
ALTER TABLE `unit_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_ingredients`
--
ALTER TABLE `user_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite_recipes`
--
ALTER TABLE `favorite_recipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `ingredient_histories`
--
ALTER TABLE `ingredient_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredient_types`
--
ALTER TABLE `ingredient_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `ingredient_variants`
--
ALTER TABLE `ingredient_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `monthly_budgets`
--
ALTER TABLE `monthly_budgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `unit_categories`
--
ALTER TABLE `unit_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_ingredients`
--
ALTER TABLE `user_ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
