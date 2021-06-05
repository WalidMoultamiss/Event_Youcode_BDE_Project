-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 03:30 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events_youcode`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `refreshToken` text NOT NULL,
  `expired` int(11) NOT NULL DEFAULT 0,
  `count` int(11) NOT NULL DEFAULT 0,
  `created_At` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `user_id`, `refreshToken`, `expired`, `count`, `created_At`) VALUES
(95, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE2MjI4MDE1NzgsImV4cCI6MTYyMjgwMTYzOCwiaWQiOiI1Iiwicm9sZSI6IkFkbWluIn0.pie61sD-r3oFW-f28iQ1uf5mbSnrChZu-ZrmKzy9oc5IRoarPYxXPralfgd27tjVOp4uNviqk6hCo4TYBPORTA', 0, 0, '2021-06-04 11:12:58'),
(96, 5, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE2MjI4MDQzODYsImV4cCI6MTYyMjgwNDQ0NiwiaWQiOiI1Iiwicm9sZSI6IkFkbWluIn0.Y3v5u7LMQTHwBDgEvxV3R_eoj0c9OmJ5_7prqGUUcii2Pzcu5OqpEGvlvEw6j1tw18fxlRY3bY38d-DwHNn7lg', 0, 0, '2021-06-04 11:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `id_member` int(11) NOT NULL,
  `youcode` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `event_where` text COLLATE utf8_bin NOT NULL,
  `event_when` text COLLATE utf8_bin NOT NULL,
  `max_places` int(11) NOT NULL,
  `classes` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `url_img` text COLLATE utf8_bin NOT NULL,
  `status` text COLLATE utf8_bin NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `event_where`, `event_when`, `max_places`, `classes`, `description`, `url_img`, `status`) VALUES
(1, 'spotify', 'agora', '2021-01-01', 25, 'all', 'description', 'src.jpg', 'archived'),
(2, 'capgemini', 'agora', '2021-01-01', 50, 'alan turing, ada love lace', 'description2', 'src2.jpg', 'highlighted'),
(3, 'capgemini', 'agora', '2021-01-01', 50, 'alan turing, ada love lace', 'description2', 'src2.jpg', 'regular'),
(4, 'capgem2ini', 'agora', '2021-01-01', 50, 'alan turing, ada love lace', 'description2', 'src2.jpg', 'highlighted');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `first_name` text COLLATE utf8_bin NOT NULL,
  `last_name` text COLLATE utf8_bin NOT NULL,
  `cin` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `archived` int(11) NOT NULL,
  `role` text COLLATE utf8_bin NOT NULL DEFAULT 'student',
  `url_img` text COLLATE utf8_bin NOT NULL,
  `status` text COLLATE utf8_bin NOT NULL DEFAULT 'active',
  `phone` text COLLATE utf8_bin NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `first_name`, `last_name`, `cin`, `password`, `archived`, `role`, `url_img`, `status`, `phone`, `birth_date`) VALUES
(1, 'walidmoultamis@gmail.com', 'walid', 'moultamiss', 'BM21352', '$2y$10$XSpKxtT.zRTzYq5My89LQu0BE3Sd7uN9O8aw3o/zzaKmIK6im2M02', 0, 'student', '', '0', '0622657350', '1996-06-06'),
(5, 'youssbak.2015@gmail.com', 'youssef', 'allo', 'ZT233080', '$2y$10$ZxaUB07yxoP9XgidX7ZwIuGRFGKCVT5K7BW4jFmnG.toAq1nRHFHq', 0, 'Admin', '', 'active', '0649621171', '1997-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notif_message` text COLLATE utf8_bin NOT NULL,
  `cleared` int(11) NOT NULL DEFAULT 0,
  `id_member` int(11) NOT NULL,
  `notif_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL,
  `re_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `speacker`
--

CREATE TABLE `speacker` (
  `id_speaker` int(11) NOT NULL,
  `full_name` text COLLATE utf8_bin NOT NULL,
  `url_img` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `id_event` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `title_suggestion` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `goal` text COLLATE utf8_bin NOT NULL,
  `id_member` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cin` (`cin`) USING HASH;

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_event` (`id_event`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `speacker`
--
ALTER TABLE `speacker`
  ADD PRIMARY KEY (`id_speaker`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `speacker`
--
ALTER TABLE `speacker`
  MODIFY `id_speaker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `auth_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`);

--
-- Constraints for table `speacker`
--
ALTER TABLE `speacker`
  ADD CONSTRAINT `speacker_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD CONSTRAINT `suggestion_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
