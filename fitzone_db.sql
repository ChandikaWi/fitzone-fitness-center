-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2025 at 01:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitzone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'Admin1', '$2y$10$vlszRJC9beMCsMTLxvmYBeuk.oUbN2qfduGl1VzlBKkIs.DN8YUD6');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `image`, `created_at`) VALUES
(3, 'Meal Plans', 'uploads/Meal Plans.jpeg', '2025-03-26 12:21:39'),
(4, 'Workout Routines', 'uploads/Workout Routines.jpeg', '2025-03-28 13:29:21'),
(5, 'Healthy Recipes', 'uploads/Healthy Recipes.jpeg', '2025-04-09 01:06:17'),
(6, 'Success Stories', 'uploads/Success Stories.jpg', '2025-04-09 01:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
(1, 'Chandika', 'Chandika@gmail.com', 'Can I know about what are the limitations of you fitness center?', '2025-03-23 06:07:59'),
(2, 'Nisal', 'Nisal@gmail.com', 'I want to know when you started this gym?', '2025-04-29 12:47:16'),
(3, 'Dinuka', 'Dinuka@gmail.com', 'This is a message', '2025-04-30 06:14:39'),
(4, 'Kavindu', 'Kavindu@gmail.com', 'Do you have a kids area?', '2025-09-19 04:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`) VALUES
(1, 'Customer1', '$2y$10$tIOuOsGW4ccNrYFy5FZoz.1p3b5ZgA4GpPzu7NyC0eGJSn0OY0TuS'),
(2, 'Customer2', '$2y$10$va8gZ37AXV6hKXbfT/60X.yBisFQ5difXR2gNKrM3QbQR.ALMuty6'),
(3, 'Customer3', '$2y$10$ovH0CsJCFm/NG.vzIVKdE.IPOrS9fvaFhqYKG4hCiW1PbcbsMI5GO'),
(4, 'Customer4', '$2y$10$86TuKGZX.5XZQUZcT.9QfurgR0YwnnI9.Jymgxb1gmdr872doxf4W'),
(8, 'Customer5', '$2y$10$NoL.lIaNpiIyHoR8a55Xveilmbd02hVrqNeYzPmHCIWusT80zR1B2');

-- --------------------------------------------------------

--
-- Table structure for table `customer_memberships`
--

CREATE TABLE `customer_memberships` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `membership_type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `purchased_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_memberships`
--

INSERT INTO `customer_memberships` (`id`, `username`, `membership_type`, `price`, `purchased_at`) VALUES
(1, 'Customer1', 'Silver - 1 Month', 10000.00, '2025-03-23 13:05:19'),
(2, 'Customer2', 'Gold - Annual', 48000.00, '2025-04-29 13:17:10'),
(3, 'Customer1', 'Platinum - Gents', 65000.00, '2025-04-30 06:19:59'),
(4, 'Customer5', 'Platinum - Gents', 65000.00, '2025-09-19 04:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `gym_appointments`
--

CREATE TABLE `gym_appointments` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `trainer` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_appointments`
--

INSERT INTO `gym_appointments` (`id`, `username`, `service`, `trainer`, `date`, `time`, `booked_at`) VALUES
(1, 'Customer1', 'Personalized Training', 'Mr. Thilina Fernando', '2025-05-05', '04:30:00', '2025-03-24 12:29:40'),
(2, 'Customer2', 'Nutrition Counseling', 'Mr. Akila Wijesinghe', '2025-05-16', '05:30:00', '2025-04-29 13:19:24'),
(3, 'Customer1', 'Strength Training', 'Mr. Ravindra Perera', '2025-05-09', '03:55:00', '2025-04-30 06:21:00'),
(4, 'Customer5', 'Strength Training', 'Mr. Ravindra Perera', '2025-09-30', '10:00:00', '2025-09-19 04:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `password`) VALUES
(1, 'Staffmember1', '$2y$10$31nIZzZb.dM5ry3GKl4/ce7YHFLZz9EgXFMYRVG5kazPKGm0YXZLm'),
(2, 'Staffmember2', '$2y$10$vMo4I/Yh/nPmOk5zqZLp5Owy7vTjK5h.M3NFJVIL.6v4GZCNM5hay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_memberships`
--
ALTER TABLE `customer_memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_appointments`
--
ALTER TABLE `gym_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_memberships`
--
ALTER TABLE `customer_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gym_appointments`
--
ALTER TABLE `gym_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
