-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2020 at 03:20 PM
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
-- Database: `mydb`
--



--
-- Table structure for table `tbl_moderators`
--

DROP TABLE IF EXISTS `tbl_moderators`;
CREATE TABLE IF NOT EXISTS `tbl_moderators` (
  `UUID` varchar(50) NOT NULL,
  `userFirstName` varchar(50) DEFAULT NULL,
  `userLastName` varchar(50) DEFAULT NULL,
  `userOtherName` varchar(50) DEFAULT NULL,
  `nationalID` varchar(255) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL,
  `userEmailAddress` varchar(60) DEFAULT NULL,
  `userPhoneNumber` varchar(15) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Role` varchar(30) DEFAULT 'normal',
  `accountStatus` varchar(30) DEFAULT 'Active',
  `profilePicture` varchar(50) DEFAULT 'default.jpg',
  `password` varchar(70) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `lastModified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`UUID`),
  UNIQUE KEY `userEmailAddress_UNIQUE` (`userEmailAddress`),
  UNIQUE KEY `userPhoneNumber_UNIQUE` (`userPhoneNumber`),
  UNIQUE KEY `userName_UNIQUE` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_moderators`
--

INSERT INTO `tbl_moderators` (`UUID`, `userFirstName`, `userLastName`, `userOtherName`, `nationalID`, `userName`, `gender`, `userEmailAddress`, `userPhoneNumber`, `Address`, `Role`, `accountStatus`, `profilePicture`, `password`, `regDate`, `lastModified`) VALUES
('19c9999d-cc2a-4ffc-aaba-3fb9180f6822', 'Peter', 'Mwaura', 'Kimani', '34171163', 'Kimani', 'Male', 'kimmwaus@gmail.com', '+254719445697', 'Banana', 'Admin', 'Active', 'default.jpg', '$2y$10$Orf63hLuJWbZofMx2qO0t.nUMNRI2akvaoMB7wCTf8RVOVhUPw58C', '2020-04-07 18:37:14', '2020-04-07 18:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `image_prod_domain`
--

DROP TABLE IF EXISTS `image_prod_domain`;
CREATE TABLE IF NOT EXISTS `image_prod_domain` (
  `UUID` varchar(70) NOT NULL,
  `image_id` varchar(70) NOT NULL,
  `product_id` varchar(70) NOT NULL,
  PRIMARY KEY (`UUID`),
  KEY `product_prod_index` (`product_id`),
  KEY `image_prod_index` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_category_domain`
--

