-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2024 at 05:45 AM
-- Server version: 8.0.36
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web2jobboard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `userId` int NOT NULL,
  `jobOpeningId` int NOT NULL,
  `applicationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_bin DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`userId`, `jobOpeningId`, `applicationDate`, `status`) VALUES
(7, 11, '2024-06-18 04:25:45', 'new'),
(7, 12, '2024-06-18 04:37:36', 'new'),
(7, 13, '2024-06-18 21:42:34', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT 'default.png',
  `contact_email` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `logo`, `contact_email`, `contact_phone`, `website`, `description`, `slug`) VALUES
(1, 'TechNex Solutions', 'default.png', 'info@technexsolutions.com', '+1 (555) 987-6543', 'www.technexsolutions.com', 'Providing cutting-edge software solutions for businesses worldwide.', 'technex-solutions'),
(2, 'GlobeTech Innovations', 'default.png', 'contact@globetechinnovations.net', '+1 (555) 987-6543', 'www.globetechinnovations.net', 'Transforming ideas into reality through innovative technology.', 'globetech-innovations'),
(3, 'DataWave Analytics', 'default.png', 'info@datawaveanalytics.com', '+1 (555) 567-8901', 'www.datawaveanalytics.com', 'Unlocking insights from data for data-driven decision-making.', 'datawave-analytics'),
(4, 'Quantum Robotics', 'default.png', 'contact@quantumrobotics.ai', '+1 (555) 234-5678', 'www.quantumrobotics.ai', 'Pioneering advancements in artificial intelligence and robotics.', 'quantum-robotics'),
(5, 'PixelCraft Studios', 'default.png', 'hello@pixelcraftstudios.com', '+1 (555) 345-6789', 'www.pixelcraftstudios.com', 'Crafting visually stunning digital experiences.', 'pixelcraft-studios');

-- --------------------------------------------------------

--
-- Table structure for table `job_opening`
--

CREATE TABLE `job_opening` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `company_id` int NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT 'N/A',
  `contract` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `experience` int DEFAULT '0',
  `level` varchar(255) COLLATE utf8mb4_bin DEFAULT 'No experience',
  `status` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT 'active',
  `publication_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publisher_id` int NOT NULL,
  `salary` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `job_opening`
--

INSERT INTO `job_opening` (`id`, `title`, `description`, `company_id`, `location`, `contract`, `experience`, `level`, `status`, `publication_date`, `publisher_id`, `salary`) VALUES
(11, 'Software Engineer', 'Join our team to build cutting-edge software solutions.', 1, 'San Francisco, CA', 'full-time', 0, 'No experience', 'active', '2024-06-12 06:11:17', 1, 120000),
(12, 'Data Analyst', 'Analyze data and drive innovation.', 2, 'New York, NY', 'part-time', 0, 'No experience', 'active', '2024-06-12 06:11:17', 1, 70000),
(13, 'Machine Learning Engineer', 'Develop ML models for data insights.', 3, 'Austin, TX', 'freelancer', 0, 'No experience', 'active', '2024-06-12 06:11:17', 1, 90000),
(14, 'Robotics Researcher', 'Explore the frontiers of AI and robotics.', 4, 'Seattle, WA', 'full-time', 0, 'No experience', 'active', '2024-06-12 06:11:17', 1, 110000),
(15, 'UI/UX Designer', 'Craft visually stunning digital experiences.', 5, 'Los Angeles, CA', 'full-time', 0, 'No experience', 'active', '2024-06-12 06:11:17', 1, 95000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'profile.png',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `linkedin`, `picture`, `created_at`, `role`) VALUES
(1, 'John Smith', 'john.smith@example.com', '$2y$10$so7h/M39r7aKwQg/WRxsMuw48LyL4cYIQTkSb5gZvbKLyAEOoEkf6', 'https://www.linkedin.com/in/john-smith/', 'profile.png', '2024-06-12 06:03:39', 'admin'),
(7, 'Amilcar Santana', 'takintosh@gmail.com', '$2y$10$s.WcuoUxdARMUsHZGqiEOeIl9IuY8jNYRFRQ32kpFi7haGBOirpCK', 'https://www.linkedin.com/in/amilcar-santana/', 'IMG_20220715_180451_697.jpg', '2024-06-13 05:53:08', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD KEY `application_job_opening_id_fk` (`jobOpeningId`),
  ADD KEY `application_user_id_fk` (`userId`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_id_uindex` (`id`);

--
-- Indexes for table `job_opening`
--
ALTER TABLE `job_opening`
  ADD UNIQUE KEY `job_opening_id_uindex` (`id`),
  ADD KEY `job_opening_user_id_fk` (`publisher_id`),
  ADD KEY `job_opening_company_id_fk` (`company_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_uindex` (`email`),
  ADD UNIQUE KEY `user_id_uindex` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_opening`
--
ALTER TABLE `job_opening`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_job_opening_id_fk` FOREIGN KEY (`jobOpeningId`) REFERENCES `job_opening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_user_id_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_opening`
--
ALTER TABLE `job_opening`
  ADD CONSTRAINT `job_opening_company_id_fk` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_opening_user_id_fk` FOREIGN KEY (`publisher_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
