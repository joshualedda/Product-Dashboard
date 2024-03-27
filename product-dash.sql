-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 27, 2024 at 01:36 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5, '2024-03-27 09:28:04', NULL),
(2, 2, 2, 2, '2024-03-27 09:28:04', NULL),
(3, 2, 3, 10, '2024-03-27 09:28:04', NULL),
(4, 1, 2, 8, '2024-03-27 09:28:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Iphone', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit cupiditate autem facere culpa minus voluptatum', 10000, 20, '2024-03-27 09:25:37', NULL),
(2, 'Samsung Note 7', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit cupiditate autem facere culpa minus voluptatum numquam provident illum hic perferendis.', 15000, 50, '2024-03-27 09:25:55', NULL),
(3, 'Xiaomi Note 7', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit cupiditate autem facere culpa minus voluptatum numquam provident illum hic perferendis.', 10000, 30, '2024-03-27 09:26:10', NULL),
(4, 'Vivo Y12', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit cupiditate autem facere culpa minus voluptatum numquam provident illum hic perferendis.', 20000, 30, '2024-03-27 09:26:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

DROP TABLE IF EXISTS `replies`;
CREATE TABLE IF NOT EXISTS `replies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `review_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `review_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(6, 7, 8, 'Good din po ba for gaming?\r\n', '2024-03-27 09:31:59', NULL),
(5, 8, 8, 'Kamusta performance after a week Ma\'am?', '2024-03-27 09:31:39', NULL),
(7, 9, 9, 'What about the gaming performance? Sulit din ba?', '2024-03-27 09:33:02', NULL),
(8, 9, 8, 'Yes, Sulit na sulit!', '2024-03-27 09:33:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(7, 1, 3, 'Performance: exceeds expectation\r\nProduct Quality: excellent\r\nBest Feature: malinaw na screen, fast refresh rate\r\nGreat specs for price point. Maganda ang display and great as back up phone, actually ', '2024-03-27 09:30:11', NULL),
(8, 1, 3, 'Best Feature: legit\r\nProduct Quality: great\r\nPerformance: working\r\nI did not hesitate to buy here  because it\'s my 4th time. This shop is legit! Delivery was instant.  Cheaper than in the mall. I got ', '2024-03-27 09:30:30', NULL),
(9, 2, 8, 'Performance: 10\r\nBest Feature: 6 gb ram/128 gb for 4kphp\r\nProduct Quality: 10\r\nSpecs wise sobrang sulit ng phone na to. I got it for 4k php, 6/128 variant. Good cam, long battery life, buttery smooth ', '2024-03-27 09:32:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` int NOT NULL DEFAULT '0' COMMENT '0:user, 1:admin',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Isaac', 'Hicks', 'zoliz@mailinator.com', '$2y$10$q4tGBYL0WViTQaUqOyqS3.rkqriVqZi7PTSxh3mT1WANh3y6sXvOS', 0, '2024-03-17 15:11:46', NULL),
(2, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$QSDg0zxKIQmw3F.3/LE..uUOwrWZ7Y.pQsdk5GSjz6zgW4/Pjiexe', 1, '2024-03-17 15:13:10', NULL),
(3, 'Malik', 'Rosa', 'user@gmail.com', '$2y$10$bFstkIRFDxBgk/dQVywW6uwzRHEmrxyYHtUjPG5yqkB1rILzGtuvC', 0, '2024-03-22 10:40:40', NULL),
(4, 'Carolyn', 'Washington', 'ruzezatuc@mailinator.com', '$2y$10$AojmBLDSNqYxBVw38lBF8.f9rVUDwaNTFyIMGkkV.VbcpbNLtT7QC', 0, '2024-03-26 09:04:02', NULL),
(5, 'Jeanette', 'Rush', 'xitimo@mailinator.com', '$2y$10$ylv2rCktO.nbIF1FVNmvPeCV.T43X0eQ92s2PKAZ4RVk2vCMBkS2y', 0, '2024-03-26 09:05:54', NULL),
(6, 'Tucker', 'Gillespie', 'lelixany@mailinator.com', '$2y$10$QssCtsCMuMIWBL606qfxkOeofMFgUnqsa1Rx9oGpX3UtwcWiNGBrO', 0, '2024-03-26 09:42:27', NULL),
(8, 'Joshua', 'Ledda', 'joshua@gmail.com', '$2y$10$PYZX9EQjAJg9NwfqfnvfDuRNUwfMTgvPX5iTcFPt1XgDqMUxM/zXa', 0, '2024-03-27 09:30:58', NULL),
(7, 'Sage', 'Gamble', 'dirugoz@mailinator.com', '$2y$10$uhlTASVls0p3ZlNCJ851zeOIDM/wXT8gFJNysfw6YZRut92naYxIK', 0, '2024-03-26 17:17:04', NULL),
(9, 'Reiss', 'Akira', 'reiss@gmail.com', '$2y$10$vbj9M9zP4j95bKugsm42xu0BR1gXpVf6pInpqlZ/EWXRUrEX7uHpi', 0, '2024-03-27 09:32:36', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
