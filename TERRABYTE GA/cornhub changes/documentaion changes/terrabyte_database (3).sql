-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 03:30 PM
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
-- Database: `terrabyte_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_price` float(7,2) NOT NULL,
  `prod_img` varchar(500) NOT NULL,
  `prod_qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_ID`, `user_ID`, `product_ID`, `prod_name`, `prod_price`, `prod_img`, `prod_qty`) VALUES
(112, 8, 5, 'Nachos', 30.00, 'images/nachos.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `user_ID` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `middleName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`user_ID`, `email`, `firstName`, `middleName`, `lastName`, `password`, `username`, `usertype`) VALUES
(8, 'litanaken@gmail.com', 'John Kenneth', 'Hate', 'Litana', '1234', 'Ryu', 'user'),
(12, 'admin@gmail.com', '', '', '', '1234', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(255) NOT NULL,
  `order_total` float(7,2) NOT NULL,
  `pmode` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `user_ID`, `order_date`, `order_status`, `order_total`, `pmode`, `phone`, `address`, `fullName`) VALUES
(33, 8, '2024-12-26 22:51:08', 'Order Cancelled', 75.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(34, 8, '2024-12-26 22:51:51', 'Order Cancelled', 195.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(35, 8, '2024-12-27 23:29:32', 'Order Cancelled', 190.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(36, 8, '2024-12-28 00:01:41', 'Order Paid', 30.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(37, 8, '2024-12-28 00:01:58', 'Order Paid', 64.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(38, 8, '2024-12-28 00:02:14', 'Order Paid', 300.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(39, 8, '2024-12-28 00:02:33', 'Order Paid', 59.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(40, 8, '2024-12-28 00:02:56', 'Order Paid', 124.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(41, 8, '2024-12-28 00:03:17', 'Order Paid', 69.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(42, 8, '2024-12-28 00:03:43', 'Order Cancelled', 219.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(43, 8, '2024-12-28 00:04:01', 'Order Cancelled', 135.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(44, 8, '2024-12-28 00:32:39', 'Order Cancelled', 1170.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(45, 8, '2024-12-28 00:33:13', 'Order Cancelled', 600.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(46, 8, '2024-12-28 00:33:42', 'Order Cancelled', 300.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(47, 8, '2024-12-28 00:40:22', 'Order Paid', 390.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(48, 8, '2024-12-28 00:40:43', 'Order Cancelled', 300.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(49, 8, '2024-12-28 00:42:54', 'Order Paid', 351.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(50, 8, '2024-12-28 00:47:03', 'Order Cancelled', 30.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana'),
(51, 8, '2024-12-28 00:47:34', 'Order Paid', 300.00, 'cod', '09556111280', 'Batangas St., Central Signal Village', 'John Kenneth H. Litana'),
(52, 8, '2024-12-28 01:40:21', 'Order Paid', 1440.00, 'cod', '09556111280', 'Camalig, Albay, Philippines', 'John Kenneth H. Litana');

-- --------------------------------------------------------

--
-- Table structure for table `orders_view`
--

CREATE TABLE `orders_view` (
  `view_ID` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_qty` int(255) NOT NULL,
  `prod_price` float(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_view`
--

INSERT INTO `orders_view` (`view_ID`, `order_ID`, `user_ID`, `prod_name`, `prod_qty`, `prod_price`) VALUES
(1, 33, 8, 'Halo-Halo', 1, 45.00),
(2, 33, 8, 'Nachos', 1, 30.00),
(3, 34, 8, 'Smoothie', 5, 39.00),
(4, 35, 8, 'Nachos', 2, 30.00),
(5, 35, 8, 'Fried Ice Cream', 2, 35.00),
(6, 35, 8, 'Fries', 2, 30.00),
(7, 36, 8, 'Nachos', 1, 30.00),
(8, 37, 8, 'Burger', 1, 35.00),
(9, 37, 8, 'Fruit Soda', 1, 29.00),
(10, 38, 8, 'Corndog', 10, 30.00),
(11, 39, 8, 'Fries', 1, 30.00),
(12, 39, 8, 'Fruit Soda', 1, 29.00),
(13, 40, 8, 'Fries', 2, 30.00),
(14, 40, 8, 'Fruit Soda', 1, 29.00),
(15, 40, 8, 'Burger', 1, 35.00),
(16, 41, 8, 'Smoothie', 1, 39.00),
(17, 41, 8, 'Corndog', 1, 30.00),
(18, 42, 8, 'Fries', 1, 30.00),
(19, 42, 8, 'Corndog', 5, 30.00),
(20, 42, 8, 'Smoothie', 1, 39.00),
(21, 43, 8, 'Halo-Halo', 3, 45.00),
(22, 44, 8, 'Smoothie', 30, 39.00),
(23, 45, 8, 'Corndog', 20, 30.00),
(24, 46, 8, 'Corndog', 10, 30.00),
(25, 47, 8, 'Smoothie', 10, 39.00),
(26, 48, 8, 'Corndog', 10, 30.00),
(27, 49, 8, 'Smoothie', 9, 39.00),
(28, 50, 8, 'Corndog', 1, 30.00),
(29, 51, 8, 'Corndog', 10, 30.00),
(30, 52, 8, 'Halo-Halo', 32, 45.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_ID` int(11) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_price` float(7,2) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_ID`, `category_ID`, `prod_name`, `prod_price`, `prod_desc`, `prod_img`) VALUES
(3, 1, 'Corndog', 30.00, 'Delicious corndogs with a crispy golden batter and juicy filling, perfect for a quick and satisfying snack!', 'images/corndogg.jpg'),
(4, 1, 'Fries', 30.00, 'Freshly made crispy fries, seasoned to perfection and served with your favorite dips!', 'images/fries.jpg'),
(5, 1, 'Nachos', 30.00, 'Crunchy nachos loaded with flavorful toppings and served with creamy cheese or savory dips!', 'images/nachos.jpg'),
(6, 2, 'Fried Ice Cream', 35.00, 'Crispy fried ice cream with a warm coating and a cool, creamy center – the perfect treat!', 'images/fried ice cream.jpg'),
(8, 3, 'Fruit Soda', 29.00, 'Refreshing fruit soda, bursting with vibrant flavors and fizzy goodness, the perfect thirst quencher!', 'images/fruit soda.jpg'),
(46, 1, 'Burger', 35.00, ' A juicy burger, grilled to perfection and packed with fresh toppings!', 'images/burger.jpg'),
(47, 3, 'Smoothie', 39.00, 'A refreshing fruit smoothie, blended fresh for a burst of natural flavor!', 'images/smoothie.jpg'),
(57, 2, 'Halo-Halo', 45.00, 'A sweet and refreshing halo-halo, packed with colorful toppings and creamy ice!', 'images/halo-halo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_ID` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_ID`, `category_name`) VALUES
(1, 'Snacks'),
(2, 'Dessert'),
(3, 'Beverage');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `product_ID` (`product_ID`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `User_ID` (`user_ID`),
  ADD UNIQUE KEY `User_ID_2` (`user_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `userz` (`user_ID`);

--
-- Indexes for table `orders_view`
--
ALTER TABLE `orders_view`
  ADD PRIMARY KEY (`view_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `user_ID` (`user_ID`);

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
  ADD PRIMARY KEY (`category_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `orders_view`
--
ALTER TABLE `orders_view`
  MODIFY `view_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `product` (`product_ID`),
  ADD CONSTRAINT `user_ID` FOREIGN KEY (`user_ID`) REFERENCES `customer_info` (`User_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `userz` FOREIGN KEY (`user_ID`) REFERENCES `customer_info` (`User_ID`);

--
-- Constraints for table `orders_view`
--
ALTER TABLE `orders_view`
  ADD CONSTRAINT `orders_view_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`order_ID`),
  ADD CONSTRAINT `orders_view_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `customer_info` (`User_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `prod_cat` FOREIGN KEY (`category_ID`) REFERENCES `product_category` (`category_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
