-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2022 at 08:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `child_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `advice`
--

CREATE TABLE `advice` (
  `id` int(11) NOT NULL,
  `topic` longtext NOT NULL,
  `content` longtext NOT NULL,
  `isdeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advice`
--

INSERT INTO `advice` (`id`, `topic`, `content`, `isdeleted`) VALUES
(1, 'advice 1', 'protects your child and your community against diseases like measles and diphtheria, which are potentially serious and even life threatening. Your child can be immunised by your GP or at a community or local council health clinic.', 0),
(2, 'advice 2', 'Many people who get sick or lose a family member want their spiritual leader to provide spiritual support. During the COVID-19 pandemic, the safest means of providing spiritual and psychological support is by phone, video, or through private social media chat platforms. Spiritual leaders may pray, share theological and scriptural reflections, and share messages of hope.', 0),
(3, 'advise 3', 'can use medications like paracetamol and ibuprofen without a prescription when your child has a fever or mild pain. You don’t normally need to see a doctor to use these medications. But if you’re unsure, talk to your pharmacist or GP. Give your child other medications only when recommended by a pharmacist or prescribed by a doctor. Always check dosage instructions on medication labels to make sure that you give your child the right dose for their weight or age.', 0),
(4, 'advice 5', '\r\nSecond-hand and third-hand smoke can cause serious health risks to children. The best way to protect your child is to quit smoking. If someone in your house smokes, make sure they always smoke outside. And never smoke in a car that carries children. Also avoid using chemical household sprays, like insect repellent or cleaning products, when your child is in the room.', 0),
(5, 'advice 4', '\r\nSecond-hand and third-hand smoke can cause serious health risks to children. The best way to protect your child is to quit smoking. If someone in your house smokes, make sure they always smoke outside. And never smoke in a car that carries children. Also avoid using chemical household sprays, like insect repellent or cleaning products, when your child is in the room.', 0),
(6, 'advice 6', 'Many people who get sick or lose a family member want their spiritual leader to provide spiritual support. During the COVID-19 pandemic, the safest means of providing spiritual and psychological support is by phone, video, or through private social media chat platforms. Spiritual leaders may pray, share theological and scriptural reflections, and share messages of hope.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `child_report`
--

CREATE TABLE `child_report` (
  `ChildId` int(225) NOT NULL,
  `Name` text NOT NULL,
  `Birthday` date NOT NULL,
  `Guardian` text NOT NULL,
  `GuardianId` int(255) NOT NULL,
  `RequestId` int(255) NOT NULL,
  `BirthPlace` text NOT NULL,
  `Area` text NOT NULL,
  `Centre` text NOT NULL,
  `MidwifeEmail` text NOT NULL,
  `NVD` date DEFAULT NULL,
  `BCG` text DEFAULT NULL,
  `Triple` text DEFAULT NULL,
  `Triple_Polio` text DEFAULT NULL,
  `MMR` text DEFAULT NULL,
  `Japanese_Encephalitis` text DEFAULT NULL,
  `Dual_Polio` text DEFAULT NULL,
  `Hepatitis_AB` text DEFAULT NULL,
  `Anti_Rabies` text DEFAULT NULL,
  `Chicken_Pox` text DEFAULT NULL,
  `Meningicoccal` text DEFAULT NULL,
  `Weight` text DEFAULT NULL,
  `Notified_V` tinyint(1) NOT NULL,
  `Notified_W` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child_report`
--

