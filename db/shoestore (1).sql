-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 09:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `image` varchar(2000) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `size` varchar(10) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `u_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `image`, `quantity`, `size`, `brand`, `category`, `u_id`) VALUES
(53, 'ja 1 basketball', '11000', 'ja-1-basketball-shoes-bCx2W3.png', 2, '10', 'Nike', 'Men', 40),
(55, 'gt-cut-3-basketball', '9000', 'gt-cut-3-basketball-shoes-GLHCGc.png', 1, '9', 'Nike', 'Men', 41),
(56, 'air-griffey-max-1', '7500', 'air-griffey-max-1-big-kids-shoes-GRjZ5g.png', 1, '5.5Y', 'Jordan', 'Kids', 41),
(57, 'air-force-1-le-big', '6000', 'air-force-1-le-big-kids-shoes-Tzzkvl.png', 1, '4Y', 'Nike', 'Kids', 40);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `u_id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`u_id`, `firstname`, `lastname`, `email`, `password`, `address`, `mobile`) VALUES
(40, 'prem', 'kathayat', 'premkathayat13@gmail.com', 'prem1234', 'kathmandu', '9806413872'),
(41, 'Anuj', 'Shrestha', 'anujmalla99@gmail.com', 'anuj1234', 'Bhaktapur', '9812345678');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `email`, `message`) VALUES
(2, 'kathayatprem275@gmail.com', 'I like this website.'),
(5, 'nepalnew275@gmail.com', 'Nice'),
(11, 'anujmalla99@gmail.com', 'I like Nike Brand Shoe.');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `name`, `number`, `email`, `method`, `house_no`, `street`, `city`, `state`, `total_products`, `total_price`, `order_date`, `action`) VALUES
(31, 'ii', '9800000000', 'premkathayat13@gmail.com', 'cash on delivery', '345', 'ktm', 'ktm', 'bagmati', 'air-griffey-max-1 (1) , air-jordan-4-retro-industrial (1) ', '12500', '2024-05-20 18:41:54', 'Canceled'),
(32, 'Anuj Shrestha', '9812345678', 'anujmalla99@gmail.com', 'cash on delivery', '23', 'thimi', 'Bhaktapur', 'bagmati', 'gt-cut-3-basketball (1) , air-griffey-max-1 (1) ', '16500', '2024-05-21 11:59:50', 'Delivered'),
(33, 'prem kathayat', '9806413872', 'premkathayat13@gmail.com', 'cash on delivery', '12', 'imadol', 'kathmandu', 'bagmati', 'ja 1 basketball (2) , air-force-1-le-big (1) ', '28000', '2024-05-21 12:07:24', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `image` varchar(2000) DEFAULT NULL,
  `size` varchar(10) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `size`, `brand`, `category`) VALUES
(68, 'gt-cut-3-basketball', '9000', 'gt-cut-3-basketball-shoes-GLHCGc.png', '9', 'Nike', 'Men'),
(69, 'ja 1 basketball', '12000', 'ja-1-basketball-shoes-bCx2W3.png', '10', 'Nike', 'Men'),
(73, 'air-force-1-le-big', '6000', 'air-force-1-le-big-kids-shoes-Tzzkvl.png', '4Y', 'Nike', 'Kids'),
(74, 'air-griffey-max-1', '7500', 'air-griffey-max-1-big-kids-shoes-GRjZ5g.png', '5.5Y', 'Jordan', 'Kids'),
(79, 'air-jordan-4-retro-industrial', '5500', 'air-jordan-4-retro-industrial-blue-big-kids-shoes-VqdnWF.png', '4.5Y', 'Nike', 'Kids'),
(86, 'rock-06', '4000', 'rock-06.jpg', '8', 'Goldstar', 'Men');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `price` varchar(25) DEFAULT NULL,
  `image` varchar(2000) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `size` varchar(10) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `u_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adding_fk` (`u_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_w` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `adding_fk` FOREIGN KEY (`u_id`) REFERENCES `customer` (`u_id`),
  ADD CONSTRAINT `fk_c` FOREIGN KEY (`u_id`) REFERENCES `customer` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_w` FOREIGN KEY (`u_id`) REFERENCES `customer` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wishlist_customer` FOREIGN KEY (`u_id`) REFERENCES `customer` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
