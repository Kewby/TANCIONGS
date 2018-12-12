-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2018 at 06:23 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finaltanciongs`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` int(11) NOT NULL,
  `product_code` bigint(20) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `dateDelivered` date NOT NULL,
  `delivery_quantity` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `product_code`, `stock_id`, `delivery_id`, `dateDelivered`, `delivery_quantity`, `expiry_date`, `supplier_id`) VALUES
(1, 74923408731, 12, 4, '2018-12-04', 500, '2023-05-07', 3),
(2, 4800049720121, 1, 1, '2018-11-01', 500, '2022-01-01', 2),
(3, 4807770270055, 2, 2, '2018-11-01', 500, '2022-01-01', 3),
(4, 4807770270024, 3, 3, '2018-11-01', 50, '2022-01-01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`) VALUES
(1, 'Cebu Branch'),
(2, 'Leyte Branch');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `description`) VALUES
(1, 'Beverages', NULL),
(2, 'Dry Goods', NULL),
(3, 'Condiments', NULL),
(4, 'Canned Goods', NULL),
(5, 'Snacks', NULL),
(6, 'Toiletries', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `dateDelivered` date DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_code` bigint(20) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `delivery_quantity` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `dateDelivered`, `product_id`, `product_code`, `product_name`, `delivery_quantity`, `supplier_id`, `expiry_date`, `employee_id`) VALUES
(1, '2018-11-01', 1, 4800049720121, '1000mL NATURES SPRING DRINKING WATER', 500, 2, '2022-01-01', 1),
(2, '2018-11-01', 2, 4807770270055, '60g PANCIT CANTON ORIGINAL', 500, 3, '2022-01-01', 1),
(3, '2018-11-01', 3, 4807770270024, '50g LUCKY ME CHICKEN', 500, 3, '2022-01-01', 1),
(4, '2018-12-04', 12, 74923408731, 'PIKNIK', 500, 3, '2023-05-07', 1),
(5, '2018-12-05', 13, 4800399036095, 'OIL CONTROL SHEET', 600, 1, '2022-03-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_firstname` varchar(255) DEFAULT NULL,
  `employee_lastname` varchar(255) DEFAULT NULL,
  `employee_username` varchar(255) DEFAULT NULL,
  `employee_password` varchar(255) DEFAULT NULL,
  `employee_email` varchar(255) DEFAULT NULL,
  `employee_contactnumber` varchar(15) DEFAULT NULL,
  `employee_tinNumber` varchar(255) DEFAULT NULL,
  `employee_philHealth` varchar(255) DEFAULT NULL,
  `employee_sssNumber` varchar(255) DEFAULT NULL,
  `employee_address` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `role_id` tinyint(4) DEFAULT NULL,
  `deleteStatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_firstname`, `employee_lastname`, `employee_username`, `employee_password`, `employee_email`, `employee_contactnumber`, `employee_tinNumber`, `employee_philHealth`, `employee_sssNumber`, `employee_address`, `branch_id`, `role_id`, `deleteStatus`) VALUES
(1, 'Cebu', 'City', 'cebu', 'cebu', 'cebu@gmail.com', '09123456789', '1234567890', '1234567890', '1234567890', 'Cebu City', 1, 1, 0),
(2, 'Leyte', 'City', 'leyte', 'leyte', 'leyte@email.com', '09123456789', '111111-222222-333333', '111111-222222-333333', '111111-222222-333333', 'Leyte', 2, 1, 0),
(3, 'Allysha', 'Ledesma', 'ally', 'ally', 'ally@email.com', '09123456789', '111111-222222-333333', '111111-222222-333333', '111111-222222-333333', 'My Address', 1, 2, 0),
(4, 'Juan', 'Dela Cruz', 'juan', 'juan', 'juan@email.com', '09123456789', '111111-2222-333', '111111-2222-333', '111111-2222-333', 'Address', 2, 2, 0),
(5, 'John', 'Smith', 'johns', '11111', 'johns@email.com', '09123456789', '111111', '11111', '11111', 'Cebu City', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_code` bigint(20) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_type` tinyint(1) DEFAULT NULL,
  `standard_cost` float(255,2) DEFAULT NULL,
  `markup` float(255,2) DEFAULT NULL,
  `list_price` float(255,2) AS (standard_cost + markup) VIRTUAL,
  `stock_id` int(11) DEFAULT NULL,
  `restockCount` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `deleteStatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_code`, `product_name`, `product_type`, `standard_cost`, `markup`, `stock_id`, `restockCount`, `category_id`, `branch_id`, `deleteStatus`) VALUES