INSERT INTO `child_report` (`ChildId`, `Name`, `Birthday`, `Guardian`, `GuardianId`, `RequestId`, `BirthPlace`, `Area`, `Centre`, `MidwifeEmail`, `NVD`, `BCG`, `Triple`, `Triple_Polio`, `MMR`, `Japanese_Encephalitis`, `Dual_Polio`, `Hepatitis_AB`, `Anti_Rabies`, `Chicken_Pox`, `Meningicoccal`, `Weight`, `Notified_V`, `Notified_W`) VALUES
(1, 'name1', '2021-09-10', 'guardian1', 11, 0, 'area51', 'area1', 'centre1', 'sahancaldera3@gmail.com', '2022-01-30', '2021/9/10_Vishaka vidyalaya_child had fever and cough\r\n', '2021/10/10_Vishaka vidyalaya_child had fever and cough\r\n', '2021/11/10_Vishaka vidyalaya_child has fever and cough', '', '', '', '', '', '', '', '2021/9/10_2.7,2021/10/11_3.5,2021/11/10_4\n,2021/11/30_4.1,2021/12/30_4.1', 0, 0),
(2, 'name2', '2021-09-17', 'guardian2', 11, 0, 'area52', 'area2', 'centre1', 'sahancaldera3@gmail.com', '2021-11-28', '2021/9/17_Vishaka vidyalaya_child had fever and cough', '2021/10/17_Vishaka vidyalaya_child had fever and cough', '', '', '', '', '', '', '', '', '2021/9/17_2.7,2021/10/17_3.5,2021/11/17_4', 1, 1),
(3, 'name3', '2021-10-03', 'guardian3', 3, 0, 'area53', 'area3', 'centre1', 'sahancaldera258@gmail.com', '2021-12-04', '2021/10/03_Vishaka vidyalaya_child had fever and cough', '2021/11/03_Vishaka vidyalaya_child had fever and cough', '', '', '', '', '', '', '', '', '2021/10/03_2.7,2021/11/20_3.5', 1, 1),
(4, 'name4', '2021-10-29', 'guardian4', 1, 0, 'area54', 'area1', 'centre1', 'sahancaldera258@gmail.com', '2021-11-29', '2021/10/29_Vishaka vidyalaya_child had fever and cough', '', '', '', '', '', '', '', '', '', '2021/10/29_2.7', 1, 1),
(5, 'name5', '2021-11-18', 'guardian5', 2, 0, 'area55', 'area4', 'centre2', 'sahantestmail@gmail.com', '2021-12-18', '2021/11/18_centre2_child had fever and cough', '', '', '', '', '', '', '', '', '', '2021/11/18_2.7', 1, 1),
(8, 'name7', '2021-10-26', 'guardian7', 7, 0, 'area57', 'area7', 'centre7', 'sahancaldera3@gmail.com', '0000-00-00', '2021/10/27_centre7_Vaccinated after 1 day', '', '', '', '', '', '', '', '', '', '', 1, 0),
(9, 'Harshani', '2021-10-29', 'Bandara', 7, 0, 'area57', 'area7', 'centre7', 'sahantestmail@gmail.com', '0000-00-00', '2021/10/29_centre7_Child has fever and cough', '', '', '', '', '', '', '', '', '', NULL, 1, 0),
(10, 'name8', '2021-11-12', 'guardian8', 8, 0, 'area58', 'area8', 'centre7', 'sahancaldera258@gmail.com', '2021-12-13', '2021/11/13_centre7_Vaccinated after 1 day', '', '', '', '', '', '', '', '', '', NULL, 1, 0),
(11, 'name9', '2021-11-22', 'guardian9', 9, 0, 'area58', 'area8', 'centre7', 'sahancaldera258@gmail.com', '2021-11-23', '', '', '', '', '', '', '', '', '', '', NULL, 1, 0),
(12, 'name10', '2021-11-22', 'guardian6', 6, 0, 'area56', 'area6', 'centre6', 'sahancaldera3@gmail.com', '2021-11-23', '', '', '', '', '', '', '', '', '', '', NULL, 1, 0),
(15, 'name11', '2021-11-22', 'guardian8', 8, 0, 'area58', 'area8', 'centre7', 'sahancaldera258@gmail.com', '2021-11-29', '2021/11/29_centre7_Vaccinated after 1 week', '', '', '', '', '', '', '', '', '', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `email`) VALUES
(5, 'childcare.cse@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `midwife`
--

CREATE TABLE `midwife` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `centre` text NOT NULL,
  `noc` int(100) NOT NULL,
  `areas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `midwife`
--

INSERT INTO `midwife` (`id`, `email`, `centre`, `noc`, `areas`) VALUES
(1, 'midwife1@gmail.com', 'centre1', 35, 'area1, area2, area3'),
(2, 'midwife2@gmail.com', 'centre2', 45, 'area4, area5, area6'),
(3, 'midwife3@gmail.com', 'centre3', 55, 'area7, area8, area9');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `birth_certificate` varchar(50) NOT NULL,
  `clinic_card` varchar(50) DEFAULT NULL,
  `uploaded_on` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobilenumber` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `date_time` date NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `mobilenumber`, `password`, `token`, `is_active`, `date_time`, `role`) VALUES
(11, 'Parent', 'One', 'parent1@gmail.com', '0111111111', '$2y$10$5nmgXPrKqrh/agpslTFXueejDJGkVwfcsysXocT3DtVyQdjKUekHu', 'ba583a7857f09790d02303123f2f1154', '1', '2021-11-23', 'parent'),
(13, 'Child', 'Care', 'childcare.cse@gmail.com', '0222222222', '$2y$10$i0SG/ckobr9FIswY9Rviie1h9MylpRRyWH2F17vBIp5inuZts6Ov2', '11114391bc21ad0daa01d44c9d49a725', '1', '2021-11-18', 'manager'),
(23, 'Midwife', 'one', 'midwife1@gmail.com', '0112212121', '$2y$10$eKqkQTHWWJqf8gX1vPWAm.bzS2DGkbB4c3z.vwmbq8UC3.tkdEQQC', '76a3310e758a5c68d48e777733d4ec0b', '1', '2022-01-09', 'midwife');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advice`
--
ALTER TABLE `advice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_report`
--
ALTER TABLE `child_report`
  ADD PRIMARY KEY (`ChildId`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `midwife`
--
ALTER TABLE `midwife`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advice`
--
ALTER TABLE `advice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `child_report`
--
ALTER TABLE `child_report`
  MODIFY `ChildId` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `midwife`
--
ALTER TABLE `midwife`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
