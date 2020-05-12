-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2020 at 10:48 PM
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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_prod_domain`
--
ALTER TABLE `image_prod_domain`
  ADD CONSTRAINT `link_to_image` FOREIGN KEY (`image_id`) REFERENCES `tbl_image_db` (`UUID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_to_product_img` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`ListOrder`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
