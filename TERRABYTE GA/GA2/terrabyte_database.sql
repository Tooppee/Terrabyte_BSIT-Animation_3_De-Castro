-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 04:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `terrabyte database`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_ID` int(11) NOT NULL,
  `house_no.` int(10) NOT NULL,
  `street` varchar(25) NOT NULL,
  `brgy` varchar(25) NOT NULL,
  `region` char(5) NOT NULL,
  `city` varchar(20) NOT NULL,
  `municipality` varchar(25) NOT NULL,
  `postal_code` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_ID`, `house_no.`, `street`, `brgy`, `region`, `city`, `municipality`, `postal_code`) VALUES
(1, 1015, 'Barriada Purok 6', 'BRGY. 38 GOGON', 'V', 'Legazpi City', 'Albay', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_ID` int(11) NOT NULL,
  `cart_ID` int(11) NOT NULL,
  `product_item_ID` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `User_ID` int(11) NOT NULL,
  `email_address` varchar(55) NOT NULL,
  `Fname` varchar(25) NOT NULL,
  `MI` varchar(1) NOT NULL,
  `Lname` varchar(25) NOT NULL,
  `contact` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`User_ID`, `email_address`, `Fname`, `MI`, `Lname`, `contact`) VALUES
(3, 'cjdc1100@gmail.com', 'Christopher John', '', 'de Castro', '09637107982');

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `order_line_ID` int(11) NOT NULL,
  `prod_item_ID` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `qty` int(25) NOT NULL,
  `price` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_ID` int(11) NOT NULL,
  `field` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `payment_type_ID` int(11) NOT NULL,
  `provider` varchar(25) NOT NULL,
  `acc_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_ID` int(11) NOT NULL,
  `field` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_ID` int(11) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `prod_IMG` varbinary(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_ID`, `category_ID`, `name`, `description`, `prod_IMG`) VALUES
(3, 1, 'Corndog', 'masarap', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `prod_category_ID` int(11) NOT NULL,
  `parent_categroy_ID` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`prod_category_ID`, `parent_categroy_ID`, `category_name`) VALUES
(1, 1, 'Snacks');

-- --------------------------------------------------------

--
-- Table structure for table `product_config`
--

