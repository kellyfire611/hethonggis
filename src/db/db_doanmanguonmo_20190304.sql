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

-- Dumping structure for table doanmanguonmo.activations
CREATE TABLE IF NOT EXISTS `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.activations: ~1 rows (approximately)
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'k5wATywmKlgJGNEJbcoYyKhFbmwMo8ca', 1, '2019-03-03 21:48:43', '2019-03-03 21:48:43', '2019-03-03 21:48:43');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.dashboard__widgets
CREATE TABLE IF NOT EXISTS `dashboard__widgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `widgets` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard__widgets_user_id_foreign` (`user_id`),
  CONSTRAINT `dashboard__widgets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.dashboard__widgets: ~0 rows (approximately)
/*!40000 ALTER TABLE `dashboard__widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard__widgets` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.media__files
CREATE TABLE IF NOT EXISTS `media__files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_folder` tinyint(1) NOT NULL DEFAULT '0',
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mimetype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filesize` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.media__files: ~0 rows (approximately)
/*!40000 ALTER TABLE `media__files` DISABLE KEYS */;
/*!40000 ALTER TABLE `media__files` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.media__file_translations
CREATE TABLE IF NOT EXISTS `media__file_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_attribute` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media__file_translations_file_id_locale_unique` (`file_id`,`locale`),
  KEY `media__file_translations_locale_index` (`locale`),
  CONSTRAINT `media__file_translations_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `media__files` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.media__file_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `media__file_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `media__file_translations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.media__imageables
CREATE TABLE IF NOT EXISTS `media__imageables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.media__imageables: ~0 rows (approximately)
/*!40000 ALTER TABLE `media__imageables` DISABLE KEYS */;
/*!40000 ALTER TABLE `media__imageables` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.menu__menuitems
CREATE TABLE IF NOT EXISTS `menu__menuitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `page_id` int(10) unsigned DEFAULT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `target` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'page',
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `module_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_root` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu__menuitems_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu__menuitems_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu__menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.menu__menuitems: ~0 rows (approximately)
/*!40000 ALTER TABLE `menu__menuitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu__menuitems` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.menu__menuitem_translations
CREATE TABLE IF NOT EXISTS `menu__menuitem_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menuitem_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu__menuitem_translations_menuitem_id_locale_unique` (`menuitem_id`,`locale`),
  KEY `menu__menuitem_translations_locale_index` (`locale`),
  CONSTRAINT `menu__menuitem_translations_menuitem_id_foreign` FOREIGN KEY (`menuitem_id`) REFERENCES `menu__menuitems` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.menu__menuitem_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `menu__menuitem_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu__menuitem_translations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.menu__menus
CREATE TABLE IF NOT EXISTS `menu__menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.menu__menus: ~0 rows (approximately)
/*!40000 ALTER TABLE `menu__menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu__menus` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.menu__menu_translations
CREATE TABLE IF NOT EXISTS `menu__menu_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu__menu_translations_menu_id_locale_unique` (`menu_id`,`locale`),
  KEY `menu__menu_translations_locale_index` (`locale`),
  CONSTRAINT `menu__menu_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu__menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.menu__menu_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `menu__menu_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu__menu_translations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.migrations: ~32 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_07_02_230147_migration_cartalyst_sentinel', 1),
	(2, '2016_06_24_193447_create_user_tokens_table', 1),
	(3, '2014_10_14_200250_create_settings_table', 2),
	(4, '2014_10_15_191204_create_setting_translations_table', 2),
	(5, '2015_06_18_170048_make_settings_value_text_field', 2),
	(6, '2015_10_22_130947_make_settings_name_unique', 2),
	(7, '2017_09_17_164631_make_setting_value_nullable', 2),
	(8, '2014_11_03_160015_create_menus_table', 3),
	(9, '2014_11_03_160138_create_menu-translations_table', 3),
	(10, '2014_11_03_160753_create_menuitems_table', 3),
	(11, '2014_11_03_160804_create_menuitem_translation_table', 3),
	(12, '2014_12_17_185301_add_root_column_to_menus_table', 3),
	(13, '2015_09_05_100142_add_icon_column_to_menuitems_table', 3),
	(14, '2016_01_26_102307_update_icon_column_on_menuitems_table', 3),
	(15, '2016_08_01_142345_add_link_type_colymn_to_menuitems_table', 3),
	(16, '2016_08_01_143130_add_class_column_to_menuitems_table', 3),
	(17, '2017_09_18_192639_make_title_field_nullable_menu_table', 3),
	(18, '2014_10_26_162751_create_files_table', 4),
	(19, '2014_10_26_162811_create_file_translations_table', 4),
	(20, '2015_02_27_105241_create_image_links_table', 4),
	(21, '2015_12_19_143643_add_sortable', 4),
	(22, '2017_09_20_144631_add_folders_columns_on_files_table', 4),
	(23, '2014_11_30_191858_create_pages_tables', 5),
	(24, '2017_10_13_103344_make_status_field_nullable_on_page_translations_table', 5),
	(25, '2018_05_23_145242_edit_body_column_nullable', 5),
	(26, '2015_04_02_184200_create_widgets_table', 6),
	(27, '2013_04_09_062329_create_revisions_table', 7),
	(28, '2015_11_20_184604486385_create_translation_translations_table', 7),
	(29, '2015_11_20_184604743083_create_translation_translation_translations_table', 7),
	(30, '2015_12_01_094031_update_translation_translations_table_with_index', 7),
	(31, '2016_07_12_181155032011_create_tag_tags_table', 8),
	(32, '2016_07_12_181155289444_create_tag_tag_translations_table', 8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.page__pages
CREATE TABLE IF NOT EXISTS `page__pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  `template` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.page__pages: ~1 rows (approximately)
/*!40000 ALTER TABLE `page__pages` DISABLE KEYS */;
INSERT INTO `page__pages` (`id`, `is_home`, `template`, `created_at`, `updated_at`) VALUES
	(1, 1, 'home', '2019-03-03 21:48:50', '2019-03-03 21:48:50');
