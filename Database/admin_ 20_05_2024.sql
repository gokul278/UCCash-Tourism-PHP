-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2024 at 08:34 AM
-- Server version: 10.11.7-MariaDB
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindetails`
--

CREATE TABLE `admindetails` (
  `id` int(10) NOT NULL,
  `admin_id` varchar(10) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_email` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admindetails`
--

INSERT INTO `admindetails` (`id`, `admin_id`, `admin_name`, `admin_password`, `admin_email`) VALUES
(1, 'UCT000000', 'Dr. P. Balakrishnnan', '9283a03246ef2dacdc21a9b137817ec1', 'test@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `availablewithdrwabalance`
--

CREATE TABLE `availablewithdrwabalance` (
  `awb_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `awb_from` varchar(100) NOT NULL,
  `awb_to` varchar(100) NOT NULL,
  `awb_points` varchar(30) NOT NULL,
  `awb_action` varchar(30) NOT NULL,
  `awb_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `availablewithdrwabalance`
--

INSERT INTO `availablewithdrwabalance` (`awb_id`, `user_id`, `awb_from`, `awb_to`, `awb_points`, `awb_action`, `awb_createdat`) VALUES
(1, 'UCT1003', 'Networking Income', 'Available Withdraw Balance', '10.00', 'credit', '2024-05-17 07:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `bonustravelpoints`
--

CREATE TABLE `bonustravelpoints` (
  `bt_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `bt_points` varchar(30) NOT NULL,
  `bt_bonusfrom` varchar(20) NOT NULL,
  `bt_lvl` varchar(20) NOT NULL,
  `bt_action` varchar(30) NOT NULL,
  `bt_remark` varchar(50) NOT NULL,
  `bt_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bonustravelpoints`
--