CREATE TABLE `product_config` (
  `prod_item_ID` int(11) NOT NULL,
  `Variation_option_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_item`
--

CREATE TABLE `product_item` (
  `prod_item_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `qty_in_stock` int(25) NOT NULL,
  `prdouct_IMG` varbinary(50) NOT NULL,
  `price` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_item`
--

INSERT INTO `product_item` (`prod_item_ID`, `product_ID`, `qty_in_stock`, `prdouct_IMG`, `price`) VALUES
(1, 3, 69, '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_status`
--

CREATE TABLE `shipping_status` (
  `shipping_status_ID` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `price` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE `shop_order` (
  `shop_order-ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_ID` int(11) NOT NULL,
  `shipping_address_ID` int(11) NOT NULL,
  `shipping_method_ID` int(11) NOT NULL,
  `order_total` decimal(6,0) NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `address_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`address_ID`, `user_ID`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_review`
--

CREATE TABLE `users_review` (
  `users_review_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `order_line_ID` int(11) NOT NULL,
  `rating_value` decimal(6,0) NOT NULL,
  `component` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation`
--

CREATE TABLE `variation` (
  `variation_ID` int(11) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation_option`
--

CREATE TABLE `variation_option` (
  `var_option_ID` int(11) NOT NULL,
  `variation_ID` int(11) NOT NULL,
  `value` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_ID`),
  ADD KEY `cart_ID` (`cart_ID`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`),
  ADD UNIQUE KEY `User_ID_2` (`User_ID`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`order_line_ID`),
  ADD KEY `prod_item` (`prod_item_ID`),
  ADD KEY `order_dizz` (`order_ID`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_ID`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `payment_type` (`payment_type_ID`),
  ADD KEY `PM_user` (`user_ID`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `prod_cat` (`category_ID`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`prod_category_ID`),
  ADD KEY `parent` (`parent_categroy_ID`);

--
-- Indexes for table `product_config`
--
ALTER TABLE `product_config`
  ADD KEY `prod` (`prod_item_ID`),
  ADD KEY `var` (`Variation_option_ID`);

--
-- Indexes for table `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`prod_item_ID`),
  ADD KEY `prod_ID` (`product_ID`);

--
-- Indexes for table `shipping_status`
--
ALTER TABLE `shipping_status`
  ADD PRIMARY KEY (`shipping_status_ID`);

--
-- Indexes for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD PRIMARY KEY (`shop_order-ID`),
  ADD KEY `shipping` (`shipping_address_ID`),
  ADD KEY `userz` (`user_ID`),
  ADD KEY `payment` (`payment_ID`),
  ADD KEY `shipping_status` (`shipping_method_ID`),
  ADD KEY `order_Stat` (`order_status`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD KEY `address_ID` (`address_ID`),
  ADD KEY `ygv` (`user_ID`);

--
-- Indexes for table `users_review`
--
ALTER TABLE `users_review`
  ADD PRIMARY KEY (`users_review_ID`),
  ADD KEY `user` (`user_ID`),
  ADD KEY `order` (`order_line_ID`);

--
-- Indexes for table `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`variation_ID`),
  ADD KEY `category` (`category_ID`);

--
-- Indexes for table `variation_option`
--
ALTER TABLE `variation_option`
  ADD PRIMARY KEY (`var_option_ID`),
  ADD KEY `var_ID` (`variation_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `order_line_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `prod_category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_item`
--
ALTER TABLE `product_item`
  MODIFY `prod_item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_status`
--
ALTER TABLE `shipping_status`
  MODIFY `shipping_status_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
  MODIFY `shop_order-ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_review`
--
ALTER TABLE `users_review`
  MODIFY `users_review_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation`
--
ALTER TABLE `variation`
  MODIFY `variation_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation_option`
--
ALTER TABLE `variation_option`
  MODIFY `var_option_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `user_ID` FOREIGN KEY (`user_ID`) REFERENCES `customer_info` (`User_ID`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_ID` FOREIGN KEY (`cart_ID`) REFERENCES `cart` (`cart_ID`);

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `order_dizz` FOREIGN KEY (`order_ID`) REFERENCES `shop_order` (`shop_order-ID`),
  ADD CONSTRAINT `prod_item` FOREIGN KEY (`prod_item_ID`) REFERENCES `product_item` (`prod_item_ID`);

--
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `PM_user` FOREIGN KEY (`user_ID`) REFERENCES `customer_info` (`User_ID`),
  ADD CONSTRAINT `payment_type` FOREIGN KEY (`payment_type_ID`) REFERENCES `payment_type` (`payment_type_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `prod_cat` FOREIGN KEY (`category_ID`) REFERENCES `product_category` (`prod_category_ID`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `parent` FOREIGN KEY (`parent_categroy_ID`) REFERENCES `product_category` (`prod_category_ID`);

--
-- Constraints for table `product_config`
--
ALTER TABLE `product_config`
  ADD CONSTRAINT `prod` FOREIGN KEY (`prod_item_ID`) REFERENCES `product_item` (`prod_item_ID`),
  ADD CONSTRAINT `var` FOREIGN KEY (`Variation_option_ID`) REFERENCES `variation_option` (`var_option_ID`);

--
-- Constraints for table `product_item`
--
ALTER TABLE `product_item`
  ADD CONSTRAINT `prod_ID` FOREIGN KEY (`product_ID`) REFERENCES `product` (`product_ID`);

--
-- Constraints for table `shop_order`
--
ALTER TABLE `shop_order`
  ADD CONSTRAINT `order_Stat` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`order_status_ID`),
  ADD CONSTRAINT `payment` FOREIGN KEY (`payment_ID`) REFERENCES `payment_method` (`payment_ID`),
  ADD CONSTRAINT `shipping` FOREIGN KEY (`shipping_address_ID`) REFERENCES `address` (`address_ID`),
  ADD CONSTRAINT `shipping_status` FOREIGN KEY (`shipping_method_ID`) REFERENCES `shipping_status` (`shipping_status_ID`),
  ADD CONSTRAINT `userz` FOREIGN KEY (`user_ID`) REFERENCES `customer_info` (`User_ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `address_ID` FOREIGN KEY (`address_ID`) REFERENCES `address` (`address_ID`),
  ADD CONSTRAINT `ygv` FOREIGN KEY (`user_ID`) REFERENCES `customer_info` (`User_ID`);

--
-- Constraints for table `users_review`
--
ALTER TABLE `users_review`
  ADD CONSTRAINT `order` FOREIGN KEY (`order_line_ID`) REFERENCES `order_line` (`order_line_ID`),
  ADD CONSTRAINT `user` FOREIGN KEY (`user_ID`) REFERENCES `customer_info` (`User_ID`);

--
-- Constraints for table `variation`
--
ALTER TABLE `variation`
  ADD CONSTRAINT `category` FOREIGN KEY (`category_ID`) REFERENCES `product_category` (`prod_category_ID`);

--
-- Constraints for table `variation_option`
--
ALTER TABLE `variation_option`
  ADD CONSTRAINT `var_ID` FOREIGN KEY (`variation_ID`) REFERENCES `variation` (`variation_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
