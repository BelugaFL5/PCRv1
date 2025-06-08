-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 08:41 AM
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
-- Database: `pcr1db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `DateOfReg` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `name`, `DateOfReg`) VALUES
(1, 'admin@apu.my', '$2y$10$jiD4l26PpsJPIVcklex4L.3n.L3YcAzXX5K9QywGttBAIrQnkA2LC', 'Aluminium Man', '2024-11-22 13:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `description`) VALUES
(1, 'Chicken Rice', 'good chicken rice'),
(3, 'Ayam Goreng berempah', 'Learn how to fried');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dateOfReg` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`id`, `email`, `password`, `name`, `dateOfReg`) VALUES
(2, 'king@gmail.com', 'ALzmklWe', 'Ayam Man', '2024-12-04'),
(3, 'll@outlook.com', 'UKQSYEIl', 'hg', '2024-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_course`
--

CREATE TABLE `lecturer_course` (
  `lecturer_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_course`
--

INSERT INTO `lecturer_course` (`lecturer_id`, `course_id`) VALUES
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(500) NOT NULL,
  `name` varchar(250) NOT NULL,
  `DateOfReg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `email`, `password`, `name`, `DateOfReg`) VALUES
(1, 'fsiyh@gmail.cpm', '$2y$10$oT44kC/ug1avGU6kxbYQx.049NBZVRlIa/pDLzBTThp.uSN7z99Ae', 'Ayam Man', '2025-01-04 14:44:30'),
(2, 'hhhh@gmail.com', '$2y$10$wXke2cqgOMjsQmOKaODZs.gzamQ5WSzbT5jwKyB4vvw2s1zyB2tI.', 'Yo', '2025-01-04 14:44:49'),
(3, 'chicken@jimil.com', '$2y$10$0JbulkNcKLCJ8nBkj1gtNeLLQ/90y2Wqp45aiA7ePyCHw/Y.QU7pm', 'Chicjen Rice', '2025-01-05 15:33:17'),
(4, 'hujaepa123@apu.edu.my', '$2y$10$9IHlYWypiZlu2gaN7pElre2sG9gp/BvqgI5lWXqmgKblJZWJJB6hC', 'Hujaepa', '2025-01-05 15:33:40'),
(5, 'siow@chicken.com', '$2y$10$8gNtz2jnDqW31CVTeJS0XOZ5LA4wSb.LRn.PladusiYTEVAe5lpz.', 'SIOW', '2025-01-05 15:34:00'),
(6, 'reborn@google.com', '$2y$10$5ekVlK0C8aXuT3VLS1t8ve1F9GqAh1//5TnlsE3RCiCSZiCCMnZ.2', 'https://www.youtube.com/watch?v=n6KZhlOrSb4', '2025-01-05 17:38:49'),
(7, 'kingdomNeverFall@cibai.com', '$2y$10$IEXybkdASvpgZerq4/J9EumWBOV86xhAAJ6YZNMunOIniLL50gWV6', '永不言败的帝国', '2025-01-05 17:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `course_id`) VALUES
(0, 0),
(0, 0),
(0, 0),
(2, 1),
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_un` (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_un` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
