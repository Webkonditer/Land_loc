-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2018 at 09:11 PM
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donators`
--

INSERT INTO `donators` (`id`, `name`, `email`, `format_name`, `monthly`, `summ`, `last_payment`, `created_at`, `updated_at`, `city`) VALUES
(37, 'Влад Петрович', 'dfgfd@dgd.rt', 'Единомышленник', 'Ежемесячно', 1000, NULL, '2018-10-02 11:48:47', '2018-10-02 11:48:47', 'Москва'),
(38, 'Влад Петрович', 'dfgfd@dgd.rt', 'Единомышленник', 'Ежемесячно', 1000, NULL, '2018-10-02 11:55:26', '2018-10-02 11:55:26', 'Москва'),
(39, 'рапрпа', 'dfsd@dfd.jh', 'Спасибо!', 'Разово', 1000, NULL, '2018-10-02 11:56:22', '2018-10-02 11:56:22', 'lkl'),
(40, 'jkj', 'jhk@dfg.hjj', 'Помощник', 'Ежемесячно', 500, NULL, '2018-10-02 11:58:07', '2018-10-02 11:58:07', 'ghj'),
(41, 'fhfgh', 'fghf@dfs.kh', 'Спасибо!', 'Разово', 1000, NULL, '2018-10-02 11:59:57', '2018-10-02 11:59:57', 'hgjgh'),
(42, 'fhfgh', 'fghf@dfs.kh', 'Спасибо!', 'Разово', 1000, NULL, '2018-10-02 12:00:46', '2018-10-02 12:00:46', 'hgjgh'),
(43, 'hfghfg', 'fhfg@dfj.gh', 'Помощник', 'Ежемесячно', 500, NULL, '2018-10-02 12:02:00', '2018-10-02 12:02:00', 'ghg'),
(44, 'hfghfg', 'fhfg@dfj.gh', 'Помощник', 'Ежемесячно', 500, NULL, '2018-10-02 12:03:26', '2018-10-02 12:03:26', 'ghg'),
(45, 'gfh', 'fghf@dfs.kh', 'Спасибо!', 'Разово', 1000, NULL, '2018-10-02 12:07:38', '2018-10-02 12:07:38', 'fghgfh'),
(46, 'gfh', 'fghf@dfs.kh', 'Спасибо!', 'Разово', 1000, NULL, '2018-10-02 12:08:04', '2018-10-02 12:08:04', 'fghgfh'),
(47, 'trytry', 'rtyy@fg.hj', 'Помощник', 'Ежемесячно', 500, NULL, '2018-10-02 12:08:49', '2018-10-02 12:08:49', 'fghg');

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
(9, '2018_09_27_183039_create_payments_table', 4),
(10, '2018_09_28_164126_create_settings_table', 5),
(11, '2018_10_02_141454_add_city_donators_table', 6);

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
(33, 37, 5, 'Ежемесячно', 1000, NULL, '2018-10-02 11:48:48', '2018-10-02 11:48:48'),
(34, 38, 5, 'Ежемесячно', 1000, NULL, '2018-10-02 11:55:27', '2018-10-02 11:55:27'),
(35, 39, 1, 'Разово', 1000, NULL, '2018-10-02 11:56:22', '2018-10-02 11:56:22'),
(36, 40, 4, 'Ежемесячно', 500, NULL, '2018-10-02 11:58:07', '2018-10-02 11:58:07'),
(37, 41, 1, 'Разово', 1000, NULL, '2018-10-02 11:59:57', '2018-10-02 11:59:57'),
(38, 42, 1, 'Разово', 1000, NULL, '2018-10-02 12:00:46', '2018-10-02 12:00:46'),
(39, 43, 4, 'Ежемесячно', 500, NULL, '2018-10-02 12:02:00', '2018-10-02 12:02:00'),
(40, 44, 4, 'Ежемесячно', 500, NULL, '2018-10-02 12:03:26', '2018-10-02 12:03:26'),
(41, 45, 1, 'Разово', 1000, NULL, '2018-10-02 12:07:38', '2018-10-02 12:07:38'),
(42, 46, 1, 'Разово', 1000, NULL, '2018-10-02 12:08:04', '2018-10-02 12:08:04'),
(43, 47, 4, 'Ежемесячно', 500, NULL, '2018-10-02 12:08:50', '2018-10-02 12:08:50');

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `test_mode` int(11) NOT NULL,
  `mrh_login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrh_pass1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrh_pass2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inv_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test_pass1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test_pass2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `test_mode`, `mrh_login`, `mrh_pass1`, `mrh_pass2`, `inv_desc`, `test_pass1`, `test_pass2`, `created_at`, `updated_at`) VALUES
(1, 0, 'iskconclub', 'SUMRS95iv3Rv4kZ3dFbj', 'NJ4kLhFZnuqSCbQ991r7', 'Участие в вебинарах и семинарах', 'TB4fw1ybFl8Bv0az8vUa', 'UV2rEDqO89VGYX5o8XfG', NULL, '2018-10-02 12:07:51');

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
(1, 'Narottam Vilas', 'webkonditer@yandex.ru', NULL, '$2y$10$whFt1xk/LscoI6b8rDYFTOjYsdJeHP38KpZ8.aqCBNq9MO2Oi8Cie', 'Hp92H3TZR5BD42ERL8R7oPU2R22K8T5dT3ag1OnIOWpmMVoOTY7TbffXvfE0', '2018-09-26 13:26:59', '2018-09-26 13:26:59');

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `formats`
--
ALTER TABLE `formats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `peoples`
--
ALTER TABLE `peoples`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
