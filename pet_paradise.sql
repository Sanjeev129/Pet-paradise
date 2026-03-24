-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2026 at 02:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_paradise`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` int(50) NOT NULL,
  `password` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
(0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--
-- Error reading structure for table pet_paradise.admin_login: #1932 - Table &#039;pet_paradise.admin_login&#039; doesn&#039;t exist in engine
-- Error reading data for table pet_paradise.admin_login: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `pet_paradise`.`admin_login`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(0, 'lucymathews366@gmail.com', '2025-06-13 03:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Sanjeev Tharu', 'csanjip321@gmail.com', '$2y$10$v7lgGIPHSIYf7LWz/mAtnOD8AQkrSLmn03ZnuoV0eCCG4lsh1TThW', '2025-06-11 14:48:49'),
(2, 'suresh', 'suresh@gmail.com', '$2y$10$sj.SdrJbxHN9c03R6jDDAO.ImY7PjLfGmUKQbOhwYOAuhpZkkjcKi', '2025-06-12 03:01:45'),
(3, 'Deshbanduu', 'Deshbandu123@gmail.com', '$2y$10$bvdMTlyFGAtZpFNm0VbC8Onz.QnMnzAQuF5WY58bsVZjMWxbZpjt.', '2025-06-12 03:03:23'),
(4, 'Sunil', 'Sunil123@gmail.com', '$2y$10$HRaIfPPJ65sMA8o1fgONOe8IirF8.x02dkcEVCvyjuChZAWayZohy', '2025-06-12 03:04:27'),
(5, 'Amrit', 'Amrit123@gmail.com', '$2y$10$AJjXn5HaSt3yP342k6S2o.nccYUdRnNSc6KIz9/gYqhmHxUZF942C', '2025-06-12 13:23:24'),
(6, 'Nishan', 'Nishan123@gmail.com', '$2y$10$0a8LM9WKfaUscwvDk5EheuYZVPLCRwZsIW9FB9n0s5p6UYEAdpvd2', '2025-06-25 14:04:33'),
(10, 'Ronix', 'Ronix@gmail.com', '$2y$10$d3mBtWolEECDzEm0e5CsAevKinhDRW3TvXiez85XBh1e8XjAPTr6W', '2025-07-31 03:48:16'),
(11, 'rajkumar sir', 'rajkumarsir@gmail.com', '$2y$10$Fe5MiDbTJUo9/jsVWVzoP.Mk.HF0u./X6V8BbjJh/sSFmd.zcPUB2', '2025-07-31 04:14:59'),
(12, 'admin', 'admin@123gmail.com', '$2y$10$cNTak3Bs9X6GMdAYRxf/ouyfFMBfeoQ/zZ9ITX2H9bNLfOOt/wt.a', '2025-08-02 05:42:18'),
(13, 'RajkumarShah', 'Rajkumar123@gmail.com', '$2y$10$B5CHlZe7kh7kCkjvyFEZ7OaWi.3cnM.4vH5OLJiPSiP2EKX8ZeiQy', '2025-08-03 03:41:35'),
(14, 'Gita', 'gita123@gmail.com', '$2y$10$SDBeggKHlxyBC7P341DoK.me3e0s7myIFI8h5W8Fi25V786Fwq5SO', '2025-08-03 04:47:48'),
(15, 'Gopal', 'Gopal123@gmail.com', '$2y$10$V4zDzz5lPtVg80f1P0YJ2.Wtr5gx.yoNC35/7XcA2i./lpXllEIDq', '2025-08-06 06:03:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
