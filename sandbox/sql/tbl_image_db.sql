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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
