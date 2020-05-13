-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2020 at 11:57 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtushimports`
--

-- --------------------------------------------------------

--
-- Table structure for table `image_prod_domain`
--

DROP TABLE IF EXISTS `image_prod_domain`;
CREATE TABLE IF NOT EXISTS `image_prod_domain` (
  `UUID` varchar(70) COLLATE utf8_bin NOT NULL,
  `image_id` varchar(70) COLLATE utf8_bin NOT NULL,
  `product_id` int(11) NOT NULL,
  KEY `link_to_product_img_idx` (`product_id`),
  KEY `link_to_image_idx` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `image_prod_domain`
--

INSERT INTO `image_prod_domain` (`UUID`, `image_id`, `product_id`) VALUES
('c36492bf-f04a-416e-9f2d-3baa95a2d31f', 'e6c5d1e5-5dca-4bc8-9128-404d007f4a97', 5),
('8ea9e96b-0ef6-43d2-9480-9f6c488974a3', '4770ffac-1afb-4f85-8987-10cdb14f31cd', 3),
('8f46420a-b7a4-4d67-8045-4a8df8d705b2', '98cc933c-d97d-4887-8436-b517487e4282', 6),
('aa032999-2396-4e2b-b4fe-9f72f76bd007', 'e3c5353d-dc0b-4664-8967-ec91420c2fd0', 7),
('534debe3-204a-4898-bd72-9570d73e21f0', '994657cd-95cb-457a-8ae2-e25e6759aca6', 8);

-- --------------------------------------------------------

--
-- Table structure for table `products_category_domain`
--

DROP TABLE IF EXISTS `products_category_domain`;
CREATE TABLE IF NOT EXISTS `products_category_domain` (
  `products_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`products_id`,`category_id`),
  KEY `categoryKey_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products_category_domain`
--

