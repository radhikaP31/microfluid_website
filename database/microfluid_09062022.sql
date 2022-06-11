-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 08:22 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microfluid`
--

-- --------------------------------------------------------

--
-- Table structure for table `common_type`
--

CREATE TABLE `common_type` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `type_cd` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type_img` varchar(255) DEFAULT NULL,
  `type_link` varchar(255) DEFAULT NULL,
  `status` enum('active','pending','','') NOT NULL DEFAULT 'active',
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `common_type`
--

INSERT INTO `common_type` (`id`, `parent_id`, `type_cd`, `title`, `description`, `type_img`, `type_link`, `status`, `created_on`, `updated_on`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 0, 'WTOFR', 'What We Offer', 'What We Offer data on home page of website', NULL, NULL, 'active', '2022-04-01 15:04:58', NULL, NULL, NULL, 0),
(2, 0, 'FOA', 'Field Of Application', 'Field of Application', NULL, NULL, 'active', '2022-04-01 15:25:00', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(11) NOT NULL,
  `customer_cd` varchar(50) DEFAULT NULL,
  `customer_company` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_details_vw`
-- (See below for the actual view)
--
CREATE TABLE `customer_details_vw` (
`customer_id` int(11)
,`customer_cd` varchar(50)
,`customer_company` varchar(255)
,`address1` varchar(255)
,`address2` varchar(255)
,`website` varchar(255)
,`contact_no` varchar(50)
,`created_on` datetime
,`updated_on` datetime
,`created_by` varchar(50)
,`updated_by` varchar(50)
,`is_deleted` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `employee_id` int(11) NOT NULL,
  `emp_name` varchar(255) DEFAULT NULL,
  `emp_email` varchar(255) DEFAULT NULL,
  `emp_contact_no` varchar(50) DEFAULT NULL,
  `emp_position` varchar(50) DEFAULT NULL,
  `emp_department` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `employee_details_vw`
-- (See below for the actual view)
--
CREATE TABLE `employee_details_vw` (
`employee_id` int(11)
,`emp_name` varchar(255)
,`emp_email` varchar(255)
,`emp_contact_no` varchar(50)
,`emp_position` varchar(50)
,`emp_department` varchar(50)
,`status` varchar(50)
,`created_on` datetime
,`updated_on` datetime
,`created_by` varchar(50)
,`updated_by` varchar(50)
,`is_deleted` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `independent_mst`
--

CREATE TABLE `independent_mst` (
  `id` int(11) NOT NULL,
  `mstr_cd` varchar(50) DEFAULT NULL,
  `mstr_nm` varchar(255) DEFAULT NULL,
  `mstr_desc` varchar(255) DEFAULT NULL,
  `mstr_img` varchar(255) DEFAULT NULL,
  `mstr_icon` varchar(50) DEFAULT NULL,
  `mstr_link` varchar(255) DEFAULT NULL,
  `status` enum('active','pending','','') NOT NULL DEFAULT 'active',
  `sequence` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `type_cd` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `independent_mst`
--

INSERT INTO `independent_mst` (`id`, `mstr_cd`, `mstr_nm`, `mstr_desc`, `mstr_img`, `mstr_icon`, `mstr_link`, `status`, `sequence`, `type_id`, `type_cd`, `created_on`, `updated_on`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 'WTOFRHPH', 'High Pressure Homogenizers', 'High Pressure Homogenizers', 'assets/img/application/homogenizers.jpeg', NULL, NULL, 'active', 1, 1, 'WTOFR', '2022-04-01 15:07:37', NULL, NULL, NULL, 0),
(2, 'WTOFRPMPS', 'Pumps', 'Pumps', 'assets/img/application/pump.jpeg', NULL, NULL, 'active', 2, 1, 'WTOFR', '2022-04-01 15:08:59', NULL, NULL, NULL, 0),
(3, 'WTOFRPHE', 'Plate Heat Extension', 'Plate Heat Extension', 'assets/img/application/plate-heat-exchanger.jpg', NULL, NULL, 'active', 3, 1, 'WTOFR', '2022-04-01 15:09:26', NULL, NULL, NULL, 0),
(4, 'WTOFRLP', 'Lope Pumps', 'Lope Pumps', 'assets/img/application/lobe-pump.jpg', NULL, NULL, 'active', 4, 1, 'WTOFR', '2022-04-01 15:09:38', NULL, NULL, NULL, 0),
(5, 'WTOFRFZP', 'Freezer Pumps', 'Freezer Pumps', 'assets/img/application/freezer-pump.jpg', NULL, NULL, 'active', 5, 1, 'WTOFR', '2022-04-01 15:11:31', NULL, NULL, NULL, 0),
(6, 'WTOFRSFS', 'Sanitary Filters & Strainers', 'Sanitary Filters & Strainers', 'assets/img/application/filters.jpeg', NULL, NULL, 'active', 6, 1, 'WTOFR', '2022-04-01 15:11:58', NULL, NULL, NULL, 0),
(7, 'WTOFRHSP', 'Homogenizers Spare Parts', 'Homogenizers Spare Parts', 'assets/img/application/spare-parts.jpeg', NULL, NULL, 'active', 7, 1, 'WTOFR', '2022-04-01 15:14:03', NULL, NULL, NULL, 0),
(8, 'WTOFRHF', 'Hygenic Fittings', 'Hygenic Fittings', 'assets/img/application/fitting.jpeg', NULL, NULL, 'active', 8, 1, 'WTOFR', '2022-04-01 15:14:21', NULL, NULL, NULL, 0),
(9, 'FOADI', 'Dairy Industry', 'Microfluid provides wide range of products for Dairy industries.', 'assets/img/fields/milk.png', 'si-glyph:botl-milk', NULL, 'active', 1, 2, 'FOA', '2022-04-01 15:26:08', NULL, NULL, NULL, 0),
(10, 'FOAFBI', 'Food & Beverage Industry', 'Microfluid provides wide range of products for Food and Baverage industries.', 'assets/img/fields/food.png', 'mdi:food-fork-drink', NULL, 'active', 2, 2, 'FOA', '2022-04-01 15:26:31', NULL, NULL, NULL, 0),
(11, 'FOACI', 'Chemical Industry', 'Microfluid provides wide range of products for Chemical industries.', 'assets/img/fields/chemical.png', 'entypo:lab-flask', NULL, 'active', 3, 2, 'FOA', '2022-04-01 15:26:47', NULL, NULL, NULL, 0),
(12, 'FOAPBI', 'Pharma & Biotech Industry', 'Microfluid provides wide range of products for Pharma industries.', 'assets/img/fields/pharma.png', 'file-icons:dna', NULL, 'active', 4, 2, 'FOA', '2022-04-01 15:27:20', NULL, NULL, NULL, 0),
(13, 'FOAHPCI', 'Home & Personal Care Industry', 'Microfluid provides wide range of products for Home and Personal care industries.', 'assets/img/fields/cosmetics.png', 'icon-park-outline:cosmetic-brush', NULL, 'active', 5, 2, 'FOA', '2022-04-01 15:27:48', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(11) NOT NULL,
  `privacy_policy` text DEFAULT NULL,
  `terms_condition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `privacy_policy`, `terms_condition`) VALUES
