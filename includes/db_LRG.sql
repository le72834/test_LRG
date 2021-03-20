-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 25, 2021 at 04:35 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_LRG`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_executive`
--

CREATE TABLE `tbl_executive` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `avatar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_executive`
--

INSERT INTO `tbl_executive` (`id`, `name`, `role`, `email`, `avatar`) VALUES
(1, 'Carl Vink', 'President', 'president@londonrefereesgroup.com', 'vink.jpg'),
(2, 'Joe Masse', 'Vice President', 'vp@londonrefereesgroup.com', 'masse.jpg'),
(3, 'John Bray', 'Secretary', 'secretary@londonrefereesgroup.com', 'bray.jpg'),
(4, 'Rob Neable', 'Treasurer', 'treasurere@londonrefereesgroup.com', 'neable.jpg'),
(5, 'Bob Wright', 'RIC', 'ric@londonrefereesgroup.com', 'wright.jpg'),
(6, 'Paul Raes', 'Rep 1', 'rep1@londonrefereesgroup.com', 'rase.jpg'),
(7, 'Mel Alexander', 'Rep 2', 'rep2@londonrefereesgroup.com', 'alex.jpg'),
(8, 'Marc Giroux', 'Assignor 1', 'assignor1@londonrefereesgroup.com', 'giroux.jpg'),
(9, 'Jamie Dewar', 'Assignor 2', 'assignor2@londonrefereesgroup.com', 'dewar.jpg'),
(10, 'Paul Schofield', 'Scheduler', 'scheduler@londonrefereesgroup.com', 'schofield.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_executive`
--
ALTER TABLE `tbl_executive`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_executive`
--
ALTER TABLE `tbl_executive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
