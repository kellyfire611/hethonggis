-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.36-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for doanmanguonmo
CREATE DATABASE IF NOT EXISTS `doanmanguonmo` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `doanmanguonmo`;

-- Dumping structure for table doanmanguonmo.binhluan
CREATE TABLE IF NOT EXISTS `binhluan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loibinh` text COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT '0',
  `diadiem_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_danhgia_diadiem` (`diadiem_id`),
  CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`diadiem_id`) REFERENCES `diadiem` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- Dumping data for table doanmanguonmo.binhluan: ~0 rows (approximately)
/*!40000 ALTER TABLE `binhluan` DISABLE KEYS */;
INSERT INTO `binhluan` (`id`, `loibinh`, `trangthai`, `diadiem_id`) VALUES
	(1, 'Quán ăn chất lượng', 1, 1);
/*!40000 ALTER TABLE `binhluan` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.danhgia
CREATE TABLE IF NOT EXISTS `danhgia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sodiem` int(11) NOT NULL DEFAULT '0',
  `diengiai` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `diadiem_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_danhgia_diadiem` (`diadiem_id`),
  CONSTRAINT `FK_danhgia_diadiem` FOREIGN KEY (`diadiem_id`) REFERENCES `diadiem` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table doanmanguonmo.danhgia: ~0 rows (approximately)
/*!40000 ALTER TABLE `danhgia` DISABLE KEYS */;
INSERT INTO `danhgia` (`id`, `sodiem`, `diengiai`, `diadiem_id`) VALUES
	(1, 4, 'dịch vụ tốt', 1);
/*!40000 ALTER TABLE `danhgia` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.diadiem
CREATE TABLE IF NOT EXISTS `diadiem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tieude` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `tinhthanh_id` int(10) unsigned NOT NULL,
  `quanhuyen_id` int(10) unsigned NOT NULL,
  `xaphuong_id` int(10) unsigned NOT NULL,
  `giomocua` text COLLATE utf8_unicode_ci NOT NULL,
  `dichvu` text COLLATE utf8_unicode_ci NOT NULL,
  `giaohang` text COLLATE utf8_unicode_ci NOT NULL,
  `thoigianchuanbi` text COLLATE utf8_unicode_ci NOT NULL,
  `gps_tungdo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `gps_vido` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_diadiem_tinhthanh` (`tinhthanh_id`),
  KEY `FK_diadiem_quanhuyen` (`quanhuyen_id`),
  KEY `FK_diadiem_xaphuong` (`xaphuong_id`),
  CONSTRAINT `FK_diadiem_quanhuyen` FOREIGN KEY (`quanhuyen_id`) REFERENCES `quanhuyen` (`id`),
  CONSTRAINT `FK_diadiem_tinhthanh` FOREIGN KEY (`tinhthanh_id`) REFERENCES `tinhthanh` (`id`),
  CONSTRAINT `FK_diadiem_xaphuong` FOREIGN KEY (`xaphuong_id`) REFERENCES `xaphuong` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table doanmanguonmo.diadiem: ~1 rows (approximately)
/*!40000 ALTER TABLE `diadiem` DISABLE KEYS */;
INSERT INTO `diadiem` (`id`, `tieude`, `diachi`, `tinhthanh_id`, `quanhuyen_id`, `xaphuong_id`, `giomocua`, `dichvu`, `giaohang`, `thoigianchuanbi`, `gps_tungdo`, `gps_vido`, `trangthai`) VALUES
	(1, 'Gà Rán Hương Việt - Đề Thám', '82 Đề Thám', 1, 1, 1, 'Từ 06:15-22:30', 'Giá từ 5000-50000d', 'Giao hàng từ 50000đ trở lên', '15\' nấu bếp', '', '', 1);
