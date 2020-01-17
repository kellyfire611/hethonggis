-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for quanlytourdulich
CREATE DATABASE IF NOT EXISTS `quanlytourdulich` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `quanlytourdulich`;

-- Dumping structure for table quanlytourdulich.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.cache: ~0 rows (approximately)
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.dacsan
CREATE TABLE IF NOT EXISTS `dacsan` (
  `madacsan` varchar(50) NOT NULL,
  `tendacsan` varchar(250) NOT NULL,
  `mota` varchar(400) NOT NULL,
  `hinhanh` varchar(300) NOT NULL,
  PRIMARY KEY (`madacsan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table quanlytourdulich.dacsan: ~17 rows (approximately)
/*!40000 ALTER TABLE `dacsan` DISABLE KEYS */;
INSERT INTO `dacsan` (`madacsan`, `tendacsan`, `mota`, `hinhanh`) VALUES
	('DS01', 'Mứt trái cây', 'Mứt trái cây đà lạt', ''),
	('DS02', 'Cà phê ', 'Cà phê ', 'cafe.jpg'),
	('DS03', 'Dâu Tây', 'Dâu Tây', 'dautay.jpg'),
	('DS04', 'Rượu Vang Đà Lạt', 'Rượu Vang Đà Lạt', 'ruouvangDL.jpg'),
	('DS05', 'Nước ép trái cây', 'Nước ép trái cây', 'nuoceptraicay.jpg'),
	('DS06', 'Đồ len', 'Đồ len', 'dolen.jpg'),
	('DS07', 'Thổ Cẩm', 'Thổ Cẩm', 'thocam.jpg'),
	('DS08', 'Rau Củ Sấy', 'Rau Củ Sấy', 'raucusay.jpg'),
	('DS09', 'Trà atiso', 'Trà atiso', 'traatiso.jpg'),
	('DS10', 'Nho Ninh Thuận', 'Nho Ninh Thuận', 'nhoninhthuan.jpg'),
	('DS11', 'Tỏi Phan Rang', 'Tỏi Phan Rang', 'ToiPhanRang.jpg'),
	('DS12', 'Chả Lụa Phan Rang', 'Chả Lụa Phan Rang', 'ChaLua.jpg'),
	('DS13', 'Bánh hỏi An Nhất', 'Bánh hỏi An Nhất', 'BanhHoi.jpg'),
	('DS14', 'Gỏi cá mai', 'Gỏi cá mai', 'CaMai.jpg'),
	('DS15', 'Bánh xèo Biển Đông Hải', 'Bánh xèo Biển Đông Hải', 'BanhXeo.jpg'),
	('DS16', 'Bánh Bông Lan Trứng muối', 'Bánh Bông Lan Trứng muối', 'BanhBongLan.jpg'),
	('DS17', 'Ô mai Hồng Lam', 'Ô mai Hồng Lam', 'omaihonglam.jpg');
/*!40000 ALTER TABLE `dacsan` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.diemthamquan
CREATE TABLE IF NOT EXISTS `diemthamquan` (
  `madiemthamquan` varchar(50) NOT NULL,
  `tendiemthamquan` varchar(250) NOT NULL,
  `hinhanh` varchar(200) NOT NULL,
  `toadodiemthamquan` point NOT NULL,
  `idquanhuyen` varchar(50) NOT NULL,
  PRIMARY KEY (`madiemthamquan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table quanlytourdulich.diemthamquan: ~21 rows (approximately)
/*!40000 ALTER TABLE `diemthamquan` DISABLE KEYS */;
INSERT INTO `diemthamquan` (`madiemthamquan`, `tendiemthamquan`, `hinhanh`, `toadodiemthamquan`, `idquanhuyen`) VALUES
	('DTQ01', 'Thác Pren </br> “Thác nước đẹp nằm ở cửa ngỏ vào Đà Lạt”', 'ThacPren.jpg', _binary 0x000000000101000000940DC5E7F1BFBD0092CB7F48BFBD2740, '376'),
	('DTQ02', 'Quảng trường Lâm Viên </br> “Điểm du lịch mới tại Đà Lạt, tự do chụp hình với không gian rộng, nhiều hoạt động tại đây và đặc biệt có dịp “sống ảo”với đóa hoa dã quỳ, hoa Atiso khổng lồ.”', 'QTLamvien.jpg', _binary 0x0000000001010000009E45EF54C0BDEFBF48FD0807274008EF, '376'),
	('DTQ03', 'Đồi Mộng Mơ </br> “Tham quan nhiều công trình tại đây như: Làng văn hóa dân tộc trưng bày cồng chiên Tây Nguyên, Vạn lý trường thành thu nhỏ...”', 'DoiMongMo.jpg', _binary 0x0000000001010000007B140A15C0EFBFBD35281A852B40560E, '376'),
	('DTQ04', 'Đồi chè Cầu Đất </br> “Điểm tham quan thơ mộng cách xa TP Đà Lạt. Quý khách sẽ được sống ảo với những đồi chè bạt ngàn.”', 'DoiCheCauDat.jpg', _binary 0x000000000101000000AA264781C0BD56010B7A6F0C0140EFBF, '376'),
	('DTQ06', 'Tham quan Nhà Ga Đà Lạt </br> “Nhà ga cổ và đẹp nhất Đà Lạt”', 'NhaGaDaLat.jpg', _binary 0x0000000001010000005B31A24DEDBFBD00000000000000EFBF, '376'),
	('DTQ07', 'Thiền viện trúc lâm </br> “Ngắm cảnh Hồ Tuyền Lâm, núi Phụng Hoàng với thiên nhiên, núi đồi, rừng thông. Quý khách có thể lựa chọn cáp treo để đến Thiền viện”', 'ThienVienTrucLam.jpg', _binary 0x0000000001010000005B31A24DEDBFBD008593D486FDEEBFBD, '376'),
	('DTQ08', 'Đường hầm điêu khắc </br> “Nơi tái hiện lịch sử Đà lạt từ thuở khai sinh đến hiện tại bằng đất sét.”', 'DuongHamDieuKhac.jpg', _binary 0x00000000010100000071AC8BDB680028409E45EF54C0BDEFBF, '376'),
	('DTQ09', 'Langbiang </br> “Nơi gắn liền chuyện tình lãng mạn của chàng Lang và nàng H’biang.”', 'Langbiang.jpg', _binary 0x0000000001010000005B68BAE4EEBFBDEF96AD513307000060, '376'),
	('DTQ10', 'Làng gốm Chăm Bàu Trúc </br> “Làng nghề truyền thống của người Chăm”', 'LangGomChamBau.jpg', _binary 0x00000000010100000014AE47E17A14EFBF050199335BEFBFBD, '459'),
	('DTQ11', 'Làng dệt thổ cẩm Mỹ Nghiệp </br> “Làng nghề truyền thống của người Chăm”', 'detthocam.jpg', _binary 0x0000000001010000009E45EF54C0BDEFBF96AD513307000060, '461'),
	('DTQ12', 'Vườn Nho Ba Mọi </br> “Cùng tìm hiểu và thưởng thức những trùm nho trĩu quả, mật nho, rượu nho.”', 'VuonNho.jpg', _binary 0x0000000001010000009E45EF54C0BDEFBFBA0A474A03000060, '461'),
	('DTQ13', 'Vịnh Vĩnh Hy </br> “Một trong bốn Vịnh đẹp nhất Việt Nam. Một vẻ đẹp nguyên sơ và tinh khiết đến ngỡ ngàng. Màu xanh của biển, của những cánh rừng bạt ngàn,…”', 'VinhVinhHy.jpg', _binary 0x0000000001010000009E45EF54C0BDEFBF92CB7F48BF3D2740, '461'),
	('DTQ14', 'Tháp PôKlong Garai </br> “Tháp được xây dựng từ thế kỷ XIII để thờ vị vua Chăm PôKlong Garai trị vì xứ Panduranga (Ninh Thuận ngày nay)”', 'ThapPoKlong.jpg', _binary 0x00000000010100000040A4DFBE0E3C274083C0CAA1453E5B40, '461'),
	('DTQ16', 'Tham quan khu Giếng Trời </br> “Quý khách tự luộc trứng gà bằng nước khoáng 82 0C, dùng trứng chín lòng đào, thơm ngon, bổ dưỡng (chi phí luộc trứng tự túc).”', 'GiengTroi.jpg', _binary 0x00000000010100000036C3392C37EFBFBD392255A3FF3F2BEF, '75'),
	('DTQ17', 'Thích ca Phật Đài </br> “Là một trong những ngôi chùa lớn nhất ở Vũng Tàu.”', 'ThichCaPhat.jpg', _binary 0x0000000001010000006885DA2413EFBFBD8593D486FDEEBFBD, '75'),
	('DTQ19', 'Khu du lịch Hồ Mây </br> “Quý khách sẽ được ngắm nhìn cảnh đẹp trên sườn núi Lớn và tham quan: Vườn hoa, thác nhân tạo, tham gia các trò vui chơi giải trí, chiêm ngưỡng tượng phật Di Lặc lớn thứ 2 tại Việt Nam”', 'HoMay.jpg', _binary 0x000000000101000000CCFBB0DDC4BD1CEFBA0A474A03000060, '75'),
	('DTQ20', 'Phố cổ Hà Nội </br> “Phố cổ Hà Nội nằm ở phía Tây và phía Bắc của Hồ Hoàn Kiếm, là nơi tập trung đông dân cư sinh sống có 36 phố phường. Mỗi con phố ở đây chủ yếu tập trung bán một loại mặt hàng nhất định. Lang thang ở khu phố và thưởng thức ẩm thực ', 'VuonNho.jpg', _binary 0x000000000101000000AD4D0BF6BCDCB524DB2D6EDD07D7A358, '216'),
	('DTQ22', 'Đồi Cát Bay </br> “Ngắm cảnh hoàng hôn trên đồi cát, thưởng thức đặc sản “Dừa ba nhát””', 'DoiCatBay.jpg', _binary 0x000000000101000000B7A61919C0BD36EF2E7D592C000000EF, '109'),
	('DTQ23', 'KDL Bàu Sen - Bàu Trắng </br> “Chiêm ngưỡng toàn cảnh hồ nước ngọt mênh mông, xanh thẳm được bao bọc bởi những đồi cát trắng mịn.”', 'BauSenBauTrang.jpg', _binary 0x0000000001010000002D69E6603EEFBFBD8593D486FDEEBFBD, '109'),
	('DTQ24', 'Lâu đài rượu </br> “Nằm trong khu nghỉ dưỡng của Sea Links City. Quý khách sẽ cảm nhận được không gian rộng lớn và tráng lệ, khám phá thế giới rượu vang.”', 'LauDaiRuou.jpg', _binary 0x0000000001010000005B68BAE4EEBFBDEF5B68BAE4EEBFBDEF, '109'),
	('DTQ25', 'Thác Pren </br> “Thác nước đẹp nằm ở cửa ngỏ vào Đà Lạt”', 'LangDetThoCam.jpg', _binary 0x00000000010100000014AE47E17A14EFBF050199335BEFBFBD, '459');
/*!40000 ALTER TABLE `diemthamquan` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.diemthamquan_dacsan
CREATE TABLE IF NOT EXISTS `diemthamquan_dacsan` (
  `madiemthamquan` varchar(50) NOT NULL,
  `madacsan` varchar(50) NOT NULL,
  PRIMARY KEY (`madiemthamquan`,`madacsan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table quanlytourdulich.diemthamquan_dacsan: ~12 rows (approximately)
/*!40000 ALTER TABLE `diemthamquan_dacsan` DISABLE KEYS */;
INSERT INTO `diemthamquan_dacsan` (`madiemthamquan`, `madacsan`) VALUES
	('DTQ01', 'DS01'),
	('DTQ01', 'DS02'),
	('DTQ01', 'DS04'),
	('DTQ01', 'DS07'),
	('DTQ02', 'DS04'),
	('DTQ02', 'DS06'),
	('DTQ23', 'DS01'),
	('DTQ23', 'DS02'),
	('DTQ23', 'DS03'),
	('DTQ23', 'DS04'),
	('DTQ23', 'DS05'),
	('DTQ23', 'DS06');
/*!40000 ALTER TABLE `diemthamquan_dacsan` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.ledgers
CREATE TABLE IF NOT EXISTS `ledgers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `recordable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recordable_id` bigint(20) unsigned NOT NULL,
  `context` tinyint(3) unsigned NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pivot` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ledgers_recordable_type_recordable_id_index` (`recordable_type`,`recordable_id`),
  KEY `ledgers_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.ledgers: ~3 rows (approximately)
/*!40000 ALTER TABLE `ledgers` DISABLE KEYS */;
INSERT INTO `ledgers` (`id`, `user_type`, `user_id`, `recordable_type`, `recordable_id`, `context`, `event`, `properties`, `modified`, `pivot`, `extra`, `url`, `ip_address`, `user_agent`, `signature`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\Auth\\User', 1, 'App\\Models\\Auth\\User', 1, 4, 'updated', '{"id":1,"uuid":"64fc11ac-bec8-4032-8d0f-c3fb530ac6d0","first_name":"Super","last_name":"Admin","email":"admin@admin.com","avatar_type":"gravatar","avatar_location":null,"password":"$2y$10$Y4IHf3GfBHe\\/o7x7FVgXMulyqr4GE5SHpfNhTSk8vgF47ZHwE\\/QMK","password_changed_at":null,"active":1,"confirmation_code":"ebc51d1224006d77d7aa583d32086bc9","confirmed":1,"timezone":null,"last_login_at":null,"last_login_ip":null,"to_be_logged_out":0,"remember_token":"Cw9eaLP4oL6JJ3LVqXKSjG0oFhtmHIg74ZyPKIm70lsyb1OohY0PGeeU71IA","created_at":"2020-01-17 14:51:11","updated_at":"2020-01-17 14:51:11","deleted_at":null}', '["remember_token"]', '[]', '[]', 'http://quanlytourdulich.local/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'a768dead5c64c56f89ba7bfcf594fa7bde228696e27b2f765e4bdb130017cab6a1ae35127c2c0a91462eb9d34a5f28b901bb45e618ea475c056d852735725fed', '2020-01-17 14:56:26', '2020-01-17 14:56:26'),
	(2, 'App\\Models\\Auth\\User', 1, 'App\\Models\\Auth\\User', 1, 4, 'updated', '{"id":1,"uuid":"64fc11ac-bec8-4032-8d0f-c3fb530ac6d0","first_name":"Super","last_name":"Admin","email":"admin@admin.com","avatar_type":"gravatar","avatar_location":null,"password":"$2y$10$Y4IHf3GfBHe\\/o7x7FVgXMulyqr4GE5SHpfNhTSk8vgF47ZHwE\\/QMK","password_changed_at":null,"active":1,"confirmation_code":"ebc51d1224006d77d7aa583d32086bc9","confirmed":1,"timezone":"America\\/New_York","last_login_at":"2020-01-17 14:56:26","last_login_ip":"127.0.0.1","to_be_logged_out":0,"remember_token":"Cw9eaLP4oL6JJ3LVqXKSjG0oFhtmHIg74ZyPKIm70lsyb1OohY0PGeeU71IA","created_at":"2020-01-17 14:51:11","updated_at":"2020-01-17 14:56:26","deleted_at":null}', '["timezone","last_login_at","last_login_ip","updated_at"]', '[]', '[]', 'http://quanlytourdulich.local/login', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'caa8df7f1e00e4a9288abc8562e1632b7146023514914b805dcb63d1c480b27517cbae767d004d17973d55d406e24ff221be1c58bdfb8e22069b8886307992d5', '2020-01-17 14:56:26', '2020-01-17 14:56:26'),
	(3, 'App\\Models\\Auth\\User', 1, 'App\\Models\\Auth\\User', 1, 4, 'updated', '{"id":1,"uuid":"64fc11ac-bec8-4032-8d0f-c3fb530ac6d0","first_name":"Super","last_name":"Admin","email":"admin@admin.com","avatar_type":"gravatar","avatar_location":null,"password":"$2y$10$Y4IHf3GfBHe\\/o7x7FVgXMulyqr4GE5SHpfNhTSk8vgF47ZHwE\\/QMK","password_changed_at":null,"active":1,"confirmation_code":"ebc51d1224006d77d7aa583d32086bc9","confirmed":1,"timezone":"America\\/New_York","last_login_at":"2020-01-17 14:56:26","last_login_ip":"127.0.0.1","to_be_logged_out":0,"remember_token":"P4l3nGVqwMToDyS8foYrWxtoSFIDbhkJQDCOzSYqUyz9xaK4AQNIVW8547aa","created_at":"2020-01-17 14:51:11","updated_at":"2020-01-17 14:56:26","deleted_at":null}', '["remember_token"]', '[]', '[]', 'http://quanlytourdulich.local/logout', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '58c18de8360a03dc61cc63e33b6b77c468e071bb8c1839aa15655e7c29219e49c1e5114bf555ab66eb6461d14ac77d6985117e6308667cd4618e8e07e65f8247', '2020-01-17 15:02:11', '2020-01-17 15:02:11');
/*!40000 ALTER TABLE `ledgers` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.migrations: ~10 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_09_03_144628_create_permission_tables', 1),
	(4, '2017_09_11_174816_create_social_accounts_table', 1),
	(5, '2017_09_26_140332_create_cache_table', 1),
	(6, '2017_09_26_140528_create_sessions_table', 1),
	(7, '2017_09_26_140609_create_jobs_table', 1),
	(8, '2018_04_08_033256_create_password_histories_table', 1),
	(9, '2018_11_21_000001_create_ledgers_table', 1),
	(10, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.model_has_roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\Auth\\User', 1),
	(2, 'App\\Models\\Auth\\User', 2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.password_histories
CREATE TABLE IF NOT EXISTS `password_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `password_histories_user_id_foreign` (`user_id`),
  CONSTRAINT `password_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.password_histories: ~2 rows (approximately)
/*!40000 ALTER TABLE `password_histories` DISABLE KEYS */;
INSERT INTO `password_histories` (`id`, `user_id`, `password`, `created_at`, `updated_at`) VALUES
	(1, 1, '$2y$10$Y4IHf3GfBHe/o7x7FVgXMulyqr4GE5SHpfNhTSk8vgF47ZHwE/QMK', '2020-01-17 14:51:11', '2020-01-17 14:51:11'),
	(2, 2, '$2y$10$C908xiSx/mRaG6OTmdqsRumjI4g6BuB/VJ.vYU.igDzBL9ISvC00q', '2020-01-17 14:51:11', '2020-01-17 14:51:11');
/*!40000 ALTER TABLE `password_histories` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.permissions: ~1 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view backend', 'web', '2020-01-17 14:51:11', '2020-01-17 14:51:11');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'web', '2020-01-17 14:51:11', '2020-01-17 14:51:11'),
	(2, 'user', 'web', '2020-01-17 14:51:11', '2020-01-17 14:51:11');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.role_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.social_accounts
CREATE TABLE IF NOT EXISTS `social_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.social_accounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.tourdulich
CREATE TABLE IF NOT EXISTS `tourdulich` (
  `matour` varchar(50) NOT NULL,
  `tentour` varchar(250) NOT NULL,
  `giatour_nguoilon` double NOT NULL,
  `giatour_treem` double NOT NULL,
  `diemkhoihanh_ten` varchar(250) NOT NULL,
  `diemkhoihanh_idhuyen` varchar(50) NOT NULL,
  `diemkhoihanh_toado` point NOT NULL,
  `diemden_ten` varchar(250) NOT NULL,
  `diemden_idhuyen` varchar(50) NOT NULL,
  `diemden_toado` point NOT NULL,
  `songaytour` varchar(100) NOT NULL,
  `hinhanh` varchar(300) NOT NULL,
  PRIMARY KEY (`matour`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table quanlytourdulich.tourdulich: ~8 rows (approximately)
/*!40000 ALTER TABLE `tourdulich` DISABLE KEYS */;
INSERT INTO `tourdulich` (`matour`, `tentour`, `giatour_nguoilon`, `giatour_treem`, `diemkhoihanh_ten`, `diemkhoihanh_idhuyen`, `diemkhoihanh_toado`, `diemden_ten`, `diemden_idhuyen`, `diemden_toado`, `songaytour`, `hinhanh`) VALUES
	('TDL01', 'Đà Lạt – Thành phố ngàn hoa', 3500000, 1750000, 'Bến Ninh Kiều', '180', _binary 0x00000000010100000041F163CC5D4BEFBF34F6FCE0444772EF, 'Chợ Đà Lạt', '376', _binary 0x0000000001010000009E45EF54C0BDEFBF39622D3E05000040, '4 ngày 4 đêm', 'Tourdalat1.jpg'),
	('TDL02', 'Ninh Chữ - Đà Lạt', 3000000, 1800000, 'Sa Đéc', '25', _binary 0x000000000101000000230F939545EFBFBDB03DB324404DEFBF, 'Ninh Chữ', '461', _binary 0x0000000001010000009E45EF54C0BDEFBF7D0A7D99040000EF, '4 ngày 4 đêm', 'NinhChu.jpg'),
	('TDL03', 'Bình Châu – Long Hải – Vũng Tàu', 2500000, 1750000, 'Cờ Đỏ', '179', _binary 0x000000000101000000A200FE47C1BD332488855AD3BC63EFBF, 'Vũng Tàu', '75', _binary 0x0000000001010000009E45EF54C0BDEFBFC6EAFBDA214013EF, '3 ngày 3 đêm', 'VungTau1.jpg'),
	('TDL04', 'Vũng Tàu – Long Sơn', 1500000, 500000, 'Vĩnh Long', '653', _binary 0x00000000010100000099CD61033C795848230F939545EFBFBD, 'Vũng Tàu', '71', _binary 0x00000000010100000059E3ED22BFBD2C7A000000000000EFBF, '2 ngày 1 đêm', 'VungTau2.jpg'),
	('TDL05', 'Cần Thơ – Phan Thiết', 1500000, 500000, 'Thới Lai', '176', _binary 0x0000000001010000005E2B87591AEFBFBD9680EC7CECBFBD68, 'Phan Thiết', '109', _binary 0x00000000010100000036C3392C37EFBFBD7D519B38FF3F3E13, '2 ngày 1 đêm', 'PhanThiet.jpg'),
	('TDL07', 'Hội An – Đà Nẵng – Huế', 5000000, 1500000, 'Tp. Trà Vinh', '645', _binary 0x0000000001010000009E45EF54C0BDEFBF32E2FA3722406BEF, 'Tp. Huế', '595', _binary 0x000000000101000000DB104BEDF1BFBD2F166877483140EFBF, '4 ngày 4 đêm', 'Hue.jpg'),
	('TDL08', 'Đà Nẵng – Hải Phòng', 5000000, 1500000, 'An Giang', '63', _binary 0x00000000010100000005A3923A014DEFBF868BBA5D234032EF, 'Bãi Biển Đồ Sơn', '316', _binary 0x0000000001010000004A77E0C228EFBFBD8593D486FDEEBFBD, '4 ngày 4 đêm', 'haiphong.jpg'),
	('TDL09', 'Ninh Chữ - Đà Lạt-Hà Nội', 6000000, 6000000, 'cái bè', '628', _binary 0x000000000101000000999AA54F705F07EF31CCD27F11143FEF, 'hồ gươm', '223', _binary 0x00000000010100000010DC32B3F1BFBD0B4450357A3540EFBF, '4 ngày 4 đêm', 'ThienVienTrucLam.jpg');
/*!40000 ALTER TABLE `tourdulich` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.tourdulich_diemthamquan
CREATE TABLE IF NOT EXISTS `tourdulich_diemthamquan` (
  `matour` varchar(50) NOT NULL,
  `madiemthamquan` varchar(50) NOT NULL,
  PRIMARY KEY (`matour`,`madiemthamquan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table quanlytourdulich.tourdulich_diemthamquan: ~46 rows (approximately)
/*!40000 ALTER TABLE `tourdulich_diemthamquan` DISABLE KEYS */;
INSERT INTO `tourdulich_diemthamquan` (`matour`, `madiemthamquan`) VALUES
	('TDL01', 'DTQ01'),
	('TDL01', 'DTQ02'),
	('TDL01', 'DTQ03'),
	('TDL01', 'DTQ04'),
	('TDL01', 'DTQ06'),
	('TDL01', 'DTQ07'),
	('TDL01', 'DTQ08'),
	('TDL02', 'DTQ03'),
	('TDL02', 'DTQ07'),
	('TDL02', 'DTQ09'),
	('TDL02', 'DTQ10'),
	('TDL02', 'DTQ13'),
	('TDL02', 'DTQ14'),
	('TDL02', 'DTQ23'),
	('TDL02', 'DTQ24'),
	('TDL03', 'DTQ01'),
	('TDL03', 'DTQ02'),
	('TDL03', 'DTQ06'),
	('TDL03', 'DTQ07'),
	('TDL03', 'DTQ10'),
	('TDL03', 'DTQ11'),
	('TDL04', 'DTQ01'),
	('TDL04', 'DTQ02'),
	('TDL04', 'DTQ03'),
	('TDL04', 'DTQ04'),
	('TDL04', 'DTQ08'),
	('TDL04', 'DTQ10'),
	('TDL04', 'DTQ14'),
	('TDL04', 'DTQ17'),
	('TDL04', 'DTQ19'),
	('TDL04', 'DTQ23'),
	('TDL05', 'DTQ02'),
	('TDL05', 'DTQ03'),
	('TDL05', 'DTQ04'),
	('TDL05', 'DTQ08'),
	('TDL05', 'DTQ12'),
	('TDL07', 'DTQ01'),
	('TDL07', 'DTQ07'),
	('TDL07', 'DTQ11'),
	('TDL07', 'DTQ22'),
	('TDL07', 'DTQ25'),
	('TDL08', 'DTQ02'),
	('TDL08', 'DTQ03'),
	('TDL08', 'DTQ07'),
	('TDL08', 'DTQ09'),
	('TDL08', 'DTQ12');
/*!40000 ALTER TABLE `tourdulich_diemthamquan` ENABLE KEYS */;

-- Dumping structure for table quanlytourdulich.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gravatar',
  `avatar_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `confirmation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_be_logged_out` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table quanlytourdulich.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `uuid`, `first_name`, `last_name`, `email`, `avatar_type`, `avatar_location`, `password`, `password_changed_at`, `active`, `confirmation_code`, `confirmed`, `timezone`, `last_login_at`, `last_login_ip`, `to_be_logged_out`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '64fc11ac-bec8-4032-8d0f-c3fb530ac6d0', 'Super', 'Admin', 'admin@admin.com', 'gravatar', NULL, '$2y$10$Y4IHf3GfBHe/o7x7FVgXMulyqr4GE5SHpfNhTSk8vgF47ZHwE/QMK', NULL, 1, 'ebc51d1224006d77d7aa583d32086bc9', 1, 'America/New_York', '2020-01-17 14:56:26', '127.0.0.1', 0, 'P4l3nGVqwMToDyS8foYrWxtoSFIDbhkJQDCOzSYqUyz9xaK4AQNIVW8547aa', '2020-01-17 14:51:11', '2020-01-17 14:56:26', NULL),
	(2, '0dd1caa0-817f-496d-8ee8-cb1ec486434f', 'Default', 'User', 'user@user.com', 'gravatar', NULL, '$2y$10$C908xiSx/mRaG6OTmdqsRumjI4g6BuB/VJ.vYU.igDzBL9ISvC00q', NULL, 1, 'e948141ecf4274833d4aca11b00b50ce', 1, NULL, NULL, NULL, 0, NULL, '2020-01-17 14:51:11', '2020-01-17 14:51:11', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
