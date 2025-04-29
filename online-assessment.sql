-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 08:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-assessment`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `exam_time` int(11) NOT NULL COMMENT 'Duration in minutes',
  `pass_mark` int(11) NOT NULL COMMENT 'Passing score as a percentage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `exam_time`, `pass_mark`, `created_at`, `updated_at`) VALUES
(1, 'Exam 1', 6, 50, '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(2, 'Exam 2', 10, 40, '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(3, 'Exam 3', 15, 35, '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(4, 'Exam 4', 20, 45, '2025-04-29 12:48:07', '2025-04-29 12:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `exam_attempts`
--

CREATE TABLE `exam_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `score` double NOT NULL,
  `passed` tinyint(1) NOT NULL,
  `time_taken` int(11) NOT NULL COMMENT 'Time taken in minutes',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_attempts`
--

INSERT INTO `exam_attempts` (`id`, `user_id`, `exam_id`, `score`, `passed`, `time_taken`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, 1, 0, '2025-04-29 13:46:59', '2025-04-29 13:46:59', '2025-04-29 13:46:59'),
(2, 1, 2, 20, 0, 0, '2025-04-29 13:48:10', '2025-04-29 13:48:10', '2025-04-29 13:48:10'),
(3, 1, 3, 40, 1, 9, '2025-04-29 13:59:37', '2025-04-29 13:59:37', '2025-04-29 13:59:37'),
(4, 1, 4, 40, 0, 2, '2025-04-29 14:06:54', '2025-04-29 14:06:54', '2025-04-29 14:06:54');

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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_29_171705_create_exams_table', 1),
(5, '2025_04_29_171731_create_questions_table', 1),
(6, '2025_04_29_185650_create_exam_attempts_table', 2);

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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `questions` text NOT NULL,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`answers`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `questions`, `answers`, `created_at`, `updated_at`) VALUES
(1, 1, 'What is the result of 25 × 4?', '{\"0\":{\"text\":\"100\",\"is_correct\":true},\"1\":{\"text\":\"90\",\"is_correct\":false},\"2\":{\"text\":\"125\",\"is_correct\":false},\"3\":{\"text\":\"75\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(2, 1, 'Select all prime numbers from the list:', '{\"0\":{\"text\":\"2\",\"is_correct\":true},\"1\":{\"text\":\"3\",\"is_correct\":true},\"2\":{\"text\":\"4\",\"is_correct\":false},\"3\":{\"text\":\"5\",\"is_correct\":true},\"4\":{\"text\":\"6\",\"is_correct\":false},\"question_type\":\"multiple\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(3, 1, 'What is the area of a rectangle with length 8 and width 6?', '{\"0\":{\"text\":\"48 square units\",\"is_correct\":true},\"1\":{\"text\":\"28 square units\",\"is_correct\":false},\"2\":{\"text\":\"14 square units\",\"is_correct\":false},\"3\":{\"text\":\"56 square units\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(4, 1, 'Select all even numbers:', '{\"0\":{\"text\":\"2\",\"is_correct\":true},\"1\":{\"text\":\"4\",\"is_correct\":true},\"2\":{\"text\":\"5\",\"is_correct\":false},\"3\":{\"text\":\"6\",\"is_correct\":true},\"4\":{\"text\":\"9\",\"is_correct\":false},\"question_type\":\"multiple\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(5, 1, 'What is 30% of 200?', '{\"0\":{\"text\":\"60\",\"is_correct\":true},\"1\":{\"text\":\"40\",\"is_correct\":false},\"2\":{\"text\":\"70\",\"is_correct\":false},\"3\":{\"text\":\"50\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(6, 2, 'What is the chemical symbol for gold?', '{\"0\":{\"text\":\"Au\",\"is_correct\":true},\"1\":{\"text\":\"Ag\",\"is_correct\":false},\"2\":{\"text\":\"Fe\",\"is_correct\":false},\"3\":{\"text\":\"Cu\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(7, 2, 'Select all noble gases:', '{\"0\":{\"text\":\"Helium\",\"is_correct\":true},\"1\":{\"text\":\"Neon\",\"is_correct\":true},\"2\":{\"text\":\"Oxygen\",\"is_correct\":false},\"3\":{\"text\":\"Argon\",\"is_correct\":true},\"4\":{\"text\":\"Nitrogen\",\"is_correct\":false},\"question_type\":\"multiple\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(8, 2, 'What is the process by which plants make their own food?', '{\"0\":{\"text\":\"Photosynthesis\",\"is_correct\":true},\"1\":{\"text\":\"Respiration\",\"is_correct\":false},\"2\":{\"text\":\"Fermentation\",\"is_correct\":false},\"3\":{\"text\":\"Digestion\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(9, 2, 'Select all parts of the human digestive system:', '{\"0\":{\"text\":\"Esophagus\",\"is_correct\":true},\"1\":{\"text\":\"Lungs\",\"is_correct\":false},\"2\":{\"text\":\"Stomach\",\"is_correct\":true},\"3\":{\"text\":\"Small intestine\",\"is_correct\":true},\"4\":{\"text\":\"Kidney\",\"is_correct\":false},\"question_type\":\"multiple\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(10, 2, 'What is the largest organ in the human body?', '{\"0\":{\"text\":\"Skin\",\"is_correct\":true},\"1\":{\"text\":\"Liver\",\"is_correct\":false},\"2\":{\"text\":\"Heart\",\"is_correct\":false},\"3\":{\"text\":\"Brain\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(11, 3, 'Who was the first President of the United States?', '{\"0\":{\"text\":\"George Washington\",\"is_correct\":true},\"1\":{\"text\":\"Thomas Jefferson\",\"is_correct\":false},\"2\":{\"text\":\"Abraham Lincoln\",\"is_correct\":false},\"3\":{\"text\":\"John Adams\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(12, 3, 'Which countries were part of the Allied Powers in World War II?', '{\"0\":{\"text\":\"United States\",\"is_correct\":true},\"1\":{\"text\":\"Great Britain\",\"is_correct\":true},\"2\":{\"text\":\"Soviet Union\",\"is_correct\":true},\"3\":{\"text\":\"Japan\",\"is_correct\":false},\"4\":{\"text\":\"Germany\",\"is_correct\":false},\"question_type\":\"multiple\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(13, 3, 'Who wrote the Declaration of Independence?', '{\"0\":{\"text\":\"Thomas Jefferson\",\"is_correct\":true},\"1\":{\"text\":\"George Washington\",\"is_correct\":false},\"2\":{\"text\":\"Benjamin Franklin\",\"is_correct\":false},\"3\":{\"text\":\"John Adams\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(14, 3, 'Select all ancient civilizations that built pyramids:', '{\"0\":{\"text\":\"Egyptians\",\"is_correct\":true},\"1\":{\"text\":\"Maya\",\"is_correct\":true},\"2\":{\"text\":\"Greeks\",\"is_correct\":false},\"3\":{\"text\":\"Aztecs\",\"is_correct\":true},\"4\":{\"text\":\"Romans\",\"is_correct\":false},\"question_type\":\"multiple\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(15, 3, 'The Renaissance period originated in which country?', '{\"0\":{\"text\":\"Italy\",\"is_correct\":true},\"1\":{\"text\":\"France\",\"is_correct\":false},\"2\":{\"text\":\"England\",\"is_correct\":false},\"3\":{\"text\":\"Spain\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(16, 4, 'What is the capital of Australia?', '{\"0\":{\"text\":\"Canberra\",\"is_correct\":true},\"1\":{\"text\":\"Sydney\",\"is_correct\":false},\"2\":{\"text\":\"Melbourne\",\"is_correct\":false},\"3\":{\"text\":\"Perth\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(17, 4, 'Select all countries that are part of Scandinavia:', '{\"0\":{\"text\":\"Norway\",\"is_correct\":true},\"1\":{\"text\":\"Sweden\",\"is_correct\":true},\"2\":{\"text\":\"Denmark\",\"is_correct\":true},\"3\":{\"text\":\"Finland\",\"is_correct\":false},\"4\":{\"text\":\"Iceland\",\"is_correct\":false},\"question_type\":\"multiple\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(18, 4, 'Who painted the Mona Lisa?', '{\"0\":{\"text\":\"Leonardo da Vinci\",\"is_correct\":true},\"1\":{\"text\":\"Pablo Picasso\",\"is_correct\":false},\"2\":{\"text\":\"Vincent van Gogh\",\"is_correct\":false},\"3\":{\"text\":\"Michelangelo\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(19, 4, 'Select all of the following that are mammals:', '{\"0\":{\"text\":\"Whale\",\"is_correct\":true},\"1\":{\"text\":\"Dolphin\",\"is_correct\":true},\"2\":{\"text\":\"Shark\",\"is_correct\":false},\"3\":{\"text\":\"Bat\",\"is_correct\":true},\"4\":{\"text\":\"Lizard\",\"is_correct\":false},\"question_type\":\"multiple\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07'),
(20, 4, 'Which planet in our solar system has the most moons?', '{\"0\":{\"text\":\"Saturn\",\"is_correct\":true},\"1\":{\"text\":\"Jupiter\",\"is_correct\":false},\"2\":{\"text\":\"Uranus\",\"is_correct\":false},\"3\":{\"text\":\"Neptune\",\"is_correct\":false},\"question_type\":\"single\"}', '2025-04-29 12:48:07', '2025-04-29 12:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7sNTgqWrHRPVcyaRp2qLSDtdezIH36QK6D4XqQWG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidk9OTWs5VlloUlIwQVI3TVA5b1kwSnZPZHB1cHE1RGQ1TkhUd2RwYiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZXhhbXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTU6ImV4YW1fc3RhcnRfdGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA0LTI5IDE5OjE4OjM5LjE4NDU4NiI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MzoiVVRDIjt9fQ==', 1745957225);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Student 1', 'student1', 'student1@gmail.com', '2025-04-29 12:48:05', '$2y$12$DckL00w7P96kzwB3GaPR6OspHfI7W4gGstkOAYxTI.3/tmBnnXZUy', 'ZoPq2T8RQC', '2025-04-29 12:48:06', '2025-04-29 12:48:06'),
(2, 'Student 2', 'student2', 'student2@gmail.com', '2025-04-29 12:48:06', '$2y$12$Z1BVl8iT.oYmuCJ1K8sGZ.C3/ir0MVKn40mfGX5XX3M/d9gnv6X.i', 'KS8pzQOu7C', '2025-04-29 12:48:06', '2025-04-29 12:48:06'),
(3, 'Student 3', 'student3', 'student3@gmail.com', '2025-04-29 12:48:06', '$2y$12$yFFcuzLpTxiIs6mJJqoXG.4IV7e1b8kWln4MOiMCHE7SmNZXLXQOy', 'hPuTcQEsR0', '2025-04-29 12:48:06', '2025-04-29 12:48:06'),
(4, 'Student 4', 'student4', 'student4@gmail.com', '2025-04-29 12:48:06', '$2y$12$OiDVqrJL1uTkhFhrIb0.K.Ku3SMCvQg62m07CQxCcELAkkbxMlblC', 'qVEz3SvOS4', '2025-04-29 12:48:06', '2025-04-29 12:48:06'),
(5, 'Student 5', 'student5', 'student5@gmail.com', '2025-04-29 12:48:07', '$2y$12$nMS01BG0cGoXKnyUSWAVtOg04gvmews8kdmRHVmERyhJZ9Q1aYa/6', 'wZByiD6XUx', '2025-04-29 12:48:07', '2025-04-29 12:48:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_attempts`
--
ALTER TABLE `exam_attempts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_attempts_user_id_exam_id_unique` (`user_id`,`exam_id`),
  ADD KEY `exam_attempts_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_attempts`
--
ALTER TABLE `exam_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_attempts`
--
ALTER TABLE `exam_attempts`
  ADD CONSTRAINT `exam_attempts_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
