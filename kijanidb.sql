-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 10:11 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kijanidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `item` int(3) UNSIGNED ZEROFILL NOT NULL,
  `quantity` double(6,1) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `_from` date NOT NULL,
  `_to` date NOT NULL,
  `submitted_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `submitted_by` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `budgeting_entity`
--

CREATE TABLE `budgeting_entity` (
  `id` int(2) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text DEFAULT NULL,
  `incharge` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `budget_items`
--

CREATE TABLE `budget_items` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(45) NOT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `category` int(2) UNSIGNED ZEROFILL NOT NULL,
  `entity` int(2) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(2) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `type` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_budget_item` (`item`),
  ADD KEY `idx_budget_user` (`submitted_by`);

--
-- Indexes for table `budgeting_entity`
--
ALTER TABLE `budgeting_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_budgeting_entity_user` (`incharge`);

--
-- Indexes for table `budget_items`
--
ALTER TABLE `budget_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_item_category` (`category`),
  ADD KEY `idx_item_budgeting_entity` (`entity`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
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
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budgeting_entity`
--
ALTER TABLE `budgeting_entity`
  MODIFY `id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_items`
--
ALTER TABLE `budget_items`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `fk_budget_item` FOREIGN KEY (`item`) REFERENCES `budget_items` (`id`),
  ADD CONSTRAINT `fk_budget_user` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `budgeting_entity`
--
ALTER TABLE `budgeting_entity`
  ADD CONSTRAINT `entity_user` FOREIGN KEY (`incharge`) REFERENCES `users` (`id`);

--
-- Constraints for table `budget_items`
--
ALTER TABLE `budget_items`
  ADD CONSTRAINT `fk_item_budgeting_entity` FOREIGN KEY (`entity`) REFERENCES `budgeting_entity` (`id`),
  ADD CONSTRAINT `fk_item_category` FOREIGN KEY (`category`) REFERENCES `item_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
