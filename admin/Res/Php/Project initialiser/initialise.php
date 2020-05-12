<?php

//create the table
$sql = "CREATE TABLE IF NOT EXISTS `tbl_users` (
  `UUID` varchar(255) NOT NULL COMMENT 'Unique User ID',
  `userFirstName` varchar(110) DEFAULT NULL COMMENT 'users first name',
  `userLastName` varchar(110) DEFAULT NULL COMMENT 'user last name',
  `userOtherName` varchar(110) DEFAULT NULL COMMENT 'user other name',
  `userDOB` date DEFAULT NULL COMMENT 'date of birth',
  `userName` varchar(50) DEFAULT NULL COMMENT 'allius',
  `userEmailAddress` varchar(100) DEFAULT NULL COMMENT 'email',
  `userPhoneNumber1` varchar(15) DEFAULT NULL COMMENT 'primary phone number',
  `userPhoneNumber2` varchar(15) DEFAULT NULL COMMENT 'phone 2',
  `userPhoneNumber3` varchar(15) DEFAULT NULL COMMENT 'phone 3',
  `userPhoneNumber4` varchar(15) DEFAULT NULL COMMENT 'phone 4',
  `userCountryCode` varchar(6) DEFAULT NULL COMMENT 'country code',
  `userCountry` varchar(100) DEFAULT NULL COMMENT 'country',
  `userLocationID` varchar(255) DEFAULT NULL COMMENT 'lyricorn location map',
  `userRegDate` datetime DEFAULT NULL COMMENT 'date joined',
  `status` varchar(30) DEFAULT NULL COMMENT 'status of account',
  `gender` varchar(30) DEFAULT NULL COMMENT 'gender',
  `userPassword` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT 'default.jpg' COMMENT 'profile image',
  PRIMARY KEY (`UUID`),
  UNIQUE KEY `identifier` (`userEmailAddress`),
  KEY `ident` (`userPhoneNumber1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Users table';";

//Create Products Table
$sql = "CREATE TABLE `forextra_db_fta`.`tbl_products` (
   `productID` VARCHAR(50) NOT NULL COMMENT 'product id' ,
   `productName` VARCHAR(255) NULL COMMENT 'product name' ,
   `unitPrice` DECIMAL(12) NULL COMMENT 'Price per unit' ,
   `unitsInStock` INT(12) NULL COMMENT 'Products remaining on stock' ,
   `quanitityOnOrder` INT(12) NULL COMMENT 'Products already ordered' ,
   `productDescription` TEXT NULL COMMENT 'product brief description' ,
   `moreDetails` MEDIUMTEXT NULL COMMENT 'Product detailed description' ,
   `supplierID` VARCHAR(50) NULL COMMENT 'product Suplier ID' ,
   `minQuantity` INT(12) NULL COMMENT 'Minimum quantity of stock allowed' ,
   `productImage` VARCHAR(255) NULL COMMENT 'Product image' ,
   `productCategory1` VARCHAR(50) NULL COMMENT 'Product category' ,
   `productCategory2` VARCHAR(50) NULL COMMENT 'Product category' ,
   `productCategory3` VARCHAR(50) NULL COMMENT 'Product category' ,
   `productCategory4` VARCHAR(50) NULL COMMENT 'Product category' ,
   `productCategory5` VARCHAR(50) NULL COMMENT 'Product category' ,
   `traits1` VARCHAR(50) NULL COMMENT 'traits that a product can pocess eg color/size etc.' ,
   `traits2` VARCHAR(50) NULL COMMENT 'traits that a product can pocess eg color/size etc.' ,
   `traits3` VARCHAR(50) NULL COMMENT 'traits that a product can pocess eg color/size etc.'
 ) ENGINE = MyISAM COMMENT = 'Table containing all products(consider Items table)';";
