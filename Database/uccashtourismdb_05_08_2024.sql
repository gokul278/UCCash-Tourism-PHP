-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2024 at 02:01 PM
-- Server version: 10.11.7-MariaDB
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uccashtourismdb`
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
  `admin_email` varchar(150) NOT NULL,
  `admin_profile` varchar(150) DEFAULT NULL,
  `admin_forgetpasshash` varchar(200) DEFAULT NULL,
  `admin_remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admindetails`
--

INSERT INTO `admindetails` (`id`, `admin_id`, `admin_name`, `admin_password`, `admin_email`, `admin_profile`, `admin_forgetpasshash`, `admin_remark`) VALUES
(1, 'UCT000000', 'Dr. P. Balakrishnnan', '9283a03246ef2dacdc21a9b137817ec1', 'admin@uccashtourism.com', '20240608075828_20240510022859_bill_image_413460_1629269700353.jpg', 'a24d0aa6792da81102f7969753bbda58', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `admingst_wallet`
--

CREATE TABLE `admingst_wallet` (
  `agst_id` int(11) NOT NULL,
  `agst_points` varchar(100) DEFAULT NULL,
  `agst_action` varchar(100) DEFAULT NULL,
  `agst_remark` varchar(200) DEFAULT NULL,
  `agst_createdat` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_wallet`
--