INSERT INTO `products_category_domain` (`products_id`, `category_id`) VALUES
(5, 1),
(5, 3),
(5, 4),
(5, 5),
(6, 1),
(6, 3),
(7, 4),
(7, 5),
(8, 1),
(8, 3),
(8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_details`
--

DROP TABLE IF EXISTS `supplier_details`;
CREATE TABLE IF NOT EXISTS `supplier_details` (
  `Product_id` int(11) DEFAULT NULL,
  `Product_name` int(11) DEFAULT NULL,
  `Vanedor_id` int(11) DEFAULT NULL,
  `Vanedor_name` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attributes`
--

DROP TABLE IF EXISTS `tbl_attributes`;
CREATE TABLE IF NOT EXISTS `tbl_attributes` (
  `UUID` varchar(70) CHARACTER SET utf8 NOT NULL,
  `att_name` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `att_slung` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `att_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_attributes`
--

INSERT INTO `tbl_attributes` (`UUID`, `att_name`, `att_slung`, `att_description`) VALUES
('0ba34626-d070-43f6-ade4-d3eba95fb638', 'color', 'color', 'all colors'),
('75c1e3c6-7aaa-4b3f-9f18-58296d9c70b5', 'size', 'size', 'all sizes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attributes_values`
--

DROP TABLE IF EXISTS `tbl_attributes_values`;
CREATE TABLE IF NOT EXISTS `tbl_attributes_values` (
  `UUID` varchar(70) CHARACTER SET utf8 NOT NULL,
  `value_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `value_slung` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `value_description` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `att_Bond` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`UUID`),
  KEY `bindtoattributes` (`att_Bond`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_attributes_values`
--

INSERT INTO `tbl_attributes_values` (`UUID`, `value_name`, `value_slung`, `value_description`, `att_Bond`) VALUES
('1ee5e6b5-0d36-4a22-b78d-4a6eeb52f989', 'red', 'red', 'red', '0ba34626-d070-43f6-ade4-d3eba95fb638'),
('ce82360b-e8c5-4419-8a5c-f74ee4ac7077', 'medium', 'medium', 'all medium items', '75c1e3c6-7aaa-4b3f-9f18-58296d9c70b5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `ListOrder` int(11) NOT NULL AUTO_INCREMENT,
  `UUID` varchar(70) CHARACTER SET utf8 NOT NULL,
  `cat_name` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `cat_slung` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `cat_parent` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `cat_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cat_img` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ListOrder`,`UUID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`ListOrder`, `UUID`, `cat_name`, `cat_slung`, `cat_parent`, `cat_description`, `cat_img`) VALUES
(1, '1', 'Default', 'Default', 'None', 'This is the default category.All products without a category will be assigned this category.Do Not delete this category. ', NULL),
(3, '9a25dc0e-d4e3-44ba-808e-015738c600be', 'Male', 'Male', 'None', 'All male products', NULL),
(4, '0647d221-9c19-42ba-8073-d0b9bee87f0a', 'Ladies Shoes', 'Ladies shoes', 'Female', 'all ladies shoes', NULL),
(5, '051e1a6e-b72d-42bb-b8ef-4399a7fbcc4c', 'Female', 'Female', 'None', 'all Female shoes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discounts`
--

DROP TABLE IF EXISTS `tbl_discounts`;
CREATE TABLE IF NOT EXISTS `tbl_discounts` (
  `discountID` varchar(70) CHARACTER SET utf8 NOT NULL,
  `discountTag` varchar(45) CHARACTER SET utf8 NOT NULL,
  `discountAmount` decimal(10,2) UNSIGNED DEFAULT NULL,
  `discountPercent` int(10) UNSIGNED DEFAULT NULL,
  `remainign` int(10) UNSIGNED NOT NULL,
  `dateAdded` datetime DEFAULT current_timestamp(),
  `dateModified` datetime DEFAULT NULL,
  PRIMARY KEY (`discountID`),
  UNIQUE KEY `discountTag_UNIQUE` (`discountTag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_image_db`
--

DROP TABLE IF EXISTS `tbl_image_db`;
CREATE TABLE IF NOT EXISTS `tbl_image_db` (
  `UUID` varchar(70) COLLATE utf8_bin NOT NULL,
  `img_width` int(11) DEFAULT NULL,
  `img_height` int(11) DEFAULT NULL,
  `img_name` varchar(70) COLLATE utf8_bin DEFAULT NULL,
  `size` decimal(15,0) DEFAULT NULL,
  `mime_type` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `path_from_root` mediumtext COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_image_db`
--

INSERT INTO `tbl_image_db` (`UUID`, `img_width`, `img_height`, `img_name`, `size`, `mime_type`, `path_from_root`) VALUES
('2e6c7c37-797f-44be-a7c7-5d17096e3c22', 500, 708, '2e6c7c37-797f-44be-a7c7-5d17096e3c22.jpg', '41320', 'image/jpeg', 'http://test.local/res/images/productsImages/2e6c7c37-797f-44be-a7c7-5d17096e3c22.jpg'),
('4770ffac-1afb-4f85-8987-10cdb14f31cd', 500, 708, '4770ffac-1afb-4f85-8987-10cdb14f31cd.jpg', '41320', 'image/jpeg', 'http://test.local/res/images/productsImages/4770ffac-1afb-4f85-8987-10cdb14f31cd.jpg'),
('98cc933c-d97d-4887-8436-b517487e4282', 500, 708, '98cc933c-d97d-4887-8436-b517487e4282.jpg', '41320', 'image/jpeg', 'http://test.local/res/images/productsImages/98cc933c-d97d-4887-8436-b517487e4282.jpg'),
('994657cd-95cb-457a-8ae2-e25e6759aca6', 500, 708, '994657cd-95cb-457a-8ae2-e25e6759aca6.jpg', '41320', 'image/jpeg', 'http://test.local/res/images/productsImages/994657cd-95cb-457a-8ae2-e25e6759aca6.jpg'),
('e3c5353d-dc0b-4664-8967-ec91420c2fd0', 500, 708, 'e3c5353d-dc0b-4664-8967-ec91420c2fd0.jpg', '41320', 'image/jpeg', 'http://test.local/res/images/productsImages/e3c5353d-dc0b-4664-8967-ec91420c2fd0.jpg'),
('e6c5d1e5-5dca-4bc8-9128-404d007f4a97', 500, 708, 'e6c5d1e5-5dca-4bc8-9128-404d007f4a97.jpg', '41320', 'image/jpeg', 'http://test.local/res/images/productsImages/e6c5d1e5-5dca-4bc8-9128-404d007f4a97.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_moderators`
--

DROP TABLE IF EXISTS `tbl_moderators`;
CREATE TABLE IF NOT EXISTS `tbl_moderators` (
  `UUID` varchar(50) CHARACTER SET utf8 NOT NULL,
  `userFirstName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `userLastName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `userOtherName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nationalID` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `userName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `userEmailAddress` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `userPhoneNumber` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `Address` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Role` varchar(30) CHARACTER SET utf8 DEFAULT 'normal',
  `accountStatus` varchar(30) CHARACTER SET utf8 DEFAULT 'Active',
  `profilePicture` varchar(50) CHARACTER SET utf8 DEFAULT 'default.jpg',
  `password` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `lastModified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`UUID`),
  UNIQUE KEY `userEmailAddress_UNIQUE` (`userEmailAddress`),
  UNIQUE KEY `userPhoneNumber_UNIQUE` (`userPhoneNumber`),
  UNIQUE KEY `userName_UNIQUE` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_moderators`
--

INSERT INTO `tbl_moderators` (`UUID`, `userFirstName`, `userLastName`, `userOtherName`, `nationalID`, `userName`, `gender`, `userEmailAddress`, `userPhoneNumber`, `Address`, `Role`, `accountStatus`, `profilePicture`, `password`, `regDate`, `lastModified`) VALUES
('3be0517c-57b9-48df-b0f6-a3afd9077b52', 'Kimani', 'Ann', 'Mwaura', '34171163', 'Kimani', 'Female', 'kimmwaus@gmail.com', '0717607177', 'Banana', 'Admin', 'Active', 'default.jpg', '$2y$10$NVCi35kh9kGj5H7YhtvpwOmag0/6xp1cVd02ZaMvIQIs5.89aeHau', '2020-05-10 23:16:05', '2020-05-11 22:11:55'),
('f661c9bb-40bd-44cc-b575-bde4762be05b', 'Mary', 'Ann', 'Mwaura', '12345678', 'Marya', 'Female', 'marya@gmail.com', '0719445697', 'Banana', 'Moderator', 'Active', 'default.jpg', '$2y$10$FzEYxkKlUJbcIx1bxx7KKOV1ETEfxvF3qAukkpbUs6rDFDKJ4AnFC', '2020-05-11 21:57:05', '2020-05-11 22:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `ListOrder` int(11) NOT NULL AUTO_INCREMENT,
  `UUID` varchar(70) CHARACTER SET utf8 NOT NULL,
  `productName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Supplier_ID` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `Short_description` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `long_description` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `Status` varchar(10) CHARACTER SET utf8 DEFAULT '1',
  `Visibility` varchar(15) CHARACTER SET utf8 DEFAULT 'All',
  `enable_edit` varchar(3) CHARACTER SET utf8 DEFAULT '1',
  `Product_type` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `addedby` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `Modified_by` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT current_timestamp(),
  `dateModified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ListOrder`),
  KEY `Uinique` (`UUID`),
  KEY `mod_added_by` (`addedby`),
  KEY `mod_modified_by` (`Modified_by`),
  KEY `link_to_vendor_idx` (`Supplier_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`ListOrder`, `UUID`, `productName`, `Supplier_ID`, `Short_description`, `long_description`, `Status`, `Visibility`, `enable_edit`, `Product_type`, `addedby`, `Modified_by`, `dateCreated`, `dateModified`) VALUES
(3, 'f6f502fc-e3dc-439f-b29e-e32eb447e3dc', 'Land cruiser Prado', '35b0f042-5574-46e2-be6d-01b35d33b9f1', '{\"ops\":[{\"insert\":\"this\\n\"}]}', '{\"ops\":[{\"insert\":\"non\\n\"}]}', 'Active', 'All', 'Yes', 'Single', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '2020-05-12 22:36:11', '2020-05-12 22:36:11'),
(5, 'f6f502fc-e3dc-439f-b29e-e32eb447e3dd', 'other1', '35b0f042-5574-46e2-be6d-01b35d33b9f1', '{\"ops\":[{\"insert\":\"this\\n\"}]}', '{\"ops\":[{\"insert\":\"non\\n\"}]}', 'Active', 'All', 'Yes', 'Single', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '2020-05-12 22:36:11', '2020-05-12 22:38:34'),
(6, 'f6f502fc-e3dc-439f-b29a-e32eb447e3dd', 'other2', '35b0f042-5574-46e2-be6d-01b35d33b9f1', '{\"ops\":[{\"insert\":\"this\\n\"}]}', '{\"ops\":[{\"insert\":\"non\\n\"}]}', 'Active', 'All', 'Yes', 'Single', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '2020-05-12 22:36:11', '2020-05-12 22:38:38'),
(7, 'f6f502fx-e3dc-439f-b29e-e32eb447e3dd', 'other3', '35b0f042-5574-46e2-be6d-01b35d33b9f1', '{\"ops\":[{\"insert\":\"this\\n\"}]}', '{\"ops\":[{\"insert\":\"non\\n\"}]}', 'Active', 'All', 'Yes', 'Single', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '2020-05-12 22:36:11', '2020-05-12 22:38:41'),
(8, 'f6fr02fc-e3dc-439f-b29e-e32eb447e3dd', 'other4', '35b0f042-5574-46e2-be6d-01b35d33b9f1', '{\"ops\":[{\"insert\":\"this\\n\"}]}', '{\"ops\":[{\"insert\":\"non\\n\"}]}', 'Active', 'All', 'Yes', 'Single', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '2020-05-12 22:36:11', '2020-05-12 22:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_simple_product`
--

DROP TABLE IF EXISTS `tbl_simple_product`;
CREATE TABLE IF NOT EXISTS `tbl_simple_product` (
  `UUID` varchar(70) CHARACTER SET utf8 NOT NULL,
  `pod_ref` int(11) NOT NULL,
  `SKU` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `low_stock_quantity` int(11) DEFAULT NULL,
  `sold_alone` varchar(5) CHARACTER SET utf8 DEFAULT '0',
  `regular_price` decimal(15,2) DEFAULT NULL,
  `Discount_ID` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `prod_condition` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `package` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `estimated_count` int(11) DEFAULT NULL,
  `price_cat` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `cardDescription` mediumtext COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`UUID`),
  KEY `link_to_products_idx` (`pod_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_simple_product`
--

INSERT INTO `tbl_simple_product` (`UUID`, `pod_ref`, `SKU`, `stock_quantity`, `low_stock_quantity`, `sold_alone`, `regular_price`, `Discount_ID`, `prod_condition`, `package`, `estimated_count`, `price_cat`, `cardDescription`) VALUES
('0157fdd3-7725-4ef0-80ff-e63029d73cbb', 7, ' P_001', 10, 1, 'No', '13.00', NULL, 'Good', '55Kg Bag', 5000, 'Average', NULL),
('061823f4-6232-490f-accf-0fe022482da9', 3, ' P_001', 100, 10, 'No', '5000.00', NULL, 'Good', '55Kg Bag', 70, 'Average', NULL),
('2fe50a8b-d575-4c12-9336-498517690243', 8, ' P_001', 5, 1, 'No', '500.00', NULL, 'Good', '55Kg Bag', 10, 'Average', NULL),
('b7fb8249-84de-462c-b86f-6ba5103ad136', 6, ' P_001', 100, 10, 'No', '5.00', NULL, 'Good', '55Kg Bag', 5000, 'Average', NULL),
('e9bee4c4-10cb-401a-aaa6-12cd4f742ab1', 5, ' P_002', 100, 10, 'No', '123132.00', NULL, 'Good', '55Kg Bag', 5000, 'Average', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

DROP TABLE IF EXISTS `tbl_tags`;
CREATE TABLE IF NOT EXISTS `tbl_tags` (
  `UUID` varchar(70) CHARACTER SET utf8 NOT NULL,
  `tag_name` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `tag_slung` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `tag_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_tags`
--

INSERT INTO `tbl_tags` (`UUID`, `tag_name`, `tag_slung`, `tag_description`) VALUES
('43d2c10d-8688-4a6f-bf69-b06f09cb2803', 'man', 'man', 'man'),
('4f43923f-05e7-4a8a-9799-a63721ebc401', 'car', NULL, NULL),
('74339eb7-052f-419a-887f-2bdc88b0d501', 'up', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `UUID` varchar(50) CHARACTER SET utf8 NOT NULL,
  `userFirstName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `userLastName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `userOtherName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `userName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `userDOB` date DEFAULT NULL,
  `userEmailAddress` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `userPhoneNumber` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `userCountryCode` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `userCountry` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `userLocationID` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `accountStatus` varchar(30) CHARACTER SET utf8 DEFAULT 'Active',
  `accountType` varchar(30) CHARACTER SET utf8 DEFAULT 'normal',
  `profilePicture` varchar(50) CHARACTER SET utf8 DEFAULT 'default.jpg',
  `password` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `lastModified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`UUID`),
  UNIQUE KEY `userEmailAddress_UNIQUE` (`userEmailAddress`),
  UNIQUE KEY `userPhoneNumber_UNIQUE` (`userPhoneNumber`),
  UNIQUE KEY `userName_UNIQUE` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

DROP TABLE IF EXISTS `tbl_vendor`;
CREATE TABLE IF NOT EXISTS `tbl_vendor` (
  `UUID` varchar(70) CHARACTER SET utf8 NOT NULL,
  `vendorName` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `contactName` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `contactTitle` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `city2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `postalCode` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Phone` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `Url` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `Note` mediumtext CHARACTER SET utf8 DEFAULT NULL,
  `Logo` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `dateCreated` datetime DEFAULT current_timestamp(),
  `lastModified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `modifiedBy` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`UUID`),
  KEY `createdby_idx` (`createdBy`),
  KEY `modifiedby_idx` (`modifiedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`UUID`, `vendorName`, `contactName`, `contactTitle`, `city1`, `address1`, `city2`, `address2`, `postalCode`, `Phone`, `Email`, `Url`, `Note`, `Logo`, `dateCreated`, `lastModified`, `createdBy`, `modifiedBy`) VALUES
('35b0f042-5574-46e2-be6d-01b35d33b9f1', 'Mtush Imports', 'Kago', 'Manager', 'Kiambu', 'Banana', 'Kiambu', 'Banana', '12345', '0719445697', 'kimmwaus@gmail.com', 'mtushimports.com', 'all clothes', NULL, '2020-05-12 02:38:14', '2020-05-12 02:38:15', '3be0517c-57b9-48df-b0f6-a3afd9077b52', '3be0517c-57b9-48df-b0f6-a3afd9077b52');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_prod_domain`
--
ALTER TABLE `image_prod_domain`
  ADD CONSTRAINT `link_to_image` FOREIGN KEY (`image_id`) REFERENCES `tbl_image_db` (`UUID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_to_product_img` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`ListOrder`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_category_domain`
--
ALTER TABLE `products_category_domain`
  ADD CONSTRAINT `categoryKey` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`ListOrder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productKey` FOREIGN KEY (`products_id`) REFERENCES `tbl_products` (`ListOrder`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_attributes_values`
--
ALTER TABLE `tbl_attributes_values`
  ADD CONSTRAINT `bindtoattributes` FOREIGN KEY (`att_Bond`) REFERENCES `tbl_attributes` (`UUID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `added_by_mod` FOREIGN KEY (`addedby`) REFERENCES `tbl_moderators` (`UUID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `link_to_vendor` FOREIGN KEY (`Supplier_ID`) REFERENCES `tbl_vendor` (`UUID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `modified_by` FOREIGN KEY (`Modified_by`) REFERENCES `tbl_moderators` (`UUID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_simple_product`
--
ALTER TABLE `tbl_simple_product`
  ADD CONSTRAINT `link_to_products` FOREIGN KEY (`pod_ref`) REFERENCES `tbl_products` (`ListOrder`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
  ADD CONSTRAINT `createdby` FOREIGN KEY (`createdBy`) REFERENCES `tbl_moderators` (`UUID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `modifiedby` FOREIGN KEY (`modifiedBy`) REFERENCES `tbl_moderators` (`UUID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
