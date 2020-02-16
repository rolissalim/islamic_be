-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2019 at 10:41 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `islamic_studies_ver_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(100) NOT NULL,
  `fullname` varchar(191) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `fullname`, `description`, `created_at`, `updated_at`) VALUES
('4c60b2c7b3f24cd19ed3854fac7a2e90', 'Tahsin', 'perbaikan bacaan al quran ', '2019-05-17 07:02:36', '2019-05-07 09:38:41'),
('d044a28048d247c399a8290a051cdfd4', 'Tilawah', 'menambah ilmu tentang agama islam berdasarkan ql al quran dan sunnah', '2019-05-17 07:12:03', '2019-05-07 09:54:01'),
('d48bfd6a649a481c949437f5d16dcf54', 'Maqomat', 'belajar irama membaca al quran ', '2019-05-17 07:09:42', '2019-05-07 09:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` varchar(100) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `country_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `fullname`, `latitude`, `longitude`, `country_id`, `created_at`, `updated_at`) VALUES
('39dedbf22fce44a58c9291484a884a64', 'Kota Cimahi', '-6.8840816', '107.5413039', 'f0d483bd54314e549223acd693e56a56', '2019-05-08 02:21:51', '2019-05-08 02:21:51'),
('8240657c7cc547df9d256219ab8700a1', 'Kota Bandung', '-6.9174639', '107.6191228', 'f0d483bd54314e549223acd693e56a56', '2019-05-06 09:04:45', '2019-05-06 09:04:45'),
('8788b92094a0472eb7a4f397b63f2ebe', 'Kabupaten Bandung', '-7.1340702', '107.6215321', 'f0d483bd54314e549223acd693e56a56', '2019-05-06 09:05:09', '2019-05-06 09:05:09'),
('911a55d552674ea3b0199b6a0382b95c', 'Kuala Lumpur', '3.1390030', '101.6868550', 'd14ed5e23f7f43fdb4012c3c123a68d5', '2019-05-15 03:16:29', '2019-05-15 03:16:29'),
('a253e5b79a2d4e68921c2f95c3094682', 'Kabupaten Bandung Barat', '-6.8652214', '107.4919767', 'f0d483bd54314e549223acd693e56a56', '2019-05-06 09:04:59', '2019-05-06 09:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` varchar(100) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `province` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `fullname`, `province`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
('d14ed5e23f7f43fdb4012c3c123a68d5', 'Malaysia', 1, '4.2104840', '101.9757660', '2019-05-06 09:02:18', '2019-05-06 09:02:18'),
('f0d483bd54314e549223acd693e56a56', 'Indonesia', 1, '-0.7892750', '113.9213270', '2019-05-06 09:02:09', '2019-05-06 09:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `image_mosque`
--

CREATE TABLE `image_mosque` (
  `id` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `mosque_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_mosque`
--

INSERT INTO `image_mosque` (`id`, `path`, `mosque_id`, `created_at`, `updated_at`) VALUES
('2620487d807b422bb81ff90bbc345ea1', 'assets/img/uploads/mosque/3c64f7962e88255e1984f59e7f37c5d4.JPG', '6079d338c42a4dd1a38de655f2fb71c9', '2019-05-06 09:51:52', '2019-05-06 09:51:52'),
('aaf97d79db1a4aa4a9e14744de25438a', 'assets/img/uploads/mosque/1d6ca3ab46048788044029ee4b40fa95.jpg', 'baa398e1029f4f9e8a31a8711df6c2af', '2019-05-06 09:35:11', '2019-05-06 09:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_04_26_101534_create_table_country', 1),
(9, '2019_05_03_094131_create_city', 1),
(10, '2019_05_05_082841_create_mosque', 1),
(11, '2019_05_06_101117_create_table_image_mosque', 1),
(12, '2019_05_07_144253_create_table_type_research', 2),
(13, '2019_05_07_155226_create_table_categery', 3),
(14, '2019_05_07_155448_create_table_categery', 4),
(15, '2019_05_07_155544_create_table_post', 5),
(17, '2019_05_09_094148_create_table_resource_person', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mosque`
--

CREATE TABLE `mosque` (
  `id` varchar(100) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `city_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mosque`
--

INSERT INTO `mosque` (`id`, `fullname`, `address`, `phonenumber`, `latitude`, `longitude`, `city_id`, `created_at`, `updated_at`) VALUES
('6079d338c42a4dd1a38de655f2fb71c9', 'Masjid Raya Bandung', 'Jl. Dalem Kaum No.14 Balonggede Regol', NULL, '-6.9217094', '107.6063572', '8240657c7cc547df9d256219ab8700a1', '2019-05-06 09:51:52', '2019-05-06 09:51:52'),
('baa398e1029f4f9e8a31a8711df6c2af', 'Masjid Al Lathiif', 'Jl. Saninten No.2 Cihapit Bandung Wetan', NULL, '-6.9079965', '107.6278698', '8240657c7cc547df9d256219ab8700a1', '2019-05-06 09:35:11', '2019-05-06 09:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0b9684317eb0ffa5648d6fdc8fabb3c02d7d61c92f62b5660b4fed7d313c610fd662183f38a2b08b', '1380075f280441ff9b2322a1a1d3035c', 1, 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', '[]', 0, '2019-07-05 09:22:23', '2019-07-05 09:22:23', '2020-07-05 16:22:23'),
('0c4cf8b0941954c5059d653bc386fda9173a95c230b04102a48d6d46e292be787182c239ed775e64', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-05 09:34:25', '2019-07-05 09:34:25', '2020-07-05 16:34:25'),
('2c916982957b36da0a5c6961466d7eeed18cd48dc19f8d26f01f8b021a1ac55a32a37f8da5f5f91b', '1380075f280441ff9b2322a1a1d3035c', 1, 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', '[]', 0, '2019-09-21 09:30:50', '2019-09-21 09:30:50', '2020-09-21 16:30:50'),
('40bd84d128ec6e8a25d8f55bce109e2d5ccc94e3df47507436664a670616c9f315467e019aece11e', '1380075f280441ff9b2322a1a1d3035c', 1, 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', '[]', 0, '2019-09-15 12:34:36', '2019-09-15 12:34:36', '2020-09-15 19:34:36'),
('4a2516757f82732e48cf1b441b903a2d02b14993414ef9c754663b8cbd46b330ab2710d5d1cd2707', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-05 09:37:57', '2019-07-05 09:37:57', '2020-07-05 16:37:57'),
('504b0974645d66f4f67d7561a53027189b150c691bbb60bfccadb0773a5d136c2568786104ae6991', '1380075f280441ff9b2322a1a1d3035c', 1, 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', '[]', 0, '2019-06-27 03:55:45', '2019-06-27 03:55:45', '2020-06-27 10:55:45'),
('6b2cb5efbdf77be1bee85a3c4cb0f5b114dd4eec2ffb29b471d73958f15fa736da8c3a736718b97c', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-05 09:31:00', '2019-07-05 09:31:00', '2020-07-05 16:31:00'),
('8aa09f1d78fac7b637a7b618dd95819adc17086ebf07bf82077702f199ff62fe032c92783a169ca6', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-04 07:45:30', '2019-07-04 07:45:30', '2020-07-04 14:45:30'),
('8f85080fef274d8b8e5e41e5ad3ff60f2d5b85b13aabb83277887d2207778f2dee0dbd9e4177a17e', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-05 09:23:03', '2019-07-05 09:23:03', '2020-07-05 16:23:03'),
('b4ad4bab819caf5178218272c58794b687543e0b2e9dde2dcdcec8b5f4828e626c1b6a945652a911', '1380075f280441ff9b2322a1a1d3035c', 1, 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', '[]', 0, '2019-09-15 09:21:15', '2019-09-15 09:21:15', '2020-09-15 16:21:15'),
('b65f053c370f6aecacac6e7b74da2ae42421a669fcdb0c28218161f510693f324f0e33b51bc90114', '1380075f280441ff9b2322a1a1d3035c', 1, 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', '[]', 0, '2019-07-04 10:19:04', '2019-07-04 10:19:04', '2020-07-04 17:19:04'),
('b9cd81561a35f43028983db616cee99847da26dac5b144b1f21b8ce7dd7d9addb8d62a4fd9169a46', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-05 09:43:05', '2019-07-05 09:43:05', '2020-07-05 16:43:05'),
('d4dec27daa55b8e5f9f4ecccf9dbb5716b2be0a3a5f3b7f18cc2894f325ccb7331ee600fc843d309', '1380075f280441ff9b2322a1a1d3035c', 1, 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', '[]', 0, '2019-09-29 06:28:25', '2019-09-29 06:28:25', '2020-09-29 13:28:25'),
('dbef2d726b7083ebc867271c6c335d08459e73428e46dcd846ebd97c8e2fccf27bfff6a91c02bc27', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-04 10:29:23', '2019-07-04 10:29:23', '2020-07-04 17:29:23'),
('eee1558f6dfd4618275efc1edd36b1c7657d066fd6938a27409b39de39cf0cd1931d6bda1a3a4cfc', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-04 07:45:48', '2019-07-04 07:45:48', '2020-07-04 14:45:48'),
('f9f624a45a4352e471e186664289924e8070259b3804c3a63403bf237942ce30b835d24d7a554f62', '1380075f280441ff9b2322a1a1d3035c', 1, 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', '[]', 0, '2019-07-04 08:44:06', '2019-07-04 08:44:06', '2020-07-04 15:44:06'),
('fe6efecd40b4648ad6a38b33299289b3cba906f73acb5096388a1377d53a01e57902d82be3677343', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-05 09:31:38', '2019-07-05 09:31:38', '2020-07-05 16:31:38'),
('ff483cd4f095bd58aa14e3de21a3e7694f7174f8a74e38405e690787e853a5dc1f616c32327fd011', '1380075f280441ff9b2322a1a1d3035c', 2, NULL, '[\"*\"]', 0, '2019-07-05 09:20:22', '2019-07-05 09:20:22', '2020-07-05 16:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'wgcIcKZxnpVWnUjl5PqhQpYJkBAGE7g5kSN78P2K', 'http://localhost', 1, 0, 0, '2019-05-06 08:52:17', '2019-05-06 08:52:17'),
(2, NULL, 'Laravel Password Grant Client', 'F3BWblGRoxVDmkyUFF0rj438ZuHGlTYq5y4bQSLM', 'http://localhost', 0, 1, 0, '2019-05-06 08:52:17', '2019-05-06 08:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-05-06 08:52:17', '2019-05-06 08:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('11f4638e26103fbb729d8ead7bff37dc63fb019579c9c6a07c537de3d9e6bcf77a85e560a3b53104', '8aa09f1d78fac7b637a7b618dd95819adc17086ebf07bf82077702f199ff62fe032c92783a169ca6', 0, '2020-07-04 14:45:30'),
('446bad0449916b6f96bff2276fb001601664652d6f41236a4eb2c9f750f6d05def57ec92cbd4ed31', '4a2516757f82732e48cf1b441b903a2d02b14993414ef9c754663b8cbd46b330ab2710d5d1cd2707', 0, '2020-07-05 16:37:57'),
('57ba772d77bcb82626dbc2e744395df08f6fdddd6e2ffb977aac98db5cd2042ac1ac2fba0fb2cc7b', 'fe6efecd40b4648ad6a38b33299289b3cba906f73acb5096388a1377d53a01e57902d82be3677343', 0, '2020-07-05 16:31:38'),
('97618216fb0c3517029b0b3c8a1e97f069b68434643c7bc2ada6e9af0308ee69b3a965f3611a2610', '0c4cf8b0941954c5059d653bc386fda9173a95c230b04102a48d6d46e292be787182c239ed775e64', 0, '2020-07-05 16:34:25'),
('c1a7d85172fdf977fc289a68f62b4c8395f988c0e560ca2db33f5b98eb43a7f3eadbc92a246955c9', 'dbef2d726b7083ebc867271c6c335d08459e73428e46dcd846ebd97c8e2fccf27bfff6a91c02bc27', 0, '2020-07-04 17:29:23'),
('cf0845cfef2c5d2b0fa3f1f4ee576af27d9d1057ac9e7271bf3caf331fd7d3c68cc687755c87235e', '8f85080fef274d8b8e5e41e5ad3ff60f2d5b85b13aabb83277887d2207778f2dee0dbd9e4177a17e', 0, '2020-07-05 16:23:03'),
('d28e3dd8eed9e71c193e796f1b0476644f2fb5bf6c48aa41a5e5fb39358f1b86cf7fd45a7c681451', 'eee1558f6dfd4618275efc1edd36b1c7657d066fd6938a27409b39de39cf0cd1931d6bda1a3a4cfc', 0, '2020-07-04 14:45:48'),
('d7713a1ab7dc6dff516afc9281c83f82689ba726483e1ed6fb0d06235a9ad61057e40b58ac746ba4', 'b9cd81561a35f43028983db616cee99847da26dac5b144b1f21b8ce7dd7d9addb8d62a4fd9169a46', 0, '2020-07-05 16:43:05'),
('e4be9a51efab1db156f5671344971edba409a0d69d734c4beda780ffb5c04bb64f09f234e06dc97b', 'ff483cd4f095bd58aa14e3de21a3e7694f7174f8a74e38405e690787e853a5dc1f616c32327fd011', 0, '2020-07-05 16:20:22'),
('f0e41b2c416c268baeb592aba0859f901c3d387b33ebdc34f2d24a62c3e64d525a5dd413b23c4904', '6b2cb5efbdf77be1bee85a3c4cb0f5b114dd4eec2ffb29b471d73958f15fa736da8c3a736718b97c', 0, '2020-07-05 16:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `mosque_id` varchar(100) DEFAULT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `resource_person_id` varchar(100) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `periodic` tinyint(1) NOT NULL,
  `post_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `text`, `mosque_id`, `category_id`, `resource_person_id`, `theme`, `path`, `periodic`, `post_time`, `created_at`, `updated_at`) VALUES
('07d28aa772d24a5f8643ce2e2420c01a', '1380075f280441ff9b2322a1a1d3035c', 'test 2', '6079d338c42a4dd1a38de655f2fb71c9', 'd044a28048d247c399a8290a051cdfd4', '353687124dc548d58152b13311917d5f', 'al quran sebagai pedoman hidup', 'assets/img/uploads/post/ac0de2e17d190a087f1f64a33f410ffc.jpg', 0, '2019-05-12 13:00:00', '2019-05-11 04:03:27', '2019-05-11 04:03:27'),
('215d214d7a0a48ce84238e9d62eb58b8', '1380075f280441ff9b2322a1a1d3035c', 'test 2', '6079d338c42a4dd1a38de655f2fb71c9', 'd044a28048d247c399a8290a051cdfd4', '353687124dc548d58152b13311917d5f', 'al quran sebagai pedoman hidup', 'assets/img/uploads/post/3385c7ae62bc1bbc1e56a9f354ad9407.jpg', 0, '2019-05-11 15:00:00', '2019-05-11 04:02:27', '2019-05-11 04:02:27'),
('7ffbf46cb3ab4b8ab6605dbb0acd1b10', '1380075f280441ff9b2322a1a1d3035c', 'test', 'baa398e1029f4f9e8a31a8711df6c2af', 'd48bfd6a649a481c949437f5d16dcf54', '353687124dc548d58152b13311917d5f', 'tilawah', 'assets/img/uploads/post/28d65ad84f979c988b1c12b7050cd651.jpg', 0, '2019-05-09 16:00:00', '2019-05-08 09:46:23', '2019-05-08 09:46:23'),
('af11aa5d5c6841858561400d4f288a3c', '1380075f280441ff9b2322a1a1d3035c', 'test', 'baa398e1029f4f9e8a31a8711df6c2af', 'd48bfd6a649a481c949437f5d16dcf54', '353687124dc548d58152b13311917d5f', 'belajar maqom', 'assets/img/uploads/post/7d0b23b4ac6fb588f0e6c4d2ec0d4b3f.jpg', 1, '2019-05-13 11:00:00', '2019-05-11 04:11:30', '2019-05-11 04:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `resource_person`
--

CREATE TABLE `resource_person` (
  `id` varchar(100) NOT NULL,
  `fullname` varchar(191) NOT NULL,
  `alamat` text,
  `phonenumber` varchar(15) DEFAULT NULL,
  `education_degree` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `city_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resource_person`
--

INSERT INTO `resource_person` (`id`, `fullname`, `alamat`, `phonenumber`, `education_degree`, `image`, `city_id`, `created_at`, `updated_at`) VALUES
('353687124dc548d58152b13311917d5f', 'Adi Hidayat', NULL, NULL, 'Lc MA', 'assets/img/uploads/resource_person/213b8cbb3dffed7a5f4568ed3b91b394.jpg', '8240657c7cc547df9d256219ab8700a1', '2019-05-09 07:26:55', '2019-05-09 07:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(100) NOT NULL,
  `fullname` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `address` text,
  `status` varchar(10) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `phonenumber` varchar(15) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status_account` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(191) DEFAULT NULL,
  `city_id` varchar(100) DEFAULT NULL,
  `api_token` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `gender`, `address`, `status`, `email`, `phonenumber`, `email_verified_at`, `status_account`, `image`, `city_id`, `api_token`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('0ac6f5d9f5ec41d8b0120ca485db4883', 'rita rita', 'rita_rita', NULL, NULL, NULL, 'rita@gmail.com', NULL, NULL, 1, NULL, 'a253e5b79a2d4e68921c2f95c3094682', '$2y$10$OZg8W2CJF/oL/dB1H7Ltw.PN3cej2HbiMATQhEaYnN9TCrovjsFtu', '$2y$10$RhgyPtEhLKZUmprvRlzNcOzHUciptq5mZAaUpZ5wj6PaXiPK517iO', NULL, '2019-05-15 06:58:28', '2019-05-15 06:58:28'),
('1380075f280441ff9b2322a1a1d3035c', 'Nurdin Rolissalim', 'nurdin_rolissalim', NULL, NULL, NULL, 'nurdinif14@gmail.com', NULL, NULL, 1, NULL, '8240657c7cc547df9d256219ab8700a1', '$2y$10$E53geicqXGLAZ5xC.Q1ZZup.I1sHHPxVjUNIMxMdoGzGx/b1wnb9G', '$2y$10$5aFx2QDECl6PlR8RNg0rSuwVXz1Lqc6IkT/Xx8JcFftnaR6goVq/a', NULL, '2019-05-06 08:53:22', '2019-05-06 08:53:22'),
('88dc5697c307421aa9bff33d0fd5f097', 'arie wungkul', 'ari_wungkul', NULL, NULL, NULL, 'arie@gmail.com', NULL, NULL, 1, NULL, '911a55d552674ea3b0199b6a0382b95c', '$2y$10$hJMx6GB2T0ofcENqA0PoMOlyBHqkwg3ZMDmuOWsp1/i9rBNlqn1RC', '$2y$10$Geir6y1XetnIwpKjucc/CeOVSbuXz8qR2nxDwiVaNHV8v8jgKgdLW', NULL, '2019-05-15 03:21:50', '2019-05-15 03:21:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_fullname_unique` (`fullname`),
  ADD KEY `city_country_id_index` (`country_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_fullname_unique` (`fullname`);

--
-- Indexes for table `image_mosque`
--
ALTER TABLE `image_mosque`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image_mosque_path_unique` (`path`),
  ADD KEY `image_mosque_mosque_id_index` (`mosque_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mosque`
--
ALTER TABLE `mosque`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mosque_fullname_unique` (`fullname`),
  ADD UNIQUE KEY `mosque_phonenumber_unique` (`phonenumber`),
  ADD KEY `mosque_city_id_index` (`city_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `mosques_id` (`mosque_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `resource_person_id` (`resource_person_id`);

--
-- Indexes for table `resource_person`
--
ALTER TABLE `resource_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_person_city_id_index` (`city_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_city_id_index` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_mosque`
--
ALTER TABLE `image_mosque`
  ADD CONSTRAINT `image_mosque_mosque_id_foreign` FOREIGN KEY (`mosque_id`) REFERENCES `mosque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mosque`
--
ALTER TABLE `mosque`
  ADD CONSTRAINT `mosque_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`mosque_id`) REFERENCES `mosque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`resource_person_id`) REFERENCES `resource_person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resource_person`
--
ALTER TABLE `resource_person`
  ADD CONSTRAINT `resource_person_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