(1, 4800049720121, '1000mL NATURES SPRING DRINKING WATER', 1, 19.75, 5.00, 1, 50, 1, 1, 0),
(2, 4807770270055, '60g PANCIT CANTON ORIGINAL', 1, 5.75, 2.25, 2, 50, 5, 1, 0),
(3, 4807770270024, '50g LUCKY ME CHICKEN', 1, 5.25, 2.00, 3, 50, 5, 1, 0),
(4, 4800110026497, '55g HO-MI INSTANT MAMI NOODLES', 1, 5.00, 2.75, 4, 60, 5, 1, 0),
(5, 4902430278119, '380G TIDE ULTRA ORIG SCENT', 1, 25.00, 5.75, 5, 45, 6, 1, 0),
(6, 4806502350096, '10G SANICARE COTTON ROLLS', 1, 14.00, 3.60, 6, 50, 6, 1, 0),
(7, 4902430698085, '12ML PANTENE SHAMPOO', 1, 4.00, 1.00, 7, 50, 6, 1, 0),
(8, 4902430698078, '16ML REJOICE FRAGRANT RICH SHAMPOO', 1, 27.25, 2.00, 8, 50, 6, 1, 0),
(9, 4902430951357, '60G SAFEGUARD FLORAL PINK WITH ALOE VERA', 1, 35.00, 0.00, 9, 50, 6, 1, 0),
(10, 4902430935999, '135G SAFEGUARD CLASSIC BEIGE', 1, 35.00, 0.00, 9, 50, 6, 1, 0),
(11, 4806507832481, '65G SILKA PAPAYA WHITENING SOAP', 1, 35.00, 0.00, 9, 50, 6, 1, 0),
(12, 74923408731, 'PIKNIK', 0, 35.25, 4.50, 12, 50, 5, 1, 0),
(13, 4800399036095, 'OIL CONTROL SHEET', 0, 35.00, 2.25, NULL, 50, 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` tinyint(4) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Owner'),
(2, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `sales_datetime` datetime DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `changefund` float(255,2) DEFAULT NULL,
  `total_sales` float(255,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_datetime`, `employee_id`, `changefund`, `total_sales`) VALUES
(9, '2018-12-06 12:14:51', 1, 1000000.00, NULL),
(12, '2018-12-07 09:00:09', 1, 100000.00, NULL),
(13, '2018-12-07 09:00:40', 1, NULL, 149.00);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `product_code` bigint(20) DEFAULT NULL,
  `stock_onhand` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `product_code`, `stock_onhand`, `branch_id`) VALUES
