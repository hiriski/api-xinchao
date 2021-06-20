-- Adminer 4.8.0 MySQL 5.5.5-10.4.18-MariaDB-1:10.4.18+maria~bionic dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `colors` (`id`, `value`) VALUES
(1,	'#ff4564'),
(2,	'#6e00ff'),
(3,	'#00b15e'),
(4,	'#faad00'),
(5,	'#707070'),
(6,	'#518ef8'),
(7,	'#28b446'),
(8,	'#ffa700');

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE `conversations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_type` enum('private','group') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `conversations_channel_id_unique` (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `conversations` (`id`, `channel_id`, `conversation_type`, `created_at`, `updated_at`) VALUES
(3,	'UTM_1621011098',	'private',	'2021-05-14 23:51:38',	'2021-05-14 23:51:38'),
(4,	'Ms0_1621255919',	'private',	'2021-05-17 19:51:59',	'2021-05-17 19:51:59'),
(5,	'KlO_1621255937',	'private',	'2021-05-17 19:52:17',	'2021-05-17 19:52:17'),
(6,	'KkO_1621565165',	'private',	'2021-05-21 09:46:05',	'2021-05-21 09:46:05'),
(7,	'nfk_1623072010',	'private',	'2021-06-07 20:20:10',	'2021-06-07 20:20:10');

DROP TABLE IF EXISTS `conversation_to_user`;
CREATE TABLE `conversation_to_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `conversation_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `conversation_to_user` (`id`, `user_id`, `conversation_id`, `created_at`, `updated_at`) VALUES
(3,	4,	3,	NULL,	NULL),
(4,	1,	3,	NULL,	NULL),
(5,	4,	4,	NULL,	NULL),
(6,	3,	4,	NULL,	NULL),
(7,	4,	5,	NULL,	NULL),
(8,	3,	5,	NULL,	NULL),
(9,	1,	6,	NULL,	NULL),
(10,	6,	6,	NULL,	NULL),
(11,	6,	7,	NULL,	NULL),
(12,	7,	7,	NULL,	NULL);

DROP TABLE IF EXISTS `discussions`;
CREATE TABLE `discussions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hits` bigint(20) unsigned NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `topic_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discussions_user_id_foreign` (`user_id`),
  KEY `discussions_topic_id_foreign` (`topic_id`),
  CONSTRAINT `discussions_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE,
  CONSTRAINT `discussions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `favoritable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favoritable_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_favoritable_type_favoritable_id_index` (`favoritable_type`,`favoritable_id`),
  KEY `favorites_user_id_foreign` (`user_id`),
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `levels` (`id`, `name`, `description`) VALUES
(1,	'Level 1',	NULL),
(2,	'Level 2',	NULL),
(3,	'Level 3',	NULL),
(4,	'Level 4',	NULL),
(5,	'Level 5',	NULL);

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint(20) unsigned NOT NULL,
  `sender_id` bigint(20) unsigned NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `text`, `caption`, `audio_url`, `image_url`, `created_at`, `updated_at`) VALUES
(3,	3,	1,	'Xin Chào 👋',	NULL,	NULL,	NULL,	'2021-05-14 23:51:38',	'2021-05-14 23:51:38'),
(4,	3,	1,	'Hello kang',	NULL,	NULL,	NULL,	'2021-05-14 23:51:43',	'2021-05-14 23:51:43'),
(5,	3,	4,	'Halo cuk',	NULL,	NULL,	NULL,	'2021-05-14 23:57:48',	'2021-05-14 23:57:48'),
(6,	3,	1,	'What the fuck',	NULL,	NULL,	NULL,	'2021-05-14 23:58:22',	'2021-05-14 23:58:22'),
(7,	3,	1,	'Ckckckc',	NULL,	NULL,	NULL,	'2021-05-14 23:58:34',	'2021-05-14 23:58:34'),
(8,	3,	1,	'Hello world',	NULL,	NULL,	NULL,	'2021-05-15 10:50:53',	'2021-05-15 10:50:53'),
(9,	3,	1,	'Hbzbz',	NULL,	NULL,	NULL,	'2021-05-15 10:51:17',	'2021-05-15 10:51:17'),
(10,	3,	1,	'Nabzjab',	NULL,	NULL,	NULL,	'2021-05-15 10:51:19',	'2021-05-15 10:51:19'),
(11,	4,	3,	'Xin Chào 👋',	NULL,	NULL,	NULL,	'2021-05-17 19:51:59',	'2021-05-17 19:51:59'),
(12,	4,	3,	'Hsmsbsj',	NULL,	NULL,	NULL,	'2021-05-17 19:52:07',	'2021-05-17 19:52:07'),
(13,	4,	3,	'Jasvnsb',	NULL,	NULL,	NULL,	'2021-05-17 19:52:11',	'2021-05-17 19:52:11'),
(14,	5,	3,	'Xin Chào 👋',	NULL,	NULL,	NULL,	'2021-05-17 19:52:17',	'2021-05-17 19:52:17'),
(15,	4,	3,	'hello',	NULL,	NULL,	NULL,	'2021-05-19 12:40:01',	'2021-05-19 12:40:01'),
(16,	4,	3,	'do slnsm',	NULL,	NULL,	NULL,	'2021-05-19 12:40:05',	'2021-05-19 12:40:05'),
(17,	5,	3,	'Hello',	NULL,	NULL,	NULL,	'2021-05-20 23:07:21',	'2021-05-20 23:07:21'),
(18,	6,	6,	'Xin Chào 👋',	NULL,	NULL,	NULL,	'2021-05-21 09:46:05',	'2021-05-21 09:46:05'),
(19,	6,	6,	'hello',	NULL,	NULL,	NULL,	'2021-05-21 09:46:19',	'2021-05-21 09:46:19'),
(20,	6,	6,	'hello world',	NULL,	NULL,	NULL,	'2021-05-21 23:28:51',	'2021-05-21 23:28:51'),
(21,	7,	7,	'Xin Chào 👋',	NULL,	NULL,	NULL,	'2021-06-07 20:20:10',	'2021-06-07 20:20:10'),
(22,	7,	7,	'hello',	NULL,	NULL,	NULL,	'2021-06-07 20:20:17',	'2021-06-07 20:20:17'),
(23,	7,	7,	'bsbsjsbs',	NULL,	NULL,	NULL,	'2021-06-07 20:20:26',	'2021-06-07 20:20:26'),
(24,	7,	7,	'hsbsns',	NULL,	NULL,	NULL,	'2021-06-07 20:20:36',	'2021-06-07 20:20:36'),
(25,	7,	7,	'Oi',	NULL,	NULL,	NULL,	'2021-06-12 14:38:42',	'2021-06-12 14:38:42');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'0000_00_00_000000_create_websockets_statistics_entries_table',	1),
(2,	'2014_10_12_000000_create_users_table',	1),
(3,	'2014_10_12_100000_create_password_resets_table',	1),
(4,	'2019_08_19_000000_create_failed_jobs_table',	1),
(5,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(6,	'2020_09_13_080016_create_phrasebook_categories_table',	1),
(7,	'2020_09_13_093119_create_phrasebooks_table',	1),
(8,	'2020_09_21_013248_create_topics_table',	1),
(9,	'2020_09_21_013550_create_discussions_table',	1),
(10,	'2020_09_21_013827_create_replies_table',	1),
(11,	'2020_09_22_095354_create_favorites_table',	1),
(12,	'2021_04_12_162251_create_social_accounts_table',	1),
(13,	'2021_04_20_223431_create_levels_table',	1),
(14,	'2021_04_20_223658_create_user_statuses_table',	1),
(15,	'2021_05_09_045737_create_colors_table',	1),
(22,	'2021_05_11_195508_create_conversations_table',	2),
(23,	'2021_05_11_195812_create_messages_table',	2),
(24,	'2021_05_12_194754_create_conversation_to_user_table',	2);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(54,	'App\\Models\\User',	1,	'riski',	'55c26ed169731119f81769afc39fe4b4d7ca013b359b3205ed03610d8e7fa8b6',	'[\"*\"]',	NULL,	'2021-06-18 21:51:24',	'2021-06-18 21:51:24'),
(55,	'App\\Models\\User',	1,	'riski',	'93ed93d683aee78940a7d5ff0a30cc54dd74152d1354d1af330f1e3ae5c5676d',	'[\"*\"]',	NULL,	'2021-06-19 01:14:33',	'2021-06-19 01:14:33'),
(56,	'App\\Models\\User',	2,	'heysix',	'25b5c40d7e440c4613c1afc8bde93b20da98c8acd46cad7189c2b69c8c32e449',	'[\"*\"]',	NULL,	'2021-06-19 02:41:25',	'2021-06-19 02:41:25'),
(58,	'App\\Models\\User',	14,	'sampleuser@gmail.com',	'50c30be474d29f4028e8be1d442f306f51197106defd38d0ce92e2fc38bccc31',	'[\"*\"]',	NULL,	'2021-06-19 06:46:52',	'2021-06-19 06:46:52'),
(59,	'App\\Models\\User',	1,	'riski',	'49ed2c955ab07d441ae22869a1612a4265300b79d1dea04ee30c6699b7c01af9',	'[\"*\"]',	NULL,	'2021-06-19 11:07:03',	'2021-06-19 11:07:03'),
(63,	'App\\Models\\User',	1,	'riski',	'a714964325c06a153f453c30fa51f1e5e1ec497eaf92681ab343b54171ed5649',	'[\"*\"]',	'2021-06-19 20:42:46',	'2021-06-19 20:37:08',	'2021-06-19 20:42:46'),
(64,	'App\\Models\\User',	1,	'riski',	'18afc5a3918b239b7517a8af819a0a74750ff5a7823dc55cc4069b4841757811',	'[\"*\"]',	'2021-06-20 14:42:13',	'2021-06-20 01:33:31',	'2021-06-20 14:42:13'),
(65,	'App\\Models\\User',	2,	'heysix',	'17970cf3fcaadb5e7edbb626c3ef8a7ca5d9de922c0d96372451292168930344',	'[\"*\"]',	NULL,	'2021-06-20 13:06:37',	'2021-06-20 13:06:37'),
(66,	'App\\Models\\User',	2,	'heysix@outlook.com',	'4b52c78226f4c534c2808c407e7eafe899d69b386375f250a2f7fb09f181d203',	'[\"*\"]',	'2021-06-20 15:21:58',	'2021-06-20 15:15:44',	'2021-06-20 15:21:58');

DROP TABLE IF EXISTS `phrasebooks`;
CREATE TABLE `phrasebooks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_ID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Bahasa Indonesia',
  `vi_VN` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tiếng Việt',
  `en_US` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(Optional) English',
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL COMMENT 'Creator of this phrase',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'User who renew of this phrase',
  `category_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phrasebooks_created_by_foreign` (`created_by`),
  KEY `phrasebooks_category_id_foreign` (`category_id`),
  CONSTRAINT `phrasebooks_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `phrasebook_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phrasebooks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `phrasebooks` (`id`, `id_ID`, `vi_VN`, `en_US`, `notes`, `created_by`, `updated_by`, `category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	'Halo!',	'Xin chào!',	'Hello!',	'Dikatakan ketika menyapa seseorang.',	1,	NULL,	2,	NULL,	'2021-05-09 14:41:20',	'2021-05-09 14:41:20'),
