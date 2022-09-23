-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql201.byetcluster.com
-- Generation Time: Sep 23, 2022 at 06:06 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unaux_32509123_mail`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `email_add` varchar(255) NOT NULL,
  `rec_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_otp` varchar(255) NOT NULL,
  `mob_num` varchar(255) NOT NULL,
  `rec_email_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `first_name`, `last_name`, `country`, `timezone`, `email_add`, `rec_email`, `password`, `last_otp`, `mob_num`, `rec_email_status`) VALUES
(42, 'Sazid Hasan', 'Sazid', 'Hasan', 'Bangladesh', 'Asia/Dhaka', 'sazid@fakemail.com', 'sazidhasan14.03.2007@gmail.com', '@no pain no gain1122', '', '01789942513', ''),
(43, 'Owner ', 'Owner', '', 'Bangladesh', 'Asia/Dhaka', 'owner@fakemail.com', 'sazid@fakemail.com', '@no pain no gain1122', '', '01972631975', ''),
(44, 'Tanzila Noor Tamanna', 'Tanzila Noor', 'Tamanna', 'Bangladesh', 'Asia/Dhaka', '@fakemail.com', '', 'disgusting', '', '01781345802', ''),
(45, 'its  me', 'its ', 'me', 'Bangladesh', 'Asia/Dhaka', 'itsme@fakemail.com@fakemail.com', '', '1111', '', '01789942513', ''),
(46, 'tester me', 'tester', 'me', 'Bangladesh', 'Asia/Dhaka', 'tester@fakemail.com', '', '1234', '', '01780000000', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
