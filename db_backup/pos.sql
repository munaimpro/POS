-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 04:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'Sale 1', 1, '2024-01-15 01:19:38', '2024-01-15 04:02:21'),
(7, 'Sale 2', 1, '2024-01-15 01:21:00', '2024-01-15 04:02:38'),
(8, 'Sale 3', 1, '2024-01-15 01:22:38', '2024-01-15 04:02:48'),
(9, 'Sale 4', 1, '2024-01-15 01:23:52', '2024-01-15 04:02:59'),
(10, 'Sale 5', 1, '2024-01-15 01:25:33', '2024-01-15 04:03:09'),
(11, 'Sale 6', 1, '2024-01-15 02:32:50', '2024-01-15 04:16:45'),
(12, 'Sale 7', 1, '2024-01-15 02:33:12', '2024-01-15 02:33:12'),
(13, 'Sale 8', 1, '2024-01-15 06:55:50', '2024-01-15 06:55:50'),
(14, 'Sale 9', 1, '2024-01-15 06:56:06', '2024-01-15 06:56:06'),
(15, 'Sale 10', 1, '2024-01-15 06:56:15', '2024-01-15 06:56:15'),
(16, 'Sale 11', 1, '2024-01-15 06:56:29', '2024-01-15 06:56:29'),
(18, 'Electronics', 8, '2024-09-08 07:02:51', '2024-09-08 07:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'Cuelin Carry', 'carry@yahoo.com', '01826116163', 1, '2024-01-15 06:46:41', '2024-01-15 06:47:40'),
(4, 'Jhon Doe', 'jhon@gmail.com', '01826116163', 1, '2024-01-15 06:47:01', '2024-01-15 06:47:01'),
(5, 'Ket Middleton', 'ket@gmail.com', '01826116163', 1, '2024-01-15 06:47:25', '2024-01-15 06:47:25'),
(6, 'Richi Riho', 'richi@gmail.com', '1826116163', 1, '2024-01-15 06:48:11', '2024-01-15 06:48:11'),
(7, 'Tom Jackob', 'tom@hotmail.com', '1826116163', 1, '2024-01-15 06:48:38', '2024-01-15 06:49:07'),
(8, 'Robust Rahino', 'robust@gmail.com', '1826116163', 1, '2024-01-15 06:50:43', '2024-01-15 06:50:43'),
(9, 'afaf', 'afafa', 'f', 1, '2024-01-15 06:51:00', '2024-01-15 06:51:00'),
(10, 'Md. Munaim Khan', 'khanmail2599@gmail.com', '01826116163', 1, '2024-01-15 06:51:11', '2024-01-15 06:51:11'),
(11, 'Munaim Khan', 'khanmail2599@gmail.com', '01826116163', 1, '2024-01-15 06:51:20', '2024-01-15 06:51:20'),
(13, 'Md. Munaim Khan', 'khanmail2599@gmail.com', '01826116163', 1, '2024-01-15 06:51:46', '2024-01-15 06:51:46'),
(14, 'Munaim Khan', 'khanmail2599@gmail.com', '01826116163', 1, '2024-01-15 06:51:59', '2024-01-15 06:51:59'),
(16, 'Customer Name', 'customer@gmail.com', '01826116163', 8, '2024-09-08 07:29:39', '2024-09-08 07:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `vat` varchar(50) NOT NULL,
  `payable` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `total`, `discount`, `vat`, `payable`, `user_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(12, '450', '0', '22.50', '472.50', 1, 3, '2024-01-21 04:21:03', '2024-01-21 04:21:03'),
(13, '450', '0', '22.50', '472.50', 1, 3, '2024-01-21 04:21:05', '2024-01-21 04:21:05'),
(14, '450', '0', '22.50', '472.50', 1, 3, '2024-01-21 04:21:06', '2024-01-21 04:21:06'),
(15, '450', '0', '22.50', '472.50', 1, 3, '2024-01-21 04:21:07', '2024-01-21 04:21:07'),
(16, '450', '0', '22.50', '472.50', 1, 3, '2024-01-21 04:21:08', '2024-01-21 04:21:08'),
(25, '1050', '0', '52.50', '1102.50', 1, 4, '2024-01-22 02:04:06', '2024-01-22 02:04:06'),
(26, '1194.00', '6', '59.70', '1253.70', 8, 16, '2024-09-08 07:31:07', '2024-09-08 07:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `qty` varchar(50) NOT NULL,
  `sale_price` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_products`
--

INSERT INTO `invoice_products` (`id`, `invoice_id`, `product_id`, `user_id`, `qty`, `sale_price`, `created_at`, `updated_at`) VALUES
(6, 12, 16, 1, '1', '450.00', '2024-01-21 04:21:03', '2024-01-21 04:21:03'),
(7, 13, 16, 1, '1', '450.00', '2024-01-21 04:21:05', '2024-01-21 04:21:05'),
(8, 14, 16, 1, '1', '450.00', '2024-01-21 04:21:06', '2024-01-21 04:21:06'),
(9, 15, 16, 1, '1', '450.00', '2024-01-21 04:21:07', '2024-01-21 04:21:07'),
(10, 16, 16, 1, '1', '450.00', '2024-01-21 04:21:08', '2024-01-21 04:21:08'),
(27, 25, 12, 1, '1', '500.00', '2024-01-22 02:04:06', '2024-01-22 02:04:06'),
(28, 25, 13, 1, '1', '200.00', '2024-01-22 02:04:06', '2024-01-22 02:04:06'),
(29, 25, 15, 1, '1', '350.00', '2024-01-22 02:04:06', '2024-01-22 02:04:06'),
(30, 26, 19, 8, '4', '1200.00', '2024-09-08 07:31:07', '2024-09-08 07:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2023_07_11_152531_create_users', 2),
(10, '2023_07_23_133550_create_customers', 2),
(11, '2023_07_23_133551_create_categories', 2),
(12, '2023_07_23_133552_create_products', 2),
(13, '2023_07_30_105124_create_invoices', 2),
(14, '2023_07_30_110928_create_invoice_products', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `name`, `price`, `unit`, `img_url`, `created_at`, `updated_at`) VALUES
(12, 1, 6, 'Lorem Ipsum is simply', '500', 'kg', 'uploads/1-1705505982-Capture.PNG', '2024-01-17 09:39:42', '2024-01-17 09:39:42'),
(13, 1, 7, 'Lorem Ipsum is simply', '200', 'kg', 'uploads/1-1705506018-Capture2.PNG', '2024-01-17 09:40:18', '2024-01-17 09:40:18'),
(14, 1, 8, 'Lorem Ipsum is simply', '300', 'kg', 'uploads/1-1705506052-Capture3.PNG', '2024-01-17 09:40:53', '2024-01-17 09:40:53'),
(15, 1, 9, 'Lorem Ipsum is simply', '350', 'kg', 'uploads/1-1705506085-Capture4.PNG', '2024-01-17 09:41:25', '2024-01-17 09:41:25'),
(16, 1, 10, 'Lorem Ipsum is simply', '450', 'kg', 'uploads/1-1705506114-Capture5.PNG', '2024-01-17 09:41:54', '2024-01-17 09:41:54'),
(17, 1, 11, 'Lorem Ipsum is simply', '350', 'kg', 'uploads/1-1705506156-Capture8.PNG', '2024-01-17 09:42:36', '2024-01-17 09:42:36'),
(19, 8, 18, 'Lorem Ipsum is simply', '300', 'kg', 'uploads/8-1725801783-কপোতাক্ষ_নদ.jpg', '2024-09-08 07:23:03', '2024-09-08 07:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `mobile`, `password`, `otp`, `created_at`, `updated_at`) VALUES
(1, 'Munaim', 'Khan', 'khanmail2599@gmail.com', '01826116163', '12345678', '0', '2024-01-10 00:50:11', '2024-01-13 08:20:37'),
(2, 'Tahmena', 'Sultana', 'stahmina112@gmail.com', '01826116163', '123', '5282', '2024-01-10 03:45:30', '2024-01-10 03:46:10'),
(3, 'Murad', 'Khan', 'muradkhan31@gmail.com', '01813208586', '123', '3767', '2024-01-10 03:54:18', '2024-01-10 04:28:39'),
(4, 'Munaim', 'Khan', 'munaimpersonal@gmail.com', '01813208586', '123', '9155', '2024-01-10 04:24:07', '2024-01-10 04:26:25'),
(5, 'Meherunnesa', 'Khanom', 'monimukta48@gmail.com', '01813208586', '123', '5715', '2024-01-10 06:13:46', '2024-01-10 06:14:35'),
(6, 'Raihanul', 'Ikram', 'raihan@yahoo.com', '01826116163', '123', '0', '2024-01-10 11:38:01', '2024-01-10 11:38:01'),
(7, 'Rupom', 'Chowdhury', 'rupom@gmail.com', '01783456723', '123', '0', '2024-01-10 11:39:12', '2024-01-10 11:39:12'),
(8, 'Munaim', 'Khan', 'demo@gmail.com', '01826116163', '12345678', '0', '2024-09-08 06:55:59', '2024-09-08 07:40:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_products_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_products_product_id_foreign` (`product_id`),
  ADD KEY `invoice_products_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD CONSTRAINT `invoice_products_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
