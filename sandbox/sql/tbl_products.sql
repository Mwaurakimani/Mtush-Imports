-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2020 at 10:45 PM
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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `added_by_mod` FOREIGN KEY (`addedby`) REFERENCES `tbl_moderators` (`UUID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `link_to_vendor` FOREIGN KEY (`Supplier_ID`) REFERENCES `tbl_vendor` (`UUID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `modified_by` FOREIGN KEY (`Modified_by`) REFERENCES `tbl_moderators` (`UUID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
