-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Oct 02, 2020 at 03:06 PM
-- Server version: 5.7.22
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agent`
--

-- --------------------------------------------------------

--
-- Table structure for table `parsing_pages`
--

CREATE TABLE `parsing_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `category` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `housingtype` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parsing_pages`
--

INSERT INTO `parsing_pages` (`id`, `site_id`, `category`, `housingtype`, `city`, `region`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Алмазарский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=20', 1, '2020-10-01 19:01:12', '2020-10-01 19:01:12'),
(2, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Бектемирский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=18', 1, '2020-10-01 19:02:20', '2020-10-01 19:02:20'),
(3, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Мирабадский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=13', 1, '2020-10-01 19:02:56', '2020-10-01 19:02:56'),
(4, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Мирзо-Улугбекский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=12', 1, '2020-10-01 19:03:44', '2020-10-01 19:03:44'),
(5, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Сергелийский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=19', 1, '2020-10-01 19:04:18', '2020-10-01 19:04:18'),
(6, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Учтепинский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=21', 1, '2020-10-01 19:04:54', '2020-10-01 19:04:54'),
(7, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Чиланзарский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=23', 1, '2020-10-01 19:06:42', '2020-10-01 19:06:42'),
(8, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Юнусабадский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=25', 1, '2020-10-01 19:06:51', '2020-10-01 19:06:51'),
(9, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Яккасарайский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=26', 1, '2020-10-01 19:08:52', '2020-10-01 19:08:52'),
(10, 1, 'Продажа', 'Вторичный рынок', 'Ташкент', 'Яшнабадский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/tashkent/?search%5Bdistrict_id%5D=22', 1, '2020-10-01 19:09:57', '2020-10-01 19:09:57'),
(11, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Алмазарский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=20', 1, '2020-10-01 19:01:12', '2020-10-02 09:14:25'),
(12, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Бектемирский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=18', 1, '2020-10-01 19:02:20', '2020-10-02 09:14:25'),
(13, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Мирабадский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=13', 1, '2020-10-01 19:02:56', '2020-10-02 09:14:25'),
(14, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Мирзо-Улугбекский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=12', 1, '2020-10-01 19:03:44', '2020-10-02 09:14:25'),
(15, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Сергелийский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=19', 1, '2020-10-01 19:04:18', '2020-10-02 09:14:25'),
(16, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Учтепинский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=21', 1, '2020-10-01 19:04:54', '2020-10-02 09:14:25'),
(17, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Чиланзарский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=23', 1, '2020-10-01 19:06:42', '2020-10-02 09:14:25'),
(18, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Юнусабадский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=25', 1, '2020-10-01 19:06:51', '2020-10-02 09:14:25'),
(19, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Яккасарайский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=26', 1, '2020-10-01 19:08:52', '2020-10-02 09:14:25'),
(20, 1, 'Продажа', 'Новостройки', 'Ташкент', 'Яшнабадский район', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/tashkent/?search%5Bdistrict_id%5D=22', 1, '2020-10-01 19:09:57', '2020-10-02 09:14:25'),
(21, 1, 'Продажа', 'Вторичный рынок', 'Ташкентская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/toshkent-oblast/', 1, '2020-10-02 09:16:33', '2020-10-02 12:55:54'),
(22, 1, 'Продажа', 'Новостройки', 'Ташкентская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/toshkent-oblast/', 1, '2020-10-02 09:17:02', '2020-10-02 12:56:02'),
(23, 1, 'Продажа', 'Вторичный рынок', 'Андижанская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/andizhanskaya-oblast/', 1, '2020-10-02 09:18:46', '2020-10-02 13:00:34'),
(24, 1, 'Продажа', 'Вторичный рынок', 'Бухарская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/buharskaya-oblast/', 1, '2020-10-02 09:19:25', '2020-10-02 13:00:57'),
(25, 1, 'Продажа', 'Вторичный рынок', 'Джиззакская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/dzhizakskaya-oblast/', 1, '2020-10-02 09:21:46', '2020-10-02 13:01:17'),
(26, 1, 'Продажа', 'Вторичный рынок', 'Республика Каракалпакстан', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/karakalpakstan/', 1, '2020-10-02 09:23:10', '2020-10-02 13:02:07'),
(27, 1, 'Продажа', 'Вторичный рынок', 'Кашкадарьинская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/kashkadarinskaya-oblast/', 1, '2020-10-02 09:24:01', '2020-10-02 13:02:54'),
(28, 1, 'Продажа', 'Вторичный рынок', 'Навоийская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/navoijskaya-oblast/', 1, '2020-10-02 09:24:25', '2020-10-02 13:03:12'),
(29, 1, 'Продажа', 'Вторичный рынок', 'Наманганская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/namanganskaya-oblast/', 1, '2020-10-02 09:24:54', '2020-10-02 13:03:36'),
(30, 1, 'Продажа', 'Вторичный рынок', 'Самаркандская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/samarkandskaya-oblast/', 1, '2020-10-02 09:25:29', '2020-10-02 12:59:52'),
(31, 1, 'Продажа', 'Вторичный рынок', 'Сурхандарьинская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/surhandarinskaya-oblast/', 1, '2020-10-02 09:26:31', '2020-10-02 13:05:30'),
(32, 1, 'Продажа', 'Вторичный рынок', 'Сирдарьинская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/syrdarinskaya-oblast/', 1, '2020-10-02 09:27:45', '2020-10-02 13:03:54'),
(33, 1, 'Продажа', 'Вторичный рынок', 'Ферганская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/ferganskaya-oblast/', 1, '2020-10-02 09:28:12', '2020-10-02 13:04:15'),
(34, 1, 'Продажа', 'Вторичный рынок', 'Хорезмская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/vtorichnyy-rynok/horezmskaya-oblast/', 1, '2020-10-02 09:29:20', '2020-10-02 13:04:35'),
(35, 1, 'Продажа', 'Новостройки', 'Сурхандарьинская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/surhandarinskaya-oblast/', 1, '2020-10-02 09:26:31', '2020-10-02 13:05:30'),
(36, 1, 'Продажа', 'Новостройки', 'Самаркандская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/samarkandskaya-oblast/', 1, '2020-10-02 09:25:29', '2020-10-02 12:59:52'),
(37, 1, 'Продажа', 'Новостройки', 'Наманганская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/namanganskaya-oblast/', 1, '2020-10-02 09:24:54', '2020-10-02 13:03:36'),
(38, 1, 'Продажа', 'Новостройки', 'Навоийская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/navoijskaya-oblast/', 1, '2020-10-02 09:24:25', '2020-10-02 13:03:12'),
(39, 1, 'Продажа', 'Новостройки', 'Кашкадарьинская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/kashkadarinskaya-oblast/', 1, '2020-10-02 09:24:01', '2020-10-02 13:02:54'),
(40, 1, 'Продажа', 'Новостройки', 'Республика Каракалпакстан', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/karakalpakstan/', 1, '2020-10-02 09:23:10', '2020-10-02 13:02:07'),
(41, 1, 'Продажа', 'Новостройки', 'Джиззакская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/dzhizakskaya-oblast/', 1, '2020-10-02 09:21:46', '2020-10-02 13:01:17'),
(42, 1, 'Продажа', 'Новостройки', 'Бухарская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/buharskaya-oblast/', 1, '2020-10-02 09:19:25', '2020-10-02 13:00:57'),
(43, 1, 'Продажа', 'Новостройки', 'Андижанская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/andizhanskaya-oblast/', 1, '2020-10-02 09:18:46', '2020-10-02 13:00:34'),
(44, 1, 'Продажа', 'Новостройки', 'Хорезмская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/horezmskaya-oblast/', 1, '2020-10-02 09:29:20', '2020-10-02 13:04:35'),
(45, 1, 'Продажа', 'Новостройки', 'Ферганская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/ferganskaya-oblast/', 1, '2020-10-02 09:28:12', '2020-10-02 13:04:15'),
(46, 1, 'Продажа', 'Новостройки', 'Сирдарьинская область', '', 'https://www.olx.uz/nedvizhimost/kvartiry/prodazha/novostroyki/syrdarinskaya-oblast/', 1, '2020-10-02 09:27:45', '2020-10-02 13:03:54'),
(49, 2, 'Продажа', 'Вторичный рынок', 'Ташкент', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-tashkente?order=created_at-DESC', 1, '2020-10-02 11:35:08', '2020-10-02 11:35:08'),
(50, 2, 'Продажа', 'Вторичный рынок', 'Самаркандская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-samarkandskoy-oblasti?operation_type_code=sale&region_id=9&category_id=23&order=created_at-DESC', 1, '2020-10-02 11:35:27', '2020-10-02 12:59:52'),
(51, 2, 'Продажа', 'Вторичный рынок', 'Андижанская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-andizhanskoy-oblasti?operation_type_code=sale&region_id=3&category_id=23&order=created_at-DESC', 1, '2020-10-02 11:52:24', '2020-10-02 13:00:34'),
(52, 2, 'Продажа', 'Вторичный рынок', 'Бухарская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-buharskoy-oblasti?operation_type_code=sale&region_id=4&category_id=23&order=created_at-DESC', 1, '2020-10-02 11:53:44', '2020-10-02 13:00:57'),
(53, 2, 'Продажа', 'Вторичный рынок', 'Джиззакская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-buharskoy-oblasti?operation_type_code=sale&region_id=5&category_id=23&order=created_at-DESC', 1, '2020-10-02 11:54:51', '2020-10-02 13:01:17'),
(54, 2, 'Продажа', 'Вторичный рынок', 'Кашкадарьинская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-kashkadar-inskoy-oblasti?operation_type_code=sale&region_id=6&category_id=23&order=created_at-DESC', 1, '2020-10-02 11:56:10', '2020-10-02 13:02:54'),
(55, 2, 'Продажа', 'Вторичный рынок', 'Навоийская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-kashkadar-inskoy-oblasti?operation_type_code=sale&region_id=7&category_id=23&order=created_at-DESC', 1, '2020-10-02 12:02:54', '2020-10-02 13:03:12'),
(56, 2, 'Продажа', 'Вторичный рынок', 'Наманганская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-namanganskoy-oblasti?operation_type_code=sale&region_id=8&category_id=23&order=created_at-DESC', 1, '2020-10-02 12:06:14', '2020-10-02 13:03:36'),
(57, 2, 'Продажа', 'Вторичный рынок', 'Республика Каракалпакстан', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-respublike-karakalpakstan?operation_type_code=sale&region_id=2&category_id=23&order=created_at-DESC', 1, '2020-10-02 12:08:23', '2020-10-02 13:02:07'),
(58, 2, 'Продажа', 'Вторичный рынок', 'Сирдарьинская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-sirdar-inskoy-oblasti?operation_type_code=sale&region_id=11&category_id=23&order=created_at-DESC', 1, '2020-10-02 12:12:24', '2020-10-02 13:03:54'),
(59, 2, 'Продажа', 'Вторичный рынок', 'Сурхандарьинская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-surhandar-inskoy-oblasti?operation_type_code=sale&region_id=10&category_id=23&order=created_at-DESC', 1, '2020-10-02 12:13:41', '2020-10-02 13:05:30'),
(60, 2, 'Продажа', 'Вторичный рынок', 'Ферганская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-ferganskoy-oblasti?operation_type_code=sale&region_id=14&category_id=23&order=created_at-DESC', 1, '2020-10-02 12:15:30', '2020-10-02 13:04:15'),
(61, 2, 'Продажа', 'Вторичный рынок', 'Хорезмская область', '', 'https://m.uybor.uz/ru/prodazha-kvartir/kvartiry-v-horezmskoy-oblasti?operation_type_code=sale&region_id=15&category_id=23&order=created_at-DESC', 1, '2020-10-02 12:17:07', '2020-10-02 13:04:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parsing_pages`
--
ALTER TABLE `parsing_pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parsing_pages`
--
ALTER TABLE `parsing_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