(1, 4800049720121, 595, 1),
(2, 4807770270055, 595, 1),
(3, 4807770270024, 590, 1),
(4, 4800110026497, 95, 1),
(5, 4902430278119, 84, 1),
(6, 4806502350096, 95, 1),
(7, 4902430698085, 100, 1),
(8, 4902430698078, 95, 1),
(9, 4902430951357, 91, 1),
(10, 4902430935999, 100, 1),
(11, 4806507832481, 89, 1),
(12, 74923408731, 495, 1),
(13, 4800399036095, 591, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_address` varchar(255) DEFAULT NULL,
  `supplier_email` varchar(255) DEFAULT NULL,
  `supplier_contactnumber` varchar(255) DEFAULT NULL,
  `supplier_contactperson` varchar(255) DEFAULT NULL,
  `deleteStatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_email`, `supplier_contactnumber`, `supplier_contactperson`, `deleteStatus`) VALUES
(1, 'Grannix INC', 'Mabolo, Cebu City', 'grannix@email.com', '09123456789', 'Lorem Ipsum', 0),
(2, 'Natures Spring', 'Lapu-Lapu City', 'natures@email.com', '09123456789', 'Lorem Ipsum', 0),
(3, 'Just Food Corp.', 'Address', 'food@email.com', '09123456789', 'Lorem Ipsum', 0),
(4, 'Virginia', 'Address', 'virginia@email.com', '09123456789', 'Lorem Ipsum', 0),
(5, 'San Miguel', 'Mandaue', 'sanmiguel@email.com', '09123456789', 'Lorem Ipsum', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_datetime` datetime DEFAULT NULL,
  `transaction_grandtotal` float(255,2) DEFAULT NULL,
  `transaction_tender` float(255,2) DEFAULT NULL,
  `transaction_change` float(255,2) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_datetime`, `transaction_grandtotal`, `transaction_tender`, `transaction_change`, `employee_id`) VALUES
(19, '2018-12-06 12:51:00', 236.25, 300.00, 63.75, 1),
(20, '2018-12-06 12:56:00', 461.25, 500.00, 38.75, 1),
(21, '2018-12-06 12:59:00', 30.75, 50.00, 19.25, 1),
(22, '2018-12-06 01:01:00', 35.00, 50.00, 15.00, 1),
(23, '2018-12-06 01:02:00', 175.00, 200.00, 25.00, 1),
(24, '2018-12-06 01:04:00', 175.00, 200.00, 25.00, 1),
(25, '2018-12-06 01:07:00', 245.00, 300.00, 55.00, 1),
(26, '2018-12-06 01:08:00', 70.00, 100.00, 30.00, 1),
(27, '2018-12-06 07:07:00', 198.75, 200.75, 2.00, 1),
(29, '2018-12-07 09:00:00', 149.00, 150.00, 1.00, 1),
(30, '2018-12-07 09:20:00', 35.00, 50.00, 15.00, 1),
(31, '2018-12-07 09:21:00', 286.25, 500.25, 214.00, 1),
(32, '2018-12-07 09:24:00', 126.75, 201.00, 74.25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactionitem`
--

CREATE TABLE `transactionitem` (
  `transactionItem_id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `transactionItem_qty` int(11) DEFAULT NULL,
  `transactionItem_unitprice` float(255,2) DEFAULT NULL,
  `transactionItem_subtotal` float(255,2) AS (transactionItem_qty * transactionItem_unitprice) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactionitem`
--

INSERT INTO `transactionitem` (`transactionItem_id`, `transaction_id`, `product_id`, `transactionItem_qty`, `transactionItem_unitprice`) VALUES
(13, 19, 1, 5, 24.75),
(14, 19, 2, 5, 8.00),
(15, 19, 3, 10, 7.25),
(16, 20, 5, 15, 30.75),
(17, 21, 5, 1, 30.75),
(18, 22, 11, 1, 35.00),
(19, 23, 11, 5, 35.00),
(20, 24, 9, 5, 35.00),
(21, 25, 9, 2, 35.00),
(22, 26, 9, 2, 35.00),
(23, 27, 12, 5, 39.75),
(29, 29, 13, 1, 37.25),
(30, 29, 13, 1, 37.25),
(31, 29, 13, 1, 37.25),
(32, 29, 13, 1, 37.25),
(33, 30, 11, 1, 35.00),
(34, 31, 11, 1, 35.00),
(35, 31, 11, 1, 35.00),
(36, 31, 11, 1, 35.00),
(37, 31, 11, 1, 35.00),
(38, 31, 8, 5, 29.25),
(39, 32, 6, 1, 17.60),
(40, 32, 6, 1, 17.60),
(41, 32, 6, 1, 17.60),
(42, 32, 6, 1, 17.60),
(43, 32, 6, 1, 17.60),
(44, 32, 4, 5, 7.75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `batch_fk1` (`stock_id`),
  ADD KEY `batch_fk2` (`delivery_id`),
  ADD KEY `batch_fk3` (`supplier_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `delivery_fk1` (`product_id`),
  ADD KEY `delivery_fk2` (`supplier_id`),
  ADD KEY `delivery_fk3` (`employee_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_fk1` (`branch_id`),
  ADD KEY `employee_fk2` (`role_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_fk1` (`branch_id`),
  ADD KEY `product_fk2` (`stock_id`),
  ADD KEY `product_fk3` (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `sales_fk1` (`employee_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `stock_fk1` (`branch_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transaction_fk1` (`employee_id`);

--
-- Indexes for table `transactionitem`
--
ALTER TABLE `transactionitem`
  ADD PRIMARY KEY (`transactionItem_id`),
  ADD KEY `transactionItem_fk1` (`transaction_id`),
  ADD KEY `transactionItem_fk2` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `transactionitem`
--
ALTER TABLE `transactionitem`
  MODIFY `transactionItem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_fk1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`stock_id`),
  ADD CONSTRAINT `batch_fk2` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`delivery_id`),
  ADD CONSTRAINT `batch_fk3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_fk1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `delivery_fk2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `delivery_fk3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_fk1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `employee_fk2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_fk1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `product_fk2` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`stock_id`),
  ADD CONSTRAINT `product_fk3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_fk1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_fk1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_fk1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `transactionitem`
--
ALTER TABLE `transactionitem`
  ADD CONSTRAINT `transactionItem_fk1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`),
  ADD CONSTRAINT `transactionItem_fk2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
