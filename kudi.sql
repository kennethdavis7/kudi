-- MySQL dump 10.13  Distrib 8.4.10, for macos26.4 (arm64)
--
-- Host: localhost    Database: kudi
-- ------------------------------------------------------
-- Server version	8.4.10

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite_recipes`
--

DROP TABLE IF EXISTS `favorite_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorite_recipes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_recipes`
--

LOCK TABLES `favorite_recipes` WRITE;
/*!40000 ALTER TABLE `favorite_recipes` DISABLE KEYS */;
INSERT INTO `favorite_recipes` VALUES (54,2,4,'2023-08-26 10:30:50','2023-08-26 10:30:50'),(114,12,3,'2023-09-13 15:57:05','2023-09-13 15:57:05'),(151,22,3,'2023-10-25 03:22:24','2023-10-25 03:22:24'),(161,1,3,'2023-10-25 06:53:28','2023-10-25 06:53:28'),(163,68,15,'2026-06-26 11:00:18','2026-06-26 11:00:18'),(164,5,15,'2026-06-26 11:00:19','2026-06-26 11:00:19');
/*!40000 ALTER TABLE `favorite_recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredient_histories`
--

DROP TABLE IF EXISTS `ingredient_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredient_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ingredient_variants_id` bigint unsigned NOT NULL,
  `qty_change` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient_histories`
--

