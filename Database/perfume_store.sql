-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 05, 2025 at 08:47 PM
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
-- Database: `perfume_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `category` enum('men','women','unisex','best_seller') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `description`, `images`, `category`) VALUES
(1, 'Jaguar Men Classic EDT', 450.00, 'رائحة قوية وعصرية تناسب الرجل العصري.', 'images/products/Men/1-1.png', 'men'),
(2, 'Versace Men Dylan', 580.00, 'رائحة قوية وعصرية تناسب الرجل العصري.', 'images/products/Men/2-1.png', 'men'),
(3, 'GIORGIO ARMANI Aqua Di Gio', 600.00, 'رائحة قوية وعصرية تناسب الرجل العصري.', 'images/products/Men/3-1.png', 'men'),
(4, 'Dunhill Men Icon Elite', 350.00, 'رائحة قوية وعصرية تناسب الرجل العصري.', 'images/products/Men/4-1.png', 'men'),
(5, 'Paco Rabbane Men Invictus', 330.00, 'رائحة قوية وعصرية تناسب الرجل العصري.', 'images/products/Men/5-1.png', 'men'),
(6, 'Carolina Harrera Bad Boy', 399.00, 'رائحة قوية وعصرية تناسب الرجل العصري.', 'images/products/Men/6-1.png', 'men'),
(7, 'Dolce & Gabbana Women The Only', 485.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/1-1.png', 'women'),
(8, 'Michael Kors Women Sexy', 360.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/2-1.png', 'women'),
(9, 'Bvlgari Splendid Jasmin Noir', 520.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/3-1.png', 'women'),
(10, 'Versace Pour Femme Dylan Blue', 570.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/4-1.png', 'women'),
(11, 'Carolina Herrera Women Good Girl', 540.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/5-1.png', 'women'),
(12, 'Jean Paul Gaultier Women Scandal', 365.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/women/6-1.png', 'women'),
(13, 'Dolce & Gabbana Women The Only', 465.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/1-1.png', 'unisex'),
(14, 'Michael Kors Women Sexy', 550.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/2-1.png', 'unisex'),
(15, 'Bvlgari Splendid Jasmin Noir', 650.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/3-1.png', 'unisex'),
(16, 'Versace Pour Femme Dylan Blue', 640.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/4-1.png', 'unisex'),
(17, 'Carolina Herrera Women Good Girl', 370.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/5-1.png', 'unisex'),
(18, 'Jean Paul Gaultier Women Scandal', 490.00, 'عبير أنثوي ناعم يدوم طوال اليوم.', 'images/products/Unisex/6-1.png', 'unisex'),
(23, 'Dolce & Gabbana Women', 599.00, ' عطر نسائي كلاسيكي يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الياسمين والورد', 'images/best-product/B1-1.png', 'best_seller'),
(24, 'Jean Paul Gaultier', 590.00, 'عطر جريء يجمع بين الفانيليا الدافئة والمسك، مع لمسة من الزنجبيل والحمضيات', 'images/best-product/B2-1.png', 'best_seller'),
(25, 'Carolina Harrera Women 212 VI', 380.00, 'عطر أنثوي فاخر يجمع بين نضارة الحمضيات ودفء المسك، مع لمسة من الفانيليا.', 'images/best-product/B3-1.png', 'best_seller');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'emad', 'emad.aladl@gmail.com', '$2y$10$inbAGuRCBh4kylZ9WnFyZOPv/yzBlYRbDBGuCk8oYr6gcUTDwB/.W', 'admin'),
(2, 'ali', 'ali@gmail.com', '$2y$10$fkwvdPJE53oke8lpFPzuA.gsWFuN7KbAUx32pk3xd/U6RLsZMXFCC', 'user'),
(3, 'omar65', 'omar@gmail.com', '$2y$10$IaR4JQUfgyv27dmvxc4Ir.ln3Z.Cd0dp0SkfuudODfbltivrfbLhq', 'user'),
(4, 'ahmad', 'ahmad@gmail.com', '$2y$10$x5nPt9dHaJB/9JJHCJX3IeozAdkcb2RQ/8oQ58xJJOm024JeP.z82', 'user'),
(5, 'admin', 'admin@example.com', '$2y$10$Vm5H5nACWv74q0VnuVMWMunIFknGJLPI8q8hBBx/IPxy/vH76CB6y', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
