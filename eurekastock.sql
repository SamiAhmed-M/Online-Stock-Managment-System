-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 24, 2016 at 09:17 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eurekastock`
--
CREATE DATABASE IF NOT EXISTS `eurekastock` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eurekastock`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerId` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerName` varchar(50) NOT NULL,
  `ContactPersonName` varchar(50) NOT NULL,
  `ContactPersonTel` varchar(25) NOT NULL,
  PRIMARY KEY (`CustomerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerId`, `CustomerName`, `ContactPersonName`, `ContactPersonTel`) VALUES
(1, 'KS SM Business Plc', 'Kalkidan Shiferaw Demissie', '0911131858'),
(3, 'Flybridge Executive Services', 'Yonas Alemu Erena', '0911875526, 0116634499'),
(5, 'XYZ International Plc', 'Mr. George Beaker', '0911223344, 0116651388');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `ItemId` int(11) NOT NULL AUTO_INCREMENT,
  `ItemCode` varchar(15) NOT NULL,
  `GoodsDescription` varchar(50) NOT NULL,
  `DamagedQuantity` int(11) NOT NULL,
  `Remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ItemId`),
  UNIQUE KEY `ItemCode` (`ItemCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemId`, `ItemCode`, `GoodsDescription`, `DamagedQuantity`, `Remark`) VALUES
(1, 'M1301-02', 'ATR ACID', 20, 'Shipment damaged-20'),
(2, 'M1301-41', 'ALCAFOAM AL', 50, 'FOAM CHEMICAL'),
(3, 'M1301-25', 'CALCIUM CHLORIDE', 0, 'Water cleaning detergent');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `PaymentId` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionId` int(11) NOT NULL,
  `PaymentDate` date NOT NULL,
  `PaidAmount` decimal(10,2) NOT NULL,
  `DebitNoteNo` varchar(20) NOT NULL,
  `Remark` varchar(100) NOT NULL,
  PRIMARY KEY (`PaymentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentId`, `TransactionId`, `PaymentDate`, `PaidAmount`, `DebitNoteNo`, `Remark`) VALUES
(2, 1, '2016-10-12', '14000.00', 'Dashen 001', 'Payment through Dashen Bank'),
(3, 2, '2016-10-29', '3000.00', 'Addis Bank 0012', 'Paid through Addis International Bank S.C.'),
(6, 1, '2016-10-24', '5000.00', 'Oromia 0123/2016', 'Paid through Oromia Bank S.C.'),
(7, 1, '2016-11-23', '4000.00', 'Enat 00123/2016', 'Paid through Enat Bank'),
(8, 1, '2016-11-24', '6000.00', 'Dashen 013/2016', 'Paid through Dashen Bank');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `PurchaseId` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`PurchaseId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`PurchaseId`, `SupplierId`, `ItemId`, `PurchaseDate`, `Quantity`, `Remark`) VALUES
(1, 1, 1, '2016-10-04', 1200, 'Imported under LC No. 1023/2009 National Bank of Ethiopia'),
(3, 2, 2, '2016-10-18', 9500, 'Dashen Bank L/C no. 18A200/15/2016'),
(4, 2, 3, '2016-09-20', 8000, 'Dashen Bank L/C 180/200/12/A98'),
(5, 1, 1, '2016-11-02', 1000, 'Imported using L/C permit Dashen 001345/2016');

-- --------------------------------------------------------

--
-- Table structure for table `quantityflag`
--

CREATE TABLE IF NOT EXISTS `quantityflag` (
  `QFlagId` int(11) NOT NULL AUTO_INCREMENT,
  `ItemId` int(11) NOT NULL,
  `MinimumQuantity` int(11) NOT NULL,
  `MaximumQuantity` int(11) NOT NULL,
  PRIMARY KEY (`QFlagId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quantityflag`
--

INSERT INTO `quantityflag` (`QFlagId`, `ItemId`, `MinimumQuantity`, `MaximumQuantity`) VALUES
(2, 1, 8000, 15000),
(3, 2, 8000, 15000),
(4, 3, 5000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `SalesId` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionId` int(11) NOT NULL,
  `ItemId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`SalesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SalesId`, `TransactionId`, `ItemId`, `Quantity`) VALUES
(2, 1, 1, 500),
(3, 2, 1, 100),
(4, 3, 2, 2000),
(5, 5, 3, 2500),
(6, 6, 2, 500),
(7, 3, 2, 500);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `SupplierId` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierName` varchar(50) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SupplierId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierId`, `SupplierName`, `Description`) VALUES
(1, 'EDX Chemical suppliers llc', 'Detergent chemical distributors in Romania'),
(2, 'SOPURA Chemicals Industry plc', 'Chemical factory in Europe'),
(4, 'ABC Chemical Industry', 'For foaming chemicals: Address: Verginia cross road no. 23/12');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `TransactionId` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerId` int(11) NOT NULL,
  `TransactionDate` date NOT NULL,
  `InvoiceNo` varchar(10) NOT NULL,
  `InvoiceAmount` decimal(10,2) NOT NULL,
  `SalesMode` varchar(10) NOT NULL DEFAULT 'Credit',
  `DueDate` date NOT NULL,
  `TransactionName` varchar(100) NOT NULL,
  PRIMARY KEY (`TransactionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TransactionId`, `CustomerId`, `TransactionDate`, `InvoiceNo`, `InvoiceAmount`, `SalesMode`, `DueDate`, `TransactionName`) VALUES
(1, 1, '2016-10-12', '0001', '30000.00', 'Credit', '2016-10-25', 'KS SM Business Plc 2016-10-12 Inv. No. 0001'),
(2, 3, '2016-10-20', '0002', '6000.00', 'Credit', '2016-12-20', 'Flybridge Executive Services 2016-10-20 Inv. No. 0002'),
(3, 3, '2016-11-08', '0003', '1800000.00', 'Credit', '2017-01-07', 'Flybridge Executive Services 2016-11-08 Inv. No. 0003'),
(5, 1, '2016-10-31', '0034', '250000.00', 'Cash', '2016-10-31', 'KS SM Business Plc 2016-10-31 Inv. No. 0034'),
(6, 5, '2016-11-01', '0089', '125000.00', 'Credit', '2017-01-01', 'XYZ International Plc 2016-11-01 Inv. No. 0089');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(50) NOT NULL,
  `Mobile` varchar(30) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Privilege` varchar(20) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `FullName`, `Mobile`, `UserName`, `Password`, `Privilege`) VALUES
(1, 'Sami Mohammed Ahmed', '0911371608', 'sami', 'sameurekastock123', 'Administrator'),
(2, 'Seife Shiferaw Demissie', '0911526278, 0911215088', 'seife', 'seifeeurekastock123', 'Account'),
(3, 'Eskinder Alemayehu', '911223344', 'eskinder', 'eskender123', 'Sales');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
