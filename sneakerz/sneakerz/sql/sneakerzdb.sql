-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 02:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sneakerzdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bilal_cart`
--

CREATE TABLE `bilal_cart` (
  `cart_id` int(40) NOT NULL,
  `product_id` int(40) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_price` double NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_quantity` int(20) NOT NULL,
  `product_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labeeb_cart`
--

CREATE TABLE `labeeb_cart` (
  `cart_id` int(40) NOT NULL,
  `product_id` int(40) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_price` double NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_quantity` int(20) NOT NULL,
  `product_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labeeb_cart`
--

INSERT INTO `labeeb_cart` (`cart_id`, `product_id`, `product_name`, `product_price`, `product_image`, `product_quantity`, `product_total`) VALUES
(1, 1, 'Nike Black Sneaker', 5000, 'product_images/black-sneaker.png', 2, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(255) NOT NULL,
  `product_url` varchar(500) NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `product_price` double NOT NULL,
  `product_image_1` varchar(255) NOT NULL,
  `product_image_2` varchar(255) NOT NULL,
  `product_image_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_url`, `product_name`, `product_description`, `product_price`, `product_image_1`, `product_image_2`, `product_image_3`) VALUES
(1, 'nike-black-sneaker', 'Nike Black Sneaker', 'Introducing the Nike Black Sneaker, a sleek and versatile footwear option designed to provide both style and comfort. With its black colorway and timeless silhouette, this sneaker effortlessly combines fashion-forward design with the renowned quality and performance associated with the Nike brand.\r\n\r\n\r\n\r\n\r\n', 5000, 'product_images/black-sneaker.png', 'product_images/black-sneaker.png', 'product_images/black-sneaker.png'),
(2, 'nike-blue-sneaker', 'Nike Blue Sneaker', 'Introducing the Nike Blue Sneaker, a sleek and versatile footwear option designed to provide both style and comfort. With its black colorway and timeless silhouette, this sneaker effortlessly combines fashion-forward design with the renowned quality and performance associated with the Nike brand.\r\n\r\n\r\n\r\n\r\n', 1200, 'product_images/blue-sneaker.png', 'product_images/blue-sneaker.png', 'product_images/blue-sneaker.png'),
(3, 'nike-green-sneaker', 'Nike Green Sneaker', 'Introducing the Nike Green Sneaker, a sleek and versatile footwear option designed to provide both style and comfort. With its black colorway and timeless silhouette, this sneaker effortlessly combines fashion-forward design with the renowned quality and performance associated with the Nike brand.\r\n\r\n\r\n\r\n\r\n', 13500, 'product_images/green-sneaker.png', 'product_images/green-sneaker.png', 'product_images/green-sneaker.png'),
(4, 'nike-white-sneaker-2', 'Nike White Sneaker', 'Introducing the Nike White Sneaker, a sleek and versatile footwear option designed to provide both style and comfort. With its black colorway and timeless silhouette, this sneaker effortlessly combines fashion-forward design with the renowned quality and performance associated with the Nike brand.\r\n\r\n\r\n\r\n\r\n', 2560, 'product_images/white-sneaker.png', 'product_images/white-sneaker.png', 'product_images/white-sneaker.png'),
(24, 'nike-red-sneaker', 'Nike Red Sneaker', 'Cheapest Sneaker On The Market', 250, 'product_images/red-sneaker.png', 'product_images/red-sneaker.png', 'product_images/red-sneaker.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_address`, `user_type`, `user_token`) VALUES
(14, 'bilal', 'bilal@gmail.com', '$2y$10$UTSxRh1FByCZkI6Ix/zg/uF87SjlcTJekS8TP9BF6YhE2w1TVsuWm', 'bilal', 'user', '$2y$10$YsKprxZFArs95e312yxacOuMA3h9w.3h5zbSDJY2RNSfIaa7JFK2e'),
(15, 'labeeb', 'labeeb@gmail.com', '$2y$10$x8srJLasQR0poJa0XnvyVenS3hk75lbAIm4Al3iIs1sevzJDb7FQu', 'labeeb', 'user', '$2y$10$djOUDz19rRSmDQrzJGuyEuBvXrCBdV4Wd9TOpdDl5W3TlT5DbiMT2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bilal_cart`
--
ALTER TABLE `bilal_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `labeeb_cart`
--
ALTER TABLE `labeeb_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bilal_cart`
--
ALTER TABLE `bilal_cart`
  MODIFY `cart_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `labeeb_cart`
--
ALTER TABLE `labeeb_cart`
  MODIFY `cart_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
