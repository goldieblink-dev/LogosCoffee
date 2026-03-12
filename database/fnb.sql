/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.16-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: fnb
-- ------------------------------------------------------
-- Server version	10.11.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cafe_profiles`
--

DROP TABLE IF EXISTS `cafe_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cafe_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `opening_hours` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cafe_profiles`
--

LOCK TABLES `cafe_profiles` WRITE;
/*!40000 ALTER TABLE `cafe_profiles` DISABLE KEYS */;
INSERT INTO `cafe_profiles` VALUES
(1,'Logos Coffe',NULL,NULL,NULL,'{\"Senin - Jumat\":\"08:00 - 22:00\",\"Sabtu - Minggu\":\"09:00 - 23:00\"}','2026-03-02 08:19:54','2026-03-02 08:19:54');
/*!40000 ALTER TABLE `cafe_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Coffee','coffee','2026-03-02 06:54:06','2026-03-02 06:54:06'),
(2,'Non-Coffee','non-coffee','2026-03-02 06:54:06','2026-03-02 06:54:06'),
(3,'Food','food','2026-03-02 06:54:06','2026-03-02 06:54:06'),
(4,'Snacks','snacks','2026-03-02 06:54:06','2026-03-02 06:54:06'),
(5,'Dessert','dessert','2026-03-05 05:13:17','2026-03-05 05:13:17'),
(6,'Fresh Drinks','fresh-drinks','2026-03-05 05:13:17','2026-03-05 05:13:17');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` datetime NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` text DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` int(11) NOT NULL,
  `reserved_at` int(11) DEFAULT NULL,
  `available_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(23,'0001_01_01_000000_create_users_table',1),
