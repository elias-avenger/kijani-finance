-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 04:24 PM
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
-- Table structure for table `budgeting_entities`
--

CREATE TABLE `budgeting_entities` (
  `id` int(2) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text DEFAULT NULL,
  `incharge` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `quantity` double(6,1) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `_from` date NOT NULL,
  `_to` date NOT NULL,
  `budget_no` varchar(45) DEFAULT NULL,
  `submitted_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `incharge` int(5) UNSIGNED ZEROFILL NOT NULL,
  `submitted_by` int(5) UNSIGNED ZEROFILL NOT NULL,
  `entity` int(2) UNSIGNED ZEROFILL NOT NULL,
  `item` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `budget_items`
--

CREATE TABLE `budget_items` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `category` int(2) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entity_has_item`
--

CREATE TABLE `entity_has_item` (
  `entity` int(2) UNSIGNED ZEROFILL NOT NULL,
  `item` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(2) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` int(8) UNSIGNED NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_by` int(5) DEFAULT NULL,
  `req_no` varchar(20) DEFAULT NULL,
  `quantity` double(6,1) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `invoice` varchar(45) DEFAULT NULL,
  `entity` int(2) UNSIGNED ZEROFILL NOT NULL,
  `item` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `dob` date DEFAULT NULL,
  `type` char(1) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `registered_by` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `last_updated` date DEFAULT NULL,
  `last_updated_by` int(5) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgeting_entities`
--
ALTER TABLE `budgeting_entities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_budgeting_entities_users1_idx` (`incharge`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_budgets_users1_idx` (`submitted_by`),
  ADD KEY `fk_budgets_entity_has_item1_idx` (`entity`,`item`);

--
-- Indexes for table `budget_items`
--
ALTER TABLE `budget_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_budget_items_item_categories1_idx` (`category`);

--
-- Indexes for table `entity_has_item`
--
ALTER TABLE `entity_has_item`
  ADD PRIMARY KEY (`entity`,`item`),
  ADD KEY `fk_budgeting_entities_has_budget_items_budget_items1_idx` (`item`),
  ADD KEY `fk_budgeting_entities_has_budget_items_budgeting_entities1_idx` (`entity`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_requisitions_entity_has_item1_idx` (`entity`,`item`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgeting_entities`
--
ALTER TABLE `budgeting_entities`
  MODIFY `id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget_items`
--
ALTER TABLE `budget_items`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budgeting_entities`
--
ALTER TABLE `budgeting_entities`
  ADD CONSTRAINT `fk_budgeting_entities_users1` FOREIGN KEY (`incharge`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `fk_budgets_entity_has_item1` FOREIGN KEY (`entity`,`item`) REFERENCES `entity_has_item` (`entity`, `item`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_budgets_users1` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `budget_items`
--
ALTER TABLE `budget_items`
  ADD CONSTRAINT `fk_budget_items_item_categories1` FOREIGN KEY (`category`) REFERENCES `item_categories` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `entity_has_item`
--
ALTER TABLE `entity_has_item`
  ADD CONSTRAINT `fk_budgeting_entities_has_budget_items_budget_items1` FOREIGN KEY (`item`) REFERENCES `budget_items` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_budgeting_entities_has_budget_items_budgeting_entities1` FOREIGN KEY (`entity`) REFERENCES `budgeting_entities` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD CONSTRAINT `fk_requisitions_entity_has_item1` FOREIGN KEY (`entity`,`item`) REFERENCES `entity_has_item` (`entity`, `item`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
