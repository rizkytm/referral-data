-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2020 at 11:48 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `referral_data`
--

CREATE TABLE `referral_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `name`, `email`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin', 'admin@referral.com', '$2y$10$PMuOgbLmXiH19COnx0KcIegpv7EogjjY53HTZRoRVqRoP9MMJu5Wm', 1, 0, '2019-07-21 21:46:46'),
(4, 'Erik', 'erik@gmail.com', '$2y$10$Jrt63H2iM.RU3Jb31M3HVeeyZ5OP31vs42I7KRUqrT3wm5kHjDrrG', 2, 0, '2019-11-26 20:47:06'),
(8, 'Eky', 'eky@mri.co.id', '$2y$10$Ya2nDBuh5AqgERuRggZS..ljSvoAuSGmoF6vpLUbTCtSL9AlMBN7q', 2, 0, '2020-05-22 16:27:12'),
(9, 'Eky', 'eky@gmail.com', '$2y$10$pwgXBWcrvu/EkfwN7CRGEumpNDchWJ0rVJHIcsaYCrlXHj1nwuSpO', 2, 0, '2020-05-22 16:42:00'),
(10, 'Rizky', 'ritrime97@gmail.com', '$2y$10$SXPUe8HdSnqXezFRqfFt1OC8IAPS5pgTgZpS8h5gNzzeSwNEdrA5C', 2, 1, '2020-05-22 16:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(5, 'eky@mri.co.id', '0J6nyz6QUHKY0Yq75lC/iap57Kp81dYUZMJLa6znu4Y=', 1590139632),
(6, 'eky@gmail.com', '61wp6hjTSR8TSe2UQOD4PwVQCzYwivpODTT7TCPt6N0=', 1590140520);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `referral_data`
--
ALTER TABLE `referral_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referral_data_ibfk_1` (`referral_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `referral_data`
--
ALTER TABLE `referral_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `referral_data`
--
ALTER TABLE `referral_data`
  ADD CONSTRAINT `referral_data_ibfk_1` FOREIGN KEY (`referral_id`) REFERENCES `user_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
