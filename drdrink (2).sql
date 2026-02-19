-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 19 Şub 2026, 07:58:51
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `drdrink`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created', 'App\\Models\\User', 'created', 1, NULL, NULL, '{\"attributes\":{\"name\":\"Admin\",\"email\":\"admin@drdrink.com\"}}', NULL, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(2, 'default', 'created', 'App\\Models\\User', 'created', 2, NULL, NULL, '{\"attributes\":{\"name\":\"Y\\u00f6netici\",\"email\":\"yonetici@drdrink.com\"}}', NULL, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(3, 'default', 'created', 'App\\Models\\User', 'created', 3, NULL, NULL, '{\"attributes\":{\"name\":\"meltem\",\"email\":\"meltembesikci@gmail.com\"}}', NULL, '2026-02-14 22:37:01', '2026-02-14 22:37:01'),
(4, 'default', 'created', 'App\\Models\\User', 'created', 4, NULL, NULL, '{\"attributes\":{\"name\":\"meltem\",\"email\":\"meltem@drdrink.com\"}}', NULL, '2026-02-14 22:56:26', '2026-02-14 22:56:26'),
(5, 'default', 'updated', 'App\\Models\\User', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":[],\"old\":[]}', NULL, '2026-02-14 23:00:06', '2026-02-14 23:00:06'),
(6, 'default', 'updated', 'App\\Models\\User', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":[],\"old\":[]}', NULL, '2026-02-14 23:00:48', '2026-02-14 23:00:48'),
(7, 'default', 'updated', 'App\\Models\\User', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"name\":\"meltem Be\\u015fik\\u00e7i\"},\"old\":{\"name\":\"meltem\"}}', NULL, '2026-02-14 23:31:34', '2026-02-14 23:31:34'),
(8, 'default', 'Sipariş durumu güncellendi', 'App\\Models\\Order', NULL, 20, 'App\\Models\\User', 1, '{\"old_status\":\"pending\",\"new_status\":\"pending\"}', NULL, '2026-02-15 00:30:28', '2026-02-15 00:30:28'),
(9, 'default', 'Sipariş iptal edildi ve ödeme iyzico üzerinden iade edildi.', 'App\\Models\\Order', NULL, 20, 'App\\Models\\User', 1, '{\"old_status\":\"pending\",\"new_status\":\"cancelled\",\"refunded\":true}', NULL, '2026-02-15 00:32:15', '2026-02-15 00:32:15'),
(10, 'default', 'Sipariş iptal edildi ve ödeme iyzico üzerinden iade edildi.', 'App\\Models\\Order', NULL, 19, 'App\\Models\\User', 1, '{\"old_status\":\"pending\",\"new_status\":\"cancelled\",\"refunded\":true}', NULL, '2026-02-15 00:33:44', '2026-02-15 00:33:44'),
(11, 'default', 'Sipariş iptal edildi ve ödeme iyzico üzerinden iade edildi.', 'App\\Models\\Order', NULL, 25, 'App\\Models\\User', 1, '{\"old_status\":\"pending\",\"new_status\":\"cancelled\",\"refunded\":true}', NULL, '2026-02-15 01:06:29', '2026-02-15 01:06:29'),
(12, 'default', 'Sipariş durumu güncellendi', 'App\\Models\\Order', NULL, 26, 'App\\Models\\User', 1, '{\"old_status\":\"pending\",\"new_status\":\"delivered\"}', NULL, '2026-02-15 01:08:52', '2026-02-15 01:08:52'),
(13, 'default', 'created', 'App\\Models\\User', 'created', 5, NULL, NULL, '{\"attributes\":{\"name\":\"Ma\\u011faza Y\\u00f6neticisi\",\"email\":\"magaza@drdrink.com\"}}', NULL, '2026-02-15 01:34:18', '2026-02-15 01:34:18'),
(14, 'default', 'created', 'App\\Models\\User', 'created', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":\"amine Bah\\u00e7e\",\"email\":\"testmagaza@drdrink.com\"}}', NULL, '2026-02-15 02:18:42', '2026-02-15 02:18:42'),
(15, 'default', 'created', 'App\\Models\\User', 'created', 7, 'App\\Models\\User', 5, '{\"attributes\":{\"name\":\"kasiyer\",\"email\":\"kasiyer@drdrink.com\"}}', NULL, '2026-02-15 02:32:46', '2026-02-15 02:32:46'),
(16, 'default', 'created', 'App\\Models\\User', 'created', 8, 'App\\Models\\User', 6, '{\"attributes\":{\"name\":\"testkasiyer\",\"email\":\"testkasiyer@drdrink.com\"}}', NULL, '2026-02-16 19:48:45', '2026-02-16 19:48:45'),
(17, 'default', 'created', 'App\\Models\\User', 'created', 9, 'App\\Models\\User', 5, '{\"attributes\":{\"name\":\"kasiyer2\",\"email\":\"kasiyer2@drdrink.com\"}}', NULL, '2026-02-16 20:18:38', '2026-02-16 20:18:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('drdrink-cache-setting_contact_email', 's:0:\"\";', 2086633856),
('drdrink-cache-setting_contact_phone', 's:0:\"\";', 2086633856),
('drdrink-cache-setting_currency', 's:3:\"TRY\";', 2086633856),
('drdrink-cache-setting_iyzico_api_key', 'N;', 2086633849),
('drdrink-cache-setting_iyzico_base_url', 'N;', 2086633849),
('drdrink-cache-setting_iyzico_secret_key', 'N;', 2086633849),
('drdrink-cache-setting_order_notification_sound', 's:1:\"0\";', 2086632435),
('drdrink-cache-setting_site_description', 's:0:\"\";', 2086633856),
('drdrink-cache-setting_site_name', 's:7:\"DrDrink\";', 2086633856),
('drdrink-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:28:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"orders.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:13:\"orders.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"orders.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"orders.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"products.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"products.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"products.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"products.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"categories.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"categories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:17:\"categories.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:17:\"categories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:11:\"cities.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:13:\"cities.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:13:\"cities.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"cities.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:10:\"users.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:12:\"users.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:10:\"roles.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"roles.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:12:\"roles.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:12:\"roles.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:17:\"activity_log.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:15:\"settings.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}}s:5:\"roles\";a:5:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"Super Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"Yönetici\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:8:\"Personel\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:19:\"Mağaza Yöneticisi\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:7:\"Kasiyer\";s:1:\"c\";s:3:\"web\";}}}', 1771360244);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `store_id`, `name`, `slug`, `description`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sıcak Kahveler', 'sicak-kahveler', 'Taze çekirdek kahvelerimizden hazırlanan sıcak içecekler', NULL, 1, 1, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(2, 1, 'Soğuk Kahveler', 'soguk-kahveler', 'Yaz aylarının vazgeçilmezi soğuk kahve çeşitleri', NULL, 1, 2, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(3, 1, 'Çaylar', 'caylar', 'Özel demleme çay çeşitlerimiz', NULL, 1, 3, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(4, 1, 'İçecekler', 'icecekler', 'Taze meyve suları ve diğer içecekler', NULL, 1, 4, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(5, 1, 'Atıştırmalıklar', 'atistirmaliklar', 'Kahvenizin yanına lezzetli atıştırmalıklar', NULL, 1, 5, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(6, 2, 'Sıcak Kahveler', 'sicak-kahveler-2', 'Taze çekirdek kahvelerimizden hazırlanan sıcak içecekler', NULL, 1, 1, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(7, 2, 'Soğuk Kahveler', 'soguk-kahveler-2', 'Yaz aylarının vazgeçilmezi soğuk kahve çeşitleri', NULL, 1, 2, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(8, 2, 'Çaylar', 'caylar-2', 'Özel demleme çay çeşitlerimiz', NULL, 1, 3, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(9, 2, 'İçecekler', 'icecekler-2', 'Taze meyve suları ve diğer içecekler', NULL, 1, 4, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(10, 2, 'Atıştırmalıklar', 'atistirmaliklar-2', 'Kahvenizin yanına lezzetli atıştırmalıklar', NULL, 1, 5, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(11, 3, 'Sıcak Kahveler', 'sicak-kahveler-3', 'Taze çekirdek kahvelerimizden hazırlanan sıcak içecekler', NULL, 1, 1, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(12, 3, 'Soğuk Kahveler', 'soguk-kahveler-3', 'Yaz aylarının vazgeçilmezi soğuk kahve çeşitleri', NULL, 1, 2, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(13, 3, 'Çaylar', 'caylar-3', 'Özel demleme çay çeşitlerimiz', NULL, 1, 3, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(14, 3, 'İçecekler', 'icecekler-3', 'Taze meyve suları ve diğer içecekler', NULL, 1, 4, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(15, 3, 'Atıştırmalıklar', 'atistirmaliklar-3', 'Kahvenizin yanına lezzetli atıştırmalıklar', NULL, 1, 5, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(16, 4, 'Sıcak Kahveler', 'sicak-kahveler-4', 'Taze çekirdek kahvelerimizden hazırlanan sıcak içecekler', NULL, 1, 1, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(17, 4, 'Soğuk Kahveler', 'soguk-kahveler-4', 'Yaz aylarının vazgeçilmezi soğuk kahve çeşitleri', NULL, 1, 2, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(18, 4, 'Çaylar', 'caylar-4', 'Özel demleme çay çeşitlerimiz', NULL, 1, 3, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(19, 4, 'İçecekler', 'icecekler-4', 'Taze meyve suları ve diğer içecekler', NULL, 1, 4, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(20, 4, 'Atıştırmalıklar', 'atistirmaliklar-4', 'Kahvenizin yanına lezzetli atıştırmalıklar', NULL, 1, 5, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(21, 5, 'Sıcak Kahveler', 'sicak-kahveler-5', 'Taze çekirdek kahvelerimizden hazırlanan sıcak içecekler', NULL, 1, 1, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(22, 5, 'Soğuk Kahveler', 'soguk-kahveler-5', 'Yaz aylarının vazgeçilmezi soğuk kahve çeşitleri', NULL, 1, 2, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(23, 5, 'Çaylar', 'caylar-5', 'Özel demleme çay çeşitlerimiz', NULL, 1, 3, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(24, 5, 'İçecekler', 'icecekler-5', 'Taze meyve suları ve diğer içecekler', NULL, 1, 4, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(25, 5, 'Atıştırmalıklar', 'atistirmaliklar-5', 'Kahvenizin yanına lezzetli atıştırmalıklar', NULL, 1, 5, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(26, 6, 'Sıcak Kahveler', 'sicak-kahveler-6', 'Taze çekirdek kahvelerimizden hazırlanan sıcak içecekler', NULL, 1, 1, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(27, 6, 'Soğuk Kahveler', 'soguk-kahveler-6', 'Yaz aylarının vazgeçilmezi soğuk kahve çeşitleri', NULL, 1, 2, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(28, 6, 'Çaylar', 'caylar-6', 'Özel demleme çay çeşitlerimiz', NULL, 1, 3, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(29, 6, 'İçecekler', 'icecekler-6', 'Taze meyve suları ve diğer içecekler', NULL, 1, 4, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(30, 6, 'Atıştırmalıklar', 'atistirmaliklar-6', 'Kahvenizin yanına lezzetli atıştırmalıklar', NULL, 1, 5, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(31, 7, 'Sıcak Kahveler', 'sicak-kahveler-7', 'Taze çekirdek kahvelerimizden hazırlanan sıcak içecekler', NULL, 1, 1, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(32, 7, 'Soğuk Kahveler', 'soguk-kahveler-7', 'Yaz aylarının vazgeçilmezi soğuk kahve çeşitleri', NULL, 1, 2, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(33, 7, 'Çaylar', 'caylar-7', 'Özel demleme çay çeşitlerimiz', NULL, 1, 3, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(34, 7, 'İçecekler', 'icecekler-7', 'Taze meyve suları ve diğer içecekler', NULL, 1, 4, '2026-02-14 19:03:15', '2026-02-15 01:19:19'),
(35, 7, 'Atıştırmalıklar', 'atistirmaliklar-7', 'Kahvenizin yanına lezzetli atıştırmalıklar', NULL, 1, 5, '2026-02-14 19:03:15', '2026-02-15 01:19:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `min_order_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `cities`
--

INSERT INTO `cities` (`id`, `name`, `slug`, `is_active`, `sort_order`, `min_order_amount`, `created_at`, `updated_at`) VALUES
(1, 'Kütahya', 'kutahya', 1, 1, 90.00, '2026-02-14 19:03:15', '2026-02-15 03:17:08'),
(2, 'İstanbul', 'istanbul', 1, 2, 90.00, '2026-02-14 19:03:15', '2026-02-15 00:49:20'),
(3, 'Ankara', 'ankara', 1, 3, 80.00, '2026-02-14 19:03:15', '2026-02-15 00:49:30'),
(4, 'İzmir', 'izmir', 1, 4, 110.00, '2026-02-14 19:03:15', '2026-02-15 00:49:38'),
(5, 'Bursa', 'bursa', 1, 5, 60.00, '2026-02-14 19:03:15', '2026-02-15 00:49:45'),
(6, 'Antalya', 'antalya', 1, 6, 99.00, '2026-02-14 19:03:15', '2026-02-15 00:49:52'),
(7, 'Eskişehir', 'eskisehir', 1, 7, 0.00, '2026-02-14 19:03:15', '2026-02-14 19:03:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
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
-- Tablo için tablo yapısı `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_14_220230_create_permission_tables', 1),
(5, '2026_02_14_220231_create_activity_log_table', 1),
(6, '2026_02_14_220232_add_event_column_to_activity_log_table', 1),
(7, '2026_02_14_220233_add_batch_uuid_column_to_activity_log_table', 1),
(8, '2026_02_14_220300_create_cities_table', 1),
(9, '2026_02_14_220301_create_categories_table', 1),
(10, '2026_02_14_220302_create_products_table', 1),
(11, '2026_02_14_220303_create_orders_table', 1),
(12, '2026_02_14_220304_create_order_items_table', 1),
(13, '2026_02_14_220305_create_order_status_logs_table', 1),
(14, '2026_02_14_220306_create_payments_table', 1),
(15, '2026_02_15_000000_create_user_addresses_table', 2),
(16, '2026_02_15_100000_add_structured_fields_to_user_addresses', 3),
(17, '2026_02_15_120000_add_address_instructions_to_user_addresses', 4),
(18, '2026_02_15_120001_create_pending_checkouts_table', 5),
(19, '2026_02_15_200000_create_settings_table', 6),
(20, '2026_02_15_210000_add_min_order_amount_to_cities_table', 7),
(21, '2026_02_15_220000_create_stores_table', 8),
(22, '2026_02_15_220001_create_store_user_table', 8),
(23, '2026_02_15_220002_add_store_id_to_categories_table', 8),
(24, '2026_02_15_220003_add_store_id_to_products_table', 8),
(25, '2026_02_15_220004_add_store_id_to_orders_table', 8),
(26, '2026_02_15_220005_populate_stores_and_assign_data', 8),
(27, '2026_02_16_000001_add_order_type_to_orders_table', 9),
(28, '2026_02_16_120000_add_discount_to_orders_table', 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `order_type` varchar(255) NOT NULL DEFAULT 'package',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `city_id`, `store_id`, `order_number`, `status`, `address`, `phone`, `customer_name`, `notes`, `subtotal`, `delivery_fee`, `discount_amount`, `discount_type`, `total`, `payment_status`, `payment_method`, `order_type`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 3, 'DD260215306B001', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem', NULL, 55.00, 15.00, 0.00, NULL, 70.00, 'pending', 'credit_card', 'package', '2026-02-14 23:04:54', '2026-02-14 23:04:54'),
(2, 3, 2, 2, 'DD260215707F002', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem', NULL, 55.00, 15.00, 0.00, NULL, 70.00, 'pending', 'credit_card', 'package', '2026-02-14 23:07:08', '2026-02-14 23:07:08'),
(4, 3, 3, 3, 'DD2602155F2C003', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'pending', 'credit_card', 'package', '2026-02-14 23:09:09', '2026-02-14 23:09:09'),
(5, 3, 2, 2, 'DD260215E3ED004', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'paid', 'credit_card', 'package', '2026-02-14 23:09:32', '2026-02-14 23:10:29'),
(6, 3, 3, 3, 'DD2602151E12005', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'paid', 'credit_card', 'package', '2026-02-14 23:12:46', '2026-02-14 23:13:12'),
(7, 3, 3, 3, 'DD2602157D16006', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 55.00, 15.00, 0.00, NULL, 70.00, 'pending', 'credit_card', 'package', '2026-02-14 23:51:59', '2026-02-14 23:51:59'),
(8, 3, 2, 2, 'DD2602152278007', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 55.00, 15.00, 0.00, NULL, 70.00, 'pending', 'credit_card', 'package', '2026-02-14 23:54:37', '2026-02-14 23:54:37'),
(9, 3, 3, 3, 'DD26021531BE008', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'pending', 'credit_card', 'package', '2026-02-14 23:57:35', '2026-02-14 23:57:35'),
(10, 3, 3, 3, 'DD260215257B009', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 75.00, 15.00, 0.00, NULL, 90.00, 'pending', 'credit_card', 'package', '2026-02-14 23:58:00', '2026-02-14 23:58:00'),
(11, 3, 3, 3, 'DD260215C6A8010', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'pending', 'credit_card', 'package', '2026-02-14 23:58:25', '2026-02-14 23:58:25'),
(12, 3, 4, 4, 'DD260215C348011', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 75.00, 15.00, 0.00, NULL, 90.00, 'pending', 'credit_card', 'package', '2026-02-14 23:58:53', '2026-02-14 23:58:53'),
(13, 3, 3, 3, 'DD260215CAC8012', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 75.00, 15.00, 0.00, NULL, 90.00, 'pending', 'credit_card', 'package', '2026-02-15 00:03:32', '2026-02-15 00:03:32'),
(14, 3, 2, 2, 'DD260215D5BA013', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'pending', 'credit_card', 'package', '2026-02-15 00:05:08', '2026-02-15 00:05:08'),
(15, 3, 2, 2, 'DD26021560A0014', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'pending', 'credit_card', 'package', '2026-02-15 00:06:51', '2026-02-15 00:06:51'),
(16, 3, 3, 3, 'DD260215BB2D015', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 75.00, 15.00, 0.00, NULL, 90.00, 'pending', 'credit_card', 'package', '2026-02-15 00:15:05', '2026-02-15 00:15:05'),
(17, 3, 2, 2, 'DD260215E480016', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 75.00, 15.00, 0.00, NULL, 90.00, 'pending', 'credit_card', 'package', '2026-02-15 00:15:28', '2026-02-15 00:15:28'),
(18, 3, 3, 3, 'DD2602153B0E017', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 75.00, 15.00, 0.00, NULL, 90.00, 'pending', 'credit_card', 'package', '2026-02-15 00:15:45', '2026-02-15 00:15:45'),
(19, 3, 2, 2, 'DD260215BA78018', 'cancelled', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'refunded', 'credit_card', 'package', '2026-02-15 00:27:34', '2026-02-15 00:33:44'),
(20, 3, 2, 2, 'DD260215541A019', 'cancelled', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 60.00, 15.00, 0.00, NULL, 75.00, 'refunded', 'credit_card', 'package', '2026-02-15 00:28:27', '2026-02-15 00:32:15'),
(21, 3, 1, 1, 'DD2602151A2E020', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 120.00, 15.00, 0.00, NULL, 135.00, 'paid', 'credit_card', 'package', '2026-02-15 00:56:52', '2026-02-15 00:56:52'),
(22, 3, 1, 1, 'DD26021545D9021', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 100.00, 15.00, 0.00, NULL, 115.00, 'paid', 'credit_card', 'package', '2026-02-15 00:58:38', '2026-02-15 00:58:38'),
(23, 3, 1, 1, 'DD2602157398022', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 135.00, 15.00, 0.00, NULL, 150.00, 'paid', 'credit_card', 'package', '2026-02-15 01:02:02', '2026-02-15 01:02:02'),
(24, 3, 1, 1, 'DD2602154D5C023', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 135.00, 15.00, 0.00, NULL, 150.00, 'paid', 'credit_card', 'package', '2026-02-15 01:05:14', '2026-02-15 01:05:14'),
(25, 3, 1, 1, 'DD26021595D8024', 'cancelled', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 135.00, 15.00, 0.00, NULL, 150.00, 'refunded', 'credit_card', 'package', '2026-02-15 01:06:15', '2026-02-15 01:06:29'),
(26, 3, 1, 1, 'DD260215DB4D025', 'delivered', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 180.00, 15.00, 0.00, NULL, 195.00, 'paid', 'credit_card', 'package', '2026-02-15 01:08:37', '2026-02-15 01:08:52'),
(27, 3, 1, 1, 'DD2602153710026', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 135.00, 0.00, 0.00, NULL, 135.00, 'paid', 'credit_card', 'package', '2026-02-15 02:46:23', '2026-02-15 02:46:23'),
(28, 3, 1, 1, 'DD260215CD5A027', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 110.00, 0.00, 0.00, NULL, 110.00, 'paid', 'credit_card', 'package', '2026-02-15 02:49:56', '2026-02-15 02:49:56'),
(29, 7, 1, 1, 'DD260216C268001', 'confirmed', 'Kütahya Mağazası - Mağaza', '', 'Mağaza Müşterisi', 'Hızlı satış - Nakit', 55.00, 0.00, 0.00, NULL, 55.00, 'paid', 'nakit', 'quick_sale', '2026-02-16 19:41:52', '2026-02-16 19:41:52'),
(30, 3, 1, 1, 'DD260216E95C002', 'pending', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 135.00, 0.00, 0.00, NULL, 135.00, 'paid', 'credit_card', 'package', '2026-02-16 20:06:44', '2026-02-16 20:06:44'),
(31, 9, 1, 1, 'DD260216F328003', 'confirmed', 'Kütahya Mağazası - Mağaza', '', 'Mağaza Müşterisi', 'Hızlı satış - Nakit: 30.00 ₺, Kredi/Banka Kartı: 20.00 ₺', 50.00, 0.00, 0.00, NULL, 50.00, 'paid', 'nakit', 'quick_sale', '2026-02-16 20:28:31', '2026-02-16 20:28:31'),
(32, 9, 1, 1, 'DD2602166BA9004', 'confirmed', 'Kütahya Mağazası - Mağaza', '', 'Mağaza Müşterisi', 'Hızlı satış - Nakit: 50.00 ₺', 50.00, 0.00, 0.00, NULL, 50.00, 'paid', 'nakit', 'quick_sale', '2026-02-16 20:30:14', '2026-02-16 20:30:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `options` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `total`, `options`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Filtre Kahve', 55.00, 1, 55.00, NULL, '2026-02-14 23:04:54', '2026-02-14 23:04:54'),
(2, 2, 2, 'Filtre Kahve', 55.00, 1, 55.00, NULL, '2026-02-14 23:07:08', '2026-02-14 23:07:08'),
(4, 4, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-14 23:09:09', '2026-02-14 23:09:09'),
(5, 5, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-14 23:09:32', '2026-02-14 23:09:32'),
(6, 6, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-14 23:12:46', '2026-02-14 23:12:46'),
(7, 7, 2, 'Filtre Kahve', 55.00, 1, 55.00, NULL, '2026-02-14 23:51:59', '2026-02-14 23:51:59'),
(8, 8, 2, 'Filtre Kahve', 55.00, 1, 55.00, NULL, '2026-02-14 23:54:37', '2026-02-14 23:54:37'),
(9, 9, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-14 23:57:35', '2026-02-14 23:57:35'),
(10, 10, 4, 'Latte', 75.00, 1, 75.00, NULL, '2026-02-14 23:58:00', '2026-02-14 23:58:00'),
(11, 11, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-14 23:58:25', '2026-02-14 23:58:25'),
(12, 12, 4, 'Latte', 75.00, 1, 75.00, NULL, '2026-02-14 23:58:53', '2026-02-14 23:58:53'),
(13, 13, 4, 'Latte', 75.00, 1, 75.00, NULL, '2026-02-15 00:03:32', '2026-02-15 00:03:32'),
(14, 14, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-15 00:05:08', '2026-02-15 00:05:08'),
(15, 15, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-15 00:06:51', '2026-02-15 00:06:51'),
(16, 16, 4, 'Latte', 75.00, 1, 75.00, NULL, '2026-02-15 00:15:05', '2026-02-15 00:15:05'),
(17, 17, 4, 'Latte', 75.00, 1, 75.00, NULL, '2026-02-15 00:15:28', '2026-02-15 00:15:28'),
(18, 18, 4, 'Latte', 75.00, 1, 75.00, NULL, '2026-02-15 00:15:45', '2026-02-15 00:15:45'),
(19, 19, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-15 00:27:34', '2026-02-15 00:27:34'),
(20, 20, 3, 'Americano', 60.00, 1, 60.00, NULL, '2026-02-15 00:28:27', '2026-02-15 00:28:27'),
(21, 21, 3, 'Americano', 60.00, 2, 120.00, NULL, '2026-02-15 00:56:52', '2026-02-15 00:56:52'),
(22, 22, 1, 'Türk Kahvesi', 45.00, 1, 45.00, NULL, '2026-02-15 00:58:38', '2026-02-15 00:58:38'),
(23, 22, 2, 'Filtre Kahve', 55.00, 1, 55.00, NULL, '2026-02-15 00:58:38', '2026-02-15 00:58:38'),
(24, 23, 1, 'Türk Kahvesi', 45.00, 3, 135.00, NULL, '2026-02-15 01:02:02', '2026-02-15 01:02:02'),
(25, 24, 1, 'Türk Kahvesi', 45.00, 3, 135.00, NULL, '2026-02-15 01:05:14', '2026-02-15 01:05:14'),
(26, 25, 1, 'Türk Kahvesi', 45.00, 3, 135.00, NULL, '2026-02-15 01:06:15', '2026-02-15 01:06:15'),
(27, 26, 1, 'Türk Kahvesi', 45.00, 4, 180.00, NULL, '2026-02-15 01:08:37', '2026-02-15 01:08:37'),
(28, 27, 1, 'Türk Kahvesi', 45.00, 3, 135.00, NULL, '2026-02-15 02:46:23', '2026-02-15 02:46:23'),
(29, 28, 2, 'Filtre Kahve', 55.00, 2, 110.00, NULL, '2026-02-15 02:49:56', '2026-02-15 02:49:56'),
(30, 29, 2, 'Filtre Kahve', 55.00, 1, 55.00, NULL, '2026-02-16 19:41:52', '2026-02-16 19:41:52'),
(31, 30, 1, 'Türk Kahvesi', 45.00, 3, 135.00, NULL, '2026-02-16 20:06:44', '2026-02-16 20:06:44'),
(32, 31, 8, 'Sütlü Türk Kahvesi', 50.00, 1, 50.00, NULL, '2026-02-16 20:28:31', '2026-02-16 20:28:31'),
(33, 32, 8, 'Sütlü Türk Kahvesi', 50.00, 1, 50.00, NULL, '2026-02-16 20:30:14', '2026-02-16 20:30:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_status_logs`
--

CREATE TABLE `order_status_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `order_status_logs`
--

INSERT INTO `order_status_logs` (`id`, `order_id`, `status`, `updated_by`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:04:54', '2026-02-14 23:04:54'),
(2, 2, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:07:08', '2026-02-14 23:07:08'),
(4, 4, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:09:09', '2026-02-14 23:09:09'),
(5, 5, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:09:32', '2026-02-14 23:09:32'),
(6, 6, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:12:46', '2026-02-14 23:12:46'),
(7, 7, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:51:59', '2026-02-14 23:51:59'),
(8, 8, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:54:37', '2026-02-14 23:54:37'),
(9, 9, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:57:35', '2026-02-14 23:57:35'),
(10, 10, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:58:00', '2026-02-14 23:58:00'),
(11, 11, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:58:25', '2026-02-14 23:58:25'),
(12, 12, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-14 23:58:53', '2026-02-14 23:58:53'),
(13, 13, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-15 00:03:32', '2026-02-15 00:03:32'),
(14, 14, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-15 00:05:08', '2026-02-15 00:05:08'),
(15, 15, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-15 00:06:51', '2026-02-15 00:06:51'),
(16, 16, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-15 00:15:05', '2026-02-15 00:15:05'),
(17, 17, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-15 00:15:28', '2026-02-15 00:15:28'),
(18, 18, 'pending', 3, 'Sipariş oluşturuldu', '2026-02-15 00:15:45', '2026-02-15 00:15:45'),
(19, 19, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 00:27:34', '2026-02-15 00:27:34'),
(20, 20, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 00:28:27', '2026-02-15 00:28:27'),
(21, 20, 'pending', 1, NULL, '2026-02-15 00:30:28', '2026-02-15 00:30:28'),
(22, 20, 'cancelled', 1, ' (İyzico iade işlemi başarılı)', '2026-02-15 00:32:15', '2026-02-15 00:32:15'),
(23, 19, 'cancelled', 1, ' (İyzico iade işlemi başarılı)', '2026-02-15 00:33:44', '2026-02-15 00:33:44'),
(24, 21, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 00:56:52', '2026-02-15 00:56:52'),
(25, 22, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 00:58:38', '2026-02-15 00:58:38'),
(26, 23, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 01:02:02', '2026-02-15 01:02:02'),
(27, 24, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 01:05:14', '2026-02-15 01:05:14'),
(28, 25, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 01:06:15', '2026-02-15 01:06:15'),
(29, 25, 'cancelled', 1, ' (İyzico iade işlemi başarılı)', '2026-02-15 01:06:29', '2026-02-15 01:06:29'),
(30, 26, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 01:08:37', '2026-02-15 01:08:37'),
(31, 26, 'delivered', 1, NULL, '2026-02-15 01:08:52', '2026-02-15 01:08:52'),
(32, 27, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 02:46:23', '2026-02-15 02:46:23'),
(33, 28, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-15 02:49:56', '2026-02-15 02:49:56'),
(34, 29, 'confirmed', 7, 'Hızlı satış - Nakit ödeme alındı', '2026-02-16 19:41:52', '2026-02-16 19:41:52'),
(35, 30, 'pending', 3, 'Sipariş oluşturuldu (ödeme alındı)', '2026-02-16 20:06:44', '2026-02-16 20:06:44'),
(36, 31, 'confirmed', 9, 'Hızlı satış - Nakit: 30.00 ₺, Kredi/Banka Kartı: 20.00 ₺', '2026-02-16 20:28:31', '2026-02-16 20:28:31'),
(37, 32, 'confirmed', 9, 'Hızlı satış - Nakit: 50.00 ₺', '2026-02-16 20:30:14', '2026-02-16 20:30:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'TRY',
  `payment_method` varchar(255) DEFAULT NULL,
  `response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`response`)),
  `error_message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_id`, `status`, `amount`, `currency`, `payment_method`, `response`, `error_message`, `created_at`, `updated_at`) VALUES
(1, 5, '28613080', 'SUCCESS', 75.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613080\",\"basket_id\":\"DD260215E3ED004\",\"paid_price\":75,\"error_message\":null}', NULL, '2026-02-14 23:10:29', '2026-02-14 23:10:29'),
(2, 6, '28613097', 'SUCCESS', 75.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613097\",\"basket_id\":\"DD2602151E12005\",\"paid_price\":75,\"error_message\":null}', NULL, '2026-02-14 23:13:12', '2026-02-14 23:13:12'),
(3, 19, '28613235', 'SUCCESS', 75.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613235\",\"basket_id\":\"DD260215BA78018\",\"paid_price\":75,\"error_message\":null}', NULL, '2026-02-15 00:27:34', '2026-02-15 00:27:34'),
(4, 20, '28613233', 'SUCCESS', 75.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613233\",\"basket_id\":\"DD260215541A019\",\"paid_price\":75,\"error_message\":null}', NULL, '2026-02-15 00:28:27', '2026-02-15 00:28:27'),
(5, 21, '28613359', 'SUCCESS', 135.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613359\",\"basket_id\":\"DD2602151A2E020\",\"paid_price\":135,\"error_message\":null}', NULL, '2026-02-15 00:56:52', '2026-02-15 00:56:52'),
(6, 22, '28613354', 'SUCCESS', 115.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613354\",\"basket_id\":\"DD26021545D9021\",\"paid_price\":115,\"error_message\":null}', NULL, '2026-02-15 00:58:38', '2026-02-15 00:58:38'),
(7, 23, '28613372', 'SUCCESS', 150.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613372\",\"basket_id\":\"DD2602157398022\",\"paid_price\":150,\"error_message\":null}', NULL, '2026-02-15 01:02:02', '2026-02-15 01:02:02'),
(8, 24, '28613393', 'SUCCESS', 150.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613393\",\"basket_id\":\"DD2602154D5C023\",\"paid_price\":150,\"error_message\":null}', NULL, '2026-02-15 01:05:14', '2026-02-15 01:05:14'),
(9, 25, '28613399', 'SUCCESS', 150.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613399\",\"basket_id\":\"DD26021595D8024\",\"paid_price\":150,\"error_message\":null}', NULL, '2026-02-15 01:06:15', '2026-02-15 01:06:15'),
(10, 26, '28613403', 'SUCCESS', 195.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613403\",\"basket_id\":\"DD260215DB4D025\",\"paid_price\":195,\"error_message\":null}', NULL, '2026-02-15 01:08:37', '2026-02-15 01:08:37'),
(11, 27, '28613747', 'SUCCESS', 135.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613747\",\"basket_id\":\"DD2602153710026\",\"paid_price\":135,\"error_message\":null}', NULL, '2026-02-15 02:46:23', '2026-02-15 02:46:23'),
(12, 28, '28613750', 'SUCCESS', 110.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28613750\",\"basket_id\":\"DD260215CD5A027\",\"paid_price\":110,\"error_message\":null}', NULL, '2026-02-15 02:49:56', '2026-02-15 02:49:56'),
(13, 30, '28623712', 'SUCCESS', 135.00, 'TRY', NULL, '{\"status\":\"success\",\"payment_status\":\"SUCCESS\",\"payment_id\":\"28623712\",\"basket_id\":\"DD260216E95C002\",\"paid_price\":135,\"error_message\":null}', NULL, '2026-02-16 20:06:44', '2026-02-16 20:06:44'),
(14, 31, NULL, 'paid', 30.00, 'TRY', 'nakit', NULL, NULL, '2026-02-16 20:28:31', '2026-02-16 20:28:31'),
(15, 31, NULL, 'paid', 20.00, 'TRY', 'kart', NULL, NULL, '2026-02-16 20:28:31', '2026-02-16 20:28:31'),
(16, 32, NULL, 'paid', 50.00, 'TRY', 'nakit', NULL, NULL, '2026-02-16 20:30:14', '2026-02-16 20:30:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pending_checkouts`
--

CREATE TABLE `pending_checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_fee` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cart_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cart_items`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `pending_checkouts`
--

INSERT INTO `pending_checkouts` (`id`, `order_number`, `user_id`, `city_id`, `address`, `phone`, `customer_name`, `notes`, `subtotal`, `delivery_fee`, `total`, `cart_items`, `created_at`) VALUES
(2, 'DD2602154F10019', 3, 2, 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4 — Adres tarifi: Apartmanın 3. katı, kapıyı çalın.', '05552012131', 'meltem Beşikçi', NULL, 60.00, 15.00, 75.00, '[{\"product_id\":3,\"product_name\":\"Americano\",\"price\":60,\"quantity\":1,\"total\":60}]', '2026-02-15 00:28:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(2, 'orders.view', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(3, 'orders.create', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(4, 'orders.update', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(5, 'orders.delete', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(6, 'products.view', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(7, 'products.create', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(8, 'products.update', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(9, 'products.delete', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(10, 'categories.view', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(11, 'categories.create', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(12, 'categories.update', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(13, 'categories.delete', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(14, 'cities.view', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(15, 'cities.create', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(16, 'cities.update', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(17, 'cities.delete', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(18, 'users.view', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(19, 'users.create', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(20, 'users.update', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(21, 'users.delete', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(22, 'roles.view', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(23, 'roles.create', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(24, 'roles.update', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(25, 'roles.delete', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(26, 'activity_log.view', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(27, 'settings.view', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(28, 'settings.update', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `category_id`, `store_id`, `city_id`, `name`, `slug`, `description`, `price`, `image`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Türk Kahvesi', 'turk-kahvesi', 'Türk Kahvesi - DrDrink özel tarifi', 45.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(2, 1, 1, NULL, 'Filtre Kahve', 'filtre-kahve', 'Filtre Kahve - DrDrink özel tarifi', 55.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(3, 1, 1, NULL, 'Americano', 'americano', 'Americano - DrDrink özel tarifi', 60.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(4, 1, 1, NULL, 'Latte', 'latte', 'Latte - DrDrink özel tarifi', 75.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(5, 1, 1, NULL, 'Cappuccino', 'cappuccino', 'Cappuccino - DrDrink özel tarifi', 70.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(6, 1, 1, NULL, 'Mocha', 'mocha', 'Mocha - DrDrink özel tarifi', 80.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(7, 1, 1, NULL, 'Espresso', 'espresso', 'Espresso - DrDrink özel tarifi', 50.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(8, 1, 1, NULL, 'Sütlü Türk Kahvesi', 'sutlu-turk-kahvesi', 'Sütlü Türk Kahvesi - DrDrink özel tarifi', 50.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(9, 2, 1, NULL, 'Buzlu Americano', 'buzlu-americano', 'Buzlu Americano - DrDrink özel tarifi', 65.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(10, 2, 1, NULL, 'Buzlu Latte', 'buzlu-latte', 'Buzlu Latte - DrDrink özel tarifi', 80.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(11, 2, 1, NULL, 'Cold Brew', 'cold-brew', 'Cold Brew - DrDrink özel tarifi', 70.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(12, 2, 1, NULL, 'Frappuccino', 'frappuccino', 'Frappuccino - DrDrink özel tarifi', 85.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(13, 3, 1, NULL, 'Çay', 'cay', 'Çay - DrDrink özel tarifi', 25.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(14, 3, 1, NULL, 'Yeşil Çay', 'yesil-cay', 'Yeşil Çay - DrDrink özel tarifi', 30.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(15, 3, 1, NULL, 'Earl Grey', 'earl-grey', 'Earl Grey - DrDrink özel tarifi', 35.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(16, 3, 1, NULL, 'Sıcak Çikolata', 'sicak-cikolata', 'Sıcak Çikolata - DrDrink özel tarifi', 55.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(17, 4, 1, NULL, 'Taze Sıkılmış Portakal Suyu', 'taze-sikilmis-portakal-suyu', 'Taze Sıkılmış Portakal Suyu - DrDrink özel tarifi', 65.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(18, 4, 1, NULL, 'Limonata', 'limonata', 'Limonata - DrDrink özel tarifi', 45.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(19, 4, 1, NULL, 'Ayran', 'ayran', 'Ayran - DrDrink özel tarifi', 25.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(20, 4, 1, NULL, 'Soda', 'soda', 'Soda - DrDrink özel tarifi', 20.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(21, 5, 1, NULL, 'Kurabiye', 'kurabiye', 'Kurabiye - DrDrink özel tarifi', 35.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(22, 5, 1, NULL, 'Pasta Dilimi', 'pasta-dilimi', 'Pasta Dilimi - DrDrink özel tarifi', 55.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(23, 5, 1, NULL, 'Sandviç', 'sandvic', 'Sandviç - DrDrink özel tarifi', 65.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(24, 1, 1, 1, 'Kütahya Özel Karışım', 'kutahya-ozel-karisim', 'Sadece Kütahya\'da - Özel karışım kahvemiz', 65.00, NULL, 1, 0, '2026-02-14 19:03:15', '2026-02-14 19:03:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2026-02-14 19:03:14', '2026-02-14 19:03:14'),
(2, 'Yönetici', 'web', '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(3, 'Personel', 'web', '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(4, 'Mağaza Yöneticisi', 'web', '2026-02-15 01:34:17', '2026-02-15 01:34:17'),
(5, 'Kasiyer', 'web', '2026-02-15 02:26:06', '2026-02-15 02:26:06');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 1),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(7, 1),
(7, 4),
(8, 1),
(8, 2),
(8, 4),
(9, 1),
(10, 1),
(10, 2),
(10, 4),
(11, 1),
(11, 4),
(12, 1),
(12, 4),
(13, 1),
(14, 1),
(14, 2),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(18, 2),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(26, 2),
(27, 1),
(27, 4),
(28, 1),
(28, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3TnzO2m7SBOx3rMJWeVFTOaEWClbaZ2SqzTHyUYs', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVW9QQW0yOG5EMDNKdzlHcWJ1a1VjWGN6WWlSVE13NWNSNXQ3c25HZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9sb2NhbGhvc3QvZHJkcmluayI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771268856),
('ECWhUBpgYc6d2VCiumgB7RVUF0KGGgk9kEjYGw2O', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQlZ0c1UwMzk1UWJOZVRoQUI5ejlSVkN3RllIQjA2WjhMWWVLblZIQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771273273),
('HW7EcjGj2n82X1ux7Tt6BnDLpwpvpqAbzYaM1bdA', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHQ1Y1YwY3k0VnN0d08yTDdmbm43WG9Rc3h0amtJejBvUWJtQ29oNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9sb2NhbGhvc3QvZHJkcmluayI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1771276350),
('JuSP8hn6nn2pl9MNVcWHuzv2RbSqHIh1gTZ9P7rr', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHg5eXBUcUtBblZXbzJCUFJBUHhlUlBoNHFZRmxHaXZZckpZeHpwNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9sb2NhbGhvc3QvZHJkcmluayI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771481693),
('Ng0IS603JSysQM7p8XNuvZqjmvElZKb8X6r84cG4', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkV2WkxoeElJWGhMc0hjOGEwbW1zVzZFRGVVNVBCajNvY0kweVo0NiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9sb2NhbGhvc3QvZHJkcmluayI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1771276781),
('xfEqgeSNFysoQW5AOie7EKxJoMWwXVpcynnxLH7y', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTkVJTjRGVEV6ZWlTMlJsM2Y0bjg1N3FEbHNVajlzOU01d3RSR256NiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771271347),
('ymF6mCxUCBQiOyUXyp9U74RZdGt6Ey1kCRC8rMeC', 3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiblo5TmdNTWZHaTk1eGt2UENSZVdLZ0h2UHJ2UE9SbGo4T0NRRFVXayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3QvZHJkcmluay9vZGVtZSI7czo1OiJyb3V0ZSI7czoxNDoiY2hlY2tvdXQuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6MTI6ImRyZHJpbmtfY2l0eSI7aToxO3M6MTI6ImRyZHJpbmtfY2FydCI7YToxOntpOjE7aTozO319', 1771272375);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `min_order_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `stores`
--

INSERT INTO `stores` (`id`, `city_id`, `name`, `slug`, `min_order_amount`, `delivery_fee`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kütahya Mağazası', 'kutahya-magaza', 100.00, 0.00, 1, 1, '2026-02-15 01:19:19', '2026-02-15 01:19:19'),
(2, 2, 'İstanbul Mağazası', 'istanbul-magaza', 90.00, 0.00, 1, 2, '2026-02-15 01:19:19', '2026-02-15 01:19:19'),
(3, 3, 'Ankara Mağazası', 'ankara-magaza', 80.00, 0.00, 1, 3, '2026-02-15 01:19:19', '2026-02-15 01:19:19'),
(4, 4, 'İzmir Mağazası', 'izmir-magaza', 110.00, 0.00, 1, 4, '2026-02-15 01:19:19', '2026-02-15 01:19:19'),
(5, 5, 'Bursa Mağazası', 'bursa-magaza', 60.00, 0.00, 1, 5, '2026-02-15 01:19:19', '2026-02-15 01:19:19'),
(6, 6, 'Antalya Mağazası', 'antalya-magaza', 99.00, 0.00, 1, 6, '2026-02-15 01:19:19', '2026-02-15 01:19:19'),
(7, 7, 'Eskişehir Mağazası', 'eskisehir-magaza', 0.00, 0.00, 1, 7, '2026-02-15 01:19:19', '2026-02-15 01:19:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `store_user`
--

CREATE TABLE `store_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'manager',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `store_user`
--

INSERT INTO `store_user` (`id`, `user_id`, `store_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'manager', '2026-02-15 01:34:18', '2026-02-15 01:34:18'),
(3, 7, 1, 'cashier', '2026-02-15 02:32:46', '2026-02-15 02:32:46'),
(4, 6, 3, 'manager', '2026-02-15 02:41:04', '2026-02-15 02:41:04'),
(5, 8, 3, 'cashier', '2026-02-16 19:48:45', '2026-02-16 19:48:45'),
(6, 9, 1, 'cashier', '2026-02-16 20:18:38', '2026-02-16 20:18:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@drdrink.com', '05321234567', NULL, '$2y$12$5O7tYLcrJ5UvI1.Byt1spuyiiaeAfiOtyfMEa.cm91dud6FnQ5JZ6', NULL, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(2, 'Yönetici', 'yonetici@drdrink.com', '05329876543', NULL, '$2y$12$XcRkAduVUtIyeHBnyIMnN.hO90Jft2WzfyrOb/jyzgqaRisgsKswe', NULL, '2026-02-14 19:03:15', '2026-02-14 19:03:15'),
(3, 'meltem Beşikçi', 'meltembesikci@gmail.com', '05552012131', NULL, '$2y$12$cl4OFzNp1UCATOlVcqFV7OfKCi1HBrYy1q/wh5imgTSvk4fxMewn6', NULL, '2026-02-14 22:37:01', '2026-02-14 23:31:34'),
(4, 'meltem', 'meltem@drdrink.com', '05552012131', NULL, '$2y$12$aRATtB8GQi72b4avUg7sjOW8ks4i2qImXIG1a0zSlfA5iP472wf9i', NULL, '2026-02-14 22:56:26', '2026-02-14 22:56:26'),
(5, 'Mağaza Yöneticisi', 'magaza@drdrink.com', '05321112233', NULL, '$2y$12$ZK0z3Tq2zs3mYHUIurD7u.fDIVtaYJVvWa4Bxgh8yc0jciS78ZQMm', NULL, '2026-02-15 01:34:18', '2026-02-15 01:34:18'),
(6, 'amine Bahçe', 'testmagaza@drdrink.com', NULL, NULL, '$2y$12$4oQVpK2DkzcVw3jnSjrNPuUgxfVbk2wZly.KRhBMIMuy2Ru7z8AG6', NULL, '2026-02-15 02:18:42', '2026-02-15 02:18:42'),
(7, 'kasiyer', 'kasiyer@drdrink.com', NULL, NULL, '$2y$12$pSMlH2OwRbBAo7.aIm9pzOsiUHhUPyZaBJB9qoSRMpTF8R7AQpZoK', NULL, '2026-02-15 02:32:46', '2026-02-15 02:32:46'),
(8, 'testkasiyer', 'testkasiyer@drdrink.com', NULL, NULL, '$2y$12$GbIutaIxWUvipmh39aUMKegkLqNBwZ3pZGOiAAL9RPI2tRezGW0.K', NULL, '2026-02-16 19:48:45', '2026-02-16 19:48:45'),
(9, 'kasiyer2', 'kasiyer2@drdrink.com', NULL, NULL, '$2y$12$cWC0p.zOWDgb6AMp5aTpbeRUtO55CLj3GUMQATVYbfqZilSspl186', NULL, '2026-02-16 20:18:38', '2026-02-16 20:18:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `avenue` varchar(255) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `address_instructions` text DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `city_id`, `district`, `neighborhood`, `street`, `avenue`, `building`, `apartment`, `address_instructions`, `title`, `address`, `phone`, `is_default`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 'Kadıköy', 'Caferağa Mah.', 'Moda Cad.', NULL, '15', '4', 'Apartmanın 3. katı, kapıyı çalın.', 'Ev', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4', '05552012131', 1, '2026-02-14 22:55:25', '2026-02-14 22:55:25'),
(3, 1, 1, 'Merkez', 'Cumhuriyet Mah.', 'Atatürk Bulvarı', NULL, '42', '7', 'Site girişinde bekleyin, zil çalışmıyor.', 'İş', 'Kütahya, Merkez, Cumhuriyet Mah., Atatürk Bulvarı, No: 42, Daire: 7', '05321234567', 0, '2026-02-14 22:55:25', '2026-02-14 22:55:25'),
(4, 4, 2, 'Kadıköy', 'Caferağa Mah.', 'Moda Cad.', NULL, '15', '4', 'Apartmanın 3. katı, kapıyı çalın.', 'Ev', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4', '05552012131', 1, '2026-02-14 22:56:26', '2026-02-14 22:56:26'),
(5, 4, 1, 'Merkez', 'Cumhuriyet Mah.', 'Atatürk Bulvarı', NULL, '42', '7', 'Site girişinde bekleyin, zil çalışmıyor.', 'İş', 'Kütahya, Merkez, Cumhuriyet Mah., Atatürk Bulvarı, No: 42, Daire: 7', '05321234567', 0, '2026-02-14 22:56:26', '2026-02-14 22:56:26'),
(6, 3, 2, 'Kadıköy', 'Caferağa Mah.', 'Moda Cad.', NULL, '15', '4', 'Apartmanın 3. katı, kapıyı çalın.', 'Ev', 'İstanbul, Kadıköy, Caferağa Mah., Moda Cad., No: 15, Daire: 4', '05552012131', 1, '2026-02-14 22:57:09', '2026-02-14 22:57:09'),
(7, 3, 1, 'Merkez', 'Cumhuriyet Mah.', 'Atatürk Bulvarı', NULL, '42', '7', 'Site girişinde bekleyin, zil çalışmıyor.', 'İş', 'Kütahya, Merkez, Cumhuriyet Mah., Atatürk Bulvarı, No: 42, Daire: 7', '05321234567', 0, '2026-02-14 22:57:09', '2026-02-14 22:57:09');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Tablo için indeksler `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Tablo için indeksler `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_store_id_foreign` (`store_id`);

--
-- Tablo için indeksler `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_slug_unique` (`slug`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Tablo için indeksler `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Tablo için indeksler `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_city_id_foreign` (`city_id`),
  ADD KEY `orders_status_city_id_index` (`status`,`city_id`),
  ADD KEY `orders_created_at_index` (`created_at`),
  ADD KEY `orders_store_id_foreign` (`store_id`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Tablo için indeksler `order_status_logs`
--
ALTER TABLE `order_status_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_logs_order_id_foreign` (`order_id`),
  ADD KEY `order_status_logs_updated_by_foreign` (`updated_by`);

--
-- Tablo için indeksler `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Tablo için indeksler `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Tablo için indeksler `pending_checkouts`
--
ALTER TABLE `pending_checkouts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pending_checkouts_order_number_unique` (`order_number`),
  ADD KEY `pending_checkouts_user_id_foreign` (`user_id`),
  ADD KEY `pending_checkouts_city_id_foreign` (`city_id`);

--
-- Tablo için indeksler `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_city_id_is_active_index` (`city_id`,`is_active`),
  ADD KEY `products_store_id_foreign` (`store_id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Tablo için indeksler `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Tablo için indeksler `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Tablo için indeksler `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stores_city_id_unique` (`city_id`);

--
-- Tablo için indeksler `store_user`
--
ALTER TABLE `store_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `store_user_user_id_store_id_unique` (`user_id`,`store_id`),
  ADD KEY `store_user_store_id_foreign` (`store_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Tablo için indeksler `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`),
  ADD KEY `user_addresses_city_id_foreign` (`city_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Tablo için AUTO_INCREMENT değeri `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Tablo için AUTO_INCREMENT değeri `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `order_status_logs`
--
ALTER TABLE `order_status_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `pending_checkouts`
--
ALTER TABLE `pending_checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `store_user`
--
ALTER TABLE `store_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `order_status_logs`
--
ALTER TABLE `order_status_logs`
  ADD CONSTRAINT `order_status_logs_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_status_logs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `pending_checkouts`
--
ALTER TABLE `pending_checkouts`
  ADD CONSTRAINT `pending_checkouts_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_checkouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `store_user`
--
ALTER TABLE `store_user`
  ADD CONSTRAINT `store_user_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