CREATE TABLE `admin_wallet` (
  `aw_id` int(11) NOT NULL,
  `aw_points` varchar(50) NOT NULL,
  `aw_action` varchar(50) NOT NULL,
  `aw_remark` varchar(100) NOT NULL,
  `aw_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `admin_wallet`
--

INSERT INTO `admin_wallet` (`aw_id`, `aw_points`, `aw_action`, `aw_remark`, `aw_createdat`) VALUES
(1, '2.50', 'credit', 'From UCT1003', '2024-06-02 15:33:27'),
(2, '100', 'debit', 'For Nagarcovil Team visiting expenses', '2024-06-15 07:12:34');

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
(1, 'UCT1003', 'Networking Income', 'Available Withdraw Balance', '10.00', 'credit', '2024-05-17 07:02:21'),
(2, 'UCT1003', 'Networking Income', 'Available Withdraw Balance', '45.00', 'credit', '2024-06-02 15:28:24'),
(3, 'UCT1003', 'Available Withdraw Balance', 'Withdrawed Amount', '50.00', 'debit', '2024-06-02 15:33:27'),
(4, 'UCT1003', 'Leadership Income', 'Available Withdraw Balance', '5.00', 'credit', '2024-06-21 17:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `bonustravelpoints`
--

CREATE TABLE `bonustravelpoints` (
  `bt_id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `bt_points` varchar(30) DEFAULT NULL,
  `bt_bonusfrom` varchar(100) DEFAULT NULL,
  `bt_lvl` varchar(20) DEFAULT NULL,
  `bt_action` varchar(30) DEFAULT NULL,
  `bt_remark` varchar(50) DEFAULT NULL,
  `bt_createdat` timestamp NULL DEFAULT current_timestamp()
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
(64, 'UCT99999', '0.83', 'UCT1010', '4', 'credit', 'Bonus Travel Points', '2024-05-21 02:34:06'),
(65, 'UCT1003', '0.83', 'UCT1030', '1', 'credit', 'Bonus Travel Points', '2024-05-29 09:35:48'),
(66, 'UCT1002', '0.83', 'UCT1030', '2', 'credit', 'Bonus Travel Points', '2024-05-29 09:35:48'),
(67, 'UCT1001', '0.83', 'UCT1030', '3', 'credit', 'Bonus Travel Points', '2024-05-29 09:35:48'),
(68, 'UCT99999', '0.83', 'UCT1030', '4', 'credit', 'Bonus Travel Points', '2024-05-29 09:35:48'),
(69, 'UCT1004', '0.83', 'UCT1035', '1', 'credit', 'Bonus Travel Points', '2024-06-03 11:29:48'),
(70, 'UCT1003', '0.83', 'UCT1035', '2', 'credit', 'Bonus Travel Points', '2024-06-03 11:29:48'),
(71, 'UCT1002', '0.83', 'UCT1035', '3', 'credit', 'Bonus Travel Points', '2024-06-03 11:29:48'),
(72, 'UCT1001', '0.83', 'UCT1035', '4', 'credit', 'Bonus Travel Points', '2024-06-03 11:29:48'),
(73, 'UCT99999', '0.83', 'UCT1035', '5', 'credit', 'Bonus Travel Points', '2024-06-03 11:29:48'),
(74, 'UCT1004', '0.83', 'UCT1036', '1', 'credit', 'Bonus Travel Points', '2024-06-04 08:24:36'),
(75, 'UCT1003', '0.83', 'UCT1036', '2', 'credit', 'Bonus Travel Points', '2024-06-04 08:24:36'),
(76, 'UCT1002', '0.83', 'UCT1036', '3', 'credit', 'Bonus Travel Points', '2024-06-04 08:24:36'),
(77, 'UCT1001', '0.83', 'UCT1036', '4', 'credit', 'Bonus Travel Points', '2024-06-04 08:24:36'),
(78, 'UCT99999', '0.83', 'UCT1036', '5', 'credit', 'Bonus Travel Points', '2024-06-04 08:24:36'),
(79, 'UCT1003', '0.83', 'UCT1018', '1', 'credit', 'Bonus Travel Points', '2024-06-05 03:48:14'),
(80, 'UCT1002', '0.83', 'UCT1018', '2', 'credit', 'Bonus Travel Points', '2024-06-05 03:48:14'),
(81, 'UCT1001', '0.83', 'UCT1018', '3', 'credit', 'Bonus Travel Points', '2024-06-05 03:48:14'),
(82, 'UCT99999', '0.83', 'UCT1018', '4', 'credit', 'Bonus Travel Points', '2024-06-05 03:48:14'),
(83, 'UCT1003', '0.83', 'UCT1033', '1', 'credit', 'Bonus Travel Points', '2024-06-05 03:54:09'),
(84, 'UCT1002', '0.83', 'UCT1033', '2', 'credit', 'Bonus Travel Points', '2024-06-05 03:54:09'),
(85, 'UCT1001', '0.83', 'UCT1033', '3', 'credit', 'Bonus Travel Points', '2024-06-05 03:54:09'),
(86, 'UCT99999', '0.83', 'UCT1033', '4', 'credit', 'Bonus Travel Points', '2024-06-05 03:54:09'),
(87, 'UCT1028', '0.83', 'UCT1039', '1', 'credit', 'Bonus Travel Points', '2024-06-08 04:14:50'),
(88, 'UCT1024', '0.83', 'UCT1039', '2', 'credit', 'Bonus Travel Points', '2024-06-08 04:14:50'),
(89, 'UCT1009', '0.83', 'UCT1039', '3', 'credit', 'Bonus Travel Points', '2024-06-08 04:14:50'),
(90, 'UCT1003', '0.83', 'UCT1039', '4', 'credit', 'Bonus Travel Points', '2024-06-08 04:14:50'),
(91, 'UCT1002', '0.83', 'UCT1039', '5', 'credit', 'Bonus Travel Points', '2024-06-08 04:14:50'),
(92, 'UCT1001', '0.83', 'UCT1039', '6', 'credit', 'Bonus Travel Points', '2024-06-08 04:14:50'),
(93, 'UCT99999', '0.83', 'UCT1039', '7', 'credit', 'Bonus Travel Points', '2024-06-08 04:14:50'),
(94, 'UCT1039', '0.83', 'UCT1040', '1', 'credit', 'Bonus Travel Points', '2024-06-08 08:50:33'),
(95, 'UCT1028', '0.83', 'UCT1040', '2', 'credit', 'Bonus Travel Points', '2024-06-08 08:50:33'),
(96, 'UCT1024', '0.83', 'UCT1040', '3', 'credit', 'Bonus Travel Points', '2024-06-08 08:50:33'),
(97, 'UCT1009', '0.83', 'UCT1040', '4', 'credit', 'Bonus Travel Points', '2024-06-08 08:50:33'),
(98, 'UCT1003', '0.83', 'UCT1040', '5', 'credit', 'Bonus Travel Points', '2024-06-08 08:50:33'),
(99, 'UCT1002', '0.83', 'UCT1040', '6', 'credit', 'Bonus Travel Points', '2024-06-08 08:50:33'),
(100, 'UCT1001', '0.83', 'UCT1040', '7', 'credit', 'Bonus Travel Points', '2024-06-08 08:50:33'),
(101, 'UCT99999', '0.83', 'UCT1040', '8', 'credit', 'Bonus Travel Points', '2024-06-08 08:50:33'),
(102, 'UCT1003', '0.83', 'UCT1041', '1', 'credit', 'Bonus Travel Points', '2024-06-12 10:03:22'),
(103, 'UCT1002', '0.83', 'UCT1041', '2', 'credit', 'Bonus Travel Points', '2024-06-12 10:03:22'),
(104, 'UCT1001', '0.83', 'UCT1041', '3', 'credit', 'Bonus Travel Points', '2024-06-12 10:03:22'),
(105, 'UCT99999', '0.83', 'UCT1041', '4', 'credit', 'Bonus Travel Points', '2024-06-12 10:03:22'),
(106, 'UCT1003', '0.83', 'UCT1042', '1', 'credit', 'Bonus Travel Points', '2024-06-12 12:27:46'),
(107, 'UCT1002', '0.83', 'UCT1042', '2', 'credit', 'Bonus Travel Points', '2024-06-12 12:27:46'),
(108, 'UCT1001', '0.83', 'UCT1042', '3', 'credit', 'Bonus Travel Points', '2024-06-12 12:27:46'),
(109, 'UCT99999', '0.83', 'UCT1042', '4', 'credit', 'Bonus Travel Points', '2024-06-12 12:27:46'),
(110, 'UCT1009', '0.83', 'UCT1044', '1', 'credit', 'Bonus Travel Points', '2024-06-15 13:31:25'),
(111, 'UCT1003', '0.83', 'UCT1044', '2', 'credit', 'Bonus Travel Points', '2024-06-15 13:31:25'),
(112, 'UCT1002', '0.83', 'UCT1044', '3', 'credit', 'Bonus Travel Points', '2024-06-15 13:31:25'),
(113, 'UCT1001', '0.83', 'UCT1044', '4', 'credit', 'Bonus Travel Points', '2024-06-15 13:31:25'),
(114, 'UCT99999', '0.83', 'UCT1044', '5', 'credit', 'Bonus Travel Points', '2024-06-15 13:31:25'),
(115, 'UCT1008', '0.83', 'UCT1045', '1', 'credit', 'Bonus Travel Points', '2024-06-19 08:08:56'),
(116, 'UCT1003', '0.83', 'UCT1045', '2', 'credit', 'Bonus Travel Points', '2024-06-19 08:08:56'),
(117, 'UCT1002', '0.83', 'UCT1045', '3', 'credit', 'Bonus Travel Points', '2024-06-19 08:08:56'),
(118, 'UCT1001', '0.83', 'UCT1045', '4', 'credit', 'Bonus Travel Points', '2024-06-19 08:08:56'),
(119, 'UCT99999', '0.83', 'UCT1045', '5', 'credit', 'Bonus Travel Points', '2024-06-19 08:08:56'),
(120, 'UCT1003', '0.83', 'UCT1048', '1', 'credit', 'Bonus Travel Points', '2024-06-20 10:10:57'),
(121, 'UCT1002', '0.83', 'UCT1048', '2', 'credit', 'Bonus Travel Points', '2024-06-20 10:10:57'),
(122, 'UCT1001', '0.83', 'UCT1048', '3', 'credit', 'Bonus Travel Points', '2024-06-20 10:10:57'),
(123, 'UCT99999', '0.83', 'UCT1048', '4', 'credit', 'Bonus Travel Points', '2024-06-20 10:10:57'),
(124, 'UCT1003', '0.83', 'UCT1051', '1', 'credit', 'Bonus Travel Points', '2024-07-03 12:53:30'),
(125, 'UCT1002', '0.83', 'UCT1051', '2', 'credit', 'Bonus Travel Points', '2024-07-03 12:53:30'),
(126, 'UCT1001', '0.83', 'UCT1051', '3', 'credit', 'Bonus Travel Points', '2024-07-03 12:53:30'),
(127, 'UCT99999', '0.83', 'UCT1051', '4', 'credit', 'Bonus Travel Points', '2024-07-03 12:53:30'),
(128, 'UCT1051', '0.83', 'UCT1052', '1', 'credit', 'Bonus Travel Points', '2024-07-04 05:44:45'),
(129, 'UCT1003', '0.83', 'UCT1052', '2', 'credit', 'Bonus Travel Points', '2024-07-04 05:44:45'),
(130, 'UCT1002', '0.83', 'UCT1052', '3', 'credit', 'Bonus Travel Points', '2024-07-04 05:44:45'),
(131, 'UCT1001', '0.83', 'UCT1052', '4', 'credit', 'Bonus Travel Points', '2024-07-04 05:44:45'),
(132, 'UCT99999', '0.83', 'UCT1052', '5', 'credit', 'Bonus Travel Points', '2024-07-04 05:44:45');

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
(64, 'UCT99999', '0.275', 'UCT1010', '4', 'credit', 'Car & House Fund', '2024-05-21 02:34:06'),
(65, 'UCT1003', '0.275', 'UCT1030', '1', 'credit', 'Car & House Fund', '2024-05-29 09:35:48'),
(66, 'UCT1002', '0.275', 'UCT1030', '2', 'credit', 'Car & House Fund', '2024-05-29 09:35:48'),
(67, 'UCT1001', '0.275', 'UCT1030', '3', 'credit', 'Car & House Fund', '2024-05-29 09:35:48'),
(68, 'UCT99999', '0.275', 'UCT1030', '4', 'credit', 'Car & House Fund', '2024-05-29 09:35:48'),
(69, 'UCT1004', '0.275', 'UCT1035', '1', 'credit', 'Car & House Fund', '2024-06-03 11:29:48'),
(70, 'UCT1003', '0.275', 'UCT1035', '2', 'credit', 'Car & House Fund', '2024-06-03 11:29:48'),
(71, 'UCT1002', '0.275', 'UCT1035', '3', 'credit', 'Car & House Fund', '2024-06-03 11:29:48'),
(72, 'UCT1001', '0.275', 'UCT1035', '4', 'credit', 'Car & House Fund', '2024-06-03 11:29:48'),
(73, 'UCT99999', '0.275', 'UCT1035', '5', 'credit', 'Car & House Fund', '2024-06-03 11:29:48'),
(74, 'UCT1004', '0.275', 'UCT1036', '1', 'credit', 'Car & House Fund', '2024-06-04 08:24:36'),
(75, 'UCT1003', '0.275', 'UCT1036', '2', 'credit', 'Car & House Fund', '2024-06-04 08:24:36'),
(76, 'UCT1002', '0.275', 'UCT1036', '3', 'credit', 'Car & House Fund', '2024-06-04 08:24:36'),
(77, 'UCT1001', '0.275', 'UCT1036', '4', 'credit', 'Car & House Fund', '2024-06-04 08:24:36'),
(78, 'UCT99999', '0.275', 'UCT1036', '5', 'credit', 'Car & House Fund', '2024-06-04 08:24:36'),
(79, 'UCT1003', '0.275', 'UCT1018', '1', 'credit', 'Car & House Fund', '2024-06-05 03:48:14'),
(80, 'UCT1002', '0.275', 'UCT1018', '2', 'credit', 'Car & House Fund', '2024-06-05 03:48:14'),
(81, 'UCT1001', '0.275', 'UCT1018', '3', 'credit', 'Car & House Fund', '2024-06-05 03:48:14'),
(82, 'UCT99999', '0.275', 'UCT1018', '4', 'credit', 'Car & House Fund', '2024-06-05 03:48:14'),
(83, 'UCT1003', '0.275', 'UCT1033', '1', 'credit', 'Car & House Fund', '2024-06-05 03:54:09'),
(84, 'UCT1002', '0.275', 'UCT1033', '2', 'credit', 'Car & House Fund', '2024-06-05 03:54:09'),
(85, 'UCT1001', '0.275', 'UCT1033', '3', 'credit', 'Car & House Fund', '2024-06-05 03:54:09'),
(86, 'UCT99999', '0.275', 'UCT1033', '4', 'credit', 'Car & House Fund', '2024-06-05 03:54:09'),
(87, 'UCT1028', '0.275', 'UCT1039', '1', 'credit', 'Car & House Fund', '2024-06-08 04:14:50'),
(88, 'UCT1024', '0.275', 'UCT1039', '2', 'credit', 'Car & House Fund', '2024-06-08 04:14:50'),
(89, 'UCT1009', '0.275', 'UCT1039', '3', 'credit', 'Car & House Fund', '2024-06-08 04:14:50'),
(90, 'UCT1003', '0.275', 'UCT1039', '4', 'credit', 'Car & House Fund', '2024-06-08 04:14:50'),
(91, 'UCT1002', '0.275', 'UCT1039', '5', 'credit', 'Car & House Fund', '2024-06-08 04:14:50'),
(92, 'UCT1001', '0.275', 'UCT1039', '6', 'credit', 'Car & House Fund', '2024-06-08 04:14:50'),
(93, 'UCT99999', '0.275', 'UCT1039', '7', 'credit', 'Car & House Fund', '2024-06-08 04:14:50'),
(94, 'UCT1039', '0.275', 'UCT1040', '1', 'credit', 'Car & House Fund', '2024-06-08 08:50:33'),
(95, 'UCT1028', '0.275', 'UCT1040', '2', 'credit', 'Car & House Fund', '2024-06-08 08:50:33'),
(96, 'UCT1024', '0.275', 'UCT1040', '3', 'credit', 'Car & House Fund', '2024-06-08 08:50:33'),
(97, 'UCT1009', '0.275', 'UCT1040', '4', 'credit', 'Car & House Fund', '2024-06-08 08:50:33'),
(98, 'UCT1003', '0.275', 'UCT1040', '5', 'credit', 'Car & House Fund', '2024-06-08 08:50:33'),
(99, 'UCT1002', '0.275', 'UCT1040', '6', 'credit', 'Car & House Fund', '2024-06-08 08:50:33'),
(100, 'UCT1001', '0.275', 'UCT1040', '7', 'credit', 'Car & House Fund', '2024-06-08 08:50:33'),
(101, 'UCT99999', '0.275', 'UCT1040', '8', 'credit', 'Car & House Fund', '2024-06-08 08:50:33'),
(102, 'UCT1003', '0.275', 'UCT1041', '1', 'credit', 'Car & House Fund', '2024-06-12 10:03:22'),
(103, 'UCT1002', '0.275', 'UCT1041', '2', 'credit', 'Car & House Fund', '2024-06-12 10:03:22'),
(104, 'UCT1001', '0.275', 'UCT1041', '3', 'credit', 'Car & House Fund', '2024-06-12 10:03:22'),
(105, 'UCT99999', '0.275', 'UCT1041', '4', 'credit', 'Car & House Fund', '2024-06-12 10:03:22'),
(106, 'UCT1003', '0.275', 'UCT1042', '1', 'credit', 'Car & House Fund', '2024-06-12 12:27:46'),
(107, 'UCT1002', '0.275', 'UCT1042', '2', 'credit', 'Car & House Fund', '2024-06-12 12:27:46'),
(108, 'UCT1001', '0.275', 'UCT1042', '3', 'credit', 'Car & House Fund', '2024-06-12 12:27:46'),
(109, 'UCT99999', '0.275', 'UCT1042', '4', 'credit', 'Car & House Fund', '2024-06-12 12:27:46'),
(110, 'UCT1009', '0.275', 'UCT1044', '1', 'credit', 'Car & House Fund', '2024-06-15 13:31:25'),
(111, 'UCT1003', '0.275', 'UCT1044', '2', 'credit', 'Car & House Fund', '2024-06-15 13:31:25'),
(112, 'UCT1002', '0.275', 'UCT1044', '3', 'credit', 'Car & House Fund', '2024-06-15 13:31:25'),
(113, 'UCT1001', '0.275', 'UCT1044', '4', 'credit', 'Car & House Fund', '2024-06-15 13:31:25'),
(114, 'UCT99999', '0.275', 'UCT1044', '5', 'credit', 'Car & House Fund', '2024-06-15 13:31:25'),
(115, 'UCT1008', '0.275', 'UCT1045', '1', 'credit', 'Car & House Fund', '2024-06-19 08:08:56'),
(116, 'UCT1003', '0.275', 'UCT1045', '2', 'credit', 'Car & House Fund', '2024-06-19 08:08:56'),
(117, 'UCT1002', '0.275', 'UCT1045', '3', 'credit', 'Car & House Fund', '2024-06-19 08:08:56'),
(118, 'UCT1001', '0.275', 'UCT1045', '4', 'credit', 'Car & House Fund', '2024-06-19 08:08:56'),
(119, 'UCT99999', '0.275', 'UCT1045', '5', 'credit', 'Car & House Fund', '2024-06-19 08:08:56'),
(120, 'UCT1003', '0.275', 'UCT1048', '1', 'credit', 'Car & House Fund', '2024-06-20 10:10:57'),
(121, 'UCT1002', '0.275', 'UCT1048', '2', 'credit', 'Car & House Fund', '2024-06-20 10:10:57'),
(122, 'UCT1001', '0.275', 'UCT1048', '3', 'credit', 'Car & House Fund', '2024-06-20 10:10:57'),
(123, 'UCT99999', '0.275', 'UCT1048', '4', 'credit', 'Car & House Fund', '2024-06-20 10:10:57'),
(124, 'UCT1003', '0.275', 'UCT1051', '1', 'credit', 'Car & House Fund', '2024-07-03 12:53:30'),
(125, 'UCT1002', '0.275', 'UCT1051', '2', 'credit', 'Car & House Fund', '2024-07-03 12:53:30'),
(126, 'UCT1001', '0.275', 'UCT1051', '3', 'credit', 'Car & House Fund', '2024-07-03 12:53:30'),
(127, 'UCT99999', '0.275', 'UCT1051', '4', 'credit', 'Car & House Fund', '2024-07-03 12:53:30'),
(128, 'UCT1051', '0.275', 'UCT1052', '1', 'credit', 'Car & House Fund', '2024-07-04 05:44:45'),
(129, 'UCT1003', '0.275', 'UCT1052', '2', 'credit', 'Car & House Fund', '2024-07-04 05:44:45'),
(130, 'UCT1002', '0.275', 'UCT1052', '3', 'credit', 'Car & House Fund', '2024-07-04 05:44:45'),
(131, 'UCT1001', '0.275', 'UCT1052', '4', 'credit', 'Car & House Fund', '2024-07-04 05:44:45'),
(132, 'UCT99999', '0.275', 'UCT1052', '5', 'credit', 'Car & House Fund', '2024-07-04 05:44:45');

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
(1, '20240608043237_1000216593.png');

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
(2, 'UCT1013', '446789cead0efafe626dfd0730ea61a6', 'pending', '2024-05-17 11:54:44', '2024-05-17 11:54:44'),
(3, 'UCT1003', '6c101ab734b87b7ecdf1b77472ec276a', 'pending', '2024-06-20 09:57:00', '2024-06-20 12:16:35'),
(4, 'UCT1004', '6434889c7ad85c45f26555cb32ec9efe', 'pending', '2024-06-21 07:19:21', '2024-06-22 05:05:47');

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
(22, '20240512094414_IMG-20240512-WA0026.jpg'),
(23, '20240512100816_IMG-20240512-WA0028.jpg'),
(24, '20240512100825_IMG-20240512-WA0029.jpg'),
(28, '20240512100922_IMG-20240512-WA0033.jpg'),
(30, '20240512100938_IMG-20240512-WA0035.jpg');

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
(29, 'UCT1029', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(30, 'UCT1030', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(31, 'UCT1031', 'UCT1016', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(32, 'UCT1032', 'UCT1024', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(33, 'UCT1033', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(34, 'UCT1034', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(35, 'UCT1035', 'UCT1004', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(36, 'UCT1036', 'UCT1004', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(37, 'UCT1037', 'UCT1024', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(38, 'UCT1038', 'UCT1024', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(39, 'UCT1039', 'UCT1028', 'UCT1024', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', ''),
(40, 'UCT1040', 'UCT1039', 'UCT1028', 'UCT1024', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', ''),
(41, 'UCT1041', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(42, 'UCT1042', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(43, 'UCT1043', 'UCT1013', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(44, 'UCT1044', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(45, 'UCT1045', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(46, 'UCT1046', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(47, 'UCT1047', 'UCT1016', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(48, 'UCT1048', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(49, 'UCT1049', 'UCT1044', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', ''),
(50, 'UCT1050', 'UCT1040', 'UCT1039', 'UCT1028', 'UCT1024', 'UCT1009', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999'),
(51, 'UCT1051', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', ''),
(52, 'UCT1052', 'UCT1051', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(53, 'UCT1053', 'UCT1008', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', ''),
(54, 'UCT1054', 'UCT1003', 'UCT1002', 'UCT1001', 'UCT99999', '', '', '', '', '');

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
(16, 'IAI-16', 'UCT1010', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-21 02:32:45'),
(17, 'IAI-17', 'UCT1030', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-05-29 09:34:55'),
(18, 'IAI-18', 'UCT1035', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-06-03 11:28:47'),
(19, 'IAI-19', 'UCT1036', 'Bank', NULL, '415613758443', '20240604081624_IMG-20240604-WA0042.jpg', 'paid', '', '2024-06-04 08:16:24'),
(20, 'IAI-20', 'UCT1018', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-06-05 03:47:40'),
(21, 'IAI-21', 'UCT1033', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-06-05 03:52:35'),
(22, 'IAI-22', 'UCT1039', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-06-08 00:31:44'),
(23, 'IAI-23', 'UCT1040', 'Crypto', 'Guna@1979', NULL, NULL, 'paid', '', '2024-06-08 07:26:52'),
(24, 'IAI-24', 'UCT1041', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-06-12 10:00:05'),
(25, 'IAI-25', 'UCT1042', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-06-12 12:25:20'),
(26, 'IAI-26', 'UCT1044', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-06-15 13:23:44'),
(27, 'IAI-27', 'UCT1045', 'Bank', NULL, '453772615826', '20240619080553_Screenshot_2024-06-19-13-35-00-48_4336b74596784d9a2aa81f87c2016f50.jpg', 'paid', '', '2024-06-19 08:05:53'),
(28, 'IAI-28', 'UCT1048', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-06-20 10:10:57'),
(29, 'IAI-29', 'UCT1051', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-07-03 11:08:19'),
(30, 'IAI-30', 'UCT1052', 'Crypto', '369369', NULL, NULL, 'paid', '', '2024-07-03 15:02:34');

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
(16, 'IAI-16', 'UCT1010', '2024-05-21 02:32:45', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-21 02:32:45'),
(17, 'IAI-17', 'UCT1030', '2024-05-29 09:34:55', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-05-29 09:34:55'),
(18, 'IAI-18', 'UCT1035', '2024-06-03 11:28:47', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-03 11:28:47'),
(19, 'IAI-19', 'UCT1036', '2024-06-04 08:16:24', 'Bank', NULL, NULL, '415613758443', '20240604081624_IMG-20240604-WA0042.jpg', 'Rs 5310', '50', 'paid', 'Activation Successful', '2024-06-04 08:16:24'),
(20, 'IAI-20', 'UCT1018', '2024-06-05 03:47:40', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-05 03:47:40'),
(21, 'IAI-21', 'UCT1033', '2024-06-05 03:52:35', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-05 03:52:35'),
(22, 'IAI-22', 'UCT1039', '2024-06-08 00:31:44', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-08 00:31:44'),
(23, 'IAI-23', 'UCT1040', '2024-06-08 07:26:52', 'Crypto', '$ 59', 'Guna@1979', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-08 07:26:52'),
(24, 'IAI-24', 'UCT1041', '2024-06-12 10:00:05', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-12 10:00:05'),
(25, 'IAI-25', 'UCT1042', '2024-06-12 12:25:20', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-12 12:25:20'),
(26, 'IAI-26', 'UCT1044', '2024-06-15 13:23:44', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-15 13:23:44'),
(27, 'IAI-27', 'UCT1045', '2024-06-19 08:05:53', 'Bank', NULL, NULL, '453772615826', '20240619080553_Screenshot_2024-06-19-13-35-00-48_4336b74596784d9a2aa81f87c2016f50.jpg', 'Rs 5310', '50', 'paid', 'Activation Successful', '2024-06-19 08:05:53'),
(28, 'IAI-28', 'UCT1048', '2024-06-20 10:10:57', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-06-20 10:10:57'),
(29, 'IAI-29', 'UCT1051', '2024-07-03 11:08:19', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-07-03 11:08:19'),
(30, 'IAI-30', 'UCT1052', '2024-07-03 15:02:34', 'Crypto', '$ 59', '369369', NULL, NULL, NULL, '50', 'paid', 'Activation Successful', '2024-07-03 15:02:34');

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
-- Table structure for table `invoiceprocess`
--

CREATE TABLE `invoiceprocess` (
  `id` int(11) NOT NULL,
  `invoiceprocessing_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `invoiceprocess`
--

INSERT INTO `invoiceprocess` (`id`, `invoiceprocessing_status`) VALUES
(1, NULL);

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
(64, 'UCT99999', '0.22', 'UCT1010', '4', 'credit', 'Leadership Income', '2024-05-21 02:34:06'),
(65, 'UCT1003', '0.22', 'UCT1030', '1', 'credit', 'Leadership Income', '2024-05-29 09:35:48'),
(66, 'UCT1002', '0.22', 'UCT1030', '2', 'credit', 'Leadership Income', '2024-05-29 09:35:48'),
(67, 'UCT1001', '0.22', 'UCT1030', '3', 'credit', 'Leadership Income', '2024-05-29 09:35:48'),
(68, 'UCT99999', '0.22', 'UCT1030', '4', 'credit', 'Leadership Income', '2024-05-29 09:35:48'),
(69, 'UCT1004', '0.22', 'UCT1035', '1', 'credit', 'Leadership Income', '2024-06-03 11:29:48'),
(70, 'UCT1003', '0.22', 'UCT1035', '2', 'credit', 'Leadership Income', '2024-06-03 11:29:48'),
(71, 'UCT1002', '0.22', 'UCT1035', '3', 'credit', 'Leadership Income', '2024-06-03 11:29:48'),
(72, 'UCT1001', '0.22', 'UCT1035', '4', 'credit', 'Leadership Income', '2024-06-03 11:29:48'),
(73, 'UCT99999', '0.22', 'UCT1035', '5', 'credit', 'Leadership Income', '2024-06-03 11:29:48'),
(74, 'UCT1004', '0.22', 'UCT1036', '1', 'credit', 'Leadership Income', '2024-06-04 08:24:36'),
(75, 'UCT1003', '0.22', 'UCT1036', '2', 'credit', 'Leadership Income', '2024-06-04 08:24:36'),
(76, 'UCT1002', '0.22', 'UCT1036', '3', 'credit', 'Leadership Income', '2024-06-04 08:24:36'),
(77, 'UCT1001', '0.22', 'UCT1036', '4', 'credit', 'Leadership Income', '2024-06-04 08:24:36'),
(78, 'UCT99999', '0.22', 'UCT1036', '5', 'credit', 'Leadership Income', '2024-06-04 08:24:36'),
(79, 'UCT1003', '0.22', 'UCT1018', '1', 'credit', 'Leadership Income', '2024-06-05 03:48:14'),
(80, 'UCT1002', '0.22', 'UCT1018', '2', 'credit', 'Leadership Income', '2024-06-05 03:48:14'),
(81, 'UCT1001', '0.22', 'UCT1018', '3', 'credit', 'Leadership Income', '2024-06-05 03:48:14'),
(82, 'UCT99999', '0.22', 'UCT1018', '4', 'credit', 'Leadership Income', '2024-06-05 03:48:14'),
(83, 'UCT1003', '0.22', 'UCT1033', '1', 'credit', 'Leadership Income', '2024-06-05 03:54:09'),
(84, 'UCT1002', '0.22', 'UCT1033', '2', 'credit', 'Leadership Income', '2024-06-05 03:54:09'),
(85, 'UCT1001', '0.22', 'UCT1033', '3', 'credit', 'Leadership Income', '2024-06-05 03:54:09'),
(86, 'UCT99999', '0.22', 'UCT1033', '4', 'credit', 'Leadership Income', '2024-06-05 03:54:09'),
(87, 'UCT1028', '0.22', 'UCT1039', '1', 'credit', 'Leadership Income', '2024-06-08 04:14:50'),
(88, 'UCT1024', '0.22', 'UCT1039', '2', 'credit', 'Leadership Income', '2024-06-08 04:14:50'),
(89, 'UCT1009', '0.22', 'UCT1039', '3', 'credit', 'Leadership Income', '2024-06-08 04:14:50'),
(90, 'UCT1003', '0.22', 'UCT1039', '4', 'credit', 'Leadership Income', '2024-06-08 04:14:50'),
(91, 'UCT1002', '0.22', 'UCT1039', '5', 'credit', 'Leadership Income', '2024-06-08 04:14:50'),
(92, 'UCT1001', '0.22', 'UCT1039', '6', 'credit', 'Leadership Income', '2024-06-08 04:14:50'),
(93, 'UCT99999', '0.22', 'UCT1039', '7', 'credit', 'Leadership Income', '2024-06-08 04:14:50'),
(94, 'UCT1039', '0.22', 'UCT1040', '1', 'credit', 'Leadership Income', '2024-06-08 08:50:33'),
(95, 'UCT1028', '0.22', 'UCT1040', '2', 'credit', 'Leadership Income', '2024-06-08 08:50:33'),
(96, 'UCT1024', '0.22', 'UCT1040', '3', 'credit', 'Leadership Income', '2024-06-08 08:50:33'),
(97, 'UCT1009', '0.22', 'UCT1040', '4', 'credit', 'Leadership Income', '2024-06-08 08:50:33'),
(98, 'UCT1003', '0.22', 'UCT1040', '5', 'credit', 'Leadership Income', '2024-06-08 08:50:33'),
(99, 'UCT1002', '0.22', 'UCT1040', '6', 'credit', 'Leadership Income', '2024-06-08 08:50:33'),
(100, 'UCT1001', '0.22', 'UCT1040', '7', 'credit', 'Leadership Income', '2024-06-08 08:50:33'),
(101, 'UCT99999', '0.22', 'UCT1040', '8', 'credit', 'Leadership Income', '2024-06-08 08:50:33'),
(102, 'UCT1003', '0.22', 'UCT1041', '1', 'credit', 'Leadership Income', '2024-06-12 10:03:22'),
(103, 'UCT1002', '0.22', 'UCT1041', '2', 'credit', 'Leadership Income', '2024-06-12 10:03:22'),
(104, 'UCT1001', '0.22', 'UCT1041', '3', 'credit', 'Leadership Income', '2024-06-12 10:03:22'),
(105, 'UCT99999', '0.22', 'UCT1041', '4', 'credit', 'Leadership Income', '2024-06-12 10:03:22'),
(106, 'UCT1003', '0.22', 'UCT1042', '1', 'credit', 'Leadership Income', '2024-06-12 12:27:46'),
(107, 'UCT1002', '0.22', 'UCT1042', '2', 'credit', 'Leadership Income', '2024-06-12 12:27:46'),
(108, 'UCT1001', '0.22', 'UCT1042', '3', 'credit', 'Leadership Income', '2024-06-12 12:27:46'),
(109, 'UCT99999', '0.22', 'UCT1042', '4', 'credit', 'Leadership Income', '2024-06-12 12:27:46'),
(110, 'UCT1009', '0.22', 'UCT1044', '1', 'credit', 'Leadership Income', '2024-06-15 13:31:25'),
(111, 'UCT1003', '0.22', 'UCT1044', '2', 'credit', 'Leadership Income', '2024-06-15 13:31:25'),
(112, 'UCT1002', '0.22', 'UCT1044', '3', 'credit', 'Leadership Income', '2024-06-15 13:31:25'),
(113, 'UCT1001', '0.22', 'UCT1044', '4', 'credit', 'Leadership Income', '2024-06-15 13:31:25'),
(114, 'UCT99999', '0.22', 'UCT1044', '5', 'credit', 'Leadership Income', '2024-06-15 13:31:25'),
(115, 'UCT1008', '0.22', 'UCT1045', '1', 'credit', 'Leadership Income', '2024-06-19 08:08:56'),
(116, 'UCT1003', '0.22', 'UCT1045', '2', 'credit', 'Leadership Income', '2024-06-19 08:08:56'),
(117, 'UCT1002', '0.22', 'UCT1045', '3', 'credit', 'Leadership Income', '2024-06-19 08:08:56'),
(118, 'UCT1001', '0.22', 'UCT1045', '4', 'credit', 'Leadership Income', '2024-06-19 08:08:56'),
(119, 'UCT99999', '0.22', 'UCT1045', '5', 'credit', 'Leadership Income', '2024-06-19 08:08:56'),
(120, 'UCT1003', '0.22', 'UCT1048', '1', 'credit', 'Leadership Income', '2024-06-20 10:10:57'),
(121, 'UCT1002', '0.22', 'UCT1048', '2', 'credit', 'Leadership Income', '2024-06-20 10:10:57'),
(122, 'UCT1001', '0.22', 'UCT1048', '3', 'credit', 'Leadership Income', '2024-06-20 10:10:57'),
(123, 'UCT99999', '0.22', 'UCT1048', '4', 'credit', 'Leadership Income', '2024-06-20 10:10:57'),
(124, 'UCT1003', '5.00', '', '', 'debit', 'Available Withdraw Balance', '2024-06-21 17:10:57'),
(125, 'UCT1003', '0.22', 'UCT1051', '1', 'credit', 'Leadership Income', '2024-07-03 12:53:30'),
(126, 'UCT1002', '0.22', 'UCT1051', '2', 'credit', 'Leadership Income', '2024-07-03 12:53:30'),
(127, 'UCT1001', '0.22', 'UCT1051', '3', 'credit', 'Leadership Income', '2024-07-03 12:53:30'),
(128, 'UCT99999', '0.22', 'UCT1051', '4', 'credit', 'Leadership Income', '2024-07-03 12:53:30'),
(129, 'UCT1051', '0.22', 'UCT1052', '1', 'credit', 'Leadership Income', '2024-07-04 05:44:45'),
(130, 'UCT1003', '0.22', 'UCT1052', '2', 'credit', 'Leadership Income', '2024-07-04 05:44:45'),
(131, 'UCT1002', '0.22', 'UCT1052', '3', 'credit', 'Leadership Income', '2024-07-04 05:44:45'),
(132, 'UCT1001', '0.22', 'UCT1052', '4', 'credit', 'Leadership Income', '2024-07-04 05:44:45'),
(133, 'UCT99999', '0.22', 'UCT1052', '5', 'credit', 'Leadership Income', '2024-07-04 05:44:45');

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
(17, 'MSI-17', 'UCT1017', '50$', '5', '55', 'paid', '', '2024-05-17 08:57:16'),
(18, 'MSI-18', 'UCT1018', '50$', '5', '55', 'pending', '', '2024-05-17 10:43:05'),
(19, 'MSI-19', 'UCT1019', '50$', '5', '55', 'paid', '', '2024-05-17 11:16:16'),
(20, 'MSI-20', 'UCT1020', '50$', '5', '55', 'pending', '', '2024-05-17 11:22:34'),
(21, 'MSI-21', 'UCT1021', '50$', '5', '55', 'paid', '', '2024-05-17 11:46:21'),
(22, 'MSI-22', 'UCT1022', '50$', '5', '55', 'paid', '', '2024-05-17 11:50:37'),
(23, 'MSI-23', 'UCT1023', '50$', '5', '55', 'paid', '', '2024-05-17 11:59:35'),
(24, 'MSI-24', 'UCT1024', '50$', '5', '55', 'pending', '', '2024-05-17 13:02:26'),
(25, 'MSI-25', 'UCT1025', '50$', '5', '55', 'pending', '', '2024-05-17 13:58:56'),
(26, 'MSI-26', 'UCT1026', '50$', '5', '55', 'pending', '', '2024-05-17 16:50:03'),
(27, 'MSI-27', 'UCT1027', '50$', '5', '55', 'pending', '', '2024-05-18 10:36:23'),
(28, 'MSI-28', 'UCT1028', '50$', '5', '55', 'pending', '', '2024-05-20 12:31:45'),
(29, 'MSI-29', 'UCT1029', '50$', '5', '55', 'pending', '', '2024-05-20 14:23:05'),
(30, 'MSI-30', 'UCT1030', '50$', '5', '55', 'pending', '', '2024-05-29 09:22:22'),
(31, 'MSI-31', 'UCT1031', '50$', '5', '55', 'pending', '', '2024-05-29 09:50:06'),
(32, 'MSI-32', 'UCT1032', '50$', '5', '55', 'pending', '', '2024-05-29 13:52:08'),
(33, 'MSI-33', 'UCT1033', '50$', '5', '55', 'pending', '', '2024-05-31 10:06:16'),
(34, 'MSI-34', 'UCT1034', '50$', '5', '55', 'pending', '', '2024-06-02 07:09:21'),
(35, 'MSI-35', 'UCT1035', '50$', '5', '55', 'pending', '', '2024-06-03 07:33:03'),
(36, 'MSI-36', 'UCT1036', '50$', '5', '55', 'pending', '', '2024-06-04 08:09:07'),
(37, 'MSI-37', 'UCT1037', '50$', '5', '55', 'pending', '', '2024-06-05 08:16:15'),
(38, 'MSI-38', 'UCT1038', '50$', '5', '55', 'pending', '', '2024-06-05 11:00:53'),
(39, 'MSI-39', 'UCT1039', '50$', '5', '55', 'pending', '', '2024-06-06 08:33:03'),
(64, 'MSI-40', 'UCT1001', '50$', '5', '55', 'pending', NULL, '2024-06-06 04:44:00'),
(65, 'MSI-65', 'UCT1002', '50$', '5', '55', 'paid', '', '2024-06-06 04:44:04'),
(66, 'MSI-66', 'UCT1003', '50$', '5', '55', 'paid', '', '2024-06-06 04:44:07'),
(67, 'MSI-67', 'UCT1004', '50$', '5', '55', 'pending', NULL, '2024-06-06 04:44:11'),
(68, 'MSI-68', 'UCT1005', '50$', '5', '55', 'pending', NULL, '2024-06-07 04:44:16'),
(69, 'MSI-69', 'UCT1006', '50$', '5', '55', 'pending', NULL, '2024-06-07 04:44:19'),
(70, 'MSI-70', 'UCT1007', '50$', '5', '55', 'pending', NULL, '2024-06-07 04:44:22'),
(71, 'MSI-71', 'UCT1008', '50$', '5', '55', 'pending', NULL, '2024-06-07 04:44:26'),
(72, 'MSI-72', 'UCT1009', '50$', '5', '55', 'pending', NULL, '2024-06-08 04:44:29'),
(73, 'MSI-73', 'UCT1040', '50$', '5', '55', 'pending', '', '2024-06-08 06:27:23'),
(74, 'MSI-74', 'UCT1041', '50$', '5', '55', 'pending', '', '2024-06-12 09:48:29'),
(75, 'MSI-75', 'UCT1042', '50$', '5', '55', 'pending', '', '2024-06-12 12:21:47'),
(76, 'MSI-76', 'UCT1010', '50$', '5', '55', 'pending', NULL, '2024-06-13 18:30:01'),
(77, 'MSI-77', 'UCT1011', '50$', '5', '55', 'pending', NULL, '2024-06-13 18:30:06'),
(78, 'MSI-78', 'UCT1012', '50$', '5', '55', 'pending', NULL, '2024-06-13 18:30:10'),
(79, 'MSI-79', 'UCT1013', '50$', '5', '55', 'pending', NULL, '2024-06-13 18:30:14'),
(80, 'MSI-80', 'UCT1043', '50$', '5', '55', 'pending', '', '2024-06-14 06:34:02'),
(81, 'MSI-81', 'UCT1044', '50$', '5', '55', 'pending', '', '2024-06-15 13:21:14'),
(82, 'MSI-82', 'UCT1014', '50$', '5', '55', 'pending', NULL, '2024-06-15 18:30:01'),
(83, 'MSI-83', 'UCT1015', '50$', '5', '55', 'pending', NULL, '2024-06-15 18:30:05'),
(84, 'MSI-84', 'UCT1016', '50$', '5', '55', 'pending', NULL, '2024-06-16 18:30:01'),
(85, 'MSI-85', 'UCT1017', '50$', '5', '55', 'paid', '', '2024-06-16 18:30:05'),
(86, 'MSI-86', 'UCT1018', '50$', '5', '55', 'pending', NULL, '2024-06-16 18:30:09'),
(87, 'MSI-87', 'UCT1019', '50$', '5', '55', 'paid', '', '2024-06-16 18:30:13'),
(88, 'MSI-88', 'UCT1020', '50$', '5', '55', 'pending', NULL, '2024-06-16 18:30:17'),
(89, 'MSI-89', 'UCT1021', '50$', '5', '55', 'paid', '', '2024-06-16 18:30:21'),
(90, 'MSI-90', 'UCT1022', '50$', '5', '55', 'paid', '', '2024-06-16 18:30:24'),
(91, 'MSI-91', 'UCT1023', '50$', '5', '55', 'paid', '', '2024-06-16 18:30:28'),
(92, 'MSI-92', 'UCT1024', '50$', '5', '55', 'pending', NULL, '2024-06-16 18:30:32'),
(93, 'MSI-93', 'UCT1025', '50$', '5', '55', 'pending', NULL, '2024-06-16 18:30:36'),
(94, 'MSI-94', 'UCT1026', '50$', '5', '55', 'pending', NULL, '2024-06-16 18:30:39'),
(95, 'MSI-95', 'UCT1045', '50$', '5', '55', 'pending', '', '2024-06-19 07:53:15'),
(96, 'MSI-96', 'UCT1046', '50$', '5', '55', 'pending', '', '2024-06-19 10:33:30'),
(97, 'MSI-97', 'UCT1047', '50$', '5', '55', 'pending', '', '2024-06-20 07:23:48'),
(98, 'MSI-98', 'UCT1048', '50$', '5', '55', 'pending', '', '2024-06-20 10:09:14'),
(99, 'MSI-99', 'UCT1027', '50$', '5', '55', 'pending', NULL, '2024-06-20 10:22:27'),
(100, 'MSI-100', 'UCT1028', '50$', '5', '55', 'pending', NULL, '2024-06-20 10:22:27'),
(101, 'MSI-101', 'UCT1029', '50$', '5', '55', 'pending', NULL, '2024-06-20 10:22:28'),
(102, 'MSI-102', 'UCT1049', '50$', '5', '55', 'pending', '', '2024-06-21 08:29:14'),
(103, 'MSI-103', 'UCT1030', '50$', '5', '55', 'pending', NULL, '2024-06-28 18:30:01'),
(104, 'MSI-104', 'UCT1031', '50$', '5', '55', 'pending', NULL, '2024-06-28 18:30:06'),
(105, 'MSI-105', 'UCT1032', '50$', '5', '55', 'pending', NULL, '2024-06-28 18:30:11'),
(106, 'MSI-106', 'UCT1050', '50$', '5', '55', 'pending', '', '2024-06-29 07:34:06'),
(107, 'MSI-107', 'UCT1033', '50$', '5', '55', 'pending', NULL, '2024-06-30 18:30:01'),
(108, 'MSI-108', 'UCT1034', '50$', '5', '55', 'pending', NULL, '2024-07-02 18:30:01'),
(109, 'MSI-109', 'UCT1051', '50$', '5', '55', 'pending', '', '2024-07-03 10:19:54'),
(110, 'MSI-110', 'UCT1052', '50$', '5', '55', 'pending', '', '2024-07-03 14:51:21'),
(111, 'MSI-111', 'UCT1035', '50$', '5', '55', 'pending', NULL, '2024-07-03 18:30:01'),
(112, 'MSI-112', 'UCT1036', '50$', '5', '55', 'pending', NULL, '2024-07-04 18:30:01'),
(113, 'MSI-113', 'UCT1053', '50$', '5', '55', 'pending', '', '2024-07-05 05:15:38'),
(114, 'MSI-114', 'UCT1037', '50$', '5', '55', 'pending', NULL, '2024-07-05 18:30:01'),
(115, 'MSI-115', 'UCT1038', '50$', '5', '55', 'pending', NULL, '2024-07-05 18:30:06'),
(116, 'MSI-116', 'UCT1054', '50$', '5', '55', 'pending', '', '2024-07-05 18:41:27'),
(117, 'MSI-117', 'UCT1001', '50$', '5', '55', 'pending', NULL, '2024-07-06 18:30:01'),
(118, 'MSI-118', 'UCT1002', '50$', '5', '55', 'pending', NULL, '2024-07-06 18:30:06'),
(119, 'MSI-119', 'UCT1003', '50$', '5', '55', 'pending', NULL, '2024-07-06 18:30:11'),
(120, 'MSI-120', 'UCT1004', '50$', '5', '55', 'pending', NULL, '2024-07-06 18:30:16'),
(121, 'MSI-121', 'UCT1039', '50$', '5', '55', 'pending', NULL, '2024-07-06 18:30:21'),
(122, 'MSI-122', 'UCT1005', '50$', '5', '55', 'pending', NULL, '2024-07-07 11:31:32'),
(123, 'MSI-123', 'UCT1006', '50$', '5', '55', 'pending', NULL, '2024-07-07 11:31:37'),
(124, 'MSI-124', 'UCT1007', '50$', '5', '55', 'pending', NULL, '2024-07-07 11:31:42'),
(125, 'MSI-125', 'UCT1008', '50$', '5', '55', 'pending', NULL, '2024-07-07 11:31:47'),
(126, 'MSI-126', 'UCT1009', '50$', '5', '55', 'pending', NULL, '2024-07-08 18:30:01'),
(127, 'MSI-127', 'UCT1040', '50$', '5', '55', 'pending', NULL, '2024-07-08 18:30:06'),
(128, 'MSI-128', 'UCT1041', '50$', '5', '55', 'pending', NULL, '2024-07-12 18:30:01'),
(129, 'MSI-129', 'UCT1042', '50$', '5', '55', 'pending', NULL, '2024-07-12 18:30:07'),
(130, 'MSI-130', 'UCT1010', '50$', '5', '55', 'pending', NULL, '2024-07-14 18:30:01'),
(131, 'MSI-131', 'UCT1011', '50$', '5', '55', 'pending', NULL, '2024-07-14 18:30:06'),
(132, 'MSI-132', 'UCT1012', '50$', '5', '55', 'pending', NULL, '2024-07-14 18:30:12'),
(133, 'MSI-133', 'UCT1013', '50$', '5', '55', 'pending', NULL, '2024-07-14 18:30:17'),
(134, 'MSI-134', 'UCT1043', '50$', '5', '55', 'pending', NULL, '2024-07-14 18:30:22'),
(135, 'MSI-135', 'UCT1044', '50$', '5', '55', 'pending', NULL, '2024-07-15 18:30:02'),
(136, 'MSI-136', 'UCT1014', '50$', '5', '55', 'pending', NULL, '2024-07-16 18:30:01'),
(137, 'MSI-137', 'UCT1015', '50$', '5', '55', 'pending', NULL, '2024-07-16 18:30:06'),
(138, 'MSI-138', 'UCT1016', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:02'),
(139, 'MSI-139', 'UCT1017', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:07'),
(140, 'MSI-140', 'UCT1018', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:12'),
(141, 'MSI-141', 'UCT1019', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:17'),
(142, 'MSI-142', 'UCT1020', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:22'),
(143, 'MSI-143', 'UCT1021', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:27'),
(144, 'MSI-144', 'UCT1022', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:33'),
(145, 'MSI-145', 'UCT1023', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:38'),
(146, 'MSI-146', 'UCT1024', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:43'),
(147, 'MSI-147', 'UCT1025', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:48'),
(148, 'MSI-148', 'UCT1026', '50$', '5', '55', 'pending', NULL, '2024-07-17 18:30:53'),
(149, 'MSI-149', 'UCT1045', '50$', '5', '55', 'pending', NULL, '2024-07-19 18:30:02'),
(150, 'MSI-150', 'UCT1046', '50$', '5', '55', 'pending', NULL, '2024-07-19 18:30:07'),
(151, 'MSI-151', 'UCT1027', '50$', '5', '55', 'pending', NULL, '2024-07-20 18:30:01'),
(152, 'MSI-152', 'UCT1028', '50$', '5', '55', 'pending', NULL, '2024-07-20 18:30:07'),
(153, 'MSI-153', 'UCT1029', '50$', '5', '55', 'pending', NULL, '2024-07-20 18:30:12'),
(154, 'MSI-154', 'UCT1047', '50$', '5', '55', 'pending', NULL, '2024-07-20 18:30:17'),
(155, 'MSI-155', 'UCT1048', '50$', '5', '55', 'pending', NULL, '2024-07-20 18:30:23'),
(156, 'MSI-156', 'UCT1049', '50$', '5', '55', 'pending', NULL, '2024-07-21 18:30:02'),
(157, 'MSI-157', 'UCT1030', '50$', '5', '55', 'pending', NULL, '2024-07-29 18:30:02'),
(158, 'MSI-158', 'UCT1031', '50$', '5', '55', 'pending', NULL, '2024-07-29 18:30:07'),
(159, 'MSI-159', 'UCT1032', '50$', '5', '55', 'pending', NULL, '2024-07-29 18:30:12'),
(160, 'MSI-160', 'UCT1050', '50$', '5', '55', 'pending', NULL, '2024-07-29 18:30:17'),
(161, 'MSI-161', 'UCT1033', '50$', '5', '55', 'pending', NULL, '2024-07-31 18:30:02'),
(162, 'MSI-162', 'UCT1034', '50$', '5', '55', 'pending', NULL, '2024-08-02 18:30:02'),
(163, 'MSI-163', 'UCT1051', '50$', '5', '55', 'pending', NULL, '2024-08-02 18:30:07'),
(164, 'MSI-164', 'UCT1052', '50$', '5', '55', 'pending', NULL, '2024-08-02 18:30:12'),
(165, 'MSI-165', 'UCT1035', '50$', '5', '55', 'pending', NULL, '2024-08-03 18:30:02'),
(166, 'MSI-166', 'UCT1036', '50$', '5', '55', 'pending', NULL, '2024-08-04 18:30:02'),
(167, 'MSI-167', 'UCT1053', '50$', '5', '55', 'pending', NULL, '2024-08-04 18:30:07');

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
  `txn_hashid` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `tp_value` varchar(100) DEFAULT NULL,
  `bonus_tp` varchar(100) DEFAULT NULL,
  `credit_tp` varchar(100) DEFAULT NULL,
  `debite_tp` varchar(100) DEFAULT NULL,
  `balance_tp` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthlytpsavinghistory`
--

INSERT INTO `monthlytpsavinghistory` (`id`, `user_id`, `invoice_id`, `invoice_date`, `paid_date`, `txn_hashid`, `payment_type`, `amount`, `tp_value`, `bonus_tp`, `credit_tp`, `debite_tp`, `balance_tp`, `action`, `remark`) VALUES
(1, 'UCT1001', 'MSI-1', '2024-05-07 15:04:54', '2024-05-07 09:39:03', '369369', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '55', 'paid', NULL),
(2, 'UCT1002', 'MSI-2', '2024-05-07 15:14:31', '2024-05-07 09:47:14', '369369', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '55', 'paid', NULL),
(3, 'UCT1003', 'MSI-3', '2024-05-07 15:20:01', '2024-05-07 09:51:17', '369369', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '55', 'paid', NULL),
(4, 'UCT1019', 'MSI-19', '2024-05-17 16:46:16', '2024-05-29 10:49:27', '0x3415adad6eaef854efa9e01daea28c9bbb4cb0ee6202cb28b419943440dee6b1', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '295', 'paid', NULL),
(5, 'UCT1021', 'MSI-21', '2024-05-17 17:16:21', '2024-05-29 10:51:24', '0x0d84b4fe2b6e3f618a010b2899bde123a3848e224d29e1372e5dba5724583810', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '295', 'paid', NULL),
(6, 'UCT1022', 'MSI-22', '2024-05-17 17:20:37', '2024-05-29 10:52:49', '0x18513cd8351f9e1c40a60d57d8381a695be891bb7fdeb4362112edddc0955790', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '295', 'paid', NULL),
(7, 'UCT1023', 'MSI-23', '2024-05-17 17:29:35', '2024-05-29 10:54:03', '0xff0af18a27e08ab42404658e286577b47e98bc92bdc24f2845f7bf5ec1dbcbf4', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '295', 'paid', NULL),
(8, 'UCT1017', 'MSI-17', '2024-05-17 14:27:16', '2024-05-29 14:14:32', '0x5781d62d11594cba56e929d6984eace7178a50ef67eb3e7da825274add757c8a', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '295', 'paid', NULL),
(9, 'UCT1003', 'MSI-66', '2024-06-06 10:14:07', '2024-06-10 03:21:05', '0xfa43194c4a201df9ff3e34d7c4f18f4cfdcc0bf9d04bb70dbf7ebf9dec5ba88e', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '105', 'paid', NULL),
(10, 'UCT1002', 'MSI-65', '2024-06-06 10:14:04', '2024-06-26 10:18:01', '369369', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '115', 'paid', NULL),
(11, 'UCT1017', 'MSI-85', '2024-06-17 00:00:05', '2024-06-29 04:32:47', '0x738c89bfbeddcbfd7016415f99dab206880d6fde88e078d4eb7c372c04ca8ee3', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '350', 'paid', NULL),
(12, 'UCT1019', 'MSI-87', '2024-06-17 00:00:13', '2024-06-29 04:58:32', '0x0c885030e80986358057e476213b17029578fa93c824d3dd44bc25926fe486db', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '350', 'paid', NULL),
(13, 'UCT1021', 'MSI-89', '2024-06-17 00:00:21', '2024-06-29 05:02:00', '0x681909977959751b87d86aa53e16b228e97950a8cb73065b1c90805e284952d7', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '350', 'paid', NULL),
(14, 'UCT1022', 'MSI-90', '2024-06-17 00:00:24', '2024-06-29 05:05:22', '0xefe4fe62b9bb15e869aed694e12a09de8b7eaf8ba3588c471a4ea628265b6913', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '350', 'paid', NULL),
(15, 'UCT1023', 'MSI-91', '2024-06-17 00:00:28', '2024-06-29 05:57:43', '0x84a353a4a44055101ea648898ebaa585d6deda0fed6afb3d6fd2aa337906e156', 'To Crypto', '4500 UCC', '50', '5', '55', NULL, '350', 'paid', NULL);

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
(65, 'UCT99999', '1', 'UCT1010', '4', 'credit', 'Networking Income', '2024-05-21 02:34:06'),
(66, 'UCT1003', '5', 'UCT1030', '1', 'credit', 'Networking Income', '2024-05-29 09:35:48'),
(67, 'UCT1002', '2.5', 'UCT1030', '2', 'credit', 'Networking Income', '2024-05-29 09:35:48'),
(68, 'UCT1001', '1.5', 'UCT1030', '3', 'credit', 'Networking Income', '2024-05-29 09:35:48'),
(69, 'UCT99999', '1', 'UCT1030', '4', 'credit', 'Networking Income', '2024-05-29 09:35:48'),
(70, 'UCT1003', '45.00', '', '', 'debit', 'Available Withdraw Balance', '2024-06-02 15:28:24'),
(71, 'UCT1004', '5', 'UCT1035', '1', 'credit', 'Networking Income', '2024-06-03 11:29:48'),
(72, 'UCT1003', '2.5', 'UCT1035', '2', 'credit', 'Networking Income', '2024-06-03 11:29:48'),
(73, 'UCT1002', '1.5', 'UCT1035', '3', 'credit', 'Networking Income', '2024-06-03 11:29:48'),
(74, 'UCT1001', '1', 'UCT1035', '4', 'credit', 'Networking Income', '2024-06-03 11:29:48'),
(75, 'UCT99999', '0.5', 'UCT1035', '5', 'credit', 'Networking Income', '2024-06-03 11:29:48'),
(76, 'UCT1004', '5', 'UCT1036', '1', 'credit', 'Networking Income', '2024-06-04 08:24:36'),
(77, 'UCT1003', '2.5', 'UCT1036', '2', 'credit', 'Networking Income', '2024-06-04 08:24:36'),
(78, 'UCT1002', '1.5', 'UCT1036', '3', 'credit', 'Networking Income', '2024-06-04 08:24:36'),
(79, 'UCT1001', '1', 'UCT1036', '4', 'credit', 'Networking Income', '2024-06-04 08:24:36'),
(80, 'UCT99999', '0.5', 'UCT1036', '5', 'credit', 'Networking Income', '2024-06-04 08:24:36'),
(81, 'UCT1003', '5', 'UCT1018', '1', 'credit', 'Networking Income', '2024-06-05 03:48:14'),
(82, 'UCT1002', '2.5', 'UCT1018', '2', 'credit', 'Networking Income', '2024-06-05 03:48:14'),
(83, 'UCT1001', '1.5', 'UCT1018', '3', 'credit', 'Networking Income', '2024-06-05 03:48:14'),
(84, 'UCT99999', '1', 'UCT1018', '4', 'credit', 'Networking Income', '2024-06-05 03:48:14'),
(85, 'UCT1003', '5', 'UCT1033', '1', 'credit', 'Networking Income', '2024-06-05 03:54:09'),
(86, 'UCT1002', '2.5', 'UCT1033', '2', 'credit', 'Networking Income', '2024-06-05 03:54:09'),
(87, 'UCT1001', '1.5', 'UCT1033', '3', 'credit', 'Networking Income', '2024-06-05 03:54:09'),
(88, 'UCT99999', '1', 'UCT1033', '4', 'credit', 'Networking Income', '2024-06-05 03:54:09'),
(89, 'UCT1028', '5', 'UCT1039', '1', 'credit', 'Networking Income', '2024-06-08 04:14:50'),
(90, 'UCT1024', '2.5', 'UCT1039', '2', 'credit', 'Networking Income', '2024-06-08 04:14:50'),
(91, 'UCT1009', '1.5', 'UCT1039', '3', 'credit', 'Networking Income', '2024-06-08 04:14:50'),
(92, 'UCT1003', '1', 'UCT1039', '4', 'credit', 'Networking Income', '2024-06-08 04:14:50'),
(93, 'UCT1002', '0.5', 'UCT1039', '5', 'credit', 'Networking Income', '2024-06-08 04:14:50'),
(94, 'UCT1001', '0.5', 'UCT1039', '6', 'credit', 'Networking Income', '2024-06-08 04:14:50'),
(95, 'UCT99999', '0.5', 'UCT1039', '7', 'credit', 'Networking Income', '2024-06-08 04:14:50'),
(96, 'UCT1039', '5', 'UCT1040', '1', 'credit', 'Networking Income', '2024-06-08 08:50:33'),
(97, 'UCT1028', '2.5', 'UCT1040', '2', 'credit', 'Networking Income', '2024-06-08 08:50:33'),
(98, 'UCT1024', '1.5', 'UCT1040', '3', 'credit', 'Networking Income', '2024-06-08 08:50:33'),
(99, 'UCT1009', '1', 'UCT1040', '4', 'credit', 'Networking Income', '2024-06-08 08:50:33'),
(100, 'UCT1003', '0.5', 'UCT1040', '5', 'credit', 'Networking Income', '2024-06-08 08:50:33'),
(101, 'UCT1002', '0.5', 'UCT1040', '6', 'credit', 'Networking Income', '2024-06-08 08:50:33'),
(102, 'UCT1001', '0.5', 'UCT1040', '7', 'credit', 'Networking Income', '2024-06-08 08:50:33'),
(103, 'UCT99999', '0.5', 'UCT1040', '8', 'credit', 'Networking Income', '2024-06-08 08:50:33'),
(104, 'UCT1003', '5', 'UCT1041', '1', 'credit', 'Networking Income', '2024-06-12 10:03:22'),
(105, 'UCT1002', '2.5', 'UCT1041', '2', 'credit', 'Networking Income', '2024-06-12 10:03:22'),
(106, 'UCT1001', '1.5', 'UCT1041', '3', 'credit', 'Networking Income', '2024-06-12 10:03:22'),
(107, 'UCT99999', '1', 'UCT1041', '4', 'credit', 'Networking Income', '2024-06-12 10:03:22'),
(108, 'UCT1003', '5', 'UCT1042', '1', 'credit', 'Networking Income', '2024-06-12 12:27:46'),
(109, 'UCT1002', '2.5', 'UCT1042', '2', 'credit', 'Networking Income', '2024-06-12 12:27:46'),
(110, 'UCT1001', '1.5', 'UCT1042', '3', 'credit', 'Networking Income', '2024-06-12 12:27:46'),
(111, 'UCT99999', '1', 'UCT1042', '4', 'credit', 'Networking Income', '2024-06-12 12:27:46'),
(112, 'UCT1009', '5', 'UCT1044', '1', 'credit', 'Networking Income', '2024-06-15 13:31:25'),
(113, 'UCT1003', '2.5', 'UCT1044', '2', 'credit', 'Networking Income', '2024-06-15 13:31:25'),
(114, 'UCT1002', '1.5', 'UCT1044', '3', 'credit', 'Networking Income', '2024-06-15 13:31:25'),
(115, 'UCT1001', '1', 'UCT1044', '4', 'credit', 'Networking Income', '2024-06-15 13:31:25'),
(116, 'UCT99999', '0.5', 'UCT1044', '5', 'credit', 'Networking Income', '2024-06-15 13:31:25'),
(117, 'UCT1008', '5', 'UCT1045', '1', 'credit', 'Networking Income', '2024-06-19 08:08:56'),
(118, 'UCT1003', '2.5', 'UCT1045', '2', 'credit', 'Networking Income', '2024-06-19 08:08:56'),
(119, 'UCT1002', '1.5', 'UCT1045', '3', 'credit', 'Networking Income', '2024-06-19 08:08:56'),
(120, 'UCT1001', '1', 'UCT1045', '4', 'credit', 'Networking Income', '2024-06-19 08:08:56'),
(121, 'UCT99999', '0.5', 'UCT1045', '5', 'credit', 'Networking Income', '2024-06-19 08:08:56'),
(122, 'UCT1003', '5', 'UCT1048', '1', 'credit', 'Networking Income', '2024-06-20 10:10:57'),
(123, 'UCT1002', '2.5', 'UCT1048', '2', 'credit', 'Networking Income', '2024-06-20 10:10:57'),
(124, 'UCT1001', '1.5', 'UCT1048', '3', 'credit', 'Networking Income', '2024-06-20 10:10:57'),
(125, 'UCT99999', '1', 'UCT1048', '4', 'credit', 'Networking Income', '2024-06-20 10:10:57'),
(126, 'UCT1003', '5', 'UCT1051', '1', 'credit', 'Networking Income', '2024-07-03 12:53:30'),
(127, 'UCT1002', '2.5', 'UCT1051', '2', 'credit', 'Networking Income', '2024-07-03 12:53:30'),
(128, 'UCT1001', '1.5', 'UCT1051', '3', 'credit', 'Networking Income', '2024-07-03 12:53:30'),
(129, 'UCT99999', '1', 'UCT1051', '4', 'credit', 'Networking Income', '2024-07-03 12:53:30'),
(130, 'UCT1051', '5', 'UCT1052', '1', 'credit', 'Networking Income', '2024-07-04 05:44:45'),
(131, 'UCT1003', '2.5', 'UCT1052', '2', 'credit', 'Networking Income', '2024-07-04 05:44:45'),
(132, 'UCT1002', '1.5', 'UCT1052', '3', 'credit', 'Networking Income', '2024-07-04 05:44:45'),
(133, 'UCT1001', '1', 'UCT1052', '4', 'credit', 'Networking Income', '2024-07-04 05:44:45'),
(134, 'UCT99999', '0.5', 'UCT1052', '5', 'credit', 'Networking Income', '2024-07-04 05:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `rankboardaward`
--

CREATE TABLE `rankboardaward` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `level1reward_date` varchar(100) DEFAULT NULL,
  `level1reward_status` varchar(100) DEFAULT NULL,
  `level2reward_date` varchar(100) DEFAULT NULL,
  `level2reward_status` varchar(100) DEFAULT NULL,
  `level3reward_date` varchar(100) DEFAULT NULL,
  `level3reward_status` varchar(100) DEFAULT NULL,
  `level4reward_date` varchar(100) DEFAULT NULL,
  `level4reward_status` varchar(100) DEFAULT NULL,
  `level5reward_date` varchar(100) DEFAULT NULL,
  `level5reward_status` varchar(100) DEFAULT NULL,
  `level6reward_date` varchar(100) DEFAULT NULL,
  `level6reward_status` varchar(100) DEFAULT NULL,
  `level7reward_date` varchar(100) DEFAULT NULL,
  `level7reward_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reactivationwallet`
--

CREATE TABLE `reactivationwallet` (
  `raw_id` int(11) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `raw_points` varchar(50) NOT NULL,
  `raw_action` varchar(50) NOT NULL,
  `raw_remark` varchar(100) NOT NULL,
  `raw_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `reactivationwallet`
--

INSERT INTO `reactivationwallet` (`raw_id`, `user_id`, `raw_points`, `raw_action`, `raw_remark`, `raw_createdat`) VALUES
(NULL, 'UCT1003', '2.50', 'credit', 'Withdrawal Fees', '2024-06-02 15:33:27');

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
(64, 'UCT99999', '0.33', 'UCT1010', '4', 'credit', 'Royalty Income', '2024-05-21 02:34:06'),
(65, 'UCT1003', '0.33', 'UCT1030', '1', 'credit', 'Royalty Income', '2024-05-29 09:35:48'),
(66, 'UCT1002', '0.33', 'UCT1030', '2', 'credit', 'Royalty Income', '2024-05-29 09:35:48'),
(67, 'UCT1001', '0.33', 'UCT1030', '3', 'credit', 'Royalty Income', '2024-05-29 09:35:48'),
(68, 'UCT99999', '0.33', 'UCT1030', '4', 'credit', 'Royalty Income', '2024-05-29 09:35:48'),
(69, 'UCT1004', '0.33', 'UCT1035', '1', 'credit', 'Royalty Income', '2024-06-03 11:29:48'),
(70, 'UCT1003', '0.33', 'UCT1035', '2', 'credit', 'Royalty Income', '2024-06-03 11:29:48'),
(71, 'UCT1002', '0.33', 'UCT1035', '3', 'credit', 'Royalty Income', '2024-06-03 11:29:48'),
(72, 'UCT1001', '0.33', 'UCT1035', '4', 'credit', 'Royalty Income', '2024-06-03 11:29:48'),
(73, 'UCT99999', '0.33', 'UCT1035', '5', 'credit', 'Royalty Income', '2024-06-03 11:29:48'),
(74, 'UCT1004', '0.33', 'UCT1036', '1', 'credit', 'Royalty Income', '2024-06-04 08:24:36'),
(75, 'UCT1003', '0.33', 'UCT1036', '2', 'credit', 'Royalty Income', '2024-06-04 08:24:36'),
(76, 'UCT1002', '0.33', 'UCT1036', '3', 'credit', 'Royalty Income', '2024-06-04 08:24:36'),
(77, 'UCT1001', '0.33', 'UCT1036', '4', 'credit', 'Royalty Income', '2024-06-04 08:24:36'),
(78, 'UCT99999', '0.33', 'UCT1036', '5', 'credit', 'Royalty Income', '2024-06-04 08:24:36'),
(79, 'UCT1003', '0.33', 'UCT1018', '1', 'credit', 'Royalty Income', '2024-06-05 03:48:14'),
(80, 'UCT1002', '0.33', 'UCT1018', '2', 'credit', 'Royalty Income', '2024-06-05 03:48:14'),
(81, 'UCT1001', '0.33', 'UCT1018', '3', 'credit', 'Royalty Income', '2024-06-05 03:48:14'),
(82, 'UCT99999', '0.33', 'UCT1018', '4', 'credit', 'Royalty Income', '2024-06-05 03:48:14'),
(83, 'UCT1003', '0.33', 'UCT1033', '1', 'credit', 'Royalty Income', '2024-06-05 03:54:09'),
(84, 'UCT1002', '0.33', 'UCT1033', '2', 'credit', 'Royalty Income', '2024-06-05 03:54:09'),
(85, 'UCT1001', '0.33', 'UCT1033', '3', 'credit', 'Royalty Income', '2024-06-05 03:54:09'),
(86, 'UCT99999', '0.33', 'UCT1033', '4', 'credit', 'Royalty Income', '2024-06-05 03:54:09'),
(87, 'UCT1028', '0.33', 'UCT1039', '1', 'credit', 'Royalty Income', '2024-06-08 04:14:50'),
(88, 'UCT1024', '0.33', 'UCT1039', '2', 'credit', 'Royalty Income', '2024-06-08 04:14:50'),
(89, 'UCT1009', '0.33', 'UCT1039', '3', 'credit', 'Royalty Income', '2024-06-08 04:14:50'),
(90, 'UCT1003', '0.33', 'UCT1039', '4', 'credit', 'Royalty Income', '2024-06-08 04:14:50'),
(91, 'UCT1002', '0.33', 'UCT1039', '5', 'credit', 'Royalty Income', '2024-06-08 04:14:50'),
(92, 'UCT1001', '0.33', 'UCT1039', '6', 'credit', 'Royalty Income', '2024-06-08 04:14:50'),
(93, 'UCT99999', '0.33', 'UCT1039', '7', 'credit', 'Royalty Income', '2024-06-08 04:14:50'),
(94, 'UCT1039', '0.33', 'UCT1040', '1', 'credit', 'Royalty Income', '2024-06-08 08:50:33'),
(95, 'UCT1028', '0.33', 'UCT1040', '2', 'credit', 'Royalty Income', '2024-06-08 08:50:33'),
(96, 'UCT1024', '0.33', 'UCT1040', '3', 'credit', 'Royalty Income', '2024-06-08 08:50:33'),
(97, 'UCT1009', '0.33', 'UCT1040', '4', 'credit', 'Royalty Income', '2024-06-08 08:50:33'),
(98, 'UCT1003', '0.33', 'UCT1040', '5', 'credit', 'Royalty Income', '2024-06-08 08:50:33'),
(99, 'UCT1002', '0.33', 'UCT1040', '6', 'credit', 'Royalty Income', '2024-06-08 08:50:33'),
(100, 'UCT1001', '0.33', 'UCT1040', '7', 'credit', 'Royalty Income', '2024-06-08 08:50:33'),
(101, 'UCT99999', '0.33', 'UCT1040', '8', 'credit', 'Royalty Income', '2024-06-08 08:50:33'),
(102, 'UCT1003', '0.33', 'UCT1041', '1', 'credit', 'Royalty Income', '2024-06-12 10:03:22'),
(103, 'UCT1002', '0.33', 'UCT1041', '2', 'credit', 'Royalty Income', '2024-06-12 10:03:22'),
(104, 'UCT1001', '0.33', 'UCT1041', '3', 'credit', 'Royalty Income', '2024-06-12 10:03:22'),
(105, 'UCT99999', '0.33', 'UCT1041', '4', 'credit', 'Royalty Income', '2024-06-12 10:03:22'),
(106, 'UCT1003', '0.33', 'UCT1042', '1', 'credit', 'Royalty Income', '2024-06-12 12:27:46'),
(107, 'UCT1002', '0.33', 'UCT1042', '2', 'credit', 'Royalty Income', '2024-06-12 12:27:46'),
(108, 'UCT1001', '0.33', 'UCT1042', '3', 'credit', 'Royalty Income', '2024-06-12 12:27:46'),
(109, 'UCT99999', '0.33', 'UCT1042', '4', 'credit', 'Royalty Income', '2024-06-12 12:27:46'),
(110, 'UCT1009', '0.33', 'UCT1044', '1', 'credit', 'Royalty Income', '2024-06-15 13:31:25'),
(111, 'UCT1003', '0.33', 'UCT1044', '2', 'credit', 'Royalty Income', '2024-06-15 13:31:25'),
(112, 'UCT1002', '0.33', 'UCT1044', '3', 'credit', 'Royalty Income', '2024-06-15 13:31:25'),
(113, 'UCT1001', '0.33', 'UCT1044', '4', 'credit', 'Royalty Income', '2024-06-15 13:31:25'),
(114, 'UCT99999', '0.33', 'UCT1044', '5', 'credit', 'Royalty Income', '2024-06-15 13:31:25'),
(115, 'UCT1008', '0.33', 'UCT1045', '1', 'credit', 'Royalty Income', '2024-06-19 08:08:56'),
(116, 'UCT1003', '0.33', 'UCT1045', '2', 'credit', 'Royalty Income', '2024-06-19 08:08:56'),
(117, 'UCT1002', '0.33', 'UCT1045', '3', 'credit', 'Royalty Income', '2024-06-19 08:08:56'),
(118, 'UCT1001', '0.33', 'UCT1045', '4', 'credit', 'Royalty Income', '2024-06-19 08:08:56'),
(119, 'UCT99999', '0.33', 'UCT1045', '5', 'credit', 'Royalty Income', '2024-06-19 08:08:56'),
(120, 'UCT1003', '0.33', 'UCT1048', '1', 'credit', 'Royalty Income', '2024-06-20 10:10:57'),
(121, 'UCT1002', '0.33', 'UCT1048', '2', 'credit', 'Royalty Income', '2024-06-20 10:10:57'),
(122, 'UCT1001', '0.33', 'UCT1048', '3', 'credit', 'Royalty Income', '2024-06-20 10:10:57'),
(123, 'UCT99999', '0.33', 'UCT1048', '4', 'credit', 'Royalty Income', '2024-06-20 10:10:57'),
(124, 'UCT1003', '0.33', 'UCT1051', '1', 'credit', 'Royalty Income', '2024-07-03 12:53:30'),
(125, 'UCT1002', '0.33', 'UCT1051', '2', 'credit', 'Royalty Income', '2024-07-03 12:53:30'),
(126, 'UCT1001', '0.33', 'UCT1051', '3', 'credit', 'Royalty Income', '2024-07-03 12:53:30'),
(127, 'UCT99999', '0.33', 'UCT1051', '4', 'credit', 'Royalty Income', '2024-07-03 12:53:30'),
(128, 'UCT1051', '0.33', 'UCT1052', '1', 'credit', 'Royalty Income', '2024-07-04 05:44:45'),
(129, 'UCT1003', '0.33', 'UCT1052', '2', 'credit', 'Royalty Income', '2024-07-04 05:44:45'),
(130, 'UCT1002', '0.33', 'UCT1052', '3', 'credit', 'Royalty Income', '2024-07-04 05:44:45'),
(131, 'UCT1001', '0.33', 'UCT1052', '4', 'credit', 'Royalty Income', '2024-07-04 05:44:45'),
(132, 'UCT99999', '0.33', 'UCT1052', '5', 'credit', 'Royalty Income', '2024-07-04 05:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `savingsincome`
--

CREATE TABLE `savingsincome` (
  `si_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `si_points` varchar(20) NOT NULL,
  `si_bonusfrom` varchar(100) NOT NULL,
  `si_lvl` varchar(100) NOT NULL,
  `si_action` varchar(20) NOT NULL,
  `si_remark` varchar(100) NOT NULL,
  `si_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savingsincome`
--

INSERT INTO `savingsincome` (`si_id`, `user_id`, `si_points`, `si_bonusfrom`, `si_lvl`, `si_action`, `si_remark`, `si_createdat`) VALUES
(1, 'UCT99999', '5', 'UCT1001', '1', 'credit', 'Savings Income', '2024-05-07 09:39:23'),
(2, 'UCT1001', '5', 'UCT1002', '1', 'credit', 'Savings Income', '2024-05-07 09:47:45'),
(3, 'UCT1002', '5', 'UCT1003', '1', 'credit', 'Savings Income', '2024-05-07 09:51:45'),
(4, 'UCT1012', '5', 'UCT1023', '1', 'credit', 'Savings Income', '2024-05-29 11:12:08'),
(5, 'UCT1012', '5', 'UCT1022', '1', 'credit', 'Savings Income', '2024-05-29 11:12:50'),
(6, 'UCT1012', '5', 'UCT1021', '1', 'credit', 'Savings Income', '2024-05-29 11:13:44'),
(7, 'UCT1012', '5', 'UCT1019', '1', 'credit', 'Savings Income', '2024-05-29 11:13:46'),
(8, 'UCT1012', '5', 'UCT1017', '1', 'credit', 'Savings Income', '2024-05-29 16:41:48'),
(9, 'UCT1002', '2.5', 'UCT1003', '1', 'credit', 'Savings Income', '2024-06-10 03:23:39'),
(10, 'UCT1001', '1', 'UCT1003', '2', 'credit', 'Savings Income', '2024-06-10 03:23:39'),
(11, 'UCT99999', '1', 'UCT1003', '3', 'credit', 'Savings Income', '2024-06-10 03:23:39'),
(12, 'UCT1001', '5', 'UCT1002', '1', 'credit', 'Savings Income', '2024-06-26 10:19:29'),
(13, 'UCT99999', '1', 'UCT1002', '2', 'credit', 'Savings Income', '2024-06-26 10:19:29'),
(14, 'UCT1012', '5', 'UCT1023', '1', 'credit', 'Savings Income', '2024-06-29 07:04:47'),
(15, 'UCT1008', '1', 'UCT1023', '2', 'credit', 'Savings Income', '2024-06-29 07:04:47'),
(16, 'UCT1003', '1', 'UCT1023', '3', 'credit', 'Savings Income', '2024-06-29 07:04:47'),
(17, 'UCT1002', '1', 'UCT1023', '4', 'credit', 'Savings Income', '2024-06-29 07:04:47'),
(18, 'UCT1001', '0.5', 'UCT1023', '5', 'credit', 'Savings Income', '2024-06-29 07:04:47'),
(19, 'UCT99999', '0.5', 'UCT1023', '6', 'credit', 'Savings Income', '2024-06-29 07:04:47'),
(20, 'UCT1012', '5', 'UCT1022', '1', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(21, 'UCT1008', '1', 'UCT1022', '2', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(22, 'UCT1003', '1', 'UCT1022', '3', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(23, 'UCT1002', '1', 'UCT1022', '4', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(24, 'UCT1001', '0.5', 'UCT1022', '5', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(25, 'UCT99999', '0.5', 'UCT1022', '6', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(26, 'UCT1012', '5', 'UCT1021', '1', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(27, 'UCT1008', '1', 'UCT1021', '2', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(28, 'UCT1003', '1', 'UCT1021', '3', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(29, 'UCT1002', '1', 'UCT1021', '4', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(30, 'UCT1001', '0.5', 'UCT1021', '5', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(31, 'UCT99999', '0.5', 'UCT1021', '6', 'credit', 'Savings Income', '2024-06-29 07:04:49'),
(32, 'UCT1012', '5', 'UCT1019', '1', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(33, 'UCT1008', '1', 'UCT1019', '2', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(34, 'UCT1003', '1', 'UCT1019', '3', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(35, 'UCT1002', '1', 'UCT1019', '4', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(36, 'UCT1001', '0.5', 'UCT1019', '5', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(37, 'UCT99999', '0.5', 'UCT1019', '6', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(38, 'UCT1012', '5', 'UCT1017', '1', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(39, 'UCT1008', '1', 'UCT1017', '2', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(40, 'UCT1003', '1', 'UCT1017', '3', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(41, 'UCT1002', '1', 'UCT1017', '4', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(42, 'UCT1001', '0.5', 'UCT1017', '5', 'credit', 'Savings Income', '2024-06-29 07:04:51'),
(43, 'UCT99999', '0.5', 'UCT1017', '6', 'credit', 'Savings Income', '2024-06-29 07:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `savingstravelpoints`
--

CREATE TABLE `savingstravelpoints` (
  `st_id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `st_points` varchar(100) DEFAULT NULL,
  `st_action` varchar(100) DEFAULT NULL,
  `st_bonusfrom` varchar(100) DEFAULT NULL,
  `st_remark` varchar(100) DEFAULT NULL,
  `st_createdat` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savingstravelpoints`
--

INSERT INTO `savingstravelpoints` (`st_id`, `user_id`, `st_points`, `st_action`, `st_bonusfrom`, `st_remark`, `st_createdat`) VALUES
(1, 'UCT1001', '55', 'credit', 'UCT1001', 'Savings Travel Points', '2024-05-07 09:39:23'),
(2, 'UCT1002', '55', 'credit', 'UCT1002', 'Savings Travel Points', '2024-05-07 09:47:45'),
(3, 'UCT1003', '55', 'credit', 'UCT1003', 'Savings Travel Points', '2024-05-07 09:51:45'),
(4, 'UCT1022', '240', 'credit', 'admin', 'Savings Travel Points', '2024-05-28 07:48:47'),
(5, 'UCT1023', '240', 'credit', 'admin', 'Savings Travel Points', '2024-05-28 07:49:43'),
(6, 'UCT1021', '240', 'credit', 'admin', 'Savings Travel Points', '2024-05-28 07:50:02'),
(7, 'UCT1019', '240', 'credit', 'admin', 'Savings Travel Points', '2024-05-28 07:50:22'),
(8, 'UCT1017', '240', 'credit', 'admin', 'Savings Travel Points', '2024-05-28 07:50:35'),
(9, 'UCT1012', '240', 'credit', 'admin', 'Savings Travel Points', '2024-05-28 07:50:51'),
(10, 'UCT1023', '55', 'credit', 'UCT1023', 'Savings Travel Points', '2024-05-29 11:12:08'),
(11, 'UCT1022', '55', 'credit', 'UCT1022', 'Savings Travel Points', '2024-05-29 11:12:50'),
(12, 'UCT1021', '55', 'credit', 'UCT1021', 'Savings Travel Points', '2024-05-29 11:13:44'),
(13, 'UCT1019', '55', 'credit', 'UCT1019', 'Savings Travel Points', '2024-05-29 11:13:46'),
(14, 'UCT1017', '55', 'credit', 'UCT1017', 'Savings Travel Points', '2024-05-29 16:41:48'),
(15, 'UCT1002', '5', 'credit', 'Transferred From UCT1003', 'transfer', '2024-06-06 10:14:58'),
(16, 'UCT1003', '5', 'debit', 'Transferred for UCT1002', 'transfer', '2024-06-06 10:14:58'),
(17, 'UCT1003', '55', 'credit', 'UCT1003', 'Savings Travel Points', '2024-06-10 03:23:39'),
(18, 'UCT1002', '55', 'credit', 'UCT1002', 'Savings Travel Points', '2024-06-26 10:19:29'),
(19, 'UCT1023', '55', 'credit', 'UCT1023', 'Savings Travel Points', '2024-06-29 07:04:47'),
(20, 'UCT1022', '55', 'credit', 'UCT1022', 'Savings Travel Points', '2024-06-29 07:04:49'),
(21, 'UCT1021', '55', 'credit', 'UCT1021', 'Savings Travel Points', '2024-06-29 07:04:49'),
(22, 'UCT1019', '55', 'credit', 'UCT1019', 'Savings Travel Points', '2024-06-29 07:04:51'),
(23, 'UCT1017', '55', 'credit', 'UCT1017', 'Savings Travel Points', '2024-06-29 07:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `tourbookinghistory`
--

CREATE TABLE `tourbookinghistory` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_id` varchar(100) NOT NULL,
  `booking_destination` varchar(100) NOT NULL,
  `booking_code` varchar(100) NOT NULL,
  `booking_person` varchar(100) NOT NULL,
  `booking_amount` varchar(100) NOT NULL,
  `booking_fromdate` varchar(100) NOT NULL,
  `booking_todate` varchar(100) NOT NULL,
  `paymentmethod_description` varchar(200) NOT NULL,
  `gst_amount` varchar(100) NOT NULL,
  `net_amount` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tourdestination`
--

CREATE TABLE `tourdestination` (
  `id` int(11) NOT NULL,
  `tour_thumbnail` varchar(100) NOT NULL,
  `tour_image1` varchar(100) NOT NULL,
  `tour_image2` varchar(100) NOT NULL,
  `tour_image3` varchar(100) NOT NULL,
  `tour_image4` varchar(100) NOT NULL,
  `tour_image5` varchar(100) NOT NULL,
  `tour_name` varchar(100) NOT NULL,
  `tour_bookingcode` varchar(100) NOT NULL,
  `tour_days` varchar(100) NOT NULL,
  `tour_fromdate` varchar(100) NOT NULL,
  `tour_todate` varchar(100) NOT NULL,
  `tour_amount` varchar(100) NOT NULL,
  `tour_daysplan` varchar(10000) NOT NULL,
  `tour_inclusion` varchar(1000) NOT NULL,
  `tour_exclusion` varchar(1000) NOT NULL,
  `tour_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `travelcouponpoints`
--

CREATE TABLE `travelcouponpoints` (
  `tc_id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `tc_points` varchar(30) DEFAULT NULL,
  `tc_action` varchar(30) DEFAULT NULL,
  `tc_remark` varchar(100) DEFAULT NULL,
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
(16, 'UCT1010', '50', 'credit', 'Travel Coupon', '2024-05-21 02:34:06'),
(17, 'UCT1030', '50', 'credit', 'Travel Coupon', '2024-05-29 09:35:48'),
(18, 'UCT1035', '50', 'credit', 'Travel Coupon', '2024-06-03 11:29:48'),
(19, 'UCT1036', '50', 'credit', 'Travel Coupon', '2024-06-04 08:24:36'),
(20, 'UCT1018', '50', 'credit', 'Travel Coupon', '2024-06-05 03:48:14'),
(21, 'UCT1033', '50', 'credit', 'Travel Coupon', '2024-06-05 03:54:09'),
(22, 'UCT1039', '50', 'credit', 'Travel Coupon', '2024-06-08 04:14:50'),
(23, 'UCT1040', '50', 'credit', 'Travel Coupon', '2024-06-08 08:50:33'),
(24, 'UCT1041', '50', 'credit', 'Travel Coupon', '2024-06-12 10:03:22'),
(25, 'UCT1042', '50', 'credit', 'Travel Coupon', '2024-06-12 12:27:46'),
(26, 'UCT1044', '50', 'credit', 'Travel Coupon', '2024-06-15 13:31:25'),
(27, 'UCT1045', '50', 'credit', 'Travel Coupon', '2024-06-19 08:08:56'),
(28, 'UCT1048', '50', 'credit', 'Travel Coupon', '2024-06-20 10:10:57'),
(29, 'UCT1051', '50', 'credit', 'Travel Coupon', '2024-07-03 12:53:30'),
(30, 'UCT1052', '50', 'credit', 'Travel Coupon', '2024-07-04 05:44:45');

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
(1, '3000');

-- --------------------------------------------------------

--
-- Table structure for table `uccwalletpoints`
--

CREATE TABLE `uccwalletpoints` (
  `uccw_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `uccw_points` varchar(100) NOT NULL,
  `uccw_action` varchar(100) NOT NULL,
  `uccw_remark` varchar(100) NOT NULL,
  `uccw_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `uccwalletpoints`
--

INSERT INTO `uccwalletpoints` (`uccw_id`, `user_id`, `uccw_points`, `uccw_action`, `uccw_remark`, `uccw_createdat`) VALUES
(1, 'UCT1003', '4500.00', 'credit', 'UCC Wallet', '2024-06-03 04:37:04'),
(2, 'UCT1004', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:07:27'),
(3, 'UCT1005', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:07:53'),
(4, 'UCT1007', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:08:10'),
(5, 'UCT1008', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:08:28'),
(6, 'UCT1009', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:08:55'),
(7, 'UCT1013', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:09:52'),
(8, 'UCT1024', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:11:22'),
(9, 'UCT1030', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:12:25'),
(10, 'UCT1035', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:13:24'),
(11, 'UCT1036', '4500.00', 'credit', 'UCC Wallet', '2024-06-05 01:13:46'),
(12, 'UCT1028', '4500', 'credit', 'UCC Wallet', '2024-06-05 03:51:29'),
(13, 'UCT1033', '4500', 'credit', 'UCC Wallet', '2024-06-05 03:54:29'),
(14, 'UCT1045', '3000', 'credit', 'UCC Wallet', '2024-06-25 10:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `userbankdetails`
--

CREATE TABLE `userbankdetails` (
  `id` int(5) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `ac_holdername` varchar(100) DEFAULT NULL,
  `ac_bankname` varchar(100) DEFAULT NULL,
  `ac_number` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `trc20_address` varchar(100) DEFAULT NULL,
  `bep20_address` varchar(100) DEFAULT NULL,
  `otp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userbankdetails`
--

INSERT INTO `userbankdetails` (`id`, `user_id`, `ac_holdername`, `ac_bankname`, `ac_number`, `ifsc_code`, `branch`, `trc20_address`, `bep20_address`, `otp`) VALUES
(1, 'UCT1003', 'BALAKRISHNAN P', 'STATE BANK OF INDIA', '33954688098', 'SBIN0018402', 'KONGANAPURAM', 'TE7E8gMA8myKGYUUvxyZEhtJzkQyqHPAMa', '0x0e5fDeD11073B688a09c3960f7240a1D38C92Ec7', NULL),
(2, 'UCT99999', 'aa123456789', 'aa123456789', 'aa123456789', 'aa123456789', 'aa123456789', 'TE7E8gMA8myKGYUUvxyZEhtJzkQyqHPAMa', '0x0e5fDeD11073B688a09c3960f7240a1D38C92Ec7', '803199'),
(3, 'UCT1002', NULL, NULL, NULL, NULL, NULL, '', 'G', NULL),
(4, 'UCT1004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '482518'),
(5, 'uct1011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '583694');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) DEFAULT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_fathername` varchar(20) DEFAULT NULL,
  `user_gender` varchar(20) DEFAULT NULL,
  `user_profileimg` varchar(255) DEFAULT NULL,
  `user_dob` varchar(10) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
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
(1, 'UCT99999', '9283a03246ef2dacdc21a9b137817ec1', 'UCCASH TOURISM', 'TOURISM', NULL, '20240510022347_INDIPENDENT DISTRIBUTOR.png', NULL, 'uccashbala@gmail.com', '+918883687758', NULL, NULL, NULL, 'Konganapuram', 'Salem', '637102', 'Tamilnadu', 'India', 'admin', 'activated', '2024-05-07 09:21:43', '2024-06-08 09:22:50'),
(2, 'UCT1001', '1c2959c174c03bee51f726cdcdf34dc7', 'SARASWATHI P', NULL, NULL, NULL, NULL, 'myvgsaraswathi@gmail.com', '+918883687758', NULL, NULL, NULL, '2 140A, PANDARANGADU, KONASAMUDRAM PO,  EDAPPADI TK,  SALEM DT,', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT99999', 'activated', '2024-05-07 09:34:54', '2024-06-08 09:23:01'),
(3, 'UCT1002', '1c2959c174c03bee51f726cdcdf34dc7', 'BALAKRISHNAN P', NULL, 'male', '20240510022859_bill_image_413460_1629269700353.jpg', NULL, 'uccashbala@gmail.com', '+919842434284', NULL, NULL, NULL, '2 140A, PANDARANGADU, KONASAMUDRAM PO,  EDAPPADI TK,  SALEM DT,', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT1001', 'activated', '2024-05-07 09:44:31', '2024-06-08 09:23:12'),
(4, 'UCT1003', '1c2959c174c03bee51f726cdcdf34dc7', 'ADMIN', 'ADMIN', 'male', NULL, '1984-04-10', 'uccashtourism@gmail.com', '+918124779993', '986264407489', 'ATPPB3908E', 'unmarried', '2 140A, PANDARANGADU, KONASAMUDRAM PO,  EDAPPADI TK,  SALEM DT,', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT1002', 'activated', '2024-05-07 09:50:01', '2024-07-06 07:55:00'),
(5, 'UCT1004', '728d91e1c5cbd3844efbc119bd2b90f9', 'P MURUGAN', 'Ponnusamy', 'male', NULL, '1968-03-23', 'myvgmurugan@gmail.com', '+918940017939', '537127052582', 'ATIPM5882B', 'married', 'Salem', 'Salem', '636004', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-07 12:55:27', '2024-07-06 07:55:07'),
(6, 'UCT1005', '802a3057a750b677ae066288213042fd', 'S VANAROJA', NULL, NULL, NULL, NULL, 'vanaroja2787@gmail.com', '+919486341457', NULL, NULL, NULL, 'Pappireddypatti', 'Harur', '636905', 'Tamil Nadu', 'India', 'UCT1004', 'activated', '2024-05-08 14:33:27', '2024-06-08 09:23:22'),
(7, 'UCT1006', '0dc47388bf9190d0073a57396233a8ca', 'Sudhakaran c', NULL, NULL, NULL, NULL, 'flytravelnetwork@gmail.com', '+919943057743', NULL, NULL, NULL, '1/162  NORTH STREET KALINGAMUDAIYANPATTY PO THURAIYUR TK TRICHY DT ', 'Tiruchirapalli', '621008', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-08 15:16:48', '2024-06-08 09:23:42'),
(8, 'UCT1007', '47ca971597b14e9b3b11058666f323aa', 'Perumal E', NULL, NULL, NULL, NULL, 'perumalperumal1983@gmail.com', '+919715529302', NULL, NULL, NULL, 'Ellappan kadu, Konasamudram Post, Edappadi TK ', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-08 15:22:42', '2024-06-08 09:24:02'),
(9, 'UCT1008', 'f5b4d3ce781deba17b07c28c9c58cf8e', 'KUMARAVEL. K', NULL, NULL, NULL, NULL, 'kumaravelpmvy369@gmail.com', '+919786322532', NULL, NULL, NULL, '8/70, Samudram, Idappadi', 'Salem', '636306', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-08 16:48:19', '2024-06-08 09:24:21'),
(10, 'UCT1009', '7aa0c32c6b7ff07264ba0e3d02262475', 'S. Meganathan', NULL, 'male', NULL, '', 'megansemmalai@gmail.com', '+919952474033', '', '', 'married', 'Dadapuram post\nV. Valasai via\nEdappadi tk\nSalem Dt\n', 'Edappadi', '637105', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-09 05:46:40', '2024-07-06 07:55:12'),
(11, 'UCT1010', 'e914e89ae6945bab0286af214d2ede0d', 'Vignesh Kumar K', NULL, NULL, NULL, NULL, 'vignesh123rb@gmail.com', '+918220402013', NULL, NULL, NULL, 'Konganaburam ', 'Salem', '637102', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-14 03:41:41', '2024-05-21 02:34:06'),
(12, 'UCT1011', 'a5ce312092aa0e2befdacfe783decae4', 'Gowtham J', NULL, NULL, NULL, NULL, 'gowthamjayaram333@gmail.com', '+919360248850', NULL, NULL, NULL, 'Chinnasalem', 'Kallakurichi', '606201', 'Tamil Nadu', 'India', 'UCT99999', 'notactivated', '2024-05-14 07:27:08', '2024-05-14 07:27:08'),
(13, 'UCT1012', '6e842b87a9490c4cf4210f849a1dd23c', 'K. Moorthy', NULL, NULL, NULL, NULL, 'kdm1468@gmail.com', '+919442333942', NULL, NULL, NULL, 'Mettur, Metturdam-1', 'Mettur', '636401', 'Tamil Nadu', 'India', 'UCT1008', 'activated', '2024-05-14 08:06:26', '2024-05-14 08:11:49'),
(14, 'UCT1013', 'dd8403cbcde0ed28862c5613cb204519', 'Arangarasan K', NULL, NULL, NULL, NULL, 'arangarasan70@gmail.com', '+918903563505', NULL, NULL, NULL, '314 4th street\nPhilomina nagar\nThanjavur 613006', 'Thanjavur', '613006', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-14 13:16:59', '2024-05-19 03:19:24'),
(15, 'UCT1014', '40fd12adc082ce920ce4957d1b4b83ee', 'JayaguruPandian', NULL, NULL, NULL, NULL, 'jayagurupandian@gmail.com', '+919700242534', NULL, NULL, NULL, '1/7 north street S chennampatti sembarani peraiyur tk', 'Madurai', '625527', 'Tamil Nadu', 'India', 'UCT1003', 'notactivated', '2024-05-16 07:22:30', '2024-05-16 07:22:30'),
(16, 'UCT1015', '7d893a09205df85fe74bddffe65e631d', 'NEWRAJA S', NULL, NULL, NULL, NULL, 'new_raja87@yahoo.com', '+919751417940', NULL, NULL, NULL, 'No.1/198, Middle Street, Kiliyur & Post, Ulundurpet Taluk, Kallakurichi Dist, Tamil Nadu - 606102', 'KALLAKURICHI', '606102', 'Tamil Nadu', 'India', 'UCT1003', 'notactivated', '2024-05-16 14:43:34', '2024-05-16 14:43:34'),
(17, 'UCT1016', '7cd10234c08b330274efbbd2f440412d', 'C.Sangilimuthan', NULL, NULL, NULL, NULL, 'csmuthu25@gmail.com', '+918870504047', NULL, NULL, NULL, 'Irumpalai,Salem_13', 'Salem', '631613', 'Tamil Nadu', 'India', 'UCT1008', 'activated', '2024-05-17 05:11:45', '2024-05-20 08:16:47'),
(18, 'UCT1017', '83df6abab1b9d233722ff14492b4f82a', 'SANTHI. N', NULL, NULL, NULL, NULL, 'nsanthiteacher@gmail.com', '+918838371795', NULL, NULL, NULL, 'Mettur, Metturdam', 'Mettur', '636401', 'Tamil Nadu', 'India', 'UCT1012', 'notactivated', '2024-05-17 08:57:16', '2024-05-17 08:57:16'),
(19, 'UCT1018', '2942f63d949da4a48ed538801c67e653', 'SURESH', NULL, NULL, NULL, NULL, 'lifeisgateway@gmail.com', '+919894603344', NULL, NULL, NULL, 'No.1.Mp.towers  \nTHIRU VI KA ROAD\n Muncipal colony', 'Erode', '638004', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-17 10:43:05', '2024-06-05 03:48:14'),
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
(30, 'UCT1029', '9f1531cd04c3430d969e66232eeefe88', 'Muthu P', NULL, NULL, NULL, NULL, 'muthu8919@gmail.com', '+919092847744', NULL, NULL, NULL, 'D.no 3/44,komalikadu, koranampatti, Edappadi, Salem ', 'Salem ', '637102', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-20 14:23:05', '2024-05-20 14:25:02'),
(31, 'UCT1030', 'e4f1305a79dfe02020964940339e53d8', 'A.K MOHANAMBAL', NULL, NULL, NULL, NULL, 'akmohanambal@gmail.com', '+918870005963', NULL, NULL, NULL, 'Salem', 'Salem', '636007', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-29 09:22:22', '2024-05-29 09:35:48'),
(32, 'UCT1031', '8601d06e3552dbb32d298dd658c13886', 'Selvam. P', NULL, NULL, NULL, NULL, 'selvampalanisamy1981@gmail.com', '+917010019947', NULL, NULL, NULL, 'Tharamangalam, salem', 'Salem', '636502', 'Tamil Nadu', 'India', 'UCT1016', 'notactivated', '2024-05-29 09:50:06', '2024-05-29 09:50:06'),
(33, 'UCT1032', 'f8f19eac4807b8ebebfb500710667431', 'Vijayakumar M', NULL, NULL, NULL, NULL, 'mvijayakumar241@gmail.com', '+916381385073', NULL, NULL, NULL, 'Karthikkanakanur Vembaneri (Po), Edappadi (Tk)', 'SALEM ', '637105', 'Tamil Nadu', 'India', 'UCT1024', 'notactivated', '2024-05-29 13:52:08', '2024-05-29 13:52:08'),
(34, 'UCT1033', 'dd7d59983018404266fcc4e0962442e7', 'N P THIYAKU', NULL, NULL, NULL, NULL, 'kpthiyagarajan2014@gmail.com', '+918903934955', NULL, NULL, NULL, 'Kolli hills', 'Namakkal', '637411', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-05-31 10:06:16', '2024-06-05 03:54:09'),
(35, 'UCT1034', '1c4b6a0d19ca206565293890d0dc56e7', 'R.saravanan', NULL, NULL, NULL, NULL, 'xrprajsaravanan@gmail.com', '+919940715817', NULL, NULL, NULL, 'Gugai salem', 'Salem', '636006', 'Tamil Nadu', 'India', 'UCT1008', 'notactivated', '2024-06-02 07:09:21', '2024-06-02 07:09:21'),
(36, 'UCT1035', 'd1bd4787a8065f272d822cbc1be7481c', 'R SHIVAPRASAD ', NULL, NULL, NULL, NULL, 'uccashshivaprasad@gmail.com', '+919543316266', NULL, NULL, NULL, 'Shantinagar 4th cross\nOpp Raghvendra theatre \nHosur', 'Hosur ', '635109', 'Tamil Nadu', 'India', 'UCT1004', 'activated', '2024-06-03 07:33:03', '2024-06-03 11:29:48'),
(37, 'UCT1036', '1b9ccb909f2f886c6d1c0315ae1d60af', 'RK ELANGOVAN', NULL, NULL, NULL, NULL, 'elongo19prasath@gmail.com', '+919025498468', NULL, NULL, NULL, 'Vellur', 'Vellur', '638282', 'Tamil Nadu', 'India', 'UCT1004', 'activated', '2024-06-04 08:09:07', '2024-06-04 08:24:36'),
(38, 'UCT1037', '6cc819538ea19d66caf998694c9a36b2', 'Chidambaram. S', NULL, NULL, NULL, NULL, 'chidambaramedp@gmail.com', '+919025493248', NULL, NULL, NULL, 'No 4/1 Dadapuram po.  Idappadi tk  ', 'Salem ', '637105', 'Tamil Nadu', 'India', 'UCT1024', 'notactivated', '2024-06-05 08:16:15', '2024-06-05 08:16:15'),
(39, 'UCT1038', '8907fc2282ea176b029fd7819a83dc2f', 'G Sivakumar', NULL, NULL, NULL, NULL, 'gsivakumar081@gmail.com', '+919443203506', NULL, NULL, NULL, 'Tharamagalam', 'Salem ', '636502', 'Tamil Nadu', 'India', 'UCT1024', 'notactivated', '2024-06-05 11:00:53', '2024-06-05 11:00:53'),
(40, 'UCT1039', '6dfa7010ed9b5f00ea056f99da36e5b1', 'G SUBRAMANI ', NULL, NULL, NULL, NULL, 'manothavan60@gmail.com', '+916381139992', NULL, NULL, NULL, 'Jalakandapuram', 'Salem', '636501', 'Tamil Nadu', 'India', 'UCT1028', 'activated', '2024-06-06 08:33:03', '2024-06-08 04:14:50'),
(41, 'UCT1040', '4713ab18dcc12bedecfccd39f5bd6d48', 'Saravanan ', NULL, NULL, NULL, NULL, 'ammanbuilder105@gmail.com', '+918608370770', NULL, NULL, NULL, '11/15,sathiyamoorthistreet ', 'Salem ', '636001', 'Tamil Nadu', 'India', 'UCT1039', 'activated', '2024-06-08 06:27:23', '2024-06-08 08:50:33'),
(42, 'UCT1041', '47835f0ed406787d34f80793596270e3', 'Sribharath R M', NULL, NULL, NULL, NULL, 'sribharathmech11@gmail.com', '+917871035155', NULL, NULL, NULL, 'M264, Watertank Stop\nKootapalli Colony, Tiruchengode', 'Namakkal', '637214', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-06-12 09:48:29', '2024-06-12 10:03:22'),
(43, 'UCT1042', '3f368470cf3c40dd6198f86cb7aaa34c', 'Deena Dayalan S', NULL, NULL, NULL, NULL, 'gsdayaalan@gmail.com', '+918870961414', NULL, NULL, NULL, '3 Eagle Garden, Nasiyanoor Road \n', 'Erode', '638012', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-06-12 12:21:47', '2024-06-12 12:27:46'),
(44, 'UCT1043', '22f94dca518bb86c109dd3c937693865', 'A P ARUL KUMARESAN', NULL, NULL, NULL, NULL, 'solarngl@gmail.com', '+919443607174', NULL, NULL, NULL, '14,MELATHERU KARAI,\nKRISHNANCOIL POST,\nNAGERCOIL ', 'NAGERCOIL ', '629001', 'Tamil Nadu', 'India', 'UCT1013', 'notactivated', '2024-06-14 06:34:02', '2024-06-14 06:34:02'),
(45, 'UCT1044', '80ccfee07deac0fa1f5bf7c0537674f0', 'Mahizhvathani M', NULL, NULL, NULL, NULL, 'epxmeganathans@gmail.com', '+919788418804', NULL, NULL, NULL, 'Dadapuram ', 'Edappadi', '637105', 'Tamil Nadu', 'India', 'UCT1009', 'activated', '2024-06-15 13:21:14', '2024-06-15 13:31:25'),
(46, 'UCT1045', '02f0aa101624cae6369113e8d09c1207', 'Karthikeyan', NULL, NULL, NULL, NULL, 'rkarthikeyan1990@gmail.com', '+918248279944', NULL, NULL, NULL, '6-10a,new street line,\nJalakandapuram main road,\nTharamangalam,\nSalem DT \n', 'Salem', '636502', 'Tamil Nadu', 'India', 'UCT1008', 'activated', '2024-06-19 07:53:15', '2024-06-19 08:08:56'),
(47, 'UCT1046', '1ef9c5132cae9d1bc6481fc574f7cde5', 'M Senthoorika', NULL, NULL, NULL, NULL, 'epxmeganathan@gmail.com', '+919655161237', NULL, NULL, NULL, 'Dadapuram ', 'Edappadi', '637105', 'Tamil Nadu', 'India', 'UCT1009', 'notactivated', '2024-06-19 10:33:30', '2024-06-19 10:33:30'),
(48, 'UCT1047', '7730797821a017b1d96c032ee523649d', 'R. RAJESH', NULL, NULL, NULL, NULL, 'rajgland1978@gmail.com', '+919566550988', NULL, NULL, NULL, 'Coimbatore', 'COIMBATORE', '641030', 'Tamil Nadu', 'India', 'UCT1016', 'notactivated', '2024-06-20 07:23:48', '2024-06-20 07:23:48'),
(49, 'UCT1048', '04fe8aa9c027644e1ba1afe39e2e4543', 'SUBRAMANIAN A A', NULL, NULL, NULL, NULL, 'wealthcircle@gmail.com', '+919366655524', NULL, NULL, NULL, 'POLLACHI', 'COIMBATORE', '642002', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-06-20 10:09:14', '2024-06-20 10:10:57'),
(50, 'UCT1049', '31a5a59ed9143eda4049f378a5277901', 'C.Murugan', NULL, NULL, NULL, NULL, 'Muruugachina@gmail.com', '+918438496603', NULL, NULL, NULL, 'North Street, Puthur, Thalaivasal ,Salem (Dt)', 'Salem', '636112', 'Tamil Nadu', 'India', 'UCT1044', 'notactivated', '2024-06-21 08:29:14', '2024-06-21 08:29:14'),
(51, 'UCT1050', 'b45e257164225d4e3a9d3b9ae112268e', 'KUPPUSAMY R', NULL, NULL, NULL, NULL, 'kuppussmskuppus@gmail.com', '+918220543722', NULL, NULL, NULL, 'salem', 'salem', '636004', 'Tamil Nadu', 'India', 'UCT1040', 'notactivated', '2024-06-29 07:34:06', '2024-06-29 07:34:06'),
(52, 'UCT1051', '5e0907430c739f9a9b87338172b96f10', 'Johnson', NULL, NULL, NULL, NULL, 'johnsonmejo@gmail.com', '+918946053081', NULL, NULL, NULL, 'Ggj', 'Chennai', '6000041', 'Tamil Nadu', 'India', 'UCT1003', 'activated', '2024-07-03 10:19:54', '2024-07-03 12:53:30'),
(53, 'UCT1052', 'd35a1a3557a87ce118f1c009f92efeaf', 'Murugesan', NULL, NULL, NULL, NULL, 'murugesanjj85@gmail.com', '+919047399999', NULL, NULL, NULL, 'Chettiyapatti vadavalam (po)                  pudukkottai (dt) 622004', 'Pudukkottai', '622004', 'Tamil Nadu', 'India', 'UCT1051', 'activated', '2024-07-03 14:51:21', '2024-07-04 05:44:45'),
(54, 'UCT1053', 'ef74a8b8b9f7c4405ac53c70dbd416f3', 'Divya Mohanrja ', NULL, NULL, NULL, NULL, 'divyababu.c123@gmail.com', '+919629659470', NULL, NULL, NULL, '783615283201', 'Salem', '63063', 'Tamil Nadu', 'India', 'UCT1008', 'notactivated', '2024-07-05 05:15:38', '2024-07-05 05:15:38'),
(55, 'UCT1054', '4f27d90779872f440fc44bb28cb6930f', 'Dwarakesh Mohan', NULL, NULL, NULL, NULL, 'sizzlersbbo@gmail.com', '+919884723009', NULL, NULL, NULL, 'No 25A kk nagar Chennai ', 'Chennai', '600078', 'Tamil Nadu', 'India', 'UCT1003', 'notactivated', '2024-07-05 18:41:27', '2024-07-05 18:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawhistory`
--

CREATE TABLE `withdrawhistory` (
  `id` int(11) NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `withdraw_amount` varchar(50) NOT NULL,
  `admin_fees` varchar(50) NOT NULL,
  `retopup_fees` varchar(50) NOT NULL,
  `net_amount` varchar(50) NOT NULL,
  `to_withdraw` varchar(500) NOT NULL,
  `txn_id` varchar(500) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `withdrawhistory`
--

INSERT INTO `withdrawhistory` (`id`, `paid_date`, `user_id`, `payment_method`, `withdraw_amount`, `admin_fees`, `retopup_fees`, `net_amount`, `to_withdraw`, `txn_id`, `remark`, `action`) VALUES
(1, '2024-06-02 15:30:43', 'UCT1003', 'Crypto', '50.00', '2.50', '2.50', '45.00', 'TE7E8gMA8myKGYUUvxyZEhtJzkQyqHPAMa', '369369369', 'Successfully Withdrawed', 'paid'),
(2, '2024-06-22 01:19:35', 'UCT1003', 'Bank', '10', '0.50', '0.50', '9.00', 'BALAKRISHNAN P,<br>STATE BANK OF INDIA,<br>33954688098,<br>SBIN0018402,<br>KONGANAPURAM', 'reject', 'Test', 'reject');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindetails`
--
ALTER TABLE `admindetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admingst_wallet`
--
ALTER TABLE `admingst_wallet`
  ADD PRIMARY KEY (`agst_id`);

--
-- Indexes for table `admin_wallet`
--
ALTER TABLE `admin_wallet`
  ADD PRIMARY KEY (`aw_id`);

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
-- Indexes for table `invoiceprocess`
--
ALTER TABLE `invoiceprocess`
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
-- Indexes for table `rankboardaward`
--
ALTER TABLE `rankboardaward`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tourbookinghistory`
--
ALTER TABLE `tourbookinghistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourdestination`
--
ALTER TABLE `tourdestination`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `uccwalletpoints`
--
ALTER TABLE `uccwalletpoints`
  ADD PRIMARY KEY (`uccw_id`);

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
-- Indexes for table `withdrawhistory`
--
ALTER TABLE `withdrawhistory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindetails`
--
ALTER TABLE `admindetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admingst_wallet`
--
ALTER TABLE `admingst_wallet`
  MODIFY `agst_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_wallet`
--
ALTER TABLE `admin_wallet`
  MODIFY `aw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `availablewithdrwabalance`
--
ALTER TABLE `availablewithdrwabalance`
  MODIFY `awb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bonustravelpoints`
--
ALTER TABLE `bonustravelpoints`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `carandhousefundwallet`
--
ALTER TABLE `carandhousefundwallet`
  MODIFY `chfw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `flashbanner`
--
ALTER TABLE `flashbanner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forgetpassword`
--
ALTER TABLE `forgetpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galleryimages`
--
ALTER TABLE `galleryimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `genealogy`
--
ALTER TABLE `genealogy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `idactivation`
--
ALTER TABLE `idactivation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `idactivationdeposite`
--
ALTER TABLE `idactivationdeposite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `idactivationhistory`
--
ALTER TABLE `idactivationhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `idactivationvalue`
--
ALTER TABLE `idactivationvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoiceprocess`
--
ALTER TABLE `invoiceprocess`
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
  MODIFY `liw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `monthlysavingpendinginvoice`
--
ALTER TABLE `monthlysavingpendinginvoice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `monthlytpsavinghistory`
--
ALTER TABLE `monthlytpsavinghistory`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `networkingincomewallet`
--
ALTER TABLE `networkingincomewallet`
  MODIFY `niw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `rankboardaward`
--
ALTER TABLE `rankboardaward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `royaltyincomewallet`
--
ALTER TABLE `royaltyincomewallet`
  MODIFY `riw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `savingsincome`
--
ALTER TABLE `savingsincome`
  MODIFY `si_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `savingstravelpoints`
--
ALTER TABLE `savingstravelpoints`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tourbookinghistory`
--
ALTER TABLE `tourbookinghistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tourdestination`
--
ALTER TABLE `tourdestination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `travelcouponpoints`
--
ALTER TABLE `travelcouponpoints`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `uccvalue`
--
ALTER TABLE `uccvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uccwalletpoints`
--
ALTER TABLE `uccwalletpoints`
  MODIFY `uccw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `userbankdetails`
--
ALTER TABLE `userbankdetails`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `withdrawhistory`
--
ALTER TABLE `withdrawhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