(1, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `mobile` text DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(25) NOT NULL,
  `dob` date DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `role` enum('admin','coach','client') DEFAULT NULL,
  `profile_pic` text DEFAULT NULL,
  `last_logged_in` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `name`, `mobile`, `email`, `username`, `dob`, `image`, `password`, `role_id`, `is_active`, `date_created`, `updated_on`, `role`, `profile_pic`, `last_logged_in`) VALUES
(6, NULL, NULL, 'Radhika Patel', NULL, 'radhikapanchasara3107@gmail.com', 'admin', NULL, 'default.jpg', '$2y$10$.pARmqJQba92nH7W.za8Ou8QOnkrk4WHRZxV0A5OPLqRHlTjMkb5i', 1, 1, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sub_menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`, `sub_menu_id`) VALUES
(1, 1, 1, NULL),
(3, 2, 2, 2),
(8, 1, 1, 1),
(9, 1, 2, 2),
(10, 1, 2, 3),
(13, 1, 1, 7),
(14, 1, 2, 8),
(22, 1, 3, 4),
(24, 1, 3, 5),
(25, 1, 3, NULL),
(29, 1, 6, 9),
(31, 1, 6, 10),
(33, 1, 7, 11),
(35, 1, 7, 12),
(39, 1, 6, NULL),
(40, 1, 7, NULL),
(41, 1, 2, 13),
(44, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(6, 'Masters'),
(7, 'Website');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Change Password', 'user/changepass', 'fas fa-fw fa-key', 1),
(9, 6, 'Common Type', 'common_type', 'fa fa-newspaper', 1),
(10, 6, 'Independent Mst', 'independent_mst', 'fa fa-newspaper', 1),
(11, 7, 'About Us', 'about_us', 'fa fa-star', 1),
(12, 7, 'Privacy Policy', 'privacy_policy/index/1', 'fa fa-newspaper', 1),
(13, 2, 'Customers', 'customer_details', 'fa fa-user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'radhikapanchasara3107@gmail.com', '1BnTTUL1KIm5QWKxu2UkUxiz4iuTS7bdVwN1VIt42OQ=', 1648816287);

-- --------------------------------------------------------

--
-- Table structure for table `web_about_info`
--

CREATE TABLE `web_about_info` (
  `id` int(11) NOT NULL,
  `tab_name` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_about_info`
--

INSERT INTO `web_about_info` (`id`, `tab_name`, `name`, `description`, `image`, `video_path`, `sequence`, `is_deleted`) VALUES
(1, 'corpo_profile', 'Corporate Profile', '<div class=\"row col-md-12\"> \n                  <div class=\"col-md-6\"> \n                    <img src=\"assets/img/about-us/corporate-profile.png\" style=\"height: auto;width: 350px;\">\n                  <br>\n                  </div>\n                  <div class=\"col-md-6\">\n                    <p class=\"letter-spacing\">Microfluid process equipment was founded in 2019 by highly qualified engineers, who have more than 25 years experience in manufacturing and process industries and high pressure reciprocating pumps.\nAs a company, we manufacturer and servicing of HIGH PRESSURE HOMOGENIZER. our range meets the requirements of the most clients across application in Dairy, food, Fruit juice &amp; beverages, ice cream, chemical &amp; pharmaceuticals, cosmetic and process industries.</p>\n                  </div> \n                  </div>', 'assets/img/about-us/corporate-profile.png', NULL, NULL, 0),
(2, 'management_values', 'Management Values', '<div class=\"row col-md-12\"> \n                  <div class=\"col-md-6\"> \n                    <img src=\"assets/img/about-us/management-values.png\" style=\"height: auto;width: 350px;\">\n                  <br>\n                  </div>\n                  <div class=\"col-md-6\">\n                    <p class=\"letter-spacing\">Microfluid process equipment was founded in 2019 by highly qualified engineers, who have more than 25 years experience in manufacturing and process industries and high pressure reciprocating pumps.\nAs a company, we manufacturer and servicing of HIGH PRESSURE HOMOGENIZER. our range meets the requirements of the most clients across application in Dairy, food, Fruit juice &amp; beverages, ice cream, chemical &amp; pharmaceuticals, cosmetic and process industries.</p>\n                  </div> \n                  </div>', 'assets/img/about-us/management-values.png', NULL, NULL, 0),
(3, 'vision_mission', 'Vision & Mission', '<div class=\"row col-md-12\"> \n                  <div class=\"col-md-6\"> \n                    <img src=\"assets/img/about-us/vision-mission.png\" style=\"height: auto;width: 350px;\">\n                  <br>\n                  </div>\n                  <div class=\"col-md-6\">\n                    <p class=\"letter-spacing\">Microfluid process equipment was founded in 2019 by highly qualified engineers, who have more than 25 years experience in manufacturing and process industries and high pressure reciprocating pumps.\nAs a company, we manufacturer and servicing of HIGH PRESSURE HOMOGENIZER. our range meets the requirements of the most clients across application in Dairy, food, Fruit juice &amp; beverages, ice cream, chemical &amp; pharmaceuticals, cosmetic and process industries.</p>\n                  </div> \n                  </div>', 'assets/img/about-us/vision-mission.png', NULL, NULL, 0),
(4, 'testimonials', 'Testimonials', '<div class=\"row col-md-12\"> \n                  <div class=\"col-md-6\"> \n                    <img src=\"assets/img/about-us/testimonials.png\" style=\"height: auto;width: 350px;\">\n                  <br>\n                  </div>\n                  <div class=\"col-md-6\">\n                    <p class=\"letter-spacing\">Microfluid process equipment was founded in 2019 by highly qualified engineers, who have more than 25 years experience in manufacturing and process industries and high pressure reciprocating pumps.\nAs a company, we manufacturer and servicing of HIGH PRESSURE HOMOGENIZER. our range meets the requirements of the most clients across application in Dairy, food, Fruit juice &amp; beverages, ice cream, chemical &amp; pharmaceuticals, cosmetic and process industries.</p>\n                  </div> \n                  </div>', 'assets/img/about-us/testimonials.png', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `web_clients`
--

CREATE TABLE `web_clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_language`
--

CREATE TABLE `web_language` (
  `id` int(11) NOT NULL,
  `variable` varchar(50) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_language`
--

INSERT INTO `web_language` (`id`, `variable`, `name`, `created_on`) VALUES
(1, 'breadcrumb_desc', 'Microfluid is one of the leading manufacturer of process equipment ', '2022-04-01 22:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `web_products`
--

CREATE TABLE `web_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_cat_id` int(11) DEFAULT NULL,
  `p_name` varchar(255) DEFAULT NULL,
  `p_description` text DEFAULT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT 0,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_products`
--

INSERT INTO `web_products` (`id`, `category_id`, `sub_cat_id`, `p_name`, `p_description`, `p_image`, `is_deleted`, `sequence`) VALUES
(1, 1, 1, 'Microfluid 300Ltr Homogenizer', 'The Microfluid 300Ltr homogenizer provides all the functionality of a full-scale homogenizer but can apply them in pilot projects running at low flow rates. Like a full-scale homogenizer, the Microfluid 300Ltr homogenizes immiscible liquids into an emulsion, operating like a positive displacement pump with a valve. It forces fluids at high pressures through a small gap in that valve. This increases velocity and decreases pressure causing a turbulence/pressure differential that disrupts and disperses particles.', '/microfluid_website/assets/img/products/pilot-homogenizer-1.jpg', 0, NULL),
(2, 1, 1, 'Microfluid Rannie 77T and Gaulin 77T Series - High Pressure Homogenizers', 'The Microfluid 77T homogenizer provides all the functionality of a full-scale homogenizer but can apply them in pilot projects running at low flow rates. Like a full-scale homogenizer, the Microfluid 77T homogenizes immiscible liquids into an emulsion, operating like a positive displacement pump with a valve. It forces fluids at high pressures through a small gap in that valve. This increases velocity and decreases pressure causing a turbulence/pressure differential that disrupts and disperses particles.', '/microfluid_website/assets/img/products/homogenizer-57t-77t-2.jpg', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_products_category`
--

CREATE TABLE `web_products_category` (
  `id` int(11) NOT NULL,
  `c_code` varchar(50) DEFAULT NULL,
  `c_name` varchar(255) DEFAULT NULL,
  `c_description` text DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT 0,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_products_category`
--

INSERT INTO `web_products_category` (`id`, `c_code`, `c_name`, `c_description`, `is_deleted`, `sequence`) VALUES
(1, 'HPH', 'Homogenizers', NULL, 0, 1),
(2, 'PMP', 'Pumps', NULL, 0, 2),
(3, 'PHE', 'Plate Heat Extension', NULL, 0, 3),
(6, 'SFS', 'Sanitary Filters & Strainers', NULL, 0, 6),
(7, 'HMSP', 'Homogenizers Spare Parts', NULL, 1, 7),
(8, 'HYFT', 'Hygenic Fittings', NULL, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `web_products_sub_category`
--

CREATE TABLE `web_products_sub_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'id from web_products_category table',
  `sc_name` varchar(255) DEFAULT NULL,
  `sc_description` text DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT 0,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_products_sub_category`
--

INSERT INTO `web_products_sub_category` (`id`, `category_id`, `sc_name`, `sc_description`, `is_deleted`, `sequence`) VALUES
(1, 1, 'General Homogenizers', 'Microfluid provide wide range of Homogenizers.', 0, NULL),
(2, 2, 'Centrifugal Pumps', 'Microfluid provide wide range of Centrifugal pumps.', 0, NULL),
(3, 3, 'Plate Heat Exchenger', 'Microfluid provide wide range of Plate Heat Exchenger.', 0, NULL),
(4, 2, 'Lope Pumps', 'Microfluid provide wide range of Lope Pumps.', 1, NULL),
(5, 2, 'Freezer Pumps', 'Microfluid provide wide range of Freezer Pumps.', 1, NULL),
(6, 6, 'Sanitary Filters', 'Microfluid provide wide range of Sanitary Filters.', 0, NULL),
(7, 6, 'Strainers', 'Microfluid provide wide range of Strainers.', 0, NULL),
(8, 1, 'Spare Parts', 'Microfluid provide wide range of Spare Parts.', 0, NULL),
(9, 8, 'Hygenic Fittings', 'Microfluid provide wide range of Hygenic Fittings.', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_product_application`
--

CREATE TABLE `web_product_application` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL COMMENT 'id from web_products table',
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_product_download`
--

CREATE TABLE `web_product_download` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL COMMENT 'id from web_products table',
  `document_name` varchar(255) DEFAULT NULL,
  `download_path` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_product_features`
--

CREATE TABLE `web_product_features` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL COMMENT 'id from web_products table',
  `feature_name` varchar(255) DEFAULT NULL,
  `feature_description` text DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_product_image`
--

CREATE TABLE `web_product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL COMMENT 'id from web_products table',
  `img_path` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_product_image`
--

INSERT INTO `web_product_image` (`id`, `product_id`, `img_path`, `is_deleted`, `sequence`) VALUES
(1, 1, '/assets/img/products/pilot-homogenizer-1.jpg', NULL, NULL),
(2, 2, '/assets/img/products/homogenizer-57t-77t-2.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_product_keys`
--

CREATE TABLE `web_product_keys` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `tab_name` varchar(255) DEFAULT NULL,
  `key_name` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_product_specification`
--

CREATE TABLE `web_product_specification` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL COMMENT 'id from web_products table',
  `spec_name` varchar(255) DEFAULT NULL,
  `spec_description` text DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `customer_details_vw`
--
DROP TABLE IF EXISTS `customer_details_vw`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_details_vw`  AS SELECT `customer_details`.`customer_id` AS `customer_id`, `customer_details`.`customer_cd` AS `customer_cd`, `customer_details`.`customer_company` AS `customer_company`, `customer_details`.`address1` AS `address1`, `customer_details`.`address2` AS `address2`, `customer_details`.`website` AS `website`, `customer_details`.`contact_no` AS `contact_no`, `customer_details`.`created_on` AS `created_on`, `customer_details`.`updated_on` AS `updated_on`, `customer_details`.`created_by` AS `created_by`, `customer_details`.`updated_by` AS `updated_by`, `customer_details`.`is_deleted` AS `is_deleted` FROM `customer_details` ;

-- --------------------------------------------------------

--
-- Structure for view `employee_details_vw`
--
DROP TABLE IF EXISTS `employee_details_vw`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employee_details_vw`  AS SELECT `employee_details`.`employee_id` AS `employee_id`, `employee_details`.`emp_name` AS `emp_name`, `employee_details`.`emp_email` AS `emp_email`, `employee_details`.`emp_contact_no` AS `emp_contact_no`, `employee_details`.`emp_position` AS `emp_position`, `employee_details`.`emp_department` AS `emp_department`, `employee_details`.`status` AS `status`, `employee_details`.`created_on` AS `created_on`, `employee_details`.`updated_on` AS `updated_on`, `employee_details`.`created_by` AS `created_by`, `employee_details`.`updated_by` AS `updated_by`, `employee_details`.`is_deleted` AS `is_deleted` FROM `employee_details` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `common_type`
--
ALTER TABLE `common_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `independent_mst`
--
ALTER TABLE `independent_mst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `web_about_info`
--
ALTER TABLE `web_about_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_clients`
--
ALTER TABLE `web_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_language`
--
ALTER TABLE `web_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_products`
--
ALTER TABLE `web_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_products_category`
--
ALTER TABLE `web_products_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_products_sub_category`
--
ALTER TABLE `web_products_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_product_application`
--
ALTER TABLE `web_product_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_product_download`
--
ALTER TABLE `web_product_download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_product_features`
--
ALTER TABLE `web_product_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_product_image`
--
ALTER TABLE `web_product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_product_keys`
--
ALTER TABLE `web_product_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_product_specification`
--
ALTER TABLE `web_product_specification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `common_type`
--
ALTER TABLE `common_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `independent_mst`
--
ALTER TABLE `independent_mst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_about_info`
--
ALTER TABLE `web_about_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `web_clients`
--
ALTER TABLE `web_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_language`
--
ALTER TABLE `web_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_products`
--
ALTER TABLE `web_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_products_category`
--
ALTER TABLE `web_products_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `web_products_sub_category`
--
ALTER TABLE `web_products_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `web_product_application`
--
ALTER TABLE `web_product_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_product_download`
--
ALTER TABLE `web_product_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_product_features`
--
ALTER TABLE `web_product_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_product_image`
--
ALTER TABLE `web_product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_product_keys`
--
ALTER TABLE `web_product_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_product_specification`
--
ALTER TABLE `web_product_specification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
