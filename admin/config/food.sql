-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 07:29 PM
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
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `product_qty`, `created_at`) VALUES
(1, 8, 2, 2, '2021-12-08 18:28:45'),
(2, 9, 2, 1, '2021-12-08 18:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(191) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `name`, `description`, `image`, `trending`, `status`, `created_at`) VALUES
(1, 'breakfast', 'Breakfast', '<p>All kinds of breakfast items</p>', 'vrzqfyqk8cvwr0kl3xuw.webp', 1, 0, '2021-10-02 10:36:14'),
(2, 'cakes', 'Cakes', '<h3 class=\"_2WzQq\" style=\"box-sizing: inherit; font-size: 20px; margin-right: 0px; margin-bottom: 5px; margin-left: 0px; font-weight: 600; position: relative; padding-top: 20px; color: rgb(40, 44, 63); font-family: ProximaNova, Arial, \"Helvetica Neue\", sans-serif;\">Cakes</h3>', 'cake1.webp', 0, 0, '2021-10-02 10:36:29'),
(3, 'biryani', 'Biryani', '<p>Biryani<br></p>', '1635665882.webp', 0, 0, '2021-10-31 07:38:02'),
(4, 'tandoori', 'Tandoori', '<h2 class=\"M_o7R\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 26px 0px 32px; font-size: 32px; letter-spacing: -0.3px; font-weight: 600; color: rgb(40, 44, 63); font-family: ProximaNova, Arial, &quot;Helvetica Neue&quot;, sans-serif;\">Tandoori</h2>', '1635672967.jpg', 0, 0, '2021-10-31 09:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(191) NOT NULL,
  `lname` varchar(191) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `pincode` varchar(191) NOT NULL,
  `address` mediumtext NOT NULL,
  `user_message` mediumtext DEFAULT NULL,
  `total_price` varchar(191) NOT NULL,
  `payment_id` varchar(191) DEFAULT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=Paid',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `tracking_no` varchar(191) NOT NULL,
  `cancel_reason` mediumtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fname`, `lname`, `phone`, `pincode`, `address`, `user_message`, `total_price`, `payment_id`, `payment_mode`, `payment_status`, `status`, `tracking_no`, `cancel_reason`, `created_at`) VALUES
(1, 2, 'Om', 'Prakash N', '6362565488', '555555', 'bangalore testing', 'Get some extra sambar', '150', '', 'COD', 0, 0, 'JRwkEcjZrMt1TNhfgoBuzGlvX', NULL, '2021-12-08 18:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_price` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `prod_qty`, `prod_price`, `created_at`) VALUES
(1, 1, 3, 2, '75', '2021-12-08 18:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `category_id` int(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `price` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `today_special` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(191) NOT NULL COMMENT 'veg,non neg',
  `availability_status` tinyint(4) NOT NULL DEFAULT 0,
  `trending` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `slug`, `category_id`, `name`, `description`, `price`, `image`, `today_special`, `type`, `availability_status`, `trending`, `status`, `created_at`) VALUES
(1, 'masala-dosa', 1, 'Masala Dosa', '<h3 class=\"styles_itemNameText__3bcKX\" style=\"box-sizing: inherit; margin-right: 4px; font-size: 1.22rem; color: rgb(62, 65, 82); word-break: break-word; font-family: ProximaNova, Arial, \"Helvetica Neue\", sans-serif;\">Masala Dosa</h3>', '45', '1634030335.webp', 0, 'Veg', 1, 0, 0, '2021-10-10 16:37:20'),
(2, 'butter-plain-dosa', 1, 'Butter Plain Dosa', '<div style=\"box-sizing: inherit; color: rgb(40, 44, 63); font-family: ProximaNova, Arial, \"Helvetica Neue\", sans-serif; font-size: 14px;\"><div style=\"box-sizing: inherit;\"><h3 class=\"styles_itemText__2y2Pm\" style=\"box-sizing: inherit; font-size: 1.22rem; color: rgb(62, 65, 82); word-break: break-word;\">Butter Plain Dosa</h3></div></div>', '70', '1634030436.webp', 0, 'Veg', 0, 1, 1, '2021-10-10 16:40:09'),
(3, 'panneer-plain-dosa', 1, 'Panneer Plain Dosa', '<h3 class=\"styles_itemText__2y2Pm\" style=\"box-sizing: inherit; font-size: 1.22rem; color: rgb(62, 65, 82); word-break: break-word; font-family: ProximaNova, Arial, \"Helvetica Neue\", sans-serif;\">Panneer Plain Dosa</h3>', '75', '1634030537.jpg', 1, 'Veg', 0, 0, 0, '2021-10-10 16:41:26'),
(4, 'Idli-2-pcs', 1, 'Idli (2 Pcs)', '<h3 class=\"styles_itemText__2y2Pm\" style=\"box-sizing: inherit; font-size: 1.22rem; color: rgb(62, 65, 82); word-break: break-word; font-family: ProximaNova, Arial, &quot;Helvetica Neue&quot;, sans-serif;\">Idli (2 Pcs)</h3>', '30', '1634030601.webp', 0, 'Veg', 0, 0, 0, '2021-10-10 17:03:07'),
(5, 'whole-wheat-pita-veg', 1, 'Whole wheat pita Veg', '<p><font color=\"rgba(40, 44, 63, 0.450980392156863)\" face=\"ProximaNova, Arial, Helvetica Neue, sans-serif\"><span style=\"font-size: 14px; letter-spacing: -0.3px;\">Indian masala cottage cheese crumble served with bread slice, watermelon &amp; pineapple salad, saute vegetables</span></font><br></p>', '158', '1635649438.webp', 1, 'Veg', 0, 1, 0, '2021-10-31 03:03:58'),
(6, 'chocolate-cake', 2, 'Chocolate Cake', '<p><br></p>', '120', '1635665189.webp', 1, 'Non-Veg', 1, 1, 0, '2021-10-31 07:26:29'),
(7, 'dutch-cake-1-pc-eggless', 2, 'Dutch Cake 1 Pc Eggless', '<p><br></p>', '124', '1635665385.webp', 1, 'Non-Veg', 0, 1, 0, '2021-10-31 07:29:45'),
(8, 'chicken-biryani', 3, 'Chicken Biryani', '<p>A flavorful combination of rice and succulent pieces of chicken cooked in a fragrant and flavorful masala seasoned with Indian whole spices; served with raita.(Serves - 1)<br></p>', '160', '1635665987.webp', 1, 'Non-Veg', 0, 1, 0, '2021-10-31 07:39:47'),
(9, 'nati-donne-biriyani', 3, 'Nati Donne Biriyani', '<p>Richly flavored aromatic rice layered with marinated chicken pieces in a delicate blend of spices.<br></p>', '170', '1635666093.webp', 1, 'Non-Veg', 0, 1, 0, '2021-10-31 07:41:33'),
(10, 'tandoori-chicken', 4, 'Tandoori Chicken', '<p>Tandoori chicken tandoori chicken full with mayonnaise &amp; mint chatni &amp; salad &amp; ( 2 pcs tandoori roti or parotta, your choice )<br></p>', '200', '1635672908.jpg', 0, 'Non-Veg', 0, 1, 0, '2021-10-31 09:35:08'),
(11, 'chicken-tikka-boneless', 0, 'Chicken Tikka Boneless', '', '260', '1635673440.jpg', 0, 'Non-Veg', 0, 0, 0, '2021-10-31 09:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(191) NOT NULL,
  `fname` varchar(191) NOT NULL,
  `lname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `role_as` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `status`, `role_as`, `created_at`) VALUES
(1, 'Admin', 'one', 'admin@gmail.com', '8880202020', '1234', 0, 1, '2021-09-30 14:53:00'),
(2, 'Om', 'Prakash N', 'om@gmail.com', '6362565488', '1234', 0, 0, '2021-10-01 09:46:51'),
(3, 'Ved', 'Prakash N', 'vedprakash151994@gmail.com', '8880202020', '1234', 0, 0, '2021-10-01 09:56:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
