-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2022 at 08:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auto_pal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL,
  `roles` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`id`, `roles`, `created_at`) VALUES
(1, 'admin', '2022-12-15 08:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `email`, `password`, `user_role`, `created_at`) VALUES
(1, 'admin', 'admin@mail.com', '$2y$10$BF2sR2TPirHZVD3AUzDF0eQM77ZIs3kXwD2bZQ7KCMO/Qo3OuVW26', 1, '2022-12-15 08:47:12'),
(2, 'newuser', 'newuser@mail.com', '$2y$10$ANll4oed7Oh8YxSG6sqtMetQBHN65C8pg.ymPjMHrQ0XBALGxGNFK', 2, '2022-12-15 08:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mech_id` int(11) NOT NULL,
  `theDate` date NOT NULL,
  `theTime` time NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `mech_id`, `theDate`, `theTime`, `createdAt`) VALUES
(23, 36, 39, '2022-12-26', '13:24:00', '2022-12-15 12:24:16'),
(24, 36, 40, '2022-12-30', '13:24:00', '2022-12-15 12:24:36'),
(25, 37, 41, '2022-12-30', '13:25:00', '2022-12-15 12:25:05'),
(26, 37, 42, '2022-12-28', '13:25:00', '2022-12-15 12:25:15'),
(27, 38, 43, '2022-12-21', '13:54:00', '2022-12-15 12:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_type` int(11) NOT NULL,
  `car_color` varchar(64) NOT NULL,
  `car_model` varchar(64) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `user_id`, `car_type`, `car_color`, `car_model`, `create_at`) VALUES
(9, 36, 1, 'Black', 'Compressor', '2022-12-15 12:16:54'),
(10, 37, 2, 'Black', 'Saden', '2022-12-15 12:17:33'),
(11, 38, 3, 'Black', 'A5', '2022-12-15 12:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `mechanic`
--

CREATE TABLE `mechanic` (
  `id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`id`, `type`, `created_at`) VALUES
(1, 'Mercedes Benz', '2022-12-13 12:29:35'),
(2, 'Toyota', '2022-12-13 12:29:35'),
(3, 'Audi', '2022-12-13 12:30:11'),
(4, 'Corolla ', '2022-12-13 12:30:11'),
(5, 'VolksWagon', '2022-12-13 12:31:02'),
(6, 'Peugeot ', '2022-12-13 12:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `msg` text NOT NULL,
  `mob` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderItems`
--

CREATE TABLE `orderItems` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `status` varchar(128) NOT NULL,
  `reason` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totalPrice` varchar(64) NOT NULL,
  `orderStatus` varchar(128) NOT NULL,
  `paymentMode` varchar(128) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `totalPrice`, `orderStatus`, `paymentMode`, `create_at`) VALUES
(14, 36, '25600', 'Order Placed', '', '2022-12-17 09:25:10'),
(15, 36, '5300', 'Order Placed', '', '2022-12-20 20:46:23'),
(16, 37, '35800', 'Order Placed', '', '2022-12-20 20:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `orderTracking`
--

CREATE TABLE `orderTracking` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderTracking`
--

INSERT INTO `orderTracking` (`id`, `orderid`, `productid`, `quantity`, `productprice`) VALUES
(27, 14, 1, 2, 300),
(28, 14, 2, 5, 5000),
(29, 15, 1, 1, 300),
(30, 15, 2, 1, 5000),
(31, 16, 1, 1, 300),
(32, 16, 2, 1, 5000),
(33, 16, 4, 1, 30500);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `body` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_name` varchar(64) NOT NULL,
  `product_price` varchar(64) NOT NULL,
  `product_desc` text DEFAULT NULL,
  `product_img` varchar(258) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `product_name`, `product_price`, `product_desc`, `product_img`, `category_id`, `created_at`) VALUES
(1, NULL, 'Spanner', '300', NULL, 'uploads/639c326651a75.jpg', NULL, '2022-12-16 08:55:02'),
(2, NULL, 'Jack', '5000', NULL, 'uploads/639c354e1d7b5.jpg', NULL, '2022-12-16 09:07:26'),
(3, NULL, 'tyre', '50000', NULL, 'uploads/639c359f32c01.jpg', NULL, '2022-12-16 09:08:47'),
(4, NULL, 'Compressor', '30500', NULL, 'uploads/639c35e5f047c.jpg', NULL, '2022-12-16 09:09:57'),
(5, NULL, 'plug', '700', NULL, 'uploads/639c367dda48c.jpg', NULL, '2022-12-16 09:12:29'),
(6, NULL, 'plug', '700', NULL, 'uploads/639c371d57ed2.jpg', NULL, '2022-12-16 09:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `roles` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `user_type`, `roles`, `created_at`) VALUES
(3, 1, 'mech', '2022-12-16 13:06:44'),
(4, 2, 'Customer', '2022-12-16 08:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `user_type` varchar(128) DEFAULT NULL,
  `password` varchar(258) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`, `createdAt`) VALUES
(36, 'newuser1', 'newuser1@mail.com', '2', '$2y$10$mT54.E6.JekN4xB8/r5lzuM31JT8No2DOVekWbSUIM0NTRRJanLKS', '2022-12-15 12:16:29'),
(37, 'newuser2', 'newuser2@mail.com', '2', '$2y$10$a5BajpHIguw1aQnTqVcBeevzGAACI6BlvOYhB692kDJolfDrpEKaS', '2022-12-15 12:17:18'),
(38, 'newuser3', 'newuser3@mail.com', '2', '$2y$10$DUkFz2gDhyECfwperHKoUeGo1GR5cDDVuvR3CF/P8.JwV.5gKJOsC', '2022-12-15 12:17:59'),
(39, 'newmech1', 'newmech1@mail.com', '1', '$2y$10$NvSAWpO6u4Tw3GSgTGE3Eu7Fd3Dzf620l7XE21fc.f6Ok/K1790Dm', '2022-12-15 12:18:43'),
(40, 'newmech2', 'newmech2@mail.com', '1', '$2y$10$f7tAp74Vdvv2cSXLs/jm7OEXMzCUv3mAFAhSdOQfhGAA2B9lIQLSG', '2022-12-15 12:19:37'),
(41, 'newmech3', 'newmech3@mail.com', '1', '$2y$10$6rhDSUcFSbW/iTYPrQhHJeYL3iAOr2Zh0wJ2Q0JneHbGzlYctxIEe', '2022-12-15 12:20:17'),
(42, 'newmech4', 'newmech4@mail.com', '1', '$2y$10$9KR7ZeoKUbbnPcZlkDYZpOKk87aaSlB8gRbGaR.G1p8RECSAw30Pm', '2022-12-15 12:21:49'),
(43, 'newmech5', 'newmech5@mail.com', '1', '$2y$10$2I4WIsniaSw7Yz0LH9UTJOgnMrra8yO7QlctQmV/IcYRXqSeFjqmW', '2022-12-15 12:22:35'),
(44, 'newmech6', 'newmech6@mail.com', '1', '$2y$10$DTatqxLK8I/V84JninBVMuexhPDtZxM23z1gyawXCJ6AidYxzgDmW', '2022-12-15 12:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `img` varchar(128) DEFAULT NULL,
  `mobile_phone` varchar(64) DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`id`, `user_id`, `firstname`, `lastname`, `img`, `mobile_phone`, `user_type`, `address`, `created_at`) VALUES
(13, 39, 'Dung', 'Umar', NULL, '987654323', 1, 'Dadin Kowa', '2022-12-17 09:13:21'),
(14, 40, 'Sadiq', 'Umar', NULL, NULL, 1, 'dfsdjf', '2022-12-15 12:19:59'),
(15, 41, 'johm', 'Doe', NULL, NULL, 2, 'fjdhfhjf', '2022-12-15 12:20:46'),
(16, 42, 'doe', 'john', NULL, NULL, 2, 'kfldld', '2022-12-15 12:22:12'),
(30, 36, 'Dung', 'Peter', NULL, '987654323', 1, 'mama iyabo', '2022-12-20 20:46:23'),
(31, 37, 'Dung', 'Umar', NULL, '987654321', 2, 'mama iyabo', '2022-12-20 20:48:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mechanic`
--
ALTER TABLE `mechanic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderItems`
--
ALTER TABLE `orderItems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderTracking`
--
ALTER TABLE `orderTracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderItems`
--
ALTER TABLE `orderItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orderTracking`
--
ALTER TABLE `orderTracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
