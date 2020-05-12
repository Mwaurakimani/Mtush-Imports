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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_simple_product`
--
ALTER TABLE `tbl_simple_product`
  ADD CONSTRAINT `link_to_products` FOREIGN KEY (`pod_ref`) REFERENCES `tbl_products` (`ListOrder`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
