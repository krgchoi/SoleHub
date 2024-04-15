-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 12:51 PM
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
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(35, 2599.00, 'paid', 91185, '09278265151', 'Iloilo City', 'Zone5', '2024-04-11 16:55:01'),
(36, 2599.00, 'paid', 65397, '09278265151', 'Iloilo City', 'Zone5', '2024-04-11 16:57:21'),
(37, 1599.00, 'paid', 81166316, '09278265151', 'Iloilo City', 'Zone5', '2024-04-11 18:57:24'),
(38, 1599.00, 'paid', 81166316, '09278265151', 'Iloilo City', 'Zone5', '2024-04-12 02:58:36'),
(39, 1599.00, 'paid', 81166316, '09278265151', 'Iloilo City', 'Zone5', '2024-04-12 03:00:10'),
(40, 1599.00, 'paid', 81166316, '09278265151', 'Iloilo City', 'Zone5', '2024-04-12 08:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_img`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(39, 35, '211', 'Nike Air Max 90 LV8', 'Nike Air Max 90 LV8.png', 2599.00, 1, 91185, '2024-04-11 16:55:01'),
(40, 36, '211', 'Nike Air Max 90 LV8', 'Nike Air Max 90 LV8.png', 2599.00, 1, 65397, '2024-04-11 16:57:21'),
(41, 37, '208', 'Nike Air Force 1', 'Nike Air Force 1.png', 1599.00, 1, 81166316, '2024-04-11 18:57:24'),
(42, 38, '210', 'Nike Cortez', 'Nike Cortez.jpg', 1599.00, 1, 81166316, '2024-04-12 02:58:36'),
(43, 39, '208', 'Nike Air Force 1', 'Nike Air Force 1.png', 1599.00, 1, 81166316, '2024-04-12 03:00:10'),
(44, 40, '208', 'Nike Air Force 1', 'Nike Air Force 1.png', 1599.00, 1, 81166316, '2024-04-12 08:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`, `payment_date`) VALUES
(2, 29, 989378483, '5UC47226PU848914Y', '2024-04-10 15:07:12'),
(3, 30, 989378483, '9J305902TK2574618', '2024-04-10 15:08:28'),
(4, 32, 989378483, '2UM12005MY8302937', '2024-04-10 15:18:44'),
(5, 35, 91185, '74A3153559818273E', '2024-04-11 16:55:35'),
(6, 36, 65397, '4JU66119E20176846', '2024-04-11 16:57:58'),
(7, 37, 81166316, '9FG24058N1213125A', '2024-04-11 18:57:52'),
(8, 38, 81166316, '25309555JD1537411', '2024-04-12 02:59:50'),
(9, 39, 81166316, '4J014620H3219194X', '2024-04-12 03:24:18'),
(10, 40, 81166316, '8CE80087P49818253', '2024-04-12 08:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_brand` enum('adidas','nike','puma','vans') NOT NULL,
  `product_category` enum('women','men','kids') NOT NULL,
  `product_featured` enum('f','s') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_price`, `product_img`, `product_description`, `product_brand`, `product_category`, `product_featured`) VALUES
(208, 'Nike Air Force 1', 1599.00, 'Nike Air Force 1.png', 'Clean Look\r\n\r\nLuxe upper features premium leather for a clean, sophisticated look.Stitch-and-turn construction creates a streamlined, easy-to-style look.\r\n\r\n\r\nA Classic Re-Imagined\r\n\r\nThe classic Air Force 1 foam midsole is exaggerated, creating a platfor', 'nike', 'women', 'f'),
(210, 'Nike Cortez', 1599.00, 'Nike Cortez.jpg', 'The Nike Cortez was designed in 1972 by Nike co-founder Bill Bowerman to be lighter and more comfortable than any other. It quickly became the most popular running shoe in the country and has transformed into an unmistakable icon, woven into pop culture h', 'nike', 'women', 'f'),
(211, 'Nike Air Max 90 LV8', 2599.00, 'Nike Air Max 90 LV8.png', 'The Air Max was at the forefront of the movement. With even more exposed Air cushioning and a bold new colour affectionately dubbed Infrared, its revolutionised design helped the first 90 take on a life of its own.', 'nike', 'women', 'f'),
(212, 'Nike Air Max', 1299.00, 'Nike Air Max Plus.png', 'Revolutionary Air technology first made its way into Nike footwear in 1978. In 1987, the Air Max 1 debuted with visible Air technology in its heel, allowing fans more than just the feel of Air cushioning—suddenly they could see it. Since then, next-genera', 'nike', 'women', 'f'),
(213, 'PUMA Men Axelion Sleek', 1598.00, 'PUMA Men Axelion Sleek.jpg', 'Fabric typeCanvas \r\nCare instructionsMachine Wash \r\nSole materialRubber \r\nOuter materialCanvas ', 'puma', 'men', 'f'),
(214, 'Air Jordan1 Low', 2599.00, 'air jordan 1 low shoes 6Q1tFM.jpg', 'Inspired by the original that debuted in 1985, the Air Jordan 1 Low offers a clean, classic look that is familiar yet always fresh. With an iconic design that pairs perfectly with any fit, these kicks ensure you will always be on point.', 'adidas', 'men', 'f'),
(215, 'HANDBALL SPEZIAL SHOES', 1299.00, 'HANDBALL SPEZIAL SHOES.png', 'Clean, confident and looking sharp. The adidas Handball Spezial shoes secure their status as a modern fashion staple through sleek design and versatile style. Made initially for indoor sports in the 70s, these shoes show off timeless attitude through thei', 'adidas', 'men', 'f'),
(216, 'SL 72 SHOES', 3599.00, 'SL 72 SHOES.png', 'First released in 1972 to equip athletes for the Summer event, the adidas SL 72 shoes have a lightweight build that revolutionised running. Today, the breathable nylon upper, suede overlays and leather accents bring retro-inspired style to your active lif', 'adidas', 'men', 's'),
(217, 'Classic Slip-on Checkerboard Vanz', 899.00, 'Classic Slip-On Checkerboard Shoe.png', 'The Slip-On that is been Setting Trends Since 1979\r\nWhat started life in 1979 as the Vans #98 has become one of the most popular shoes in Southern California, and one of the most instantly recognizable shoes in the world. Slip-On shoes are undeniably styl', 'vans', 'men', 'f'),
(218, 'Marvel Spider Man', 799.00, 'Marvel Spider Man.png', 'This product features at least 20% recycled materials. By reusing materials that have already been created, we help to reduce waste and our reliance on finite resources and reduce the footprint of the products we make.', 'adidas', 'kids', 'f'),
(219, 'Kids Knu Skill Shoe', 899.00, 'Kids Knu Skool Shoe.png', 'A Puffy 90s Style Inspired by the Past, But Built for Today\r\n\r\nThe Kids Knu Skool is a modern interpretation of a classic 90s style, defined by its puffed up tongue and 3D-molded Sidestripe, and tied off with chunky laces.', 'vans', 'kids', 'f'),
(220, 'Anzarun Lite Youth Trainers', 1599.00, 'Anzarun Lite Youth Trainers.png', 'Deconstructed and refined, the Anzarun Lite Trainers ensure a clean look that is perfect for every occasion. Featuring a breathable mesh upper, a cushy EVA midsole and true heritage PUMA branding throughout, this trainer is comfort and style combined.', 'puma', 'kids', 'f');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `typed` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_id`, `first_name`, `last_name`, `email`, `pass`, `gender`, `contact_number`, `date`, `typed`) VALUES
(12, 91185, 'Kim Rholand', 'Guillem', 'admin@gmail.com', '$2y$10$NvtfG27Hc1CN9YYVyPE8TOiT42wS.sogSEMjVfNjzPgZ0lP6yReg.', 'Male', '09278265151', '2024-04-05 03:16:13', 'a'),
(24, 2147483647, 'Kim Rholand', 'Gui', 'kida.guillem.ui@phinmaed.com', '$2y$10$4x1H6cN3vUWEDYiarprWne2TKQobo0TXMKN.Y.IkxDj0Sw0Okm1pm', 'Female', '09278265152', '2024-03-27 06:59:42', 'g'),
(27, 81166316, 'Kim Rholand', 'Guillem', 'kida@gmail.com', '$2y$10$yhp4a19VcXSqw8pydbWB5.IMtqplEePu78MbOQ7Pd0rKwGsWSZqbC', 'Male', '09123456789', '2024-04-07 05:07:52', 'g'),
(29, 214748364, 'Jelly ann', 'Paja', 'jellyannpaja@gmail.com', '$2y$10$EpNfEdQ3NAb3EBgGZYDqhuUdnJgtP6oodjWrsKoDoV7JsRv0O856G', 'Female', ' 09123456789', '2024-04-03 18:03:28', 'g'),
(30, 9569, 'jasper', 'red', 'jasperredanas@gmail.com', '$2y$10$6KhykyhlTt8L5545NZgzSu6OkrXi1sp/pwOexLMozvNRHH6WU9G.i', 'Male', '09196190019', '2024-04-04 03:03:31', 'g'),
(31, 989378483, 'guest', 'guest', 'guest@gmail.com', '$2y$10$Czhm5/v7oNxo1hvPPn40Nudxoma0CZ77dRcL7OME9nlJ6xM5gQMp2', 'Male', '09278265151', '2024-04-10 13:05:48', 'g'),
(32, 97925, 'guest2', 'guest2', 'guest2@gmail.com', '$2y$10$Pmkb6Zdsijd9fomd2bscJe6pbhndwUTHqL7qbBATHMmgNolspqhUa', 'Female', ' 09278265151', '2024-04-10 16:51:10', 'g'),
(39, 755368375, 'Dona Jean', 'Asdulo', 'donajean@gmail.com', '$2y$10$kn0e7bClA7FPmeDTRjVQPuvViMhhoSgoJLnOjr7TBrukQqW/3jQr6', 'Female', '09123456789', '2024-04-12 07:30:22', 'g'),
(40, 65397, 'myname', 'mylast', 'myemail2@gmail.com', '$2y$10$hsPSj2pDaagddjU3Lz83n./.TEG33RwhwAqgIpD3q/..hB0J4yDEu', 'Male', '09278265151', '2024-04-11 14:56:41', 'g');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