(2,	'Iya',	'Có',	'Yes',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:48:06',	'2021-05-09 14:48:06'),
(3,	'Tidak',	'Không',	'No',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:48:32',	'2021-05-09 14:48:32'),
(4,	'Terima Kasih',	'Cảm ơn',	'Thanks',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:49:02',	'2021-05-09 14:49:02'),
(5,	'Permisi',	'Làm ơn, rất vui lòng',	'Please',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:49:45',	'2021-05-09 14:49:45'),
(6,	'Tidak masalah',	'Không thành vấn đề',	'Not a problem',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:50:14',	'2021-05-09 14:50:14'),
(7,	'Maaf / Permisi',	'Xin lỗi',	'Sorry / Excuse me',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:50:58',	'2021-05-09 14:50:58'),
(8,	'Maaf',	'Rất tiếc',	'Sorry',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:51:27',	'2021-05-09 14:51:27'),
(9,	'Aku tidak tahu.',	'Tôi không biết.',	'I don\'t know',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:51:54',	'2021-05-09 14:51:54'),
(10,	'Apakah kamu mengerti ?',	'Anh có hiểu tôi không ?',	'Do you understand ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:52:46',	'2021-05-09 14:52:46'),
(11,	'Aku mengerti',	'Tôi hiểu.',	'I understand',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:53:17',	'2021-05-09 14:53:17'),
(12,	'Aku tidak mengerti',	'Tôi không hiểu.',	'I don\'t understand',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 14:53:39',	'2021-05-09 14:53:39'),
(13,	'Sebentar..',	'Chờ một chút.',	'Just a moment.',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:00:26',	'2021-05-09 15:00:26'),
(14,	'Sama-sama',	'Không có gì.',	'You\'re welcome.',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:01:05',	'2021-05-09 15:01:05'),
(15,	'Apa ?',	'Cái gì ?',	'What ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:01:37',	'2021-05-09 15:01:37'),
(16,	'Yang mana ?',	'Cái nào?',	'Which ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:02:12',	'2021-05-09 15:02:12'),
(17,	'Kapan ?',	'Khi nào ?',	'When ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:02:43',	'2021-05-09 15:02:43'),
(18,	'Dimana ?',	'Ở đâu? ?',	'Where ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:03:03',	'2021-05-09 15:03:03'),
(19,	'Kenapa ?',	'Tại sao?',	'Why ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:03:26',	'2021-05-09 15:03:26'),
(20,	'Siapa ?',	'Ai?',	'Who ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:03:45',	'2021-05-09 15:03:45'),
(21,	'Berapa banyak ?',	'Bao nhiêu ?',	'How many ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:04:13',	'2021-05-09 15:04:13'),
(22,	'Berapa ?',	'Bao nhiêu?',	'How much ?',	NULL,	2,	NULL,	5,	NULL,	'2021-05-09 15:04:42',	'2021-05-09 15:04:42'),
(23,	'Apa kabar ?',	'Bạn có khỏe không',	'How are you ?',	'Dikatakan ketika kamu menanyakan kabar kepada seseorang.',	1,	NULL,	2,	NULL,	'2021-05-09 15:08:46',	'2021-05-09 15:08:46'),
(24,	'Aku baik-baik saja. Terima kasih.',	'Cảm ơn, tôi khỏe.',	'I\'m fine. Thank.',	'Dikatakan ketika kamu ditanya kabar oleh seseorang.',	1,	NULL,	2,	NULL,	'2021-05-09 15:10:35',	'2021-05-09 15:10:35'),
(25,	'Aku kủrang baik. Terima kasih.',	'Cảm ơn, tôi không khỏe.',	'I\'m not well. Thanks',	'Dikatakan ketika kamu ditanya kabar oleh seseorang.',	1,	NULL,	2,	NULL,	'2021-05-09 15:11:41',	'2021-05-09 15:11:41'),
(26,	'Sia',	'Tên bạn là gì',	'What your name ?',	'Dikatakan ketika kamu ditanya kabar oleh seseorang.',	1,	NULL,	2,	NULL,	'2021-05-09 15:12:55',	'2021-05-09 15:12:55'),
(27,	'Siapa namamu ?',	'Tên bạn là gì',	'What your name ?',	'Ketika kamu bertanya nama seseorang.',	1,	NULL,	2,	NULL,	'2021-05-09 15:13:53',	'2021-05-09 15:13:53'),
(28,	'Namaku Riski.',	'Tên tôi là Riski.',	'My name is Riski.',	'Ketika seseorang bertanya tentang namamu.',	1,	NULL,	2,	NULL,	'2021-05-09 15:16:52',	'2021-05-09 15:16:52'),
(29,	'Sampai jumpa.',	'Hẹn gặp lại.',	'See you later.',	'Sama hal halnya seperti bye bye.',	1,	NULL,	2,	NULL,	'2021-05-09 15:18:33',	'2021-05-09 15:18:33'),
(30,	'Selamat tinggal.',	'Tâm biệt.',	'Good bye.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:19:52',	'2021-05-09 15:19:52'),
(31,	'Senang bertemu denganmu.',	'Rất vui được gặp bạn.',	'Nice to meet you.',	'Ketika kamu bertemu dengan orang baru.',	1,	NULL,	2,	NULL,	'2021-05-09 15:21:16',	'2021-05-09 15:21:16'),
(32,	'Bagaimana denganmu ?',	'Thế còn bạn',	'What about you?',	'Ketika kamu sedang mengobrol lalu kamu ingin bertanya balik.',	1,	NULL,	2,	NULL,	'2021-05-09 15:23:21',	'2021-05-09 15:23:21'),
(33,	'Semoga betuntung',	'Chúc may mắn',	'Good luck',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:24:02',	'2021-05-09 15:24:02'),
(34,	'Hati-hati.',	'Bạn trong',	'Take care',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:24:38',	'2021-05-09 15:24:38'),
(35,	'Sudah lama',	'Được một lúc rồi đấy',	'It\'s been a while',	'Misal, ketika kamu ditanya \"Sudah lama kamu di disini?\"\nKamu bisa menjawab dengan kalimat ini.',	1,	NULL,	2,	NULL,	'2021-05-09 15:27:31',	'2021-05-09 15:27:31'),
(36,	'Apakah kamu bisa bahasa inggris ?',	'Bạn có nội được tiếng Anh không',	'Can you speak english ?',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:30:34',	'2021-05-09 15:30:34'),
(37,	'Aku bisa bahasa vietnam sedikit.',	'Tôi có thể nói được một chút tiếng việt.',	'I can speak a little vietnamese.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:33:15',	'2021-05-09 15:33:15'),
(38,	'Aku tidak bisa bahasa vietnam.',	'Tôi không thể nói tiếng việt.',	'I can\'t speak vietnamese.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:36:22',	'2021-05-09 15:36:22'),
(39,	'Darimana kamu berasal ?',	'Bạn đến từ đâu',	'Where are you from ?',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:38:07',	'2021-05-09 15:38:07'),
(40,	'Aku dari Indonesia.',	'Tôi đến từ Indonesia.',	'I am from Indonesia.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:39:00',	'2021-05-09 15:39:00'),
(41,	'Berapa umurmu ?',	'Bạn bao nhiêu tuổi ?',	'How old are you ?',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:40:40',	'2021-05-09 15:40:40'),
(42,	'Umurku 22 tahun.',	'Tôi 22 tuổi',	'I\'m 22 years old.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:42:15',	'2021-05-09 15:42:15'),
(43,	'Dimana kamu tinggal ?',	'Bạn sống ở đâu ?',	'Where do you live ?',	'Bertanya tempat tinggal seseorang.',	1,	NULL,	1,	NULL,	'2021-05-09 15:48:16',	'2021-05-09 15:48:16'),
(44,	'Aku tinggal di Kota Bandung.',	'Tôi sống ở Bandung City.',	'I live in Bandung City.',	NULL,	1,	NULL,	1,	NULL,	'2021-05-09 15:49:36',	'2021-05-09 15:49:36'),
(45,	'Kamu mau pergi kemana ?',	'Bạn đang đi đâu đấy',	'Where are you going ?',	NULL,	1,	NULL,	1,	NULL,	'2021-05-09 15:51:26',	'2021-05-09 15:51:26'),
(46,	'Selamat!',	'Xin chúc mừng',	'Congratulations!',	'Memberikan kata selamat kepada seseorang.',	1,	NULL,	1,	NULL,	'2021-05-09 15:53:49',	'2021-05-09 15:53:49'),
(47,	'Selamat pagi',	'Buổi sáng tốt lành',	'Good morning',	NULL,	1,	NULL,	1,	NULL,	'2021-05-09 15:54:54',	'2021-05-09 15:54:54'),
(48,	'Selamat sore',	'Buổi trưa tốt lành',	'Good afternoon',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:55:41',	'2021-05-09 15:55:41'),
(49,	'Selamat malam',	'Buổi tối tốt lành',	'Good afternoon',	NULL,	1,	NULL,	2,	NULL,	'2021-05-09 15:58:06',	'2021-05-09 15:58:06'),
(50,	'Kosong',	'Không',	'Zero',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:15:50',	'2021-05-09 21:15:50'),
(51,	'Satu',	'Một',	'One',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:16:28',	'2021-05-09 21:16:28'),
(52,	'Dua',	'Hai',	'Two',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:16:52',	'2021-05-09 21:16:52'),
(53,	'Tiga',	'Ba',	'Three',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:17:15',	'2021-05-09 21:17:15'),
(54,	'Empat',	'Bổn',	'Four',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:18:28',	'2021-05-09 21:18:28'),
(55,	'Lima',	'Năm',	'Five',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:19:08',	'2021-05-09 21:19:08'),
(56,	'Enam',	'Sáu',	'Six',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:20:22',	'2021-05-09 21:20:22'),
(57,	'Tujuh',	'Bảy',	'Seven',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:20:51',	'2021-05-09 21:20:51'),
(58,	'Depalan',	'Tám',	'Eight',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:21:17',	'2021-05-09 21:21:17'),
(59,	'Sembilan',	'Chín',	'Nine',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:21:34',	'2021-05-09 21:21:34'),
(60,	'Sepuluh',	'Mười',	'Ten',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:22:03',	'2021-05-09 21:22:03'),
(61,	'Sebelas',	'Mười một',	'Eleven',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:22:37',	'2021-05-09 21:22:37'),
(62,	'Dua belas',	'Mười hai',	'Twelve',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:22:56',	'2021-05-09 21:22:56'),
(63,	'Tiga belas',	'Mười ba',	'Thirteen',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:23:19',	'2021-05-09 21:23:19'),
(64,	'Empat belas',	'Mười bốn',	'Fourteen',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:23:47',	'2021-05-09 21:23:47'),
(65,	'Lima belas',	'Mười năm',	'Fifteen',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:24:09',	'2021-05-09 21:24:09'),
(66,	'Enam belas',	'Mười sáu',	'Sixteen',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:24:27',	'2021-05-09 21:24:27'),
(67,	'Tujuh belas',	'Mười bảy',	'Seventeen',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:24:47',	'2021-05-09 21:24:47'),
(68,	'Delapan belas',	'Mười tám',	'Eighteen',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:25:05',	'2021-05-09 21:25:05'),
(69,	'Sembilan belas',	'Mười chín',	'Nineteen',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:25:24',	'2021-05-09 21:25:24'),
(70,	'Dua p',	'Mười chín',	'Nineteen',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:25:34',	'2021-05-09 21:25:34'),
(71,	'Dua puluh',	'Hai mươi',	'Twenty',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:25:55',	'2021-05-09 21:25:55'),
(72,	'Dua puluh satu',	'Hai mốt',	'Twenty one',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:28:04',	'2021-05-09 21:28:04'),
(73,	'Dua puluh dua',	'Hai hai',	'Twenty two',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:28:25',	'2021-05-09 21:28:25'),
(74,	'Dua puluh tiga',	'Hai ba',	'Twenty three',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:28:47',	'2021-05-09 21:28:47'),
(75,	'Dua puluh empat',	'Hai bốn',	'Twenty four',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:29:06',	'2021-05-09 21:29:06'),
(76,	'Dua puluh lima',	'Hai năm',	'Twenty five',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:29:21',	'2021-05-09 21:29:21'),
(77,	'Dua puluh enam',	'Hai sáu',	'Twenty six',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:29:37',	'2021-05-09 21:29:37'),
(78,	'Dua puluh tujuh',	'Hai bảy',	'Twenty seven',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:29:56',	'2021-05-09 21:29:56'),
(79,	'Dua puluh delapan',	'Hai tám',	'Twenty eight',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:30:18',	'2021-05-09 21:30:18'),
(80,	'Dua puluh sembilan',	'Hai chín',	'Twenty nine',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:30:39',	'2021-05-09 21:30:39'),
(81,	'Tiga puluh',	'Ba mươi',	NULL,	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:31:04',	'2021-05-09 21:31:04'),
(82,	'Tiga puluh',	'Ba mươi',	'Thirty',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:31:16',	'2021-05-09 21:31:16'),
(83,	'Enpapuluh',	'Ba mươi',	'Thirty',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:31:26',	'2021-05-09 21:31:26'),
(84,	'Empat uluh',	'Bốn mươi',	'Forty',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:31:45',	'2021-05-09 21:31:45'),
(85,	'Lima uluh',	'Năm mươi',	'Fifty',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:32:05',	'2021-05-09 21:32:05'),
(86,	'Enam uluh',	'Sáu mươi',	'Sixty',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:32:22',	'2021-05-09 21:32:22'),
(87,	'Tujuh uluh',	'Bảy mươi',	'Seventy',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:32:40',	'2021-05-09 21:32:40'),
(88,	'Delapan uluh',	'Tám mươi',	'Eighty',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:33:05',	'2021-05-09 21:33:05'),
(89,	'Sembilan uluh',	'Chín mươi',	'Ninety',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:33:28',	'2021-05-09 21:33:28'),
(90,	'Seratus',	'Một trăm',	'One hundred',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:33:52',	'2021-05-09 21:33:52'),
(91,	'Seribu',	'Một ngàn',	'One thousand',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:34:50',	'2021-05-09 21:34:50'),
(92,	'Sepuluh ribu',	'Mười ngàn',	'Ten thousand',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:35:18',	'2021-05-09 21:35:18'),
(93,	'Seratus ribu',	'Một trăm ngàn',	'Hundred thousand',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:35:47',	'2021-05-09 21:35:47'),
(94,	'Satu juta',	'Một triệu',	'One million',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:36:17',	'2021-05-09 21:36:17'),
(95,	'Pertama',	'Thứ nhất',	'First',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:36:54',	'2021-05-09 21:36:54'),
(96,	'Kedua',	'Thứ hai',	'Second',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:37:08',	'2021-05-09 21:37:08'),
(97,	'Ketiga',	'Thứ ba',	'Thrid',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:37:33',	'2021-05-09 21:37:33'),
(98,	'Keempat',	'Thứ tư',	'Fourth',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:37:58',	'2021-05-09 21:37:58'),
(99,	'Kelima',	'Thứ tư',	'Fourth',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:38:41',	'2021-05-09 21:38:41'),
(100,	'Kelima',	'Thứ năm',	'Fifth',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:39:09',	'2021-05-09 21:39:09'),
(101,	'Keenam',	'Thứ sáu',	'Sixth',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:39:31',	'2021-05-09 21:39:31'),
(102,	'Ketujuh',	'Thứ bảy',	'Seventh',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:39:50',	'2021-05-09 21:39:50'),
(103,	'Kedepalan',	'Thứ tám',	'Eighth',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:40:11',	'2021-05-09 21:40:11'),
(104,	'Kesembilan',	'Thứ chín',	'Ninth',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:40:35',	'2021-05-09 21:40:35'),
(105,	'Kesepuluh',	'Thứ mười',	'Tenth',	NULL,	1,	NULL,	4,	NULL,	'2021-05-09 21:41:08',	'2021-05-09 21:41:08'),
(106,	'Maaf, bisa katana lagi',	'Làm ơn nói lại lần nữa',	'Please say that again',	NULL,	1,	NULL,	5,	NULL,	'2021-05-09 21:49:38',	'2021-05-09 21:49:38'),
(107,	'Bisalah kamu bicara pelan-pelan ?',	'Bạn có thể nói chậm hơn không?',	'Can speak slowly ?',	NULL,	1,	NULL,	5,	NULL,	'2021-05-09 21:50:38',	'2021-05-09 21:50:38'),
(108,	'Tidak, terima kasih',	'Không, cảm ơn',	'No, thank you',	NULL,	1,	NULL,	5,	NULL,	'2021-05-09 21:52:00',	'2021-05-09 21:52:00'),
(109,	'Maaf (Rasa simpati)',	'Tôi lấy làm tiếc',	'I\'m sorry (sympathy)',	NULL,	1,	NULL,	5,	NULL,	'2021-05-09 21:53:14',	'2021-05-09 21:53:14'),
(110,	'Kamu bicara terlalu cepat',	'Cậu nói nhanh quá',	'You speak to fast',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:32:31',	'2021-05-10 05:32:31'),
(111,	'Siapa kamu ?',	'Bạn là ai?',	'Who are you ?',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:33:38',	'2021-05-10 05:33:38'),
(112,	'Siapa disana ?',	'Ai kia?',	'Who is there ?',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:34:42',	'2021-05-10 05:34:42'),
(113,	'Sekolah dimana kamu ?',	'Bạn học ở trường nào?',	'Where do you study ?',	'Atau bisa juga \"Kuliah dimana kamu?\"',	2,	NULL,	2,	NULL,	'2021-05-10 05:36:24',	'2021-05-10 05:36:24'),
(114,	'Ini disebut apa dalam babasa inggris ?',	'Cái này trong tiếng Anh gọi là gì?',	'What is this called in English ?',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:38:24',	'2021-05-10 05:38:24'),
(116,	'Apa arti kata ini ?',	'Từ này có nghĩa là gì?',	'What does this word mean ?',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:39:30',	'2021-05-10 05:39:30'),
(117,	'Apa yang kamu harapkan ?',	'Bạn muốn gì?',	'What do you wish ?',	'Atau bisa juga apa \"Apa yang kamu inginkan?\"',	2,	NULL,	2,	NULL,	'2021-05-10 05:40:39',	'2021-05-10 05:40:39'),
(118,	'Tunggu aku',	'Chờ tôi',	'Wait for me',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:41:04',	'2021-05-10 05:41:04'),
(119,	'Tunggu sebentar',	'Đợt một chút',	'Wait a moment',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:42:16',	'2021-05-10 05:42:16'),
(120,	'Tunggu sebentar',	'Đợi tí',	'Wait a minute',	'Hampir sama dengan \"Đợt 1 chút\". Bedanya menunggu sedikit lama.',	2,	NULL,	2,	NULL,	'2021-05-10 05:45:22',	'2021-05-10 05:45:22'),
(121,	'Sangat baik.',	'Rất khỏe',	'Very well.',	'Dikatakan ketika kamu ditanya kabar',	2,	NULL,	2,	NULL,	'2021-05-10 05:46:28',	'2021-05-10 05:46:28'),
(122,	'Masalah',	'Rắc rối',	'Trouble',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:47:34',	'2021-05-10 05:47:34'),
(123,	'Hari ini',	'Hôm nay',	'Today',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:47:54',	'2021-05-10 05:47:54'),
(124,	'Kamu yang sangat baik',	'Bạn thật tốt bụng',	'That\'s very kind of you',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:48:56',	'2021-05-10 05:48:56'),
(125,	'Tidak apa-apa',	'Không sao đâu',	'That\'s all right',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:49:44',	'2021-05-10 05:49:44'),
(126,	'Terima kasih. Aku tidak akan lupa bantuanmu',	'Cảm ơn. Tôi sẽ không quên sự giúp đỡ của anh.',	'Thank, i won\'t forget to your help.',	'Kalimat ini dikatakan ketika orang lain menolongmu',	2,	NULL,	2,	NULL,	'2021-05-10 05:52:40',	'2021-05-10 05:52:40'),
(127,	'Terima kasih telah datang mengantarku.',	'Cảm ơn vì đã đến tiễn tôi.',	'Thank for coming to see me off.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:53:55',	'2021-05-10 05:53:55'),
(128,	'Terima kasih atas bantuanmu.',	'Cảm ơn sự giúp đỡ của bạn',	'Thanks a loot for your help.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:54:46',	'2021-05-10 05:54:46'),
(129,	'Terima kasih banyak.',	'Cảm ơn bạn rất nhiều',	'Thank you very much.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:55:31',	'2021-05-10 05:55:31'),
(130,	'Terima kasih telah membantuku.',	'Cảm ơn bạn đã giúp đỡ tôi',	'Thank you for helping me out.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:57:06',	'2021-05-10 05:57:06'),
(131,	'Terima kasih untuk semuanya.',	'Cảm ơn vì mọi thứ',	'Thank you for everything',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:58:14',	'2021-05-10 05:58:14'),
(132,	'Meluangkan waktu.',	'Cứ từ từ, không cần vôj',	'Take the time.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 05:59:47',	'2021-05-10 05:59:47'),
(133,	'Hati-hati.',	'Bảo trọng',	'Take care.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 06:00:32',	'2021-05-10 06:00:32'),
(134,	'Sukses',	'Thành công',	'Success',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:04:43',	'2021-05-10 06:04:43'),
(135,	'Duduk disini',	'Ngồi đây',	'Sit here',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:05:34',	'2021-05-10 06:05:34'),
(136,	'Dengan senang hati.',	'Niềm vinh hạnh',	'Pleasure.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:06:17',	'2021-05-10 06:06:17'),
(137,	'Mohon bicara lebih pelan.',	'Hãy nói chậm hơn',	'Please speak more slowly.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:06:50',	'2021-05-10 06:06:50'),
(138,	'Silahkan duduk',	'Vui lòng ngồi xuống',	'Please sit down',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:07:14',	'2021-05-10 06:07:14'),
(139,	'Mohon ulangi',	'Hãy nhắc lại',	'Please repeat',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:07:36',	'2021-05-10 06:07:36'),
(140,	'Silahkan masuk',	'Xin mời vào',	'Please come in',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:08:07',	'2021-05-10 06:08:07'),
(141,	'Terpaksa',	'Biết ơn',	'Obliged',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:09:19',	'2021-05-10 06:09:19'),
(142,	'Sekarang',	'Bây giờ',	'Now',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:09:42',	'2021-05-10 06:09:42'),
(143,	'Tidak buruk',	'Không tệ lắm',	'Not to bad',	'Maksudnya tidak \"begitu bagus\".\nPrasa ini dikatakan jika seseorang bertanya kabar.',	1,	NULL,	2,	NULL,	'2021-05-10 06:10:53',	'2021-05-10 06:10:53'),
(144,	'Ya ampun, sudah lama tidak bicara',	'Trời ơi, lâu lắm rồi không nói chuyện',	'Oh my goodness. long time no speak',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:12:03',	'2021-05-10 06:12:03'),
(145,	'Bertemu',	'Gặp',	'Meet',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:12:24',	'2021-05-10 06:12:24'),
(146,	'Mungkin akan segera menyusulmu lagi',	'Mình gặp lại sớm nhé.',	'Maybe cath up with you again soon.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:15:02',	'2021-05-10 06:15:02'),
(147,	'Bolehkah aku memberimu kartu nama ?',	'Tôi có thể xin danh thiếp của bạn được không?',	'May i have your name card ?',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:16:23',	'2021-05-10 06:16:23'),
(148,	'Betuntung',	'May mắn',	'Lucky',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:16:51',	'2021-05-10 06:16:51'),
(149,	'Perpustakaan',	'Thư viện',	'Library',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:17:16',	'2021-05-10 06:17:16'),
(150,	'Nanti',	'Sau',	'Later',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:17:33',	'2021-05-10 06:17:33'),
(151,	'Nanti',	'Sau',	'Later',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:17:34',	'2021-05-10 06:17:34'),
(152,	'Kebaikan',	'Lòng tử tế',	'Kindness',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:18:03',	'2021-05-10 06:18:03'),
(153,	'Tetap terhubung',	'Hãy giữ liên lạc!',	'Keep in touch',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:19:11',	'2021-05-10 06:19:11'),
(154,	'Menurutku',	'Dường như với tôi',	'It seems to me',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:20:22',	'2021-05-10 06:20:22'),
(155,	'Saya disini untuk urusan bisnis',	'Tôi đến đây vì công việc',	'I\'m here on bussiness',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:23:13',	'2021-05-10 06:23:13'),
(156,	'Aku baik-baik saja, terima kasih. Dan kamu apa kabar ?',	'Tôi khỏe, cám ơn. Còn bạn?',	'I\'m fine, thank. And you ?',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:23:49',	'2021-05-10 06:23:49'),
(157,	'Saya mahasiswa',	'Tôi là sinh viên cao đẳng.',	'I\'m a college student.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:25:08',	'2021-05-10 06:25:08'),
(158,	'Aku akan ingat kebaikanmu',	'Tôi sẽ nhớ lòng tốt của bạn',	'I will remember yo kindness.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:26:00',	'2021-05-10 06:26:00'),
(159,	'Aku ingin melihatmu.',	'Tôi muốn gặp bạn.',	'I want to see you.',	'Maksudnya aku ingin bertemu denganmu',	1,	NULL,	2,	NULL,	'2021-05-10 06:26:45',	'2021-05-10 06:26:45'),
(160,	'Aku pikir begitu.',	'I think so',	'Tôi nghĩ vậy',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:27:13',	'2021-05-10 06:27:13'),
(161,	'Aku rasa aku sangat beruntung.',	'Tôi nghĩ tôi rất may mắn.',	'I think i\'m very lucky.',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:27:47',	'2021-05-10 06:27:47'),
(162,	'Aku tahu',	'Tôi biết',	'I know',	NULL,	1,	NULL,	2,	NULL,	'2021-05-10 06:28:57',	'2021-05-10 06:28:57'),
(163,	'Aku sudah lama tidak melihatmu',	'Lâu lắm rồi không gặp anh',	'I haven\'t seen you for long time',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 08:49:46',	'2021-05-10 08:49:46'),
(164,	'Aku memiliki dua adik perempuan.',	'Tôi có hai em gái.',	'I have two younger sisters.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 08:51:45',	'2021-05-10 08:51:45'),
(165,	'Aku punya satu kakak laki-laki.',	'Tôi có một anh trai.',	'I have one older brother.',	NULL,	2,	NULL,	1,	NULL,	'2021-05-10 08:56:03',	'2021-05-10 08:56:03'),
(166,	'Aku lupa',	'Tôi đã quên mất',	'I have forgotten',	NULL,	2,	NULL,	1,	NULL,	'2021-05-10 08:56:42',	'2021-05-10 08:56:42'),
(167,	'Aku tidak bisa bahasa vietnam',	'Tôi không nói được tiếng Việt',	'I don\'t speak vietnamese',	NULL,	2,	NULL,	1,	NULL,	'2021-05-10 08:57:27',	'2021-05-10 08:57:27'),
(168,	'Aku tidak bisa bahasa inggris dengan baik.',	'Tôi không hiểu tiếng Anh tốt',	'I don\'t understand English well',	NULL,	2,	NULL,	1,	NULL,	'2021-05-10 08:58:13',	'2021-05-10 08:58:13'),
(169,	'Aku rasa tidak.',	'Tôi không nghĩ vậy',	'I don\'t think so',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 08:59:00',	'2021-05-10 08:59:00'),
(170,	'Aku tidal tahu harus berkata apa.',	'Tôi không biết phải nói gì.',	'I don\'t know what to say.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:00:02',	'2021-05-10 09:00:02'),
(171,	'Aku sangat senang bertemu denganmu.',	'Tôi rất vui được gặp bạn',	'I am very pleased to meet you.',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:01:40',	'2021-05-10 09:01:40'),
(172,	'Aku senang berkenalan denganmu.',	'Tôi rất vui được làm quen với bạn',	'I am happy to make you acquaintance',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:03:37',	'2021-05-10 09:03:37'),
(173,	'Aku takut.',	'Tôi sợ',	'I am afraid',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:04:40',	'2021-05-10 09:04:40'),
(174,	'Bagaimana saudara perempuanmu ?',	'Chị gái của bạn thế nào?',	'How is your sister ?',	'Menanyakan kabar saudara perempuan',	2,	NULL,	2,	NULL,	'2021-05-10 09:06:18',	'2021-05-10 09:06:18'),
(175,	'Bagaimana kabar orangtuamu?',	'Bố mẹ của bạn khỏe không?',	'How are your parents ?',	'Menanyakan kabar orangtua',	2,	NULL,	2,	NULL,	'2021-05-10 09:08:26',	'2021-05-10 09:08:26'),
(176,	'Bagaimana kabarmu hari ini ?',	'Hôm nay anh thế nào?',	'How are you today ?',	'Menanyakan kabar hari ini',	2,	NULL,	2,	NULL,	'2021-05-10 09:09:36',	'2021-05-10 09:09:36'),
(177,	'Tolong!',	'Giúp đỡ',	'Help!',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:12:42',	'2021-05-10 09:12:42'),
(178,	'Selamat tidur!',	'Chúc ngủ ngon',	'Goodnight!',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:13:31',	'2021-05-10 09:13:31'),
(179,	'Senang bertemu denganmu.',	'Rất vui được làm quen với anh',	'Glad to meet you',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:14:18',	'2021-05-10 09:14:18'),
(180,	'Lama sekali',	'Đã lâu rồi',	'For ages',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:15:10',	'2021-05-10 09:15:10'),
(181,	'Semuanya',	'Tất cả mọi thứ',	'Everything',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:16:06',	'2021-05-10 09:16:06'),
(182,	'Jangan khawatir',	'Đừng lo',	'Don\'t worry',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:16:30',	'2021-05-10 09:16:30'),
(183,	'Jangan sebutkan itu',	'Đừng để ý',	'Don\'t mention it',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:17:07',	'2021-05-10 09:17:07'),
(184,	'Apakah disini ada orang yang bicara bahasa inggris ?',	'Có ai ở đây nói tiếng Anh không?',	'Does anybody here speak English?',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:18:54',	'2021-05-10 09:18:54'),
(185,	'Pujian',	'Lời khen',	'Compliment',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:19:50',	'2021-05-10 09:19:50'),
(186,	'Ikut denganku',	'Đi với tôi',	'Come with me',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:20:19',	'2021-05-10 09:20:19'),
(188,	'Apakah kamu pelajar ?',	'Bạn có phải là sinh viên không?',	'Are you students ?',	NULL,	2,	NULL,	2,	NULL,	'2021-05-10 09:21:11',	'2021-05-10 09:21:11'),
(189,	'Satu milyar',	'Một tỷ',	'One billion',	NULL,	1,	NULL,	4,	NULL,	'2021-05-10 17:33:52',	'2021-05-10 17:33:52'),
(190,	'Persen',	'Phần trăm',	'Percent',	NULL,	1,	NULL,	4,	NULL,	'2021-05-10 17:36:33',	'2021-05-10 17:36:33'),
(191,	'Satu persen',	'Một phần trăm',	'One percent',	NULL,	1,	NULL,	4,	NULL,	'2021-05-10 17:36:52',	'2021-05-10 17:36:52'),
(192,	'Dua persen',	'Hai phần trăm',	'Two percent',	NULL,	1,	NULL,	4,	NULL,	'2021-05-10 17:37:11',	'2021-05-10 17:37:11'),
(193,	'Tiga persen',	'Ba phần trăm',	'Three percent',	NULL,	1,	NULL,	4,	NULL,	'2021-05-10 17:37:29',	'2021-05-10 17:37:29'),
(194,	'Setengah',	'Một nửa',	'Half',	NULL,	1,	NULL,	4,	NULL,	'2021-05-10 17:37:54',	'2021-05-10 17:37:54'),
(195,	'Perempat',	'Phần tư',	'Quarter',	NULL,	1,	NULL,	1,	NULL,	'2021-05-10 17:39:35',	'2021-05-10 17:39:35'),
(196,	'Satu setengah',	'Một phần hai',	'One-half',	NULL,	1,	NULL,	1,	NULL,	'2021-05-10 17:40:26',	'2021-05-10 17:40:26'),
(197,	'Sepertiga',	'Một phần ba',	'One-thrid',	NULL,	1,	NULL,	1,	NULL,	'2021-05-10 17:41:19',	'2021-05-10 17:41:19'),
(198,	'Satu perempat',	'Một phần tư',	'One-quarter',	NULL,	1,	NULL,	1,	NULL,	'2021-05-10 17:44:14',	'2021-05-10 17:44:14'),
(199,	'Nomor urut',	'Số thứ tự',	'Ordinal numbers',	NULL,	1,	NULL,	1,	NULL,	'2021-05-10 17:45:18',	'2021-05-10 17:45:18'),
(200,	'Senin',	'Thứ hai',	'Monday',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:49:40',	'2021-05-11 05:49:40'),
(201,	'Selasa',	'Thứ ba',	'Tuesday',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:50:03',	'2021-05-11 05:50:03'),
(202,	'Rabu',	'Thứ tư',	'Wednesday',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:50:35',	'2021-05-11 05:50:35'),
(203,	'Kamis',	'Thứ năm',	'Thursday',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:51:01',	'2021-05-11 05:51:01'),
(204,	'Jumat',	'Thứ sáu',	'Friday',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:51:21',	'2021-05-11 05:51:21'),
(205,	'Sabtu',	'Thứ bảy',	'Saturday',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:51:44',	'2021-05-11 05:51:44'),
(206,	'Minggu',	'Chủ nhật',	'Sunday',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:51:58',	'2021-05-11 05:51:58'),
(207,	'Januari',	'Tháng một',	'January',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:52:17',	'2021-05-11 05:52:17'),
(208,	'Februari',	'Tháng hai',	'February',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:52:38',	'2021-05-11 05:52:38'),
(209,	'Maret',	'Tháng ba',	'March',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:52:58',	'2021-05-11 05:52:58'),
(210,	'April',	'Tháng tư',	'April',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:53:17',	'2021-05-11 05:53:17'),
(211,	'Mei',	'Tháng năm',	'May',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:53:35',	'2021-05-11 05:53:35'),
(212,	'Juni',	'Tháng sáu',	'June',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 05:53:54',	'2021-05-11 05:53:54'),
(213,	'Juli',	'Tháng bảy',	'July',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:04:12',	'2021-05-11 06:04:12'),
(214,	'Agustus',	'Tháng tám',	'August',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:04:50',	'2021-05-11 06:04:50'),
(215,	'September',	'Tháng chín',	'September',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:05:06',	'2021-05-11 06:05:06'),
(216,	'Oktov',	'Tháng chín',	'September',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:05:29',	'2021-05-11 06:05:29'),
(217,	'Oktov',	'Tháng chín',	'September',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:05:29',	'2021-05-11 06:05:29'),
(218,	'Oktober',	'Tháng mười',	'October',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:05:38',	'2021-05-11 06:05:38'),
(219,	'November',	'Tháng mười một',	'November',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:05:57',	'2021-05-11 06:05:57'),
(220,	'Desember',	'Tháng mười hai',	'December',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:06:14',	'2021-05-11 06:06:14'),
(221,	'Hari ini',	'Hôm nay',	'Today',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:06:43',	'2021-05-11 06:06:43'),
(222,	'Besok',	'Ngày mai',	'Tomorrow',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:07:34',	'2021-05-11 06:07:34'),
(223,	'Kemarin',	'Ngày hôm qua',	'Yesterday',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:08:00',	'2021-05-11 06:08:00'),
(224,	'Hari sebelum kemarin',	'Ngày hôm kia',	'The day before yesterday',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:09:01',	'2021-05-11 06:09:01'),
(225,	'Hari setelah besok',	'Ngày mốt',	'The day after tomorrow',	NULL,	1,	NULL,	1,	NULL,	'2021-05-11 06:09:40',	'2021-05-11 06:09:40'),
(226,	'Pagi',	'Buổi sáng',	'Morning',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:10:04',	'2021-05-11 06:10:04'),
(227,	'Siang',	'Buổi trưa',	'Afternoon',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:10:21',	'2021-05-11 06:10:21'),
(228,	'Malam',	'Buổi chiều',	'Evening',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:10:48',	'2021-05-11 06:10:48'),
(229,	'Malam',	'Ban đêm',	'Night',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:11:05',	'2021-05-11 06:11:05'),
(230,	'Tengah malam',	'Nửa đêm',	'Midnight',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:11:28',	'2021-05-11 06:11:28'),
(231,	'Tengah hari',	'Trưa',	'Noon',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:11:51',	'2021-05-11 06:11:51'),
(232,	'Subuh / fajar',	'Bình minh',	'Dawn',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:12:25',	'2021-05-11 06:12:25'),
(233,	'Petang',	'Hoàng hôn',	'Dusk',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:12:51',	'2021-05-11 06:12:51'),
(234,	'Saat matahari terbit',	'Lúc mặt trời mọc',	'Sunrise',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:13:26',	'2021-05-11 06:13:26'),
(235,	'Saat matahari terbenam',	'Lúc mặt trời lặn',	'Sunset',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:14:10',	'2021-05-11 06:14:10'),
(236,	'Adab',	'Thế kỉ',	'Century',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:14:56',	'2021-05-11 06:14:56'),
(237,	'Dekade',	'Thập kỷ',	'Decade',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:15:30',	'2021-05-11 06:15:30'),
(238,	'Tahun',	'Năm',	'Year',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:15:46',	'2021-05-11 06:15:46'),
(239,	'Bulan',	'Tháng',	'Month',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:16:04',	'2021-05-11 06:16:04'),
(240,	'Hari',	'Ngày',	'Day',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:16:17',	'2021-05-11 06:16:17'),
(241,	'Jam',	'Giờ',	'Hour',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:16:35',	'2021-05-11 06:16:35'),
(242,	'Menit',	'Phút',	'Minute',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:16:56',	'2021-05-11 06:16:56'),
(243,	'Detik',	'Giây',	'Second',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:17:13',	'2021-05-11 06:17:13'),
(244,	'Jam',	'Giờ',	'O\'clock',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:17:39',	'2021-05-11 06:17:39'),
(245,	'Tadi malam',	'Tối qua',	'Last night',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:20:06',	'2021-05-11 06:20:06'),
(246,	'Malam ini',	'Tối nay',	'Tonight',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:20:34',	'2021-05-11 06:20:34'),
(247,	'Besok malam',	'Tối mai',	'Tomorrow night',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:21:12',	'2021-05-11 06:21:12'),
(248,	'Di pagi hari',	'Vào buổi sáng',	'In the morning',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:21:45',	'2021-05-11 06:21:45'),
(249,	'Di siang hari',	'Vào buổi chiều',	'In the afternoon',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:22:14',	'2021-05-11 06:22:14'),
(250,	'Di malam hari',	'Vào buổi tối',	'In the evening',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:22:42',	'2021-05-11 06:22:42'),
(251,	'Kemarin pagi',	'Sáng qua',	'Yesterday morning',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:23:22',	'2021-05-11 06:23:22'),
(252,	'Kemarin siang',	'Chiều qua',	'Yesterday afternoon',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:24:21',	'2021-05-11 06:24:21'),
(253,	'Kemarin malam',	'Tối qua',	'Yesterday evening',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:24:44',	'2021-05-11 06:24:44'),
(254,	'Pagi ini',	'Sáng nay',	'This morning',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:26:18',	'2021-05-11 06:26:18'),
(255,	'Siang ini',	'Chiều nay',	'This afternoon',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:26:45',	'2021-05-11 06:26:45'),
(256,	'Malam ini',	'Tối nay',	'This evening',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:27:12',	'2021-05-11 06:27:12'),
(257,	'Besok pagi',	'Sáng mai',	'Tomorrow morning',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:29:03',	'2021-05-11 06:29:03'),
(258,	'Besok siang',	'Chiều mai',	'Tomorrow afternoon',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:29:30',	'2021-05-11 06:29:30'),
(259,	'Besok malam',	'Tối mai',	'Tomorrow evening',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:29:57',	'2021-05-11 06:29:57'),
(260,	'Bulan berikutnya',	'Tháng tới',	'Next month',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:32:11',	'2021-05-11 06:32:11'),
(261,	'Bulan lalu',	'Tháng trước',	'Last month',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:32:55',	'2021-05-11 06:32:55'),
(262,	'Bulan lalu',	'Tháng trước',	'Last month',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:32:58',	'2021-05-11 06:32:58'),
(263,	'Akhir pekan',	'Cuối tuần',	'Weekend',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 06:33:29',	'2021-05-11 06:33:29'),
(264,	'Sarapan',	'Bữa sáng',	'Breakfast',	NULL,	1,	NULL,	13,	NULL,	'2021-05-11 11:23:48',	'2021-05-11 11:23:48'),
(265,	NULL,	'2121',	NULL,	NULL,	2,	NULL,	1,	NULL,	'2021-06-19 20:20:26',	'2021-06-19 20:20:26'),
(266,	NULL,	'asasas',	NULL,	NULL,	1,	NULL,	1,	NULL,	'2021-06-19 20:33:51',	'2021-06-19 20:33:51'),
(267,	NULL,	'asasasas',	NULL,	NULL,	1,	NULL,	1,	NULL,	'2021-06-19 20:39:17',	'2021-06-19 20:39:17'),
(268,	NULL,	'asasasasas',	NULL,	NULL,	1,	NULL,	1,	NULL,	'2021-06-19 20:42:06',	'2021-06-19 20:42:06'),
(269,	NULL,	'asasasas',	NULL,	NULL,	1,	NULL,	1,	NULL,	'2021-06-19 20:42:46',	'2021-06-19 20:42:46'),
(270,	NULL,	'assas',	NULL,	NULL,	1,	NULL,	1,	NULL,	'2021-06-20 14:42:13',	'2021-06-20 14:42:13');

DROP TABLE IF EXISTS `phrasebook_categories`;
CREATE TABLE `phrasebook_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_ID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vi_VN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `en_US` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material_icon_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_type` enum('eva','material_icons','ant_design') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phrasebook_categories_user_id_foreign` (`user_id`),
  CONSTRAINT `phrasebook_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `phrasebook_categories` (`id`, `id_ID`, `vi_VN`, `en_US`, `description`, `slug`, `color_id`, `icon_name`, `material_icon_name`, `icon_type`, `user_id`) VALUES
(1,	'Uncategory',	'Uncategory',	'Uncategory',	NULL,	'uncategory',	NULL,	NULL,	NULL,	'eva',	1),
(2,	'Salam',	NULL,	'Greeting',	NULL,	'greeting',	'2',	NULL,	NULL,	'eva',	1),
(3,	'Asmara',	NULL,	'Romance',	NULL,	'romance',	'1',	NULL,	NULL,	'eva',	1),
(4,	'Nomor',	NULL,	'Numbers',	NULL,	'number',	'4',	NULL,	NULL,	'eva',	1),
(5,	'Umum',	NULL,	'General',	NULL,	'general',	'5',	NULL,	NULL,	'eva',	1),
(6,	'Darurat',	NULL,	'Emergency',	NULL,	'emergency',	'5',	NULL,	NULL,	'eva',	1),
(7,	'Pakaian',	NULL,	'Fashion',	NULL,	'fashion',	'6',	NULL,	NULL,	'eva',	1),
(8,	'Sekolah',	NULL,	'School',	NULL,	'school',	'7',	NULL,	NULL,	'eva',	1),
(9,	'Binatang',	NULL,	'Animal',	NULL,	'animal',	'8',	NULL,	NULL,	'eva',	1),
(10,	'Makanan',	NULL,	'Food',	'',	'food',	'1',	NULL,	NULL,	'eva',	1),
(11,	'Arah',	NULL,	'Direction',	NULL,	'direction',	'2',	NULL,	NULL,	'eva',	1),
(12,	'Bekerja',	NULL,	'Work',	NULL,	'work',	'3',	NULL,	NULL,	'eva',	1),
(13,	'Waktu',	NULL,	'Time',	NULL,	'time',	'4',	NULL,	NULL,	'eva',	1),
(14,	'Lainnya',	NULL,	'Others',	NULL,	'other',	'5',	NULL,	NULL,	'eva',	1);

DROP TABLE IF EXISTS `replies`;
CREATE TABLE `replies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `discussion_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `replies_user_id_foreign` (`user_id`),
  KEY `replies_discussion_id_foreign` (`discussion_id`),
  CONSTRAINT `replies_discussion_id_foreign` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `social_accounts`;
CREATE TABLE `social_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `social_accounts` (`id`, `user_id`, `social_id`, `social_provider`, `social_name`, `social_photo_url`, `created_at`, `updated_at`) VALUES
(1,	3,	'107767353087601514270',	'google',	'Chao Dev',	NULL,	'2021-05-12 06:47:16',	'2021-05-12 06:47:16'),
(2,	4,	'107075335851845059906',	'google',	'Kang Iki',	'https://lh3.googleusercontent.com/a-/AOh14GjR0nYvLdHzWQ8V-JLyh_EIkg4aoXh_vupPXeDEjQ',	'2021-05-12 17:06:09',	'2021-05-12 17:06:09'),
(3,	6,	'117981266143300387148',	'google',	'Dev Plara',	'https://lh3.googleusercontent.com/a-/AOh14Gg0LHNn3Qt6hid-99f9kemL_L8ZNSf4u6pb0AbI',	'2021-05-21 09:44:33',	'2021-05-21 09:44:33'),
(4,	7,	'116681782789533932337',	'google',	'Riski',	'https://lh3.googleusercontent.com/a-/AOh14GjOQoeKU7pd6Jmlb50aGixQFXnKlRc4rr9gUYdE-g',	'2021-06-03 15:26:38',	'2021-06-03 15:26:38');

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `topics_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_id` tinyint(3) unsigned NOT NULL,
  `status_id` tinyint(3) unsigned NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','none') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contribution_point` bigint(20) unsigned NOT NULL DEFAULT 0,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `verified`, `email_verified_at`, `photo_url`, `cover_photo_url`, `level_id`, `status_id`, `phone_number`, `gender`, `contribution_point`, `about`, `birthday`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Riski',	'riski',	'hi@riski.me',	'$2y$10$OePP0FgjcEvltQfK9S7/uORjamOMIhyUoQZHCxAZ9RfgNi.JJA4bO',	0,	NULL,	'4yearsago.jpg',	'nicolas-j-leclercq-Tc2_T0H-QNU-unsplash.jpg',	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-05-09 13:02:32',	'2021-05-09 13:02:32'),
(2,	'Hey Six',	'heysix',	'heysix@outlook.com',	'$2y$10$9uIMNfY83BnjA94KBit7OeidwoHQ9G22UAMBOp3/.dL0EHL91TPKi',	0,	NULL,	'heysix.jpg',	NULL,	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-05-09 21:38:07',	'2021-05-09 21:38:07'),
(3,	'Chao Dev',	'Chao DevPzSPi',	'xinchaodev@gmail.com',	NULL,	0,	NULL,	NULL,	NULL,	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-05-12 06:47:16',	'2021-05-12 06:47:16'),
(4,	'Kang Iki',	'Kang IkikHEkR',	'kangiki.me@gmail.com',	NULL,	0,	NULL,	NULL,	NULL,	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-05-12 17:06:09',	'2021-05-12 17:06:09'),
(5,	'Indra Anugrah',	'indra',	'bayuagustian243@gmail.com',	'$2y$10$GjfVg4CFrVGNSYfAbB0z6OywCSmKtM.ynwZ53jhYgvWnVtO5KZtxa',	0,	NULL,	NULL,	NULL,	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-05-12 17:16:38',	'2021-05-12 17:16:38'),
(6,	'Dev Plara',	'Dev PlarakTzwd',	'devplara@gmail.com',	NULL,	0,	NULL,	NULL,	NULL,	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-05-21 09:44:33',	'2021-05-21 09:44:33'),
(7,	'Riski',	'RiskipR6TC',	'riski.web.id@gmail.com',	NULL,	0,	NULL,	NULL,	NULL,	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-06-03 15:26:38',	'2021-06-03 15:26:38'),
(12,	'Udin',	'udin-ruZ',	'udin@gmail.com',	'$2y$10$gvPBa.lotDpj60dwMdPV0ecLAXnWwZhOs43EZixpQ2LiQx77uCjIS',	0,	NULL,	NULL,	NULL,	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-06-12 20:34:22',	'2021-06-12 20:34:22'),
(14,	'Sample user',	'sample-user-WlC',	'sampleuser@gmail.com',	'$2y$10$q3BOOX0IEj2w.jANAR3/HOHgpWdd9p41/GHxss1QrZncuO3J9Z/.2',	0,	NULL,	NULL,	NULL,	1,	1,	NULL,	NULL,	0,	NULL,	NULL,	NULL,	'2021-06-19 06:46:51',	'2021-06-19 06:46:51');

DROP TABLE IF EXISTS `user_statuses`;
CREATE TABLE `user_statuses` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_statuses` (`id`, `name`, `description`) VALUES
(1,	'Active',	NULL),
(2,	'Inactive',	NULL);

DROP TABLE IF EXISTS `websockets_statistics_entries`;
CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2021-06-20 08:43:29