/*!40000 ALTER TABLE `page__pages` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.page__page_translations
CREATE TABLE IF NOT EXISTS `page__page_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `body` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page__page_translations_page_id_locale_unique` (`page_id`,`locale`),
  KEY `page__page_translations_locale_index` (`locale`),
  CONSTRAINT `page__page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `page__pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.page__page_translations: ~1 rows (approximately)
/*!40000 ALTER TABLE `page__page_translations` DISABLE KEYS */;
INSERT INTO `page__page_translations` (`id`, `page_id`, `locale`, `title`, `slug`, `status`, `body`, `meta_title`, `meta_description`, `og_title`, `og_description`, `og_image`, `og_type`, `created_at`, `updated_at`) VALUES
	(1, 1, 'en', 'Home page', 'home', '1', '<p><strong>You made it!</strong></p>\n<p>You&#39;ve installed AsgardCMS and are ready to proceed to the <a href="/en/backend">administration area</a>.</p>\n<h2>What&#39;s next ?</h2>\n<p>Learn how you can develop modules for AsgardCMS by reading our <a href="https://github.com/AsgardCms/Documentation">documentation</a>.</p>\n', 'Home page', NULL, NULL, NULL, NULL, NULL, '2019-03-03 21:48:50', '2019-03-03 21:48:50');
/*!40000 ALTER TABLE `page__page_translations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.persistences
CREATE TABLE IF NOT EXISTS `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.persistences: ~0 rows (approximately)
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;
INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
	(1, 1, 'rTCDSOeV7FUkDRZA4nDgdzUd3I0Y5t1n', '2019-03-03 22:00:05', '2019-03-03 22:00:05');
/*!40000 ALTER TABLE `persistences` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.reminders
CREATE TABLE IF NOT EXISTS `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.reminders: ~0 rows (approximately)
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.revisions
CREATE TABLE IF NOT EXISTS `revisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.revisions: ~0 rows (approximately)
/*!40000 ALTER TABLE `revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `revisions` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Admin', '{"core.sidebar.group":true,"dashboard.index":true,"dashboard.update":true,"dashboard.reset":true,"workshop.sidebar.group":true,"workshop.modules.index":true,"workshop.modules.show":true,"workshop.modules.update":true,"workshop.modules.disable":true,"workshop.modules.enable":true,"workshop.modules.publish":true,"workshop.themes.index":true,"workshop.themes.show":true,"workshop.themes.publish":true,"user.roles.index":true,"user.roles.create":true,"user.roles.edit":true,"user.roles.destroy":true,"user.users.index":true,"user.users.create":true,"user.users.edit":true,"user.users.destroy":true,"account.api-keys.index":true,"account.api-keys.create":true,"account.api-keys.destroy":true,"menu.menus.index":true,"menu.menus.create":true,"menu.menus.edit":true,"menu.menus.destroy":true,"menu.menuitems.index":true,"menu.menuitems.create":true,"menu.menuitems.edit":true,"menu.menuitems.destroy":true,"media.medias.index":true,"media.medias.create":true,"media.medias.edit":true,"media.medias.destroy":true,"media.folders.index":true,"media.folders.create":true,"media.folders.edit":true,"media.folders.destroy":true,"setting.settings.index":true,"setting.settings.edit":true,"page.pages.index":true,"page.pages.create":true,"page.pages.edit":true,"page.pages.destroy":true,"translation.translations.index":true,"translation.translations.edit":true,"translation.translations.export":true,"translation.translations.import":true,"tag.tags.index":true,"tag.tags.create":true,"tag.tags.edit":true,"tag.tags.destroy":true}', '2019-03-03 21:48:13', '2019-03-03 21:48:13'),
	(2, 'user', 'User', NULL, '2019-03-03 21:48:13', '2019-03-03 21:48:13');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.role_users
CREATE TABLE IF NOT EXISTS `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.role_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2019-03-03 21:48:43', '2019-03-03 21:48:43');
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.setting__settings
CREATE TABLE IF NOT EXISTS `setting__settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plainValue` text COLLATE utf8mb4_unicode_ci,
  `isTranslatable` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting__settings_name_unique` (`name`),
  KEY `setting__settings_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.setting__settings: ~2 rows (approximately)
/*!40000 ALTER TABLE `setting__settings` DISABLE KEYS */;
INSERT INTO `setting__settings` (`id`, `name`, `plainValue`, `isTranslatable`, `created_at`, `updated_at`) VALUES
	(1, 'core::template', 'Flatly', 0, '2019-03-03 21:48:50', '2019-03-03 21:48:50'),
	(2, 'core::locales', '["en"]', 0, '2019-03-03 21:48:50', '2019-03-03 21:48:50');
