-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2018 at 06:07 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `land`
--

-- --------------------------------------------------------

--
-- Table structure for table `donators`
--

CREATE TABLE `donators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summ` int(11) NOT NULL,
  `last_payment` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donators`
--

INSERT INTO `donators` (`id`, `name`, `email`, `format_name`, `monthly`, `summ`, `last_payment`, `created_at`, `updated_at`) VALUES
(1, 'Семен Семенович', 'aaaaa@sssssss.dd', 'Спасибо!', 'Разово', 1000, NULL, '2018-09-27 16:33:41', '2018-09-27 16:33:41'),
(2, 'Иванов Иван Иванович', 'dfgfd@dgd.rt', 'Попечитель', 'Ежемесячно', 5000, NULL, '2018-09-27 16:36:22', '2018-09-27 16:36:22'),
(3, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-27 16:50:54', '2018-09-27 16:50:54'),
(4, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-27 16:52:17', '2018-09-27 16:52:17'),
(5, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 07:09:23', '2018-09-28 07:09:23'),
(6, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 07:11:30', '2018-09-28 07:11:30'),
(7, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 07:12:39', '2018-09-28 07:12:39'),
(8, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 07:15:04', '2018-09-28 07:15:04'),
(9, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 07:17:31', '2018-09-28 07:17:31'),
(10, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 07:18:46', '2018-09-28 07:18:46'),
(11, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 07:22:07', '2018-09-28 07:22:07'),
(12, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 08:15:18', '2018-09-28 08:15:18'),
(13, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 08:17:02', '2018-09-28 08:17:02'),
(14, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 08:18:21', '2018-09-28 08:18:21'),
(15, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 08:22:43', '2018-09-28 08:22:43'),
(16, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 08:44:20', '2018-09-28 08:44:20'),
(17, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 08:48:32', '2018-09-28 08:48:32'),
(18, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 08:49:28', '2018-09-28 08:49:28'),
(19, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 09:05:30', '2018-09-28 09:05:30'),
(20, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 09:12:42', '2018-09-28 09:12:42'),
(21, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 09:46:07', '2018-09-28 09:46:07'),
(22, 'Игорь Игоревич', 'fffffffffff@ddddddd.dd', 'Доброжелатель', 'Ежемесячно', 250, NULL, '2018-09-28 09:49:46', '2018-09-28 09:49:46'),
(23, 'Семен семеныч', 'webkonditer@yandex.ru', 'Единомышленник', 'Ежемесячно', 1000, NULL, '2018-09-28 09:59:40', '2018-09-28 09:59:40'),
(24, 'Иван Иванович', 'dd@sd.sd', 'Помощник', 'Ежемесячно', 500, NULL, '2018-09-28 10:05:59', '2018-09-28 10:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `formats`
--

CREATE TABLE `formats` (
  `id` int(10) UNSIGNED NOT NULL,
  `position` int(10) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summ` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formats`
--

INSERT INTO `formats` (`id`, `position`, `image`, `name`, `summ`, `monthly`, `bonus_1`, `bonus_2`, `created_at`, `updated_at`) VALUES
(1, 1, 'i/formatsImage/AXNGgFwPhB90iwTxQirSpWaQzEeBE4BHfXcEKhM4.jpeg', 'Спасибо!', '1000', 'Разово', 'Возможность послужить в миссии;', 'Благодарственная грамота;', '2018-09-27 06:45:49', '2018-09-27 08:48:03'),
(3, 2, 'i/formatsImage/iFcgKigZKS3q6WbX0YxmoLJN57PHpAWCk16GKwZY.jpeg', 'Доброжелатель', '250', 'Ежемесячно', 'Бонус участника \"Спасибо\";', 'Ежемесячный вебинар об образовании (1);', '2018-09-27 08:49:28', '2018-09-27 08:49:28'),
(4, 3, 'i/formatsImage/6j6Z7oeXKODOasH0hZi4RVuflCGVsfHIilxlb8Ac.jpeg', 'Помощник', '500', 'Ежемесячно', 'Бонус участника \"Доброжелатель\";', 'Участие в чате WhatsApp (2);', '2018-09-27 08:53:32', '2018-09-27 08:53:32'),
(5, 4, 'i/formatsImage/xNL7oPp7cA0J2cbBN9Xj9CMs8LVg52XSfFS0oUTa.jpeg', 'Единомышленник', '1000', 'Ежемесячно', 'Бонус участника \"Помощник\";', 'Имя на доске участников клуба (3);', '2018-09-27 08:54:54', '2018-09-27 08:54:54'),
(6, 5, 'i/formatsImage/zjYuv1ZTV2pyNMvX9oCvIqm2Kxlz9FAnyEVOnTP0.jpeg', 'Соратник', '2500', 'Ежемесячно', 'Бонус участника \"Единомышленник\";', 'Бесплатные онлайн-курсы нашего отдела (4);', '2018-09-27 08:57:20', '2018-09-27 10:24:24'),
(7, 6, 'i/formatsImage/4XLAJ1knctGdbqhHJfsUWuA4Nwv4kN5hIf0nlC7m.jpeg', 'Попечитель', '5000', 'Ежемесячно', 'Бонус участника \"Соратник\";', 'Бесплатное обучение в Индии (5);', '2018-09-27 08:59:56', '2018-09-27 09:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_20_123941_create_table_pages', 1),
(6, '2018_09_20_124336_create_table_peoples', 1),
(7, '2018_09_26_162947_create_formats_table', 2),
(8, '2018_09_27_172332_create_donators_table', 3),
(9, '2018_09_27_183039_create_payments_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `alias`, `text`, `images`, `created_at`, `updated_at`) VALUES
(1, 'home', 'home', '<h2><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Мы создаем </font></font><strong><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">удивительные</font></font></strong><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\"> веб-шаблоны</font></font></h2>', 'main_device_image.png', NULL, NULL),
(3, 'about us', 'aboutUs', '<p><font style=\"vertical-align: inherit;\"><font style=\"vertical-align: inherit;\">Lorem Ipsum - просто фиктивный текст печатной и печатной промышленности. </font><font style=\"vertical-align: inherit;\">Lorem Ipsum был стандартным фиктивным текстовым принтером в отрасли, который взял камбуз типа и скремблировал его, чтобы сделать типовой экземпляр.</font></font></p>', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `donator_id` int(11) NOT NULL,
  `format_id` int(11) NOT NULL,
  `monthly` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summ` int(11) NOT NULL,
  `confirmation` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `donator_id`, `format_id`, `monthly`, `summ`, `confirmation`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 'Ежемесячно', 250, NULL, '2018-09-27 16:52:17', '2018-09-27 16:52:17'),