DROP TABLE IF EXISTS `product_category_domain`;
CREATE TABLE IF NOT EXISTS `product_category_domain` (
  `product_id` varchar(70) NOT NULL,
  `category_id` varchar(70) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `c_key_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `sub_categories`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
`UUID` varchar(70)
,`cat_name` varchar(40)
,`cat_slung` varchar(45)
,`cat_parent` varchar(45)
,`cat_description` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `supplier_details`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `supplier_details`;
CREATE TABLE IF NOT EXISTS `supplier_details` (
`Product_id` varchar(70)
,`Product_name` varchar(100)
,`Vanedor_id` varchar(70)
,`Vanedor_name` varchar(70)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attributes`
--

DROP TABLE IF EXISTS `tbl_attributes`;
CREATE TABLE IF NOT EXISTS `tbl_attributes` (
  `UUID` varchar(70) NOT NULL,
  `att_name` varchar(40) DEFAULT NULL,
  `att_slung` varchar(45) DEFAULT NULL,
  `att_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attributes_values`
--

DROP TABLE IF EXISTS `tbl_attributes_values`;
CREATE TABLE IF NOT EXISTS `tbl_attributes_values` (
  `UUID` varchar(70) NOT NULL,
  `value_name` varchar(50) DEFAULT NULL,
  `value_slung` varchar(50) DEFAULT NULL,
  `value_description` varchar(45) DEFAULT NULL,
  `att_Bond` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`UUID`),
  KEY `bind attribute_idx` (`att_Bond`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `UUID` varchar(70) NOT NULL,
  `cat_name` varchar(40) DEFAULT NULL,
  `cat_slung` varchar(45) DEFAULT NULL,
  `cat_parent` varchar(45) DEFAULT NULL,
  `cat_description` varchar(255) DEFAULT NULL,
  `cat_img` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`UUID`, `cat_name`, `cat_slung`, `cat_parent`, `cat_description`, `cat_img`) VALUES
('1', 'Default', 'Others', 'None', 'All products will have this as their default category.Do not delete this Category.Altering it is discouraged', NULL),
('64a28132-0c0a-4af4-b525-46c0b5d5adc4', 'Female', 'Ladies\' Fashion', 'None', 'Get the most from our Ladies fashion selection. Whether it&rsquo;s that big event you are heading to or that office job you intend to get or rather just want to dress up for a swim. We offer fits for all those out door/indoor activities and so much more.', NULL),
('8f65f540-d377-4ee7-8a88-beb2720b9091', 'Male', 'Men\'s Fashion', 'None', 'Get the opportunity to choose from a wide selection of Male products. Official, casual, sporty and a mixture of trendy all at the most affordable prices.', NULL),
('992afb64-3b11-457a-bc41-69b56adea838', 'House Hold', 'House Hold', 'None', 'Make your house look extravagant with all available house hold items. Ranging from curtains, carpets, Doormats , Duvets  and so much more to choose from.  ', NULL),
('d83f2ae1-8d67-4729-9c9b-656831b9c7d2', 'Kids', 'Kids fashion', 'None', 'We offer Kids wear with age and style in mind. From Cold wear to summer outfits. Variations based on children age from new-born to 12-year-old. Sweaters, socks, trendy wear you can all find them here.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discounts`
--

DROP TABLE IF EXISTS `tbl_discounts`;
CREATE TABLE IF NOT EXISTS `tbl_discounts` (
  `discountID` varchar(70) NOT NULL,
  `discountTag` varchar(45) NOT NULL,
  `discountAmount` decimal(10,2) UNSIGNED DEFAULT NULL,
  `discountPercent` int(10) UNSIGNED DEFAULT NULL,
  `remainign` int(10) UNSIGNED NOT NULL,
  `dateAdded` datetime DEFAULT current_timestamp(),
  `dateModified` datetime DEFAULT NULL,
  PRIMARY KEY (`discountID`),
  UNIQUE KEY `discountTag_UNIQUE` (`discountTag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_image_db`
--

DROP TABLE IF EXISTS `tbl_image_db`;
CREATE TABLE IF NOT EXISTS `tbl_image_db` (
  `UUID` varchar(70) NOT NULL,
  `img_width` int(11) DEFAULT NULL,
  `img_height` int(11) DEFAULT NULL,
  `img_name` varchar(70) DEFAULT NULL,
  `size` decimal(15,0) DEFAULT NULL,
  `mime_type` varchar(100) DEFAULT NULL,
  `path_from_root` mediumtext DEFAULT NULL,
  PRIMARY KEY (`UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `UUID` varchar(70) NOT NULL,
  `productName` varchar(100) DEFAULT NULL,
  `ListOrder` int(11) NOT NULL AUTO_INCREMENT,
  `Supplier_ID` varchar(70) DEFAULT NULL,
  `Short_description` mediumtext DEFAULT NULL,
  `long_description` mediumtext DEFAULT NULL,
  `Status` varchar(10) DEFAULT '1',
  `Visibility` varchar(15) DEFAULT 'All',
  `enable_edit` varchar(3) DEFAULT '1',
  `Product_type` varchar(45) DEFAULT NULL,
  `addedby` varchar(70) DEFAULT NULL,
  `Modified_by` varchar(70) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT current_timestamp(),
  `dateModified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_image` varchar(80) DEFAULT 'http://test.local/res/images/productsImages/default.png',
  PRIMARY KEY (`ListOrder`),
  KEY `mod_added_by` (`addedby`),
  KEY `mod_modified_by` (`Modified_by`),
  KEY `Uinique` (`UUID`),
  KEY `link_to_vendor_idx` (`Supplier_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`UUID`, `productName`, `ListOrder`, `Supplier_ID`, `Short_description`, `long_description`, `Status`, `Visibility`, `enable_edit`, `Product_type`, `addedby`, `Modified_by`, `dateCreated`, `dateModified`, `product_image`) VALUES
('26ec323c-17f5-43c8-9eeb-95d842806e20', 'Prado', 32, 'b9268c99-f2c1-47b9-88dd-7c1a20da5116', '{\"ops\":[{\"insert\":\"the quick brown fox jummped over the lazy dogs\\n\\n\"}]}', '{\"ops\":[{\"insert\":\"this is a car\\n\"}]}', 'Active', 'All', 'Yes', 'Single', '19c9999d-cc2a-4ffc-aaba-3fb9180f6822', '19c9999d-cc2a-4ffc-aaba-3fb9180f6822', '2020-04-22 14:08:02', '2020-04-22 14:08:02', 'http://test.local/res/images/productsImages/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_simple_product`
--

DROP TABLE IF EXISTS `tbl_simple_product`;
CREATE TABLE IF NOT EXISTS `tbl_simple_product` (
  `UUID` varchar(70) NOT NULL,
  `pod_ref` varchar(70) NOT NULL,
  `SKU` varchar(45) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `low_stock_quantity` int(11) DEFAULT NULL,
  `sold_alone` varchar(5) DEFAULT '0',
  `regular_price` decimal(15,2) DEFAULT NULL,
  `Discount_ID` varchar(70) DEFAULT NULL,
  `prod_condition` varchar(45) DEFAULT NULL,
  `package` varchar(45) DEFAULT NULL,
  `estimated_count` int(11) DEFAULT NULL,
  `price_cat` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`UUID`),
  KEY `link_to_products_idx` (`pod_ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_simple_product`
--

INSERT INTO `tbl_simple_product` (`UUID`, `pod_ref`, `SKU`, `stock_quantity`, `low_stock_quantity`, `sold_alone`, `regular_price`, `Discount_ID`, `prod_condition`, `package`, `estimated_count`, `price_cat`) VALUES
('8c5acc0c-fc2a-4646-81d2-4b0c6b0aa397', '26ec323c-17f5-43c8-9eeb-95d842806e20', ' P_001', 10, 5, 'No', '4000.00', NULL, 'Good', '55Kg Bag', 70, 'Average');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

DROP TABLE IF EXISTS `tbl_tags`;
CREATE TABLE IF NOT EXISTS `tbl_tags` (
  `UUID` varchar(70) NOT NULL,
  `tag_name` varchar(40) DEFAULT NULL,
  `tag_slung` varchar(45) DEFAULT NULL,
  `tag_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tags`
--

INSERT INTO `tbl_tags` (`UUID`, `tag_name`, `tag_slung`, `tag_description`) VALUES
('62d3866d-edcc-4de0-a969-224e04156126', 'color', 'color', 'color');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `UUID` varchar(50) NOT NULL,
  `userFirstName` varchar(50) DEFAULT NULL,
  `userLastName` varchar(50) DEFAULT NULL,
  `userOtherName` varchar(50) DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userDOB` date DEFAULT NULL,
  `userEmailAddress` varchar(60) DEFAULT NULL,
  `userPhoneNumber` varchar(15) DEFAULT NULL,
  `userCountryCode` varchar(5) DEFAULT NULL,
  `userCountry` varchar(100) DEFAULT NULL,
  `userLocationID` varchar(150) DEFAULT NULL,
  `accountStatus` varchar(30) DEFAULT 'Active',
  `accountType` varchar(30) DEFAULT 'normal',
  `profilePicture` varchar(50) DEFAULT 'default.jpg',
  `password` varchar(70) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `lastModified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`UUID`),
  UNIQUE KEY `userEmailAddress_UNIQUE` (`userEmailAddress`),
  UNIQUE KEY `userPhoneNumber_UNIQUE` (`userPhoneNumber`),
  UNIQUE KEY `userName_UNIQUE` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

DROP TABLE IF EXISTS `tbl_vendor`;
CREATE TABLE IF NOT EXISTS `tbl_vendor` (
  `UUID` varchar(70) NOT NULL,
  `vendorName` varchar(70) DEFAULT NULL,
  `contactName` varchar(70) DEFAULT NULL,
  `contactTitle` varchar(50) DEFAULT NULL,
  `city1` varchar(50) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `city2` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `postalCode` varchar(20) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(70) DEFAULT NULL,
  `Url` varchar(70) DEFAULT NULL,
  `Note` mediumtext DEFAULT NULL,
  `Logo` varchar(80) DEFAULT NULL,
  `dateCreated` datetime DEFAULT current_timestamp(),
  `lastModified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` varchar(70) DEFAULT NULL,
  `modifiedBy` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`UUID`),
  KEY `createdby_idx` (`createdBy`),
  KEY `modifiedby_idx` (`modifiedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`UUID`, `vendorName`, `contactName`, `contactTitle`, `city1`, `address1`, `city2`, `address2`, `postalCode`, `Phone`, `Email`, `Url`, `Note`, `Logo`, `dateCreated`, `lastModified`, `createdBy`, `modifiedBy`) VALUES
('b9268c99-f2c1-47b9-88dd-7c1a20da5116', 'Mtush Imports ltd', 'Kimani', '1234567', 'Kiambu', 'Banana', 'Kiambu', 'Banana', '12345', '0719445697', 'kimmwaus@gmail.com', 'Mtush.imports.com', 'the quick brown fox jumped over the lazy dogs\n\nthe quick brown fox jumped over the lazy dogs\n', NULL, '2020-04-08 22:01:18', '2020-04-08 22:46:47', '19c9999d-cc2a-4ffc-aaba-3fb9180f6822', '19c9999d-cc2a-4ffc-aaba-3fb9180f6822'),
('f3b254bf-3119-43cf-96cd-5df9292374bd', 'Lyricorn', 'Kimani', 'Mtush Imports', 'Kiambu', 'Banana', 'Kiambu', 'Banana', '12345', '0719445697', 'kimmwaus@gmail.com', 'Mtush.imports.com', 'jgsdgdfgdfgdfgdfgdsf', NULL, '2020-04-08 23:48:00', '2020-04-08 23:48:01', '19c9999d-cc2a-4ffc-aaba-3fb9180f6822', '19c9999d-cc2a-4ffc-aaba-3fb9180f6822');

-- --------------------------------------------------------

--
-- Structure for view `sub_categories`
--
DROP TABLE IF EXISTS `sub_categories`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sub_categories`  AS  select `tbl_category`.`UUID` AS `UUID`,`tbl_category`.`cat_name` AS `cat_name`,`tbl_category`.`cat_slung` AS `cat_slung`,`tbl_category`.`cat_parent` AS `cat_parent`,`tbl_category`.`cat_description` AS `cat_description` from `tbl_category` where `tbl_category`.`cat_parent` <> 'None' ;

-- --------------------------------------------------------

--
-- Structure for view `supplier_details`
--
DROP TABLE IF EXISTS `supplier_details`;

CREATE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supplier_details`  AS  select `tbl_products`.`UUID` AS `Product_id`,`tbl_products`.`productName` AS `Product_name`,`tbl_vendor`.`UUID` AS `Vanedor_id`,`tbl_vendor`.`vendorName` AS `Vanedor_name` from (`tbl_products` join `tbl_vendor` on(`tbl_products`.`Supplier_ID` = `tbl_vendor`.`UUID`)) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_prod_domain`
--
ALTER TABLE `image_prod_domain`
  ADD CONSTRAINT `image_fk` FOREIGN KEY (`image_id`) REFERENCES `tbl_image_db` (`UUID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_fk` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`UUID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category_domain`
--
ALTER TABLE `product_category_domain`
  ADD CONSTRAINT `c_key` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`UUID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `p_key` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`UUID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_attributes_values`
--
ALTER TABLE `tbl_attributes_values`
  ADD CONSTRAINT `bind attribute` FOREIGN KEY (`att_Bond`) REFERENCES `tbl_attributes` (`UUID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `link_to_products` FOREIGN KEY (`pod_ref`) REFERENCES `tbl_products` (`UUID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
