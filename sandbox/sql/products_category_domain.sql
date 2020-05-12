-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2020 at 10:46 PM
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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_category_domain`
--
ALTER TABLE `products_category_domain`
  ADD CONSTRAINT `categoryKey` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`ListOrder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productKey` FOREIGN KEY (`products_id`) REFERENCES `tbl_products` (`ListOrder`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