(2, 5, 3, 'Ежемесячно', 250, NULL, '2018-09-28 07:09:23', '2018-09-28 07:09:23'),
(3, 6, 3, 'Ежемесячно', 250, NULL, '2018-09-28 07:11:30', '2018-09-28 07:11:30'),
(4, 7, 3, 'Ежемесячно', 250, NULL, '2018-09-28 07:12:39', '2018-09-28 07:12:39'),
(5, 8, 3, 'Ежемесячно', 250, NULL, '2018-09-28 07:15:04', '2018-09-28 07:15:04'),
(6, 9, 3, 'Ежемесячно', 250, NULL, '2018-09-28 07:17:31', '2018-09-28 07:17:31'),
(7, 10, 3, 'Ежемесячно', 250, NULL, '2018-09-28 07:18:46', '2018-09-28 07:18:46'),
(8, 11, 3, 'Ежемесячно', 250, NULL, '2018-09-28 07:22:07', '2018-09-28 07:22:07'),
(9, 12, 3, 'Ежемесячно', 250, NULL, '2018-09-28 08:15:18', '2018-09-28 08:15:18'),
(10, 13, 3, 'Ежемесячно', 250, NULL, '2018-09-28 08:17:02', '2018-09-28 08:17:02'),
(11, 14, 3, 'Ежемесячно', 250, NULL, '2018-09-28 08:18:21', '2018-09-28 08:18:21'),
(12, 15, 3, 'Ежемесячно', 250, NULL, '2018-09-28 08:22:43', '2018-09-28 08:22:43'),
(13, 16, 3, 'Ежемесячно', 250, NULL, '2018-09-28 08:44:20', '2018-09-28 08:44:20'),
(14, 17, 3, 'Ежемесячно', 250, NULL, '2018-09-28 08:48:32', '2018-09-28 08:48:32'),
(15, 18, 3, 'Ежемесячно', 250, NULL, '2018-09-28 08:49:28', '2018-09-28 08:49:28'),
(16, 19, 3, 'Ежемесячно', 250, NULL, '2018-09-28 09:05:30', '2018-09-28 09:05:30'),
(17, 20, 3, 'Ежемесячно', 250, NULL, '2018-09-28 09:12:42', '2018-09-28 09:12:42'),
(18, 21, 3, 'Ежемесячно', 250, NULL, '2018-09-28 09:46:07', '2018-09-28 09:46:07'),
(19, 22, 3, 'Ежемесячно', 250, NULL, '2018-09-28 09:49:46', '2018-09-28 09:49:46'),
(20, 23, 5, 'Ежемесячно', 1000, NULL, '2018-09-28 09:59:40', '2018-09-28 09:59:40'),
(21, 24, 4, 'Ежемесячно', 500, NULL, '2018-09-28 10:05:59', '2018-09-28 10:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `peoples`
--

CREATE TABLE `peoples` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posicion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peoples`
--

INSERT INTO `peoples` (`id`, `name`, `posicion`, `images`, `text`, `created_at`, `updated_at`) VALUES
(1, 'Том Ренд', 'Директор компании', 'team_pic1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Проин, следовательно, sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin следовательно.', NULL, NULL),
(2, 'Катрен Мори', 'Старший менеджер', 'team_pic2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Проин, следовательно, sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin следовательно.', NULL, NULL),
(3, 'Lancer Jack', 'Старший менеджер', 'team_pic3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Проин, следовательно, sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin следовательно.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Narottam Vilas', 'webkonditer@yandex.ru', NULL, '$2y$10$whFt1xk/LscoI6b8rDYFTOjYsdJeHP38KpZ8.aqCBNq9MO2Oi8Cie', 'x2MunSa8nY6lMVXaknhWfZH70jCg1kFjLVQpNYoHnyEWMhbatwfyzl6S57hL', '2018-09-26 13:26:59', '2018-09-26 13:26:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donators`
--
ALTER TABLE `donators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formats`
--
ALTER TABLE `formats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peoples`
--
ALTER TABLE `peoples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donators`
--
ALTER TABLE `donators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `formats`
--
ALTER TABLE `formats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `peoples`
--
ALTER TABLE `peoples`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
