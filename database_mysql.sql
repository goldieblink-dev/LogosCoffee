SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `migration` VARCHAR(255) not null, `batch` INT not null) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES(23,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(24,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(25,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(26,'2026_03_01_144744_create_categories_table',1);
INSERT INTO migrations VALUES(27,'2026_03_01_144745_create_cafe_profiles_table',1);
INSERT INTO migrations VALUES(28,'2026_03_01_144745_create_products_table',1);
INSERT INTO migrations VALUES(29,'2026_03_01_170520_add_promo_price_to_products_table',1);
INSERT INTO migrations VALUES(30,'2026_03_01_170521_create_order_items_table',1);
INSERT INTO migrations VALUES(31,'2026_03_01_170521_create_orders_table',1);
INSERT INTO migrations VALUES(32,'2026_03_01_174152_update_order_statuses_in_orders_table',1);
INSERT INTO migrations VALUES(33,'2026_03_01_175130_add_role_to_users_table',1);
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `name` VARCHAR(255) not null, `email` VARCHAR(255) not null, `email_verified_at` DATETIME, `password` VARCHAR(255) not null, `remember_token` VARCHAR(255), `created_at` DATETIME, `updated_at` DATETIME, `role` VARCHAR(255) not null default 'cashier') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES(1,'Admin Logos','admin@logoscoffe.com',NULL,'$2y$12$DDj2Rb4Oy7eJ1VySSGcLweVj5wmfa.DzO00VCaWgq/osbEGEyoziK',NULL,'2026-03-02 06:54:05','2026-03-02 06:54:05','admin');
INSERT INTO users VALUES(2,'Cashier Logos','cashier@logoscoffe.com',NULL,'$2y$12$/M7fu6fDOZBri7z5.EXaVOP3cb8I.OsSsfK2nVs5D/3HPBoNPqo/y',NULL,'2026-03-02 06:54:06','2026-03-02 06:54:06','cashier');
INSERT INTO users VALUES(3,'Owner Logos','owner@logoscoffe.com',NULL,'$2y$12$ZYEayKGjvzxHssbB6ADHUO52nhf1Fh4PPYjfMJLYWYIUV8lGv8Nie',NULL,'2026-03-02 06:54:06','2026-03-02 06:54:06','owner');
INSERT INTO users VALUES(4,'Test User','test@example.com','2026-03-02 06:54:06','$2y$12$x1qw7L5Vlbv4tph4XanEEObYiKWfcFO41GMaNXa4PYBCvis8c9LSO','BkMToCe6l1','2026-03-02 06:54:06','2026-03-02 06:54:06','cashier');
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (`email` VARCHAR(255) not null, `token` VARCHAR(255) not null, `created_at` DATETIME, primary key (`email`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (`id` VARCHAR(255) not null, `user_id` INT, `ip_address` VARCHAR(255), `user_agent` text, `payload` text not null, `last_activity` INT not null, primary key (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (`key` VARCHAR(255) not null, `value` text not null, `expiration` INT not null, primary key (`key`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (`key` VARCHAR(255) not null, `owner` VARCHAR(255) not null, `expiration` INT not null, primary key (`key`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `queue` VARCHAR(255) not null, `payload` text not null, `attempts` INT not null, `reserved_at` INT, `available_at` INT not null, `created_at` INT not null) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (`id` VARCHAR(255) not null, `name` VARCHAR(255) not null, `total_jobs` INT not null, `pending_jobs` INT not null, `failed_jobs` INT not null, `failed_job_ids` text not null, `options` text, `cancelled_at` INT, `created_at` INT not null, `finished_at` INT, primary key (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `uuid` VARCHAR(255) not null, `connection` text not null, `queue` text not null, `payload` text not null, `exception` text not null, `failed_at` DATETIME not null default CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `name` VARCHAR(255) not null, `slug` VARCHAR(255) not null, `created_at` DATETIME, `updated_at` DATETIME) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO categories VALUES(1,'Coffee','coffee','2026-03-02 06:54:06','2026-03-02 06:54:06');
INSERT INTO categories VALUES(2,'Non-Coffee','non-coffee','2026-03-02 06:54:06','2026-03-02 06:54:06');
INSERT INTO categories VALUES(3,'Food','food','2026-03-02 06:54:06','2026-03-02 06:54:06');
INSERT INTO categories VALUES(4,'Snacks','snacks','2026-03-02 06:54:06','2026-03-02 06:54:06');
DROP TABLE IF EXISTS `cafe_profiles`;
CREATE TABLE IF NOT EXISTS `cafe_profiles` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `name` VARCHAR(255) not null, `address` text, `contact` VARCHAR(255), `logo` VARCHAR(255), `opening_hours` text, `created_at` DATETIME, `updated_at` DATETIME) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `category_id` INT not null, `name` VARCHAR(255) not null, `slug` VARCHAR(255) not null, `description` text, `price` DECIMAL(19,4) not null, `image` VARCHAR(255), `is_available` TINYINT(1) not null default '1', `created_at` DATETIME, `updated_at` DATETIME, `promo_price` DECIMAL(19,4), foreign key(`category_id`) references `categories`(`id`) on delete cascade) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES(1,1,'Espresso','espresso-69a5340e54649','Single shot espresso.',15000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',12000);
INSERT INTO products VALUES(2,1,'Americano','americano-69a5340e5820d','Espresso with hot water.',20000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(3,1,'Cafe Latte','cafe-latte-69a5340e5bb92','Espresso with steamed milk.',25000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(4,1,'Cappuccino','cappuccino-69a5340e5f6da','Espresso with frothed milk.',25000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(5,2,'Matcha Latte','matcha-latte-69a5340e66215','Premium matcha with milk.',28000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(6,2,'Chocolate Hot','chocolate-hot-69a5340e69c4a','Rich dark chocolate.',25000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(7,2,'Iced Tea','iced-tea-69a5340e6d861','Fresh brewed jasmine tea.',10000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(8,3,'Nasi Goreng LC','nasi-goreng-lc-69a5340e752f9','Special fried rice with egg.',35000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(9,3,'Mie Goreng LC','mie-goreng-lc-69a5340e79269','Fried noodles with vegetables.',30000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(10,4,'French Fries','french-fries-69a5340e811e9','Crispy golden fries.',18000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
INSERT INTO products VALUES(11,4,'Croissant','croissant-69a5340e84e79','Buttery flaky pastry.',22000,NULL,1,'2026-03-02 06:54:06','2026-03-02 06:54:06',NULL);
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `order_id` INT not null, `product_id` INT not null, `quantity` INT not null, `price` DECIMAL(19,4) not null, `created_at` DATETIME, `updated_at` DATETIME, foreign key(`order_id`) references `orders`(`id`) on delete cascade, foreign key(`product_id`) references `products`(`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (`id` INT PRIMARY KEY AUTO_INCREMENT not null, `table_number` VARCHAR(255) not null, `customer_name` VARCHAR(255) not null, `customer_phone` VARCHAR(255), `total_amount` DECIMAL(19,4) not null, `status` VARCHAR(255) not null default 'pending', `payment_method` VARCHAR(255), `payment_proof` VARCHAR(255), `created_at` DATETIME, `updated_at` DATETIME) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE UNIQUE INDEX `users_email_unique` on `users` (`email`);
CREATE INDEX `sessions_user_id_index` on `sessions` (`user_id`);
CREATE INDEX `sessions_last_activity_index` on `sessions` (`last_activity`);
CREATE INDEX `cache_expiration_index` on `cache` (`expiration`);
CREATE INDEX `cache_locks_expiration_index` on `cache_locks` (`expiration`);
CREATE INDEX `jobs_queue_index` on `jobs` (`queue`);
CREATE UNIQUE INDEX `failed_jobs_uuid_unique` on `failed_jobs` (`uuid`);
CREATE UNIQUE INDEX `categories_slug_unique` on `categories` (`slug`);
CREATE UNIQUE INDEX `products_slug_unique` on `products` (`slug`);

SET FOREIGN_KEY_CHECKS = 1;
