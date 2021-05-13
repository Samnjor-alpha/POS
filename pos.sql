-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2020 at 12:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(6) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `username`, `email`, `role`, `password`) VALUES
(1, 'samuel', 'Njoroge', 'samnjor', 'samnjormessy@gmail.com', 1, '$2y$10$WIP34VuDSz1LCwcpw00Z7uFrQh5IY10SGa0f0r7n4D1cLxAQ76EB2'),
(4, 'Cashier', 'casier', 'CASHIER', 'cashier@pos.com', 0, '$2y$10$.dT8z.U2gVUHdygylboo2.TdmrdCsGnPHi6cYoMo2Sxc7F.9lSUp2');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'laundry soaps & Detergents'),
(2, 'Glassware'),
(3, 'Cereals'),
(4, 'Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `p_code` varchar(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_categeory` varchar(255) NOT NULL,
  `p_supplier` varchar(255) NOT NULL,
  `cost_price` int(255) NOT NULL,
  `selling_price` int(255) NOT NULL,
  `p_qty` int(255) NOT NULL,
  `date_delivered` datetime(6) NOT NULL,
  `mfg_date` date NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `p_code`, `p_name`, `p_categeory`, `p_supplier`, `cost_price`, `selling_price`, `p_qty`, `date_delivered`, `mfg_date`, `expiry_date`) VALUES
(1, 'PCT-0722', 'omo', 'laundry soaps & Detergents', 'kilof', 12, 15, 201, '2020-04-26 15:26:43.000000', '2020-03-29', '2021-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `p_menu`
--

CREATE TABLE `p_menu` (
  `id` int(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `units` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `p_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_menu`
--

INSERT INTO `p_menu` (`id`, `p_name`, `units`, `price`, `p_desc`) VALUES
(1, 'omo', 'grams', 15, 'omo 15 grams');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `s_date` date NOT NULL,
  `amount` varchar(100) NOT NULL,
  `cash` int(255) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `transaction_id`, `invoice_number`, `cashier`, `c_name`, `s_date`, `amount`, `cash`, `profit`, `balance`) VALUES
(1, 'TRNS2022', 'INV-242', 'admin', ',. M,M ', '2020-04-27', '2805', 2805, '571', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `order_id` int(11) NOT NULL,
  `order_trans_id` varchar(255) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `p_id` varchar(255) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` int(255) NOT NULL,
  `Profit` varchar(100) NOT NULL,
  `product_code` varchar(150) NOT NULL,
  `price` varchar(100) NOT NULL,
  `date` varchar(500) NOT NULL,
  `complete` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`order_id`, `order_trans_id`, `invoice`, `product`, `p_id`, `qty`, `amount`, `Profit`, `product_code`, `price`, `date`, `complete`) VALUES
(2, 'ORD-4564', 'INV-242', 'OMO', '1', '187', 2805, '571', 'PCT-0722', '15', '27/04/2020', 1),
(4, 'ORD4023', 'INV-42305', 'omo', '1', '1', 15, '3', 'PCT-0722', '15', '2020-04-30 13:28:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `biz_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cost_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `fname`, `lname`, `email`, `biz_name`, `category`, `tel`, `address`, `cost_price`) VALUES
(1, 'kingoo', 'Madini', 'sheski@gmail.com', 'Sheski', 'laundry soaps & Detergents', '075549549', 'Wendani', '30'),
(2, 'Felan', 'ewa', 'fel@mil.com', 'filani', 'Beverages', '0782923223', 'reatr', '40'),
(3, 'kingoo', 'castier', 'kilo@fsf.cvpn', 'kilof', 'Cereals', '0782923223', 'sds', '45');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `sup_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cost_price` int(255) NOT NULL,
  `p_qty` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `date_delivered` date NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `qty_remain` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`sup_id`, `product_code`, `product_name`, `category`, `cost_price`, `p_qty`, `supplier`, `date_delivered`, `invoice`, `amount`, `qty_remain`) VALUES
(1, 'PCT-0722', 'omo', 'laundry soaps & Detergents', 12, '500', 'kilof', '2020-04-26', 'S-INV-32423', 6000, 182);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_menu`
--
ALTER TABLE `p_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`sup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `p_menu`
--
ALTER TABLE `p_menu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
