-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 03:35 PM
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
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_image` text NOT NULL DEFAULT '1.png',
  `admin_type` int(11) NOT NULL DEFAULT 1,
  `admin_email` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL,
  `admin_phon` int(11) NOT NULL,
  `admin_state` int(2) NOT NULL DEFAULT 1,
  `dateAdded` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_image`, `admin_type`, `admin_email`, `admin_password`, `admin_phon`, `admin_state`, `dateAdded`) VALUES
(1, 'admin', '1.png', 1, 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', 0, 1, '2022-09-13'),
(2, 'rasheedo', '1.png', 1, 'aaa@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 1, '2022-09-13'),
(3, 'aaaa', '1.png', 1, 'aaaaa', 'aaaaa', 0, 1, '2022-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `bunch`
--

CREATE TABLE `bunch` (
  `bunch_ID` int(10) NOT NULL,
  `bunch_form_name` varchar(100) NOT NULL,
  `bunch_form_pro_count` int(10) NOT NULL,
  `bunch_form_price` int(11) NOT NULL,
  `bunch_form_about` text DEFAULT NULL,
  `bunch_form_status` int(11) NOT NULL DEFAULT 1,
  `bunch_form_date_updata` varchar(120) NOT NULL DEFAULT current_timestamp(),
  `bunch_form_date_add` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `bunch_form_department` varchar(100) NOT NULL DEFAULT 'باقات عامة'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bunch`
--

INSERT INTO `bunch` (`bunch_ID`, `bunch_form_name`, `bunch_form_pro_count`, `bunch_form_price`, `bunch_form_about`, `bunch_form_status`, `bunch_form_date_updata`, `bunch_form_date_add`, `bunch_form_department`) VALUES
(1, '50 منتج', 50, 222, '', 1, '2024-02-21 22:43:17', '2024-02-21 21:33:56', 'باقات عامة'),
(2, '100 منتج', 100, 0, '', 1, '2024-03-27 15:44:41', '2024-02-21 21:33:56', '78'),
(3, '150 منتج', 150, 1500, '', 1, '2024-02-22 20:24:57', '2024-02-21 21:33:56', 'باقات عامة'),
(4, '200 منتج', 200, 2500, '', 1, '2024-02-21 22:44:34', '2024-02-21 21:33:56', 'باقات عامة');

-- --------------------------------------------------------

--
-- Table structure for table `bunch_com`
--

CREATE TABLE `bunch_com` (
  `id_bunch_com` int(10) NOT NULL,
  `com_id` int(10) NOT NULL,
  `date_subs` datetime NOT NULL DEFAULT current_timestamp(),
  `bunch_com_status` int(11) NOT NULL DEFAULT 0,
  `bunch_name_com` varchar(30) NOT NULL,
  `pro_count_com` int(11) NOT NULL,
  `bunch_com_price` int(11) NOT NULL,
  `bunch_com_about` text NOT NULL,
  `bunch_com_depatr` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bunch_com`
--

INSERT INTO `bunch_com` (`id_bunch_com`, `com_id`, `date_subs`, `bunch_com_status`, `bunch_name_com`, `pro_count_com`, `bunch_com_price`, `bunch_com_about`, `bunch_com_depatr`) VALUES
(20, 74, '2024-02-18 00:04:14', 1, '150 منتج', 150, 1500, '', ''),
(21, 74, '2024-02-18 00:04:25', 2, '200 منتج', 200, 0, '', ''),
(22, 74, '2024-02-18 00:20:27', 1, '100 منتج', 100, 0, '', ''),
(23, 74, '2024-02-18 00:22:07', 1, '100 منتج', 100, 0, 'zzzzzzzzzzzzzzzz', ''),
(68, 74, '2024-02-27 12:05:44', 1, '50 منتج', 50, 222, '', 'باقات عامة'),
(69, 74, '2024-03-04 20:00:28', 2, '50 منتج', 50, 222, '', 'باقات عامة'),
(70, 74, '2024-03-04 20:08:12', 1, '50 منتج', 50, 222, '', 'باقات عامة'),
(71, 77, '2024-03-04 21:40:53', 1, '50 منتج', 50, 222, '', NULL),
(72, 77, '2024-03-04 21:41:32', 2, '200 منتج', 200, 2500, '', NULL),
(73, 77, '2024-03-05 20:49:57', 1, '50 منتج', 50, 222, '', 'باقات عامة'),
(74, 74, '2024-05-21 13:11:09', 0, '150 منتج', 150, 1500, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(200) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `state_cat` int(1) NOT NULL DEFAULT 1,
  `cat_image` text NOT NULL DEFAULT '1.png',
  `cat_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `depart_id`, `state_cat`, `cat_image`, `cat_details`) VALUES
(4, 'رجالي', 1, 1, '1.png', ''),
(5, 'نسائي', 1, 1, '1.png', ''),
(6, 'ولادي', 1, 3, '1.png', ''),
(7, 'lg', 2, 3, '1.png', ''),
(8, 'sams', 2, 1, '1.png', ''),
(37, 'بناتي', 1, 1, '1.png', ''),
(38, 'mp3', 2, 1, '1.png', ''),
(39, 'السماعات', 2, 1, '1.png', ''),
(40, 'كاميرات', 2, 1, '1.png', ''),
(41, 'شاشات', 2, 1, '1.png', ''),
(42, ' الكمبيوتر المحمول', 2, 1, '_1713981709.jpg', ''),
(43, 'رجالي', 30, 1, '1.png', ''),
(44, 'نسائي', 30, 1, '1.png', ''),
(45, 'ولادي', 30, 1, '1.png', ''),
(46, 'بناتي', 30, 1, '1.png', ''),
(48, 'حقائب يد', 35, 1, '1.png', ''),
(49, 'حقائب ضهر', 35, 1, '1.png', ''),
(50, 'حقائب كتف', 35, 1, '1.png', ''),
(51, 'عطور', 31, 1, '1.png', ''),
(52, 'ساعات', 31, 1, '1.png', ''),
(53, 'مكياج', 31, 1, '1.png', ''),
(54, 'العناية بالجسم', 36, 1, '1.png', ''),
(55, 'العناية بالشعر', 36, 1, '1.png', ''),
(56, 'العناية بالبشرة', 36, 1, '1.png', ''),
(57, 'مطابخ وغرف الطعام', 4, 1, '1.png', ''),
(58, 'أدوات المطبخ', 4, 1, '1.png', ''),
(59, 'غرف نوم', 37, 1, '1.png', ''),
(60, 'الدواليب وملحقاتها', 37, 1, '1.png', ''),
(61, 'المكتبة والكراسي', 37, 1, '1.png', ''),
(62, 'الطاولات', 37, 1, '1.png', ''),
(63, 'ادوات نظافة منزلية', 38, 1, '1.png', ''),
(64, 'short', 42, 1, '1.png', ''),
(73, '55', 1, 1, '1.png', ''),
(74, '55', 1, 1, '1.png', ''),
(75, '55', 1, 1, '1.png', ''),
(76, '55', 1, 1, '1.png', ''),
(77, '55', 1, 1, '1.png', ''),
(78, '55', 1, 1, '1.png', ''),
(79, 'sss', 1, 1, '1.png', ''),
(80, 'sss', 1, 1, '1.png', ''),
(81, 'اواني العيد', 77, 1, '1.png', ''),
(82, '55', 79, 1, '1.png', ''),
(83, 'سابر', 80, 1, '1.png', ''),
(84, 'اواني العيد', 77, 1, '1.png', ''),
(85, 'ايام عادية', 77, 1, '1.png', ''),
(86, 'اواني رمضان', 77, 1, '1.png', ''),
(87, '55', 79, 1, '1.png', ''),
(88, 'سابر', 80, 1, '1.png', ''),
(89, '877', 1, 1, '1.png', ''),
(90, '877', 30, 1, '1.png', ''),
(91, '45', 1, 1, '1.png', ''),
(92, '3323', 1, 1, '_1714327985.jpg', 'asssssssssssssssss'),
(93, '787', 1, 1, '_1714328130.jpg', '4544444444444444'),
(94, 'wew', 30, 1, '_1714329678.jpg', 'wwwwwwwwwwww'),
(95, '1q', 30, 1, '_1714330666.jpg', '111111111111111'),
(96, '1q', 36, 1, '_1714330715.jpg', '11111111111'),
(97, '778', 1, 1, '_1715630181.jpg', 'خخخخخخخخخخخخخخخخخخخخخخخخخخخ'),
(98, '1ض', 96, 1, '_1714330804.jpg', '111111111'),
(103, 'ggh', 95, 1, '_1714332946.jpg', 'wwwwwwwwwww'),
(104, '112211', 1, 1, '_1716341416.jpg', '1111111111111111111111');

-- --------------------------------------------------------

--
-- Table structure for table `categories_com`
--

CREATE TABLE `categories_com` (
  `id_cat_com` int(11) NOT NULL,
  `cat_id_fk` int(11) NOT NULL DEFAULT 0,
  `id_depart_com_fk` int(11) DEFAULT 0,
  `deprat_id_fk` int(11) DEFAULT 0,
  `com_id_fk` int(11) NOT NULL,
  `name_depart_form` varchar(100) DEFAULT NULL,
  `name_cat_form` varchar(100) DEFAULT NULL,
  `cat_image_com` text NOT NULL DEFAULT '1.png',
  `cat_details_com` text DEFAULT NULL,
  `state_cat_com` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_com`
--

INSERT INTO `categories_com` (`id_cat_com`, `cat_id_fk`, `id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_image_com`, `cat_details_com`, `state_cat_com`) VALUES
(24530, 4, 282, 1, 44, 'الملابس', 'رجالي', '_1714042019.jpg', '54545', 1),
(24531, 5, 282, 1, 44, 'الملابس', 'نسائي', '1.png', '', 2),
(24532, 6, 282, 1, 44, 'الملابس', 'ولادي', '1.png', '', 3),
(24533, 37, 282, 1, 44, 'الملابس', 'بناتي', '1.png', '', 3),
(24535, 44, 283, 96, 44, 'احذية', 'نسائي', '1.png', '', 1),
(24536, 45, 283, 96, 44, 'احذية', 'ولادي', '1.png', '', 1),
(24537, 46, 283, 96, 44, 'احذية', 'بناتي', '1.png', '', 1),
(24542, 73, 282, 1, 44, 'الملابس', '55', '1.png', '', 1),
(24543, 79, 285, 1, 44, 'we', 'sss', '1.png', '', 1),
(24544, 81, 286, 77, 44, 'اواني', 'اواني العيد', '1.png', '', 1),
(24545, 85, 286, 77, 44, 'اواني', 'ايام عادية', '1.png', '', 1),
(24546, 86, 286, 77, 44, 'اواني', 'اواني رمضان', '1.png', '', 1),
(24547, 82, 287, 79, 44, 'بضاعات', '55', '1.png', '', 1),
(24548, 83, 288, 80, 44, 'سمسوم', 'سابر', '1.png', '', 1),
(24549, 89, 282, 1, 44, 'الملابس', '877', '1.png', '', 1),
(24550, 90, 283, 96, 44, 'احذية', '877', '1.png', '', 1),
(24551, 91, 282, 1, 44, 'الملابس', '45', '1.png', '', 1),
(24552, 91, 175, 1, 74, 'الملابس', '45', '1.png', '', 1),
(24553, 92, 175, 1, 74, 'الملابس', '3323', '_1714327985.jpg', 'asssssssssssssssss', 1),
(24554, 93, 175, 1, 74, 'الملابس', '787', '_1714328130.jpg', '4544444444444444', 1),
(24555, 5, 175, 1, 74, 'الملابس', '1121', '_1714328398.jpg', '11111111111111', 1),
(24556, 6, 175, 1, 74, 'الملابس', '566', '_1714329134.jpg', 'as', 1),
(24557, 48, 160, 35, 74, 'حقائب', 'wew', '_1714329284.jpg', 'we', 1),
(24558, 94, 283, 96, 44, 'احذية', 'wew', '_1714329678.jpg', 'wwwwwwwwwwww', 1),
(24559, 95, 283, 96, 44, 'احذية', '1q', '_1714330666.jpg', '111111111111111', 1),
(24560, 96, 159, 36, 74, 'العناية والجمال', '1q', '_1714330715.jpg', '11111111111', 1),
(24561, 98, 155, 96, 74, 'احذية', '1ض', '_1714330804.jpg', '111111111', 1),
(24562, 95, 155, 96, 74, 'احذية', '1q', '_1714330820.jpg', '111', 1),
(24563, 103, 300, 95, 74, 'oop', 'ggh', '_1714332946.jpg', 'wwwwwwwwwww', 1),
(24564, 0, 303, 95, 44, 'oop', 'sssssssssss', '1.png', '', 1),
(24565, 51, 317, 31, 44, 'اكسسوارات', 'عطور', '1.png', '', 1),
(24566, 51, 317, 31, 44, 'اكسسوارات', 'عطور', '1.png', '', 1),
(24567, 51, 317, 31, 44, 'اكسسوارات', 'عطور', '1.png', '', 1),
(24568, 82, 318, 79, 74, 'بضاعات', '55', '1.png', '', 1),
(24569, 82, 318, 79, 74, 'بضاعات', '55', '1.png', '', 1),
(24570, 0, 319, 0, 74, '1212121', '2222222222', '_1714597993.jpg', '111111111123', 1),
(24571, 83, 324, 80, 74, 'سمسوم', 'سابر', '1.png', '', 1),
(24572, 83, 324, 80, 74, 'سمسوم', 'سابر', '1.png', '', 1),
(24573, 0, 175, 1, 74, 'الملابس', '877', '1.png', '', 1),
(24574, 0, 155, 96, 74, 'احذية', '877', '1.png', '', 1),
(24575, 79, 175, 1, 74, 'الملابس', 'sss', '_1716340643.jpg', '', 1),
(24576, 104, 282, 1, 44, 'الملابس', '112211', '_1716341416.jpg', '1111111111111111111111', 1),
(24577, 104, 175, 1, 74, 'الملابس', '112211', '_1716341696.jpg', 'vvvvvvvvvvvvvvvvvvvv', 1),
(45639, 44, 340, 30, 43, 'احذية', 'نسائي', '1.png', '', 1),
(45640, 45, 340, 30, 43, 'احذية', 'ولادي', '1.png', '', 1),
(45641, 46, 340, 30, 43, 'احذية', 'بناتي', '1.png', '', 1),
(45642, 90, 340, 30, 43, 'احذية', '877', '1.png', '', 1),
(45643, 94, 340, 30, 43, 'احذية', 'wew', '_1714329678.jpg', 'wwwwwwwwwwww', 1),
(45644, 95, 340, 30, 43, 'احذية', '1q', '_1714330666.jpg', '111111111111111', 1),
(45645, 4, 341, 1, 43, 'الملابس', 'رجالي', '1.png', '', 1),
(45646, 5, 341, 1, 43, 'الملابس', 'نسائي', '1.png', '', 1),
(45647, 6, 341, 1, 43, 'الملابس', 'ولادي', '1.png', '', 3),
(45648, 37, 341, 1, 43, 'الملابس', 'بناتي', '1.png', '', 1),
(45649, 73, 341, 1, 43, 'الملابس', '55', '1.png', '', 1),
(45650, 74, 341, 1, 43, 'الملابس', '55', '1.png', '', 1),
(45651, 75, 341, 1, 43, 'الملابس', '55', '1.png', '', 1),
(45652, 76, 341, 1, 43, 'الملابس', '55', '1.png', '', 1),
(45653, 77, 341, 1, 43, 'الملابس', '55', '1.png', '', 1),
(45654, 78, 341, 1, 43, 'الملابس', '55', '1.png', '', 1),
(45655, 79, 341, 1, 43, 'الملابس', 'sss', '1.png', '', 1),
(45656, 80, 341, 1, 43, 'الملابس', 'sss', '1.png', '', 1),
(45657, 89, 341, 1, 43, 'الملابس', '877', '1.png', '', 1),
(45658, 91, 341, 1, 43, 'الملابس', '45', '1.png', '', 1),
(45659, 92, 341, 1, 43, 'الملابس', '3323', '_1714327985.jpg', 'asssssssssssssssss', 1),
(45660, 93, 341, 1, 43, 'الملابس', '787', '_1714328130.jpg', '4544444444444444', 1),
(45661, 97, 341, 1, 43, 'الملابس', '778', '_1715630181.jpg', 'خخخخخخخخخخخخخخخخخخخخخخخخخخخ', 1),
(45662, 104, 341, 1, 43, 'الملابس', '112211', '_1716341416.jpg', '1111111111111111111111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `colors_product`
--

CREATE TABLE `colors_product` (
  `id_product_colors` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cod_color` varchar(50) NOT NULL,
  `image_path` text DEFAULT NULL,
  `color_statues` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors_product`
--

INSERT INTO `colors_product` (`id_product_colors`, `product_id`, `cod_color`, `image_path`, `color_statues`) VALUES
(1, 268, '77785', '.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `com_id` int(11) NOT NULL,
  `com_name` varchar(30) NOT NULL,
  `com_phone` varchar(30) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `com_email` varchar(30) NOT NULL,
  `icon` varchar(50) DEFAULT '2.png',
  `com_status` int(11) NOT NULL,
  `comm_Reg` varchar(255) NOT NULL,
  `contract_accept` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modifide` datetime NOT NULL DEFAULT current_timestamp(),
  `location` varchar(1000) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `telegram` varchar(100) NOT NULL,
  `website_company` varchar(300) NOT NULL,
  `instagram` varchar(200) NOT NULL,
  `facebook` varchar(300) NOT NULL,
  `twitter` varchar(300) NOT NULL,
  `linkedin` varchar(300) NOT NULL,
  `about_company` text NOT NULL,
  `messg_comm` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`com_id`, `com_name`, `com_phone`, `city`, `address`, `com_email`, `icon`, `com_status`, `comm_Reg`, `contract_accept`, `date_added`, `date_modifide`, `location`, `whatsapp`, `telegram`, `website_company`, `instagram`, `facebook`, `twitter`, `linkedin`, `about_company`, `messg_comm`) VALUES
(43, 'البلاد مول', '967 736 264', 'Ibb', 'Ibb', 'beladmol@gmail.com', '1661467402_download (3).jfif', 4, '', '1', '2024-02-18 04:48:06', '2024-02-15 21:44:20', '', '', '', 'http://localhost/myporject1/home/', '', '', '', '', ' ', ''),
(44, 'الدعيس مول', '445 654 745', '', '', 'os@gmail.com', '44_1711277860.jpg', 2, '', '', '2024-03-07 19:33:22', '2024-03-24 13:57:40', '', '', '', 'lklk', '', '', '', '', '7787', ''),
(74, 'سيتي ماكس', '775 662 462', 'Ibb', 'مقابل مزايا سنترت', 'city_max@gmail.co', '74_1690500622.jpg', 3, '1663617395_الفورم.pdf', '1663617395_الفورم.pdf', '2022-09-19 22:56:35', '2024-02-14 20:50:31', '111.236.02148785232..254412868797987', 'chat/me/775662462', 'telegram@gmail.com', 'http://localhost/myporject1/home/', 'instgram', 'faicbook@gmail.com', '7548', 'linkedin@gmail.com', 'متجر حلو جدا من قبل كان الناس يذهبو من متجر الى اخر يبحثون عن افضل المنتجات والعروض والاسعار ,ايضاً واجه البائعون العديد من الصعوبات للإعلان عن منتجاتهم وعروضهم، بالاضافة الى صعوبة الوصول الى شريحة اكبر من المتسوقين والقدرة على عرض المنتاجات بسهولة تم إنشاء تسوق كوم لتوفير نظام استعراض المنتجات ومقارنة اسعار المنتجات في المراكز بسهولة وانت في مكانك لاداعي للتنقل من مركز إلى اخر,تسوق كوم متطور وسهل الاستخدام لتقديم الخدمات الالكترونية للسوق اليمني والذي سيمنح تجربة جديدة ومتغييرة في التسويق بالنسبة للمستخدم والبائع', 'heello'),
(75, 'مركز المشرقي', '777855565', 'إب', 'Ibb', 'ccc@gmail.com', '1663715335_المشرقي للمفروشات.jpg', 1, '', '', '2024-02-09 01:15:34', '2022-09-20 21:55:54', '', '', '', 'http://localhost/myporject1/home/', '', '', '', '', '', ''),
(76, 'مول العرب', '757577777455', 'إب', 'شارع تعز', 'abc@gmail.com', '1663716360_yegcn.jpeg', 1, '', '', '2022-09-21 03:07:05', '2022-09-21 02:26:00', '', '', '', 'http://localhost/myporject1/home/', '', '', '', '', '', ''),
(77, 'عالم التوفير', '711 111 111', 'إب', 'شارع تعز', 'aaa@gmail.com', '1664403915_profile.png', 1, '1663718779_a.pdf', '1663718779_a.pdf', '2022-09-21 03:07:09', '2024-01-31 21:20:04', '', '775662462', '775662462', 'http://localhost/myporject1/home/', '', '', '', '', 'جميل جدا ', ''),
(79, 'شض', '123 123 1__', '', '', 'OSAMH@GMAIL.COM', '1.png', 1, '', '', '2024-04-29 23:15:54', '2024-04-29 23:15:54', '', '', '', '', '', '', '', '', '', ''),
(80, 'شض', '123 123 1__', '', '', 'OSAMH@GMAIL.COM', '1.png', 1, '', '', '2024-04-29 23:16:14', '2024-04-29 23:16:14', '', '', '', '', '', '', '', '', '', ''),
(81, 'شض', '123 123 1__', 'إب', 'DDDDDDDDDDDD', 'OSAMH@GMAIL.COM', '1.png', 1, '', '', '2024-04-29 23:16:28', '2024-04-29 23:16:28', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_com`
--

CREATE TABLE `delivery_com` (
  `id_delivery` int(11) NOT NULL,
  `delivery_name` varchar(150) NOT NULL,
  `delivery_phone` varchar(50) NOT NULL,
  `delivery_address` varchar(50) NOT NULL,
  `delivery_email` varchar(50) NOT NULL,
  `delivery_statue` int(5) NOT NULL DEFAULT 1,
  `delivery_icon` text NOT NULL DEFAULT '1.png',
  `delivery_fk_com` int(11) NOT NULL DEFAULT 0,
  `delivery_type` varchar(50) DEFAULT NULL,
  `delivery_details` text DEFAULT NULL,
  `fk_id_delivery_form` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_com`
--

INSERT INTO `delivery_com` (`id_delivery`, `delivery_name`, `delivery_phone`, `delivery_address`, `delivery_email`, `delivery_statue`, `delivery_icon`, `delivery_fk_com`, `delivery_type`, `delivery_details`, `fk_id_delivery_form`) VALUES
(1, 'اسامة عبدالقادر ناحي', '775662462', 'اب', 'osamh3862@gmail.com', 1, '1.png', 74, NULL, NULL, 0),
(2, 'ناجي عبدالقادر ناحي', '775534911', 'اب', 'najeshhra77@gmail.com', 1, '1.png', 74, NULL, NULL, 0),
(3, 'بيلي', '7475', 'ل', 'بلا', 1, '1.png', 74, 'ل', '', 0),
(4, 'توصيل', '775662462', 'اب-الدائري', 'tosial@gmail.com', 1, '4_1720385466.jpg', 74, 'شركة', '.s', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_form`
--

CREATE TABLE `delivery_form` (
  `id_delivery_form` int(11) NOT NULL,
  `delivery_name_form` varchar(150) NOT NULL,
  `delivery_phone_form` varchar(50) NOT NULL,
  `delivery_address_form` varchar(50) NOT NULL,
  `delivery_email_form` varchar(50) NOT NULL,
  `delivery_statue_form` int(2) NOT NULL,
  `delivery_icon_form` text NOT NULL DEFAULT '1.png',
  `delivery_type_form` varchar(50) DEFAULT NULL,
  `delivery_details_form` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_form`
--

INSERT INTO `delivery_form` (`id_delivery_form`, `delivery_name_form`, `delivery_phone_form`, `delivery_address_form`, `delivery_email_form`, `delivery_statue_form`, `delivery_icon_form`, `delivery_type_form`, `delivery_details_form`) VALUES
(1, 'توصيل', '775662462', 'اب-الدائري', 'tosial@gmail.com', 1, '1.png', 'شركة', '.');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `deprat_id` int(11) NOT NULL,
  `name_depart` varchar(255) NOT NULL,
  `about_depart` varchar(255) NOT NULL,
  `icon_depart` varchar(100) DEFAULT '1.jpg',
  `depart_state` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deprat_id`, `name_depart`, `about_depart`, `icon_depart`, `depart_state`) VALUES
(1, 'الملابس', 'ملابس', '1.jpg', 1),
(2, 'ألكترونيات', '778', '_1713942365.jpg', 1),
(4, 'ادوات منزلية', '0', '1.jpg', 1),
(30, 'احذية', '', '1.jpg', 1),
(31, 'اكسسوارات', '', '1.jpg', 1),
(35, 'حقائب', '', '1.jpg', 1),
(36, 'العناية والجمال', '', '1.jpg', 1),
(37, 'الاثاث المنزلي', '', '1.jpg', 1),
(38, 'المنظفات', '', '1.jpg', 1),
(39, 'التحف والهدايا', '', '1.jpg', 1),
(53, 'qw343غ', 'غا', '_1711542549.jpg', 1),
(54, 'ssssss', '', '_1712178830.jpg', 1),
(55, '222222222', '', '1.jpg', 1),
(56, 'tyt', '', '1.jpg', 1),
(72, '12', '222222', '_1713899224.jpg', 1),
(77, 'اواني', '', '1.jpg', 1),
(78, 'اواني', '', '1.jpg', 1),
(79, 'بضاعات', '', '1.jpg', 1),
(80, 'سمسوم', '', '1.jpg', 1),
(81, '88888', '', '1.jpg', 1),
(82, 'aaaaaaaaaaa', '', '1.jpg', 1),
(83, 'asa', '', '1.jpg', 1),
(84, 'sdfsds', '', '1.jpg', 1),
(85, '13', '', '1.jpg', 1),
(86, '3ww', '', '_1714245888.jpg', 1),
(87, '121', '', '1.jpg', 1),
(88, '133', '', '1.jpg', 1),
(89, 'sssssss', '', '1.jpg', 1),
(90, 'sssssss', '', '1.jpg', 1),
(91, 'sssssss', '', '1.jpg', 1),
(92, 'sssssss', '', '1.jpg', 1),
(93, 'sssssss', '', '1.jpg', 1),
(94, 'wwwwwww', '', '1.jpg', 1),
(95, 'oop', '', '_1714332062.jpg', 1),
(96, 'احذية', 'قفغ', '_1713887204.jpg', 1),
(97, 'احذية', 'قفغ', '_1713887204.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_com`
--

CREATE TABLE `department_com` (
  `id_depart_com` int(11) NOT NULL,
  `deprat_id` int(10) NOT NULL DEFAULT 0,
  `name_depart_com` varchar(100) NOT NULL,
  `about_depart_com` varchar(255) DEFAULT NULL,
  `com_id` int(10) NOT NULL,
  `depart_state_com` int(2) NOT NULL DEFAULT 1,
  `icon_depart_com` varchar(100) DEFAULT '1.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_com`
--

INSERT INTO `department_com` (`id_depart_com`, `deprat_id`, `name_depart_com`, `about_depart_com`, `com_id`, `depart_state_com`, `icon_depart_com`) VALUES
(138, 4, 'ادوات منزلية', 'ادوات منزلية', 35, 1, '1.jpg'),
(139, 96, 'احذية', '', 35, 1, '1.jpg'),
(146, 35, 'حقائب', 'حلو جدا', 35, 0, '1.jpg'),
(148, 36, 'العناية والجمال', 'حلو جدا', 35, 0, '1.jpg'),
(149, 31, 'اكسسوارات', 'حلو جدا', 35, 1, '1.jpg'),
(150, 39, 'التحف والهدايا', 'حلو جدا', 35, 0, '1.jpg'),
(151, 38, 'المنظفات', 'حلو جدا', 35, 0, '1.jpg'),
(152, 37, 'الاثاث المنزلي', 'حلو جدا', 35, 0, '1.jpg'),
(153, 36, 'العناية والجمال', 'حلو جدا', 35, 0, '1.jpg'),
(155, 96, 'احذية', 'قفغ', 74, 1, '_1713887204.jpg'),
(156, 39, 'التحف والهدايا', '', 74, 1, '1.jpg'),
(157, 38, 'المنظفات', 'حلو جدا', 74, 1, '1.jpg'),
(158, 37, 'الاثاث المنزلي 1111111111', '1211111111', 74, 1, '158_1714596196.jpg'),
(159, 36, 'العناية والجمال', 'حلو جدا', 74, 1, '1.jpg'),
(160, 35, 'حقائبef', 'eeeeeeeeeeeeee', 74, 1, '160_1714597859.jpg'),
(161, 31, 'اكسسوارات', 'حلو جدا', 74, 1, '1.jpg'),
(163, 4, 'ادوات منزلية', 'حلو جدا', 74, 1, '1.jpg'),
(167, 37, 'الاثاث المنزلي', 'مجموعة الاثاث المنزلي', 75, 0, '1.jpg'),
(168, 37, 'الاثاث المنزلي', 'مجموعة الاثاث المنزلي', 75, 0, '1.jpg'),
(170, 35, 'حقائب', '', 77, 0, '1.jpg'),
(172, 1, 'الملابس', 'ملابس', 77, 1, '1.jpg'),
(173, 2, 'ألكترونيات', '', 77, 1, '1.jpg'),
(174, 96, 'احذية', '', 77, 1, '1.jpg'),
(175, 1, 'الملابس', 'ملابس', 74, 1, '1.jpg'),
(176, 2, 'ألكترونيات', '', 74, 1, '1.jpg'),
(245, 35, 'سيب', '', 74, 1, '_1713888387.jpg'),
(254, 54, 'ssssss', '', 74, 1, '_1712178830.jpg'),
(257, 56, 'tyt', '', 74, 1, '1.jpg'),
(258, 72, '12', '222222', 74, 1, '_1713899224.jpg'),
(282, 1, 'الملابس', 'ملابس41', 44, 1, '1.jpg'),
(283, 96, 'احذية', '', 44, 3, '1.jpg'),
(286, 77, 'اواني', '', 44, 3, '1.jpg'),
(287, 79, 'بضاعات', '', 44, 2, '1.jpg'),
(288, 80, 'سمسوم', '', 44, 1, '1.jpg'),
(289, 81, '88888', '', 44, 1, '1.jpg'),
(290, 84, 'sdfsds', '', 44, 1, '1.jpg'),
(291, 83, 'asa', '', 44, 1, '1.jpg'),
(292, 82, 'aaaaaaaaaaa', '', 44, 1, '1.jpg'),
(293, 72, '12', '222222', 44, 1, '_1713899224.jpg'),
(294, 86, '3ww', '', 44, 1, '_1714245888.jpg'),
(295, 85, '13', '', 44, 1, '1.jpg'),
(296, 87, '121', '', 44, 1, '1.jpg'),
(297, 88, '133', '', 44, 1, '1.jpg'),
(298, 89, 'sssssss', '', 44, 1, '1.jpg'),
(299, 94, 'wwwwwww', '', 44, 1, '1.jpg'),
(300, 95, 'oop', '', 74, 1, '_1714332062.jpg'),
(301, 0, 'سيب', '', 74, 1, '_1714332075.jpg'),
(302, 0, 'سيب', '', 74, 1, '_1714332645.jpg'),
(303, 95, 'oop', 'p', 44, 1, '_1714333461.jpg'),
(304, 0, 'qwq', 'qqqqqq', 44, 1, '_1714334476.jpg'),
(305, 0, 'qwq', '', 44, 1, '1.jpg'),
(306, 0, 'zxz', 'zzzzzz', 44, 1, '_1714334663.jpg'),
(307, 0, 'zxz', '', 44, 1, '1.jpg'),
(308, 0, 'zxz', '', 44, 1, '1.jpg'),
(309, 0, 'zxz', '', 44, 1, '1.jpg'),
(310, 0, 'zxz', '', 44, 1, '1.jpg'),
(311, 0, 'zxz', '', 44, 1, '1.jpg'),
(312, 0, 'zxz', '', 44, 1, '1.jpg'),
(313, 0, '..', '', 44, 1, '1.jpg'),
(314, 0, '..', '', 44, 1, '1.jpg'),
(315, 0, 'zxz', '', 44, 1, '1.jpg'),
(316, 93, 'sssssss', '', 44, 1, '1.jpg'),
(317, 31, 'اكسسوارات', '', 44, 1, '1.jpg'),
(318, 79, 'بضاعات', '', 74, 4, '1.jpg'),
(319, 0, '1212121', 'eeeeeeeeeeeee', 74, 1, '_1714597879.jpg'),
(320, 30, 'احذية', '', 74, 1, '1.jpg'),
(321, 88, '133', '', 74, 1, '1.jpg'),
(322, 53, 'qw343غ', 'غا', 74, 1, '_1711542549.jpg'),
(323, 77, 'اواني', '22222222222222222', 74, 1, '_1716230454.jpg'),
(324, 80, 'سمسوم', '', 74, 1, '1.jpg'),
(325, 86, '3ww', 'ssssssssssssssssss', 74, 1, '_1714245888.jpg'),
(341, 1, 'الملابس', 'ملابس', 43, 1, '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `form_items_pro`
--

CREATE TABLE `form_items_pro` (
  `id_ite_for` int(11) NOT NULL,
  `fk_cat_ite_for` int(11) NOT NULL,
  `na_ite_fo` varchar(100) NOT NULL,
  `detali_ite_fo` text NOT NULL,
  `img_ite_for` text DEFAULT '1.png',
  `status_ite_for` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_items_pro`
--

INSERT INTO `form_items_pro` (`id_ite_for`, `fk_cat_ite_for`, `na_ite_fo`, `detali_ite_fo`, `img_ite_for`, `status_ite_for`) VALUES
(1, 4, 'فساتين سهرات', 'جميل جدا', '_1716226804.jpg', 1),
(2, 5, 'فساتين جميلة', '', '1.png', 1),
(3, 7, 'دهونات شعر12', '122222222222222', '_1715668621.jpg', 1),
(4, 4, 'ملابس علوية', 'ششششششش', '_1715800822.jpg', 1),
(5, 4, 'ملابس سفلية', 'سسسس', '1.png', 2),
(6, 5, 'ملابس سفلية', 'ssssssssss', '1.png', 1),
(7, 46, 'احذية مدرسية', 'ؤؤؤؤؤؤؤ', '_1716494496.jpg', 1),
(8, 46, 'احذية عيد', '', '1.png', 1),
(9, 4, 'yyy', 'rrrrrrrrrrr', '_1716838674.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_size`
--

CREATE TABLE `form_size` (
  `id_form` int(11) NOT NULL,
  `cat_fk_id` int(11) NOT NULL,
  `size` varchar(150) NOT NULL DEFAULT 'لم يتم التحديد',
  `details` varchar(1000) NOT NULL DEFAULT 'لم يتم التحديد',
  `form_state` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_size`
--

INSERT INTO `form_size` (`id_form`, `cat_fk_id`, `size`, `details`, `form_state`) VALUES
(1, 5, 'M', 'طول العباية 150 - طول الذراع 60 - محيط الرقبة 38 - محيط الصدر 100 - محيط الوسط 84 - 1/2 محيط الهنش 60 - طول الكتف 12.50 - محيط الذراع 34 - عرض الظهر 38', 3),
(2, 5, 'L', 'طول العباية 151 - طول الذراع 61 - محيط الرقبة 40 - محيط الصدر 104 - محيط الوسط 88 - 1/2 محيط الهنش 62 - طول الكتف 13 - محيط الذراع 34 - عرض الظهر 40', 1),
(3, 5, 'XL', 'طول العباية 151 - طول الذراع 61 - محيط الرقبة 41 - محيط الصدر 108 - محيط الوسط 100 - 1/2 محيط الهنش 64 - طول الكتف 13.50 - محيط الذراع 36 - عرض الظهر 41', 1),
(4, 5, '2XL', 'طول العباية 152 - طول الذراع 62 - محيط الرقبة 42 - محيط الصدر 114 - محيط الوسط 106 - 1/2 محيط الهنش 68 - طول الكتف 14 - محيط الذراع 37 - عرض الظهر 42', 1),
(5, 5, '3XL', 'طول العباية 152 - طول الذراع 62 - محيط الرقبة 44 - محيط الصدر 120 - محيط الوسط 110 - 1/2 محيط الهنش 74 - طول الكتف 14.50 - محيط الذراع 38 - عرض الظهر 43', 1),
(6, 4, 'M', 'لم يتم التحديد', 1),
(7, 4, 'S', '78', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items_product`
--

CREATE TABLE `items_product` (
  `id_item` int(11) NOT NULL,
  `fk_ite_for` int(11) NOT NULL DEFAULT 0,
  `fk_cat_ite` int(11) NOT NULL DEFAULT 0,
  `fk_pro_ite` int(11) NOT NULL DEFAULT 0,
  `name_items` varchar(100) NOT NULL,
  `item_prod_statues` int(11) NOT NULL DEFAULT 1,
  `imag_item_prod` text NOT NULL DEFAULT '1.png',
  `details_item_prod` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_product`
--

INSERT INTO `items_product` (`id_item`, `fk_ite_for`, `fk_cat_ite`, `fk_pro_ite`, `name_items`, `item_prod_statues`, `imag_item_prod`, `details_item_prod`) VALUES
(17, 1, 45645, 0, 'فساتين سهرات', 1, '_1716226804.jpg', 'جميل جدا'),
(18, 4, 45645, 0, 'ملابس علوية', 1, '_1715800822.jpg', 'ششششششش'),
(19, 5, 45645, 0, 'ملابس سفلية', 2, '1.png', 'سسسس'),
(20, 2, 45646, 0, 'فساتين جميلة', 1, '1.png', ''),
(21, 6, 45646, 0, 'ملابس سفلية', 1, '1.png', 'ssssssssss'),
(22, 0, 45646, 456, '20', 1, '1.png', NULL),
(23, 0, 45646, 456, '21', 1, '1.png', NULL),
(24, 0, 45646, 457, 'فساتين جميلة', 1, '1.png', NULL),
(25, 0, 45646, 457, 'ملابس سفلية', 1, '1.png', NULL),
(26, 0, 45646, 458, 'فساتين جميلة', 1, '1.png', NULL),
(27, 0, 45646, 458, 'ملابس سفلية', 1, '1.png', NULL),
(28, 0, 45646, 459, '21', 1, '1.png', NULL),
(29, 0, 45646, 459, 'فساتين جميلة', 1, '1.png', NULL),
(30, 0, 45646, 460, 'فساتين جميلة', 1, '1.png', NULL),
(31, 0, 45646, 461, 'ملابس سفلية', 1, '1.png', NULL),
(32, 0, 45646, 463, 'فساتين جميلة', 1, '1.png', NULL),
(33, 0, 45646, 473, '21', 1, '1.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mang_com`
--

CREATE TABLE `mang_com` (
  `id_manag` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `name_manag` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mang_com`
--

INSERT INTO `mang_com` (`id_manag`, `com_id`, `name_manag`, `email`, `password`, `status`) VALUES
(1, 44, 'الدعيس مول', 'aaa@gmail.com', '202cb962ac59075b964b07152d234b70', '2'),
(6, 35, 'اكس بو الشارقة', 'xbo@gmail.com', 'ca3a33a85682f1fa77e700496b0afa53', '1'),
(7, 43, 'osamh', 'beladmol@gmail.com', '202cb962ac59075b964b07152d234b70', '4'),
(8, 74, 'سيتي ماكس', 'city_max@gmail.com', '202cb962ac59075b964b07152d234b70', '3'),
(9, 75, 'مركز المشرقي', 'ccc@gmail.com', '202cb962ac59075b964b07152d234b70', '2'),
(10, 76, 'مول العرب', 'beladmol@gmail.com', '202cb962ac59075b964b07152d234b70', '2'),
(11, 77, 'مزايا سنتر', 'aaa@gmail.com', '202cb962ac59075b964b07152d234b70', '2');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `custom_id` int(11) NOT NULL,
  `cu_name` varchar(250) NOT NULL,
  `cus_phone` varchar(100) NOT NULL,
  `type_order` int(5) NOT NULL,
  `address_order` varchar(400) NOT NULL,
  `order_location` text NOT NULL,
  `order_dale_receipt` text NOT NULL,
  `pers_gift` varchar(50) NOT NULL,
  `chack_order` int(5) NOT NULL DEFAULT 1,
  `chack_money` int(5) NOT NULL DEFAULT 0,
  `processor_order` int(5) NOT NULL DEFAULT 0,
  `delivery_order` int(5) NOT NULL DEFAULT 0,
  `order_note` varchar(500) NOT NULL,
  `mony_image` text NOT NULL,
  `process_image` text NOT NULL,
  `delivery_image` text NOT NULL,
  `status_order` int(5) NOT NULL DEFAULT 1,
  `date_add` date NOT NULL DEFAULT current_timestamp(),
  `com_id_ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `custom_id`, `cu_name`, `cus_phone`, `type_order`, `address_order`, `order_location`, `order_dale_receipt`, `pers_gift`, `chack_order`, `chack_money`, `processor_order`, `delivery_order`, `order_note`, `mony_image`, `process_image`, `delivery_image`, `status_order`, `date_add`, `com_id_ord`) VALUES
(12, 0, 'osamah11', '1233', 1, 'tr', '', '2023-06-20', '', 1, 0, 0, 0, '', '12_1687808382.JPG', '', '', 1, '2023-06-14', 74),
(13, 0, 'اسامة شحرة', '77584', 0, 'اب ميتم ', '', '2023-06-21', '', 1, 1, 1, 1, '', '13_1687808524.jpeg', '13_1688400888.jpg', '0', 2, '2023-06-15', 74),
(14, 0, 'اسامة 1', '787787', 0, 'اب ميتم ', 'ibb', '2023-06-15', 'شخصية', 1, 1, 1, 1, '', '14_1688398459.jpeg', '14_1706733338.jpg', '0', 2, '2023-06-15', 74),
(17, 0, 'osamah12', '2212', 0, 'اب ميتم ', '45121124', '2023-06-17', 'شخصية', 1, 0, 0, 0, 'oooo', '', '', '', 1, '2023-06-16', 74),
(20, 0, 'oollllllllllllllll', '78', 1, '457', '', '2023-06-19', 'شخصية', 1, 1, 1, 0, 'u', '20_1687810577.jpg', '20_1687811285.jpg', '20_1687811906.jpg', 0, '2023-06-19', 74),
(21, 0, 'no_item', '00', 2, 'اب ميتم ', '45121124', '2023-06-19', 'شخصية', 1, 0, 0, 0, 'لاشي', '', '', '', 1, '2023-06-19', 74),
(22, 0, '21/6', '554', 2, 'اب ميتم ', '45121124', '2023-06-22', 'شخصية', 1, 1, 1, 1, '44545', '22_1687810663.jpg', '22_1687811100.jpg', '22_1687814659.jpg', 2, '2023-06-21', 74),
(23, 0, '100', '775662462', 2, 'aa', 'a', '2024-02-08', 'هدية', 1, 1, 1, 0, '', '0', '0', '', 1, '2024-02-03', 74),
(24, 0, 'fngn', '324', 1, '234r3', '', '', 'شخصية', 1, 0, 0, 0, '', '', '', '', 1, '2024-03-05', 77);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id_item_order` int(11) NOT NULL,
  `fk_order` int(11) NOT NULL,
  `fk_pro` int(11) NOT NULL,
  `pro_size_id` int(11) NOT NULL,
  `note` varchar(500) NOT NULL,
  `quantity_item` int(5) NOT NULL,
  `price_one` decimal(10,0) NOT NULL,
  `total_item` decimal(10,0) NOT NULL,
  `item_statue` int(5) NOT NULL DEFAULT 1,
  `com_id_item_ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id_item_order`, `fk_order`, `fk_pro`, `pro_size_id`, `note`, `quantity_item`, `price_one`, `total_item`, `item_statue`, `com_id_item_ord`) VALUES
(48, 12, 134, 2, '', 2, 5000, 10000, 1, 74),
(49, 12, 136, 0, '', 1, 15000, 15000, 1, 74),
(50, 13, 131, 1, '', 4, 8000, 32000, 1, 74),
(51, 13, 147, 0, 'جميل جدا', 2, 2500, 5000, 1, 74),
(53, 14, 134, 2, '', 4, 5000, 20000, 1, 74),
(54, 14, 137, 0, '787', 1, 6000, 6000, 1, 74),
(68, 17, 131, 1, '', 1, 8000, 8000, 1, 74),
(69, 17, 134, 2, '', 1, 5000, 5000, 1, 74),
(70, 17, 134, 2, '', 1, 5000, 5000, 1, 74),
(71, 17, 135, 0, '', 1, 500, 500, 1, 74),
(72, 17, 135, 0, '', 1, 500, 500, 1, 74),
(73, 17, 140, 0, '', 1, 400, 400, 1, 74),
(74, 17, 141, 0, 'kklk', 1, 14000, 14000, 1, 74),
(145, 20, 138, 0, '', 1, 100, 100, 1, 74),
(146, 20, 131, 4, '', 1, 8000, 8000, 1, 74),
(147, 20, 131, 3, '', 1, 8000, 8000, 1, 74),
(148, 20, 134, 2, '', 1, 5000, 5000, 1, 74),
(149, 20, 135, 0, '', 1, 500, 500, 1, 74),
(177, 22, 145, 0, '', 1, 14000, 14000, 1, 74),
(178, 22, 145, 0, '', 1, 14000, 14000, 1, 74),
(195, 23, 127, 0, '', 1, 25000, 25000, 1, 74),
(197, 23, 148, 0, '', 1, 11200, 11200, 1, 74),
(199, 24, 148, 0, '', 1, 11200, 11200, 1, 77),
(200, 24, 177, 0, '', 1, 5000, 5000, 1, 77),
(206, 1, 285, 0, '', 1, 45000, 45000, 1, 74),
(207, 1, 286, 0, '', 2, 35000, 70000, 1, 74),
(209, 1, 268, 0, '', 28, 6500, 182000, 1, 74),
(210, 1, 268, 0, '', 1, 6500, 6500, 1, 74),
(212, 1, 134, 0, '', 1, 5000, 5000, 1, 43);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `id_depart_com` int(10) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `QR_number` varchar(255) DEFAULT NULL,
  `product_image` text DEFAULT '1.png',
  `price` bigint(50) NOT NULL,
  `opponent` bigint(10) NOT NULL,
  `product_desc` text DEFAULT NULL,
  `notice` varchar(255) DEFAULT NULL,
  `status_pro` int(3) NOT NULL DEFAULT 1,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `datemodified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `com_id`, `id_depart_com`, `product_title`, `product_cat`, `QR_number`, `product_image`, `price`, `opponent`, `product_desc`, `notice`, `status_pro`, `dateAdded`, `datemodified`) VALUES
(1, 74, 161, 'دعايات', 51, '3362353', '1679523092_anonymous_man_mask_268565_2560x1080.jpg', 150, 0, 'دعايات جميله جدا تقاوم المياة والرطوبة', NULL, 0, '2023-03-23 01:11:32', '2023-03-23 01:11:32'),
(125, 43, 127, 'مشغل mp3 صغير', 39, '45464564645664', '1663631683_ipod_shuffle_5.jpg', 2000, 0, 'مشغلات mp3 صغيرة مع سماعة اذن', NULL, 2, '2022-09-19 22:35:55', '2022-09-19 22:35:55'),
(127, 76, 134, 'فستان سهرات', 5, '5060010', '1663616262_-5949676152446629615_121.jpg', 25000, 0, 'فستان سهرات نسائي تركي \r\nخامة ممتازة \r\nالمقاسات : 38/48\r\nاللون اللحمي فقط', NULL, 1, '2022-09-19 22:37:42', '2022-09-19 22:37:42'),
(128, 43, 127, 'شاشات ستار  بوصة', 41, '45464564645664                                                      ', '1663616378_thunderboltdisplay.jpg', 50000, 0, '\r\nشاشات ستار سات 64 بوصة\r\n', NULL, 2, '2022-09-19 22:39:38', '2022-09-19 22:39:38'),
(130, 43, 127, 'شاشة سامسونج ', 41, '456454485585', '1663616550_samsungtab.jpg', 40000, 0, '\r\nشاشات سامسونج 24 بوصة HD', NULL, 1, '2022-09-19 22:42:30', '2022-09-19 22:42:30'),
(131, 76, 134, ' فستان سهرات', 5, '5060011', '1663616589_-5834832828645357615_121.jpg', 18000, 10000, '', NULL, 1, '2022-09-19 22:43:09', '2022-09-19 22:43:09'),
(133, 76, 134, 'فستان سهرات', 5, '5060012', '1663616809_‏‏-5949676152446629620_121 - نسخة.jpg', 19500, 0, 'فستان نسائي سهرات تركي\r\n\r\nخامة شيفون \r\nيتوفر الالوان الكحلي والاصفر ودم الغزال', NULL, 1, '2022-09-19 22:46:49', '2022-09-19 22:46:49'),
(134, 43, 144, 'بنطلون رجالي11', 4, '5070301', '1663631759_41OJZebRUoL._SL246_SX190_CR0,0,190,246_.jpg', 5000, 0, 'بنطلون تركي', NULL, 1, '2022-09-19 22:48:15', '2022-09-19 22:48:15'),
(135, 43, 127, 'جهاز ماك محمول', 42, '1242424524254', '1663616987_macbook.jpg', 500, 0, '\r\nجهاز ماك محمول شاشة 14 انش', NULL, 1, '2022-09-19 22:49:47', '2022-09-19 22:49:47'),
(136, 76, 134, 'فستان سهرات', 5, '5060013', '1663617062_‏‏-5954056121440384857_121 - نسخة.jpg', 15000, 0, 'القطفان شيفون ناعم من أجواد انواع الشيفون مطرز بالحرير والترتر اللامع \r\n\r\nالمقاسات 3848\r\n\r\nالالوان العنابي والاسواد', NULL, 1, '2022-09-19 22:51:02', '2022-09-19 22:51:02'),
(137, 43, 144, 'بنطلون كتان', 4, '5070302', '1663617099_-5147781989934409793_121.jpg', 6000, 0, '\r\nبنطلون كتان', NULL, 1, '2022-09-19 22:51:39', '2022-09-19 22:51:39'),
(138, 43, 127, 'جهاز كمبيوتر مكتبي', 42, '454555585', '1663617126_compaq_presario.jpg', 100, 0, '\r\nجهاز كمبيوتر مكتبي ', NULL, 2, '2022-09-19 22:52:06', '2022-09-19 22:52:06'),
(139, 76, 134, 'فستان سهرات', 5, '5060014', '1663617213_-5911353877251340720_121.jpg', 12500, 0, 'طفم نسائي بألوان ومقاسات متنوعة\r\n\r\nيبدأ المقاسات من 3548\r\nا\r\nمتوفر جميع الالوان', NULL, 1, '2022-09-19 22:53:33', '2022-09-19 22:53:33'),
(140, 43, 127, 'جهاز hp -490', 42, '12452524556', '1663617352_hp_1.jpg', 400, 0, '\r\nجهاز hp 490 \r\n\r\nRAM:16 GB\r\nHD: 512GB', NULL, 1, '2022-09-19 22:55:52', '2022-09-19 22:55:52'),
(141, 76, 134, 'بلوزة نسائي تركي', 5, '5060015', '1663617360_‏‏-5913605677065026123_121 - نسخة.jpg', 14000, 0, 'بلوزة خامة تركي شيفون \r\nمطرزة \r\n\r\nالمقاسات 15\r\nمتوفرة باللون الابيض فقط', NULL, 1, '2022-09-19 22:56:00', '2022-09-19 22:56:00'),
(142, 76, 134, 'عباية خليجي ', 37, '5003006', '1663617372_IMG_20220830_015327_274.jpg', 11000, 0, 'عباية خليجي تصميم عربي موضة جديد فخامة تتوفر مقاسات ضغير كبير مختلف الفئات العمريه ', NULL, 1, '2022-09-19 22:56:12', '2022-09-19 22:56:12'),
(143, 76, 134, 'فستان سهرات', 5, '5060016', '1663617499_-5467705041432455246_121.jpg', 18500, 0, 'فستان سهرات تركي نام \r\nبخامات واللوان ممتازة \r\n\r\nالقياسات  15\r\nمتوفرة بلون واحد فقط ', NULL, 1, '2022-09-19 22:58:19', '2022-09-19 22:58:19'),
(144, 43, 127, 'كاميرا كانون eos 5d', 40, '78578796', '1663617608_canon_eos_5d_1.jpg', 1000, 0, '\r\nكاميرا كانون 5d تصوير HD+ تصوير بدقة عالية', NULL, 1, '2022-09-19 23:00:08', '2022-09-19 23:00:08'),
(145, 76, 134, 'فستان سهرات', 5, '5060016', '1663617755_-5947025745308137703_121.jpg', 14000, 0, 'فستان حرير ناعم \r\nبخامة ممتازة \r\n\r\nالمقاسات 4048\r\n\r\nمتوفر لها  لون واحد                 \r\n  فقط', NULL, 1, '2022-09-19 23:02:35', '2022-09-19 23:02:35'),
(146, 76, 134, 'طقم ولادي صغير', 6, '5003009', '1663617787_1415480490067.jpg', 13000, 0, 'طقم ولادي متكامل ماركة ممتازه قماش متوفر كافة الالون ', NULL, 1, '2022-09-19 23:03:07', '2022-09-19 23:03:07'),
(147, 76, 134, 'تيشيرت ولادي ', 6, '5003010', '1663617964_-5149983719019358387_121.jpg', 2500, 0, 'تيشيرت وبلدي قطن ابو تمساح ماركة عالمية متوفر لدينا جميع الالون ', NULL, 1, '2022-09-19 23:06:04', '2022-09-19 23:06:04'),
(148, 76, 134, 'بلوزة نسائي تركي', 5, '506001701', '1663617969_‏‏-5967299498478778187_121 - نسخة.jpg', 11200, 0, 'بلوزة نسائي تركي \r\nبنقشات هادية و\r\nبخامة ممتازة \r\n\r\nالمقاسات 4048\r\n\r\nمتوفر لها  لون واحد                 \r\n  فقط', NULL, 1, '2022-09-19 23:06:09', '2022-09-19 23:06:09'),
(149, 43, 144, 'بنطلون جنز', 4, '30703012', '1663618068_-5974196240998578997_121.jpg', 75, 0, 'بنطلون جنز', NULL, 0, '2022-09-19 23:07:48', '2022-09-19 23:07:48'),
(150, 76, 134, 'جاكيت ولادي صغير ', 6, '5003011', '1663618089_-5195425366364240167_121.jpg', 8000, 0, 'جاكيت ولادي صغير فخامة خامة فريده وجيدة متوفر كافة الالون ', NULL, 1, '2022-09-19 23:08:09', '2022-09-19 23:08:09'),
(151, 76, 134, 'فستان سهرات', 5, '5060017', '1663618143_‏‏-5969551298292463339_121 - نسخة.jpg', 30500, 0, 'فستان سهرات تركي \r\nحرير ناعم \r\nبخامة ممتازة \r\n\r\nالمقاسات 4048\r\n\r\nمتوفر لها  اللون الاحمرفقط', NULL, 1, '2022-09-19 23:09:03', '2022-09-19 23:09:03'),
(152, 43, 144, 'بنطلون رجالي كتان', 4, '3070304', '1663618273_-5149983719019358424_121.jpg', 9000, 0, 'كتان هندي', NULL, 1, '2022-09-19 23:11:13', '2022-09-19 23:11:13'),
(153, 43, 144, 'بنطلون رجالي', 4, '3070305', '1663618352_-5150235764880156731_121.jpg', 5500, 0, 'بنطلون تركي', NULL, 1, '2022-09-19 23:12:32', '2022-09-19 23:12:32'),
(154, 76, 134, 'طقم نسائي', 5, '50600187', '1663618378_‏‏-5913583923055671452_121 - نسخة.jpg', 8500, 0, '', NULL, 1, '2022-09-19 23:12:58', '2022-09-19 23:12:58'),
(155, 76, 134, 'تيشيرت رجالي ', 4, '307030180', '1663618459_-5429587198090524658_121.jpg', 5000, 0, 'تيشيرت ولادي قطن طبيعيى هندي رقم واحد متوفره كافة اللوان وكل المقاسات ', NULL, 1, '2022-09-19 23:14:19', '2022-09-19 23:14:19'),
(156, 76, 134, 'فستان سهرات', 5, '50600183', '1663618496_-4986043554610653713_121.jpg', 17600, 0, '', NULL, 1, '2022-09-19 23:14:56', '2022-09-19 23:14:56'),
(157, 43, 144, 'بنطلون  هندي', 4, '3070306', '1663618547_-5149983719019358419_121.jpg', 6000, 0, 'بنطلون هندي درجه اولى', NULL, 1, '2022-09-19 23:15:47', '2022-09-19 23:15:47'),
(158, 43, 144, 'بنطلون تركي ', 4, '3070307', '1663618670_-5150235764880156731_121.jpg', 8000, 0, ' بنطلون تركي ', NULL, 1, '2022-09-19 23:17:50', '2022-09-19 23:17:50'),
(159, 76, 134, 'بجامة نسائي', 5, '5060019', '1663618689_-5316942863185061816_121.jpg', 8700, 0, '', NULL, 1, '2022-09-19 23:18:09', '2022-09-19 23:18:09'),
(161, 43, 144, 'بنطلون سوري ', 0, '307030878', '1663618750_-5149983719019358424_121.jpg', 8000, 0, 'سوري درجه اولى', NULL, 1, '2022-09-19 23:19:10', '2022-09-19 23:19:10'),
(162, 76, 139, 'شوز ولاديصغير ', 45, '5003400', '1663618760_-5393586146560290901_121.jpg', 7500, 0, 'شوز ولادي صغير ماركة طبي مساعد على المشي رياضي ', NULL, 1, '2022-09-19 23:19:20', '2022-09-19 23:19:20'),
(163, 43, 144, 'بنطلون سوري ', 4, '3070308', '1663618832_-5149983719019358423_121.jpg', 8000, 0, 'سوري درجه اولى', NULL, 1, '2022-09-19 23:20:32', '2022-09-19 23:20:32'),
(164, 76, 139, 'كوتش ولادي صغير ', 45, '307030990', '1663618860_-5393586146560290890_121.jpg', 4500, 0, 'كوتش وبلدي هندي درجة اولى قاعه طبى ', NULL, 1, '2022-09-19 23:21:00', '2022-09-19 23:21:00'),
(165, 43, 144, 'بنطلون جنز', 4, '3070309', '1663618986_-5147781989934409791_121.jpg', 6000, 0, 'كتان ', NULL, 1, '2022-09-19 23:23:06', '2022-09-19 23:23:06'),
(166, 76, 134, 'طقم نسائي', 5, '5060020', '1663619005_-5764757344834664741_121.jpg', 6000, 0, 'طقم نسائي \r\nنوعية ممتازة تتوفر بألوان مختلفة\r\n\r\nالمقاسات 3545', NULL, 1, '2022-09-19 23:23:25', '2022-09-19 23:23:25'),
(169, 43, 144, 'طقم نسائي', 5, '50600187', '1663619325_-5913583923055671452_121.jpg', 5500, 0, 'طقم نسائي', NULL, 1, '2022-09-19 23:28:45', '2022-09-19 23:28:45'),
(170, 43, 144, ' فستان سهرات', 5, '5060011', '1663619479_-5834832828645357615_121.jpg', 6000, 0, 'فستان سهررات', NULL, 1, '2022-09-19 23:31:19', '2022-09-19 23:31:19'),
(172, 43, 144, 'فستان نسائي شيفون', 5, '5060010', '1663619592_-5949676152446629619_121.jpg', 6000, 0, 'درع نسائي شيفون', NULL, 1, '2022-09-19 23:33:12', '2022-09-19 23:33:12'),
(173, 76, 134, 'درع نسائي شيفون', 5, '5060021', '1663619636_-5922618309453396686_121.jpg', 12000, 0, 'القطفان شيفون مبطن               \r\nالشيفون مطرز\r\n\r\nالمقاسات تبداء من MLXLXXL\r\n\r\nاللون الاسود فقط', NULL, 1, '2022-09-19 23:33:56', '2022-09-19 23:33:56'),
(174, 43, 144, 'فستان وردي ', 5, '307030204', '1663619749_-5195296062078823470_121.jpg', 5000, 0, 'فستان زردي', NULL, 1, '2022-09-19 23:35:49', '2022-09-19 23:35:49'),
(175, 76, 134, 'فنيلة كم', 4, '307030221', '1663621266_-5850713964143556134_120.jpg', 8000, 0, 'فنيلة كم ماركة فرنسية تصميم حديث والوان زاهية ملمس ناعم لتوفير الراحة القصوى عند الارتداء \r\n\r\nمصنوعة من مواد عالية الجودة والقطن', NULL, 1, '2022-09-19 23:37:48', '2022-09-19 23:37:48'),
(176, 43, 144, 'فستان ', 5, '30703147', '1663619875_-5978555843257415769_121.jpg', 8000, 0, '\r\nفستان كتان', NULL, 1, '2022-09-19 23:37:55', '2022-09-19 23:37:55'),
(177, 43, 144, 'فستان بناتي', 37, '30703030', '1663620037_بناتي (4).jpg', 5000, 0, '\r\nفستان بناتي  ناعم', NULL, 1, '2022-09-19 23:40:37', '2022-09-19 23:40:37'),
(178, 43, 144, 'فستان ناعم', 37, '30703030', '1663620121_بناتي (3).jpg', 4500, 0, 'فستان بناتي ناعم وحرير', NULL, 1, '2022-09-19 23:42:01', '2022-09-19 23:42:01'),
(180, 76, 146, 'شنطة كتف جابريانا ', 50, '500700', '1663620162_-5924522440254404517_121.jpg', 4500, 0, 'سحاب مغناطسي بلاستك pvc بتصميم مونو جرام عالي الجودة جيبان سحاب واحد \r\n\r\nشتطة باكيت من الجلد النباتي كاجوال وعصرية ستحتفظ بكل ما تحتاجينة للعمل ', NULL, 1, '2022-09-19 23:42:42', '2022-09-19 23:42:42'),
(181, 43, 144, 'طقم بناتي', 37, '307030145', '1663620191_بلوزة-بنصف-كم-قصيرة-مع-بنطلون-أزرق-مزين-بالورود-مع-كوتشي-باللون-الابيض.jpg', 8000, 0, 'طقم بناتي هندي درجه اولى', NULL, 1, '2022-09-19 23:43:11', '2022-09-19 23:43:11'),
(182, 43, 144, 'طقم بناتي تركي', 37, '5003220', '1663620258_بلوز-ة-باللون-الابيض-منقوشة-مع-حزم-فى-الوسط-باللون-الاحمر-مع-بنطلون-باللون-االابيض.jpg', 9000, 0, 'طقم بناتي تركي ناعم ', NULL, 1, '2022-09-19 23:44:18', '2022-09-19 23:44:18'),
(183, 76, 134, 'طقم ولادي صغير ', 6, '30703026', '1663620339_8470-2.jpg', 8000, 0, 'طقم ولادي كلاكيس رهيب خامة عالية جودة ممتازه ', NULL, 1, '2022-09-19 23:45:39', '2022-09-19 23:45:39'),
(184, 76, 146, 'حائب يد باوتش', 48, '5060022', '1663620363_-5924522440254404517_121.jpg', 9500, 0, 'جودة ممتازة \r\nجميع الألوان متوفرة\r\n\r\nا', NULL, 1, '2022-09-19 23:46:03', '2022-09-19 23:46:03'),
(185, 43, 144, 'جنز بناتي', 37, '307030177', '1663620397_ولادي.jpg', 4500, 0, 'جنز بناتي ', NULL, 1, '2022-09-19 23:46:37', '2022-09-19 23:46:37'),
(186, 43, 144, 'ولادي جنز', 6, '307030232', '1663620520_download.jpg', 5000, 0, 'ولادي جنز مريح ', NULL, 1, '2022-09-19 23:48:40', '2022-09-19 23:48:40'),
(187, 76, 139, 'حذاء كعب ', 44, '5060024', '1663620568_-5924522440254404524_121.jpg', 9800, 0, 'كولكشن  كعب فلانتينو الأكثر طلبا \r\n\r\n\r\nالمقاسات 36 42', NULL, 1, '2022-09-19 23:49:28', '2022-09-19 23:49:28'),
(188, 43, 144, 'ولادي تركي', 6, '30703026', '1663620588_ولادي.jpg', 6000, 0, 'ولادي تركي', NULL, 1, '2022-09-19 23:49:48', '2022-09-19 23:49:48'),
(189, 76, 139, 'حذاء كعب ', 44, '5060024', '1663620629_-5924522440254404524_121.jpg', 9800, 0, 'كولكشن  كعب فلانتينو الأكثر طلبا \r\n\r\n\r\nالمقاسات 36 42', NULL, 1, '2022-09-19 23:50:29', '2022-09-19 23:50:29'),
(190, 76, 134, 'جاكيت شبابي راقي ', 4, '500500', '1663620685_-5429587198090524654_121.jpg', 11000, 0, 'جاكيت شبابي راقي جديد تصميم رهيب قماش ممتاز \r\n\r\nشبابي راقي فخامة  لانك المميز جاكيت هندي ', NULL, 1, '2022-09-19 23:51:25', '2022-09-19 23:51:25'),
(191, 43, 144, 'ولادي هندي ', 6, '5003009', '1663620697_ولادي (2).jpg', 8000, 0, 'ولادي هندي مريح', NULL, 1, '2022-09-19 23:51:37', '2022-09-19 23:51:37'),
(192, 43, 144, 'فستان بناتي', 37, '30703060', '1663620771_-4922457126434089178_121.jpg', 5500, 0, 'فستان بناتي هندي', NULL, 1, '2022-09-19 23:52:51', '2022-09-19 23:52:51'),
(193, 43, 144, 'فستان وردي بناتي', 37, '30703013', '1663620856_-4922713243923884188_120.jpg', 6000, 0, 'فستان بناتي وردي مريخ', NULL, 1, '2022-09-19 23:54:16', '2022-09-19 23:54:16'),
(195, 76, 134, 'فستان سهرات قصير', 5, '5060027', '1663621021_-5936209531598125060_121.jpg', 0, 0, 'فستان نسئي تركي \r\nقماش ناعم صافي\r\n\r\nالمقاسات 3543\r\n\r\nيتوفر بالون الرصاصي فقط', NULL, 1, '2022-09-19 23:57:01', '2022-09-19 23:57:01'),
(196, 76, 139, 'صندل كعب مفتوح ', 44, '5003550', '1663621036_-5924522440254404522_121.jpg', 12000, 0, 'صندل نسائي كعب مفتوح عالي ورباط حول الكاحل \r\nصنادل نسائية مفتوحة من الامام ذات كعب سميك مناسب لفساتين الحفلات', NULL, 1, '2022-09-19 23:57:16', '2022-09-19 23:57:16'),
(199, 76, 134, 'فستان سهرات', 5, '5060028', '1663621211_-5987558846329108778_121.jpg', 14500, 0, 'فستان شيفون تركي\r\nبخامة ممتازة \r\nدقة الخرز لن تجدوها بمكان أخر والجميع جرب هذا الشي\r\n\r\nالمقاسات 4048\r\n\r\nمتوفر لها  جميع الألون', NULL, 1, '2022-09-20 00:00:11', '2022-09-20 00:00:11'),
(200, 43, 144, 'فنيله رجالي ابيض', 4, '307030221', '1663621266_-5850713964143556134_120.jpg', 5000, 0, 'فنيله رجالي', NULL, 1, '2022-09-20 00:01:06', '2022-09-20 00:01:06'),
(201, 43, 144, 'فنيله رجالي ', 4, '30703456', '1663621344_-5850713964143556133_120.jpg', 5500, 0, 'فنيله رجالي ', NULL, 1, '2022-09-20 00:02:24', '2022-09-20 00:02:24'),
(202, 76, 139, 'صندل كعب مقفلة ', 44, '5003077', '1663621349_-5940328297860806217_121.jpg', 9500, 0, 'احذية  نسائية ذات كعب عال من الجلد المدبوغ احذية مكتبية للحفلات مغلقة من الامام وحزام كاحل بفيونكة خلفية لوليتا ', NULL, 1, '2022-09-20 00:02:29', '2022-09-20 00:02:29'),
(203, 76, 134, 'فستان سهرات', 5, '307030145', '1663621404_-6007973251088758249_121.jpg', 17800, 0, 'فستان سهرات \r\nبخامة تركية درجة أولى \r\nقماش حريري ناعم\r\n\r\n\r\nالمقاسات 4048\r\n\r\nمتوفر جميع الألوان', NULL, 1, '2022-09-20 00:03:24', '2022-09-20 00:03:24'),
(204, 43, 144, 'فنيله صوف', 4, '307030231', '1663621443_-5850713964143556141_120.jpg', 8000, 0, 'فنيله رجالي', NULL, 1, '2022-09-20 00:04:03', '2022-09-20 00:04:03'),
(205, 76, 139, 'حذاء نسائي ', 44, '5003055', '1663621536_-5942580097674491822_121.jpg', 5600, 0, 'حذاء الحفلات الايطالية احذية زفاف سهلة الارتداء مع الجلد اللامع ', NULL, 1, '2022-09-20 00:05:36', '2022-09-20 00:05:36'),
(206, 76, 134, 'فستان سهرات', 5, '30703147', '1663621674_-5978555843257415769_121.jpg', 23000, 0, 'فستان  سهرات طويل \r\nحرير ناعم \r\nبخامة ممتازة \r\n\r\nالمقاسات 4048\r\n\r\nمتوفر لها  الألو العنابي فقط', NULL, 1, '2022-09-20 00:07:54', '2022-09-20 00:07:54'),
(207, 43, 144, 'فنيله رجالي ', 4, '30703097', '1663621762_-5429587198090524656_121.jpg', 3000, 0, 'فنليه ', NULL, 1, '2022-09-20 00:09:22', '2022-09-20 00:09:22'),
(208, 43, 144, 'فنيله صوف رجالي', 4, '307030', '1663621850_-5429587198090524657_121.jpg', 4500, 0, 'فنيله صوف', NULL, 1, '2022-09-20 00:10:50', '2022-09-20 00:10:50'),
(209, 76, 134, 'جاكيت نسائي ', 5, '5003085', '1663621856_-5958606596340824201_121.jpg', 7400, 0, 'جاكيت نسائي شتوي انيق من اجود انواع القماش البارد المريح يلائم الاجواء وجميع الظروف المتقلبة \r\n\r\nخامة مريحة للجسم والاكثر رغبة ', NULL, 1, '2022-09-20 00:10:56', '2022-09-20 00:10:56'),
(210, 43, 144, 'فنيله رجالي قطن', 4, '30703014', '1663621938_-5429587198090524659_121.jpg', 5000, 0, 'فنيله قطن رجالي', NULL, 1, '2022-09-20 00:12:18', '2022-09-20 00:12:18'),
(211, 76, 134, 'طقم  بناتي', 37, '5003220', '1663622008_بلوز-ة-باللون-الابيض-منقوشة-مع-حزم-فى-الوسط-باللون-الاحمر-مع-بنطلون-باللون-االابيض.jpg', 10500, 0, 'بلوز-ة-باللون-الابيض-منقوشة-مع-حزم-فى-الوسط-باللون-الاحمر-مع-بنطلون-باللون-االابيض', NULL, 1, '2022-09-20 00:13:28', '2022-09-20 00:13:28'),
(212, 43, 144, 'فنيله رجالي اسود', 4, '307030180', '1663622072_-5429587198090524658_121.jpg', 6000, 0, 'فنيله رجالي اسود', NULL, 1, '2022-09-20 00:14:32', '2022-09-20 00:14:32'),
(213, 76, 134, 'طقم بناتي', 37, '5003221', '1663622130_بلوزة-بنصف-كم-قصيرة-مع-بنطلون-أزرق-مزين-بالورود-مع-كوتشي-باللون-الابيض.jpg', 0, 0, 'بلوزة-بنصف-كم-قصيرة-مع-بنطلون-أزرق-مزين-بالورود-مع-كوتشي-باللون-الابيض', NULL, 1, '2022-09-20 00:15:30', '2022-09-20 00:15:30'),
(214, 43, 144, 'جاكت ', 4, '30703016', '1663622168_-5429587198090524655_121.jpg', 8000, 0, 'جاكت رجالي ', NULL, 1, '2022-09-20 00:16:08', '2022-09-20 00:16:08'),
(215, 76, 134, 'بجامة شبابية ', 4, '30703021', '1663626740_-5960599624374925204_121.jpg', 5000, 0, 'بجامة شبابيه فنيلة كم مع سروال رياضي وقماش ناعم وخامة باردة رياضية سترتش \r\n\r\nلا انك انيق يتوجب ان تتميز عن الغير ', NULL, 1, '2022-09-20 00:16:25', '2022-09-20 00:16:25'),
(216, 43, 144, 'جاكت  رجالي', 4, '500500', '1663622225_-5429587198090524654_121.jpg', 9000, 0, 'جاكت تركي', NULL, 1, '2022-09-20 00:17:05', '2022-09-20 00:17:05'),
(217, 43, 144, 'طقم رجالي', 4, '30703029', '1663622303_-5370604270480635897_121.jpg', 9000, 0, 'طقم رجالي', NULL, 1, '2022-09-20 00:18:23', '2022-09-20 00:18:23'),
(218, 76, 134, 'طقم بناتي نصف كم ', 6, '500333', '1663622412_بلوزة-بنصف-كم-قصيرة-مع-بنطلون-أزرق-مزين-بالورود-مع-كوتشي-باللون-الابيض.jpg', 4500, 0, 'بلوزة بنصف كم قصيرة مع بنطلون ازرق مزين بالورد مع كوتش باللون الابيض ', NULL, 1, '2022-09-20 00:20:12', '2022-09-20 00:20:12'),
(219, 43, 144, 'طقم رجالي تركي', 4, '30703019', '1663622418_-5974388694188143972_121.jpg', 15000, 0, 'طقم رجالي ', NULL, 1, '2022-09-20 00:20:18', '2022-09-20 00:20:18'),
(220, 43, 147, 'كلاركس', 4, '3070305013', '1663622520_-5393586146560290905_121.jpg', 5000, 0, 'تركي مريح', NULL, 1, '2022-09-20 00:22:00', '2022-09-20 00:22:00'),
(221, 76, 134, 'طقم بناتي ', 6, '500444', '1663622554_بلوز-ة-باللون-الابيض-منقوشة-مع-حزم-فى-الوسط-باللون-الاحمر-مع-بنطلون-باللون-االابيض.jpg', 6000, 0, 'بلوزة باللون الابيض منقوشن مع حزام في الوسط باللون الاحمر مع بنطلون باللون الابيض', NULL, 1, '2022-09-20 00:22:34', '2022-09-20 00:22:34'),
(222, 43, 144, 'كوتش رجالي', 4, '30703044', '1663622588_-5404661840719490919_121.jpg', 9000, 0, 'كوتش ', NULL, 1, '2022-09-20 00:23:08', '2022-09-20 00:23:08'),
(223, 43, 147, 'كوتش رجالي', 43, '30703033', '1663622651_-5393586146560290906_121.jpg', 6000, 0, 'كوتش رجالي قوي', NULL, 1, '2022-09-20 00:24:11', '2022-09-20 00:24:11'),
(224, 43, 147, 'كوتش تركي', 43, '30703045', '1663622724_-5393586146560290900_120.jpg', 2500, 0, 'كوتش', NULL, 1, '2022-09-20 00:25:24', '2022-09-20 00:25:24'),
(225, 43, 147, 'جزمه', 0, '3070305015', '1663622830_-5393586146560290889_121.jpg', 6000, 0, 'جزمه ضد الماء', NULL, 1, '2022-09-20 00:27:10', '2022-09-20 00:27:10'),
(226, 76, 134, 'طقم شرتات', 4, '50033221', '1663622843_1 (1).jpg', 18000, 0, 'طقم شرتات رياضي \r\nصيفي\r\nيحتوي على جرام \r\nوشرت وشوز ماركة ديداس\r\n\r\nيتوفر ب الونا', NULL, 1, '2022-09-20 00:27:23', '2022-09-20 00:27:23'),
(227, 43, 147, 'جزمه هندي', 43, '307030907', '1663622911_-5431611085464647257_120.jpg', 9000, 0, 'جزمه هندي', NULL, 1, '2022-09-20 00:28:31', '2022-09-20 00:28:31'),
(228, 43, 147, 'جزمه سوري', 43, '307030990', '1663623009_-5393586146560290890_121.jpg', 7000, 0, 'جزمه سوري ', NULL, 1, '2022-09-20 00:30:09', '2022-09-20 00:30:09'),
(230, 43, 147, 'صندل نسائي', 44, '3070301', '1663623217_-5915937079802574983_121.jpg', 5500, 0, 'صندل مريح ', NULL, 1, '2022-09-20 00:33:37', '2022-09-20 00:33:37'),
(231, 76, 134, 'بنطلون جنز نسائي', 5, '5000440', '1663623224_1 (71).jpg', 7000, 0, 'بنطلون نسائي جنز\r\nخامة هندي\r\n ممتازة ومريحة \r\n\r\nتتوفر بألوان ومقاسات مختلفة', NULL, 1, '2022-09-20 00:33:44', '2022-09-20 00:33:44'),
(232, 43, 147, 'صندل نسائي درج', 44, '30703028', '1663623301_-5915937079802574990_121.jpg', 4500, 0, 'صندل مريح ', NULL, 1, '2022-09-20 00:35:01', '2022-09-20 00:35:01'),
(233, 43, 147, 'صندل نسائي ', 44, '30703015', '1663623360_-5942580097674491822_121.jpg', 5000, 0, 'صندل نسائي ', NULL, 1, '2022-09-20 00:36:00', '2022-09-20 00:36:00'),
(234, 43, 147, 'صندل نسائي كعب', 44, '30703777', '1663623429_-5942580097674491819_121.jpg', 9000, 0, 'صندل نسائي', NULL, 1, '2022-09-20 00:37:09', '2022-09-20 00:37:09'),
(235, 43, 147, 'صندل نسائي ', 44, '3070301', '1663623544_-5942580097674491813_121.jpg', 8000, 0, 'صندل نسائي تركي', NULL, 1, '2022-09-20 00:39:04', '2022-09-20 00:39:04'),
(237, 76, 134, 'بنطلون جنز نسائي', 5, '5000441', '1663623559_1 (70).jpg', 13000, 0, 'بنطلون جنز \r\nتركي خامة ناعم ومريحة\r\n \r\nمقاسات جميع الأحجم', NULL, 1, '2022-09-20 00:39:19', '2022-09-20 00:39:19'),
(238, 43, 147, 'صندل نسائي تركي', 44, '30707854', '1663623606_-5942580097674491823_121.jpg', 5500, 0, 'صندل نسائي', NULL, 1, '2022-09-20 00:40:06', '2022-09-20 00:40:06'),
(239, 76, 134, 'بنطلون استريتش', 5, '5000442', '1663623631_1 (83).jpg', 0, 0, '', NULL, 1, '2022-09-20 00:40:31', '2022-09-20 00:40:31'),
(240, 43, 147, 'صندل نسائي شبك', 44, '307030190', '1663623749_-5940328297860806205_121.jpg', 5000, 0, 'صندل نسائي شبك', NULL, 1, '2022-09-20 00:42:29', '2022-09-20 00:42:29'),
(241, 43, 147, 'صندل نسائي ', 43, '3070301', '1663623809_-5940328297860806206_121.jpg', 4500, 0, 'صندل نسائي', NULL, 1, '2022-09-20 00:43:29', '2022-09-20 00:43:29'),
(242, 43, 147, 'كوتش تركي', 44, '30703020', '1663623891_-5915937079802574996_121.jpg', 9000, 0, 'صندل نسائي', NULL, 1, '2022-09-20 00:44:51', '2022-09-20 00:44:51'),
(243, 43, 147, 'كوتش نسائي هندي', 44, '30703010', '1663623989_-5915937079802575001_121.jpg', 5500, 0, '\r\nكوتش درجه اولى مريح', NULL, 1, '2022-09-20 00:46:29', '2022-09-20 00:46:29'),
(244, 43, 147, 'كوتش نسائي ', 44, '30703027', '1663624064_-5915937079802575008_121.jpg', 4500, 0, 'كوتش مريك', NULL, 1, '2022-09-20 00:47:44', '2022-09-20 00:47:44'),
(245, 43, 147, 'كوتش سوري نسائي', 44, '307030210', '1663624154_-5915937079802575009_121.jpg', 8000, 0, 'كوتش نسائي سوري', NULL, 1, '2022-09-20 00:49:14', '2022-09-20 00:49:14'),
(246, 43, 147, 'جزمه كعب', 44, '30703016', '1663624211_-5940328297860806203_121.jpg', 5500, 0, 'جزمه جعب مؤيح', NULL, 1, '2022-09-20 00:50:11', '2022-09-20 00:50:11'),
(247, 43, 147, 'جزمه كعب هندي', 44, '30703020', '1663624282_-5940328297860806201_121.jpg', 6000, 0, 'جزمه هندي مريح ', NULL, 1, '2022-09-20 00:51:22', '2022-09-20 00:51:22'),
(248, 43, 147, 'جزمه كعب سوري', 44, '3070305014', '1663624348_-5940328297860806217_121.jpg', 8000, 0, 'جزمه سوري ', NULL, 1, '2022-09-20 00:52:28', '2022-09-20 00:52:28'),
(249, 43, 147, 'صندل كعب ', 43, '30703052', '1663624461_-5924522440254404508_121.jpg', 9000, 0, 'صندل كعب', NULL, 1, '2022-09-20 00:54:21', '2022-09-20 00:54:21'),
(250, 43, 147, 'صندل شبك هندي', 44, '30703053', '1663624542_-5924522440254404511_121.jpg', 5000, 0, 'صندل شبك', NULL, 1, '2022-09-20 00:55:42', '2022-09-20 00:55:42'),
(254, 43, 154, ' شنطه', 48, '3070305017', '1663625043_-5924522440254404520_120.jpg', 4500, 0, 'شنطه يد حلوه', NULL, 1, '2022-09-20 01:04:03', '2022-09-20 01:04:03'),
(255, 43, 154, 'حقبه يد ', 48, '30703051', '1663625113_-5924522440254404519_121.jpg', 4500, 0, 'حقيبه حلوه ', NULL, 1, '2022-09-20 01:05:13', '2022-09-20 01:05:13'),
(256, 43, 154, 'حقيبه هندي', 50, '30703017', '1663625167_-5924522440254404517_121.jpg', 4500, 0, 'حقيبه كتف ', NULL, 1, '2022-09-20 01:06:07', '2022-09-20 01:06:07'),
(257, 43, 154, 'شنطه يد سوري', 48, '5060022', '1663625305_-5924522440254404516_121.jpg', 6000, 0, 'حقيبه سوري حلوه', NULL, 1, '2022-09-20 01:08:25', '2022-09-20 01:08:25'),
(258, 43, 144, 'معوز رجالي', 4, '30703088', '1663625403_-4940580818976352494_121.jpg', 9000, 0, 'معوز رجالي درجه اولى ', NULL, 1, '2022-09-20 01:10:03', '2022-09-20 01:10:03'),
(259, 43, 144, 'معوز بيضاني', 4, '30703145', '1663625484_-4958849732952828012_121.jpg', 20000, 0, 'معوز بيضاني مريح جدا\" ', NULL, 1, '2022-09-20 01:11:24', '2022-09-20 01:11:24'),
(261, 43, 144, 'معوز حظرمي ', 4, '30703080', '1663625618_-4958849732952828013_121.jpg', 9000, 0, 'معوز حظرمي ', NULL, 1, '2022-09-20 01:13:38', '2022-09-20 01:13:38'),
(262, 43, 144, 'معوز لحجي', 4, '30703023', '1663625680_-4958849732952828009_121.jpg', 16000, 0, 'معوز لحجي ', NULL, 1, '2022-09-20 01:14:40', '2022-09-20 01:14:40'),
(263, 43, 144, 'معوز عدني ', 4, '30703146', '1663625755_-4958849732952828002_121.jpg', 9000, 0, 'معوز عدني ', NULL, 1, '2022-09-20 01:15:55', '2022-09-20 01:15:55'),
(264, 43, 144, 'معوز جلاكسي', 4, '30703090', '1663625857_-4958849732952828003_121.jpg', 8000, 0, 'معوز جلاكسي ', NULL, 1, '2022-09-20 01:17:37', '2022-09-20 01:17:37'),
(265, 74, 145, 'تيشيرت رجالي ', 4, '5002212', '1663626119_1 (71).jpg', 4500, 0, 'تيشيرت رجالي التمساح قطن ممتاز عالي الجودة \r\n\r\nيتوفر اللون ومقاسات متعددة ', NULL, 1, '2022-09-20 01:21:59', '2022-09-20 01:21:59'),
(266, 43, 154, 'شنطه شوري كلاركس', 48, '30703022', '1663626297_-5969551298292463349_121.jpg', 5500, 0, 'حقيبه سوري ', NULL, 1, '2022-09-20 01:24:57', '2022-09-20 01:24:57'),
(267, 43, 154, 'حيقبه تركي ', 48, '307030211', '1663626362_-5969551298292463348_121.jpg', 5500, 0, 'حقيبة تركي ', NULL, 1, '2022-09-20 01:26:02', '2022-09-20 01:26:02'),
(268, 74, 145, 'فستان بناتي قصير ', 6, '500121', '1663626373_1 (5).jpg', 6500, 0, 'فستان قصير علاقي ثلاث شاشات ناعم وخفيف مناسب للاطفال ', NULL, 1, '2022-09-20 01:26:13', '2022-09-20 01:26:13'),
(269, 43, 154, 'حقيبه كتف', 48, '3070300', '1663626447_-5969551298292463347_121.jpg', 8000, 0, 'حقيبه كتف  هندي درجه اولى', NULL, 1, '2022-09-20 01:27:27', '2022-09-20 01:27:27'),
(270, 43, 144, 'طقم رجالي رياضي', 4, '30703021', '1663626740_-5960599624374925204_121.jpg', 12000, 0, 'طقم رجالي ', NULL, 1, '2022-09-20 01:32:20', '2022-09-20 01:32:20'),
(271, 43, 144, 'شمزان رجالي', 4, '30703011', '1663626954_-5372856070294321169_121.jpg', 4500, 0, 'شمزان تركي ', NULL, 1, '2022-09-20 01:35:54', '2022-09-20 01:35:54'),
(272, 74, 145, 'طقم رجالي ', 4, '500660', '1663627047_1 (1).jpg', 3500, 0, 'بجامة قطن رجالي حرير ناعم وخيف ', NULL, 1, '2022-09-20 01:37:27', '2022-09-20 01:37:27'),
(273, 43, 144, 'شميز رجال اسود', 4, '30703024', '1663627104_-5372856070294321168_121.jpg', 4500, 0, 'شميز تركي ', NULL, 1, '2022-09-20 01:38:24', '2022-09-20 01:38:24'),
(274, 43, 144, 'طقم رجالي ', 4, '3070305', '1663627225_-5782654769909837331_120.jpg', 15000, 0, 'طقم رجالي هندي حلو جد', NULL, 1, '2022-09-20 01:40:25', '2022-09-20 01:40:25'),
(275, 43, 144, 'طقم رجالي هندي', 4, '30703025', '1663627342_-5787479590141275698_120.jpg', 14000, 0, '', NULL, 1, '2022-09-20 01:42:22', '2022-09-20 01:42:22'),
(276, 43, 144, 'بجامه رجالي ', 4, '30703025', '1663627529_-5974388694188143972_121.jpg', 8000, 0, 'بجامه', NULL, 1, '2022-09-20 01:45:29', '2022-09-20 01:45:29'),
(277, 43, 144, 'بجامه رجالي هندي ', 4, '', '1663627590_-5974388694188143974_121.jpg', 8000, 0, 'بجامه رجالي ', NULL, 1, '2022-09-20 01:46:30', '2022-09-20 01:46:30'),
(278, 43, 147, 'صندل نسائي', 43, '3070305011', '1663627683_-5924522440254404512_121.jpg', 5000, 0, 'صندل هندي ', NULL, 1, '2022-09-20 01:48:03', '2022-09-20 01:48:03'),
(279, 43, 147, 'كوتش نسائي مصري', 44, '30703000', '1663627777_-5870487310674540614_120.jpg', 5500, 0, 'مصري قويه مريحه للقدم', NULL, 1, '2022-09-20 01:49:37', '2022-09-20 01:49:37'),
(280, 43, 144, 'فنيله رجالي ', 4, '', '1663627856_-5850713964143556168_120.jpg', 5000, 0, 'فنيله رجالي ', NULL, 1, '2022-09-20 01:50:56', '2022-09-20 01:50:56'),
(281, 74, 161, 'عطرلانكوم ايدول انتنس', 51, '50004600', '1663627857_-5994352054367270335_120.jpg', 71000, 0, 'لانكوم ايدول انتنس\r\n\r\nحجم ٧٥ملي\r\n\r\nوصف العطر\r\n\r\nلمسات زهرية ناعمة نقية وهادئة تتناغم مع روحك الأنثوية الرقيقة من الياسمين بأنواعه المختلفة الممزوجة مع قطرات البرتقال المنعشة ومغلفين بنفحات دافئة من الصندل وخشب الأرز في مزيج عطري جديد ومتألق للنساء المحبة للظهور بأناقة فريدة والمحبة للاستحواذ على المكانة الأولى بلا منافس في كل القلوب، تمتعي بالحيوية والتفرد في كل محافلك ومناسباتك المميزة والمختلفة', NULL, 1, '2022-09-20 01:50:57', '2022-09-20 01:50:57'),
(282, 74, 145, 'طقم بناتي ', 5, '500065', '1663627860_1 (24).jpg', 4500, 0, 'طقم بناتب متكامل تصميم جديد ورهيب خامه ممتازة ', NULL, 1, '2022-09-20 01:51:00', '2022-09-20 01:51:00'),
(283, 43, 147, 'كوتش نسائي٢', 44, '3070305012', '1663627968_-5870487310674540612_120.jpg', 6000, 0, 'كوتش حلزه مريح للقدم', NULL, 1, '2022-09-20 01:52:48', '2022-09-20 01:52:48'),
(284, 74, 161, 'عطرجيفنشي لو إنتيرديت ', 51, '50004601', '1663628246_-5764841019387524106_120.jpg', 45000, 0, 'جيفنشي لو إنتيرديت رذاذ للشعر\r\n\r\nحجم 35ملي\r\n\r\nعن العطر:\r\n\r\nعطر أنيق وناعم يغمرك بروائح البرجموت والكمثرى اللذيذة ممزوجين بقلب مفعم بالروائح الزهرية الناعمة من الياسمين وزهور الحمضيات مع مسك الروم المنعش ثم يجعلك تشعري بجاذبية لا تقاوم مع نجيل الهند والباتشولي مغلفين بحبيبات الفانيليا الرقيقة ويحافظ على لمعان شعرك وجماله لساعات طويلة', NULL, 0, '2022-09-20 01:57:26', '2022-09-20 01:57:26'),
(285, 74, 161, 'عطر جيفنشي', 51, '50004601', '1663628291_-5764841019387524106_120.jpg', 45000, 0, 'جيفنشي لو إنتيرديت رذاذ للشعر\r\n\r\nحجم 35ملي\r\n\r\nعن العطر:\r\n\r\nعطر أنيق وناعم يغمرك بروائح البرجموت والكمثرى اللذيذة ممزوجين بقلب مفعم بالروائح الزهرية الناعمة من الياسمين وزهور الحمضيات مع مسك الروم المنعش ثم يجعلك تشعري بجاذبية لا تقاوم مع نجيل الهند والباتشولي مغلفين بحبيبات الفانيليا الرقيقة ويحافظ على لمعان شعرك وجماله لساعات طويلة', NULL, 2, '2022-09-20 01:58:11', '2022-09-20 01:58:11'),
(286, 74, 161, 'عطر شانيل كوكو', 51, '50004602', '1663628416_-5764841019387524110_120.jpg', 35000, 0, 'شانيل كوكو مودموزيل فريش عطر للشعر\r\n\r\nحجم 35ملي\r\n\r\nعن المنتج:\r\n\r\nعطر نسائي للشعر، يُنعش شعرك بروائح طازجة ومنعشة تدوم طوال اليوم، مع مزيج مذهل من البرتقال والباتشولي والورد.', NULL, 1, '2022-09-20 02:00:16', '2022-09-20 02:00:16'),
(287, 74, 161, 'جيرلان انسولينس', 51, '50004603', '1663628497_-5767204969387242622_121.jpg', 15000, 0, 'جيرلان انسولينس ✨\r\nمن العطور الأكثر مبيعاً✨\r\nخلاصة الأزهار العاطفية 🌺 بمزيج زهرة السوسن , البنفسج , التفاح و زهر البرتقال', NULL, 2, '2022-09-20 02:01:37', '2022-09-20 02:01:37'),
(288, 74, 161, 'عطور دولتشي آند', 51, '50004604', '1663628666_-5807885804398294341_121.jpg', 56000, 0, 'دولتشي آند غابانا ذا وان إنتنس\r\n\r\nحجم 100مل\r\n\r\n\r\nعن المنتج:\r\n\r\nتوليفة عطرية جؤيةئ تجمع ماء زهر البرتقال الممزوج بالهيل الأخضر مع السرو، مع الكشمير الذي يضفي عليك روحاً رجولية شجاعة بصحبة مجموعة أخرى من الروائح الجذابة التي تدوم معك فترات طويلة من اليوم والليلة', NULL, 1, '2022-09-20 02:04:26', '2022-09-20 02:04:26'),
(289, 74, 161, 'عطر زهري خشبي', 51, '50004604', '1663628776_-5787281489069716681_121.jpg', 34000, 0, 'عطر زهري خشبي للنساء برائحة فاتنة تجمع بين الجاذبية والإغواء الأنثوي الذي لا يستطيع رجل مقاومته، تضيف المكونات المتلألئة من الكمثرى والأمبريت لمسة حيوية على العطر، مع قاعدة عطرية من أخشاب الأرز والمسك تمنحك نبضات ساحرة من الحرية والإغواء العفوي', NULL, 1, '2022-09-20 02:06:16', '2022-09-20 02:06:16'),
(290, 74, 161, 'عطر جان بول غوتييه', 51, '50004605', '1663628867_-5812161865248257567_120.jpg', 23000, 0, 'جان بول غوتييه سو سكاندال\r\n\r\n\r\n\r\nعطر جان بول غوتييه الجديد لها أنيق للغاية! يخطف الأنظار بشدة ويكشف بنعومة عن وجه أكثر جرأة وحسيّة لماركة جان بول غوتييه الأنثوية. في عالم المجتمع الراقي الباريسي الراقي والمبدع، هذا العطر يمتلك العبير الزهري الأخاذ والذي سيدفع الآخرين للتساؤل عن سر هذا الشذى.', NULL, 1, '2022-09-20 02:07:47', '2022-09-20 02:07:47'),
(291, 74, 161, 'عطر فرزاتشي بور', 51, '50004607', '1663629017_-5825804579755898285_120.jpg', 43000, 0, 'فرزاتشي بور فيم ديلان تركواز أو دو تواليت\r\n\r\nحجم 100مل\r\n\r\nعن العطر:\r\n\r\nإبداع عطري جديد من أيدي صوفي لاب يجسد روحك الشبابية المتحررة في أجواء الربيع والصيف المنعشة\r\n\r\nقطرات الليمون مع الفلفل الوردي تأخذك في رحلة إلى أحد الجزر البعيدة هروباً من صخب العالم\r\n\r\nقلب العطر الأخضر المنعش ينضح بنسيم كاسيس والفريزيا مع نفحات لذيذة من الجوافة يرافقك طوال الرحلة\r\n\r\nالعطر يمنحك إحساساً عالياً بالانتعاش والحماسة ويزيد من رغبتك في التحرر والانطلاق بدون قيود', NULL, 1, '2022-09-20 02:10:17', '2022-09-20 02:10:17'),
(292, 74, 145, 'طقم نسائي ', 5, '5003099', '1663629087_1 (29).jpg', 4500, 0, 'طقم نسائي جديد مع حزام اللوان باهية وتمصميم جديد ', NULL, 1, '2022-09-20 02:11:27', '2022-09-20 02:11:27'),
(293, 74, 161, 'عطر ليبر سان ', 51, '50004608', '1663629142_-5843750052630214357_121.jpg', 62000, 0, 'ليبر سان لوران انتنس\r\nحجم 90مل\r\n\r\n\r\n\r\nعطر شرقي زهري للنساء. عطر جديد تم إصداره عام 2020.\r\nمقدمة العطر/ اليوسفي، الخزامي الفرنسي، البارغموت.\r\nقلب العطر/ اللافندر، ياسمين سامباك، زهر البرتقال من المغرب، الأوركيد.\r\nقاعدة العطر/ الفانيلا من مدغشقر، نجيل الهند، العنبر، التونكا المطلقة من فنزويلا.', NULL, 1, '2022-09-20 02:12:22', '2022-09-20 02:12:22'),
(294, 74, 161, 'عطر جيفنشي لانتيردي', 0, '50004609', '1663629425_-5870929060945835633_121.jpg', 45000, 0, 'جيفنشي لانتيردي انتنس - او دو بارفيوم\r\n\r\nحجم 80مل \r\n\r\n\r\n\r\n#عطر شرقي - زهري للنساء ، عطر جديد تم إصداره عام 2020.\r\n\r\nمقدمة العطر الفلفل الأسود; قلب العطر مسك الروم, براعم البرتقال و السمسم; قاعدة العطر تتكون من نجيل الهند, الباتشولي و فانيليا مدغشقر.', NULL, 1, '2022-09-20 02:17:05', '2022-09-20 02:17:05'),
(295, 74, 161, 'عطر مارلي إكسليوسف', 51, '50004611', '1663629512_-5816712889904510258_121.jpg', 13000, 0, 'مارلي ديلينا إكسليوسف رويال\r\n\r\nحجم 75مل\r\n\r\nعن العطر:\r\n\r\nعطر زهري للنساء، يحمل سر جمال الشرق، ويمنحكِ دفعة من الحسية القوية ليجعلكِ مصدر إغواء لا يقاوم، مع مزيج رائع من الكمثرى والورد التركي والعنبر والفانيليا', NULL, 1, '2022-09-20 02:18:32', '2022-09-20 02:18:32'),
(296, 74, 145, 'فستان سهرات', 5, '5003052', '1663684589_-5773887113866101253_121.jpg', 9500, 0, 'فستان سهرات تركي   خامة بارده مطرز ero  المقاسات 35/48', NULL, 1, '2022-09-20 02:18:54', '2022-09-20 02:18:54'),
(297, 74, 159, 'زيت تساقط الشعر ', 55, '50004612', '1663629765_IMG_20220920_021945_568.jpg', 4300, 0, 'قطرة الشعر  .... مع المجموعه الكامله لمنع تساقط الشعر😍', NULL, 1, '2022-09-20 02:22:45', '2022-09-20 02:22:45'),
(298, 74, 145, 'جاكت رجالي', 4, '', '1663629917_1 (103).jpg', 3500, 0, 'جاكت رجالي راقي وفخامة نوعية ممتازه وقماش درجة اولى \r\n\r\nجديد وحصري ', NULL, 1, '2022-09-20 02:25:17', '2022-09-20 02:25:17'),
(300, 74, 163, 'حافظة طعام', 57, '50006013', '1663630287_1 (1).jpg', 1200, 0, '', NULL, 0, '2022-09-20 02:31:27', '2022-09-20 02:31:27'),
(301, 74, 145, 'كوت رجالي ', 4, '5003810', '1663630484_IMG_20220830_015403_250.jpg', 15000, 0, 'كوت خارجي تصميم هندي قماش جودة عالية \r\n\r\nاللوان ومقاسات متعددة اناقة شبابية ', NULL, 1, '2022-09-20 02:34:44', '2022-09-20 02:34:44'),
(302, 74, 163, 'حافظة طعام', 57, '50006013', '1663630530_1 (1).jpg', 1200, 0, '', NULL, 1, '2022-09-20 02:35:30', '2022-09-20 02:35:30'),
(303, 74, 163, 'فرشة دهان بالعلبة ', 57, '50006017', '1663630656_1 (14).jpg', 1400, 0, 'فرشة دهان بالعلبة تركي', NULL, 1, '2022-09-20 02:37:36', '2022-09-20 02:37:36'),
(305, 74, 145, 'فنيلة رياضية شبابي ', 4, '503014', '1663630890_1 (74).jpg', 1700, 0, 'فنيلة رياضي قطن طبيعى شفاف خامة باردة  صناعة ايطاليه درجة اولى ', NULL, 1, '2022-09-20 02:41:30', '2022-09-20 02:41:30'),
(306, 74, 157, 'الجردل موب', 0, '', '1663630989_1 (19).jpg', 7500, 0, 'الجردل موب فلات 3\r\nخانات 2 غيار تريند 2022\r\nسعة 14 لتر غيار مايكرو فايبر\r\nماركة Flora  تركي درجة اولى', NULL, 0, '2022-09-20 02:43:09', '2022-09-20 02:43:09'),
(307, 74, 145, 'كوت رسمي ', 4, '500690', '1663631040_IMG_20220830_015357_882.jpg', 3500, 0, 'كوت  رسمي خامة طبيعيه مضمونه صنع هندي ماركة RT ', NULL, 1, '2022-09-20 02:44:00', '2022-09-20 02:44:00'),
(308, 74, 159, 'علاج تساقط الشعر', 55, '50006019', '1663631086_1 (21).jpg', 7500, 0, '', NULL, 1, '2022-09-20 02:44:46', '2022-09-20 02:44:46'),
(311, 74, 145, 'شميز رجالي ', 4, '50853001', '1663631463_IMG_20220830_015407_591.jpg', 4400, 0, 'شميز رجالي ماركة خامات راقية وفاخره صناعة هندية درجة اولى ', NULL, 1, '2022-09-20 02:51:03', '2022-09-20 02:51:03'),
(312, 74, 145, 'بنطلون جنز رجالي ', 4, '5004820', '1663631574_IMG_20220830_015230_460.jpg', 5400, 0, 'بنطلون رجالي جنس فاخر ضبغة ممتازة ماركة معروفة والاكثر ملبعا في الاسواق ', NULL, 1, '2022-09-20 02:52:54', '2022-09-20 02:52:54'),
(313, 74, 159, 'زيت تساقط الشعر ', 55, '50004612', '1663631600_IMG_20220920_021945_568.jpg', 4300, 0, 'قطرة الشعر  .... مع المجموعه الكامله لمنع تساقط الشعر😍', NULL, 1, '2022-09-20 02:53:20', '2022-09-20 02:53:20'),
(314, 74, 145, 'بنطلون جنز رجالي ', 4, '5004544', '1663631686_IMG_20220830_015233_688.jpg', 5000, 0, 'بنطلون كتان فاخر درجة اولى مضمون صبغة عالية الثبات \r\n\r\nماركة عالمية ASG', NULL, 1, '2022-09-20 02:54:46', '2022-09-20 02:54:46'),
(315, 74, 145, 'بنطلون جنز شبابي ', 4, '5001232', '1663631804_IMG_20220830_015233_688.jpg', 8500, 0, 'بنطلون جنز ممتاز لمعان عالى الجودة خامه خفيفه مع تفحيطات فريدة ', NULL, 1, '2022-09-20 02:56:44', '2022-09-20 02:56:44'),
(316, 74, 155, 'صندل رجالي مفتوح', 59, '5000125', '1683829001_bird_waves_sea_horizon_wings_85424_1920x1080.jpg', 11500, 12, 'صندل رجالي مفتوح جلد مدبوغ نوعية خامه وفريدة نتميز بالفخامة والرقى', '', 0, '2022-09-20 02:58:54', '2022-09-20 02:58:54'),
(317, 74, 145, 'بنطلون جنز شبابي ', 4, '5006605', '1663631987_IMG_20220830_015233_688.jpg', 8500, 0, 'جنس رجالي ', NULL, 1, '2022-09-20 02:59:47', '2022-09-20 02:59:47'),
(318, 74, 145, 'جاكيت نسائي ', 5, '50030043', '1663632051_IMG_20220830_015305_113.jpg', 4000, 0, 'جاكت نسائى ', NULL, 1, '2022-09-20 03:00:51', '2022-09-20 03:00:51'),
(319, 74, 159, 'زيت ايمامي للشعر', 55, '5000802', '1663632097_1 (217).jpg', 7500, 0, 'زيت ايمامي للشعر الأصلي \r\n200مل +هدية شامبو كيش كينج صغير ترميم شعرك التالف \r\nسيعمل على منع التساقط \r\nحيث انه يتكون من 7 زيوت مميزة لتحصلي على فوائد 7 زيوت في زجاجة واحدة', NULL, 1, '2022-09-20 03:01:37', '2022-09-20 03:01:37'),
(320, 74, 161, 'كريم اساس نوت ', 53, '5000803', '1663632120_-5841652102840040020_120.jpg', 4600, 0, 'وصل وصل وصل تاني🙈\r\n\r\nكريم اساس نوت يوفر لكي تغطيه كاملة وجماليه لبشره ومظهر طبيعي للغايه\r\nيحتوي ع واقي من الشمس💥\r\nومعالج بزيووت طبيعيه وفيتامينE ليمنحك تغطيه مثاليه وعنايه فائقه 💞\r\n', NULL, 1, '2022-09-20 03:02:00', '2022-09-20 03:02:00'),
(321, 74, 145, 'كوت رجالي ', 4, '5003005', '1663632157_IMG_20220830_015342_281.jpg', 12500, 0, 'كوت رجالي رسمي راقي قاش طبيعي مقام للظروف المحيطه \r\n\r\nجودة ممتازه صناعه هنديه ', NULL, 1, '2022-09-20 03:02:37', '2022-09-20 03:02:37'),
(323, 74, 163, 'طقم الضيافة ', 58, '520752', '1663632289_IMG_20220830_015506_265.jpg', 5000, 0, 'ادوات طقم الضيافة تتكون من ثلاجه صنع ياباني متوفرلة في كافة اللوان مع طقم كاسات زجاج بارق ولماع ', NULL, 1, '2022-09-20 03:04:49', '2022-09-20 03:04:49'),
(324, 74, 145, 'بجامة  بناتي ', 37, '500656', '1663632410_IMG_20220830_015841_230.jpg', 1500, 0, 'طقم متكامل بجامه مع جزمه شتويه راقيه فخامه كي تتميز في كافة الاجواء مع افضل الماركات ', NULL, 1, '2022-09-20 03:06:50', '2022-09-20 03:06:50'),
(325, 74, 161, 'كريم اساس موناليزا', 53, '5000805', '1663632446_1 (195).jpg', 2000, 0, 'تركيبتة مائية تندمج مع البشرة بسهولة دون اي تكتلات', NULL, 1, '2022-09-20 03:07:26', '2022-09-20 03:07:26'),
(326, 74, 155, 'صندل رجالي ابو حزا', 59, '500978', '1683829111_close-up_dandelion_stem_flower_68202_1920x1080.jpg', 1150, 5000, ':(صندل رجالي ابو حزام برمائي ضد الماء ملائم لكافة الاحوال من ماركات رولكس ثناعة ايطالية', '776756', 1, '2022-09-20 03:08:34', '2022-09-20 03:08:34'),
(327, 74, 145, 'بنطلون جنز رجالي ', 4, '546820', '1663632578_IMG_20220830_015240_736.jpg', 4200, 0, 'بنطلون رجالي جودة وتااقة وماركة معروفه ', NULL, 1, '2022-09-20 03:09:38', '2022-09-20 03:09:38'),
(329, 74, 159, 'شامبو كيش كينج ', 55, '5000804', '1663680837_-5846130065807621507_121.jpg', 1300, 0, '\r\nنفس مكونات شامبو كيش كنج بس الفرق ان دا ترطيبة اعلي بكتيررر كمان يعني ولا محتاجة بلسم ولا حمام كريم اقسم بالله ريحته تحفه تحفه كرتونه واحده اللي وصلت اللي تلحق بقي وبسعر🔥🔥🔥🔥\r\n\r\nشامبو كيش كينج 340 ملي ببروتين الحليب واعشاب الطب الايروفيدي الهندي الجدييييد وحصري لإصلاح الأضرار ~ بسبب الحرارة والمعالجة الكيميائية من أول غسلة \r\n\r\nيقلل من تساقط الشعر 😍\r\n\r\nيتكون من بروتين الحليب و 21 نوع من الأعشاب الأيروفيدك\r\n\r\nيتركك بشعر ناعم ولامع بشكل ملحوظ😍\r\n\r\nيغذي الشعر من الجذور ، ويترك الشعر جميلاً وقوياً بشكل واضح😍\r\n\r\nلا يحتوي على بارابين😍\r\n\r\nخالية من المواد الكيميائية الضارة\r\n\r\nخالي من القسوة ومعتمد من إدارة الغذاء والدواء\r\n\r\nمناسبة لجميع أنواع الشعر\r\n\r\nمناسب لجميع أفراد الأسرة\r\n\r\nالمكونات الرئيسية\r\n\r\nينشط بصيلات الشعر مما ينتج عنه شعر أقوى\r\n\r\nيمنع شيب الشعر\r\n\r\nيرطب ويلطف الشعر\r\n\r\nيجعل الشعر يبدو أكثر صحة ولمعاناً ونعومة\r\n\r\nيقوي ويصلح خصلات الشعر\r\n\r\nيعزز نمو الشعر.\r\n\r\nيفيد في تقوية الشعر وجعله ناعماً.\r\n\r\nيساعد في إزالة القشرة.\r\nيتركك بشعر ناعم ولامع\r\n\r\nيغذي الشعر من الجذور ، ويترك الشعر جميلاً وقوياً بشكل واضح \r\n\r\nتعليمات الإستخدام\r\n\r\n~ تلف الشعر يشير إلى الشعر الجاف والباهت والخشن الذي يصعب التحكم فيه\r\n\r\n* استنادًا إلى دراسات مفيدة حول الشعر الأسود الهندي المعالج التالف مقابل الشعر التالف غير المعالج\r\n', NULL, 1, '2022-09-20 16:33:57', '2022-09-20 16:33:57'),
(331, 74, 161, 'مكياج', 53, '50008020', '1663699119_1 (87).jpg', 4500, 0, '', NULL, 1, '2022-09-20 21:38:39', '2022-09-20 21:38:39'),
(332, 74, 145, 'بنطلون جنز رجالي ', 4, '5006222', '1663699240_1 (67).jpg', 9500, 0, 'بنطلون رجالي ماركة ممتازه خامة درجة اولى ', NULL, 1, '2022-09-20 21:40:40', '2022-09-20 21:40:40'),
(333, 74, 161, 'قلم حواجب', 53, '5000821', '1663699285_1 (47).jpg', 750, 0, '', NULL, 1, '2022-09-20 21:41:25', '2022-09-20 21:41:25'),
(334, 74, 159, 'معطر جسم', 54, '5000822', '1663699455_1 (176).jpg', 2000, 0, '', NULL, 1, '2022-09-20 21:44:15', '2022-09-20 21:44:15'),
(335, 74, 159, 'جهاز أزالة الشعر', 54, '5000824', '1663699805_1 (167).jpg', 7000, 0, 'اشتري المنتج الان\r\nفالكمية  محدودة \r\n\r\n', NULL, 1, '2022-09-20 21:50:05', '2022-09-20 21:50:05'),
(336, 74, 145, 'بنطلون جنز رجالي ', 4, '5006222', '1663699873_1 (67).jpg', 9500, 0, 'بنطلون رجالي ماركة ممتازه خامة درجة اولى ', NULL, 1, '2022-09-20 21:51:13', '2022-09-20 21:51:13'),
(337, 74, 159, 'كريم فازلين  ', 54, '5000825', '1663699953_1 (126).jpg', 1400, 0, 'كريم فازلين لليدين والاظافر ', NULL, 1, '2022-09-20 21:52:33', '2022-09-20 21:52:33'),
(338, 74, 159, 'استشوارKemel', 55, '5000826', '1663700373_1 (157).jpg', 12000, 0, '', NULL, 1, '2022-09-20 21:59:33', '2022-09-20 21:59:33'),
(339, 74, 161, 'روائح', 51, '5000829', '1663700498_1 (200).jpg', 700, 0, '', NULL, 1, '2022-09-20 22:01:38', '2022-09-20 22:01:38'),
(340, 74, 160, 'حقايب ', 48, '5000830', '1663701147_1 (399).jpg', 6500, 0, 'حقايب كوريا\r\n نوعية جديدة بتصميم اكثر من رائع \r\nتتوفر بأكثر من لون', NULL, 2, '2022-09-20 22:12:27', '2022-09-20 22:12:27'),
(341, 74, 145, 'طقم بناتي شتوي', 37, '5000834', '1663701334_1 (265).jpg', 9000, 0, 'طقم بناتي تركي \r\nخامة ناعمة ونوع ممتاز\r\nتتوفر بمقاسات تبداء من سن 23 سنين\r\n\r\nوبألون متنوعة ', NULL, 1, '2022-09-20 22:15:34', '2022-09-20 22:15:34'),
(342, 74, 161, 'طقم هدايا نسائي ', 52, '50008260', '1663702657_-6003352729566687916_121.jpg', 23000, 0, '', NULL, 1, '2022-09-20 22:37:37', '2022-09-20 22:37:37'),
(343, 74, 145, 'طقم بناتي ', 37, '50008031', '1663703172_-5931491767721505719_121.jpg', 6400, 0, '', NULL, 1, '2022-09-20 22:46:12', '2022-09-20 22:46:12'),
(344, 74, 163, 'قالب كيك جرانيت مخرم', 58, '5000701', '1663703359_1 (308).jpg', 1500, 0, 'قالب كيك جرانيت مخرم\r\nمدور لعمل احلى كيك في المنزل بشكل \r\nجديد عملى جدا\r\n', NULL, 1, '2022-09-20 22:49:19', '2022-09-20 22:49:19'),
(345, 74, 163, 'طقم براد شاي بيركس', 58, '5000702', '1663703549_1 (313).jpg', 12000, 0, 'طقم براد شاي بيركس\r\n للتقديم فقط \r\nعبارة عن براد +  4 مج شاي \r\n', NULL, 1, '2022-09-20 22:52:29', '2022-09-20 22:52:29'),
(346, 74, 145, 'طقم بناتي ', 37, '50008034', '1663703640_-5931491767721505723_121.jpg', 6900, 0, '', NULL, 1, '2022-09-20 22:54:00', '2022-09-20 22:54:00'),
(347, 74, 157, 'ديسبنسر الصابون (1X2)', 0, '5000712', '1663703912_1 (320).jpg', 4200, 0, 'ديسبنسر الصابون (1X2)\r\n\r\nالديسبنسر مصنوعة من الاكريلك والخزان\r\nتبعه 400 ملي ', NULL, 0, '2022-09-20 22:58:32', '2022-09-20 22:58:32'),
(348, 74, 163, 'سكسنة مخلل', 58, '5000717', '1663704037_1 (322).jpg', 1200, 0, '', NULL, 1, '2022-09-20 23:00:37', '2022-09-20 23:00:37'),
(349, 74, 163, 'طقم توابل فراولة', 57, '50007121', '1663704179_1 (325).jpg', 5200, 0, 'طقم توابل فراولة\r\n2دور زجاج على شكل فرولة\r\nبالحامل والمعالق ', NULL, 1, '2022-09-20 23:02:59', '2022-09-20 23:02:59'),
(350, 74, 163, 'هوك مقلايه جرانيت', 57, '5000733', '1663704724_1 (330).jpg', 16000, 0, 'هوك مقلايه جرانيت اصلي\r\n\r\nمقاس 35سم\r\nعميقة جدا عمق 15سم\r\nمحمية بيد سيلكون لعزل السخونيه', NULL, 1, '2022-09-20 23:12:04', '2022-09-20 23:12:04'),
(351, 74, 163, 'طقم بولات زجاج ', 57, '50007201', '1663704852_1 (335).jpg', 1780, 0, '', NULL, 1, '2022-09-20 23:14:12', '2022-09-20 23:14:12'),
(352, 74, 157, 'مساحة مثلثه ', 0, '50007341', '1663705039_1 (338).jpg', 6000, 0, 'مساحة مثلثة\r\nبيد استانليس\r\nللارضيات والأسقف \r\nلكافة الاستخدامات المنزلية\r\nخامة مايكروفيبر', NULL, 0, '2022-09-20 23:17:19', '2022-09-20 23:17:19'),
(353, 74, 163, 'طاجن بايركس بالغطاء', 57, '50008211', '1663705289_1 (364).jpg', 8500, 0, 'طاجن بايركس بالغطاء\r\nللفرن والمايكرويف\r\nمقاس 20سم', NULL, 1, '2022-09-20 23:21:29', '2022-09-20 23:21:29'),
(355, 74, 145, 'طقم نسائي ', 5, '50008121', '1663705631_-5911379973472631096_121.jpg', 17500, 0, 'طقم تركي مع الحجاب\r\n\r\nبألوان ومقاسات متنوعة ', NULL, 1, '2022-09-20 23:27:11', '2022-09-20 23:27:11'),
(356, 74, 145, 'طقم بناتي ', 37, '50008034', '1663705692_-5931491767721505723_121.jpg', 6900, 0, '', NULL, 1, '2022-09-20 23:28:12', '2022-09-20 23:28:12'),
(357, 75, 167, 'غرف نوم ', 59, '50009211', '1663706783_1 (103).jpg', 420000, 0, '', NULL, 1, '2022-09-20 23:46:23', '2022-09-20 23:46:23'),
(358, 75, 167, 'غرف نوم عرئسي', 59, '5000921', '1663707148_1 (66).jpg', 760000, 0, '', NULL, 1, '2022-09-20 23:52:28', '2022-09-20 23:52:28'),
(359, 75, 167, 'دولاب', 59, '5000922', '1663707198_1 (79).jpg', 23000, 0, '', NULL, 1, '2022-09-20 23:53:18', '2022-09-20 23:53:18'),
(360, 75, 167, 'غرف نوم ', 59, '5000923', '1663707275_1 (94).jpg', 340000, 0, '', NULL, 1, '2022-09-20 23:54:35', '2022-09-20 23:54:35'),
(361, 75, 167, 'مجلس عربي ', 59, '5000925', '1663707600_1 (440).jpg', 420000, 0, '', NULL, 1, '2022-09-21 00:00:00', '2022-09-21 00:00:00'),
(362, 75, 167, 'دولاب كتب', 59, '5000926', '1663707647_1 (439).jpg', 19000, 0, '', NULL, 1, '2022-09-21 00:00:47', '2022-09-21 00:00:47'),
(363, 75, 167, 'مجلس عربي ', 59, '5000927', '1663707694_1 (441).jpg', 342000, 0, '', NULL, 1, '2022-09-21 00:01:34', '2022-09-21 00:01:34'),
(364, 75, 167, 'مجلس عربي', 59, '5000929', '1663707740_1 (442).jpg', 421000, 0, '', NULL, 1, '2022-09-21 00:02:20', '2022-09-21 00:02:20'),
(365, 75, 167, 'كنب مجالس', 59, '5000928', '1663707797_1 (470).jpg', 15000, 0, '', NULL, 1, '2022-09-21 00:03:17', '2022-09-21 00:03:17'),
(366, 75, 167, 'ساعات حائط', 59, '5000821', '1663707899_1 (859).jpg', 1300, 0, '', NULL, 1, '2022-09-21 00:04:59', '2022-09-21 00:04:59'),
(367, 75, 167, 'حاملة مناديل', 59, '5000921', '1663707963_1 (598).jpg', 1500, 0, '', NULL, 1, '2022-09-21 00:06:03', '2022-09-21 00:06:03'),
(368, 76, 134, 'طقم بناتي', 37, '50009211', '1663708663_1 (491).jpg', 5600, 0, '', NULL, 1, '2022-09-21 00:17:43', '2023-05-09 21:49:46'),
(369, 76, 134, 'طقم بناتيي', 37, '5000823', '1663708697_1 (485).jpg', 12000, 0, '', NULL, 1, '2022-09-21 00:18:17', '2022-09-21 00:18:17'),
(370, 76, 134, 'فستان بناتي', 37, '50600131', '1663708770_1 (488).jpg', 12000, 0, '', NULL, 1, '2022-09-21 00:19:30', '2022-09-21 00:19:30'),
(371, 76, 134, 'طقم  بناتي', 37, '5000822', '1663708819_1 (494).jpg', 7500, 0, '', NULL, 1, '2022-09-21 00:20:19', '2022-09-21 00:20:19'),
(372, 76, 134, 'طقم  بناتي', 37, '50008212', '1663708862_1 (492).jpg', 8500, 0, '', NULL, 1, '2022-09-21 00:21:02', '2022-09-21 00:21:02'),
(373, 76, 138, 'حافظة طعام', 57, '50600291', '1663708902_1 (502).jpg', 2300, 0, '', NULL, 1, '2022-09-21 00:21:42', '2022-09-21 00:21:42'),
(374, 76, 138, 'حافظة طعام', 57, '50600292', '1663708950_1 (514).jpg', 12000, 0, '', NULL, 1, '2022-09-21 00:22:30', '2022-09-21 00:22:30'),
(375, 76, 146, 'حقايب', 48, '50600293', '1663709025_1 (683).jpg', 7500, 0, '', NULL, 1, '2022-09-21 00:23:45', '2022-09-21 00:23:45'),
(376, 76, 134, 'فستان سهرات قصير', 5, '50008213', '1663709073_1 (447).jpg', 8200, 0, '', NULL, 1, '2022-09-21 00:24:33', '2022-09-21 00:24:33'),
(385, 74, 37, 'جزمةرقف', 59, '8797', '1683829790_bird_yellow_branch_210515_3840x2160.jpg', 3, 123, '787', 'بيىلا65', 1, '2023-05-09 21:15:50', '2023-05-09 21:15:50'),
(386, 74, 4, 'عصفور', 58, '23432', '1683658405_bird_yellow_branch_210515_3840x2160.jpg', 15000, 5000, 'لاترد', '', 1, '2023-05-09 21:53:25', '2023-05-09 21:53:25'),
(387, 74, 37, 'car', 59, '3234233', '1683830275_porsche_cayman_porsche_car_266168_2560x1080.jpg', 12000, 23, 'dssc', 'sdfsfsdsf', 1, '2023-05-11 21:37:55', '2023-05-11 21:37:55'),
(388, 74, 37, 'car', 59, '3234233', '1683830282_porsche_cayman_porsche_car_266168_2560x1080.jpg', 12000, 23, 'dssc', 'sdfsfsdsf', 1, '2023-05-11 21:38:02', '2023-05-11 21:38:02'),
(389, 74, 37, 'car', 59, '3234233', '1683830397_porsche_cayman_porsche_car_266168_2560x1080.jpg', 12000, 23, 'dssc', 'sdfsfsdsf', 1, '2023-05-11 21:39:57', '2023-05-11 21:39:57'),
(390, 74, 37, 'اخراص مطلي', 60, '23432', '1683849305_wolf_predator_wildlife_261567_2560x1080.jpg', 5000, 77, '', 'بيىلا65', 1, '2023-05-12 02:55:05', '2023-05-12 02:55:05'),
(391, 74, 37, 'بقدونس', 59, '8797', '1683849474_star_glow_rays_359316_3840x2160.jpg', 5000, 12, 'لاترد', '776756', 1, '2023-05-12 02:57:54', '2023-05-12 02:57:54'),
(392, 74, 158, 'بقدونس', 59, '14214', '1683918899_wolf_predator_animal_261895_2560x1080.jpg', 5000, 123, 'قابل لل ارجاع', '776756', 2, '2023-05-12 22:14:59', '2023-05-12 22:14:59'),
(393, 74, 155, 'osa', 43, '8797', '1683992726_IMG_20220723_101629_610.jpg', 78, 123, 'قابل لل ارجاع', 'جميل', 1, '2023-05-13 18:45:26', '2023-05-13 18:45:26'),
(394, 74, 155, 'بقدونس', 43, '', '1684012881_IMG_20220723_101744_121.jpg', 3500, 0, '', '', 1, '2023-05-14 00:21:21', '2023-05-14 00:21:21'),
(395, 74, 175, 'تيشرت احمر', 4, '', '1684776401_10.jpg', 5000, 0, 'لاترد', '', 1, '2023-05-22 20:26:41', '2023-05-22 20:26:41'),
(396, 74, 175, 'تيشرت احمر', 4, '', '1684776404_10.jpg', 5000, 0, 'لاترد', '', 1, '2023-05-22 20:26:44', '2023-05-22 20:26:44'),
(397, 74, 175, 'تيشرت احمر', 4, '', '1684776480_10.jpg', 5000, 0, 'لاترد', '', 1, '2023-05-22 20:28:00', '2023-05-22 20:28:00'),
(398, 74, 175, 'تيشرت احمر', 4, '', '1684776482_10.jpg', 5000, 0, 'لاترد', '', 1, '2023-05-22 20:28:02', '2023-05-22 20:28:02');
INSERT INTO `product` (`product_id`, `com_id`, `id_depart_com`, `product_title`, `product_cat`, `QR_number`, `product_image`, `price`, `opponent`, `product_desc`, `notice`, `status_pro`, `dateAdded`, `datemodified`) VALUES
(399, 74, 175, 'تيشرت منتخب البرتغال', 4, '0', '1684776713_4.jpg', 5000, 0, '0', '0', 1, '2023-05-22 20:31:53', '2023-05-22 20:31:53'),
(400, 74, 175, 'تيشرت منتخب البرتغال', 4, '0', '1684776717_4.jpg', 5000, 0, '0', '0', 1, '2023-05-22 20:31:57', '2023-05-22 20:31:57'),
(401, 74, 175, 'تيشرت منتخب البرتغال', 4, '0', '1684776767_4.jpg', 5000, 0, '0', '0', 1, '2023-05-22 20:32:47', '2023-05-22 20:32:47'),
(402, 74, 175, 'تيشرت احمر', 4, '', '1684776904_12.jpg', 3500, 0, 'لاترد', '', 1, '2023-05-22 20:35:04', '2023-05-22 20:35:04'),
(403, 74, 175, 'تيشرت احمر', 4, '', '1684776907_12.jpg', 3500, 0, 'لاترد', '', 1, '2023-05-22 20:35:07', '2023-05-22 20:35:07'),
(407, 74, 155, 'ssm', 98, 'serww324', '_1716327867.jpg', 1221, 123, 'fffff', '3423rwedsdfs', 1, '2024-05-22 00:44:27', '2024-05-22 00:44:27'),
(408, 74, 155, 'ssm', 98, 'serww324', '_1716328021.jpg', 1221, 123, 'fffff', '3423rwedsdfs', 1, '2024-05-22 00:47:01', '2024-05-22 00:47:01'),
(409, 0, 0, '', 0, '', '1.png', 0, 0, NULL, NULL, 1, '2024-05-24 03:37:56', '2024-05-24 03:37:56'),
(410, 43, 341, ' ww', 45646, ' 212', '1.png', 12, 12, NULL, NULL, 1, '2024-05-24 03:40:15', '2024-05-24 03:40:15'),
(411, 43, 341, ' ww', 45646, ' 212', '1.png', 12, 12, NULL, NULL, 1, '2024-05-24 03:40:34', '2024-05-24 03:40:34'),
(412, 43, 341, ' ww', 45646, ' 212', '1.png', 12, 12, NULL, NULL, 1, '2024-05-24 03:40:45', '2024-05-24 03:40:45'),
(413, 43, 341, ' qqq', 45646, ' 111', '1.png', 123, 12, NULL, NULL, 1, '2024-05-24 03:57:11', '2024-05-24 03:57:11'),
(414, 43, 341, ' qqq', 45646, ' 111', '1.png', 123, 12, NULL, NULL, 1, '2024-05-24 03:57:43', '2024-05-24 03:57:43'),
(415, 43, 341, '', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:35:36', '2024-05-25 02:35:36'),
(416, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:36:54', '2024-05-25 02:36:54'),
(417, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:37:38', '2024-05-25 02:37:38'),
(418, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:43:41', '2024-05-25 02:43:41'),
(419, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:48:51', '2024-05-25 02:48:51'),
(420, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:49:06', '2024-05-25 02:49:06'),
(421, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:49:14', '2024-05-25 02:49:14'),
(422, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:49:37', '2024-05-25 02:49:37'),
(423, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:49:46', '2024-05-25 02:49:46'),
(424, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:49:59', '2024-05-25 02:49:59'),
(425, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:53:25', '2024-05-25 02:53:25'),
(426, 43, 341, ' qqqqqqqqqqqqqqq', 45646, ' 2342', '1.png', 123, 23, NULL, NULL, 1, '2024-05-25 02:54:50', '2024-05-25 02:54:50'),
(427, 43, 341, ' 111111111111', 45646, ' ', '1.png', 11111111111111, 12, NULL, NULL, 1, '2024-05-25 02:58:40', '2024-05-25 02:58:40'),
(428, 43, 341, ' 111111111', 45646, ' ', '1.png', 11111111, 12, NULL, NULL, 1, '2024-05-25 02:59:25', '2024-05-25 02:59:25'),
(429, 43, 341, ' 111111111', 45646, ' 11', '1.png', 11111111, 12, NULL, NULL, 1, '2024-05-25 03:00:19', '2024-05-25 03:00:19'),
(430, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:00:53', '2024-05-25 03:00:53'),
(431, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:02:36', '2024-05-25 03:02:36'),
(432, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:04:29', '2024-05-25 03:04:29'),
(433, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:04:39', '2024-05-25 03:04:39'),
(434, 43, 341, ' 1111111111', 0, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:04:55', '2024-05-25 03:04:55'),
(435, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:05:36', '2024-05-25 03:05:36'),
(436, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:07:06', '2024-05-25 03:07:06'),
(437, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:07:22', '2024-05-25 03:07:22'),
(438, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:08:05', '2024-05-25 03:08:05'),
(439, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:08:59', '2024-05-25 03:08:59'),
(440, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:10:04', '2024-05-25 03:10:04'),
(441, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:10:30', '2024-05-25 03:10:30'),
(442, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:10:32', '2024-05-25 03:10:32'),
(443, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:11:48', '2024-05-25 03:11:48'),
(444, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:12:03', '2024-05-25 03:12:03'),
(445, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:13:20', '2024-05-25 03:13:20'),
(446, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:13:41', '2024-05-25 03:13:41'),
(447, 43, 341, ' 1111111111', 45646, ' 1111', '1.png', 11111111, 1111111, NULL, NULL, 1, '2024-05-25 03:14:10', '2024-05-25 03:14:10'),
(448, 43, 341, ' 44444444444', 45646, ' 444444', '1.png', 444444444, 44444444, NULL, NULL, 1, '2024-05-25 03:15:35', '2024-05-25 03:15:35'),
(449, 43, 341, ' 44444444444', 45646, ' 444444', '1.png', 444444444, 44444444, NULL, NULL, 1, '2024-05-25 03:16:29', '2024-05-25 03:16:29'),
(450, 43, 341, ' 44444444444', 45646, ' 444444', '1.png', 444444444, 44444444, NULL, NULL, 1, '2024-05-25 03:17:04', '2024-05-25 03:17:04'),
(451, 43, 341, ' 44444444444', 45646, ' 444444', '1.png', 444444444, 44444444, NULL, NULL, 1, '2024-05-25 03:17:36', '2024-05-25 03:17:36'),
(452, 74, 155, ' 7', 24574, ' 7', '1.png', 47, 7, NULL, NULL, 1, '2024-06-11 22:01:06', '2024-06-11 22:01:06'),
(453, 74, 156, ' 8', 0, ' 8', '1.png', 8, 8, NULL, NULL, 1, '2024-06-11 22:21:41', '2024-06-11 22:21:41'),
(454, 74, 155, ' 8', 24561, ' 8', '1.png', 8, 8, NULL, NULL, 1, '2024-06-11 22:22:39', '2024-06-11 22:22:39'),
(455, 74, 155, ' 9', 24561, ' 9', '1.png', 9, 9, NULL, NULL, 1, '2024-06-11 22:25:46', '2024-06-11 22:25:46'),
(456, 43, 341, ' 9', 45646, ' 9', '1.png', 9, 9, NULL, NULL, 1, '2024-06-11 23:26:18', '2024-06-11 23:26:18'),
(457, 43, 341, ' 11', 45646, ' ', '1.png', 11, 11, NULL, NULL, 1, '2024-06-11 23:57:13', '2024-06-11 23:57:13'),
(458, 43, 341, ' 12', 45646, ' ', '1.png', 12, 12, NULL, NULL, 1, '2024-06-12 00:01:39', '2024-06-12 00:01:39'),
(459, 43, 341, ' 13', 45646, ' ', '1.png', 13, 0, NULL, NULL, 1, '2024-06-12 00:08:53', '2024-06-12 00:08:53'),
(460, 43, 341, ' 14', 45646, ' ', '1.png', 14, 14, NULL, NULL, 1, '2024-06-12 00:12:28', '2024-06-12 00:12:28'),
(461, 43, 341, ' 15', 45646, ' ', '1.png', 15, 0, NULL, NULL, 1, '2024-06-12 00:20:21', '2024-06-12 00:20:21'),
(462, 43, 341, ' 20', 45646, ' ', '1.png', 2, 0, NULL, NULL, 1, '2024-06-12 00:23:31', '2024-06-12 00:23:31'),
(463, 43, 341, ' 20', 45646, ' ', '1.png', 2, 0, NULL, NULL, 1, '2024-06-12 00:24:05', '2024-06-12 00:24:05'),
(464, 43, 341, ' 21', 45646, ' ', '1.png', 21, 12, NULL, NULL, 1, '2024-06-12 00:28:42', '2024-06-12 00:28:42'),
(465, 43, 341, ' 21', 45646, ' ', '1.png', 21, 12, NULL, NULL, 1, '2024-06-12 00:34:58', '2024-06-12 00:34:58'),
(466, 43, 341, ' 21', 45646, ' ', '1.png', 21, 12, NULL, NULL, 1, '2024-06-12 00:35:35', '2024-06-12 00:35:35'),
(467, 43, 341, ' 21', 45646, ' ', '1.png', 21, 12, NULL, NULL, 1, '2024-06-12 00:35:49', '2024-06-12 00:35:49'),
(468, 43, 341, ' 21', 45646, ' ', '1.png', 21, 21, NULL, NULL, 1, '2024-06-12 00:41:12', '2024-06-12 00:41:12'),
(469, 43, 341, ' 21', 45646, ' ', '1.png', 21, 21, NULL, NULL, 1, '2024-06-12 00:41:53', '2024-06-12 00:41:53'),
(470, 43, 341, ' 21', 45646, ' ', '1.png', 21, 21, NULL, NULL, 1, '2024-06-12 00:42:29', '2024-06-12 00:42:29'),
(471, 43, 341, ' 21', 45646, ' ', '1.png', 21, 21, NULL, NULL, 1, '2024-06-12 00:42:31', '2024-06-12 00:42:31'),
(472, 43, 341, ' 21', 45646, ' ', '1.png', 21, 21, NULL, NULL, 1, '2024-06-12 00:42:49', '2024-06-12 00:42:49'),
(473, 43, 341, ' 21', 45646, ' ', '1.png', 21, 21, NULL, NULL, 1, '2024-06-12 00:43:00', '2024-06-12 00:43:00'),
(474, 74, 155, ' 22', 24562, ' ', '1.png', 22, 0, NULL, NULL, 1, '2024-06-12 11:16:31', '2024-06-12 11:16:31'),
(475, 74, 156, ' 23', 0, ' ', '1.png', 23, 23, NULL, NULL, 1, '2024-06-12 11:20:35', '2024-06-12 11:20:35'),
(476, 43, 341, ' 55555', 45646, ' ', '1.png', 55555, 55555, NULL, NULL, 1, '2024-06-12 14:33:10', '2024-06-12 14:33:10'),
(477, 44, 288, ' fh', 24548, ' 67', '1.png', 678, 678, NULL, NULL, 1, '2024-11-13 23:31:41', '2024-11-13 23:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id_product_images` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id_product_images`, `product_id`, `image_path`) VALUES
(1, 283, 'uploads/resized_a.jpg'),
(2, 283, 'uploads/resized_a.jpg'),
(3, 283, 'uploads/resized_a.jpg'),
(4, 283, 'uploads/resized_h.jpg'),
(5, 283, 'uploads/resized_m.jpg'),
(6, 283, 'uploads/resized_s.jpg'),
(7, 412, 'uploads/resized_a.jpg'),
(8, 412, 'uploads/resized_h.jpg'),
(9, 412, 'uploads/resized_m.jpg'),
(10, 412, 'uploads/resized_s.jpg'),
(11, 414, 'uploads/resized_a.jpg'),
(12, 414, 'uploads/resized_h.jpg'),
(13, 414, 'uploads/resized_m.jpg'),
(14, 414, 'uploads/resized_o.jpg'),
(15, 414, 'uploads/resized_s.jpg'),
(16, 426, 'a.jpg'),
(17, 426, 'h.jpg'),
(18, 426, 'm.jpg'),
(19, 426, 's.jpg'),
(20, 428, 'a.jpg'),
(21, 428, 'h.jpg'),
(22, 428, 'm.jpg'),
(23, 428, 's.jpg'),
(24, 429, 'a.jpg'),
(25, 429, 'h.jpg'),
(26, 429, 'm.jpg'),
(27, 429, 's.jpg'),
(28, 430, 'a.jpg'),
(29, 430, 'h.jpg'),
(30, 430, 'm.jpg'),
(31, 430, 's.jpg'),
(32, 436, 'a.jpg'),
(33, 436, 'h.jpg'),
(34, 436, 'm.jpg'),
(35, 436, 's.jpg'),
(36, 437, 'a.jpg'),
(37, 437, 'h.jpg'),
(38, 437, 'm.jpg'),
(39, 437, 's.jpg'),
(40, 438, 'a.jpg'),
(41, 438, 'h.jpg'),
(42, 438, 'm.jpg'),
(43, 438, 's.jpg'),
(44, 449, 'a.jpg'),
(45, 449, 'h.jpg'),
(46, 449, 'm.jpg'),
(47, 449, 's.jpg'),
(48, 451, 'a.jpg'),
(49, 451, 'h.jpg'),
(50, 452, '_1714329284.jpg'),
(51, 452, '_1714329678.jpg'),
(52, 452, '_1714330666.jpg'),
(53, 452, '_1714330715.jpg'),
(54, 453, '_1714327788.jpg'),
(55, 453, '_1714327793.jpg'),
(56, 455, ' 74_1718133946.jpg'),
(57, 455, ' 74_1718133946.jpg'),
(58, 455, ' 74_1718133946.jpg'),
(59, 455, ' 74_1718133946.jpg'),
(60, 456, ' 43_456_1718137578.jpg'),
(61, 456, ' 43_456_1718137578.jpg'),
(62, 456, ' 43_456_1718137578.jpg'),
(63, 456, ' 43_456_1718137578.jpg'),
(64, 457, ' 43_457_1718139433.jpg'),
(65, 457, ' 43_457_1718139433.jpg'),
(66, 458, ' 43_458_1718139699.jpg'),
(67, 458, ' 43_458_1718139699.jpg'),
(68, 459, ' 43_1718140133.jpg'),
(69, 459, ' 43_1718140133.jpg'),
(70, 459, ' 43_1718140133.jpg'),
(71, 459, ' 43_1718140133.jpg'),
(72, 460, 'acorn_seed_close_up_110715_2560x1080.jpg'),
(73, 460, 'anonymous_man_mask_268565_2560x1080.jpg'),
(74, 460, 'ball_baseball_closeup_142691_2560x1080.jpg'),
(75, 460, 'bird_color_branch_sit_91637_2560x1080.jpg'),
(76, 461, ' 43_1718140821.jpg'),
(77, 461, ' 43_1718140821.jpg'),
(78, 461, ' 43_1718140821.jpg'),
(79, 461, ' 43_1718140821.jpg'),
(80, 463, ' 43_1718141045.jpg'),
(81, 463, ' 43_1718141045.jpg'),
(82, 463, ' 43_1718141045.jpg'),
(83, 463, ' 43_1718141045.jpg'),
(84, 473, ' 43_1718142180.jpg'),
(85, 473, ' 43_1718142180.jpg'),
(86, 473, ' 43_1718142180.jpg'),
(87, 474, ' 74_1718180191.jpg'),
(88, 474, ' 74_1718180191.jpg'),
(89, 474, ' 74_1718180191.jpg'),
(90, 475, ' 74_475_1718180435.jpg'),
(91, 475, ' 74_475_1718180435.jpg'),
(92, 475, ' 74_475_1718180435.jpg'),
(93, 476, ' 43_476_66698776d44c45.11552075.jpg'),
(94, 476, ' 43_476_66698776d721f0.80291220.jpg'),
(95, 476, ' 43_476_66698776d95e22.91120688.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reactive_company`
--

CREATE TABLE `reactive_company` (
  `id_reac_com_user` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow` tinyint(1) NOT NULL DEFAULT 0,
  `comment` varchar(255) DEFAULT NULL,
  `user_like` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reactive_company`
--

INSERT INTO `reactive_company` (`id_reac_com_user`, `com_id`, `user_id`, `follow`, `comment`, `user_like`) VALUES
(1, 74, 0, 0, '', 0),
(12, 43, 58, 1, '', 1),
(13, 43, 54, 1, '', 0),
(14, 74, 55, 1, '', 1),
(15, 43, 62, 1, '', 1),
(16, 74, 50, 1, '', 1),
(17, 76, 64, 1, 'احلا منتج x', 0),
(18, 74, 64, 1, 'good', 1),
(19, 75, 64, 1, '', 0),
(20, 43, 64, 1, 'احلا منتج x', 1),
(21, 43, 50, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reactive_product`
--

CREATE TABLE `reactive_product` (
  `reactive_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_like` int(1) NOT NULL,
  `cart_status` int(1) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reactive_product`
--

INSERT INTO `reactive_product` (`reactive_product_id`, `product_id`, `user_id`, `user_like`, `cart_status`, `comment`) VALUES
(1, 137, 0, 1, 0, 'حلو '),
(44, 125, 50, 1, 1, 'الصرااحة الف شكر لكم مع تسوق اصبحت حياتنا اسهل '),
(45, 228, 50, 1, 0, ''),
(46, 241, 50, 0, 1, 'ًصندل رووعه'),
(47, 281, 50, 1, 1, 'oooooo'),
(48, 127, 50, 1, 1, 'ads'),
(49, 131, 50, 1, 1, 'good'),
(50, 141, 50, 1, 1, 'الصرااحة الف شكر لكم مع تسوق اصبحت حياتنا اسهل '),
(51, 143, 50, 1, 1, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(52, 124, 50, 1, 0, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(53, 134, 50, 1, 1, 'اتمنى من كافة طاقم العمل ان يتم شرح وتفصيل اكثر عن المنتج وتعربف العملاء عنه ولكم مني جزيل الشكر والعرفان '),
(54, 149, 50, 1, 1, 'good'),
(55, 153, 50, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(56, 155, 50, 1, 0, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(57, 175, 50, 1, 0, ''),
(58, 140, 50, 0, 0, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(59, 135, 50, 1, 1, 'راجع حالك ياعم 500 ايش ياعم 500 مجنون انت والله لو يكون مسروق محد يبيعة بسعر كذا سلامات يابوي وش فيك حرارتك كيييففففف'),
(60, 200, 50, 1, 0, 'الصراحة فنيلة مقاومة لكل التغيرات ومناسبة لكافة الاجواء '),
(61, 176, 50, 1, 1, 'الصرااحة الف شكر لكم مع تسوق اصبحت حياتنا اسهل '),
(62, 139, 50, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(63, 136, 50, 0, 1, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(64, 148, 50, 1, 0, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(65, 159, 50, 1, 0, 'روعةةةةة وتعامل اسهل '),
(66, 174, 50, 1, 0, 'شكله مسروق سعر 500 ههههههههههههههههههههههههه'),
(67, 166, 50, 1, 1, 'واووووووو يهبلللللللللللللللللللللللللللل'),
(68, 292, 50, 1, 0, 'البنت احلا من المنتج تخبللللللل'),
(69, 231, 50, 1, 0, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(70, 328, 50, 1, 0, 'الصرااحة الف شكر لكم مع تسوق اصبحت حياتنا اسهل '),
(71, 296, 50, 1, 0, 'ياحبيبي مين قال لكم انه اسمه فستان سهرة الله يصلحك اسمه درع هندي '),
(72, 209, 50, 1, 0, 'هوه حلو بس اسعاركم تلعب مررررره اوفرررر'),
(73, 199, 50, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(74, 265, 50, 0, 1, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(75, 214, 50, 1, 0, ''),
(76, 217, 50, 1, 1, ''),
(77, 280, 50, 1, 0, ''),
(78, 325, 50, 1, 0, 'الصراحة حلووووو مره ومجربه كان عندي حبوب وراح كل شيء انصح الكل بتجريب المنتج '),
(79, 320, 50, 1, 0, 'الصراحة انتم رائعون انتم الروعة والجمال '),
(80, 331, 50, 1, 0, 'التميز هنا وعالمم الجمال والموضه '),
(81, 333, 50, 1, 0, 'حراااااام عليكم ترى قلم حواجب حقة 100 ريال خيرررررر 750 والله لو يكتب شعر مايطلع سعره كذا'),
(82, 144, 50, 1, 0, 'واووووووو روعه والسعر دمار اريد اربع حبات منهم '),
(83, 180, 50, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(84, 256, 50, 1, 0, 'سبحان كيف اصبحت هندي ياخي يرحم امك اكتب اسماء المنتاجات بدقة '),
(85, 300, 50, 1, 0, 'واوووووووووو'),
(86, 124, 55, 1, 1, 'واووووو جلوووو'),
(87, 134, 55, 1, 1, 'جميلللللللللل'),
(88, 149, 55, 1, 1, 'محمد ثابت جغمان يرحب بكم '),
(89, 137, 55, 1, 1, 'حاحه والله ما راحة'),
(90, 155, 55, 1, 0, 'جميللللللل جدااا'),
(91, 200, 55, 1, 1, 'الشكر والتقدير وجل الاحترام الا مديرنا وحبيبنا الاخ الغالي المحبوب في قلوب الكل أ/ اسامه شحرة '),
(92, 312, 55, 1, 1, 'الصرااحة الف شكر لكم مع تسوق اصبحت حياتنا اسهل '),
(93, 274, 55, 1, 1, 'واووووووووو'),
(94, 215, 55, 1, 1, ''),
(95, 265, 55, 1, 0, 'دام انتم المبدعين وانتم المتميزون وانتم الاشبال واسود البرمجه اتنم '),
(96, 154, 50, 1, 1, ''),
(97, 208, 55, 0, 1, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(98, 128, 50, 1, 1, '55'),
(99, 259, 55, 1, 0, 'oooooo'),
(100, 216, 55, 1, 1, 'واوووووو حسييييننننن '),
(101, 226, 55, 1, 1, 'احبكم كلكم'),
(102, 271, 55, 1, 1, ''),
(103, 124, 56, 0, 0, 'ت'),
(104, 182, 56, 1, 1, 'روعه فين موقعكم '),
(105, 177, 56, 1, 1, 'جميل جدا\" وربي'),
(106, 144, 56, 1, 1, 'روووعه تقصد ١٠٠٠سعودي '),
(107, 187, 56, 1, 1, 'روووعه يجنن صراحه فين الموقع بالله'),
(108, 192, 55, 1, 1, 'اشتريته الا زوجتي وقالت انه حسين جدا الف شكر لكم '),
(109, 177, 55, 1, 1, 'رهف عادي نتعرف'),
(110, 181, 55, 1, 1, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(111, 185, 55, 1, 0, 'روعةةةةة وتعامل اسهل  '),
(112, 343, 55, 1, 1, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(113, 356, 55, 1, 1, 'كاما كاكا'),
(114, 125, 58, 1, 0, 'كيووووت'),
(115, 128, 58, 1, 1, 'واووووو فديتكم '),
(116, 130, 58, 1, 1, 'حلوووووووووو مررره '),
(117, 127, 58, 1, 1, 'الصراحة يخبللللللل'),
(118, 131, 58, 1, 0, 'ياحبي لكم احبكممممم'),
(119, 136, 58, 1, 1, 'ياويلييييييي نااااارررر'),
(120, 139, 58, 1, 1, 'ينفع لي بعد الزواج مب الحين '),
(121, 239, 50, 0, 1, ''),
(122, 143, 58, 1, 0, 'الصرااحة الف شكر لكم مع تسوق اصبحت حياتنا اسهل '),
(123, 159, 58, 1, 1, 'واوووو حبيتتتتتتتتتت'),
(124, 174, 58, 1, 1, 'باخذه لانه وردي'),
(125, 133, 58, 1, 0, 'حبيتتتتتتتتتت'),
(126, 237, 58, 1, 1, 'مناسب ومرررره حلووووو'),
(127, 141, 58, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(128, 137, 58, 1, 1, ''),
(129, 134, 58, 1, 1, 'جغمان حبيتككك نتعرف '),
(130, 149, 58, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(131, 146, 58, 1, 1, 'الصراحة اشكركم من اعماق قلبي اجمل هدية جبتها الا اخي في عيد ميلاده الله يسعدك شكرا تسوق'),
(132, 127, 60, 1, 0, ''),
(133, 146, 60, 1, 1, 'خاماتهم حلووة بس السعر غالي شوي'),
(134, 147, 58, 1, 1, 'مب حلووووو يعععععع فيه تمساح '),
(135, 270, 54, 1, 1, ''),
(136, 215, 54, 1, 1, ''),
(137, 150, 58, 1, 1, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(138, 183, 58, 1, 0, 'احبكمممممممممممممممممممم'),
(139, 200, 54, 1, 1, ''),
(140, 175, 54, 1, 1, ''),
(141, 191, 58, 1, 1, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(142, 218, 58, 1, 0, 'بناتي ربي يحفظهم'),
(143, 310, 58, 1, 0, 'واوووووو حلوووو في توصيل الا المحافظات'),
(144, 357, 58, 1, 0, 'حبيتها كم سعرهااااا'),
(145, 359, 58, 1, 0, 'ابغااا تفاصيل كامله عنه'),
(146, 164, 54, 1, 1, ''),
(147, 362, 58, 1, 0, 'روعةةةةة وتعامل اسهل '),
(148, 228, 54, 1, 1, ''),
(149, 361, 58, 1, 0, 'مشاء الله ممكن تساعدون اختكم والله محتاجه ضروري رقمي للاتصال 771212008'),
(150, 367, 58, 1, 0, 'برجع بعد شهر وشوف كم صلاه على النبى نفسي اجمع مليون صلاة اللهم صل وسلم على سيدنا محمد'),
(151, 364, 58, 1, 0, 'انشر كلمة لا اله الا الله محمد رسول الله اذا لم تنشرها فعلم ان الشيطان منعك عن نشرهاااااا'),
(152, 366, 58, 1, 0, 'الله حلوه بس ماتنفع '),
(153, 365, 58, 1, 1, 'مرررررة قديممممممم'),
(154, 310, 55, 1, 0, 'الصراحة مررررة ممتاز'),
(155, 357, 55, 1, 0, 'مرررره غالية'),
(156, 358, 55, 1, 1, 'عيش ياعم '),
(157, 359, 55, 1, 0, 'خلاص بعد الان ولا ريال يضيع '),
(158, 361, 55, 1, 0, 'امانة توقع تخزينه ابو اسد'),
(159, 360, 55, 1, 0, 'مافي تخفيضضضضض'),
(160, 362, 55, 1, 0, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(161, 367, 55, 1, 0, 'قوتك ياعم'),
(162, 366, 55, 1, 0, 'اشتي اربع بكم قطاف لاكن'),
(163, 363, 55, 1, 1, 'روعةةةةة وتعامل اسهل '),
(164, 364, 55, 1, 0, 'في لون فستقي'),
(165, 310, 50, 1, 1, 'عمي قال يبى واحده منها'),
(166, 358, 50, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(167, 359, 50, 1, 0, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(168, 357, 50, 1, 0, 'روعةةةةة وتعامل اسهل '),
(169, 361, 50, 1, 0, 'oooooo'),
(170, 367, 50, 1, 0, 'ابداع'),
(171, 364, 50, 1, 0, 'في لون ورديي'),
(172, 125, 61, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(173, 127, 61, 1, 1, 'الصرااحة الف شكر لكم مع تسوق اصبحت حياتنا اسهل '),
(174, 128, 61, 1, 0, 'روعةةةةة وتعامل اسهل '),
(175, 130, 61, 1, 1, ''),
(176, 131, 61, 1, 1, 'عسللللللللل'),
(177, 140, 61, 1, 1, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(178, 138, 61, 1, 0, 'الصراحة المنتجات حلوه بس الاسعار مرة اوفر مررر غالية اتمنى منكم إعادة النظر في الاسعار '),
(179, 135, 61, 1, 0, 'الف شكر لك من عمل في بناء وتطوير تسوق كم ونشكر كافة طاقم الغمل تسلم اياديكم ودمتم فخر لنا '),
(180, 150, 61, 1, 0, ''),
(181, 137, 62, 1, 1, '👍👍👍👍😍😍😍😍😍'),
(182, 133, 62, 0, 0, '👍👍👍👍😍😍😍😍😍'),
(183, 366, 62, 0, 1, '**********'),
(184, 130, 62, 0, 1, ''),
(185, 372, 50, 0, 0, '👍👍👍👍😍😍😍😍😍'),
(186, 268, 62, 1, 0, ''),
(187, 292, 62, 1, 0, ''),
(188, 349, 50, 0, 0, ''),
(189, 304, 50, 1, 1, ''),
(190, 223, 50, 1, 1, ''),
(191, 303, 50, 1, 0, ''),
(192, 142, 50, 1, 1, ''),
(193, 147, 50, 1, 0, ''),
(194, 0, 50, 1, 1, 'Very nice '),
(195, 128, 57, 1, 1, 'الله ماذا على قوه  تقدر تجيب لي واحد مثله '),
(196, 130, 57, 1, 0, 'قد هو قديييم  عادك فرح '),
(197, 134, 61, 1, 0, ''),
(198, 125, 57, 1, 1, 'اقلك  من يوم نزلين كان قيمتهن  500وانت تغلاهن علاذي زعم بلوتوث'),
(199, 144, 61, 1, 0, 'قوه'),
(200, 0, 61, 1, 0, ''),
(201, 284, 61, 1, 0, ''),
(202, 146, 61, 1, 0, ''),
(203, 147, 61, 1, 0, ''),
(204, 148, 57, 1, 0, 'ماذا  إلا فستان  تقول  يرجع المراه ربحه '),
(205, 186, 61, 1, 0, ''),
(206, 133, 61, 1, 0, ''),
(207, 136, 61, 1, 0, 'وووو يكون قوه'),
(208, 148, 61, 1, 0, ''),
(209, 136, 57, 1, 0, ''),
(210, 318, 61, 1, 0, ''),
(211, 137, 61, 1, 0, ''),
(212, 149, 61, 1, 0, ''),
(213, 175, 61, 1, 0, ''),
(214, 155, 61, 1, 0, ''),
(215, 190, 61, 1, 0, ''),
(216, 204, 61, 1, 0, ''),
(217, 151, 61, 1, 0, ''),
(218, 159, 61, 1, 0, ''),
(219, 166, 61, 1, 0, ''),
(220, 169, 61, 1, 0, ''),
(221, 231, 61, 1, 0, ''),
(222, 141, 61, 1, 0, ''),
(223, 162, 61, 1, 0, 'والله البواتي يهبليين ♥'),
(224, 164, 61, 1, 0, ''),
(225, 215, 61, 1, 0, ''),
(226, 217, 61, 1, 0, ''),
(227, 220, 61, 1, 0, ''),
(228, 145, 61, 1, 0, ''),
(229, 156, 57, 1, 0, 'اقلك  امانه  غالي  جورر   وبعدا ماهنش أيلبسونه يوم هي إلا ساعه قبل الحادث '),
(230, 139, 61, 1, 0, ''),
(231, 174, 61, 1, 0, ''),
(232, 139, 57, 1, 0, ''),
(233, 156, 61, 1, 0, ''),
(234, 176, 61, 1, 0, ''),
(235, 143, 57, 0, 0, 'ماشاء الله مشحفه تقول  لوفي  واحد لابسه بيكون احسن '),
(236, 262, 61, 1, 0, ''),
(237, 219, 61, 1, 0, ''),
(238, 226, 61, 1, 0, ''),
(239, 222, 61, 0, 0, ''),
(240, 144, 57, 1, 0, ''),
(241, 259, 61, 1, 0, ''),
(242, 157, 61, 1, 0, ''),
(243, 158, 50, 0, 1, ''),
(244, 145, 50, 1, 1, 'احلا منتج'),
(245, 1, 50, 1, 1, 'what is this product'),
(246, 128, 64, 1, 0, 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'),
(247, 219, 64, 1, 0, ''),
(248, 127, 64, 1, 1, ''),
(249, 1, 64, 0, 1, ''),
(250, 130, 64, 0, 0, ''),
(251, 140, 64, 1, 1, 'good'),
(252, 188, 64, 1, 1, ''),
(253, 130, 50, 1, 0, '🤙🤙🤙'),
(254, 127, 65, 1, 0, 'روووووعة'),
(255, 133, 50, 1, 1, ''),
(256, 207, 50, 1, 0, ''),
(257, 162, 50, 1, 0, '🤙🤙'),
(258, 164, 50, 0, 0, 'جميل جدا 🥰'),
(259, 208, 50, 0, 0, 'روعه'),
(260, 226, 50, 0, 0, 'gooooooood'),
(261, 313, 50, 1, 0, ''),
(262, 329, 50, 1, 0, ''),
(263, 182, 50, 1, 0, ''),
(264, 291, 50, 1, 1, ''),
(265, 366, 50, 1, 0, 'احلا منتج'),
(266, 284, 50, 1, 0, 'afds'),
(267, 290, 50, 0, 1, 'بيللابلابلا'),
(268, 286, 50, 0, 1, ''),
(269, 285, 50, 0, 1, ''),
(270, 295, 50, 1, 0, ''),
(271, 287, 50, 1, 0, 'جميل جدا'),
(272, 402, 50, 1, 1, 'احلا منتج'),
(273, 387, 80, 0, 1, 'qo'),
(274, 131, 80, 1, 0, ''),
(275, 138, 80, 0, 0, '74'),
(276, 338, 80, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id_ship` int(11) NOT NULL,
  `fk_order` int(11) NOT NULL,
  `fk_delivery` int(11) NOT NULL,
  `type_ship` varchar(150) NOT NULL,
  `cost_ship` decimal(10,0) NOT NULL,
  `address_ship` varchar(250) NOT NULL,
  `ship_location` text NOT NULL,
  `ship_date_receipt` varchar(50) NOT NULL,
  `statue_ship` int(5) NOT NULL DEFAULT 1,
  `ship_date_add` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id_ship`, `fk_order`, `fk_delivery`, `type_ship`, `cost_ship`, `address_ship`, `ship_location`, `ship_date_receipt`, `statue_ship`, `ship_date_add`) VALUES
(1, 14, 1, 'fast', 4000, 'اب ميتم ', 'ibb', '2023-06-15', 1, '2023-06-15'),
(2, 15, 1, 'fast', 2, '2', '12', '2023-06-15', 1, '2023-06-15'),
(3, 16, 1, 'fast', 2, '2', '12', '2023-06-15', 1, '2023-06-15'),
(4, 17, 1, 'fast', 3000, 'اب ميتم ', '45121124', '2023-06-17', 1, '2023-06-16'),
(5, 18, 1, 'fast', 74, ';km', 'e22', '2023-06-16', 1, '2023-06-16'),
(6, 19, 1, 'fast', 1992, 'kk', 'km', '2023-06-16', 1, '2023-06-16'),
(7, 20, 1, 'fast', 2000, '457', '', '2023-06-19', 1, '2023-06-19'),
(8, 21, 2, 'fast', 2000, 'اب ميتم ', '45121124', '2023-06-19', 1, '2023-06-19'),
(9, 22, 2, 'fast', 500, 'اب ميتم ', '45121124', '2023-06-22', 1, '2023-06-21'),
(10, 23, 1, 'in_date', 1200, 'aa', 'a', '2024-02-08', 1, '2024-02-03'),
(11, 24, 1, 'fast', 78, '234r3', '', '', 1, '2024-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `size_product`
--

CREATE TABLE `size_product` (
  `id_size_pro` int(11) NOT NULL,
  `fk_form_size` int(11) NOT NULL,
  `fk_id_pro` int(11) NOT NULL,
  `cat_fk_id_size` int(11) NOT NULL,
  `name_size` varchar(150) NOT NULL DEFAULT 'لم يتم التحديد',
  `details_size` text NOT NULL,
  `size_status` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size_product`
--

INSERT INTO `size_product` (`id_size_pro`, `fk_form_size`, `fk_id_pro`, `cat_fk_id_size`, `name_size`, `details_size`, `size_status`) VALUES
(21, 6, 0, 45645, 'M', 'لم يتم التحديد', 1),
(22, 7, 0, 45645, 'S', '78', 1),
(23, 1, 0, 45646, 'M', 'طول العباية 150 - طول الذراع 60 - محيط الرقبة 38 - محيط الصدر 100 - محيط الوسط 84 - 1/2 محيط الهنش 60 - طول الكتف 12.50 - محيط الذراع 34 - عرض الظهر 38', 3),
(24, 2, 0, 45646, 'L', 'طول العباية 151 - طول الذراع 61 - محيط الرقبة 40 - محيط الصدر 104 - محيط الوسط 88 - 1/2 محيط الهنش 62 - طول الكتف 13 - محيط الذراع 34 - عرض الظهر 40', 1),
(25, 3, 0, 45646, 'XL', 'طول العباية 151 - طول الذراع 61 - محيط الرقبة 41 - محيط الصدر 108 - محيط الوسط 100 - 1/2 محيط الهنش 64 - طول الكتف 13.50 - محيط الذراع 36 - عرض الظهر 41', 1),
(26, 4, 0, 45646, '2XL', 'طول العباية 152 - طول الذراع 62 - محيط الرقبة 42 - محيط الصدر 114 - محيط الوسط 106 - 1/2 محيط الهنش 68 - طول الكتف 14 - محيط الذراع 37 - عرض الظهر 42', 1),
(27, 5, 0, 45646, '3XL', 'طول العباية 152 - طول الذراع 62 - محيط الرقبة 44 - محيط الصدر 120 - محيط الوسط 110 - 1/2 محيط الهنش 74 - طول الكتف 14.50 - محيط الذراع 38 - عرض الظهر 43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id_system` int(11) NOT NULL,
  `name_system` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `phon_number` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `icon_system` varchar(255) DEFAULT '1.jpg',
  `whatsapp` varchar(50) NOT NULL DEFAULT '+967775662462',
  `telegram` varchar(50) NOT NULL DEFAULT '+967775662462',
  `website_system` varchar(255) DEFAULT NULL,
  `instagram` varchar(300) NOT NULL DEFAULT '#',
  `facebook` varchar(300) NOT NULL DEFAULT '#',
  `twitter` varchar(300) NOT NULL DEFAULT '#',
  `linkedin` varchar(300) NOT NULL DEFAULT '#',
  `about_system` varchar(1000) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id_system`, `name_system`, `Email`, `phon_number`, `address`, `icon_system`, `whatsapp`, `telegram`, `website_system`, `instagram`, `facebook`, `twitter`, `linkedin`, `about_system`, `create_date`) VALUES
(1, 'ازيائي', 'osamh3860@gmail.com', 775662462, 'ibb/mytem', '1.jpg', '+967775662462', '+967775662462', 'http://localhost/myPorject1/home/index.php', 'https://www.instagram.com/osamhshhra/', 'https://www.facebook.com/osamhqader', 'https://twitter.com/assomat2022', 'https://www.linkedin.com/in/osamh-abdulqader-naji-abdullah-540a27231', '                    من قبل كان الناس يذهبو من متجر الى اخر يبحثون عن افضل المنتجات والعروض والاسعار ,ايضاً واجه البائعون\r\n                    العديد من الصعوبات للإعلان عن منتجاتهم وعروضهم، بالاضافة الى صعوبة الوصول الى شريحة اكبر من\r\n                    المتسوقين والقدرة على عرض المنتاجات بسهولة\r\n                    تم إنشاء تسوق كوم لتوفير نظام استعراض المنتجات ومقارنة اسعار المنتجات في المراكز بسهولة وانت في\r\n                    مكانك لاداعي للتنقل من مركز إلى اخر,تسوق كوم متطور وسهل الاستخدام لتقديم الخدمات الالكترونية للسوق\r\n                    اليمني والذي سيمنح تجربة جديدة ومتغييرة في التسويق بالنسبة للمستخدم والبائع.', '2023-05-05 19:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `icon` varchar(255) NOT NULL DEFAULT '1.png',
  `user_type` int(1) NOT NULL DEFAULT 0,
  `com_id` int(10) NOT NULL,
  `user_state` int(2) NOT NULL DEFAULT 1,
  `fk_permissions` int(1) NOT NULL DEFAULT 1,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `Email`, `password`, `country`, `city`, `phone_number`, `icon`, `user_type`, `com_id`, `user_state`, `fk_permissions`, `dateAdded`) VALUES
(1, 'jjh', 'najeshhra77@gmail.com', '202cb962ac59075b964b07152d234b70', 'Yemen', 'Ibb', '772750928', '1.png', 1, 74, 1, 2, '2023-03-22 22:01:08'),
(50, 'osamh12', 'osamh@gmail.com', 'a01610228fe998f515a72dd730294d87', 'Yemen', '12', '(775) 662-462', '1683529276_1679325538795.jpg', 1, 74, 1, 6, '2022-09-19 21:28:54'),
(54, 'سيف الهتار', 'saif@gmail.com', '202cb962ac59075b964b07152d234b701', 'Yemen', 'إب', '(044) 264-2__-___', 'avatar04.png', 1, 74, 1, 1, '2022-09-20 20:18:28'),
(55, 'محمد ثابت جغمان ', 'gamin@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', 'الولايات المتحدة الامريكية ', 'تكساس ', '05900500', 'avatar.png', 2, 0, 1, 0, '2022-09-20 20:25:49'),
(56, 'رهف عجلان', 'beladmol@gmail.com', '202cb962ac59075b964b07152d234b70', 'اليمن', 'اب', '735087231', '1.png', 2, 0, 1, 0, '2022-09-20 20:33:10'),
(57, 'عبدالرحمن سعيد', 'dwas@gmail.com', '202cb962ac59075b964b07152d234b70', 'YEMEN', 'تعز', '415465472', '1.png', 1, 75, 1, 0, '2022-09-20 21:08:32'),
(58, 'بنت اليمن ', 'n@gmail.com', 'dcddb75469b4b4875094e14561e573d8', 'اليمن', 'العدين', '0096655878', 'avatar2.png', 2, 0, 1, 0, '2022-09-20 21:19:54'),
(60, 'حذيفة المقطري', 'almagtry123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'اليمن', 'اب', '12345678', '1.png', 2, 0, 1, 0, '2022-09-20 21:53:09'),
(61, 'ضيم 505', 'dddh@gmail.com', '202cb962ac59075b964b07152d234b70', 'rقطر', 'الدوحة', '735087231', '1.png', 2, 0, 1, 0, '2022-09-20 23:08:55'),
(62, 'رشيد الجماعي', 'aaa@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', '1.png', 2, 0, 1, 0, '2022-09-20 23:46:34'),
(63, 'حسن الجبلي', 'HASSAN@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '', '', '1.png', 2, 0, 1, 0, '2022-09-20 23:48:06'),
(64, 'اسومااات', 'ppo12@gmail.com', '123456789', '55', 'إب', '55454', '1683487553_anonymous_man_mask_268565_2560x1080.jpg', 2, 0, 1, 0, '2023-05-05 14:15:06'),
(65, ' Ali shahrah', 'ali@gmali.com', '1234', 'Yemen', 'Ibb', '772750928', '1683493453_٢٠٢٢٠٥١١_١٦٤٣٥٤.jpg', 2, 0, 1, 0, '2023-05-07 20:40:16'),
(66, 'Ali Shahrah ', 'ali@gmail.com', '202cb962ac59075b964b07152d234b70', 'Yemen ', 'Ibb', '772750928', '1.png', 2, 0, 1, 1, '2023-05-07 20:50:27'),
(67, 'Abdulkhaleq Ameen Qasem Abdullah', 'a7q2014@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'اليمن', 'اب', '776452830', '1683533373_20230506_024852.jpg', 2, 0, 1, 0, '2023-05-08 08:08:19'),
(68, 'Ali', 'najeshhra77@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'YEMEN', 'إب', '(967) 775-662-407', '1689798378_IMG_20220723_101629_610.jpg', 1, 74, 1, 6, '2023-05-15 17:22:14'),
(72, 'Anas', 'sharkah@gmail.com', '202cb962ac59075b964b07152d234b70', 'YEMEN', 'إب', '(044) 292-4__-___', '1689900950_IMG_20230526_204435_708.jpg', 1, 74, 1, 2, '2023-06-19 17:03:28'),
(73, 'osamah', 'osamh3860@gmail.com', '202cb962ac59075b964b07152d234b70', 'ibb', 'ibb', '(967) 775-662-462', '1689967141_IMG_20230526_204435_708.jpg', 1, 74, 1, 2, '2023-06-24 18:12:55'),
(74, 'qw', 'qwwq@ss', '202cb962ac59075b964b07152d234b70', 'imj', '223234e', '(112) 2__-___-___', '1689968550_user1-128x128.jpg', 1, 74, 1, 3, '2023-07-21 19:42:30'),
(75, 'qw', 'qwwq@ss', '202cb962ac59075b964b07152d234b70', 'imj', '223234e', '(967) 775-534', '1.png', 1, 74, 1, 3, '2023-07-21 19:44:30'),
(76, 'op', 'qw@gmail.com', '202cb962ac59075b964b07152d234b70', 'lok', 'll,km', '(967) 773-127-095', '1.png', 1, 74, 1, 5, '2023-07-21 19:51:22'),
(77, 'jjh4', 'cmax@gmail.com', '202cb962ac59075b964b07152d234b70', 'ok', '', '(445) 414-525', ' 77_1716286174.jpg', 1, 74, 1, 2, '2023-07-22 15:47:55'),
(78, 'op', 'cmax7@gmail.com', '202cb962ac59075b964b07152d234b70', 'ok', 'po', '(777) 777-777-777', '1.png', 1, 74, 1, 3, '2023-07-22 16:20:09'),
(79, '78', 'cmax7@gmail.com', '202cb962ac59075b964b07152d234b70', 'ok', 'po', '', '1.png', 1, 74, 1, 3, '2023-07-24 18:59:48'),
(81, 'osa_blad', 'osa_blad@gmail.com', '202cb962ac59075b964b07152d234b70', 'ok', 'po', '(775) 534-911', ' 81_1690597146.jpg', 1, 43, 0, 6, '2023-07-29 02:15:51'),
(82, 'osa_blad', 'osa_blad@gmail.com', '202cb962ac59075b964b07152d234b70', 'ok', '', '(775) 534-911', '1.png', 1, 43, 1, 1, '2023-07-29 02:16:34'),
(83, 'beladmol@gmail.com', 'osa_blad@gmail.com33', '202cb962ac59075b964b07152d234b70', 'ok', '', '(332) 142-2__', '1.png', 1, 43, 1, 1, '2023-07-29 02:20:58'),
(84, 'qq', 'qw@gr', '202cb962ac59075b964b07152d234b70', '123', '123', '(123) 111-211', ' 84_1706726101.jpg', 1, 77, 0, 2, '2024-01-31 18:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id_user_permissions` int(11) NOT NULL,
  `name_user_permissions` varchar(100) NOT NULL,
  `details_user_permissions` varchar(250) NOT NULL DEFAULT 'لايوجد',
  `status_user_permissions` int(1) NOT NULL DEFAULT 1,
  `data_add_user_permissions` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id_user_permissions`, `name_user_permissions`, `details_user_permissions`, `status_user_permissions`, `data_add_user_permissions`) VALUES
(1, 'لاشيء', 'لايوجد', 1, '2023-07-21 01:14:35'),
(2, 'مدخل بيانات', 'لايوجد', 1, '2023-07-21 01:17:17'),
(3, 'خدمات التوصيل', 'لايوجد', 1, '2023-07-21 01:17:17'),
(4, 'إدارة مالية', 'لايوجد', 1, '2023-07-21 01:17:17'),
(5, 'مراقبه', 'لايوجد', 1, '2023-07-21 01:17:17'),
(6, 'مدير', 'لايوجد', 1, '2023-07-21 01:17:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bunch`
--
ALTER TABLE `bunch`
  ADD PRIMARY KEY (`bunch_ID`);

--
-- Indexes for table `bunch_com`
--
ALTER TABLE `bunch_com`
  ADD PRIMARY KEY (`id_bunch_com`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `categories_com`
--
ALTER TABLE `categories_com`
  ADD PRIMARY KEY (`id_cat_com`);

--
-- Indexes for table `colors_product`
--
ALTER TABLE `colors_product`
  ADD PRIMARY KEY (`id_product_colors`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `delivery_com`
--
ALTER TABLE `delivery_com`
  ADD PRIMARY KEY (`id_delivery`);

--
-- Indexes for table `delivery_form`
--
ALTER TABLE `delivery_form`
  ADD PRIMARY KEY (`id_delivery_form`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deprat_id`);

--
-- Indexes for table `department_com`
--
ALTER TABLE `department_com`
  ADD PRIMARY KEY (`id_depart_com`);

--
-- Indexes for table `form_items_pro`
--
ALTER TABLE `form_items_pro`
  ADD PRIMARY KEY (`id_ite_for`);

--
-- Indexes for table `form_size`
--
ALTER TABLE `form_size`
  ADD PRIMARY KEY (`id_form`);

--
-- Indexes for table `items_product`
--
ALTER TABLE `items_product`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `mang_com`
--
ALTER TABLE `mang_com`
  ADD PRIMARY KEY (`id_manag`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id_item_order`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id_product_images`);

--
-- Indexes for table `reactive_company`
--
ALTER TABLE `reactive_company`
  ADD PRIMARY KEY (`id_reac_com_user`);

--
-- Indexes for table `reactive_product`
--
ALTER TABLE `reactive_product`
  ADD PRIMARY KEY (`reactive_product_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id_ship`);

--
-- Indexes for table `size_product`
--
ALTER TABLE `size_product`
  ADD PRIMARY KEY (`id_size_pro`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id_system`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id_user_permissions`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bunch`
--
ALTER TABLE `bunch`
  MODIFY `bunch_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bunch_com`
--
ALTER TABLE `bunch_com`
  MODIFY `id_bunch_com` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `categories_com`
--
ALTER TABLE `categories_com`
  MODIFY `id_cat_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45663;

--
-- AUTO_INCREMENT for table `colors_product`
--
ALTER TABLE `colors_product`
  MODIFY `id_product_colors` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `delivery_com`
--
ALTER TABLE `delivery_com`
  MODIFY `id_delivery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_form`
--
ALTER TABLE `delivery_form`
  MODIFY `id_delivery_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `deprat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `department_com`
--
ALTER TABLE `department_com`
  MODIFY `id_depart_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `form_items_pro`
--
ALTER TABLE `form_items_pro`
  MODIFY `id_ite_for` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `form_size`
--
ALTER TABLE `form_size`
  MODIFY `id_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items_product`
--
ALTER TABLE `items_product`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `mang_com`
--
ALTER TABLE `mang_com`
  MODIFY `id_manag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id_item_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=478;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id_product_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `reactive_company`
--
ALTER TABLE `reactive_company`
  MODIFY `id_reac_com_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reactive_product`
--
ALTER TABLE `reactive_product`
  MODIFY `reactive_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id_ship` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `size_product`
--
ALTER TABLE `size_product`
  MODIFY `id_size_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id_system` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id_user_permissions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
