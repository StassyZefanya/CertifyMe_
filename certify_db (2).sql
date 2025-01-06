-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2025 at 02:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `certify_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `template` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `nama_1` varchar(255) NOT NULL,
  `jabatan_1` varchar(255) NOT NULL,
  `nama_2` varchar(255) NOT NULL,
  `jabatan_2` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sign_1_image` varchar(255) DEFAULT NULL,
  `sign_2_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `template`, `title`, `name`, `position`, `description`, `nama_1`, `jabatan_1`, `nama_2`, `jabatan_2`, `file_path`, `created_at`, `updated_at`, `sign_1_image`, `sign_2_image`) VALUES
(11, NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL),
(12, NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL),
(13, 19, 'template', '1', '1', '1', '1\r\n', '1', '1', '1', '1', '../generated/certificate_6770d33fead37.pdf', '2024-12-29 04:42:39', '2024-12-29 04:59:21', NULL, NULL),
(14, 19, 'template', 'ayam', 'aowk', 'dhusa', 'OISAD', 'do', 'afskn', 'asken', 'aps', '../generated/certificate_6770d3af5147c.pdf', '2024-12-29 04:44:31', '2024-12-29 04:59:25', NULL, NULL),
(15, 19, 'template', 'ayam', 'aowk', 'dhusa', 'OISAD', 'do', 'afskn', 'asken', 'aps', '../generated/certificate_6770d6a4550ba.pdf', '2024-12-29 04:57:08', '2024-12-29 04:59:18', NULL, NULL),
(16, NULL, 'template', 'asdsadas', 'dasdsa', 'dasdasd', 'asdasdasd', 'asdad', 'dasdqsda', 'dsad', 'dsadsa', '../generated/certificate_6770d8334754c.pdf', '2024-12-29 05:03:47', '2024-12-29 05:03:47', NULL, NULL),
(17, NULL, 'template', 'asdasdasd', 'asdasd', 'asdas', 'dasda', 'asdasd', 'asdsa', 'asdsad', 'dasdasd', '../generated/certificate_6770d8e450fc7.pdf', '2024-12-29 05:06:44', '2024-12-29 05:06:44', NULL, NULL),
(18, NULL, 'template', 'asdasda', 'sdsada', 'adasdasd', 'adsadada', 'asdasda', 'dasdas', 'dasdas', 'dasdasd', '../generated/certificate_6770dbdf21ed5.pdf', '2024-12-29 05:19:27', '2024-12-29 05:19:27', NULL, NULL),
(19, NULL, 'template', 'iasj', 'sdsadaasknd', 'adasdasd', 'adsadada', 'asdasda', 'dasdas', 'dasdas', 'dasdasdasf', '../generated/certificate_6770dbf920378.pdf', '2024-12-29 05:19:53', '2024-12-29 05:19:53', NULL, NULL),
(20, NULL, 'template', 'balap karung', 'bivan', 'juara 1', 'selamat atas kemenangannya', 'gilang', 'kepala sekolah', 'fariz', 'wakil kepala sekolah', '../generated/certificate_6770dd4122593.pdf', '2024-12-29 05:25:21', '2024-12-29 05:25:21', NULL, NULL),
(21, NULL, 'template', 'p', 'p', 'p', 'p\r\n', 'po', 'op', 'pa', 'ap', '../generated/certificate_67796734f04f1.pdf', '2025-01-04 16:52:04', '2025-01-04 16:52:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certificate_templates`
--

CREATE TABLE `certificate_templates` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `certificate_templates`
--

INSERT INTO `certificate_templates` (`id`, `name`, `file_path`, `created_at`) VALUES
(13, 'Sertifikat Gacor', 'certificate_67521539388401.33326757.png', '2024-12-05 21:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'USER',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(10, 'Admin', 'admin', '$2y$10$JPd.JEy6W46j7ZlSKtDcguzFDSzSAanBtOYjbbR/z5duvhhKejGzq', 'ADMIN', '2024-12-28 22:42:43', '2024-12-28 22:43:26'),
(11, 'gilang@gmail.com', 'gilang', '$2y$10$u6werafmYyVEVu65iadTvu/bdtzy3J8NNlu/KKpkGrarg.Hdj0i62', 'ADMIN', '2024-12-29 03:18:07', '2024-12-29 03:24:32'),
(18, 'pp', 'pp', '$2y$10$4avKiKX0I5m.4CtFYlWhZuVNpUvVJYHKFj1/uXMZ24qlobWgdJvYW', 'USER', '2024-12-29 03:30:11', '2024-12-29 03:30:11'),
(19, 'salwa', 'salwa', '$2y$10$UhpDLaIuZiHIcpAJVx2l7uWNG8iSfgKR0fUCxGDhQy/a/p3MUMi86', 'USER', '2024-12-29 04:20:13', '2024-12-29 04:20:13'),
(20, 'sisi', 'sisi', '$2y$10$vPdzn/alXzqipeUqyhvWd.6SZyD9aa.HJVR2Sb0mCLvl.J/jPPumC', 'USER', '2025-01-04 16:47:07', '2025-01-04 16:47:07'),
(21, 'gugugaga', 'kuku_sapi', '$2y$10$kUsDAcHe.Yp/OfpHo7EHu..rK2cF3oeojZwwTc2W4pZCMoFCs5Xj6', 'USER', '2025-01-04 18:26:24', '2025-01-04 18:26:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `certificate_templates`
--
ALTER TABLE `certificate_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `certificate_templates`
--
ALTER TABLE `certificate_templates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
