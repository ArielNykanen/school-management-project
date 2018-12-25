-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2018 at 04:25 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `admin_role` int(11) NOT NULL,
  `admin_phone` varchar(10) COLLATE utf8_bin NOT NULL,
  `admin_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `admin_image` varchar(500) COLLATE utf8_bin NOT NULL,
  `admin_password` varchar(500) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `admin_name`, `admin_role`, `admin_phone`, `admin_email`, `admin_image`, `admin_password`) VALUES
(1, 'Ariel Nykänen ', 1, '544444444', 'example1@any.any', 'f0799852-02af-11e9-967e-9c5c8ec2ccdf.jpg', 'a01610228fe998f515a72dd730294d87'),
(40, 'David Goldman', 2, '0544444444', 'example2@any.any', '5cbac4e7-02b0-11e9-967e-9c5c8ec2ccdf-9443efa5130a8f5ca07ef3f5f0b9a830-da70d9d6dbd16cb4b8714360b20c514a.jpeg', 'a01610228fe998f515a72dd730294d87'),
(41, 'sales man', 3, '0577777777', 'example3@any.any', 'e978b247-0679-11e9-967e-9c5c8ec2ccdf-771761aac41f072ae9c80cc0542ef9ab.png', '1212');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `course_description` text COLLATE utf8_bin NOT NULL,
  `course_image` varchar(500) COLLATE utf8_bin NOT NULL,
  `course_max_students` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `course_image`, `course_max_students`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Github', '              Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, esse exercitationem itaque fugit laborum consequuntur repellendus architecto dolores officia deleniti suscipit eligendi eos odit maxime ab natus libero mollitia tempora?              ', 'f67bd295-02ae-11e9-967e-9c5c8ec2ccdf-2914fd7341fc6c434cbfaad7e64d6395.jpeg', 30, '2018-11-28 22:00:00', '2018-11-05 22:00:00', NULL),
(2, 'Angular pro', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci itaque commodi odit labore facilis alias debitis, explicabo natus dolore sed neque, deserunt quae doloribus dolorum. Cupiditate dolor quo facere sequi!', 'c58715ad-02e8-11e9-967e-9c5c8ec2ccdf.png', 30, '2018-11-28 22:00:00', '2018-11-28 22:00:00', NULL),
(3, 'Amazon', '  Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci itaque commodi odit labore facilis alias debitis, explicabo natus dolore sed neque, deserunt quae doloribus dolorum. Cupiditate dolor quo facere sequi!  ', 'ec72ece4-02e8-11e9-967e-9c5c8ec2ccdf.png', 2, '2018-11-28 22:00:00', '2018-11-28 22:00:00', NULL),
(4, 'Ebay', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci itaque commodi odit labore facilis alias debitis, explicabo natus dolore sed neque, deserunt quae doloribus dolorum. Cupiditate dolor quo facere sequi!', 'ec72f9d0-02e8-11e9-967e-9c5c8ec2ccdf.png', 30, '2018-11-28 22:00:00', '2018-11-28 22:00:00', NULL),
(5, 'node', 'Learn node js...', 'ac9d4735-02e7-11e9-967e-9c5c8ec2ccdf.png', 30, '2018-12-17 22:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_level` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_level`) VALUES
(1, 'owner'),
(2, 'manager'),
(3, 'sale');

-- --------------------------------------------------------

--
-- Table structure for table `sc-connector`
--

CREATE TABLE `sc-connector` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sc-connector`
--

INSERT INTO `sc-connector` (`student_id`, `course_id`) VALUES
(70, 3),
(71, 3);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `student_phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `student_email` varchar(200) COLLATE utf8_bin NOT NULL,
  `student_image` varchar(500) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_phone`, `student_email`, `student_image`) VALUES
(70, 'student1', '0500000000', 'student1@example.com', 'e3547f56-02e5-11e9-967e-9c5c8ec2ccdf-8e85ddd8643faa65e2b97c5d2503c5fe-500903716612870b1ed985716d66457a-96054aa2f1bbd160f7c9d03c806808c7.png'),
(71, 'student2', '0500000001', 'student2@example.com', '2dd3ffb1-02e6-11e9-967e-9c5c8ec2ccdf-e621345e4f04e4951474ba671943c62b.png'),
(72, 'student3', '0500000002', 'student3@example.com', '5cbac4e7-02b0-11e9-967e-9c5c8ec2ccdf-850bf10077fbefd44fbcd58dc62dfaf7-29f9f2e7583564e62f1b6080f15c2f9e.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_role` (`admin_role`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sc-connector`
--
ALTER TABLE `sc-connector`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`admin_role`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `sc-connector`
--
ALTER TABLE `sc-connector`
  ADD CONSTRAINT `sc-connector_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `sc-connector_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
