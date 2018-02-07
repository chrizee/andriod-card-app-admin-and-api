-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2018 at 07:08 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `tag` varchar(1) NOT NULL DEFAULT '0' COMMENT '0:free,1:paid',
  `price` float(8,2) NOT NULL DEFAULT '0.00',
  `link` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '0:deleted,1:active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `name`, `category`, `tag`, `price`, `link`, `created_at`, `status`) VALUES
(1, 'cake', 2, '1', 1234.00, 'img/wedding/5a7a97a4997cb.jpg', '2018-02-07 06:07:32', '1'),
(2, 'birth', 1, '0', 0.00, 'img/birthday/5a7a97d4ba455.jpg', '2018-02-07 06:08:20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `icon` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1:active,0:deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `icon`, `status`) VALUES
(1, 'birthday', '2018-02-07 05:54:27', 'img/icons/5a7a9493d2969.jpg', '1'),
(2, 'wedding', '2018-02-07 06:07:08', 'img/icons/5a7a978cefff6.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 active, 0 inactive(deleted), 2 leave, 3 sick'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `password`, `salt`, `created`, `status`) VALUES
(1, 'okoro efe', 'efe@gmail.com', 'M', 'ce2c692ee0f0a5f94ef530094c215ba2ebee1c42627cc77eac924162423ef2e8', '<+q9U,eãÊ`[ôVÄ½W+KDyL5L	', '2017-12-14 18:05:43', '1'),
(2, 'Junior', 'junior@gmail.com', 'M', '0a094c536487ef71679431feb27b4ac71f1883dbee705d443e607221895203be', '–¢Å:Ìï#Æ¾_ª\\ìƒœ8ù\Z|f–OQN|3à£', '2017-12-20 16:38:06', '1'),
(3, 'john', 'john@gmail.com', 'M', 'e7bc9ccb1eb79a6999d1aca7de1979fce16c397043fad5c0b636ed9ead36b5d2', 'âð¸ ëçíæ)‹¤fØÄÜˆ‡=Ów&nŠq€ªS?', '2018-01-05 07:30:25', '1'),
(4, 'okoro chris', 'chris@gmail.com', 'F', '25b2137df8b05edd781bc670aad5657e8db7df5090c9f2b7dda83fef099319aa', ';¹y½–b	Âæ~ªLtä|6’N0\0Øèxñø‰eŒ}', '2018-01-06 06:28:09', '1'),
(5, 'elo', 'elo@gmail.com', 'F', 'addbc85c467da8dfc07c90a40110dc57c80e554c6182ccf18acc9d2761f2e845', 'ŒEõý´º‡?ú0÷GÆ¾æ;l`uCh‘,³ƒ', '2018-01-06 06:31:08', '1'),
(6, 'Andrew', 'andrew@gmail.com', 'M', 'c9ccbe77cc0107b344270a0629c8138558088fbf1897c4bc2dc296019fc87e7e', '„w»db“-ø8[›‚ûÚÆ®ˆ³C\r…Ë€5pB', '2018-01-16 13:56:33', '1'),
(7, 'peter', 'peter@gmail.com', 'M', 'efbaf7e8a7727cfdf2a8250e1cd249710f8c6adade8242a0089ee111d0b7aca1', 'Ué°áøT\ZQ®½J¯\r÷é²ý^Z‚3éÎ7Šp£', '2018-01-16 13:59:01', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
