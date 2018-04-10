-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2018 at 11:13 PM
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
  `sub_category` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(1) NOT NULL DEFAULT '0' COMMENT '0:free,1:paid',
  `price` float(8,2) NOT NULL DEFAULT '0.00',
  `link` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '0:deleted,1:active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `name`, `category`, `sub_category`, `tag`, `price`, `link`, `created_at`, `status`) VALUES
(1, 'test', 1, 1, '0', 0.00, 'img/birthday/5abf46201f53b.jpg', '2018-03-31 08:26:08', '0'),
(2, 'test1', 2, 0, '0', 0.00, 'img/wedding/5abf49f8355c2.jpg', '2018-03-31 08:42:32', '0'),
(3, 'test2', 1, 1, '0', 0.00, 'img/birthday/may/5abf4a19d9d12.jpg', '2018-03-31 08:43:05', '0'),
(4, 'space test1', 2, 2, '0', 0.00, 'img/wedding/sub test/5ac04b81ef65b.jpg', '2018-04-01 03:01:21', '0'),
(5, 'card_5acd044bb5df9', 2, 4, '1', 34.45, 'img/wedding/court/5acd044bb45c1.jpg', '2018-04-10 18:36:59', '0'),
(6, 'card_5acd048005481', 2, 4, '0', 0.00, 'img/wedding/court/5acd048003cc6.jpg', '2018-04-10 18:37:52', '0'),
(7, 'card_5acd2c597ec7b', 1, 0, '0', 0.00, 'img/birthday/5acd2c597ec81.jpg', '2018-04-10 21:27:53', '1'),
(8, 'card_5acd2c59c5c8e', 1, 0, '0', 0.00, 'img/birthday/5acd2c59c5c9c.jpg', '2018-04-10 21:27:53', '1'),
(9, 'card_5acd2c59e54f7', 1, 0, '0', 0.00, 'img/birthday/5acd2c59e5506.jpg', '2018-04-10 21:27:53', '1'),
(10, 'oke', 3, 0, '1', 200.00, 'img/test without sub/5acd2e5877304.jpg', '2018-04-10 21:36:24', '1'),
(11, 'efe', 1, 5, '0', 0.00, 'img/birthday/5acd2f19b61c4.jpg', '2018-04-10 21:39:37', '0'),
(12, 'efe1', 1, 5, '0', 0.00, 'img/birthday/5acd2f1a0881d.jpg', '2018-04-10 21:39:38', '1');

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
(1, 'birthday', '2018-04-10 18:32:51', 'img/icons/5abf451e98eac.jpg', '1'),
(2, 'wedding', '2018-04-10 18:53:19', 'img/icons/5abf45f40920c.jpg', '0'),
(3, 'test without sub', '2018-04-01 04:09:30', 'img/icons/5ac05b7a5b342.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent` varchar(11) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '0:deleted,1:active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `parent`, `icon`, `created_at`, `status`) VALUES
(1, 'may', '1', 'img/icons/5abf45cbcab44.jpg', '2018-03-31 09:24:43', '0'),
(2, 'sub test', '2', 'img/icons/5ac04a1d2cc13.jpg', '2018-04-01 03:55:25', '0'),
(3, 'trad', '2', 'img/icons/5ac0640c69020.jpg', '2018-04-01 05:46:04', '0'),
(4, 'court', '2', 'img/icons/5ac064271d006.jpg', '2018-04-01 05:46:31', '0'),
(5, 'april', '1', 'img/icons/5acd2f46c58a3.jpg', '2018-04-10 22:40:22', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pic` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 active, 0 inactive(deleted), 2 leave, 3 sick'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `salt`, `created`, `pic`, `status`) VALUES
(1, 'okoro efe', 'efe@gmail.com', 'ce2c692ee0f0a5f94ef530094c215ba2ebee1c42627cc77eac924162423ef2e8', '<+q9U,eãÊ`[ôVÄ½W+KDyL5L	', '2017-12-14 18:05:43', '', '1'),
(2, 'Junior', 'junior@gmail.com', '0a094c536487ef71679431feb27b4ac71f1883dbee705d443e607221895203be', '–¢Å:Ìï#Æ¾_ª\\ìƒœ8ù\Z|f–OQN|3à£', '2017-12-20 16:38:06', '', '1'),
(3, 'john', 'john@gmail.com', 'e7bc9ccb1eb79a6999d1aca7de1979fce16c397043fad5c0b636ed9ead36b5d2', 'âð¸ ëçíæ)‹¤fØÄÜˆ‡=Ów&nŠq€ªS?', '2018-01-05 07:30:25', '', '1'),
(4, 'okoro chris', 'chris@gmail.com', '25b2137df8b05edd781bc670aad5657e8db7df5090c9f2b7dda83fef099319aa', ';¹y½–b	Âæ~ªLtä|6’N0\0Øèxñø‰eŒ}', '2018-01-06 06:28:09', '', '1'),
(5, 'elo', 'elo@gmail.com', 'addbc85c467da8dfc07c90a40110dc57c80e554c6182ccf18acc9d2761f2e845', 'ŒEõý´º‡?ú0÷GÆ¾æ;l`uCh‘,³ƒ', '2018-01-06 06:31:08', '', '1'),
(6, 'Andrew', 'andrew@gmail.com', 'c9ccbe77cc0107b344270a0629c8138558088fbf1897c4bc2dc296019fc87e7e', '„w»db“-ø8[›‚ûÚÆ®ˆ³C\r…Ë€5pB', '2018-01-16 13:56:33', '', '1'),
(7, 'peter', 'peter@gmail.com', 'efbaf7e8a7727cfdf2a8250e1cd249710f8c6adade8242a0089ee111d0b7aca1', 'Ué°áøT\ZQ®½J¯\r÷é²ý^Z‚3éÎ7Šp£', '2018-01-16 13:59:01', '', '1'),
(8, 'new admin', 'admin@admin.com', '5c5a800b87b0ce3d254b8ff36aff26eb9d2e64b63aa9af7ea416b27889c20096', 'PKFMY0,N*Pn5fAo??xW#:vo5&g%^c9Go', '2018-04-10 15:19:42', '', '1'),
(9, 'new admin2', 'admin2@admin.com', 'cd0150c543bb15001f6c06e50acd07f03814ff19066842682b8c611066a6a5b7', '50Uq9YTa%lD*SaycL-&_+&HAKeI.8B=;', '2018-04-10 15:27:43', '', '1'),
(10, 'maylite2', 'may@gmail.co', '55aa77325589d5ba1dcc296cd647a6d3d806c345e399b8d4f7637e040a0c63fb', '2sfnjq=@7FJzY.X)G^7d;qDt8==UzDCU', '2018-04-10 16:41:28', '5acce1aa14a40.jpg', '1'),
(11, 'solo', 'solo@gmail.com', '99a61788307ca06af3465bad25b9005a0ac108d120c0ce7deca28e5012831e97', '0Qr3pwk=;J:nPuT^PoT$?orf?;kdwl_.', '2018-04-10 17:11:53', '5acce2d44746a.jpg', '1');

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
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