(24,'0001_01_01_000001_create_cache_table',1),
(25,'0001_01_01_000002_create_jobs_table',1),
(26,'2026_03_01_144744_create_categories_table',1),
(27,'2026_03_01_144745_create_cafe_profiles_table',1),
(28,'2026_03_01_144745_create_products_table',1),
(29,'2026_03_01_170520_add_promo_price_to_products_table',1),
(30,'2026_03_01_170521_create_order_items_table',1),
(31,'2026_03_01_170521_create_orders_table',1),
(32,'2026_03_01_174152_update_order_statuses_in_orders_table',1),
(33,'2026_03_01_175130_add_role_to_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES
(7,5,1,1,12000.0000,'2026-03-02 14:04:23','2026-03-02 14:04:23'),
(8,5,5,1,28000.0000,'2026-03-02 14:04:23','2026-03-02 14:04:23'),
(9,5,8,1,35000.0000,'2026-03-02 14:04:23','2026-03-02 14:04:23'),
(10,5,11,1,22000.0000,'2026-03-02 14:04:23','2026-03-02 14:04:23'),
(11,6,1,1,12000.0000,'2026-03-04 05:30:05','2026-03-04 05:30:05'),
(12,6,3,1,25000.0000,'2026-03-04 05:30:05','2026-03-04 05:30:05'),
(13,6,5,1,28000.0000,'2026-03-04 05:30:05','2026-03-04 05:30:05'),
(14,6,7,1,10000.0000,'2026-03-04 05:30:05','2026-03-04 05:30:05'),
(15,6,9,1,30000.0000,'2026-03-04 05:30:05','2026-03-04 05:30:05'),
(16,6,10,1,18000.0000,'2026-03-04 05:30:05','2026-03-04 05:30:05'),
(17,7,1,1,12000.0000,'2026-03-05 04:49:39','2026-03-05 04:49:39'),
(18,8,1,4,12000.0000,'2026-03-05 04:52:11','2026-03-05 04:52:11'),
(19,9,1,1,12000.0000,'2026-03-05 05:03:51','2026-03-05 05:03:51'),
(20,10,1,1,12000.0000,'2026-03-05 05:03:58','2026-03-05 05:03:58'),
(21,11,1,1,12000.0000,'2026-03-05 05:09:03','2026-03-05 05:09:03'),
(22,12,1,9,12000.0000,'2026-03-05 06:47:33','2026-03-05 06:47:33'),
(23,13,1,2,12000.0000,'2026-03-05 06:47:44','2026-03-05 06:47:44'),
(24,14,6,1,25000.0000,'2026-03-05 06:53:01','2026-03-05 06:53:01'),
(25,14,15,1,18000.0000,'2026-03-05 06:53:01','2026-03-05 06:53:01'),
(26,15,2,1,20000.0000,'2026-03-05 07:00:02','2026-03-05 07:00:02'),
(27,15,6,1,25000.0000,'2026-03-05 07:00:02','2026-03-05 07:00:02'),
(28,15,8,1,35000.0000,'2026-03-05 07:00:02','2026-03-05 07:00:02'),
(29,15,11,1,22000.0000,'2026-03-05 07:00:02','2026-03-05 07:00:02'),
(30,15,12,1,32000.0000,'2026-03-05 07:00:02','2026-03-05 07:00:02'),
(31,15,15,1,18000.0000,'2026-03-05 07:00:02','2026-03-05 07:00:02'),
(32,16,1,1,12000.0000,'2026-03-09 02:36:22','2026-03-09 02:36:22'),
(33,16,15,1,18000.0000,'2026-03-09 02:36:22','2026-03-09 02:36:22'),
(34,17,13,1,30000.0000,'2026-03-09 02:38:12','2026-03-09 02:38:12'),
(35,17,15,1,18000.0000,'2026-03-09 02:38:12','2026-03-09 02:38:12'),
(36,18,13,1,30000.0000,'2026-03-09 02:38:38','2026-03-09 02:38:38'),
(37,18,15,1,18000.0000,'2026-03-09 02:38:38','2026-03-09 02:38:38'),
(38,19,1,1,12000.0000,'2026-03-12 10:35:58','2026-03-12 10:35:58'),
(39,19,2,1,20000.0000,'2026-03-12 10:35:58','2026-03-12 10:35:58'),
(40,19,7,1,10000.0000,'2026-03-12 10:35:58','2026-03-12 10:35:58'),
(41,19,8,1,35000.0000,'2026-03-12 10:35:58','2026-03-12 10:35:58'),
(42,20,8,1,35000.0000,'2026-03-12 10:37:32','2026-03-12 10:37:32'),
(43,20,9,1,30000.0000,'2026-03-12 10:37:32','2026-03-12 10:37:32'),
(44,20,10,1,18000.0000,'2026-03-12 10:37:32','2026-03-12 10:37:32'),
(45,20,13,1,30000.0000,'2026-03-12 10:37:32','2026-03-12 10:37:32'),
(46,20,17,1,22000.0000,'2026-03-12 10:37:32','2026-03-12 10:37:32');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_number` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `total_amount` decimal(19,4) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES
(5,'4','Rendy Julkifli Usman','081573802608',97000.0000,'completed','QRIS',NULL,'2026-03-02 14:04:23','2026-03-06 23:12:29'),
(6,'2','lukas','081234',123000.0000,'paid','QRIS',NULL,'2026-03-04 05:30:05','2026-03-04 05:30:11'),
(7,'2','udin','08912345',12000.0000,'pending',NULL,NULL,'2026-03-05 04:49:39','2026-03-05 04:49:39'),
(8,'2','udin','08912345',48000.0000,'paid','QRIS',NULL,'2026-03-05 04:52:11','2026-03-05 04:52:14'),
(9,'-2','udin','098986',12000.0000,'pending',NULL,NULL,'2026-03-05 05:03:51','2026-03-05 05:03:51'),
(10,'-2','udin','098986',12000.0000,'paid','QRIS',NULL,'2026-03-05 05:03:58','2026-03-05 05:04:02'),
(11,'-2','udin','098986',12000.0000,'paid','QRIS',NULL,'2026-03-05 05:09:03','2026-03-05 05:09:06'),
(12,'2221','udin','123123123',108000.0000,'pending',NULL,NULL,'2026-03-05 06:47:33','2026-03-05 06:47:33'),
(13,'2221','udin','123123123',24000.0000,'pending',NULL,NULL,'2026-03-05 06:47:44','2026-03-05 06:47:44'),
(14,'32','ikuy','876876868',43000.0000,'paid','QRIS',NULL,'2026-03-05 06:53:01','2026-03-05 06:57:59'),
(15,'1','loli','08123',152000.0000,'completed','QRIS',NULL,'2026-03-05 07:00:02','2026-03-12 05:58:33'),
(16,'1','dfdfd',NULL,30000.0000,'paid','QRIS',NULL,'2026-03-09 02:36:22','2026-03-09 02:36:35'),
(17,'3','ds',NULL,48000.0000,'pending',NULL,NULL,'2026-03-09 02:38:12','2026-03-09 02:38:12'),
(18,'3','ds',NULL,48000.0000,'pending',NULL,NULL,'2026-03-09 02:38:38','2026-03-09 02:38:38'),
(19,'4','Adam','08123321',77000.0000,'paid','QRIS',NULL,'2026-03-12 10:35:58','2026-03-12 10:36:16'),
(20,'6','yudi','08712562',135000.0000,'paid','QRIS',NULL,'2026-03-12 10:37:32','2026-03-12 10:37:38');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(19,4) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `promo_price` decimal(19,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,1,'Espresso','espresso-69a5340e54649','Single shot espresso.',15000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',12000.0000),
(2,1,'Americano','americano-69a5340e5820d','Espresso with hot water.',20000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(3,1,'Cafe Latte','cafe-latte-69a5340e5bb92','Espresso with steamed milk.',25000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(4,1,'Cappuccino','cappuccino-69a5340e5f6da','Espresso with frothed milk.',25000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(5,2,'Matcha Latte','matcha-latte-69a5340e66215','Premium matcha with milk.',28000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(6,2,'Chocolate Hot','chocolate-hot-69a5340e69c4a','Rich dark chocolate.',25000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(7,2,'Iced Tea','iced-tea-69a5340e6d861','Fresh brewed jasmine tea.',10000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(8,3,'Nasi Goreng LC','nasi-goreng-lc-69a5340e752f9','Special fried rice with egg.',35000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(9,3,'Mie Goreng LC','mie-goreng-lc-69a5340e79269','Fried noodles with vegetables.',30000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(10,4,'French Fries','french-fries-69a5340e811e9','Crispy golden fries.',18000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(11,4,'Croissant','croissant-69a5340e84e79','Buttery flaky pastry.',22000.0000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL),
(12,5,'Tiramisu','tiramisu-69a910ed76688','Classic Italian dessert with espresso.',32000.0000,NULL,1,'2026-03-05 05:13:17','2026-03-05 05:13:17',NULL),
(13,5,'Cheesecake','cheesecake-69a910ed77e55','Creamy New York style cheesecake.',30000.0000,NULL,1,'2026-03-05 05:13:17','2026-03-05 05:13:17',NULL),
(14,5,'Brownies','brownies-69a910ed7941a','Rich fudgy chocolate brownies.',22000.0000,NULL,1,'2026-03-05 05:13:17','2026-03-05 05:13:17',NULL),
(15,6,'Lemon Squash','lemon-squash-69a910ed7cfad','Fresh squeezed lemon with soda.',18000.0000,NULL,1,'2026-03-05 05:13:17','2026-03-05 05:13:17',NULL),
(16,6,'Mango Smoothie','mango-smoothie-69a910ed7f5ca','Blended fresh mango with yogurt.',25000.0000,NULL,1,'2026-03-05 05:13:17','2026-03-05 05:13:17',NULL),
(17,6,'Strawberry Juice','strawberry-juice-69a910ed80d65','Fresh strawberry with a hint of mint.',22000.0000,NULL,1,'2026-03-05 05:13:17','2026-03-05 05:13:17',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('AjQn4zPq1tf3y6kZMAXEEsuMNNgjRd4H1RNR7UIU',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoib0J1UTZZMnpoTVhZZ2lHejVBajZxcGtxUExGTTRuRXBkRnl6TkZBaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoyMDoiYWRtaW4ucHJvZHVjdHMuaW5kZXgiO31zOjg6ImN1c3RvbWVyIjthOjM6e3M6MTI6InRhYmxlX251bWJlciI7czoxOiI2IjtzOjEzOiJjdXN0b21lcl9uYW1lIjtzOjQ6Inl1ZGkiO3M6MTQ6ImN1c3RvbWVyX3Bob25lIjtzOjg6IjA4NzEyNTYyIjt9czoxNjoiY3VycmVudF9vcmRlcl9pZCI7aToyMDtzOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1773313131),
('bus9fYhGudYmd6xKfO7GJ9pgxFzDeyoTLAJc8sq8',2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY1ZUSjJEa0daUG5xMlBOdEtGYU9CSkNUQ0RPV1NDWkxDMFZNQU9PVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXNoaWVyIjtzOjU6InJvdXRlIjtzOjE3OiJjYXNoaWVyLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1773308069),
('FADLi6JOPR3IpxGb2c8UV01eWHDjjr6IHBfuqFrA',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSEtySmJkWXBRVTdFVm5mNm9vZ3NXZDM4bGs5VjBrR0dFdnJ0WWE1NiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4iO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1773305854),
('PkTOceyRdJW9hN75dG0qSuPtbAeOYzLIN1DkgZW9',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoic25OV1h2NTNRcTNKbjRLMDhycnprblNmVTdqbU1JVjlLMkJnalF0eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9vcmRlcnMiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLm9yZGVycy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1773349826);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'cashier',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Admin Logos','admin@logoscoffe.com',NULL,'$2y$12$DDj2Rb4Oy7eJ1VySSGcLweVj5wmfa.DzO00VCaWgq/osbEGEyoziK',NULL,'2026-03-02 06:54:05','2026-03-02 06:54:05','admin'),
(2,'Cashier Logos','cashier@logoscoffe.com',NULL,'$2y$12$/M7fu6fDOZBri7z5.EXaVOP3cb8I.OsSsfK2nVs5D/3HPBoNPqo/y',NULL,'2026-03-02 06:54:06','2026-03-02 06:54:06','cashier'),
(3,'Owner Logos','owner@logoscoffe.com',NULL,'$2y$12$ZYEayKGjvzxHssbB6ADHUO52nhf1Fh4PPYjfMJLYWYIUV8lGv8Nie',NULL,'2026-03-02 06:54:06','2026-03-02 06:54:06','owner'),
(4,'Test User','test@example.com','2026-03-02 06:54:06','$2y$12$x1qw7L5Vlbv4tph4XanEEObYiKWfcFO41GMaNXa4PYBCvis8c9LSO','BkMToCe6l1','2026-03-02 06:54:06','2026-03-02 06:54:06','cashier');
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

-- Dump completed on 2026-03-13  4:54:34