/*!40000 ALTER TABLE `diadiem` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.diadiem_chitiet
CREATE TABLE IF NOT EXISTS `diadiem_chitiet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tenmon` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `giatien` decimal(10,0) NOT NULL,
  `dichvu` text COLLATE utf8_unicode_ci NOT NULL,
  `solandat` int(11) NOT NULL,
  `hinhminhhoa` text COLLATE utf8_unicode_ci NOT NULL,
  `diadiem_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_diadiem_chitiet_diadiem` (`diadiem_id`),
  CONSTRAINT `FK_diadiem_chitiet_diadiem` FOREIGN KEY (`diadiem_id`) REFERENCES `diadiem` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table doanmanguonmo.diadiem_chitiet: ~2 rows (approximately)
/*!40000 ALTER TABLE `diadiem_chitiet` DISABLE KEYS */;
INSERT INTO `diadiem_chitiet` (`id`, `tenmon`, `giatien`, `dichvu`, `solandat`, `hinhminhhoa`, `diadiem_id`) VALUES
	(1, 'Khoai tây chiên cọng chuẩn KFC', 17000, '', 12, 'khoaitaychien.jpg', 1),
	(2, 'Cánh gà tẩm ướp rán giòn', 35000, '', 24, 'canhgatamuoprangion.jpg', 1);
/*!40000 ALTER TABLE `diadiem_chitiet` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.migrations: ~13 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(27, '2014_10_12_000000_create_users_table', 1),
	(28, '2014_10_12_100000_create_password_resets_table', 1),
	(29, '2017_01_01_000003_tenancy_websites', 1),
	(30, '2017_01_01_000005_tenancy_hostnames', 1),
	(31, '2017_09_03_144628_create_permission_tables', 1),
	(32, '2017_09_11_174816_create_social_accounts_table', 1),
	(33, '2017_09_26_140332_create_cache_table', 1),
	(34, '2017_09_26_140528_create_sessions_table', 1),
	(35, '2017_09_26_140609_create_jobs_table', 1),
	(36, '2018_04_06_000001_tenancy_websites_needs_db_host', 1),
	(37, '2018_04_08_033256_create_password_histories_table', 1),
	(38, '2019_02_21_034256_create_survey_table_v1', 1),
	(39, '2019_02_25_022041_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `permission_id_model_has_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `role_id_model_has_roles_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.model_has_roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\Auth\\User', 1),
	(2, 'App\\Models\\Auth\\User', 2),
	(3, 'App\\Models\\Auth\\User', 3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.password_histories
CREATE TABLE IF NOT EXISTS `password_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `password_histories_user_id_foreign` (`user_id`),
  CONSTRAINT `password_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.password_histories: ~4 rows (approximately)
/*!40000 ALTER TABLE `password_histories` DISABLE KEYS */;
INSERT INTO `password_histories` (`id`, `user_id`, `password`, `created_at`, `updated_at`) VALUES
	(1, 1, '$2y$10$q93BpY/lhEeumQGVmmlyGeUkSddC0PSHkwHlf2bv3.Tx3uxr1eRFG', '2019-02-28 02:54:45', '2019-02-28 02:54:45'),
	(2, 2, '$2y$10$mmOLauzdMhKiBWzOfC3BG.MvlkQ5dr6j4u1aZtbm20K6VzVXGAOLG', '2019-02-28 02:54:45', '2019-02-28 02:54:45'),
	(3, 3, '$2y$10$oMIAsCLBnPCK95fgYdAzD.zIsKoYvzLw24M/TTOu04jgQrKCINbjC', '2019-02-28 02:54:45', '2019-02-28 02:54:45'),
	(4, 4, '$2y$10$3NXbiCsEhNpzbr1z8w7QX.IGilBmiWsjAhjhnvd4jSDROlIn8o3OK', '2019-02-28 02:54:58', '2019-02-28 02:54:58');
/*!40000 ALTER TABLE `password_histories` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view backend', 'web', '2019-02-28 02:54:45', '2019-02-28 02:54:45');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.quanhuyen
CREATE TABLE IF NOT EXISTS `quanhuyen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tenquanhuyen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tinhthanh_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_quanhuyen_tinhthanh` (`tinhthanh_id`),
  CONSTRAINT `FK_quanhuyen_tinhthanh` FOREIGN KEY (`tinhthanh_id`) REFERENCES `tinhthanh` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table doanmanguonmo.quanhuyen: ~1 rows (approximately)
/*!40000 ALTER TABLE `quanhuyen` DISABLE KEYS */;
INSERT INTO `quanhuyen` (`id`, `tenquanhuyen`, `tinhthanh_id`) VALUES
	(1, 'Ninh Kiều', 1);