LOCK TABLES `ingredient_histories` WRITE;
/*!40000 ALTER TABLE `ingredient_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingredient_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredient_types`
--

DROP TABLE IF EXISTS `ingredient_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredient_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_category_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient_types`
--

LOCK TABLES `ingredient_types` WRITE;
/*!40000 ALTER TABLE `ingredient_types` DISABLE KEYS */;
INSERT INTO `ingredient_types` VALUES (1,'Telur','2023-08-24 01:11:24','2023-08-24 01:11:24',5),(3,'Cabe','2023-08-24 04:45:31','2023-08-24 04:45:31',1),(4,'Wortel','2023-08-25 01:10:45','2023-08-25 01:10:45',1),(5,'Kol','2023-08-25 01:11:47','2023-08-25 01:11:47',1),(74,'Kangkung','2023-08-30 15:17:48','2023-08-30 15:17:48',1),(76,'Garam','2023-08-30 15:23:57','2023-08-30 15:23:57',1),(77,'Gula','2023-08-30 15:30:33','2023-08-30 15:30:33',2),(78,'Kaldu Jamur','2023-08-30 15:30:55','2023-08-30 15:30:55',1),(79,'Terasi','2023-08-30 15:33:04','2023-08-30 15:33:04',5),(80,'Bawang Putih','2023-08-30 15:56:32','2023-08-30 15:56:32',1),(81,'Minyak','2023-09-06 10:18:35','2023-09-06 10:18:35',2),(82,'Tepung terigu',NULL,NULL,2),(83,'Ayam','2023-09-25 16:49:42','2023-09-25 16:49:42',1),(84,'Toge','2023-09-25 16:52:16','2023-09-25 16:52:16',1),(85,'Tahu','2023-09-25 16:52:55','2023-09-25 16:52:55',1),(86,'Tempe','2023-09-25 16:53:37','2023-09-25 16:53:37',1),(87,'Udang','2023-09-25 16:54:08','2023-09-25 16:54:08',1),(88,'Kacang','2023-09-25 16:54:38','2023-09-25 16:54:38',1),(89,'Jagung','2023-09-25 16:55:17','2023-09-25 16:55:17',1),(90,'Brokoli','2023-09-25 16:55:49','2023-09-25 16:55:49',1),(91,'Tomat','2023-09-25 16:56:29','2023-09-25 16:56:29',1);
/*!40000 ALTER TABLE `ingredient_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredient_variants`
--

DROP TABLE IF EXISTS `ingredient_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredient_variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ingredient_types_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `initial_qty` int NOT NULL,
  `current_qty` int NOT NULL,
  `buy_price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=379 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient_variants`
--

LOCK TABLES `ingredient_variants` WRITE;
/*!40000 ALTER TABLE `ingredient_variants` DISABLE KEYS */;
INSERT INTO `ingredient_variants` VALUES (149,79,7,6,0,500,'2023-08-30 15:49:37','2023-09-06 10:32:34'),(153,76,7,3,0,500,'2023-08-30 15:51:59','2023-08-30 16:49:11'),(154,77,7,3,0,500,'2023-08-30 15:52:24','2023-09-06 10:32:50'),(155,78,7,3,0,500,'2023-08-30 15:56:26','2023-09-06 10:32:50'),(156,80,7,30,0,1000,'2023-08-30 15:57:17','2023-08-30 16:49:11'),(160,3,7,3,0,5000,'2023-08-30 16:12:46','2023-08-30 16:49:11'),(162,3,3,3,0,15000,'2023-09-06 04:33:13','2023-09-06 04:33:22'),(167,81,8,1,1,10000,'2023-09-07 08:48:58','2023-09-07 08:51:27'),(168,2,3,3,0,3000,'2023-09-08 05:21:53','2023-09-08 05:21:59'),(169,3,3,10,0,1000,'2023-09-09 03:31:50','2023-09-14 14:29:23'),(172,1,3,5,0,10000,'2023-09-13 01:11:49','2023-09-14 14:29:23'),(176,81,7,10,10,1000,'2023-09-14 13:36:57','2023-09-14 13:36:57'),(177,3,3,100,0,1000,'2023-09-14 14:27:58','2023-09-21 07:58:11'),(180,1,3,10,0,10000,'2023-09-14 14:28:46','2023-09-21 07:58:11'),(182,3,3,10,0,10000,'2023-09-16 15:17:31','2023-09-27 05:26:07'),(190,79,3,3,0,10000,'2023-09-17 05:22:39','2023-09-17 05:22:46'),(191,79,3,3,0,10000,'2023-09-17 05:25:05','2023-09-17 05:26:17'),(195,79,3,3,0,10000,'2023-09-17 05:38:06','2023-09-17 05:39:09'),(199,76,3,100,0,1232,'2023-09-18 02:56:12','2023-09-18 02:56:26'),(200,81,3,100,0,1232,'2023-09-18 02:56:20','2023-09-18 02:56:26'),(201,76,3,100,0,20000,'2023-09-18 02:57:58','2023-09-18 02:58:20'),(202,81,3,100,0,10000,'2023-09-18 02:58:12','2023-09-18 02:58:20'),(203,76,3,30,0,10000,'2023-09-18 05:19:35','2023-09-21 07:58:11'),(204,78,3,50,14,20000,'2023-09-18 05:20:11','2023-10-25 05:49:58'),(205,81,3,100,0,2000,'2023-09-18 05:21:41','2023-09-21 07:58:11'),(206,79,3,10,0,10000,'2023-09-18 05:22:06','2023-09-28 02:01:59'),(208,74,3,300,0,50000,'2023-09-18 05:25:46','2023-09-18 05:25:54'),(209,76,3,10,0,10000,'2023-09-21 07:56:35','2023-09-21 07:58:11'),(210,1,3,10,0,10000,'2023-09-21 07:56:55','2023-09-22 04:24:42'),(211,76,3,200,0,10000,'2023-09-21 07:57:53','2023-09-24 08:49:35'),(212,81,3,1000,0,23423,'2023-09-22 04:19:59','2023-09-23 05:28:03'),(214,79,3,10,0,1000,'2023-09-22 06:19:52','2023-09-27 07:29:40'),(217,81,3,10000,0,1000,'2023-09-23 05:40:53','2023-09-24 16:59:28'),(218,81,3,100,0,10000,'2023-09-23 05:48:04','2023-09-23 05:48:12'),(219,81,3,10000,0,1000,'2023-09-23 05:55:18','2023-10-25 05:06:41'),(220,76,3,100,0,10000,'2023-09-24 16:59:19','2023-09-24 16:59:28'),(221,78,3,10000000,9999943,10000,'2023-09-25 01:48:06','2023-10-25 04:34:53'),(222,82,3,200000,198200,10000,'2023-09-25 01:48:42','2023-10-02 04:56:32'),(223,76,3,1000000000,997865,10000,'2023-09-25 01:48:53','2023-10-25 06:52:43'),(224,76,3,10,0,15882,'2023-09-25 08:06:26','2023-09-25 08:18:35'),(225,88,3,10000000,10000000,10000,'2023-09-26 02:05:19','2023-09-26 02:05:19'),(227,88,3,10,10,7000,'2023-09-27 05:14:12','2023-09-27 05:14:12'),(228,76,3,100,0,70000,'2023-09-27 05:23:33','2023-09-27 05:30:29'),(230,74,3,300000,0,7000,'2023-09-27 05:25:14','2023-09-27 05:26:07'),(231,3,3,3000,0,7000,'2023-09-27 05:25:50','2023-09-27 06:24:00'),(233,88,3,200,200,10000,'2023-09-27 06:09:47','2023-09-27 06:09:47'),(234,3,3,10000,0,20000,'2023-09-27 06:14:20','2023-09-27 07:29:40'),(235,74,3,300000,0,12000,'2023-09-27 06:14:54','2023-09-27 06:15:13'),(236,87,3,100000,100000,20000,'2023-09-27 06:22:11','2023-09-27 06:22:11'),(237,74,3,300000,0,10000,'2023-09-27 06:23:42','2023-09-27 06:24:00'),(239,74,3,300000,0,5000,'2023-09-27 07:04:41','2023-09-27 07:04:55'),(241,74,3,300000,0,10000,'2023-09-27 07:29:06','2023-09-27 07:29:40'),(242,3,3,3000,0,20000,'2023-09-27 07:29:21','2023-09-27 07:41:24'),(243,1,3,3,0,2000,'2023-09-27 07:38:34','2023-10-25 03:34:36'),(244,79,3,3,0,8355,'2023-09-27 07:40:30','2023-09-27 07:41:24'),(245,74,3,300000,0,76757,'2023-09-27 07:40:46','2023-09-27 07:41:24'),(246,3,3,3000,0,75577,'2023-09-27 07:41:01','2023-09-28 03:38:56'),(247,3,3,3000,0,20000,'2023-09-27 08:08:55','2023-09-27 08:11:05'),(248,74,3,300000,0,20000,'2023-09-27 08:10:28','2023-09-27 08:11:05'),(249,79,3,3,0,20000,'2023-09-27 08:10:40','2023-09-27 08:11:05'),(251,3,3,3000,0,28000,'2023-09-27 08:42:16','2023-09-27 08:43:09'),(252,79,3,3,0,20000,'2023-09-27 08:42:32','2023-09-28 05:01:40'),(253,79,3,3,0,20000,'2023-09-27 08:42:33','2023-09-27 08:43:09'),(254,79,3,3,0,20000,'2023-09-27 08:42:33','2023-09-28 02:20:18'),(255,74,3,300000,0,5558,'2023-09-27 08:42:45','2023-09-27 08:43:09'),(256,79,3,3,0,20000,'2023-09-27 08:56:14','2023-09-27 08:58:56'),(257,3,3,3000,0,20000,'2023-09-27 08:58:11','2023-09-27 08:58:56'),(258,74,3,300000,0,30000,'2023-09-27 08:58:25','2023-09-27 08:58:56'),(259,74,3,300000,0,30000,'2023-09-27 08:58:25','2023-09-27 09:41:21'),(260,79,3,3,0,20000,'2023-09-27 09:38:12','2023-09-27 09:41:21'),(261,3,3,3000,0,2000,'2023-09-27 09:40:53','2023-09-27 09:41:21'),(262,74,3,200000,0,20000,'2023-09-28 01:59:39','2023-09-28 02:01:59'),(264,3,3,3000,0,2000,'2023-09-28 02:01:19','2023-09-28 02:01:59'),(265,74,3,100000,0,20000,'2023-09-28 02:01:33','2023-09-28 02:01:59'),(266,74,3,300000,0,20000,'2023-09-28 02:15:56','2023-09-28 02:20:18'),(267,3,3,3000,0,20000,'2023-09-28 02:18:11','2023-09-28 02:20:18'),(268,76,3,20000,19749,2000,'2023-09-28 02:18:28','2023-10-25 06:43:49'),(270,74,3,300000,0,20000,'2023-09-28 02:40:23','2023-09-28 02:43:32'),(273,3,3,3000,0,2000,'2023-09-28 02:43:00','2023-09-28 02:43:32'),(274,79,3,3,0,20000,'2023-09-28 02:43:14','2023-09-28 03:38:56'),(275,79,3,3,0,20000,'2023-09-28 02:43:14','2023-09-28 02:43:32'),(276,79,3,3,0,20000,'2023-09-28 02:43:14','2023-09-28 02:59:35'),(277,74,3,300000,0,20000,'2023-09-28 02:57:55','2023-09-28 02:59:35'),(278,3,3,3000,0,2000,'2023-09-28 02:59:09','2023-09-28 02:59:35'),(279,74,3,300000,0,20000,'2023-09-28 03:03:03','2023-09-28 05:01:40'),(280,3,3,3000,0,20000,'2023-09-28 03:05:30','2023-09-28 05:01:40'),(282,74,3,300000,0,20000,'2023-09-28 03:37:27','2023-09-28 03:38:56'),(284,3,3,3000,0,20000,'2023-09-28 05:00:49','2023-09-28 05:29:41'),(285,79,3,3,0,3000,'2023-09-28 05:01:12','2023-09-28 05:29:41'),(286,3,3,3000,0,20000,'2023-09-28 05:27:32','2023-09-28 07:33:30'),(288,74,3,300000,0,20000,'2023-09-28 05:29:05','2023-09-28 05:29:41'),(289,79,3,1,0,20000,'2023-09-28 05:29:16','2023-09-28 05:29:41'),(290,3,3,3000,0,20000,'2023-09-28 05:43:26','2023-09-28 05:45:51'),(292,74,3,300000,0,20000,'2023-09-28 05:45:08','2023-09-28 05:45:51'),(293,79,3,3,0,2000,'2023-09-28 05:45:28','2023-09-28 05:45:51'),(294,79,3,3,0,20000,'2023-09-28 06:58:04','2023-09-28 07:00:28'),(296,3,3,3000,0,20000,'2023-09-28 06:59:48','2023-09-28 07:00:28'),(297,74,3,300000,0,2000,'2023-09-28 07:00:04','2023-09-28 07:00:28'),(299,74,3,300000,0,20000,'2023-09-28 07:31:44','2023-09-28 07:33:30'),(300,79,3,3,0,2000,'2023-09-28 07:31:59','2023-09-28 07:33:30'),(301,3,3,3000,0,2000,'2023-09-28 07:32:51','2023-10-25 01:49:39'),(302,87,3,200000,200000,2000,'2023-09-28 07:55:26','2023-09-28 07:55:26'),(304,79,3,1,0,2800,'2023-09-28 07:57:46','2023-09-28 07:59:27'),(305,74,3,300000,0,20000,'2023-09-28 07:58:01','2023-09-28 07:59:27'),(306,3,3,3000,0,3000,'2023-09-28 07:58:41','2023-09-28 07:59:27'),(307,79,3,2,0,2200,'2023-09-28 07:58:55','2023-09-28 07:59:27'),(308,90,3,10,10,1000,'2023-10-11 06:06:29','2023-10-11 06:06:29'),(309,88,3,10,10,10000,'2023-10-11 06:08:03','2023-10-11 06:08:03'),(311,83,3,55,55,544428,'2023-10-25 01:29:24','2023-10-25 01:29:24'),(312,3,3,50000,0,5447,'2023-10-25 01:46:15','2023-10-25 02:20:49'),(314,79,3,5,0,5000,'2023-10-25 01:48:45','2023-10-25 03:11:59'),(315,74,3,300000,0,50000,'2023-10-25 01:49:01','2023-10-25 01:49:39'),(317,3,3,5000000,0,58805,'2023-10-25 02:19:59','2023-10-25 03:34:36'),(318,80,3,40,0,8585,'2023-10-25 02:20:12','2023-10-25 02:38:46'),(319,81,3,400000,0,5850,'2023-10-25 02:20:38','2023-10-25 06:03:55'),(320,86,3,55,55,5858,'2023-10-25 02:23:07','2023-10-25 02:23:07'),(321,85,3,40000,40000,4000,'2023-10-25 02:36:25','2023-10-25 02:36:25'),(322,80,3,40000,22040,4000,'2023-10-25 02:37:57','2023-10-25 05:49:58'),(323,74,3,300000,0,4000,'2023-10-25 02:38:12','2023-10-25 02:38:46'),(324,79,3,3,0,40000,'2023-10-25 02:38:28','2023-10-25 02:38:46'),(325,80,3,40000,31000,40000,'2023-10-25 03:01:32','2023-10-25 04:34:53'),(326,74,3,300000,0,40000,'2023-10-25 03:03:27','2023-10-25 03:03:56'),(327,79,3,3,0,50000,'2023-10-25 03:03:41','2023-10-25 03:03:56'),(328,86,3,400000,400000,80505,'2023-10-25 03:10:01','2023-10-25 03:10:01'),(329,74,3,300000,0,40000,'2023-10-25 03:11:28','2023-10-25 03:11:59'),(330,79,3,2,0,5000,'2023-10-25 03:11:40','2023-10-25 03:16:54'),(331,79,3,3,0,40000,'2023-10-25 03:15:13','2023-10-25 05:49:58'),(332,74,3,300000,0,4000,'2023-10-25 03:16:42','2023-10-25 03:16:54'),(333,85,3,40,40,40000,'2023-10-25 03:20:16','2023-10-25 03:20:16'),(334,79,3,3,0,4000,'2023-10-25 03:21:33','2023-10-25 03:22:05'),(335,74,3,300000,0,40000,'2023-10-25 03:21:52','2023-10-25 03:22:05'),(336,90,3,50000,50000,40000,'2023-10-25 03:32:10','2023-10-25 03:32:10'),(337,3,3,5000000,0,2000,'2023-10-25 03:33:55','2023-10-25 05:06:41'),(338,1,3,5,0,20000,'2023-10-25 03:34:23','2023-10-25 05:25:59'),(339,79,3,3,0,2000,'2023-10-25 03:45:32','2023-10-25 03:45:57'),(340,74,3,300000,0,20000,'2023-10-25 03:45:47','2023-10-25 03:45:57'),(341,84,3,200000,200000,40000,'2023-10-25 04:26:40','2023-10-25 04:26:40'),(342,79,3,3,0,4000,'2023-10-25 04:27:52','2023-10-25 04:28:25'),(343,74,3,300000,0,40000,'2023-10-25 04:28:12','2023-10-25 04:28:25'),(344,88,3,200000,200000,20000,'2023-10-25 04:32:40','2023-10-25 04:32:40'),(345,79,3,3,0,40000,'2023-10-25 04:34:25','2023-10-25 04:34:53'),(346,74,3,300000,0,40000,'2023-10-25 04:34:37','2023-10-25 04:34:53'),(347,86,3,4000,4000,4000,'2023-10-25 04:40:08','2023-10-25 04:40:08'),(348,74,3,300000,0,10000,'2023-10-25 05:03:46','2023-10-25 05:49:58'),(349,3,3,3000000,0,40000,'2023-10-25 05:06:04','2023-10-25 05:06:41'),(350,3,3,2000000,0,40000,'2023-10-25 05:06:28','2023-10-25 05:25:59'),(351,84,3,200000,200000,40000,'2023-10-25 05:10:55','2023-10-25 05:10:55'),(352,80,3,400000,0,40000,'2023-10-25 05:23:51','2023-10-25 05:24:27'),(353,3,3,5000000,0,40000,'2023-10-25 05:25:49','2023-10-25 06:07:29'),(354,80,3,400000,400000,40000,'2023-10-25 05:38:19','2023-10-25 05:38:19'),(355,85,3,400000,350000,40000,'2023-10-25 05:47:33','2023-10-25 05:48:18'),(356,79,3,4,1,40000,'2023-10-25 05:49:33','2023-10-25 06:07:40'),(357,78,3,200000,199997,20000,'2023-10-25 06:01:36','2023-10-25 06:43:49'),(358,81,3,500000,307986,4000,'2023-10-25 06:03:05','2023-10-25 06:52:43'),(359,3,3,5000000,0,40000,'2023-10-25 06:03:20','2023-10-25 06:03:55'),(360,1,3,2,0,40000,'2023-10-25 06:03:47','2023-10-25 06:03:55'),(361,74,3,300000,0,20000,'2023-10-25 06:42:27','2023-10-25 06:43:49'),(362,79,3,3,0,40000,'2023-10-25 06:42:36','2023-10-25 06:43:49'),(363,80,3,5000,2000,48000,'2023-10-25 06:42:52','2023-10-25 06:43:49'),(364,3,3,40000000,34997000,40000,'2023-10-25 06:43:29','2023-10-25 06:52:43'),(365,84,3,400000,400000,40000,'2023-10-25 06:50:20','2023-10-25 06:50:20'),(366,1,3,3,1,4000,'2023-10-25 06:52:27','2023-10-25 06:52:43'),(367,85,3,200000,200000,20000,'2023-10-25 10:02:37','2023-10-25 10:02:37'),(369,87,13,1,1,1000,'2024-05-29 07:28:19','2024-05-29 07:28:19'),(372,83,14,100,100,15000,'2026-06-24 01:55:51','2026-06-24 01:55:51'),(375,87,15,1000000,0,10000,'2026-06-27 10:07:34','2026-06-27 10:18:26'),(376,85,15,10000000,0,100000,'2026-06-27 10:08:59','2026-06-27 10:44:38');
/*!40000 ALTER TABLE `ingredient_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(7,'2023_08_18_032811_create_months_table',1),(8,'2023_08_22_004417_create_ingredient_histories_table',1),(9,'2023_08_22_004625_create_ingredient_types_table',1),(10,'2023_08_22_004712_create_ingredient_variants_table',1),(14,'2023_08_22_073001_create_user_ingredients_table',2),(15,'2023_08_24_213906_create_recipe_ingredients_table',2),(16,'2023_08_13_084627_create_favorites_table',3),(17,'2023_08_28_071914_create_unit_categories_table',4),(18,'2023_08_28_072045_create_units_table',4),(19,'2023_08_28_074319_add_unit_category_id_to_ingredient_types',4),(20,'2023_08_28_093132_add_unit_id_to_ingredient_variants',4),(21,'2023_08_28_105351_create_monthly_budgets_table',5),(22,'2023_08_28_144320_add_unit_id_to_recipe_ingredients',5),(23,'2023_09_12_082232_create_recipe_steps_table',6),(24,'2023_09_13_071045_remove_procedure_column_from_recipes_table',6),(25,'2023_08_13_083538_create_recipes_table',6),(27,'2023_09_14_115818_add_status_to_recipes_table',7),(28,'2023_09_14_165341_add_image_to_users_table',8),(29,'2023_09_15_125053_add_cook_time_to_recipes_table',9),(30,'2023_09_15_000030_create_recipe_user_history_table',10),(31,'2023_09_18_105231_remove_unit_id_from_ingredient_variants',11),(32,'2023_09_24_122813_create_tag_categories_table',12),(33,'2023_09_24_122858_create_tag_recipes_table',12),(34,'2023_09_24_125850_add_color_to_tag_categories',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monthly_budgets`
--

DROP TABLE IF EXISTS `monthly_budgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `monthly_budgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `budget` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monthly_budgets`
--

LOCK TABLES `monthly_budgets` WRITE;
/*!40000 ALTER TABLE `monthly_budgets` DISABLE KEYS */;
INSERT INTO `monthly_budgets` VALUES (1,3,4000000,'2023-08-28 04:51:14','2023-10-25 06:51:36'),(2,7,500000,'2023-08-30 15:42:48','2023-08-30 15:43:40'),(3,8,10000000,'2023-09-07 08:47:00','2023-09-07 08:47:00'),(4,15,100000,'2026-06-26 10:53:56','2026-06-27 10:32:34');
/*!40000 ALTER TABLE `monthly_budgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `months`
--

DROP TABLE IF EXISTS `months`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `months` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `month` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `months`
--

LOCK TABLES `months` WRITE;
/*!40000 ALTER TABLE `months` DISABLE KEYS */;
INSERT INTO `months` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12);
/*!40000 ALTER TABLE `months` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_ingredients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint unsigned NOT NULL,
  `ingredient_types_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=412 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ingredients`
--

LOCK TABLES `recipe_ingredients` WRITE;
/*!40000 ALTER TABLE `recipe_ingredients` DISABLE KEYS */;
INSERT INTO `recipe_ingredients` VALUES (148,20,1,10,'2023-09-14 13:38:00','2023-09-14 13:38:00',8),(301,5,79,3,'2023-09-17 05:16:10','2023-09-17 05:16:10',8),(302,5,3,3,'2023-09-17 05:16:10','2023-09-17 05:16:10',2),(303,5,76,3,'2023-09-17 05:16:10','2023-09-17 05:16:10',1),(304,5,81,3,'2023-09-17 05:16:10','2023-09-17 05:16:10',4),(305,5,78,3,'2023-09-17 05:16:10','2023-09-17 05:16:10',1),(306,5,80,3,'2023-09-17 05:16:10','2023-09-17 05:16:10',2),(307,5,74,300,'2023-09-17 05:16:10','2023-09-17 05:16:10',2),(363,22,82,100,'2023-09-25 16:41:54','2023-09-25 16:41:54',4),(364,22,76,100,'2023-09-25 16:41:54','2023-09-25 16:41:54',1),(365,22,81,100,'2023-09-25 16:41:54','2023-09-25 16:41:54',4),(366,1,1,2,'2023-09-25 16:47:24','2023-09-25 16:47:24',8),(367,1,3,5,'2023-09-25 16:47:24','2023-09-25 16:47:24',3),(368,1,81,100,'2023-09-25 16:47:24','2023-09-25 16:47:24',5),(369,1,76,100,'2023-09-25 16:47:24','2023-09-25 16:47:24',1),(407,68,74,400,'2023-10-25 06:46:30','2023-10-25 06:46:30',1),(408,69,76,400,'2023-10-25 06:55:59','2023-10-25 06:55:59',1),(409,70,81,5,'2026-06-26 10:59:48','2026-06-26 10:59:48',4),(410,70,79,3,'2026-06-26 10:59:48','2026-06-26 10:59:48',8),(411,70,83,2,'2026-06-26 10:59:48','2026-06-26 10:59:48',1);
/*!40000 ALTER TABLE `recipe_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_steps`
--

DROP TABLE IF EXISTS `recipe_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_steps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipe_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_steps_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `recipe_steps_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_steps`
--

LOCK TABLES `recipe_steps` WRITE;
/*!40000 ALTER TABLE `recipe_steps` DISABLE KEYS */;
INSERT INTO `recipe_steps` VALUES (79,1,'sfasdf',20,'2023-09-14 13:38:00','2023-09-14 13:38:00'),(149,1,'Panasin minyak di kuali, masukkin terasi, diaduk sampai hancur, kemudian masukkin bawang putih',5,'2023-09-17 05:16:10','2023-09-17 05:16:10'),(150,2,'Masukkin cabe yang sudah diiris, diaduk sebentar, kemudian masukkan kangkung.',5,'2023-09-17 05:16:10','2023-09-17 05:16:10'),(151,3,'Masukkin kaldu jamur dan garam secukupnya, tumis sampai layu tunggu sekitar 3 menit',5,'2023-09-17 05:16:10','2023-09-17 05:16:10'),(152,4,'Lalu angkat kangkungnya dan siap disajikan',5,'2023-09-17 05:16:10','2023-09-17 05:16:10'),(208,1,'Cuci bersih kulit singkong iris sesuai selera.  Masak air sampai mendidih masukan kulit singkong,garam rebus sampai matang angkat tiriskan.',22,'2023-09-25 16:41:54','2023-09-25 16:41:54'),(209,2,'Siapkan wadah masukan 3 tepung aduk rata.  Masukan kulit singkong aduk sampai tercampur rata.  Panaskan minyak goreng masukan kulitnya goreng dengan api sedang aduk\"setelah masak kuning kecoklatan angkat tiriskan.',22,'2023-09-25 16:41:54','2023-09-25 16:41:54'),(210,3,'Masukan ke dalam wadah taburi, lalu keripik kulit singkong siap disajikan',22,'2023-09-25 16:41:54','2023-09-25 16:41:54'),(211,1,'Siapkan penggorengan dengan api sedang, tuang margarin atau minyak goreng.',1,'2023-09-25 16:47:24','2023-09-25 16:47:24'),(212,2,'Masukkan bawang putih dan daun bawang yang sudah dicincang halus. Tumis hingga berbau harum atau hingga warnanya keemasan.',1,'2023-09-25 16:47:24','2023-09-25 16:47:24'),(213,3,'Masukkan sosis dan 1 butir telur ayam. Tumis sebentar.',1,'2023-09-25 16:47:24','2023-09-25 16:47:24'),(214,4,'Nasi goreng biasa yang sederhana dan enak siap disajikan.',1,'2023-09-25 16:47:24','2023-09-25 16:47:24'),(252,1,'Hthy',68,'2023-10-25 06:46:30','2023-10-25 06:46:30'),(253,1,'Btb',69,'2023-10-25 06:55:59','2023-10-25 06:55:59'),(254,1,'dsafd',70,'2026-06-26 10:59:48','2026-06-26 10:59:48'),(255,2,'dfasd',70,'2026-06-26 10:59:48','2026-06-26 10:59:48'),(256,3,'dfsa',70,'2026-06-26 10:59:48','2026-06-26 10:59:48');
/*!40000 ALTER TABLE `recipe_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_user_history`
--

DROP TABLE IF EXISTS `recipe_user_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_user_history` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `recipe_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `rating` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_user_history_user_id_foreign` (`user_id`),
  KEY `recipe_user_history_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `recipe_user_history_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  CONSTRAINT `recipe_user_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_user_history`
--

LOCK TABLES `recipe_user_history` WRITE;
/*!40000 ALTER TABLE `recipe_user_history` DISABLE KEYS */;
INSERT INTO `recipe_user_history` VALUES (1,3,22,'sdafmkf',5,'2023-09-18 02:56:48','2023-09-18 02:56:58'),(2,3,22,NULL,NULL,'2023-09-18 02:58:20','2023-09-18 02:58:20'),(3,3,5,NULL,NULL,'2023-09-18 05:25:54','2023-09-18 05:25:54'),(4,3,1,NULL,NULL,'2023-09-21 07:58:11','2023-09-21 07:58:11'),(5,3,22,NULL,NULL,'2023-09-22 04:20:33','2023-09-22 04:20:33'),(6,3,22,NULL,NULL,'2023-09-22 06:20:14','2023-09-22 06:20:14'),(7,3,22,NULL,NULL,'2023-09-23 05:48:12','2023-09-23 05:48:12'),(8,3,22,NULL,NULL,'2023-09-24 08:49:35','2023-09-24 08:49:35'),(9,3,22,NULL,NULL,'2023-09-24 16:59:28','2023-09-24 16:59:28'),(10,3,22,'lsfadk',5,'2023-09-25 01:49:07','2023-09-25 01:49:52'),(11,3,22,NULL,NULL,'2023-09-25 08:18:35','2023-09-25 08:18:35'),(12,3,22,NULL,NULL,'2023-09-26 02:07:01','2023-09-26 02:07:01'),(13,3,22,NULL,NULL,'2023-09-27 05:22:09','2023-09-27 05:22:09'),(14,3,22,NULL,NULL,'2023-09-27 05:23:48','2023-09-27 05:23:48'),(15,3,5,NULL,NULL,'2023-09-27 05:26:07','2023-09-27 05:26:07'),(16,3,22,NULL,NULL,'2023-09-27 05:30:29','2023-09-27 05:30:29'),(17,3,22,NULL,NULL,'2023-09-27 06:10:55','2023-09-27 06:10:55'),(18,3,5,NULL,NULL,'2023-09-27 06:15:13','2023-09-27 06:15:13'),(19,3,22,NULL,NULL,'2023-09-27 06:22:58','2023-09-27 06:22:58'),(20,3,5,NULL,NULL,'2023-09-27 06:24:00','2023-09-27 06:24:00'),(21,3,22,NULL,NULL,'2023-09-27 07:04:07','2023-09-27 07:04:07'),(22,3,5,NULL,NULL,'2023-09-27 07:04:55','2023-09-27 07:04:55'),(23,3,22,NULL,NULL,'2023-09-27 07:28:14','2023-09-27 07:28:14'),(24,3,5,NULL,NULL,'2023-09-27 07:29:40','2023-09-27 07:29:40'),(25,3,22,NULL,NULL,'2023-09-27 07:39:41','2023-09-27 07:39:41'),(26,3,5,NULL,NULL,'2023-09-27 07:41:24','2023-09-27 07:41:24'),(27,3,22,NULL,NULL,'2023-09-27 08:09:52','2023-09-27 08:09:52'),(28,3,5,NULL,NULL,'2023-09-27 08:11:05','2023-09-27 08:11:05'),(29,3,22,NULL,NULL,'2023-09-27 08:41:29','2023-09-27 08:41:29'),(30,3,5,NULL,NULL,'2023-09-27 08:43:09','2023-09-27 08:43:09'),(31,3,22,NULL,NULL,'2023-09-27 08:57:26','2023-09-27 08:57:26'),(32,3,5,NULL,NULL,'2023-09-27 08:58:56','2023-09-27 08:58:56'),(33,3,22,NULL,NULL,'2023-09-27 09:39:22','2023-09-27 09:39:22'),(34,3,22,NULL,NULL,'2023-09-27 09:39:44','2023-09-27 09:39:44'),(35,3,5,NULL,NULL,'2023-09-27 09:41:21','2023-09-27 09:41:21'),(36,3,5,NULL,NULL,'2023-09-28 02:01:59','2023-09-28 02:01:59'),(37,3,22,NULL,NULL,'2023-09-28 02:17:24','2023-09-28 02:17:24'),(38,3,5,NULL,NULL,'2023-09-28 02:20:18','2023-09-28 02:20:18'),(39,3,5,NULL,NULL,'2023-09-28 02:43:32','2023-09-28 02:43:32'),(40,3,5,NULL,NULL,'2023-09-28 02:59:35','2023-09-28 02:59:35'),(41,3,5,NULL,NULL,'2023-09-28 03:38:56','2023-09-28 03:38:56'),(42,3,5,NULL,NULL,'2023-09-28 05:01:40','2023-09-28 05:01:40'),(43,3,5,NULL,NULL,'2023-09-28 05:29:41','2023-09-28 05:29:41'),(44,3,5,NULL,NULL,'2023-09-28 05:45:51','2023-09-28 05:45:51'),(45,3,5,NULL,NULL,'2023-09-28 07:00:28','2023-09-28 07:00:28'),(46,3,5,NULL,NULL,'2023-09-28 07:33:30','2023-09-28 07:33:30'),(47,3,5,'sdknfja',4,'2023-09-28 07:59:27','2023-10-11 06:35:40'),(48,3,22,NULL,NULL,'2023-10-02 04:56:32','2023-10-02 04:56:32'),(49,3,5,NULL,NULL,'2023-10-25 01:49:39','2023-10-25 01:49:39'),(50,3,1,NULL,NULL,'2023-10-25 02:20:49','2023-10-25 02:20:49'),(51,3,5,NULL,NULL,'2023-10-25 02:38:46','2023-10-25 02:38:46'),(52,3,5,NULL,NULL,'2023-10-25 03:03:56','2023-10-25 03:03:56'),(53,3,5,NULL,NULL,'2023-10-25 03:11:59','2023-10-25 03:11:59'),(54,3,5,NULL,NULL,'2023-10-25 03:16:54','2023-10-25 03:16:54'),(55,3,5,NULL,NULL,'2023-10-25 03:22:05','2023-10-25 03:22:05'),(56,3,1,NULL,NULL,'2023-10-25 03:34:36','2023-10-25 03:34:36'),(57,3,5,NULL,NULL,'2023-10-25 03:45:57','2023-10-25 03:45:57'),(58,3,5,NULL,NULL,'2023-10-25 04:28:25','2023-10-25 04:28:25'),(59,3,5,NULL,NULL,'2023-10-25 04:34:53','2023-10-25 04:34:53'),(60,3,1,NULL,NULL,'2023-10-25 05:06:41','2023-10-25 05:06:41'),(61,3,1,NULL,NULL,'2023-10-25 05:25:59','2023-10-25 05:25:59'),(62,3,5,NULL,NULL,'2023-10-25 05:49:58','2023-10-25 05:49:58'),(63,3,1,NULL,NULL,'2023-10-25 06:03:55','2023-10-25 06:03:55'),(64,3,5,NULL,NULL,'2023-10-25 06:43:49','2023-10-25 06:43:49'),(65,3,1,NULL,NULL,'2023-10-25 06:52:43','2023-10-25 06:52:43'),(66,15,68,'jbj',4,'2026-06-27 10:30:34','2026-06-27 10:45:30');
/*!40000 ALTER TABLE `recipe_user_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recipe_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipe_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL,
  `cook_time` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (1,'Nasi Goreng','public/images/recipes/nasi-goreng.jpg\r\n',3,'2023-08-25 00:59:14','2023-10-25 06:56:14','Resep ini merupakan nasi goreng oriental yang tidak diberi tambahan kecap. Warnanya putih kekuningan dengan campuran ayam charsiun, udang dan juga telur ayam.',1,1200),(5,'Kangkung Terasi','public/images/recipes/kangkung.jpg\r\n',3,'2023-08-30 15:52:04','2023-10-25 10:02:58','Kangkung yang segar dan renyah dimasak dengan sempurna dalam campuran terasi yang kaya akan aroma dan cita rasa. Terasi memberikan dimensi tambahan pada hidangan ini, memberikan sentuhan gurih yang khas dan mengundang selera. Proses memasak yang cepat dan mudah membuat hidangan ini menjadi pilihan favorit untuk hidangan sehari-hari yang enak dan bergizi.',1,1800),(20,'snaf','public/images/recipes/bW1R2qYJcmf3ScyCmYC5TACm2kv3qpKUwRKeOAcf.png',7,'2023-09-14 13:38:00','2023-09-14 13:38:00','ndsjfna',0,3600),(22,'Keripik Kulit Singkong','public/images/recipes/XkkTZG1sZMfyvwrzc0esHY6poWNEutfnXZ1Jw0ey.png',3,'2023-09-17 04:57:22','2023-10-25 06:56:12','Keripik Kulit Singkong adalah camilan yang lezat dan gurih yang terbuat dari kulit singkong yang dipotong tipis, kemudian digoreng hingga renyah. Camilan ini memiliki tekstur yang renyah dan rasa yang gurih, membuatnya menjadi pilihan yang populer sebagai camilan ringan.',0,1800),(68,'Xdcedc','public/images/recipes/OhcT5gtm9W52Ljsx9nvEtFFEEqSBWqcFd290bUBk.jpg',3,'2023-10-25 06:46:30','2023-10-25 10:03:00','Crcec',1,7200),(69,'Cdrc','public/images/recipes/YiZtsQRetbaQBxu7E9w9Wf061eRJIGTCXepldffZ.jpg',3,'2023-10-25 06:55:59','2023-10-25 06:56:10','Ecdc',0,7200),(70,'dafs','public/images/recipes/2syrd2CDrgC2HMYzfCi6X3f0pRf52ZabZfmgpscp.png',15,'2026-06-26 10:59:48','2026-06-26 10:59:48','dsfad',1,3600);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_categories`
--

DROP TABLE IF EXISTS `tag_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_categories`
--

LOCK TABLES `tag_categories` WRITE;
/*!40000 ALTER TABLE `tag_categories` DISABLE KEYS */;
INSERT INTO `tag_categories` VALUES (1,'Pedas','2023-09-24 05:33:58','2023-09-24 05:33:58','danger'),(2,'Halal','2023-09-24 05:33:50','2023-09-24 05:33:50','success'),(3,'Olahan Sisa Pangan',NULL,NULL,'warning');
/*!40000 ALTER TABLE `tag_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_recipes`
--

DROP TABLE IF EXISTS `tag_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_recipes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag_category_id` bigint unsigned NOT NULL,
  `recipe_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_recipes_tag_category_id_foreign` (`tag_category_id`),
  KEY `tag_recipes_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `tag_recipes_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  CONSTRAINT `tag_recipes_tag_category_id_foreign` FOREIGN KEY (`tag_category_id`) REFERENCES `tag_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_recipes`
--

LOCK TABLES `tag_recipes` WRITE;
/*!40000 ALTER TABLE `tag_recipes` DISABLE KEYS */;
INSERT INTO `tag_recipes` VALUES (1,2,5,'2023-09-24 05:34:48','2023-09-24 05:34:48'),(2,1,5,'2023-09-24 05:43:36','2023-09-24 05:43:36'),(30,2,22,'2023-09-25 16:41:54','2023-09-25 16:41:54'),(31,3,22,'2023-09-25 16:41:54','2023-09-25 16:41:54'),(32,1,1,'2023-09-25 16:47:24','2023-09-25 16:47:24'),(73,1,68,'2023-10-25 06:46:30','2023-10-25 06:46:30'),(74,1,69,'2023-10-25 06:55:59','2023-10-25 06:55:59'),(75,2,69,'2023-10-25 06:55:59','2023-10-25 06:55:59'),(76,2,70,'2026-06-26 10:59:48','2026-06-26 10:59:48');
/*!40000 ALTER TABLE `tag_recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_categories`
--

DROP TABLE IF EXISTS `unit_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_categories`
--

LOCK TABLES `unit_categories` WRITE;
/*!40000 ALTER TABLE `unit_categories` DISABLE KEYS */;
INSERT INTO `unit_categories` VALUES (1,'weight','2023-08-28 00:28:35','2023-08-28 00:28:35'),(2,'volume','2023-08-28 00:30:10','2023-08-28 00:30:10'),(3,'length','2023-08-28 00:30:21','2023-08-28 00:30:21'),(4,'temperature','2023-08-28 00:30:32','2023-08-28 00:30:32'),(5,'piece','2023-08-28 00:30:40','2023-08-28 00:30:40');
/*!40000 ALTER TABLE `unit_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_category_id` bigint unsigned NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'milligram',1,'mg',1,'2023-08-28 00:31:45','2023-08-28 00:31:45'),(2,'gram',1,'g',1000,'2023-08-28 00:33:48','2023-08-28 00:33:48'),(3,'kilogram',1,'kg',1000000,'2023-08-28 00:34:51','2023-08-28 00:34:51'),(4,'millilitre',2,'mL',1,'2023-08-28 00:37:02','2023-08-28 00:37:02'),(5,'litre',2,'L',1000,'2023-08-28 00:37:47','2023-08-28 00:37:47'),(6,'ounce',1,'oz',28349,'2023-08-28 00:38:49','2023-08-28 00:38:49'),(7,'pound',1,'lb',453592,'2023-08-28 00:39:22','2023-08-28 00:39:22'),(8,'piece',5,'pcs',1,'2023-08-28 00:53:51','2023-08-28 00:53:51');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_ingredients`
--

DROP TABLE IF EXISTS `user_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_ingredients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `ingredient_types_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_ingredients`
--

LOCK TABLES `user_ingredients` WRITE;
/*!40000 ALTER TABLE `user_ingredients` DISABLE KEYS */;
INSERT INTO `user_ingredients` VALUES (29,4,2,'2023-08-27 12:27:30','2023-08-27 12:27:30'),(76,8,81,'2023-09-07 08:48:58','2023-09-07 08:48:58'),(77,3,2,'2023-09-08 05:21:53','2023-09-08 05:21:53'),(78,3,3,'2023-09-09 03:31:50','2023-09-09 03:31:50'),(80,3,1,'2023-09-13 01:11:49','2023-09-13 01:11:49'),(82,7,81,'2023-09-14 13:36:57','2023-09-14 13:36:57'),(87,3,79,'2023-09-17 05:22:39','2023-09-17 05:22:39'),(91,3,76,'2023-09-18 02:56:12','2023-09-18 02:56:12'),(93,3,78,'2023-09-18 05:20:11','2023-09-18 05:20:11'),(94,3,74,'2023-09-18 05:25:46','2023-09-18 05:25:46'),(97,3,81,'2023-09-23 05:40:53','2023-09-23 05:40:53'),(98,3,82,'2023-09-25 01:48:42','2023-09-25 01:48:42'),(99,3,88,'2023-09-26 02:05:19','2023-09-26 02:05:19'),(102,3,87,'2023-09-27 06:22:11','2023-09-27 06:22:11'),(107,3,90,'2023-10-11 06:06:29','2023-10-11 06:06:29'),(109,3,83,'2023-10-25 01:29:24','2023-10-25 01:29:24'),(111,3,80,'2023-10-25 02:20:12','2023-10-25 02:20:12'),(112,3,86,'2023-10-25 02:23:07','2023-10-25 02:23:07'),(113,3,85,'2023-10-25 02:36:25','2023-10-25 02:36:25'),(114,3,84,'2023-10-25 04:26:40','2023-10-25 04:26:40'),(116,13,87,'2024-05-29 07:28:19','2024-05-29 07:28:19'),(119,14,83,'2026-06-24 01:55:51','2026-06-24 01:55:51'),(122,15,85,'2026-06-27 10:08:59','2026-06-27 10:08:59');
/*!40000 ALTER TABLE `user_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Halim Bajragin Simbolon S.Kom','iirawan@example.com','2023-08-23 18:10:25','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',0,'UOs0Nl7K5T','2023-08-23 18:10:25','2023-08-23 18:10:25','public/images/users/user-default.png'),(2,'Tasdik Winarno S.Ked','patricia61@example.com','2023-08-23 18:10:25','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',0,'t0i5EKWe8U','2023-08-23 18:10:25','2023-08-23 18:10:25',''),(3,'Kenneth','kenneth@gmail.com',NULL,'$2y$10$45IDRhMNkQi5vCZxdzrUbOkQInGZP8X1RUuv7EKbD1w1k/y9reGHy',0,NULL,'2023-08-23 18:13:08','2023-09-14 11:20:36','public/images/users/UlmrMbqgAsvplIw8VZYUQp1VYeep1P8231MonS0L.jpg'),(4,'joseph','joseph@gmail.com',NULL,'$2y$10$WUM2hPnNBbga5frpkMeHXukzCvm5hVxRO1wzYWoCZrNHx18JCSF7S',0,NULL,'2023-08-26 04:15:10','2023-08-26 04:15:10','public/images/users/user-default.png'),(7,'Alisa','alisa@gmail.com',NULL,'$2y$10$kEdtApOdOsPnfWaWPI6dO.BJ1bsN/9MpnZlepOXZTo61w3vm.eEZq',0,NULL,'2023-08-30 15:40:47','2023-08-30 15:40:47','public/images/users/user-default.png'),(13,'kenneth','tes@gmail.com',NULL,'$2y$10$bWxdW9/Xd/SPSh71woNS8eFLPUHcbo.FdSC3TIvcyv8lctoCktNbi',0,NULL,'2024-05-29 07:27:33','2024-05-29 07:27:33','public/images/users/user-default.png'),(14,'Kenneth','kdav@gmail.com',NULL,'$2y$10$KdzZpBZfhBZVDKWPLSH3..2rOzUV8eOLlVD9ue5fbsgONgqcdQwxe',0,NULL,'2026-06-24 01:51:47','2026-06-24 01:51:47','public/images/users/user-default.png'),(15,'dnak','adnfn@gmail.com',NULL,'$2y$10$riq7wjDJU.QVmn3wmkrwnO6QYJMq5UeqIcVJuHdSKIBsQncLgb1MC',0,NULL,'2026-06-26 10:45:07','2026-06-26 10:45:07','public/images/users/user-default.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-28 16:26:33