INSERT INTO `bonustravelpoints` (`bt_id`, `user_id`, `bt_points`, `bt_bonusfrom`, `bt_lvl`, `bt_action`, `bt_remark`, `bt_createdat`) VALUES
(1, 'UCT99999', '0.83', 'UCT1001', '1', 'credit', 'Bonus Travel Points', '2024-05-07 09:39:14'),
(2, 'UCT1001', '0.83', 'UCT1002', '1', 'credit', 'Bonus Travel Points', '2024-05-07 09:47:38'),
(3, 'UCT99999', '0.83', 'UCT1002', '2', 'credit', 'Bonus Travel Points', '2024-05-07 09:47:38'),
(4, 'UCT1002', '0.83', 'UCT1003', '1', 'credit', 'Bonus Travel Points', '2024-05-07 09:51:38'),
(5, 'UCT1001', '0.83', 'UCT1003', '2', 'credit', 'Bonus Travel Points', '2024-05-07 09:51:38'),
(6, 'UCT99999', '0.83', 'UCT1003', '3', 'credit', 'Bonus Travel Points', '2024-05-07 09:51:38'),
(7, 'UCT1003', '0.83', 'UCT1004', '1', 'credit', 'Bonus Travel Points', '2024-05-07 13:00:47'),
(8, 'UCT1002', '0.83', 'UCT1004', '2', 'credit', 'Bonus Travel Points', '2024-05-07 13:00:47'),
(9, 'UCT1001', '0.83', 'UCT1004', '3', 'credit', 'Bonus Travel Points', '2024-05-07 13:00:47'),
(10, 'UCT99999', '0.83', 'UCT1004', '4', 'credit', 'Bonus Travel Points', '2024-05-07 13:00:47'),
(11, 'UCT1004', '0.83', 'UCT1005', '1', 'credit', 'Bonus Travel Points', '2024-05-08 14:35:20'),
(12, 'UCT1003', '0.83', 'UCT1005', '2', 'credit', 'Bonus Travel Points', '2024-05-08 14:35:20'),
(13, 'UCT1002', '0.83', 'UCT1005', '3', 'credit', 'Bonus Travel Points', '2024-05-08 14:35:20'),
(14, 'UCT1001', '0.83', 'UCT1005', '4', 'credit', 'Bonus Travel Points', '2024-05-08 14:35:20'),
(15, 'UCT99999', '0.83', 'UCT1005', '5', 'credit', 'Bonus Travel Points', '2024-05-08 14:35:20'),
(16, 'UCT1003', '0.83', 'UCT1007', '1', 'credit', 'Bonus Travel Points', '2024-05-08 15:25:05'),
(17, 'UCT1002', '0.83', 'UCT1007', '2', 'credit', 'Bonus Travel Points', '2024-05-08 15:25:05'),
(18, 'UCT1001', '0.83', 'UCT1007', '3', 'credit', 'Bonus Travel Points', '2024-05-08 15:25:05'),
(19, 'UCT99999', '0.83', 'UCT1007', '4', 'credit', 'Bonus Travel Points', '2024-05-08 15:25:05'),
(20, 'UCT1003', '0.83', 'UCT1008', '1', 'credit', 'Bonus Travel Points', '2024-05-09 02:30:49'),
(21, 'UCT1002', '0.83', 'UCT1008', '2', 'credit', 'Bonus Travel Points', '2024-05-09 02:30:49'),
(22, 'UCT1001', '0.83', 'UCT1008', '3', 'credit', 'Bonus Travel Points', '2024-05-09 02:30:49'),
(23, 'UCT99999', '0.83', 'UCT1008', '4', 'credit', 'Bonus Travel Points', '2024-05-09 02:30:49'),
(24, 'UCT1003', '0.83', 'UCT1009', '1', 'credit', 'Bonus Travel Points', '2024-05-09 11:04:08'),
(25, 'UCT1002', '0.83', 'UCT1009', '2', 'credit', 'Bonus Travel Points', '2024-05-09 11:04:08'),
(26, 'UCT1001', '0.83', 'UCT1009', '3', 'credit', 'Bonus Travel Points', '2024-05-09 11:04:08'),
(27, 'UCT99999', '0.83', 'UCT1009', '4', 'credit', 'Bonus Travel Points', '2024-05-09 11:04:08'),
(28, 'UCT1003', '0.83', 'UCT1006', '1', 'credit', 'Bonus Travel Points', '2024-05-13 07:10:01'),
(29, 'UCT1002', '0.83', 'UCT1006', '2', 'credit', 'Bonus Travel Points', '2024-05-13 07:10:01'),
(30, 'UCT1001', '0.83', 'UCT1006', '3', 'credit', 'Bonus Travel Points', '2024-05-13 07:10:01'),
(31, 'UCT99999', '0.83', 'UCT1006', '4', 'credit', 'Bonus Travel Points', '2024-05-13 07:10:01'),
(32, 'UCT1008', '0.83', 'UCT1012', '1', 'credit', 'Bonus Travel Points', '2024-05-14 08:11:49'),
(33, 'UCT1003', '0.83', 'UCT1012', '2', 'credit', 'Bonus Travel Points', '2024-05-14 08:11:49'),
(34, 'UCT1002', '0.83', 'UCT1012', '3', 'credit', 'Bonus Travel Points', '2024-05-14 08:11:49'),
(35, 'UCT1001', '0.83', 'UCT1012', '4', 'credit', 'Bonus Travel Points', '2024-05-14 08:11:49'),
(36, 'UCT99999', '0.83', 'UCT1012', '5', 'credit', 'Bonus Travel Points', '2024-05-14 08:11:49'),
(37, 'UCT1003', '0.83', 'UCT1013', '1', 'credit', 'Bonus Travel Points', '2024-05-19 03:19:24'),
(38, 'UCT1002', '0.83', 'UCT1013', '2', 'credit', 'Bonus Travel Points', '2024-05-19 03:19:24'),
(39, 'UCT1001', '0.83', 'UCT1013', '3', 'credit', 'Bonus Travel Points', '2024-05-19 03:19:24'),
(40, 'UCT99999', '0.83', 'UCT1013', '4', 'credit', 'Bonus Travel Points', '2024-05-19 03:19:24'),
(41, 'UCT1009', '0.83', 'UCT1024', '1', 'credit', 'Bonus Travel Points', '2024-05-20 07:47:01'),
(42, 'UCT1003', '0.83', 'UCT1024', '2', 'credit', 'Bonus Travel Points', '2024-05-20 07:47:01'),
(43, 'UCT1002', '0.83', 'UCT1024', '3', 'credit', 'Bonus Travel Points', '2024-05-20 07:47:01'),
(44, 'UCT1001', '0.83', 'UCT1024', '4', 'credit', 'Bonus Travel Points', '2024-05-20 07:47:01'),
(45, 'UCT99999', '0.83', 'UCT1024', '5', 'credit', 'Bonus Travel Points', '2024-05-20 07:47:01'),
(46, 'UCT1008', '0.83', 'UCT1016', '1', 'credit', 'Bonus Travel Points', '2024-05-20 08:16:47'),
(47, 'UCT1003', '0.83', 'UCT1016', '2', 'credit', 'Bonus Travel Points', '2024-05-20 08:16:47'),
(48, 'UCT1002', '0.83', 'UCT1016', '3', 'credit', 'Bonus Travel Points', '2024-05-20 08:16:47'),
(49, 'UCT1001', '0.83', 'UCT1016', '4', 'credit', 'Bonus Travel Points', '2024-05-20 08:16:47'),
(50, 'UCT99999', '0.83', 'UCT1016', '5', 'credit', 'Bonus Travel Points', '2024-05-20 08:16:47'),
(51, 'UCT1003', '0.83', 'UCT1029', '1', 'credit', 'Bonus Travel Points', '2024-05-20 14:25:02'),
(52, 'UCT1002', '0.83', 'UCT1029', '2', 'credit', 'Bonus Travel Points', '2024-05-20 14:25:02'),
(53, 'UCT1001', '0.83', 'UCT1029', '3', 'credit', 'Bonus Travel Points', '2024-05-20 14:25:02'),
(54, 'UCT99999', '0.83', 'UCT1029', '4', 'credit', 'Bonus Travel Points', '2024-05-20 14:25:02'),
(55, 'UCT1024', '0.83', 'UCT1028', '1', 'credit', 'Bonus Travel Points', '2024-05-20 16:37:08'),
(56, 'UCT1009', '0.83', 'UCT1028', '2', 'credit', 'Bonus Travel Points', '2024-05-20 16:37:08'),
(57, 'UCT1003', '0.83', 'UCT1028', '3', 'credit', 'Bonus Travel Points', '2024-05-20 16:37:08'),
(58, 'UCT1002', '0.83', 'UCT1028', '4', 'credit', 'Bonus Travel Points', '2024-05-20 16:37:08'),
(59, 'UCT1001', '0.83', 'UCT1028', '5', 'credit', 'Bonus Travel Points', '2024-05-20 16:37:08'),
(60, 'UCT99999', '0.83', 'UCT1028', '6', 'credit', 'Bonus Travel Points', '2024-05-20 16:37:08'),
(61, 'UCT1003', '0.83', 'UCT1010', '1', 'credit', 'Bonus Travel Points', '2024-05-21 02:34:06'),
(62, 'UCT1002', '0.83', 'UCT1010', '2', 'credit', 'Bonus Travel Points', '2024-05-21 02:34:06'),
(63, 'UCT1001', '0.83', 'UCT1010', '3', 'credit', 'Bonus Travel Points', '2024-05-21 02:34:06'),
(64, 'UCT99999', '0.83', 'UCT1010', '4', 'credit', 'Bonus Travel Points', '2024-05-21 02:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `carandhousefundwallet`
--

CREATE TABLE `carandhousefundwallet` (
  `chfw_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `chfw_points` varchar(30) NOT NULL,
  `chfw_bonusfrom` varchar(20) NOT NULL,
  `chfw_lvl` varchar(20) NOT NULL,
  `chfw_action` varchar(30) NOT NULL,
  `chfw_remark` varchar(50) NOT NULL,
  `chfw_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carandhousefundwallet`
--

INSERT INTO `carandhousefundwallet` (`chfw_id`, `user_id`, `chfw_points`, `chfw_bonusfrom`, `chfw_lvl`, `chfw_action`, `chfw_remark`, `chfw_createdat`) VALUES
(1, 'UCT99999', '0.275', 'UCT1001', '1', 'credit', 'Car & House Fund', '2024-05-07 09:39:14'),
(2, 'UCT1001', '0.275', 'UCT1002', '1', 'credit', 'Car & House Fund', '2024-05-07 09:47:38'),
(3, 'UCT99999', '0.275', 'UCT1002', '2', 'credit', 'Car & House Fund', '2024-05-07 09:47:38'),
(4, 'UCT1002', '0.275', 'UCT1003', '1', 'credit', 'Car & House Fund', '2024-05-07 09:51:38'),
(5, 'UCT1001', '0.275', 'UCT1003', '2', 'credit', 'Car & House Fund', '2024-05-07 09:51:38'),
(6, 'UCT99999', '0.275', 'UCT1003', '3', 'credit', 'Car & House Fund', '2024-05-07 09:51:38'),
(7, 'UCT1003', '0.275', 'UCT1004', '1', 'credit', 'Car & House Fund', '2024-05-07 13:00:47'),
(8, 'UCT1002', '0.275', 'UCT1004', '2', 'credit', 'Car & House Fund', '2024-05-07 13:00:47'),
(9, 'UCT1001', '0.275', 'UCT1004', '3', 'credit', 'Car & House Fund', '2024-05-07 13:00:47'),
(10, 'UCT99999', '0.275', 'UCT1004', '4', 'credit', 'Car & House Fund', '2024-05-07 13:00:47'),
(11, 'UCT1004', '0.275', 'UCT1005', '1', 'credit', 'Car & House Fund', '2024-05-08 14:35:20'),
(12, 'UCT1003', '0.275', 'UCT1005', '2', 'credit', 'Car & House Fund', '2024-05-08 14:35:20'),
(13, 'UCT1002', '0.275', 'UCT1005', '3', 'credit', 'Car & House Fund', '2024-05-08 14:35:20'),
(14, 'UCT1001', '0.275', 'UCT1005', '4', 'credit', 'Car & House Fund', '2024-05-08 14:35:20'),
(15, 'UCT99999', '0.275', 'UCT1005', '5', 'credit', 'Car & House Fund', '2024-05-08 14:35:20'),
(16, 'UCT1003', '0.275', 'UCT1007', '1', 'credit', 'Car & House Fund', '2024-05-08 15:25:05'),
(17, 'UCT1002', '0.275', 'UCT1007', '2', 'credit', 'Car & House Fund', '2024-05-08 15:25:05'),
(18, 'UCT1001', '0.275', 'UCT1007', '3', 'credit', 'Car & House Fund', '2024-05-08 15:25:05'),
(19, 'UCT99999', '0.275', 'UCT1007', '4', 'credit', 'Car & House Fund', '2024-05-08 15:25:05'),
(20, 'UCT1003', '0.275', 'UCT1008', '1', 'credit', 'Car & House Fund', '2024-05-09 02:30:49'),
(21, 'UCT1002', '0.275', 'UCT1008', '2', 'credit', 'Car & House Fund', '2024-05-09 02:30:49'),
(22, 'UCT1001', '0.275', 'UCT1008', '3', 'credit', 'Car & House Fund', '2024-05-09 02:30:49'),
(23, 'UCT99999', '0.275', 'UCT1008', '4', 'credit', 'Car & House Fund', '2024-05-09 02:30:49'),
(24, 'UCT1003', '0.275', 'UCT1009', '1', 'credit', 'Car & House Fund', '2024-05-09 11:04:08'),
(25, 'UCT1002', '0.275', 'UCT1009', '2', 'credit', 'Car & House Fund', '2024-05-09 11:04:08'),
(26, 'UCT1001', '0.275', 'UCT1009', '3', 'credit', 'Car & House Fund', '2024-05-09 11:04:08'),
(27, 'UCT99999', '0.275', 'UCT1009', '4', 'credit', 'Car & House Fund', '2024-05-09 11:04:08'),
(28, 'UCT1003', '0.275', 'UCT1006', '1', 'credit', 'Car & House Fund', '2024-05-13 07:10:01'),
(29, 'UCT1002', '0.275', 'UCT1006', '2', 'credit', 'Car & House Fund', '2024-05-13 07:10:01'),
(30, 'UCT1001', '0.275', 'UCT1006', '3', 'credit', 'Car & House Fund', '2024-05-13 07:10:01'),
(31, 'UCT99999', '0.275', 'UCT1006', '4', 'credit', 'Car & House Fund', '2024-05-13 07:10:01'),
(32, 'UCT1008', '0.275', 'UCT1012', '1', 'credit', 'Car & House Fund', '2024-05-14 08:11:49'),
(33, 'UCT1003', '0.275', 'UCT1012', '2', 'credit', 'Car & House Fund', '2024-05-14 08:11:49'),
(34, 'UCT1002', '0.275', 'UCT1012', '3', 'credit', 'Car & House Fund', '2024-05-14 08:11:49'),
(35, 'UCT1001', '0.275', 'UCT1012', '4', 'credit', 'Car & House Fund', '2024-05-14 08:11:49'),
(36, 'UCT99999', '0.275', 'UCT1012', '5', 'credit', 'Car & House Fund', '2024-05-14 08:11:49'),
(37, 'UCT1003', '0.275', 'UCT1013', '1', 'credit', 'Car & House Fund', '2024-05-19 03:19:24'),
(38, 'UCT1002', '0.275', 'UCT1013', '2', 'credit', 'Car & House Fund', '2024-05-19 03:19:24'),
(39, 'UCT1001', '0.275', 'UCT1013', '3', 'credit', 'Car & House Fund', '2024-05-19 03:19:24'),
(40, 'UCT99999', '0.275', 'UCT1013', '4', 'credit', 'Car & House Fund', '2024-05-19 03:19:24'),
(41, 'UCT1009', '0.275', 'UCT1024', '1', 'credit', 'Car & House Fund', '2024-05-20 07:47:01'),
(42, 'UCT1003', '0.275', 'UCT1024', '2', 'credit', 'Car & House Fund', '2024-05-20 07:47:01'),
(43, 'UCT1002', '0.275', 'UCT1024', '3', 'credit', 'Car & House Fund', '2024-05-20 07:47:01'),
(44, 'UCT1001', '0.275', 'UCT1024', '4', 'credit', 'Car & House Fund', '2024-05-20 07:47:01'),
(45, 'UCT99999', '0.275', 'UCT1024', '5', 'credit', 'Car & House Fund', '2024-05-20 07:47:01'),
(46, 'UCT1008', '0.275', 'UCT1016', '1', 'credit', 'Car & House Fund', '2024-05-20 08:16:47'),
(47, 'UCT1003', '0.275', 'UCT1016', '2', 'credit', 'Car & House Fund', '2024-05-20 08:16:47'),
(48, 'UCT1002', '0.275', 'UCT1016', '3', 'credit', 'Car & House Fund', '2024-05-20 08:16:47'),
(49, 'UCT1001', '0.275', 'UCT1016', '4', 'credit', 'Car & House Fund', '2024-05-20 08:16:47'),
(50, 'UCT99999', '0.275', 'UCT1016', '5', 'credit', 'Car & House Fund', '2024-05-20 08:16:47'),
(51, 'UCT1003', '0.275', 'UCT1029', '1', 'credit', 'Car & House Fund', '2024-05-20 14:25:02'),
(52, 'UCT1002', '0.275', 'UCT1029', '2', 'credit', 'Car & House Fund', '2024-05-20 14:25:02'),
(53, 'UCT1001', '0.275', 'UCT1029', '3', 'credit', 'Car & House Fund', '2024-05-20 14:25:02'),
(54, 'UCT99999', '0.275', 'UCT1029', '4', 'credit', 'Car & House Fund', '2024-05-20 14:25:02'),
(55, 'UCT1024', '0.275', 'UCT1028', '1', 'credit', 'Car & House Fund', '2024-05-20 16:37:08'),
(56, 'UCT1009', '0.275', 'UCT1028', '2', 'credit', 'Car & House Fund', '2024-05-20 16:37:08'),
(57, 'UCT1003', '0.275', 'UCT1028', '3', 'credit', 'Car & House Fund', '2024-05-20 16:37:08'),
(58, 'UCT1002', '0.275', 'UCT1028', '4', 'credit', 'Car & House Fund', '2024-05-20 16:37:08'),
(59, 'UCT1001', '0.275', 'UCT1028', '5', 'credit', 'Car & House Fund', '2024-05-20 16:37:08'),
(60, 'UCT99999', '0.275', 'UCT1028', '6', 'credit', 'Car & House Fund', '2024-05-20 16:37:08'),
(61, 'UCT1003', '0.275', 'UCT1010', '1', 'credit', 'Car & House Fund', '2024-05-21 02:34:06'),
(62, 'UCT1002', '0.275', 'UCT1010', '2', 'credit', 'Car & House Fund', '2024-05-21 02:34:06'),
(63, 'UCT1001', '0.275', 'UCT1010', '3', 'credit', 'Car & House Fund', '2024-05-21 02:34:06'),
(64, 'UCT99999', '0.275', 'UCT1010', '4', 'credit', 'Car & House Fund', '2024-05-21 02:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `flashbanner`
--

CREATE TABLE `flashbanner` (
  `id` int(11) NOT NULL,
  `bannerimage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flashbanner`
--

INSERT INTO `flashbanner` (`id`, `bannerimage`) VALUES
(1, '20240517161603_1000190444.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `forgetpassword`
--

CREATE TABLE `forgetpassword` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `forgetpass_hash` varchar(40) NOT NULL,
  `remark` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forgetpassword`
--

INSERT INTO `forgetpassword` (`id`, `user_id`, `forgetpass_hash`, `remark`, `created_at`, `updated_at`) VALUES
(1, 'UCT99999', '19ed0c26fa77565fdbd1108a1218d0be', 'pending', '2024-05-14 07:30:59', '2024-05-14 07:30:59'),
(2, 'UCT1013', '446789cead0efafe626dfd0730ea61a6', 'pending', '2024-05-17 11:54:44', '2024-05-17 11:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `galleryimages`
--

CREATE TABLE `galleryimages` (
  `id` int(11) NOT NULL,
  `imagename` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleryimages`
--

INSERT INTO `galleryimages` (`id`, `imagename`) VALUES
(20, '20240512094353_IMG-20240512-WA0023.jpg'),
(21, '20240512094404_IMG-20240512-WA0025.jpg'),
(22, '20240512094414_IMG-20240512-WA0026.jpg'),
(23, '20240512100816_IMG-20240512-WA0028.jpg'),
(24, '20240512100825_IMG-20240512-WA0029.jpg'),
(25, '20240512100855_IMG-20240512-WA0030.jpg'),
(26, '20240512100908_IMG-20240512-WA0031.jpg'),
(27, '20240512100915_IMG-20240512-WA0032.jpg'),
(28, '20240512100922_IMG-20240512-WA0033.jpg'),
(29, '20240512100929_IMG-20240512-WA0034.jpg'),
(30, '20240512100938_IMG-20240512-WA0035.jpg'),
(31, '20240512100946_IMG-20240512-WA0036.jpg'),
(32, '20240512100954_IMG-20240512-WA0038.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `genealogy`
--

CREATE TABLE `genealogy` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `lvl1` varchar(30) NOT NULL,
  `lvl2` varchar(30) DEFAULT NULL,
  `lvl3` varchar(30) DEFAULT NULL,
  `lvl4` varchar(30) DEFAULT NULL,
  `lvl5` varchar(30) DEFAULT NULL,
  `lvl6` varchar(30) DEFAULT NULL,
  `lvl7` varchar(30) DEFAULT NULL,
  `lvl8` varchar(30) DEFAULT NULL,
  `lvl9` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genealogy`
--

INSERT INTO `genealogy` (`id`, `user_id`, `lvl1`, `lvl2`, `lvl3`, `lvl4`, `lvl5`, `lvl6`, `lvl7`, `lvl8`, `lvl9`) VALUES
(1, 'UCT1001', 'UCT99999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', '', '', ''),
(3, 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', '', ''),
(4, 'UCT1004', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(5, 'UCT1005', 'UCT1004', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(6, 'UCT1006', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(7, 'UCT1007', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(8, 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(9, 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(10, 'UCT1010', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(11, 'UCT1011', 'UCT99999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'UCT1012', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(13, 'UCT1013', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(14, 'UCT1014', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(15, 'UCT1015', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(16, 'UCT1016', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(17, 'UCT1017', 'UCT1012', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(18, 'UCT1018', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(19, 'UCT1019', 'UCT1012', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(20, 'UCT1020', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(21, 'UCT1021', 'UCT1012', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(22, 'UCT1022', 'UCT1012', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(23, 'UCT1023', 'UCT1012', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(24, 'UCT1024', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(25, 'UCT1025', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(26, 'UCT1026', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(27, 'UCT1027', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(28, 'UCT1028', 'UCT1024', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(29, 'UCT1029', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `idactivation`
--

CREATE TABLE `idactivation` (
  `id` int(11) NOT NULL,
  `idactivation_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `deposite_type` varchar(20) NOT NULL,
  `txnhashid` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(70) DEFAULT NULL,
  `proof_image` varchar(400) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL,
  `remark` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `idactivation`
--

INSERT INTO `idactivation` (`id`, `idactivation_id`, `user_id`, `deposite_type`, `txnhashid`, `transaction_id`, `proof_image`, `action`, `remark`, `created_at`) VALUES
(1, 'IAI-1', 'UCT1001', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-07 09:38:51'),
(2, 'IAI-2', 'UCT1002', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-07 09:47:00'),
(3, 'IAI-3', 'UCT1003', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-07 09:50:56'),
(4, 'IAI-4', 'UCT1004', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-07 12:59:15'),
(5, 'IAI-5', 'UCT1005', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-08 14:34:25'),
(6, 'IAI-6', 'UCT1007', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-08 15:24:13'),
(7, 'IAI-7', 'UCT1008', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-09 00:51:23'),
(8, 'IAI-8', 'UCT1009', 'Crypto', '369369369', NULL, NULL, 'paid', '', '2024-05-09 10:58:12'),
(9, 'IAI-9', 'UCT1006', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-13 06:12:57'),
(10, 'IAI-10', 'UCT1012', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-14 08:11:21'),
(11, 'IAI-11', 'UCT1013', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-19 03:14:19'),
(12, 'IAI-12', 'UCT1024', 'Crypto', '369369369', NULL, NULL, 'paid', '', '2024-05-20 07:43:26'),
(13, 'IAI-13', 'UCT1016', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-20 08:07:24'),
(14, 'IAI-14', 'UCT1029', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-20 14:24:42'),
(15, 'IAI-15', 'UCT1028', 'Crypto', '369369369', NULL, NULL, 'paid', '', '2024-05-20 14:56:46'),
(16, 'IAI-16', 'UCT1010', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-21 02:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `idactivationdeposite`
--

CREATE TABLE `idactivationdeposite` (
  `id` int(11) NOT NULL,
  `crypto_image` varchar(255) NOT NULL,
  `crypto_address` varchar(100) NOT NULL,
  `crypto_value` varchar(30) NOT NULL,
  `bankdeposit_image` varchar(255) NOT NULL,
  `ac_holdername` varchar(50) NOT NULL,
  `ac_number` varchar(50) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `upi_id` varchar(50) NOT NULL,
  `deposit_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `idactivationdeposite`
--

INSERT INTO `idactivationdeposite` (`id`, `crypto_image`, `crypto_address`, `crypto_value`, `bankdeposit_image`, `ac_holdername`, `ac_number`, `ifsc_code`, `branch`, `upi_id`, `deposit_value`) VALUES
(1, '20240506203818_trc20 (1).jpeg', 'TK8XreREARoQse2B9xPMidL7WWNVHZSb2c', '$ 59', '20240509151020_Screenshot_2024_0509_195359.jpg', 'UCCASH TOURISM PRIVATE LIMITED ', '42730402390', 'SBIN0018402', 'KONGANAPURAM', 'uccash@sbi', 'Rs 5310');

-- --------------------------------------------------------

--
-- Table structure for table `idactivationhistory`
--

CREATE TABLE `idactivationhistory` (
  `id` int(11) NOT NULL,
  `idactivation_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `deposite_type` varchar(30) NOT NULL,
  `crypto_value` varchar(50) DEFAULT NULL,
  `txnhash_id` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(70) DEFAULT NULL,
  `proof_image` varchar(400) DEFAULT NULL,
  `bank_value` varchar(20) DEFAULT NULL,
  `travel_coupon` varchar(20) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `idactivationhistory`
--

INSERT INTO `idactivationhistory` (`id`, `idactivation_id`, `user_id`, `paid_date`, `deposite_type`, `crypto_value`, `txnhash_id`, `transaction_id`, `proof_image`, `bank_value`, `travel_coupon`, `action`, `remark`, `created_at`) VALUES
(1, 'IAI-1', 'UCT1001', '2024-05-07 09:38:51', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-07 09:38:51'),
(2, 'IAI-2', 'UCT1002', '2024-05-07 09:47:00', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-07 09:47:00'),
(3, 'IAI-3', 'UCT1003', '2024-05-07 09:50:56', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-07 09:50:56'),
(4, 'IAI-4', 'UCT1004', '2024-05-07 12:59:15', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-07 12:59:15'),
(5, 'IAI-5', 'UCT1005', '2024-05-08 14:34:25', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-08 14:34:25'),
(6, 'IAI-6', 'UCT1007', '2024-05-08 15:24:13', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-08 15:24:13'),
(7, 'IAI-7', 'UCT1008', '2024-05-09 00:51:23', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-09 00:51:23'),
(8, 'IAI-8', 'UCT1009', '2024-05-09 10:58:12', 'Crypto', '$ 59', '369369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-09 10:58:12'),
(9, 'IAI-9', 'UCT1006', '2024-05-13 06:12:57', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-13 06:12:57'),
(10, 'IAI-10', 'UCT1012', '2024-05-14 08:11:21', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-14 08:11:21'),
(11, 'IAI-11', 'UCT1013', '2024-05-19 03:14:19', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-19 03:14:19'),
(12, 'IAI-12', 'UCT1024', '2024-05-20 07:43:26', 'Crypto', '$ 59', '369369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-20 07:43:26'),
(13, 'IAI-13', 'UCT1016', '2024-05-20 08:07:24', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-20 08:07:24'),
(14, 'IAI-14', 'UCT1029', '2024-05-20 14:24:42', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-20 14:24:42'),
(15, 'IAI-15', 'UCT1028', '2024-05-20 14:56:46', 'Crypto', '$ 59', '369369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-20 14:56:46'),
(16, 'IAI-16', 'UCT1010', '2024-05-21 02:32:45', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-21 02:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `idactivationvalue`
--

CREATE TABLE `idactivationvalue` (
  `id` int(11) NOT NULL,
  `value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `idactivationvalue`
--

INSERT INTO `idactivationvalue` (`id`, `value`) VALUES
(1, '50');

-- --------------------------------------------------------

--
-- Table structure for table `latestnews`
--

CREATE TABLE `latestnews` (
  `id` int(10) NOT NULL,
  `news` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latestnews`
--

INSERT INTO `latestnews` (`id`, `news`) VALUES
(1, 'Welcome to UCCASH  Tourism\n<br><br>\nThank you for joining us');

-- --------------------------------------------------------

--
-- Table structure for table `leadershipincomewallet`
--

CREATE TABLE `leadershipincomewallet` (
  `liw_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `liw_points` varchar(30) NOT NULL,
  `liw_bonusfrom` varchar(20) NOT NULL,
  `liw_lvl` varchar(20) NOT NULL,
  `liw_action` varchar(30) NOT NULL,
  `liw_remark` varchar(50) NOT NULL,
  `liw_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leadershipincomewallet`
--

INSERT INTO `leadershipincomewallet` (`liw_id`, `user_id`, `liw_points`, `liw_bonusfrom`, `liw_lvl`, `liw_action`, `liw_remark`, `liw_createdat`) VALUES
(1, 'UCT99999', '0.22', 'UCT1001', '1', 'credit', 'Leadership Income', '2024-05-07 09:39:14'),
(2, 'UCT1001', '0.22', 'UCT1002', '1', 'credit', 'Leadership Income', '2024-05-07 09:47:38'),
(3, 'UCT99999', '0.22', 'UCT1002', '2', 'credit', 'Leadership Income', '2024-05-07 09:47:38'),
(4, 'UCT1002', '0.22', 'UCT1003', '1', 'credit', 'Leadership Income', '2024-05-07 09:51:38'),
(5, 'UCT1001', '0.22', 'UCT1003', '2', 'credit', 'Leadership Income', '2024-05-07 09:51:38'),
(6, 'UCT99999', '0.22', 'UCT1003', '3', 'credit', 'Leadership Income', '2024-05-07 09:51:38'),
(7, 'UCT1003', '0.22', 'UCT1004', '1', 'credit', 'Leadership Income', '2024-05-07 13:00:47'),
(8, 'UCT1002', '0.22', 'UCT1004', '2', 'credit', 'Leadership Income', '2024-05-07 13:00:47'),
(9, 'UCT1001', '0.22', 'UCT1004', '3', 'credit', 'Leadership Income', '2024-05-07 13:00:47'),
(10, 'UCT99999', '0.22', 'UCT1004', '4', 'credit', 'Leadership Income', '2024-05-07 13:00:47'),
(11, 'UCT1004', '0.22', 'UCT1005', '1', 'credit', 'Leadership Income', '2024-05-08 14:35:20'),
(12, 'UCT1003', '0.22', 'UCT1005', '2', 'credit', 'Leadership Income', '2024-05-08 14:35:20'),
(13, 'UCT1002', '0.22', 'UCT1005', '3', 'credit', 'Leadership Income', '2024-05-08 14:35:20'),
(14, 'UCT1001', '0.22', 'UCT1005', '4', 'credit', 'Leadership Income', '2024-05-08 14:35:20'),
(15, 'UCT99999', '0.22', 'UCT1005', '5', 'credit', 'Leadership Income', '2024-05-08 14:35:20'),
(16, 'UCT1003', '0.22', 'UCT1007', '1', 'credit', 'Leadership Income', '2024-05-08 15:25:05'),
(17, 'UCT1002', '0.22', 'UCT1007', '2', 'credit', 'Leadership Income', '2024-05-08 15:25:05'),
(18, 'UCT1001', '0.22', 'UCT1007', '3', 'credit', 'Leadership Income', '2024-05-08 15:25:05'),
(19, 'UCT99999', '0.22', 'UCT1007', '4', 'credit', 'Leadership Income', '2024-05-08 15:25:05'),
(20, 'UCT1003', '0.22', 'UCT1008', '1', 'credit', 'Leadership Income', '2024-05-09 02:30:49'),
(21, 'UCT1002', '0.22', 'UCT1008', '2', 'credit', 'Leadership Income', '2024-05-09 02:30:49'),
(22, 'UCT1001', '0.22', 'UCT1008', '3', 'credit', 'Leadership Income', '2024-05-09 02:30:49'),
(23, 'UCT99999', '0.22', 'UCT1008', '4', 'credit', 'Leadership Income', '2024-05-09 02:30:49'),
(24, 'UCT1003', '0.22', 'UCT1009', '1', 'credit', 'Leadership Income', '2024-05-09 11:04:08'),
(25, 'UCT1002', '0.22', 'UCT1009', '2', 'credit', 'Leadership Income', '2024-05-09 11:04:08'),
(26, 'UCT1001', '0.22', 'UCT1009', '3', 'credit', 'Leadership Income', '2024-05-09 11:04:08'),
(27, 'UCT99999', '0.22', 'UCT1009', '4', 'credit', 'Leadership Income', '2024-05-09 11:04:08'),
(28, 'UCT1003', '0.22', 'UCT1006', '1', 'credit', 'Leadership Income', '2024-05-13 07:10:01'),
(29, 'UCT1002', '0.22', 'UCT1006', '2', 'credit', 'Leadership Income', '2024-05-13 07:10:01'),
(30, 'UCT1001', '0.22', 'UCT1006', '3', 'credit', 'Leadership Income', '2024-05-13 07:10:01'),
(31, 'UCT99999', '0.22', 'UCT1006', '4', 'credit', 'Leadership Income', '2024-05-13 07:10:01'),
(32, 'UCT1008', '0.22', 'UCT1012', '1', 'credit', 'Leadership Income', '2024-05-14 08:11:49'),
(33, 'UCT1003', '0.22', 'UCT1012', '2', 'credit', 'Leadership Income', '2024-05-14 08:11:49'),
(34, 'UCT1002', '0.22', 'UCT1012', '3', 'credit', 'Leadership Income', '2024-05-14 08:11:49'),
(35, 'UCT1001', '0.22', 'UCT1012', '4', 'credit', 'Leadership Income', '2024-05-14 08:11:49'),
(36, 'UCT99999', '0.22', 'UCT1012', '5', 'credit', 'Leadership Income', '2024-05-14 08:11:49'),
(37, 'UCT1003', '0.22', 'UCT1013', '1', 'credit', 'Leadership Income', '2024-05-19 03:19:24'),
(38, 'UCT1002', '0.22', 'UCT1013', '2', 'credit', 'Leadership Income', '2024-05-19 03:19:24'),
(39, 'UCT1001', '0.22', 'UCT1013', '3', 'credit', 'Leadership Income', '2024-05-19 03:19:24'),
(40, 'UCT99999', '0.22', 'UCT1013', '4', 'credit', 'Leadership Income', '2024-05-19 03:19:24'),
(41, 'UCT1009', '0.22', 'UCT1024', '1', 'credit', 'Leadership Income', '2024-05-20 07:47:01'),
(42, 'UCT1003', '0.22', 'UCT1024', '2', 'credit', 'Leadership Income', '2024-05-20 07:47:01'),
(43, 'UCT1002', '0.22', 'UCT1024', '3', 'credit', 'Leadership Income', '2024-05-20 07:47:01'),
(44, 'UCT1001', '0.22', 'UCT1024', '4', 'credit', 'Leadership Income', '2024-05-20 07:47:01'),
(45, 'UCT99999', '0.22', 'UCT1024', '5', 'credit', 'Leadership Income', '2024-05-20 07:47:01'),
(46, 'UCT1008', '0.22', 'UCT1016', '1', 'credit', 'Leadership Income', '2024-05-20 08:16:47'),
(47, 'UCT1003', '0.22', 'UCT1016', '2', 'credit', 'Leadership Income', '2024-05-20 08:16:47'),
(48, 'UCT1002', '0.22', 'UCT1016', '3', 'credit', 'Leadership Income', '2024-05-20 08:16:47'),
(49, 'UCT1001', '0.22', 'UCT1016', '4', 'credit', 'Leadership Income', '2024-05-20 08:16:47'),
(50, 'UCT99999', '0.22', 'UCT1016', '5', 'credit', 'Leadership Income', '2024-05-20 08:16:47'),
(51, 'UCT1003', '0.22', 'UCT1029', '1', 'credit', 'Leadership Income', '2024-05-20 14:25:02'),
(52, 'UCT1002', '0.22', 'UCT1029', '2', 'credit', 'Leadership Income', '2024-05-20 14:25:02'),
(53, 'UCT1001', '0.22', 'UCT1029', '3', 'credit', 'Leadership Income', '2024-05-20 14:25:02'),
(54, 'UCT99999', '0.22', 'UCT1029', '4', 'credit', 'Leadership Income', '2024-05-20 14:25:02'),
(55, 'UCT1024', '0.22', 'UCT1028', '1', 'credit', 'Leadership Income', '2024-05-20 16:37:08'),
(56, 'UCT1009', '0.22', 'UCT1028', '2', 'credit', 'Leadership Income', '2024-05-20 16:37:08'),
(57, 'UCT1003', '0.22', 'UCT1028', '3', 'credit', 'Leadership Income', '2024-05-20 16:37:08'),
(58, 'UCT1002', '0.22', 'UCT1028', '4', 'credit', 'Leadership Income', '2024-05-20 16:37:08'),
(59, 'UCT1001', '0.22', 'UCT1028', '5', 'credit', 'Leadership Income', '2024-05-20 16:37:08'),
(60, 'UCT99999', '0.22', 'UCT1028', '6', 'credit', 'Leadership Income', '2024-05-20 16:37:08'),
(61, 'UCT1003', '0.22', 'UCT1010', '1', 'credit', 'Leadership Income', '2024-05-21 02:34:06'),
(62, 'UCT1002', '0.22', 'UCT1010', '2', 'credit', 'Leadership Income', '2024-05-21 02:34:06'),
(63, 'UCT1001', '0.22', 'UCT1010', '3', 'credit', 'Leadership Income', '2024-05-21 02:34:06'),
(64, 'UCT99999', '0.22', 'UCT1010', '4', 'credit', 'Leadership Income', '2024-05-21 02:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `monthlysavingpendinginvoice`
--

CREATE TABLE `monthlysavingpendinginvoice` (
  `id` int(10) NOT NULL,
  `invoice_id` varchar(20) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `saving_value` varchar(10) DEFAULT NULL,
  `bonustp_value` varchar(10) DEFAULT NULL,
  `totaltp_value` varchar(10) DEFAULT NULL,
  `action` varchar(10) DEFAULT NULL,
  `remark` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthlysavingpendinginvoice`
--

INSERT INTO `monthlysavingpendinginvoice` (`id`, `invoice_id`, `user_id`, `saving_value`, `bonustp_value`, `totaltp_value`, `action`, `remark`, `created_at`) VALUES
(1, 'MSI-1', 'UCT1001', '50$', '5', '55', 'paid', '', '2024-05-07 09:34:54'),
(2, 'MSI-2', 'UCT1002', '50$', '5', '55', 'paid', '', '2024-05-07 09:44:31'),
(3, 'MSI-3', 'UCT1003', '50$', '5', '55', 'paid', '', '2024-05-07 09:50:01'),
(4, 'MSI-4', 'UCT1004', '50$', '5', '55', 'pending', '', '2024-05-07 12:55:27'),
(5, 'MSI-5', 'UCT1005', '50$', '5', '55', 'pending', '', '2024-05-08 14:33:27'),
(6, 'MSI-6', 'UCT1006', '50$', '5', '55', 'pending', '', '2024-05-08 15:16:48'),
(7, 'MSI-7', 'UCT1007', '50$', '5', '55', 'pending', '', '2024-05-08 15:22:42'),
(8, 'MSI-8', 'UCT1008', '50$', '5', '55', 'pending', '', '2024-05-08 16:48:19'),
(9, 'MSI-9', 'UCT1009', '50$', '5', '55', 'pending', '', '2024-05-09 05:46:40'),
(10, 'MSI-10', 'UCT1010', '50$', '5', '55', 'pending', '', '2024-05-14 03:41:41'),
(11, 'MSI-11', 'UCT1011', '50$', '5', '55', 'pending', '', '2024-05-14 07:27:08'),
(12, 'MSI-12', 'UCT1012', '50$', '5', '55', 'pending', '', '2024-05-14 08:06:26'),
(13, 'MSI-13', 'UCT1013', '50$', '5', '55', 'pending', '', '2024-05-14 13:16:59'),
(14, 'MSI-14', 'UCT1014', '50$', '5', '55', 'pending', '', '2024-05-16 07:22:30'),
(15, 'MSI-15', 'UCT1015', '50$', '5', '55', 'pending', '', '2024-05-16 14:43:34'),
(16, 'MSI-16', 'UCT1016', '50$', '5', '55', 'pending', '', '2024-05-17 05:11:45'),
(17, 'MSI-17', 'UCT1017', '50$', '5', '55', 'pending', '', '2024-05-17 08:57:16'),
(18, 'MSI-18', 'UCT1018', '50$', '5', '55', 'pending', '', '2024-05-17 10:43:05'),
(19, 'MSI-19', 'UCT1019', '50$', '5', '55', 'pending', '', '2024-05-17 11:16:16'),
(20, 'MSI-20', 'UCT1020', '50$', '5', '55', 'pending', '', '2024-05-17 11:22:34'),
(21, 'MSI-21', 'UCT1021', '50$', '5', '55', 'pending', '', '2024-05-17 11:46:21'),
(22, 'MSI-22', 'UCT1022', '50$', '5', '55', 'pending', '', '2024-05-17 11:50:37'),
(23, 'MSI-23', 'UCT1023', '50$', '5', '55', 'pending', '', '2024-05-17 11:59:35'),
(24, 'MSI-24', 'UCT1024', '50$', '5', '55', 'pending', '', '2024-05-17 13:02:26'),
(25, 'MSI-25', 'UCT1025', '50$', '5', '55', 'pending', '', '2024-05-17 13:58:56'),
(26, 'MSI-26', 'UCT1026', '50$', '5', '55', 'pending', '', '2024-05-17 16:50:03'),
(27, 'MSI-27', 'UCT1027', '50$', '5', '55', 'pending', '', '2024-05-18 10:36:23'),
(28, 'MSI-28', 'UCT1028', '50$', '5', '55', 'pending', '', '2024-05-20 12:31:45'),
(29, 'MSI-29', 'UCT1029', '50$', '5', '55', 'pending', '', '2024-05-20 14:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `monthlytpsavinghistory`
--

CREATE TABLE `monthlytpsavinghistory` (
  `id` int(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `invoice_id` varchar(10) NOT NULL,
  `invoice_date` varchar(50) NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `txn_hashid` varchar(40) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `tp_value` varchar(10) DEFAULT NULL,
  `bonus_tp` varchar(10) DEFAULT NULL,
  `credit_tp` varchar(10) DEFAULT NULL,
  `debite_tp` varchar(10) DEFAULT NULL,
  `balance_tp` varchar(10) DEFAULT NULL,
  `action` varchar(10) DEFAULT NULL,
  `remark` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthlytpsavinghistory`
--

INSERT INTO `monthlytpsavinghistory` (`id`, `user_id`, `invoice_id`, `invoice_date`, `paid_date`, `txn_hashid`, `payment_type`, `amount`, `tp_value`, `bonus_tp`, `credit_tp`, `debite_tp`, `balance_tp`, `action`, `remark`) VALUES
(1, 'UCT1001', 'MSI-1', '2024-05-07 15:04:54', '2024-05-07 09:39:03', '369369', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '55', 'paid', NULL),
(2, 'UCT1002', 'MSI-2', '2024-05-07 15:14:31', '2024-05-07 09:47:14', '369369', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '55', 'paid', NULL),
(3, 'UCT1003', 'MSI-3', '2024-05-07 15:20:01', '2024-05-07 09:51:17', '369369', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '55', 'paid', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `networkingincomewallet`
--

CREATE TABLE `networkingincomewallet` (
  `niw_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `niw_points` varchar(30) NOT NULL,
  `niw_bonusfrom` varchar(20) NOT NULL,
  `niw_lvl` varchar(20) NOT NULL,
  `niw_action` varchar(30) NOT NULL,
  `niw_remark` varchar(50) NOT NULL,
  `niw_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `networkingincomewallet`
--

INSERT INTO `networkingincomewallet` (`niw_id`, `user_id`, `niw_points`, `niw_bonusfrom`, `niw_lvl`, `niw_action`, `niw_remark`, `niw_createdat`) VALUES
(1, 'UCT99999', '5', 'UCT1001', '1', 'credit', 'Networking Income', '2024-05-07 09:39:14'),
(2, 'UCT1001', '5', 'UCT1002', '1', 'credit', 'Networking Income', '2024-05-07 09:47:38'),
(3, 'UCT99999', '2.5', 'UCT1002', '2', 'credit', 'Networking Income', '2024-05-07 09:47:38'),
(4, 'UCT1002', '5', 'UCT1003', '1', 'credit', 'Networking Income', '2024-05-07 09:51:38'),
(5, 'UCT1001', '2.5', 'UCT1003', '2', 'credit', 'Networking Income', '2024-05-07 09:51:38'),
(6, 'UCT99999', '1.5', 'UCT1003', '3', 'credit', 'Networking Income', '2024-05-07 09:51:38'),
(7, 'UCT1003', '5', 'UCT1004', '1', 'credit', 'Networking Income', '2024-05-07 13:00:47'),
(8, 'UCT1002', '2.5', 'UCT1004', '2', 'credit', 'Networking Income', '2024-05-07 13:00:47'),
(9, 'UCT1001', '1.5', 'UCT1004', '3', 'credit', 'Networking Income', '2024-05-07 13:00:47'),
(10, 'UCT99999', '1', 'UCT1004', '4', 'credit', 'Networking Income', '2024-05-07 13:00:47'),
(11, 'UCT1004', '5', 'UCT1005', '1', 'credit', 'Networking Income', '2024-05-08 14:35:20'),
(12, 'UCT1003', '2.5', 'UCT1005', '2', 'credit', 'Networking Income', '2024-05-08 14:35:20'),
(13, 'UCT1002', '1.5', 'UCT1005', '3', 'credit', 'Networking Income', '2024-05-08 14:35:20'),
(14, 'UCT1001', '1', 'UCT1005', '4', 'credit', 'Networking Income', '2024-05-08 14:35:20'),
(15, 'UCT99999', '0.5', 'UCT1005', '5', 'credit', 'Networking Income', '2024-05-08 14:35:20'),
(16, 'UCT1003', '5', 'UCT1007', '1', 'credit', 'Networking Income', '2024-05-08 15:25:05'),
(17, 'UCT1002', '2.5', 'UCT1007', '2', 'credit', 'Networking Income', '2024-05-08 15:25:05'),
(18, 'UCT1001', '1.5', 'UCT1007', '3', 'credit', 'Networking Income', '2024-05-08 15:25:05'),
(19, 'UCT99999', '1', 'UCT1007', '4', 'credit', 'Networking Income', '2024-05-08 15:25:05'),
(20, 'UCT1003', '5', 'UCT1008', '1', 'credit', 'Networking Income', '2024-05-09 02:30:49'),
(21, 'UCT1002', '2.5', 'UCT1008', '2', 'credit', 'Networking Income', '2024-05-09 02:30:49'),
(22, 'UCT1001', '1.5', 'UCT1008', '3', 'credit', 'Networking Income', '2024-05-09 02:30:49'),
(23, 'UCT99999', '1', 'UCT1008', '4', 'credit', 'Networking Income', '2024-05-09 02:30:49'),
(24, 'UCT1003', '5', 'UCT1009', '1', 'credit', 'Networking Income', '2024-05-09 11:04:08'),
(25, 'UCT1002', '2.5', 'UCT1009', '2', 'credit', 'Networking Income', '2024-05-09 11:04:08'),
(26, 'UCT1001', '1.5', 'UCT1009', '3', 'credit', 'Networking Income', '2024-05-09 11:04:08'),
(27, 'UCT99999', '1', 'UCT1009', '4', 'credit', 'Networking Income', '2024-05-09 11:04:08'),
(28, 'UCT1003', '5', 'UCT1006', '1', 'credit', 'Networking Income', '2024-05-13 07:10:01'),
(29, 'UCT1002', '2.5', 'UCT1006', '2', 'credit', 'Networking Income', '2024-05-13 07:10:01'),
(30, 'UCT1001', '1.5', 'UCT1006', '3', 'credit', 'Networking Income', '2024-05-13 07:10:01'),
(31, 'UCT99999', '1', 'UCT1006', '4', 'credit', 'Networking Income', '2024-05-13 07:10:01'),
(32, 'UCT1008', '5', 'UCT1012', '1', 'credit', 'Networking Income', '2024-05-14 08:11:49'),
(33, 'UCT1003', '2.5', 'UCT1012', '2', 'credit', 'Networking Income', '2024-05-14 08:11:49'),
(34, 'UCT1002', '1.5', 'UCT1012', '3', 'credit', 'Networking Income', '2024-05-14 08:11:49'),
(35, 'UCT1001', '1', 'UCT1012', '4', 'credit', 'Networking Income', '2024-05-14 08:11:49'),
(36, 'UCT99999', '0.5', 'UCT1012', '5', 'credit', 'Networking Income', '2024-05-14 08:11:49'),
(37, 'UCT1003', '10.00', '', '', 'debit', 'Available Withdraw Balance', '2024-05-17 07:02:21'),
(38, 'UCT1003', '5', 'UCT1013', '1', 'credit', 'Networking Income', '2024-05-19 03:19:24'),
(39, 'UCT1002', '2.5', 'UCT1013', '2', 'credit', 'Networking Income', '2024-05-19 03:19:24'),
(40, 'UCT1001', '1.5', 'UCT1013', '3', 'credit', 'Networking Income', '2024-05-19 03:19:24'),
(41, 'UCT99999', '1', 'UCT1013', '4', 'credit', 'Networking Income', '2024-05-19 03:19:24'),
(42, 'UCT1009', '5', 'UCT1024', '1', 'credit', 'Networking Income', '2024-05-20 07:47:01'),
(43, 'UCT1003', '2.5', 'UCT1024', '2', 'credit', 'Networking Income', '2024-05-20 07:47:01'),
(44, 'UCT1002', '1.5', 'UCT1024', '3', 'credit', 'Networking Income', '2024-05-20 07:47:01'),
(45, 'UCT1001', '1', 'UCT1024', '4', 'credit', 'Networking Income', '2024-05-20 07:47:01'),
(46, 'UCT99999', '0.5', 'UCT1024', '5', 'credit', 'Networking Income', '2024-05-20 07:47:01'),
(47, 'UCT1008', '5', 'UCT1016', '1', 'credit', 'Networking Income', '2024-05-20 08:16:47'),
(48, 'UCT1003', '2.5', 'UCT1016', '2', 'credit', 'Networking Income', '2024-05-20 08:16:47'),
(49, 'UCT1002', '1.5', 'UCT1016', '3', 'credit', 'Networking Income', '2024-05-20 08:16:47'),
(50, 'UCT1001', '1', 'UCT1016', '4', 'credit', 'Networking Income', '2024-05-20 08:16:47'),
(51, 'UCT99999', '0.5', 'UCT1016', '5', 'credit', 'Networking Income', '2024-05-20 08:16:47'),
(52, 'UCT1003', '5', 'UCT1029', '1', 'credit', 'Networking Income', '2024-05-20 14:25:02'),
(53, 'UCT1002', '2.5', 'UCT1029', '2', 'credit', 'Networking Income', '2024-05-20 14:25:02'),
(54, 'UCT1001', '1.5', 'UCT1029', '3', 'credit', 'Networking Income', '2024-05-20 14:25:02'),
(55, 'UCT99999', '1', 'UCT1029', '4', 'credit', 'Networking Income', '2024-05-20 14:25:02'),
(56, 'UCT1024', '5', 'UCT1028', '1', 'credit', 'Networking Income', '2024-05-20 16:37:08'),
(57, 'UCT1009', '2.5', 'UCT1028', '2', 'credit', 'Networking Income', '2024-05-20 16:37:08'),
(58, 'UCT1003', '1.5', 'UCT1028', '3', 'credit', 'Networking Income', '2024-05-20 16:37:08'),
(59, 'UCT1002', '1', 'UCT1028', '4', 'credit', 'Networking Income', '2024-05-20 16:37:08'),
(60, 'UCT1001', '0.5', 'UCT1028', '5', 'credit', 'Networking Income', '2024-05-20 16:37:08'),
(61, 'UCT99999', '0.5', 'UCT1028', '6', 'credit', 'Networking Income', '2024-05-20 16:37:08'),
(62, 'UCT1003', '5', 'UCT1010', '1', 'credit', 'Networking Income', '2024-05-21 02:34:06'),
(63, 'UCT1002', '2.5', 'UCT1010', '2', 'credit', 'Networking Income', '2024-05-21 02:34:06'),
(64, 'UCT1001', '1.5', 'UCT1010', '3', 'credit', 'Networking Income', '2024-05-21 02:34:06'),
(65, 'UCT99999', '1', 'UCT1010', '4', 'credit', 'Networking Income', '2024-05-21 02:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `royaltyincomewallet`
--

CREATE TABLE `royaltyincomewallet` (
  `riw_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `riw_points` varchar(30) NOT NULL,
  `riw_bonusfrom` varchar(20) NOT NULL,
  `riw_lvl` varchar(20) NOT NULL,
  `riw_action` varchar(30) NOT NULL,
  `riw_remark` varchar(50) NOT NULL,
  `riw_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `royaltyincomewallet`
--

INSERT INTO `royaltyincomewallet` (`riw_id`, `user_id`, `riw_points`, `riw_bonusfrom`, `riw_lvl`, `riw_action`, `riw_remark`, `riw_createdat`) VALUES
(1, 'UCT99999', '0.33', 'UCT1001', '1', 'credit', 'Royalty Income', '2024-05-07 09:39:14'),
(2, 'UCT1001', '0.33', 'UCT1002', '1', 'credit', 'Royalty Income', '2024-05-07 09:47:38'),
(3, 'UCT99999', '0.33', 'UCT1002', '2', 'credit', 'Royalty Income', '2024-05-07 09:47:38'),
(4, 'UCT1002', '0.33', 'UCT1003', '1', 'credit', 'Royalty Income', '2024-05-07 09:51:38'),
(5, 'UCT1001', '0.33', 'UCT1003', '2', 'credit', 'Royalty Income', '2024-05-07 09:51:38'),
(6, 'UCT99999', '0.33', 'UCT1003', '3', 'credit', 'Royalty Income', '2024-05-07 09:51:38'),
(7, 'UCT1003', '0.33', 'UCT1004', '1', 'credit', 'Royalty Income', '2024-05-07 13:00:47'),
(8, 'UCT1002', '0.33', 'UCT1004', '2', 'credit', 'Royalty Income', '2024-05-07 13:00:47'),
(9, 'UCT1001', '0.33', 'UCT1004', '3', 'credit', 'Royalty Income', '2024-05-07 13:00:47'),
(10, 'UCT99999', '0.33', 'UCT1004', '4', 'credit', 'Royalty Income', '2024-05-07 13:00:47'),
(11, 'UCT1004', '0.33', 'UCT1005', '1', 'credit', 'Royalty Income', '2024-05-08 14:35:20'),
(12, 'UCT1003', '0.33', 'UCT1005', '2', 'credit', 'Royalty Income', '2024-05-08 14:35:20'),
(13, 'UCT1002', '0.33', 'UCT1005', '3', 'credit', 'Royalty Income', '2024-05-08 14:35:20'),
(14, 'UCT1001', '0.33', 'UCT1005', '4', 'credit', 'Royalty Income', '2024-05-08 14:35:20'),
(15, 'UCT99999', '0.33', 'UCT1005', '5', 'credit', 'Royalty Income', '2024-05-08 14:35:20'),
(16, 'UCT1003', '0.33', 'UCT1007', '1', 'credit', 'Royalty Income', '2024-05-08 15:25:05'),
(17, 'UCT1002', '0.33', 'UCT1007', '2', 'credit', 'Royalty Income', '2024-05-08 15:25:05'),
(18, 'UCT1001', '0.33', 'UCT1007', '3', 'credit', 'Royalty Income', '2024-05-08 15:25:05'),
(19, 'UCT99999', '0.33', 'UCT1007', '4', 'credit', 'Royalty Income', '2024-05-08 15:25:05'),
(20, 'UCT1003', '0.33', 'UCT1008', '1', 'credit', 'Royalty Income', '2024-05-09 02:30:49'),
(21, 'UCT1002', '0.33', 'UCT1008', '2', 'credit', 'Royalty Income', '2024-05-09 02:30:49'),
(22, 'UCT1001', '0.33', 'UCT1008', '3', 'credit', 'Royalty Income', '2024-05-09 02:30:49'),
(23, 'UCT99999', '0.33', 'UCT1008', '4', 'credit', 'Royalty Income', '2024-05-09 02:30:49'),
(24, 'UCT1003', '0.33', 'UCT1009', '1', 'credit', 'Royalty Income', '2024-05-09 11:04:08'),
(25, 'UCT1002', '0.33', 'UCT1009', '2', 'credit', 'Royalty Income', '2024-05-09 11:04:08'),
(26, 'UCT1001', '0.33', 'UCT1009', '3', 'credit', 'Royalty Income', '2024-05-09 11:04:08'),
(27, 'UCT99999', '0.33', 'UCT1009', '4', 'credit', 'Royalty Income', '2024-05-09 11:04:08'),
(28, 'UCT1003', '0.33', 'UCT1006', '1', 'credit', 'Royalty Income', '2024-05-13 07:10:01'),
(29, 'UCT1002', '0.33', 'UCT1006', '2', 'credit', 'Royalty Income', '2024-05-13 07:10:01'),
(30, 'UCT1001', '0.33', 'UCT1006', '3', 'credit', 'Royalty Income', '2024-05-13 07:10:01'),
(31, 'UCT99999', '0.33', 'UCT1006', '4', 'credit', 'Royalty Income', '2024-05-13 07:10:01'),
(32, 'UCT1008', '0.33', 'UCT1012', '1', 'credit', 'Royalty Income', '2024-05-14 08:11:49'),
(33, 'UCT1003', '0.33', 'UCT1012', '2', 'credit', 'Royalty Income', '2024-05-14 08:11:49'),
(34, 'UCT1002', '0.33', 'UCT1012', '3', 'credit', 'Royalty Income', '2024-05-14 08:11:49'),
(35, 'UCT1001', '0.33', 'UCT1012', '4', 'credit', 'Royalty Income', '2024-05-14 08:11:49'),
(36, 'UCT99999', '0.33', 'UCT1012', '5', 'credit', 'Royalty Income', '2024-05-14 08:11:49'),
(37, 'UCT1003', '0.33', 'UCT1013', '1', 'credit', 'Royalty Income', '2024-05-19 03:19:24'),
(38, 'UCT1002', '0.33', 'UCT1013', '2', 'credit', 'Royalty Income', '2024-05-19 03:19:24'),
(39, 'UCT1001', '0.33', 'UCT1013', '3', 'credit', 'Royalty Income', '2024-05-19 03:19:24'),
(40, 'UCT99999', '0.33', 'UCT1013', '4', 'credit', 'Royalty Income', '2024-05-19 03:19:24'),
(41, 'UCT1009', '0.33', 'UCT1024', '1', 'credit', 'Royalty Income', '2024-05-20 07:47:01'),
(42, 'UCT1003', '0.33', 'UCT1024', '2', 'credit', 'Royalty Income', '2024-05-20 07:47:01'),
(43, 'UCT1002', '0.33', 'UCT1024', '3', 'credit', 'Royalty Income', '2024-05-20 07:47:01'),
(44, 'UCT1001', '0.33', 'UCT1024', '4', 'credit', 'Royalty Income', '2024-05-20 07:47:01'),
(45, 'UCT99999', '0.33', 'UCT1024', '5', 'credit', 'Royalty Income', '2024-05-20 07:47:01'),
(46, 'UCT1008', '0.33', 'UCT1016', '1', 'credit', 'Royalty Income', '2024-05-20 08:16:47'),
(47, 'UCT1003', '0.33', 'UCT1016', '2', 'credit', 'Royalty Income', '2024-05-20 08:16:47'),
(48, 'UCT1002', '0.33', 'UCT1016', '3', 'credit', 'Royalty Income', '2024-05-20 08:16:47'),
(49, 'UCT1001', '0.33', 'UCT1016', '4', 'credit', 'Royalty Income', '2024-05-20 08:16:47'),
(50, 'UCT99999', '0.33', 'UCT1016', '5', 'credit', 'Royalty Income', '2024-05-20 08:16:47'),
(51, 'UCT1003', '0.33', 'UCT1029', '1', 'credit', 'Royalty Income', '2024-05-20 14:25:02'),
(52, 'UCT1002', '0.33', 'UCT1029', '2', 'credit', 'Royalty Income', '2024-05-20 14:25:02'),
(53, 'UCT1001', '0.33', 'UCT1029', '3', 'credit', 'Royalty Income', '2024-05-20 14:25:02'),
(54, 'UCT99999', '0.33', 'UCT1029', '4', 'credit', 'Royalty Income', '2024-05-20 14:25:02'),
(55, 'UCT1024', '0.33', 'UCT1028', '1', 'credit', 'Royalty Income', '2024-05-20 16:37:08'),
(56, 'UCT1009', '0.33', 'UCT1028', '2', 'credit', 'Royalty Income', '2024-05-20 16:37:08'),
(57, 'UCT1003', '0.33', 'UCT1028', '3', 'credit', 'Royalty Income', '2024-05-20 16:37:08'),
(58, 'UCT1002', '0.33', 'UCT1028', '4', 'credit', 'Royalty Income', '2024-05-20 16:37:08'),
(59, 'UCT1001', '0.33', 'UCT1028', '5', 'credit', 'Royalty Income', '2024-05-20 16:37:08'),
(60, 'UCT99999', '0.33', 'UCT1028', '6', 'credit', 'Royalty Income', '2024-05-20 16:37:08'),
(61, 'UCT1003', '0.33', 'UCT1010', '1', 'credit', 'Royalty Income', '2024-05-21 02:34:06'),
(62, 'UCT1002', '0.33', 'UCT1010', '2', 'credit', 'Royalty Income', '2024-05-21 02:34:06'),
(63, 'UCT1001', '0.33', 'UCT1010', '3', 'credit', 'Royalty Income', '2024-05-21 02:34:06'),
(64, 'UCT99999', '0.33', 'UCT1010', '4', 'credit', 'Royalty Income', '2024-05-21 02:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `savingsincome`
--

CREATE TABLE `savingsincome` (
  `si_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `si_points` varchar(20) NOT NULL,
  `si_bonusfrom` varchar(20) NOT NULL,
  `si_action` varchar(20) NOT NULL,
  `si_remark` varchar(50) NOT NULL,
  `si_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savingsincome`
--

INSERT INTO `savingsincome` (`si_id`, `user_id`, `si_points`, `si_bonusfrom`, `si_action`, `si_remark`, `si_createdat`) VALUES
(1, 'UCT99999', '5', 'UCT1001', 'credit', 'Savings Income', '2024-05-07 09:39:23'),
(2, 'UCT1001', '5', 'UCT1002', 'credit', 'Savings Income', '2024-05-07 09:47:45'),
(3, 'UCT1002', '5', 'UCT1003', 'credit', 'Savings Income', '2024-05-07 09:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `savingstravelpoints`
--

CREATE TABLE `savingstravelpoints` (
  `st_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `st_points` varchar(20) NOT NULL,
  `st_action` varchar(20) NOT NULL,
  `st_bonusfrom` varchar(20) NOT NULL,
  `st_remark` varchar(40) NOT NULL,
  `st_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savingstravelpoints`
--

INSERT INTO `savingstravelpoints` (`st_id`, `user_id`, `st_points`, `st_action`, `st_bonusfrom`, `st_remark`, `st_createdat`) VALUES
(1, 'UCT1001', '55', 'credit', 'UCT1001', 'Savings Travel Points', '2024-05-07 09:39:23'),
(2, 'UCT1002', '55', 'credit', 'UCT1002', 'Savings Travel Points', '2024-05-07 09:47:45'),
(3, 'UCT1003', '55', 'credit', 'UCT1003', 'Savings Travel Points', '2024-05-07 09:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `travelcouponpoints`
--

CREATE TABLE `travelcouponpoints` (
  `tc_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tc_points` varchar(30) NOT NULL,
  `tc_action` varchar(30) NOT NULL,
  `tc_remark` varchar(50) NOT NULL,
  `tc_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travelcouponpoints`
--

INSERT INTO `travelcouponpoints` (`tc_id`, `user_id`, `tc_points`, `tc_action`, `tc_remark`, `tc_createdat`) VALUES
(1, 'UCT1001', '50', 'credit', 'Travel Coupon', '2024-05-07 09:39:14'),
(2, 'UCT1002', '50', 'credit', 'Travel Coupon', '2024-05-07 09:47:38'),
(3, 'UCT1003', '50', 'credit', 'Travel Coupon', '2024-05-07 09:51:38'),
(4, 'UCT1004', '50', 'credit', 'Travel Coupon', '2024-05-07 13:00:47'),
(5, 'UCT1005', '50', 'credit', 'Travel Coupon', '2024-05-08 14:35:20'),
(6, 'UCT1007', '50', 'credit', 'Travel Coupon', '2024-05-08 15:25:05'),
(7, 'UCT1008', '50', 'credit', 'Travel Coupon', '2024-05-09 02:30:49'),
(8, 'UCT1009', '50', 'credit', 'Travel Coupon', '2024-05-09 11:04:08'),
(9, 'UCT1006', '50', 'credit', 'Travel Coupon', '2024-05-13 07:10:01'),
(10, 'UCT1012', '50', 'credit', 'Travel Coupon', '2024-05-14 08:11:49'),
(11, 'UCT1013', '50', 'credit', 'Travel Coupon', '2024-05-19 03:19:24'),
(12, 'UCT1024', '50', 'credit', 'Travel Coupon', '2024-05-20 07:47:01'),
(13, 'UCT1016', '50', 'credit', 'Travel Coupon', '2024-05-20 08:16:47'),
(14, 'UCT1029', '50', 'credit', 'Travel Coupon', '2024-05-20 14:25:02'),
(15, 'UCT1028', '50', 'credit', 'Travel Coupon', '2024-05-20 16:37:08'),
(16, 'UCT1010', '50', 'credit', 'Travel Coupon', '2024-05-21 02:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `uccvalue`
--

CREATE TABLE `uccvalue` (
  `id` int(11) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uccvalue`
--

INSERT INTO `uccvalue` (`id`, `value`) VALUES
(1, '4500');

-- --------------------------------------------------------

--
-- Table structure for table `userbankdetails`
--

CREATE TABLE `userbankdetails` (
  `id` int(5) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `ac_holdername` varchar(20) DEFAULT NULL,
  `ac_bankname` varchar(30) DEFAULT NULL,
  `ac_number` varchar(20) DEFAULT NULL,
  `ifsc_code` varchar(15) DEFAULT NULL,
  `branch` varchar(15) DEFAULT NULL,
  `trc20_address` varchar(30) DEFAULT NULL,
  `bep20_address` varchar(30) DEFAULT NULL,
  `otp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userbankdetails`
--

INSERT INTO `userbankdetails` (`id`, `user_id`, `ac_holdername`, `ac_bankname`, `ac_number`, `ifsc_code`, `branch`, `trc20_address`, `bep20_address`, `otp`) VALUES
(1, 'UCT1003', 'BALAKRISHNAN P', 'STATE BANK OF INDIA', '33954688098', 'SBIN0018402', 'KONGANAPURAM', NULL, NULL, '497681'),
(2, 'UCT99999', 'aa', 'aa', 'aa', 'aa', 'aa', 'aa', 'aaq', NULL),
(3, 'UCT1002', NULL, NULL, NULL, NULL, NULL, '', 'G', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) DEFAULT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_fathername` varchar(20) DEFAULT NULL,
  `user_gender` varchar(20) DEFAULT NULL,
  `user_profileimg` varchar(255) DEFAULT NULL,
  `user_dob` varchar(10) DEFAULT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_phoneno` varchar(20) NOT NULL,
  `user_aadharano` varchar(20) DEFAULT NULL,
  `user_panno` varchar(15) DEFAULT NULL,
  `user_maritalstatus` varchar(10) DEFAULT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_city` varchar(20) NOT NULL,
  `user_zipcode` varchar(20) NOT NULL,
  `user_state` varchar(20) NOT NULL,
  `user_country` varchar(20) NOT NULL,
  `user_sponserid` varchar(10) NOT NULL,
  `user_referalStatus` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `user_id`, `user_password`, `user_name`, `user_fathername`, `user_gender`, `user_profileimg`, `user_dob`, `user_email`, `user_phoneno`, `user_aadharano`, `user_panno`, `user_maritalstatus`, `user_address`, `user_city`, `user_zipcode`, `user_state`, `user_country`, `user_sponserid`, `user_referalStatus`, `created_at`, `updated_at`) VALUES
(1, 'UCT99999', '9283a03246ef2dacdc21a9b137817ec1', 'UCCASH TOURISM', 'TOURISM', '', '20240510022347_INDIPENDENT DISTRIBUTOR.png', '', 'gokulhk278@gmail.com', '', '', '', '', 'Konganapuram', 'Salem', '637102', 'Tamilnadu', 'India', 'admin', 'activated', '2024-05-07 09:21:43', '2024-05-14 07:45:27'),
(2, 'UCT1001', '1c2959c174c03bee51f726cdcdf34dc7', 'SARASWATHI P', '', '', '', '', 'myvgsaraswathi@gmail.com', '+918883687758', '', '', '', '2 140A, PANDARANGADU, KONASAMUDRAM PO,  EDAPPADI TK,  SALEM DT,', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT99999', 'activated', '2024-05-07 09:34:54', '2024-05-07 09:39:14'),
(3, 'UCT1002', '1c2959c174c03bee51f726cdcdf34dc7', 'BALAKRISHNAN P', '', '', '20240510022859_bill_image_413460_1629269700353.jpg', '', 'uccashbala@gmail.com', '+919842434284', '', '', '', '2 140A, PANDARANGADU, KONASAMUDRAM PO,  EDAPPADI TK,  SALEM DT,', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT1001', 'activated', '2024-05-07 09:44:31', '2024-05-10 02:28:59'),
(4, 'UCT1003', '1c2959c174c03bee51f726cdcdf34dc7', 'ADMIN', 'ADMIN', 'male', '20240510023228_4_20240417_162752_0003.png', '1984-04-10', 'uccashtourism@gmail.com', '+918124779993', '986264407489', 'ATPPB3908E', 'unmarried', '2 140A, PANDARANGADU, KONASAMUDRAM PO,  EDAPPADI TK,  SALEM DT,', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT1002', 'activated', '2024-05-07 09:50:01', '2024-05-14 08:48:16'),
(5, 'UCT1004', '728d91e1c5cbd3844efbc119bd2b90f9', 'P MURUGAN', '', '', '', '', 'myvgmurugan@gmail.com', '+918940017939', '', '', '', 'Salem', 'Salem', '636004', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-07 12:55:27', '2024-05-07 13:00:47'),
(6, 'UCT1005', '802a3057a750b677ae066288213042fd', 'S VANAROJA', '', '', '', '', 'vanaroja2787@gmail.com', '+919486341457', '', '', '', 'Pappireddypatti', 'Harur', '636905', 'Tamil Nadu', 'India', 'UCT1004', 'activated', '2024-05-08 14:33:27', '2024-05-08 14:35:20'),
(7, 'UCT1006', '0dc47388bf9190d0073a57396233a8ca', 'Sudhakaran c', '', '', '', '', 'flytravelnetwork@gmail.com', '+919943057743', '', '', '', '1/162  NORTH STREET KALINGAMUDAIYANPATTY PO THURAIYUR TK TRICHY DT ', 'Tiruchirapalli', '621008', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-08 15:16:48', '2024-05-13 07:10:01'),
(8, 'UCT1007', '47ca971597b14e9b3b11058666f323aa', 'Perumal E', '', '', '', '', 'perumalperumal1983@gmail.com', '+919715529302', '', '', '', 'Ellappan kadu, Konasamudram Post, Edappadi TK ', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-08 15:22:42', '2024-05-08 15:25:05'),
(9, 'UCT1008', 'f5b4d3ce781deba17b07c28c9c58cf8e', 'KUMARAVEL. K', '', '', '', '', 'kumaravelpmvy369@gmail.com', '+919786322532', '', '', '', '8/70, Samudram, Idappadi', 'Salem', '636306', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-08 16:48:19', '2024-05-09 02:30:49'),
(10, 'UCT1009', '7aa0c32c6b7ff07264ba0e3d02262475', 'S. Meganathan', '', '', '', '', 'megansemmalai@gmail.com', '+919952474033', '', '', '', 'Dadapuram post\nV. Valasai via\nEdappadi tk\nSalem Dt\n', 'Edappadi', '637105', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-09 05:46:40', '2024-05-09 11:04:08'),
(11, 'UCT1010', 'e914e89ae6945bab0286af214d2ede0d', 'Vignesh Kumar K', NULL, NULL, NULL, NULL, 'vignesh123rb@gmail.com', '+918220402013', NULL, NULL, NULL, 'Konganaburam ', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-14 03:41:41', '2024-05-21 02:34:06'),
(12, 'UCT1011', 'a5ce312092aa0e2befdacfe783decae4', 'Gowtham J', NULL, NULL, NULL, NULL, 'gowthamjayaram333@gmail.com', '+919360248850', NULL, NULL, NULL, 'Chinnasalem', 'Kallakurichi', '606201', 'Tamil Nadu', 'India', 'UCT99999', 'notactivated', '2024-05-14 07:27:08', '2024-05-14 07:27:08'),
(13, 'UCT1012', '6e842b87a9490c4cf4210f849a1dd23c', 'K. Moorthy', NULL, NULL, NULL, NULL, 'kdm1468@gmail.com', '+919442333942', NULL, NULL, NULL, 'Mettur, Metturdam-1', 'Mettur', '636401', 'Tamil Nadu', 'India', 'UCT1008', 'activated', '2024-05-14 08:06:26', '2024-05-14 08:11:49'),
(14, 'UCT1013', 'dd8403cbcde0ed28862c5613cb204519', 'Arangarasan K', NULL, NULL, NULL, NULL, 'arangarasan70@gmail.com', '+918903563505', NULL, NULL, NULL, '314 4th street\nPhilomina nagar\nThanjavur 613006', 'Thanjavur', '613006', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-14 13:16:59', '2024-05-19 03:19:24'),
(15, 'UCT1014', '40fd12adc082ce920ce4957d1b4b83ee', 'JayaguruPandian', NULL, NULL, NULL, NULL, 'jayagurupandian@gmail.com', '+919700242534', NULL, NULL, NULL, '1/7 north street S chennampatti sembarani peraiyur tk', 'Madurai', '625527', 'Tamil Nadu', 'India', 'UCT1003', 'notactivated', '2024-05-16 07:22:30', '2024-05-16 07:22:30'),
(16, 'UCT1015', '7d893a09205df85fe74bddffe65e631d', 'NEWRAJA S', NULL, NULL, NULL, NULL, 'new_raja87@yahoo.com', '+919751417940', NULL, NULL, NULL, 'No.1/198, Middle Street, Kiliyur & Post, Ulundurpet Taluk, Kallakurichi Dist, Tamil Nadu - 606102', 'KALLAKURICHI', '606102', 'Tamil Nadu', 'India', 'UCT1003', 'notactivated', '2024-05-16 14:43:34', '2024-05-16 14:43:34'),
(17, 'UCT1016', '7cd10234c08b330274efbbd2f440412d', 'C.Sangilimuthan', NULL, NULL, NULL, NULL, 'csmuthu25@gmail.com', '+918870504047', NULL, NULL, NULL, 'Irumpalai,Salem_13', 'Salem', '631613', 'Tamil Nadu', 'India', 'UCT1008', 'activated', '2024-05-17 05:11:45', '2024-05-20 08:16:47'),
(18, 'UCT1017', '83df6abab1b9d233722ff14492b4f82a', 'SANTHI. N', NULL, NULL, NULL, NULL, 'nsanthiteacher@gmail.com', '+918838371795', NULL, NULL, NULL, 'Mettur, Metturdam', 'Mettur', '636401', 'Tamil Nadu', 'India', 'UCT1012', 'notactivated', '2024-05-17 08:57:16', '2024-05-17 08:57:16'),
(19, 'UCT1018', '2942f63d949da4a48ed538801c67e653', 'SURESH', NULL, NULL, NULL, NULL, 'lifeisgateway@gmail.com', '+919894603344', NULL, NULL, NULL, 'No.1.Mp.towers  \nTHIRU VI KA ROAD\n Muncipal colony', 'Erode', '638004', 'Tamil Nadu', 'India', 'UCT1003', 'notactivated', '2024-05-17 10:43:05', '2024-05-17 10:43:05'),
(20, 'UCT1019', 'f872ad029e116b7a6ec849e28769acd3', 'KOWSALYA. D', NULL, NULL, NULL, NULL, 'kowsalyamtr97@gmail.com', '+918903670167', NULL, NULL, NULL, 'Mettur, Metturdam', 'Mettur', '636401', 'Tamil Nadu', 'India', 'UCT1012', 'notactivated', '2024-05-17 11:16:16', '2024-05-17 11:16:16'),
(21, 'UCT1020', '2113608f1b8ee6d8903ec33df30ab477', 'R. KATHIRAVAN ', NULL, NULL, NULL, NULL, 'uccashkathiravan@gmail.com', '+919095647575', NULL, NULL, NULL, '76, sikkinapuram. Thannirpantal\nDhalavoipattinam PO, Dharapuram tk', 'Tirupur', '638672', 'Tamil Nadu', 'India', 'UCT1003', 'notactivated', '2024-05-17 11:22:34', '2024-05-17 11:22:34'),
(22, 'UCT1021', 'a1c868695b692d939bd160c9efbfa06a', 'INDU. D', NULL, NULL, NULL, NULL, 'di6289315@gmail.com', '+919791233305', NULL, NULL, NULL, 'Mettur, Metturdam', 'Mettur', '636401', 'Tamil Nadu', 'India', 'UCT1012', 'notactivated', '2024-05-17 11:46:21', '2024-05-17 11:46:21'),
(23, 'UCT1022', '33d96aaa49c9f87a2d8b8900ddb3c1bd', 'D BRINDA', NULL, NULL, NULL, NULL, 'brindashrin@gmail.com', '+918878001050', NULL, NULL, NULL, 'Mettur, Mettur dam', 'Mettur', '636401', 'Tamil Nadu', 'India', 'UCT1012', 'notactivated', '2024-05-17 11:50:37', '2024-05-17 11:50:37'),
(24, 'UCT1023', '4ac0566733d63e90bda543127b312567', 'SUWETHA. D', NULL, NULL, NULL, NULL, 'suwethamoorthy123@gmail.com', '+919786238797', NULL, NULL, NULL, 'Mettur, Metturdam', 'Mettur', '636401', 'Tamil Nadu', 'India', 'UCT1012', 'notactivated', '2024-05-17 11:59:35', '2024-05-17 11:59:35'),
(25, 'UCT1024', 'f354b384c0d334606e004c5880b99d7e', 'Rajeswari S', NULL, NULL, NULL, NULL, 'epxrajeswari@gmail.com', '+918675335774', NULL, NULL, NULL, 'Dadapuram', 'Edappadi', '637105', 'Tamil Nadu', 'India', 'UCT1009', 'activated', '2024-05-17 13:02:26', '2024-05-20 07:47:01'),
(26, 'UCT1025', '9d302835494c7500612d42c4db3fb338', 'Subramani P', NULL, NULL, NULL, NULL, 'subramanimps8614@gmail.com', '+918883336620', NULL, NULL, NULL, '116,Rayanampatti  koranampatti ', 'Salem ', '637102', 'Tamil Nadu', 'India', 'UCT1003', 'notactivated', '2024-05-17 13:58:56', '2024-05-17 13:58:56'),
(27, 'UCT1026', '13441469653a2e8c6040db10c541ac95', 'Ramesh ', NULL, NULL, NULL, NULL, 'sub.ramesh1980@gmail.com', '+919345459874', NULL, NULL, NULL, '# L-11,ThiyaguMudaliar Nagar Housing board\nMudaliarpet, Pondicherry', 'Puducherry', '605004', 'Puducherry', 'India', 'UCT1003', 'notactivated', '2024-05-17 16:50:03', '2024-05-17 16:50:03'),
(28, 'UCT1027', 'ed23570bbff1989d48681952a6ecfbf4', 'Annamalai S', NULL, NULL, NULL, NULL, 'aranthaiannamalai@gmail.com', '+919842422567', NULL, NULL, NULL, '155-1 mookudi, Aliyanilai Po, Aranthangi-614616', 'PUDUKKOTTAI', '614616', 'Tamil Nadu', 'India', 'UCT1008', 'notactivated', '2024-05-18 10:36:23', '2024-05-18 10:36:23'),
(29, 'UCT1028', 'c875c6fb08ce1eb547eb72efb197841a', 'M Murugan', NULL, NULL, NULL, NULL, 'muthumurugan01974@gmail.com', '+919080237937', NULL, NULL, NULL, '1,selavadai', 'Salem', '636501', 'Tamil Nadu', 'India', 'UCT1024', 'activated', '2024-05-20 12:31:45', '2024-05-20 16:37:08'),
(30, 'UCT1029', '9f1531cd04c3430d969e66232eeefe88', 'Muthu P', NULL, NULL, NULL, NULL, 'muthu8919@gmail.com', '+919092847744', NULL, NULL, NULL, 'D.no 3/44,komalikadu, koranampatti, Edappadi, Salem ', 'Salem ', '637102', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-20 14:23:05', '2024-05-20 14:25:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindetails`
--
ALTER TABLE `admindetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `availablewithdrwabalance`
--
ALTER TABLE `availablewithdrwabalance`
  ADD PRIMARY KEY (`awb_id`);

--
-- Indexes for table `bonustravelpoints`
--
ALTER TABLE `bonustravelpoints`
  ADD PRIMARY KEY (`bt_id`);

--
-- Indexes for table `carandhousefundwallet`
--
ALTER TABLE `carandhousefundwallet`
  ADD PRIMARY KEY (`chfw_id`);

--
-- Indexes for table `flashbanner`
--
ALTER TABLE `flashbanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgetpassword`
--
ALTER TABLE `forgetpassword`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `galleryimages`
--
ALTER TABLE `galleryimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genealogy`
--
ALTER TABLE `genealogy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `idactivation`
--
ALTER TABLE `idactivation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `idactivationdeposite`
--
ALTER TABLE `idactivationdeposite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `idactivationhistory`
--
ALTER TABLE `idactivationhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `idactivationvalue`
--
ALTER TABLE `idactivationvalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latestnews`
--
ALTER TABLE `latestnews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leadershipincomewallet`
--
ALTER TABLE `leadershipincomewallet`
  ADD PRIMARY KEY (`liw_id`);

--
-- Indexes for table `monthlysavingpendinginvoice`
--
ALTER TABLE `monthlysavingpendinginvoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthlytpsavinghistory`
--
ALTER TABLE `monthlytpsavinghistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `networkingincomewallet`
--
ALTER TABLE `networkingincomewallet`
  ADD PRIMARY KEY (`niw_id`);

--
-- Indexes for table `royaltyincomewallet`
--
ALTER TABLE `royaltyincomewallet`
  ADD PRIMARY KEY (`riw_id`);

--
-- Indexes for table `savingsincome`
--
ALTER TABLE `savingsincome`
  ADD PRIMARY KEY (`si_id`);

--
-- Indexes for table `savingstravelpoints`
--
ALTER TABLE `savingstravelpoints`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `travelcouponpoints`
--
ALTER TABLE `travelcouponpoints`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indexes for table `uccvalue`
--
ALTER TABLE `uccvalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userbankdetails`
--
ALTER TABLE `userbankdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindetails`
--
ALTER TABLE `admindetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `availablewithdrwabalance`
--
ALTER TABLE `availablewithdrwabalance`
  MODIFY `awb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bonustravelpoints`
--
ALTER TABLE `bonustravelpoints`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `carandhousefundwallet`
--
ALTER TABLE `carandhousefundwallet`
  MODIFY `chfw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `flashbanner`
--
ALTER TABLE `flashbanner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forgetpassword`
--
ALTER TABLE `forgetpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `galleryimages`
--
ALTER TABLE `galleryimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `genealogy`
--
ALTER TABLE `genealogy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `idactivation`
--
ALTER TABLE `idactivation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `idactivationdeposite`
--
ALTER TABLE `idactivationdeposite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `idactivationhistory`
--
ALTER TABLE `idactivationhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `idactivationvalue`
--
ALTER TABLE `idactivationvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `latestnews`
--
ALTER TABLE `latestnews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leadershipincomewallet`
--
ALTER TABLE `leadershipincomewallet`
  MODIFY `liw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `monthlysavingpendinginvoice`
--
ALTER TABLE `monthlysavingpendinginvoice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `monthlytpsavinghistory`
--
ALTER TABLE `monthlytpsavinghistory`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `networkingincomewallet`
--
ALTER TABLE `networkingincomewallet`
  MODIFY `niw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `royaltyincomewallet`
--
ALTER TABLE `royaltyincomewallet`
  MODIFY `riw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `savingsincome`
--
ALTER TABLE `savingsincome`
  MODIFY `si_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `savingstravelpoints`
--
ALTER TABLE `savingstravelpoints`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `travelcouponpoints`
--
ALTER TABLE `travelcouponpoints`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `uccvalue`
--
ALTER TABLE `uccvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userbankdetails`
--
ALTER TABLE `userbankdetails`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