/*!40000 ALTER TABLE `quanhuyen` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'web', '2019-02-28 02:54:45', '2019-02-28 02:54:45'),
	(2, 'executive', 'web', '2019-02-28 02:54:45', '2019-02-28 02:54:45'),
	(3, 'user', 'web', '2019-02-28 02:54:45', '2019-02-28 02:54:45');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_id_role_has_permissions_id` (`role_id`),
  CONSTRAINT `permission_id_role_has_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_id_role_has_permissions_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.role_has_permissions: ~2 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(1, 2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.social_accounts
CREATE TABLE IF NOT EXISTS `social_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.social_accounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.tinhthanh
CREATE TABLE IF NOT EXISTS `tinhthanh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tentinhthanh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table doanmanguonmo.tinhthanh: ~1 rows (approximately)
/*!40000 ALTER TABLE `tinhthanh` DISABLE KEYS */;
INSERT INTO `tinhthanh` (`id`, `tentinhthanh`) VALUES
	(1, 'Cần Thơ');
/*!40000 ALTER TABLE `tinhthanh` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.trang
CREATE TABLE IF NOT EXISTS `trang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `tieude` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table doanmanguonmo.trang: ~0 rows (approximately)
/*!40000 ALTER TABLE `trang` DISABLE KEYS */;
/*!40000 ALTER TABLE `trang` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gravatar',
  `avatar_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `uuid`, `first_name`, `last_name`, `email`, `avatar_type`, `avatar_location`, `password`, `password_changed_at`, `active`, `confirmation_code`, `confirmed`, `timezone`, `last_login_at`, `last_login_ip`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '9bd124e5-fd12-4535-924e-2b3bcedbad3b', 'Quản trị', 'Hệ thống', 'admin@admin.com.vn', 'gravatar', NULL, '$2y$10$q93BpY/lhEeumQGVmmlyGeUkSddC0PSHkwHlf2bv3.Tx3uxr1eRFG', NULL, 1, '32cd8599fe464382e9cf53e542285ebc', 1, 'America/New_York', '2019-03-06 22:50:30', '127.0.0.1', 'V9eSo1gnN4jo0NU7fimAf6GRcrNOGPDfbQM5PgvI0xBUnIFmP4MsmFpK0Vrf', '2019-02-28 02:54:45', '2019-03-06 22:50:30', NULL),
	(2, '10fd9b48-f3d8-41e3-b5b5-fc8ba1dd8e68', 'Backend', 'User', 'executive@executive.com', 'gravatar', NULL, '$2y$10$mmOLauzdMhKiBWzOfC3BG.MvlkQ5dr6j4u1aZtbm20K6VzVXGAOLG', NULL, 1, '7898859f9d8d91f5cfcc8f8e6e5ffa29', 1, NULL, NULL, NULL, NULL, '2019-02-28 02:54:45', '2019-02-28 02:54:45', NULL),
	(3, 'b83e8518-d10b-4b34-bb42-8e383bb832e9', 'Default', 'User', 'user@user.com', 'gravatar', NULL, '$2y$10$oMIAsCLBnPCK95fgYdAzD.zIsKoYvzLw24M/TTOu04jgQrKCINbjC', NULL, 1, '4131cbaf8e7314b7229a9828c66d848b', 1, NULL, NULL, NULL, NULL, '2019-02-28 02:54:45', '2019-02-28 02:54:45', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.xaphuong
CREATE TABLE IF NOT EXISTS `xaphuong` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tenxaphuong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quanhuyen_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_quanhuyen_tinhthanh` (`quanhuyen_id`),
  CONSTRAINT `xaphuong_ibfk_1` FOREIGN KEY (`quanhuyen_id`) REFERENCES `quanhuyen` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- Dumping data for table doanmanguonmo.xaphuong: ~2 rows (approximately)
/*!40000 ALTER TABLE `xaphuong` DISABLE KEYS */;
INSERT INTO `xaphuong` (`id`, `tenxaphuong`, `quanhuyen_id`) VALUES
	(1, 'An Hội', 1),
	(2, 'An Phú', 1);
/*!40000 ALTER TABLE `xaphuong` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