/*!40000 ALTER TABLE `setting__settings` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.setting__setting_translations
CREATE TABLE IF NOT EXISTS `setting__setting_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting__setting_translations_setting_id_locale_unique` (`setting_id`,`locale`),
  KEY `setting__setting_translations_locale_index` (`locale`),
  CONSTRAINT `setting__setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `setting__settings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.setting__setting_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `setting__setting_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `setting__setting_translations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.tag__tagged
CREATE TABLE IF NOT EXISTS `tag__tagged` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag__tagged_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.tag__tagged: ~0 rows (approximately)
/*!40000 ALTER TABLE `tag__tagged` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag__tagged` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.tag__tags
CREATE TABLE IF NOT EXISTS `tag__tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `namespace` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.tag__tags: ~0 rows (approximately)
/*!40000 ALTER TABLE `tag__tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag__tags` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.tag__tag_translations
CREATE TABLE IF NOT EXISTS `tag__tag_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag__tag_translations_tag_id_locale_unique` (`tag_id`,`locale`),
  KEY `tag__tag_translations_locale_index` (`locale`),
  CONSTRAINT `tag__tag_translations_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tag__tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.tag__tag_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `tag__tag_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag__tag_translations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.throttle
CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.throttle: ~0 rows (approximately)
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.translation__translations
CREATE TABLE IF NOT EXISTS `translation__translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `translation__translations_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.translation__translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `translation__translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translation__translations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.translation__translation_translations
CREATE TABLE IF NOT EXISTS `translation__translation_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation_id` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_trans_id_locale_unique` (`translation_id`,`locale`),
  KEY `translation__translation_translations_locale_index` (`locale`),
  CONSTRAINT `translation__translation_translations_translation_id_foreign` FOREIGN KEY (`translation_id`) REFERENCES `translation__translations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.translation__translation_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `translation__translation_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translation__translation_translations` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin@manguonmo.com', '$2y$10$es9sIUhgtf7KafFxH9c8gOCJnnmQOwUsMdV.A4JVokJvS1Wrp7yGC', NULL, '2019-03-03 22:00:05', 'Admin', 'Istrator', '2019-03-03 21:48:43', '2019-03-03 22:00:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table doanmanguonmo.user_tokens
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `access_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_tokens_access_token_unique` (`access_token`),
  KEY `user_tokens_user_id_foreign` (`user_id`),
  CONSTRAINT `user_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doanmanguonmo.user_tokens: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_tokens` DISABLE KEYS */;
INSERT INTO `user_tokens` (`id`, `user_id`, `access_token`, `created_at`, `updated_at`) VALUES
	(1, 1, '38daaa07-ed06-4bbe-a9f2-5abdb0e73173', '2019-03-03 21:48:44', '2019-03-03 21:48:44');
/*!40000 ALTER TABLE `user_tokens` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
